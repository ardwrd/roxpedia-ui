<?php

/** @var array<int, array<string, mixed>> $furniture */
/** @var array<int, string> $subtypeLabels */
/** @var array<int> $qualityOptions */
/** @var array<int> $tierOptions */
/** @var array<string, mixed>|null $topBeautify */

$furniture = $furniture ?? [];
$subtypeLabels = $subtypeLabels ?? [];
$qualityOptions = $qualityOptions ?? [];
$tierOptions = $tierOptions ?? [];
$topBeautify = $topBeautify ?? null;
$itemBaseUrl = '/assets/img/items';
$fallbackFurnitureImage = '/assets/img/items/UI_home_icon_jiaju_lan.png';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="ROXPEDIA Home System - Furniture DB and Beautify optimizer for Prosperity planning.">
  <meta name="robots" content="index, follow">
  <title>Home System - Furniture DB & Beautify Optimizer | ROXPEDIA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <?= view('partials/site_header') ?>

    <main>
      <div class="card border-secondary mb-4">
        <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-chart-simple me-2 text-warning"></i>
              <h5 class="mb-0">Quick Optimizer</h5>
            </div>
            <a href="<?= site_url('home-system'); ?>" class="btn btn-outline-secondary btn-sm">
              <i class="fa-solid fa-arrow-left me-1"></i>
              <span class="d-none d-md-inline">Back to Home</span>
            </a>
          </div>
        </div>
        <div class="card-body">
          <?php $topName = (string) ($topBeautify['name'] ?? '-'); ?>
          <?php $topVal = (int) ($topBeautify['beautify'] ?? 0); ?>
          <?php $topImageFile = (string) ($topBeautify['image_file'] ?? ''); ?>
          <?php $topImageUrl = $topImageFile !== '' ? ($itemBaseUrl . '/' . $topImageFile) : $fallbackFurnitureImage; ?>
          <div class="row g-3 mb-3">
            <div class="col-12 col-md-4">
              <label for="targetProsperity" class="form-label fw-semibold">Target Prosperity</label>
              <input id="targetProsperity" class="form-control" type="number" min="1" step="1" value="1000">
            </div>
            <div class="col-12 col-md-4">
              <label for="optimizerMode" class="form-label fw-semibold">Pool</label>
              <select id="optimizerMode" class="form-select">
                <option value="all">All Furniture</option>
                <option value="craftable">Craftable Only</option>
              </select>
            </div>
            <div class="col-12 col-md-4">
              <label for="optimizerBuildingLevel" class="form-label fw-semibold">Max Building Level (Craftable)</label>
              <select id="optimizerBuildingLevel" class="form-select">
                <option value="0">No Limit</option>
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
              </select>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-12 col-md-4">
              <div class="bg-body-tertiary rounded p-3 h-100">
                <div class="text-secondary small">Best Beautify (Global)</div>
                <div class="d-flex align-items-center gap-2 mt-1">
                  <img
                    src="<?= esc($topImageUrl); ?>"
                    alt="<?= esc($topName); ?>"
                    class="rounded flex-shrink-0"
                    style="width:28px;height:28px;object-fit:contain;"
                    onerror="this.onerror=null;this.src='<?= esc($fallbackFurnitureImage); ?>';">
                  <div class="fw-semibold"><?= esc($topName); ?></div>
                </div>
                <div class="fs-4 fw-bold text-warning"><?= $topVal; ?></div>
              </div>
            </div>
            <div class="col-12 col-md-8">
              <div class="bg-body-tertiary rounded p-3 h-100">
                <div class="text-secondary small mb-2">Optimizer Result</div>
                <div id="optimizerResult" class="fw-semibold">Set target and filter to calculate recommendation.</div>
                <div id="optimizerHint" class="small text-secondary mt-2">
                  Result uses highest Beautify item from selected pool. Estimated copies = ceil(target / beautify).
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-secondary mb-4">
        <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
          <div class="d-flex align-items-center">
            <i class="fa-solid fa-database me-2 text-warning"></i>
            <h5 class="mb-0">Furniture Database</h5>
          </div>
        </div>
        <div class="card-body">
          <div class="row g-3 mb-4">
            <div class="col-12 col-md-3">
              <label for="filterSearch" class="form-label fw-semibold">Search</label>
              <input id="filterSearch" type="text" class="form-control" placeholder="Furniture name...">
            </div>
            <div class="col-6 col-md-2">
              <label for="filterQuality" class="form-label fw-semibold">Quality</label>
              <select id="filterQuality" class="form-select">
                <option value="">All</option>
                <?php foreach ($qualityOptions as $q): ?>
                  <option value="<?= (int) $q; ?>">Q<?= (int) $q; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-6 col-md-2">
              <label for="filterTier" class="form-label fw-semibold">Tier</label>
              <select id="filterTier" class="form-select">
                <option value="">All</option>
                <?php foreach ($tierOptions as $t): ?>
                  <option value="<?= (int) $t; ?>">T<?= (int) $t; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-6 col-md-2">
              <label for="filterSubtype" class="form-label fw-semibold">Subtype</label>
              <select id="filterSubtype" class="form-select">
                <option value="">All</option>
                <?php foreach ($subtypeLabels as $subtype => $label): ?>
                  <option value="<?= (int) $subtype; ?>"><?= esc((string) $label); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <label for="filterCraftable" class="form-label fw-semibold">Craftable</label>
              <select id="filterCraftable" class="form-select">
                <option value="">All</option>
                <option value="1">Craftable</option>
                <option value="0">Not Craftable</option>
              </select>
            </div>
          </div>

          <?php if (empty($furniture)): ?>
            <div class="alert alert-secondary border-secondary mb-0">No furniture data found.</div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-striped table-bordered align-middle mb-0" id="furnitureTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th class="text-center">Beautify</th>
                    <th class="text-center">Quality</th>
                    <th class="text-center">Tier</th>
                    <th class="text-center">Subtype</th>
                    <th class="text-center">Craftable</th>
                    <th class="text-center">Forge Lv</th>
                    <th>Blueprint</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($furniture as $item): ?>
                    <tr
                      class="furniture-row"
                      data-name="<?= esc(strtolower((string) ($item['name'] ?? '')), 'attr'); ?>"
                      data-quality="<?= (int) ($item['quality'] ?? 0); ?>"
                      data-tier="<?= (int) ($item['tier'] ?? 0); ?>"
                      data-subtype="<?= (int) ($item['subtype'] ?? 0); ?>"
                      data-craftable="<?= !empty($item['is_craftable']) ? '1' : '0'; ?>"
                      data-beautify="<?= (int) ($item['beautify'] ?? 0); ?>"
                      data-forge-level="<?= (int) ($item['forge_building_level'] ?? 0); ?>">
                      <?php
                      $itemImageFile = (string) ($item['image_file'] ?? '');
                      $itemImageUrl = $itemImageFile !== '' ? ($itemBaseUrl . '/' . $itemImageFile) : $fallbackFurnitureImage;
                      ?>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <img
                            src="<?= esc($itemImageUrl); ?>"
                            alt="<?= esc((string) ($item['name'] ?? 'Furniture')); ?>"
                            class="rounded flex-shrink-0"
                            style="width:26px;height:26px;object-fit:contain;"
                            onerror="this.onerror=null;this.src='<?= esc($fallbackFurnitureImage); ?>';">
                          <div class="fw-semibold"><?= esc((string) ($item['name'] ?? '')); ?></div>
                        </div>
                      </td>
                      <td class="text-center fw-semibold text-warning"><?= (int) ($item['beautify'] ?? 0); ?></td>
                      <td class="text-center">Q<?= (int) ($item['quality'] ?? 0); ?></td>
                      <td class="text-center">T<?= (int) ($item['tier'] ?? 0); ?></td>
                      <td class="text-center">
                        <?= esc((string) ($item['subtype_label'] ?? 'Unknown Subtype')); ?>
                      </td>
                      <td class="text-center">
                        <?php if (!empty($item['is_craftable'])): ?>
                          <span class="badge text-bg-success">Yes</span>
                        <?php else: ?>
                          <span class="badge text-bg-secondary">No</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-center"><?= (int) ($item['forge_building_level'] ?? 0); ?></td>
                      <td>
                        <?php if (!empty($item['blueprint_item_id'])): ?>
                          <?= esc((string) ($item['blueprint_name'] ?? 'Blueprint Item')); ?>
                        <?php else: ?>
                          <span class="text-secondary">-</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div id="tableEmptyState" class="alert alert-dark border-secondary mt-3 mb-0 d-none">
              No furniture matches the current filters.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    const rows = Array.from(document.querySelectorAll('.furniture-row'));
    const tableEmptyState = document.getElementById('tableEmptyState');
    const filterSearch = document.getElementById('filterSearch');
    const filterQuality = document.getElementById('filterQuality');
    const filterTier = document.getElementById('filterTier');
    const filterSubtype = document.getElementById('filterSubtype');
    const filterCraftable = document.getElementById('filterCraftable');

    const targetProsperity = document.getElementById('targetProsperity');
    const optimizerMode = document.getElementById('optimizerMode');
    const optimizerBuildingLevel = document.getElementById('optimizerBuildingLevel');
    const optimizerResult = document.getElementById('optimizerResult');

    function getVisibleRows() {
      return rows.filter((row) => !row.classList.contains('d-none'));
    }

    function applyTableFilters() {
      const search = (filterSearch ? filterSearch.value : '').trim().toLowerCase();
      const quality = filterQuality ? filterQuality.value : '';
      const tier = filterTier ? filterTier.value : '';
      const subtype = filterSubtype ? filterSubtype.value : '';
      const craftable = filterCraftable ? filterCraftable.value : '';

      let visibleCount = 0;

      rows.forEach((row) => {
        const name = row.getAttribute('data-name') || '';
        const rowQuality = row.getAttribute('data-quality') || '';
        const rowTier = row.getAttribute('data-tier') || '';
        const rowSubtype = row.getAttribute('data-subtype') || '';
        const rowCraftable = row.getAttribute('data-craftable') || '';

        const okSearch = !search || name.includes(search);
        const okQuality = !quality || quality === rowQuality;
        const okTier = !tier || tier === rowTier;
        const okSubtype = !subtype || subtype === rowSubtype;
        const okCraftable = !craftable || craftable === rowCraftable;

        const show = okSearch && okQuality && okTier && okSubtype && okCraftable;
        row.classList.toggle('d-none', !show);
        if (show) {
          visibleCount++;
        }
      });

      if (tableEmptyState) {
        tableEmptyState.classList.toggle('d-none', visibleCount > 0);
      }

      runOptimizer();
    }

    function runOptimizer() {
      const target = Math.max(0, parseInt((targetProsperity && targetProsperity.value) || '0', 10) || 0);
      const mode = optimizerMode ? optimizerMode.value : 'all';
      const maxForgeLevel = parseInt((optimizerBuildingLevel && optimizerBuildingLevel.value) || '0', 10) || 0;

      const pool = getVisibleRows().filter((row) => {
        if (mode === 'craftable') {
          const craftable = row.getAttribute('data-craftable') === '1';
          if (!craftable) {
            return false;
          }
          if (maxForgeLevel > 0) {
            const forgeLevel = parseInt(row.getAttribute('data-forge-level') || '0', 10) || 0;
            if (forgeLevel <= 0 || forgeLevel > maxForgeLevel) {
              return false;
            }
          }
        }
        return true;
      });

      if (!pool.length) {
        optimizerResult.textContent = 'No item available in selected pool/filter.';
        return;
      }

      pool.sort((a, b) => {
        const ba = parseInt(a.getAttribute('data-beautify') || '0', 10) || 0;
        const bb = parseInt(b.getAttribute('data-beautify') || '0', 10) || 0;
        return bb - ba;
      });

      const best = pool[0];
      const bestName = best.querySelector('td .fw-semibold')?.textContent?.trim() || 'Unknown';
      const bestBeautify = parseInt(best.getAttribute('data-beautify') || '0', 10) || 0;

      if (bestBeautify <= 0 || target <= 0) {
        optimizerResult.textContent = `Top item: ${bestName} (${bestBeautify} Beautify). Set target > 0 to calculate copies.`;
        return;
      }

      const copies = Math.ceil(target / bestBeautify);
      const total = copies * bestBeautify;
      optimizerResult.textContent = `Use ${copies}x ${bestName} (${bestBeautify} each). Estimated total: ${total} Beautify.`;
    }

    [filterSearch, filterQuality, filterTier, filterSubtype, filterCraftable].forEach((el) => {
      if (!el) return;
      el.addEventListener('input', applyTableFilters);
      el.addEventListener('change', applyTableFilters);
    });

    [targetProsperity, optimizerMode, optimizerBuildingLevel].forEach((el) => {
      if (!el) return;
      el.addEventListener('input', runOptimizer);
      el.addEventListener('change', runOptimizer);
    });

    applyTableFilters();
  </script>
</body>

</html>

