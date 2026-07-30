# SMB Real Estate — Pre-WordPress Website Readiness Audit

## 1. Audit Scope

This audit answers one question: can the current PHP site be frozen now and used as the authoritative visual, structural, behavioral, and content reference for a later WordPress conversion?

The audit is limited to the current implementation. It does not design or recommend a WordPress theme, plugin, content type, taxonomy, field model, migration script, or administration interface.

The inspected implementation comprises:

- `index.php`, the five files in `pages/`, 19 Project route wrappers, and 20 Developer route wrappers;
- the two shared page templates, four template parts, five includes, `.htaccess`, `router.php`, `robots.txt`, and `sitemap.xml`;
- `data/projects.json`, `data/developers.json`, and both JSON Schemas;
- all seven active CSS files and `assets/js/main.js`;
- all media referenced by generated HTML or the two primary datasets.

Existing Markdown reports and plans were excluded from evidence. They were neither read nor used to form conclusions.

## 2. Audit Method

Evidence was collected independently from source, data, generated HTML, local HTTP responses, and referenced files.

Executed checks:

- PHP 8.2.30 syntax lint: **57/57 active PHP files passed**.
- JavaScript syntax: `node --check assets/js/main.js` **passed**.
- JSON parsing: both primary datasets, both schemas, and all 19 image-library JSON files **passed**.
- Draft 2020-12 schema validation with the locally installed `jsonschema` validator: **both primary datasets passed**.
- Local server: `php -S 127.0.0.1:8765 router.php`.
- HTTP verification: **46/46 intended HTML requests returned 200**.
- Generated dependency crawl: **193 unique local asset/page URLs returned 200** using GET.
- Generated heading/ID scan: every intended route has one H1; no duplicate rendered IDs were found.
- Record checks: slug uniqueness, wrapper coverage, Developer relationships, price-state consistency, supported icon values through schema validation, and data-referenced file existence.
- Static interaction review of the complete active JavaScript file.
- Static responsive review of all active CSS and its breakpoints.

Test limitation: the in-app browser was unavailable (`agent.browsers.list()` returned no browser). Therefore screenshot comparison, computed contrast, live browser-console capture, orientation changes, and visual verification at exact viewport widths could not be executed. They are marked **not executed**, never passed by inference. HTTP-rendered output and source-level responsive behavior were still verified.

The pre-existing worktree contained unrelated documentation moves. This audit did not modify them.

## 3. Independent Source Inventory

| Source group | Active role | Status |
|---|---|---|
| `index.php` | Home route and page-specific editorial sections | Active |
| `pages/*.php` | About, Services, Developers, Communities, Contact | Active |
| `projects/*.php` | 19 thin slug wrappers | Active; all map to records |
| `developers/*.php` | 20 thin slug wrappers | Active; all map to records |
| `templates/project-template.php` | Canonical Project detail markup | Active |
| `templates/developer-template.php` | Canonical Developer detail markup | Active |
| `template-parts/*.php` | Breadcrumb, Project card, Developer card, Project enquiry form | Active |
| `includes/*.php` | Global shell, data loaders, Project card helpers | Active |
| `data/projects.json` | 19 Project records | Active |
| `data/developers.json` | 20 Developer records | Active |
| `data/*.schema.json` | Dataset constraints | Active validation references |
| `assets/css/*.css` | Global and Page CSS | Active; seven files referenced |
| `assets/js/main.js` | All client-side interaction | Active site-wide |
| `.htaccess` | Production flat-route rewrites | Active under Apache |
| `router.php` | Local-preview flat-route emulation | Local development only |
| `sitemap.xml`, `robots.txt` | Public discovery metadata | Active |
| `assets/images/projects/*/{original,png}` | Source/export variants not referenced by the site | Confirmed non-runtime media |
| `assets/images/projects/*/image-library.json` | Media provenance/catalogue files | Not loaded at runtime |
| root `zoom200-index.png` | Standalone screenshot | Not referenced at runtime |
| Markdown audits/plans | Documentation | Explicitly excluded from evidence |

## 4. Public Route Inventory

“Assets valid” means every local URL emitted by the route resolved with HTTP 200. “Links valid” concerns resolvable destinations; placeholder `#` interactions are separately marked.

| Route | Page type | Source/template | Runtime status | Assets valid | Links valid | Freeze status |
|---|---|---|---:|---|---|---|
| `/` | Home | `index.php` | 200 | Pass | Fail: 3 Insights use `#` | Blocked |
| `/index.php` | Home alias | `index.php` | 200; canonical `/` | Pass | Fail: same as `/` | Blocked |
| `/about.php` | Editorial Page | `pages/about.php` | 200 | Pass | Pass | Ready |
| `/services.php` | Editorial Page | `pages/services.php` | 200 | Pass | Pass | Ready |
| `/developers.php` | Developer index | `pages/developers.php` | 200 | Pass | Pass | Ready |
| `/communities.php` | Project index | `pages/communities.php` | 200 | Pass | Fail: 6 category links use `#` | Blocked |
| `/contact.php` | Contact Page | `pages/contact.php` | 200 | Pass | Pass | Blocked: false form success |
| `/grand-polo-club-resort.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: fabricated place |
| `/fahid-island.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: fabricated place |
| `/damac-riverside-views.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: fabricated place |
| `/bay-grove-residences.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: fabricated place |
| `/la-tilia-at-villanova.php` | Project | wrapper → Project template | 200 | Pass | Pass | Ready |
| `/sobha-central.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: fabricated place |
| `/the-acres-estates.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: 2 fabricated places |
| `/binghatti-aquarise.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: empty amenities |
| `/sparklz-by-danube.php` | Project | wrapper → Project template | 200 | Pass | Pass | Ready |
| `/azizi-milan.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: empty amenities |
| `/everly-place.php` | Project | wrapper → Project template | 200 | Pass | Pass | Ready |
| `/downtown-residences.php` | Project | wrapper → Project template | 200 | Pass | Pass | Ready |
| `/lumena.php` | Project | wrapper → Project template | 200 | Pass | Pass | Ready |
| `/one-park-central.php` | Project | wrapper → Project template | 200 | Pass | Pass | Ready |
| `/verdana-empire.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: empty amenities |
| `/tiger-sky-tower.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: empty amenities |
| `/elysee-heights.php` | Project | wrapper → Project template | 200 | Pass | Pass | Ready |
| `/six-senses-residences-dubai-marina.php` | Project | wrapper → Project template | 200 | Pass | Pass | Blocked: fabricated place |
| `/damac-islands2.php` | Project | wrapper → Project template | 200 | Pass | Pass | Ready |
| `/emaar-properties.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/aldar-properties.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/damac-properties.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/nakheel.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/dubai-properties.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/sobha-realty.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/meraas.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/binghatti-developers.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/danube-properties.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/azizi-developments.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/mag-group-holding.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Blocked: unrelated placeholder |
| `/ellington-properties.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/samana-developers.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Blocked: unrelated placeholder |
| `/deyaar-development.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/omniyat.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/iman-developers.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/reportage-properties.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/tiger-properties.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/pantheon-development.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |
| `/select-group.php` | Developer | wrapper → Developer template | 200 | Pass | Pass | Ready |

The sitemap contains the canonical Home URL, all five Page routes, all 20 Developers, and all 19 Projects: 45 canonical URLs. `/index.php` is correctly excluded as a duplicate alias.

## 5. Canonical Page-Type Inventory

| Page type | Canonical source | Structural status | Freeze assessment |
|---|---|---|---|
| Home | `index.php` + global shell + Project card partial | Unique editorial composition | Incomplete Insights destinations |
| About | `pages/about.php` + global shell | Unique editorial composition | Stable |
| Services | `pages/services.php` + global shell | Unique editorial composition | Stable |
| Developers index | `pages/developers.php` + Developer card partial | Record-driven listing | Stable |
| Communities/Projects index | `pages/communities.php` + Project card partial | Record-driven listing plus editorial categories | Category behavior unfinished |
| Contact | `pages/contact.php` + global JS | Unique form variant | Submission behavior not real |
| Project detail | 19 wrappers + `templates/project-template.php` | One shared template | Structurally canonical; fallback behavior is not freeze-ready |
| Developer detail | 20 wrappers + `templates/developer-template.php` | One shared template | Structurally canonical; two records expose unrelated fallback media |
| Controlled record 404 | Branches inside both shared templates | Shared per record type | Clear implementation fallback |

No obsolete duplicate public PHP page was found. Wrappers are legitimate route adapters, not duplicate page implementations.

## 6. Component Inventory

| Component | Used on | Canonical implementation | Duplicate implementations | Data dependency | WordPress conversion risk | Freeze status |
|---|---|---|---|---|---|---|
| Header | All HTML routes | `includes/header.php` | None | Global hardcoded nav/contact | Low | Ready |
| Mobile navigation | All routes | Header + `main.js` | None | Nav array | Low | Source-ready; visual test pending |
| Footer | All routes | `includes/footer.php` | None | Global hardcoded identity/contact | Medium: repeated owner | Ready with note |
| Page hero | About, Services, Developers, Communities, Contact, Developer details | Shared class system; markup repeated per editorial Page | Acceptable Page-specific markup | Page copy/media or Developer record | Low | Ready |
| Project hero | All Projects | `templates/project-template.php` | None | Project record | Low | Ready |
| Developer hero | All Developers | `templates/developer-template.php` | None | Developer + related Project | High for empty Developers | Blocked |
| Breadcrumb | All non-Home routes | `template-parts/breadcrumb.php` + header JSON-LD | None | `$breadcrumb_trail` | Low | Ready |
| Project card | Home, Communities, Developer details | `template-parts/project-card.php` | None | Project + Developer records | Low | Ready |
| Developer card/row | Developers index | `template-parts/developer-card.php` | None | Developer + grouped Projects | Low | Ready |
| Team card | About | Repeated twice in Page | Small acceptable repetition | Page editorial | Low | Ready |
| Property-type/category card | Home, Communities | Shared CSS pattern; Page markup | Intentional editorial instances | Hardcoded labels/actions | High: six unfinished actions | Blocked |
| Final CTA | Home and editorial Pages | Repeated Page markup using centralized CSS | Copy/media variants intentional | Page editorial + global contact | Medium duplication | Ready |
| Sticky CTA | All routes | `includes/footer.php` + `main.js` | None | Template overrides | Low | Ready |
| Project enquiry form | All Projects, twice per route | `template-parts/enquiry-form.php` | Hero/card intentional variants | Project context | Blocker: false success | Blocked |
| Contact form | Contact | Page-specific markup + shared JS | Separate from enquiry partial; justified extra radio group | Page context | Blocker: false success | Blocked |
| Gallery | All Projects | Project template | None | Four record paths | Low | Ready |
| Lightbox | All Projects | Project template + `main.js` | None | Gallery DOM | Medium a11y verification | Source-ready |
| Overview statistic card | All Projects | Project template | None | Exactly three record cards | Low | Ready |
| Project facts | All Projects | Project template | None | Exactly four record facts | Low | Ready |
| Amenities item | All Projects | Project template | None | Variable record list | Blocker for four records | Blocked |
| Nearby-place item | All Projects | Project template | None | 1–4 record items but forced to four | Blocker | Blocked |
| Content split | About, Developer detail, selected editorial sections | Central `.split` rules; repeated semantic markup | Intentional content variants | Page/record | Low | Ready |
| Section heading | Site-wide | `.section-head` system | Minor semantic variants | Copy | Low | Ready |
| Developer empty projects | Two Developers | Developer template “Coming Soon” | None | Empty relationship result | Medium | Stable behavior, inaccurate media |
| Project data fallback UI | Project template | Central fallback rules | None | Optional/invalid fields | High: invents visible content | Blocked |

## 7. Static and Dynamic Content Classification

| Page/section | Current source | Classification | Canonical owner clear? | Conversion ambiguity |
|---|---|---|---|---|
| Home hero/categories/process/communities/testimonials/Insights/CTA | `index.php` | Page-specific editorial | Yes | Insights destinations unfinished |
| Home selected Projects | `projects.json` via helper + card partial | Record-driven/derived | Yes | No |
| About all sections/team | `pages/about.php` | Page-specific editorial | Yes | No |
| Services all sections/FAQ | `pages/services.php` | Page-specific editorial | Yes | No |
| Developers hero/editorial/CTA | `pages/developers.php` | Page-specific editorial | Yes | No |
| Developer listing | `developers.json` + grouped Projects | Record-driven/derived | Yes | No |
| Communities editorial categories/FAQ/CTA | `pages/communities.php` | Page-specific editorial | Yes | Filter behavior absent |
| Communities Project grid | `projects.json` | Record-driven | Yes | No |
| Contact content/form/office | `pages/contact.php` | Page-specific editorial + global business data duplicate | Partly | Form transport and repeated contact owner |
| Project details | `projects.json` | Record-driven | Yes | Four records contain empty visible concepts; template invents locations |
| Developer details | `developers.json` + related Project lookup | Record-driven/derived | Yes | Empty-Project hero ownership unclear |
| Header/nav | `includes/header.php` | Global site content | Yes | No |
| Footer/organization schema | `includes/footer.php` | Global site/legal content | Yes within file, duplicated elsewhere | Contact values repeated |
| CTA button labels/fallbacks | Page/template PHP | Theme presentation copy | Yes | Some fallback copy is being shown as real content |
| Current year | Static `2026`, replaced by JS current year | Runtime-generated | Yes | No current defect |
| SEO metadata | Page PHP, Project records, Developer records | Page-specific or record-driven | Yes | Developer OG image is derived from Project/fallback |

## 8. Content Ownership Findings

Global phone, email, office address, company name, and WhatsApp number are repeated in the header, footer, Contact Page, Project template, and final CTAs. The repeated values currently agree:

- phone/WhatsApp: `+971 50 421 7299` / `971504217299`;
- email: `info@smbdubai.net`;
- office: `3002 Westburry Tower Office, Business Bay, Dubai, UAE`;
- canonical domain: `https://smbdubai.net`.

This is an architectural opportunity, not a current inconsistency. The one visible identity variation is Home’s “SMB Real Estate L.L.C · UAE” versus the otherwise consistent “SMB Real Estate Brokers L.L.C”; see PWF-011.

Project cards derive name, Developer link, image, types, and pricing from the same Project/Developer records used by detail pages. No card/detail disagreement was found.

Developer names in Projects exactly match a `canonical_name` in `developers.json`. The template derives display names and links; there are no orphan relationships.

The main ownership failures are not duplicate values: they are fallback-generated visible claims (“Project Amenity”, “Key Destination”) that have no record owner.

## 9. Data Integrity and Migration Readiness

Schema validity is not freeze readiness. Both datasets pass schema validation, but the schema permits empty amenity strings and one-to-three location places, while the renderer turns those states into invented content.

| Record | Type | Data valid | Relationships valid | Media valid | Manual interpretation needed | Status |
|---|---|---|---|---|---|---|
| Grand Polo Club & Resort | Project | Yes | Yes | Yes | No | Ready |
| Fahid Island | Project | Schema-valid | Yes | Yes | Yes: 4th place is invented | Blocked |
| DAMAC Riverside Views | Project | Schema-valid | Yes | Yes | Yes: 4th place is invented | Blocked |
| Bay Grove Residences | Project | Schema-valid | Yes | Yes | Yes: 4th place is invented | Blocked |
| La Tilia at Villanova | Project | Yes | Yes | Yes | No | Ready |
| Sobha Central | Project | Schema-valid | Yes | Yes | Yes: 4th place is invented | Blocked |
| The Acres Estates | Project | Schema-valid | Yes | Yes | Yes: 3rd/4th places invented | Blocked |
| Binghatti Aquarise | Project | Schema-valid but 4 blank amenities | Yes | Yes | Yes | Blocked |
| Sparklz by Danube | Project | Yes | Yes | Yes | No | Ready |
| Azizi Milan | Project | Schema-valid but 4 blank amenities | Yes | Yes | Yes | Blocked |
| Everly Place | Project | Yes | Yes | Yes | No | Ready |
| Downtown Residences | Project | Yes | Yes | Yes | No | Ready |
| LUMENA | Project | Yes | Yes | Yes | No | Ready |
| One Park Central | Project | Yes | Yes | Yes | No | Ready |
| Verdana Empire | Project | Schema-valid but 4 blank amenities | Yes | Yes | Yes | Blocked |
| Tiger Sky Tower | Project | Schema-valid but 4 blank amenities | Yes | Yes | Yes | Blocked |
| Elysee Heights | Project | Yes | Yes | Yes | No | Ready |
| Six Senses Residences Dubai Marina | Project | Schema-valid | Yes | Yes | Yes: 4th place invented | Blocked |
| DAMAC Islands 2 | Project | Yes | Yes | Yes | No | Ready |
| Emaar, Aldar, DAMAC, Nakheel, Dubai Properties, Sobha, Meraas, Binghatti, Danube, Azizi, Ellington, Deyaar, Omniyat, Iman, Reportage, Tiger, Pantheon, Select Group | Developer (18) | Yes | Yes | Yes | No | Ready |
| MAG Group Holding | Developer | Yes | Empty Project set is valid | Logo valid; hero is unrelated Emaar Project | Yes: correct hero intent | Blocked |
| Samana Developers | Developer | Yes | Empty Project set is valid | Logo valid; hero is unrelated Emaar Project | Yes: correct hero intent | Blocked |

Additional verified data results:

- Project slugs: 19 unique; Developer slugs: 20 unique.
- Every slug has a matching public wrapper.
- Every Project has exactly four facts, three overview cards, and four gallery paths.
- All 133 media paths directly referenced by the datasets exist.
- Price states are internally consistent: 12 “available on request” records have null price; seven priced records have positive numeric values.
- `damac-islands2` is the only enabled district strip and has eight non-empty items; the other 18 are consistently disabled with empty data.
- Gallery limits and supported icons pass schema constraints.

## 10. Visual and Layout Consistency

The implementation has a coherent central visual system:

- one `--container`-based `.container`;
- common section spacing tokens and mobile reductions;
- one typography family and centralized heading scale;
- shared color, radius, shadow, button, field, card, hero, facts, gallery, amenities, location, footer, and sticky-CTA rules;
- Page-specific CSS layers for genuine editorial structures;
- one Project detail template and one Developer detail template.

Intentional variations include the full-height Home hero, Page heroes, the two-column Project hero, Page-specific editorial compositions, and compact/full enquiry forms. These are not inconsistencies.

Confirmed visual ambiguity comes from content, not competing CSS: blank amenities become four visually complete generic cards, missing places become normal-looking destination cards, and empty Developers show unrelated Project photography. A WordPress reproduction cannot know whether these are deliberate designs or temporary fill.

Exact visual comparison across small mobile, mobile, tablet, desktop, and wide desktop was not executed because no browser was available. The CSS contains explicit adaptations at 480, 600/640/700, 768, 992, 1100, and 1200px, plus fluid containers and overflow safeguards; this is positive source evidence, not a rendered pass.

## 11. Responsive Readiness

Source-level verified behavior:

- mobile navigation becomes a fixed off-canvas panel below 992px, with 44px controls and body scroll lock;
- Home search chips scroll horizontally below 480px;
- card/facts/amenity/location grids progress from one to two to three/four columns;
- Project gallery is a horizontal snap list on small screens and a grid from 768px;
- Project lightbox uses viewport-limited media and mobile control positions;
- sticky CTA changes from full-width inset to a 320px desktop card;
- Page hero height and type reduce on mobile;
- global `overflow-x: hidden` contains the closed navigation panel.

Not executed: visual overflow checks, long-name wrapping for “Six Senses Residences Dubai Marina,” tap testing, landscape orientation, and screenshots at representative widths. No source-level fixed-width overflow defect was confirmed.

PWF-010 remains a reduced-motion issue: CSS hides the Home video, but the autoplay element and sources remain in markup and JavaScript does not pause or prevent loading it.

## 12. Interaction and JavaScript Readiness

Positive verified behavior in `assets/js/main.js`:

- all selectors are guarded before use;
- mobile menu updates `aria-expanded`, label, overlay, body lock, Escape handling, breakpoint reset, and focus return;
- open mobile nav and lightbox both implement Tab containment;
- reveal animations are bypassed under reduced motion or without IntersectionObserver;
- sticky CTA updates keyboard exposure with visibility and scrolls/focuses the enquiry form;
- form validation is instance-scoped, focuses the first invalid field, updates error text and `aria-invalid`;
- lightbox supports click triggers, backdrop/close, previous/next, zoom, arrows, Escape, focus return, and counter;
- optional page elements do not cause unguarded selector errors;
- the JavaScript syntax check passes.

Blocking behavior: successful validation never performs a request. It immediately hides the form and presents “Your Enquiry Has Been Received.” This affects `hero-form` and `main-form`; 19 Project pages render two forms each and Contact renders one, for 39 visible instances.

Live browser-console capture was not possible. No runtime exception was observed through generated-output checks, but console status is **not tested**.

## 13. Forms Readiness

Frontend structure is mostly stable:

- Project forms have one shared partial with intentional hero/card variants.
- IDs are instance-prefixed (`hf-*`, `mf-*`), and rendered duplicate-ID scans pass.
- Contact’s separate form is justified by its enquiry-type radio group and required message.
- Every visible text field has a label; required states and `aria-describedby` targets are present.
- Project forms carry source page and Project context in hidden inputs.
- Validation is scoped to each form and supports multiple instances.

Transport is not merely deferred: it is contradicted by the UI. No form has `action` or `method`, no JavaScript request is made, no pending/error state exists, no honeypot exists, and valid submission displays a definitive receipt claim. Before freeze, the canonical frontend behavior must stop claiming receipt or a real transport contract must be established. The backend itself need not be implemented to resolve the reference ambiguity.

## 14. Media Readiness

Verified results:

- 149 asset paths are explicitly referenced by active source/data.
- The only missing literal path is `assets/images/project-placeholder.jpg`; runtime detects its absence and uses an existing `hero-villa-pool.jpg`, so no current request is broken.
- All 193 generated local URLs, including media, CSS, JS, font, and pages, return 200.
- Both Home video encodings exist: MP4 3.10 MiB and WebM 2.81 MiB; poster fallback exists.
- No actively referenced image exceeds 1 MiB; the largest checked image is approximately 0.78 MiB.
- Project galleries contain four existing files each.
- All 20 Developer logos exist.
- Team portraits and Home/Page hero media exist.
- Most non-hero images use lazy loading; hero images use eager/fetch-priority behavior.

Conversion risks:

- MAG and Samana use Grand Polo Club & Resort photography as visible hero, overview, OG, and Twitter imagery.
- Project media data stores only paths. Alt text is generated as “Project — Lifestyle Image N,” not owned by the record.
- Source/export `original` and `png` trees are not runtime content and must not be mistaken for additional canonical galleries.

Image fidelity/content accuracy was not visually inspected because the browser was unavailable. File existence does not prove that an image depicts the correct Project.

## 15. URL and Navigation Integrity

All resolvable internal links passed local HTTP verification. Header, footer, logo, breadcrumb, card, Project, Developer, phone, email, WhatsApp, CTA, and canonical destinations are syntactically coherent.

Confirmed destination problems:

- three Home Insight cards use `href="#"`, with accessible labels explicitly saying “article to be added”;
- six Communities category cards use `href="#"`, with labels explicitly saying “Filtered View To Be Added”;
- six Home community cards route to the Home enquiry anchor rather than the existing Communities Page, which creates an unclear “Explore” contract (PWF-009).

Flat `.php` routes are consistent across wrappers, navigation, sitemap, canonical metadata, `.htaccess`, and local router. The production Apache rewrite behavior itself was not executed locally; `router.php` mirrors the enumerated patterns.

## 16. SEO and Metadata Reference Readiness

Positive evidence:

- every intended route emits a non-empty title, description, robots directive, canonical, Open Graph, Twitter card, and one H1;
- canonical paths are correct for all 46 tested requests, with `/index.php` canonicalized to `/`;
- BreadcrumbList JSON-LD is centralized;
- RealEstateAgent JSON-LD is centralized and uses the same current contact values;
- Project structured data derives name, description, image, address locality, URL, and optional price from the Project record;
- sitemap and record/page route sets agree.

Risks:

- Developer OG/Twitter images are derived from a related Project and fall back to unrelated Emaar photography for MAG and Samana.
- Project alt ownership is absent from data (PWF-007).
- “Sparklz by Danube by Danube Properties” is a mechanically awkward but data-consistent page title; it is a Low editorial issue, not a structural blocker (PWF-012).

Generated JSON-LD source is escaped/encoded consistently. Full rich-result validation against an external service was not executed.

## 17. Accessibility Reference Readiness

Confirmed strengths:

- semantic header/nav/main/footer landmarks;
- a working skip-link target on every Page type;
- one H1 per intended route and structured section headings;
- controls use buttons where actions occur and links where navigation occurs;
- mobile nav exposes state and supports Escape/focus return/trapping;
- form labels and described error elements are present;
- lightbox has dialog semantics, modal state, named controls, Escape/arrows, focus trap, and focus return;
- visible focus styles and dark-background focus overrides exist;
- reduced-motion CSS and JavaScript paths exist;
- no rendered duplicate IDs were found.

Confirmed issues:

- Project photographs have generic ordinal alt text because records cannot own meaningful alternatives (PWF-007).
- Home autoplay video is only hidden in reduced-motion CSS; playback/loading is not explicitly suppressed (PWF-010).
- Placeholder cards expose invented accessible text such as “Project Amenity” and “Key Destination” (PWF-003/PWF-004).

Computed color contrast and screen-reader/browser interaction were not executed. No contrast failure is reported without measurement.

## 18. PHP-Specific Implementation Artifacts

| Artifact | Current purpose | Visible behavior to preserve? | Conversion treatment |
|---|---|---|---|
| 39 slug wrapper files | Set a slug and include a shared template | Preserve the route/result, not wrapper mechanics | Discard as implementation detail |
| `.htaccess` enumerated rewrites | Map flat public URLs to subfolders | Preserve decided public URL behavior if approved | Discard mechanics |
| `router.php` | Emulate rewrites in PHP local server | No production-visible behavior | Discard |
| `REQUEST_URI` basename canonical builder | Produce flat canonical URLs behind rewrites | Preserve canonical results | Discard mechanics |
| JSON `file_get_contents` loaders/static cache | Load records once per request | Preserve failure/empty-state intent where approved | Discard mechanics |
| exact-string Developer relationship lookup | Connect Project to Developer | Preserve the verified relationship | Discard mechanics |
| `is_file` fallback checks | Avoid broken images | Preserve a decided fallback behavior | Current specific fallback is not canonical |
| PHP array padding to fixed card counts | Force four facts/gallery/places and three stats | Facts/gallery counts are data contract; place invention must not be preserved | Resolve before freeze |
| inline 404 styles | Render controlled missing-record pages | Preserve user-facing 404 intent only | Discard inline implementation |

## 19. Conversion Ambiguities

| Ambiguity | Exact evidence | Why the converter would guess | Smallest pre-freeze decision |
|---|---|---|---|
| Are Insights real navigation? | `index.php:295-320`, six `href="#"` anchors and “article to be added” labels | Card presence says yes; destination says no | Remove from freeze scope or assign real destinations |
| Do Communities categories filter? | `pages/communities.php:100-146`, six “Filtered View To Be Added” links | Visual cards imply behavior not implemented | Decide/remove/implement the intended current behavior |
| Did a form submit? | `main.js` submit handler and forms without transport | UI says received; runtime sends nothing | Define honest reference state |
| Are blank amenities intentional? | Four records contain four empty title/description pairs | Template converts blanks into convincing generic cards | Supply real items or define an intentional no-amenities state |
| Should fewer places stay fewer? | Six records have 2–3; template pads to four | UI invents missing content | Render real count or supply real records |
| What image represents an empty Developer? | Developer template line 68 uses an Emaar Project image globally | MAG/Samana have no related Project | Choose a truthful empty-state/Developer image behavior |
| Who owns image alternatives? | Project records contain paths only; template generates ordinals | Generic generated alt may be copied as authoritative | Confirm decorative status or add canonical descriptions before freeze |
| Which CSS defines Developer pages? | Developer template loads six Page stylesheets | Equivalent rules are spread across unrelated Page bundles | Document/canonicalize only the active visual rules before handoff |

## 20. Legacy and Unused Code Risks

Confirmed non-runtime material:

- Project `original/` and `png/` exports are not emitted by current pages.
- `image-library.json` files are not loaded by PHP or JavaScript.
- `zoom200-index.png` is not referenced.
- existing Markdown reports/plans are documentation-only and excluded.

Active fallback, not legacy:

- `assets/images/project-placeholder.jpg` does not exist, but its check is active and deterministically falls back to `hero-villa-pool.jpg`.
- controlled record-not-found branches are reachable when a wrapper supplies an unknown slug or a record is removed.

The Developer template’s six CSS imports are active even if many individual rules do not match. They are not labeled “unused”; the risk is unclear dependency ownership.

No broad cleanup is required to begin correction. Only items that confuse canonical behavior need resolution.

## 21. Findings by Severity

### Findings register

| ID | Severity | Area | Finding | Affected routes/files | Freeze blocker |
|---|---|---|---|---|---|
| PWF-001 | Blocker | Completeness/links | Nine visible cards advertise unfinished destinations with `href="#"` | Home, Communities; `index.php`, `pages/communities.php` | Yes |
| PWF-002 | Blocker | Forms/interaction | 39 forms claim receipt without transmitting data | Contact + all Projects; `main.js`, form sources | Yes |
| PWF-003 | Blocker | Data/fallback | Four Projects store 16 empty amenities rendered as generic content | Four Project routes; `projects.json`, Project template | Yes |
| PWF-004 | Blocker | Data/fallback | Six Projects fabricate seven destination cards to force four slots | Six Project routes; `projects.json`, Project template | Yes |
| PWF-005 | High | Media/Developer | Two Developers use unrelated Emaar photography and metadata | MAG, Samana; Developer template | Yes |
| PWF-006 | Medium | Content | Amenity descriptions are heavily duplicated formula copy | Multiple Projects; `projects.json` | No |
| PWF-007 | Medium | Accessibility/media | Project images have no record-owned alt text | All Projects; data + Project template | No |
| PWF-008 | Medium | CSS ownership | Developer detail depends on all six unrelated Page CSS bundles | All Developer details; Developer template | No |
| PWF-009 | Medium | Navigation | Home “Explore” community cards lead to enquiry, not Communities | Home; `index.php` | No |
| PWF-010 | Medium | Reduced motion/media | Reduced-motion mode hides but does not stop/load-suppress autoplay video | Home; `index.php`, `home.css`, `main.js` | No |
| PWF-011 | Low | Identity | Home eyebrow omits “Brokers” from the otherwise consistent legal-facing name | Home; `index.php` | No |
| PWF-012 | Low | Metadata/editorial | “Sparklz by Danube by Danube Properties” title is awkward | Sparklz route; `projects.json` | No |

### PWF-001 — Blocker — Visible unfinished destinations

- **Affected:** `/`, `/index.php`, `/communities.php`; `index.php:295-320`, `pages/communities.php:100-146`.
- **Evidence:** three Insight cards contain six `href="#"` anchors and labels ending “article to be added.” Six category cards use `href="#"` and labels ending “Filtered View To Be Added.”
- **Verification:** source scan plus generated HTML inspection.
- **Conversion impact:** these are visible, interactive components whose canonical destination/behavior does not exist. A converter must invent, omit, or reproduce a dead action.
- **Minimum action:** remove the provisional cards from the frozen reference or give them their decided working destinations/behavior.
- **Blocks freeze:** **Yes**.

### PWF-002 — Blocker — Forms claim success without a submission

- **Affected:** `/contact.php` and all 19 Project routes; `template-parts/enquiry-form.php:42-85`, `pages/contact.php:79-122`, `assets/js/main.js` form submit handler.
- **Evidence:** forms have no action/method; JavaScript calls `preventDefault()`, performs no fetch/XHR, hides the form, and reveals copy stating the enquiry “Has Been Received.”
- **Verification:** full JavaScript review and generated form count (39 instances).
- **Conversion impact:** the current behavior is materially false and leaves the converter unable to know whether to preserve a demo, a success state, or an intended transport contract. User data is discarded.
- **Minimum action:** define an honest canonical frontend outcome. Backend implementation may remain deferred, but receipt must not be claimed without transmission.
- **Blocks freeze:** **Yes**.

### PWF-003 — Blocker — Empty amenities become invented cards

- **Affected:** `/binghatti-aquarise.php`, `/azizi-milan.php`, `/verdana-empire.php`, `/tiger-sky-tower.php`; `data/projects.json`; `templates/project-template.php:420-445`.
- **Evidence:** each affected record has four amenity objects with empty title and description. Renderer substitutes “Project Amenity” and “Full Amenity Details Are Available On Request.”
- **Verification:** record-level JSON extraction and rendered-template branch review; schema passes because strings have no `minLength`.
- **Conversion impact:** 16 visible cards have no canonical content owner. Migration cannot distinguish unknown amenities from four intentional generic amenities.
- **Minimum action:** provide real amenity content or define/render an intentional no-amenities state.
- **Blocks freeze:** **Yes**.

### PWF-004 — Blocker — Fewer places are padded with fictional destinations

- **Affected:** Fahid Island, DAMAC Riverside Views, Bay Grove Residences, Sobha Central, The Acres Estates, Six Senses Residences Dubai Marina; `data/projects.json`; `templates/project-template.php:451-492`.
- **Evidence:** affected records contain 3,3,3,3,2,3 places. The template pads every list to four and renders blank slots as “Key Destination” / “Travel Details Available On Request,” creating seven fictional cards.
- **Verification:** record counts and template branch review.
- **Conversion impact:** the rendered reference contains entities absent from source data. Reproducing it migrates invented content; omitting it changes the canonical layout.
- **Minimum action:** render the real variable count or supply real destinations.
- **Blocks freeze:** **Yes**.

### PWF-005 — High — Empty Developers use unrelated Emaar Project media

- **Affected:** `/mag-group-holding.php`, `/samana-developers.php`; `templates/developer-template.php:64-111, 143-165, 181-201`.
- **Evidence:** both Developers have zero Projects. The template uses Grand Polo Club & Resort photography for hero, overview, OG, and Twitter image, labels it “Placeholder Image For [Developer],” and shows “Coming Soon.”
- **Verification:** exact relationship counts, Developer-template fallback review, and generated route inspection.
- **Conversion impact:** a frozen visual/SEO reference would incorrectly associate two Developers with an Emaar Project and leaves the correct empty-state design undecided.
- **Minimum action:** approve a truthful Developer empty-media state or provide correct media.
- **Blocks freeze:** **Yes**.

### PWF-006 — Medium — Project amenity copy is formulaically duplicated

- **Affected:** multiple Project records; `data/projects.json`.
- **Evidence:** exact descriptions repeat across unrelated records: swimming copy 15 times, exercise copy 12 times, wellness copy 9 times, social-space copy 7 times, family-recreation copy 6 times, and landscaped-space copy 5 times.
- **Verification:** exact-string grouping across every amenity item.
- **Conversion impact:** structure is migratable, but the reference may freeze generic research-normalization copy as authoritative editorial content.
- **Minimum action:** explicitly approve this copy as canonical or review only the repeated descriptions before freeze.
- **Blocks freeze:** **No**, unless content approval is withheld.

### PWF-007 — Medium — Project image alternative text has no content owner

- **Affected:** all Project routes; `data/projects.json`; `templates/project-template.php:190-198, 352-385`.
- **Evidence:** records store media paths but no alt values. Hero alt is composed from Project/headline; gallery alt is “Project — Lifestyle Image N.”
- **Verification:** dataset topology and template review.
- **Conversion impact:** a converter must preserve generic text, decide images are decorative, or author new descriptions during conversion.
- **Minimum action:** approve decorative/generated behavior or provide canonical meaningful alternatives before freeze.
- **Blocks freeze:** **No**.

### PWF-008 — Medium — Developer style ownership spans every Page bundle

- **Affected:** all Developer details; `templates/developer-template.php:121-128`.
- **Evidence:** every Developer route loads `home.css`, `about.css`, `services.css`, `contact.css`, `communities.css`, and `developers.css` in addition to `main.css`.
- **Verification:** template and generated link inspection.
- **Conversion impact:** the visual result is active, but ownership of Developer hero, split, Project cards, and logo rules is obscured by unrelated bundles, increasing the chance of missing cascade-dependent rules.
- **Minimum action:** document which existing rule groups are canonical for Developer pages; no large refactor is required.
- **Blocks freeze:** **No**.

### PWF-009 — Medium — Home community “Explore” actions have ambiguous intent

- **Affected:** Home community cards; `index.php:200-239`.
- **Evidence:** all six cards say “Explore” but link to `#enquire`; a dedicated `/communities.php` route exists and is in global navigation.
- **Verification:** source and generated link inspection.
- **Conversion impact:** the converter cannot tell whether cards are location navigation, enquiry triggers, or future community pages.
- **Minimum action:** approve the enquiry destination explicitly or point them to the intended existing destination.
- **Blocks freeze:** **No**.

### PWF-010 — Medium — Reduced motion does not suppress autoplay media

- **Affected:** Home; `index.php:29-36`, `assets/css/home.css:19-21`, `assets/js/main.js`.
- **Evidence:** the video has `autoplay muted loop playsinline`; reduced-motion CSS only applies `display:none`; JavaScript reads the preference for animations/scroll but does not pause or prevent video loading.
- **Verification:** complete HTML/CSS/JS review.
- **Conversion impact:** copying current appearance alone misses the unresolved behavioral expectation for reduced-motion users and may retain unnecessary media transfer.
- **Minimum action:** decide and implement the canonical reduced-motion video behavior before freeze.
- **Blocks freeze:** **No**.

### PWF-011 — Low — Company identity short form is inconsistent

- **Affected:** Home hero; `index.php:40`; compare `includes/footer.php:18,44,55` and Page metadata.
- **Evidence:** Home displays “SMB Real Estate L.L.C · UAE”; dominant site identity is “SMB Real Estate Brokers L.L.C.”
- **Verification:** exact identity string scan.
- **Conversion impact:** minor uncertainty about whether this is an approved short brand or omitted word.
- **Minimum action:** confirm the short form or align it.
- **Blocks freeze:** **No**.

### PWF-012 — Low — One generated title reads as duplicated attribution

- **Affected:** `/sparklz-by-danube.php`; `data/projects.json` SEO title.
- **Evidence:** runtime title is “Sparklz by Danube by Danube Properties.”
- **Verification:** HTTP title extraction and record comparison.
- **Conversion impact:** low; it would be migrated exactly but may not be intended editorial wording.
- **Minimum action:** approve or edit the title before SEO freeze.
- **Blocks freeze:** **No**.

## 22. Required Pre-Freeze Corrections

1. Resolve all nine provisional `#` card destinations.
2. Make form success behavior truthful and unambiguous; backend delivery may remain separately deferred.
3. Replace or intentionally suppress the 16 empty amenity cards across four Projects.
4. Stop inventing seven nearby-place cards across six Projects or supply real data.
5. Establish truthful hero/overview/social media behavior for MAG Group Holding and Samana Developers.

These are the smallest changes required to make the implementation a reliable reference. They do not require structural redesign.

## 23. Non-Blocking Improvements

- Approve or revise formulaically repeated amenity descriptions.
- Decide whether Project photos need record-owned alt text or are decorative.
- Document the CSS rule ownership used by Developer details.
- Confirm Home community-card destination intent.
- Suppress Home video playback/loading under reduced motion if that is the intended behavior.
- Confirm the Home identity short form and the Sparklz page-title wording.
- After corrections, perform the unavailable browser pass at approximately 320, 390, 768, 1440, and 1920px, including landscape mobile, keyboard-only interaction, computed contrast, network failures, and console capture.

## 24. Freeze Checklist

| Check | Pass/Fail | Evidence |
|---|---|---|
| All public routes verified | Pass | 46/46 intended requests returned 200 |
| All Projects verified | Fail | Four empty-amenity and six padded-place records |
| All Developers verified | Fail | MAG and Samana use unrelated placeholder media |
| Relationships valid | Pass | Every Project Developer matches one canonical Developer |
| No broken assets | Pass | 193/193 generated local URLs returned 200 |
| No broken internal links | Fail | Nine visible `href="#"` feature destinations |
| Canonical components identified | Pass | Shared shell, parts, and Page-type templates inventoried |
| No competing component versions | Pass | Variants are intentional; no competing Project/Developer templates |
| Optional states verified | Fail | Fewer-place and empty-amenity states invent content |
| Forms structurally stable | Pass | Labels, IDs, validation, and multi-form scoping are stable |
| Forms behavior stable and truthful | Fail | Success shown without transmission |
| Responsive layouts stable | Not verified | Source supports breakpoints; visual browser pass unavailable |
| Interactions stable | Fail | Navigation/lightbox source is stable; forms are not |
| Content ownership clear | Fail | Generated amenity/place content and two Developer images lack truthful owners |
| No unresolved design decisions | Fail | Empty Developer media and provisional cards |
| No unresolved migration ambiguities | Fail | Placeholder/fallback behavior would require guessing |
| Current implementation approved as canonical reference | Fail | Blockers remain |

## 25. Final Readiness Verdict

**NOT READY FOR WORDPRESS CONVERSION**

Finding totals:

- **Blocker: 4**
- **High: 1**
- **Medium: 5**
- **Low: 2**

The site is structurally much closer to ready than the verdict alone suggests: every intended route works, datasets parse and validate, relationships and media paths are intact, common components are identifiable, and Project/Developer rendering is centralized.

It cannot be frozen today because visible canonical behavior still includes unfinished navigation, false form success, record-empty amenities converted into invented cards, real variable-length nearby-place data converted into fictional destinations, and unrelated Emaar imagery on two Developer pages. Those defects would force the WordPress developer either to reproduce inaccurate behavior or make design/content decisions during conversion.

After the five required correction groups are resolved, a rendered multi-viewport/browser-console pass remains necessary because that verification could not be executed in this environment.
