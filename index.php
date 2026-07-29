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
    'assets/css/communities.css',
];

require __DIR__ . '/includes/project-data.php';
require __DIR__ . '/includes/developer-data.php';
require __DIR__ . '/includes/header.php';
?>

  <script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'SMB Real Estate Brokers',
    'url' => $site_url . '/',
  ], JSON_UNESCAPED_SLASHES) ?></script>

  <main id="top">

    <section class="hero hero--home" aria-labelledby="hero-title">
      <img class="hero__bg hero__bg--fallback" src="assets/images/hero-lagoon-aerial.jpg"
           alt="Aerial View Of A Dubai Waterfront Community With Turquoise Lagoons And Villas"
           fetchpriority="high">
      <video class="hero__bg hero__bg--video" autoplay muted loop playsinline webkit-playsinline
             preload="metadata" poster="assets/images/hero-lagoon-aerial.jpg" aria-hidden="true" tabindex="-1">
        <source src="assets/videos/hero.webm" type="video/webm">
        <source src="assets/videos/hero.mp4" type="video/mp4">
      </video>
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <p class="eyebrow eyebrow--light">SMB Real Estate L.L.C &middot; UAE</p>
          <h1 id="hero-title">Property Decisions, Considered Properly</h1>
          <p class="hero__headline">Independent Advice Across The UAE</p>
          <div class="hero__cta">
            <a class="btn btn--accent btn--lg" href="#projects">Review Selected Opportunities</a>
            <a class="btn btn--ghost btn--lg" href="#enquire">Start A Private Conversation</a>
          </div>
          <div class="hero__search" role="search" aria-label="Browse Properties By Type">
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

    <?php
      require_once __DIR__ . '/includes/project-card-helpers.php';

      $comm_project_placeholder = 'assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp';
      $comm_project_fallback_image = is_file(__DIR__ . '/' . $comm_project_placeholder)
          ? $comm_project_placeholder
          : 'assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp';

      $all_home_projects = get_all_projects_safe();
      $home_projects = $all_home_projects !== null ? array_slice($all_home_projects, 0, 6) : [];

      $project_card_fallback_image = $comm_project_fallback_image;
      $project_card_dev_href_fallback = static function (string $developerName): string {
          return 'developers.php#developer-' . developer_slug($developerName);
      };
    ?>
    <section class="projects section" id="projects" aria-labelledby="projects-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Projects</p>
          <h2 id="projects-title">Properties Selected With Purpose</h2>
          <p class="section-head__sub">
            Off-Plan And Ready Properties Chosen For Their Relevance To Your Brief&mdash;Not For The Convenience Of The Sale.
          </p>
        </div>
<?php if (empty($home_projects)): ?>
        <p class="section-head__sub">Project Listings Are Currently Unavailable.</p>
<?php else: ?>
        <div class="comms__grid">
<?php foreach ($home_projects as $project): ?>
<?php require __DIR__ . '/template-parts/project-card.php'; ?>
<?php endforeach; ?>
        </div>
<?php endif; ?>
      </div>
    </section>

    <section class="categories section" id="categories" aria-labelledby="categories-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Property Types</p>
          <h2 id="categories-title">Browse By Category</h2>
        </div>
        <div class="categories__grid">
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg></span>
            <span class="category-card__text">
              <h3>Apartments</h3>
              <p>Well-Connected Homes In Established And Emerging City Districts</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-home"/></svg></span>
            <span class="category-card__text">
              <h3>Villas</h3>
              <p>Privacy, Space And Continuity For Family Life</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-key"/></svg></span>
            <span class="category-card__text">
              <h3>Townhouses</h3>
              <p>A Practical Balance Of Space, Community And Value</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-waves"/></svg></span>
            <span class="category-card__text">
              <h3>Waterfront</h3>
              <p>Coastal Homes Shaped By Setting, Access And Outlook</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-bag"/></svg></span>
            <span class="category-card__text">
              <h3>Commercial</h3>
              <p>Offices And Retail For Growing Businesses</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-sparkles"/></svg></span>
            <span class="category-card__text">
              <h3>Investment</h3>
              <p>Off-Plan And Ready Assets Selected Against Your Strategy</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
        </div>
      </div>
    </section>

    <section class="steps section" aria-labelledby="steps-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">How It Works</p>
          <h2 id="steps-title">A Measured Route To The Right Decision</h2>
        </div>
        <ol class="steps__grid">
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">1</span>
            <h3>Discover</h3>
            <p>Your Priorities, Budget And Timing Give The Search Its Direction.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">2</span>
            <h3>Consult</h3>
            <p>Your Adviser Tests The Strongest Options Against Value, Location, Terms And Long-Term Suitability.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">3</span>
            <h3>Reserve</h3>
            <p>When The Choice Is Made, Negotiation, Reservation And Documentation Are Handled With Care.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">4</span>
            <h3>Own</h3>
            <p>The Relationship Continues Through Signing And Handover, With Practical Assistance Available Afterwards.</p>
          </li>
        </ol>
      </div>
    </section>

    <section class="communities section section--gray" id="communities" aria-labelledby="communities-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Communities</p>
          <h2 id="communities-title">A Location That Works For You</h2>
          <p class="section-head__sub">
            From Mature City Districts To Quieter Coastal Destinations, The Right Setting Depends On How You Plan To Live Or Invest.
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

    <section class="testimonials section section--gray" aria-labelledby="testimonials-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Client Stories</p>
          <h2 id="testimonials-title">Confidence Built Over The Whole Journey</h2>
        </div>
        <div class="testimonials__grid">
          <figure class="testimonial-card" data-reveal>
            <span class="testimonial-card__mark" aria-hidden="true">&ldquo;</span>
            <blockquote>
              <p>The Team Was Responsive From The First Call And Negotiated A Better Payment Plan Than I Expected. Everything Was Explained Clearly — No Surprises.</p>
            </blockquote>
            <figcaption>
              <p class="testimonial-card__name">Ahmed R.</p>
              <p class="testimonial-card__role">Property Investor</p>
            </figcaption>
          </figure>
          <figure class="testimonial-card" data-reveal>
            <span class="testimonial-card__mark" aria-hidden="true">&ldquo;</span>
            <blockquote>
              <p>As First-Time Buyers We Had Endless Questions. Our Consultant Walked Us Through Every Step, From Viewings To Handover. We Felt Supported The Whole Way.</p>
            </blockquote>
            <figcaption>
              <p class="testimonial-card__name">Sarah M.</p>
              <p class="testimonial-card__role">Homeowner, Dubai Hills</p>
            </figcaption>
          </figure>
          <figure class="testimonial-card" data-reveal>
            <span class="testimonial-card__mark" aria-hidden="true">&ldquo;</span>
            <blockquote>
              <p>Professional, Honest And Genuinely Knowledgeable About The Market. They Helped Us Find The Right Commercial Space And Handled The Details End To End.</p>
            </blockquote>
            <figcaption>
              <p class="testimonial-card__name">Daniel K.</p>
              <p class="testimonial-card__role">Business Owner</p>
            </figcaption>
          </figure>
        </div>
      </div>
    </section>

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

    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/gallery-lagoon-beach.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Begin With The Right Conversation</h2>
        <p class="cta-final__sub" data-reveal>
          Tell Us What The Property Needs To Achieve. We Will Bring Perspective To The Decision, Discipline To The Search And Care To The Work That Follows.
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
          Prefer Email? Write To <a href="mailto:info@smbdubai.net">info@smbdubai.net</a>
        </p>
      </div>
    </section>
  </main>

<?php require __DIR__ . '/includes/footer.php'; ?>
