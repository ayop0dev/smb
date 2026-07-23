# Project Pages — Implementation Notes

## Architecture

```
data/projects.json            ← only content source (18 frozen project records)
        ↓
includes/project-data.php     ← load / decode / validate / retrieve (no HTML)
        ↓
project-template.php          ← the entire page: SEO, JSON-LD, hero, facts,
        ↓                       overview, gallery, amenities, location, enquiry
{slug}.php                    ← 18 three-line pages, one per project
```

`damac-islands2.php` is the approved visual/structural reference and was **not**
modified. It remains a separate, standalone page.

## Data source and validation contract

- `data/projects.json` is the only source of project content. Nothing in the
  template, the loader, or the individual pages hardcodes project-specific
  facts, copy, or images.
- `data/projects.schema.json` is the validation contract and was synchronized
  to match the frozen JSON exactly: `sticky_cta` now requires only `value`;
  `overview` only `title`/`paragraphs`/`cards`; `gallery` only `title`/`images`;
  `amenities` only `title`/`items`; `location` only `title`/`description`/
  `background_image`/`places`; `cta` is an empty object (its copy is
  template-level UI text — see below).
- Before implementation, `projects.json` was validated against the
  synchronized schema: 18 projects, 18 unique slugs, exactly 4 facts and
  exactly 3 overview cards per project, no undeclared fields, no external
  image URLs anywhere in the dataset.

## `includes/project-data.php`

Three functions, nothing else:

- `load_projects_data(): array` — reads `data/projects.json` by absolute path,
  decodes with `JSON_THROW_ON_ERROR`, caches the result in a static variable
  for the rest of the request. On a missing/unreadable file or malformed JSON
  it logs the real cause via `error_log()` and returns a plain-text HTTP 500
  — no paths or stack traces are ever sent to the client.
- `get_all_projects(): array` — the full project list.
- `get_project_by_slug(string $slug): ?array` — the matching record, or
  `null` if the slug isn't found. The loader never invents data and never
  falls back to any other file; turning a `null` into a 404 is the
  template's job.

## `project-template.php`

Every project page's entire content lives here. In order: resolves the
project (404 if missing) → SEO variables → sticky CTA / price → requires
`header.php` → JSON-LD → hero → districts (conditional) → quick facts →
overview → gallery → amenities → location → enquiry → requires `footer.php`.

It reuses `damac-islands2.php`'s exact markup, CSS classes, section IDs,
form IDs/JS hooks, and copy for anything not driven by project data (contact
details, form success/error copy, button labels are all identical to the
DAMAC page). No new component system, no new CSS file — `main.css` already
contains every class the DAMAC page uses, generically, so no project-page
stylesheet exists to duplicate.

### Template-level fixed copy (lives here, never in `projects.json`)

Sticky CTA label/action, overview eyebrow/button, gallery/amenities/location
eyebrows, the location note, and the CTA eyebrow/title/description are all
hardcoded in the template, per the implementation spec. Contact phone,
email, WhatsApp link, office address, and the lead-form success/error copy
are also template-level (copied verbatim from the DAMAC reference) and are
never expected in project data.

### Icon mapping

`project_icon_symbol(string $icon): string` maps the dataset's icon
identifiers (`home`, `bed`, `waves`, …) to the shared SVG sprite's symbol IDs
(`#i-home`, `#i-bed`, `#i-waves`, …) defined in `header.php`. The dataset's
`info` identifier and any unrecognized identifier both fall back to the
existing `#i-deed` (document) symbol — a dedicated `#i-info` symbol was
briefly added to `header.php` for this purpose and was then removed in
favor of reusing an existing icon, so no project-only icon lives in the
shared header sprite.

### Placeholder behavior (safe handling of missing data)

| Section | Missing data → |
|---|---|
| Quick facts | always exactly 4 positions; empty value/label → "Available on request" / "Project details" |
| Overview | empty title → "Discover {Project Name}"; empty paragraphs → one generic sentence; always exactly 3 cards, empty fields → "Available on request" / "Additional project details" |
| Gallery | always exactly 4 positions, featured slot first; missing images fill with the centralized placeholder and alt text "Project image for {Project Name}" |
| Amenities | empty items array → 4 render-time placeholder cards ("Project Amenity" / "Full amenity details are available on request."); per-item empty fields get the same placeholder text |
| Location | always exactly 4 place-card positions; empty name/time → "Key Destination" / "Travel details available on request", generic pin icon; the "Approximate driving times." note is suppressed entirely when all 4 cards are placeholders |
| Districts | hidden entirely unless `districts.enabled === true` **and** it has an intro and at least one item — none of the 18 current projects enable it, so it never renders today, but the code path is implemented and ready |
| Starting price | empty → "Available on request" in the hero card **and** the sticky CTA (never written back to JSON); JSON-LD gets no `offers` block unless `structured_data.price` is a positive number |

Nothing here mutates `projects.json` — every fallback is computed at render
time only.

### Image fallback behavior

`assets/images/project-placeholder.jpg` is the intended centralized local
placeholder and will be used automatically once it exists. It does not exist
yet, so the template currently falls back to the existing DAMAC hero image
(`assets/images/hero-villa-pool.jpg`) — clearly commented in
`project-template.php` as a **temporary** implementation fallback to be
replaced once real project photography is assigned. This same fallback is
reused for the hero image, all empty gallery slots, the location background,
and the structured-data image, so there is exactly one fallback path to swap
later, not one per section. All image paths (project-supplied or fallback)
are passed through `project_safe_local_path()`, which refuses any remote URL
or path-traversal attempt and substitutes the fallback instead — defense in
depth on top of the schema's own `^(?!https?://)` constraint.

### Safe output

Every visible string is escaped with `header.php`'s existing `smb_e()`
helper (`htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`) before being echoed.
JSON-LD is built as a PHP array and emitted via `json_encode()`, matching the
DAMAC reference. No project-data value is ever written into an HTML
attribute, script, or URL unescaped.

## Individual project pages

Each of the 18 pages (one per slug in `data/projects.json`, excluding
Samana Ocean Views and Keturah Ardh, which are not in the dataset) is exactly:

```php
<?php
$project_slug = 'exact-project-slug';
require __DIR__ . '/project-template.php';
```

No page contains header/footer logic, HTML, forms, SEO generation, JSON-LD,
or project data — all of that lives in `project-template.php` exactly once.

## Adding a future project safely

1. Add a new record to `data/projects.json` following the existing shape
   exactly (all required keys, even if some values are empty strings/`{}`/
   `[]` placeholders) — the frozen schema in `data/projects.schema.json` is
   the contract to validate against.
2. Create one new `{slug}.php` file with the three-line pattern above.
3. Do not add a new CSS file, a new template, or duplicate any markup —
   the shared template already handles missing/partial data safely.
4. If the new project enables `districts`, populate `districts.intro` and
   at least one item — the rendering code already supports it.

## Files that must not be edited manually

- `damac-islands2.php` — standalone reference page, outside this system.
- `includes/project-data.php` — data access only; do not add HTML or
  project-specific logic here.
- `data/projects.json` — edit only by adding/updating project records that
  conform to `data/projects.schema.json`; never hand-patch template copy
  into it (`cta`, eyebrows, button text, etc. belong in the template).
- Any `{slug}.php` file — these must stay three lines; put shared behavior
  changes in `project-template.php` instead.
