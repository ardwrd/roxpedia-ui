<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="Fishing spot details for <?= esc($location); ?> in Ragnarok X Next Generation. Check bait, drop rates, and expected catch.">
  <meta name="keywords" content="ROX Fishing, Ragnarok X Fishing, Fishing Spot, <?= esc($location); ?>, Bait, Drop Rate, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <title>ROXPEDIA - Fishing Spot: <?= esc($location); ?></title>

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
        <div class="col-12 col-lg-10">
          <!-- Fishing Setup Card -->
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2">
              <div class="d-flex align-items-center">
                <i class="fa-solid fa-sliders me-2 text-info"></i>
                <h5 class="mb-0">Fishing Calculator</h5>
              </div>
            </div>

            <div class="card-body">
              <div class="row g-3">
                <!-- Bait Selection -->
                <div class="col-12 col-md-6">
                  <label for="baitSelect" class="form-label fw-semibold">
                    <i class="fa-solid fa-worm me-1"></i>Bait Selection
                  </label>
                  <select id="baitSelect" class="form-select">
                    <?php foreach ($baits as $index => $bait): ?>
                      <option value="<?= (int) $bait['index']; ?>" <?= $index === 0 ? 'selected' : ''; ?>>
                        <?= esc($bait['name']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <div class="form-text small mt-1 text-secondary">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Each bait has different drop rates for fish.
                  </div>
                </div>

                <!-- Stamina Input - SEDERHANA -->
                <div class="col-12 col-md-6">
                  <label for="staminaInput" class="form-label fw-semibold">
                    <i class="fa-solid fa-battery-full me-1"></i>Total Stamina
                  </label>
                  <div class="input-group">
                    <input type="number" id="staminaInput" class="form-control" value="240" min="0" step="10">
                    <span class="input-group-text bg-body-tertiary border-secondary">stamina</span>
                  </div>
                  <div class="form-text small mt-1 text-secondary">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Consumes <?= $staminaPerCast; ?> stamina per cast
                  </div>
                </div>
              </div>

              <!-- Stats Overview -->
              <div class="row g-3 mt-4 pt-3 border-top border-secondary">
                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-fire me-1"></i>Stamina / Cast
                      </div>
                      <div class="fs-5 fw-bold text-warning" id="staminaPerCastLabel"><?= $staminaPerCast; ?></div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-fishing-rod me-1"></i>Total Casts
                      </div>
                      <div class="fs-5 fw-bold text-info" id="castsLabel">0</div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-star me-1"></i>EXP per Cast
                      </div>
                      <div class="fs-5 fw-bold text-success">+<?= $expPerCast; ?></div>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-3">
                      <div class="text-secondary small mb-2">
                        <i class="fa-solid fa-chart-line me-1"></i>Total EXP
                      </div>
                      <div class="fs-5 fw-bold text-success" id="expLabel">0</div>
                    </div>
                  </div>
                </div>


                <!-- TOMBOL BACK DISIMPAN DISINI - TIDAK TERLIHAT JECK -->
                <div class="mt-4 pt-3 border-top border-secondary">
                  <a href="<?= site_url('fishing'); ?>" class="btn btn-outline-secondary w-100">
                    <i class="fa-solid fa-arrow-left me-1"></i>
                    Back to All Fishing Spots
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Two Column Layout for Additional Compensation and Drop Table -->
          <div class="row g-4">
            <!-- Additional Compensation -->
            <div class="col-12 col-lg-4">
              <div class="card border-secondary h-100">
                <div class="card-header bg-body-tertiary border-secondary py-2">
                  <div class="d-flex align-items-center">
                    <i class="fa-solid fa-gift me-2 text-warning"></i>
                    <h5 class="mb-0">Additional Compensation</h5>
                  </div>
                </div>

                <div class="card-body">
                  <p class="small text-secondary mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    These items have a chance to drop regardless of the fish you catch.
                  </p>

                  <div class="list-group list-group-flush">
                    <?php foreach ($additionalComp as $row): ?>
                      <div class="list-group-item bg-transparent border-bottom border-secondary d-flex justify-content-between align-items-center px-0 py-2">
                        <div class="d-flex align-items-center">
                          <?php if (!empty($row['image_file'])): ?>
                            <img src="<?= base_url('assets/img/items/' . $row['image_file']); ?>"
                              alt="<?= esc($row['name']); ?>"
                              class="me-2 border border-secondary rounded"
                              style="width: 28px; height: 28px; object-fit: contain;">
                          <?php endif; ?>
                          <?php if (!empty($row['item_id'])): ?>
                            <a href="<?= site_url('items/detail/' . (int)$row['item_id']); ?>" class="small text-decoration-none text-reset">
                              <?= esc($row['name']); ?>
                            </a>
                          <?php else: ?>
                            <span class="small"><?= esc($row['name']); ?></span>
                          <?php endif; ?>
                        </div>
                        <span class="badge bg-success"><?= number_format((float)$row['rate'], 2); ?>%</span>
                      </div>
                    <?php endforeach; ?>
                  </div>

                </div>
              </div>
            </div>

            <!-- Drop Table -->
            <div class="col-12 col-lg-8">
              <div class="card border-secondary h-100">
                <div class="card-header bg-body-tertiary border-secondary py-2">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <i class="fa-solid fa-table me-2 text-primary"></i>
                      <h5 class="mb-0">Drop Table</h5>
                    </div>
                    <div class="small text-secondary">
                      <i class="fa-solid fa-calculator me-1"></i>
                      Based on selected bait
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <p class="small text-secondary mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Rates and expected pieces update automatically based on bait and stamina.
                  </p>

                  <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                      <thead>
                        <tr>
                          <th style="width: 45%;" class="small fw-semibold">
                            <i class="fa-solid fa-fish me-1"></i>Fish
                          </th>
                          <th style="width: 25%;" class="small fw-semibold text-center">
                            <i class="fa-solid fa-percent me-1"></i>Drop Rate
                          </th>
                          <th style="width: 30%;" class="small fw-semibold text-center">
                            <i class="fa-solid fa-calculator me-1"></i>Expected Pieces
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($fishes as $fish): ?>
                          <?php
                          $img = $fish['fish_image'] ?? null;
                          $name = $fish['fish_name'] ?? '';
                          $itemId = (int)($fish['fish_item_id'] ?? 0);
                          $itemUrl = $itemId > 0 ? site_url('items/detail/' . $itemId) : null;
                          ?>
                          <tr class="fish-row align-middle"
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                            <?php $rateKey = 'bait_' . $i . '_rate'; ?>
                            data-bait-<?= $i; ?>-rate="<?= isset($fish[$rateKey]) && $fish[$rateKey] !== null ? (float) $fish[$rateKey] : 0; ?>"
                            <?php endfor; ?>>
                            <td>
                              <div class="d-flex align-items-center">
                                <?php if ($itemUrl): ?>
                                  <a href="<?= esc($itemUrl); ?>" class="d-flex align-items-center text-decoration-none text-reset">
                                  <?php endif; ?>
                                  <?php if (!empty($img)): ?>
                                    <img src="<?= base_url('assets/img/items/' . $img); ?>"
                                      alt="<?= esc($name); ?>"
                                      class="me-2 border border-secondary rounded"
                                      style="width: 36px; height: 36px; object-fit: contain;">
                                  <?php else: ?>
                                    <div class="me-2 d-flex align-items-center justify-content-center border border-secondary rounded bg-body-tertiary"
                                      style="width: 36px; height: 36px; font-size: 0.8rem;">
                                      <i class="fa-solid fa-fish text-secondary"></i>
                                    </div>
                                  <?php endif; ?>
                                  <span class="small"><?= esc($name); ?></span>
                                  <?php if ($itemUrl): ?>
                                  </a>
                                <?php endif; ?>
                              </div>
                            </td>
                            <td class="text-center">
                              <span class="badge bg-success rate-badge small px-3 py-2">0.00%</span>
                            </td>
                            <td class="text-center">
                              <span class="expected-label small text-body">~ 0 pcs</span>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="mt-3 pt-3 border-top border-secondary">
                    <div class="alert alert-secondary border-secondary small mb-0">
                      <div class="d-flex">
                        <i class="fa-solid fa-lightbulb mt-1 me-2 text-warning"></i>
                        <div>
                          <div class="fw-semibold mb-1">Fishing Tips:</div>
                          <div class="mb-1">- Higher rarity baits generally have better drop rates for rare fish</div>
                          <div class="mb-0">- Adjust stamina to see how many fish you can catch with your available energy</div>
                        </div>
                      </div>
                    </div>
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

    // Fishing Calculator Logic
    (function() {
      const staminaPerCast = <?= $staminaPerCast; ?>;
      const expPerCast = <?= $expPerCast; ?>;
      const baitSelect = document.getElementById('baitSelect');
      const staminaInput = document.getElementById('staminaInput');
      const castsLabel = document.getElementById('castsLabel');
      const expLabel = document.getElementById('expLabel');

      // Format number function (consistent with other scripts)
      const fmt = n => Number(n || 0).toLocaleString('en-US');

      function recalc() {
        const stamina = Math.max(0, Math.floor(Number(staminaInput.value || 0)));
        const casts = staminaPerCast > 0 ? Math.floor(stamina / staminaPerCast) : 0;
        const totalExp = casts * expPerCast;

        castsLabel.textContent = fmt(casts);
        expLabel.textContent = fmt(totalExp);

        const baitIndex = Number(baitSelect.value || 0);

        // Update all fish rows
        document.querySelectorAll('.fish-row').forEach(function(row) {
          const rate = Number(row.getAttribute('data-bait-' + baitIndex + '-rate') || '0');
          const ratePercent = rate * 100;
          const expected = Math.floor(casts * rate);

          const rateBadge = row.querySelector('.rate-badge');
          const expectedLabel = row.querySelector('.expected-label');

          if (rateBadge) {
            rateBadge.textContent = ratePercent.toFixed(2) + '%';
            // Color code based on rate
            if (ratePercent >= 50) {
              rateBadge.className = 'badge bg-success small px-3 py-2';
            } else if (ratePercent >= 20) {
              rateBadge.className = 'badge bg-primary small px-3 py-2';
            } else if (ratePercent >= 5) {
              rateBadge.className = 'badge bg-warning text-dark small px-3 py-2';
            } else {
              rateBadge.className = 'badge bg-secondary small px-3 py-2';
            }
          }

          if (expectedLabel) {
            expectedLabel.textContent = '~ ' + fmt(expected) + ' pcs';
          }
        });

        // Add visual feedback to stamina input
        staminaInput.classList.remove('border-success', 'border-warning', 'border-danger');
        if (stamina >= 500) {
          staminaInput.classList.add('border-success');
        } else if (stamina >= 100) {
          staminaInput.classList.add('border-warning');
        } else if (stamina <= 20) {
          staminaInput.classList.add('border-danger');
        }
      }

      // Event listeners
      baitSelect.addEventListener('change', recalc);
      staminaInput.addEventListener('input', recalc);

      // Initialize calculation
      recalc();

    })();
  </script>
</body>

</html>

