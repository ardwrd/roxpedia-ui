<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="Dream Sand Conversion Calculator shows MVP / Mini Coins obtained and Dream Sand yielded per conversion.">
  <meta name="keywords" content="Ragnarok X, ROX, Dream Sand, MVP Coin, Mini Coin, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <title>ROXPEDIA - Dream Sand Conversion</title>

  <!-- BOOTSTRAP 5.3 ONLY - NO CUSTOM CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <!-- HEADER SAMA PERSIS DENGAN INDEX UTAMA -->
    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-md-11 col-lg-10">
          <div class="row g-4">

            <!-- INPUT CARD -->
            <div class="col-12 col-lg-6">
              <div class="card h-100 border-secondary">
                <div class="card-body">
                  <h5 class="card-title mb-3">
                    <i class="fa-solid fa-sliders me-2"></i>Conversion Input
                  </h5>

                  <!-- Info Alert -->
                  <div class="alert alert-dark border-info mb-4">
                    <div class="d-flex align-items-start">
                      <i class="fa-solid fa-info-circle mt-1 me-2 text-info"></i>
                      <div class="small">
                        <div class="fw-semibold mb-1">Coin Type Rule:</div>
                        <div class="mb-1">- <span class="text-warning">Weapons</span> grant <span class="fw-bold">MVP Coins</span></div>
                        <div>- <span class="text-info">Accessories &amp; Talismans</span> grant <span class="fw-bold">Mini Coins</span></div>
                      </div>
                    </div>
                  </div>

                  <!-- Tier Selection -->
                  <div class="mb-4">
                    <label class="form-label fw-semibold mb-2">
                      <i class="fa-solid fa-layer-group me-2"></i>Tier
                    </label>
                    <select id="tier" class="form-select">
                      <option value="" selected disabled>Select tier</option>
                      <option value="t1">Tier 1</option>
                      <option value="t2">Tier 2</option>
                      <option value="t3">Tier 3</option>
                      <option value="t4">Tier 4</option>
                      <option value="t5">Tier 5</option>
                      <option value="t6">Tier 6</option>
                      <option value="t7">Tier 7</option>
                    </select>
                    <div id="tierHint" class="form-text text-info small mt-2">
                      <i class="fa-solid fa-robot me-1"></i>
                      <span>Select a tier to see available bosses</span>
                    </div>
                  </div>

                  <!-- Equipment Type -->
                  <div>
                    <label class="form-label fw-semibold mb-2">
                      <i class="fa-solid fa-helmet-safety me-2"></i>Equipment Type
                    </label>
                    <select id="equip" class="form-select">
                      <option value="" selected disabled>Select equipment type</option>
                      <option value="1h">1H Weapon</option>
                      <option value="2h">2H Weapon</option>
                      <option value="dagger">Dagger</option>
                      <option value="offhand">Off-Hand Weapon</option>
                      <option value="accessory">Accessory</option>
                      <option value="talisman">Talisman</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- RESULTS CARD -->
            <div class="col-12 col-lg-6">
              <div class="card h-100 border-secondary">
                <div class="card-body">
                  <h5 class="card-title mb-3">
                    <i class="fa-solid fa-chart-bar me-2"></i>Conversion Results
                  </h5>

                  <!-- Default State -->
                  <div id="resultPlaceholder" class="text-center py-5">
                    <i class="fa-solid fa-calculator fa-3x text-secondary mb-3"></i>
                    <h6 class="text-secondary mb-2">Select Tier and Equipment Type</h6>
                    <p class="text-secondary small mb-0">Choose from the dropdowns to see conversion rewards</p>
                  </div>

                  <!-- Results Container -->
                    <div id="resultContainer" class="d-none">
                      <!-- Selected Equipment -->
                      <div class="card bg-body-tertiary border-info mb-4">
                        <div class="card-body">
                          <div class="d-flex flex-column flex-md-row align-items-md-start justify-content-between gap-3 mb-3">
                            <div class="w-100">
                              <div class="small text-uppercase text-secondary mb-1">Selected Setup</div>
                              <h6 id="resultTitle" class="mb-2 fw-bold">-</h6>
                              <p id="bossPreview" class="small text-secondary mb-0">-</p>
                            </div>
                            <div id="coinTypeBadge" class="badge bg-warning text-dark px-3 py-2 flex-shrink-0 fs-6 align-self-md-start">-</div>
                          </div>

                          <div class="border-top pt-3">
                            <button class="btn btn-sm btn-outline-secondary"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#bossListCollapse"
                              aria-expanded="false"
                              aria-controls="bossListCollapse">
                              <i class="fa-solid fa-chevron-down me-1"></i>
                              <span id="bossToggleLabel">Show boss list</span>
                            </button>

                            <div class="collapse mt-3" id="bossListCollapse">
                              <div id="bossFullList" class="d-flex flex-wrap gap-2"></div>
                            </div>
                          </div>

                          <!-- Results Grid -->
                          <div class="row g-3 mt-3">
                          <!-- Coins Obtained -->
                          <div class="col-12 col-md-6">
                            <div class="card bg-body-tertiary border-secondary h-100">
                              <div class="card-body text-center p-3">
                                <div class="text-secondary small mb-2">
                                  <i class="fa-solid fa-coins me-1"></i>Coins Obtained
                                </div>
                                <div id="coinRequired" class="fs-4 fw-bold text-warning mb-1">-</div>
                                <div class="text-secondary small">per conversion</div>
                              </div>
                            </div>
                          </div>

                          <!-- Dream Sand Obtained -->
                          <div class="col-12 col-md-6">
                            <div class="card bg-body-tertiary border-secondary h-100">
                              <div class="card-body text-center p-3">
                                <div class="text-secondary small mb-2">
                                  <i class="fa-solid fa-hourglass-half me-1"></i>Dream Sand Obtained
                                </div>
                                <div id="dreamSand" class="fs-4 fw-bold text-info mb-1">-</div>
                                <div class="text-secondary small">per conversion</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Quick Tips -->
                    <div class="alert alert-dark border-secondary small">
                      <div class="d-flex">
                        <i class="fa-solid fa-lightbulb mt-1 me-2 text-warning"></i>
                        <div>
                          <div class="fw-semibold mb-1">Quick Tips:</div>
                          <div class="mb-1">- Higher tiers require more coins but yield more Dream Sand</div>
                          <div class="mb-0">- 2H weapons require 50% more coins than 1H weapons</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Reset Button -->
                  <div class="mt-4 pt-3 border-top border-secondary">
                    <button class="btn btn-outline-secondary w-100" onclick="resetForm()" type="button">
                      <i class="fa-solid fa-rotate me-2"></i>Reset Form
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>

    <!-- FOOTER SAMA DENGAN INDEX UTAMA -->
    <?= view('partials/site_footer') ?>
  </div>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Set current year in footer
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // ===== Data ============================================================
    const DATA = {
      t1: {
        boss: "Phreeoni / Mistress / Kraken / Eddga / Eclipse / Dragon Fly / Mastering / Ghostring",
        rates: {
          '1h': [540, 108000],
          '2h': [810, 162000],
          'dagger': [405, 81000],
          'offhand': [270, 54000],
          'accessory': [270, 54000],
          'talisman': [540, 108000]
        }
      },
      t2: {
        boss: "Maya / Pharaoh / Orc Hero / Orc Lord / Toad / King Dramoh / Angeling / Deviling",
        rates: {
          '1h': [2700, 203000],
          '2h': [4050, 237000],
          'dagger': [2025, 235000],
          'offhand': [1350, 157000],
          'accessory': [1350, 157000],
          'talisman': [2700, 203000]
        }
      },
      t3: {
        boss: "Amon Ra / Doppelganger / Dark Priest / Vagabond Wolf",
        rates: {
          '1h': [5400, 267000],
          '2h': [8100, 401000],
          'dagger': [4050, 237000],
          'offhand': [2700, 203000],
          'accessory': [2700, 203000],
          'talisman': [5400, 267000]
        }
      },
      t4: {
        boss: "Morroc / Time Holder / Mysteltainn / Chimera",
        rates: {
          '1h': [8100, 401000],
          '2h': [12150, 711000],
          'dagger': [6075, 355000],
          'offhand': [4050, 237000],
          'accessory': [4050, 237000],
          'talisman': [8100, 401000]
        }
      },
      t5: {
        boss: "Lost Dragon / Tao Gunka / Necromancer / Ogretooth",
        rates: {
          '1h': [10800, 535000],
          '2h': [16200, 803000],
          'dagger': [8100, 401000],
          'offhand': [5400, 267000],
          'accessory': [5400, 267000],
          'talisman': [10800, 535000]
        }
      },
      t6: {
        boss: "Fallen Bishop / Lord of the Dead / Naght Sieger / Coelacanth",
        rates: {
          '1h': [13500, 592000],
          '2h': [20250, 889000],
          'dagger': [10125, 444000],
          'offhand': [6750, 296000],
          'accessory': [6750, 296000],
          'talisman': [13500, 592000]
        }
      },
      t7: {
        boss: "Arc Angeling / Goia / RSX / Niddhoggr / Gloom Under Night / Retribution / Observation / Skeggiold / Faceworm Queen / Queen Scaraba / Shelter / Ktullanux",
        rates: {
          '1h': [2700, 203000],
          '2h': [4050, 237000],
          'dagger': [2025, 235000],
          'offhand': [1350, 157000],
          'accessory': [1350, 157000],
          'talisman': [2700, 203000]
        }
      }
    };

    // ===== DOM refs ========================================================
    const tierEl = document.getElementById('tier');
    const equipEl = document.getElementById('equip');
    const tierHint = document.getElementById('tierHint');
    const resultPlaceholder = document.getElementById('resultPlaceholder');
    const resultContainer = document.getElementById('resultContainer');
    const resultTitle = document.getElementById('resultTitle');
    const bossPreview = document.getElementById('bossPreview');
    const bossFullList = document.getElementById('bossFullList');
    const coinTypeBadge = document.getElementById('coinTypeBadge');
    const coinRequired = document.getElementById('coinRequired');
    const dreamSand = document.getElementById('dreamSand');

    // ===== Helpers =========================================================
    const fmt = n => Number(n || 0).toLocaleString('en-US');
    const coinType = t => (t === 'accessory' || t === 'talisman') ? 'Mini Coin' : 'MVP Coin';
    const bossToggleLabel = document.getElementById('bossToggleLabel');

    function escapeHtml(value) {
      return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
    }

    function bossNames(text) {
      return String(text || '')
        .split(' / ')
        .map(name => name.trim())
        .filter(Boolean);
    }

    // ===== Calculate and display results ==================================
    function calculate() {
      if (!tierEl.value || !equipEl.value) {
        resultPlaceholder.classList.remove('d-none');
        resultContainer.classList.add('d-none');
        return;
      }

      const tierData = DATA[tierEl.value];
      const rates = tierData.rates[equipEl.value];
      const coin = rates[0];
      const sand = rates[1];

      resultPlaceholder.classList.add('d-none');
      resultContainer.classList.remove('d-none');

      const bosses = bossNames(tierData.boss);
      const preview = bosses.length > 3
        ? bosses.slice(0, 3).join(' / ') + ' +' + (bosses.length - 3) + ' more'
        : bosses.join(' / ');

      resultTitle.textContent = tierEl.options[tierEl.selectedIndex].text + ' \u2014 ' + equipEl.options[equipEl.selectedIndex].text;
      bossPreview.textContent = bosses.length > 0
        ? 'Boss pool: ' + preview
        : '-';
      bossFullList.innerHTML = bosses.map(name =>
        '<span class="badge rounded-pill bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis fw-normal">' + escapeHtml(name) + '</span>'
      ).join('');
      bossToggleLabel.textContent = 'Show ' + bosses.length + ' bosses';
      coinTypeBadge.textContent = coinType(equipEl.value);
      coinRequired.textContent = fmt(coin);
      dreamSand.textContent = fmt(sand);
    }

    // ===== Update tier hint ===============================================
    function updateTierHint() {
      if (tierEl.value) {
        const bossCount = DATA[tierEl.value].boss.split(' / ').length;
        tierHint.innerHTML = '<i class="fa-solid fa-skull me-1"></i><span>' + tierEl.options[tierEl.selectedIndex].text + ' \u2014 ' + bossCount + ' bosses available</span>';
      } else {
        tierHint.innerHTML = '<i class="fa-solid fa-robot me-1"></i><span>Select a tier to see available bosses</span>';
      }
      calculate();
    }

    // ===== Reset form =====================================================
    function resetForm() {
      tierEl.value = '';
      equipEl.value = '';
      tierHint.innerHTML = '<i class="fa-solid fa-robot me-1"></i><span>Select a tier to see available bosses</span>';
      resultPlaceholder.classList.remove('d-none');
      resultContainer.classList.add('d-none');

      // Tutup collapse boss list jika sedang terbuka
      const collapseEl = document.getElementById('bossListCollapse');
      if (collapseEl) {
        const bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
        if (bsCollapse) bsCollapse.hide();
      }

      bossPreview.textContent = '-';
      bossFullList.innerHTML = '';
      bossToggleLabel.textContent = 'Show boss list';
      tierEl.focus();
    }

    function applyInitialStateFromQuery() {
      const params = new URLSearchParams(window.location.search);
      const tier = params.get('tier');
      const equip = params.get('equip');

      if (tier && DATA[tier]) {
        tierEl.value = tier;
      }

      if (equip && Object.prototype.hasOwnProperty.call(DATA[tierEl.value]?.rates || {}, equip)) {
        equipEl.value = equip;
      }
    }

    // ===== Event listeners ================================================
    tierEl.addEventListener('change', updateTierHint);
    equipEl.addEventListener('change', calculate);

    // Init on load
    document.addEventListener('DOMContentLoaded', function() {
      applyInitialStateFromQuery();
      updateTierHint();
    });
  </script>
</body>

</html>

