<?php
/**
 * Shared visible-breadcrumb partial — the rendering half of the unified
 * breadcrumb mechanism (the BreadcrumbList JSON-LD half lives in
 * includes/header.php, driven by the same $breadcrumb_trail).
 *
 * The caller sets $breadcrumb_trail to the same array it set before
 * requiring includes/header.php (segments AFTER Home; the final segment
 * omits 'url' to render as the current, non-linked page), then requires
 * this file wherever the breadcrumb nav belongs in its markup.
 *
 * includes/header.php (for smb_e()) must already be required by the caller.
 * Renders nothing when $breadcrumb_trail is empty (e.g. the homepage).
 */
if (!empty($breadcrumb_trail)):
?>
          <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
              <li><a href="index.php">Home</a></li>
<?php foreach ($breadcrumb_trail as $crumb): ?>
<?php if (!empty($crumb['url'])): ?>
              <li><a href="<?= smb_e((string) $crumb['url']) ?>"><?= smb_e((string) $crumb['label']) ?></a></li>
<?php else: ?>
              <li><span aria-current="page"><?= smb_e((string) $crumb['label']) ?></span></li>
<?php endif; ?>
<?php endforeach; ?>
            </ol>
          </nav>
<?php endif; ?>
