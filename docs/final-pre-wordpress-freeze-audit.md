# SMB Real Estate — Final Pre-WordPress Freeze Audit

Audit date: 2026-07-30
Scope: current source code, runtime output (PHP 8.2 built-in server via `router.php`, reproducing `.htaccess` rewrites), rendered pages, public routes, assets, current data. No prior audit reports were used as evidence.

## 1. Verdict

**NOT READY FOR WORDPRESS CONVERSION**

Three Blocker-level defects exist in code the freeze would canonize as the WordPress reference: the enquiry form (used on every project page and Contact) shows a false "Thank You" success state while transmitting the entered data nowhere; every article page emits an identical, incorrect canonical/OG URL regardless of which article is being viewed; and the Communities page ships six public "lifestyle" filter cards that are dead links, self-documented in the markup as `(Filtered View To Be Added)`. None of these require a content or design decision to fix — they are code-level bugs — but freezing before they are corrected would make the false-success form and the broken canonical logic the literal reference behavior for WordPress to replicate.

## 2. Scope & Method

This is a resumed audit. The prior session left no report file and no recorded findings, but did leave partial visual-review evidence (12 desktop + 7 tablet screenshots at repo root). Per the resume instructions, inventories were not rebuilt from scratch; instead this session performed the verification phases directly against current source and runtime state:

- Static analysis: `php -l` on every `.php` file, `json_decode` validation of `data/*.json` against `data/*.schema.json`, cross-reference of every record's required fields, media paths, and relationships.
- Runtime crawl: PHP 8.2 built-in server (`php -S localhost:8091 router.php`, which reproduces the production `.htaccess` flat-URL rewrites for local use only) — every one of the 46 public routes was requested and inspected for status code, H1 count, canonical URL, duplicate IDs, and PHP warnings/notices.
- Source inspection of every canonical shared component: header, footer, breadcrumb, project/developer/article card, enquiry form, project/developer/article templates, gallery/lightbox and section-background-alternation logic.
- Visual review: the prior session's 12 desktop + 7 tablet screenshots were reused; the missing 5 tablet views and all 12 mobile views (previously absent entirely) were captured this session via Playwright against the local server, including a manual scroll-through verification of the reveal-on-scroll animation system.

## 3. Verification Summary

| Check | Result | Coverage | Evidence |
|---|---|---|---|
| PHP lint (`php -l`) | Pass | 100% of `.php` files | No syntax errors on any file |
| JSON well-formed + schema required-fields | Pass | `projects.json` (19/19), `developers.json` (20/20) | Schema enumerates exact slug lists; counts match exactly |
| Duplicate slugs | None found | Projects, Developers, Articles | Slug sets are unique per dataset |
| Project→Developer relationship | Consistent | 19/19 projects | Every `developer` field matches a `canonical_name`/`display_name` |
| Media reference integrity | Pass | All project hero/gallery/OG/structured-data images, all developer logos, all article images (incl. inline `<img>` in article HTML) | 0 missing files |
| Route crawl (status, H1, canonical) | 46/46 routes 200, exactly 1 H1 each | 7 top-level pages, 20 developers, 19 projects | Live curl crawl; canonical **wrong** on article routes — see F-2 |
| 404 handling | Correct | Unknown developer slug, unknown project slug, unknown article slug, random route | All return HTTP 404; article 404 renders a real "Article Not Found" page |
| Duplicate DOM IDs | None found | 9 spot-checked routes across every template type | — |
| PHP warnings/notices in server log | None | All 46 route requests | Clean log |
| `git diff --check` | No blocking whitespace errors | Full diff | Only benign LF→CRLF line-ending notices |
| Placeholder / TODO / Lorem ipsum scan | 1 real instance found | All `.php` | `pages/communities.php` — see F-3 |
| Dead `href="#"` scan | 1 file, 6 instances | All `.php` | `pages/communities.php` only |
| Sitemap completeness | Incomplete | `sitemap.xml` vs. live routes | Missing `articles.php` + all 3 article URLs — see F-4 |
| Enquiry form data transmission | **Broken (false success)** | `assets/js/main.js` `setupForm()`, all form instances | No `fetch`/`XHR`/form `action`/`mailto` anywhere — see F-1 |
| Section background alternation | Robust | `main.css:144-145` | Pure CSS `:nth-child(even of [data-neutral-section])` — immune to missing/optional/removed sections by construction |
| Reveal-on-scroll content | Functional | `communities.php` manual scroll test | 47/47 `[data-reveal]` items reach `is-visible` after a real scroll-through (see Limitations for a screenshot-tooling caveat) |
| Reduced-motion support | Present | `main.css`, `home.css`, `services.css` | `prefers-reduced-motion` handled |
| Visual review — desktop | Complete | All 12 representative page types | Screenshots (prior session, reused) |
| Visual review — tablet | Complete | All 12 representative page types | 7 reused (prior session) + 5 captured this session |
| Visual review — mobile | Complete | All 12 representative page types + mobile nav | 12 captured this session (previously absent) |

## 4. Route & Record Coverage

- **Routes (46/46 crawled):** `index.php` + 6 top-level pages (`about`, `services`, `developers`, `communities`, `contact`, `articles`) + 20 developer archive pages + 19 project pages. `article.php?slug=…` covered for all 3 existing articles plus an unknown-slug 404 case. `.htaccess` rewrite rules enumerate exactly the 20 developer slugs and 19 project slugs present in the data files — no drift between routing, data, and filesystem.
- **Projects (19/19 validated):** every record satisfies its schema's required fields (`slug`, `name`, `developer`, `seo`, `hero`, `structured_data`, `districts`, `facts`, `overview`, `gallery`, `amenities`, `location`); every referenced image resolves on disk; every `developer` field matches a real developer record. `districts.enabled` is `true` only for `damac-islands2` (the schema's explicit source template) and correctly renders the optional Districts section only there — confirmed live for both the enabled and a disabled case.
- **Developers (20/20 validated):** all required fields present, all logos resolve on disk. Project counts per developer range 0–2; `mag-group-holding` and `samana-developers` have 0 live projects and correctly render the "Coming Soon" empty state (visually confirmed for `mag-group-holding`); `damac-properties` has 2 and correctly renders a populated grid.
- **Articles (3/3 validated):** all required fields present, all images (including images embedded inline in article HTML body) resolve on disk. Articles are the one record type not backed by JSON/schema — see F-5.
- **Wrapper files:** all 39 developer/project PHP files (and the article/project/developer templates) are confirmed thin 3-line wrappers (`$slug = '...'; require '.../template.php';`) — zero per-record markup duplication or hacks.

## 5. Findings

**F-1 — Enquiry form shows false success; entered data is transmitted nowhere**
Severity: **Blocker**
Files: `template-parts/enquiry-form.php`, `assets/js/main.js:197-224`
Evidence: `setupForm()` calls `event.preventDefault()`, validates fields client-side, then unconditionally hides the form and reveals the "Thank You" success panel. There is no `fetch`, `XMLHttpRequest`, `<form action>`, `mailto:`, or storage call anywhere in `main.js` or `enquiry-form.php` — confirmed by exhaustive grep. This is the same shared component used on every project page (hero + card variants) and the Contact page.
WordPress impact: freezing this as "the reference" would canonize a lead-capture flow that loses every enquiry while telling the visitor it succeeded.
Minimum correction: either wire real submission (even a `mailto:` fallback) before freeze, or change the visible success copy so it does not claim the enquiry was received.
Freeze blocker: **Yes**

**F-2 — Every article page emits the same (wrong) canonical URL and `og:url`**
Severity: **Blocker**
Files: `includes/header.php:21-26`
Evidence: `$canonical_url` is derived from `parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)`, which strips the query string. Articles are routed via `article.php?slug=…`, so `$current_file` resolves to `article.php` for every article. Live-verified: all 3 articles return `<link rel="canonical" href="https://smbdubai.net/article.php">` and `og:url` = the same URL, regardless of slug.
WordPress impact: this duplicate-canonical behavior must not be treated as intended; WordPress's per-post canonical must be built independently of this reference's article-routing logic.
Minimum correction: derive canonical/OG URL for `article.php` from `$_GET['slug']` (or move articles to a rewritten flat URL like every other content type, then this class of bug disappears entirely).
Freeze blocker: **Yes**

**F-3 — Communities page ships 6 public dead-end links, self-marked "To Be Added"**
Severity: **Blocker**
Files: `pages/communities.php:100-147`
Evidence: The "Explore By Lifestyle" grid (Waterfront Living, Family Communities, City Living, Distinguished Destinations, Investment Areas, Emerging Communities) uses `href="#"` on all 6 cards, with `aria-label` text literally reading `"… (Filtered View To Be Added)"` — an in-code acknowledgment that this is unfinished. Visually confirmed: these render as normal, clickable-looking cards with icon/heading/description/arrow, indistinguishable from working navigation. (Distinct from the homepage's "Browse By Category"/"Featured Communities" cards, which route to `#enquire` — a real, working in-page anchor to the CTA, not a dead end.)
WordPress impact: WordPress must decide whether these become real filtered taxonomy views or are removed/repointed — leaving them as `#` would carry the same dead links forward.
Minimum correction: either implement the filtered views, remove the cards, or point them at `#enquire` like the homepage's equivalent pattern.
Freeze blocker: **Yes**

**F-4 — `sitemap.xml` omits the entire article system**
Severity: Medium
Files: `sitemap.xml`
Evidence: 45 URLs listed (home + 5 top-level pages [`about`, `services`, `developers`, `communities`, `contact`] + 20 developers + 19 projects); `articles.php` itself and all 3 `article.php?slug=…` URLs are absent.
WordPress impact: none directly (WP generates its own sitemap), but this is a live indexing gap in the current site the audit is meant to catch.
Minimum correction: add `articles.php` and the 3 article URLs.
Freeze blocker: No

**F-5 — Articles are the only record type without a JSON/schema data source**
Severity: Medium
Files: `includes/article-data.php` vs. `data/projects.json` + `data/projects.schema.json`, `data/developers.json` + `data/developers.schema.json`
Evidence: Projects and developers are schema-validated JSON with `additionalProperties: false` and exact-count enums. Articles are a hand-written PHP function returning an array with inline HTML heredocs — no schema, no external data file.
WordPress impact: the article content type has no structured source to migrate from mechanically; the 3 existing articles will need to be hand-authored into WP (Posts/CPT), which is manageable at this volume but is a real asymmetry versus the other two content types.
Minimum correction: none required to freeze at this volume (3 records) — flagged for WordPress content-migration planning, not as a code defect.
Freeze blocker: No

**F-6 — Article URLs use query-string routing, breaking the site's flat-URL convention**
Severity: Low
Files: `pages/article.php`, `template-parts/article-card.php`, `.htaccess`
Evidence: Every other content type (developers, projects, top-level pages) has a dedicated flat URL enumerated in `.htaccess` (e.g. `/fahid-island.php`). Articles alone use `/article.php?slug=…`. This is also the root cause of F-2.
WordPress impact: WordPress's native `/post-slug/` permalinks resolve this automatically, so it's not migration-blocking, but it's a deviation from the pattern the rest of the frozen reference establishes.
Minimum correction: none required for freeze; note for WordPress permalink planning.
Freeze blocker: No

## 6. Freeze Checklist

- [x] All public routes verified (46/46)
- [x] All Project records verified (19/19)
- [x] All Developer records verified (20/20)
- [x] All Article records verified (3/3)
- [x] No broken assets (0 missing images across all datasets)
- [ ] No unfinished links — **fails** (F-3)
- [x] No invented content (no fallback/placeholder content found beyond the legitimate "Coming Soon" empty state)
- [ ] Forms behave truthfully — **fails** (F-1)
- [x] Canonical component implementations exist (header, footer, breadcrumb, 3 card types, enquiry form, 3 templates — all single-source, zero competing variants)
- [x] Section backgrounds alternate correctly (robust CSS `:nth-child(of)` mechanism, immune to optional/removed sections)
- [x] Optional states behave correctly (districts on/off, developer with/without projects — all visually confirmed)
- [x] Responsive verification completed (desktop, tablet, mobile all captured for all 12 representative page types this session)
- [x] Interactions stable (mobile nav open/close, reveal-on-scroll confirmed functional via scroll test)
- [ ] Metadata stable — **fails** (F-2: canonical/OG URL incorrect on all article pages)
- [x] Accessibility stable (reduced-motion respected, no duplicate IDs, single H1 per page, labeled form fields)
- [x] No unresolved content ownership
- [ ] No unresolved migration ambiguity — **partial** (F-5, F-6 are non-blocking notes, not ambiguity requiring a decision)

## 7. Final Decision

**NOT READY FOR WORDPRESS CONVERSION.**

All three Blocker findings (F-1, F-2, F-3) are narrow, mechanical code fixes — none require new design or content decisions. Once corrected, this codebase is otherwise in strong shape to freeze: canonical components are genuinely single-source with no competing variants, all 46 routes and all 42 data records are internally consistent with zero broken media references, and the section-alternation mechanism is robust by construction. Re-run this audit's Section 5 checks after the fixes; no other phase needs to be repeated.

---

### Limitations

- Automated `fullPage` screenshot capture (Chromium/Playwright) produced misleading blank gaps on some mobile screenshots due to `IntersectionObserver`-based reveal-on-scroll animations not always resolving before the stitched capture. This was verified to be a capture-tooling artifact, not a site defect, via a manual scroll-through test (`communities.php`: 47/47 reveal items reached `is-visible`) — the affected screenshot was retaken after a scroll warm-up and is clean.
- No JS unit/E2E test suite exists in the repo to run as an automated gate; all interaction checks in this audit were performed via live browser verification instead.
- Backend/lead-storage behavior is explicitly out of scope per the audit brief ("Backend may remain deferred") — F-1 is scoped strictly to the false *visible* success state, not to the absence of a backend.

## Freeze Corrections

Blocker IDs resolved: **F-1, F-2, F-3**.

Files modified:
- `template-parts/enquiry-form.php` — success panel title changed from "Thank You" to "Backend Integration In Progress" (shared by all project-page hero/card form instances).
- `templates/project-template.php` — `$enquiry_form_success_message` copy replaced with wording that states backend integration is in progress; no longer claims the enquiry was received.
- `pages/contact.php` — its own inline success panel (not routed through the shared template part) updated with the same title/message.
- `includes/header.php` — `$canonical_url` now appends `?slug=…` (sanitized the same way as `pages/article.php`) when `$current_file === 'article.php'`, so canonical/`og:url` are derived per-article instead of always resolving to the bare `article.php` path. No routing or URL-structure change.
- `pages/communities.php` — all 6 "Explore By Lifestyle" cards changed from `href="#"` (with `aria-label="… (Filtered View To Be Added)"`) to `href="#enquire"` with the placeholder `aria-label` removed, matching the existing `#enquire` CTA pattern already used by the homepage's category cards and this page's own project/community cards.

Verification summary:
- **Enquiry form**: validation unchanged (same `setupForm()` logic in `assets/js/main.js`); after successful validation the form hides and the informational panel shows "Backend Integration In Progress" with copy stating the enquiry system is being connected to the backend — no "Thank You" wording and no claim that an enquiry was received remains anywhere in the codebase (confirmed via grep for `lead-form__success-title`). Checked both the Contact page and a project page (hero + card forms).
- **Articles**: live-served all 3 articles via the local PHP server — each returns a unique `canonical` and `og:url` matching its own slug (`how-to-assess-a-dubai-off-plan-investment`, `freehold-ownership-in-the-uae`, `dubai-communities-for-families`). Non-article routes (e.g. homepage) confirmed unaffected.
- **Communities**: `grep -c 'href="#"'` on `pages/communities.php` returns 0; all 6 lifestyle cards now point to `#enquire`, the page's real in-page enquiry section (confirmed present at `pages/communities.php:292`).
- `php -l` run across every `.php` file in the repo: no syntax errors.
- `git diff --check`: no blocking whitespace errors (only pre-existing benign LF→CRLF notices).
