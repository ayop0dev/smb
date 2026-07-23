<?php
$page_title = 'About Us — SMB Real Estate Brokers L.L.C | Dubai Real Estate Brokerage';
$page_description = 'Learn about SMB Real Estate Brokers L.L.C — a Dubai-based brokerage established in 2021, helping clients buy, sell, manage and invest in residential and commercial properties with honest, client-first guidance.';
$page_og_title = 'About SMB Real Estate Brokers — Serving, Managing & Beyond';
$page_og_description = 'A Dubai-based brokerage built on transparency, market knowledge and long-term client relationships.';
$page_og_image = 'assets/images/projects/the-acres-estates/webp/01-exterior.webp';
$current_page = 'about';
$skip_link = '#intro';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
];

require __DIR__ . '/../includes/header.php';
?>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/projects/the-acres-estates/webp/01-exterior.webp"
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
          <h1 id="hero-title">Serving, Managing &amp;&nbsp;Beyond</h1>
          <p class="hero__description">
            SMB is a UAE real estate advisory built around a simple principle: the right investment decision matters more than the quickest transaction.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Company introduction ============ -->
    <section class="intro section" id="intro" aria-labelledby="intro-title">
      <div class="container split split--media-right">
        <div class="split__text" data-reveal>
          <p class="eyebrow">Who We Are</p>
          <h2 id="intro-title">Advice with your interests at its centre</h2>
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
          <ul class="intro-facts" aria-label="Company facts">
            <li>Established 2021</li>
            <li>Serving all seven emirates</li>
            <li>Residential &amp; Commercial</li>
            <li>Off-Plan Advisory</li>
          </ul>
        </div>
        <div class="split__media" data-reveal>
          <img src="assets/images/projects/everly-place/webp/05-living-room.webp"
               alt="Bright open-plan living space representing the properties SMB works with"
               loading="lazy" width="900" height="1200">
        </div>
      </div>
    </section>

    <!-- ============ Team ============ -->
    <section class="team section" aria-labelledby="team-title">
      <div class="container">
        <div class="team__grid">
          <div class="section-head" data-reveal>
            <p class="eyebrow">Our Team</p>
            <h2 id="team-title">The people behind SMB</h2>
            <p class="section-head__sub">
              Experienced advisers, direct access and personal accountability from the first meeting onwards.
            </p>
          </div>
          <article class="team-card" data-reveal>
            <div class="team-card__media">
              <img src="assets/images/HAITHAM.jpeg"
                   alt="Portrait of Haitham Mahdy, Managing Director at SMB Real Estate Brokers"
                   loading="lazy" width="960" height="1200">
            </div>
            <div class="team-card__body">
              <h3 class="team-card__name">Haitham Mahdy</h3>
              <p class="team-card__role">Managing Director</p>
              <p class="team-card__bio">
                With over 15 years of experience in sales, leadership, and real estate, Haitham Mahdy has built a career centered on delivering exceptional client experiences and sustainable investment opportunities. As Managing Director of SMB Real Estate Brokers, he leads the company with a client-first philosophy, combining strategic market insight, strong negotiation skills, and a commitment to transparency. His extensive industry knowledge enables clients to make confident decisions while receiving professional guidance at every stage of their real estate journey.
              </p>
            </div>
          </article>
          <article class="team-card" data-reveal>
            <div class="team-card__media">
              <img src="assets/images/Sadam.jpeg"
                   alt="Portrait of Saddam Barakat, Managing Director at SMB Real Estate Brokers"
                   loading="lazy" width="960" height="1200">
            </div>
            <div class="team-card__body">
              <h3 class="team-card__name">Saddam Barakat</h3>
              <p class="team-card__role">Managing Director</p>
              <p class="team-card__bio">
                Saddam Barakat is an experienced real estate professional with nearly two decades of expertise in property investment, sales, and client advisory. At SMB Real Estate Brokers, he focuses on helping buyers and investors identify opportunities that align with their financial goals and long-term vision. Known for his analytical approach, market knowledge, and dedication to personalized service, Saddam is committed to building lasting relationships based on trust, integrity, and consistent results.
              </p>
            </div>
          </article>
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
            <h3>Clarity before commitment</h3>
            <p>
              To give clients the context, judgement and personal attention required to make sound property decisions.
            </p>
          </div>
          <div class="mv-block" data-reveal>
            <p class="eyebrow">Vision</p>
            <h3>A relationship built for the long term</h3>
            <p>
              To build lasting client relationships by placing sound advice ahead of short-term transactions across the UAE.
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
            <p>We follow communities, developers and values across the Emirates, so our advice reflects current market conditions.</p>
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
          <h2 id="choose-title">What client-first advice looks like</h2>
          <p>
            Our principles are visible in the work: candid recommendations, selective shortlists and careful attention to the details that affect your outcome.
          </p>
          <a class="btn btn--primary" href="#enquire">Meet Our Advisers</a>
        </div>
        <ol class="choose__list">
          <li data-reveal>
            <div>
              <h3>Honest, clear property guidance</h3>
              <p>A candid view of pricing, terms and compromises before any commitment is made.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Access to selected opportunities</h3>
              <p>A disciplined selection shaped by your brief, rather than a stream of whatever happens to be available.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Support from enquiry to transaction</h3>
              <p>Close management of viewings, negotiation, paperwork and coordination from one accountable contact.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Knowledge of communities and developers</h3>
              <p>A practical understanding of UAE locations and developer track records gives each recommendation proper context.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Responsive, personal communication</h3>
              <p>You deal with an adviser who knows the brief, remembers the detail and remains accessible.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <!-- ============ How we work ============ -->
    <section class="steps section section--gray" aria-labelledby="steps-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">How We Work</p>
          <h2 id="steps-title">Deliberate from the outset</h2>
        </div>
        <ol class="steps__grid">
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">1</span>
            <h3>Understand</h3>
            <p>The brief begins with your priorities, budget and timeline.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">2</span>
            <h3>Advise</h3>
            <p>Market context and realistic values reveal where the strongest fit lies.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">3</span>
            <h3>Shortlist</h3>
            <p>Only a focused set of credible options earns your time and attention.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">4</span>
            <h3>Support</h3>
            <p>From offer to handover, the process remains closely managed; the relationship continues afterwards.</p>
          </li>
        </ol>
      </div>
    </section>

    <!-- ============ Company commitment ============ -->
    <section class="commitment section" aria-labelledby="commitment-title">
      <div class="container split">
        <div class="split__media" data-reveal>
          <img src="assets/images/projects/fahid-island/webp/03-pool.webp"
               alt="Resort-style pool surrounded by palm trees, representing the Dubai lifestyle SMB clients invest in"
               loading="lazy" width="900" height="1200">
        </div>
        <div class="split__text" data-reveal>
          <p class="eyebrow">Our Commitment</p>
          <h2 id="commitment-title">Relationships that outlast transactions</h2>
          <div class="commitment__rule" aria-hidden="true"></div>
          <p>
            The quality of our work is often clearest after the deal closes: in the decisions that still feel sound, the questions that still receive an answer and the relationships that endure. Client interests come before a quick commission.
          </p>
          <p>
            That is why clients return&mdash;and why they refer people whose interests matter to them.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Let good advice shape the next move</h2>
        <p class="cta-final__sub" data-reveal>
          Whether the next move is a home, a sale or a portfolio decision, begin with a considered conversation.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="tel:+971504217299">
            <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
            Meet Our Advisers
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
