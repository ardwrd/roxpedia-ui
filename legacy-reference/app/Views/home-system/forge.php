<?php

/** @var array<int, array<string, mixed>> $recipes */
/** @var array<int, string> $subtypeLabels */
$recipes = $recipes ?? [];
$subtypeLabels = $subtypeLabels ?? [];
$itemBaseUrl = '/assets/img/items';
$fallbackFurnitureImage = '/assets/img/items/UI_home_icon_jianzao.png';
$fallbackMaterialImage = '/assets/img/items/UI_home_icon_shengchan.png';

$buildingLevelOptions = [];
foreach ($recipes as $recipe) {
  $lvl = (int) ($recipe['building_level'] ?? 0);
  if ($lvl > 0) {
    $buildingLevelOptions[$lvl] = true;
  }
}
$buildingLevels = array_keys($buildingLevelOptions);
sort($buildingLevels);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="ROXPEDIA Home System - Forge recipes for Home furniture items.">
  <meta name="robots" content="index, follow">
  <title>Home System - Forge | ROXPEDIA</title>
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
              <i class="fa-solid fa-cubes me-2 text-danger"></i>
              <h5 class="mb-0">Forge Recipes</h5>
            </div>
            <a href="<?= site_url('home-system'); ?>" class="btn btn-outline-secondary btn-sm">
              <i class="fa-solid fa-arrow-left me-1"></i>
              <span class="d-none d-md-inline">Back to Home</span>
            </a>
          </div>
        </div>

        <div class="card-body">
          <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
              <label class="form-label fw-semibold" for="filterLevel">Building Level</label>
              <select id="filterLevel" class="form-select">
                <option value="">All Levels</option>
                <?php foreach ($buildingLevels as $level): ?>
                  <option value="<?= $level; ?>">Level <?= $level; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label fw-semibold" for="filterSubtype">Furniture Subtype</label>
              <select id="filterSubtype" class="form-select">
                <option value="">All Subtypes</option>
                <?php foreach ($subtypeLabels as $subtype => $label): ?>
                  <option value="<?= (int) $subtype; ?>"><?= esc($label); ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label fw-semibold" for="filterSearch">Search Furniture</label>
              <input id="filterSearch" type="text" class="form-control" placeholder="Type item name...">
            </div>
          </div>

          <?php if (empty($recipes)): ?>
            <div class="alert alert-secondary border-secondary mb-0">
              <i class="fa-solid fa-circle-info me-2"></i>No forge recipe data found.
            </div>
          <?php else: ?>
            <div class="row g-3" id="forgeGrid">
              <?php foreach ($recipes as $recipe): ?>
                <?php
                $name = (string) ($recipe['furniture_name'] ?? '');
                $level = (int) ($recipe['building_level'] ?? 0);
                $subtype = (int) ($recipe['furniture_subtype'] ?? 0);
                $materials = $recipe['materials'] ?? [];
                $subtypeLabel = $subtypeLabels[$subtype] ?? 'Unknown Subtype';
                $furnitureImageFile = (string) ($recipe['furniture_image_file'] ?? '');
                $furnitureImageUrl = $furnitureImageFile !== '' ? ($itemBaseUrl . '/' . $furnitureImageFile) : $fallbackFurnitureImage;
                ?>
                <div
                  class="col-12 col-md-6 col-xl-4 forge-card"
                  data-level="<?= $level; ?>"
                  data-subtype="<?= $subtype; ?>"
                  data-name="<?= esc(strtolower($name), 'attr'); ?>">
                  <div class="card border-secondary h-100">
                    <div class="card-header bg-body-tertiary border-secondary py-2">
                      <div class="d-flex align-items-center gap-2">
                        <img
                          src="<?= esc($furnitureImageUrl); ?>"
                          alt="<?= esc($name); ?>"
                          class="rounded flex-shrink-0"
                          style="width:34px;height:34px;object-fit:contain;"
                          onerror="this.onerror=null;this.src='<?= esc($fallbackFurnitureImage); ?>';">
                        <h6 class="mb-0"><?= esc($name); ?></h6>
                      </div>
                    </div>

                    <div class="card-body">
                      <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-secondary">Lv.<?= $level; ?></span>
                        <span class="badge bg-secondary"><?= esc($subtypeLabel); ?></span>
                        <span class="badge bg-info text-dark"><?= esc((string) ($recipe['production_time_label'] ?? '0 min')); ?></span>
                      </div>

                      <div class="small text-secondary mb-2">Required Materials</div>
                      <?php if (empty($materials)): ?>
                        <div class="small text-secondary">No material entry.</div>
                      <?php else: ?>
                        <ul class="list-group list-group-flush">
                          <?php foreach ($materials as $material): ?>
                            <?php
                            $materialImageFile = (string) ($material['image_file'] ?? '');
                            $materialImageUrl = $materialImageFile !== '' ? ($itemBaseUrl . '/' . $materialImageFile) : $fallbackMaterialImage;
                            ?>
                            <li class="list-group-item bg-body-tertiary text-body border-secondary px-0 py-2">
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                  <img
                                    src="<?= esc($materialImageUrl); ?>"
                                    alt="<?= esc((string) ($material['item_name'] ?? 'Material')); ?>"
                                    class="rounded flex-shrink-0"
                                    style="width:22px;height:22px;object-fit:contain;"
                                    onerror="this.onerror=null;this.src='<?= esc($fallbackMaterialImage); ?>';">
                                  <span><?= esc((string) ($material['item_name'] ?? '')); ?></span>
                                </div>
                                <span class="badge bg-primary">x<?= (int) ($material['quantity'] ?? 0); ?></span>
                              </div>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <div id="emptyState" class="alert alert-secondary border-secondary mt-3 mb-0 d-none">
              <i class="fa-solid fa-filter me-2"></i>No recipe matches the current filter.
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

    const levelFilter = document.getElementById('filterLevel');
    const subtypeFilter = document.getElementById('filterSubtype');
    const searchFilter = document.getElementById('filterSearch');
    const cards = document.querySelectorAll('.forge-card');
    const emptyState = document.getElementById('emptyState');

    function applyForgeFilters() {
      const levelVal = levelFilter ? levelFilter.value.trim() : '';
      const subtypeVal = subtypeFilter ? subtypeFilter.value.trim() : '';
      const searchVal = searchFilter ? searchFilter.value.trim().toLowerCase() : '';

      let shown = 0;
      cards.forEach((card) => {
        const cardLevel = card.getAttribute('data-level') || '';
        const cardSubtype = card.getAttribute('data-subtype') || '';
        const cardName = card.getAttribute('data-name') || '';

        const levelMatch = !levelVal || cardLevel === levelVal;
        const subtypeMatch = !subtypeVal || cardSubtype === subtypeVal;
        const searchMatch = !searchVal || cardName.includes(searchVal);
        const visible = levelMatch && subtypeMatch && searchMatch;

        card.classList.toggle('d-none', !visible);
        if (visible) {
          shown++;
        }
      });

      if (emptyState) {
        emptyState.classList.toggle('d-none', shown > 0);
      }
    }

    if (levelFilter) levelFilter.addEventListener('change', applyForgeFilters);
    if (subtypeFilter) subtypeFilter.addEventListener('change', applyForgeFilters);
    if (searchFilter) searchFilter.addEventListener('input', applyForgeFilters);
  </script>
</body>

</html>

