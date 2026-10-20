<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ROXPEDIA">
  <meta name="description" content="Gardening detail for <?= esc((string) $location) ?> in Ragnarok X Next Generation. Check plants, stamina usage, and drop rates.">
  <meta name="robots" content="index, follow">
  <title>ROXPEDIA - Gardening: <?= esc((string) $location) ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-sliders me-2 text-success"></i>
                  <h5 class="mb-0">Gardening Calculator</h5>
                </div>
                <a href="<?= site_url('gardening') ?>" class="btn btn-outline-secondary btn-sm">
                  <i class="fa-solid fa-arrow-left me-1"></i>Back to Locations
                </a>
              </div>
            </div>

            <div class="card-body">
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <label for="plantSelect" class="form-label fw-semibold">
                    <i class="fa-solid fa-seedling me-1"></i>Plant Node
                  </label>
                  <select id="plantSelect" class="form-select">
                    <?php foreach ($plants as $idx => $plant): ?>
                      <option value="<?= (int) $idx ?>"><?= esc((string) ($plant['plant_name'] ?? '-')) ?> (Lv <?= (int) ($plant['life_level'] ?? 1) ?>)</option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-12 col-md-6">
                  <label for="staminaInput" class="form-label fw-semibold">
                    <i class="fa-solid fa-battery-full me-1"></i>Total Stamina
                  </label>
                  <div class="input-group">
                    <input type="number" id="staminaInput" class="form-control" value="240" min="0" step="10">
                    <span class="input-group-text bg-body-tertiary border-secondary">stamina</span>
                  </div>
                </div>
              </div>

              <div class="row g-3 mt-3 pt-3 border-top border-secondary">
                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-3">
                      <div class="text-secondary small mb-2"><i class="fa-solid fa-chart-line me-1"></i>Required Level</div>
                      <div class="fs-5 fw-bold text-primary" id="requiredLevelLabel">-</div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-3">
                      <div class="text-secondary small mb-2"><i class="fa-solid fa-fire me-1"></i>Stamina / Gather</div>
                      <div class="fs-5 fw-bold text-warning" id="staminaCostLabel">-</div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-3">
                      <div class="text-secondary small mb-2"><i class="fa-solid fa-seedling me-1"></i>Total Gather</div>
                      <div class="fs-5 fw-bold text-info" id="gatherLabel">0</div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="card bg-body-tertiary border-secondary h-100">
                    <div class="card-body text-center p-3">
                      <div class="text-secondary small mb-2"><i class="fa-solid fa-star me-1"></i>Total EXP</div>
                      <div class="fs-5 fw-bold text-success" id="totalExpLabel">0</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-table me-2 text-primary"></i>
                  <h5 class="mb-0">Drop Table (Main + Additional)</h5>
                </div>
                <div class="small text-secondary" id="selectedPlantLabel">-</div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                  <thead>
                    <tr>
                      <th style="width:42%;">Item</th>
                      <th class="text-center" style="width:18%;">Type</th>
                      <th class="text-center" style="width:18%;">Rate</th>
                      <th class="text-center" style="width:22%;">Expected Pieces</th>
                    </tr>
                  </thead>
                  <tbody id="dropTableBody"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    const PLANTS = <?= json_encode($plants, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

    const plantSelect = document.getElementById('plantSelect');
    const staminaInput = document.getElementById('staminaInput');
    const requiredLevelLabel = document.getElementById('requiredLevelLabel');
    const staminaCostLabel = document.getElementById('staminaCostLabel');
    const gatherLabel = document.getElementById('gatherLabel');
    const totalExpLabel = document.getElementById('totalExpLabel');
    const selectedPlantLabel = document.getElementById('selectedPlantLabel');
    const dropTableBody = document.getElementById('dropTableBody');

    function fmt(n) {
      return Number(n || 0).toLocaleString('en-US');
    }

    function clearDropTable() {
      while (dropTableBody.firstChild) {
        dropTableBody.removeChild(dropTableBody.firstChild);
      }
    }

    function createDropRow(drop, gathers, isAdditional) {
      const tr = document.createElement('tr');

      const tdItem = document.createElement('td');
      const itemWrap = document.createElement('div');
      itemWrap.className = 'd-flex align-items-center';

      if (drop.image_file) {
        const img = document.createElement('img');
        img.src = '<?= base_url('assets/img/items/') ?>' + drop.image_file;
        img.alt = drop.item_name || '';
        img.className = 'me-2 border border-secondary rounded';
        img.style.width = '36px';
        img.style.height = '36px';
        img.style.objectFit = 'contain';
        itemWrap.appendChild(img);
      } else {
        const ph = document.createElement('div');
        ph.className = 'me-2 d-flex align-items-center justify-content-center border border-secondary rounded bg-body-tertiary';
        ph.style.width = '36px';
        ph.style.height = '36px';
        ph.innerHTML = '<i class="fa-solid fa-leaf text-secondary"></i>';
        itemWrap.appendChild(ph);
      }

      const nameSpan = document.createElement('span');
      nameSpan.className = 'small';
      nameSpan.textContent = drop.item_name || '-';
      itemWrap.appendChild(nameSpan);

      const itemId = Number(drop.item_id || 0);
      if (itemId > 0) {
        const link = document.createElement('a');
        link.href = '<?= site_url('items/detail/') ?>' + itemId;
        link.className = 'd-flex align-items-center text-decoration-none text-reset';
        link.appendChild(itemWrap);
        tdItem.appendChild(link);
      } else {
        tdItem.appendChild(itemWrap);
      }

      const tdRate = document.createElement('td');
      tdRate.className = 'text-center';

      const tdType = document.createElement('td');
      tdType.className = 'text-center';
      const typeBadge = document.createElement('span');
      typeBadge.className = isAdditional ? 'badge bg-warning text-dark' : 'badge bg-primary';
      typeBadge.textContent = isAdditional ? 'Additional' : 'Main';
      tdType.appendChild(typeBadge);

      const rateBadge = document.createElement('span');
      rateBadge.className = 'badge bg-success';
      rateBadge.textContent = drop.rate_raw || '0%';
      tdRate.appendChild(rateBadge);

      const tdExpected = document.createElement('td');
      tdExpected.className = 'text-center';
      const expectedSpan = document.createElement('span');
      expectedSpan.className = 'small';
      const ratePct = Number(drop.rate_pct || 0);
      const expected = Math.floor(gathers * (ratePct / 100));
      expectedSpan.textContent = '~ ' + fmt(expected) + ' pcs';
      tdExpected.appendChild(expectedSpan);

      tr.appendChild(tdItem);
      tr.appendChild(tdType);
      tr.appendChild(tdRate);
      tr.appendChild(tdExpected);

      return tr;
    }

    function recalc() {
      const idx = Number(plantSelect.value || 0);
      const plant = PLANTS[idx] || PLANTS[0] || null;

      if (!plant) {
        clearDropTable();
        return;
      }

      const stamina = Math.max(0, Math.floor(Number(staminaInput.value || 0)));
      const staminaCost = Math.max(1, Number(plant.pick_energy || 1));
      const expPerGather = Math.max(0, Number(plant.pick_exp || 0));
      const gathers = Math.floor(stamina / staminaCost);
      const totalExp = Math.floor(gathers * expPerGather);

      requiredLevelLabel.textContent = 'Lv ' + Number(plant.life_level || 1);
      staminaCostLabel.textContent = String(staminaCost);
      gatherLabel.textContent = fmt(gathers);
      totalExpLabel.textContent = fmt(totalExp);
      selectedPlantLabel.textContent = String(plant.plant_name || '-');

      clearDropTable();
      const rows = [];
      const mainDrops = Array.isArray(plant.drops) ? plant.drops : [];
      const additionalDrops = Array.isArray(plant.additional_drops) ? plant.additional_drops : [];

      mainDrops.forEach((drop) => {
        rows.push({
          item_id: Number(drop.item_id || 0),
          item_name: drop.item_name,
          image_file: drop.image_file,
          rate_pct: Number(drop.rate_pct || 0),
          rate_raw: drop.rate_raw,
          isAdditional: false,
        });
      });

      additionalDrops.forEach((drop) => {
        rows.push({
          item_id: Number(drop.item_id || 0),
          item_name: drop.item_name,
          image_file: drop.image_file,
          rate_pct: Number(drop.rate_pct || 0),
          rate_raw: drop.rate_raw,
          isAdditional: true,
        });
      });

      if (rows.length === 0) {
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.colSpan = 4;
        td.className = 'text-center text-secondary py-4';
        td.textContent = 'No drop data.';
        tr.appendChild(td);
        dropTableBody.appendChild(tr);
        return;
      }

      rows.forEach((drop) => {
        dropTableBody.appendChild(createDropRow(drop, gathers, !!drop.isAdditional));
      });
    }

    plantSelect.addEventListener('change', recalc);
    staminaInput.addEventListener('input', recalc);
    recalc();
  </script>
</body>

</html>

