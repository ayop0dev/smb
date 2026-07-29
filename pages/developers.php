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

$breadcrumb_trail = [
    ['label' => 'Developers'],
];

require __DIR__ . '/../includes/header.php';
?>

  <main id="top">

    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/projects/six-senses-residences-dubai-marina/webp/01-exterior.webp"
           alt="Aerial View Of A Master-Planned Dubai Community With Lagoons And Villas"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <?php require __DIR__ . '/../template-parts/breadcrumb.php'; ?>
          <h1 id="hero-title">Choose The Project, Not The Sales Agenda</h1>
          <p class="hero__description">
            A Broad UAE Developer Portfolio Creates Genuine Choice. Independence Ensures That Choice Is Narrowed In The Client's Interest&mdash;Not Around A Sales Target Or Commission.
          </p>
        </div>
      </div>
    </section>

    <section class="devs section section--gray" id="developers" aria-labelledby="devs-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Developers</p>
          <h2 id="devs-title">Who We Work With</h2>
        </div>
        <div class="devs__grid">
          <?php foreach (get_all_developers() as $dev_rec): ?>
          <?php
            $dev_slug = $dev_rec['slug'];
            $dev_url = $dev_slug . '.php';
            $dev_display = $dev_rec['display_name'];
            $dev_projects = get_projects_by_developer($dev_rec['canonical_name']);
          ?>
          <?php require __DIR__ . '/../template-parts/developer-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="choose section" aria-labelledby="help-title">
      <div class="container choose__grid">
        <div class="choose__intro" data-reveal>
          <p class="eyebrow">How SMB Helps</p>
          <h2 id="help-title">Independent Of Any Developer Agenda</h2>
          <p>
            Developer Relationships Provide Access. They Do Not Dictate The Advice. Suitability, Value And Risk Determine The Recommendation&mdash;Not Ease Of Sale.
          </p>
          <a class="btn btn--primary" href="contact.php">Compare Developer Options</a>
        </div>
        <ol class="choose__list">
          <li data-reveal>
            <div>
              <h3>Compare Developers Side By Side</h3>
              <p>A Neutral View Of Differences In Delivery History, Finishes, Communities And Terms.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Match Projects To Your Budget</h3>
              <p>The Budget Is Treated As A Boundary, Not An Invitation To Stretch The Brief.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Understand Payment Plans</h3>
              <p>Instalments, Fees, Obligations And Handover Terms Made Clear Before Commitment.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Evaluate Communities Properly</h3>
              <p>Location, Amenities, Connectivity And Day-To-Day Realities Considered Beyond The Brochure.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Support The Complete Buying Journey</h3>
              <p>Continuity Through Reservation, Documentation, Construction Milestones, Handover And Beyond.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get In Touch</p>
        <h2 id="cta-title" data-reveal>Choose With A Clearer View</h2>
        <p class="cta-final__sub" data-reveal>
          Bring Us The Shortlist&mdash;Or Start With A Blank Page. We Will Assess The Relevant Developers, Terms And Communities Against What You Want To Achieve.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="contact.php#enquire">Request An Independent View</a>
          <a class="btn btn--ghost btn--lg" href="https://wa.me/971504217299" target="_blank" rel="noopener">
            <svg class="icon" aria-hidden="true"><use href="#i-whatsapp"/></svg>
            WhatsApp Us
          </a>
        </div>
        <p class="cta-final__contact" data-reveal>
          Prefer Email? Write To <a href="mailto:info@smbdubai.net">info@smbdubai.net</a>
        </p>
      </div>
    </section>
  </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
