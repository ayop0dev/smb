<?php
$page_title = 'Dubai Communities — SMB Real Estate Brokers L.L.C | Explore by Location';
$page_description = 'Explore Dubai\'s most sought-after communities with SMB Real Estate Brokers — Downtown Dubai, Dubai Marina, Business Bay, Dubai Hills Estate, Palm Jumeirah and Dubai Creek Harbour.';
$page_og_title = 'Dubai Communities — SMB Real Estate Brokers';
$page_og_description = 'Explore Dubai real estate by community — lifestyle, property types and honest guidance on choosing the right location.';
$page_og_image = 'assets/images/gallery-resort-pool.jpg';
$current_page = 'communities';
$skip_link = '#intro';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/services.css',
    'assets/css/contact.css',
    'assets/css/communities.css',
];

require __DIR__ . '/header.php';
?>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/gallery-resort-pool.jpg"
           alt="Resort-style pool and palm trees overlooking the sea in Dubai"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="home.php">Home</a></li>
              <li><span aria-current="page">Communities</span></li>
            </ol>
          </nav>
          <p class="eyebrow eyebrow--light">Dubai Communities</p>
          <h1 id="hero-title">Explore Dubai's most sought-after communities</h1>
          <p class="hero__description">
            Every great property decision starts with the right location. Browse Dubai
            by community, then discover the projects available within each one.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Communities introduction ============ -->
    <section class="comm-intro section" id="intro" aria-labelledby="intro-title">
      <div class="container comm-intro__inner">
        <div data-reveal>
          <p class="eyebrow">Why Location Matters</p>
          <h2 id="intro-title">The community shapes everything</h2>
          <p>
            The same budget buys very different lives in different parts of Dubai.
            Community determines your property type, daily commute, schools and
            amenities — and it drives long-term value as much as the property itself.
            Whether you are choosing a family home or building a portfolio, start with
            the location, and the right property follows.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Featured communities ============ -->
    <section class="comms section section--gray" id="communities" aria-labelledby="comms-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Communities</p>
          <h2 id="comms-title">Where our clients are looking</h2>
        </div>
        <div class="comms__grid">
          <article class="comm-card" data-reveal>
            <div class="comm-card__media">
              <img src="assets/images/gallery-interior.jpg" alt="Bright contemporary interior representing Downtown Dubai living" loading="lazy" width="900" height="1200">
            </div>
            <div class="comm-card__body">
              <h3>Downtown Dubai</h3>
              <p class="comm-card__desc">The city's centrepiece — landmark towers, dining and culture on your doorstep.</p>
              <ul class="comm-card__types" aria-label="Property types">
                <li>Apartments</li>
                <li>Penthouses</li>
              </ul>
              <a class="comm-card__link" href="#" aria-label="Explore Downtown Dubai (community page to be added)">
                Explore Community
                <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>

          <article class="comm-card" data-reveal>
            <div class="comm-card__media">
              <img src="assets/images/gallery-resort-pool.jpg" alt="Waterfront pool scene representing Dubai Marina" loading="lazy" width="900" height="1200">
            </div>
            <div class="comm-card__body">
              <h3>Dubai Marina</h3>
              <p class="comm-card__desc">High-rise waterfront living around the marina promenade and beachfront.</p>
              <ul class="comm-card__types" aria-label="Property types">
                <li>Apartments</li>
                <li>Penthouses</li>
              </ul>
              <a class="comm-card__link" href="#" aria-label="Explore Dubai Marina (community page to be added)">
                Explore Community
                <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>

          <article class="comm-card" data-reveal>
            <div class="comm-card__media">
              <img src="assets/images/hero-lagoon-aerial.jpg" alt="Dubai skyline representing Business Bay" loading="lazy" width="1800" height="1200">
            </div>
            <div class="comm-card__body">
              <h3>Business Bay</h3>
              <p class="comm-card__desc">Dubai's central business district — where SMB is based — beside the canal.</p>
              <ul class="comm-card__types" aria-label="Property types">
                <li>Apartments</li>
                <li>Commercial</li>
              </ul>
              <a class="comm-card__link" href="#" aria-label="Explore Business Bay (community page to be added)">
                Explore Community
                <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>

          <article class="comm-card" data-reveal>
            <div class="comm-card__media">
              <img src="assets/images/gallery-villa-dusk.jpg" alt="Contemporary villa at dusk representing Dubai Hills Estate" loading="lazy" width="1800" height="1200">
            </div>
            <div class="comm-card__body">
              <h3>Dubai Hills Estate</h3>
              <p class="comm-card__desc">A green, master-planned family district built around parkland and a golf course.</p>
              <ul class="comm-card__types" aria-label="Property types">
                <li>Villas</li>
                <li>Townhouses</li>
                <li>Apartments</li>
              </ul>
              <a class="comm-card__link" href="#" aria-label="Explore Dubai Hills Estate (community page to be added)">
                Explore Community
                <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>

          <article class="comm-card" data-reveal>
            <div class="comm-card__media">
              <img src="assets/images/gallery-lagoon-beach.jpg" alt="Beachfront scene representing Palm Jumeirah" loading="lazy" width="900" height="1200">
            </div>
            <div class="comm-card__body">
              <h3>Palm Jumeirah</h3>
              <p class="comm-card__desc">Dubai's signature island address — beachfront villas and resort-style living.</p>
              <ul class="comm-card__types" aria-label="Property types">
                <li>Villas</li>
                <li>Apartments</li>
                <li>Penthouses</li>
              </ul>
              <a class="comm-card__link" href="#" aria-label="Explore Palm Jumeirah (community page to be added)">
                Explore Community
                <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>

          <article class="comm-card" data-reveal>
            <div class="comm-card__media">
              <img src="assets/images/hero-villa-pool.jpg" alt="Modern villa with pool representing Dubai Creek Harbour" loading="lazy" width="1800" height="1200">
            </div>
            <div class="comm-card__body">
              <h3>Dubai Creek Harbour</h3>
              <p class="comm-card__desc">A new waterfront district rising along the creek, minutes from Downtown.</p>
              <ul class="comm-card__types" aria-label="Property types">
                <li>Apartments</li>
                <li>Waterfront</li>
              </ul>
              <a class="comm-card__link" href="#" aria-label="Explore Dubai Creek Harbour (community page to be added)">
                Explore Community
                <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ============ Browse all communities ============ -->
    <section class="comm-browse section" aria-labelledby="browse-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Browse All Communities</p>
          <h2 id="browse-title">The full directory</h2>
          <p class="section-head__sub">
            More communities will be added as new opportunities are curated.
          </p>
        </div>
        <div class="comm-rows">
          <div class="comm-row" data-reveal>
            <img class="comm-row__thumb" src="assets/images/gallery-interior.jpg" alt="" loading="lazy" width="128" height="128">
            <div class="comm-row__text">
              <h3>Downtown Dubai</h3>
              <p>City-centre living beside Dubai's landmarks</p>
              <span class="comm-row__cats">City Living &middot; Luxury</span>
            </div>
            <a class="btn btn--secondary btn--sm" href="#" aria-label="View Downtown Dubai community (page to be added)">View Community</a>
          </div>
          <div class="comm-row" data-reveal>
            <img class="comm-row__thumb" src="assets/images/gallery-resort-pool.jpg" alt="" loading="lazy" width="128" height="128">
            <div class="comm-row__text">
              <h3>Dubai Marina</h3>
              <p>Waterfront towers and promenade lifestyle</p>
              <span class="comm-row__cats">Waterfront &middot; City Living</span>
            </div>
            <a class="btn btn--secondary btn--sm" href="#" aria-label="View Dubai Marina community (page to be added)">View Community</a>
          </div>
          <div class="comm-row" data-reveal>
            <img class="comm-row__thumb" src="assets/images/hero-lagoon-aerial.jpg" alt="" loading="lazy" width="128" height="128">
            <div class="comm-row__text">
              <h3>Business Bay</h3>
              <p>Central district for residents and businesses</p>
              <span class="comm-row__cats">City Living &middot; Investment</span>
            </div>
            <a class="btn btn--secondary btn--sm" href="#" aria-label="View Business Bay community (page to be added)">View Community</a>
          </div>
          <div class="comm-row" data-reveal>
            <img class="comm-row__thumb" src="assets/images/gallery-villa-dusk.jpg" alt="" loading="lazy" width="128" height="128">
            <div class="comm-row__text">
              <h3>Dubai Hills Estate</h3>
              <p>Parkland, schools and family villas</p>
              <span class="comm-row__cats">Family &middot; Luxury</span>
            </div>
            <a class="btn btn--secondary btn--sm" href="#" aria-label="View Dubai Hills Estate community (page to be added)">View Community</a>
          </div>
          <div class="comm-row" data-reveal>
            <img class="comm-row__thumb" src="assets/images/gallery-lagoon-beach.jpg" alt="" loading="lazy" width="128" height="128">
            <div class="comm-row__text">
              <h3>Palm Jumeirah</h3>
              <p>Iconic island beachfront living</p>
              <span class="comm-row__cats">Waterfront &middot; Luxury</span>
            </div>
            <a class="btn btn--secondary btn--sm" href="#" aria-label="View Palm Jumeirah community (page to be added)">View Community</a>
          </div>
          <div class="comm-row" data-reveal>
            <img class="comm-row__thumb" src="assets/images/hero-villa-pool.jpg" alt="" loading="lazy" width="128" height="128">
            <div class="comm-row__text">
              <h3>Dubai Creek Harbour</h3>
              <p>Emerging waterfront district by the creek</p>
              <span class="comm-row__cats">Waterfront &middot; Emerging</span>
            </div>
            <a class="btn btn--secondary btn--sm" href="#" aria-label="View Dubai Creek Harbour community (page to be added)">View Community</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ Explore by lifestyle ============ -->
    <section class="lifestyle section section--gray" aria-labelledby="lifestyle-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Explore by Lifestyle</p>
          <h2 id="lifestyle-title">Start from how you want to live</h2>
        </div>
        <div class="categories__grid">
          <a class="category-card" href="#" data-reveal aria-label="Waterfront Living communities (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-waves"/></svg></span>
            <span class="category-card__text">
              <h3>Waterfront Living</h3>
              <p>Beaches, marinas and lagoon communities</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Family Communities (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-users"/></svg></span>
            <span class="category-card__text">
              <h3>Family Communities</h3>
              <p>Parks, schools and villa neighbourhoods</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="City Living communities (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg></span>
            <span class="category-card__text">
              <h3>City Living</h3>
              <p>Towers and districts at the centre of it all</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Luxury Destinations (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-sparkles"/></svg></span>
            <span class="category-card__text">
              <h3>Luxury Destinations</h3>
              <p>Dubai's most exclusive addresses</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Investment Areas (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-chart"/></svg></span>
            <span class="category-card__text">
              <h3>Investment Areas</h3>
              <p>Districts with strong rental demand</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Emerging Communities (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-leaf"/></svg></span>
            <span class="category-card__text">
              <h3>Emerging Communities</h3>
              <p>New districts taking shape across Dubai</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
        </div>
      </div>
    </section>

    <!-- ============ Choosing the right community ============ -->
    <section class="choose section" aria-labelledby="choose-title">
      <div class="container choose__grid">
        <div class="choose__intro" data-reveal>
          <p class="eyebrow">Choosing the Right Community</p>
          <h2 id="choose-title">We compare locations so you don't have to guess</h2>
          <p>
            Brochures make every community look perfect. Our job is to show you how
            they actually compare for your life and your goals.
          </p>
          <a class="btn btn--primary" href="contact.php">Speak With a Consultant</a>
        </div>
        <ol class="choose__list">
          <li data-reveal>
            <div>
              <h3>Understand your goals first</h3>
              <p>Living, investing or both — the right community depends on the answer.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Compare lifestyle and investment needs</h3>
              <p>Some areas favour daily life; others favour returns. We show the trade-offs.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Evaluate connectivity</h3>
              <p>Real commute times to work, schools and airports — not map distances.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Review the property options</h3>
              <p>What each community actually offers at your budget, ready and off-plan.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Match communities to your budget</h3>
              <p>A realistic shortlist of locations where your budget works hardest.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Support the final decision</h3>
              <p>Viewings, comparisons and paperwork — through to a confident choice.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <!-- ============ Communities map ============ -->
    <section class="map section section--gray" aria-labelledby="map-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Communities Map</p>
          <h2 id="map-title">Where they sit in the city</h2>
        </div>
        <div class="map__frame" data-reveal>
          <svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg>
          <p class="map__placeholder-title">Map placeholder</p>
          <p class="map__placeholder-text">
            A simplified Dubai map with markers for each featured community will be
            added here. In the meantime, you can explore the city in Google Maps.
          </p>
          <a class="btn btn--primary" href="https://www.google.com/maps/search/?api=1&amp;query=Dubai" target="_blank" rel="noopener">
            Open Dubai in Google Maps
          </a>
        </div>
      </div>
    </section>

    <!-- ============ Featured opportunities ============ -->
    <section class="projects section" aria-labelledby="projects-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Opportunities</p>
          <h2 id="projects-title">A few projects worth a look</h2>
          <p class="section-head__sub">
            A small, curated selection — each community page will carry its own
            project listings.
          </p>
        </div>
        <div class="projects__grid">
          <article class="project-card" data-reveal>
            <div class="project-card__media">
              <img src="assets/images/hero-villa-pool.jpg"
                   alt="Modern luxury villa with a private pool in DAMAC Islands 2"
                   loading="lazy" width="1800" height="1200">
            </div>
            <div class="project-card__body">
              <h3 class="project-card__name">DAMAC Islands 2</h3>
              <ul class="project-card__meta">
                <li><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg> Dubailand, Dubai</li>
                <li><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg> DAMAC Properties</li>
              </ul>
              <div class="project-card__foot">
                <div>
                  <p class="project-card__price-label">Starting from</p>
                  <p class="project-card__price">AED 1.9M</p>
                </div>
                <a class="project-card__link" href="damac-islands2.php">
                  View Project
                  <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
                </a>
              </div>
            </div>
          </article>

          <article class="project-card" data-reveal>
            <div class="project-card__media">
              <img src="assets/images/gallery-lagoon-beach.jpg"
                   alt="Turquoise lagoon meeting a sandy beach in a waterfront community"
                   loading="lazy" width="900" height="1200">
            </div>
            <div class="project-card__body">
              <h3 class="project-card__name">Creek Waterfront Residences</h3>
              <ul class="project-card__meta">
                <li><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg> Dubai Creek Harbour</li>
                <li><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg> Emaar</li>
              </ul>
              <div class="project-card__foot">
                <div>
                  <p class="project-card__price-label">Starting from</p>
                  <p class="project-card__price">AED 1.6M</p>
                </div>
                <a class="project-card__link" href="contact.php#enquire">
                  Enquire
                  <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
                </a>
              </div>
            </div>
          </article>

          <article class="project-card" data-reveal>
            <div class="project-card__media">
              <img src="assets/images/gallery-villa-dusk.jpg"
                   alt="Contemporary two-storey villa with floor-to-ceiling glazing at dusk"
                   loading="lazy" width="1800" height="1200">
            </div>
            <div class="project-card__body">
              <h3 class="project-card__name">Hillside Villa Collection</h3>
              <ul class="project-card__meta">
                <li><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg> Dubai Hills Estate</li>
                <li><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg> Emaar</li>
              </ul>
              <div class="project-card__foot">
                <div>
                  <p class="project-card__price-label">Starting from</p>
                  <p class="project-card__price">AED 5.2M</p>
                </div>
                <a class="project-card__link" href="contact.php#enquire">
                  Enquire
                  <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
                </a>
              </div>
            </div>
          </article>

          <article class="project-card" data-reveal>
            <div class="project-card__media">
              <img src="assets/images/gallery-resort-pool.jpg"
                   alt="Resort-style swimming pool surrounded by palm trees by the sea"
                   loading="lazy" width="900" height="1200">
            </div>
            <div class="project-card__body">
              <h3 class="project-card__name">Island Coast Townhouses</h3>
              <ul class="project-card__meta">
                <li><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg> Palm Jebel Ali</li>
                <li><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg> Nakheel</li>
              </ul>
              <div class="project-card__foot">
                <div>
                  <p class="project-card__price-label">Starting from</p>
                  <p class="project-card__price">AED 2.8M</p>
                </div>
                <a class="project-card__link" href="contact.php#enquire">
                  Enquire
                  <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
                </a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="faq section section--gray" aria-labelledby="faq-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Common Questions</p>
          <h2 id="faq-title">Choosing a community, explained</h2>
        </div>
        <div class="faq__list">
          <details class="faq-item" data-reveal>
            <summary>
              Which Dubai communities are best for families?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Families usually gravitate toward master-planned villa and townhouse
                communities with parks, schools and space — areas like Dubai Hills
                Estate are a common starting point. The right fit depends on schools,
                commutes and budget, which is exactly what we help you compare.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              What are my options for waterfront living?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Dubai offers several distinct waterfront lifestyles — marina high-rises,
                island beachfront, creek-side districts and new lagoon communities.
                Each has a different feel and price point; tell us yours and we will
                narrow it down.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              How do I compare two communities properly?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Look past the renders: compare real commute times, the property types
                available at your budget, amenities you will actually use, and how
                established the community is. We prepare this comparison for you before
                any viewing.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Can I find both ready and off-plan properties in these areas?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Yes — established communities offer ready homes for immediate move-in,
                while newer districts are dominated by off-plan releases with staged
                payment plans. Many buyers weigh one against the other, and we can show
                you both sides.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Which areas suit investors best?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                It depends on your strategy — rental yield, capital growth or a mix.
                Central districts and emerging waterfront communities each behave
                differently. We will walk you through the realistic options against
                your budget and horizon rather than quoting generic numbers.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              How do I get help choosing?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Book a short consultation — by phone, WhatsApp or at our Business Bay
                office. We will map your goals to two or three communities worth
                focusing on, with no obligation to proceed.
              </p>
            </div>
          </details>
        </div>
      </div>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/hero-lagoon-aerial.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Not sure which Dubai community fits your goals?</h2>
        <p class="cta-final__sub" data-reveal>
          Tell us how you want to live — or what you want your investment to do — and
          we will shortlist the communities that deliver it.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="contact.php#enquire">Contact Us</a>
          <a class="btn btn--ghost btn--lg" href="https://wa.me/971504217299" target="_blank" rel="noopener">
            <svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg>
            WhatsApp Us
          </a>
        </div>
        <p class="cta-final__contact" data-reveal>
          Prefer email? Write to <a href="mailto:info@smbdubai.net">info@smbdubai.net</a>
        </p>
      </div>
    </section>
  </main>

<?php require __DIR__ . '/footer.php'; ?>
