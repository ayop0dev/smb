<?php
/**
 * Shared project enquiry-form template part.
 *
 * Two variants exist across today's project pages, both rendered through
 * this one file:
 * - 'hero' — compact 3-field form inside the hero price card
 * - 'card' — fuller form (adds an optional message field) used at the
 *            bottom-of-page Enquire section
 *
 * The caller sets these before each `require` of this file:
 * - $enquiry_form_variant          string  'hero' | 'card'
 * - $enquiry_form_instance         string  e.g. 'hero' | 'main' — becomes
 *                                          <form id="{instance}-form">,
 *                                          the exact id assets/js/main.js's
 *                                          setupForm() already looks up
 * - $enquiry_form_field_prefix     string  e.g. 'hf' | 'mf' — prefixes every
 *                                          field id/for/aria-describedby,
 *                                          preserving today's exact field IDs
 *                                          and keeping multiple instances on
 *                                          one page free of duplicate IDs
 * - $enquiry_form_success_message  string  success-panel body copy (this
 *                                          varies per calling page today)
 * - $enquiry_form_privacy_note     string  privacy line shown only in the
 *                                          'hero' variant (also varies per
 *                                          calling page)
 * - $enquiry_form_context          array   source-attribution data. Always:
 *                                          page_title, page_slug, page_url.
 *                                          When available: project_name,
 *                                          project_slug, developer_name.
 *
 * includes/header.php (for smb_e()) must already be required by the caller.
 */
$ef_is_card = $enquiry_form_variant === 'card';
$ef_form_class = $ef_is_card ? 'lead-form lead-form--card' : 'lead-form';
$ef_success_class = $ef_is_card ? 'lead-form__success lead-form__success--card' : 'lead-form__success';
$ef_button_label = $ef_is_card ? 'Send Enquiry' : 'Enquire Now';
$ef_button_class = $ef_is_card ? 'btn btn--accent btn--block btn--lg' : 'btn btn--accent btn--block';
$ef_prefix = $enquiry_form_field_prefix;
$ef_ctx = $enquiry_form_context;
?>
          <form class="<?= smb_e($ef_form_class) ?>" id="<?= smb_e($enquiry_form_instance) ?>-form" novalidate>
            <div class="field">
              <label for="<?= smb_e($ef_prefix) ?>-name">Full Name</label>
              <input type="text" id="<?= smb_e($ef_prefix) ?>-name" name="name" autocomplete="name" placeholder="Your Full Name" required aria-describedby="<?= smb_e($ef_prefix) ?>-name-error">
              <p class="field__error" id="<?= smb_e($ef_prefix) ?>-name-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="<?= smb_e($ef_prefix) ?>-phone">Phone Number</label>
              <input type="tel" id="<?= smb_e($ef_prefix) ?>-phone" name="phone" autocomplete="tel" placeholder="+971 50 000 0000" required aria-describedby="<?= smb_e($ef_prefix) ?>-phone-error">
              <p class="field__error" id="<?= smb_e($ef_prefix) ?>-phone-error" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="<?= smb_e($ef_prefix) ?>-email">Email Address</label>
              <input type="email" id="<?= smb_e($ef_prefix) ?>-email" name="email" autocomplete="email" placeholder="name@example.com" required aria-describedby="<?= smb_e($ef_prefix) ?>-email-error">
              <p class="field__error" id="<?= smb_e($ef_prefix) ?>-email-error" aria-live="polite"></p>
            </div>
<?php if ($ef_is_card): ?>
            <div class="field">
              <label for="<?= smb_e($ef_prefix) ?>-message">Message <span class="field__optional">(Optional)</span></label>
              <textarea id="<?= smb_e($ef_prefix) ?>-message" name="message" rows="4" placeholder="Tell Us What You Are Looking For" aria-describedby="<?= smb_e($ef_prefix) ?>-message-error"></textarea>
              <p class="field__error" id="<?= smb_e($ef_prefix) ?>-message-error" aria-live="polite"></p>
            </div>
<?php endif; ?>
            <input type="hidden" name="source_page_title" value="<?= smb_e((string) ($ef_ctx['page_title'] ?? '')) ?>">
            <input type="hidden" name="source_page_slug" value="<?= smb_e((string) ($ef_ctx['page_slug'] ?? '')) ?>">
            <input type="hidden" name="source_page_url" value="<?= smb_e((string) ($ef_ctx['page_url'] ?? '')) ?>">
<?php if (!empty($ef_ctx['project_name'])): ?>
            <input type="hidden" name="project_name" value="<?= smb_e((string) $ef_ctx['project_name']) ?>">
<?php endif; ?>
<?php if (!empty($ef_ctx['project_slug'])): ?>
            <input type="hidden" name="project_slug" value="<?= smb_e((string) $ef_ctx['project_slug']) ?>">
<?php endif; ?>
<?php if (!empty($ef_ctx['developer_name'])): ?>
            <input type="hidden" name="developer_name" value="<?= smb_e((string) $ef_ctx['developer_name']) ?>">
<?php endif; ?>
            <button type="submit" class="<?= smb_e($ef_button_class) ?>"><?= smb_e($ef_button_label) ?></button>
<?php if (!$ef_is_card && trim((string) $enquiry_form_privacy_note) !== ''): ?>
            <p class="lead-form__privacy"><?= smb_e($enquiry_form_privacy_note) ?></p>
<?php endif; ?>
          </form>
          <div class="<?= smb_e($ef_success_class) ?>" hidden>
            <p class="lead-form__success-title">Thank You</p>
            <p><?= smb_e($enquiry_form_success_message) ?></p>
          </div>
