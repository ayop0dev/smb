<?php
/** @var array $article */
require_once __DIR__ . '/../includes/article-data.php';

if (empty($article)) {
    http_response_code(404);
    $page_title = 'Article Not Found — SMB Real Estate Brokers';
    $page_description = 'The requested SMB Real Estate article could not be found.';
    $page_styles = ['assets/css/home.css', 'assets/css/articles.css'];
    require __DIR__ . '/../includes/header.php';
    ?>
    <main id="top" data-neutral-sequence>
      <section class="section" id="not-found" aria-labelledby="not-found-title" data-neutral-section>
        <div class="container">
          <p class="eyebrow">Article</p>
          <h1 id="not-found-title">Article Not Found</h1>
          <p>That article is not available. Return to the article archive to continue reading.</p>
          <a class="btn btn--primary" href="articles.php">View Articles</a>
        </div>
      </section>
    </main>
    <?php
    require __DIR__ . '/../includes/footer.php';
    return;
}

$page_title = $article['title'] . ' — SMB Real Estate Brokers';
$page_description = $article['excerpt'];
$page_og_title = $article['title'];
$page_og_description = $article['excerpt'];
$page_og_image = $article['image'];
$current_page = '';
$skip_link = '#article-content';
$page_styles = [
    'assets/css/home.css',
    'assets/css/articles.css',
];
$breadcrumb_trail = [
    ['label' => 'Articles', 'url' => 'articles.php'],
    ['label' => $article['title']],
];
$related_articles = array_values(array_filter(
    get_all_articles(),
    static fn (array $candidate): bool => $candidate['slug'] !== $article['slug']
));
$related_articles = array_slice($related_articles, 0, 2);
require __DIR__ . '/../includes/header.php';
?>

  <main id="top">
    <article data-neutral-sequence>
      <section class="hero article-hero" aria-labelledby="article-title">
        <img class="hero__bg" src="<?= smb_e($article['image']) ?>" alt="" fetchpriority="high">
        <div class="hero__scrim" aria-hidden="true"></div>
        <div class="container hero__inner">
          <div class="hero__content">
            <?php require __DIR__ . '/../template-parts/breadcrumb.php'; ?>
            <h1 id="article-title"><?= smb_e($article['title']) ?></h1>
          </div>
        </div>
      </section>

      <section class="article-meta" aria-label="Article information" data-neutral-section>
        <div class="container article-meta__inner">
          <span><svg class="icon icon--sm" aria-hidden="true"><use href="#i-calendar"/></svg><time datetime="<?= smb_e($article['date_iso']) ?>"><?= smb_e($article['date']) ?></time></span>
          <span><svg class="icon icon--sm" aria-hidden="true"><use href="#i-clock"/></svg><?= smb_e($article['reading_time']) ?></span>
        </div>
      </section>

      <section class="article-content section" id="article-content" aria-labelledby="article-content-title" data-neutral-section>
        <div class="container article-content__inner">
          <h2 id="article-content-title" class="visually-hidden">Article Content</h2>
          <?= $article['content'] ?>
        </div>
      </section>

      <section class="article-related" aria-labelledby="related-title" data-neutral-section>
        <div class="container">
          <div class="section-head" data-reveal>
            <p class="eyebrow">Keep Reading</p>
            <h2 id="related-title">Related Articles</h2>
          </div>
          <div class="insights__grid">
<?php foreach ($related_articles as $article_card): $article = $article_card; require __DIR__ . '/../template-parts/article-card.php'; endforeach; ?>
          </div>
        </div>
      </section>

      <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
        <img class="cta-final__bg" src="assets/images/gallery-lagoon-beach.jpg" alt="" loading="lazy" aria-hidden="true">
        <div class="container cta-final__inner">
          <p class="eyebrow eyebrow--gold" data-reveal>Get In Touch</p>
          <h2 id="cta-title" data-reveal>Bring A Clearer View To Your Next Move</h2>
          <p class="cta-final__sub" data-reveal>Tell us what the property needs to achieve. We will bring perspective to the decision and care to the work that follows.</p>
          <div class="cta-final__buttons" data-reveal>
            <a class="btn btn--accent btn--lg" href="tel:+971504217299"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>Start A Conversation</a>
            <a class="btn btn--ghost btn--lg" href="https://wa.me/971504217299" target="_blank" rel="noopener"><svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg>WhatsApp Us</a>
          </div>
          <p class="cta-final__contact" data-reveal>Prefer Email? Write To <a href="mailto:info@smbdubai.net">info@smbdubai.net</a></p>
        </div>
      </section>
    </article>
  </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
