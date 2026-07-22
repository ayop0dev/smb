<?php
/**
 * Shared project-page template.
 *
 * Renders any project from data/projects.json using the DAMAC Islands 2 page
 * (damac-islands2.php) as the structural, visual, and accessibility reference.
 * Individual project pages set $project_slug and require this file — all
 * markup, fallback/placeholder behavior, and template-level copy lives here
 * so no project page duplicates the template.
 */
declare(strict_types=1);

require __DIR__ . '/includes/project-data.php';

/* ---------- Resolve the project or fail with a controlled 404 ---------- */
$project_slug = trim((string) ($project_slug ?? ''));
$project = $project_slug === '' ? null : get_project_by_slug($project_slug);

if ($project === null) {
    http_response_code(404);
    $page_title = 'Project Not Found — SMB Real Estate Brokers';
    $page_description = 'The project you are looking for could not be found.';
    $current_page = '';
    $skip_link = '#not-found';
    require __DIR__ . '/header.php';
    ?>
      <main id="top">
        <section class="section" id="not-found" aria-labelledby="not-found-title">
          <div class="container" style="text-align:center; max-width:640px;">
            <p class="eyebrow">Project Not Found</p>
            <h1 id="not-found-title">We couldn't find that project</h1>
            <p style="margin: 0 auto 32px; max-width: 60ch;">
              The project page you're looking for may have been renamed or is no longer
              available. Explore our current developments or get in touch with our team.
            </p>
            <div class="hero__cta" style="justify-content:center;">
              <a class="btn btn--primary" href="communities.php">Browse Communities</a>
              <a class="btn btn--ghost" href="contact.php">Contact Us</a>
            </div>
          </div>
        </section>
      </main>
    <?php
    require __DIR__ . '/footer.php';
    exit;
}

/* ---------- Icon mapping: dataset icon identifiers -> SVG symbol IDs ---------- */
function project_icon_symbol(string $icon): string
{
    static $map = [
        'deed'     => '#i-deed',
        'home'     => '#i-home',
        'calendar' => '#i-calendar',
        'expand'   => '#i-expand',
        'bed'      => '#i-bed',
        'plan'     => '#i-plan',
        'sparkles' => '#i-sparkles',
        'waves'    => '#i-waves',
        'dumbbell' => '#i-dumbbell',
        'heart'    => '#i-heart',
        'users'    => '#i-users',
        'balloon'  => '#i-balloon',
        'bag'      => '#i-bag',
        'leaf'     => '#i-leaf',
        'shield'   => '#i-shield',
        'building' => '#i-building',
        'anchor'   => '#i-anchor',
        'plane'    => '#i-plane',
        'clock'    => '#i-clock',
        'pin'      => '#i-pin',
        /* 'info' has no dedicated symbol — the existing generic document/deed
           icon is the neutral stand-in, used for both a declared "info" icon
           and any unrecognized identifier. */
        'info'     => '#i-deed',
    ];

    return $map[$icon] ?? '#i-deed';
}

/* Defense in depth: even though the schema forbids external image URLs,
   never let a raw project-data string reach an <img src> or CSS background
   without being checked here first. */
function project_safe_local_path(string $path, string $fallback): string
{
    $path = trim($path);
    if ($path === '') {
        return $fallback;
    }
    if (preg_match('#^([a-z]+:)?//#i', $path) === 1) {
        return $fallback; // remote / protocol-relative URL
    }
    if (str_contains($path, '..')) {
        return $fallback; // path traversal
    }
    return $path;
}

/* ---------- Centralized local placeholder / fallback image ----------
   Per implementation spec: use assets/images/project-placeholder.jpg only
   if that file already exists. It does not exist yet at implementation
   time, so this falls back to the existing DAMAC hero image — a TEMPORARY
   local implementation fallback to be replaced once real project photography
   is assigned (see PROJECT-PAGES-IMPLEMENTATION.md). */
$project_placeholder_path = 'assets/images/project-placeholder.jpg';
$fallback_image = is_file(__DIR__ . '/' . $project_placeholder_path)
    ? $project_placeholder_path
    : 'assets/images/hero-villa-pool.jpg'; // TEMP fallback (DAMAC hero image) — replace during image-assignment phase

/* ---------- SEO / page metadata ---------- */
$seo = $project['seo'];
$page_title = $seo['page_title'] !== '' ? $seo['page_title'] : ($project['name'] . ' — SMB Real Estate Brokers');
$page_description = $seo['page_description'] !== '' ? $seo['page_description'] : 'Contact SMB Real Estate Brokers for further project information.';
$page_og_title = $seo['og_title'] !== '' ? $seo['og_title'] : $page_title;
$page_og_description = $seo['og_description'] !== '' ? $seo['og_description'] : $page_description;

$hero_image_raw = $project['hero']['image'];
$hero_image = project_safe_local_path($hero_image_raw, $fallback_image);
$hero_image_is_placeholder = trim($hero_image_raw) === '';

$page_og_image = project_safe_local_path($seo['og_image'], $hero_image);

$current_page = '';
$skip_link = '#overview';

/* ---------- Starting price (shared by hero card + sticky CTA) ---------- */
$has_starting_price = trim($project['hero']['starting_price']) !== '';
$price_display = $has_starting_price ? $project['hero']['starting_price'] : 'Available on request';

/* ---------- Sticky CTA (label/action are fixed template copy) ---------- */
$sticky_label = 'Starting from';
$sticky_value = $price_display;
$sticky_action = 'Fill the form';

require __DIR__ . '/header.php';

/* ---------- JSON-LD structured data ---------- */
$sd = $project['structured_data'];
$sd_image_path = project_safe_local_path($sd['image'], $hero_image);
$sd_image_url = $site_url . '/' . ltrim($sd_image_path, '/');

$json_ld = [
    '@context' => 'https://schema.org',
    '@type' => in_array($sd['type'], ['Residence', 'OfficeBuilding'], true) ? $sd['type'] : 'Residence',
    'name' => $sd['name'] !== '' ? $sd['name'] : $project['name'],
    'description' => $sd['description'] !== '' ? $sd['description'] : 'Contact SMB Real Estate Brokers for further project information.',
    'url' => $canonical_url,
    'image' => $sd_image_url,
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => $sd['address_locality'] !== '' ? $sd['address_locality'] : $project['location_label'],
        'addressCountry' => 'AE',
    ],
];

if (is_numeric($sd['price']) && (float) $sd['price'] > 0) {
    $json_ld['offers'] = [
        '@type' => 'Offer',
        'priceCurrency' => $sd['currency'] !== '' ? $sd['currency'] : 'AED',
        'price' => (string) $sd['price'],
        'availability' => 'https://schema.org/InStock',
    ];
}
?>

  <script type="application/ld+json"><?= json_encode($json_ld, JSON_UNESCAPED_SLASHES) ?></script>

  <main id="top">

    <!-- ============ Hero ============ -->
    <?php
      $hero_alt = $hero_image_is_placeholder
          ? 'Placeholder image for ' . $project['name']
          : $project['name'] . (trim($project['hero']['headline']) !== '' ? ' — ' . $project['hero']['headline'] : '');
    ?>
    <section class="hero" aria-labelledby="hero-title">
      <img class="hero__bg" src="<?= smb_e($hero_image) ?>"
           alt="<?= smb_e($hero_alt) ?>"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <p class="eyebrow eyebrow--light">By <?= smb_e($project['developer']) ?> &middot; <?= smb_e($project['location_label']) ?></p>
          <h1 id="hero-title"><?= smb_e($project['name']) ?></h1>
<?php if (trim($project['hero']['headline']) !== ''): ?>
          <p class="hero__headline"><?= smb_e($project['hero']['headline']) ?></p>
<?php endif; ?>
<?php if (trim($project['hero']['description']) !== ''): ?>
          <p class="hero__description"><?= smb_e($project['hero']['description']) ?></p>
<?php else: ?>
          <p class="hero__description">Contact SMB Real Estate Brokers for further project information.</p>
<?php endif; ?>
          <div class="hero__cta">
            <a class="btn btn--accent btn--lg" href="#enquire">Enquire Now</a>
            <a class="btn btn--ghost btn--lg" href="#overview">Explore the Project</a>
          </div>
<?php
          $trust_badges = array_values(array_filter(
              array_map('trim', $project['hero']['trust_badges']),
              static fn (string $b): bool => $b !== ''
          ));
          $trust_badges = array_slice($trust_badges, 0, 3);
?>
<?php if (!empty($trust_badges)): ?>
          <ul class="hero__badges" aria-label="Trust indicators">
<?php foreach ($trust_badges as $badge): ?>
            <li><?= smb_e($badge) ?></li>
<?php endforeach; ?>
          </ul>
<?php endif; ?>
        </div>

        <div class="hero__card" id="hero-form-card">
          <p class="price-label">Starting from</p>
          <p class="price"><?= smb_e($price_display) ?><?php if ($has_starting_price): ?><span class="price__note">*</span><?php endif; ?></p>
          <p class="price-footnote"><?= smb_e($project['hero']['price_note'] !== '' ? $project['hero']['price_note'] : '*Prices are subject to change by the developer.') ?></p>
          <form class="lead-form" id="hero-form" novalidate>
            <div class="field">
              <label for="hf-name">Full Name</label>
              <input type="text" id="hf-name" name="name" autocomplete="name" placeholder="Your full name" required aria-describedby="hf-name-error">
              <p class="field__error" id="hf-name-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="hf-phone">Phone Number</label>
              <input type="tel" id="hf-phone" name="phone" autocomplete="tel" placeholder="+971 50 000 0000" required aria-describedby="hf-phone-error">
              <p class="field__error" id="hf-phone-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="hf-email">Email Address</label>
              <input type="email" id="hf-email" name="email" autocomplete="email" placeholder="name@example.com" required aria-describedby="hf-email-error">
              <p class="field__error" id="hf-email-error" aria-live="polite"></p>
            </div>
            <button type="submit" class="btn btn--accent btn--block">Enquire Now</button>
            <p class="lead-form__privacy">Our team will contact you shortly.</p>
          </form>
          <div class="lead-form__success" hidden>
            <p class="lead-form__success-title">Thank you</p>
            <p>Your enquiry has been received. A property consultant from SMB Real Estate Brokers will contact you shortly.</p>
          </div>
        </div>
      </div>
    </section>

<?php
    /* ---------- Island districts strip (only when the project enables it) ---------- */
    $districts = $project['districts'];
    $district_rows = [];
    if ($districts['enabled'] === true) {
        foreach ($districts['items'] as $item) {
            if (is_string($item)) {
                $name = trim($item);
                $launching = false;
            } elseif (is_array($item)) {
                $name = trim((string) ($item['name'] ?? ''));
                $launching = !empty($item['launching']) || !empty($item['is_launching']);
            } else {
                continue;
            }
            if ($name === '') {
                continue;
            }
            $district_rows[] = ['name' => $name, 'launching' => $launching];
        }
    }
    $show_districts = $districts['enabled'] === true && trim($districts['intro']) !== '' && !empty($district_rows);
?>
<?php if ($show_districts): ?>
    <section class="districts" aria-label="Districts of the master community">
      <div class="container">
        <p class="districts__intro"><?= smb_e($districts['intro']) ?></p>
        <ul class="districts__list">
<?php foreach ($district_rows as $row): ?>
          <li<?= $row['launching'] ? ' class="is-launching"' : '' ?>><?= smb_e($row['name']) ?></li>
<?php endforeach; ?>
        </ul>
<?php if (array_filter($district_rows, static fn ($r) => $r['launching'])): ?>
        <p class="districts__legend"><span class="districts__dot" aria-hidden="true"></span> Now launching</p>
<?php endif; ?>
      </div>
    </section>
<?php endif; ?>

<?php
    /* ---------- Quick facts: always exactly 4 visual positions ---------- */
    $facts = array_slice($project['facts'], 0, 4);
    while (count($facts) < 4) {
        $facts[] = ['value' => '', 'label' => '', 'icon' => 'info'];
    }
?>
    <!-- ============ Quick facts ============ -->
    <section class="facts" aria-labelledby="facts-title">
      <h2 class="visually-hidden" id="facts-title">Key Facts</h2>
      <div class="container">
        <ul class="facts__row">
<?php foreach ($facts as $fact): ?>
          <li class="facts__item" data-reveal>
            <span class="facts__icon"><svg class="icon" aria-hidden="true"><use href="<?= smb_e(project_icon_symbol($fact['icon'] ?? 'info')) ?>"/></svg></span>
            <div>
              <p class="facts__value"><?= smb_e($fact['value'] !== '' ? $fact['value'] : 'Available on request') ?></p>
              <p class="facts__label"><?= smb_e($fact['label'] !== '' ? $fact['label'] : 'Project details') ?></p>
            </div>
          </li>
<?php endforeach; ?>
        </ul>
      </div>
    </section>

<?php
    /* ---------- Project overview: title, 1-2 paragraphs, exactly 3 cards ---------- */
    $overview_title = trim($project['overview']['title']) !== '' ? $project['overview']['title'] : ('Discover ' . $project['name']);
    $overview_paragraphs = array_values(array_filter(
        array_map('trim', $project['overview']['paragraphs']),
        static fn (string $t): bool => $t !== ''
    ));
    if (empty($overview_paragraphs)) {
        $overview_paragraphs = ['Contact SMB Real Estate Brokers for further project information.'];
    }

    $overview_cards = array_slice($project['overview']['cards'], 0, 3);
    while (count($overview_cards) < 3) {
        $overview_cards[] = ['value' => '', 'label' => '', 'icon' => 'info'];
    }
?>
    <!-- ============ Project overview ============ -->
    <section class="overview section section--gray" id="overview" aria-labelledby="overview-title">
      <div class="container overview__grid">
        <div class="overview__text" data-reveal>
          <p class="eyebrow">Project Overview</p>
          <h2 id="overview-title"><?= smb_e($overview_title) ?></h2>
<?php foreach ($overview_paragraphs as $paragraph): ?>
          <p><?= smb_e($paragraph) ?></p>
<?php endforeach; ?>
          <a class="btn btn--primary" href="#enquire">Speak with a Property Consultant</a>
        </div>
        <div class="overview__cards">
<?php foreach ($overview_cards as $card): ?>
          <article class="stat-card" data-reveal>
            <span class="stat-card__icon"><svg class="icon" aria-hidden="true"><use href="<?= smb_e(project_icon_symbol($card['icon'] ?? 'info')) ?>"/></svg></span>
            <div>
              <p class="stat-card__value"><?= smb_e($card['value'] !== '' ? $card['value'] : 'Available on request') ?></p>
              <p class="stat-card__label"><?= smb_e($card['label'] !== '' ? $card['label'] : 'Additional project details') ?></p>
            </div>
          </article>
<?php endforeach; ?>
        </div>
      </div>
    </section>

<?php
    /* ---------- Gallery: always exactly 4 visual positions, featured first ---------- */
    $gallery_title = trim($project['gallery']['title']) !== '' ? $project['gallery']['title'] : ('A closer look at ' . $project['name']);
    $gallery_images = array_values(array_filter(
        array_map('trim', $project['gallery']['images']),
        static fn (string $img): bool => $img !== ''
    ));
    $gallery_images = array_slice($gallery_images, 0, 4);
    while (count($gallery_images) < 4) {
        $gallery_images[] = null; // null marks a render-time placeholder slot
    }
?>
    <!-- ============ Lifestyle gallery ============ -->
    <section class="gallery section" id="gallery" aria-labelledby="gallery-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Lifestyle Gallery</p>
          <h2 id="gallery-title"><?= smb_e($gallery_title) ?></h2>
        </div>
        <div class="gallery__grid">
<?php foreach ($gallery_images as $idx => $img): ?>
<?php
          $is_featured = $idx === 0;
          $is_placeholder = $img === null;
          $src = $is_placeholder ? $fallback_image : project_safe_local_path($img, $fallback_image);
          $alt = $is_placeholder
              ? 'Project image for ' . $project['name']
              : $project['name'] . ' — lifestyle image ' . ($idx + 1);
          $dims = $is_featured ? ['1800', '1200'] : ['900', '1200'];
?>
          <figure class="gallery__item<?= $is_featured ? ' gallery__item--featured' : '' ?>" data-reveal>
            <img src="<?= smb_e($src) ?>"
                 alt="<?= smb_e($alt) ?>"
                 loading="lazy" width="<?= $dims[0] ?>" height="<?= $dims[1] ?>">
          </figure>
<?php endforeach; ?>
        </div>
      </div>
    </section>

<?php
    /* ---------- Amenities: variable-length grid, placeholder-safe ---------- */
    $amenity_items = $project['amenities']['items'];
    if (empty($amenity_items)) {
        $amenity_items = array_fill(0, 4, ['title' => '', 'description' => '', 'icon' => 'info']);
    }
    $amenities_title = trim($project['amenities']['title']) !== '' ? $project['amenities']['title'] : ('Amenities at ' . $project['name']);
?>
    <!-- ============ Features & amenities ============ -->
    <section class="amenities section section--gray" id="amenities" aria-labelledby="amenities-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Features &amp; Amenities</p>
          <h2 id="amenities-title"><?= smb_e($amenities_title) ?></h2>
        </div>
        <ul class="amenities__grid">
<?php foreach ($amenity_items as $amenity): ?>
<?php
          $a_title = trim((string) ($amenity['title'] ?? '')) !== '' ? $amenity['title'] : 'Project Amenity';
          $a_desc = trim((string) ($amenity['description'] ?? '')) !== '' ? $amenity['description'] : 'Full amenity details are available on request.';
          $a_icon = project_icon_symbol($amenity['icon'] ?? 'info');
?>
          <li class="amenity-card" data-reveal>
            <span class="amenity-card__icon"><svg class="icon" aria-hidden="true"><use href="<?= smb_e($a_icon) ?>"/></svg></span>
            <h3><?= smb_e($a_title) ?></h3>
            <p><?= smb_e($a_desc) ?></p>
          </li>
<?php endforeach; ?>
        </ul>
      </div>
    </section>

<?php
    /* ---------- Location & connectivity: always exactly 4 visual positions ---------- */
    $location_title = trim($project['location']['title']) !== '' ? $project['location']['title'] : ('Connected living in ' . $project['location_label']);
    $location_description = trim($project['location']['description']) !== '' ? $project['location']['description'] : 'Contact SMB Real Estate Brokers for further project information.';
    $location_bg = project_safe_local_path($project['location']['background_image'], $fallback_image);

    $places = array_values(array_filter($project['location']['places'], 'is_array'));
    $places = array_slice($places, 0, 4);
    $real_place_count = 0;
    foreach ($places as $place) {
        if (trim((string) ($place['name'] ?? '')) !== '' && trim((string) ($place['time'] ?? '')) !== '') {
            $real_place_count++;
        }
    }
    while (count($places) < 4) {
        $places[] = ['name' => '', 'time' => '', 'icon' => ''];
    }
?>
    <!-- ============ Location & connectivity ============ -->
    <section class="location section" id="location" aria-labelledby="location-title">
      <img class="location__bg" src="<?= smb_e($location_bg) ?>"
           alt="" loading="lazy" aria-hidden="true">
      <div class="container location__inner">
        <div class="section-head section-head--light" data-reveal>
          <p class="eyebrow eyebrow--gold">Location &amp; Connectivity</p>
          <h2 id="location-title"><?= smb_e($location_title) ?></h2>
          <p class="section-head__sub"><?= smb_e($location_description) ?></p>
        </div>
        <ul class="location__grid">
<?php foreach ($places as $place): ?>
<?php
          $p_name = trim((string) ($place['name'] ?? '')) !== '' ? $place['name'] : 'Key Destination';
          $p_time = trim((string) ($place['time'] ?? '')) !== '' ? $place['time'] : 'Travel details available on request';
          $p_icon = trim((string) ($place['icon'] ?? '')) !== '' ? project_icon_symbol($place['icon']) : '#i-pin';
?>
          <li class="place-card" data-reveal>
            <span class="place-card__icon"><svg class="icon" aria-hidden="true"><use href="<?= smb_e($p_icon) ?>"/></svg></span>
            <h3><?= smb_e($p_name) ?></h3>
            <p class="place-card__time">
              <svg class="icon icon--sm" aria-hidden="true"><use href="#i-clock"/></svg>
              <?= smb_e($p_time) ?>
            </p>
          </li>
<?php endforeach; ?>
        </ul>
<?php if ($real_place_count > 0): ?>
        <p class="location__note">Approximate driving times.</p>
<?php endif; ?>
      </div>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="enquire section section--gray" id="enquire" aria-labelledby="enquire-title">
      <div class="container enquire__grid">
        <div class="enquire__text" data-reveal>
          <p class="eyebrow">Contact</p>
          <h2 id="enquire-title">Enquire Now</h2>
          <p class="enquire__sub">
            Fill out the form and our team will get back to you shortly.
          </p>
          <div class="enquire__buttons">
            <a class="btn btn--accent" href="https://wa.me/971504217299" target="_blank" rel="noopener">
              <svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg>
              WhatsApp
            </a>
            <a class="btn btn--primary" href="tel:+971504217299">
              <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
              Call +971 50 421 7299
            </a>
          </div>
          <address>
            <ul class="enquire__details">
              <li>
                <svg class="icon" aria-hidden="true"><use href="#i-mail"/></svg>
                <a href="mailto:info@smbdubai.net">info@smbdubai.net</a>
              </li>
              <li>
                <svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg>
                <span>3002 Westburry Tower Office, Business Bay, Dubai, UAE</span>
              </li>
            </ul>
          </address>
        </div>
        <div class="enquire__form-wrap" data-reveal>
          <form class="lead-form lead-form--card" id="main-form" novalidate>
            <div class="field">
              <label for="mf-name">Full Name</label>
              <input type="text" id="mf-name" name="name" autocomplete="name" placeholder="Your full name" required aria-describedby="mf-name-error">
              <p class="field__error" id="mf-name-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="mf-phone">Phone Number</label>
              <input type="tel" id="mf-phone" name="phone" autocomplete="tel" placeholder="+971 50 000 0000" required aria-describedby="mf-phone-error">
              <p class="field__error" id="mf-phone-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="mf-email">Email Address</label>
              <input type="email" id="mf-email" name="email" autocomplete="email" placeholder="name@example.com" required aria-describedby="mf-email-error">
              <p class="field__error" id="mf-email-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="mf-message">Message <span class="field__optional">(optional)</span></label>
              <textarea id="mf-message" name="message" rows="4" placeholder="Tell us what you are looking for" aria-describedby="mf-message-error"></textarea>
              <p class="field__error" id="mf-message-error" aria-live="polite"></p>
            </div>
            <button type="submit" class="btn btn--accent btn--block btn--lg">Send Enquiry</button>
          </form>
          <div class="lead-form__success lead-form__success--card" hidden>
            <p class="lead-form__success-title">Thank you</p>
            <p>Your enquiry has been received. A property consultant from SMB Real Estate Brokers will contact you shortly.</p>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php require __DIR__ . '/footer.php'; ?>
