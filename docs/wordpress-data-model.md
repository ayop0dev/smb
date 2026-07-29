# SMB Real Estate — WordPress Data Model

Status: Definitive architecture  
Basis: Current implementation inventory dated 2026-07-29

## 1. System Overview

WordPress is the content-management layer for the existing SMB Real Estate website.

The theme is responsible only for presentation: templates, template parts, CSS, JavaScript, and rendering. It consumes content but does not define content types, fields, relationships, validation rules, forms, global settings, or administrative behavior.

The project plugin owns the real-estate data model and its administration. It defines the Project and Developer custom post types, the Emirate taxonomy, the Project-to-Developer relationship, the fields listed in this document, validation, forms, global settings, and related admin behavior.

The default WordPress Posts, Categories, and Tags remain unchanged and are reserved exclusively for future blog or article content. Projects and Developers must not use Categories or Tags.

This model intentionally contains:

- two custom post types: Project and Developer;
- one custom taxonomy: Emirate;
- one content relationship: Project to Developer; and
- no Community content type or taxonomy.

Standard WordPress Pages remain appropriate for Home, About, Services, Developers, Communities, and Contact. Their existing editorial content is page content, not part of the real-estate record model defined below.

## 2. Content Types

### 2.1 Project

**Purpose**

A Project is the canonical record for one real-estate development displayed by SMB.

**Responsibilities**

- Own the project's identity, location text, commercial summary, project-specific SEO, hero content, optional district content, facts, overview, gallery, amenities, and location/connectivity content.
- Select its Developer through the approved relationship.
- Receive at least one Emirate term and support assignment to multiple Emirate terms.
- Supply content to the project detail page and reusable project cards.

**Editable by administrator?**

Yes. Administrators can create, edit, publish, unpublish, and delete Project records; edit their approved fields; choose a published Developer through the controlled relationship field; and assign one or multiple Emirate terms. A Project cannot be published without a Developer and at least one Emirate term.

**Frontend usage**

- Single Project detail pages.
- Project cards on the homepage, Communities page, and Developer pages.
- Project listings already represented by the current site.
- Project-specific enquiry context.
- Project structured data derived from the Project record.

**WordPress-native properties**

- Title: project name.
- Slug: project URL identifier.
- Publication status and publication controls.

The default content editor is not a second source for the project overview. Project narrative is stored in the explicit overview fields defined in Section 4.

### 2.2 Developer

**Purpose**

A Developer is the canonical record for one property developer represented on the website.

**Responsibilities**

- Own the developer's public name, biography, and logo.
- Act as the relationship target selected by Projects.
- Supply content to the developer directory, Developer detail page, and project cards.

**Editable by administrator?**

Yes. Administrators can create, edit, publish, unpublish, and delete Developer records and edit their approved fields. Deletion must be prevented while Projects still reference the Developer, unless those Project relationships are reassigned or removed first.

**Frontend usage**

- Developer directory.
- Single Developer detail pages.
- Developer identity and link on Project pages and project cards.
- Developer project listings derived from Projects that reference the Developer.
- Developer project counts derived from the same relationship.

**WordPress-native properties**

- Title: public developer display name.
- Slug: developer URL identifier.
- Publication status and publication controls.

The WordPress record is the canonical identity. A separate canonical-name field is not required: the current `canonical_name` string exists only to make text-based JSON matching possible. WordPress relationships replace that matching mechanism.

## 3. Taxonomies

### 3.1 Emirate

**Purpose**

Emirate provides the approved project-specific geographic classification at emirate level. It does not replace the Project's free-text Location field.

**Attached post type**

Project only.

**Hierarchical or not**

Hierarchical. The current site uses a single level, but the hierarchical behavior provides the appropriate controlled WordPress administration for named geographic terms. No child-term structure is required by the current implementation.

**Frontend usage**

- Identify and group Projects by any of their assigned emirates where the presentation calls for it.
- Support emirate-aware Project URLs, listings, or labels only when implemented by the future presentation layer, including Projects assigned to multiple Emirates.
- Supply one or more controlled emirate values independently of the more specific human-readable Location field.

A publishable Project must have at least one Emirate term assigned and may have multiple Emirate terms. This supports Projects with versions, phases, or implementations in more than one Emirate. Current content requires only terms evidenced by the existing Projects: Dubai and Abu Dhabi.

No Community taxonomy is permitted. Categories and Tags must not be attached to Project or Developer.

## 4. Field Groups

Field names below are architectural names, not implementation keys. “Required” describes content validity for a publishable record. Empty values already supported by the current templates remain optional.

### 4.1 Project field groups

#### A. Classification and relationship

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Developer | Single Developer relationship selected from existing published Developer records | Required for a publishable Project | Replaces the current developer-name string and supplies the linked Developer through a searchable select or equivalent controlled relationship field |
| Emirate | One or more Emirate terms | At least one term required for a publishable Project | Approved controlled project-specific taxonomy; multiple terms are permitted |
| Location | Single-line text | Required for a publishable Project | Human-readable marketing or display location shown in the hero, cards, Project page, metadata, and structured-data derivation where appropriate |
| Google Maps Embed Code | Google Maps Embed HTML | Optional | Stores the complete Google Maps Embed HTML copied directly from Google Maps |

##### Google Maps Embed Code

**Administrator workflow**

1. Open Google Maps.
2. Select Share.
3. Select Embed a map.
4. Copy HTML.
5. Paste the entire HTML into this field.

The administrator is never expected to extract attributes or modify the HTML.

**Plugin behavior**

- Accept the pasted Google Maps Embed HTML.
- Extract only the validated Google Maps Embed URL from the iframe's `src` attribute.
- Store only the validated Embed URL.
- Never store the original HTML.
- Never render administrator HTML directly.
- The Theme generates the iframe using the stored validated URL.

##### Validation

- Only Google Maps Embed HTML is accepted.
- Only HTTPS Google Maps Embed URLs are valid.
- The iframe `src` must point to an approved Google Maps Embed endpoint.
- Reject arbitrary HTML.
- Reject JavaScript.
- Reject inline event attributes.
- Reject iframe code from non-Google domains.
- Ignore every iframe attribute except the validated embed URL.
- The generated frontend iframe must always be created by the Theme, never by administrator-provided HTML.

Location examples include `Business Bay, Dubai`, `Sheikh Zayed Road`, `Jumeirah Village Circle`, and `Fahid Island, Abu Dhabi`. Location is not a taxonomy and must not replace Emirate classification.

Google Maps Embed Code does not replace Location and does not create a relationship, taxonomy, or content type.

Project name and slug use the native WordPress title and slug rather than custom fields.

The Developer field must be presented to administrators as a searchable select or equivalent controlled relationship field. Administrators select an existing published Developer record; they never type a Developer name or enter or see a WordPress post ID. The Project must not duplicate the selected Developer's name, biography, logo, slug, or URL.

#### B. Search and social metadata

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Page title | Single-line text | Optional | Project SEO page title |
| Page description | Multi-line text | Optional | Project meta description |
| Open Graph title | Single-line text | Optional | Project Open Graph title |
| Open Graph description | Multi-line text | Optional | Project Open Graph description |
| Open Graph image | Single image | Optional | Project Open Graph image |

The current structured-data name, description, image, and address locality duplicate content already owned by the Project. They are derived as follows and are not additional editorial fields:

- structured-data name from the Project title;
- structured-data description from the project description, with the page description as fallback;
- structured-data image from the hero image;
- structured-data address locality from the human-readable Location field, using assigned Emirate classification where appropriate;
- Offer data from the starting-price fields;
- address country fixed by the system to the current `AE` value.

Schema type is the only structured-data value that is not safely derivable from another current field and remains editable in the Hero and commercial group below.

#### C. Hero and commercial summary

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Headline | Single-line text | Required | Property-type headline shown in the Project hero and parsed for the current project-card type label |
| Description | Multi-line text | Required | Project hero description |
| Hero image | Single image | Required | Project hero background and primary project image |
| Structured-data type | Controlled choice: Residence or Office Building | Required | Preserves the current Project schema type |
| Starting price in millions of AED | Positive decimal number, maximum two decimal places | Conditional | Numeric starting price used by the hero, cards, sticky CTA, and structured Offer |
| Available on request | Boolean | Required | Indicates that no numeric starting price is currently available |
| Price note | Single-line text | Optional | Existing explanatory price note |
| Trust badges | Ordered list of text values, maximum 3 | Optional | Existing hero trust badges |

Starting price and Available on request are mutually exclusive: when Available on request is enabled, the numeric price must be empty; when it is disabled, a positive numeric price is required.

#### D. Optional district strip

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Show district strip | Boolean | Required | Preserves the enabled state used by DAMAC Islands 2 |
| District introduction | Multi-line text | Required when shown | Existing district-strip introduction |
| Districts | Ordered list | Required when shown | Existing district entries |
| District name | Single-line text per item | Required per item | District label |
| Launching | Boolean per item | Optional | Existing “Launching” state |

These are Project fields, not a District taxonomy or content type.

#### E. Key facts

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Key facts | Ordered list of exactly 4 items | Required | Existing four-position fact row |
| Fact value | Single-line text per item | Required | Displayed fact value |
| Fact label | Single-line text per item | Required | Displayed fact label |
| Fact icon | Controlled existing icon choice per item | Required | Displayed fact icon |

The icon choices must be limited to the icon identifiers already supported by the current project implementation. Administrators select an icon; they do not create icon identifiers.

#### F. Overview

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Overview title | Single-line text | Required | Project overview heading |
| Overview paragraphs | Ordered list of text paragraphs | Required, at least 1 | Existing one-or-more overview paragraphs |
| Overview statistic cards | Ordered list of exactly 3 items | Required | Existing three-card overview layout |
| Statistic value | Single-line text per item | Required | Statistic value |
| Statistic label | Single-line text per item | Required | Statistic label |
| Statistic icon | Controlled existing icon choice per item | Required | Statistic icon |

#### G. Gallery

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Gallery title | Single-line text | Required | Existing gallery section title |
| Gallery images | Ordered image collection, maximum 4 | Required | Existing four-position project gallery and lightbox |

Image alternative text is managed on the WordPress Media item. The image-library provenance manifests are not runtime content and do not become Project fields.

#### H. Amenities

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Amenities title | Single-line text | Required | Existing amenities section title |
| Amenities | Ordered list | Optional | Existing variable-length amenity collection |
| Amenity title | Single-line text per item | Required per non-empty item | Amenity name |
| Amenity description | Multi-line text per item | Required per non-empty item | Amenity description |
| Amenity icon | Controlled existing icon choice per item | Required per non-empty item | Amenity icon |

Empty placeholder rows must not be stored. An empty Amenities list is valid because the current implementation supports Projects without usable amenity content.

#### I. Location and connectivity

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Location section title | Single-line text | Required | Existing location/connectivity heading |
| Location description | Multi-line text | Required | Existing location/connectivity description |
| Location background image | Single image | Required | Existing location section background |
| Nearby places | Ordered list, maximum 4 | Optional | Existing nearby-place collection |
| Place name | Single-line text per item | Required per non-empty item | Destination name |
| Travel time | Single-line text per item | Required per non-empty item | Existing human-readable travel time |
| Place icon | Controlled existing icon choice per item | Required per non-empty item | Destination icon |

The Project's human-readable Location remains a separate single-line text field. The location/connectivity fields in this group describe the existing Project-page section and do not replace either Location or Emirate classification. Nearby places are nested Project content, not relationships, taxonomies, or separate content types. Empty placeholder rows must not be stored.

### 4.2 Developer field groups

#### A. Developer identity and profile

| Field | Content shape | Requirement | Current-content purpose |
|---|---|---:|---|
| Biography | Multi-line text | Required | Existing developer biography used in the hero, overview, and page description |
| Logo | Single image | Required | Existing developer logo |

Developer display name and slug use the native WordPress title and slug. No separate canonical-name field is retained because Project relationships identify the Developer record directly.

The current developer hero/overview image is derived from the first usable image belonging to a related Project, with the existing presentation fallback when no related Project has an image. It is not a Developer field.

Related Projects and live-project count are reverse queries of the Project-to-Developer relationship. They are not stored Developer fields.

No developer headquarters, founded year, website, contact details, gallery, facts, statistics, location, or taxonomy fields are part of this model.

## 5. Relationships

### 5.1 Project to Developer

**Cardinality**

- Each Project belongs to exactly one Developer.
- Each Developer may have zero, one, or many Projects.

This is a many-to-one relationship from Project to Developer.

**Data ownership**

The Project owns the relationship by storing the selected Developer reference. The relationship is required for a publishable Project and may target only an existing published Developer record. The Developer does not store a duplicate list of Project references.

Developer name, biography, logo, and URL belong to the Developer record. They must not be copied into Project fields. Project lists and counts for a Developer are calculated from published Projects that reference that Developer.

In administration, the Developer field is a searchable select or equivalent controlled relationship field. The administrator selects a Developer record by its human-readable identity, never manually types a Developer name, and never sees or enters a WordPress post ID. The relationship does not duplicate the Developer name, biography, logo, slug, or URL in the Project record.

**Display ownership**

- The Project presentation displays its selected Developer's name and link.
- Project cards may display the related Developer's name and link.
- The Developer presentation displays a list of Projects that reference it.
- The theme decides markup, placement, ordering presentation, empty states, and fallbacks.
- The plugin provides the relationship, valid selections, queries, and validation.

Changing a Developer's title or slug updates all relationship-driven displays without editing its Projects. A Developer with related Projects cannot be deleted until those relationships are resolved.

There are no other content relationships. Emirate assignment is taxonomy classification, not a post relationship.

## 6. Global Settings

The following values already exist as shared or repeated site-wide data and must be managed once as plugin-owned global settings rather than copied into Pages, Projects, Developers, or templates.

### 6.1 Company identity

| Setting | Existing use |
|---|---|
| Company legal name | Footer copyright and organization structured data |
| Company tagline | Footer brand content |
| Company summary | Footer brand content and organization structured data |
| Site URL | Canonical organization/site metadata base |

### 6.2 Brand Settings

| Setting | Existing use |
|---|---|
| Primary logo | Primary site branding, including the current horizontal-logo presentation |
| Secondary logo | Alternate site branding, including the current vertical-logo asset |
| Favicon | Browser and site-identity icon |
| Default social sharing image | Global fallback image for social metadata when content-specific sharing imagery is unavailable |

These media values are global site settings managed once. Projects, Developers, and Pages must not duplicate them. The theme consumes them for presentation and metadata. Administrators may replace their media values but may not add new settings or alter the Brand Settings structure.

### 6.3 Contact details

| Setting | Existing use |
|---|---|
| Phone display value | Visible header, footer, Contact page, Project enquiry section, and CTAs |
| Phone dial value | `tel:` destinations and structured data |
| WhatsApp number or destination | Repeated WhatsApp actions |
| Email address | Header/footer-related contact output, Contact page, Project enquiry section, and CTAs |
| Office address display value | Footer, Contact page, and Project enquiry section |
| Office street address | Organization structured data |
| Office locality | Organization structured data |
| Office country code | Organization structured data |

### 6.4 Shared legal content

| Setting | Existing use |
|---|---|
| Property information disclaimer | Global footer disclaimer |

Navigation labels, section headings, CTA wording, form labels, validation messages, fallback copy, and page-specific editorial content remain presentation or Page content; they are not global business-data settings.

No social profile URLs currently exist in the implementation. Therefore no social-link settings are included. Icon symbols alone are not content evidence.

## 7. Administrator Permissions

Administrators manage content. Developers manage system structure.

### 7.1 Administrators can

- Create, edit, publish, unpublish, and delete Projects, subject to relationship integrity.
- Edit every Project field defined in Section 4.1.
- Choose exactly one existing published Developer for each publishable Project through the searchable select or equivalent controlled relationship field.
- Assign one or multiple Emirate terms to a Project, with at least one term required for publication.
- Manage the required human-readable Location text.
- Manage the optional Google Maps Embed Code.
- Create, edit, publish, and unpublish Developers.
- Delete a Developer only when no Project references it.
- Edit Developer biography and logo.
- Manage the approved Emirate terms needed by Project content.
- Edit the global settings defined in Section 6.
- Replace the media values for Primary logo, Secondary logo, Favicon, and Default social sharing image.
- Manage standard WordPress Pages and their existing editorial content.
- Use default Posts, Categories, and Tags only for future blog/article content.
- Manage media used by the approved fields.
- Review and manage form submissions if submission storage is introduced by the plugin.

### 7.2 Administrators cannot

- Create new custom post types.
- Create new custom taxonomies or attach Categories or Tags to Projects or Developers.
- Create a Community taxonomy or Community content type.
- Publish a Project with no Emirate term assigned.
- Type an arbitrary Developer name instead of selecting an existing published Developer record.
- Enter or manage a WordPress post ID for the Developer relationship.
- Change the Developer relationship type.
- Paste arbitrary HTML or iframe code from non-Google domains into the Google Maps Embed Code field.
- Add latitude, longitude, or other map fields.
- Add new Brand Settings or otherwise alter the structure of Brand Settings.
- Add, remove, rename, reorder structurally, or change the data type of fields or field groups.
- Change relationship cardinality or make Developer project lists independently editable.
- Add unapproved real-estate fields, including video, payment plan, floor plans, brochure, unit inventory, or availability collections.
- Add unapproved Developer fields, including headquarters or founded year.
- Change validation rules, controlled icon choices, schema choices, or publish requirements.
- Edit plugin logic, form processing rules, administrative logic, theme files, templates, template parts, CSS, JavaScript, or rendering behavior through content controls.
- Use Project or Developer records as blog posts.

### 7.3 Developers are responsible for

- The definitions of content types, taxonomy, fields, relationships, validation, forms, global settings, and admin behavior in the plugin.
- The presentation implementation in the theme.
- Structural changes, migrations, permission changes, and additions to this data model.

Any future structural change requires an explicit architecture decision and an update to this document before implementation.
