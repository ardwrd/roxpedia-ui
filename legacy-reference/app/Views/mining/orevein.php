<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ore Vein - Level <?= htmlspecialchars((string)(int)preg_replace('/\D/', '', (string)$level)) ?></title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">

  <style>
    .page-header-card {
      background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.08), transparent 55%);
      border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .pill-badge {
      border-radius: 999px;
      padding-inline: .9rem;
      padding-block: .35rem;
      font-size: .8rem;
    }

    .table-sm td,
    .table-sm th {
      padding-top: .4rem;
      padding-bottom: .4rem;
    }
  </style>
</head>

<body class="bg-body-tertiary">

  <div class="container py-4">
    <?= view('partials/site_header') ?>

    <main class="col-lg-12">

      <?php
      // Normalisasi level (1-16)
      $levelInt = (int)preg_replace('/\D/', '', (string)$level);
      if ($levelInt < 1) $levelInt = 1;
      if ($levelInt > 16) $levelInt = 16;

      // Bangun list dari hasil JOIN MiningModel
      $list = [];
      if (!empty($itemsByLevel) && is_array($itemsByLevel)) {
        foreach ($itemsByLevel as $row) {
          $rate  = isset($row['rate_value']) ? (float)$row['rate_value'] : 0.0;
          if ($rate <= 0) {
            continue;
          }

          $raw   = $row['rate_raw'] ?? (number_format($rate, 2) . '%');
          $nameId  = $row['item_name_id'] ?? '';
          $nameEn  = $row['item_name_en'] ?? '';
          $label   = $row['mining_label'] ?? '';

          // Prioritas nama: Indo -> English -> label mining
          $displayName = $nameId !== '' ? $nameId : ($nameEn !== '' ? $nameEn : $label);

          $list[] = [
            'displayName'  => $displayName,
            'mining_label' => $label,
            'raw'          => $raw,
            'rate'         => $rate,
            'item_id'      => (int)($row['item_id'] ?? 0),
            'image_file'   => $row['image_file'] ?? null,
          ];
        }
      }

      // Sort: Nothing/Failed/Spirit dulu, lalu rate tertinggi
      usort($list, static function ($a, $b) {
        $aLabel = strtolower($a['mining_label']);
        $bLabel = strtolower($b['mining_label']);

        $aIsNothing = str_contains($aLabel, 'nothing') || str_contains($aLabel, 'failed') || str_contains($aLabel, 'spirit');
        $bIsNothing = str_contains($bLabel, 'nothing') || str_contains($bLabel, 'failed') || str_contains($bLabel, 'spirit');

        if ($aIsNothing && !$bIsNothing) return -1;
        if (!$aIsNothing && $bIsNothing) return 1;

        if ($a['rate'] === $b['rate']) {
          return strcasecmp($a['displayName'], $b['displayName']);
        }

        return $b['rate'] <=> $a['rate'];
      });

      $totalItems   = count($list);
      $highestRate  = 0.0;
      $highestName  = '-';

      // Cari drop non-"Nothing" dengan rate tertinggi
      foreach ($list as $item) {
        $lbl = strtolower($item['mining_label']);
        $isNothing = str_contains($lbl, 'nothing') || str_contains($lbl, 'failed') || str_contains($lbl, 'spirit');
        if ($isNothing) continue;

        $highestRate = $item['rate'];
        $highestName = $item['displayName'];
        break;
      }
      ?>

      <?php if (!empty($list)): ?>

        <section class="mb-4">
          <div class="card page-header-card shadow-sm">
            <div class="card-body d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3">

              <div class="d-flex align-items-center gap-3">
                <div>
                  <h3 class="mb-1">Ore Vein - Level <?= $levelInt ?></h3>
                  <p class="mb-0 text-secondary" style="font-size:.9rem;">Check drop rates and simulate expected yields.</p>
                </div>
              </div>

              <div class="ms-md-auto d-flex flex-wrap gap-2">
                <span class="pill-badge bg-primary text-body">Level <?= $levelInt ?></span>
                <span class="pill-badge bg-secondary text-body"><?= $totalItems ?> items</span>
                <a href="<?= site_url('mining'); ?>" class="btn btn-outline-secondary btn-sm">
                  <i class="fa-solid fa-arrow-left-long me-1"></i> Back
                </a>
              </div>

            </div>
          </div>
        </section>

        <section class="mb-4">
          <div class="row g-4">

            <div class="col-lg-6">
              <div class="card shadow-sm h-100">
                <div class="card-body">
                  <h5 class="card-title mb-3">Mining Simulator</h5>
                  <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                      <label class="form-label">Total Stamina</label>
                      <input type="number" id="inpStamina" class="form-control" value="240" min="0">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Stamina / Attempt</label>
                      <div class="form-control-plaintext fw-semibold" id="labCost">-</div>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Attempts</label>
                      <div class="form-control-plaintext fw-semibold" id="labAttempts">0</div>
                    </div>
                  </div>
                  <p class="text-secondary mt-3 mb-0" style="font-size:.85rem;">
                    pcs = floor(attempts * (rate / 100))
                    <br>Cost: Lv1-5=2, Lv6-9=3, Lv10-16=4.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card shadow-sm h-100">
                <div class="card-body">
                  <h5 class="card-title mb-3">Level Summary</h5>
                  <ul class="list-unstyled mb-0" style="font-size:.9rem;">
                    <li class="mb-2">Total items: <b><?= $totalItems ?></b></li>
                    <li class="mb-2">Highest drop: <b><?= htmlspecialchars($highestName) ?></b> (<?= number_format($highestRate, 2) ?>%)</li>
                    <li>Sorting: Nothing -> Highest rate -> Lowest</li>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </section>

        <section class="mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-2">Drop List</h5>

              <div class="table-responsive mt-3">
                <table class="table table-sm align-middle">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th style="width:20%;">Drop Rate</th>
                      <th style="width:25%;">Expected</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($list as $item): ?>
                      <?php
                      $lblLower  = strtolower($item['mining_label']);
                      $isNothing = str_contains($lblLower, 'nothing') || str_contains($lblLower, 'failed') || str_contains($lblLower, 'spirit');
                      ?>
                      <tr>
                        <td class="fw-semibold">
                      <?php $itemId = (int)($item['item_id'] ?? 0); ?>
                          <?php $itemUrl = $itemId > 0 ? site_url('items/detail/' . $itemId) : null; ?>
                          <?php if ($itemUrl): ?>
                            <a href="<?= esc($itemUrl) ?>" class="text-decoration-none text-reset">
                            <?php endif; ?>
                            <div class="d-flex align-items-center gap-2">
                              <?php if (!empty($item['image_file'])): ?>
                                <img src="/assets/img/items/<?= htmlspecialchars($item['image_file']) ?>"
                                  alt="<?= htmlspecialchars($item['displayName']) ?>"
                                  width="32" height="32" style="image-rendering: pixelated;">
                              <?php endif; ?>
                              <span><?= htmlspecialchars($item['displayName']) ?></span>
                              <?php if ($isNothing): ?>
                                <span class="badge bg-outline-danger text-danger border border-danger ms-2" style="font-size:.7rem;">
                                  Failed / Nothing / Spirit Stone
                                </span>
                              <?php endif; ?>
                            </div>
                            <?php if ($itemUrl): ?>
                            </a>
                          <?php endif; ?>
                        </td>
                        <td><span class="badge text-bg-success"><?= htmlspecialchars($item['raw']) ?></span></td>
                        <td><span class="item-pcs" data-rate="<?= htmlspecialchars((string)$item['rate']) ?>">~ 0 pcs</span></td>
                      </tr>
                    <?php endforeach; ?>

                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </section>

      <?php else: ?>
        <p>No items found.</p>
      <?php endif; ?>

    </main>

    <?= view('partials/site_footer') ?>

  </div>

  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    (function() {
      const inpStamina = document.getElementById('inpStamina');
      const labCost = document.getElementById('labCost');
      const labAttempts = document.getElementById('labAttempts');
      const pcsNodes = Array.from(document.querySelectorAll('.item-pcs'));
      const LEVEL = <?= json_encode($levelInt) ?>;

      function staminaCost(level) {
        if (level >= 10) return 4;
        if (level >= 6) return 3;
        return 2;
      }

      function recalc() {
        const cost = staminaCost(LEVEL);
        const stamina = Math.max(0, Math.floor(Number(inpStamina.value || 0)));
        const attempts = Math.floor(stamina / cost);
        labCost.textContent = cost;
        labAttempts.textContent = attempts;
        pcsNodes.forEach(el => {
          const rate = Number(el.dataset.rate || 0);
          const pcs = Math.floor(attempts * (rate / 100));
          el.textContent = '~ ' + pcs + ' pcs';
        });
      }

      inpStamina.addEventListener('input', recalc);
      recalc();
    })();
  </script>

</body>

</html>

