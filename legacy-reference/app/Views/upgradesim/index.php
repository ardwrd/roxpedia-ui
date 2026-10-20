<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="ROXPEDIA Team" />
  <meta name="description" content="Calculate the required materials and Zeny for upgrading equipment in Ragnarok X: Next Generation." />
  <meta name="keywords" content="Upgrade Simulator, Ragnarok X, Upgrade Equipment, Weapon Upgrade, Armor Upgrade, Decoration Upgrade, Zeny Calculator" />
  <meta name="robots" content="index, follow" />
  <meta name="revisit-after" content="7 days" />
  <title>Upgrade Simulator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-md-10">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="upgradeTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tab-calculator-tab" data-bs-toggle="tab" data-bs-target="#tab-calculator" type="button" role="tab" aria-controls="tab-calculator" aria-selected="true">
                Upgrade Calculator
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-list-tab" data-bs-toggle="tab" data-bs-target="#tab-list" type="button" role="tab" aria-controls="tab-list" aria-selected="false">
                Upgrade List
              </button>
            </li>
          </ul>

          <!-- Tab content -->
          <form id="upgradeForm" class="tab-content p-3 border border-top-0 rounded-bottom bg-body-tertiary" novalidate>
            <!-- Tab 1: Upgrade Calculator -->
            <div class="tab-pane fade show active" id="tab-calculator" role="tabpanel" aria-labelledby="tab-calculator-tab" tabindex="0">
              <!-- Equipment Type -->
              <div class="mb-3 row">
                <label for="equipmentType" class="col-sm-4 col-form-label">Equipment Type</label>
                <div class="col-sm-8">
                  <select id="equipmentType" name="equipmentType" class="form-select" required>
                    <option value="">-- Select Equipment Type --</option>
                    <option value="Weapon">Weapon</option>
                    <option value="Armor">Armor</option>
                    <option value="Decoration">Decoration</option>
                  </select>
                </div>
              </div>

              <!-- Weapon Type (hidden by default) -->
              <div class="mb-3 row" id="weaponTypeContainer" style="display:none;">
                <label for="weaponType" class="col-sm-4 col-form-label">Weapon Type</label>
                <div class="col-sm-8">
                  <select id="weaponType" name="weaponType" class="form-select">
                    <option value="">-- Select Weapon Type --</option>
                    <option value="1H">1H</option>
                    <option value="Shield">Shield</option>
                    <option value="2H">2H</option>
                    <option value="Dagger">Dagger</option>
                  </select>
                </div>
              </div>

              <!-- Decoration Type (Accessory/Talisman) -->
              <div class="mb-3 row" id="decorationTypeContainer" style="display:none;">
                <label for="decorationType" class="col-sm-4 col-form-label">Decoration Type</label>
                <div class="col-sm-8">
                  <select id="decorationType" name="decorationType" class="form-select">
                    <option value="">-- Select Decoration Type --</option>
                    <option value="Accessory">Accessory</option>
                    <option value="Talisman">Talisman</option>
                  </select>
                </div>
              </div>

              <!-- Current Upgrade Level -->
              <div class="mb-3 row">
                <label for="currentLevel" class="col-sm-4 col-form-label">Current Upgrade Level</label>
                <div class="col-sm-8">
                  <input type="number" id="currentLevel" name="currentLevel" class="form-control" placeholder="Current Level" min="1" max="15" required />
                </div>
              </div>

              <!-- Target Upgrade Level -->
              <div class="mb-3 row">
                <label for="targetLevel" class="col-sm-4 col-form-label">Target Upgrade Level</label>
                <div class="col-sm-8">
                  <input type="number" id="targetLevel" name="targetLevel" class="form-control" placeholder="Target Level" min="1" max="15" required />
                </div>
              </div>

              <!-- Submit button -->
              <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                  <button type="submit" class="btn btn-primary w-100">Calculate</button>
                </div>
              </div>

              <div id="result" class="alert alert-info mt-3" style="display:none;"></div>
            </div>

            <!-- Tab 2: Upgrade List -->
            <div class="tab-pane fade" id="tab-list" role="tabpanel" aria-labelledby="tab-list-tab" tabindex="0">
              <p>This is the list of upgrade materials and success rates for different equipment.</p>
              <div id="upgradeData" style="display:none;">
                <!-- Data upgrade will appear here -->
              </div>
            </div>

          </form>

        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script>
    // Set current year dynamically
    document.getElementById('current-year').textContent = new Date().getFullYear();
  </script>

  <script src="<?= base_url('assets/upgradesim/js/upgradesim.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
