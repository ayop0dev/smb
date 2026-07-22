<?php
$page_title = 'Dubai Communities — SMB Real Estate Brokers L.L.C | Explore by Location';
$page_description = 'Explore Dubai\'s most sought-after communities with SMB Real Estate Brokers — Downtown Dubai, Dubai Marina, Business Bay, Dubai Hills Estate, Palm Jumeirah and Dubai Creek Harbour.';
$page_og_title = 'Dubai Communities — SMB Real Estate Brokers';
$page_og_description = 'Explore Dubai real estate by community — lifestyle, property types and honest guidance on choosing the right location.';
$page_og_image = 'assets/images/gallery-resort-pool.jpg';
$current_page = 'communities';
$skip_link = '#intro';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/services.css',
    'assets/css/contact.css',
    'assets/css/communities.css',
];

require __DIR__ . '/includes/project-data.php';
require __DIR__ . '/header.php';
?>

  <main id="top">

    <!-- ============ Inner page hero ============ -->
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/gallery-resort-pool.jpg"
           alt="Resort-style pool and palm trees overlooking the sea in Dubai"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="index.php">Home</a></li>
              <li><span aria-current="page">Communities</span></li>
            </ol>
          </nav>
          <h1 id="hero-title">The right property begins with place</h1>
          <p class="hero__description">
            A property can be changed. Its setting cannot. We look across the UAE for locations that make sense both on an ordinary day and over the years ahead.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Communities introduction ============ -->
    <section class="comm-intro section" id="intro" aria-labelledby="intro-title">
      <div class="container comm-intro__inner">
        <div data-reveal>
          <p class="eyebrow">Why Location Matters</p>
          <h2 id="intro-title">Place changes the whole equation</h2>
          <p>
            A city address, an island home and a quieter coastal community each change the rhythm of daily life. They also carry different patterns of demand, supply and future growth. Good location advice holds the emotional and practical questions together.
          </p>
        </div>
      </div>
    </section>

    <!-- ============ Featured communities: real project archive ============ -->
    <?php
      /* Data-driven project archive. Image precedence: hero.image, then the
         first valid gallery image, then the same centralized local
         placeholder project-template.php falls back to (never an external
         URL, never invented). get_all_projects_safe() never triggers a
         page-wide failure — an unavailable dataset degrades to a local
         empty-state message inside this section only. */
      function comm_project_card_image(array $project, string $fallback): array
      {
          $candidates = [$project['hero']['image'] ?? ''];
          foreach (($project['gallery']['images'] ?? []) as $img) {
              $candidates[] = $img;
          }
          foreach ($candidates as $candidate) {
              $candidate = trim((string) $candidate);
              if ($candidate === '') {
                  continue;
              }
              if (preg_match('#^([a-z]+:)?//#i', $candidate) === 1 || str_contains($candidate, '..')) {
                  continue; // no external/protocol-relative URLs, no path traversal
              }
              return ['src' => $candidate, 'is_placeholder' => false];
          }
          return ['src' => $fallback, 'is_placeholder' => true];
      }

      /* Splits a hero.headline such as "Apartments, Duplexes and Penthouses"
         into individual, deduplicated display labels. Supports commas and
         "and"; invents nothing — a headline with no separators just yields
         its own single label. */
      function comm_parse_property_types(string $headline): array
      {
          $headline = trim($headline);
          if ($headline === '') {
              return [];
          }
          $normalized = preg_replace('/\s+and\s+/i', ', ', $headline);
          $parts = array_map('trim', explode(',', $normalized));
          $parts = array_filter($parts, static fn (string $p): bool => $p !== '');
          return array_values(array_unique($parts));
      }

      /* Icon per property-type label, reused from the icons already used by
         the removed larger project cards — no new SVG symbol added. */
      function comm_property_type_icon(string $label): string
      {
          $l = strtolower($label);
          if (str_contains($l, 'apartment') || str_contains($l, 'penthouse') || str_contains($l, 'office')) {
              return '#i-building';
          }
          if (str_contains($l, 'retail')) {
              return '#i-bag';
          }
          return '#i-home'; // villas, townhouses, and any other residential label
      }

      $comm_project_placeholder = 'assets/images/project-placeholder.jpg';
      $comm_project_fallback_image = is_file(__DIR__ . '/' . $comm_project_placeholder)
          ? $comm_project_placeholder
          : 'assets/images/hero-villa-pool.jpg'; // same centralized fallback as project-template.php

      $comm_projects = get_all_projects_safe();
    ?>
    <section class="comms section section--gray" id="communities" aria-labelledby="comms-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Communities</p>
          <h2 id="comms-title">A cross-section of UAE living</h2>
        </div>
<?php if (empty($comm_projects)): ?>
        <p class="section-head__sub">Project listings are currently unavailable.</p>
<?php else: ?>
        <div class="comms__grid">
<?php foreach ($comm_projects as $project): ?>
<?php
          $card_image = comm_project_card_image($project, $comm_project_fallback_image);
          $card_name = (string) ($project['name'] ?? '');
          $card_location = trim((string) ($project['location_label'] ?? ''));
          $card_developer = trim((string) ($project['developer'] ?? ''));
          $card_types = comm_parse_property_types((string) ($project['hero']['headline'] ?? ''));
          $card_href = (string) ($project['slug'] ?? '') . '.php';
?>
          <article class="comm-card" data-reveal>
            <div class="comm-card__media">
              <img src="<?= htmlspecialchars($card_image['src'], ENT_QUOTES, 'UTF-8') ?>"
                   alt="<?= htmlspecialchars('Project image for ' . $card_name, ENT_QUOTES, 'UTF-8') ?>"
                   loading="lazy" width="900" height="563">
            </div>
            <div class="comm-card__body">
              <h3><?= htmlspecialchars($card_name, ENT_QUOTES, 'UTF-8') ?></h3>
<?php if ($card_developer !== '' || $card_location !== ''): ?>
              <p class="comm-card__desc">
<?php if ($card_developer !== ''): ?>
                <a class="comm-card__dev-link" href="<?= htmlspecialchars('developers.php#developer-' . developer_slug($card_developer), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($card_developer, ENT_QUOTES, 'UTF-8') ?></a>
<?php endif; ?>
<?php if ($card_developer !== '' && $card_location !== ''): ?> &middot; <?php endif; ?>
<?= htmlspecialchars($card_location, ENT_QUOTES, 'UTF-8') ?>
              </p>
<?php endif; ?>
<?php if (!empty($card_types)): ?>
              <ul class="comm-card__types" aria-label="Property types">
<?php foreach ($card_types as $type): ?>
                <li><svg class="icon" aria-hidden="true"><use href="<?= htmlspecialchars(comm_property_type_icon($type), ENT_QUOTES, 'UTF-8') ?>"/></svg><?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?></li>
<?php endforeach; ?>
              </ul>
<?php endif; ?>
              <a class="comm-card__link" href="<?= htmlspecialchars($card_href, ENT_QUOTES, 'UTF-8') ?>" aria-label="<?= htmlspecialchars('View ' . $card_name . ' project details', ENT_QUOTES, 'UTF-8') ?>">
                View Project
                <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>
<?php endforeach; ?>
        </div>
<?php endif; ?>
      </div>
    </section>

    <!-- ============ Explore by lifestyle ============ -->
    <section class="lifestyle section section--gray" aria-labelledby="lifestyle-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Explore by Lifestyle</p>
          <h2 id="lifestyle-title">Begin with the life&mdash;or outcome&mdash;you want</h2>
        </div>
        <div class="categories__grid">
          <a class="category-card" href="#" data-reveal aria-label="Waterfront Living communities (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-waves"/></svg></span>
            <span class="category-card__text">
              <h3>Waterfront Living</h3>
              <p>Beaches, marinas and lagoon communities</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Family Communities (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-users"/></svg></span>
            <span class="category-card__text">
              <h3>Family Communities</h3>
              <p>Parks, schools and villa neighbourhoods</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="City Living communities (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg></span>
            <span class="category-card__text">
              <h3>City Living</h3>
              <p>Towers and districts at the centre of it all</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Luxury Destinations (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-sparkles"/></svg></span>
            <span class="category-card__text">
              <h3>Distinguished Destinations</h3>
              <p>Distinguished addresses across the UAE</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Investment Areas (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-chart"/></svg></span>
            <span class="category-card__text">
              <h3>Investment Areas</h3>
              <p>Areas assessed for sustainable rental demand</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Emerging Communities (filtered view to be added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-leaf"/></svg></span>
            <span class="category-card__text">
              <h3>Emerging Communities</h3>
              <p>New districts taking shape across the Emirates</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
        </div>
      </div>
    </section>

    <!-- ============ Choosing the right community ============ -->
    <section class="choose section" aria-labelledby="choose-title">
      <div class="container choose__grid">
        <div class="choose__intro" data-reveal>
          <p class="eyebrow">Choosing the Right Community</p>
          <h2 id="choose-title">A location decision grounded in evidence</h2>
          <p>
            A render cannot tell you how a weekday commute feels, whether future supply may alter the market or if the neighbourhood suits your routines. Those realities belong in the decision from the beginning.
          </p>
          <a class="btn btn--primary" href="contact.php">Discuss the Right Location</a>
        </div>
        <ol class="choose__list">
          <li data-reveal>
            <div>
              <h3>Define the purpose</h3>
              <p>A home, an investment or both&mdash;the answer changes the search.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Balance use and return</h3>
              <p>Daily convenience and investment performance do not always point to the same place.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Test the connections</h3>
              <p>Consider real travel times to work, schools and airports, not distance on a map.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Examine what the budget buys</h3>
              <p>Establish what the same capital secures in ready and off-plan markets.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Set a realistic shortlist</h3>
              <p>Keep only the locations where lifestyle, value and timing make a coherent case.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Move forward with certainty</h3>
              <p>Take the chosen location through viewings, due diligence and documentation.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="faq section section--gray" aria-labelledby="faq-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Common Questions</p>
          <h2 id="faq-title">Choosing a community, explained</h2>
        </div>
        <div class="faq__list">
          <details class="faq-item" data-reveal>
            <summary>
              Which UAE communities are well suited to families?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Families often favour master-planned communities with schools, parks and practical connections. The right answer may sit in Dubai, Abu Dhabi, Sharjah, Ajman or elsewhere in the Northern Emirates; daily routines and budget will narrow the field.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              What are my options for waterfront living?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Waterfront living in the UAE ranges from marina towers and island addresses to quieter coastal communities. Each brings a different relationship with access, amenities, price and future supply.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              How do I compare two communities properly?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Start with real travel times, the homes available within budget, amenities you will use and the maturity of the wider neighbourhood. These factors create a more useful basis for a viewing than renders alone.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Can I find both ready and off-plan properties in these areas?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Yes. Established communities often provide ready homes, while newer districts may have more off-plan supply and staged payment plans. The choice depends on timing, certainty and the role of the property in your plans.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Which areas are well suited to investors?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                That depends on whether the priority is income, capital growth or a balance of both. Established central districts and emerging waterfront markets behave differently, so budget and time horizon must be considered together.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              How do I get help choosing?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Arrange a short consultation by phone, WhatsApp or at our Business Bay office. We will turn the brief into a focused location shortlist, with no obligation to proceed.
              </p>
            </div>
          </details>
        </div>
      </div>
      <script type="application/ld+json"><?= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
          ['@type' => 'Question', 'name' => 'Which UAE communities are well suited to families?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Families often favour master-planned communities with schools, parks and practical connections. The right answer may sit in Dubai, Abu Dhabi, Sharjah, Ajman or elsewhere in the Northern Emirates; daily routines and budget will narrow the field.']],
          ['@type' => 'Question', 'name' => 'What are my options for waterfront living?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Waterfront living in the UAE ranges from marina towers and island addresses to quieter coastal communities. Each brings a different relationship with access, amenities, price and future supply.']],
          ['@type' => 'Question', 'name' => 'How do I compare two communities properly?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Start with real travel times, the homes available within budget, amenities you will use and the maturity of the wider neighbourhood. These factors create a more useful basis for a viewing than renders alone.']],
          ['@type' => 'Question', 'name' => 'Can I find both ready and off-plan properties in these areas?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. Established communities often provide ready homes, while newer districts may have more off-plan supply and staged payment plans. The choice depends on timing, certainty and the role of the property in your plans.']],
          ['@type' => 'Question', 'name' => 'Which areas are well suited to investors?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'That depends on whether the priority is income, capital growth or a balance of both. Established central districts and emerging waterfront markets behave differently, so budget and time horizon must be considered together.']],
          ['@type' => 'Question', 'name' => 'How do I get help choosing?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Arrange a short consultation by phone, WhatsApp or at our Business Bay office. We will turn the brief into a focused location shortlist, with no obligation to proceed.']],
        ],
      ], JSON_UNESCAPED_SLASHES) ?></script>
    </section>

    <!-- ============ Final call to action ============ -->
    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/hero-lagoon-aerial.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get in Touch</p>
        <h2 id="cta-title" data-reveal>Find the location that fits the brief</h2>
        <p class="cta-final__sub" data-reveal>
          Share the practical needs as well as the longer-term ambition. We will identify the UAE locations that warrant a closer look.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="contact.php#enquire">Build Your Location Shortlist</a>
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
