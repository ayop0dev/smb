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
$breadcrumb_trail = [
    ['label' => 'About'],
];

require __DIR__ . '/../includes/header.php';
?>

  <main id="top" data-neutral-sequence>

    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/projects/the-acres-estates/webp/01-exterior.webp"
           alt="Contemporary Villa With Floor-To-Ceiling Glazing At Dusk In Dubai"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <?php require __DIR__ . '/../template-parts/breadcrumb.php'; ?>
          <h1 id="hero-title">Serving, Managing &amp;&nbsp;Beyond</h1>
          <p class="hero__description">
            The People, Principles And Everyday Practice Behind SMB Real Estate Brokers.
          </p>
        </div>
      </div>
    </section>

    <section class="intro section" id="intro" aria-labelledby="intro-title" data-neutral-section>
      <div class="container split split--media-right">
        <div class="split__text" data-reveal>
          <p class="eyebrow">Who We Are</p>
          <h2 id="intro-title">Advice With Your Interests At Its Centre</h2>
          <p>
            SMB Is A UAE Real Estate Advisory Built Around A Simple Principle: The Right Investment Decision Matters More Than The Quickest Transaction.
          </p>
          <p>
            We Don't Just Help You Buy A Property—We Stand By Your Side Every Step Of The Journey. From Negotiating With Leading Developers On Your Behalf And Guiding You Through The Entire Purchasing Process To Assisting With Mortgage Financing Upon Handover, Our Team Ensures A Seamless Experience.
          </p>
          <p>
            Our Commitment Doesn't End Once You Own The Property. We Can Help You Resell It At The Right Time, Lease It To Qualified Tenants, And Maximize Its Long-Term Value.
          </p>
          <p>
            At SMB, We Don't Simply Sell Real Estate—We Create A Complete Investment Ecosystem Designed To Protect Your Investment And Help You Achieve The Highest Possible Return With Confidence.
          </p>
        </div>
        <div class="split__media" data-reveal>
          <img src="assets/images/projects/everly-place/webp/05-living-room.webp"
               alt="Bright Open-Plan Living Space Representing The Properties SMB Works With"
               loading="lazy" width="900" height="1200">
        </div>
      </div>
    </section>

    <section class="company-facts" aria-labelledby="company-facts-title" data-neutral-section>
      <div class="container">
        <h2 class="visually-hidden" id="company-facts-title">Company Facts</h2>
        <ul class="company-facts__row">
          <li class="company-facts__item" data-reveal>
            <span class="company-facts__icon" aria-hidden="true"><svg class="icon"><use href="#i-calendar"/></svg></span>
            <p class="company-facts__label">Established 2021</p>
          </li>
          <li class="company-facts__item" data-reveal>
            <span class="company-facts__icon" aria-hidden="true"><svg class="icon"><use href="#i-pin"/></svg></span>
            <p class="company-facts__label">Serving All Seven Emirates</p>
          </li>
          <li class="company-facts__item" data-reveal>
            <span class="company-facts__icon" aria-hidden="true"><svg class="icon"><use href="#i-building"/></svg></span>
            <p class="company-facts__label">Residential &amp; Commercial</p>
          </li>
          <li class="company-facts__item" data-reveal>
            <span class="company-facts__icon" aria-hidden="true"><svg class="icon"><use href="#i-plan"/></svg></span>
            <p class="company-facts__label">Off-Plan Advisory</p>
          </li>
        </ul>
      </div>
    </section>

    <section class="team section" aria-labelledby="team-title" data-neutral-section>
      <div class="container">
        <div class="team__grid">
          <div class="section-head" data-reveal>
            <p class="eyebrow">Our Team</p>
            <h2 id="team-title">The People Behind SMB</h2>
            <p class="section-head__sub">
              Experienced Advisers, Direct Access And Personal Accountability From The First Meeting Onwards.
            </p>
          </div>
          <article class="team-card" data-reveal>
            <div class="team-card__media">
              <img src="assets/images/HAITHAM.jpeg"
                   alt="Portrait Of Haitham Mahdy, Managing Director At SMB Real Estate Brokers"
                   loading="lazy" width="960" height="1200">
            </div>
            <div class="team-card__body">
              <h3 class="team-card__name">Haitham Mahdy</h3>
              <p class="team-card__role">Managing Director</p>
              <p class="team-card__bio">
                With Over 15 Years Of Experience In Sales, Leadership, And Real Estate, Haitham Mahdy Has Built A Career Centered On Delivering Exceptional Client Experiences And Sustainable Investment Opportunities. As Managing Director Of SMB Real Estate Brokers, He Leads The Company With A Client-First Philosophy, Combining Strategic Market Insight, Strong Negotiation Skills, And A Commitment To Transparency. His Extensive Industry Knowledge Enables Clients To Make Confident Decisions While Receiving Professional Guidance At Every Stage Of Their Real Estate Journey.
              </p>
            </div>
          </article>
          <article class="team-card" data-reveal>
            <div class="team-card__media">
              <img src="assets/images/Sadam.jpeg"
                   alt="Portrait Of Saddam Barakat, Managing Director At SMB Real Estate Brokers"
                   loading="lazy" width="960" height="1200">
            </div>
            <div class="team-card__body">
              <h3 class="team-card__name">Saddam Barakat</h3>
              <p class="team-card__role">Managing Director</p>
              <p class="team-card__bio">
                Saddam Barakat Is An Experienced Real Estate Professional With Nearly Two Decades Of Expertise In Property Investment, Sales, And Client Advisory. At SMB Real Estate Brokers, He Focuses On Helping Buyers And Investors Identify Opportunities That Align With Their Financial Goals And Long-Term Vision. Known For His Analytical Approach, Market Knowledge, And Dedication To Personalized Service, Saddam Is Committed To Building Lasting Relationships Based On Trust, Integrity, And Consistent Results.
              </p>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="mv section" aria-labelledby="mv-title" data-neutral-section>
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Our Direction</p>
          <h2 id="mv-title">What Guides Our Work</h2>
        </div>
        <div class="direction-panel" data-reveal>
          <div class="direction-panel__block direction-panel__block--mission">
            <span class="direction-panel__accent" aria-hidden="true"></span>
            <p class="eyebrow">Mission</p>
            <h3>Clarity Before Commitment</h3>
            <p>
              To Give Clients The Context, Judgement And Personal Attention Required To Make Sound Property Decisions.
            </p>
          </div>
          <div class="direction-panel__block direction-panel__block--vision">
            <span class="direction-panel__accent" aria-hidden="true"></span>
            <p class="eyebrow">Vision</p>
            <h3>A Relationship Built For The Long Term</h3>
            <p>
              To Build Lasting Client Relationships By Placing Sound Advice Ahead Of Short-Term Transactions Across The UAE.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="values section" aria-labelledby="values-title" data-neutral-section>
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Our Values</p>
          <h2 id="values-title">How We Work With Every Client</h2>
        </div>
        <ol class="steps__grid">
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">1</span>
            <h3>Transparency</h3>
            <p>We Share What We Know — Prices, Risks And Realistic Timelines — So Nothing Important Is Left Unsaid.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">2</span>
            <h3>Client Commitment</h3>
            <p>Every Recommendation Starts From The Client's Goals, Not From What Is Easiest To Sell.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">3</span>
            <h3>Market Knowledge</h3>
            <p>We Follow Communities, Developers And Values Across The Emirates, So Our Advice Reflects Current Market Conditions.</p>
          </li>
          <li class="step" data-reveal>
            <span class="step__num" aria-hidden="true">4</span>
            <h3>Professional Support</h3>
            <p>One Dedicated Point Of Contact Represents You Professionally Through Paperwork, Negotiation And Handover.</p>
          </li>
        </ol>
      </div>
    </section>

    <section class="choose section" aria-labelledby="choose-title" data-neutral-section>
      <div class="container choose__grid">
        <div class="choose__intro" data-reveal>
          <p class="eyebrow">Why Clients Choose SMB</p>
          <h2 id="choose-title">What Client-First Advice Looks Like</h2>
          <p>
            Our Principles Are Visible In The Work: Candid Recommendations, Selective Shortlists And Careful Attention To The Details That Affect Your Outcome.
          </p>
          <a class="btn btn--primary" href="#enquire">Meet Our Advisers</a>
        </div>
        <ol class="choose__list">
          <li data-reveal>
            <div>
              <h3>Honest, Clear Property Guidance</h3>
              <p>A Candid View Of Pricing, Terms And Compromises Before Any Commitment Is Made.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Access To Selected Opportunities</h3>
              <p>A Disciplined Selection Shaped By Your Brief, Rather Than A Stream Of Whatever Happens To Be Available.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Support From Enquiry To Transaction</h3>
              <p>Close Management Of Viewings, Negotiation, Paperwork And Coordination From One Accountable Contact.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Knowledge Of Communities And Developers</h3>
              <p>A Practical Understanding Of UAE Locations And Developer Track Records Gives Each Recommendation Proper Context.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Responsive, Personal Communication</h3>
              <p>You Deal With An Adviser Who Knows The Brief, Remembers The Detail And Remains Accessible.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get In Touch</p>
        <h2 id="cta-title" data-reveal>Let Good Advice Shape The Next Move</h2>
        <p class="cta-final__sub" data-reveal>
          Whether The Next Move Is A Home, A Sale Or A Portfolio Decision, Begin With A Considered Conversation.
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
          Prefer Email? Write To <a href="mailto:info@smbdubai.net">info@smbdubai.net</a>
        </p>
      </div>
    </section>
  </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
