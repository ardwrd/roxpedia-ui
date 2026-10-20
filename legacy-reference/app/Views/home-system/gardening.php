<?php

/** @var array<string, mixed> $rawData */
$rawData = $rawData ?? [
  'seeds' => [],
  'gardeningLevel' => [],
  'yield' => [],
  'sowToWater' => [],
  'waterToHarvest' => [],
  'basicDrops' => [],
  'additionalDrops' => [],
  'additionalDropsBySeed' => [],
];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="ROXPEDIA Home System - Gardening module: levels, timings, yields, and drops.">
  <meta name="keywords" content="ROX Gardening, Ragnarok X Gardening, Gardening Simulator, Seed Calculator, Drop Rates, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <!-- OpenGraph -->
  <meta property="og:title" content="ROXPEDIA - Home System: Gardening">
  <meta property="og:description" content="View gardening levels, sow-to-harvest timings, expected yield, and drop lists.">
  <meta property="og:image" content="<?= base_url('assets/og-image.png') ?>">
  <meta property="og:url" content="https://roxpedia.com/home-system/gardening">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ROXPEDIA - Home System: Gardening">
  <meta name="twitter:description" content="View gardening levels, sow-to-harvest timings, expected yield, and drop lists.">
  <meta name="twitter:image" content="<?= base_url('assets/og-image.png') ?>">
  <meta name="twitter:site" content="@ROXPEDIA">

  <title>Home System - Gardening | ROXPEDIA</title>

  <!-- BOOTSTRAP 5.3 ONLY - NO CUSTOM CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <!-- HEADER STANDAR TANPA BACK BUTTON -->
    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <!-- SIMULATOR CARD DENGAN BACK BUTTON DI KANAN HEADER -->
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-calculator me-2 text-success"></i>
                  <h5 class="mb-0">Gardening Simulator</h5>
                </div>
                <!-- TOMBOL BACK DI KANAN HEADER -->
                <a href="<?= site_url('home-system'); ?>" class="btn btn-outline-secondary btn-sm">
                  <i class="fa-solid fa-arrow-left me-1"></i>
                  <span class="d-none d-md-inline">Back to Home</span>
                </a>
              </div>
            </div>

            <div class="card-body">
              <!-- INPUT SECTION -->
              <div class="row g-3 mb-4">
                <!-- Seed Selection -->
                <div class="col-12 col-md-7">
                  <label for="selSeed" class="form-label fw-semibold">
                    <i class="fa-solid fa-seedling me-1"></i>Select Seed
                  </label>
                  <select id="selSeed" class="form-select"></select>
                  <div class="form-text small text-secondary mt-1">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Choose a seed type to view its details
                  </div>
                </div>

                <!-- Plots Input -->
                <div class="col-12 col-md-5">
                  <label for="inpPlots" class="form-label fw-semibold">
                    <i class="fa-solid fa-border-all me-1"></i>Plots (Seeds)
                  </label>
                  <div class="input-group">
                    <input type="number" id="inpPlots" class="form-control" value="1" min="1" max="36" step="1">
                    <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('inpPlots').value = 36">Max</button>
                  </div>
                  <div class="form-text small text-secondary mt-1">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Number of seeds planted simultaneously
                  </div>
                </div>
              </div>

              <!-- STATS OVERVIEW -->
              <div class="row g-3 mb-4 pb-3 border-bottom border-secondary">
                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-2 p-md-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-chart-line me-1"></i>Level
                      </div>
                      <div class="fs-4 fw-bold text-success" id="labLevel">-</div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-2 p-md-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-boxes-packing me-1"></i>Yield per Plant
                      </div>
                      <div class="fs-4 fw-bold text-info" id="labYield">-</div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-2 p-md-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-droplet me-1"></i>Sow â†’ Water
                      </div>
                      <div class="fs-5 fw-bold" id="labSowWater">-</div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-2 p-md-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-hourglass-half me-1"></i>Water â†’ Harvest
                      </div>
                      <div class="fs-5 fw-bold" id="labWaterHarvest">-</div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- TIME SUMMARY -->
              <div class="row g-3 mb-4">
                <div class="col-12 col-md-6">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body p-3">
                      <div class="d-flex align-items-center mb-2">
                        <div class="bg-success bg-opacity-25 rounded p-2 me-3">
                          <i class="fa-solid fa-clock text-success"></i>
                        </div>
                        <div>
                          <div class="text-secondary small">Total Time</div>
                          <div class="fs-4 fw-bold" id="labTotalTime">-</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-6">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body p-3">
                      <div class="d-flex align-items-center mb-2">
                        <div class="bg-info bg-opacity-25 rounded p-2 me-3">
                          <i class="fa-solid fa-calculator text-info"></i>
                        </div>
                        <div>
                          <div class="text-secondary small">Estimated Total Yield</div>
                          <div class="fs-4 fw-bold text-warning" id="labTotalYield">-</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- INFORMATION NOTE -->
              <div class="alert alert-dark border-secondary">
                <div class="d-flex">
                  <i class="fa-solid fa-circle-info mt-1 me-2 text-success"></i>
                  <div>
                    <div class="fw-semibold mb-1">How Plots Work:</div>
                    <div class="mb-0">
                      - "Plots" refers to the number of seeds planted simultaneously.<br>
                      - Example: If yield per plant is <code>15-30</code> and you set <code>Plots = 3</code>,<br>
                      &nbsp;&nbsp;the estimated total yield is <code>45-90</code> items.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- TWO COLUMN LAYOUT FOR DROPS -->
          <div class="row g-4">
            <!-- BASIC DROPS CARD -->
            <div class="col-12 col-lg-6">
              <div class="card border-secondary h-100">
                <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
                  <div class="d-flex align-items-center">
                    <i class="fa-solid fa-leaf me-2 text-primary"></i>
                    <h5 class="mb-0">Basic Drops</h5>
                  </div>
                </div>

                <div class="card-body">
                  <p class="small text-secondary mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Common items that can be obtained from the selected seed.
                  </p>

                  <div class="row g-3">
                    <div class="col-6">
                      <div id="basicLeft" class="d-flex flex-column gap-2"></div>
                    </div>
                    <div class="col-6">
                      <div id="basicRight" class="d-flex flex-column gap-2"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- ADDITIONAL DROPS CARD -->
            <div class="col-12 col-lg-6">
              <div class="card border-secondary h-100">
                <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
                  <div class="d-flex align-items-center">
                    <i class="fa-solid fa-gift me-2 text-warning"></i>
                    <h5 class="mb-0">Additional Drops</h5>
                  </div>
                </div>

                <div class="card-body">
                  <p class="small text-secondary mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Extra items that may appear from certain gardening activities.
                  </p>

                  <div class="row g-3">
                    <div class="col-6">
                      <div id="addLeft" class="d-flex flex-column gap-2"></div>
                    </div>
                    <div class="col-6">
                      <div id="addRight" class="d-flex flex-column gap-2"></div>
                    </div>
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

    // Gardening data from backend
    const RAW = <?= json_encode(
                  $rawData,
                  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
                ); ?>;
    // Elements
    const selSeed = document.getElementById('selSeed');
    const inpPlots = document.getElementById('inpPlots');
    const labLevel = document.getElementById('labLevel');
    const labYield = document.getElementById('labYield');
    const labS2W = document.getElementById('labSowWater');
    const labW2H = document.getElementById('labWaterHarvest');
    const labTotal = document.getElementById('labTotalTime');
    const labTotYld = document.getElementById('labTotalYield');
    const basicLeft = document.getElementById('basicLeft');
    const basicRight = document.getElementById('basicRight');
    const addLeft = document.getElementById('addLeft');
    const addRight = document.getElementById('addRight');
    const itemImageApiUrl = '/home-system/item-images';
    const itemBaseUrl = '/assets/img/items';
    const fallbackItemImage = '/assets/logo.png';

    let itemImageMap = {};

    // Initialize dropdown
    RAW.seeds.forEach((name, i) => {
      const opt = document.createElement('option');
      opt.value = String(i);
      opt.textContent = name;
      selSeed.appendChild(opt);
    });
    selSeed.value = "0";

    function normalizeItemName(name) {
      return String(name || '')
        .replace(/\sx\d+$/i, '')
        .replace(/^Blueprint:\s*/i, '')
        .trim();
    }

    function resolveItemImage(name) {
      const direct = itemImageMap[name];
      if (direct) return `${itemBaseUrl}/${direct}`;

      const normalized = normalizeItemName(name);
      if (normalized && itemImageMap[normalized]) {
        return `${itemBaseUrl}/${itemImageMap[normalized]}`;
      }

      return fallbackItemImage;
    }

    function buildDropRow(name) {
      const row = document.createElement('div');
      row.className = 'd-flex align-items-center p-2 bg-body-tertiary rounded';

      const img = document.createElement('img');
      img.className = 'rounded me-2 flex-shrink-0';
      img.style.width = '24px';
      img.style.height = '24px';
      img.style.objectFit = 'contain';
      img.alt = name;
      img.src = resolveItemImage(name);
      img.onerror = function() {
        this.onerror = null;
        this.src = fallbackItemImage;
      };

      const text = document.createElement('span');
      text.textContent = name;

      row.appendChild(img);
      row.appendChild(text);
      return row;
    }

    function collectItemNames() {
      const names = new Set();
      RAW.basicDrops.forEach((list) => list.forEach((name) => names.add(name)));
      RAW.additionalDrops.forEach((name) => names.add(name));
      (RAW.additionalDropsBySeed || []).forEach((list) => {
        (list || []).forEach((name) => names.add(name));
      });
      return Array.from(names);
    }

    async function loadItemImages() {
      const names = collectItemNames();
      if (!names.length) {
        itemImageMap = {};
        return;
      }

      try {
        const res = await fetch(itemImageApiUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            names
          }),
        });
        if (!res.ok) return;
        const data = await res.json();
        itemImageMap = data && typeof data.map === 'object' && data.map !== null ? data.map : {};
      } catch (err) {
        itemImageMap = {};
      }
    }

    function renderAdditionalDrops(idx) {
      addLeft.innerHTML = '';
      addRight.innerHTML = '';

      const perSeed = Array.isArray(RAW.additionalDropsBySeed) ? (RAW.additionalDropsBySeed[idx] || []) : [];
      const list = perSeed.length > 0 ? perSeed : (RAW.additionalDrops || []);
      const mid = Math.ceil(list.length / 2);

      list.slice(0, mid).forEach((name) => {
        addLeft.appendChild(buildDropRow(name));
      });
      list.slice(mid).forEach((name) => {
        addRight.appendChild(buildDropRow(name));
      });
    }

    // Helper functions (SAMA)
    function parseYieldRange(s) {
      const m = String(s || '').match(/(\d+)\s*-\s*(\d+)/);
      return m ? {
        min: +m[1],
        max: +m[2]
      } : {
        min: 0,
        max: 0
      };
    }

    function parseTimeHM(s) {
      const hM = String(s || '').match(/(\d+)\s*hr/);
      const mM = String(s || '').match(/(\d+)\s*min/);
      return (hM ? +hM[1] : 0) * 60 + (mM ? +mM[1] : 0);
    }

    function fmtHM(min) {
      const h = Math.floor(min / 60);
      const m = min % 60;
      const parts = [];
      if (h > 0) parts.push(`${h} hr`);
      if (m > 0) parts.push(`${m} min`);
      return parts.length > 0 ? parts.join(' ') : '0 min';
    }

    // Render function
    function render() {
      const idx = Number(selSeed.value || 0);

      if (!Array.isArray(RAW.seeds) || RAW.seeds.length === 0) {
        labLevel.textContent = '-';
        labYield.textContent = '-';
        labS2W.textContent = '-';
        labW2H.textContent = '-';
        labTotal.textContent = '-';
        labTotYld.textContent = '-';
        basicLeft.innerHTML = '';
        basicRight.innerHTML = '';
        renderAdditionalDrops(0);
        return;
      }

      let plots = Math.floor(Number(inpPlots.value || 1));

      if (isNaN(plots)) plots = 1;
      if (plots < 1) plots = 1;
      if (plots > 36) plots = 36;
      if (String(plots) !== String(inpPlots.value)) inpPlots.value = String(plots);

      const lvl = RAW.gardeningLevel[idx];
      const yld = parseYieldRange(RAW.yield[idx]);
      const s2w = RAW.sowToWater[idx];
      const w2h = RAW.waterToHarvest[idx];

      // Update stats
      labLevel.textContent = String(lvl);
      labYield.textContent = `${yld.min} - ${yld.max}`;
      labS2W.textContent = s2w;
      labW2H.textContent = w2h;

      const totalMin = parseTimeHM(s2w) + parseTimeHM(w2h);
      labTotal.textContent = fmtHM(totalMin);
      labTotYld.textContent = `${yld.min * plots} - ${yld.max * plots} pcs`;

      // Update basic drops with new styling
      const drops = RAW.basicDrops[idx] || [];
      basicLeft.innerHTML = '';
      basicRight.innerHTML = '';
      const mid = Math.ceil(drops.length / 2);

      drops.slice(0, mid).forEach(t => {
        basicLeft.appendChild(buildDropRow(t));
      });

      drops.slice(mid).forEach(t => {
        basicRight.appendChild(buildDropRow(t));
      });

      renderAdditionalDrops(idx);
    }

    // Event listeners
    selSeed.addEventListener('change', render);
    inpPlots.addEventListener('input', render);

    // Mobile optimizations
    document.addEventListener('DOMContentLoaded', async function() {
      // Touch-friendly adjustments
      const inputs = document.querySelectorAll('select, input');
      inputs.forEach(input => {
        input.style.minHeight = '44px';
      });

      await loadItemImages();

      // Initial render
      render();
    });
  </script>
</body>

</html>

