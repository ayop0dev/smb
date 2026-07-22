# Project Field Dictionary

All project objects retain every schema key. “Required” below means the key must exist; values may still be empty or null where the source does not verify them. “Optional” means the value is optional while the key remains required by schema.

| Field | Type | Value requirement | WordPress / ACF mapping |
|---|---|---|---|
| `schema_version` | string | Required | Dataset schema version; store as configuration, not CPT content. |
| `generated_at` | ISO-8601 string | Required | Import/audit metadata. |
| `research_notes` | object/group | Required | Global import notes; options page or migration metadata. |
| `projects` | array/repeater | Required | One row per project; each row maps to one project CPT post. |
| `slug` | string | Required | WordPress post_name. |
| `name` | string | Required | WordPress post_title. |
| `developer` | object/group | Required | ACF group: developer_name, developer_website, project_url; developer name may later become a taxonomy/relationship. |
| `status` | object/group | Required | ACF group for launch/construction status, verified date and change flag. |
| `seo` | object/group | Required | SEO plugin fields or ACF fallback: title, meta and Open Graph copy. |
| `hero` | object/group | Required | ACF hero group; starting_price is a nested group and trust_badges is a repeater/array. |
| `hero.starting_price.amount` | number|null | Optional | Numeric ACF field in AED; never store formatted text here. |
| `hero.starting_price.display` | string | Optional | Display fallback for ranges, sold-out or request-only states. |
| `location` | object/group | Required | ACF group; community may later be taxonomy; nearby_destinations is a repeater. |
| `location.latitude / longitude` | number|null | Optional | ACF number fields for map integration. |
| `location.nearby_destinations` | array/repeater | Optional | Repeater: name, travel_time, travel_mode, verified. |
| `property_details` | object/group | Required | ACF group; property_types and bedrooms are multi-select/checkbox arrays. |
| `property_details.handover` | object/group | Required | ACF group: display, machine date, verified flag. |
| `property_details.built_up_area / plot_area` | object/group | Required | ACF groups with numeric minimum/maximum, unit and display. |
| `property_details.total_units / tower_count` | integer|null | Optional | ACF number fields. |
| `commercial` | object/group | Required | ACF group containing payment plan and service charge groups. |
| `commercial.payment_plan` | object/group | Required | ACF group with summary and numeric percentage fields. |
| `commercial.service_charge` | object/group | Required | ACF group with display, numeric amount, unit and verified. |
| `overview` | object/group | Required | ACF group; paragraphs and stats are repeaters. |
| `overview.paragraphs` | array/repeater | Optional | Repeater or rich-text blocks; preserve paragraph boundaries. |
| `overview.stats` | array/repeater | Optional | Repeater: value, label, icon. |
| `highlights` | array/repeater | Optional | Repeater: value, label, icon. |
| `amenities` | array/repeater | Optional | Repeater: name, description, category, icon; category may become taxonomy. |
| `gallery` | object/group | Required | ACF group; images is a repeater referencing locally approved media later. |
| `gallery.images` | array/repeater | Optional | Research-only URL/caption/alt/status entries; import approved images into Media Library before publishing. |
| `optional_sections` | array/flexible content | Optional | ACF Flexible Content; type selects layout and items stores layout-specific repeater data. |
| `cta` | object/group | Required | ACF CTA group for heading, description, sticky label/value/action. |
| `structured_data` | object/group | Required | ACF/schema group; map into generated JSON-LD, not raw user HTML. |
| `sources` | array/repeater | Required | Private/admin ACF repeater: title, URL, source type, publisher, accessed date, supported fields. |
| `verification` | object/group | Required | Private/admin ACF group; status plus repeaters for verified/unverified fields, conflicts and notes. |

## Primitive Conventions

- Unknown scalar: `null` for numeric/date values, empty string for unavailable display text.
- Unknown list: empty array.
- Dates: `YYYY-MM-DD` only when a calendar date is confirmed; quarter/year-only claims remain in `display`.
- Currency: numeric AED values without separators in `amount`; formatted wording in `display`.
- Icons: stable icon-library identifiers, not SVG markup.
- Source URLs: canonical URLs without tracking parameters.

## Repeater And Flexible Content Guidance

Use ACF Repeaters for trust badges, nearby destinations, overview paragraphs/stats, highlights, amenities, gallery images, sources, and verification lists. Use an ACF Group for fixed nested objects. Map `optional_sections` to ACF Flexible Content so project-specific blocks do not alter the shared base schema. Arrays such as property types and bedrooms may use checkbox/multi-select fields when their vocabulary is controlled.

## Publishing Guidance

Research and verification fields should be visible to editors but not necessarily rendered publicly. Time-sensitive fields should display their verified date in the editorial interface and should require review before publication. External gallery URLs are research references only and must never be hotlinked.
