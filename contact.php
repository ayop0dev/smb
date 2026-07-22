<?php
$page_title = 'Contact Us — SMB Real Estate Brokers L.L.C | Business Bay, Dubai';
$page_description = 'Contact SMB Real Estate Brokers L.L.C in Business Bay, Dubai. Call, WhatsApp or send an enquiry about buying, selling, managing or investing in Dubai property.';
$page_og_title = 'Contact SMB Real Estate Brokers — Dubai';
$page_og_description = 'Call, WhatsApp or send an enquiry — property guidance for buyers, sellers and investors in Dubai.';
$page_og_image = 'assets/images/hero-villa-pool.jpg';
$current_page = 'contact';
$skip_link = '#methods';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/contact.css',
];

require __DIR__ . '/header.php';
?>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/hero-villa-pool.jpg"
           alt="Modern luxury villa with a private pool under a clear sky in Dubai"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="index.php">Home</a></li>
              <li><span aria-current="page">Contact</span></li>
            </ol>
          </nav>
          <h1 id="hero-title">Let's discuss your property&nbsp;goals</h1>
          <p class="hero__description">
            Contact SMB Real Estate Brokers for property enquiries, buying, selling,
            managing or investment support in Dubai.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Contact overview ============ -->
    <section class="methods section" id="methods" aria-labelledby="methods-title">
      <div class="container">
        <h2 class="visually-hidden" id="methods-title">Ways to contact us</h2>
        <div class="methods__grid">
          <a class="method-card" href="tel:+971504217299" data-reveal>
            <span class="method-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg></span>
            <span>
              <span class="method-card__label">Call us</span>
              <span class="method-card__value">+971 50 421 7299</span>
            </span>
          </a>
          <a class="method-card" href="https://wa.me/971504217299" target="_blank" rel="noopener" data-reveal>
            <span class="method-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg></span>
            <span>
              <span class="method-card__label">WhatsApp</span>
              <span class="method-card__value">Message us directly</span>
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

    <!-- ============ Contact form + office information ============ -->
    <section class="enquire section section--gray" id="enquire" aria-labelledby="enquire-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Send an Enquiry</p>
          <h2 id="enquire-title">Tell us how we can help</h2>
          <p class="section-head__sub">
            Fill out the form and a property consultant will get back to you shortly.
          </p>
        </div>
        <div class="contact-layout">
          <div data-reveal>
            <form class="lead-form lead-form--card" id="main-form" novalidate>
              <div class="field">
                <label for="cf-name">Full Name</label>
                <input type="text" id="cf-name" name="name" autocomplete="name" placeholder="Your full name" required aria-describedby="cf-name-error">
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
                <textarea id="cf-message" name="message" rows="4" placeholder="Tell us what you are looking for" required aria-describedby="cf-message-error"></textarea>
                <p class="field__error" id="cf-message-error" aria-live="polite"></p>
              </div>
              <button type="submit" class="btn btn--accent btn--block btn--lg">Send Enquiry</button>
              <p class="lead-form__privacy">Our team will contact you shortly.</p>
            </form>
            <div class="lead-form__success lead-form__success--card" hidden>
              <p class="lead-form__success-title">Thank you</p>
              <p>Your enquiry has been received. A property consultant from SMB Real Estate Brokers will contact you shortly.</p>
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
                  <p class="office-card__value">To be confirmed</p>
                  <span class="office-card__temp">Temporary — final schedule to be provided.</span>
                </div>
              </li>
            </ul>
            <p class="office-card__note">
              Enquiries are handled by our team during business hours, and we aim to
              respond to every message as soon as possible.
            </p>
          </aside>
        </div>
      </div>
    </section>

    <!-- ============ Map ============ -->
    <section class="map section" aria-labelledby="map-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Find Us</p>
          <h2 id="map-title">Business Bay, Dubai</h2>
        </div>
        <div class="map__frame" data-reveal>
          <svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg>
          <p class="map__placeholder-title">Map placeholder</p>
          <p class="map__placeholder-text">
            An interactive map will be embedded here once the verified office location
            pin is available. In the meantime, open the address directly in Google Maps.
          </p>
          <a class="btn btn--primary" href="https://www.google.com/maps/search/?api=1&amp;query=Westburry+Tower+Business+Bay+Dubai" target="_blank" rel="noopener">
            Open in Google Maps
          </a>
        </div>
      </div>
    </section>

    <!-- ============ Visit or speak with us ============ -->
    <section class="visit section section--gray" aria-labelledby="visit-title">
      <div class="container visit__inner">
        <p class="eyebrow" data-reveal>Prefer to Talk?</p>
        <h2 id="visit-title" data-reveal>Speak with a consultant or visit our office</h2>
        <p data-reveal>
          Some conversations are easier in person or over the phone. Call us or send a
          WhatsApp message to arrange a time that suits you.
        </p>
        <div class="visit__buttons" data-reveal>
          <a class="btn btn--primary btn--lg" href="tel:+971504217299">
            <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
            Call +971 50 421 7299
          </a>
          <a class="btn btn--accent btn--lg" href="https://wa.me/971504217299" target="_blank" rel="noopener">
            <svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg>
            WhatsApp Us
          </a>
        </div>
      </div>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/hero-lagoon-aerial.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>One Step Away</p>
        <h2 id="cta-title" data-reveal>Ready to make your next property move?</h2>
        <p class="cta-final__sub" data-reveal>
          Send us an enquiry and start the conversation — honest guidance from the
          first message.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="#enquire">Send an Enquiry</a>
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
