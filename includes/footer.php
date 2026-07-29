<?php
/**
 * Global site footer — shared by every page.
 * The sticky CTA text can be overridden per page (see damac-islands2.php).
 */
$sticky_href = $sticky_href ?? '#enquire';
$sticky_label = $sticky_label ?? 'UAE Property Advisory';
$sticky_value = $sticky_value ?? 'Start A Conversation';
$sticky_action = $sticky_action ?? 'Contact Us';
?>

  <footer class="footer">
    <div class="container footer__grid">
      <div class="footer__brand">
        <img src="assets/images/smb-logo-horizontal.png" alt="SMB Real Estate Brokers — Serving, Managing &amp; Beyond" width="97" height="56" loading="lazy">
        <p class="footer__tagline">Serving, Managing &amp; Beyond</p>
        <p class="footer__about">
          SMB Real Estate Brokers L.L.C Is A UAE Property Advisory For Residential And Commercial Clients, Known For Independent Judgement, Attentive Execution And Relationships That Continue Beyond Completion.
        </p>
      </div>
      <div class="footer__col">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="developers.php">Developers</a></li>
          <li><a href="communities.php">Communities</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h3>Contact</h3>
        <address>
          <ul>
            <li><a href="tel:+971504217299">+971 50 421 7299</a></li>
            <li><a href="mailto:info@smbdubai.net">info@smbdubai.net</a></li>
            <li>3002 Westburry Tower Office,<br>Business Bay, Dubai, UAE</li>
          </ul>
        </address>
      </div>
    </div>
    <div class="container footer__bottom">
      <p>&copy; <span id="year">2026</span> SMB Real Estate Brokers L.L.C. All Rights Reserved.</p>
      <p class="footer__disclaimer">
        Prices, Availability And Handover Dates Are Indicative And Subject To Change By The Developer.
      </p>
    </div>
  </footer>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "RealEstateAgent",
    "name": "SMB Real Estate Brokers L.L.C",
    "description": "SMB Real Estate Brokers L.L.C is a UAE property advisory for residential and commercial clients, known for independent judgement, attentive execution and relationships that continue beyond completion.",
    "url": "<?= smb_e($site_url) ?>/",
    "logo": "<?= smb_e($site_url) ?>/assets/images/smb-logo-horizontal.png",
    "image": "<?= smb_e($site_url) ?>/assets/images/smb-logo-horizontal.png",
    "telephone": "+971504217299",
    "email": "info@smbdubai.net",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "3002 Westburry Tower Office, Business Bay",
      "addressLocality": "Dubai",
      "addressCountry": "AE"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+971504217299",
      "email": "info@smbdubai.net",
      "contactType": "customer service",
      "areaServed": "AE",
      "availableLanguage": "English"
    }
  }
  </script>

  <a class="sticky-cta" id="sticky-cta" href="<?= smb_e($sticky_href) ?>" aria-hidden="true" tabindex="-1">
    <span class="sticky-cta__text">
      <span class="sticky-cta__label"><?= smb_e($sticky_label) ?></span>
      <span class="sticky-cta__price"><?= smb_e($sticky_value) ?></span>
    </span>
    <span class="sticky-cta__action">
      <?= smb_e($sticky_action) ?>
      <svg class="icon icon--sm" aria-hidden="true"><use href="#i-arrow"/></svg>
    </span>
  </a>

  <script src="assets/js/main.js"></script>
</body>
</html>
