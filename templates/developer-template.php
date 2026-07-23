<?php
/**
 * Shared developer archive template.
 *
 * Renders a Developer Archive page for any developer in data/developers.json.
 * Individual developer wrapper files set $developer_slug and require this file.
 */
declare(strict_types=1);

require __DIR__ . '/../includes/project-data.php';
require __DIR__ . '/../includes/developer-data.php';

/* ---------- Resolve the developer or fail with a controlled 404 ---------- */
$developer_slug = trim((string) ($developer_slug ?? ''));
$developer = $developer_slug === '' ? null : get_developer_by_slug($developer_slug);

if ($developer === null) {
    http_response_code(404);
    $page_title = 'Developer Not Found — SMB Real Estate Brokers';
    $page_description = 'The developer you are looking for could not be found.';
    $current_page = '';
    $skip_link = '#not-found';
    require __DIR__ . '/../includes/header.php';
    ?>
      <main id="top">
        <section class="section" id="not-found" aria-labelledby="not-found-title">
          <div class="container" style="text-align:center; max-width:640px;">
            <p class="eyebrow">Developer Not Found</p>
            <h1 id="not-found-title">We couldn't find that developer</h1>
            <p style="margin: 0 auto 32px; max-width: 60ch;">
              The developer page you're looking for may have been renamed or is no longer available. Explore our current developers or get in touch with our team.
            </p>
            <div class="hero__cta" style="justify-content:center;">
              <a class="btn btn--primary" href="developers.php">Browse Developers</a>
              <a class="btn btn--ghost" href="contact.php">Contact Us</a>
            </div>
          </div>
        </section>
      </main>
    <?php
    require __DIR__ . '/../includes/footer.php';
    exit;
}

require_once __DIR__ . '/../includes/project-card-helpers.php';

/* ---------- Resolved developer variables ---------- */
$developer_display_name = (string) ($developer['display_name'] ?? '');
$developer_canonical_name = (string) ($developer['canonical_name'] ?? '');
$developer_biography = (string) ($developer['biography'] ?? '');

/* ---------- Projects filtering ---------- */
$developer_projects = get_projects_by_developer($developer_canonical_name);

/* ---------- Image selection and fallback ---------- */
$developer_project_placeholder = 'assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp';
$developer_fallback_image = is_file(dirname(__DIR__) . '/' . $developer_project_placeholder)
    ? $developer_project_placeholder
    : 'assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp';

$developer_image_project = null;
$developer_image = '';
$developer_image_is_placeholder = true;
$developer_image_alt = '';

foreach ($developer_projects as $proj) {
    $candidates = [];
    if (isset($proj['hero']['image'])) {
        $candidates[] = $proj['hero']['image'];
    }
    if (isset($proj['gallery']['images']) && is_array($proj['gallery']['images'])) {
        foreach ($proj['gallery']['images'] as $g_img) {
            $candidates[] = $g_img;
        }
    }
    foreach ($candidates as $cand) {
        $cand = trim((string) $cand);
        if ($cand === '') {
            continue;
        }
        if (preg_match('#^([a-z]+:)?//#i', $cand) === 1 || str_contains($cand, '..')) {
            continue;
        }
        $developer_image_project = $proj;
        $developer_image = $cand;
        $developer_image_is_placeholder = false;
        break 2;
    }
}

if ($developer_image === '') {
    $developer_image = $developer_fallback_image;
    $developer_image_project = null;
    $developer_image_is_placeholder = true;
    $developer_image_alt = 'Placeholder image for ' . $developer_display_name;
} else {
    $proj_name = (string) ($developer_image_project['name'] ?? '');
    $developer_image_alt = $proj_name . ' by ' . $developer_display_name;
}

/* ---------- Global page and SEO variables ---------- */
$page_title = $developer_display_name . ' — SMB Real Estate Brokers';
$page_description = $developer_biography;
$page_og_title = $page_title;
$page_og_description = $page_description;
$page_og_image = $developer_image;
$current_page = '';
$skip_link = '#overview';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/services.css',
    'assets/css/contact.css',
    'assets/css/communities.css',
];
$sticky_href = 'contact.php';
$sticky_label = 'UAE Property Advisory';
$sticky_value = 'Start a Conversation';
$sticky_action = 'Contact us';

require __DIR__ . '/../includes/header.php';
?>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => $site_url . '/',
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Developers',
            'item' => $site_url . '/developers.php',
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $developer_display_name,
            'item' => $canonical_url,
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="<?= htmlspecialchars($developer_image, ENT_QUOTES, 'UTF-8') ?>"
           alt="<?= htmlspecialchars($developer_image_alt, ENT_QUOTES, 'UTF-8') ?>"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="index.php">Home</a></li>
              <li><a href="developers.php">Developers</a></li>
              <li><span aria-current="page"><?= htmlspecialchars($developer_display_name, ENT_QUOTES, 'UTF-8') ?></span></li>
            </ol>
          </nav>
          <h1 id="hero-title"><?= htmlspecialchars($developer_display_name, ENT_QUOTES, 'UTF-8') ?></h1>
          <p class="hero__description">
            <?= htmlspecialchars($developer_biography, ENT_QUOTES, 'UTF-8') ?>
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Developer Overview ============ -->
    <section class="section" id="overview" aria-labelledby="overview-title">
      <div class="container">
        <div class="split">
          <div class="split__media" data-reveal>
            <img src="<?= htmlspecialchars($developer_image, ENT_QUOTES, 'UTF-8') ?>"
                 alt="<?= htmlspecialchars($developer_image_alt, ENT_QUOTES, 'UTF-8') ?>"
                 loading="lazy" width="900" height="675">
          </div>
          <div class="split__text" data-reveal>
            <p class="eyebrow">Developer Overview</p>
            <h2 id="overview-title"><?= htmlspecialchars($developer_display_name, ENT_QUOTES, 'UTF-8') ?></h2>
            <p><?= htmlspecialchars($developer_biography, ENT_QUOTES, 'UTF-8') ?></p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ Projects ============ -->
    <section class="comms section section--gray" id="projects" aria-labelledby="projects-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Projects</p>
          <h2 id="projects-title"><?= htmlspecialchars('Projects by ' . $developer_display_name, ENT_QUOTES, 'UTF-8') ?></h2>
        </div>
<?php if (empty($developer_projects)): ?>
        <p class="section-head__sub">Coming Soon</p>
<?php else: ?>
        <div class="comms__grid">
<?php
          $project_card_fallback_image = $developer_fallback_image;
          $project_card_dev_href_fallback = static function (string $developerName) use ($developer_slug): string {
              return $developer_slug . '.php';
          };
?>
<?php foreach ($developer_projects as $project): ?>
<?php require __DIR__ . '/../template-parts/project-card.php'; ?>
<?php endforeach; ?>
        </div>
<?php endif; ?>
      </div>
    </section>
  </main>

<?php
require __DIR__ . '/../includes/footer.php';
