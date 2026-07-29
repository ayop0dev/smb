<?php
$page_title = 'Dubai Communities — SMB Real Estate Brokers L.L.C | Explore by Location';
$page_description = 'Explore Dubai\'s most sought-after communities with SMB Real Estate Brokers — Downtown Dubai, Dubai Marina, Business Bay, Dubai Hills Estate, Palm Jumeirah and Dubai Creek Harbour.';
$page_og_title = 'Dubai Communities — SMB Real Estate Brokers';
$page_og_description = 'Explore Dubai real estate by community — lifestyle, property types and honest guidance on choosing the right location.';
$page_og_image = 'assets/images/projects/damac-riverside-views/webp/01-aerial-view.webp';
$current_page = 'communities';
$skip_link = '#intro';
$page_styles = [
    'assets/css/home.css',
    'assets/css/about.css',
    'assets/css/services.css',
    'assets/css/communities.css',
];
$breadcrumb_trail = [
    ['label' => 'Communities'],
];

require __DIR__ . '/../includes/project-data.php';
require __DIR__ . '/../includes/developer-data.php';
require __DIR__ . '/../includes/header.php';
?>

  <main id="top">

    <section class="hero hero--page" aria-labelledby="hero-title">
      <img class="hero__bg" src="assets/images/projects/damac-riverside-views/webp/01-aerial-view.webp"
           alt="Resort-Style Pool And Palm Trees Overlooking The Sea In Dubai"
           fetchpriority="high">
      <div class="hero__scrim" aria-hidden="true"></div>
      <div class="container hero__inner">
        <div class="hero__content">
          <?php require __DIR__ . '/../template-parts/breadcrumb.php'; ?>
          <h1 id="hero-title">The Right Property Begins With Place</h1>
          <p class="hero__description">
            A Property Can Be Changed. Its Setting Cannot. We Look Across The UAE For Locations That Make Sense Both On An Ordinary Day And Over The Years Ahead.
          </p>
        </div>
      </div>
    </section>

    <section class="comm-intro section" id="intro" aria-labelledby="intro-title">
      <div class="container comm-intro__inner">
        <div data-reveal>
          <p class="eyebrow">Why Location Matters</p>
          <h2 id="intro-title">Place Changes The Whole Equation</h2>
          <p>
            A City Address, An Island Home And A Quieter Coastal Community Each Change The Rhythm Of Daily Life. They Also Carry Different Patterns Of Demand, Supply And Future Growth. Good Location Advice Holds The Emotional And Practical Questions Together.
          </p>
        </div>
      </div>
    </section>

    <?php
      /* Data-driven project archive. Image precedence: hero.image, then the
         first valid gallery image, then the same centralized local
         placeholder project-template.php falls back to (never an external
         URL, never invented). get_all_projects_safe() never triggers a
         page-wide failure — an unavailable dataset degrades to a local
         empty-state message inside this section only. */
      require_once __DIR__ . '/../includes/project-card-helpers.php';

      $comm_project_placeholder = 'assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp';
      $comm_project_fallback_image = is_file(dirname(__DIR__) . '/' . $comm_project_placeholder)
          ? $comm_project_placeholder
          : 'assets/images/projects/grand-polo-club-resort/webp/01-exterior.webp'; // same centralized fallback as project-template.php

      $comm_projects = get_all_projects_safe();

      $project_card_fallback_image = $comm_project_fallback_image;
      $project_card_dev_href_fallback = static function (string $developerName): string {
          return 'developers.php#developer-' . developer_slug($developerName);
      };
    ?>
    <section class="comms section section--gray" id="communities" aria-labelledby="comms-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Featured Communities</p>
          <h2 id="comms-title">A Cross-Section Of UAE Living</h2>
        </div>
<?php if (empty($comm_projects)): ?>
        <p class="section-head__sub">Project Listings Are Currently Unavailable.</p>
<?php else: ?>
        <div class="comms__grid">
<?php foreach ($comm_projects as $project): ?>
<?php require __DIR__ . '/../template-parts/project-card.php'; ?>
<?php endforeach; ?>
        </div>
<?php endif; ?>
      </div>
    </section>

    <section class="lifestyle section section--gray" aria-labelledby="lifestyle-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Explore By Lifestyle</p>
          <h2 id="lifestyle-title">Begin With The Life&mdash;Or Outcome&mdash;You Want</h2>
        </div>
        <div class="categories__grid">
          <a class="category-card" href="#" data-reveal aria-label="Waterfront Living Communities (Filtered View To Be Added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-waves"/></svg></span>
            <span class="category-card__text">
              <h3>Waterfront Living</h3>
              <p>Beaches, Marinas And Lagoon Communities</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Family Communities (Filtered View To Be Added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-users"/></svg></span>
            <span class="category-card__text">
              <h3>Family Communities</h3>
              <p>Parks, Schools And Villa Neighbourhoods</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="City Living Communities (Filtered View To Be Added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-building"/></svg></span>
            <span class="category-card__text">
              <h3>City Living</h3>
              <p>Towers And Districts At The Centre Of It All</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Luxury Destinations (Filtered View To Be Added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-sparkles"/></svg></span>
            <span class="category-card__text">
              <h3>Distinguished Destinations</h3>
              <p>Distinguished Addresses Across The UAE</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Investment Areas (Filtered View To Be Added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-chart"/></svg></span>
            <span class="category-card__text">
              <h3>Investment Areas</h3>
              <p>Areas Assessed For Sustainable Rental Demand</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
          <a class="category-card" href="#" data-reveal aria-label="Emerging Communities (Filtered View To Be Added)">
            <span class="category-card__icon"><svg class="icon" aria-hidden="true"><use href="#i-leaf"/></svg></span>
            <span class="category-card__text">
              <h3>Emerging Communities</h3>
              <p>New Districts Taking Shape Across The Emirates</p>
            </span>
            <span class="category-card__arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span>
          </a>
        </div>
      </div>
    </section>

    <section class="choose section" aria-labelledby="choose-title">
      <div class="container choose__grid">
        <div class="choose__intro" data-reveal>
          <p class="eyebrow">Choosing The Right Community</p>
          <h2 id="choose-title">A Location Decision Grounded In Evidence</h2>
          <p>
            A Render Cannot Tell You How A Weekday Commute Feels, Whether Future Supply May Alter The Market Or If The Neighbourhood Suits Your Routines. Those Realities Belong In The Decision From The Beginning.
          </p>
          <a class="btn btn--primary" href="contact.php">Discuss The Right Location</a>
        </div>
        <ol class="choose__list">
          <li data-reveal>
            <div>
              <h3>Define The Purpose</h3>
              <p>A Home, An Investment Or Both&mdash;The Answer Changes The Search.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Balance Use And Return</h3>
              <p>Daily Convenience And Investment Performance Do Not Always Point To The Same Place.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Test The Connections</h3>
              <p>Consider Real Travel Times To Work, Schools And Airports, Not Distance On A Map.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Examine What The Budget Buys</h3>
              <p>Establish What The Same Capital Secures In Ready And Off-Plan Markets.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Set A Realistic Shortlist</h3>
              <p>Keep Only The Locations Where Lifestyle, Value And Timing Make A Coherent Case.</p>
            </div>
          </li>
          <li data-reveal>
            <div>
              <h3>Move Forward With Certainty</h3>
              <p>Take The Chosen Location Through Viewings, Due Diligence And Documentation.</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="faq faq--centered section section--gray" aria-labelledby="faq-title">
      <div class="container">
        <div class="section-head" data-reveal>
          <p class="eyebrow">Common Questions</p>
          <h2 id="faq-title">Choosing A Community, Explained</h2>
        </div>
        <div class="faq__list">
          <details class="faq-item" data-reveal>
            <summary>
              Which UAE Communities Are Well Suited To Families?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Families Often Favour Master-Planned Communities With Schools, Parks And Practical Connections. The Right Answer May Sit In Dubai, Abu Dhabi, Sharjah, Ajman Or Elsewhere In The Northern Emirates; Daily Routines And Budget Will Narrow The Field.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              What Are My Options For Waterfront Living?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Waterfront Living In The UAE Ranges From Marina Towers And Island Addresses To Quieter Coastal Communities. Each Brings A Different Relationship With Access, Amenities, Price And Future Supply.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              How Do I Compare Two Communities Properly?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Start With Real Travel Times, The Homes Available Within Budget, Amenities You Will Use And The Maturity Of The Wider Neighbourhood. These Factors Create A More Useful Basis For A Viewing Than Renders Alone.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Can I Find Both Ready And Off-Plan Properties In These Areas?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Yes. Established Communities Often Provide Ready Homes, While Newer Districts May Have More Off-Plan Supply And Staged Payment Plans. The Choice Depends On Timing, Certainty And The Role Of The Property In Your Plans.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              Which Areas Are Well Suited To Investors?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                That Depends On Whether The Priority Is Income, Capital Growth Or A Balance Of Both. Established Central Districts And Emerging Waterfront Markets Behave Differently, So Budget And Time Horizon Must Be Considered Together.
              </p>
            </div>
          </details>
          <details class="faq-item" data-reveal>
            <summary>
              How Do I Get Help Choosing?
              <span class="faq-item__indicator" aria-hidden="true"></span>
            </summary>
            <div class="faq-item__body">
              <p>
                Arrange A Short Consultation By Phone, WhatsApp Or At Our Business Bay Office. We Will Turn The Brief Into A Focused Location Shortlist, With No Obligation To Proceed.
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

    <section class="cta-final section" id="enquire" aria-labelledby="cta-title">
      <img class="cta-final__bg" src="assets/images/projects/fahid-island/webp/01-exterior.webp" alt="" loading="lazy" aria-hidden="true">
      <div class="container cta-final__inner">
        <p class="eyebrow eyebrow--gold" data-reveal>Get In Touch</p>
        <h2 id="cta-title" data-reveal>Find The Location That Fits The Brief</h2>
        <p class="cta-final__sub" data-reveal>
          Share The Practical Needs As Well As The Longer-Term Ambition. We Will Identify The UAE Locations That Warrant A Closer Look.
        </p>
        <div class="cta-final__buttons" data-reveal>
          <a class="btn btn--accent btn--lg" href="contact.php#enquire">Build Your Location Shortlist</a>
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
