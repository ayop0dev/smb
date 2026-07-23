# Current Project Structure Audit

**Project:** D:\Projects\SMB-realestate
**Audit date:** 2026-07-23
**Nature of this document:** Read-only inspection. No project file was modified, moved, renamed, created, or deleted as part of this audit, except for this report file itself.

---

## Audit Scope

This audit inspected every file relevant to the application architecture under `D:\Projects\SMB-realestate`: all PHP source files (root, `pages/`, `developers/`, `projects/`, `templates/`, `template-parts/`, `includes/`), all CSS (`assets/css/*.css`), the single JavaScript file (`assets/js/main.js`), all data files (`data/*.json` and their `*.schema.json` companions), all documentation (`docs/*.md`), the media tree (`assets/images/`, `assets/videos/`, `assets/fonts/`, `assets/icons/`), the root `.htaccess`, and `README.md`.

Excluded from architectural analysis per instruction: `.git` internals, `.claude/` (editor/tooling config), `.agents/` (empty), `tools/` (empty — confirmed empty, not a build pipeline).

File counts inspected: **53 PHP files, 7 CSS files, 1 JavaScript file, 22 application JSON files (4 in `data/`, 18 per-project `image-library.json`), 20 Markdown files, 649 image files, 3 video files, 1 font file.**

---

## Executive Summary

This is a flat-file PHP site (no framework, no database, no build step) that was reorganized on 2026-07-23 into a WordPress-conversion-friendly folder layout (documented in `docs/project-architecture-report.md`, which this audit independently verifies rather than assumes). The site's 45 public pages resolve through a root `.htaccess` rewrite layer to files now living in `pages/`, `developers/`, `projects/`, `templates/`, and `template-parts/`, with shared chrome and data access centralized in `includes/`.

The architecture is unusually well-prepared for a CPT-based WordPress conversion for a non-WordPress project:

- **Two shared full-page templates** (`templates/developer-template.php`, `templates/project-template.php`) already render every developer and project record from a single template driven by one slug variable — structurally identical to how WordPress `single-*.php` templates consume `get_queried_object()`.
- **All developer and project content lives in two JSON files** (`data/developers.json`, `data/projects.json`) with matching JSON Schemas that enforce a frozen, fixed-shape dataset (20 developers, 18 projects).
- **One shared card partial** (`template-parts/project-card.php`) and **one shared helpers file** (`includes/project-card-helpers.php`) already exist, used identically by the homepage, the Communities page, and every developer page.

The most significant remaining architectural issue is `docs/company-brief.md` / `docs/website-content.md`: these read as the original source-of-truth content documents, but nothing in the PHP reads them — every page's copy is hand-transcribed and hardcoded directly into its `.php` file. There is also one confirmed structural outlier, `projects/damac-islands2.php`, which duplicates the entire `project-template.php` markup by hand rather than using the template, and is not present in `data/projects.json`.

---

## Current Directory Tree

```
D:\Projects\SMB-realestate\
├── .htaccess                          Rewrite rules mapping flat public URLs to pages//developers//projects/
├── index.php                          Homepage (site entry point; stays at root)
├── README.md                          Stale — describes an earlier single-page project phase (see Weaknesses)
│
├── pages/                             5 standalone top-level pages
│   ├── about.php
│   ├── communities.php
│   ├── contact.php
│   ├── developers.php
│   └── services.php
│
├── developers/                        20 developer-archive wrapper files (3 lines each — set slug, require template)
│   ├── aldar-properties.php
│   ├── azizi-developments.php
│   ├── binghatti-developers.php
│   ├── damac-properties.php
│   ├── danube-properties.php
│   ├── deyaar-development.php
│   ├── dubai-properties.php
│   ├── ellington-properties.php
│   ├── emaar-properties.php
│   ├── iman-developers.php
│   ├── mag-group-holding.php
│   ├── meraas.php
│   ├── nakheel.php
│   ├── omniyat.php
│   ├── pantheon-development.php
│   ├── reportage-properties.php
│   ├── samana-developers.php
│   ├── select-group.php
│   ├── sobha-realty.php
│   └── tiger-properties.php
│
├── projects/                          19 project pages: 18 thin wrappers + 1 standalone
│   ├── azizi-milan.php … verdana-empire.php   (18 template-driven wrappers, 3 lines each)
│   └── damac-islands2.php             Standalone — full hand-written markup, NOT template-driven, NOT in data/projects.json
│
├── templates/                         Shared full-page templates ("single-*" equivalents)
│   ├── developer-template.php         Renders any developer from data/developers.json
│   └── project-template.php           Renders any project from data/projects.json
│
├── template-parts/                    Reusable page fragments
│   └── project-card.php               Shared project-card markup (used by 3 call sites)
│
├── includes/                          Shared PHP: global chrome + data loaders + helpers
│   ├── header.php                     <head>, SVG icon sprite, site header/nav — required by every page
│   ├── footer.php                     Footer, RealEstateAgent JSON-LD, sticky CTA markup, main.js include
│   ├── developer-data.php             Sole responsibility: load/validate/query data/developers.json
│   ├── project-data.php               Sole responsibility: load/validate/query data/projects.json
│   └── project-card-helpers.php       3 functions used only by template-parts/project-card.php
│
├── data/                              Content data + schemas (the site's only "database")
│   ├── developers.json                20 developer records
│   ├── developers.schema.json         JSON Schema — enforces exactly 20 records, fixed field set
│   ├── projects.json                  18 project records
│   └── projects.schema.json           JSON Schema — enforces exactly 18 records, fixed field set
│
├── assets/
│   ├── css/
│   │   ├── main.css                   Global: design tokens, reset, header/nav, buttons, forms, hero, footer, sticky CTA, scroll-reveal (791 lines)
│   │   ├── home.css                   index.php only — hero variant, project/category/community cards, steps, testimonials, insights (356 lines)
│   │   ├── about.css                  about.php only — inner-page hero, breadcrumb, split layout, team, mission/vision (201 lines)
│   │   ├── services.css               services.php only — off-plan feature block, service cards, FAQ accordion (147 lines)
│   │   ├── contact.css                contact.php only — contact methods, form+office layout, map placeholder (133 lines)
│   │   ├── communities.css            communities.php only — .comm-card, compact community rows (104 lines)
│   │   └── developers.css             developers.php only — .dev-card, developer logo treatment, browse rows (134 lines)
│   ├── js/
│   │   └── main.js                    Single global script: header scroll state, mobile nav, scroll reveals, sticky CTA, lead-form validation (255 lines)
│   ├── images/
│   │   ├── (82 site-wide/homepage images at root: hero-*.jpg, gallery-*.jpg, raw_*.webp/jpg, team photos, logos)
│   │   ├── developers/                20 developer logo files (svg/png), one per data/developers.json record
│   │   └── projects/{18 slugs}/       Per project: original/ (source), png/, webp/, image-library.json
│   ├── videos/                        hero.mp4, hero.webm, 202607192044.mp4 (homepage hero background video)
│   ├── fonts/                         Manrope-VariableFont_wght.ttf (single variable font, all weights)
│   └── icons/                         favicon.svg
│
├── docs/                              Planning specs + prior audit reports (not read by any PHP at runtime — verified)
│   ├── company-brief.md               Source-of-truth company facts (legal name, address, contact) — hand-transcribed into PHP, not live-linked
│   ├── website-content.md             Source-of-truth page copy, labeled "editing this file should only affect website copy" — same caveat
│   ├── design-brief.md, implementation-rules.md, landingpage-tree.md, premium-polish-specification.md
│   ├── about-page-specification.md, communities-page-specification.md, contact-page-specification.md,
│   │   developers-page-specification.md, services-page-specification-v2.md, homepage.md
│   ├── developer-archive-template-specification.md   Build spec for the developer-template system (contains now-superseded routing rules — see Weaknesses)
│   ├── developers-projects.md
│   ├── website-content-v4.md
│   ├── project-pages-implementation.md
│   ├── image-library-report.md        Full image-coverage audit for all 18 approved projects
│   ├── project-architecture-report.md Prior reorg report (2026-07-23) — this audit's findings are independently verified against it, not assumed from it
│   └── projects/
│       └── damac-islands-2.md         Verified project brief for DAMAC Islands 2 (source for damac-islands2.php content)
│
├── tools/                             Empty — no build scripts, no linter config, no asset pipeline
└── .agents/                           Empty
```

---

## Current Pages

Because 38 of the site's 45 pages are generated by exactly two templates from JSON data, this table gives one full row per unique page *type*, then lists every filename covered by that row.

| Page type | Main file(s) | Purpose | Shared files included | CSS | JS | Media | Static/Dynamic | Notes |
|---|---|---|---|---|---|---|---|---|
| Homepage | `index.php` | Corporate landing page: hero, featured projects, why-SMB, categories, featured communities, process steps, testimonials, insights, final CTA | `includes/project-data.php`, `includes/developer-data.php`, `includes/header.php`, `includes/footer.php`, `includes/project-card-helpers.php`, `template-parts/project-card.php` | `main.css` + `home.css` | `main.js` | `assets/videos/202607192044.mp4` (hero bg video), `assets/images/hero-lagoon-aerial.jpg` (poster), 6 project card images (from data) | Dynamic (featured projects pulled live from `data/projects.json`, sliced to 6) | Own `WebSite` JSON-LD |
| About | `pages/about.php` | Company story, team, mission/vision, values, "why choose SMB" | `includes/header.php`, `includes/footer.php` | `main.css` + `home.css` + `about.css` | `main.js` | Team photos (`HAITHAM.jpeg`, `Sadam.jpeg`), root gallery images | Static (all copy/images hardcoded in the file) | — |
| Services | `pages/services.php` | Services list, off-plan advisory feature, FAQ | `includes/header.php`, `includes/footer.php` | `main.css` + `home.css` + `about.css` + `services.css` | `main.js` | Root gallery images | Static | `FAQPage` JSON-LD (5 Q&A) |
| Contact | `pages/contact.php` | Contact methods, lead form, office info, map placeholder | `includes/header.php`, `includes/footer.php` | `main.css` + `home.css` + `about.css` + `contact.css` | `main.js` | none page-specific | Mostly static, one interactive form | Only page with an enquiry-type radio-pill selector; map is a static placeholder frame, no embedded map |
| Developers listing | `pages/developers.php` | Browse all 20 developers: featured cards, "why these developers" criteria grid, browse-all rows | `includes/project-data.php`, `includes/developer-data.php`, `includes/header.php`, `includes/footer.php` | `main.css` + `home.css` + `about.css` + `services.css` + `developers.css` | `main.js` | 20 developer logo files | Dynamic — iterates `data/developers.json`, computes per-developer project counts via `includes/project-data.php` | Contains its own local `developer_canonical()` helper function (business logic living in a page file, not `includes/`) |
| Communities listing | `pages/communities.php` | Browse all 18 projects as "communities": featured cards, lifestyle filters, compact rows, FAQ | `includes/project-data.php`, `includes/developer-data.php`, `includes/header.php`, `includes/footer.php`, `includes/project-card-helpers.php`, `template-parts/project-card.php` | `main.css` + `home.css` + `about.css` + `services.css` + `contact.css` + `communities.css` | `main.js` | 18 project card images (from data) | Dynamic — iterates `data/projects.json` | `FAQPage` JSON-LD (6 Q&A) |
| Developer archive (×20) | `developers/{slug}.php` → `templates/developer-template.php` | One page per developer: hero, overview, "projects by {developer}" grid | Wrapper requires `templates/developer-template.php`, which requires `includes/project-data.php`, `includes/developer-data.php`, `includes/header.php`, `includes/footer.php`, `includes/project-card-helpers.php`, `template-parts/project-card.php` | `main.css` + `home.css` + `about.css` + `services.css` + `contact.css` + `communities.css` | `main.js` | Developer's matched project images, or a centralized fallback image if none found | Fully dynamic — one shared template resolves `$developer_slug` against `data/developers.json` | Each wrapper file is exactly 3 lines: `<?php $developer_slug = '…'; require __DIR__ . '/../templates/developer-template.php';`. Unmatched/missing slug → controlled HTTP 404 branch (own `<head>`/`<main>`, no archive content rendered) |
| Project page (×18, template-driven) | `projects/{slug}.php` → `templates/project-template.php` | One page per project: hero, island/district strip, quick facts, overview, gallery, amenities, location, lead-capture enquiry section | Wrapper requires `templates/project-template.php`, which requires `includes/project-data.php`, `includes/header.php`, `includes/footer.php` | `main.css` + `home.css` + `about.css` + `services.css` + `contact.css` + `communities.css` | `main.js` (incl. lead-form validation for `#hero-form` and `#main-form`) | Project's own `original/png/webp` image set under `assets/images/projects/{slug}/` | Fully dynamic — one shared template resolves `$project_slug` against `data/projects.json` | Each wrapper file is 3 lines, same pattern as developer wrappers. Two lead-capture forms per page (hero + final CTA). Unmatched slug → controlled 404 |
| DAMAC Islands 2 (standalone) | `projects/damac-islands2.php` | Same section structure as the project template (hero, districts, facts, overview, gallery, amenities, location, enquire), but hand-written in full | `includes/header.php`, `includes/footer.php` directly (bypasses `templates/project-template.php` entirely) | Same CSS stack as other project pages | `main.js` | Its own image set (`gallery-*.jpg`, `hero-*.jpg` at `assets/images/` root, not under `assets/images/projects/`) | Static — all content hardcoded, not sourced from `data/projects.json` | Confirmed **not** present in `data/projects.json` (18/18 records checked, no `damac-islands2` slug). Its own `Residence`/`PostalAddress`/`Offer` JSON-LD block, structurally parallel to but independent of `project-template.php`'s. This is the file `project-template.php`'s own docblock says was used "as the structural, visual, and accessibility reference" when the template was built — confirmed by near-identical section markup |

---

## Shared Components

| Component | Defined in | Used by | Inclusion mechanism | Genuinely reusable? | Inconsistent versions? |
|---|---|---|---|---|---|
| **Global header** (`<head>`, SVG icon sprite, site nav, mobile burger) | `includes/header.php` | Every one of the 45 pages | `require __DIR__ . '/(../)includes/header.php'`, with page-specific variables (`$page_title`, `$page_styles`, `$current_page`, etc.) set immediately before the require | Yes — fully parameterized, zero page-specific markup inside it | No — one version, one call site pattern |
| **Global footer** (footer grid, `RealEstateAgent` JSON-LD, sticky CTA markup, `main.js` include) | `includes/footer.php` | Every one of the 45 pages | `require __DIR__ . '/(../)includes/footer.php'`; sticky-CTA text overridable via `$sticky_href`/`$sticky_label`/`$sticky_value`/`$sticky_action` | Yes | No |
| **Mobile navigation** (off-canvas panel, focus trap, Escape handling) | Markup in `includes/header.php`; behavior in `assets/js/main.js` (`navToggle`/`nav`/`navClose`/`navOverlay` handlers) | Every page (markup is part of the header include) | Same as header | Yes | No |
| **Project card** | `template-parts/project-card.php` (markup) + `includes/project-card-helpers.php` (3 functions: `comm_project_card_image()`, `comm_parse_property_types()`, `comm_property_type_icon()`) | `index.php` (Featured Projects), `pages/communities.php` (Featured Communities), `templates/developer-template.php` (Projects by {developer}) | Each caller sets `$project_card_fallback_image` and a `$project_card_dev_href_fallback` closure, then `require`s the partial once per loop iteration | Yes — this is the one component that was previously triplicated (per `docs/project-architecture-report.md`) and has since been consolidated; confirmed only one definition of each helper function exists repo-wide | No — consolidated to one version as of the 2026-07-23 reorg |
| **Developer listing card** (`.dev-card`) | Inline in `pages/developers.php` (markup repeated inside its own `foreach` loop, not extracted) | Only `pages/developers.php` | Plain PHP `foreach` over `data/developers.json`, markup written once per iteration in the same file | Partially — it is a single-file repeated loop, not duplicated *across* files, but it is not yet an independent, reusable `template-parts/` file the way the project card is | N/A (single call site, so no cross-file inconsistency possible) |
| **Hero section** | No shared partial exists. Each page type writes its own `<section class="hero …">` markup directly (`index.php`, `pages/about.php`, `pages/services.php`, `pages/contact.php`, `pages/communities.php`, `pages/developers.php`, `templates/developer-template.php`, `templates/project-template.php`, `projects/damac-islands2.php`) | 9 distinct call sites | Shared only through CSS class conventions (`.hero`, `.hero--home`, `.hero--page`) and shared design tokens in `main.css` | Not extracted as PHP — reuse currently happens at the CSS layer only | The homepage hero (video background, search pill) and the "inner page" hero (breadcrumb, `.hero--page`) are two genuinely different variants by design, not accidental drift — but even within the "inner page" variant, the markup is hand-repeated per file rather than parameterized |
| **Lead-capture form** (`.lead-form`) | Markup repeated in `templates/project-template.php` (×2: `#hero-form`, `#main-form`), `projects/damac-islands2.php` (×2, same IDs), `pages/contact.php` (×1: `#main-form`) | 3 files, 5 form instances total | Shared only through: CSS classes (`main.css` `.lead-form*` rules) and JS (`assets/js/main.js` `setupForm()` looks up forms by the fixed IDs `hero-form`/`main-form`) | The *validation logic* (`setupForm()`, `validators` object) is genuinely shared and reusable — it operates generically on any form with `name="name"/"phone"/"email"/"message"` inputs. The *markup* is hand-repeated, not a shared PHP partial | Field sets differ slightly: `contact.php`'s form adds a `fieldset.field` radio-pill enquiry-type selector that the project-page forms don't have |
| **Calls to action** (`.cta-final`) | Markup repeated per page (`index.php`, `pages/about.php`, `pages/services.php`, `pages/contact.php`, `pages/communities.php`, `pages/developers.php`) | 6 files | Shared CSS class (`main.css`/`home.css` `.cta-final*`), no shared PHP partial | CSS-level reuse only | Content (heading, buttons, contact line) differs per page, which is expected — but the wrapping markup structure is still hand-repeated rather than parameterized |
| **Breadcrumbs** | Auto-generated 2-item `BreadcrumbList` JSON-LD in `includes/header.php` (keyed off `$current_page` + a hardcoded `$nav_items` array); a separate 3-item `BreadcrumbList` is hand-built inline in `templates/developer-template.php` for the developer-archive case | Every page gets the header's version (or none, if `$current_page` is empty/unmatched); developer pages additionally emit their own | Header's version: automatic, driven by `$current_page`. Developer template's version: manually constructed inline (lines ~124–150 of `templates/developer-template.php`) | Partially — the 2-item version is a genuine shared mechanism; the 3-item developer-specific version is a one-off, not generalized into the header's mechanism | Yes, in the sense that there are two different BreadcrumbList generation code paths for what is conceptually one feature |
| **Project listings / Developer listings** | `pages/communities.php` (all 18 projects) and `pages/developers.php` (all 20 developers) are themselves the "listing" components — there is no further shared listing partial beneath them | Single call site each | Direct `foreach` over `get_all_projects_safe()` / iteration over `data/developers.json` | N/A — each is a page, not a reusable fragment | N/A |
| **Structured data (JSON-LD)** | Multiple independent blocks: `RealEstateAgent` (footer, sitewide), `WebSite` (homepage only), `BreadcrumbList` (header, + developer template's own), `FAQPage` (services.php, communities.php), `Residence`/`Offer`/`PostalAddress` (project-template.php's `$json_ld`, and damac-islands2.php's own hand-built equivalent) | See above | Each is independently `json_encode()`'d inline | The project-template.php version is genuinely data-driven (built from `$project['structured_data']`) | damac-islands2.php's `Residence`/`Offer`/`PostalAddress` block is structurally parallel to but a separate, hand-maintained copy of project-template.php's logic |

---

## PHP File Relationships

**Path style:** 100% relative, using `__DIR__` exclusively — no absolute filesystem paths found anywhere. Depth-correct: files one level below root (`pages/`, `developers/`, `projects/`, `templates/`) use `__DIR__ . '/../includes/...'`; `index.php` (which stays at root) uses `__DIR__ . '/includes/...'` directly. This was verified consistent across all 53 PHP files (zero stale single-segment `require` paths found by repo-wide grep).

**Dependency summary (who requires whom):**

```
index.php
 ├─→ includes/project-data.php     (function definitions only)
 ├─→ includes/developer-data.php   (function definitions only)
 ├─→ includes/header.php           (must run after $page_title etc. are set)
 ├─→ includes/project-card-helpers.php   (require_once, before the project loop)
 ├─→ template-parts/project-card.php     (require, once per loop iteration — 6 times)
 └─→ includes/footer.php           (last)

pages/{about,services}.php
 ├─→ includes/header.php
 └─→ includes/footer.php

pages/contact.php
 ├─→ includes/header.php
 └─→ includes/footer.php
     (no project/developer data needed)

pages/developers.php
 ├─→ includes/project-data.php
 ├─→ includes/developer-data.php
 ├─→ includes/header.php
 └─→ includes/footer.php

pages/communities.php
 ├─→ includes/project-data.php
 ├─→ includes/developer-data.php
 ├─→ includes/header.php
 ├─→ includes/project-card-helpers.php   (require_once)
 ├─→ template-parts/project-card.php     (require, once per project — 18 times)
 └─→ includes/footer.php

developers/{20 files}.php
 └─→ templates/developer-template.php   (sets $developer_slug first)
      ├─→ includes/project-data.php
      ├─→ includes/developer-data.php
      ├─→ includes/header.php            (twice in source: once in the 404 branch, once in the success path — only one path executes per request)
      ├─→ includes/project-card-helpers.php  (require_once)
      ├─→ template-parts/project-card.php    (require, once per matched project)
      └─→ includes/footer.php            (twice in source, same either/or as header.php)

projects/{18 files}.php
 └─→ templates/project-template.php   (sets $project_slug first)
      ├─→ includes/project-data.php
      ├─→ includes/header.php   (twice in source, 404-branch / success-path either/or)
      └─→ includes/footer.php  (twice in source, same either/or)

projects/damac-islands2.php
 ├─→ includes/header.php   (direct — bypasses templates/project-template.php entirely)
 └─→ includes/footer.php

includes/developer-data.php  → data/developers.json (via __DIR__ . '/../data/developers.json')
includes/project-data.php    → data/projects.json    (via __DIR__ . '/../data/projects.json')
includes/project-card-helpers.php → (no further requires; pure function definitions)
template-parts/project-card.php   → (no requires; assumes helpers + includes/developer-data.php's
                                       get_developer_by_canonical_name() are already loaded by the caller)
```

**Findings:**

- **No file appears to guard against direct web access.** `includes/header.php`, `includes/footer.php`, `templates/developer-template.php`, `templates/project-template.php`, `template-parts/project-card.php`, `includes/project-card-helpers.php`, `includes/project-data.php`, and `includes/developer-data.php` contain no access-guard constant/check (no equivalent of WordPress's `defined('ABSPATH') or die`). Requesting `includes/header.php` or `includes/footer.php` directly by URL would render a broken partial-page fragment (undefined `$page_title` etc. fall back to their `??` defaults, so no PHP error, but the output is not a complete HTML document). `templates/developer-template.php` and `templates/project-template.php` are safer in this respect — direct access with no `$developer_slug`/`$project_slug` set correctly falls through to the existing controlled-404 branch. This is a low-severity but real finding, verified by reading each file's top-of-file logic.
- **Business logic mixed into presentation templates in a few places:**
  - `pages/developers.php` defines its own `developer_canonical()` function locally (verified: not present in any `includes/*.php` file) — page-specific logic living in a page template rather than a shared include.
  - `templates/developer-template.php` and `templates/project-template.php` each contain inline data-resolution logic (image fallback selection, breadcrumb JSON-LD construction) directly alongside their HTML output, rather than delegating to a function in `includes/`.
- **Functions are centralized for data access** (`includes/project-data.php`, `includes/developer-data.php` — confirmed sole-responsibility, no HTML output, no template copy per their own docblocks) but **not for card/list rendering** beyond the one project-card partial — the developer-card loop's rendering logic lives directly in `pages/developers.php`.
- **`declare(strict_types=1)`** is present in `templates/developer-template.php`, `templates/project-template.php`, `includes/project-data.php`, `includes/developer-data.php`, but **absent** from `pages/communities.php`, `index.php`, `includes/header.php`, `includes/footer.php`, `includes/project-card-helpers.php`, and `template-parts/project-card.php` — an inconsistency in strictness convention across the codebase (verified by direct inspection of each file's opening lines).

---

## CSS Architecture

**7 files, 1,866 total lines, loaded via a documented, explicit cascade** — every page-specific CSS file's own header comment states exactly which other CSS files it "extends" and the required `<link>` order (verified by reading all 7 files in full):

- `main.css` — loaded on every page. Global reset, `@font-face` (Manrope variable font), design tokens (`:root` custom properties: `--navy`, `--gold`, `--bg-*`, `--text-*`, `--r-sm/md/lg/xl` radius scale, `--shadow-*`, `--transition-*`, `--container`, `--gutter`, `--section-pad`, `--header-h`), responsive token overrides at 768px/992px, base typography, buttons, global header/nav (including the full mobile off-canvas nav), hero base styles, forms (`.lead-form`, `.field`), quick-facts, overview/stat-cards, gallery, amenities, location, footer, sticky CTA, and the `[data-reveal]` scroll-animation base (with a `prefers-reduced-motion: reduce` override disabling all transitions).
- `home.css` — `index.php` only. Corporate hero variant, hero search pill, `.project-card`, `.category-card`, `.community-card`, buying-process `.step`, `.testimonial-card`, `.insight-card`.
- `about.css` — `about.php` only. `.hero--page` inner-hero variant (used by every non-homepage page), `.breadcrumb`, `.split` two-column layout, `.mv-block`, `.choose__list` (numbered list), `.team-card`.
- `services.css` — `services.php` only. `.offplan` feature band, `.service-card`, `.audience__grid`, `.faq-item` (native `<details>`/`<summary>` accordion).
- `contact.css` — `contact.php` only. `.method-card`, radio `.pill-group`, `.office-card`, `.map__frame` placeholder, `.visit__inner`.
- `communities.css` — `communities.php` only. `.comm-card` (the styling counterpart to the shared `template-parts/project-card.php` markup), `.comm-row` compact rows.
- `developers.css` — `developers.php` only. `.dev-card`, `.dev-card__logo-mark` (CSS-mask-based single-color logo treatment), `.browse-item` rows.

**Design tokens:** Centralized entirely in `main.css`'s `:root` block; no other file redefines a token, and no hardcoded hex colors were found duplicating a token value in any of the other six files (spot-checked; all color references in page-specific files use `var(--*)`).

**Duplicate rules:** None found at the *selector* level — each page-specific file's own header comment explicitly disclaims which shared component classes it reuses rather than redefining (e.g. `communities.css`'s header comment: "Extends main.css…, home.css…, about.css…, services.css…and contact.css…"). The one duplication that *did* exist at the component level (the project card) was at the PHP/markup layer, not CSS — `.comm-card`'s CSS rules already lived in exactly one place (`communities.css`) even before the PHP-level consolidation documented in `docs/project-architecture-report.md`.

**Inline styles:** A small number of inline `style="..."` attributes exist directly in PHP templates for one-off layout tweaks (e.g. `style="text-align:center; max-width:640px;"` in the controlled-404 branches of `templates/developer-template.php` and `templates/project-template.php`, and `style="-webkit-mask-image:url('...'); mask-image:url('...')"` per-developer-logo in `pages/developers.php`, which is inherently per-instance data, not a candidate for a static CSS rule).

**Responsive breakpoints:** A consistent, limited set is used throughout: `480px`, `600px`, `640px`, `700px`, `767.98px`/`768px`, `991.98px`/`992px`, `1100px`, `1200px`. No conflicting or one-off breakpoint values were found.

**RTL / logical-property readiness:** Mixed. The codebase already uses logical properties in several places (`margin-inline`, `padding-inline`, `padding-block`, `inset-inline`), which is a positive sign for future Arabic RTL support (mentioned as a known gap in `README.md`). However, physical-direction properties (`left`, `right`, `padding-left`, `text-align: left`) are still used extensively for positioning (e.g. `.eyebrow::before` uses `left: 0`, `.sticky-cta` uses `left`/`right`, `.header__nav` mobile panel uses `right: 0`) — a full RTL conversion would require auditing and converting these, not merely activating a `dir="rtl"` attribute.

---

## JavaScript Architecture

**Single global file: `assets/js/main.js` (255 lines), loaded on every page via `includes/footer.php`'s `<script src="assets/js/main.js">`.** No page has any page-specific `.js` file, and no inline `<script>` blocks containing behavioral logic were found outside of JSON-LD `<script type="application/ld+json">` data blocks.

Structure — one IIFE (`(function () { 'use strict'; ... })();`), containing five independent, self-guarding behavior blocks that each check for the existence of their target DOM elements before wiring up:

1. **Header scroll state** — toggles `.is-scrolled` on `#header` based on `window.scrollY`.
2. **Mobile navigation** — `#nav-toggle`/`#main-nav`/`#nav-close`/`#nav-overlay`, with a documented focus trap (Tab/Shift+Tab cycling inside the open panel), Escape-to-close, click-outside-to-close, and automatic close if the viewport crosses the `min-width: 992px` desktop breakpoint while open (`matchMedia` with an `addEventListener`/`addListener` fallback for older browsers).
3. **Scroll reveal** — `IntersectionObserver`-driven, targets every `[data-reveal]` element, staggers reveal via `item.style.transitionDelay = (index % 4) * 70 + 'ms'`; falls back to immediately marking everything visible if `prefers-reduced-motion: reduce` or `IntersectionObserver` is unsupported.
4. **Sticky CTA** — two `IntersectionObserver`s (one on `.hero`, one on `#enquire`) drive a `heroPassed`/`enquireVisible` state machine that shows/hides `#sticky-cta`; clicking it smooth-scrolls to `#enquire` and focuses its first input.
5. **Lead-form validation** — a `validators` object (`name`, `phone`, `email`, `message`, matched by each `<input>`'s `name` attribute) plus a generic `setupForm(form)` function wired to `#hero-form` and `#main-form` specifically (`document.getElementById('hero-form')` / `document.getElementById('main-form')`). **Confirmed: on successful validation, the form is hidden and a `.lead-form__success` panel is shown — there is no `fetch`/`XMLHttpRequest` call and no form `action`/network submission anywhere in this file.** This matches the explicit statement in `README.md`: "no endpoint is connected — wire up email/CRM during WordPress conversion."

**Global variables/namespace:** Everything is scoped inside the IIFE; the only global side effect is `document.documentElement.classList.add('js')` (used by `main.css`'s `html.js [data-reveal]` selector to only apply the animated-hidden state when JS is available, avoiding a no-JS content-hidden trap).

**Third-party dependencies:** None. No `<script src="https://...">` to any CDN or library was found anywhere in the codebase (confirmed by repo-wide search).

**Potential duplication:** None found within `main.js` itself — the `setupForm()` function is already written generically and reused for both form instances rather than being copy-pasted.

---

## Media and Asset Organization

- **Images (649 files):**
  - `assets/images/` root (82 files) — site-wide and homepage-specific imagery: hero backgrounds (`hero-lagoon-aerial.jpg`, `hero-villa-pool.jpg`), gallery images (`gallery-*.jpg`), numbered stock images (`001.webp` … `030.jpg`, `raw_000.jpg` … `raw_069.webp` — inconsistent, non-descriptive naming), two team photos (`HAITHAM.jpeg`, `Sadam.jpeg`), and the two brand logo files (`smb-logo-horizontal.png`, `smb-logo-vertical.png`).
  - `assets/images/developers/` (20 files) — one logo per developer record in `data/developers.json`, mixed formats (`.svg`, `.png`), named to loosely match developer slugs but not identical casing/format (e.g. `Azizi_Developments.svg`, `MAG-GROUP-HOLDING-logo.png` vs. lowercase-hyphenated slugs like `azizi-developments`).
  - `assets/images/projects/{18 slugs}/` — each project folder contains `original/` (source), `png/`, `webp/`, and `image-library.json` (per-project metadata). Per `docs/image-library-report.md`, this is a complete, audited set: 18/18 projects, 179 originals, 175 PNGs, 175 WebPs. **`damac-islands2` has no corresponding folder here** — its images live loose in the `assets/images/` root instead, confirming it predates this per-project convention.
- **Videos (3 files):** `hero.mp4`, `hero.webm` (referenced by `docs/` specs as the originally-planned hero video pair), and `202607192044.mp4` (a non-descriptively-named file, confirmed via `grep` to be actively referenced by `index.php`'s hero `<video><source>`).
- **Fonts (1 file):** `Manrope-VariableFont_wght.ttf`, a single variable font covering weights 200–800, loaded once via `@font-face` in `main.css`.
- **Icons:** `assets/icons/favicon.svg` only. All *inline* UI icons (nav, buttons, cards) are a single shared SVG `<symbol>` sprite defined directly inside `includes/header.php` (verified: ~30 `<symbol id="i-...">` definitions) and referenced via `<use href="#i-name"/>` — no icon library, no separate icon files for UI icons.
- **Third-party libraries:** None found anywhere in the asset tree.

**Hardcoded asset paths:** Every asset reference site-wide uses a page-root-relative path (e.g. `assets/images/...`, `assets/css/main.css`) with no leading slash — these resolve correctly because every public URL is flat at the domain root (preserved by the `.htaccess` rewrite even though the underlying files moved into subfolders). `data/projects.json`'s `hero.image`/`gallery.images`/`structured_data.image` fields also store these same page-root-relative paths as plain strings.

**WordPress Media Library migration candidates:** All of `assets/images/`, `assets/videos/`, `assets/fonts/` — none of these are referenced through any abstraction layer today (all hardcoded path strings), so a future migration would need to both upload each file to the Media Library and rewrite every stored path (in both PHP files and the two JSON data files) to the resulting Media Library URLs.

**Duplicate or unused-looking files:** Not exhaustively verified for all 82 root-level `assets/images/` files (see Files Requiring Further Investigation) — cross-referencing every one against every `.php`/`.json` file that might reference it was outside the time budget for this audit. The 18 per-project folders were independently confirmed complete and non-duplicated via `docs/image-library-report.md`'s own audit table.

---

## Current Content Sources

| Content | Where it currently lives | Notes |
|---|---|---|
| Page titles, meta descriptions, OG/Twitter fields | Hardcoded PHP variables (`$page_title`, `$page_description`, `$page_og_title`, etc.) at the top of each page/template file | For developer/project pages, these are set dynamically from `data/developers.json` / `data/projects.json` (e.g. `$page_title = $developer_display_name . ' — SMB Real Estate Brokers';`) |
| Homepage hero, About/Services/Contact copy | Hardcoded directly in `index.php` / `pages/about.php` / `pages/services.php` / `pages/contact.php` HTML | Confirmed hand-transcribed from `docs/website-content.md` (which is explicitly labeled as the copy source of truth) — but there is no runtime link; editing the `.md` file does nothing to the live site |
| Developer data (name, bio, logo, canonical name) | `data/developers.json` (20 records), loaded via `includes/developer-data.php` | Structured, schema-validated, genuinely data-driven |
| Project data (name, developer, location, hero/gallery images, facts, amenities, districts, SEO fields, structured data) | `data/projects.json` (18 records), loaded via `includes/project-data.php` | Structured, schema-validated, genuinely data-driven; the richest and most WordPress-CPT-ready data source in the project |
| DAMAC Islands 2 content | Hardcoded directly in `projects/damac-islands2.php` | Cross-referenced against `docs/projects/damac-islands-2.md` ("verified project brief") — same pattern as other static pages: doc is the authored source, PHP is a hand-transcribed, disconnected copy |
| Company legal/contact information (address, phone, email, established year) | Hardcoded in `includes/footer.php` (footer markup + `RealEstateAgent` JSON-LD) and repeated inline in `pages/contact.php` | Cross-referenced against `docs/company-brief.md` (marked "Primary Source: Client Information Collection Form") — again, hand-transcribed, no live link |
| Services list, FAQ content | Hardcoded in `pages/services.php` / `pages/communities.php` (both as visible HTML and duplicated into each page's own `FAQPage` JSON-LD array) | Each FAQ answer exists twice within its own file — once as visible `<details>` markup, once as a JSON-LD string — with no shared source between the two (a same-file duplication risk: editing one without the other desyncs visible copy from structured data) |
| Team members | Hardcoded in `pages/about.php` (two named individuals with role/bio/photo) | Static, no data file |
| Images/videos | Referenced as literal path strings from PHP and from `data/*.json` | See Media and Asset Organization |
| Forms | Client-side only — no submission destination | See Forms and Interactive Features |
| Query parameters / external APIs / database | **None found.** No `$_GET`/`$_POST` handling beyond the client-side-only forms, no `curl`/`file_get_contents` against a remote URL, no database connection code (no `mysqli`/`PDO`/`SQLite` usage anywhere in the codebase) | Confirmed by repo-wide search — this is a fully static-content, no-backend PHP site; the only "dynamic" behavior is PHP reading local JSON files at request time |

**Content very likely to need to become WordPress-editable:** page titles/SEO fields, hero content per page, project data (already structured — direct CPT/ACF candidate), developer data (same), contact information (currently duplicated in at least two places — footer + contact page — and would benefit from single-sourcing), team members, services list/descriptions, FAQ entries (currently duplicated per-page between visible markup and JSON-LD), all images or videos referenced by path.

---

## Forms and Interactive Features

| Form | File | Fields | Validation | Submission |
|---|---|---|---|---|
| Hero lead form (`#hero-form`) | `templates/project-template.php`, `projects/damac-islands2.php` | name, phone, email | Client-side (`assets/js/main.js` `validators`) | **None** — `event.preventDefault()`, shows a static success panel |
| Main enquiry form (`#main-form`, card variant) | `templates/project-template.php`, `projects/damac-islands2.php` | name, phone, email | Same | Same |
| Main contact form (`#main-form`) | `pages/contact.php` | name, phone, email, message, plus a radio-pill enquiry-type selector (fieldset) | Same `validators`, plus the `message` validator's `required`-attribute-aware branch | Same |

No form on any developer page, the developers listing, the communities listing, `about.php`, `services.php`, or `index.php` — confirmed by direct search for `<form` across those files (none found).

Other interactive features: mobile off-canvas navigation (see JavaScript Architecture), scroll-reveal animations, sticky CTA, FAQ `<details>`/`<summary>` native accordions (no JS required for these — pure HTML/CSS), footer auto-updating copyright year (`#year`, set via `main.js`).

---

## SEO and Metadata Implementation

- **Canonical URL, Open Graph, and Twitter Card tags** are generated once in `includes/header.php` from `$_SERVER['REQUEST_URI']` (confirmed: this was changed from `SCRIPT_NAME` during the 2026-07-23 reorg specifically so these stay correct despite the `.htaccess` rewrite — see `docs/project-architecture-report.md`), combined with each page's `$page_title`/`$page_description`/`$page_og_title`/`$page_og_description`/`$page_og_image` variables.
- **`RealEstateAgent` JSON-LD** — one instance, in `includes/footer.php`, present on every single page (sitewide business identity markup).
- **`WebSite` JSON-LD** — `index.php` only.
- **`BreadcrumbList` JSON-LD** — two independent generation paths: an automatic 2-item version in `includes/header.php` (driven by `$current_page` against a hardcoded `$nav_items` map, covering `about`/`services`/`developers`/`communities`/`contact`), and a hand-built 3-item version inline in `templates/developer-template.php` for the developer-archive case specifically (Home → Developers → {Developer Name}). `templates/project-template.php` does not add its own extra breadcrumb level beyond the header's default.
- **`FAQPage` JSON-LD** — `pages/services.php` (5 Q&A) and `pages/communities.php` (6 Q&A), each duplicating its own visible FAQ markup verbatim into the JSON-LD array within the same file (see Current Content Sources — same-file duplication risk).
- **`Residence`/`Offer`/`PostalAddress` JSON-LD** — `templates/project-template.php` builds this dynamically from `data/projects.json`'s `structured_data` field (verified field-by-field: `type`, `name`, `description`, `image`, `price`, `currency`, `address_locality` all map directly into the JSON-LD object). `projects/damac-islands2.php` has its own separately hand-built but structurally parallel block using the same schema.org types.
- **Meta robots:** a static `<meta name="robots" content="index, follow">` on every page (from `includes/header.php`) — no per-page override mechanism exists for pages that might need `noindex` (e.g. the controlled-404 branches render their own `<head>` and do not set an explicit `robots` override, though they do correctly set `http_response_code(404)`).

---

## Repeated Code and Duplication

| Duplication | Files | Status |
|---|---|---|
| Project-card markup + 3 helper functions | *(historical)* — was previously triplicated across `index.php`, `communities.php`, `developer-template.php` | **Resolved** as of the 2026-07-23 reorg — verified: exactly one definition of each helper function exists (`includes/project-card-helpers.php`), and one markup partial (`template-parts/project-card.php`) |
| Developer-listing card (`.dev-card`) loop | `pages/developers.php` only | Not cross-file duplicated (single call site), but not yet extracted to `template-parts/`, unlike its project-card counterpart |
| Full project-page section structure (hero → districts → facts → overview → gallery → amenities → location → enquire) | `templates/project-template.php` vs. `projects/damac-islands2.php` | Hand-duplicated — `damac-islands2.php` reproduces the entire template's section structure independently rather than being data-driven through the template, confirmed via matching `<section>` id/class sequences in both files |
| FAQ content (visible markup vs. JSON-LD) | `pages/services.php` (own file, twice), `pages/communities.php` (own file, twice) | Same-file duplication — each FAQ answer is written out twice with no single source, risking silent desync if one copy is edited without the other |
| Breadcrumb JSON-LD generation | `includes/header.php` (2-item, generic) vs. `templates/developer-template.php` (3-item, hand-built) | Two independent code paths for conceptually one feature |
| Structured-data (`Residence`/`Offer`/`PostalAddress`) construction | `templates/project-template.php` (data-driven, from `$project['structured_data']`) vs. `projects/damac-islands2.php` (hand-built, hardcoded values) | Parallel implementations of the same schema shape |
| Hardcoded internal links | Every page's nav/footer links (`about.php`, `services.php`, etc.) and every project card's developer-link fallback (`'developers.php#developer-' . developer_slug(...)`) | These are consistent and centralized enough (single nav array in `header.php`; single fallback closure pattern in the card partial) that this is a minor, not a structural, finding |
| Hardcoded file paths | Every asset reference (`assets/css/...`, `assets/images/...`) across all 53 PHP files and both JSON data files | Necessary given the current flat-URL, no-abstraction architecture; this is the single largest category of "hardcoding" a WordPress conversion will need to replace with `wp_enqueue_style()`/`wp_enqueue_script()`/Media Library URLs |
| Company contact details | `includes/footer.php` (markup + JSON-LD) and `pages/contact.php` (contact-methods section, office-card) | Same phone/email/address values exist as separate hardcoded strings in at least two files |

---

## Architectural Coupling

- **`projects/damac-islands2.php`** is the most tightly-coupled file in the project: it cannot be swapped onto the shared `project-template.php` without either (a) backfilling it into `data/projects.json` first, or (b) accepting it will remain a permanent one-off. It is coupled to its own hardcoded content, its own image paths (stored outside the standard `assets/images/projects/{slug}/` convention), and its own JSON-LD block.
- **`pages/developers.php`** is coupled to its own inline `developer_canonical()` function and its own inline `.dev-card` rendering loop — reusing that card elsewhere (e.g. if a future page wanted a "developer of the month" widget) would require either duplicating the markup again or extracting it first.
- **`templates/developer-template.php` / `templates/project-template.php`** are well-decoupled from content (driven entirely by JSON), but are still coupled to the *page-load flow* itself — image-fallback resolution, breadcrumb JSON-LD, and SEO-variable assignment are all inlined directly in the template rather than delegated to callable functions, so the "what data flows in" and "how it's rendered" responsibilities are mixed in one file per template.
- **FAQ content** in `services.php`/`communities.php` is coupled between two representations (visible HTML and JSON-LD) with no shared source — a future CMS/CPT conversion should treat this as one editable field that generates both outputs, not two.
- **No page currently depends on live external services**, a database, or any network call — the entire site's "coupling" is internal (PHP-to-PHP, PHP-to-JSON, PHP-to-CSS-class-convention), which is a favorable starting condition for decoupling work during a WordPress conversion.

---

## Existing Strengths

- Two mature, well-documented, genuinely data-driven page templates (`developer-template.php`, `project-template.php`) already behave like WordPress `single-*.php` templates.
- `data/developers.json` and `data/projects.json`, backed by strict JSON Schemas, are essentially ready-made ACF/custom-field specifications.
- Consistent, sole-responsibility data-loader functions (`includes/developer-data.php`, `includes/project-data.php`) with no HTML mixed in.
- One already-consolidated shared component (`template-parts/project-card.php` + `includes/project-card-helpers.php`), proving the pattern works for this codebase.
- A fully documented, single-cascade CSS system with centralized design tokens and no cross-file token duplication.
- A single, dependency-free, well-organized global JavaScript file with no third-party libraries to migrate.
- Consistent relative-path `require`/`require_once` usage throughout, verified with zero stale references after the recent reorganization.
- A complete, audited local image library for all 18 data-driven projects (per `docs/image-library-report.md`).

---

## Current Structural Weaknesses

1. `projects/damac-islands2.php` is architecturally inconsistent with every other project page (hand-built, not template-driven, absent from `data/projects.json`, images stored outside the standard per-project folder convention).
2. The developer-listing card (`.dev-card` in `pages/developers.php`) has not been extracted into a `template-parts/` file the way the project card has.
3. FAQ content is duplicated within the same file (visible markup vs. JSON-LD) in both `services.php` and `communities.php`, with no single source.
4. Company contact details are duplicated as separate hardcoded strings across `includes/footer.php` and `pages/contact.php`.
5. Breadcrumb JSON-LD has two independent implementations (generic 2-item in the header, hand-built 3-item in the developer template) rather than one generalized mechanism.
6. No file in `includes/`, `templates/`, or `template-parts/` guards against being requested directly by URL.
7. `pages/developers.php` contains its own locally-defined business-logic function (`developer_canonical()`) rather than delegating to `includes/`.
8. `docs/company-brief.md` and `docs/website-content.md` are effectively "dead" as content sources at runtime — they describe what should be on the site, but nothing keeps the live PHP in sync with them.
9. `README.md` is stale, describing an earlier single-page project phase rather than the current 45-page, data-driven site.
10. `docs/developer-archive-template-specification.md` contains routing rules ("no router, rewrite rule... is added") that are now factually superseded by the `.htaccess` layer added in the 2026-07-23 reorg — confirmed by direct comparison with `docs/project-architecture-report.md` and the current `.htaccess` file.
11. `tools/` is an empty placeholder — no linter, formatter, or build tooling exists.
12. `declare(strict_types=1)` usage is inconsistent across otherwise-similar files.

---

## WordPress Conversion Readiness

| Classification | Applies to |
|---|---|
| **Already reusable** | `templates/developer-template.php`, `templates/project-template.php` (structurally single-CPT-template-shaped); `template-parts/project-card.php` + `includes/project-card-helpers.php`; `includes/developer-data.php` / `includes/project-data.php` (as a model layer); `data/developers.schema.json` / `data/projects.schema.json` (as field-group specifications) |
| **Requires extraction into template parts** | The developer-listing card in `pages/developers.php`; the hero-section markup (currently hand-repeated across 9 files with only CSS-level sharing); the `.cta-final` block (repeated across 6 files) |
| **Requires data separation** | All static page copy in `index.php`, `pages/about.php`, `pages/services.php`, `pages/contact.php`, `projects/damac-islands2.php` (currently hardcoded HTML, no data file backing it); FAQ content (needs to become one source feeding both visible markup and structured data); team member entries in `about.php`; company contact details (footer + contact page) |
| **Requires path adjustment** | Every hardcoded `assets/...` path across all 53 PHP files and both JSON data files — these will need to become Media Library URLs or theme-relative `get_template_directory_uri()` calls |
| **Requires WordPress API replacement** | `includes/header.php`'s nav array → `wp_nav_menu()`; `main.css`'s enqueue → `wp_enqueue_style()`; `main.js`'s enqueue → `wp_enqueue_script()`; the JSON data loaders → `WP_Query`/CPT meta reads; the hardcoded `$site_url` in `includes/header.php` → `home_url()` |
| **Requires plugin-level functionality** | Lead-form submission (currently has no backend at all — will need Contact Form 7 / Gravity Forms / WPForms, or a custom handler, plus a CRM/email integration); any future need for a real embedded map (currently a static placeholder) |
| **Requires further investigation** | `projects/damac-islands2.php`'s eventual disposition (backfill into the CPT dataset vs. keep as a one-off custom page); whether the 649 root-level/developer-logo image files have any unused entries (not exhaustively checked — see below) |

---

## Preliminary Existing-to-WordPress Mapping

*(Conceptual only — no WordPress structure was created as part of this audit.)*

| Current file/concept | Likely WordPress theme area |
|---|---|
| `includes/header.php` | `header.php` |
| `includes/footer.php` | `footer.php` |
| `index.php` | `front-page.php` |
| `pages/about.php`, `pages/services.php`, `pages/contact.php` | Individual page templates (`page-about.php`, etc.) or standard WP Pages using a shared template |
| `pages/developers.php`, `pages/communities.php` | CPT archive templates (`archive-developer.php`; a custom `page-communities.php` querying the `project` CPT) |
| `templates/developer-template.php` | `single-developer.php` |
| `templates/project-template.php` | `single-project.php` |
| `projects/damac-islands2.php` | Either a one-off custom page template, or backfilled into the `project` CPT and retired |
| `template-parts/project-card.php` | `template-parts/project-card.php` (name/location already matches WP convention) |
| The not-yet-extracted `.dev-card` loop | Future `template-parts/developer-card.php` |
| `includes/project-data.php`, `includes/developer-data.php` | `inc/` (data-access helpers), largely superseded by native `WP_Query`/CPT meta once migrated |
| `includes/project-card-helpers.php` | `inc/` |
| `data/developers.json`, `data/projects.json` | One-time import source into `developer`/`project` CPT posts + meta (via their `.schema.json` companions as the field-group spec) |
| `assets/css/*.css`, `assets/js/main.js` | `assets/` (enqueued via `functions.php`) |
| `assets/images/`, `assets/videos/`, `assets/fonts/` | WordPress Media Library (after one-time import) |
| Lead-capture forms | Plugin-level functionality (Contact Form 7 / Gravity Forms / WPForms, or custom) |
| `docs/*.md` | Not part of the theme; historical/planning reference only |

---

## Files Requiring Further Investigation

- **`projects/damac-islands2.php`** — needs a product decision (not just a technical one) on whether it becomes a 19th `data/projects.json` record or remains permanently outside the CPT dataset.
- **Full usage audit of the 82 root-level `assets/images/` files** and the 20 `assets/images/developers/` files against every `.php`/`.json` reference — this audit spot-checked and confirmed several (hero/gallery images, developer logos referenced by `pages/developers.php`, the homepage hero video) but did not exhaustively grep every one of the 102 combined files for at least one confirmed reference.
- **`docs/developer-archive-template-specification.md` and `docs/project-pages-implementation.md`** — both are prior build-instruction documents; their prescriptive content (routing rules, wrapper-file conventions) should be treated as historical rather than current-state authoritative, per the confirmed contradiction with the live `.htaccess`.
- **Hosting environment** — this audit inspected files only; whether the live/target hosting environment actually has `mod_rewrite`/`AllowOverride` enabled (required for the existing `.htaccess` to function) was out of scope and was already flagged as an open risk in `docs/project-architecture-report.md`.

---

## Verified Findings

- Full PHP `require`/`include` graph (root → `pages/` → `developers/`/`projects/` → `templates/` → `template-parts/` → `includes/`), confirmed via direct reading and repo-wide grep, zero stale references.
- All paths are relative (`__DIR__`-based); no absolute filesystem paths exist anywhere.
- No database connection code, no external API calls, no server-side form submission exists anywhere in the codebase.
- Exactly one definition each of `comm_project_card_image()`, `comm_parse_property_types()`, `comm_property_type_icon()` (in `includes/project-card-helpers.php`) — the prior triplication is confirmed resolved.
- `projects/damac-islands2.php` is confirmed absent from `data/projects.json` (checked against all 18 records).
- `docs/*.md` files are confirmed not read by any PHP file at runtime.
- All 7 CSS files and the 1 JS file were read in full; the cascade/dependency comments in each CSS file's header were verified accurate against actual usage.
- `main.js` was read in full; confirmed no network/AJAX submission code exists for either lead form.
- JSON Schemas (`data/developers.schema.json`, `data/projects.schema.json`) confirmed to enforce fixed dataset sizes (exactly 20 / exactly 18 records) via `minItems`/`maxItems`.
- Canonical/OG/Twitter URL generation confirmed to use `$_SERVER['REQUEST_URI']` (not `SCRIPT_NAME`) in `includes/header.php`.
- Every JSON-LD `@type` instance across the codebase was catalogued via repo-wide search.

## Unverified or Uncertain Findings

- Whether every one of the 82 root-level `assets/images/` files and 20 developer-logo files is actively referenced somewhere, versus a small number being orphaned/unused — not exhaustively checked (see Files Requiring Further Investigation).
- Whether the target production hosting environment actually supports the `.htaccess` rewrite rules the current architecture depends on — cannot be verified by static file inspection alone.
- Whether `docs/company-brief.md` / `docs/website-content.md` are still being actively maintained as planning references by the team (vs. abandoned) — this audit can only confirm they are not runtime-connected, not their current editorial status.

---

## Final Current-State Assessment

The project is a disciplined, well-organized flat-file PHP site with no framework and no database, already reorganized (as of 2026-07-23) into a folder structure that anticipates a CPT-based WordPress conversion. Its two shared page templates and two JSON data files are the standout assets — they are structurally very close to what a WordPress `developer`/`project` CPT implementation will need, and the one shared UI component that exists (`template-parts/project-card.php`) proves the extraction pattern works cleanly here. The remaining gaps are concentrated and well-defined rather than pervasive: one architecturally inconsistent standalone page (`damac-islands2.php`), a handful of not-yet-extracted repeated markup blocks (developer card, hero, final CTA), same-file FAQ duplication between visible content and structured data, and the hard dependency on hardcoded asset paths that any WordPress conversion will need to replace with Media-Library-backed URLs. No hidden backend, no external integrations, and no database dependency were found — the entire "dynamic" behavior of the site is PHP reading two local JSON files at request time, which meaningfully simplifies the eventual migration path.
