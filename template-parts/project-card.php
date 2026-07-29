<?php
/**
 * Shared project-card markup partial.
 *
 * The caller sets these before each `require` of this file inside its own
 * foreach loop over project records:
 * - $project                         array    current project record
 * - $project_card_fallback_image     string   local fallback image path
 * - $project_card_dev_href_fallback  callable(string $developerName): string
 *                                             href used when no canonical
 *                                             developer record is matched
 *
 * includes/project-card-helpers.php must already be required by the caller.
 */
$card_image = comm_project_card_image($project, $project_card_fallback_image);
$card_name = (string) ($project['name'] ?? '');
$card_location = trim((string) ($project['location_label'] ?? ''));
$card_developer = trim((string) ($project['developer'] ?? ''));
$card_dev_rec = $card_developer !== '' ? get_developer_by_canonical_name($card_developer) : null;
$card_dev_href = $card_dev_rec !== null
    ? ($card_dev_rec['slug'] . '.php')
    : $project_card_dev_href_fallback($card_developer);
$card_types = comm_parse_property_types((string) ($project['hero']['headline'] ?? ''));
$card_href = (string) ($project['slug'] ?? '') . '.php';
?>
          <article class="comm-card" data-reveal>
            <a class="comm-card__media" href="<?= smb_e($card_href) ?>" aria-label="<?= smb_e('View ' . $card_name) ?>">
              <img src="<?= smb_e($card_image['src']) ?>"
                   alt=""
                   loading="lazy" width="900" height="563">
            </a>
            <div class="comm-card__body">
              <h3><a href="<?= smb_e($card_href) ?>"><?= smb_e($card_name) ?></a></h3>
<?php if ($card_developer !== '' || $card_location !== ''): ?>
              <p class="comm-card__desc">
<?php if ($card_developer !== ''): ?>
                <a class="comm-card__dev-link" href="<?= smb_e($card_dev_href) ?>"><?= smb_e($card_developer) ?></a>
<?php endif; ?>
<?php if ($card_developer !== '' && $card_location !== ''): ?> &middot; <?php endif; ?>
<?= smb_e($card_location) ?>
              </p>
<?php endif; ?>
<?php if (!empty($card_types)): ?>
              <ul class="comm-card__types" aria-label="Property Types">
<?php foreach ($card_types as $type): ?>
                <li><svg class="icon" aria-hidden="true"><use href="<?= smb_e(comm_property_type_icon($type)) ?>"/></svg><?= smb_e($type) ?></li>
<?php endforeach; ?>
              </ul>
<?php endif; ?>
              <a class="comm-card__link" href="<?= smb_e($card_href) ?>" aria-label="<?= smb_e('View ' . $card_name . ' Project Details') ?>">
                View Project
                <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>
              </a>
            </div>
          </article>
