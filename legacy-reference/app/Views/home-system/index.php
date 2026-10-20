<!doctype html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
  <!-- Basic -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Primary SEO -->
  <title><?= lang('HomeSystem.meta_title') ?></title>
  <meta name="description" content="<?= lang('HomeSystem.meta_description') ?>">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <link rel="canonical" href="https://roxpedia.com/home-system">

  <!-- Author -->
  <meta name="author" content="Cherubim">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">
  <meta property="og:title" content="<?= lang('HomeSystem.meta_title') ?>">
  <meta property="og:description" content="<?= lang('HomeSystem.og_description') ?>">
  <meta property="og:url" content="https://roxpedia.com/home-system">
  <meta property="og:image" content="<?= base_url('assets/og-image.png') ?>">
  <meta property="og:image:secure_url" content="<?= base_url('assets/og-image.png') ?>">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="<?= lang('HomeSystem.og_image_alt') ?>">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= lang('HomeSystem.meta_title') ?>">
  <meta name="twitter:description" content="<?= lang('HomeSystem.twitter_description') ?>">
  <meta name="twitter:image" content="<?= base_url('assets/og-image.png') ?>">

  <!-- NOTE:
       - meta keywords & revisit-after intentionally omitted (deprecated for modern SEO)
       - OG image assumes home.png is >= 1200x630; adjust width/height if different
  -->

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>


<body class="bg-body-tertiary">
  <div class="container py-4">
    <!-- HEADER STANDAR -->
    <?= view('partials/site_header') ?>

    <main>
      <!-- TITLE SECTION STANDAR -->
      <div class="pricing-header p-3 pb-md-4 mx-auto text-center mb-4">
        <h1 class="display-5 display-md-4 fw-medium text-body-emphasis mb-3">
          <i class="fa-solid fa-home me-2 text-primary"></i>
          <?= lang('HomeSystem.page_title') ?>
        </h1>
        <p class="col-12 col-md-10 col-lg-8 mx-auto fs-6 text-secondary mb-0">
          <?= lang('HomeSystem.page_description') ?>
        </p>
      </div>

      <!-- MODULES GRID - RESPONSIF -->
      <div class="row justify-content-center g-3 g-md-4">
        <!-- Gardening Card -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-secondary h-100">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-25 rounded p-2 me-3">
                  <i class="fa-solid fa-seedling text-success"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-semibold"><?= lang('HomeSystem.gardening_title') ?></h5>
                  <p class="small text-secondary mb-0 mt-1"><?= lang('HomeSystem.gardening_subtitle') ?></p>
                </div>
              </div>
            </div>

            <div class="card-body d-flex flex-column p-3 p-md-4">
              <p class="text-secondary mb-3 mb-md-4 flex-grow-1">
                <?= lang('HomeSystem.gardening_description') ?>
              </p>

              <div class="mt-auto">
                <a href="<?= site_url('home-system/gardening'); ?>" class="btn btn-success w-100">
                  <i class="fa-solid fa-seedling me-2"></i>
                  <span><?= lang('HomeSystem.gardening_cta') ?></span>
                </a>
              </div>
            </div>

            <div class="card-footer bg-body-tertiary border-secondary py-2">
              <div class="d-flex justify-content-between small text-secondary">
                <span><i class="fa-solid fa-clock me-1"></i> <?= lang('HomeSystem.gardening_footer_left') ?></span>
                <span><i class="fa-solid fa-leaf me-1"></i> <?= lang('HomeSystem.gardening_footer_right') ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Fishing Card -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-secondary h-100">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-25 rounded p-2 me-3">
                  <i class="fa-solid fa-fish text-primary"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-semibold"><?= lang('HomeSystem.fishing_title') ?></h5>
                  <p class="small text-secondary mb-0 mt-1"><?= lang('HomeSystem.fishing_subtitle') ?></p>
                </div>
              </div>
            </div>

            <div class="card-body d-flex flex-column p-3 p-md-4">
              <p class="text-secondary mb-3 mb-md-4 flex-grow-1">
                <?= lang('HomeSystem.fishing_description') ?>
              </p>

              <div class="mt-auto">
                <a href="<?= site_url('home-system/fishing'); ?>" class="btn btn-primary w-100">
                  <i class="fa-solid fa-fish me-2"></i>
                  <span><?= lang('HomeSystem.fishing_cta') ?></span>
                </a>
              </div>
            </div>

            <div class="card-footer bg-body-tertiary border-secondary py-2">
              <div class="d-flex justify-content-between small text-secondary">
                <span><i class="fa-solid fa-battery-full me-1"></i> <?= lang('HomeSystem.fishing_footer_left') ?></span>
                <span><i class="fa-solid fa-water me-1"></i> <?= lang('HomeSystem.fishing_footer_right') ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Mining Card -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-secondary h-100">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-25 rounded p-2 me-3">
                  <i class="fa-solid fa-gem text-warning"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-semibold"><?= lang('HomeSystem.mining_title') ?></h5>
                  <p class="small text-secondary mb-0 mt-1"><?= lang('HomeSystem.mining_subtitle') ?></p>
                </div>
              </div>
            </div>

            <div class="card-body d-flex flex-column p-3 p-md-4">
              <p class="text-secondary mb-3 mb-md-4 flex-grow-1">
                <?= lang('HomeSystem.mining_description') ?>
              </p>

              <div class="mt-auto">
                <a href="<?= site_url('home-system/mining'); ?>" class="btn btn-warning w-100">
                  <i class="fa-solid fa-gem me-2"></i>
                  <span><?= lang('HomeSystem.mining_cta') ?></span>
                </a>
              </div>
            </div>

            <div class="card-footer bg-body-tertiary border-secondary py-2">
              <div class="d-flex justify-content-between small text-secondary">
                <span><i class="fa-solid fa-mountain me-1"></i> <?= lang('HomeSystem.mining_footer_left') ?></span>
                <span><i class="fa-solid fa-hammer me-1"></i> <?= lang('HomeSystem.mining_footer_right') ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Home Level Quests Card -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-secondary h-100">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center">
                <div class="bg-info bg-opacity-25 rounded p-2 me-3">
                  <i class="fa-solid fa-list-check text-info"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-semibold"><?= lang('HomeSystem.quests_title') ?></h5>
                  <p class="small text-secondary mb-0 mt-1"><?= lang('HomeSystem.quests_subtitle') ?></p>
                </div>
              </div>
            </div>

            <div class="card-body d-flex flex-column p-3 p-md-4">
              <p class="text-secondary mb-3 mb-md-4 flex-grow-1">
                <?= lang('HomeSystem.quests_description') ?>
              </p>

              <div class="mt-auto">
                <a href="<?= site_url('home-system/level-quests'); ?>" class="btn btn-info w-100">
                  <i class="fa-solid fa-list-check me-2"></i>
                  <span><?= lang('HomeSystem.quests_cta') ?></span>
                </a>
              </div>
            </div>

            <div class="card-footer bg-body-tertiary border-secondary py-2">
              <div class="d-flex justify-content-between small text-secondary">
                <span><i class="fa-solid fa-stairs me-1"></i> <?= lang('HomeSystem.quests_footer_left') ?></span>
                <span><i class="fa-solid fa-clipboard-check me-1"></i> <?= lang('HomeSystem.quests_footer_right') ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Forge Card -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-secondary h-100">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center">
                <div class="bg-danger bg-opacity-25 rounded p-2 me-3">
                  <i class="fa-solid fa-hammer text-danger"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-semibold"><?= lang('HomeSystem.forge_title') ?></h5>
                  <p class="small text-secondary mb-0 mt-1"><?= lang('HomeSystem.forge_subtitle') ?></p>
                </div>
              </div>
            </div>

            <div class="card-body d-flex flex-column p-3 p-md-4">
              <p class="text-secondary mb-3 mb-md-4 flex-grow-1">
                <?= lang('HomeSystem.forge_description') ?>
              </p>

              <div class="mt-auto">
                <a href="<?= site_url('home-system/forge'); ?>" class="btn btn-danger w-100">
                  <i class="fa-solid fa-hammer me-2"></i>
                  <span><?= lang('HomeSystem.forge_cta') ?></span>
                </a>
              </div>
            </div>

            <div class="card-footer bg-body-tertiary border-secondary py-2">
              <div class="d-flex justify-content-between small text-secondary">
                <span><i class="fa-solid fa-house-chimney-window me-1"></i> <?= lang('HomeSystem.forge_footer_left') ?></span>
                <span><i class="fa-solid fa-cubes me-1"></i> <?= lang('HomeSystem.forge_footer_right') ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Furniture DB Card -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-secondary h-100">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-25 rounded p-2 me-3">
                  <i class="fa-solid fa-couch text-warning"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-semibold"><?= lang('HomeSystem.furniture_title') ?></h5>
                  <p class="small text-secondary mb-0 mt-1"><?= lang('HomeSystem.furniture_subtitle') ?></p>
                </div>
              </div>
            </div>

            <div class="card-body d-flex flex-column p-3 p-md-4">
              <p class="text-secondary mb-3 mb-md-4 flex-grow-1">
                <?= lang('HomeSystem.furniture_description') ?>
              </p>

              <div class="mt-auto">
                <a href="<?= site_url('home-system/furniture'); ?>" class="btn btn-warning w-100">
                  <i class="fa-solid fa-couch me-2"></i>
                  <span><?= lang('HomeSystem.furniture_cta') ?></span>
                </a>
              </div>
            </div>

            <div class="card-footer bg-body-tertiary border-secondary py-2">
              <div class="d-flex justify-content-between small text-secondary">
                <span><i class="fa-solid fa-star me-1"></i> <?= lang('HomeSystem.furniture_footer_left') ?></span>
                <span><i class="fa-solid fa-arrow-trend-up me-1"></i> <?= lang('HomeSystem.furniture_footer_right') ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- QUICK STATS -->
      <div class="row g-3 g-md-4 mt-4 mt-md-5">
        <div class="col-12">
          <div class="card border-secondary">
            <div class="card-header bg-body-tertiary border-secondary py-2">
              <div class="d-flex align-items-center">
                <i class="fa-solid fa-chart-line me-2 text-info"></i>
                <h5 class="mb-0"><?= lang('HomeSystem.overview_title') ?></h5>
              </div>
            </div>

            <div class="card-body p-3">
              <div class="row g-3 g-md-4 text-center">
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="bg-body-tertiary rounded p-3">
                    <div class="text-secondary small mb-2">
                      <i class="fa-solid fa-seedling me-1"></i><?= lang('HomeSystem.stat_gardening_label') ?>
                    </div>
                    <div class="fs-4 fw-bold text-success">15+</div>
                    <div class="text-secondary small"><?= lang('HomeSystem.stat_gardening_value') ?></div>
                  </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                  <div class="bg-body-tertiary rounded p-3">
                    <div class="text-secondary small mb-2">
                      <i class="fa-solid fa-fish me-1"></i><?= lang('HomeSystem.stat_fishing_label') ?>
                    </div>
                    <div class="fs-4 fw-bold text-primary">8+</div>
                    <div class="text-secondary small"><?= lang('HomeSystem.stat_fishing_value') ?></div>
                  </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                  <div class="bg-body-tertiary rounded p-3">
                    <div class="text-secondary small mb-2">
                      <i class="fa-solid fa-gem me-1"></i><?= lang('HomeSystem.stat_mining_label') ?>
                    </div>
                    <div class="fs-4 fw-bold text-warning">10+</div>
                    <div class="text-secondary small"><?= lang('HomeSystem.stat_mining_value') ?></div>
                  </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                  <div class="bg-body-tertiary rounded p-3">
                    <div class="text-secondary small mb-2">
                      <i class="fa-solid fa-list-check me-1"></i><?= lang('HomeSystem.stat_quests_label') ?>
                    </div>
                    <div class="fs-4 fw-bold text-info">50+</div>
                    <div class="text-secondary small"><?= lang('HomeSystem.stat_quests_value') ?></div>
                  </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                  <div class="bg-body-tertiary rounded p-3">
                    <div class="text-secondary small mb-2">
                      <i class="fa-solid fa-hammer me-1"></i><?= lang('HomeSystem.stat_forge_label') ?>
                    </div>
                    <div class="fs-4 fw-bold text-danger">90+</div>
                    <div class="text-secondary small"><?= lang('HomeSystem.stat_forge_value') ?></div>
                  </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                  <div class="bg-body-tertiary rounded p-3">
                    <div class="text-secondary small mb-2">
                      <i class="fa-solid fa-couch me-1"></i><?= lang('HomeSystem.stat_furniture_label') ?>
                    </div>
                    <div class="fs-4 fw-bold text-warning">110+</div>
                    <div class="text-secondary small"><?= lang('HomeSystem.stat_furniture_value') ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- FOOTER STANDAR -->
    <?= view('partials/site_footer') ?>
  </div>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Set current year in footer
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // Mobile optimizations
    document.addEventListener('DOMContentLoaded', function() {
      // Card touch feedback
      const cards = document.querySelectorAll('.card');
      cards.forEach(card => {
        card.style.cursor = 'pointer';
        card.addEventListener('click', function(e) {
          if (!e.target.closest('a, button')) {
            const link = this.querySelector('a.btn');
            if (link) link.click();
          }
        });
      });
    });
  </script>
</body>

</html>

