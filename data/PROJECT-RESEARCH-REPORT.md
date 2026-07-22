# Project Research Report

## Executive summary

This research pass normalized 20 requested projects into one JSON dataset using a fixed schema. Official project pages, developer pages, brochures, factsheets and press releases were prioritized. No project images were downloaded. Commercial facts are explicitly time-sensitive and marked subject to change.

- Research date: 2026-07-22
- Total projects completed: 20
- Projects with complete official data: 6
- Projects with partial official data: 9
- Projects with major missing information: 5

“Complete” means the accessible official sources supplied enough core project, location, product, status and commercial/delivery detail for template preparation. It does not mean every schema field is available.

## Complete Official Data

- Sobha Central
- Everly Place
- Downtown Residences
- Lumena
- One Park Central
- Six Senses Residences Dubai Marina

## Partial Data

- The Grand Polo Club & Resort
- Fahid Island
- Riverside Views
- Bay Grove Residences (Dubai Islands)
- La Tilia at Villanova
- The Acres Estates
- Binghatti Aquarise
- Sparklz by Danube
- Pantheon Elysee Heights

## Major Missing Information

- Azizi Milan
- Keturah Ardh
- Samana Ocean Views
- Verdana Empire
- Tiger Sky Tower

## Conflicts And Caveats

- **Samana Ocean Views:** the official developer page places this project on Haa Alif Medhafushi in the Maldives. The mandated schema fixes `country` to `United Arab Emirates`. The record preserves that required value but leaves UAE city/emirate empty and records the conflict. This must be resolved before implementation.
- **Grand Polo Club & Resort:** Emaar’s current community page lists 5,599 residences while its April 2025 press release described more than 6,600. The dataset uses the newer live community-page figure and does not treat the older press-release figure as current.
- **Bay Grove Residences:** unit counts vary by phase. The dataset uses 257 units for the final phase, not 296 from the first release or 241 from phase 3.
- **Sobha Central:** prices, sizes and handovers vary by tower. The dataset uses the lowest currently displayed tower price and identifies the handover as the latest listed tower date; implementation should not imply one uniform date for all towers.
- **La Tilia:** official pages confirm product and scale, but an exact official handover date and current price were not retained because available third-party sources differ between August/September and Q3/Q4 2028.
- **Six Senses Residences Dubai Marina:** the official page reports an estimated service-charge range, so no single numeric `amount` is stored.

## Fields Commonly Unverified

Coordinates, ownership tenure, plot area, furnishing, service charges, exact handover dates, current availability, and current payment plans were frequently unavailable on accessible official pages. These remain null, empty, or explicitly unverified. Direct official image asset URLs were not reliably exposed, so image arrays are empty and official media/project pages are recorded for later rights review.

## Official Sources By Project

1. **The Grand Polo Club & Resort**: https://properties.emaar.com/en/our-communities/grand-polo-club-and-resort/
2. **Fahid Island**: https://www.aldar.com/properties/en/Fahid-Island  
   Additional official source: https://www.aldar.com/en/news-and-media/aldar-unveils-fahid-island
3. **Riverside Views**: https://preprod.damacproperties.com/en/projects/damac-riverside-views/
4. **Bay Grove Residences (Dubai Islands)**: https://www.nakheel.com/en/new-launches/baygrove-residences  
   Additional official source: https://www.nakheel.com/en/media-centre/press-releases/news-detail/2025/07/03/nakheel-unveils-final-phase-of-bay-grove-residences-on-dubai-islands
5. **La Tilia at Villanova**: https://villanova.dp.ae/  
   Additional official source: https://www.dubaiholding.com/en/media-hub/press-releases/dubai-properties-awards-contracts-worth-aed-1-1-billion-to-expand-villanova-with-850-new-homes
6. **Sobha Central**: https://sobharealty.com/properties-in-dubai/sobha-central
7. **The Acres Estates**: https://theacres.meraas.com/home-v2  
   Additional official source: https://meraas.com/en/latest-post/news/meraas-awards-aed-24-billion-construction-contracts-new-phases-acres-communities
8. **Binghatti Aquarise**: https://www.binghatti.com/en/project-details/4-bedroom-binghatti-aquarise/10068  
   Additional official source: https://www2.binghatti.com/wp-content/uploads/2025/05/Aquarise-Project-Facts.pdf
9. **Sparklz by Danube**: https://danubeproperties.com/wp-content/uploads/2025/04/Sparklz_brochure_EN_compressed-1.pdf
10. **Azizi Milan**: https://www.azizidevelopments.com/
11. **Keturah Ardh**: https://mag.ae/
12. **Everly Place**: https://ellingtonproperties.ae/en/property-for-sale/everly-place-mohammed-bin-rashid-city
13. **Samana Ocean Views**: https://www.samanadevelopers.com/projects/samana-ocean-views?lang=en
14. **Downtown Residences**: https://www.deyaar.ae/en/media_center/deyaar-unveils-downtown-residences-in-dubai-one-of-the-worlds-tallest-vertical-residential-communities/
15. **Lumena**: https://lumena.omniyat.com/
16. **One Park Central**: https://www.imandevelopers.com/iman-properties/one-park-central  
   Additional official source: https://www.imandevelopers.com/media-centers/groundbreaking-ceremony-of-one-park-central-launch
17. **Verdana Empire**: https://reportageuae.com/
18. **Tiger Sky Tower**: https://tigerproperties.ae/
19. **Pantheon Elysee Heights**: https://www.pantheondevelopment.ae/projects/elysee-heights/
20. **Six Senses Residences Dubai Marina**: https://www.select-group.ae/developments/six-senses-residences-dubai-marina

## Manual Review Recommendations

1. Resolve whether Samana Ocean Views belongs in a UAE-only schema or whether the country rule should be relaxed.
2. Request current sales packs from Azizi, MAG, Reportage and Tiger for projects classified with major gaps.
3. Obtain dated official price lists and payment plans immediately before implementation; do not reuse this snapshot as live inventory.
4. Confirm handover dates at project or phase level, especially Sobha Central, Bay Grove and La Tilia.
5. Perform a separate media-rights review and copy approved assets locally; do not hotlink external images.
6. Review whether commercial-only Lumena should use a non-residential structured-data type in the later template.
