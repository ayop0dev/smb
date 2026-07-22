# Project Data Audit Report

Audit date: 2026-07-22  
Scope: identity, developer pairing, physical UAE location, normalized geography, project-specific URLs, and supported factual/commercial fields. The original projects-research.json was not overwritten.

## 1. Executive summary

- Total records audited: **20**
- Confirmed as physically located in the UAE: **18**
- Records requiring at least one correction or evidence correction: **20**
- Rejected as non-UAE or incorrectly identified: **1**
- Still unresolved: **1**
- Records in the corrected implementation dataset: **18**

The decisive rejection is **SAMANA Ocean Views**: Samana's official page identifies the exact project as water villas in the Maldives. **Keturah Ardh** remains blocked because the accessible official portfolio confirms the name and MAG association but does not establish a project-specific physical UAE location.

## 2. Project-by-project audit table

| Developer | Listed project | Identity result | UAE location result | Data quality | Action taken |
|---|---|---|---|---|---|
| Emaar Properties | The Grand Polo Club & Resort | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Aldar Properties | Fahid Island | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| DAMAC Properties | Riverside Views | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Nakheel | Bay Grove Residences (Dubai Islands) | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Dubai Properties | La Tilia at Villanova | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Sobha Realty | Sobha Central | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Meraas | The Acres Estates | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Binghatti Developers | Binghatti Aquarise | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Danube Properties | Sparklz by Danube | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Azizi Developments | Azizi Milan | Partially verified | Confirmed | Usable with missing optional fields | Retained conservatively |
| MAG Group Holding | Keturah Ardh | Partially verified | Unresolved | Blocked pending manual decision | Excluded pending approval |
| Ellington Properties | Everly Place | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Samana Developers | Samana Ocean Views | Non-UAE project | Rejected â€” Maldives | Not suitable for the UAE project collection | Excluded pending approval |
| Deyaar Development | Downtown Residences | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Omniyat | Lumena | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Iman Developers | One Park Central | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Reportage Properties | Verdana Empire | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Tiger Properties | Tiger Sky Tower | Partially verified | Confirmed | Usable with missing optional fields | Retained conservatively |
| Pantheon Development | Pantheon Elysee Heights | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |
| Select Group | Six Senses Residences Dubai Marina | Confirmed | Confirmed | Ready for template implementation | Corrected/confirmed |

## 3. Corrections made

The table below records substantive identity/location changes. In addition, every record's sources were rebuilt so that supports no longer asserts unsupported detailed facts.

| Project | Field | Previous value | Corrected value | Reason | Supporting source |
|---|---|---|---|---|---|
| The Grand Polo Club & Resort | `location.full_label` | Dubai South, Dubai, Dubai | Dubai South, Dubai | Removed duplicate emirate/city wording. | [https://properties.emaar.com/en/our-communities/grand-polo-club-and-resort/](https://properties.emaar.com/en/our-communities/grand-polo-club-and-resort/) |
| The Grand Polo Club & Resort | `name` | The Grand Polo Club & Resort | Grand Polo Club & Resort | Aligned to the official project title. | [https://properties.emaar.com/en/our-communities/grand-polo-club-and-resort/](https://properties.emaar.com/en/our-communities/grand-polo-club-and-resort/) |
| Fahid Island | `location.full_label` | Fahid Island, Abu Dhabi, Abu Dhabi | Fahid Island, Abu Dhabi | Removed duplicate emirate/city wording. | [https://www.aldar.com/en/news-and-media/aldar-unveils-fahid-island](https://www.aldar.com/en/news-and-media/aldar-unveils-fahid-island) |
| Riverside Views | `location.full_label` | Dubai Investments Park, Dubai, Dubai | Dubai Investments Park, Dubai | Removed duplicate emirate/city wording. | [https://preprod.damacproperties.com/en/projects/damac-riverside-views/](https://preprod.damacproperties.com/en/projects/damac-riverside-views/) |
| Riverside Views | `name` | Riverside Views | DAMAC Riverside Views | Official project-specific page uses the DAMAC-prefixed name. | [https://preprod.damacproperties.com/en/projects/damac-riverside-views/](https://preprod.damacproperties.com/en/projects/damac-riverside-views/) |
| Bay Grove Residences (Dubai Islands) | `location.full_label` | Dubai Islands, Dubai, Dubai | Dubai Islands, Dubai | Removed duplicate emirate/city wording. | [https://www.nakheel.com/en/new-launches/baygrove-residences](https://www.nakheel.com/en/new-launches/baygrove-residences) |
| Bay Grove Residences (Dubai Islands) | `name` | Bay Grove Residences (Dubai Islands) | Bay Grove Residences | Dubai Islands is the location, not part of the official project title. | [https://www.nakheel.com/en/new-launches/baygrove-residences](https://www.nakheel.com/en/new-launches/baygrove-residences) |
| La Tilia at Villanova | `location.full_label` | Villanova, Dubailand, Dubai, Dubai | Villanova, Dubailand, Dubai | Removed duplicate emirate/city wording. | [https://villanova.dp.ae/](https://villanova.dp.ae/) |
| Sobha Central | `location.full_label` | Sheikh Zayed Road, Dubai, Dubai | Sheikh Zayed Road, Dubai | Removed duplicate emirate/city wording. | [https://sobharealty.com/properties-in-dubai/sobha-central](https://sobharealty.com/properties-in-dubai/sobha-central) |
| The Acres Estates | `location.full_label` | The Acres, Dubailand, Dubai, Dubai | The Acres, Dubailand, Dubai | Removed duplicate emirate/city wording. | [https://theacres.meraas.com/](https://theacres.meraas.com/) |
| Binghatti Aquarise | `location.full_label` | Business Bay, Dubai, Dubai | Business Bay, Dubai | Removed duplicate emirate/city wording. | [https://www.binghatti.com/en-uk/projects/binghatti-aquarise](https://www.binghatti.com/en-uk/projects/binghatti-aquarise) |
| Sparklz by Danube | `location.full_label` | Al Furjan, Dubai, Dubai | Al Furjan, Dubai | Removed duplicate emirate/city wording. | [https://promotions.danubeproperties.com/sparklz_int/](https://promotions.danubeproperties.com/sparklz_int/) |
| Azizi Milan | `location.full_label` | City of Arabia, Dubai, Dubai | City of Arabia, Dubai | Removed duplicate emirate/city wording. | [https://www.propertyfinder.ae/en/new-projects/azizi-developments/azizi-milan](https://www.propertyfinder.ae/en/new-projects/azizi-developments/azizi-milan) |
| Keturah Ardh | `location.full_label` | Dubai, Dubai | Dubai | Removed duplicate emirate/city wording. | [https://keturah.global/terms/](https://keturah.global/terms/) |
| Everly Place | `location.full_label` | Meydan Horizon, Mohammed Bin Rashid City, Dubai, Dubai | Meydan Horizon, Mohammed Bin Rashid City, Dubai | Removed duplicate emirate/city wording. | [https://everly-place.ellingtonproperties.ae/](https://everly-place.ellingtonproperties.ae/) |
| Samana Ocean Views | `location.full_label` | Haa Alif Medhafushi | Haa Alif Medhafushi,  | Removed duplicate emirate/city wording. | [https://www.samanadevelopers.com/projects/samana-ocean-views?lang=en](https://www.samanadevelopers.com/projects/samana-ocean-views?lang=en) |
| Downtown Residences | `location.full_label` | Business Bay / Downtown Dubai gateway, Dubai, Dubai | Business Bay / Downtown Dubai gateway, Dubai | Removed duplicate emirate/city wording. | [https://www.deyaar.ae/en/media_center/deyaar-unveils-downtown-residences-in-dubai-one-of-the-worlds-tallest-vertical-residential-communities/](https://www.deyaar.ae/en/media_center/deyaar-unveils-downtown-residences-in-dubai-one-of-the-worlds-tallest-vertical-residential-communities/) |
| Lumena | `location.full_label` | Business Bay, Dubai, Dubai | Business Bay, Dubai | Removed duplicate emirate/city wording. | [https://www.omniyat.com/commercial/lumena-by-omniyat](https://www.omniyat.com/commercial/lumena-by-omniyat) |
| Lumena | `structured_data.schema_type` | Place | OfficeBuilding | LUMENA is a commercial office tower, not a residential development. | [https://www.omniyat.com/commercial/lumena-by-omniyat](https://www.omniyat.com/commercial/lumena-by-omniyat) |
| One Park Central | `location.full_label` | Jumeirah Village Circle, Dubai, Dubai | Jumeirah Village Circle, Dubai | Removed duplicate emirate/city wording. | [https://www.imandevelopers.com/media-centers/groundbreaking-ceremony-of-one-park-central-launch](https://www.imandevelopers.com/media-centers/groundbreaking-ceremony-of-one-park-central-launch) |
| Verdana Empire | `location.full_label` | Dubai Investments Park, Dubai, Dubai | Dubai Investments Park, Dubai | Removed duplicate emirate/city wording. | [https://reportageempire.com/en/project-details/verdana-empire](https://reportageempire.com/en/project-details/verdana-empire) |
| Tiger Sky Tower | `location.full_label` | Business Bay, Dubai, Dubai | Business Bay, Dubai | Removed duplicate emirate/city wording. | [https://metropolitan.realestate/business-bay/tiger-sky-tower/](https://metropolitan.realestate/business-bay/tiger-sky-tower/) |
| Pantheon Elysee Heights | `location.full_label` | Jumeirah Village Circle, Dubai, Dubai | Jumeirah Village Circle, Dubai | Removed duplicate emirate/city wording. | [https://pantheondevelopment.ae/projects/](https://pantheondevelopment.ae/projects/) |
| Pantheon Elysee Heights | `name` | Pantheon Elysee Heights | Elysee Heights | Official portfolio lists the project as Elysee Heights. | [https://pantheondevelopment.ae/projects/](https://pantheondevelopment.ae/projects/) |
| Six Senses Residences Dubai Marina | `location.full_label` | Dubai Marina, Dubai, Dubai | Dubai Marina, Dubai | Removed duplicate emirate/city wording. | [https://www.select-group.ae/developments/six-senses-residences-dubai-marina](https://www.select-group.ae/developments/six-senses-residences-dubai-marina) |

Additional evidence-led corrections include: Binghatti Aquarise units and Q1 2027 completion from Binghatti's official release; Sparklz unit types, Q2 2028 completion and current official starting-price display; Verdana Empire's apartment/townhouse mix; LUMENA's commercial OfficeBuilding classification; removal of the unsupported Six Senses service-charge claim; and replacement of homepage/unit-detail/brochure URLs with project-level URLs where available.

## 4. Rejected or unresolved records

### SAMANA Ocean Views â€” rejected, non-UAE

The [official Samana project page](https://www.samanadevelopers.com/projects/samana-ocean-views?lang=en) identifies SAMANA Ocean Views as water villas in the Maldives. The original record's Maldives community was therefore not a mere location typo. No exact UAE project with this identity was verified, and no different Samana project was substituted. The record is excluded pending an explicit replacement decision.

### Keturah Ardh â€” unresolved location

The [official Keturah portfolio/terms page](https://keturah.global/terms/) confirms that Keturah Ardh belongs to the Keturah portfolio operated by MAG of Life. The accessible source does not provide a project-specific physical site, community, or city. Because a Dubai corporate address is not evidence of a project's physical location, the record remains excluded pending project-specific official documentation or manual approval.

## 5. Commercial-data warnings

- All prices, availability and payment plans are time-sensitive and subject to change.
- Sobha Central: price and completion wording may be tower-specific; do not generalize a latest-tower value to the whole six-tower masterplan.
- Bay Grove Residences: unit totals vary by phase (296 in the 2024 release; 257 in the final phase). The audited record retains the explicitly identified final-phase figures.
- Binghatti Aquarise: current inventory prices vary by unit type; the displayed minimum is not a project-wide guaranteed offer.
- Sparklz: official promotional variants showed inconsistent bedroom summaries; the broader official page supports Studio through 3BR.
- Azizi Milan: prices, payment plans, tower/unit totals and handover claims vary across secondary sources; unsupported commercial details remain blank.
- Everly Place: the current official payment schedule is subject to SPA milestones and availability.
- Downtown Residences: Q4 2030 is a target stated at launch, not a delivery guarantee.
- LUMENA: sold out; launch pricing and payment plan are historical/commercial context, not current availability.
- One Park Central: launch price is historical and current availability was not independently established.
- Verdana Empire: portals conflict on unit mix, unit counts and pricing; only the broad official project mix is retained, and handover remains unverified.
- Tiger Sky Tower: official project-specific evidence was unavailable; height, unit count, price, payment plan and handover remain omitted or unverified.
- Elysee Heights: the developer portfolio supports 2026 completion, but current availability and launch-price history should not be presented as live inventory.
- Six Senses Residences Dubai Marina: service charge was removed and payment-plan/handover verification flags were downgraded because the current official project page does not support those commercial details.

## 6. Implementation readiness

### Ready for template implementation

- `grand-polo-club-resort`
- `fahid-island`
- `damac-riverside-views`
- `bay-grove-residences`
- `la-tilia-at-villanova`
- `sobha-central`
- `the-acres-estates`
- `binghatti-aquarise`
- `sparklz-by-danube`
- `everly-place`
- `downtown-residences`
- `lumena`
- `one-park-central`
- `verdana-empire`
- `elysee-heights`
- `six-senses-residences-dubai-marina`

### Usable with missing optional fields

- zizi-milan â€” UAE location corroborated by two independent UAE portals; official project page unavailable.
- 	iger-sky-tower â€” UAE location corroborated by two independent UAE property sources; official project page unavailable.

### Blocked pending manual decision

- keturah-ardh â€” project-specific UAE location not established.
- samana-ocean-views â€” exact project is in the Maldives; replacement requires approval.

### Not suitable for the UAE project collection

- samana-ocean-views

## Validation record

- Both generated JSON files parse successfully.
- Machine-readable audit contains exactly 20 project entries.
- Corrected dataset contains 18 unique slugs and only UAE records.
- No rejected or unresolved record is marked implementation-ready.
- Every retained location uses the UAE and a valid UAE emirate.
- Public-facing project copy contains no research warnings added by this audit.
- No page, PHP, route, WordPress, CPT, ACF, image, or UI implementation was created or modified.
