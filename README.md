# DAMAC Islands 2 — Landing Page Preview

Static preview of the DAMAC Islands 2 landing page for **SMB Real Estate Brokers L.L.C**,
built with HTML5, CSS3 and vanilla JavaScript per `docs/implementation-rules.md`.
The site uses shared PHP includes (`header.php` / `footer.php`). Serve it locally with
`php -S localhost:8000` from the project root, then open `http://localhost:8000/home.php`.

---

## Folder Structure

```
preview/
├── header.php                  Shared document head, SVG sprite, skip link, global header
├── footer.php                  Shared global footer, sticky CTA, script includes
├── home.php … contact.php      Site pages (config vars + <main> content + includes)
├── damac-islands2.php          Project landing page (same include structure)
├── README.md                   This file
└── assets/
    ├── css/
    │   └── main.css            All styles — design tokens, mobile-first, no frameworks
    ├── js/
    │   └── main.js             Header state, mobile nav, reveals, sticky CTA, form validation
    ├── images/                 All imagery, stored locally (no hotlinking)
    ├── icons/
    │   └── favicon.svg         Favicon derived from the SMB logo mark (gold bars on navy)
    └── fonts/
        └── Manrope-VariableFont_wght.ttf   Brand font (weights 200–800)
```

---

## Page Structure

Follows `docs/landingpage-tree.md` exactly:

1. **Hero** — full-width image, project name/headline/description left, floating lead-form card with starting price right.
2. **Island districts strip** *(design addition)* — the eight island districts from the master plan (Bahamas → Antigua), with the currently launching clusters (Mauritius, Antigua) highlighted in gold. Content sourced from the project brief's Master Plan section.
3. **Quick Facts** — horizontal icon row (freehold, property types, handover, community size).
4. **Project Overview** — description left, three stacked stat cards right.
5. **Lifestyle Gallery** — asymmetric grid: one large featured image (~70%) + three stacked images (~30%); horizontal snap-scroll strip on mobile.
6. **Features & Amenities** — 8-category icon grid, all items from the project brief.
7. **Location & Connectivity** — four destination cards with driving times on a navy band with a dimmed Dubai skyline backdrop.
8. **Final CTA** — WhatsApp/Call buttons + full lead form (`#enquire`).
9. **Footer** — brand, tagline, contact details, anchor nav, disclaimer.
10. **Sticky CTA** — floating card (bottom-right desktop, snackbar-style mobile) that appears after the hero, scrolls to the form, and hides while the Final CTA section is visible.

---

## Design Decisions

- **Tokens straight from `design-brief.md`**: navy `#0a2342`, gold `#f9ba3f`, the five neutrals, radius 10/12/20px, soft shadows only, 1280px max width, 96/64/48px section padding.
- **Typography**: Manrope variable font only (the brand's single face). Hierarchy is built on weight contrast — 800 tight-tracked headings, 400 body, 700 letterspaced-uppercase eyebrows/labels.
- **Color discipline**: navy is reserved for the header, hero scrim, island strip, location band and footer; gold appears only on CTAs, prices, eyebrow ticks and icon accents. Sections alternate white / `#F5F7FA` for rhythm.
- **Signature element**: the island-districts strip under the hero — real master-plan content used as a structural divider, not decoration.
- **Animation**: subtle only — scroll-triggered fade/rise reveals, card hover lifts, gentle image zoom on gallery hover. `prefers-reduced-motion` disables all of it.
- **Accessibility (WCAG 2.2 AA)**: one `h1`, ordered headings, labels on every field, alt text on every meaningful image (decorative skyline is `aria-hidden`), visible gold focus rings, skip link, keyboard-operable nav and forms, `aria-live` validation messages, `aria-expanded` on the menu toggle.
- **AA contrast note**: the design brief specifies "dark gray" text on the gold accent button; `#5E6673` on gold fails 4.5:1, so the button uses the brand black `#111111` (≈11:1) instead.

### Data decisions (source-of-truth conflicts)

`landingpage-tree.md` carries example values that conflict with the verified project brief
(`docs/projects/damac-islands-2.md`). Per the brief's own rule that official information takes
precedence, the page uses:

| Item | Tree example | Used on page (from project brief) |
|---|---|---|
| Handover | 2028 | December 2029 (official) |
| Starting bedrooms | 2 | 4–5 bedrooms |
| Starting built-up area | 800 sq.ft | From ~2,180 sq.ft |
| "1000+ Units" quick fact | 1000+ Units | ~20M sq.ft master community (verifiable) |
| Starting price | AED 1.9M | AED 1.9M (kept — only source), with a "subject to change" footnote |

No facts, statistics, testimonials or payment plans were invented.

---

## Image Sources

All images are stored locally in `assets/images/`. No hotlinking.

| File | Content | Source |
|---|---|---|
| `hero-villa-pool.jpg` | Modern villa with pool, blue sky (hero) | Royalty-free (Unsplash), carried over from earlier preview |
| `gallery-villa-dusk.jpg` | Contemporary villa with infinity pool | Unsplash (royalty-free), photo `1613490493576` |
| `gallery-lagoon-beach.jpg` | Turquoise water / sandy beach | Unsplash (royalty-free), photo `1507525428034` |
| `gallery-interior.jpg` | Bright open-plan living interior | Unsplash (royalty-free), photo `1600607687939` |
| `gallery-resort-pool.jpg` | Resort pool with palms over the sea | Unsplash (royalty-free), photo `1540541338287` |
| `hero-lagoon-aerial.jpg` | Dubai skyline at sunrise (location backdrop) | Unsplash (royalty-free), photo `1512453979798` |
| `smb-logo-horizontal.png` / `smb-logo-vertical.png` | Client brand logos | Client assets (`assets/logo/`) |

All icons are hand-drawn inline SVG (outline style, rounded caps, consistent 1.75 stroke)
in a shared SVG sprite in `header.php` — no icon libraries.

**These are temporary placeholder photographs.** They represent luxury waterfront living but
are *not* official DAMAC Islands 2 renders and must be replaced before publication.

---

## Still Requires Real Client Assets

From the project brief's "Missing Information" list, the preview omits or placeholds:

- Official DAMAC Islands 2 renders (hero, lagoon, villas, townhouses, interiors, amenities)
- High-resolution master plan image and official community map
- Google Maps coordinates / embedded map for the Location section
- Official brochure PDF, floor plans, unit matrix, payment plan (CTAs for these were left out — no fake downloads)
- Current price list confirmation (AED 1.9M shown with a "subject to change" footnote)
- DLD project number and RERA registration details (typically required in the footer for Dubai marketing)
- Arabic font + RTL variant (secondary language, per company brief)
- Form backend: forms validate client-side and show a success state, but **no endpoint is connected** — wire up email/CRM during WordPress conversion

---

## Verified

- Opens correctly from the filesystem (no server dependencies, all paths relative)
- CSS and JS load; no console errors
- Responsive: 375px / 768px / 992px / 1440px checked
- All assets local; no broken references
