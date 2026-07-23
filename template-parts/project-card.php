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
                <a class="comm-card__dev-link" href="<?= htmlspecialchars($card_dev_href, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($card_developer, ENT_QUOTES, 'UTF-8') ?></a>
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
