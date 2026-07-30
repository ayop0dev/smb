<?php
/** @var array $article */
if (empty($article) || empty($article['slug'])) {
    return;
}
?>
<article class="insight-card article-card" data-reveal>
  <a class="insight-card__media article-card__media" href="article.php?slug=<?= smb_e($article['slug']) ?>" aria-label="Read <?= smb_e($article['title']) ?>">
    <img src="<?= smb_e($article['image']) ?>" alt="<?= smb_e($article['image_alt']) ?>" loading="lazy" width="1800" height="1200">
  </a>
  <p class="insight-card__tag"><?= smb_e($article['category']) ?></p>
  <h3><a href="article.php?slug=<?= smb_e($article['slug']) ?>"><?= smb_e($article['title']) ?></a></h3>
  <p class="insight-card__excerpt"><?= smb_e($article['excerpt']) ?></p>
  <div class="article-card__footer">
    <p class="insight-card__date"><time datetime="<?= smb_e($article['date_iso']) ?>"><?= smb_e($article['date']) ?></time><span aria-hidden="true">&middot;</span><?= smb_e($article['reading_time']) ?></p>
    <a class="btn btn--primary btn--sm" href="article.php?slug=<?= smb_e($article['slug']) ?>">Read More <span aria-hidden="true">&rarr;</span></a>
  </div>
</article>
