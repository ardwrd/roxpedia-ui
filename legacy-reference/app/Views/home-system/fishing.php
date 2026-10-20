<?php

/** @var array<string, mixed> $rawData */
$rawData = $rawData ?? [
  'locations' => [],
  'fishingLevel' => [],
  'yield' => [],
  'toCollect' => [],
  'toMax' => [],
  'basicDrops' => [],
  'additionalDrops' => [],
  'additionalDropsByLocation' => [],
];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="ROXPEDIA Home System - Fishing: levels, timings, yields, and drops.">
  <meta name="keywords" content="ROX Fishing, Ragnarok X Fishing, Fishing Simulator, Fingerlings Calculator, Drop Rates, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <!-- OpenGraph -->
  <meta property="og:title" content="ROXPEDIA - Home System: Fishing">
  <meta property="og:description" content="View fishing levels, timings to collect & max, yield estimation, and drop lists by location.">
  <meta property="og:image" content="<?= base_url('assets/og-image.png') ?>">
  <meta property="og:url" content="<?= site_url('home-system/fishing'); ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ROXPEDIA - Home System: Fishing">
  <meta name="twitter:description" content="View fishing levels, timings to collect & max, yield estimation, and drop lists by location.">
  <meta name="twitter:image" content="<?= base_url('assets/og-image.png') ?>">
  <meta name="twitter:site" content="@ROXPEDIA">

  <title>Home System - Fishing | ROXPEDIA</title>

  <!-- BOOTSTRAP 5.3 ONLY - NO CUSTOM CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <!-- HEADER STANDAR -->
    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <!-- SIMULATOR CARD STANDAR -->
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-calculator me-2 text-primary"></i>
                  <h5 class="mb-0">Fishing Simulator</h5>
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
                <!-- Location Selection -->
                <div class="col-12 col-md-7">
                  <label for="selLoc" class="form-label fw-semibold">
                    <i class="fa-solid fa-location-dot me-1"></i>Fingerlings (Location)
                  </label>
                  <select id="selLoc" class="form-select"></select>
                  <div class="form-text small text-secondary mt-1">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Choose a fishing location to view its details
                  </div>
                </div>

                <!-- Collections Input -->
                <div class="col-12 col-md-5">
                  <label for="inpCollections" class="form-label fw-semibold">
                    <i class="fa-solid fa-boxes-packing me-1"></i>Collections (Fingerlings)
                  </label>
                  <div class="input-group">
                    <input type="number" id="inpCollections" class="form-control" value="1" min="1" max="30" step="1" inputmode="numeric">
                    <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('inpCollections').value = 30">Max</button>
                  </div>
                  <div class="form-text small text-secondary mt-1">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Number of fingerling packs placed simultaneously
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
                      <div class="fs-4 fw-bold text-primary" id="labLevel">-</div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-2 p-md-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-boxes-packing me-1"></i>Yield / Collection
                      </div>
                      <div class="fs-4 fw-bold text-info" id="labYield">-</div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-2 p-md-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-hourglass-start me-1"></i>To Collect
                      </div>
                      <div class="fs-5 fw-bold" id="labToCollect">-</div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-2 p-md-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-hourglass-end me-1"></i>To Max
                      </div>
                      <div class="fs-5 fw-bold" id="labToMax">-</div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- YIELD SUMMARY -->
              <div class="row g-3 mb-4">
                <div class="col-12">
                  <div class="card bg-body-tertiary border-secondary">
                    <div class="card-body p-3">
                      <div class="d-flex align-items-center">
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
                  <i class="fa-solid fa-circle-info mt-1 me-2 text-primary"></i>
                  <div>
                    <div class="fw-semibold mb-1">How Collections Work:</div>
                    <div class="mb-0">
                      - "Collections" refers to the number of fingerling packs placed simultaneously.<br>
                      - Maximum is <code>30</code> packs at once.<br>
                      - Example: If yield per collection is <code>10-25</code> and you set <code>Collections = 30</code>,<br>
                      &nbsp;&nbsp;the estimated total yield is <code>300-750</code> items.
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
                    <i class="fa-solid fa-fish me-2 text-primary"></i>
                    <h5 class="mb-0">Basic Drops</h5>
                  </div>
                </div>

                <div class="card-body">
                  <p class="small text-secondary mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Common items obtainable at the selected fishing location.
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
                    Extra items that may appear from fishing activities.
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

    /** ===== RAW DATA (from your table) ===== */
    const RAW = <?= json_encode(
                  $rawData,
                  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
                ); ?>;
    // Elements
    const selLoc = document.getElementById('selLoc');
    const inpCol = document.getElementById('inpCollections');
    const labLvl = document.getElementById('labLevel');
    const labYld = document.getElementById('labYield');
    const labTC = document.getElementById('labToCollect');
    const labTM = document.getElementById('labToMax');
    const labTot = document.getElementById('labTotalYield');
    const basicLeft = document.getElementById('basicLeft');
    const basicRight = document.getElementById('basicRight');
    const addLeft = document.getElementById('addLeft');
    const addRight = document.getElementById('addRight');
    const itemImageApiUrl = '/home-system/item-images';
    const itemBaseUrl = '/assets/img/items';
    const fallbackItemImage = '/assets/logo.png';

    let itemImageMap = {};

    // Initialize dropdown
    RAW.locations.forEach((name, i) => {
      const opt = document.createElement('option');
      opt.value = String(i);
      opt.textContent = name;
      selLoc.appendChild(opt);
    });
    selLoc.value = "0";

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
      (RAW.additionalDropsByLocation || []).forEach((list) => {
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

      const perLocation = Array.isArray(RAW.additionalDropsByLocation) ? (RAW.additionalDropsByLocation[idx] || []) : [];
      const list = perLocation.length > 0 ? perLocation : (RAW.additionalDrops || []);
      const mid = Math.ceil(list.length / 2);

      list.slice(0, mid).forEach((name) => {
        addLeft.appendChild(buildDropRow(name));
      });
      list.slice(mid).forEach((name) => {
        addRight.appendChild(buildDropRow(name));
      });
    }

    // Helper functions
    function parseYieldRange(s) {
      const m = String(s || '').match(/(\d+)\s*-\s*(\d+)/);
      return m ? {
        min: parseInt(m[1], 10),
        max: parseInt(m[2], 10)
      } : {
        min: 0,
        max: 0
      };
    }

    // Clamp helper to enforce max 30
    function clampCollections(n) {
      n = Math.floor(Number(n || 1));
      if (n < 1) n = 1;
      if (n > 30) n = 30;
      return n;
    }

    function render() {
      const idx = Number(selLoc.value || 0);

      if (!Array.isArray(RAW.locations) || RAW.locations.length === 0) {
        labLvl.textContent = '-';
        labYld.textContent = '-';
        labTC.textContent = '-';
        labTM.textContent = '-';
        labTot.textContent = '-';
        basicLeft.innerHTML = '';
        basicRight.innerHTML = '';
        renderAdditionalDrops(0);
        return;
      }

      const collections = clampCollections(inpCol.value);
      if (String(collections) !== String(inpCol.value)) inpCol.value = String(collections);

      const lvl = RAW.fishingLevel[idx];
      const yld = parseYieldRange(RAW.yield[idx]);
      const tc = RAW.toCollect[idx];
      const tm = RAW.toMax[idx];

      labLvl.textContent = String(lvl);
      labYld.textContent = `${yld.min} - ${yld.max}`;
      labTC.textContent = tc;
      labTM.textContent = tm;

      const totMin = yld.min * collections;
      const totMax = yld.max * collections;
      labTot.textContent = `${totMin} - ${totMax} pcs`;

      // Basic drops dengan styling baru
      const drops = RAW.basicDrops[idx] || [];
      const clean = drops.filter(Boolean);
      basicLeft.innerHTML = '';
      basicRight.innerHTML = '';
      const mid = Math.ceil(clean.length / 2);

      clean.slice(0, mid).forEach(t => {
        basicLeft.appendChild(buildDropRow(t));
      });

      clean.slice(mid).forEach(t => {
        basicRight.appendChild(buildDropRow(t));
      });

      renderAdditionalDrops(idx);
    }

    // Event listeners
    selLoc.addEventListener('change', render);
    inpCol.addEventListener('input', render);

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

