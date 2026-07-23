<?php
$page_title = 'Our Services — SMB Real Estate Brokers L.L.C | Off-Plan, Residential & Commercial';
$page_description = 'Explore the services of SMB Real Estate Brokers L.L.C — off-plan property advisory, residential and commercial sales, investment guidance and full transaction support across Dubai.';
$page_og_title = 'Services — SMB Real Estate Brokers';
$page_og_description = 'Off-plan advisory, residential and commercial sales, investment guidance and transaction support in Dubai.';
$page_og_image = 'assets/images/projects/six-senses-residences-dubai-marina/webp/01-exterior.webp';
$current_page = 'services';
$skip_link = '#intro';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/services.css',
];

require __DIR__ . '/../includes/header.php';
?>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/projects/six-senses-residences-dubai-marina/webp/01-exterior.webp"
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
          <h1 id="hero-title">Advice for the decisions that matter</h1>
          <p class="hero__description">
            SMB is a UAE real estate advisory built around a simple principle: the right investment decision matters more than the quickest transaction.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Services introduction ============ -->
    <section class="intro section" id="intro" aria-labelledby="intro-title">
      <div class="container split split--media-right">
        <div class="split__text" data-reveal>
          <p class="eyebrow">What We Do</p>
          <h2 id="intro-title">One standard across every service</h2>
          <p>
            SMB is a UAE real estate advisory built around a simple principle: the right investment decision matters more than the quickest transaction.
          </p>
          <p>
            We don't just help you buy a property—we stand by your side every step of the journey. From negotiating with leading developers on your behalf and guiding you through the entire purchasing process to assisting with mortgage financing upon handover, our team ensures a seamless experience.
          </p>
          <p>
            Our commitment doesn't end once you own the property. We can help you resell it at the right time, lease it to qualified tenants, and maximize its long-term value.
          </p>
          <p>
            At SMB, we don't simply sell real estate—we create a complete investment ecosystem designed to protect your investment and help you achieve the highest possible return with confidence.
          </p>
        </div>
        <div class="split__media" data-reveal>
          <img src="assets/images/projects/lumena/webp/05-living-room.webp"
               alt="Modern luxury villa with a private pool representing Dubai's property market"
               loading="lazy" width="1800" height="1200">
        </div>
      </div>
    </section>

    <!-- ============ Featured service: off-plan advisory ============ -->
    <section class="offplan section" aria-labelledby="offplan-title">
      <img class="offplan__bg" src="assets/images/projects/damac-riverside-views/webp/01-aerial-view.webp" alt="" loading="lazy" aria-hidden="true">
      <div class="container offplan__inner split">
        <div class="offplan__text" data-reveal>
          <span class="offplan__tag">Core Focus</span>
          <h2 id="offplan-title">Off-Plan Property Advisory</h2>
          <p>
            Off-plan may offer a useful payment structure or early entry into a developing location. Those benefits need context. Delivery history, pricing, contract terms and future supply matter long after launch-day interest has passed.
          </p>
          <ul class="offplan__list">
            <li>
              <svg class="icon" aria-hidden="true"><use href="#i-check"/></svg>
              <span>A filtered view of launches with a credible place in the market</span>
            </li>
            <li>
              <svg class="icon" aria-hidden="true"><use href="#i-check"/></svg>
              <span>Payment plans, total costs and handover assumptions examined in full</span>
            </li>
            <li>
              <svg class="icon" aria-hidden="true"><use href="#i-check"/></svg>
              <span>A candid view of suitability, value and the compromises involved</span>
            </li>
            <li>
              <svg class="icon" aria-hidden="true"><use href="#i-check"/></svg>
              <span>Continuity across reservation, documentation, construction updates and handover</span>
            </li>
          </ul>
          <a class="btn btn--accent btn--lg" href="#enquire">Review Off-Plan Options</a>
        </div>
        <div class="offplan__media" data-reveal>
          <img src="assets/images/projects/azizi-milan/webp/01-exterior.webp"
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
          <h2 id="services-title">Expertise applied to your brief</h2>
        </div>
        <div class="services__grid">
          <article class="service-card" data-reveal>
            <span class="service-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-home"/></svg></span>
            <h3>Residential Property Sales</h3>
            <p>Advice and representation for buyers and sellers, grounded in realistic values, relevant opportunities and careful negotiation.</p>
            <a class="service-card__link" href="#enquire">
              Enquire
              <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
            </a>
          </article>
          <article class="service-card" data-reveal>
            <span class="service-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg></span>
            <h3>Commercial Property Sales</h3>
            <p>Commercial property considered against operating needs, location, tenure and the longer-term case for the asset.</p>
            <a class="service-card__link" href="#enquire">
              Enquire
              <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
            </a>
          </article>
          <article class="service-card" data-reveal>
            <span class="service-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-chart"/></svg></span>
            <h3>Investment Guidance</h3>
            <p>Decisions framed around capital, time horizon, income expectations and risk&mdash;not a fashionable launch or headline return.</p>
            <a class="service-card__link" href="#enquire">
              Enquire
              <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
            </a>
          </article>
          <article class="service-card" data-reveal>
            <span class="service-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-deed"/></svg></span>
            <h3>Transaction Support</h3>
            <p>Negotiation, documentation and coordination managed with a clear view of what is due, from whom and by when.</p>
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
          <h2 id="audience-title">Different briefs. The same care.</h2>
          <p class="section-head__sub">
            A first home calls for different judgement from a business premises or portfolio acquisition. Each receives the same care, but never the same formula.
          </p>
        </div>
        <div class="audience__grid">
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-key"/></svg></span>
            <span class="category-card__text">
              <h3>First-Time Buyers</h3>
              <p>Context and reassurance from initial budgeting to title deed</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg></span>
            <span class="category-card__text">
              <h3>Owners &amp; Sellers</h3>
              <p>Evidence-based pricing, considered positioning and qualified interest</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-chart"/></svg></span>
            <span class="category-card__text">
              <h3>Investors</h3>
              <p>Ready and off-plan opportunities tested against a defined strategy</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#enquire" data-reveal>
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-bag"/></svg></span>
            <span class="category-card__text">
              <h3>Businesses</h3>
              <p>Premises assessed and negotiated around operational priorities</p>
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
                The service covers launch selection, payment plans, total fees, delivery assumptions and fit with your wider objectives. Once a project is chosen, reservation and documentation are managed through to handover.
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
                Both, alongside landlords, investors and businesses. Buyers receive an independent view of the market; owners receive realistic pricing and considered representation.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Can international buyers purchase property in the UAE?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Yes. International buyers may own property in designated UAE freehold areas, subject to the rules of the relevant emirate. The process can be handled remotely, with the ownership framework and each required step set out clearly.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Which areas of the UAE do you cover?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Our coverage spans all seven emirates. Where a broader search serves the brief, locations are considered across emirate boundaries rather than in isolation.
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
                Fees depend on the service and transaction. They are set out and agreed before an engagement begins, so the commercial basis is clear from the outset.
              </p>
            </div>
          </details>
        </div>
      </div>
      <script type="application/ld+json"><?= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
          ['@type' => 'Question', 'name' => 'What does your off-plan advisory service include?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'The service covers launch selection, payment plans, total fees, delivery assumptions and fit with your wider objectives. Once a project is chosen, reservation and documentation are managed through to handover.']],
          ['@type' => 'Question', 'name' => 'Do you work with buyers, sellers, or both?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Both, alongside landlords, investors and businesses. Buyers receive an independent view of the market; owners receive realistic pricing and considered representation.']],
          ['@type' => 'Question', 'name' => 'Can international buyers purchase property in the UAE?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. International buyers may own property in designated UAE freehold areas, subject to the rules of the relevant emirate. The process can be handled remotely, with the ownership framework and each required step set out clearly.']],
          ['@type' => 'Question', 'name' => 'Which areas of the UAE do you cover?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Our coverage spans all seven emirates. Where a broader search serves the brief, locations are considered across emirate boundaries rather than in isolation.']],
          ['@type' => 'Question', 'name' => 'How are your services charged?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Fees depend on the service and transaction. They are set out and agreed before an engagement begins, so the commercial basis is clear from the outset.']],
        ],
      ], JSON_UNESCAPED_SLASHES) ?></script>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/projects/fahid-island/webp/06-marina-promenade.webp" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Bring us the decision you are considering</h2>
        <p class="cta-final__sub" data-reveal>
          A focused conversation is usually enough to define the requirement, establish what is realistic and decide whether SMB is the right adviser for the work.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="tel:+971504217299">
            <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
            Discuss Your Requirements
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

<?php require __DIR__ . '/../includes/footer.php'; ?>
