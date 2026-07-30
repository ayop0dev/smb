# Minimal Presentation Improvement Plan

> Planning document only. No project file was modified while producing this plan. Builds directly on the findings in `CARD-SYSTEM-AUDIT.md` and `CONTENT-PRESENTATION-DIVERSITY-AUDIT.md` without repeating their analysis.

## 1. Objective

The prior audits found that the site's monotony comes overwhelmingly from one source: the Small-Block Grid ("Feature/Entity Grid") presentation language being used as the default answer for any set of short, parallel items, regardless of whether that content is company values, amenities, contact methods, or audience segments. They also found that the site already owns a working alternative — the Editorial Rule-Divided List ("Choose List") pattern — and a second lightweight alternative, the shell-less Fact Strip, both already live in the codebase and already proven on multiple pages.

This plan does not propose anything new. It proposes **redistributing presentation languages the site already has**, at the smallest number of touch points that produce a noticeable rhythm improvement. The guiding priorities, in order, are simplicity, consistency with the existing system, low engineering cost, and speed — not maximum variety. Where a genuine fix would require inventing a new pattern, or where fixing one repetition would only relocate it next to another instance of the same pattern elsewhere on the same page, this plan deliberately declines to act rather than force a change.

## 2. Sections That Should NOT Change

- **All entity/navigational cards** — Project Card, Community Card, Team Card, Insight/Article Card, Developer Row. Per this task's own instruction, these are final decisions, not candidates.
- **Hero Statement and CTA/Action Band, everywhere they appear.** These two patterns account for the largest share of repeated structure site-wide (present on effectively every page), but they are structural bookends the reader expects and relies on for orientation, not the source of the "repetitive feeling" the diversity audit identified — that audit specifically attributed the monotony to the *middle* of pages (the Small-Block Grid family), not the open/close. Touching either would mean touching every page on the site, the opposite of a minimal plan, for a problem neither pattern actually causes.
- **The Split Story pattern and its dark/checklist variant on Services** (the "Off-Plan Property Advisory" section immediately following the page's plain-intro Split Story). The diversity audit noted this repetition is already meaningfully softened by the tonal/background shift between the two instances — it is a soft echo, not a hard repeat, and does not meet the bar for inclusion in a minimal-change list.
- **About's "Mission & Vision" and "Our Values" sections**, despite sitting back-to-back as two Small-Block Grids (the diversity audit's flagged weak point for this page). Considered and excluded — see Section 6 for the reasoning; converting either one risks creating a *new* repetition against About's own existing "Why Clients Choose SMB" rule-divided list two sections later.
- **Communities' "Explore by Lifestyle" section**, despite sitting immediately after the Featured Communities project grid. Considered and excluded for the same class of reason as About — see Section 6.
- **Contact's "Visit or Speak With Us" band and closing CTA band**, despite being near-duplicate action prompts back-to-back. Considered and excluded — see Section 6.
- **Every Accordion/FAQ, Gallery, Quote/Testimonial Grid, Article Preview Grid, Directory, Image-Overlay Collection, Form, and Map section.** The diversity audit confirmed each of these is already a distinct presentation language used sparingly — none of them contribute to the repetition problem, and several are exactly the kind of variety the site should keep as-is.

## 3. High-Priority Improvement Candidates

Three candidates, not four — the fourth- and fifth-ranked options considered (About, Communities, Contact) were excluded rather than included at lower confidence, per Section 6's reasoning. Reuse targets below refer only to presentation languages that already exist elsewhere in the current codebase.

### Candidate 1 — Project Page template: "Location & Connectivity" section

- **Current presentation:** A Small-Block Grid on a dark navy band — four items, each an icon, a destination name, and a travel-time line, inside individually bordered/shelled tiles.
- **Reason for repetition:** It sits immediately after the "Features & Amenities" section, which is the same Small-Block Grid language (icon + heading + description, in shelled tiles) simply recolored for a light background. The two sections back-to-back are the one unresolved repetition point in an otherwise well-varied page sequence (per the diversity audit's scroll-rhythm finding for the Project Page template).
- **Existing presentation language it could reuse:** The Fact Strip — the shell-less icon row already used earlier on the very same page, in the "Quick Facts" section near the top (icon + short value + label, no card shell). Location's content (an icon, a destination name, a short time value) is structurally almost identical to what Fact Strip already displays; this is a same-page echo of a pattern the page already introduces, not a new import.
- **Expected impact:** High, and disproportionately so — this template renders on all 19 project pages, so one change resolves the same repetition 19 times over. This is the single highest-leverage item in this plan.
- **Implementation complexity:** Low–Medium. Two source files carry this section (the shared project template, plus one standalone legacy page that duplicates the template's structure by hand), so the change must be made twice, not once — otherwise, it is a simplification (removing a shell treatment) rather than new styling.
- **Priority:** 1

### Candidate 2 — Services page: "Who We Serve" section

- **Current presentation:** A Small-Block Grid — four audience segments (First-Time Buyers, Owners & Sellers, Investors, Businesses), each a whole-tile link with an icon, heading, one line of text, and a trailing arrow.
- **Reason for repetition:** It sits immediately after "All Services," also a Small-Block Grid (icon + heading + paragraph + CTA link). The diversity audit specifically flagged Services as the page with the most back-to-back repetition of any single language on the site, with this pairing as one of its two repeat points.
- **Existing presentation language it could reuse:** The Editorial Rule-Divided List, already used on three other pages for structurally identical content (a short enumerated set of points, each with a heading and one line of explanation). Four audience segments fit this shape at least as naturally as a grid.
- **Expected impact:** Medium–High. Resolves the more severe of Services' two flagged repetitions and gives the page a genuine second presentation language it currently lacks entirely (Services has no rule-divided list anywhere on it today, so there is no risk of creating a new adjacent repetition — unlike About or Communities).
- **Implementation complexity:** Very Low. The stylesheet that already defines the rule-divided list pattern is already loaded on this page for other content, so no new dependency is introduced — this is the cheapest candidate in the plan.
- **Priority:** 2 (cheapest to execute; recommended as the first step regardless of its impact ranking — see Section 4)

### Candidate 3 — Home page: "Why SMB" section

- **Current presentation:** A Small-Block Grid — four company differentiators, each a large numeral, a heading, and a paragraph, with no icon and no card shell (a lighter-weight grid variant, but still the same underlying "row of parallel short items" language).
- **Reason for repetition:** It is the middle section of a three-in-a-row run of Small-Block Grid variants (Featured Projects → Why SMB → Browse by Category) — the single worst repetition run identified anywhere on the site in the diversity audit. Featured Projects is an entity card grid and is out of scope; Why SMB is the only touchable section in that run whose content (a short enumerated list of reasons) is a natural fit for the alternative pattern.
- **Existing presentation language it could reuse:** The Editorial Rule-Divided List — the same pattern is already used elsewhere on the site for near-identical content ("Why Clients Choose SMB" on About, "How SMB Helps" on Developers). Converting Why SMB is not introducing a new idea, it is applying the site's own existing "reasons/differentiators" language to its most prominent instance of that exact content type.
- **Expected impact:** High. Home is the site's highest-traffic, highest-visibility page, and this single change breaks its worst-identified repetition run into an alternating grid → list → grid sequence without needing to touch either of the two grids on either side of it.
- **Implementation complexity:** Low. One page file. The rule-divided-list stylesheet is not currently loaded on this page, so it would need to be added as a dependency — a small, well-precedented step (the same stylesheet is already loaded on three other pages for the same pattern), but worth noting as the one small piece of extra work this candidate carries that Candidate 2 does not.
- **Priority:** 3

## 4. Recommended Execution Order

Ordered to validate the approach on the cheapest, lowest-risk change first, then move to the highest-visibility page, and finish with the change that has the widest blast radius (19 rendered pages) once the pattern has already been proven twice elsewhere.

**Step 1 — Services: "Who We Serve."**
Cheapest possible execution (no new stylesheet dependency), affects one page, and is independently reviewable in isolation. Serves as a low-risk proof that redistributing the Rule-Divided List pattern reads well outside its original three pages.

**Step 2 — Home: "Why SMB."**
Same pattern substitution as Step 1, on the site's most-visited page. Independently reviewable without depending on Step 1 having shipped, though doing it second lets the team confirm the approach once before touching the homepage specifically.

**Step 3 — Project template: "Location & Connectivity."**
Highest-leverage but widest-reaching change (two source files, 19 rendered pages) — sequenced last so it benefits from whatever was learned reviewing Steps 1-2, and so any issue with the approach is caught on lower-stakes pages first.

Each step is a single-section, single-pattern-substitution change and can be shipped and reviewed independently of the others — none depends on another being completed first, only the ordering above is a risk-management recommendation, not a technical requirement.

## 5. Estimated Result

After all three steps: 3 of the 6 back-to-back repetition points identified in the diversity audit are resolved (Home's three-grid run, Services' worse repetition point, and the Project Page template's end-of-page repetition — the last one resolved across all 19 project pages via a single template fix). The Small-Block Grid's share of the site's counted content sections drops modestly — from roughly 15 instances to roughly 12 — it remains the site's dominant presentation language, just less dominant, and the Editorial Rule-Divided List and Fact Strip each go from being used on a handful of pages to being confirmed, reusable options the team can reach for with precedent behind them.

This will not make the site "diverse" in the sense the diversity audit measured, and it will not resolve About's, Communities', or Contact's remaining repetition points, or Services' softer Split Story echo. It is a targeted reduction in the most noticeable monotony, at the lowest reasonable engineering cost — not a systemic fix.

## 6. Explicitly Out of Scope

- **All entity/navigational cards** (Project Card, Community Card, Team Card, Insight Card, Developer Row) — final decision per this task's framing, not re-evaluated.
- **Hero Statement and CTA/Action Band** — present on nearly every page; excluded because fixing them would require touching the entire site, and neither was identified as the actual source of the repetitive feeling.
- **About's "Mission & Vision" + "Our Values" pairing** — considered and excluded. About already contains a Rule-Divided List two sections later ("Why Clients Choose SMB"); converting either grid to that same pattern would remove one repetition only to create a new one nearby, on the same page. A safe fix would require reordering sections, which is an information-architecture change, not a presentation-language substitution, and is outside this plan's scope.
- **Communities' "Explore by Lifestyle" section** — considered and excluded for the identical reason: Communities already contains its own Rule-Divided List one section later ("Choosing the Right Community"), so a direct pattern swap creates the same adjacency risk as About.
- **Contact's "Visit or Speak With Us" band and closing CTA** — considered and excluded. No existing presentation language in the codebase fits this content without trimming or restructuring the copy itself, which would exceed a pure presentation-language substitution.
- **Services' two Split Story variants (plain intro + dark off-plan spotlight)** — considered and excluded; the diversity audit found this repetition already softened by the tonal shift between the two instances, below the bar for inclusion.
- **Any new presentation pattern, layout idea, illustration, animation, or interaction.** Nothing in this plan introduces a pattern that does not already exist and already have working styling somewhere in the current codebase.
- **Any change to design tokens, spacing, typography, color, or the visual shell of any component.** This plan only proposes swapping which existing presentation language a given section's content uses — never how any pattern itself looks.
- **All 18 individual project-record content differences** (e.g., whether one project's amenity list is more or less extensive than another's) — outside a presentation-pattern plan; addressed, if at all, at the content/data level, not the template level.

---

## Final Response

1. **File created:** `MINIMAL-PRESENTATION-IMPROVEMENT-PLAN.md` (project root)
2. **Number of recommended section changes:** 3 (Project Page template "Location & Connectivity," Services "Who We Serve," Home "Why SMB")
3. **Highest-impact section:** Project Page template — "Location & Connectivity," because the fix propagates across all 19 rendered project pages from a single change
4. **Lowest-effort improvement:** Services — "Who We Serve," because the target presentation language's stylesheet is already loaded on that page, requiring no new dependency
5. **Confirmation:** No project files were modified while producing this plan. Only `MINIMAL-PRESENTATION-IMPROVEMENT-PLAN.md` was created.
