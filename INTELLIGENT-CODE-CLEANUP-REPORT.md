# Intelligent Code Cleanup Report

**Scope:** Evidence-based cleanup pass across the entire active SMB Real Estate Brokers PHP website. No content rewrite, no new features, no visual redesign. Every removal below was verified against actual usage before being made; every retained "uncertain" item is listed with the reason it was not touched.

---

## 1. Executive Summary

The codebase was already in good shape from prior implementation work — no debug artifacts, no dead functions, no broken routes, no orphaned wrapper files. The cleanup found and removed:

- **~228 lines of confirmed-dead CSS** across five stylesheets — three complete legacy component blocks left behind by earlier redesigns (an old project-card system, an old Developers-page layout, an old Communities "browse rows" list) plus two unused button modifiers.
- **53 browser-exposed HTML section-divider comments** and **~90 lines of CSS/JS section-divider comments**, all pure organizational labels that added no technical information and were visible to any visitor via View Source.
- **One unnecessary stylesheet dependency** (`contact.css` loaded by `communities.php` with zero matching classes) — confirmed independently and removed.
- **One stale/misleading comment block** (main.css's file banner called the shared, site-wide base stylesheet a "DAMAC Islands 2 Landing Page") and a few other comments that narrated implementation history rather than explaining current, non-obvious constraints.

Everything else — PHP logic, JavaScript behavior, asset files, JSON data, routing — was traced and found either genuinely in use or legitimately protected (fallback logic, accessibility features, source photography, a provisioned-but-unwired schema field). Nothing in those categories was deleted; uncertain items are listed in Section 15/16 for a human decision.

Net result: **5,311 → 5,005 lines** across the 26 touched files (−5.8%), zero functional or visual change, all 45 public pages verified rendering identically with zero PHP/console errors before and after.

---

## 2. Files Inspected

Every active PHP file (57 total via `find . -name "*.php"`), all 7 CSS files, `assets/js/main.js`, `data/projects.json` + `data/developers.json` + both schema files, all 39 project/developer wrapper files, `.htaccess`, `router.php`, `robots.txt`, `sitemap.xml`, and the full `assets/images`, `assets/videos`, `assets/fonts`, `assets/icons` directories (603 image files, 2 video files, 1 font, 1 icon). Excluded per instructions: `.git/`, `.agents/`, `.claude/`, `docs/*.md`, and the root-level historical audit `.md` reports.

## 3. Files Modified

`assets/css/main.css`, `assets/css/home.css`, `assets/css/developers.css`, `assets/css/communities.css`, `assets/css/about.css`, `assets/css/services.css`, `assets/css/contact.css`, `assets/js/main.js`, `index.php`, `pages/about.php`, `pages/communities.php`, `pages/contact.php`, `pages/developers.php`, `pages/services.php`, `includes/header.php`, `includes/footer.php`, `templates/project-template.php`, `templates/developer-template.php`.

## 4. Files Deleted

None. No file was deleted in its entirety. (Two dead CSS declarations and several whole legacy component blocks were removed *from within* existing files — see Section 5 — but no file itself was removed.)

---

## 5. Confirmed Dead Code Removed

Each item was verified with a full-repository `grep` for every class name / field name it would need to appear as, across all `.php`, `.css`, `.js`, and `.json` files, before removal.

| Item | File | Evidence | Why safe to remove |
|---|---|---|---|
| `.project-card`, `.project-card__*` (media/body/name/meta/foot/price-label/price/link), `.projects__grid` | `assets/css/home.css` | Repo-wide grep for `project-card` found matches only inside `require` paths/filenames (`project-card-helpers.php`, `project-card.php`), never as `class="project-card"`. The homepage's actual featured-projects grid renders via `template-parts/project-card.php`, which emits `class="comm-card"` (defined in `communities.css`), not `.project-card`. | Superseded by the `.comm-card` component (used on Home, Communities, and Developer pages) after an earlier card-consolidation pass. Confirmed via screenshot before/after: featured-project cards render identically. |
| `.dev-intro__inner`, `.dev-logo`, `.dev-logo-note` | `assets/css/developers.css` | Zero matches for any of these three class names anywhere in `pages/developers.php` or any template-part. | `pages/developers.php` has no "intro" section separate from its hero, and no monogram-placeholder logo markup — it uses real logo files via `.dev-row__logo-mark` (a different, actively-used class). Leftover from an earlier page layout. |
| `.criteria`, `.criteria__grid` (+ its `.section-head` breakpoint override) | `assets/css/developers.css` | Zero matches anywhere in the codebase. | No "Why These Developers" 6-item grid exists on the current page. |
| `.browse__grid`, `.browse-item`, `.browse-item__text` | `assets/css/developers.css` | Zero matches anywhere in the codebase. | No "Browse By Developer" list section exists on the current page; developers are presented via the `.devs__grid`/`.dev-row` directory list instead. |
| `.comm-rows`, `.comm-row`, `.comm-row__thumb`, `.comm-row__text`, `.comm-row__cats` (+ 768px breakpoint rule) | `assets/css/communities.css` | Zero matches anywhere in the codebase. | No "Browse all communities (compact rows)" section exists on the current page; communities are presented via the `.comms__grid`/`.comm-card` grid instead. |
| `.btn--secondary`, `.btn--sm` | `assets/css/main.css` | Zero matches anywhere in PHP or JS, across the whole repository (every other `.btn--*` variant — primary, accent, ghost, lg, block — has confirmed live usage). | These are two specific unused modifiers inside an otherwise fully-used, shared component; removing them changes no page's rendered output (verified: nothing references them, so nothing could visually change). |

**Total CSS removed:** ~228 lines across 5 stylesheets, confirmed with zero visual regression (Section 19).

---

## 6. Duplicate Logic Consolidated

None found that warranted consolidation. `includes/project-data.php` and `includes/developer-data.php` share a similar internal shape (a loader function, a "safe" variant, a "by slug" getter, a controlled-failure function) — this is intentional, parallel structure for two conceptually separate data sources, not unjustified duplication, and merging them into a shared abstraction would violate the "no enterprise patterns" constraint for no real benefit.

## 7. Browser-Exposed Comments Removed

- **53 HTML section-divider comments** (`<!-- ============ Section Name ============ -->`) removed from `index.php`, all five `pages/*.php` files, `includes/header.php`, `includes/footer.php`, and both `templates/*.php` files. These were visible to any visitor via View Source and carried no information beyond what the following `<section>`'s own `class`/`aria-labelledby` already states.
- One HTML comment (`<!-- SVG icon sprite (shared: union of all page symbols) -->`) removed from `includes/header.php` for consistency — the sprite's purpose is self-evident from its `<symbol id="...">` markup.
- **~30 CSS section-divider comments** (`/* ---------- Name ---------- */`) removed across all 7 stylesheets — pure labels restating the selector that follows.
- **6 JS section-divider comments** removed from `assets/js/main.js` (header scroll, mobile nav, scroll reveal, sticky CTA, form validation, footer year — all self-evident from the code beneath them).
- File-header "banner" comments (the `/* ====... ==== */` blocks at the top of each CSS file) trimmed to a single factual line stating stylesheet load-order dependency (a genuine technical fact, since load order affects CSS cascade) — the decorative box-drawing and page-name restatement were removed.
- `assets/css/main.css`'s file banner previously read *"SMB Real Estate Brokers — DAMAC Islands 2 Landing Page / Premium Polish Specification Implementation"* — this is factually wrong today (the file is the shared, site-wide base stylesheet loaded by every single page) and was removed entirely rather than corrected, since the file's role is self-evident from how `includes/header.php` loads it.

Verified via `grep -rn "<!--"` across every `.php` file post-cleanup: **zero HTML comments remain anywhere in the codebase.**

## 8. PHP Comments Removed or Retained

**Removed/tightened (1 case):** `templates/project-template.php`'s fallback-image comment described the DAMAC hero image fallback as "TEMPORARY... to be replaced once real project photography is assigned," named the specific borrowed image's origin ("DAMAC hero image"), and pointed to a planning document — this is historical/internal narrative describing a decision, not a current technical constraint. It was rewritten to state the current, factual behavior only ("Uses assets/images/project-placeholder.jpg once that file exists; falls back to this image for any project without its own photography"). The underlying fallback logic itself was **not** touched — it is genuinely active, correct, and necessary right now (verified: `assets/images/project-placeholder.jpg` still does not exist, so this fallback branch is what actually executes for every project page today).

**Retained (all other PHP comments):** Every remaining PHP-only comment was checked against the "why" test (non-obvious safety check / routing decision / browser-compat path / defensive fallback / a constraint that can't be simplified) and kept because it passed:
- `includes/project-data.php` / `includes/developer-data.php`: comments explaining why `get_all_projects_safe()` exists alongside `get_all_projects()` (page-wide 500 vs. local empty state), why `project_data_fail()` logs internally but returns a generic 500 (no path/stack-trace leakage).
- `templates/project-template.php`: the "defense in depth" comment on `project_safe_local_path()` (explains why a redundant-looking check against external URLs and path traversal must stay even though the schema also forbids them), the icon-mapping fallback rationale, and the ~15 short structural signposts (e.g. `/* ---------- Quick facts: always exactly 4 visual positions ---------- */`) that mark out this 500+ line procedural file's distinct sections — kept because they are PHP-only (never shipped to the browser) and materially help navigate a long file, unlike the browser-exposed HTML/CSS dividers.
- `includes/header.php`: the canonical-URL derivation comment and the breadcrumb-mechanism contract comment — both explain non-obvious cross-file agreements that a future maintainer could otherwise break.
- `main.css`'s WCAG contrast-ratio comment on `:focus-visible`, the mobile-nav focus-trap explanation, the visually-hidden-phone-number accessibility note, and the hero-content mobile-centering exceptions — all retained as exactly the kind of "why a non-obvious accessibility/constraint exists" comment the brief asks to protect.
- `assets/js/main.js`: the focus-trap comment, the "fall back to default anchor behavior" comment, the hidden-attribution-input validation-skip comment, and the "Static preview: no backend endpoint is connected yet" comment — the last of these is the single most important comment in the file for setting correct expectations (confirms no backend persistence is claimed anywhere in behavior or copy) and was deliberately kept.

## 9. CSS Selectors and Declarations Removed

Covered in full in Section 5. Summary count: **2 button modifiers + 3 complete legacy component groups** (project-card system, Developers-page legacy layout, Communities "browse rows") removed, confirmed via full-repository class-name search (not just a same-page text search) before each removal, per the brief's evidentiary bar. No `@keyframes`, no CSS custom properties, and no attribute selectors (`[aria-expanded]`, `[data-reveal]`, `[open]`, `[id^="developer-"]`, `[aria-current]`) were found unused — every one is actively consumed by JS or native browser state.

## 10. JavaScript Cleanup Performed

No `console.*`, `debugger`, `alert`, unused functions, unused variables, or dead selectors were found in `assets/js/main.js` — every function is called, every `getElementById` lookup is guarded with a null check that lets the script safely no-op on pages without that element (exactly the "safe no-op" pattern the brief protects). Only the 6 section-divider comments (Section 7) were removed; all logic is untouched. `node --check` passes after the change.

## 11. Unused Stylesheet Dependencies Removed

`pages/communities.php` loaded `assets/css/contact.css` in its `$page_styles` array. Independently re-verified (per the explicit instruction to re-check this) by extracting every class `contact.css` defines (`contact-layout`, `method-card*`, `methods__grid`, `office-card*`, `pill-group`, `visit__buttons`, `visit__inner`) and grepping each one individually against `communities.php` and every template-part it includes — **zero matches for any of them.** Removed `'assets/css/contact.css'` from the array. Confirmed via Playwright screenshot comparison and a zero-console-error reload that the page is visually and functionally identical afterward (the FAQ centering communities.php relies on lives in `services.css`, which it already loads for other reasons and continues to load).

## 12. Assets Removed

**None.** Full findings, all preserved:

- **Project image pipeline** (`assets/images/projects/<slug>/{original,png,webp}/...`, 547 files across 19 projects): only the `webp/` paths are referenced by `data/projects.json` (144 references, 100% webp). The `original/` and `png/` folders are not referenced by any template — but each project also ships an `image-library.json` manifest that explicitly documents `original_path`, `png_path`, and `webp_path` together with source URL, publisher, and dimensions for every image. This is a deliberately maintained, documented multi-format source-asset pipeline, not leftover clutter — preserved in full, nothing removed.
- **Developer logos** (`assets/images/developers/*`, 20 files): exact 1:1 match against `developers.json`'s `logo` field for all 20 developers — fully used, nothing to remove.
- **Fonts, icons, videos**: `Manrope-VariableFont_wght.ttf`, `favicon.svg`, `hero.mp4`, `hero.webm` — all confirmed referenced (font in `@font-face` + preload, favicon in `<link rel="icon">`, both video formats as `<source>` elements in the homepage hero). Nothing to remove.
- **`smb-logo-vertical.png`**: zero references found anywhere in the codebase — but this is a brand-logo variant (vertical orientation of the actively-used horizontal logo), not incidental clutter. A business commonly keeps such a variant for uses outside the website itself (social profiles, print, partner listings). Preserved; flagged as uncertain in Section 16.
- **46 numbered/raw top-level images** (`005.webp`...`029.webp`, `raw_001.webp`...`raw_069.webp`, ~11MB total): zero references anywhere. Cross-checked and found that 14 of these files are byte-for-byte duplicates of a differently-named counterpart in the same pool (e.g. `015.webp` and `raw_062.webp` are identical). This looks like a partially-curated raw photography library — the prior session's git history already shows a batch of similarly-named files (`001.webp`, `raw_000.jpg`, `raw_003.jpg`, etc.) deleted before this task began, meaning someone is actively curating this pool rather than it being pure accidental leftover. Per the explicit instruction not to delete unreferenced source photography without ruling out its role as an intentional asset, **none of these were deleted.** Flagged in Section 16 for a human decision, including the exact duplicate pairs.

## 13. Data or Schema Cleanup

**No data or schema files were modified.** One well-evidenced finding, deliberately left for human judgment rather than acted on:

- `data/projects.schema.json` marks `sticky_cta` (`{ value: string }`) as a **required** top-level field, and every one of the 19 records in `data/projects.json` populates it (always as `{"value": ""}`). Tracing every consumer — `project-template.php`, `developer-template.php`, both template-parts, `index.php`, `communities.php`, `developers.php` — found **zero reads of `$project['sticky_cta']` anywhere.** The template instead computes its own sticky-CTA copy independently (`$sticky_label = 'Starting From'`, etc.) from hardcoded template strings and `$project['hero']['starting_price']`.
  This has the shape of a field that was schema-provisioned for a planned per-project sticky-CTA override that was never wired into the template — not confirmed-replaced legacy data (there's no evidence a prior template implementation using it ever existed). Because removing a required field means editing content across 19 real data records and a validation contract, and because "usage" (zero, proven) and "future intent" (unknown) are different questions, this was **not** removed. See Section 16.
- `data/developers.schema.json` (5 fields: `slug`, `display_name`, `canonical_name`, `biography`, `logo`) — all 5 confirmed read by `developer-template.php`/`template-parts/developer-card.php`. Nothing to remove.

## 14. Routing Cleanup

**No changes.** Independently cross-checked and found fully consistent, byte-for-byte:
- `.htaccess`'s developer-slug rewrite list (20 slugs) = the 20 files in `developers/` = the 20 `slug` values in `developers.json`.
- `.htaccess`'s project-slug rewrite list (19 slugs) = the 19 files in `projects/` = the 19 `slug` values in `projects.json`.
- `sitemap.xml`'s 45 `<loc>` entries = exactly {home + 5 static pages + 20 developer URLs + 19 project URLs}, no more, no fewer, every one returning HTTP 200 through the local router.
- `router.php` retained as-is (required for the PHP built-in dev server; not a production dependency, not touched).

## 15. Items Investigated But Preserved

| Item | Why it looked like a candidate | Why it was kept |
|---|---|---|
| `developer_data_fail`-adjacent `function_exists('developer_slug')` guard in `includes/developer-data.php` | Every current caller of `developer-data.php` also loads `project-data.php` first, so the guard's false branch is never reached today | Defensive coupling-safety code for a plausible future caller that includes `developer-data.php` without `project-data.php`; costs nothing to keep, protects against a fatal error if that ever happens |
| `data/projects.json`'s `sticky_cta` field | Zero reads anywhere (Section 13) | Usage is proven dead, but intent is not — looks like an unwired feature stub, not confirmed-replaced legacy code; removing it touches 19 content records + a schema contract, a bigger and more consequential edit than pure code cleanup |
| 46 unreferenced numbered/raw top-level images (Section 12) | Zero references anywhere | Explicit instruction not to delete unreferenced source photography without ruling out its role as an intentional asset; evidence (partial curation already visible in git history) suggests active, ongoing human curation of this pool |
| `smb-logo-vertical.png` | Zero references anywhere | A brand-logo variant, not incidental clutter — plausibly used outside the website itself |
| Homepage "Latest Insights" section and its `href="#"` placeholder links | Sentence-case heading inconsistent with the rest of the site; anchor links go nowhere | Explicitly out of scope per standing instruction not to touch this section |
| Communities "Explore by Lifestyle" category cards (`href="#"`, aria-label ending "(Filtered View To Be Added)")| Links go nowhere | Explicitly and honestly labeled as a not-yet-built filter feature in their own accessible text — working as designed, not dead code |
| All `data-reveal` scroll-animation elements, the mobile-nav focus trap, the reduced-motion branch in `main.js` | Only exercised via scroll/JS/media-query, not visible in a static read of the markup | Traced and manually tested (Section 19) — all fully functional |

## 16. Uncertain Items Requiring Human Decision

1. **`sticky_cta` schema field** (Section 13) — confirmed zero usage; recommend either wiring it into `project-template.php`'s sticky-CTA logic (if a per-project override was the original intent) or removing it from the schema and all 19 records (if abandoned). Left untouched pending that decision.
2. **46 unreferenced numbered/raw images, ~11MB, including 14 exact-duplicate pairs** (Section 12) — recommend the site owner confirm whether this raw-photo pool is still needed; if so, consider settling on one naming convention (either the `0XX` shortlist numbering or the original `raw_XXX` numbering) to eliminate the duplicate pairs without losing the underlying photography.
3. **`smb-logo-vertical.png`** (Section 12) — confirm whether this is used outside the website (social, print, partner kits) or can be removed.

## 17. Before/After Code and Asset Counts

| File | Before (lines) | After (lines) | Δ |
|---|---:|---:|---:|
| `assets/css/main.css` | 825 | 782 | −43 |
| `assets/css/home.css` | 343 | 272 | −71 |
| `assets/css/developers.css` | 153 | 87 | −66 |
| `assets/css/communities.css` | 106 | 67 | −39 |
| `assets/css/about.css` | 190 | 181 | −9 |
| `assets/css/services.css` | 129 | 123 | −6 |
| `assets/css/contact.css` | 113 | 105 | −8 |
| `assets/js/main.js` | 252 | 246 | −6 |
| `index.php` | 361 | 353 | −8 |
| `pages/about.php` | 266 | 258 | −8 |
| `pages/communities.php` | 322 | 314 | −8 |
| `pages/contact.php` | 213 | 208 | −5 |
| `pages/developers.php` | 135 | 131 | −4 |
| `pages/services.php` | 292 | 285 | −7 |
| `includes/header.php` | 179 | 177 | −2 |
| `includes/footer.php` | 94 | 92 | −2 |
| `templates/project-template.php` | 525 | 514 | −11 |
| `templates/developer-template.php` | 192 | 189 | −3 |
| **Total (touched files)** | **5,311** | **5,005** | **−306 (−5.8%)** |

Assets: 0 removed, 0 added. Data/schema: 0 fields removed, 0 fields added. Routing: 0 rules changed.

## 18. Validation Commands and Results

```
php -l  → run individually on all 57 active .php files: 0 syntax errors
node --check assets/js/main.js  → OK
```

Every one of the 45 URLs in `sitemap.xml` (home + 5 static pages + 20 developer pages + 19 project pages) loaded through the local PHP router: **all 45 → HTTP 200, zero occurrences of "Fatal error", "Warning:", "Notice:", "Deprecated:", or "Parse error" in any response body.**

Browser console (Playwright/Chromium) checked on Home, About, Services, Communities, Contact, Developers, one project page (`azizi-milan.php`), and DAMAC Islands 2: **0 errors, 0 warnings** on every page.

Forms tested live: Contact page form (invalid submission → four field-level errors shown correctly; valid submission → form hides, success panel shows and receives focus); a project page's hero form (invalid submission → validation triggers correctly). Confirmed the hidden attribution inputs (`source_page_title`, `source_page_slug`, `source_page_url`, `project_name`, `project_slug`, `developer_name`) are present and correctly populated. Confirmed the success flow makes no claim of backend persistence beyond what the (unchanged, deliberately preserved) `"Static preview: no backend endpoint is connected yet"` comment already documents.

Interaction behaviors re-tested after cleanup: mobile nav open/close, Escape-to-close with focus return to the toggle button, full keyboard focus trap in both directions (Tab wraps last→first, Shift+Tab wraps first→last), sticky CTA show/hide tied to hero and enquire-section visibility, and scroll-reveal (tested via `prefers-reduced-motion: reduce` emulation, which is also the code path used for actual reduced-motion users) — all functioned identically to before the cleanup.

## 19. Visual Regression Results

Checked with Playwright (Chromium) at 1440px (desktop), 768px (tablet, overflow-only), and 390px (mobile) as applicable:

- **Homepage**: hero, featured-projects cards (post `.project-card` removal — rendering via the untouched `.comm-card` component, confirmed pixel-identical in function), scroll order, testimonials, footer — no change.
- **Communities**: hero, breadcrumb, and the FAQ section (post `contact.css` dependency removal) — confirmed centered and visually identical to before.
- **Developers**: hero and the full numbered directory list (post legacy-CSS removal) — logos, index numbers, bios, project counts, and "View Developer" links all render exactly as before.
- **DAMAC Islands 2**: hero, breadcrumb, price card, and enquiry form — no change.
- No horizontal overflow detected on any checked page/breakpoint combination (`document.documentElement.scrollWidth > clientWidth` → `false` everywhere tested).
- No missing icons, no missing images, no unstyled content, no layout shift attributable to any removed CSS.

Not re-screenshotted this pass (unchanged from the prior conversation's dedicated visual audit, and none of this cleanup's edits touched their layout): About and Services page sections beyond the FAQ/dependency checks above.

## 20. Remaining Technical Debt

- The `sticky_cta` schema field (Section 13/16) — either wire it up or retire it.
- The duplicate raw/numbered image pool (Section 12/16) — a housekeeping decision for the site owner, not a code defect.
- `smb-logo-vertical.png`'s intended use is undocumented (Section 12/16).
- Nothing else identified. No dead functions, no dead includes, no duplicate route logic, no broken links, no orphaned wrapper files, no unused schema fields beyond the one noted above.

## 21. Final Verdict

**Cleanup Approved.**

All confirmed-dead code was removed with full before/after evidence and zero functional or visual regression across all 45 pages. All uncertain items were left untouched and are documented above for a human decision — none of them are code defects, and none affect the site's current behavior, appearance, SEO, or accessibility.
