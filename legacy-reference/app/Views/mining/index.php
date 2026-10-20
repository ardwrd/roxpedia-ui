<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>ROXPEDIA - Mining Vein Data</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-body-tertiary">

  <div class="container py-4">

    <?= view('partials/site_header') ?>

    <div class="card bg-body-tertiary border-secondary mb-4">
      <div class="card-body d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3">
        <div class="d-flex align-items-center gap-3">
          <div>
            <h3 class="mb-1">Mining Ore Veins</h3>
            <p class="mb-0 text-secondary">
              Browse mining levels and view detailed drop rates for each Ore Vein.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

      <?php foreach ($levelColumns as $column): ?>
        <?php $levelNum = (int)preg_replace('/\D/', '', $column); ?>

        <?php
        if ($levelNum >= 10) $staminaCost = 4;
        elseif ($levelNum >= 6) $staminaCost = 3;
        else $staminaCost = 2;
        ?>

        <div class="col">
          <div class="card h-100 bg-body-tertiary border-secondary shadow-sm">

            <div class="card-body d-flex flex-column">

              <div class="d-flex align-items-center mb-3">
                <img src="<?= base_url('assets/img/pickaxe.png'); ?>" class="me-3" width="42" height="42" alt="Pickaxe">
                <div>
                  <h5 class="mb-0">Level <?= $levelNum ?></h5>
                  <small class="text-secondary">Ore Vein</small>
                </div>
              </div>

              <div class="mt-auto">
                <div class="d-flex justify-content-between mb-2">
                  <span class="text-secondary small">Stamina / attempt</span>
                  <span class="badge bg-secondary"><?= $staminaCost ?></span>
                </div>

                <a href="<?= site_url('orevein/' . $column); ?>"
                  class="btn btn-success w-100 btn-sm">
                  <i class="fa-solid fa-chart-column me-1"></i> View Drop Rates
                </a>
              </div>

            </div>
          </div>
        </div>

      <?php endforeach; ?>

    </div>

    <?= view('partials/site_footer') ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

