<?php
$page_title = 'About Us — SMB Real Estate Brokers L.L.C | Dubai Real Estate Brokerage';
$page_description = 'Learn about SMB Real Estate Brokers L.L.C — a Dubai-based brokerage established in 2021, helping clients buy, sell, manage and invest in residential and commercial properties with honest, client-first guidance.';
$page_og_title = 'About SMB Real Estate Brokers — Serving, Managing & Beyond';
$page_og_description = 'A Dubai-based brokerage built on transparency, market knowledge and long-term client relationships.';
$page_og_image = 'assets/images/gallery-villa-dusk.jpg';
$current_page = 'about';
$skip_link = '#intro';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
];

require __DIR__ . '/header.php';
?>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/gallery-villa-dusk.jpg"
           alt="Contemporary villa with floor-to-ceiling glazing at dusk in Dubai"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="index.php">Home</a></li>
              <li><span aria-current="page">About</span></li>
            </ol>
          </nav>
          <p class="eyebrow eyebrow--light">About SMB</p>
          <h1 id="hero-title">Serving, Managing &amp;&nbsp;Beyond</h1>
          <p class="hero__description">
            SMB Real Estate Brokers helps clients buy, sell, manage and invest in
            residential and commercial properties across Dubai — with honest guidance
            at every step.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Company introduction ============ -->
    <section class="intro section" id="intro" aria-labelledby="intro-title">
      <div class="container split split--media-right">
        <div class="split__text" data-reveal>
          <p class="eyebrow">Who We Are</p>
          <h2 id="intro-title">A client-first brokerage in the heart of Dubai</h2>
          <p>
            SMB Real Estate Brokers L.L.C is a Dubai-based brokerage established in 2021
            and headquartered in Business Bay. We assist individual buyers, families,
            investors and businesses with residential, commercial and off-plan
            properties across the city.
          </p>
          <p>
            Our work is built on local market knowledge and transparent advice. We take
            the time to understand each client's goals, explain options clearly, and
            stay involved from the first conversation to the final signature — and
            beyond. Most of our business comes from repeat clients and referrals, which
            is how we prefer to grow.
          </p>
          <ul class="intro-facts" aria-label="Company facts">
            <li>Established 2021</li>
            <li>Business Bay, Dubai</li>
            <li>Residential &amp; Commercial</li>
            <li>Off-Plan Advisory</li>
          </ul>
        </div>
        <div class="split__media" data-reveal>
          <img src="assets/images/gallery-interior.jpg"
               alt="Bright open-plan living space representing the properties SMB works with"
               loading="lazy" width="900" height="1200">
        </div>
      </div>
    </section>

    <!-- ============ Mission & vision ============ -->
    <section class="mv section section--gray" aria-labelledby="mv-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Our Direction</p>
          <h2 id="mv-title">What guides our work</h2>
        </div>
        <div class="mv__grid">
          <div class="mv-block" data-reveal>
            <p class="eyebrow">Mission</p>
            <h3>Informed decisions, every time</h3>
            <p>
              To help clients make informed property decisions through honest guidance,
              genuine market knowledge and dedicated support at every stage of the
              transaction.
            </p>
          </div>
          <div class="mv-block" data-reveal>
            <p class="eyebrow">Vision</p>
            <h3>Dubai's trusted property partner</h3>
            <p>
              To become a trusted real estate partner for buyers, sellers, landlords
              and investors in Dubai — known for transparency and long-term
              relationships.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ Our values ============ -->
    <section class="values section" aria-labelledby="values-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Our Values</p>
          <h2 id="values-title">How we work with every client</h2>
        </div>
        <div class="why__grid">
          <div class="why-item" data-reveal>
            <span class="why-item__num" aria-hidden="true">01</span>
            <h3>Transparency</h3>
            <p>We share what we know — prices, risks and realistic timelines — so nothing important is left unsaid.</p>
          </div>
          <div class="why-item" data-reveal>
            <span class="why-item__num" aria-hidden="true">02</span>
            <h3>Client Commitment</h3>
            <p>Every recommendation starts from the client's goals, not from what is easiest to sell.</p>
          </div>
          <div class="why-item" data-reveal>
            <span class="why-item__num" aria-hidden="true">03</span>
            <h3>Market Knowledge</h3>
            <p>We follow Dubai's communities, developers and values closely, so our advice reflects the market as it is today.</p>
          </div>
          <div class="why-item" data-reveal>
            <span class="why-item__num" aria-hidden="true">04</span>
            <h3>Professional Support</h3>
            <p>One dedicated point of contact represents you professionally through paperwork, negotiation and handover.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ Why clients choose SMB ============ -->
    <section class="choose section section--gray" aria-labelledby="choose-title">
      <div class="container choose__grid">
        <div class="choose__intro" data-reveal>
          <p class="eyebrow">Why Clients Choose SMB</p>
          <h2 id="choose-title">Practical value at every step</h2>
          <p>
            Values matter most when they show up in the day-to-day work. Here is what
            working with SMB looks like in practice.
          </p>
          <a class="btn btn--primary" href="#enquire">Speak With Our Team</a>
        </div>
        <ol class="choose__list">
          <li data-reveal>
            <div>
              <h3>Honest, clear property guidance</h3>
              <p>Straight answers about pricing, payment plans and trade-offs — before you commit to anything.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Access to selected opportunities</h3>
              <p>We shortlist properties and off-plan releases that genuinely fit your brief, rather than sending everything on the market.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Support from enquiry to transaction</h3>
              <p>Viewings, negotiation, paperwork and coordination are managed for you, end to end.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Knowledge of communities and developers</h3>
              <p>Practical insight into Dubai's neighbourhoods and developer track records informs every recommendation.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Responsive, personal communication</h3>
              <p>You deal with a person who knows your file — and who answers when you call.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <!-- ============ Team ============ -->
    <section class="team section" aria-labelledby="team-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Our Team</p>
          <h2 id="team-title">The people behind SMB</h2>
          <p class="section-head__sub">
            A small, dedicated team — so every client works directly with the people
            responsible for the result.
          </p>
        </div>
        <div class="team__grid">
          <article class="team-card" data-reveal>
            <div class="team-card__media" role="img" aria-label="Portrait placeholder — photo to be added">
              <svg class="icon" aria-hidden="true"><use href="#i-user"/></svg>
              <p class="team-card__media-note">Portrait to be added</p>
            </div>
            <div class="team-card__body">
              <h3 class="team-card__name">Name To Be Confirmed</h3>
              <p class="team-card__role">Founder &amp; Managing Director</p>
              <p class="team-card__bio">
                Leads SMB's brokerage operations and client advisory, with a focus on
                transparent guidance across Dubai's residential and off-plan market.
              </p>
              <div class="team-card__links">
                <a href="mailto:info@smbdubai.net" aria-label="Email the Founder &amp; Managing Director">
                  <svg class="icon" aria-hidden="true"><use href="#i-mail"/></svg>
                </a>
                <a href="#" aria-label="LinkedIn profile of the Founder &amp; Managing Director (link to be added)">
                  <svg class="icon" aria-hidden="true"><use href="#i-linkedin"/></svg>
                </a>
              </div>
              <p class="team-card__note">Temporary profile — final name, portrait and biography to be provided.</p>
            </div>
          </article>
          <article class="team-card" data-reveal>
            <div class="team-card__media" role="img" aria-label="Portrait placeholder — photo to be added">
              <svg class="icon" aria-hidden="true"><use href="#i-user"/></svg>
              <p class="team-card__media-note">Portrait to be added</p>
            </div>
            <div class="team-card__body">
              <h3 class="team-card__name">Name To Be Confirmed</h3>
              <p class="team-card__role">Senior Property Consultant</p>
              <p class="team-card__bio">
                Supports buyers and investors from first enquiry to handover,
                specialising in residential and commercial opportunities across
                Dubai's key communities.
              </p>
              <div class="team-card__links">
                <a href="mailto:info@smbdubai.net" aria-label="Email the Senior Property Consultant">
                  <svg class="icon" aria-hidden="true"><use href="#i-mail"/></svg>
                </a>
                <a href="#" aria-label="LinkedIn profile of the Senior Property Consultant (link to be added)">
                  <svg class="icon" aria-hidden="true"><use href="#i-linkedin"/></svg>
                </a>
              </div>
              <p class="team-card__note">Temporary profile — final name, portrait and biography to be provided.</p>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ============ How we work ============ -->
    <section class="steps section section--gray" aria-labelledby="steps-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">How We Work</p>
          <h2 id="steps-title">A simple, considered approach</h2>
        </div>
        <ol class="steps__grid">
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">1</span>
            <h3>Understand</h3>
            <p>We start with your goals, budget and timeline — not with a sales pitch.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">2</span>
            <h3>Advise</h3>
            <p>You get a clear picture of the market, realistic values and the options that fit.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">3</span>
            <h3>Shortlist</h3>
            <p>We narrow the market to a focused shortlist worth your time to view and compare.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">4</span>
            <h3>Support</h3>
            <p>From offer to handover, we manage the process and stay available afterwards.</p>
          </li>
        </ol>
      </div>
    </section>

    <!-- ============ Company commitment ============ -->
    <section class="commitment section" aria-labelledby="commitment-title">
      <div class="container split">
        <div class="split__media" data-reveal>
          <img src="assets/images/gallery-resort-pool.jpg"
               alt="Resort-style pool surrounded by palm trees, representing the Dubai lifestyle SMB clients invest in"
               loading="lazy" width="900" height="1200">
        </div>
        <div class="split__text" data-reveal>
          <p class="eyebrow">Our Commitment</p>
          <h2 id="commitment-title">Relationships that outlast transactions</h2>
          <div class="commitment__rule" aria-hidden="true"></div>
          <p>
            We measure our work by what happens after the deal closes. That means
            long-term client relationships, transparent communication throughout, and
            property decisions aligned with each client's goals — not with a quick
            commission.
          </p>
          <p>
            It is the reason clients come back, and the reason they send the people
            they care about to us.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/hero-villa-pool.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Let's discuss your property goals in Dubai</h2>
        <p class="cta-final__sub" data-reveal>
          Whether you are buying your first home, selling, or building a portfolio,
          a conversation with our team is the right place to start.
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
