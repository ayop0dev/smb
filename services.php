<?php
$page_title = 'Our Services — SMB Real Estate Brokers L.L.C | Off-Plan, Residential & Commercial';
$page_description = 'Explore the services of SMB Real Estate Brokers L.L.C — off-plan property advisory, residential and commercial sales, investment guidance and full transaction support across Dubai.';
$page_og_title = 'Services — SMB Real Estate Brokers';
$page_og_description = 'Off-plan advisory, residential and commercial sales, investment guidance and transaction support in Dubai.';
$page_og_image = 'assets/images/gallery-lagoon-beach.jpg';
$current_page = 'services';
$skip_link = '#intro';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/services.css',
];

require __DIR__ . '/header.php';
?>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/gallery-lagoon-beach.jpg"
           alt="Turquoise lagoon water meeting a sandy beach in Dubai"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="index.php">Home</a></li>
              <li><span aria-current="page">Services</span></li>
            </ol>
          </nav>
          <h1 id="hero-title">Guidance for every property decision</h1>
          <p class="hero__description">
            From off-plan launches to ready homes and commercial space, SMB supports
            buyers, sellers and investors through every stage of the transaction.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Services introduction ============ -->
    <section class="intro section" id="intro" aria-labelledby="intro-title">
      <div class="container split split--media-right">
        <div class="split__text" data-reveal>
          <p class="eyebrow">What We Do</p>
          <h2 id="intro-title">One brokerage, the full transaction</h2>
          <p>
            SMB Real Estate Brokers works across Dubai's residential and commercial
            market. Whether you are buying, selling, leasing or investing, we provide
            the market knowledge, professional representation and expert advice to
            move from intention to a completed transaction.
          </p>
          <p>
            Every engagement follows the same principle: understand your goal first,
            then recommend only what serves it. The services below cover the ways we
            most often help our clients.
          </p>
        </div>
        <div class="split__media" data-reveal>
          <img src="assets/images/hero-villa-pool.jpg"
               alt="Modern luxury villa with a private pool representing Dubai's property market"
               loading="lazy" width="1800" height="1200">
        </div>
      </div>
    </section>

    <!-- ============ Featured service: off-plan advisory ============ -->
    <section class="offplan section" aria-labelledby="offplan-title">
      <img class="offplan__bg" src="assets/images/hero-lagoon-aerial.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container offplan__inner split">
        <div class="offplan__text" data-reveal>
          <span class="offplan__tag">Core Focus</span>
          <h2 id="offplan-title">Off-Plan Property Advisory</h2>
          <p>
            Off-plan is where SMB does its most important work. Buying before
            completion can offer attractive entry prices and payment plans — but it
            requires careful judgement about location, timing and the terms behind
            the brochure.
          </p>
          <ul class="offplan__list">
            <li>
              <svg class="icon" aria-hidden="true"><use href="#i-check"/></svg>
              <span>Guidance on new launches across Dubai's master-planned communities</span>
            </li>
            <li>
              <svg class="icon" aria-hidden="true"><use href="#i-check"/></svg>
              <span>Payment plans, fees and handover timelines explained before you commit</span>
            </li>
            <li>
              <svg class="icon" aria-hidden="true"><use href="#i-check"/></svg>
              <span>Honest assessment of how each opportunity fits your budget and goals</span>
            </li>
            <li>
              <svg class="icon" aria-hidden="true"><use href="#i-check"/></svg>
              <span>Support with reservation, documentation and every milestone to handover</span>
            </li>
          </ul>
          <a class="btn btn--accent btn--lg" href="#enquire">Discuss Off-Plan Opportunities</a>
        </div>
        <div class="offplan__media" data-reveal>
          <img src="assets/images/gallery-villa-dusk.jpg"
               alt="Newly completed contemporary villa at dusk"
               loading="lazy" width="1800" height="1200">
        </div>
      </div>
    </section>

    <!-- ============ All services ============ -->
    <section class="services section section--gray" aria-labelledby="services-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">All Services</p>
          <h2 id="services-title">How we help our clients</h2>
        </div>
        <div class="services__grid">
          <article class="service-card" data-reveal>
            <span class="service-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-home"/></svg></span>
            <h3>Residential Property Sales</h3>
            <p>Buying or selling apartments, villas and townhouses — accurate valuations, qualified buyers and professional representation throughout.</p>
            <a class="service-card__link" href="#enquire">
              Enquire
              <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
            </a>
          </article>
          <article class="service-card" data-reveal>
            <span class="service-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg></span>
            <h3>Commercial Property Sales</h3>
            <p>Offices, retail and commercial space for businesses and investors, matched to operational needs and long-term plans.</p>
            <a class="service-card__link" href="#enquire">
              Enquire
              <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
            </a>
          </article>
          <article class="service-card" data-reveal>
            <span class="service-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-chart"/></svg></span>
            <h3>Investment Guidance</h3>
            <p>Practical advice on where and how to invest in Dubai real estate, aligned with your budget, horizon and appetite for risk.</p>
            <a class="service-card__link" href="#enquire">
              Enquire
              <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
            </a>
          </article>
          <article class="service-card" data-reveal>
            <span class="service-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-deed"/></svg></span>
            <h3>Transaction Support</h3>
            <p>Negotiation, paperwork and coordination handled end to end, so your transaction moves forward without stress or surprises.</p>
            <a class="service-card__link" href="#enquire">
              Enquire
              <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
            </a>
          </article>
        </div>
      </div>
    </section>

    <!-- ============ Who we serve ============ -->
    <section class="audience section" aria-labelledby="audience-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Who We Serve</p>
          <h2 id="audience-title">Built around different goals</h2>
          <p class="section-head__sub">
            The service is the same standard — the advice is shaped around who you are
            and what you are trying to achieve.
          </p>
        </div>
        <div class="audience__grid">
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-key"/></svg></span>
            <span class="category-card__text">
              <h3>First-Time Buyers</h3>
              <p>Clear explanations of every step, from budgeting to title deed</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg></span>
            <span class="category-card__text">
              <h3>Owners &amp; Sellers</h3>
              <p>Realistic valuations and qualified buyers for your property</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-chart"/></svg></span>
            <span class="category-card__text">
              <h3>Investors</h3>
              <p>Off-plan and ready opportunities assessed against your goals</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-bag"/></svg></span>
            <span class="category-card__text">
              <h3>Businesses</h3>
              <p>Commercial premises found and negotiated for your operations</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
        </div>
      </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="faq section section--gray" aria-labelledby="faq-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Common Questions</p>
          <h2 id="faq-title">Before you get in touch</h2>
        </div>
        <div class="faq__list">
          <details class="faq-item" data-reveal>
            <summary>
              What does your off-plan advisory service include?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                We help you compare current launches, understand payment plans, fees and
                expected handover timelines, and assess how each opportunity fits your
                budget and goals. Once you decide, we manage the reservation and
                documentation, and stay involved through to handover.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Do you work with buyers, sellers, or both?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Both — as well as landlords, investors and businesses. We represent
                buyers looking for the right property and owners who want realistic
                valuations and qualified interest in what they are selling.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Can international buyers purchase property in Dubai?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Yes. Dubai's freehold areas allow ownership for all nationalities. We
                regularly assist overseas buyers and can guide you through the process
                remotely, from shortlisting to completion.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Which areas of Dubai do you cover?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                We work across Dubai's residential and commercial communities, with
                particular depth in off-plan and master-planned developments. Tell us
                where you are looking — or let us suggest areas that fit your brief.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              How are your services charged?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                It depends on the service and the transaction. Fees are always explained
                clearly and agreed before any engagement begins — transparency on costs
                is part of how we work.
              </p>
            </div>
          </details>
        </div>
      </div>
      <script type="application/ld+json"><?= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
          ['@type' => 'Question', 'name' => 'What does your off-plan advisory service include?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'We help you compare current launches, understand payment plans, fees and expected handover timelines, and assess how each opportunity fits your budget and goals. Once you decide, we manage the reservation and documentation, and stay involved through to handover.']],
          ['@type' => 'Question', 'name' => 'Do you work with buyers, sellers, or both?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Both — as well as landlords, investors and businesses. We represent buyers looking for the right property and owners who want realistic valuations and qualified interest in what they are selling.']],
          ['@type' => 'Question', 'name' => 'Can international buyers purchase property in Dubai?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Yes. Dubai's freehold areas allow ownership for all nationalities. We regularly assist overseas buyers and can guide you through the process remotely, from shortlisting to completion."]],
          ['@type' => 'Question', 'name' => 'Which areas of Dubai do you cover?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => "We work across Dubai's residential and commercial communities, with particular depth in off-plan and master-planned developments. Tell us where you are looking — or let us suggest areas that fit your brief."]],
          ['@type' => 'Question', 'name' => 'How are your services charged?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'It depends on the service and the transaction. Fees are always explained clearly and agreed before any engagement begins — transparency on costs is part of how we work.']],
        ],
      ], JSON_UNESCAPED_SLASHES) ?></script>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/gallery-resort-pool.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Tell us what you're trying to achieve</h2>
        <p class="cta-final__sub" data-reveal>
          A short conversation is enough to point you in the right direction — and to
          see whether we are the right partner for it.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="tel:+971504217299">
            <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
            Call +971 50 421 7299
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
