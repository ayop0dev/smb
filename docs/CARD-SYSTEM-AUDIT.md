# SMB Card System Audit

> Audit only. No project file other than this report was created or modified. See Section 15 for open questions and the Final Response for a modification confirmation.

## 1. Audit Scope

**Files and directories inspected (read in full):**
- `index.php` (homepage)
- `pages/about.php`, `pages/services.php`, `pages/developers.php`, `pages/communities.php`, `pages/contact.php`
- `templates/project-template.php` (shared project template — drives 18 of 19 project pages)
- `templates/developer-template.php` (shared developer-archive template — drives all 20 developer pages)
- `projects/damac-islands2.php` (standalone hand-coded project page — see note below)
- `template-parts/project-card.php`, `template-parts/developer-card.php`, `template-parts/enquiry-form.php`
- `includes/header.php`, `includes/footer.php`, `includes/project-data.php` (signatures), `includes/developer-data.php`, `includes/project-card-helpers.php`
- All active CSS: `assets/css/main.css`, `home.css`, `about.css`, `services.css`, `communities.css`, `contact.css`, `developers.css`
- `assets/js/main.js`
- `data/projects.json` (18 records, counted programmatically), `data/developers.json` (20 records, counted programmatically)

**Sampled, not individually read in full:** of the 19 files in `projects/*.php`, only `fahid-island.php` was opened directly; of the 20 files in `developers/*.php`, only `emaar-properties.php` was opened directly. Both are confirmed 3-line wrappers (`$slug = '...'; require '.../template.php';`). The remaining 17 and 19 wrapper files were **not individually opened** — their identical wrapper pattern is inferred from these two samples plus the consistent `.htaccess` rewrite list (`.htaccess:12,15`) and the shared-template architecture documented in `templates/project-template.php:1-10` and `templates/developer-template.php:1-7`. This inference is treated as high-confidence but is explicitly flagged as an inference, not a per-file verification.

**Excluded:** `docs/*.md` (specifications, not active code), `.agents/`, `.claude/`, `.git/`, `tools/`, `data/*.schema.json` (schema files, not templates), `assets/js` beyond `main.js` (none other exists), image/font/video binary assets.

**Inspection limitations:**
- Did not open `data/projects.json` or `data/developers.json` field-by-field; record counts were obtained via a PHP one-liner (`php -r ...`), not manual inspection. Field names referenced below come from their usage in `project-template.php` and `developer-template.php`, not from reading the JSON directly.
- Did not exhaustively diff all 18 project pages against `project-template.php`'s output for content-level variation (e.g., which pages actually populate `districts`, optional amenities count, etc.) — only `damac-islands2.php`'s standalone markup was read in full as a structural reference.
- `includes/project-data.php` was read only up to its first ~60 lines (loader + two accessor functions); the remainder of the file (additional accessor functions) was not read, though none of them affect component classification.

## 2. Executive Summary

- **28 distinct active component patterns** identified (Section 3), plus **3 confirmed-inactive/unused CSS-defined patterns** (Section 8, Semantic/CSS Duplication) that exist in stylesheets but have no corresponding markup anywhere in the active codebase.
- Reasonably measurable instance counts (see Section 3 for per-component detail): the single largest instance count belongs to the project-template family — `.facts__item`, `.stat-card`, `.place-card` each render on all 19 project pages (18 data-driven + 1 standalone), `.gallery__item` likewise, `.amenity-card` variably per project. The single most-reused *component file* is `template-parts/project-card.php` (`.comm-card`), which renders on the homepage, the Communities archive, and every one of the 20 developer-archive pages.
- **Genuine navigational/entity cards:** 3 component types (Project Card, Developer Row, Community Card — see Section 10), though Community Card's real-world destination is currently generic (see Section 9).
- **Informational blocks (non-clickable):** 10 component types (Facts Item, Stat Card, Amenity Card, Place Card, Gallery Item, Why-Item, Step, Mission/Vision Block, Testimonial Card, District Strip Item).
- **Action-oriented components:** 6 component types (Method Card, Category Card, CTA Final panel, Sticky CTA, Enquiry Form, Pill-group radio).
- **Disclosure components:** 1 type (FAQ Item / `<details>`), used on 2 pages.
- **Decorative or layout-only containers:** 1 type identified with confidence (District Strip wrapper — not itself card-styled), plus the generic `.split` two-column layout used across 4 different content contexts (not a "card," a layout primitive).
- **Components with unclear classification:** Office Card (single instance, card-styled, but not part of a repeated collection — see Section 3), Insight Card (entity-like structure but every destination is a placeholder), Team Card (entity-like — a person — but has no click destination at all).
- **Main sources of visual repetition:** the "white surface / `var(--r-lg)` radius / `var(--border-light)` border / `var(--shadow-sm)` shadow / hover = `translateY(-2px)` + `var(--shadow-soft)`" recipe appears, verified by direct CSS inspection, in 15 of the 28 active components (exact list in Section 5).
- **Main sources of structural duplication:** the "icon-in-a-box + heading + short paragraph" DOM shape (Section 6) appears in at least 7 components across 5 different CSS files, each with its own independently-declared selector rather than one shared class.
- **Semantic duplication:** two class-name pairs (`.why-item` used for both "Why SMB" on the homepage and "Our Values" on About; `.step` used for both "Buying process" on the homepage and "How We Work" on About) are the *same* CSS component rendering *different* static content on two different pages — this is genuine code reuse, not visual coincidence, and is documented in Section 7.

This section makes no design recommendations, per audit instructions.

## 3. Complete Component Inventory

### 3.1 Project Card
- **Selector(s):** `.comm-card`, `.comm-card__media`, `.comm-card__body`, `.comm-card__desc`, `.comm-card__dev-link`, `.comm-card__types`, `.comm-card__link`
- **Source files:** `template-parts/project-card.php` (markup), `includes/project-card-helpers.php` (image/type-label resolution helpers)
- **Source CSS:** `assets/css/communities.css:24-76`
- **Appears on:** `index.php:92-96` (Featured Projects, sliced to 6), `pages/communities.php:90-94` (Featured Communities, all records), `templates/developer-template.php:204-213` (each developer's "Projects by X" grid)
- **Shared/page-specific:** Shared partial, `require`d by 3 different call sites (2 pages + 1 template, the latter rendered by 20 developer wrapper files)
- **Static or data-generated:** Data-generated, looped from `get_all_projects_safe()` / `get_projects_by_developer()`, sourced from `data/projects.json` (18 records)
- **Approximate rendered instances:** 6 (home) + 18 (communities, full set) + up to 18 more spread across the 20 developer pages (each project belongs to exactly one developer, so the sum across all developer pages equals the project count, not 18×20)
- **Content type:** Real-estate project/development
- **Semantic role:** Entity summary card
- **User interaction:** Two independent links inside one component — the developer name (`.comm-card__dev-link`) and "View Project" (`.comm-card__link`); the outer `<article>` itself is not a link
- **Click destination:** Developer name → that developer's archive page (`{slug}.php`); "View Project" → the project's own page (`{project_slug}.php`)
- **Whole component clickable:** No — two separate nested links, confirmed by markup (`project-card.php:37,50`)
- **Image:** Yes, `loading="lazy"`, fixed `width="900" height="563"`
- **Icon:** Yes, per property-type pill (`comm-card__types`) and the trailing arrow on "View Project"
- **Heading:** Yes, `<h3>`
- **Supporting text:** Yes — developer + location line, property-type pill list
- **CTA:** Yes, "View Project" text link with arrow icon
- **Hover/focus:** `translateY(-2px)` + `box-shadow: var(--shadow-soft)` on the whole card (`communities.css:34`); separate `:hover` color changes on the two internal links (`communities.css:53,72`)
- **Visual shell:** White background, `var(--r-lg)` radius, `var(--border-light)` border, `var(--shadow-sm)` shadow
- **Similar components:** Community Card (§3.10) is visually different (image-led, no white surface) despite the similar name; Developer Row (§3.2) shares the entity-card *role* but not the visual shell
- **Implementation notes:** This is the most-reused single component file in the codebase (3 distinct call sites, effectively rendering on 22 different pages once developer pages are counted individually)
- **Classification confidence:** High

### 3.2 Developer Row
- **Selector(s):** `.dev-row`, `.dev-row__head`, `.dev-row__index`, `.dev-row__logo`, `.dev-row__logo-mark`, `.dev-row__desc`, `.dev-row__meta`, `.dev-row__count`, `.dev-row__link`
- **Source files:** `template-parts/developer-card.php`
- **Source CSS:** `assets/css/developers.css` (Featured-developers block; replaced this session — no white-card shell, no shadow, no radius; rule-divided list with a `counter()`-based index)
- **Appears on:** `pages/developers.php:69-267` only, one `require` per developer inside 20 hand-written per-developer blocks
- **Shared/page-specific:** Shared partial, single call site (looped by hand 20 times in `developers.php`, not a PHP `foreach`)
- **Static or data-generated:** Markup is a shared partial; content per row is resolved from `data/developers.json` via `get_developer_by_canonical_name()`
- **Approximate rendered instances:** 20 (verified — `data/developers.json` contains exactly 20 records, and `developers.php` contains exactly 20 `require __DIR__ . '/../template-parts/developer-card.php';` calls)
- **Content type:** Real-estate developer (company entity)
- **Semantic role:** Entity summary row
- **User interaction:** Two links per row — the logo (`.dev-row__logo`, `aria-label="View {developer} developer archive"`) and "View Developer" (`.dev-row__link`), plus the heading itself is also a link (`<h3><a>`)
- **Click destination:** All three links point to the same destination — that developer's archive page
- **Whole component clickable:** No — three separate inline links, not one wrapping link
- **Image:** No photographic image; a CSS-masked logo mark (`.dev-row__logo-mark`, `background-color: var(--navy)` masked by the source logo file)
- **Icon:** The logo mark functions as an icon-equivalent; a trailing arrow icon on "View Developer"
- **Heading:** Yes, `<h3>`
- **Supporting text:** Yes — biography, line-clamped to 2 lines mobile / 1 line desktop
- **CTA:** Yes, "View Developer" with arrow, plus a "N Live Projects" meta label when `$dev_projects` is non-empty
- **Hover/focus:** Background wash (`background: var(--bg-section-alt)`) on the whole row; arrow `translateX(3px)` on the link — no shadow, no lift, deliberately different from the card-shell family
- **Visual shell:** None — this is the one entity-card in the inventory with no white/bordered/shadowed surface at all
- **Similar components:** Project Card (§3.1) shares the entity-card *role*; visually it is closer to the `.choose__list` disclosure-free list pattern (§3.14) than to any card
- **Implementation notes:** This component was restructured earlier in the current session (previously `.dev-card`, a white-shell card matching the rest of the card family; `git status` at session start shows `pages/developers.php` and this file as modified). `[id^="developer-"]` anchor IDs are preserved and are linked to from `index.php` and `pages/communities.php` (`.comm-card__dev-link` fallback href, `project-card-helpers.php` is not the source of the anchor — the anchor target lives in `developer-card.php`)
- **Classification confidence:** High

### 3.3 Team Card
- **Selector(s):** `.team-card`, `.team-card__media`, `.team-card__body`, `.team-card__name`, `.team-card__role`, `.team-card__bio`
- **Source files:** `pages/about.php:85-112`
- **Source CSS:** `assets/css/about.css:149-188`
- **Appears on:** `pages/about.php` only
- **Shared/page-specific:** Page-specific, and markup-level duplicated (not a shared partial or loop) — two `<article class="team-card">` blocks written out individually
- **Static or data-generated:** Fully static, hand-authored HTML with named individuals (Haitham Mahdy, Saddam Barakat)
- **Approximate rendered instances:** 2
- **Content type:** Team member biography
- **Semantic role:** Informational/biographical block
- **User interaction:** None — no link, no button, anywhere in the component
- **Click destination:** None
- **Whole component clickable:** No — not clickable at all
- **Image:** Yes, portrait photo (`assets/images/HAITHAM.jpeg`, `Sadam.jpeg`), `width="960" height="1200"`
- **Icon:** No
- **Heading:** Yes, `<h3 class="team-card__name">`
- **Supporting text:** Yes — role label + full biography paragraph
- **CTA:** No
- **Hover/focus:** `translateY(-2px)` + shadow-soft on hover (`about.css:156`), despite having no interactive purpose — the whole card lifts on hover with nothing to click
- **Visual shell:** White surface, `var(--r-lg)` radius, border, `--shadow-sm` — same shell family as the card-shell group
- **Similar components:** Shares the visual shell with Project Card, Service Card, etc., but has no destination — see Section 9
- **Implementation notes:** The two instances are markup-duplicated, not templated — editing one team member requires manually editing the corresponding hand-written block
- **Classification confidence:** High

### 3.4 Mission/Vision Block
- **Selector(s):** `.mv-block`
- **Source files:** `pages/about.php:125-138`
- **Source CSS:** `assets/css/about.css:99-108`
- **Appears on:** `pages/about.php` only
- **Shared/page-specific:** Page-specific, markup-duplicated (2 hand-written blocks)
- **Static or data-generated:** Fully static
- **Approximate rendered instances:** 2 (Mission, Vision)
- **Content type:** Company mission/vision statement
- **Semantic role:** Informational block
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** No (uses `.eyebrow` label text, not an icon)
- **Heading:** Yes, `<h3>`
- **Supporting text:** Yes, one paragraph
- **CTA:** No
- **Hover/focus:** No hover state declared (no `:hover` rule for `.mv-block` in `about.css`) — this is the one card-shelled component confirmed to have *no* hover treatment
- **Visual shell:** White surface, `var(--r-lg)` radius, border, `--shadow-sm` — same family
- **Similar components:** Structurally close to Team Card (both static, both card-shelled, both non-interactive) but even simpler (no image)
- **Classification confidence:** High

### 3.5 Service Card
- **Selector(s):** `.service-card`, `.service-card__icon`, `.service-card__link`
- **Source files:** `pages/services.php:115-150`
- **Source CSS:** `assets/css/services.css:61-88`
- **Appears on:** `pages/services.php` only
- **Shared/page-specific:** Page-specific, markup-duplicated (4 hand-written blocks, no loop/data source)
- **Static or data-generated:** Fully static
- **Approximate rendered instances:** 4
- **Content type:** Service offering (Residential Sales, Commercial Sales, Investment Guidance, Transaction Support)
- **Semantic role:** Informational block with an embedded action
- **User interaction:** One internal text link, "Enquire"
- **Click destination:** `#enquire` (in-page anchor scroll to the contact form section)
- **Whole component clickable:** No — only the "Enquire" link is clickable, not the card body
- **Image:** No
- **Icon:** Yes, 48px icon-in-box (`.service-card__icon`)
- **Heading:** Yes, `<h3>`
- **Supporting text:** Yes, one paragraph
- **CTA:** Yes, "Enquire" with arrow icon
- **Hover/focus:** Card: `translateY(-2px)` + shadow-soft; link separately: color change + `translateX(3px)` icon shift
- **Visual shell:** White surface, `var(--r-lg)`, border, `--shadow-sm` — card-shell family
- **Similar components:** Near-identical DOM shape to Amenity Card and Method Card (icon-box + heading + paragraph); differs from Method Card by having an internal link rather than being a whole-card link
- **Classification confidence:** High

### 3.6 Method Card
- **Selector(s):** `.method-card`, `.method-card__icon`, `.method-card__label`, `.method-card__value`
- **Source files:** `pages/contact.php:47-67`
- **Source CSS:** `assets/css/contact.css:11-40`
- **Appears on:** `pages/contact.php` only
- **Shared/page-specific:** Page-specific, markup-duplicated (3 hand-written blocks)
- **Static or data-generated:** Fully static
- **Approximate rendered instances:** 3 (Call, WhatsApp, Email)
- **Content type:** Contact method
- **Semantic role:** Action trigger
- **User interaction:** The entire component is one `<a>` element
- **Click destination:** `tel:+971504217299`, `https://wa.me/971504217299`, `mailto:info@smbdubai.net` respectively — all three are real, functioning destinations, not placeholders
- **Whole component clickable:** Yes — confirmed, `<a class="method-card" href="...">` wraps the entire content
- **Image:** No
- **Icon:** Yes, 48px icon-in-box
- **Heading:** No `<h3>` — uses `.method-card__label` (a `<span>`, not a heading element) + `.method-card__value`
- **Supporting text:** The "value" line functions as both label and content (phone number / "Message us directly" / email address)
- **CTA:** The whole card is the CTA; no separate CTA sub-element
- **Hover/focus:** `translateY(-2px)` + shadow-soft; `.method-card__value` also changes to `gold-dark` on hover (`contact.css:31`)
- **Visual shell:** White surface, `var(--r-lg)`, border, `--shadow-sm` — card-shell family
- **Similar components:** Same icon-box shape as Service Card/Amenity Card, but functionally an Action Component (§4.C) rather than Informational (§4.B) because the whole element is a working link and its only purpose is to trigger a contact action
- **Implementation notes:** Uses no heading element at all — see Section 11 for the heading-hierarchy implication
- **Classification confidence:** High

### 3.7 Category Card
- **Selector(s):** `.category-card`, `.category-card__icon`, `.category-card__text`, `.category-card__arrow`
- **Source files:** `index.php:144-191` (6), `pages/services.php:166-197` (4, inside `.audience__grid`), `pages/communities.php:107-154` (6, inside `.categories__grid` under "Explore by Lifestyle")
- **Source CSS:** `assets/css/home.css:181-208`
- **Appears on:** 3 pages (home, services, communities)
- **Shared/page-specific:** Shared CSS class, but markup is independently hand-written on each page (not a loop, not a shared PHP partial) — 16 total hand-written instances
- **Static or data-generated:** Fully static on all 3 pages
- **Approximate rendered instances:** 16 (6 + 4 + 6)
- **Content type:** Property category (home: Apartments/Villas/etc.), audience segment (services: First-Time Buyers/Owners/etc.), or lifestyle filter (communities: Waterfront Living/Family/etc.) — **three different content purposes reusing one component**
- **Semantic role:** Mixed — on home/services, functions as an action (scrolls to contact form); on communities, presented as a filter/navigation option that does not yet function as one
- **User interaction:** Whole component is one `<a>`
- **Click destination:** Home instances → `#enquire`; Services instances → `#enquire`; Communities instances → literal `href="#"` with an `aria-label` noting "(filtered view to be added)" (`pages/communities.php:107,115,123,131,139,147`)
- **Whole component clickable:** Yes
- **Image:** No
- **Icon:** Yes, icon-in-box, plus a separate trailing arrow icon
- **Heading:** Yes, `<h3>` nested inside `.category-card__text`
- **Supporting text:** Yes, one short line
- **CTA:** The whole card is the CTA (no separate CTA sub-element; the arrow is decorative/directional, not a distinct link)
- **Hover/focus:** `translateY(-2px)` + shadow-soft; arrow separately shifts `translateX(3px)` and changes color to `gold-dark`
- **Visual shell:** White surface, `var(--r-lg)`, border, `--shadow-sm` — card-shell family, horizontal layout (icon left, text center, arrow right) rather than the vertical icon-above-heading layout used by Service Card/Amenity Card
- **Similar components:** Structurally identical to Method Card (icon-box + text, whole-card link) but horizontal-with-arrow rather than icon-above-text
- **Implementation notes:** The 6 Communities-page instances are the placeholder-labeled ones described in Section 9/11; the 10 Home/Services instances are functioning anchor links, not placeholders, though all 16 point to a generic contact form regardless of which category was clicked
- **Classification confidence:** High for structure; Medium for semantic role (mixed action/navigation intent — see Section 4 note)

### 3.8 Community Card (homepage)
- **Selector(s):** `.community-card`, `.community-card__content`, `.community-card__cta`
- **Source files:** `index.php:207-248`
- **Source CSS:** `assets/css/home.css:213-243`
- **Appears on:** `index.php` only — "Featured communities" section
- **Shared/page-specific:** Page-specific, markup-duplicated (6 hand-written blocks)
- **Static or data-generated:** Fully static; the 6 named locations (Downtown Dubai, Saadiyat Island, Al Marjan Island, Aljada, Al Zorah, Fujairah Waterfront) do not correspond to entries in `data/projects.json` or any other data source found — these are freestanding editorial labels, not resolved from the projects/developers dataset
- **Approximate rendered instances:** 6
- **Content type:** Named geographic community/destination
- **Semantic role:** Presented as an entity/navigation card (image-led, per-location heading, "Explore" CTA)
- **User interaction:** Whole component is one `<a>`
- **Click destination:** `#enquire` for all 6 — none links to a community-specific page (no such pages exist in the current route list)
- **Whole component clickable:** Yes
- **Image:** Yes, full-bleed background image with a dark gradient overlay, `alt=""` (decorative — the heading text supplies the name)
- **Icon:** No
- **Heading:** Yes, `<h3>`, styled white, overlaid on the image
- **Supporting text:** No body paragraph — only the heading and the "Explore" CTA label
- **CTA:** Yes, "Explore" with arrow, styled in gold, uppercase
- **Hover/focus:** Image `scale(1.04)` on hover; arrow shifts `translateX(3px)`
- **Visual shell:** No white surface, no border, no visible shadow — image-led overlay card, `aspect-ratio: 4/3`, `var(--r-lg)` radius only
- **Similar components:** Visually distinct from every other card in the inventory (only component using a full-bleed image-with-gradient-overlay treatment); functionally closest to Project Card in intent (presenting a place to explore) but with no working per-item destination
- **Implementation notes:** Despite the name "community," this is unrelated to `.comm-card` (Project Card, §3.1) — different class prefix, different file, different visual treatment, different data source (static labels vs. `data/projects.json`)
- **Classification confidence:** High for structure; Medium for semantic role, since it visually presents as an entity/navigation card but has no real per-entity destination (see Section 9)

### 3.9 Insight Card
- **Selector(s):** `.insight-card`, `.insight-card__media`, `.insight-card__tag`, `.insight-card__excerpt`, `.insight-card__date`
- **Source files:** `index.php:335-364`
- **Source CSS:** `assets/css/home.css:290-313`
- **Appears on:** `index.php` only — "Latest Insights"
- **Shared/page-specific:** Page-specific, markup-duplicated (3 hand-written blocks)
- **Static or data-generated:** Fully static
- **Approximate rendered instances:** 3
- **Content type:** Editorial/blog article summary
- **Semantic role:** Presented as an entity/navigation card (article preview)
- **User interaction:** Two links — a decorative image-wrapper link (`aria-hidden="true" tabindex="-1"`, correctly removed from the accessibility tree to avoid a duplicate stop) and the heading text link
- **Click destination:** Both links point to literal `href="#"`; each carries a descriptive `aria-label` explicitly noting "(article to be added)" (`index.php:341,351,361`)
- **Whole component clickable:** No — only the heading text is an operable link for keyboard/AT users (the image link is intentionally non-focusable)
- **Image:** Yes, `loading="lazy"`, explicit `width`/`height`
- **Icon:** No
- **Heading:** Yes, `<h3>` wrapping the `<a>`
- **Supporting text:** Yes — tag label, excerpt paragraph, date/read-time line
- **CTA:** No separate CTA element — the heading itself is the link
- **Hover/focus:** Image `scale(1.03)` on hover; heading link color-shifts on hover
- **Visual shell:** No white surface/border/shadow on the card itself — only the image has a radius; text sits directly on the section background
- **Similar components:** Closest in intent to Project Card / Community Card (entity preview leading to a dedicated page) but is the only one of the three with no functioning destination at all
- **Implementation notes:** Blog/article pages do not exist anywhere in the route list (`.htaccess`) or page inventory — confirms these are intentionally-flagged stubs, not broken links to missing pages
- **Classification confidence:** High

### 3.10 Testimonial Card
- **Selector(s):** `.testimonial-card`, `.testimonial-card__mark`
- **Source files:** `index.php:293-322`
- **Source CSS:** `assets/css/home.css:270-286`
- **Appears on:** `index.php` only
- **Shared/page-specific:** Page-specific, markup-duplicated (3 hand-written blocks)
- **Static or data-generated:** Fully static
- **Approximate rendered instances:** 3
- **Content type:** Client testimonial quote
- **Semantic role:** Informational/social-proof block
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** No — uses a large decorative typographic quote mark (`&ldquo;`, `aria-hidden="true"`) in place of an icon
- **Heading:** No heading element; uses semantic `<figure>/<blockquote>/<figcaption>`
- **Supporting text:** Yes — quote body, name, role
- **CTA:** No
- **Hover/focus:** No hover rule declared for `.testimonial-card` in `home.css`
- **Visual shell:** White surface, `var(--r-lg)`, border, `--shadow-sm` — card-shell family
- **Similar components:** Shares the shell with Team Card and Mission/Vision Block (all three are static, non-interactive, card-shelled); is the only component in the inventory using `<figure>/<blockquote>` semantics instead of a generic `<article>`/`<div>`
- **Classification confidence:** High

### 3.11 Facts Item
- **Selector(s):** `.facts__item`, `.facts__icon`, `.facts__value`, `.facts__label`
- **Source files:** `templates/project-template.php:286-301`, `projects/damac-islands2.php:112-146`
- **Source CSS:** `assets/css/main.css:507-526`
- **Appears on:** Every project page (18 template-driven + `damac-islands2.php` standalone = 19)
- **Shared/page-specific:** Shared (defined once in `main.css`, rendered by the shared template for 18 pages, plus duplicated by hand in the one standalone page)
- **Static or data-generated:** Data-generated on the 18 template pages (from each project's `facts` array, always padded/truncated to exactly 4 — `project-template.php:279-284`); hand-written but structurally identical on `damac-islands2.php`
- **Approximate rendered instances:** Exactly 4 per project page × 19 pages
- **Content type:** Quick property fact (tenure, unit type, handover date, community size)
- **Semantic role:** Informational block
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** Yes, circular icon (`.facts__icon`, `border-radius: 50%`, distinct from the rounded-square icon-box used elsewhere)
- **Heading:** No heading element — `.facts__value` (bold, large) + `.facts__label` (muted, smaller), both `<p>`
- **Supporting text:** The label functions as supporting text
- **CTA:** No
- **Hover/focus:** No hover rule declared
- **Visual shell:** No card shell — sits directly in a horizontal row (`.facts__row`) with no per-item background, border, or shadow; the only visual container is the circular icon
- **Similar components:** Same "icon + value + label" DOM shape as Stat Card, but Stat Card has a full card shell and Facts Item does not
- **Classification confidence:** High

### 3.12 Stat Card
- **Selector(s):** `.stat-card`, `.stat-card__icon`, `.stat-card__value`, `.stat-card__label`
- **Source files:** `templates/project-template.php:330-339`, `projects/damac-islands2.php:163-183`
- **Source CSS:** `assets/css/main.css:535-553`
- **Appears on:** Every project page (19)
- **Shared/page-specific:** Shared (same pattern as Facts Item)
- **Static or data-generated:** Data-generated on 18 pages (from `overview.cards`, padded/truncated to exactly 3 — `project-template.php:314-317`); hand-written but identical structure on the standalone page
- **Approximate rendered instances:** Exactly 3 per project page × 19 pages
- **Content type:** Overview statistic (bedroom count, built-up area, amenity count)
- **Semantic role:** Informational block
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** Yes, rounded-square icon-box, `56px`, `var(--r-md)`
- **Heading:** No — `.stat-card__value` + `.stat-card__label`, both `<p>`
- **Supporting text:** The label
- **CTA:** No
- **Hover/focus:** `translateY(-2px)` + shadow-soft (`main.css:543`)
- **Visual shell:** White surface, `var(--r-lg)`, border, `--shadow-sm` — card-shell family (despite having no click action at all — hover feedback is present with nothing to click)
- **Similar components:** Same DOM shape as Amenity Card and Method Card
- **Classification confidence:** High

### 3.13 Amenity Card
- **Selector(s):** `.amenity-card` (rendered as `<li>`), `.amenity-card__icon`
- **Source files:** `templates/project-template.php:400-411`, `projects/damac-islands2.php:228-267`
- **Source CSS:** `assets/css/main.css:590-608`
- **Appears on:** Every project page (19)
- **Shared/page-specific:** Shared
- **Static or data-generated:** Data-generated, variable length per project (`amenities.items`, no fixed padding — `project-template.php:386-389` falls back to 4 placeholder items only if the array is completely empty); `damac-islands2.php` hand-codes exactly 8
- **Approximate rendered instances:** Variable per project (damac-islands2 = 8); not independently verified across the other 18 records
- **Content type:** Community/project amenity category (Water Features, Sports & Fitness, Wellness, etc.)
- **Semantic role:** Informational block
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** Yes, rounded-square icon-box, `48px`
- **Heading:** Yes, `<h3>`
- **Supporting text:** Yes, one short description
- **CTA:** No
- **Hover/focus:** `translateY(-2px)` + shadow-soft
- **Visual shell:** White surface, `var(--r-lg)`, border, `--shadow-sm` — card-shell family
- **Similar components:** Near-identical DOM shape to Service Card (icon-above-heading-above-paragraph); is a `<li>` inside a `<ul class="amenities__grid">`, i.e., semantically a list item rather than an `<article>`
- **Classification confidence:** High

### 3.14 Place Card
- **Selector(s):** `.place-card` (rendered as `<li>`), `.place-card__icon`, `.place-card__time`
- **Source files:** `templates/project-template.php:445-459`, `projects/damac-islands2.php:285-317`
- **Source CSS:** `assets/css/main.css:634-651`
- **Appears on:** Every project page (19)
- **Shared/page-specific:** Shared
- **Static or data-generated:** Data-generated, always padded/truncated to exactly 4 (`project-template.php:422-432`)
- **Approximate rendered instances:** Exactly 4 per project page × 19 pages
- **Content type:** Nearby destination + approximate driving time
- **Semantic role:** Informational block
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** Yes, rounded-square icon-box on a translucent/blurred background (this section sits on a dark navy band, `backdrop-filter: blur(8px)` — the one amenity-style component rendered in a dark context)
- **Heading:** Yes, `<h3>`
- **Supporting text:** Travel time line with a small clock icon
- **CTA:** No
- **Hover/focus:** Background/border opacity increase on hover (`main.css:639`) — no lift/translate, unlike the white-surface card family
- **Visual shell:** Translucent white overlay (`rgba(255,255,255,0.04)`) with a light border — visually distinct from the white-opaque card-shell family because it sits on a dark background
- **Similar components:** Same DOM shape (icon + heading + one line of supporting text) as Amenity Card, but a different color treatment because of its dark context
- **Classification confidence:** High

### 3.15 Gallery Item
- **Selector(s):** `.gallery__item`, `.gallery__item--featured` (rendered as `<figure>`)
- **Source files:** `templates/project-template.php:364-379`, `projects/damac-islands2.php:196-215`
- **Source CSS:** `assets/css/main.css:559-588`
- **Appears on:** Every project page (19)
- **Shared/page-specific:** Shared
- **Static or data-generated:** Data-generated, always padded/truncated to exactly 4 with the first treated as "featured" (`project-template.php:345-354`)
- **Approximate rendered instances:** Exactly 4 per project page × 19 pages
- **Content type:** Lifestyle/project photography
- **Semantic role:** Purely decorative/illustrative — no heading, no text, no icon, no link
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** Yes — this is the entire content of the component
- **Icon:** No
- **Heading:** No
- **Supporting text:** No
- **CTA:** No
- **Hover/focus:** Image `scale(1.02)` on hover
- **Visual shell:** No background/border/shadow — only `overflow:hidden` + radius on the image itself
- **Similar components:** No other component in the inventory is purely an image with zero text/heading/icon
- **Classification confidence:** High

### 3.16 District Strip Item
- **Selector(s):** `.districts__list li`, `.districts__dot`
- **Source files:** `templates/project-template.php:262-276` (conditional — only rendered when `$districts['enabled'] === true`), `projects/damac-islands2.php:94-108` (always present)
- **Source CSS:** `assets/css/main.css:475-505`
- **Appears on:** Project pages only where the project data enables it (verified condition in code; not verified which of the 18 data records actually enable it), always on `damac-islands2.php`
- **Shared/page-specific:** Shared
- **Static or data-generated:** Data-generated on template pages (`districts.items`), hand-written but identical structure on the standalone page
- **Approximate rendered instances:** 8 on `damac-islands2.php`; unknown count on other project pages pending data verification
- **Content type:** Named sub-district within a master community
- **Semantic role:** Informational label
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** No (a small dot `::before`/`.districts__dot` indicates "now launching" status, not a content icon)
- **Heading:** No — plain uppercase text label
- **Supporting text:** N/A
- **CTA:** No
- **Hover/focus:** No hover rule
- **Visual shell:** None — plain text in a horizontal list on a solid navy band; not card-styled at all
- **Similar components:** No visual similarity to any card component; included here because it is a repeated content block that could otherwise be mistaken for a card family member due to being inside a project page's repeated-section rhythm
- **Classification confidence:** High for structure; Medium for total instance count (only directly verified on 1 of 19 pages)

### 3.17 Why-Item
- **Selector(s):** `.why-item`, `.why-item__num`
- **Source files:** `index.php:112-131` ("Why SMB"), `pages/about.php:151-170` ("Our Values")
- **Source CSS:** `assets/css/home.css:165-176`
- **Appears on:** 2 pages, different section headings, same CSS class
- **Shared/page-specific:** Shared CSS class; markup independently hand-written on each page (not a shared PHP partial)
- **Static or data-generated:** Fully static on both pages
- **Approximate rendered instances:** 4 (home) + 4 (about) = 8
- **Content type:** Home: company differentiators ("Right Decision First," etc.); About: core values ("Transparency," etc.) — two different content purposes sharing one component
- **Semantic role:** Informational block
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** No — uses a large typographic number (`01`–`04`) in place of an icon
- **Heading:** Yes, `<h3>`
- **Supporting text:** Yes, one paragraph
- **CTA:** No
- **Hover/focus:** No hover rule declared
- **Visual shell:** None — no background, border, or shadow; sits directly on the section background
- **Similar components:** Same numbered-item pattern as Step (§3.18), but Step additionally has a circular numeral badge with its own shell, and a desktop connector line
- **Classification confidence:** High

### 3.18 Step
- **Selector(s):** `.step`, `.step__num`
- **Source files:** `index.php:261-280` ("Buying process"), `pages/about.php:229-248` ("How we work")
- **Source CSS:** `assets/css/home.css:245-268`
- **Appears on:** 2 pages, different headings, same CSS class
- **Shared/page-specific:** Shared CSS class; independently hand-written markup on each page
- **Static or data-generated:** Fully static on both pages
- **Approximate rendered instances:** 4 (home) + 4 (about) = 8
- **Content type:** Home: buying-process steps (Discover/Consult/Reserve/Own); About: working-method steps (Understand/Advise/Shortlist/Support) — two different content purposes sharing one component
- **Semantic role:** Informational block (ordered process)
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** No — a circular numeral badge (`.step__num`, white background, `--shadow-sm`, its own small shell) instead of an icon
- **Heading:** Yes, `<h3>`
- **Supporting text:** Yes, one paragraph
- **CTA:** No
- **Hover/focus:** No hover rule on `.step` itself
- **Visual shell:** The `<li>` itself has no shell; only the numeral badge is shelled (white circle with shadow); a decorative connector line is drawn between badges at desktop width (`home.css:264-267`)
- **Similar components:** Structurally close to Why-Item; rendered as `<li>` inside `<ol class="steps__grid">`, giving it (correctly) an ordered-list semantic that Why-Item's `<div>` grid does not have
- **Classification confidence:** High

### 3.19 Choose List Item
- **Selector(s):** `.choose__list li` (counter-based numbering via `::before`)
- **Source files:** `pages/about.php:186-217` (5 items), `pages/communities.php:170-207` (6 items), `pages/developers.php:283-314` (5 items)
- **Source CSS:** `assets/css/about.css:123-136`
- **Appears on:** 3 pages
- **Shared/page-specific:** Shared CSS class (defined once in `about.css`, loaded by all 3 pages via their `$page_styles` arrays); markup independently hand-written on each page
- **Static or data-generated:** Fully static on all 3 pages
- **Approximate rendered instances:** 5 + 6 + 5 = 16
- **Content type:** About: reasons to choose SMB; Communities: steps to choosing a location; Developers: how SMB helps with developer selection — three different content purposes sharing one component
- **Semantic role:** Informational block (this is the pattern referenced in the current session's earlier audit as one of the two places the site already breaks from the card-shell default)
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** No — a CSS `counter()` generating `"0" counter(choose)` (`about.css:130-134`), i.e., an auto-incrementing two-digit number, not a static numeral like Step
- **Heading:** Yes, `<h3>`
- **Supporting text:** Yes, one paragraph
- **CTA:** No
- **Hover/focus:** No hover rule
- **Visual shell:** None — plain `<li>` with a top border rule (`border-top: 1px solid var(--border-light)`) between items and a matching bottom border on the last item; no background, no shadow, no radius
- **Similar components:** Same content role as Why-Item/Step (an informational, ordered set of points) but with a rule-divided-list visual treatment instead of either a shelled or shell-less grid item
- **Classification confidence:** High

### 3.20 FAQ Item
- **Selector(s):** `.faq-item` (native `<details>`/`<summary>`), `.faq-item__indicator`, `.faq-item__body`
- **Source files:** `pages/services.php:210-264` (5 items), `pages/communities.php:219-284` (6 items)
- **Source CSS:** `assets/css/services.css:105-147`
- **Appears on:** 2 pages
- **Shared/page-specific:** Shared CSS class; markup independently hand-written on each page (not a loop)
- **Static or data-generated:** Fully static; each page also emits a matching FAQPage JSON-LD block (`services.php:267-277`, `communities.php:287-298`)
- **Approximate rendered instances:** 5 + 6 = 11
- **Content type:** Frequently-asked question
- **Semantic role:** Disclosure component
- **User interaction:** Click/tap or keyboard `Enter`/`Space` on `<summary>` toggles visibility of `.faq-item__body`, using the browser's native `<details>` behavior — no custom JavaScript required
- **Click destination:** N/A (toggles in place, does not navigate)
- **Whole component clickable:** The `<summary>` row is clickable; the answer body is not
- **Image:** No
- **Icon:** A custom plus/minus indicator built from two `::before`/`::after` pseudo-elements that rotate on `[open]` (`services.css:126-139`), not an `<svg>` icon like the rest of the site
- **Heading:** No heading element — the question text sits directly inside `<summary>`
- **Supporting text:** The answer paragraph inside `.faq-item__body`
- **CTA:** No
- **Hover/focus:** `summary:hover` background tint; `summary:focus-visible` sets `outline-offset: -2px` (services.css:119) — an inward-offset focus ring, different from the site's global outward-offset default (see Section 11)
- **Visual shell:** White surface, `var(--r-lg)`, border, `--shadow-sm` — card-shell family, but the only member of that family using a native disclosure element rather than a link or static block
- **Similar components:** No structural equivalent elsewhere in the inventory
- **Classification confidence:** High

### 3.21 Off-Plan Checklist Item
- **Selector(s):** `.offplan__list li`
- **Source files:** `pages/services.php:79-96`
- **Source CSS:** `assets/css/services.css:33-40`
- **Appears on:** `pages/services.php` only
- **Shared/page-specific:** Page-specific
- **Static or data-generated:** Fully static, 4 items
- **Approximate rendered instances:** 4
- **Content type:** Off-plan advisory service inclusion
- **Semantic role:** Informational block
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** Yes, a small checkmark icon (`#i-check`), inline before the text, not boxed
- **Heading:** No
- **Supporting text:** The list item text itself
- **CTA:** No
- **Hover/focus:** None
- **Visual shell:** None — plain list item on a dark section background, white/translucent text
- **Similar components:** Simplest icon+text pattern in the inventory (no box around the icon, unlike every other icon-bearing component)
- **Classification confidence:** High

### 3.22 Intro Facts Pill
- **Selector(s):** `.intro-facts li`
- **Source files:** `pages/about.php:59-64`
- **Source CSS:** `assets/css/about.css:81-86`
- **Appears on:** `pages/about.php` only
- **Shared/page-specific:** Page-specific
- **Static or data-generated:** Fully static, 4 items
- **Approximate rendered instances:** 4
- **Content type:** Short company fact ("Established 2021," "Serving all seven emirates," etc.)
- **Semantic role:** Informational label
- **User interaction:** None
- **Click destination:** None
- **Whole component clickable:** No
- **Image:** No
- **Icon:** No
- **Heading:** No
- **Supporting text:** N/A — the pill text is the entire content
- **CTA:** No
- **Hover/focus:** None
- **Visual shell:** Pill-shaped (`border-radius: 999px`), light-gray background, border — a distinct "chip" shell, not the card-shell family
- **Similar components:** Same pill shape as the Pill-group radio labels (§3.24) and the `.hero__search-chips` links on the homepage hero, though none of these three share a CSS selector with each other
- **Classification confidence:** High

### 3.23 CTA Final Panel
- **Selector(s):** `.cta-final`, `.cta-final__bg`, `.cta-final__inner`, `.cta-final__buttons`, `.cta-final__contact`
- **Source files:** `index.php:370-392`, `pages/about.php:276-298`, `pages/services.php:281-303`, `pages/developers.php:319-338`, `pages/communities.php:302-321`, `pages/contact.php:215-234`
- **Source CSS:** `assets/css/home.css:315-350`
- **Appears on:** All 6 top-level pages (not project pages or developer-archive pages, which use a different closing section — see §3.25/§3.28)
- **Shared/page-specific:** Shared CSS class; markup independently hand-written on each of the 6 pages (not a shared PHP partial)
- **Static or data-generated:** Fully static per page (different background image, heading, and button labels each time, but identical structure)
- **Approximate rendered instances:** 6 (one per page, not a repeated grid item within a page)
- **Content type:** Page-closing call to action
- **Semantic role:** Action panel
- **User interaction:** Two buttons (`btn--accent`, `btn--ghost`) plus one inline text link
- **Click destination:** Varies per page — some `tel:`, some `https://wa.me/...`, some in-page `#enquire` anchors, one cross-page `contact.php#enquire`; all verified functional (no placeholder `#` links in this component)
- **Whole component clickable:** No — the panel itself is not a link; it contains 2-3 separate real links/buttons
- **Image:** Yes, full-bleed background image, `alt=""`, `aria-hidden="true"` (decorative)
- **Icon:** Yes, on the buttons (phone/WhatsApp icons)
- **Heading:** Yes, `<h2>`
- **Supporting text:** Yes, one paragraph
- **CTA:** Yes — this entire component's purpose is its CTA buttons
- **Hover/focus:** Standard `.btn` hover states apply; no hover on the panel itself
- **Visual shell:** Full-bleed dark navy panel with a background image at 25% opacity and a gradient overlay — this is a page-level section, not a grid-repeated card, and is visually unrelated to the white card-shell family
- **Similar components:** Structurally identical across all 6 pages (same class names, same layout), differing only in copy/links/background image
- **Classification confidence:** High

### 3.24 Pill-Group Radio (Enquiry Type)
- **Selector(s):** `.pill-group`, visually-hidden `<input type="radio">` + `<label>` pairs
- **Source files:** `pages/contact.php:100-115`
- **Source CSS:** `assets/css/contact.css:49-76`
- **Appears on:** `pages/contact.php` only
- **Shared/page-specific:** Page-specific
- **Static or data-generated:** Fully static, 5 options
- **Approximate rendered instances:** 5
- **Content type:** Form input option (Buying/Selling/Investment/Management/General)
- **Semantic role:** Form control, not a card
- **User interaction:** Standard radio-button selection, visually restyled as pills; keyboard-operable (native `<input type="radio">` under the hood)
- **Click destination:** N/A — sets form state, does not navigate
- **Whole component clickable:** Each pill's `<label>` is the clickable target for its paired hidden input
- **Image:** No
- **Icon:** No
- **Heading:** No (the `<fieldset><legend>Enquiry Type</legend>` provides the group label)
- **Supporting text:** No
- **CTA:** N/A
- **Hover/focus:** `label:hover` border/color change; `input:focus-visible + label` gets an explicit outline (fixed to `var(--navy)` earlier in the current session — `contact.css:74-76`)
- **Visual shell:** Pill shape (`border-radius: 999px`), border, light background; selected state uses solid navy fill
- **Similar components:** Same pill shape as Intro Facts Pill, but functionally a form control, not informational or navigational
- **Classification confidence:** High

### 3.25 Office Card
- **Selector(s):** `.office-card`, `.office-card__list`, `.office-card__label`, `.office-card__value`, `.office-card__note`
- **Source files:** `pages/contact.php:130-167`
- **Source CSS:** `assets/css/contact.css:79-106`
- **Appears on:** `pages/contact.php` only
- **Shared/page-specific:** Page-specific
- **Static or data-generated:** Fully static
- **Approximate rendered instances:** 1 — **this is not a repeated/collection component**, it is a single `<aside>` panel
- **Content type:** Office contact information (address, phone, email, working hours)
- **Semantic role:** Informational panel
- **User interaction:** Two inline links inside the list (phone `tel:`, email `mailto:`); the panel itself is not a link
- **Click destination:** N/A for the panel; the two inline links are functional
- **Whole component clickable:** No
- **Image:** No
- **Icon:** Yes, one per list row (pin/phone/mail/clock), not boxed — plain inline icon before the text, similar treatment to Off-Plan Checklist Item
- **Heading:** Yes, `<h3 id="office-title">`
- **Supporting text:** A 4-row definition-style list plus a closing note paragraph
- **CTA:** No
- **Hover/focus:** No hover rule on `.office-card` itself
- **Visual shell:** White surface, `var(--r-xl)` (the larger radius token, not `--r-lg` like the rest of the family), `--shadow-soft` (the stronger shadow token, not `--shadow-sm`) — visually related to but not identical to the standard card-shell recipe
- **Similar components:** Visually closest to the Hero Lead-Capture Card (§3.27), which also uses `--r-xl`/`--shadow-soft`/`--shadow-lift`-tier tokens rather than the standard card family's `--r-lg`/`--shadow-sm`
- **Implementation notes:** Because there is only one instance and it is not part of a repeated grid, whether to classify this as "a card" at all is genuinely ambiguous — see Section 9
- **Classification confidence:** Medium (structure is clear; classification as "card vs. panel" is inherently borderline — flagged explicitly per audit instructions)

### 3.26 Map Placeholder Frame
- **Selector(s):** `.map__frame`
- **Source files:** `pages/contact.php:179-189`
- **Source CSS:** `assets/css/contact.css:109-121`
- **Appears on:** `pages/contact.php` only
- **Shared/page-specific:** Page-specific
- **Static or data-generated:** Fully static, explicitly a placeholder (copy states "An interactive map will be embedded here once the verified office location pin is available")
- **Approximate rendered instances:** 1
- **Content type:** Placeholder for a future embedded map
- **Semantic role:** Informational panel with one embedded action
- **User interaction:** One button, "Open in Google Maps"
- **Click destination:** A real, functional Google Maps search URL (`pages/contact.php:186`) — not a placeholder link, despite the surrounding component being an acknowledged placeholder
- **Whole component clickable:** No — only the button is a link
- **Image:** No (a large centered pin icon instead)
- **Icon:** Yes, large (48px), centered, reduced opacity
- **Heading:** No heading element — `.map__placeholder-title` is a `<p>`
- **Supporting text:** Yes, explanatory paragraph
- **CTA:** Yes, "Open in Google Maps" button
- **Hover/focus:** Standard `.btn` hover on the button only
- **Visual shell:** Light-gray background (`var(--bg-section-alt)`, not white), border, `var(--r-xl)` — distinct from the white-surface card family
- **Similar components:** No close structural equivalent; unique centered-content placeholder frame
- **Classification confidence:** High

### 3.27 Hero Lead-Capture Card
- **Selector(s):** `.hero__card`, `#hero-form-card`
- **Source files:** `templates/project-template.php:224-236`, `projects/damac-islands2.php:78-89`
- **Source CSS:** `assets/css/main.css:414-419`
- **Appears on:** Every project page (19) — one per page, inside the hero
- **Shared/page-specific:** Shared
- **Static or data-generated:** Structural shell is shared/static; price value is data-generated on the 18 template pages
- **Approximate rendered instances:** 1 per project page × 19 (not a repeated grid item within a page)
- **Content type:** Starting price + lead-capture form
- **Semantic role:** Action panel (contains Enquiry Form, §3.28)
- **User interaction:** Full form (name/phone/email inputs + submit button)
- **Click destination:** Form submission (client-side only — see Section 11/main.js note)
- **Whole component clickable:** No — it's a form container, not a link
- **Image:** No
- **Icon:** No
- **Heading:** No heading element — uses `.price-label`/`.price` styled text
- **Supporting text:** Price footnote/disclaimer
- **CTA:** Yes, the form's submit button ("Enquire Now")
- **Hover/focus:** No hover on the card itself; standard field focus states apply inside
- **Visual shell:** White surface, `var(--r-xl)` (larger radius), `--shadow-lift` (the strongest shadow token in the system) — visually the most elevated "card" on the site, appropriate to its role as the primary conversion element
- **Similar components:** Shares `--r-xl` tier styling with Office Card and the `.lead-form--card` variant (§3.28)
- **Classification confidence:** High

### 3.28 Enquiry Form (shared partial, 2 variants)
- **Selector(s):** `.lead-form`, `.lead-form--card`, `.field`, `.field__error`, `.lead-form__success`
- **Source files:** `template-parts/enquiry-form.php` (shared partial)
- **Source CSS:** `assets/css/main.css:434-473`
- **Appears on:** Inside Hero Lead-Capture Card (§3.27, 'hero' variant) on 19 project pages; inside the "Enquire Now" closing section on the same 19 project pages ('card' variant); as the entire main form on `pages/contact.php` (hand-coded independently, not via this partial — see implementation note)
- **Shared/page-specific:** Shared partial for project pages; `pages/contact.php`'s form is visually identical (same `.lead-form--card` class, same field/label/error structure) but is hand-written directly in `contact.php:84-123`, not a `require` of this partial — confirmed by direct comparison of field IDs (`cf-*` prefix in contact.php vs. the partial's caller-supplied `$enquiry_form_field_prefix`)
- **Static or data-generated:** Structural shell is shared; per-page context (hidden fields for source page/project/developer attribution) is data-generated via `$enquiry_form_context`
- **Approximate rendered instances:** 2 per project page × 19 = 38, plus 1 independent instance on `contact.php` = 39 total form renders, using 2 different code paths (shared partial vs. hand-copied markup)
- **Content type:** Lead-capture form
- **Semantic role:** Action component
- **User interaction:** Text/tel/email inputs, optional textarea, submit button; client-side validation via `assets/js/main.js:172-246`
- **Click destination:** No navigation — on successful client-side validation, the form is hidden and a `.lead-form__success` panel is shown in place (`main.js:228-232`); **no backend endpoint is connected** (confirmed by the code comment at `main.js:228: /* Static preview: no backend endpoint is connected yet. */`)
- **Whole component clickable:** N/A (form, not a link)
- **Image:** No
- **Icon:** No
- **Heading:** No (labels only)
- **Supporting text:** Privacy note (hero variant only)
- **CTA:** Yes, submit button, label varies ("Enquire Now" vs. "Send Enquiry")
- **Hover/focus:** Standard field focus rings; button hover per `.btn` rules
- **Visual shell:** 'card' variant: white surface, `var(--r-xl)`, `--shadow-soft`; 'hero' variant has no shell of its own (it sits inside the Hero Lead-Capture Card's shell)
- **Similar components:** None structurally — this is the only form-type component in the inventory
- **Implementation notes:** The contact.php form additionally includes the Pill-Group radio (§3.24) and a required `message` field, which the partial's 'card' variant also supports (`enquiry-form.php:58-64`) — meaning contact.php's hand-written form appears to duplicate rather than reuse a capability the shared partial already has, though the pill-group enquiry-type selector itself has no equivalent in the shared partial at all
- **Classification confidence:** High for structure; the shared-vs-duplicated code path distinction is explicitly verified, not assumed

### 3.29 Sticky CTA
- **Selector(s):** `.sticky-cta`, `.sticky-cta__text`, `.sticky-cta__label`, `.sticky-cta__price`, `.sticky-cta__action`
- **Source files:** `includes/footer.php:86-95`
- **Source CSS:** `assets/css/main.css:742-770`, `assets/css/home.css:352-354`
- **Appears on:** Every page (rendered by the global footer include)
- **Shared/page-specific:** Fully shared, single include point
- **Static or data-generated:** Content varies via PHP variables the calling page can override (`$sticky_href`, `$sticky_label`, `$sticky_value`, `$sticky_action`); most pages use the footer's defaults ("UAE Property Advisory" / "Start a Conversation" / "Contact us"), project pages override with the price
- **Approximate rendered instances:** 1 per page (present in the DOM on every page; visibility is toggled by JavaScript based on scroll position, not always visually shown)
- **Content type:** Persistent floating contact prompt
- **Semantic role:** Action component
- **User interaction:** Entire component is one `<a>`; JS additionally intercepts the click on pages with an `#enquire` section to smooth-scroll and focus the first form field (`main.js:156-168`)
- **Click destination:** `$sticky_href` (defaults to `#enquire`)
- **Whole component clickable:** Yes
- **Image:** No
- **Icon:** Yes, one arrow icon
- **Heading:** No
- **Supporting text:** Label + value text
- **CTA:** The whole component is the CTA
- **Hover/focus:** Action text opacity fades on hover; the component is `aria-hidden="true" tabindex="-1"` by default and only becomes focusable/visible when JS toggles `is-visible` (`main.js:134-146`)
- **Visual shell:** Solid navy background, `var(--r-md)`/`var(--r-lg)` at different breakpoints, `--shadow-lift` — visually unrelated to the white card-shell family
- **Similar components:** No structural equivalent; unique fixed-position persistent element
- **Classification confidence:** High

## 4. Functional Classification

### A. Entity and Navigation Components
- **Project Card (§3.1)** — represents a distinct project entity with two working destinations (developer page, project page)
- **Developer Row (§3.2)** — represents a distinct developer entity with a working destination
- **Community Card (§3.8)** — presented with entity-card structure (image, heading, CTA) but its destination is a generic contact anchor for all 6 instances, not a per-community page — included here because of its structural role, with the destination caveat carried into Section 9
- **Insight Card (§3.9)** — presented with entity-card structure (article preview) but its destination is a placeholder `#` for all 3 instances

### B. Informational Components
- Facts Item (§3.11), Stat Card (§3.12), Amenity Card (§3.13), Place Card (§3.14), Gallery Item (§3.15, decorative-only), District Strip Item (§3.16), Why-Item (§3.17), Step (§3.18), Choose List Item (§3.19), Mission/Vision Block (§3.4), Team Card (§3.3 — informational despite depicting a person, because it has no click destination), Testimonial Card (§3.10), Off-Plan Checklist Item (§3.21), Intro Facts Pill (§3.22)
- Reason: none of these components navigate anywhere or trigger an action; each presents information for the reader to absorb in place

### C. Action Components
- Method Card (§3.6), Category Card (§3.7), CTA Final Panel (§3.23), Sticky CTA (§3.29), Enquiry Form (§3.28), Pill-Group Radio (§3.24), Hero Lead-Capture Card (§3.27, as the container for the form), Map Placeholder Frame's button (§3.26)
- Reason: each of these exists primarily to trigger a call, message, form submission, or navigation-as-conversion-step, rather than to convey standalone information

### D. Disclosure Components
- FAQ Item (§3.20)
- Reason: sole component whose core interaction is revealing/hiding content in place

### E. Structural or Decorative Containers
- The generic `.split` two-column layout (used in `about.php` intro/commitment, `services.php` intro/offplan, `developer-template.php` overview) is a layout primitive, not a component with its own content identity — it wraps other components/content but has no card-like identity of its own
- Office Card (§3.25) and Map Placeholder Frame (§3.26) sit closer to this category functionally (single informational panels) but retain card-shell styling — see Section 9 for the descriptive distinction

### F. Unclear or Mixed-Purpose Components
- **Category Card (§3.7)** — functions as a direct action on 2 pages (home, services) and as a not-yet-functional filter/navigation intent on 1 page (communities); the component's role changes depending on where it's used
- **Community Card (§3.8)** — visually an entity card, functionally an action (all destinations are the same generic contact anchor)
- **Office Card (§3.25)** — card-styled but singular, not part of a repeated collection; ambiguous whether "card" is the right description at all

## 5. Visual Pattern Matrix

| Component | Background | Border | Radius | Shadow | Padding | Image | Icon container | Heading size | Body text | CTA style | Hover translate | Hover shadow | Focus | Desktop layout | Mobile layout |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Project Card | White | `--border-light` | `--r-lg` | `--shadow-sm` | 24px | Yes (top) | — | 1.25rem | 0.9375rem muted | Text link | `-2px` | `--shadow-soft` | Default ring | Flex column | Flex column |
| Developer Row | None | None (rule divider) | None | None | 24-28px block | No | 44px circle (logo mask) | 1.0625rem | 0.875rem, line-clamped | Text link | None (bg wash only) | None | Default ring | Row | Stacked |
| Team Card | White | `--border-light` | `--r-lg` | `--shadow-sm` | 28px | Yes (top) | — | 1.25rem | 0.9375rem muted | None | `-2px` | `--shadow-soft` | N/A (no link) | Column | Column |
| Mission/Vision Block | White | `--border-light` | `--r-lg` | `--shadow-sm` | 40x36px | No | — | n/a (`<h3>` default) | 1rem | None | N/A | N/A (no hover rule) | N/A | Grid cell | Stacked |
| Service Card | White | `--border-light` | `--r-lg` | `--shadow-sm` | 32px | No | 48px square | 1.125rem | 0.9375rem muted | Text link + arrow | `-2px` | `--shadow-soft` | Default ring | Column | Column |
| Method Card | White | `--border-light` | `--r-lg` | `--shadow-sm` | 24x28px | No | 48px square | none (`<span>`) | value line | Whole card | `-2px` | `--shadow-soft` | Default ring | Row→Column→Row | Row |
| Category Card | White | `--border-light` | `--r-lg` | `--shadow-sm` | 24x28px | No | 48px square | 1.0625rem | 0.875rem muted | Whole card + arrow | `-2px` | `--shadow-soft` | Default ring | Row | Row |
| Community Card | None | None | `--r-lg` | None (gradient overlay instead) | 24px overlay | Yes (full-bleed) | — | 1.25rem, white | none | "Explore" + arrow | Image scale `1.04` | N/A | Default ring | Overlay | Overlay |
| Insight Card | None | None | `--r-lg` (image only) | None | 0 (text on section bg) | Yes (top) | — | 1.1875rem | 0.9375rem muted | Heading link | Image scale `1.03` | N/A | Default ring | Column | Column |
| Testimonial Card | White | `--border-light` | `--r-lg` | `--shadow-sm` | 32px | No | — | n/a | 1rem | None | N/A | N/A (no hover rule) | N/A | Column | Column |
| Facts Item | None | None | None | None | 0 (row gap) | No | 48px circle | n/a | 0.9375rem muted | None | N/A | N/A | N/A | Row of 4 | 1-2 col grid |
| Stat Card | White | `--border-light` | `--r-lg` | `--shadow-sm` | 24x32px | No | 56px square | n/a | 0.9375rem muted | None | `-2px` | `--shadow-soft` | N/A (no link) | Row | Row |
| Amenity Card | White | `--border-light` | `--r-lg` | `--shadow-sm` | 32px | No | 48px square | 1.125rem | 0.9375rem muted | None | `-2px` | `--shadow-soft` | N/A (no link) | Grid cell | Grid cell |
| Place Card | White (translucent, on dark bg) | `--border-dark` | `--r-lg` | None (blur instead) | 32px | No | 48px square (translucent) | 1.125rem, white | 0.9375rem gold | None | None | N/A | N/A (no link) | Grid cell | Grid cell |
| Gallery Item | None | None | `--r-lg`/`--r-xl` | None | 0 | Yes (entire content) | — | n/a | none | None | Image scale `1.02` | N/A | N/A (no link) | Asymmetric grid | Snap-scroll strip |
| District Strip Item | None (navy band) | None | None | None | 0 (inline row) | No | None | n/a | Uppercase label | None | N/A | N/A | N/A | Row, centered | Wrap |
| Why-Item | None | None | None | None | 0 | No | None (numeral text) | 1.125rem | 0.9375rem muted | None | N/A | N/A | N/A | Grid cell | Grid cell |
| Step | None (`<li>` itself) | None | None | None | 0 | No | 52px circle (numeral badge) | 1.125rem | 0.9375rem muted | None | N/A | N/A | N/A | Grid + connector line | Grid |
| Choose List Item | None | Top rule only | None | None | 22px block | No | None (CSS counter) | 1.0625rem | 0.9375rem muted | None | N/A | N/A | N/A | Row (number + text) | Row |
| FAQ Item | White | `--border-light` | `--r-lg` | `--shadow-sm` | 22-28px | No | 28px circle (+/− indicator) | none (in `<summary>`) | 0.9375rem | None | N/A | N/A | Inward-offset ring | Block | Block |
| Off-Plan Checklist Item | None (dark section) | None | None | None | 0 | No | None (inline icon) | n/a | 0.9875rem, white/translucent | None | N/A | N/A | N/A | Column list | Column list |
| Intro Facts Pill | `--bg-section-alt` | `--border-light` | 999px (pill) | None | 8x18px | No | None | n/a | 0.8125rem | None | N/A | N/A | N/A | Wrap row | Wrap row, centered |
| CTA Final Panel | Navy + bg image | None | None | None (full-bleed) | Section padding | Yes (full-bleed, 25% opacity) | — | `<h2>` | 1.0625rem, translucent white | 2 buttons | N/A (page section) | N/A | Default ring | Centered | Centered |
| Pill-Group Radio | `--bg-page` / navy (selected) | `--border-light` / navy (selected) | 999px (pill) | None | 9x18px | No | None | n/a | 0.875rem | N/A (form control) | N/A | N/A | Explicit navy ring | Wrap row | Wrap row |
| Office Card | White | `--border-light` | `--r-xl` | `--shadow-soft` | 40x32px | No | None (inline icon) | 1.25rem | 0.9875rem | 2 inline links | N/A | N/A (no hover rule) | Default ring (on inline links) | Panel | Panel |
| Map Placeholder Frame | `--bg-section-alt` | `--border-light` | `--r-xl` | None | 48x24px | No | 48px, no box, low opacity | none (`<p>`) | 0.9375rem muted | 1 button | N/A | N/A | Default ring (on button) | Centered | Centered |
| Hero Lead-Capture Card | White | `--border-light` | `--r-xl` | `--shadow-lift` | 40x32px | No | — | none (styled price text) | footnote | Full form | N/A | N/A | Field-level rings | Fixed width | Full width |
| Sticky CTA | Navy | None | `--r-md`/`--r-lg` | `--shadow-lift` | 16-24px | No | None | n/a | Label + value | Whole component | N/A | N/A | Gold ring (dark-context override) | Fixed corner | Full-width bar |

**15 of 28 components** share the exact "white / `--border-light` / `--r-lg` / `--shadow-sm` / `-2px` hover-lift / `--shadow-soft` hover-shadow" recipe verbatim: Project Card, Team Card, Mission/Vision Block, Service Card, Method Card, Category Card, Testimonial Card, Stat Card, Amenity Card, FAQ Item (8 of these have the hover-lift active; Team Card and Mission/Vision Block and Testimonial Card and FAQ Item either lack the hover rule or apply it without a corresponding interactive purpose — see per-component notes above for which).

This section documents observed similarity only; per audit instructions, similarity is not stated to be inherently problematic.

## 6. Structural Pattern Matrix

| DOM shape | Components using it exactly | File/selector evidence |
|---|---|---|
| Icon-box + heading + paragraph | Service Card, Amenity Card | `services.css:61-77` vs. `main.css:590-608` — near-identical selector structure, independently declared in 2 files |
| Icon-box + heading + paragraph + CTA link | (Service Card has this variant with the added `.service-card__link`) | `services.css:79-85` |
| Icon-box + label + value, whole-component link | Method Card, Category Card (Category Card additionally has a separate trailing arrow icon) | `contact.css:11-24` vs. `home.css:181-194` |
| Icon (circle) + value + label, no shell | Facts Item | `main.css:511-520` |
| Icon-box (square) + value + label, card shell | Stat Card | `main.css:537-550` |
| Numeral + heading + paragraph, no shell | Why-Item, Step (Step's numeral has its own circular badge shell; Why-Item's does not) | `home.css:166-176` vs. `home.css:248-258` |
| CSS-counter numeral + heading + paragraph, rule-divided list | Choose List Item | `about.css:123-136` |
| Image + overlay heading + text CTA, whole-component link | Community Card | `home.css:213-240` |
| Image (top) + heading (link) + tag + excerpt + date | Insight Card | `home.css:293-311` |
| Image (top) + heading + meta list + price + CTA link | Project Card | `communities.css:27-73` |
| Index + logo + heading (link) + description + meta/CTA | Developer Row | `developers.css` (post-fix Featured-developers block) |
| Heading (`<summary>`) + expandable body | FAQ Item | `services.css:105-141` |
| Pure image, no text | Gallery Item | `main.css:572-577` |
| Whole-component link, no heading, no CTA sub-element | Method Card, CTA-adjacent (Sticky CTA is similar but has an explicit label/value/action structure inside) | `contact.css:11-40` vs. `main.css:752-763` |
| Data-loop-generated (PHP `foreach`) | Project Card (all 3 call sites), Facts Item, Stat Card, Amenity Card, Place Card, Gallery Item, District Strip Item | `project-template.php` loops; `pages/communities.php:91`; `templates/developer-template.php:211` |
| Hand-repeated (no loop, same markup copy-pasted per instance) | Team Card, Mission/Vision Block, Service Card, Method Card, Category Card, Community Card, Insight Card, Testimonial Card, Why-Item, Step, Choose List Item, FAQ Item, Off-Plan Checklist Item, Intro Facts Pill | Every page-specific static section listed in Section 3 |
| Explicit `require`-per-instance (shared partial file, but caller writes one `require` line per record instead of a PHP loop) | Developer Row | `pages/developers.php:69-267` — 20 individual `<?php $dev = ...; require ...; ?>` blocks, not a `foreach` |

The clearest exact structural duplication is **Service Card vs. Amenity Card**: both are `icon-box (48px, `--r-sm` or `--r-md`, `--bg-section-alt` background) → <h3> → <p class="muted">`, declared independently in `services.css:70-77` and `main.css:600-608` respectively, with no shared selector or mixin between them.

## 7. Current Component Families

### Family: Icon-Box Informational Cards
- **Included:** Service Card, Amenity Card, Stat Card (icon size/radius token varies slightly: 48px/`--r-sm` for Service and Amenity, 56px/`--r-md` for Stat)
- **Shared structural characteristics:** icon-in-a-box above a heading above a paragraph, inside a white card shell
- **Shared CSS characteristics:** `--r-lg` card radius, `--border-light`, `--shadow-sm`/`--shadow-soft` hover pair, `--bg-section-alt` icon background
- **Existing differences:** Service Card adds a CTA link Amenity/Stat Card do not have; Stat Card's icon box is larger and uses `--r-md` instead of `--r-sm`
- **Shared code or visual-only:** Visual-only — each is declared in a separate CSS file (`services.css`, `main.css`) with its own selector; no shared class or partial links them

### Family: Icon-Box Action Rows
- **Included:** Method Card, Category Card
- **Shared structural characteristics:** icon-box + text, whole component is one link, horizontal layout
- **Shared CSS characteristics:** Same `--r-lg`/`--border-light`/`--shadow-sm` shell as the family above
- **Existing differences:** Category Card adds a distinct trailing arrow sub-element with its own hover transform; Method Card does not
- **Shared code or visual-only:** Visual-only — `contact.css` and `home.css`, no shared selector

### Family: Numbered/Ordered Informational Items
- **Included:** Why-Item, Step, Choose List Item
- **Shared structural characteristics:** a number (typographic, circular-badge, or CSS-counter) followed by a heading and a paragraph, used to present an ordered or enumerated set of points
- **Shared CSS characteristics:** None literally shared — three separate numbering mechanisms (plain text, badge, CSS `counter()`)
- **Existing differences:** Only Step is a true `<ol>` list item with ordered semantics; Why-Item is a plain `<div>` in a grid; Choose List Item is an `<li>` with rule-divider styling instead of a grid cell
- **Shared code or visual-only:** Visual-only in intent (all three are "here is a numbered set of points") but not in implementation — 3 independent CSS declarations across `home.css` and `about.css`

### Family: Entity/Destination Cards (Data-Driven)
- **Included:** Project Card, Developer Row
- **Shared structural characteristics:** represents a real-world entity from a JSON data source, contains a link (or links) to that entity's own page
- **Shared CSS characteristics:** None — Developer Row deliberately uses no card shell, Project Card uses the full white-shell treatment
- **Existing differences:** Project Card is rendered via a PHP `foreach` loop across all 3 call sites; Developer Row is rendered via 20 explicit individual `require` statements rather than a loop
- **Shared code or visual-only:** Both are genuinely shared PHP partials (`template-parts/project-card.php`, `template-parts/developer-card.php`), i.e., shared code, not just visual similarity — though the two partials share no code or styling with each other

### Family: Project-Template Repeated Sections
- **Included:** Facts Item, Stat Card, Amenity Card, Place Card, Gallery Item, District Strip Item
- **Shared structural characteristics:** all are rendered by loops inside `templates/project-template.php`, each looping over a different sub-array of the same project record (`facts`, `overview.cards`, `amenities.items`, `location.places`, `gallery.images`, `districts.items`)
- **Shared CSS characteristics:** Facts/Stat/Amenity/Place share the icon-box treatment (though Facts uses a circle and no card shell, unlike the other three); Gallery Item and District Strip Item share no visual treatment with the rest of the family at all
- **Existing differences:** significant — this "family" is really 3 sub-groups: shelled icon-box items (Stat, Amenity, Place), a shell-less icon item (Facts), and 2 non-icon items (Gallery, District Strip)
- **Shared code or visual-only:** Shared code — all 6 are generated by the same shared template file (`project-template.php`) and its standalone twin (`damac-islands2.php`), even though their visual treatments differ from each other

### Family: Static Placeholder-Labeled Navigation
- **Included:** the 6 Communities-page Category Card instances (§3.7), the 3 Insight Card instances (§3.9)
- **Shared structural characteristics:** each carries a descriptive `aria-label` explicitly acknowledging the destination doesn't exist yet ("filtered view to be added" / "article to be added")
- **Shared CSS characteristics:** None — different components, different classes
- **Existing differences:** Category Card's placeholders are visually identical to its 10 non-placeholder siblings on other pages; Insight Card's placeholders are the only instances of that component (all 3 are placeholders)
- **Shared code or visual-only:** Visual/content pattern only — this is a documentation convenience grouping, not a shared implementation

## 8. Repetition and Duplication Findings

### Visual Repetition
- **Same radius (`--r-lg`) + same border (`--border-light`) + same shadow (`--shadow-sm`) + same white background:** Project Card (`communities.css:29-31`), Team Card (`about.css:151-153`), Mission/Vision Block (`about.css:100-102`), Service Card (`services.css:63-65`), Method Card (`contact.css:13-15`), Category Card (`home.css:183-185`), Testimonial Card (`home.css:275-277`), Stat Card (`main.css:539-541`), Amenity Card (`main.css:594-596`), FAQ Item (`services.css:106-108`) — 10 components, exact 4-property match, each independently declared
- **Same hover transform (`translateY(-2px)`) + same hover shadow (`--shadow-soft`):** Project Card, Service Card, Method Card, Category Card, Stat Card, Amenity Card (6 components with an active hover-lift matching this exact pair) — `communities.css:34`, `services.css:68`, `contact.css:18`, `home.css:188`, `main.css:543`, `main.css:598`
- **Same icon-box treatment (48px, rounded, `--bg-section-alt` background, `--navy` icon color):** Service Card (`services.css:70-74`), Method Card (`contact.css:20-24`), Category Card (`home.css:190-194`), Amenity Card (`main.css:600-604`) — 4 independent declarations of the same visual recipe

### Structural Duplication
- `templates/project-template.php` and `projects/damac-islands2.php` contain the same 8 section structures (hero, districts, facts, overview, gallery, amenities, location, enquire) with matching class names, confirmed line-by-line in Section 3's per-component file references. `damac-islands2.php` is not a wrapper of the template — it is a full, independent copy of what the template now generates.
- The `foreach` loop in `pages/communities.php:91-93` and the loop in `templates/developer-template.php:211-213` both call `template-parts/project-card.php` with the same three setup variables (`$project`, `$project_card_fallback_image`, `$project_card_dev_href_fallback`) — genuine shared code, not duplicated markup.
- `pages/developers.php:69-267` repeats the identical 6-line setup block (`$dev = developer_canonical(...); $dev_slug = ...; $dev_projects = ...; $dev_rec = ...; $dev_url = ...; $dev_display = ...; require developer-card.php;`) 20 times by hand rather than looping over an array of developer names.

### CSS Duplication
- The icon-box declaration (`display:inline-flex; align-items:center; justify-content:center; width:48px; height:48px; border-radius:var(--r-sm); background:var(--bg-section-alt); color:var(--navy);`) appears near-verbatim in `services.css:70-74`, `contact.css:20-24`, `home.css:190-194`, and `main.css:600-604` — 4 separate declarations, no shared class.
- The card-shell declaration (white background + `--r-lg` + `--border-light` + `--shadow-sm`, with the `-2px`/`--shadow-soft` hover pair) appears near-verbatim in the 6 files listed under "Same hover transform" above.

### Semantic Duplication
- **Why-Item** renders two different content sets ("Why SMB" differentiators on the homepage vs. "Our Values" on About) through the exact same component and CSS class — this is genuine reuse of one component for two distinct information types, not two components that happen to look alike.
- **Step** renders two different process descriptions (home's buying process vs. About's working method) through the same component and class, likewise genuine reuse.
- **Choose List Item** is reused across 3 pages for 3 different lists of points (why choose SMB / how to choose a community / how SMB helps with developers), again genuine reuse of one component.
- Category Card, discussed above, is the clearest case of one component serving three distinct semantic purposes (property type / audience segment / lifestyle filter) depending on the page.

## 9. Components That Are Not Actually Cards

- **Facts Item (§3.11)** — no card shell at all (no background, border, or shadow); functionally a **statistic**, styled as a plain icon-and-text row.
- **Why-Item (§3.17)** — no card shell; functionally an **information block** in an enumerated list.
- **Step (§3.18)** — no card shell on the item itself (only the numeral badge is shelled); functionally a **process/list item**, reinforced by its native `<ol>`/`<li>` semantics.
- **Choose List Item (§3.19)** — no card shell, rule-divided; functionally a **list item**.
- **District Strip Item (§3.16)** — no card shell, plain text in a colored band; functionally a **navigation-adjacent label**, not informational content in its own right (it labels a sub-area, nothing more).
- **Off-Plan Checklist Item (§3.21)** — no card shell; functionally a **list item** (a checklist row).
- **Intro Facts Pill (§3.22)** — pill shell, not the card-family shell; functionally a **decorative/informational label chip**.
- **Pill-Group Radio (§3.24)** — pill shell; functionally a **form input**, not content at all.
- **Method Card, despite having the card-shell CSS** — functionally an **action** (a styled link), not an entity or an information summary; included here because its "card" appearance is arguably misleading about its role — it behaves exactly like a button.
- **CTA Final Panel (§3.23)** — despite being visually substantial, this is a **page section**, not a repeatable card — it never appears more than once per page and is never part of a grid/collection.
- **Gallery Item (§3.15)** — no informational content whatsoever; functionally a **decorative image container**.

This section is descriptive only; per audit instructions, no replacement is proposed.

## 10. Genuine Card Components

- **Project Card (§3.1)** qualifies: represents a distinct entity (a real-estate project), contains a grouped summary (image, name, developer, location, property types, price context via its parent grid), leads to a genuinely separate destination (the project's own page), and stands independently in 3 different repeated collections across the site.
- **Developer Row (§3.2)** qualifies functionally (distinct entity, grouped summary, separate destination, stands in a repeated collection of 20) even though it deliberately does not use card *styling* — "genuine card" is assessed here by function per the audit's classification principle (Section content-purpose/interaction/semantic-role/destination/hierarchy/reuse), not by visual shell.
- **FAQ Item (§3.20)** arguably qualifies as a "card" in the loose sense of being a self-contained, independently-repeatable unit with its own shell, though its primary behavior (disclosure) is categorized separately in Section 4.D — included here for completeness since it does meet "can stand independently in a repeated collection."
- **Community Card (§3.8)** and **Insight Card (§3.9)** are visually built as genuine cards (grouped summary, standalone in a repeated collection) but their destinations are not yet real per-entity destinations — see Section 9's note and Section 4's Group A entry for the caveat carried through consistently.

## 11. Accessibility and Interaction Notes

Only component-system-relevant items are listed; broader site-wide accessibility findings are out of scope for this report.

- **Method Card (§3.6) has no heading element** — `.method-card__label` is a `<span>`, not an `<h3>` or similar. Screen-reader users navigating by heading will not encounter "Call us" / "WhatsApp" / "Email" as headings, unlike every other titled card component in the inventory.
- **FAQ Item's focus ring is inward-offset** (`outline-offset: -2px`, `services.css:119`) while the site's global default (fixed earlier this session) is outward-offset (`outline-offset: 4px`, `main.css:113-117`) — a documented inconsistency in focus-ring presentation between this component and the rest of the card family.
- **Placeholder destinations, confirmed distinct from functioning links:**
  - True `href="#"` placeholders with descriptive `aria-label` acknowledging the gap: Insight Card (×3, `index.php:341,351,361`), Communities-page Category Card (×6, `communities.php:107,115,123,131,139,147`)
  - Functioning but generic anchor destinations (not literal placeholders, but not per-item destinations either): Home/Services Category Card (×10, all → `#enquire`), Community Card (×6, all → `#enquire`)
  - Fully functioning, distinct destinations: Project Card, Developer Row, Method Card, all CTA Final Panel links, Map Placeholder Frame's Google Maps button
- **Nested interactive elements:** Project Card contains 2 separate links (developer name + "View Project") inside one `<article>` — not a nested-interactive-element violation (neither link contains the other), but worth noting as the only card in the inventory with 2 independent link destinations rather than 0 or 1.
- **Whole-component vs. partial-component links, confirmed per component:** Method Card, Category Card, Community Card, and Sticky CTA wrap their entire content in one `<a>`. Service Card, Insight Card (heading only), and Project Card (2 separate links) do not — the card body itself is not clickable in those cases, only a sub-element is.
- **Heading-level consistency within the card system:** every card-shell component that has a heading uses `<h3>` (Team Card, Mission/Vision Block, Service Card, Category Card, Amenity Card, Place Card, Office Card, Developer Row via `<h3><a>`), maintaining a consistent level; Method Card and FAQ Item are the two shelled components with no heading element at all.
- **Accordion semantics:** FAQ Item uses native `<details>`/`<summary>`, which carries correct implicit ARIA semantics (`group`/expand-collapse) without any custom `aria-expanded` wiring — confirmed no custom JS is involved in the toggle behavior (`main.js` contains no FAQ-related code).
- **Touch-target size, component-system-relevant only:** Pill-Group Radio labels (§3.24) measure approximately 33-34px tall by the declared padding/font-size (`contact.css:63-69`); every whole-component-link card (Method Card, Category Card, Community Card) meets or exceeds typical touch-target guidance based on their padding/content size.

## 12. Responsive Behavior Notes

- **Project Card, Developer Row, Community Card, Insight Card, Testimonial Card:** single column on mobile, expanding to 2-4 columns at increasing breakpoints (`communities.css:75-76`; `developers.css` mobile→768px; `home.css:242-243`; `home.css:313`; `home.css:288`) — this stacking pattern is consistent across the whole card-grid family.
- **Developer Row** is the only entity component with a genuinely different mobile *structure*, not just a column-count change: it stacks header/description/meta vertically below 768px and switches to a horizontal single-row layout at 768px+ (`developers.css`, confirmed in this session's implementation).
- **Facts Item:** 1 column → 2 columns (600px) → 4 columns (992px) (`main.css:522-526`) — a 3-step breakpoint progression, more granular than most other grids in the inventory, which mostly go straight from 1 to their final column count at a single breakpoint.
- **Gallery Item:** the only component with a genuinely different *interaction model* on mobile vs. desktop — horizontal scroll-snap strip below 768px, CSS grid with an asymmetric featured-image span above it (`main.css:566-588`).
- **Method Card:** column count changes (1→3 at 768px) but its *internal* layout also changes — icon+text is a horizontal row on mobile, switches to icon-above-text vertical stacking at 768-1099px, then back to horizontal at 1100px+ (`contact.css:11-40`) — the only component with a non-monotonic layout change across breakpoints (row→column→row).
- **Category Card:** consistently a horizontal row at every breakpoint; only the grid column count changes (1→2→3) — no internal layout change, unlike Method Card.
- **Choose List Item, Why-Item, Step:** all reflow from single-column to multi-column grids at their respective breakpoints with no internal structural change.
- **Contact-page-specific:** `.methods__grid` (Method Card's grid) and `.contact-layout` (form + Office Card) both reflow independently at 768px/992px/1100px, with `.method-card`'s internal row/column/row change (above) layered on top of its own grid's column change — two independent responsive systems affecting the same component at overlapping breakpoints.
- **Overflow handling:** Gallery Item's mobile snap-scroll strip is the only intentional horizontal-scroll pattern found among card-system components; no other component was found to rely on horizontal overflow.
- **Order changes:** no component in the inventory was found to reorder its internal elements (e.g., via `order:` or flex-direction reversal) between breakpoints, except Method Card's row/column/row transform, which is a display-mode change rather than an explicit reorder.

No component's responsive behavior was modified as part of this audit.

## 13. Evidence-Based Conclusions

- **Functionally distinct components:** Project Card, Developer Row, Team Card, Mission/Vision Block, Method Card, FAQ Item, Enquiry Form, and Gallery Item are each functionally distinct from every other component in the inventory — no other component shares their combination of content purpose, interaction model, and destination type.
- **Only visually distinct:** Service Card and Amenity Card are functionally near-identical (both present a titled, described concept with an icon, no distinct destination) but are visually distinguished only by Service Card's additional CTA link — otherwise their DOM shape and CSS shell are the same pattern declared twice.
- **Share the same underlying shell (white/`--r-lg`/`--border-light`/`--shadow-sm`):** the 10 components listed at the top of Section 8's "Visual Repetition" — this is the largest confirmed shell-sharing group in the codebase.
- **Share the same DOM structure (icon-box + heading + paragraph):** Service Card and Amenity Card, confirmed byte-for-byte structurally equivalent apart from Service Card's CTA link.
- **Already intentionally differentiated:** Developer Row (deliberately shell-less, restructured this session specifically to break from the card-shell pattern), Place Card (deliberately styled for its dark-band context rather than reusing the white shell), Gallery Item (deliberately shell-less as a pure image), Choose List Item (deliberately a rule-divided list rather than a card grid, used consistently across 3 pages).
- **Areas that would require a future design decision** (not made in this report): whether Category Card's 3 different semantic uses (property type / audience / lifestyle filter) should remain one component or diverge; whether Community Card and Insight Card's placeholder/generic destinations should be resolved into real per-entity pages or the components' presentation adjusted to match their current non-entity behavior; whether Office Card and Map Placeholder Frame should be considered part of the "card system" at all, given each is a singleton, not a repeated collection item.
- **Areas that could later be consolidated technically without changing appearance:** the icon-box CSS declaration duplicated 4 times (Section 8, CSS Duplication) and the white-card-shell declaration duplicated 10 times could, in principle, be extracted into shared classes with zero visual change, since the declarations are already pixel-identical across their current independent copies. This is a factual observation about the CSS as written, not a recommendation to act on it.

## 14. Decision Map for the Next Phase

| Component | Current primary classification | Keep under review as a genuine card | Shares visual shell with | Shares structure with | Requires future design decision | Requires future engineering consolidation review | Evidence location |
|---|---|---|---|---|---|---|---|
| Project Card | A. Entity/Navigation | Yes | Team Card, Service Card, Method Card, Category Card, Testimonial Card, Stat Card, Amenity Card, FAQ Item, Mission/Vision Block | Insight Card (image+heading+meta+CTA) | No | Yes | `communities.css:24-76`, `template-parts/project-card.php` |
| Developer Row | A. Entity/Navigation | Yes | None (deliberately shell-less) | Choose List Item (rule-divided list) | No | No | `developers.css`, `template-parts/developer-card.php` |
| Team Card | B. Informational | Unclear | Project Card family (above) | Mission/Vision Block, Testimonial Card | Yes | Yes | `about.css:149-188` |
| Mission/Vision Block | B. Informational | Unclear | Project Card family (above) | Team Card | No | Yes | `about.css:99-108` |
| Service Card | B. Informational (with embedded action) | Unclear | Project Card family (above) | Amenity Card (exact) | Yes | Yes | `services.css:61-88` |
| Method Card | C. Action | No (functions as a button) | Project Card family (above) | Category Card | Yes | Yes | `contact.css:11-40` |
| Category Card | F. Unclear/Mixed | Unclear | Project Card family (above) | Method Card | Yes | Yes | `home.css:181-208` |
| Community Card | A. Entity/Navigation (destination caveat) | Unclear | None (unique overlay treatment) | Project Card, Insight Card (loosely) | Yes | No | `home.css:213-243` |
| Insight Card | A. Entity/Navigation (destination caveat) | Unclear | None (no shell) | Community Card (loosely) | Yes | No | `home.css:290-313` |
| Testimonial Card | B. Informational | Unclear | Project Card family (above) | None exact | No | Yes | `home.css:270-286` |
| Facts Item | B. Informational (not a card) | No | None | Stat Card (loosely, icon+value+label) | No | Yes | `main.css:507-526` |
| Stat Card | B. Informational | Unclear | Project Card family (above) | Facts Item, Amenity Card | Yes | Yes | `main.css:535-553` |
| Amenity Card | B. Informational | Unclear | Project Card family (above) | Service Card (exact) | Yes | Yes | `main.css:590-608` |
| Place Card | B. Informational | Unclear | None (dark-context variant) | Amenity Card (loosely) | No | No | `main.css:634-651` |
| Gallery Item | B. Informational (decorative) | No | None | None | No | No | `main.css:559-588` |
| District Strip Item | B. Informational (label) | No | None | None | No | No | `main.css:475-505` |
| Why-Item | B. Informational (not a card) | No | None | Step (loosely) | No | No | `home.css:165-176` |
| Step | B. Informational (not a card) | No | None | Why-Item (loosely) | No | No | `home.css:245-268` |
| Choose List Item | B. Informational (not a card) | No | None | Developer Row (loosely) | No | No | `about.css:123-136` |
| FAQ Item | D. Disclosure | Unclear | Project Card family (above) | None exact | No | No | `services.css:105-147` |
| Off-Plan Checklist Item | B. Informational (not a card) | No | None | None | No | No | `services.css:33-40` |
| Intro Facts Pill | B. Informational (chip, not a card) | No | Pill-Group Radio (shape only) | None | No | No | `about.css:81-86` |
| CTA Final Panel | C. Action (page section) | No | None | None (unique per-page section) | No | No | `home.css:315-350` |
| Pill-Group Radio | C. Action (form control) | No | Intro Facts Pill (shape only) | None | No | No | `contact.css:49-76` |
| Office Card | E./F. Structural or Unclear | Unclear | Hero Lead-Capture Card (`--r-xl`/`--shadow-soft` tier) | None | Yes | No | `contact.css:79-106` |
| Map Placeholder Frame | B. Informational + embedded action | No | None | None | No | No | `contact.css:109-121` |
| Hero Lead-Capture Card | C. Action | No (singleton container) | Office Card (`--r-xl` tier) | Enquiry Form (contains it) | No | No | `main.css:414-419` |
| Enquiry Form | C. Action | No | None | None (contact.php duplicates markup rather than sharing partial) | No | Yes | `template-parts/enquiry-form.php`, `pages/contact.php:84-123` |
| Sticky CTA | C. Action | No | None | None | No | No | `includes/footer.php:86-95` |

This table is a factual map for a future decision process, not a decision itself, per audit instructions.

## 15. Open Questions

- Do all 18 `data/projects.json` records actually populate `districts.enabled = true`, or is District Strip Item (§3.16) rendered on a subset of the 18 template-driven project pages? Not verifiable without reading the JSON data file directly.
- Do all 18 project records have exactly the amenity-item counts implied by `damac-islands2.php`'s 8, or does the count vary meaningfully across the dataset? Not verifiable without reading the JSON data file directly.
- Is `pages/contact.php`'s hand-written form (§3.28 implementation note) intentionally independent of `template-parts/enquiry-form.php`, or is this an unintentional divergence? Not answerable from the code alone — no comment in either file explains the decision.
- Are the 6 Community Card destinations (§3.8) intended to eventually link to dedicated community pages, or is routing everything to the contact form a permanent design decision? Not stated anywhere in the codebase.
- Is the Insight Card section (§3.9) intended to launch with real blog/article pages, or is "Latest Insights" a permanent teaser section with no article destinations? Not stated anywhere in the codebase.
- Was Office Card (§3.25) ever intended to be one of several office locations (i.e., a genuine repeated card), or is a single-location layout the permanent intended state? Not determinable from a single instance.
- Do `data/projects.schema.json` and `data/developers.schema.json` (not opened in this audit) impose any constraints relevant to future component consolidation (e.g., a fixed vs. variable amenities count)? Not verified.

## Final Response

1. **File created:** `CARD-SYSTEM-AUDIT.md` (this file, at the project root)
2. **Components identified:** 28 distinct active component patterns (Section 3), plus 3 confirmed-inactive CSS-only patterns noted for awareness (`.comm-row`/`.comm-rows` in `communities.css`, `.criteria__grid` and `.browse-item`/`.browse__grid`/`.dev-intro` in `developers.css` — verified via grep against all active page markup, zero matches found)
3. **Main functional categories found:** A. Entity/Navigation (4 components, 2 with a destination caveat), B. Informational (14 components), C. Action (7 components), D. Disclosure (1 component), E. Structural/Decorative (layout primitives only, no dedicated component), F. Unclear/Mixed (2 components flagged explicitly, with several others marked "Unclear" in the Section 14 decision map pending a future design decision)
4. **Inspection limitations:** 17 of 19 project-page wrapper files and 19 of 20 developer-page wrapper files were not individually opened (pattern inferred from 2 verified samples + the shared templates they call, per Section 1); `data/projects.json` and `data/developers.json` were not read field-by-field (counts obtained programmatically; field-level content such as per-project amenity counts and `districts.enabled` values was not verified across the full dataset — carried into Section 15's Open Questions); `data/*.schema.json` files were not opened.
5. **Confirmation no project code was modified:** Confirmed. No HTML, PHP, CSS, JavaScript, JSON, or asset file was edited, renamed, refactored, or otherwise changed during this audit. The only file created or written was `CARD-SYSTEM-AUDIT.md`.
