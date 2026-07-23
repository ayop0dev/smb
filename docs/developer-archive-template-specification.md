# Developer Archive Template — Implementation Specification

## Status and Authority

This document is the single source of truth for implementing the Developer Archive Template in the current SMB Real Estate Brokers project.

The specification is limited to behavior, structure, data, components, and responsive patterns confirmed in the current codebase. It does not authorize a redesign, a new visual pattern, a new card variant, additional sections, or unrelated refactoring.

All implementation decisions are fixed in this document. The implementing agent must not select alternate filenames, routes, data contracts, copy, fallback rules, components, or presentation patterns.

## Execution Contract

This document is an implementation contract.

The implementing agent must execute this specification exactly as written.

Every required behavior described in this document must be implemented.

Anything not explicitly described in this document must not be added.

No assumptions are permitted.

No creative decisions are permitted.

No speculative implementation is permitted.

No alternative implementations are permitted.

The implementing agent must not reinterpret requirements or replace them with preferred architectural patterns.

When implementation is complete, stop immediately.

## Confirmed Current Project Context

The current website is a PHP project with:

- Shared global page chrome in `header.php` and `footer.php`.
- Shared project data loading and lookup functions in `includes/project-data.php`.
- Project records in `data/projects.json`, constrained by `data/projects.schema.json`.
- Individual project entry files that set `$project_slug` and require `project-template.php`.
- An existing Developers listing page in `developers.php`.
- An existing Communities page in `communities.php`.
- Global styles in `assets/css/main.css`.
- Existing internal-page hero and split-layout styles in `assets/css/about.css`.
- Existing developer-page styles in `assets/css/developers.css`.
- Existing project-card styles in `assets/css/communities.css`.
- Shared behavior in `assets/js/main.js`, loaded once by `footer.php`.

The Developer Archive implementation must follow the individual-project architecture:

- A root-level shared template named `developer-template.php`.
- One root-level PHP wrapper for each developer.
- Each wrapper sets only `$developer_slug` and requires `developer-template.php`.
- Static PHP filenames provide routing; no router, rewrite rule, query-string route, directory route, or front controller is added.
- Developer metadata is loaded through a dedicated include that follows the organization and failure behavior of `includes/project-data.php`.

The existing inline Communities project card remains the visual and markup reference. It is not converted into a new design or a new card variant.

## 1. Page Purpose

The Developer Archive page represents one current developer.

Its only purposes are:

1. Identify the current developer through the existing internal-page hero pattern.
2. Present a Developer Overview containing one project image and the current developer biography.
3. Present only the projects whose project data belongs to the current developer.

The page must not include new marketing sections, comparison sections, criteria sections, FAQs, lifestyle sections, calls to action, forms, statistics, or other content that is not required above.

If `$developer_slug` is missing, empty, or does not resolve to a record in `data/developers.json`, the shared template must return HTTP 404 and render the existing controlled not-found presentation pattern from `project-template.php`, adapted only from “Project” to “Developer”:

- Page title: `Developer Not Found — SMB Real Estate Brokers`
- Page description: `The developer you are looking for could not be found.`
- Eyebrow: `Developer Not Found`
- Heading: `We couldn't find that developer`
- Body copy: `The developer page you're looking for may have been renamed or is no longer available. Explore our current developers or get in touch with our team.`
- Primary link: `developers.php`, labelled `Browse Developers`
- Secondary link: `contact.php`, labelled `Contact Us`

The 404 branch must require `header.php`, render the not-found content, require `footer.php`, and exit before any archive content is rendered.

## 2. Expected Layout Hierarchy

The rendered hierarchy must be:

1. Shared global header from `header.php`.
2. Main content container.
3. Existing internal-page hero.
4. Developer Overview section.
5. Projects section.
6. Shared global footer from `footer.php`.

No other page section is authorized.

The Developer Overview must use the existing shared split-layout pattern from `assets/css/about.css`.

The Projects section must use the existing project archive grid and project-card presentation currently implemented by `communities.php` and `assets/css/communities.css`.

The exact section order is fixed. The image and biography must not be moved into the hero. The Projects section must not appear before the Developer Overview.

## 3. Hero Section Requirements

The hero must reuse the existing internal-page hero implementation used by `developers.php` and `communities.php`.

Required existing structure and behavior:

- Use the existing `hero hero--page` section classes.
- Use the existing `hero__bg` image element.
- Use the existing `hero__scrim`.
- Use the existing `container hero__inner`.
- Use the existing `hero__content`.
- Use the existing breadcrumb structure and classes.
- Use a single page heading identified by `hero-title`.
- Use the existing `hero__description`.
- Use `aria-labelledby="hero-title"`.
- Set the hero image to `fetchpriority="high"`, matching existing internal pages.
- Use the current developer `display_name` as the page heading.
- Use the current developer `biography` as the hero description.
- Do not add an eyebrow because the breadcrumb occupies the existing small-label row.

The visible breadcrumb must contain exactly:

1. `Home`, linking to `index.php`.
2. `Developers`, linking to `developers.php`.
3. The current developer `display_name`, marked with `aria-current="page"`.

The template must set `$current_page` to an empty string before requiring `header.php`. This follows `project-template.php` for pages outside the primary `$nav_items` set and suppresses the header’s automatic two-item BreadcrumbList JSON-LD, which cannot represent this three-item archive breadcrumb.

After requiring `header.php`, the template must emit one developer-page BreadcrumbList JSON-LD object using the existing `$site_url` and `$canonical_url` variables:

1. Home: name `Home`, URL `$site_url . '/'`.
2. Developers: name `Developers`, URL `$site_url . '/developers.php'`.
3. Current developer: name from `display_name`, URL from `$canonical_url`.

The hero must not use the project-page lead form card, project price, project trust badges, homepage search controls, new buttons, or any newly designed content.

### Hero image source

The hero image must be the same resolved image used by the Developer Overview.

The template must resolve one `$developer_image` and reuse it for:

- The hero background image.
- The Developer Overview image.
- The Open Graph and Twitter image through `$page_og_image`.

The image-selection and fallback algorithm is defined in Section 4 and must run before the SEO variables are assigned and before `header.php` is required.

The hero image alt text must use `$developer_image_alt`, defined by the same image-resolution process.

## 4. Developer Overview Section

The Developer Overview must be a two-column layout based on the existing shared `.split` pattern in `assets/css/about.css`.

### Required hierarchy

- A `section` using the existing `section` class.
- The section must have `id="overview"` and `aria-labelledby="overview-title"`.
- A `container`.
- One `.split` layout.
- One `.split__media` side with `data-reveal`.
- One `.split__text` side with `data-reveal`.

The `.split__media` side must appear first in source order. Do not add `.split--media-right`.

The `.split__text` content must be:

- Eyebrow: `Developer Overview`
- Heading with `id="overview-title"`: the current developer `display_name`
- One paragraph: the current developer `biography`

Do not add a button, facts list, logo, badge, project count, date, award, statistic, or second paragraph.

### Image side

- Display exactly one image.
- The image must be selected from the current developer’s projects when project image data is available.
- A project belongs to the current developer only when its exact `developer` value in `data/projects.json` matches the current developer `canonical_name`.
- Do not use an image from another developer’s project.
- Use the existing split-image behavior from `assets/css/about.css`: the image fills its media wrapper, uses `object-fit: cover`, and follows the current split-layout aspect ratios.
- Set `loading="lazy"` because the image is below the hero, even though the same source is fetched eagerly by the hero.
- Set explicit `width="900"` and `height="675"`, matching the existing 4:3 split-image shape.

### Project and image selection rule

The template must obtain `$developer_projects` by calling `get_projects_by_developer($developer_canonical_name)`. The returned order is the order in `data/projects.json`.

Image selection must be deterministic:

1. Inspect the current developer’s projects in `$developer_projects` order.
2. For each project, inspect `hero.image` first.
3. Then inspect that project’s `gallery.images` in array order.
4. The first non-empty safe local path ends the search.
5. A safe local path must be rejected when it is remote, protocol-relative, or contains `..`, matching the protections in `project_safe_local_path()` and `comm_project_card_image()`.
6. Store the project that supplied the image in `$developer_image_project`.
7. Store the selected safe path in `$developer_image`.
8. Use the same `$developer_image` for both the hero and overview.

Do not randomly select a project. Do not infer an image path from a project slug, project image-library directory, developer name, developer logo, or filename.

### Image fallback behavior

If no matching project contains a safe non-empty `hero.image` or `gallery.images` value:

1. Use `assets/images/project-placeholder.jpg` only when that file exists at the project root-relative location.
2. Otherwise use the existing fallback `assets/images/hero-villa-pool.jpg`.
3. Set `$developer_image_project` to `null`.
4. Set `$developer_image_is_placeholder` to `true`.

This is the same centralized local fallback convention used by `project-template.php` and `communities.php`.

When an actual project image is selected:

- Set `$developer_image_is_placeholder` to `false`.
- Set `$developer_image_alt` to `{project name} by {developer display name}`.

When the fallback is used:

- Set `$developer_image_alt` to `Placeholder image for {developer display name}`.

No external fallback image is permitted.

### Biography side

- Display the current developer biography only.
- Use the current section-label, heading, and paragraph typography patterns already present in the project.
- Do not add facts, dates, claims, statistics, awards, links, buttons, or badges.
- Do not generate, summarize, or expand biography copy.

The biography source is the `biography` field in the current developer record in `data/developers.json`.

Every biography in that file must be copied exactly from the corresponding `.dev-card__desc` in `developers.php`. Punctuation, capitalization, spelling, and wording must remain unchanged.

## 5. Projects Section

The Projects section must display only projects belonging to the current developer.

### Filtering contract

- Load projects through `includes/project-data.php`.
- Set `$developer_canonical_name` from the resolved developer record’s `canonical_name`.
- Call `get_projects_by_developer($developer_canonical_name)` exactly once and store the result in `$developer_projects`.
- Reuse that array for overview-image selection and Projects rendering.
- Filter by the exact project `developer` value through the existing function.
- Do not add partial matching.
- Do not add case-insensitive matching.
- Do not add a second manual filter.
- Do not infer relationships from project names, slugs, image folders, logos, or locations.
- Preserve the order in `data/projects.json`; `get_projects_grouped_by_developer()` already preserves dataset order.
- Do not display projects belonging to any other developer.

### Section presentation

The section must:

- Use `class="comms section section--gray"`.
- Use `id="projects"`.
- Use `aria-labelledby="projects-title"`.
- Contain the existing `.container`.
- Contain a `.section-head` with `data-reveal`.
- Use eyebrow copy `Projects`.
- Use heading copy `Projects by {developer display name}` with `id="projects-title"`.
- Contain no descriptive paragraph above the grid.

When projects exist, use the existing `.comms__grid` grid and reuse the existing project card exactly as implemented in `communities.php`.

The existing project card is not a standalone include. It is the inline `.comm-card` implementation in the Featured Communities project archive in `communities.php`.

The implementation must copy the following three helper functions from `communities.php` into `developer-template.php` without changing their behavior:

- `comm_project_card_image()`
- `comm_parse_property_types()`
- `comm_property_type_icon()`

Because each request loads either `communities.php` or `developer-template.php`, the duplicate page-scoped function names do not collide. Do not extract these helpers or the card into a new shared include, because doing so would require unrelated modification of `communities.php`.

The implementation must copy the existing `.comm-card` rendering block from `communities.php` into `developer-template.php` and supply it from `$developer_projects`.

Feature implementation takes precedence over architectural improvement.

The implementing agent must preserve the current project architecture exactly as it exists.

Do not extract shared components.

Do not introduce reusable abstractions.

Do not move helper functions.

Do not replace inline implementations with shared implementations.

Do not modernize existing architecture.

Do not refactor existing code.

Behavioral compatibility with the current codebase is mandatory.

The goal is to implement the Developer Archive feature only, not to improve the project architecture.

Exact reuse means retaining the current:

- `.comm-card` article.
- `.comm-card__media` image wrapper.
- Project image behavior and dimensions.
- `.comm-card__body`.
- Project name heading.
- `.comm-card__desc`.
- Developer link generated with `developer_slug()`.
- Developer link target of `developers.php#developer-{developer slug}`.
- Location display.
- `.comm-card__types` property-type pills when derived property types are present.
- Existing property-type icon mapping.
- `.comm-card__link` and its arrow icon.
- `View Project` label.
- Project URL convention of `{project slug}.php`.
- Existing `htmlspecialchars()` escaping used by the Communities card.
- Existing lazy loading, `width="900"`, `height="563"`, accessible labels, and `data-reveal` behavior.

The card image fallback must use:

1. The card project’s `hero.image`.
2. The first valid item in the card project’s `gallery.images`.
3. `assets/images/project-placeholder.jpg` when that file exists.
4. Otherwise `assets/images/hero-villa-pool.jpg`.

Do not create a developer-specific card design. Do not add developer logos, prices, descriptions, badges, buttons, metadata, or controls that are absent from the existing `.comm-card`.

### Empty result

When `$developer_projects` is empty:

- Render the Projects section and its section heading.
- Do not render an empty `.comms__grid`.
- Render one paragraph with `class="section-head__sub"` and the exact text `Coming Soon`.

This reuses the exact empty-project copy already used by developer cards in `developers.php`.

The same empty state applies when `get_all_projects_safe()` cannot load or decode the project dataset, because the current `get_projects_by_developer()` contract returns an empty array in that condition.

## 6. Data Source Requirements

### Confirmed project source

`data/projects.json` is the sole project-record source.

`includes/project-data.php` is the sole project loading and project/developer relationship lookup layer.

The implementation must not:

- Read archived or legacy project data.
- Duplicate project records in the template.
- Hardcode a developer’s project list.
- Derive project ownership from directory names or filenames.
- Write to `data/projects.json` during page rendering.
- Use external project or developer data.

### Confirmed project fields used by the required page

- `slug`
- `name`
- `developer`
- `location_label`
- `hero.image`
- `hero.headline`
- `gallery.images`

### Developer metadata source

Create `data/developers.json` as the sole developer archive metadata source.

Create `data/developers.schema.json` to constrain that source, following the role and strictness of `data/projects.schema.json`.

The top-level JSON object must contain one required `developers` array and no additional top-level properties.

Every developer record must contain exactly these required string fields and no additional properties:

- `slug`
- `display_name`
- `canonical_name`
- `biography`
- `logo`

Field rules:

- `slug` is the result of applying the existing `developer_slug()` behavior to `canonical_name`.
- `display_name` is the visible `<h3>` name currently used by the corresponding developer card in `developers.php`.
- `canonical_name` is the exact string used by matching project records in `data/projects.json`.
- For Emaar, `canonical_name` is `Emaar Properties`.
- For Aldar, `canonical_name` is `Aldar Properties`.
- For every other developer, `canonical_name` is the existing canonical input used by that developer card in `developers.php`.
- `biography` is copied exactly from the corresponding `.dev-card__desc` in `developers.php`.
- `logo` is the current developer-card logo path from `developers.php`, retained as metadata even though the archive layout does not display the logo.

Create `includes/developer-data.php` as the sole developer archive loader.

It must follow the architecture of `includes/project-data.php` and provide:

- A cached loader for `data/developers.json`.
- A function that returns all developer records in dataset order.
- A function named `get_developer_by_slug(string $slug): ?array`.
- A controlled failure function for a missing, unreadable, malformed, or structurally invalid developer data file.

`get_developer_by_slug()` must:

- Trim the input.
- Return `null` for an empty slug.
- Compare the input to the stored `slug` value using exact string equality.
- Return the first exact match.
- Return `null` when no record matches.

The loader must not render HTML, generate metadata, select images, filter projects, or write to the JSON file.

### Required developer records

`data/developers.json` must contain these records in the same order as the developer cards in `developers.php`:

| `slug` | `display_name` | `canonical_name` | `logo` | `biography` |
|---|---|---|---|---|
| `emaar-properties` | Emaar | Emaar Properties | `/assets/images/developers/Emaar_logo.svg` | Known for large-scale, master-planned communities that combine homes, amenities and long-term placemaking. |
| `aldar-properties` | Aldar | Aldar Properties | `/assets/images/developers/aldar.png` | An Abu Dhabi-based developer with a wide portfolio of residential, cultural and leisure destinations across the emirate. |
| `damac-properties` | DAMAC Properties | DAMAC Properties | `/assets/images/developers/damac.svg` | Luxury Dubai developer renowned for high-end residential towers and branded, amenity-rich communities. |
| `nakheel` | Nakheel | Nakheel | `/assets/images/developers/nakheel.svg` | A Dubai developer whose portfolio includes established residential communities, waterfront destinations and major land reclamation projects. |
| `dubai-properties` | Dubai Properties | Dubai Properties | `/assets/images/developers/dubai-properties.png` | Diversified Dubai developer delivering residential, retail and hospitality projects across established city communities. |
| `sobha-realty` | Sobha Realty | Sobha Realty | `/assets/images/developers/sobha.svg` | Premium developer recognised for meticulous craftsmanship and high-quality residential communities across Dubai. |
| `meraas` | Meraas | Meraas | `/assets/images/developers/Meraas-logo.svg` | Focused on urban neighbourhoods and destination-led developments with a strong emphasis on public realm and everyday experience. |
| `binghatti-developers` | Binghatti Developers | Binghatti Developers | `/assets/images/developers/binghatti.svg` | Fast-growing Dubai developer recognised for bold architectural designs and distinctive, branded residential towers. |
| `danube-properties` | Danube Properties | Danube Properties | `/assets/images/developers/danube.png` | Value-driven Dubai developer offering affordable, amenity-rich residences with flexible, investor-friendly payment plans. |
| `azizi-developments` | Azizi Developments | Azizi Developments | `/assets/images/developers/Azizi_Developments.svg` | Dubai developer delivering accessible, well-located residential communities across several of the city's key districts. |
| `mag-group-holding` | MAG Group Holding | MAG Group Holding | `/assets/images/developers/MAG-GROUP-HOLDING-logo.png` | Diversified UAE developer with a growing portfolio of residential, hospitality and mixed-use projects. |
| `ellington-properties` | Ellington Properties | Ellington Properties | `/assets/images/developers/ellington.svg` | Boutique Dubai developer celebrated for design-led residences and thoughtfully curated architectural details. |
| `samana-developers` | Samana Developers | Samana Developers | `/assets/images/developers/samana.png` | Dubai developer known for amenity-packed residences and attractive, investor-friendly payment structures. |
| `deyaar-development` | Deyaar Development | Deyaar Development | `/assets/images/developers/deyaar.svg` | Established Dubai developer delivering residential and commercial projects across key city locations. |
| `omniyat` | Omniyat | Omniyat | `/assets/images/developers/omniyat.svg` | Ultra-luxury Dubai developer crafting architecturally distinctive, branded residences in prime waterfront locations. |
| `iman-developers` | Iman Developers | Iman Developers | `/assets/images/developers/iman.png` | Dubai developer focused on quality residential projects designed for comfortable, connected community living. |
| `reportage-properties` | Reportage Properties | Reportage Properties | `/assets/images/developers/reportage.svg` | UAE-wide developer delivering large-scale residential communities across Dubai and several other emirates. |
| `tiger-properties` | Tiger Properties | Tiger Properties | `/assets/images/developers/tiger.png` | Dubai developer with a diverse portfolio of residential and commercial towers across the city. |
| `pantheon-development` | Pantheon Development | Pantheon Development | `/assets/images/developers/pantheon.png` | Dubai developer delivering design-focused residential projects with an emphasis on quality finishes. |
| `select-group` | Select Group | Select Group | `/assets/images/developers/select-group.svg` | Award-winning Dubai developer known for premium waterfront residences and landmark hospitality projects. |

Do not add developer facts, alternate names, archive descriptions, SEO copy, hero fields, or project arrays to these records.

## 7. Relationship Between Developers and Projects

The relationship is the exact string value in each project record’s `developer` field.

The required relationship flow is:

1. A wrapper assigns one stored developer slug to `$developer_slug`.
2. `developer-template.php` trims `$developer_slug`.
3. `get_developer_by_slug($developer_slug)` resolves the developer record by exact stored slug.
4. The template assigns the record’s `canonical_name` to `$developer_canonical_name`.
5. The template passes `$developer_canonical_name` to `get_projects_by_developer()`.
6. `get_projects_grouped_by_developer()` groups records by the trimmed, exact `developer` value.
7. Projects with an empty developer value are ignored.
8. The returned project order follows `data/projects.json`.

`developer_slug()` in `includes/project-data.php` remains the canonical slug-generation function used by the existing Communities-to-Developers anchor contract and by the values stored in `data/developers.json`.

The stored developer slug must equal `developer_slug(canonical_name)`. The implementation must validate this when preparing `data/developers.json`; the runtime template must use the stored slug for lookup and must not perform fuzzy normalization.

### Developer page URL convention

The URL convention is:

`{developer slug}.php`

The developer slug is the `slug` value in `data/developers.json`.

Examples:

- Emaar: `emaar-properties.php`
- Aldar: `aldar-properties.php`
- DAMAC Properties: `damac-properties.php`
- Nakheel: `nakheel.php`

Routing is provided by root-level wrapper files. No `.htaccess` change, web-server route, query parameter, nested `/developers/` directory, or dynamic route is permitted.

## 8. Required Template Variables

### Wrapper input

Each developer wrapper must set:

- `$developer_slug`: the exact developer `slug` from `data/developers.json`.

The wrapper must then require `developer-template.php` using `__DIR__`.

No wrapper may set metadata, biography, canonical name, projects, images, styles, breadcrumb values, or copy. All such behavior belongs in `developer-template.php`.

### Resolved developer variables

`developer-template.php` must use these exact variable names:

- `$developer_slug`: trimmed wrapper input.
- `$developer`: resolved developer record.
- `$developer_display_name`: `$developer['display_name']`.
- `$developer_canonical_name`: `$developer['canonical_name']`.
- `$developer_biography`: `$developer['biography']`.
- `$developer_projects`: result of `get_projects_by_developer($developer_canonical_name)`.

### Image variables

The image-selection process must use these exact result variables:

- `$developer_image_project`: the project record that supplied the selected image, or `null`.
- `$developer_image`: the selected safe local image path or the resolved local fallback path.
- `$developer_image_is_placeholder`: `true` only when the fallback is used.
- `$developer_image_alt`: the final alt text defined in Section 4.
- `$developer_project_placeholder`: `assets/images/project-placeholder.jpg`.
- `$developer_fallback_image`: `$developer_project_placeholder` when that file exists; otherwise `assets/images/hero-villa-pool.jpg`.

Temporary loop variables may be named locally as needed, but they must not become part of the wrapper or data contract.

### Global page and SEO variables

Before requiring `header.php`, the template must assign:

- `$page_title`: `{developer display name} — SMB Real Estate Brokers`
- `$page_description`: the exact developer biography.
- `$page_og_title`: identical to `$page_title`.
- `$page_og_description`: identical to `$page_description`.
- `$page_og_image`: `$developer_image`.
- `$current_page`: an empty string.
- `$skip_link`: `#overview`.
- `$page_styles`: the exact ordered stylesheet list defined below.
- `$sticky_href`: `contact.php`.
- `$sticky_label`: `UAE Property Advisory`.
- `$sticky_value`: `Start a Conversation`.
- `$sticky_action`: `Contact us`.

The exact `$page_styles` order is:

1. `assets/css/home.css`
2. `assets/css/about.css`
3. `assets/css/services.css`
4. `assets/css/contact.css`
5. `assets/css/communities.css`

This is the existing stylesheet stack used by `communities.php`; it supplies the internal hero dependencies, shared section patterns, split layout, and exact Communities project-card presentation without a new archive stylesheet.

`header.php` must continue to generate:

- The `<title>` from `$page_title`.
- Meta description from `$page_description`.
- Canonical URL from the executing wrapper filename.
- Open Graph and Twitter title from `$page_og_title`.
- Open Graph and Twitter description from `$page_og_description`.
- Open Graph and Twitter image from `$page_og_image`.
- Global `index, follow` robots metadata.

Do not add a developer-specific SEO object to `data/developers.json`. SEO values are generated deterministically from `display_name`, `biography`, and `$developer_image`.

## 9. Required Includes and Existing Components

The include order in `developer-template.php` is fixed:

1. Declare strict types, matching `project-template.php` and `includes/project-data.php`.
2. Require `includes/project-data.php`.
3. Require `includes/developer-data.php`.
4. Resolve the developer or execute the controlled 404 branch.
5. Resolve `$developer_projects`.
6. Resolve image and SEO variables.
7. Require `header.php`.
8. Emit developer BreadcrumbList JSON-LD.
9. Render the hero, overview, and projects.
10. Require `footer.php`.

Required existing presentation patterns:

- Internal-page hero from `developers.php` and `communities.php`.
- Breadcrumb from the same internal-page hero implementation.
- Split layout from `assets/css/about.css`.
- Project grid and `.comm-card` from `communities.php`.
- Project-card styles from `assets/css/communities.css`.
- Global icons already defined by `header.php`.
- Existing global reveal behavior from `assets/js/main.js`.
- Existing header, mobile navigation, footer, sticky CTA, and footer-year behavior supplied by the shared files.

No standalone project-card include may be created. The current project has no such include, and extracting one would require unrelated edits to `communities.php`.

The archive must copy and reuse the inline Communities card implementation as specified in Section 5.

### JavaScript usage

- Do not create a developer archive JavaScript file.
- Do not add inline JavaScript.
- Do not add a script entry to `$page_styles` or another page variable.
- `footer.php` must load the existing `assets/js/main.js` once.
- `data-reveal` on the overview sides, section heading, and project cards must use the existing IntersectionObserver reveal behavior.
- The shared mobile-navigation behavior must remain unchanged.
- The archive has no form, so the existing form setup functions exit without effect.
- The archive has no `#enquire` section. `$sticky_href` must therefore be `contact.php`; the existing sticky CTA click handler will preserve normal link navigation because `enquireSection` is absent.
- Reduced-motion behavior must remain controlled by the existing CSS and `assets/js/main.js`.

## 10. Responsive Behavior

Responsive behavior must follow only the existing CSS patterns.

### Hero

Use the current `.hero--page` behavior from `assets/css/about.css`:

- Mobile: minimum height of 50 viewport-height units, reduced top and bottom padding, 2rem heading, and 0.9375rem description.
- From 768px: minimum height of 64 viewport-height units.
- From 992px: minimum height of 76 viewport-height units and a single-column hero inner grid.
- At widths below 768px, the global hero content is centered by `assets/css/main.css`.

### Developer Overview

Use the current `.split` behavior from `assets/css/about.css`:

- Below 992px: one-column grid with the existing 48px gap.
- From 992px: two columns using the existing `1.05fr 0.95fr` proportions and existing 80px gap.
- Use the existing media aspect ratio of 4:3 below 992px.
- Use the existing media aspect ratio of 4:3.4 from 992px.
- At widths below 768px, center only the split text using the current rule.
- Do not add new breakpoints.

### Projects grid

Use the current `.comms__grid` behavior from `assets/css/communities.css`:

- Default: one column with a 24px gap.
- From 640px: two columns.
- From 1100px: three columns with a 32px gap.

Use the current `.comm-card` media aspect ratio of 16:10, body padding, type-pill wrapping, hover behavior, and link behavior without alteration.

### General behavior

- Use the shared `.container` widths and section spacing.
- Preserve the current mobile navigation and footer behavior by using the shared header and footer.
- Preserve the current reduced-motion handling supplied by the global styles and script.
- Do not introduce a developer-archive-specific breakpoint.
- Do not create `assets/css/developer-template.css` or any other archive stylesheet.

## Implementation Scope

The implementation scope is strictly limited to the Developer Archive feature described in this specification.

The implementing agent must not perform unrelated work.

Specifically, it must not:

- refactor existing architecture
- reorganize the project
- rename existing files
- move existing files
- improve existing code outside this feature
- optimize unrelated PHP
- optimize unrelated CSS
- optimize unrelated JavaScript
- redesign existing layouts
- redesign existing components
- update existing project cards
- update existing developer cards
- change existing responsive behavior
- introduce reusable abstractions outside this feature
- extract shared components unrelated to this implementation
- modify documentation unrelated to this feature
- perform cleanup work outside the implementation described here

Only the files explicitly listed in this specification may be created.

Only the implementation described by this specification may be performed.

## 11. Files Expected to Be Modified

The implementation must create only the files listed below.

No additional files may be created unless explicitly required by this specification.

### Shared template and data layer

- `developer-template.php`
- `includes/developer-data.php`
- `data/developers.json`
- `data/developers.schema.json`

### Root-level developer wrapper pages

- `emaar-properties.php`
- `aldar-properties.php`
- `damac-properties.php`
- `nakheel.php`
- `dubai-properties.php`
- `sobha-realty.php`
- `meraas.php`
- `binghatti-developers.php`
- `danube-properties.php`
- `azizi-developments.php`
- `mag-group-holding.php`
- `ellington-properties.php`
- `samana-developers.php`
- `deyaar-development.php`
- `omniyat.php`
- `iman-developers.php`
- `reportage-properties.php`
- `tiger-properties.php`
- `pantheon-development.php`
- `select-group.php`

Each wrapper filename must exactly match its stored developer slug plus `.php`.

Each wrapper must contain only:

- The PHP opening tag.
- Assignment of its exact slug to `$developer_slug`.
- A requirement of `developer-template.php` using `__DIR__`.

No existing PHP, CSS, JavaScript, JSON, schema, asset, or documentation file is part of the later implementation change.

## 12. Files That MUST NOT Be Modified

The implementation must not modify:

- `project-template.php`
- Any existing individual project entry file.
- `data/projects.json`
- `data/projects.schema.json`
- `includes/project-data.php`
- `developers.php`
- `communities.php`
- `about.php`
- `contact.php`
- `index.php`
- `services.php`
- `damac-islands2.php`
- `assets/css/communities.css`
- `assets/css/developers.css`
- `assets/css/main.css`
- `assets/css/about.css`
- `assets/css/home.css`
- `assets/css/services.css`
- `assets/css/contact.css`
- `assets/js/main.js`
- `header.php`
- `footer.php`
- Existing project image assets.
- Existing developer logo assets.
- Existing documentation.

The implementation must not alter existing page content, existing page section order, existing project cards, existing developer cards, global navigation, global tokens, global responsive behavior, existing project routes, or the current Communities-to-Developers anchor links.

The new developer archive files must consume the current architecture without refactoring existing files.

## 13. Acceptance Checklist

- [ ] `developer-template.php` exists at the project root.
- [ ] `includes/developer-data.php` exists and follows the project data-loader architecture.
- [ ] `data/developers.json` exists with exactly the 20 specified developer records and exact specified values.
- [ ] `data/developers.schema.json` enforces the specified top-level and record contracts.
- [ ] All 20 specified root-level developer wrapper pages exist.
- [ ] Every wrapper filename is `{stored developer slug}.php`.
- [ ] Every wrapper sets only `$developer_slug` and requires `developer-template.php`.
- [ ] Missing, empty, and unmatched developer slugs use the specified controlled HTTP 404 branch.
- [ ] The page represents exactly one resolved developer.
- [ ] The page uses `header.php` and `footer.php`.
- [ ] The include order matches Section 9.
- [ ] `$current_page` is empty, preventing the header’s two-item breadcrumb JSON-LD.
- [ ] The template emits the specified three-item developer BreadcrumbList JSON-LD.
- [ ] The visible breadcrumb is exactly Home / Developers / current developer.
- [ ] The canonical URL is generated from the executing wrapper filename.
- [ ] The page title is exactly `{display name} — SMB Real Estate Brokers`.
- [ ] Meta and Open Graph descriptions are the exact developer biography.
- [ ] Open Graph and Twitter images use `$developer_image`.
- [ ] The page loads the exact five-item `$page_styles` list in the specified order.
- [ ] No archive-specific CSS file exists.
- [ ] The page uses the existing internal-page `hero hero--page` structure.
- [ ] The hero heading is the current developer `display_name`.
- [ ] The hero description is the exact developer `biography`.
- [ ] The hero and overview reuse the same resolved `$developer_image`.
- [ ] The hero image uses high fetch priority.
- [ ] No project-page form card, price, badges, or homepage search control appears in the hero.
- [ ] The Developer Overview uses the existing `.split` layout and the specified source order.
- [ ] The Developer Overview displays exactly one image.
- [ ] The image search inspects developer projects in dataset order, `hero.image` first, then `gallery.images`.
- [ ] An actual overview image belongs to a project whose exact `developer` value matches the current `canonical_name`.
- [ ] Empty or unsafe image values use the specified local placeholder/fallback chain.
- [ ] The overview image uses the specified alt-text rule, dimensions, and lazy loading.
- [ ] The Developer Overview eyebrow is `Developer Overview`.
- [ ] The Developer Overview heading is the developer `display_name`.
- [ ] The Developer Overview paragraph is the exact developer `biography`.
- [ ] No biography copy or developer fact has been invented.
- [ ] The Projects section uses the specified classes, IDs, eyebrow, and dynamic heading.
- [ ] The template calls `get_projects_by_developer()` exactly once with `$developer_canonical_name`.
- [ ] The same `$developer_projects` array drives image selection and project-card rendering.
- [ ] Every displayed project belongs to the current developer.
- [ ] No project belonging to another developer is displayed.
- [ ] Project order matches `data/projects.json`.
- [ ] The three Communities card helper functions are copied without behavioral changes.
- [ ] Every project uses the existing `.comm-card` structure and classes exactly.
- [ ] Project image precedence and fallback match the current Communities project-card behavior.
- [ ] Project property types are derived from `hero.headline` using the current Communities behavior.
- [ ] Project developer links retain the current `developers.php#developer-{slug}` target.
- [ ] Project detail URLs follow the current `{project slug}.php` convention.
- [ ] Existing escaping, lazy loading, dimensions, icons, accessible names, and reveal attributes are preserved.
- [ ] A developer with no matching projects displays `Coming Soon` and no empty grid.
- [ ] The project grid is one column by default, two columns from 640px, and three columns from 1100px.
- [ ] The overview becomes two columns only from 992px.
- [ ] The internal-page hero uses the existing 50vh, 64vh, and 76vh responsive pattern.
- [ ] `footer.php` loads the existing `assets/js/main.js` once.
- [ ] No new or inline JavaScript exists.
- [ ] The sticky CTA links to `contact.php` and uses the specified existing default copy.
- [ ] No new section, component variant, breakpoint, visual style, interaction, alternate route, or optional feature has been added.
- [ ] No file listed under “Files That MUST NOT Be Modified” has changed.
- [ ] The document contains no unresolved implementation decision.

## Completion Criteria

The implementation is considered complete only when every requirement in this specification has been satisfied.

Completion requires all of the following:

- Every required file has been created.
- Every required page renders successfully.
- Every developer wrapper loads the shared developer template correctly.
- Every developer page displays the correct developer.
- Every developer page displays only projects belonging to that developer.
- No unrelated project page behavior has changed.
- No existing Communities page behavior has changed.
- No existing Developers page behavior has changed.
- No prohibited file has been modified.
- No PHP syntax errors exist.
- No PHP runtime errors exist.
- No warnings or notices are introduced by the implementation.
- All Acceptance Checklist items can be verified as complete.

When every Completion Criteria item has been satisfied, the implementing agent must stop immediately.
