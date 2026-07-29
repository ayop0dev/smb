<?php
/**
 * Global site header — shared by every page.
 * Pages set their metadata / styles before requiring this file.
 */
$page_title = $page_title ?? 'SMB Real Estate Brokers';
$page_description = $page_description ?? '';
$page_og_title = $page_og_title ?? $page_title;
$page_og_description = $page_og_description ?? $page_description;
$page_og_image = $page_og_image ?? 'assets/images/projects/fahid-island/webp/01-exterior.webp';
$current_page = $current_page ?? '';
$page_styles = $page_styles ?? [];
$skip_link = $skip_link ?? '#top';

/* Canonical URL + absolute OG/Twitter image, derived from the original
   requested path so every page gets a correct value without needing its own
   boilerplate. REQUEST_URI (not SCRIPT_NAME) is used because page files live
   in subfolders (pages/, developers/, projects/) behind .htaccess rewrites
   that map flat public URLs to them — SCRIPT_NAME would reflect the rewritten
   filesystem path, REQUEST_URI always reflects the original request. */
$site_url = 'https://smbdubai.net';
$request_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$current_file = basename($request_path);
$current_file = $current_file !== '' ? $current_file : 'index.php';
$canonical_url = $site_url . ($current_file === 'index.php' ? '/' : '/' . $current_file);
$page_og_image_url = $site_url . '/' . ltrim($page_og_image, '/');
$main_css_version = (string) filemtime(__DIR__ . '/../assets/css/main.css');

$nav_items = [
    'home' => ['index.php', 'Home'],
    'about' => ['about.php', 'About'],
    'services' => ['services.php', 'Services'],
    'developers' => ['developers.php', 'Developers'],
    'communities' => ['communities.php', 'Communities'],
    'contact' => ['contact.php', 'Contact'],
];

function smb_e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/* ---------- Unified breadcrumb mechanism (single source for every page type) ----------
   A page sets $breadcrumb_trail before requiring this file: an array of
   ['label' => string, 'url' => string|null] segments AFTER Home (Home is
   added automatically, both here and by template-parts/breadcrumb.php). The
   final segment should omit 'url' (or set it to null) to mark the current,
   non-linked page — its schema.org "item" falls back to $canonical_url.
   Pages that don't set $breadcrumb_trail (the homepage) get no breadcrumb,
   matching the existing "Home has no visible breadcrumb" design. */
$breadcrumb_trail = $breadcrumb_trail ?? [];
$breadcrumb_json = null;
if (!empty($breadcrumb_trail)) {
    $breadcrumb_items = [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url . '/'],
    ];
    $breadcrumb_position = 2;
    foreach ($breadcrumb_trail as $crumb) {
        $crumb_url = !empty($crumb['url'])
            ? $site_url . '/' . ltrim((string) $crumb['url'], '/')
            : $canonical_url;
        $breadcrumb_items[] = [
            '@type' => 'ListItem',
            'position' => $breadcrumb_position,
            'name' => (string) $crumb['label'],
            'item' => $crumb_url,
        ];
        $breadcrumb_position++;
    }
    $breadcrumb_json = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $breadcrumb_items,
    ], JSON_UNESCAPED_SLASHES);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= smb_e($page_title) ?></title>
  <meta name="description" content="<?= smb_e($page_description) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= smb_e($canonical_url) ?>">
  <meta property="og:title" content="<?= smb_e($page_og_title) ?>">
  <meta property="og:description" content="<?= smb_e($page_og_description) ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= smb_e($canonical_url) ?>">
  <meta property="og:image" content="<?= smb_e($page_og_image_url) ?>">
  <meta property="og:site_name" content="SMB Real Estate Brokers">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= smb_e($page_og_title) ?>">
  <meta name="twitter:description" content="<?= smb_e($page_og_description) ?>">
  <meta name="twitter:image" content="<?= smb_e($page_og_image_url) ?>">
  <meta name="theme-color" content="#0a2342">
<?php if ($breadcrumb_json): ?>
  <script type="application/ld+json"><?= $breadcrumb_json ?></script>
<?php endif; ?>
  <link rel="icon" type="image/svg+xml" href="assets/icons/favicon.svg">
  <link rel="preload" href="assets/fonts/Manrope-VariableFont_wght.ttf" as="font" type="font/ttf" crossorigin>
  <link rel="stylesheet" href="/assets/css/main.css?v=<?= smb_e($main_css_version) ?>">
<?php foreach ($page_styles as $style): ?>
  <link rel="stylesheet" href="<?= smb_e($style) ?>">
<?php endforeach; ?>
</head>
<body>

  <svg xmlns="http://www.w3.org/2000/svg" style="display:none" aria-hidden="true">
    <symbol id="i-home" viewBox="0 0 24 24"><path d="M3 11.5 12 4l9 7.5"/><path d="M5.5 9.6V20h13V9.6"/><path d="M10 20v-5.5h4V20"/></symbol>
    <symbol id="i-building" viewBox="0 0 24 24"><rect x="6" y="3.5" width="12" height="17" rx="1.5"/><path d="M10 7.5h1.5M13.5 7.5H15M10 11h1.5M13.5 11H15M10 14.5h1.5M13.5 14.5H15M10.5 20.5v-3h3v3"/></symbol>
    <symbol id="i-waves" viewBox="0 0 24 24"><path d="M3 8c3-2.4 6-2.4 9 0s6 2.4 9 0M3 13c3-2.4 6-2.4 9 0s6 2.4 9 0M3 18c3-2.4 6-2.4 9 0s6 2.4 9 0"/></symbol>
    <symbol id="i-bag" viewBox="0 0 24 24"><path d="M5.5 8.5h13L19.6 20H4.4z"/><path d="M9 11V6.5a3 3 0 0 1 6 0V11"/></symbol>
    <symbol id="i-deed" viewBox="0 0 24 24"><path d="M6 2.8h8.5L19 7.2V21H6z"/><path d="M14.5 3v4.5H19"/><path d="M9.5 13.5l2.2 2.2 3.8-4.2"/></symbol>
    <symbol id="i-sparkles" viewBox="0 0 24 24"><path d="M11 4.5l1.6 4.1 4.1 1.6-4.1 1.6L11 16l-1.6-4.2-4.1-1.6 4.1-1.6z"/><path d="M18 14.5l.9 2.1 2.1.9-2.1.9-.9 2.1-.9-2.1-2.1-.9 2.1-.9z"/></symbol>
    <symbol id="i-key" viewBox="0 0 24 24"><circle cx="8" cy="15.5" r="4"/><path d="M11 12.5 20 3.5M16.5 7l2.5 2.5M14 9.5l2 2"/></symbol>
    <symbol id="i-pin" viewBox="0 0 24 24"><path d="M12 21S5.5 15.6 5.5 10.5a6.5 6.5 0 0 1 13 0C18.5 15.6 12 21 12 21z"/><circle cx="12" cy="10.5" r="2.3"/></symbol>
    <symbol id="i-search" viewBox="0 0 24 24"><circle cx="10.5" cy="10.5" r="6.5"/><path d="M19.5 19.5 15.3 15.3"/></symbol>
    <symbol id="i-phone" viewBox="0 0 24 24"><path d="M5 4h4l1.5 4.5L8 10c1 2.5 3.5 5 6 6l1.5-2.5L20 15v4c0 1-.8 1.8-1.8 1.8C10 20.5 3.5 14 3.2 5.8 3.2 4.8 4 4 5 4z"/></symbol>
    <symbol id="i-whatsapp" viewBox="0 0 24 24"><path d="M12 3.5a8.5 8.5 0 0 0-7.3 12.8L3.5 20.5l4.3-1.1A8.5 8.5 0 1 0 12 3.5z"/><path d="M9 8.5c-.3 2.5 2.5 6 6 6.5l1-1.5-2-1.2-1 .7c-1-.5-2-1.5-2.4-2.5l.8-.9-1-2z"/></symbol>
    <symbol id="i-mail" viewBox="0 0 24 24"><rect x="3.5" y="5.5" width="17" height="13" rx="2"/><path d="M4.5 7.5 12 13l7.5-5.5"/></symbol>
    <symbol id="i-arrow" viewBox="0 0 24 24"><path d="M4 12h15M13.5 5.5 20 12l-6.5 6.5"/></symbol>
    <symbol id="i-instagram" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="4.5"/><circle cx="12" cy="12" r="3.4"/><circle cx="16.6" cy="7.4" r="0.5"/></symbol>
    <symbol id="i-linkedin" viewBox="0 0 24 24"><rect x="3.5" y="3.5" width="17" height="17" rx="3"/><path d="M8 10.5v6M8 7.4v.2M12 16.5v-3.6a2 2 0 0 1 4 0v3.6"/></symbol>
    <symbol id="i-facebook" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5"/><path d="M14.8 8.5h-1.6c-.9 0-1.4.5-1.4 1.5v10M9.8 12.3h4.4"/></symbol>
    <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8.5" r="3.6"/><path d="M5 20c.6-4 3.4-6 7-6s6.4 2 7 6"/></symbol>
    <symbol id="i-chart" viewBox="0 0 24 24"><path d="M4.5 4.5v15h15"/><path d="M7.5 15l3.5-4 3 2.5 4.5-6"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24"><path d="M5 12.5l4.5 4.5L19 7.5"/></symbol>
    <symbol id="i-users" viewBox="0 0 24 24"><circle cx="9" cy="8.5" r="3.2"/><path d="M3.5 19.5c0-3 2.5-5 5.5-5s5.5 2 5.5 5M15.5 5.8a3.2 3.2 0 0 1 0 5.4M17 14.7c2.2.5 3.5 2.4 3.5 4.8"/></symbol>
    <symbol id="i-leaf" viewBox="0 0 24 24"><path d="M5 19.5C5 9.5 12 4.5 19.5 4.5c0 9.5-6.5 15-14.5 15z"/><path d="M5 19.5c3-5.5 7-9.5 11-11.5"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></symbol>
    <symbol id="i-calendar" viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="15.5" rx="2"/><path d="M3.5 9.5h17M8 2.8v4M16 2.8v4"/></symbol>
    <symbol id="i-expand" viewBox="0 0 24 24"><path d="M4 9V4h5M20 15v5h-5M15 4h5v5M9 20H4v-5"/></symbol>
    <symbol id="i-bed" viewBox="0 0 24 24"><path d="M3 18v-8.5M3 14h18v4M3 14v0M21 14v-2a2.5 2.5 0 0 0-2.5-2.5H10V14"/><circle cx="6.5" cy="11.5" r="1.6"/></symbol>
    <symbol id="i-plan" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M10 4v6M10 10H4M14 20v-5M14 15h6"/></symbol>
    <symbol id="i-dumbbell" viewBox="0 0 24 24"><path d="M6.5 6.5v11M17.5 6.5v11M3.5 9v6M20.5 9v6M6.5 12h11"/></symbol>
    <symbol id="i-heart" viewBox="0 0 24 24"><path d="M12 20s-7-4.6-9-9c-1.2-2.8.4-6 3.5-6 2 0 3.5 1.2 4.5 3 1-1.8 2.5-3 4.5-3 3.1 0 4.7 3.2 3.5 6-2 4.4-9 9-9 9z"/></symbol>
    <symbol id="i-balloon" viewBox="0 0 24 24"><ellipse cx="12" cy="9" rx="5" ry="6"/><path d="M11.2 15l.8 1.4.8-1.4M12 16.4c.2 1.8-1.6 2.4-1.4 4.3"/></symbol>
    <symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 3l7 2.8v5.4c0 4.6-3 7.6-7 9.8-4-2.2-7-5.2-7-9.8V5.8z"/><path d="M9 11.5l2.2 2.2 4-4.5"/></symbol>
    <symbol id="i-anchor" viewBox="0 0 24 24"><circle cx="12" cy="5.5" r="2"/><path d="M12 7.5V20M12 20c-4.4 0-8-3.6-8-8h2.5M12 20c4.4 0 8-3.6 8-8h-2.5M9 9.5h6"/></symbol>
    <symbol id="i-plane" viewBox="0 0 24 24"><path d="M2.5 19.5h19"/><path d="M3.8 13l4.3 1.1 8.7-5.6c1.3-.8 2.8-.5 3.4.5-.3 1-1.2 1.8-2.6 2.1L9.3 14.7l-4.3-.6z"/></symbol>
    <symbol id="i-close" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6 6 18"/></symbol>
    <symbol id="i-zoom-in" viewBox="0 0 24 24"><circle cx="10.5" cy="10.5" r="6.5"/><path d="M19.5 19.5 15.3 15.3M10.5 7.5v6M7.5 10.5h6"/></symbol>
    <symbol id="i-zoom-out" viewBox="0 0 24 24"><circle cx="10.5" cy="10.5" r="6.5"/><path d="M19.5 19.5 15.3 15.3M7.5 10.5h6"/></symbol>
  </svg>

  <a class="skip-link" href="<?= smb_e($skip_link) ?>">Skip To Content</a>

  <header class="header" id="header">
    <div class="header__overlay" id="nav-overlay" aria-hidden="true"></div>
    <div class="container header__inner">
      <a class="header__logo" href="index.php" aria-label="SMB Real Estate Brokers — Home">
        <img src="assets/images/smb-logo-horizontal.png" alt="SMB Real Estate Brokers — Serving, Managing &amp; Beyond" width="80" height="46">
      </a>
      <nav class="header__nav" id="main-nav" aria-label="Main Navigation">
        <button type="button" class="header__close" id="nav-close" aria-label="Close Menu">
          <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg>
        </button>
        <ul>
<?php foreach ($nav_items as $slug => [$href, $label]): ?>
          <li><a href="<?= smb_e($href) ?>"<?= $current_page === $slug ? ' aria-current="page"' : '' ?>><?= smb_e($label) ?></a></li>
<?php endforeach; ?>
        </ul>
        <div class="header__nav-extra">
          <a class="header__phone" href="tel:+971504217299">
            <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
            +971 50 421 7299
          </a>
        </div>
      </nav>
      <div class="header__actions">
        <a class="header__phone" href="tel:+971504217299">
          <svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>
          <span class="header__phone-text">+971 50 421 7299</span>
        </a>
        <button type="button" class="header__burger" id="nav-toggle" aria-expanded="false" aria-controls="main-nav" aria-label="Open Menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>
