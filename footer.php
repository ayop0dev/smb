<?php
/**
 * Global site footer — shared by every page.
 * The sticky CTA text can be overridden per page (see damac-islands2.php).
 */
$sticky_href = $sticky_href ?? '#enquire';
$sticky_label = $sticky_label ?? 'Buy · Sell · Invest';
$sticky_value = $sticky_value ?? 'Talk to an expert';
$sticky_action = $sticky_action ?? 'Contact us';
?>

  <!-- ============ Footer ============ -->
  <footer class="footer">
    <div class="container footer__grid">
      <div class="footer__brand">
        <img src="assets/images/smb-logo-horizontal.png" alt="SMB Real Estate Brokers logo" width="97" height="56" loading="lazy">
        <p class="footer__tagline">Serving, Managing &amp; Beyond</p>
        <p class="footer__about">
          SMB Real Estate Brokers L.L.C is a Dubai-based brokerage assisting clients with
          selling, managing and investing in residential and commercial properties.
        </p>
        <div class="footer__social">
          <a href="#" aria-label="SMB Real Estate Brokers on Instagram"><svg class="icon" aria-hidden="true"><use href="#i-instagram"/></svg></a>
          <a href="#" aria-label="SMB Real Estate Brokers on LinkedIn"><svg class="icon" aria-hidden="true"><use href="#i-linkedin"/></svg></a>
          <a href="#" aria-label="SMB Real Estate Brokers on Facebook"><svg class="icon" aria-hidden="true"><use href="#i-facebook"/></svg></a>
        </div>
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
        <ul>
          <li><a href="tel:+971504217299">+971 50 421 7299</a></li>
          <li><a href="mailto:info@smbdubai.net">info@smbdubai.net</a></li>
          <li>3002 Westburry Tower Office,<br>Business Bay, Dubai, UAE</li>
        </ul>
      </div>
    </div>
    <div class="container footer__bottom">
      <p>&copy; <span id="year">2026</span> SMB Real Estate Brokers L.L.C. All rights reserved.</p>
      <p class="footer__disclaimer">
        Prices, availability and handover dates are indicative and subject to change by the developer.
      </p>
    </div>
  </footer>

  <!-- ============ Sticky CTA ============ -->
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
