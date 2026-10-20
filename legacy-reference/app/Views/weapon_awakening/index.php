<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="Weapon Awakening Calculator helps you plan weapon upgrade, refine and enchants to reach every Awakening Tier.">
  <meta name="keywords" content="Ragnarok X, ROX, Weapon Awakening, Awakening Calculator, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <!-- OpenGraph -->
  <meta property="og:title" content="ROXPEDIA - Weapon Awakening Calculator">
  <meta property="og:description" content="Plan your weapon upgrade, refine and enchants to reach Weapon Awakening Tier bonuses.">
  <meta property="og:image" content="<?= base_url('assets/img/weapon-awakening.png'); ?>">
  <meta property="og:url" content="<?= site_url('weapon-awakening'); ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ROXPEDIA - Weapon Awakening Calculator">
  <meta name="twitter:description" content="Plan your weapon upgrade, refine and enchants to reach Weapon Awakening Tier bonuses.">
  <meta name="twitter:image" content="<?= base_url('assets/img/weapon-awakening.png'); ?>">
  <meta name="twitter:site" content="@ROXPEDIA">

  <link rel="canonical" href="<?= site_url('weapon-awakening'); ?>">
  <meta http-equiv="content-language" content="en">

  <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
  <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

  <title>ROXPEDIA - Weapon Awakening Calculator</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <!-- CSRF for AJAX -->
  <script>
    const CSRF_NAME = '<?= csrf_token() ?>';
    let CSRF_HASH = '<?= csrf_hash() ?>';
  </script>
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <!-- Header -->
    <?= view('partials/site_header') ?>

    <main>
      <!-- Page Title Section -->
      <div class="text-center mb-4">
        <h2 class="fw-bold mb-1">Weapon Awakening Calculator</h2>
        <p class="text-secondary mb-0">
          Calculate the total Awakening Score of a single weapon and estimate how many weapons
          you need to reach each Awakening Power Tier.
        </p>
      </div>

      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xxl-9">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
                <div>
                  <h5 class="card-title mb-2">Weapon Awakening</h5>
                  <!-- Static info card about weapon type ratings -->
                  <div class="border rounded p-3 mb-3 bg-body-secondary bg-opacity-25">
                    <div class="fw-semibold small mb-1">Number of Weapon Types</div>
                    <ul class="small mb-1">
                      <li>The Awakening Power per weapon depends on the weapon category:</li>
                    </ul>
                    <ul class="small mb-1 ps-4 mb-1">
                      <li>Two-Handed Weapon: <strong>600</strong></li>
                      <li>One-Handed Weapon: <strong>400</strong></li>
                      <li>Off-hand Weapon: <strong>200</strong></li>
                      <li>Dagger: <strong>300</strong></li>
                    </ul>
                    <p class="small mb-0">
                      For <strong>Daggers</strong>, the <strong>two highest-scoring pieces</strong> are counted for ratings.
                      For all other weapon types, only the <strong>single highest-scoring item</strong> is used.
                    </p>
                  </div>
                  <p class="text-secondary mb-0">

                    <span class="d-block small text-muted">
                      Calculation runs automatically whenever you change any input.
                    </span>
                  </p>
                </div>
              </div>
            </div>

            <div class="card-body pt-0">
              <div class="row g-4">
                <!-- Input -->
                <div class="col-12 col-xl-5">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="mb-3">Weapon Input</h6>

                      <!-- FORM ONLY FOR GATHERING DATA, NEVER SUBMITTED -->
                      <form id="awakeningForm" class="row g-3" onsubmit="return false;">
                        <div class="col-12">
                          <label for="weapon_type" class="form-label">Weapon Type</label>
                          <select class="form-select" id="weapon_type" name="weapon_type" required>
                            <option value="" selected disabled>Select weapon type</option>
                            <?php foreach ($weaponTypes as $type): ?>
                              <option value="<?= esc($type); ?>">
                                <?= esc($type); ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <div class="col-md-6">
                          <label for="upgrade_level" class="form-label">Upgrade Level</label>
                          <input type="number"
                            class="form-control"
                            id="upgrade_level"
                            name="upgrade_level"
                            min="0"
                            max="320"
                            placeholder="e.g. 181">
                          <div class="form-text">Level 0 means no upgrade.</div>
                        </div>

                        <div class="col-md-6">
                          <label for="refine_level" class="form-label">Refine Level</label>
                          <input type="number"
                            class="form-control"
                            id="refine_level"
                            name="refine_level"
                            min="0"
                            max="15"
                            placeholder="0-15">
                          <div class="form-text">Refine 0-15 (follows your Excel table).</div>
                        </div>

                        <hr class="mt-2 mb-1">

                        <div class="col-12">
                          <p class="text-secondary mb-1"><strong>Enchant Lines</strong></p>
                          <div class="small text-secondary mb-2">
                            If a line does not exist, leave the City empty or set Level to <strong>0</strong>.
                          </div>
                        </div>

                        <?php
                        $enchantNames = [
                          1 => 'enchant1',
                          2 => 'enchant2',
                          3 => 'enchant3',
                        ];
                        ?>

                        <?php foreach ($enchantNames as $idx => $prefix): ?>
                          <div class="col-12">
                            <div class="border rounded p-2">
                              <div class="small mb-2 fw-semibold">Enchant Line <?= $idx; ?></div>
                              <div class="row g-2">
                                <div class="col-7">
                                  <select class="form-select form-select-sm" name="<?= $prefix; ?>_city" id="<?= $prefix; ?>_city">
                                    <option value="">(None)</option>
                                    <?php foreach ($cities as $city): ?>
                                      <option value="<?= esc($city); ?>"><?= esc($city); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-5">
                                  <select class="form-select form-select-sm" name="<?= $prefix; ?>_level" id="<?= $prefix; ?>_level">
                                    <?php foreach ($levels as $lvl): ?>
                                      <option value="<?= $lvl; ?>">
                                        <?= $lvl === 0 ? 'Lv 0 (none)' : 'Lv ' . $lvl; ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>

                        <!-- No manual button; everything is auto-calculated -->
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Result -->
                <div class="col-12 col-xl-7">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="mb-3">Results</h6>

                      <!-- AJAX result container -->
                      <div id="awakening-result" class="border rounded p-3 text-secondary">
                        Enter your weapon data (at least select a <strong>Weapon Type</strong>) to see
                        its Awakening Score and the recommended number of weapons for each Tier.
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- row -->
            </div> <!-- card-body -->
          </div> <!-- card -->
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    const fmt = (n) => Number(n || 0).toLocaleString('en-US');

    const resultEl = document.getElementById('awakening-result');
    const formEl = document.getElementById('awakeningForm');

    function renderPlaceholder(message = null) {
      resultEl.innerHTML = `
        <div class="text-secondary">
          ${message ?? 'Enter your weapon data (at least select a <strong>Weapon Type</strong>) to see its Awakening Score and the recommended number of weapons for each Tier.'}
        </div>
      `;
    }

    function renderError(message) {
      resultEl.innerHTML = `
        <div class="alert alert-danger mb-0 py-2">
          ${message}
        </div>
      `;
    }

    function renderResult(data) {
      const res = data.result;
      if (!res) {
        renderPlaceholder();
        return;
      }

      const baseRating = Number(res.baseRating || 0);
      const upgradeScore = Number(res.scores?.upgrade || 0);
      const refineScore = Number(res.scores?.refine || 0);
      const totalScore = Number(res.scores?.total || 0);
      const bestTier = res.bestTierByScore;

      // Enchant lines
      let enchantHtml = '';
      (res.enchant || []).forEach((e, idx) => {
        const line = idx + 1;
        const city = e.city || '';
        const level = Number(e.level || 0);
        const score = Number(e.score || 0);

        if (!city || !level) {
          enchantHtml += `
            <div class="col-md-4">
              <div class="small text-secondary">Enchant Line ${line}</div>
              <div class="small text-secondary">None</div>
            </div>
          `;
        } else {
          enchantHtml += `
            <div class="col-md-4">
              <div class="small text-secondary">Enchant Line ${line}</div>
              <div class="small">
                ${city} Lv ${level}<br>
                Score: <strong>${fmt(score)}</strong>
              </div>
            </div>
          `;
        }
      });

      // Tiers
      const tiers = res.tiers || {};
      const tierKeys = Object.keys(tiers).sort((a, b) => parseInt(a) - parseInt(b));
      let tiersHtml = '';

      tierKeys.forEach((k) => {
        const t = tiers[k];
        const scoreOk = !!t.scoreReached;
        const powerReq = Number(t.powerRequired || 0);
        const scoreReq = Number(t.scoreRequired || 0);
        const singlePower = scoreOk ? Number(t.singlePower || 0) : 0;
        const weaponsNeeded = (t.weaponsNeeded === null || !scoreOk || baseRating === 0) ?
          null :
          Number(t.weaponsNeeded || 0);

        tiersHtml += `
          <tr>
            <td class="fw-semibold">T${t.tier}</td>
            <td>${fmt(scoreReq)}</td>
            <td>${fmt(powerReq)}</td>
            <td>
              ${scoreOk
                ? '<span class="badge bg-success">Score OK</span>'
                : '<span class="badge bg-secondary">Not enough</span>'}
            </td>
            <td>${scoreOk ? fmt(singlePower) : '0'}</td>
            <td>
              ${
                weaponsNeeded === null
                  ? '<span class="text-secondary small">-</span>'
                  : `<strong>${weaponsNeeded}</strong> of this weapon type`
              }
            </td>
          </tr>
        `;
      });

      const bestTierAlert = bestTier ?
        `
          <div class="alert alert-success mt-3 mb-0 py-2">
            Your weapon qualifies for
            <strong>Awakening Tier T${bestTier}</strong>.
          </div>
        ` :
        `
          <div class="alert alert-warning mt-3 mb-0 py-2">
            Total Awakening Score is still below <strong>T1 (250)</strong>, so this weapon
            does not yet contribute Awakening Power to any Tier.
          </div>
        `;

      resultEl.innerHTML = `
        <div class="border rounded p-3 mb-3">
          <div class="row g-2">
            <div class="col-sm-6">
              <div class="text-secondary small">Weapon Type</div>
              <div class="fw-semibold">
                ${res.weaponType || '-'}
              </div>
            </div>
            <div class="col-sm-6">
              <div class="text-secondary small">Base Awakening Power</div>
              <div class="fw-semibold">
                ${fmt(baseRating)}
              </div>
            </div>
            <div class="col-sm-4">
              <div class="text-secondary small">Upgrade Score</div>
              <div class="fw-semibold">${fmt(upgradeScore)}</div>
            </div>
            <div class="col-sm-4">
              <div class="text-secondary small">Refine Score</div>
              <div class="fw-semibold">${fmt(refineScore)}</div>
            </div>
            <div class="col-sm-4">
              <div class="text-secondary small">Total Awakening Score</div>
              <div class="fw-semibold">${fmt(totalScore)}</div>
            </div>
          </div>

          <hr class="my-3">

          <div class="row g-2">
            ${enchantHtml}
          </div>

          ${bestTierAlert}
        </div>

        <h6 class="mb-2">Tier Breakdown</h6>
        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead class="table-dark">
              <tr>
                <th class="text-nowrap">Tier</th>
                <th class="text-nowrap">Score Req.</th>
                <th class="text-nowrap">Power Req.</th>
                <th class="text-nowrap">Score Status</th>
                <th class="text-nowrap">Power / Weapon</th>
                <th class="text-nowrap">Weapons Needed</th>
              </tr>
            </thead>
            <tbody>
              ${tiersHtml}
            </tbody>
          </table>
        </div>
      `;
    }

    let calcTimeout = null;

    async function calculateAwakening() {
      const weaponType = document.getElementById('weapon_type').value;

      if (!weaponType) {
        renderPlaceholder();
        return;
      }

      const formData = new FormData(formEl);
      formData.append(CSRF_NAME, CSRF_HASH);

      resultEl.innerHTML = `
        <div class="text-secondary small">
          Calculating awakening...
          <span class="spinner-border spinner-border-sm ms-1" role="status" aria-hidden="true"></span>
        </div>
      `;

      try {
        const response = await fetch('<?= site_url('weapon-awakening/calculate'); ?>', {
          method: 'POST',
          body: formData,
        });

        if (!response.ok) {
          renderError('Error while calculating awakening (HTTP ' + response.status + ').');
          return;
        }

        const json = await response.json();

        // Update CSRF hash if backend sends a new one
        if (json.csrfHash) {
          CSRF_HASH = json.csrfHash;
        }

        if (!json.ok) {
          renderError(json.message || 'Unable to calculate awakening.');
          return;
        }

        renderResult(json);
      } catch (err) {
        console.error(err);
        renderError('Error while calculating awakening (network error).');
      }
    }

    function scheduleCalculate() {
      clearTimeout(calcTimeout);
      calcTimeout = setTimeout(calculateAwakening, 250);
    }

    // Bind auto-calculate events to all inputs
    document.getElementById('weapon_type').addEventListener('change', scheduleCalculate);
    document.getElementById('upgrade_level').addEventListener('input', scheduleCalculate);
    document.getElementById('refine_level').addEventListener('input', scheduleCalculate);

    ['enchant1', 'enchant2', 'enchant3'].forEach(prefix => {
      const cityEl = document.getElementById(prefix + '_city');
      const levelEl = document.getElementById(prefix + '_level');
      if (cityEl) cityEl.addEventListener('change', scheduleCalculate);
      if (levelEl) levelEl.addEventListener('change', scheduleCalculate);
    });
  </script>
</body>

</html>

