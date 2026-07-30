<?php
require_once __DIR__ . '/../includes/article-data.php';
$articles = get_all_articles();
$page_title = 'Articles — SMB Real Estate Brokers L.L.C';
$page_description = 'Practical UAE real estate guidance from SMB Real Estate Brokers L.L.C.';
$page_og_title = 'Articles — SMB Real Estate Brokers';
$page_og_description = $page_description;
$current_page = '';
$skip_link = '#articles';
$page_styles = [
    'assets/css/home.css',
    'assets/css/articles.css',
];
$breadcrumb_trail = [
    ['label' => 'Articles'],
];
require __DIR__ . '/../includes/header.php';
?>

  <main id="top" data-neutral-sequence>
    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/hero-lagoon-aerial.jpg" alt="Aerial view of a waterfront residential community in Dubai" fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <?php require __DIR__ . '/../template-parts/breadcrumb.php'; ?>
          <h1 id="hero-title">Perspective For Better Property Decisions</h1>
          <p class="hero__description">Practical notes on buying, investing and choosing a place to live in the UAE.</p>
        </div>
      </div>
    </section>

    <section class="article-archive section" id="articles" aria-labelledby="articles-title" data-neutral-section>
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">SMB Articles</p>
          <h2 id="articles-title">Useful context for the next conversation</h2>
          <p class="section-head__sub">Clear, considered guidance for buyers, investors and families weighing their options across the UAE.</p>
        </div>
        <div class="article-archive__grid">
<?php foreach ($articles as $article): require __DIR__ . '/../template-parts/article-card.php'; endforeach; ?>
        </div>
        <nav class="pagination-placeholder" aria-label="Article Pagination">
          <span class="visually-hidden">Article pagination</span>
          <span aria-current="page">1</span><span>2</span><span>3</span>
        </nav>
      </div>
    </section>

    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/gallery-lagoon-beach.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get In Touch</p>
        <h2 id="cta-title" data-reveal>Begin With The Right Conversation</h2>
        <p class="cta-final__sub" data-reveal>Bring us the property decision you are considering. We will help you make the next step clearer.</p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="tel:+971504217299"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>Start A Conversation</a>
          <a class="btn btn--ghost btn--lg" href="https://wa.me/971504217299" target="_blank" rel="noopener"><svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg>WhatsApp Us</a>
        </div>
        <p class="cta-final__contact" data-reveal>Prefer Email? Write To <a href="mailto:info@smbdubai.net">info@smbdubai.net</a></p>
      </div>
    </section>
  </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
