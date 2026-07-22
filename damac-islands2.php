<?php
$page_title = 'DAMAC Islands 2 — Luxury Waterfront Villas & Townhouses in Dubailand | SMB Real Estate Brokers';
$page_description = 'Luxury waterfront villas and townhouses in DAMAC Islands 2, Dubailand. Explore the master plan, amenities, location and enquire with SMB Real Estate Brokers.';
$page_og_title = 'DAMAC Islands 2 — Luxury Waterfront Villas & Townhouses';
$page_og_description = 'An island-inspired waterfront community by DAMAC Properties in Dubailand, Dubai. Freehold villas and townhouses from AED 1.9M.';
$page_og_image = 'assets/images/hero-villa-pool.jpg';
$current_page = '';
$skip_link = '#overview';

/* Project-page sticky CTA variant */
$sticky_label = 'Starting from';
$sticky_value = 'AED 1.9M';
$sticky_action = 'Fill the form';

require __DIR__ . '/header.php';
?>

  <script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Residence',
    'name' => 'DAMAC Islands 2',
    'description' => 'A master-planned waterfront community offering luxury villas and townhouses in Dubailand, Dubai. Crystal lagoons, water features and resort-style amenities, designed for a premium island lifestyle.',
    'url' => $canonical_url,
    'image' => $site_url . '/assets/images/hero-villa-pool.jpg',
    'address' => [
      '@type' => 'PostalAddress',
      'addressLocality' => 'Dubailand, Dubai',
      'addressCountry' => 'AE',
    ],
    'offers' => [
      '@type' => 'Offer',
      'priceCurrency' => 'AED',
      'price' => '1900000',
      'availability' => 'https://schema.org/InStock',
    ],
  ], JSON_UNESCAPED_SLASHES) ?></script>

  <main id="top">

    <!-- ============ Hero ============ -->
    <section class="hero" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/hero-villa-pool.jpg"
           alt="Modern luxury villa with a private pool under a clear blue sky"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <p class="eyebrow eyebrow--light">By DAMAC Properties &middot; Dubailand, Dubai</p>
          <h1 id="hero-title">DAMAC Islands&nbsp;2</h1>
          <p class="hero__headline">High-End Waterfront Villas &amp; Townhouses</p>
          <p class="hero__description">
            A large-scale Dubailand community of villas and townhouses organised around water, landscaping and shared leisure spaces. This page sets out the current release, setting and practical considerations.
          </p>
          <div class="hero__cta">
            <a class="btn btn--accent btn--lg" href="#enquire">Enquire Now</a>
            <a class="btn btn--ghost btn--lg" href="#overview">Review Project Details</a>
          </div>
          <ul class="hero__badges" aria-label="Trust indicators">
            <li>Developed by DAMAC Properties</li>
            <li>Freehold Community</li>
            <li>Master-Planned Development</li>
          </ul>
        </div>

        <div class="hero__card" id="hero-form-card">
          <p class="price-label">Starting from</p>
          <p class="price">AED 1.9M<span class="price__note">*</span></p>
          <p class="price-footnote">*Prices are subject to change by the developer.</p>
          <form class="lead-form" id="hero-form" novalidate>
            <div class="field">
              <label for="hf-name">Full Name</label>
              <input type="text" id="hf-name" name="name" autocomplete="name" placeholder="Your full name" required aria-describedby="hf-name-error">
              <p class="field__error" id="hf-name-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="hf-phone">Phone Number</label>
              <input type="tel" id="hf-phone" name="phone" autocomplete="tel" placeholder="+971 50 000 0000" required aria-describedby="hf-phone-error">
              <p class="field__error" id="hf-phone-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="hf-email">Email Address</label>
              <input type="email" id="hf-email" name="email" autocomplete="email" placeholder="name@example.com" required aria-describedby="hf-email-error">
              <p class="field__error" id="hf-email-error" aria-live="polite"></p>
            </div>
            <button type="submit" class="btn btn--accent btn--block">Enquire Now</button>
            <p class="lead-form__privacy">Our team will contact you to understand your needs and agree the next step.</p>
          </form>
          <div class="lead-form__success" hidden>
            <p class="lead-form__success-title">Thank you</p>
            <p>Your enquiry has been received. An SMB property consultant will contact you to understand your goals and guide the next step.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ Island districts strip ============ -->
    <section class="districts" aria-label="Island districts of the master community">
      <div class="container">
        <p class="districts__intro">One master community &middot; Eight island districts</p>
        <ul class="districts__list">
          <li>Bahamas</li>
          <li>Tahiti</li>
          <li>Bermuda</li>
          <li>Barbados</li>
          <li>Cuba</li>
          <li>Maui</li>
          <li class="is-launching">Mauritius (Now launching)</li>
          <li class="is-launching">Antigua (Now launching)</li>
        </ul>
        <p class="districts__legend"><span class="districts__dot" aria-hidden="true"></span> Now launching</p>
      </div>
    </section>

    <!-- ============ Quick facts ============ -->
    <section class="facts" aria-labelledby="facts-title">
      <h2 class="visually-hidden" id="facts-title">Key Facts</h2>
      <div class="container">
        <ul class="facts__row">
          <li class="facts__item" data-reveal>
            <span class="facts__icon"><svg class="icon" aria-hidden="true"><use href="#i-deed"/></svg></span>
            <div>
              <p class="facts__value">Freehold</p>
              <p class="facts__label">Ownership for all nationalities</p>
            </div>
          </li>
          <li class="facts__item" data-reveal>
            <span class="facts__icon"><svg class="icon" aria-hidden="true"><use href="#i-home"/></svg></span>
            <div>
              <p class="facts__value">Villas &amp; Townhouses</p>
              <p class="facts__label">4–5 bedroom homes</p>
            </div>
          </li>
          <li class="facts__item" data-reveal>
            <span class="facts__icon"><svg class="icon" aria-hidden="true"><use href="#i-calendar"/></svg></span>
            <div>
              <p class="facts__value">Dec 2029</p>
              <p class="facts__label">Expected handover</p>
            </div>
          </li>
          <li class="facts__item" data-reveal>
            <span class="facts__icon"><svg class="icon" aria-hidden="true"><use href="#i-expand"/></svg></span>
            <div>
              <p class="facts__value">~20M sq.ft</p>
              <p class="facts__label">Master community</p>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <!-- ============ Project overview ============ -->
    <section class="overview section section--gray" id="overview" aria-labelledby="overview-title">
      <div class="container overview__grid">
        <div class="overview__text" data-reveal>
          <p class="eyebrow">Project Overview</p>
          <h2 id="overview-title">A waterfront community taking shape in Dubailand</h2>
          <p>
            DAMAC Islands 2 brings villas and townhouses into a water-led master plan in Dubailand. The proposition is straightforward: larger homes, a broad amenity programme and a suburban setting connected to Dubai's main road network.
          </p>
          <p>
            Eight island themes give the districts their individual identity. Across them, the plan combines lagoons, landscaped parks, walking routes and family recreation. Buyers should consider that environment alongside the 2029 handover horizon and the scale of the wider community.
          </p>
          <a class="btn btn--primary" href="#enquire">Discuss DAMAC Islands 2</a>
        </div>
        <div class="overview__cards">
          <article class="stat-card" data-reveal>
            <span class="stat-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-bed"/></svg></span>
            <div>
              <p class="stat-card__value">4–5</p>
              <p class="stat-card__label">Bedrooms in the current release</p>
            </div>
          </article>
          <article class="stat-card" data-reveal>
            <span class="stat-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-plan"/></svg></span>
            <div>
              <p class="stat-card__value">From 2,180 sq.ft</p>
              <p class="stat-card__label">Built-up area, up to approx. 3,160 sq.ft</p>
            </div>
          </article>
          <article class="stat-card" data-reveal>
            <span class="stat-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-sparkles"/></svg></span>
            <div>
              <p class="stat-card__value">20+</p>
              <p class="stat-card__label">Features &amp; amenities across the community</p>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ============ Lifestyle gallery ============ -->
    <section class="gallery section" id="gallery" aria-labelledby="gallery-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Lifestyle Gallery</p>
          <h2 id="gallery-title">Designed around water, nature and light</h2>
        </div>
        <div class="gallery__grid">
          <figure class="gallery__item gallery__item--featured" data-reveal>
            <img src="assets/images/gallery-villa-dusk.jpg"
                 alt="Contemporary two-storey villa with floor-to-ceiling glazing and a private infinity pool"
                 loading="lazy" width="1800" height="1200">
          </figure>
          <figure class="gallery__item" data-reveal>
            <img src="assets/images/gallery-lagoon-beach.jpg"
                 alt="Turquoise lagoon water meeting a white sandy beach at sunrise"
                 loading="lazy" width="900" height="1200">
          </figure>
          <figure class="gallery__item" data-reveal>
            <img src="assets/images/gallery-interior.jpg"
                 alt="Bright open-plan living room and kitchen with modern furnishings"
                 loading="lazy" width="900" height="1200">
          </figure>
          <figure class="gallery__item" data-reveal>
            <img src="assets/images/gallery-resort-pool.jpg"
                 alt="Resort-style swimming pool surrounded by palm trees overlooking the sea"
                 loading="lazy" width="900" height="1200">
          </figure>
        </div>
      </div>
    </section>

    <!-- ============ Features & amenities ============ -->
    <section class="amenities section section--gray" id="amenities" aria-labelledby="amenities-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Features &amp; Amenities</p>
          <h2 id="amenities-title">Amenities organised around everyday life</h2>
        </div>
        <ul class="amenities__grid">
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-waves"/></svg></span>
            <h3>Water Features</h3>
            <p>Lagoons, sandy edges, swimming pools and waterfront parks.</p>
          </li>
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-dumbbell"/></svg></span>
            <h3>Sports &amp; Fitness</h3>
            <p>Fitness centres, sports courts, running and cycling tracks, and mini golf.</p>
          </li>
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-heart"/></svg></span>
            <h3>Wellness</h3>
            <p>Spa facilities, quieter wellness areas and outdoor yoga spaces.</p>
          </li>
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-users"/></svg></span>
            <h3>Family</h3>
            <p>Community parks, barbecue areas and shared gathering spaces.</p>
          </li>
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-balloon"/></svg></span>
            <h3>Kids</h3>
            <p>Playgrounds and dedicated activity areas for children.</p>
          </li>
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-bag"/></svg></span>
            <h3>Dining &amp; Retail</h3>
            <p>A planned retail boulevard with shops, restaurants and caf&eacute;s.</p>
          </li>
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-leaf"/></svg></span>
            <h3>Nature</h3>
            <p>Botanical gardens, ecological parks, walking trails and planted open space.</p>
          </li>
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-shield"/></svg></span>
            <h3>Security</h3>
            <p>Controlled community access and dedicated security.</p>
          </li>
        </ul>
      </div>
    </section>

    <!-- ============ Location & connectivity ============ -->
    <section class="location section" id="location" aria-labelledby="location-title">
      <img class="location__bg" src="assets/images/hero-lagoon-aerial.jpg"
           alt="" loading="lazy" aria-hidden="true">
      <div class="container location__inner">
        <div class="section-head section-head--light" data-reveal>
          <p class="eyebrow eyebrow--gold">Location &amp; Connectivity</p>
          <h2 id="location-title">Minutes from Dubai's key destinations</h2>
          <p class="section-head__sub">
            The site connects with Al Qudra Road (D63), Emirates Road (E611) and Sheikh Mohammed Bin Zayed Road (E311), placing it within reach of Dubai's principal business, leisure and airport districts.
          </p>
        </div>
        <ul class="location__grid">
          <li class="place-card" data-reveal>
            <span class="place-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg></span>
            <h3>Downtown Dubai</h3>
            <p class="place-card__time">
              <svg class="icon icon--sm" aria-hidden="true"><use href="#i-clock"/></svg>
              30–35 minutes
            </p>
          </li>
          <li class="place-card" data-reveal>
            <span class="place-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-anchor"/></svg></span>
            <h3>Dubai Marina</h3>
            <p class="place-card__time">
              <svg class="icon icon--sm" aria-hidden="true"><use href="#i-clock"/></svg>
              30 minutes
            </p>
          </li>
          <li class="place-card" data-reveal>
            <span class="place-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-plane"/></svg></span>
            <h3>Dubai International Airport</h3>
            <p class="place-card__time">
              <svg class="icon icon--sm" aria-hidden="true"><use href="#i-clock"/></svg>
              35–40 minutes
            </p>
          </li>
          <li class="place-card" data-reveal>
            <span class="place-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-plane"/></svg></span>
            <h3>Al Maktoum International Airport</h3>
            <p class="place-card__time">
              <svg class="icon icon--sm" aria-hidden="true"><use href="#i-clock"/></svg>
              30 minutes
            </p>
          </li>
        </ul>
        <p class="location__note">Indicative driving times; actual journeys will vary with traffic and route conditions.</p>
      </div>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="enquire section section--gray" id="enquire" aria-labelledby="enquire-title">
      <div class="container enquire__grid">
        <div class="enquire__text" data-reveal>
          <p class="eyebrow">Contact</p>
          <h2 id="enquire-title">Enquire Now</h2>
          <p class="enquire__sub">
            Share your details to discuss the current release, payment terms and whether the project suits your plans.
          </p>
          <div class="enquire__buttons">
            <a class="btn btn--accent" href="https://wa.me/971504217299" target="_blank" rel="noopener">
              <svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg>
              WhatsApp
            </a>
            <a class="btn btn--primary" href="tel:+971504217299">
              <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
              Call +971 50 421 7299
            </a>
          </div>
          <address>
            <ul class="enquire__details">
              <li>
                <svg class="icon" aria-hidden="true"><use href="#i-mail"/></svg>
                <a href="mailto:info@smbdubai.net">info@smbdubai.net</a>
              </li>
              <li>
                <svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg>
                <span>3002 Westburry Tower Office, Business Bay, Dubai, UAE</span>
              </li>
            </ul>
          </address>
        </div>
        <div class="enquire__form-wrap" data-reveal>
          <form class="lead-form lead-form--card" id="main-form" novalidate>
            <div class="field">
              <label for="mf-name">Full Name</label>
              <input type="text" id="mf-name" name="name" autocomplete="name" placeholder="Your full name" required aria-describedby="mf-name-error">
              <p class="field__error" id="mf-name-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="mf-phone">Phone Number</label>
              <input type="tel" id="mf-phone" name="phone" autocomplete="tel" placeholder="+971 50 000 0000" required aria-describedby="mf-phone-error">
              <p class="field__error" id="mf-phone-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="mf-email">Email Address</label>
              <input type="email" id="mf-email" name="email" autocomplete="email" placeholder="name@example.com" required aria-describedby="mf-email-error">
              <p class="field__error" id="mf-email-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="mf-message">Message <span class="field__optional">(optional)</span></label>
              <textarea id="mf-message" name="message" rows="4" placeholder="Tell us what you are looking for" aria-describedby="mf-message-error"></textarea>
              <p class="field__error" id="mf-message-error" aria-live="polite"></p>
            </div>
            <button type="submit" class="btn btn--accent btn--block btn--lg">Send Enquiry</button>
          </form>
          <div class="lead-form__success lead-form__success--card" hidden>
            <p class="lead-form__success-title">Thank you</p>
            <p>Your enquiry has been received. An SMB property consultant will contact you to understand your goals and guide the next step.</p>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php require __DIR__ . '/footer.php'; ?>
