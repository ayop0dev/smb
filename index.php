<?php
$page_title = 'SMB Real Estate Brokers — Buy, Sell & Invest in Dubai Real Estate';
$page_description = 'SMB Real Estate Brokers L.L.C is a Dubai-based brokerage helping clients buy, sell and invest in residential, commercial and off-plan properties across Dubai\'s leading communities.';
$page_og_title = 'SMB Real Estate Brokers — Dubai Real Estate Brokerage';
$page_og_description = 'Your trusted partner for residential, commercial and off-plan real estate in Dubai. Serving, Managing & Beyond.';
$page_og_image = 'assets/images/hero-lagoon-aerial.jpg';
$current_page = 'home';
$skip_link = '#projects';
$page_styles = [
    'assets/css/home.css',
];

require __DIR__ . '/header.php';
?>

  <script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'SMB Real Estate Brokers',
    'url' => $site_url . '/',
  ], JSON_UNESCAPED_SLASHES) ?></script>

  <main id="top">

    <!-- ============ Hero ============ -->
    <section class="hero hero--home" aria-labelledby="hero-title">
      <img class="hero__bg hero__bg--fallback" src="assets/images/hero-lagoon-aerial.jpg"
           alt="Aerial view of a Dubai waterfront community with turquoise lagoons and villas"
           fetchpriority="high">
      <video class="hero__bg hero__bg--video" autoplay muted loop playsinline webkit-playsinline
             preload="auto" poster="assets/images/hero-lagoon-aerial.jpg" aria-hidden="true" tabindex="-1">
        <source src="assets/videos/hero.webm" type="video/webm">
        <source src="assets/videos/hero.mp4" type="video/mp4">
      </video>
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <p class="eyebrow eyebrow--light">SMB Real Estate L.L.C &middot; UAE</p>
          <h1 id="hero-title">Property decisions, considered properly</h1>
          <p class="hero__headline">Independent advice across the UAE</p>
          <div class="hero__cta">
            <a class="btn btn--accent btn--lg" href="#projects">Review Selected Opportunities</a>
            <a class="btn btn--ghost btn--lg" href="#enquire">Start a Private Conversation</a>
          </div>
          <div class="hero__search" role="search" aria-label="Browse properties by type">
            <span class="hero__search-icon" aria-hidden="true">
              <svg class="icon icon--sm" aria-hidden="true"><use href="#i-search"/></svg>
            </span>
            <span class="hero__search-divider" aria-hidden="true"></span>
            <div class="hero__search-chips">
              <a href="#categories">Apartments</a>
              <a href="#categories">Villas</a>
              <a href="#categories">Townhouses</a>
              <a href="#categories">Commercial</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ Featured projects ============ -->
    <section class="projects section" id="projects" aria-labelledby="projects-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Projects</p>
          <h2 id="projects-title">Properties selected with purpose</h2>
          <p class="section-head__sub">
            Off-plan and ready properties chosen for their relevance to your brief&mdash;not for the convenience of the sale.
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
                <a class="project-card__link" href="#enquire">
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
                <a class="project-card__link" href="#enquire">
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
                <a class="project-card__link" href="#enquire">
                  Enquire
                  <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
                </a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ============ Why SMB ============ -->
    <section class="why section section--gray" id="why-smb" aria-labelledby="why-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Why SMB</p>
          <h2 id="why-title">Your interests set the direction</h2>
          <p class="section-head__sub">
            The brief begins with what matters to you. Everything that follows&mdash;research, recommendation and execution&mdash;must answer to it.
          </p>
        </div>
        <div class="why__grid">
          <div class="why-item" data-reveal>
            <span class="why-item__num" aria-hidden="true">01</span>
            <h3>Local Market Expertise</h3>
            <p>Market judgement grounded in current values, local context and a clear view of the opportunities across the Emirates.</p>
          </div>
          <div class="why-item" data-reveal>
            <span class="why-item__num" aria-hidden="true">02</span>
            <h3>Verified Projects</h3>
            <p>A project earns consideration through its fundamentals: developer, location, terms, delivery outlook and fit with your plans.</p>
          </div>
          <div class="why-item" data-reveal>
            <span class="why-item__num" aria-hidden="true">03</span>
            <h3>Transparent Guidance</h3>
            <p>Merits are presented alongside limitations and trade-offs, before any commitment is made.</p>
          </div>
          <div class="why-item" data-reveal>
            <span class="why-item__num" aria-hidden="true">04</span>
            <h3>End-to-End Support</h3>
            <p>One adviser holds the detail throughout&mdash;from the early search to handover and the practical matters that follow.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ Property categories ============ -->
    <section class="categories section" id="categories" aria-labelledby="categories-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Property Types</p>
          <h2 id="categories-title">Browse by category</h2>
        </div>
        <div class="categories__grid">
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg></span>
            <span class="category-card__text">
              <h3>Apartments</h3>
              <p>Well-connected homes in established and emerging city districts</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-home"/></svg></span>
            <span class="category-card__text">
              <h3>Villas</h3>
              <p>Privacy, space and continuity for family life</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-key"/></svg></span>
            <span class="category-card__text">
              <h3>Townhouses</h3>
              <p>A practical balance of space, community and value</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-waves"/></svg></span>
            <span class="category-card__text">
              <h3>Waterfront</h3>
              <p>Coastal homes shaped by setting, access and outlook</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-bag"/></svg></span>
            <span class="category-card__text">
              <h3>Commercial</h3>
              <p>Offices and retail for growing businesses</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-sparkles"/></svg></span>
            <span class="category-card__text">
              <h3>Investment</h3>
              <p>Off-plan and ready assets selected against your strategy</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
        </div>
      </div>
    </section>

    <!-- ============ Featured communities ============ -->
    <section class="communities section section--gray" id="communities" aria-labelledby="communities-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Communities</p>
          <h2 id="communities-title">A location that works for you</h2>
          <p class="section-head__sub">
            From mature city districts to quieter coastal destinations, the right setting depends on how you plan to live or invest.
          </p>
        </div>
        <div class="communities__grid">
          <a class="community-card" href="#enquire" data-reveal>
            <img src="assets/images/gallery-interior.jpg" alt="" loading="lazy" width="900" height="1200">
            <span class="community-card__content">
              <h3>Downtown Dubai</h3>
              <span class="community-card__cta">Explore <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
            </span>
          </a>
          <a class="community-card" href="#enquire" data-reveal>
            <img src="assets/images/gallery-resort-pool.jpg" alt="" loading="lazy" width="900" height="1200">
            <span class="community-card__content">
              <h3>Saadiyat Island, Abu Dhabi</h3>
              <span class="community-card__cta">Explore <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
            </span>
          </a>
          <a class="community-card" href="#enquire" data-reveal>
            <img src="assets/images/hero-lagoon-aerial.jpg" alt="" loading="lazy" width="1800" height="1200">
            <span class="community-card__content">
              <h3>Al Marjan Island, Ras Al Khaimah</h3>
              <span class="community-card__cta">Explore <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
            </span>
          </a>
          <a class="community-card" href="#enquire" data-reveal>
            <img src="assets/images/gallery-villa-dusk.jpg" alt="" loading="lazy" width="1800" height="1200">
            <span class="community-card__content">
              <h3>Aljada, Sharjah</h3>
              <span class="community-card__cta">Explore <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
            </span>
          </a>
          <a class="community-card" href="#enquire" data-reveal>
            <img src="assets/images/gallery-lagoon-beach.jpg" alt="" loading="lazy" width="900" height="1200">
            <span class="community-card__content">
              <h3>Al Zorah, Ajman</h3>
              <span class="community-card__cta">Explore <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
            </span>
          </a>
          <a class="community-card" href="#enquire" data-reveal>
            <img src="assets/images/hero-villa-pool.jpg" alt="" loading="lazy" width="1800" height="1200">
            <span class="community-card__content">
              <h3>Fujairah Waterfront</h3>
              <span class="community-card__cta">Explore <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
            </span>
          </a>
        </div>
      </div>
    </section>

    <!-- ============ Buying process ============ -->
    <section class="steps section" aria-labelledby="steps-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">How It Works</p>
          <h2 id="steps-title">A measured route to the right decision</h2>
        </div>
        <ol class="steps__grid">
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">1</span>
            <h3>Discover</h3>
            <p>Your priorities, budget and timing give the search its direction.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">2</span>
            <h3>Consult</h3>
            <p>Your adviser tests the strongest options against value, location, terms and long-term suitability.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">3</span>
            <h3>Reserve</h3>
            <p>When the choice is made, negotiation, reservation and documentation are handled with care.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">4</span>
            <h3>Own</h3>
            <p>The relationship continues through signing and handover, with practical assistance available afterwards.</p>
          </li>
        </ol>
      </div>
    </section>

    <!-- ============ Testimonials ============ -->
    <section class="testimonials section section--gray" aria-labelledby="testimonials-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Client Stories</p>
          <h2 id="testimonials-title">Confidence built over the whole journey</h2>
        </div>
        <div class="testimonials__grid">
          <figure class="testimonial-card" data-reveal>
            <span class="testimonial-card__mark" aria-hidden="true">&ldquo;</span>
            <blockquote>
              <p>The team was responsive from the first call and negotiated a better payment plan than I expected. Everything was explained clearly — no surprises.</p>
            </blockquote>
            <figcaption>
              <p class="testimonial-card__name">Ahmed R.</p>
              <p class="testimonial-card__role">Property Investor</p>
            </figcaption>
          </figure>
          <figure class="testimonial-card" data-reveal>
            <span class="testimonial-card__mark" aria-hidden="true">&ldquo;</span>
            <blockquote>
              <p>As first-time buyers we had endless questions. Our consultant walked us through every step, from viewings to handover. We felt supported the whole way.</p>
            </blockquote>
            <figcaption>
              <p class="testimonial-card__name">Sarah M.</p>
              <p class="testimonial-card__role">Homeowner, Dubai Hills</p>
            </figcaption>
          </figure>
          <figure class="testimonial-card" data-reveal>
            <span class="testimonial-card__mark" aria-hidden="true">&ldquo;</span>
            <blockquote>
              <p>Professional, honest and genuinely knowledgeable about the market. They helped us find the right commercial space and handled the details end to end.</p>
            </blockquote>
            <figcaption>
              <p class="testimonial-card__name">Daniel K.</p>
              <p class="testimonial-card__role">Business Owner</p>
            </figcaption>
          </figure>
        </div>
      </div>
    </section>

    <!-- ============ Latest insights ============ -->
    <section class="insights section" id="insights" aria-labelledby="insights-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Latest Insights</p>
          <h2 id="insights-title">Perspective for better decisions</h2>
        </div>
        <div class="insights__grid">
          <article class="insight-card" data-reveal>
            <a class="insight-card__media" href="#" aria-hidden="true" tabindex="-1">
              <img src="assets/images/hero-lagoon-aerial.jpg"
                   alt="" loading="lazy" width="1800" height="1200">
            </a>
            <p class="insight-card__tag">Market Insights</p>
            <h3><a href="#" aria-label="Dubai off-plan in 2026: what buyers should know before reserving (article to be added)">UAE off-plan in 2026: what buyers should know before reserving</a></h3>
            <p class="insight-card__excerpt">Payment plans, handover timelines and how to evaluate a developer's track record.</p>
            <p class="insight-card__date">July 2026 &middot; 6 min read</p>
          </article>
          <article class="insight-card" data-reveal>
            <a class="insight-card__media" href="#" aria-hidden="true" tabindex="-1">
              <img src="assets/images/gallery-interior.jpg"
                   alt="" loading="lazy" width="900" height="1200">
            </a>
            <p class="insight-card__tag">Buying Guides</p>
            <h3><a href="#" aria-label="Freehold ownership in Dubai: a practical guide for international buyers (article to be added)">Freehold ownership in the UAE: a practical guide for international buyers</a></h3>
            <p class="insight-card__excerpt">What freehold means, where international buyers can purchase and the steps from offer to title deed.</p>
            <p class="insight-card__date">June 2026 &middot; 5 min read</p>
          </article>
          <article class="insight-card" data-reveal>
            <a class="insight-card__media" href="#" aria-hidden="true" tabindex="-1">
              <img src="assets/images/gallery-villa-dusk.jpg"
                   alt="" loading="lazy" width="1800" height="1200">
            </a>
            <p class="insight-card__tag">Communities</p>
            <h3><a href="#" aria-label="Five Dubai communities families are choosing in 2026 (article to be added)">UAE communities families are considering in 2026</a></h3>
            <p class="insight-card__excerpt">Schools, parks and connectivity &mdash; how family communities across the Emirates compare.</p>
            <p class="insight-card__date">June 2026 &middot; 4 min read</p>
          </article>
        </div>
      </div>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/gallery-lagoon-beach.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Begin with the right conversation</h2>
        <p class="cta-final__sub" data-reveal>
          Tell us what the property needs to achieve. We will bring perspective to the decision, discipline to the search and care to the work that follows.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="tel:+971504217299">
            <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
            Start Your Property Conversation
          </a>
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
