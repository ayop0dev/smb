<?php
$page_title = 'Contact Us — SMB Real Estate Brokers L.L.C | Business Bay, Dubai';
$page_description = 'Contact SMB Real Estate Brokers L.L.C in Business Bay, Dubai. Call, WhatsApp or send an enquiry about buying, selling, managing or investing in Dubai property.';
$page_og_title = 'Contact SMB Real Estate Brokers — Dubai';
$page_og_description = 'Call, WhatsApp or send an enquiry — property guidance for buyers, sellers and investors in Dubai.';
$page_og_image = 'assets/images/projects/bay-grove-residences/webp/01-exterior.webp';
$current_page = 'contact';
$skip_link = '#methods';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/contact.css',
];
$breadcrumb_trail = [
    ['label' => 'Contact'],
];

require __DIR__ . '/../includes/header.php';
?>

  <main id="top" data-neutral-sequence>

    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/projects/bay-grove-residences/webp/01-exterior.webp"
           alt="Modern Luxury Villa With A Private Pool Under A Clear Sky In Dubai"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <?php require __DIR__ . '/../template-parts/breadcrumb.php'; ?>
          <h1 id="hero-title">A Considered Decision Starts Here</h1>
          <p class="hero__description">
            Speak With An Adviser About Buying, Selling, Managing Or Investing In Property Anywhere In The UAE.
          </p>
        </div>
      </div>
    </section>

    <section class="methods section" id="methods" aria-labelledby="methods-title" data-neutral-section>
      <div class="container">
        <h2 class="visually-hidden" id="methods-title">Ways To Contact Us</h2>
        <div class="methods__grid">
          <a class="method-card" href="tel:+971504217299" data-reveal>
            <span class="method-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg></span>
            <span>
              <span class="method-card__label">Call Us</span>
              <span class="method-card__value">+971 50 421 7299</span>
            </span>
          </a>
          <a class="method-card" href="https://wa.me/971504217299" target="_blank" rel="noopener" data-reveal>
            <span class="method-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg></span>
            <span>
              <span class="method-card__label">WhatsApp</span>
              <span class="method-card__value">Message Us Directly</span>
            </span>
          </a>
          <a class="method-card" href="mailto:info@smbdubai.net" data-reveal>
            <span class="method-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-mail"/></svg></span>
            <span>
              <span class="method-card__label">Email</span>
              <span class="method-card__value">info@smbdubai.net</span>
            </span>
          </a>
        </div>
      </div>
    </section>

    <section class="enquire section" id="enquire" aria-labelledby="enquire-title" data-neutral-section>
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Request A Consultation</p>
          <h2 id="enquire-title">Tell Us What You Are Considering</h2>
          <p class="section-head__sub">
            A Few Details Are Enough To Begin. An Adviser Will Respond With A Relevant And Considered Next Step.
          </p>
        </div>
        <div class="contact-layout">
          <div data-reveal>
            <form class="lead-form lead-form--card" id="main-form" novalidate>
              <div class="field">
                <label for="cf-name">Full Name</label>
                <input type="text" id="cf-name" name="name" autocomplete="name" placeholder="Your Full Name" required aria-describedby="cf-name-error">
                <p class="field__error" id="cf-name-error" aria-live="polite"></p>
              </div>
              <div class="field">
                <label for="cf-phone">Phone Number</label>
                <input type="tel" id="cf-phone" name="phone" autocomplete="tel" placeholder="+971 50 000 0000" required aria-describedby="cf-phone-error">
                <p class="field__error" id="cf-phone-error" aria-live="polite"></p>
              </div>
              <div class="field">
                <label for="cf-email">Email Address</label>
                <input type="email" id="cf-email" name="email" autocomplete="email" placeholder="name@example.com" required aria-describedby="cf-email-error">
                <p class="field__error" id="cf-email-error" aria-live="polite"></p>
              </div>
              <fieldset class="field" aria-describedby="cf-enquiry-error">
                <legend>Enquiry Type</legend>
                <div class="pill-group">
                  <input type="radio" id="et-buying" name="enquiry" value="Buying Property">
                  <label for="et-buying">Buying Property</label>
                  <input type="radio" id="et-selling" name="enquiry" value="Selling Property">
                  <label for="et-selling">Selling Property</label>
                  <input type="radio" id="et-investment" name="enquiry" value="Property Investment">
                  <label for="et-investment">Property Investment</label>
                  <input type="radio" id="et-management" name="enquiry" value="Property Management">
                  <label for="et-management">Property Management</label>
                  <input type="radio" id="et-general" name="enquiry" value="General Enquiry" checked>
                  <label for="et-general">General Enquiry</label>
                </div>
                <p class="field__error" id="cf-enquiry-error" aria-live="polite"></p>
              </fieldset>
              <div class="field">
                <label for="cf-message">Message</label>
                <textarea id="cf-message" name="message" rows="4" placeholder="Tell Us What You Are Looking For" required aria-describedby="cf-message-error"></textarea>
                <p class="field__error" id="cf-message-error" aria-live="polite"></p>
              </div>
              <button type="submit" class="btn btn--accent btn--block btn--lg">Send Enquiry</button>
              <p class="lead-form__privacy">Our Team Will Contact You To Understand Your Needs And Agree The Next Step.</p>
            </form>
            <div class="lead-form__success lead-form__success--card" hidden>
              <p class="lead-form__success-title">Backend Integration In Progress</p>
              <p>Thank You For Your Interest. The Enquiry System Is Currently Being Connected To The Backend. Form Submission Will Become Available In The Upcoming WordPress Version.</p>
            </div>
          </div>

          <aside class="office-card" data-reveal aria-labelledby="office-title">
            <h3 id="office-title">Office Information</h3>
            <ul class="office-card__list">
              <li>
                <svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg>
                <div>
                  <p class="office-card__label">Address</p>
                  <p class="office-card__value">3002 Westburry Tower Office,<br>Business Bay, Dubai, UAE</p>
                </div>
              </li>
              <li>
                <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
                <div>
                  <p class="office-card__label">Phone</p>
                  <p class="office-card__value"><a href="tel:+971504217299">+971 50 421 7299</a></p>
                </div>
              </li>
              <li>
                <svg class="icon" aria-hidden="true"><use href="#i-mail"/></svg>
                <div>
                  <p class="office-card__label">Email</p>
                  <p class="office-card__value"><a href="mailto:info@smbdubai.net">info@smbdubai.net</a></p>
                </div>
              </li>
              <li>
                <svg class="icon" aria-hidden="true"><use href="#i-clock"/></svg>
                <div>
                  <p class="office-card__label">Working Hours</p>
                  <p class="office-card__value">10 AM &ndash; 5 PM</p>
                </div>
              </li>
            </ul>
            <p class="office-card__note">
              Enquiries Are Handled By Our Team During Business Hours, And We Aim To
              Respond To Every Message As Soon As Possible.
            </p>
          </aside>
        </div>
      </div>
    </section>

    <section class="visit section" aria-labelledby="visit-title" data-neutral-section>
      <div class="container visit__inner">
        <p class="eyebrow" data-reveal>Prefer To Talk?</p>
        <h2 id="visit-title" data-reveal>A Direct Conversation, In Person Or By Phone</h2>
        <p data-reveal>
          Call, Message Or Arrange A Meeting At Our Business Bay Office. The Conversation Starts With Your Plans&mdash;Not With A Project Presentation.
        </p>
        <div class="visit__buttons" data-reveal>
          <a class="btn btn--primary btn--lg" href="tel:+971504217299">
            <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
            Speak With An Adviser
          </a>
          <a class="btn btn--accent btn--lg" href="https://wa.me/971504217299" target="_blank" rel="noopener">
            <svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg>
            WhatsApp Us
          </a>
        </div>
      </div>
    </section>

    <section class="cta-final section" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/projects/fahid-island/webp/02-aerial-view.webp" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>One Step Away</p>
        <h2 id="cta-title" data-reveal>Ready For A Clearer Next Step?</h2>
        <p class="cta-final__sub" data-reveal>
          Send An Enquiry And Receive Advice Shaped Around Your Interests From The Outset.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="#enquire">Request A Consultation</a>
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
