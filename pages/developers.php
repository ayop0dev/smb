<?php
$page_title = 'Developers — SMB Real Estate Brokers L.L.C | Emaar, Aldar, Nakheel & Meraas';
$page_description = 'Explore the leading UAE developers SMB Real Estate Brokers works with — Emaar, Aldar, Nakheel and Meraas — and get objective guidance on choosing the right developer for your goals.';
$page_og_title = 'Developers — SMB Real Estate Brokers';
$page_og_description = 'Carefully selected UAE developers, with objective guidance on choosing between them.';
$page_og_image = 'assets/images/projects/six-senses-residences-dubai-marina/webp/01-exterior.webp';
$current_page = 'developers';
$skip_link = '#developers';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/services.css',
    'assets/css/developers.css',
];

require __DIR__ . '/../includes/project-data.php';
require __DIR__ . '/../includes/developer-data.php';

/* Some developer cards below use a shorter display name than the exact
   `developer` value stored in data/projects.json. This is the single place
   that reconciles the two, so every card's project lookup, anchor slug,
   and the matching link from communities.php all resolve to the same
   developer. Cards not listed here already match the dataset name as-is. */
$dev_canonical_names = [
    'Emaar' => 'Emaar Properties',
    'Aldar' => 'Aldar Properties',
];

function developer_canonical(string $displayName, array $overrides): string
{
    return $overrides[$displayName] ?? $displayName;
}

require __DIR__ . '/../includes/header.php';
?>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/projects/six-senses-residences-dubai-marina/webp/01-exterior.webp"
           alt="Aerial view of a master-planned Dubai community with lagoons and villas"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="index.php">Home</a></li>
              <li><span aria-current="page">Developers</span></li>
            </ol>
          </nav>
          <h1 id="hero-title">Choose the project, not the sales agenda</h1>
          <p class="hero__description">
            A broad UAE developer portfolio creates genuine choice. Independence ensures that choice is narrowed in the client's interest&mdash;not around a sales target or commission.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Featured developers ============ -->
    <section class="devs section section--gray" id="developers" aria-labelledby="devs-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Developers</p>
          <h2 id="devs-title">Who we work with</h2>
        </div>
        <div class="devs__grid">
          <?php
            $dev = developer_canonical('Emaar', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/Emaar_logo.svg'); mask-image:url('/assets/images/developers/Emaar_logo.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Emaar</a></h3>
            <p class="dev-card__desc">
              Known for large-scale, master-planned communities that combine homes, amenities and long-term placemaking.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Aldar', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/aldar.png'); mask-image:url('/assets/images/developers/aldar.png')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Aldar</a></h3>
            <p class="dev-card__desc">
              An Abu Dhabi-based developer with a wide portfolio of residential, cultural and leisure destinations across the emirate.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('DAMAC Properties', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/damac.svg'); mask-image:url('/assets/images/developers/damac.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">DAMAC Properties</a></h3>
            <p class="dev-card__desc">
              Luxury Dubai developer renowned for high-end residential towers and
              branded, amenity-rich communities.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Nakheel', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/nakheel.svg'); mask-image:url('/assets/images/developers/nakheel.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Nakheel</a></h3>
            <p class="dev-card__desc">
              A Dubai developer whose portfolio includes established residential communities, waterfront destinations and major land reclamation projects.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Dubai Properties', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/dubai-properties.png'); mask-image:url('/assets/images/developers/dubai-properties.png')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Dubai Properties</a></h3>
            <p class="dev-card__desc">
              Diversified Dubai developer delivering residential, retail and
              hospitality projects across established city communities.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Sobha Realty', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/sobha.svg'); mask-image:url('/assets/images/developers/sobha.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Sobha Realty</a></h3>
            <p class="dev-card__desc">
              Premium developer recognised for meticulous craftsmanship and
              high-quality residential communities across Dubai.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Meraas', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/Meraas-logo.svg'); mask-image:url('/assets/images/developers/Meraas-logo.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Meraas</a></h3>
            <p class="dev-card__desc">
              Focused on urban neighbourhoods and destination-led developments with a strong emphasis on public realm and everyday experience.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Binghatti Developers', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/binghatti.svg'); mask-image:url('/assets/images/developers/binghatti.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Binghatti Developers</a></h3>
            <p class="dev-card__desc">
              Fast-growing Dubai developer recognised for bold architectural
              designs and distinctive, branded residential towers.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Danube Properties', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/danube.png'); mask-image:url('/assets/images/developers/danube.png')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Danube Properties</a></h3>
            <p class="dev-card__desc">
              Value-driven Dubai developer offering affordable, amenity-rich
              residences with flexible, investor-friendly payment plans.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Azizi Developments', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/Azizi_Developments.svg'); mask-image:url('/assets/images/developers/Azizi_Developments.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Azizi Developments</a></h3>
            <p class="dev-card__desc">
              Dubai developer delivering accessible, well-located residential
              communities across several of the city's key districts.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('MAG Group Holding', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/MAG-GROUP-HOLDING-logo.png'); mask-image:url('/assets/images/developers/MAG-GROUP-HOLDING-logo.png')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">MAG Group Holding</a></h3>
            <p class="dev-card__desc">
              Diversified UAE developer with a growing portfolio of residential,
              hospitality and mixed-use projects.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Ellington Properties', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/ellington.svg'); mask-image:url('/assets/images/developers/ellington.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Ellington Properties</a></h3>
            <p class="dev-card__desc">
              Boutique Dubai developer celebrated for design-led residences and
              thoughtfully curated architectural details.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Samana Developers', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/samana.png'); mask-image:url('/assets/images/developers/samana.png')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Samana Developers</a></h3>
            <p class="dev-card__desc">
              Dubai developer known for amenity-packed residences and attractive,
              investor-friendly payment structures.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Deyaar Development', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/deyaar.svg'); mask-image:url('/assets/images/developers/deyaar.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Deyaar Development</a></h3>
            <p class="dev-card__desc">
              Established Dubai developer delivering residential and commercial
              projects across key city locations.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Omniyat', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/omniyat.svg'); mask-image:url('/assets/images/developers/omniyat.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Omniyat</a></h3>
            <p class="dev-card__desc">
              Ultra-luxury Dubai developer crafting architecturally distinctive,
              branded residences in prime waterfront locations.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Iman Developers', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/iman.png'); mask-image:url('/assets/images/developers/iman.png')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Iman Developers</a></h3>
            <p class="dev-card__desc">
              Dubai developer focused on quality residential projects designed
              for comfortable, connected community living.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Reportage Properties', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/reportage.svg'); mask-image:url('/assets/images/developers/reportage.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Reportage Properties</a></h3>
            <p class="dev-card__desc">
              UAE-wide developer delivering large-scale residential communities
              across Dubai and several other emirates.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Tiger Properties', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/tiger.png'); mask-image:url('/assets/images/developers/tiger.png')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Tiger Properties</a></h3>
            <p class="dev-card__desc">
              Dubai developer with a diverse portfolio of residential and
              commercial towers across the city.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Pantheon Development', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/pantheon.png'); mask-image:url('/assets/images/developers/pantheon.png')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Pantheon Development</a></h3>
            <p class="dev-card__desc">
              Dubai developer delivering design-focused residential projects with
              an emphasis on quality finishes.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>

          <?php
            $dev = developer_canonical('Select Group', $dev_canonical_names);
            $dev_slug = developer_slug($dev);
            $dev_projects = get_projects_by_developer($dev);
            $dev_rec = get_developer_by_canonical_name($dev);
            $dev_url = $dev_rec ? ($dev_rec['slug'] . '.php') : ($dev_slug . '.php');
            $dev_display = $dev_rec['display_name'] ?? $dev;
          ?>
          <article class="dev-card" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <a class="dev-card__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' developer archive') ?>">
              <span class="dev-card__logo-mark" style="-webkit-mask-image:url('/assets/images/developers/select-group.svg'); mask-image:url('/assets/images/developers/select-group.svg')" aria-hidden="true"></span>
            </a>
            <h3><a href="<?= smb_e($dev_url) ?>">Select Group</a></h3>
            <p class="dev-card__desc">
              Award-winning Dubai developer known for premium waterfront
              residences and landmark hospitality projects.
            </p>
<p class="dev-card__projects">
              <a href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' developer archive') ?>">Visit Developer</a>
            </p>
          </article>
        </div>
      </div>
    </section>

    <!-- ============ How SMB helps ============ -->
    <section class="choose section" aria-labelledby="help-title">
      <div class="container choose__grid">
        <div class="choose__intro" data-reveal>
          <p class="eyebrow">How SMB Helps</p>
          <h2 id="help-title">Independent of any developer agenda</h2>
          <p>
            Developer relationships provide access. They do not dictate the advice. Suitability, value and risk determine the recommendation&mdash;not ease of sale.
          </p>
          <a class="btn btn--primary" href="contact.php">Compare Developer Options</a>
        </div>
        <ol class="choose__list">
          <li data-reveal>
            <div>
              <h3>Compare developers side by side</h3>
              <p>A neutral view of differences in delivery history, finishes, communities and terms.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Match projects to your budget</h3>
              <p>The budget is treated as a boundary, not an invitation to stretch the brief.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Understand payment plans</h3>
              <p>Instalments, fees, obligations and handover terms made clear before commitment.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Evaluate communities properly</h3>
              <p>Location, amenities, connectivity and day-to-day realities considered beyond the brochure.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Support the complete buying journey</h3>
              <p>Continuity through reservation, documentation, construction milestones, handover and beyond.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Choose with a clearer view</h2>
        <p class="cta-final__sub" data-reveal>
          Bring us the shortlist&mdash;or start with a blank page. We will assess the relevant developers, terms and communities against what you want to achieve.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="contact.php#enquire">Request an Independent View</a>
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
