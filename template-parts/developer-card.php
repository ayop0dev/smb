<?php
/**
 * Shared developer-directory-row markup partial (used on the Developers page).
 *
 * The caller sets these before each `require` of this file inside its own
 * per-developer block:
 * - $dev_rec      array|null  developer record from data/developers.json
 *                             (as returned by get_developer_by_canonical_name())
 * - $dev_slug     string      anchor slug for id="developer-{slug}" — the
 *                             canonical-name-based slug (developer_slug($dev)),
 *                             kept separate from $dev_rec['slug'] because
 *                             external links (e.g. the project card's
 *                             developer-link fallback) target this same slug
 * - $dev_url      string      href to the developer's archive page, already
 *                             resolved by the caller with its existing
 *                             $dev_rec ? … : … fallback
 * - $dev_display  string      display name used in aria-label text, already
 *                             resolved by the caller with its existing
 *                             $dev_rec['display_name'] ?? $dev fallback
 * - $dev_projects array       projects by this developer, from
 *                             get_projects_by_developer() — used only for
 *                             the live-project count shown in the row
 *
 * includes/header.php (for smb_e()) must already be required by the caller.
 */
$dev_card_name = $dev_rec['display_name'] ?? $dev_display;
$dev_card_bio = $dev_rec['biography'] ?? '';
$dev_card_logo = $dev_rec['logo'] ?? '';
$dev_card_project_count = is_array($dev_projects ?? null) ? count($dev_projects) : 0;
$dev_card_project_label = $dev_card_project_count === 1 ? '1 Live Project' : $dev_card_project_count . ' Live Projects';
?>
          <article class="dev-row" id="developer-<?= smb_e($dev_slug) ?>" data-reveal>
            <div class="dev-row__head">
              <span class="dev-row__index" aria-hidden="true"></span>
              <a class="dev-row__logo" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('View ' . $dev_display . ' Developer Archive') ?>">
                <span class="dev-row__logo-mark" style="-webkit-mask-image:url('<?= smb_e($dev_card_logo) ?>'); mask-image:url('<?= smb_e($dev_card_logo) ?>')" aria-hidden="true"></span>
              </a>
              <h3><a href="<?= smb_e($dev_url) ?>"><?= smb_e($dev_card_name) ?></a></h3>
            </div>
            <p class="dev-row__desc"><?= smb_e($dev_card_bio) ?></p>
            <div class="dev-row__meta">
<?php if ($dev_card_project_count > 0): ?>
              <span class="dev-row__count"><?= smb_e($dev_card_project_label) ?></span>
<?php endif; ?>
              <a class="dev-row__link" href="<?= smb_e($dev_url) ?>" aria-label="<?= smb_e('Visit ' . $dev_display . ' Developer Archive') ?>">
                View Developer
                <svg class="icon icon--sm" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>
