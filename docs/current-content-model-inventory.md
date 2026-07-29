# SMB Real Estate — Current Content Model Inventory

Inventory date: 2026-07-29

Scope: current runtime website files in `index.php`, `pages/`, `projects/`, `developers/`, `templates/`, `template-parts/`, `includes/`, `data/`, and content-bearing asset metadata. Documentation and historical audit files are not runtime website content. This report records the implementation as found and makes no architectural recommendation.

## 1. Website Pages

### Page inventory

| Filename | Purpose | Dynamic or static | Reusable sections | Repeated components |
|---|---|---|---|---|
| `index.php` | Homepage and corporate/property landing page | Mixed: editorial sections are hardcoded; the first six records from `data/projects.json` are rendered dynamically in dataset order | Global header/footer; project card; section heading pattern; category cards; numbered steps; final CTA | Six project cards; six property-type cards; four process steps; six community cards; three testimonials; three insight cards |
| `pages/about.php` | Company, team, mission, vision, values, and reasons to choose SMB | Static | Global header/footer; page hero; breadcrumb; split content; section headings; numbered steps; choose list; final CTA | Four company facts; two team cards; mission/vision panels; four value steps; five choose items |
| `pages/services.php` | Services, working process, audiences served, and service FAQ | Static, except FAQ JSON-LD is generated from a hardcoded PHP array | Global header/footer; page hero; breadcrumb; split content; numbered steps; FAQ; final CTA | Five journey/service points; four process steps; four audience cards; five FAQ items |
| `pages/developers.php` | Directory of all developers and explanation of SMB's developer-comparison role | Mixed: developer directory is generated from `data/developers.json`; project counts are derived from `data/projects.json`; supporting copy is hardcoded | Global header/footer; page hero; breadcrumb; developer card; choose list; final CTA | Twenty developer cards; five help/choose items |
| `pages/communities.php` | Location-led discovery page and full project archive presented as a cross-section of UAE living | Mixed: all project cards come from `data/projects.json`; other sections are hardcoded | Global header/footer; page hero; breadcrumb; project card; category cards; choose list; FAQ; final CTA | Nineteen project cards; six lifestyle cards; six decision steps; six FAQ items |
| `pages/contact.php` | Contact methods, consultation form, office information, and direct-contact CTAs | Static | Global header/footer; page hero; breadcrumb; contact method cards; lead form; final CTA | Three contact method cards; five enquiry-type radio options; four office-information rows; two direct-contact CTA sections |

### Shared page-level content elements

Every public page uses the global header and footer. The five files in `pages/` use a page hero and breadcrumb. The homepage uses a distinct video-backed home hero and has no breadcrumb. Page-level metadata is set in PHP variables: page title, page description, Open Graph title, Open Graph description, Open Graph image, current navigation page, skip-link target, and page-specific stylesheet list.

### Pages that do not exist

- No separate project archive page named `projects.php` exists.
- No separate community detail-page files or community dataset exist.
- No article/insight detail-page files exist; homepage insight links are `#` placeholders.
- No property-type detail or filtered-result pages exist.
- No search-results page exists.
- No blog, category, or tag archive exists.

## 2. Project Pages

### Project page inventory

All 19 files below are three-line wrappers that set `$project_slug` and require `templates/project-template.php`. Their content is dynamic and comes from the matching record in `data/projects.json`.

| Filename | Project | Developer | Location | Price state | Distinct implemented content |
|---|---|---|---|---|---|
| `projects/grand-polo-club-resort.php` | Grand Polo Club & Resort | Emaar Properties | Dubai South, Dubai | Available on request | Standard shared project sections |
| `projects/fahid-island.php` | Fahid Island | Aldar Properties | Fahid Island, Abu Dhabi | Available on request | Standard shared project sections |
| `projects/damac-riverside-views.php` | DAMAC Riverside Views | DAMAC Properties | Dubai Investments Park, Dubai | Available on request | Standard shared project sections |
| `projects/bay-grove-residences.php` | Bay Grove Residences | Nakheel | Dubai Islands, Dubai | Available on request | Standard shared project sections |
| `projects/la-tilia-at-villanova.php` | La Tilia at Villanova | Dubai Properties | Villanova, Dubailand, Dubai | Available on request | Standard shared project sections; stored location-place rows are blank and are not rendered |
| `projects/sobha-central.php` | Sobha Central | Sobha Realty | Sheikh Zayed Road, Dubai | AED 1.78 million | Standard shared project sections |
| `projects/the-acres-estates.php` | The Acres Estates | Meraas | The Acres, Dubailand, Dubai | Available on request | Standard shared project sections |
| `projects/binghatti-aquarise.php` | Binghatti Aquarise | Binghatti Developers | Business Bay, Dubai | AED 1.34 million | Stored amenity text and location-place values are blank and are not rendered |
| `projects/sparklz-by-danube.php` | Sparklz by Danube | Danube Properties | Al Furjan, Dubai | AED 1.8 million | Stored location-place rows are blank and are not rendered |
| `projects/azizi-milan.php` | Azizi Milan | Azizi Developments | City of Arabia, Dubai | Record-driven numeric price | Standard shared project sections |
| `projects/everly-place.php` | Everly Place | Ellington Properties | Meydan Horizon, Mohammed Bin Rashid City, Dubai | Record-driven price state | Standard shared project sections |
| `projects/downtown-residences.php` | Downtown Residences | Deyaar Development | Business Bay / Downtown Dubai gateway, Dubai | Available on request | Stored location-place rows are blank and are not rendered |
| `projects/lumena.php` | LUMENA | Omniyat | Business Bay, Dubai | AED 19 million | Stored location-place rows are blank and are not rendered |
| `projects/one-park-central.php` | One Park Central | Iman Developers | Jumeirah Village Circle, Dubai | AED 0.65 million | Stored location-place rows are blank and are not rendered |
| `projects/verdana-empire.php` | Verdana Empire | Reportage Properties | Dubai Investments Park, Dubai | Available on request | Stored amenity text and location-place values are blank and are not rendered |
| `projects/tiger-sky-tower.php` | Tiger Sky Tower | Tiger Properties | Business Bay, Dubai | Available on request | Stored amenity text and location-place values are blank and are not rendered |
| `projects/elysee-heights.php` | Elysee Heights | Pantheon Development | Jumeirah Village Circle, Dubai | Available on request | Stored location-place rows are blank and are not rendered |
| `projects/six-senses-residences-dubai-marina.php` | Six Senses Residences Dubai Marina | Select Group | Dubai Marina, Dubai | Available on request | Standard shared project sections |
| `projects/damac-islands2.php` | DAMAC Islands 2 | DAMAC Properties | Dubailand, Dubai | AED 1.9 million | The only record with an enabled district strip: six normal districts and two “Launching” districts; two overview paragraphs; eight amenities |

### Content elements implemented on project pages

- SEO: page title, page description, Open Graph title, Open Graph description, and Open Graph image.
- Structured data: schema type, name, description, image, address locality, and a computed Offer when a numeric starting price exists.
- Breadcrumb: Projects, then current project name.
- Hero: background image, project name, property-type headline, description, developer name and link, location label, starting-price/available-on-request display, price note, trust badges, and a compact enquiry form.
- Optional district strip: enabled flag, introduction, district name, and optional launching state.
- Key facts: repeated fact label, value, and icon.
- Overview: eyebrow, section title, one or more paragraphs, and repeated statistic cards containing value, label, and icon.
- Gallery: section title and repeated image paths; the template derives image alternative text and supports a lightbox, previous/next controls, zoom, and close controls.
- Amenities: section title and repeated amenity title, description, and icon. Blank amenity items are filtered from rendered output.
- Location: section title, description, background image, and repeated nearby-place name, travel time, and icon. Blank place rows are filtered from rendered output.
- Enquiry section: fixed section heading and explanatory copy, project-specific name in copy, WhatsApp link, phone link, email address, office address, and a card enquiry form.
- Sticky mobile CTA: computed price label/value plus fixed contact action.
- Not-found state: controlled 404 page when a wrapper slug does not resolve.

### Consolidated unique project data fields

- Dataset metadata: `schema_version`, `generated_at`, `status`, `source`.
- Identity: `slug`, `name`.
- Relationship/display: `developer`, `location_label`.
- SEO: `seo.page_title`, `seo.page_description`, `seo.og_title`, `seo.og_description`, `seo.og_image`.
- Hero: `hero.headline`, `hero.description`, `hero.image`, `hero.starting_price_million_aed`, `hero.available_on_request`, `hero.price_note`, `hero.trust_badges[]`.
- Structured data: `structured_data.type`, `structured_data.name`, `structured_data.description`, `structured_data.image`, `structured_data.address_locality`.
- Districts: `districts.enabled`, `districts.intro`, `districts.items[]`; an item is either a district-name string or an object with `name` and `launching`.
- Facts: `facts[].label`, `facts[].value`, `facts[].icon`.
- Overview: `overview.title`, `overview.paragraphs[]`, `overview.cards[].value`, `overview.cards[].label`, `overview.cards[].icon`.
- Gallery: `gallery.title`, `gallery.images[]`.
- Amenities: `amenities.title`, `amenities.items[].title`, `amenities.items[].description`, `amenities.items[].icon`.
- Location: `location.title`, `location.description`, `location.background_image`, `location.places[].name`, `location.places[].time`, `location.places[].icon`.

No project subtitle field exists. No project floor-plan field exists. No payment-plan field exists. No project brochure field exists. No unit inventory or availability collection exists. No project category/tag collection exists. No explicit community identifier exists; location is stored as free text.

## 3. Developer Pages

### Developer page inventory

All developer files set `$developer_slug` and use `templates/developer-template.php`. Every page has the same structure: breadcrumb, image-led hero, developer name, biography, overview image, optional logo, repeated biography, and a project grid or “Coming Soon” empty state.

| Filename | Display name | Canonical relationship value | Related projects |
|---|---|---|---|
| `developers/emaar-properties.php` | Emaar | Emaar Properties | Grand Polo Club & Resort |
| `developers/aldar-properties.php` | Aldar | Aldar Properties | Fahid Island |
| `developers/damac-properties.php` | DAMAC Properties | DAMAC Properties | DAMAC Riverside Views; DAMAC Islands 2 |
| `developers/nakheel.php` | Nakheel | Nakheel | Bay Grove Residences |
| `developers/dubai-properties.php` | Dubai Properties | Dubai Properties | La Tilia at Villanova |
| `developers/sobha-realty.php` | Sobha Realty | Sobha Realty | Sobha Central |
| `developers/meraas.php` | Meraas | Meraas | The Acres Estates |
| `developers/binghatti-developers.php` | Binghatti Developers | Binghatti Developers | Binghatti Aquarise |
| `developers/danube-properties.php` | Danube Properties | Danube Properties | Sparklz by Danube |
| `developers/azizi-developments.php` | Azizi Developments | Azizi Developments | Azizi Milan |
| `developers/mag-group-holding.php` | MAG Group Holding | MAG Group Holding | None; page shows “Coming Soon” |
| `developers/ellington-properties.php` | Ellington Properties | Ellington Properties | Everly Place |
| `developers/samana-developers.php` | Samana Developers | Samana Developers | None; page shows “Coming Soon” |
| `developers/deyaar-development.php` | Deyaar Development | Deyaar Development | Downtown Residences |
| `developers/omniyat.php` | Omniyat | Omniyat | LUMENA |
| `developers/iman-developers.php` | Iman Developers | Iman Developers | One Park Central |
| `developers/reportage-properties.php` | Reportage Properties | Reportage Properties | Verdana Empire |
| `developers/tiger-properties.php` | Tiger Properties | Tiger Properties | Tiger Sky Tower |
| `developers/pantheon-development.php` | Pantheon Development | Pantheon Development | Elysee Heights |
| `developers/select-group.php` | Select Group | Select Group | Six Senses Residences Dubai Marina |

### Consolidated unique developer data fields

- `slug`
- `display_name`
- `canonical_name`
- `biography`
- `logo`
- Derived, not stored: related projects, live-project count, archive hero/overview image, hero image alternative text, page title, page description, Open Graph title, Open Graph description, and Open Graph image.

No developer-specific gallery, facts, statistics, location, website URL, contact details, founding date, or taxonomy values exist.

## 4. Shared Components

| Component | Where used | Duplicated? | Unique? |
|---|---|---|---|
| Global header/navigation | Every public page and controlled 404 state | Single include; rendered everywhere | No |
| Global footer | Every public page and controlled 404 state | Single include; rendered everywhere | No |
| Page hero | About, Services, Developers, Communities, Contact, all developer pages | Markup is repeated across page files; developer pages share one template | No |
| Home hero | Homepage only | No | Yes |
| Project hero | All 19 project pages | Shared project template | Yes to project-page context |
| Breadcrumb | Five general pages, all project pages, all developer pages | Shared partial; breadcrumb data is set by callers | No |
| Project card | Homepage, Communities page, every developer page with projects | Shared partial and shared helper functions | No |
| Developer card/directory row | Developers page | Shared partial repeated for 20 records | Yes to developer directory |
| Enquiry form partial | Twice on each of the 19 project pages | Single partial with compact/card variants | Yes to project pages |
| Contact-page consultation form | Contact page | Separate inline form; overlaps with enquiry partial fields | Yes |
| Section heading pattern | Across all general and detail pages | Repeated markup pattern, not a partial | No |
| Category card | Homepage property types and Communities lifestyle groupings | Markup repeated inline in two pages | No |
| Numbered step list | Homepage, About, Services | Markup repeated inline | No |
| Choose/help list | About, Developers, Communities | Markup repeated inline | No |
| FAQ accordion | Services and Communities | Markup repeated inline; separate hardcoded question sets | No |
| Final CTA | Homepage and all five general pages | Similar structure repeated inline with page-specific copy | No |
| Contact method card | Contact page | Repeated three times inline | Yes |
| Team card | About page | Repeated twice inline | Yes |
| Testimonial card | Homepage | Repeated three times inline | Yes |
| Insight card | Homepage | Repeated three times inline | Yes |
| Community card | Homepage | Repeated six times inline | Yes |
| Project fact item | All project pages | Shared project template loop | Yes to project pages |
| Project overview statistic card | All project pages | Shared project template loop | Yes to project pages |
| Gallery item/lightbox | All project pages | Shared project template loop and one lightbox | Yes to project pages |
| Amenity card | Project pages with nonblank amenities | Shared project template loop | Yes to project pages |
| Nearby-place card | Project pages with nonblank places | Shared project template loop | Yes to project pages |
| Developer overview | All developer pages | Shared developer template | Yes to developer pages |
| Developer project archive section | All developer pages | Shared developer template and project cards | Yes to developer pages |
| Sticky mobile CTA | Project pages and developer pages | Values are set by each shared template; markup is global | No |

## 5. Existing Data Sources

| Data source | What it stores | Where consumed |
|---|---|---|
| `data/projects.json` | Dataset metadata and 19 complete project records: identity, developer, location, SEO, hero, structured data, districts, facts, overview, gallery, amenities, and location/connectivity | `includes/project-data.php`; through it: homepage, Communities page, Developers page project counts, project template, developer template, and project cards |
| `data/developers.json` | 20 developer records: slug, display name, canonical relationship name, biography, and logo path | `includes/developer-data.php`; through it: Developers page, developer template, project template, and project/developer cards |
| `data/projects.schema.json` | JSON Schema contract for the projects dataset and every nested project field | Not read by runtime PHP |
| `data/developers.schema.json` | JSON Schema contract for the developers dataset | Not read by runtime PHP |
| `assets/images/projects/*/image-library.json` (18 files) | Per-project source-image metadata: project slug/name, image count, base name, source URL/type, publisher, dimensions, orientation, original format, original/PNG/WebP paths, scene, watermark flag, and notes | Not read by runtime PHP; these are asset provenance/derivative manifests. No manifest exists for `damac-islands2` |
| Page-local PHP variables/arrays | Page metadata, stylesheet lists, breadcrumb trails, FAQ structured-data arrays, and component context | Corresponding page and shared header/partials |
| `includes/project-data.php` | Loader/query helpers for projects; exact developer grouping; slug derivation; price-display and numeric-offer derivation | Homepage, Communities, Developers, project template, developer template, project cards |
| `includes/developer-data.php` | Loader/query helpers for developer slug and canonical-name lookup | Developers page, project template, developer template, project cards |
| `includes/project-card-helpers.php` | Project-card image selection/fallback, property-type parsing from hero headline, and icon mapping | Homepage, Communities page, developer template |
| `includes/header.php` | Hardcoded navigation array, site URL, metadata defaults, breadcrumb JSON-LD assembly, icon symbols, and global header/sticky CTA markup | Every page |
| `includes/footer.php` | Hardcoded quick links, company contact details, copyright, and footer markup | Every page |

### Runtime helper behavior

- `get_all_projects()` returns all project records in JSON order.
- `get_project_by_slug()` performs exact slug lookup.
- `get_all_projects_safe()` returns all records or `null` without taking down a listing page.
- `get_projects_grouped_by_developer()` groups by the exact nonblank `project.developer` string, preserving dataset order.
- `get_projects_by_developer()` retrieves an exact developer group.
- `developer_slug()` derives a lowercase hyphenated anchor slug.
- `project_price_info()` converts the stored million-AED value and request flag into display text and optional whole-AED structured-data value.
- `get_all_developers()` returns all developer records in JSON order.
- `get_developer_by_slug()` performs exact slug lookup.
- `get_developer_by_canonical_name()` first matches exact canonical name and then may fall back to the derived slug.
- `comm_project_card_image()` selects a hero image, then gallery image, then local fallback.
- `comm_parse_property_types()` derives card labels from `hero.headline`; the parsed values are not stored separately.

No database, API, CMS, CSV, XML content feed, or remote runtime content source exists.

## 6. Existing Relationships

| Relationship | Current implementation |
|---|---|
| Project → Developer | `project.developer` is matched to `developer.canonical_name`; project heroes and cards link to the matched developer slug |
| Developer → Projects | `get_projects_by_developer(developer.canonical_name)` returns projects whose `developer` value is an exact match |
| Developer directory → Project count | Each developer card counts the exact-match project collection |
| Homepage → Projects | First six project records in dataset order via `array_slice(..., 0, 6)` |
| Communities page → Projects | All project records in dataset order |
| Project card → Project page | `project.slug + ".php"` |
| Developer card → Developer page | `developer.slug + ".php"` |
| Developer page → Representative image | First usable hero image or gallery image from the developer's first matching project; otherwise a fixed project placeholder |
| Project → Gallery images | Project record contains a list of local image paths |
| Project → Amenities | Project record contains repeated amenity objects |
| Project → Nearby places | Project record contains repeated place/time/icon objects |
| Project → Districts | Project record contains district items; only DAMAC Islands 2 enables rendering |

All 19 project developer values resolve to existing developer records. MAG Group Holding and Samana Developers have no related projects. No Project → Community entity relationship exists. No Developer → Community relationship exists. No project-to-project, developer-to-developer, page-to-developer selection, category, tag, author, agent, or team-member relationship exists.

## 7. Existing Filters & Groupings

| Grouping/filter | How it currently works |
|---|---|
| Homepage “Featured Projects” | Loads all projects safely, then takes the first six records with `array_slice`; there is no stored featured flag |
| Communities project archive | Displays all project records in JSON order; it is labelled “Featured Communities” but does not filter by community or featured status |
| Developer projects | Groups projects by exact `project.developer` string and retrieves the group using `developer.canonical_name` |
| Developer live-project count | Counts the same exact-match developer project group; zero counts are not displayed |
| Property types on project cards | Parses comma/“and” separated values from `project.hero.headline`; there is no stored property-type taxonomy |
| Homepage property-type grouping | Six hardcoded cards: Apartments, Villas, Townhouses, Waterfront, Commercial, Investment; all link to the enquiry section, not a filtered archive |
| Homepage hero browse chips | Four hardcoded links: Apartments, Villas, Townhouses, Commercial; all jump to the hardcoded property-type cards |
| Homepage featured communities | Six hardcoded editorial cards: Downtown Dubai; Saadiyat Island, Abu Dhabi; Al Marjan Island, Ras Al Khaimah; Aljada, Sharjah; Al Zorah, Ajman; Fujairah Waterfront; all link to enquiry |
| Communities lifestyle grouping | Six hardcoded cards: Waterfront Living, Family Communities, City Living, Distinguished Destinations, Investment Areas, Emerging Communities; links are `#` placeholders and no filtering code exists |
| District grouping | A per-project `districts.enabled` flag controls the strip; only DAMAC Islands 2 is enabled; its district items can carry a launching flag |
| Numeric price vs request | `hero.available_on_request` and `hero.starting_price_million_aed` determine the price presentation and structured-data Offer |
| Amenity/place visibility | Items with blank title/name are removed before rendering; sections render only when filtered items remain |
| Navigation current state | `$current_page` selects the active global navigation item |
| FAQ grouping | Hardcoded question/answer sets exist separately on Services and Communities; matching FAQPage JSON-LD is emitted |

No functional category filter, tag filter, community filter, price filter, bedroom filter, status filter, search filter, sort control, pagination, or AJAX filtering exists.

## 8. Forms

### Form inventory

| Form | Where used | Fields | Duplicated? | Identical/differences |
|---|---|---|---|---|
| Compact project enquiry form (`hero-form`) | Project hero on all 19 project pages | Full name (required); phone (required); email (required); message (optional); hidden source page title; source page slug; source page URL; project name; project slug; developer name | 19 rendered instances from one partial | Same field set as the project card form; compact CSS variant and “Request Project Details” button |
| Card project enquiry form (`main-form`) | Bottom enquiry section on all 19 project pages | Full name (required); phone (required); email (required); message (optional); hidden source page title; source page slug; source page URL; project name; project slug; developer name | 19 rendered instances from one partial | Same field set as compact form; card CSS variant and “Send Enquiry” button |
| Contact consultation form (`main-form`) | `pages/contact.php` | Full name (required); phone (required); email (required); enquiry radio group with Buying Property, Selling Property, Property Investment, Property Management, General Enquiry (default); message (required) | No cross-page duplication; inline markup | Shares name/phone/email/message with project forms; adds enquiry type, makes message required, and has no hidden page/project/developer context |

All forms use client-side validation hooks in `assets/js/main.js`. No PHP form handler, form action URL, database storage, email-sending code, CRM integration, or submission API is present in the inspected project.

## 9. Hardcoded Content Inventory

### Global

- Main navigation labels and URLs: Home, About, Services, Developers, Communities, Contact.
- Header CTA labels and contact destination.
- Footer quick links.
- Company phone: `+971 50 421 7299`.
- WhatsApp destination using the same phone number.
- Company email: `info@smbdubai.net`.
- Office address: `3002 Westburry Tower Office, Business Bay, Dubai, UAE`.
- Site URL and organization/site metadata defaults.
- SVG icon symbol library and icon-name mappings.
- Form labels, placeholders, validation messages, and submit-button labels.
- Project-template section eyebrows, enquiry copy, contact copy, 404 copy, image fallbacks, and sticky CTA labels.
- Developer-template section labels, “Coming Soon” empty state, 404 copy, image fallback, and sticky CTA copy.

### Homepage

- SEO and Open Graph metadata.
- Hero eyebrow, title, headline, two CTA labels, four property browse chips, video/poster/image alternative text.
- Featured-project section title and explanatory copy; selection is first six records rather than a stored feature value.
- Six property-type cards: Apartments, Villas, Townhouses, Waterfront, Commercial, Investment, including descriptions and icons.
- Four process steps: Discover, Consult, Reserve, Own, including descriptions and step numbers.
- Six community names listed in Section 7, including their descriptions and icons.
- Three testimonial quotations and client attributions.
- Three insight titles, excerpts, category/date metadata, and placeholder URLs.
- Final CTA heading, description, action labels, and contact line.

### About

- SEO and Open Graph metadata; hero image, alternative text, title, and description.
- Who We Are title and body copy.
- Four company facts/statistics.
- Team members Haitham Mahdy and Saddam Barakat, their images, roles, and biographies.
- Mission and vision labels, titles, and copy.
- Four values: Transparency, Client Commitment, Market Knowledge, Professional Support, with descriptions.
- Five reasons to choose SMB listed under the page section.
- Final CTA copy and links.

### Services

- SEO and Open Graph metadata; hero image, alternative text, title, and description.
- Intro title/body and image.
- “A Journey Shaped Around You” copy and five hardcoded service/journey points.
- Four process steps: Understand, Advise, Shortlist, Support, with descriptions.
- Four audience cards: First-Time Buyers, Owners & Sellers, Investors, Businesses, with descriptions and icons.
- Five FAQ questions and answers plus a duplicate hardcoded PHP array used for FAQPage JSON-LD.
- Final CTA copy and links.

### Developers directory

- SEO and Open Graph metadata; hero image, alternative text, title, and description.
- Directory section headings.
- Five advisory/help points: Compare Developers Side By Side; Match Projects To Your Budget; Understand Payment Plans; Evaluate Communities Properly; Support The Complete Buying Journey, with descriptions.
- Final CTA copy and links.
- Developer names, biographies, logos, and canonical names are not hardcoded here; they come from JSON.

### Communities

- SEO and Open Graph metadata; hero image, alternative text, title, and description.
- Location-introduction title and body copy.
- Project archive section labels.
- Six lifestyle labels listed in Section 7, descriptions, icons, and nonfunctional placeholder links.
- Six location-decision steps: Define The Purpose; Balance Use And Return; Test The Connections; Examine What The Budget Buys; Set A Realistic Shortlist; Move Forward With Certainty, with descriptions.
- Six FAQ questions and answers and matching FAQPage structured-data content.
- Final CTA copy and links.
- The cards in the “Featured Communities” archive use project JSON data; there is no separate hardcoded community dataset for that archive.

### Contact

- SEO and Open Graph metadata; hero image, alternative text, title, and description.
- Phone, WhatsApp, and email method-card labels and copy.
- Consultation section heading and explanatory copy.
- Five enquiry-type options.
- Office title, phone, WhatsApp availability, email, and address.
- Direct-conversation section and final CTA copy and links.

### Project/developer structured content

- Project content is stored in `data/projects.json`, not in individual wrapper files.
- Developer content is stored in `data/developers.json`, not in individual wrapper files.
- Project and developer wrapper slugs are hardcoded once per wrapper file.
- Section labels, empty states, contact details, form UI copy, fallback images, and CTA copy remain hardcoded in the shared templates.
- Image provenance and derivative metadata are stored in 18 asset `image-library.json` files but are not runtime page content.

## 10. Initial WordPress Candidates (NO DESIGN)

### Potential Pages

- Home
- About
- Services
- Developers
- Communities
- Contact

### Potential Custom Post Types

- Project
- Developer

### Potential Taxonomies

- Property Type
- Location
- Lifestyle
- Project Status
- Amenity

### Potential Relationships

- Project → Developer
- Developer → Projects
- Page → Projects
- Project → Districts
- Project → Amenities
- Project → Nearby Places

### Potential Custom Fields

- Slug
- Name
- Display Name
- Canonical Name
- Biography
- Logo
- Developer
- Location Label
- Page Title
- Page Description
- Open Graph Title
- Open Graph Description
- Open Graph Image
- Hero Headline
- Hero Description
- Hero Image
- Starting Price Million AED
- Available On Request
- Price Note
- Trust Badges
- Structured Data Type
- Structured Data Name
- Structured Data Description
- Structured Data Image
- Address Locality
- Districts Enabled
- Districts Introduction
- District Name
- District Launching
- Fact Label
- Fact Value
- Fact Icon
- Overview Title
- Overview Paragraph
- Overview Card Value
- Overview Card Label
- Overview Card Icon
- Gallery Title
- Gallery Image
- Amenities Title
- Amenity Title
- Amenity Description
- Amenity Icon
- Location Title
- Location Description
- Location Background Image
- Nearby Place Name
- Nearby Place Travel Time
- Nearby Place Icon
