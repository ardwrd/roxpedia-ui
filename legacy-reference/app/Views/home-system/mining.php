<?php

/** @var array<string, mixed> $rawData */
/** @var array<int> $levelOptions */
$rawData = $rawData ?? [
  'level_options' => [],
  'level_meta' => [],
  'veins' => [],
  'drops' => [],
  'additional_drops' => [],
];
$levelOptions = $levelOptions ?? [];
if (empty($levelOptions) && !empty($rawData['level_options']) && is_array($rawData['level_options'])) {
  $levelOptions = array_map(static fn($v): int => (int) $v, $rawData['level_options']);
}
if (empty($levelOptions)) {
  $levelOptions = [0];
}
sort($levelOptions);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="ROXPEDIA Home System - Mining: levels, vein types, drop rates, and yields.">
  <meta name="keywords" content="ROX Mining, Ragnarok X Mining, Mining Simulator, Ore Veins, Drop Rates, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <title>Home System - Mining | ROXPEDIA</title>

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
          <!-- LEVEL SELECTION CARD -->
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-mountain me-2 text-warning"></i>
                  <h5 class="mb-0">Select Mine Level</h5>
                </div>
                <!-- TOMBOL BACK DI KANAN HEADER -->
                <a href="<?= site_url('home-system'); ?>" class="btn btn-outline-secondary btn-sm">
                  <i class="fa-solid fa-arrow-left me-1"></i>
                  <span class="d-none d-md-inline">Back to Home</span>
                </a>
              </div>
            </div>

            <div class="card-body">
              <!-- LEVEL SELECTION -->
              <div class="mb-4">
                <label for="selLevel" class="form-label fw-semibold">
                  <i class="fa-solid fa-layer-group me-1"></i>Mine Level
                </label>
                <select id="selLevel" class="form-select" aria-label="Mine Level">
                  <?php foreach ($levelOptions as $idx => $levelOpt): ?>
                    <option value="<?= (int) $levelOpt; ?>" <?= $idx === 0 ? 'selected' : ''; ?>>Level <?= (int) $levelOpt; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="form-text small text-secondary mt-1">
                  <i class="fa-solid fa-circle-info me-1"></i>
                  Select mine level to view available vein types and drop rates
                </div>
              </div>

              <!-- META INFORMATION -->
              <div class="card bg-body-tertiary border-secondary mb-0">
                <div class="card-body p-3">
                  <div class="row g-3 text-center">
                    <div class="col-6 col-md-4">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-hill-rockslide me-1"></i>Mine Level
                      </div>
                      <div class="fs-4 fw-bold text-warning" id="metaMineLevel">Level 0</div>
                    </div>

                    <div class="col-6 col-md-4">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-person-digging me-1"></i>Mining Level Required
                      </div>
                      <div class="fs-4 fw-bold text-info" id="metaMiningReq">1</div>
                    </div>

                    <div class="col-12 col-md-4">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-gem me-1"></i>Available Veins
                      </div>
                      <div id="metaVeins" class="d-flex flex-wrap justify-content-center gap-2">
                        <!-- Vein chips will be inserted here -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- DROP RATES BY VEIN CARD -->
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center">
                <i class="fa-solid fa-percent me-2 text-primary"></i>
                <h5 class="mb-0">Drop Rates by Vein</h5>
              </div>
            </div>

            <div class="card-body">
              <div class="row g-3 g-md-4" id="veinColumns">
                <!-- Vein columns will be inserted here -->
              </div>
              <div id="emptyNotice" class="text-center py-5" style="display:none;">
                <i class="fa-solid fa-inbox fa-2x text-secondary mb-3"></i>
                <h6 class="text-secondary">No data for this level yet</h6>
                <p class="text-secondary small mb-0">Select a different mine level to view drop rates</p>
              </div>
            </div>
          </div>

          <!-- ADDITIONAL DROPS CARD -->
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center">
                <i class="fa-solid fa-gift me-2 text-success"></i>
                <h5 class="mb-0">Additional Drops (All Ore Veins)</h5>
              </div>
            </div>

            <div class="card-body">
              <p class="small text-secondary mb-3">
                <i class="fa-solid fa-circle-info me-1"></i>
                These items can drop from any ore vein regardless of type or level.
              </p>

              <div class="row g-3" id="additionalDrops">
                <!-- Additional drops will be inserted here -->
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

    /* ===== Home Mining Data (Dynamic) ===== */
    const HOME_MINING = <?= json_encode(
                          $rawData,
                          JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
                        ); ?>;

    const LEVEL_META = HOME_MINING.level_meta || {};

    const RAW = {
      veins: HOME_MINING.veins || [],
      drops: HOME_MINING.drops || {},
      additionalDrops: HOME_MINING.additional_drops || [],
    };
    /* ===== Elements ===== */
    const selLevel = document.getElementById('selLevel');
    const veinColumns = document.getElementById('veinColumns');
    const emptyNotice = document.getElementById('emptyNotice');
    const addDropsWrap = document.getElementById('additionalDrops');
    const metaMineLevel = document.getElementById('metaMineLevel');
    const metaMiningReq = document.getElementById('metaMiningReq');
    const metaVeins = document.getElementById('metaVeins');
    const itemImageApiUrl = '/home-system/item-images';
    const itemBaseUrl = '/assets/img/items';
    const fallbackItemImage = '/assets/logo.png';

    let itemImageMap = {};

    /* ===== Helper Functions ===== */
    function parsePercent(x) {
      const s = String(x ?? "").replace(/%/g, "").replace(/,/g, ".").trim();
      const v = parseFloat(s);
      return isNaN(v) ? 0 : v;
    }

    function sortByRateDesc(arr) {
      return arr.slice().sort((a, b) => parsePercent(b.rate) - parsePercent(a.rate));
    }

    function getRateColor(rate) {
      const percent = parsePercent(rate);
      if (percent >= 20) return "success";
      if (percent >= 5) return "primary";
      if (percent >= 1) return "warning";
      return "secondary";
    }

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

    function buildItemMedia(name) {
      const wrap = document.createElement('div');
      wrap.className = 'd-flex align-items-center gap-2 min-w-0';

      const img = document.createElement('img');
      img.className = 'rounded flex-shrink-0';
      img.style.width = '22px';
      img.style.height = '22px';
      img.style.objectFit = 'contain';
      img.alt = name;
      img.src = resolveItemImage(name);
      img.onerror = function() {
        this.onerror = null;
        this.src = fallbackItemImage;
      };

      const text = document.createElement('span');
      text.className = 'small text-truncate';
      text.textContent = name;

      wrap.appendChild(img);
      wrap.appendChild(text);
      return wrap;
    }

    function collectItemNames() {
      const names = new Set();
      Object.keys(RAW.drops || {}).forEach((lv) => {
        const veins = RAW.drops[lv] || {};
        Object.keys(veins).forEach((vein) => {
          (veins[vein] || []).forEach((entry) => {
            if (entry && entry.name) names.add(entry.name);
          });
        });
      });
      RAW.additionalDrops.forEach((name) => names.add(name));
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

    /* ===== Render Functions ===== */
    function renderMeta() {
      const lv = String(selLevel.value || "0");
      const metaKeys = Object.keys(LEVEL_META || {});
      const fallbackKey = metaKeys.length > 0 ? metaKeys[0] : lv;
      const fallbackMeta = LEVEL_META[fallbackKey] || {
        miningReq: 0,
        veins: []
      };
      const meta = LEVEL_META[lv] || fallbackMeta;
      const displayLevel = LEVEL_META[lv] ? lv : fallbackKey;

      metaMineLevel.textContent = `Level ${displayLevel}`;
      metaMiningReq.textContent = String(meta.miningReq);

      metaVeins.innerHTML = "";
      meta.veins.forEach(v => {
        const chip = document.createElement('span');
        chip.className = "badge bg-secondary bg-opacity-25 text-body border border-secondary";
        chip.style.fontSize = "0.8rem";
        chip.textContent = v;
        metaVeins.appendChild(chip);
      });
    }

    function renderVeins() {
      const lv = String(selLevel.value || "0");
      veinColumns.innerHTML = "";

      let rendered = 0;
      (LEVEL_META[lv]?.veins || RAW.veins).forEach(vein => {
        const items = (RAW.drops[lv] && RAW.drops[lv][vein]) ? RAW.drops[lv][vein] : [];
        const usable = items.filter(it => parsePercent(it.rate) > 0);
        if (!usable.length) return;

        rendered++;
        const sorted = sortByRateDesc(usable);

        const col = document.createElement('div');
        col.className = "col-12 col-md-6 col-lg-4";

        const card = document.createElement('div');
        card.className = "card bg-body-tertiary border-secondary h-100";

        const cardHeader = document.createElement('div');
        cardHeader.className = "card-header bg-body-tertiary border-secondary py-2";

        const title = document.createElement('h6');
        title.className = "mb-0 d-flex align-items-center";
        title.innerHTML = `<i class="fa-solid fa-gem me-2 text-warning"></i>${vein}`;
        cardHeader.appendChild(title);

        const cardBody = document.createElement('div');
        cardBody.className = "card-body p-3";

        const list = document.createElement('div');
        list.className = "d-flex flex-column gap-2";

        sorted.forEach(it => {
          const row = document.createElement('div');
          row.className = "d-flex justify-content-between align-items-center p-2 bg-body-tertiary bg-opacity-50 rounded";

          const rate = document.createElement('span');
          const pct = parsePercent(it.rate);
          const colorClass = getRateColor(it.rate);
          rate.className = `badge bg-${colorClass} small`;
          rate.textContent = (isFinite(pct) ? pct.toFixed(2) : "0.00") + "%";

          row.appendChild(buildItemMedia(it.name));
          row.appendChild(rate);
          list.appendChild(row);
        });

        cardBody.appendChild(list);
        card.appendChild(cardHeader);
        card.appendChild(cardBody);
        col.appendChild(card);
        veinColumns.appendChild(col);
      });

      emptyNotice.style.display = rendered ? "none" : "block";
    }

    function renderAdditional() {
      addDropsWrap.innerHTML = "";

      RAW.additionalDrops.forEach((t) => {
        const d = document.createElement('div');
        d.className = "col-6 mb-2";

        const item = document.createElement('div');
        item.className = "d-flex align-items-center p-2 bg-body-tertiary rounded";
        item.appendChild(buildItemMedia(t));

        d.appendChild(item);
        addDropsWrap.appendChild(d);
      });
    }

    /* ===== Initialize ===== */
    selLevel.addEventListener('change', () => {
      renderMeta();
      renderVeins();
    });

    // Mobile optimizations
    document.addEventListener('DOMContentLoaded', async function() {
      // Touch-friendly adjustments
      const select = document.getElementById('selLevel');
      select.style.minHeight = '44px';

      await loadItemImages();

      // Initial render
      renderMeta();
      renderVeins();
      renderAdditional();
    });
  </script>
</body>

</html>

