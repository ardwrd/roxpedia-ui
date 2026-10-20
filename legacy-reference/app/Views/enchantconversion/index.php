<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="ROXPEDIA Team" />
  <meta name="description" content="Calculate the required enchant stones for transferring enchantments between cities in Ragnarok X: Next Generation. Supports Shield, Armor, and Accessory equipment types." />
  <meta name="keywords" content="Enchant Transfer, Ragnarok X, Enchant Stones, Shield Enchant, Armor Enchant, Accessory Enchant, Transfer Calculator, Game Calculator" />
  <meta name="robots" content="index, follow" />
  <meta name="revisit-after" content="7 days" />
  <title>Enchant Conversion Calculator</title>
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
          <ul class="nav nav-tabs" id="enchantTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tab-calculator-tab" data-bs-toggle="tab" data-bs-target="#tab-calculator" type="button" role="tab" aria-controls="tab-calculator" aria-selected="true">
                Enchant Calculator
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-placeholder-tab" data-bs-toggle="tab" data-bs-target="#tab-placeholder" type="button" role="tab" aria-controls="tab-placeholder" aria-selected="false">
                 Enchantment List
              </button>
            </li>
          </ul>

          <!-- Tab content -->
          <form id="enchantForm" class="tab-content p-3 border border-top-0 rounded-bottom bg-body-tertiary" novalidate>
            <!-- Tab 1: Enchant Calculator -->
            <div class="tab-pane fade show active" id="tab-calculator" role="tabpanel" aria-labelledby="tab-calculator-tab" tabindex="0">
              <!-- Equipment Type -->
              <div class="mb-3 row align-items-center">
                <label for="equipmentType" class="col-sm-4 col-form-label">Equipment Type</label>
                <div class="col-sm-8">
                  <select id="equipmentType" name="equipmentType" class="form-select" required>
                    <option value="">-- Select Equipment Type --</option>
                    <option value="Weapon">Weapon</option>
                    <option value="Armor">Armor</option>
                    <option value="Accessory">Accessory</option>
                  </select>
                </div>
              </div>

              <!-- Weapon Type (hidden by default) -->
              <div class="mb-3 row align-items-center" id="weaponTypeContainer" style="display:none;">
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

              <!-- Enchantment Line (Slot 1) -->
              <div class="mb-3 row align-items-center">
                <label class="col-sm-4 col-form-label">Enchantment Line (Slot 1)</label>
                <div class="col-sm-8">
                  <div class="row g-2">
                    <div class="col-4">
                      <select id="startingCity1" name="startingCity1" class="form-select">
                        <option value="">Starting City</option>
                        <option value="Prontera">Prontera</option>
                        <option value="Morroc">Morroc</option>
                        <option value="Izlude">Izlude</option>
                        <option value="Alberta">Alberta</option>
                        <option value="Payon">Payon</option>
                        <option value="Geffen">Geffen</option>
                        <option value="Glast Heim">Glast Heim</option>
                        <option value="Comodo">Comodo</option>
                        <option value="Umbala">Umbala</option>
                        <option value="Juno">Juno</option>
                      </select>
                    </div>
                    <div class="col-4">
                      <input type="number" id="startingLevel1" name="startingLevel1" class="form-control" placeholder="Starting Level" min="1" max="15" />
                    </div>
                    <div class="col-4">
                      <select id="targetCity1" name="targetCity1" class="form-select targetCitySelect">
                        <option value="">Target City</option>
                        <option value="Prontera">Prontera</option>
                        <option value="Morroc">Morroc</option>
                        <option value="Izlude">Izlude</option>
                        <option value="Alberta">Alberta</option>
                        <option value="Payon">Payon</option>
                        <option value="Geffen">Geffen</option>
                        <option value="Glast Heim">Glast Heim</option>
                        <option value="Comodo">Comodo</option>
                        <option value="Umbala">Umbala</option>
                        <option value="Juno">Juno</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Enchantment Line (Slot 2) -->
              <div class="mb-3 row align-items-center">
                <label class="col-sm-4 col-form-label">Enchantment Line (Slot 2)</label>
                <div class="col-sm-8">
                  <div class="row g-2">
                    <div class="col-4">
                      <select id="startingCity2" name="startingCity2" class="form-select">
                        <option value="">Starting City</option>
                        <option value="Prontera">Prontera</option>
                        <option value="Morroc">Morroc</option>
                        <option value="Izlude">Izlude</option>
                        <option value="Alberta">Alberta</option>
                        <option value="Payon">Payon</option>
                        <option value="Geffen">Geffen</option>
                        <option value="Glast Heim">Glast Heim</option>
                        <option value="Comodo">Comodo</option>
                        <option value="Umbala">Umbala</option>
                        <option value="Juno">Juno</option>
                      </select>
                    </div>
                    <div class="col-4">
                      <input type="number" id="startingLevel2" name="startingLevel2" class="form-control" placeholder="Starting Level" min="1" max="15" />
                    </div>
                    <div class="col-4">
                      <select id="targetCity2" name="targetCity2" class="form-select targetCitySelect">
                        <option value="">Target City</option>
                        <option value="Prontera">Prontera</option>
                        <option value="Morroc">Morroc</option>
                        <option value="Izlude">Izlude</option>
                        <option value="Alberta">Alberta</option>
                        <option value="Payon">Payon</option>
                        <option value="Geffen">Geffen</option>
                        <option value="Glast Heim">Glast Heim</option>
                        <option value="Comodo">Comodo</option>
                        <option value="Umbala">Umbala</option>
                        <option value="Juno">Juno</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Enchantment Line (Slot 3) -->
              <div class="mb-3 row align-items-center">
                <label class="col-sm-4 col-form-label">Enchantment Line (Slot 3)</label>
                <div class="col-sm-8">
                  <div class="row g-2">
                    <div class="col-4">
                      <select id="startingCity3" name="startingCity3" class="form-select">
                        <option value="">Starting City</option>
                        <option value="Prontera">Prontera</option>
                        <option value="Morroc">Morroc</option>
                        <option value="Izlude">Izlude</option>
                        <option value="Alberta">Alberta</option>
                        <option value="Payon">Payon</option>
                        <option value="Geffen">Geffen</option>
                        <option value="Glast Heim">Glast Heim</option>
                        <option value="Comodo">Comodo</option>
                        <option value="Umbala">Umbala</option>
                        <option value="Juno">Juno</option>
                      </select>
                    </div>
                    <div class="col-4">
                      <input type="number" id="startingLevel3" name="startingLevel3" class="form-control" placeholder="Starting Level" min="1" max="15" />
                    </div>
                    <div class="col-4">
                      <select id="targetCity3" name="targetCity3" class="form-select targetCitySelect">
                        <option value="">Target City</option>
                        <option value="Prontera">Prontera</option>
                        <option value="Morroc">Morroc</option>
                        <option value="Izlude">Izlude</option>
                        <option value="Alberta">Alberta</option>
                        <option value="Payon">Payon</option>
                        <option value="Geffen">Geffen</option>
                        <option value="Glast Heim">Glast Heim</option>
                        <option value="Comodo">Comodo</option>
                        <option value="Umbala">Umbala</option>
                        <option value="Juno">Juno</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Submit button -->
              <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                  <button type="submit" class="btn btn-primary w-100" id="calcBtn">Calculate</button>
                </div>
              </div>

              <!-- Result (INFO) & Error (DANGER) -->
              <div id="result" class="alert alert-info mt-3" style="display:none;" aria-live="polite"></div>
              <div id="formError" class="alert alert-danger mt-3" style="display:none;" aria-live="assertive"></div>
            </div>

            <!-- Tab 2: Enchantment List -->
            <div class="tab-pane fade" id="tab-placeholder" role="tabpanel" aria-labelledby="tab-placeholder-tab" tabindex="0">

              <p class="mb-3">This is the database of base enchantment stats by city.</p>

              <!-- Filter bar: City + Level + Reset -->
              <div class="card bg-body-tertiary border-0">
                <div class="card-body">
                  <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-6">
                      <label for="citySelect" class="form-label mb-1">Select City</label>
                      <select id="citySelect" class="form-select w-100">
                        <option value="">-- Choose a city --</option>
                        <option value="Prontera">Prontera</option>
                        <option value="Morroc">Morroc</option>
                        <option value="Izlude">Izlude</option>
                        <option value="Alberta">Alberta</option>
                        <option value="Payon">Payon</option>
                        <option value="Geffen">Geffen</option>
                        <option value="Glast Heim">Glast Heim</option>
                        <option value="Comodo">Comodo</option>
                        <option value="Umbala">Umbala</option>
                        <option value="Juno">Juno</option>
                        <option value="Einbroch">Einbroch</option> <!-- NEW -->
                        <option value="Rachel">Rachel</option> <!-- NEW -->
                      </select>
                    </div>
                    <div class="col-6 col-md-3">
                      <label for="levelSelect" class="form-label mb-1">Select Level</label>
                      <select id="levelSelect" class="form-select w-100">
                        <option value="">-- Choose Level --</option>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                        <option value="4">Level 4</option>
                        <option value="5">Level 5</option>
                        <option value="6">Level 6</option>
                        <option value="7">Level 7</option>
                        <option value="8">Level 8</option>
                        <option value="9">Level 9</option>
                        <option value="10">Level 10</option>
                        <option value="11">Level 11</option>
                        <option value="12">Level 12</option>
                        <option value="13">Level 13</option>
                        <option value="14">Level 14</option>
                        <option value="15">Level 15</option>
                      </select>
                    </div>
                    <div class="col-6 col-md-3 d-grid">
                      <label class="form-label mb-1 opacity-0">Reset</label>
                      <button id="resetFilter" type="button" class="btn btn-outline-danger">Reset</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Context header -->
              <h5 id="enchantContext" class="mt-3 d-none"></h5>

              <!-- Enchant tables container -->
              <div id="enchantData" class="mt-2" style="display:none;">
                <!-- Data enchantment akan muncul di sini -->
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

  <!-- Script untuk tab Enchantment List (filter bar + level multiplier) -->
  <script>
    // Helper untuk render header konteks
    function setContextHeader(city, level) {
      const ctx = document.getElementById('enchantContext');
      if (city && level) {
        ctx.textContent = `${city} - Level ${level} Enchants`;
        ctx.classList.remove('d-none');
      } else {
        ctx.classList.add('d-none');
        ctx.textContent = '';
      }
    }

    // Fungsi update nilai tabel sesuai level (tetap sama dengan sebelumnya)
    function updateTableStats(level) {
      const container = document.getElementById('enchantData');
      const tables = container.querySelectorAll('table');

      if (tables.length > 0) container.style.display = 'block';

      tables.forEach(table => {
        // Tambahkan hover agar lebih enak dibaca (jika belum ada)
        table.classList.add('table', 'table-hover');

        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
          const valueCells = row.querySelectorAll('td:nth-child(2), td:nth-child(3), td:nth-child(4), td:nth-child(5)');
          valueCells.forEach(valueCell => {
            const baseValue = valueCell.textContent.trim();
            let newValue;

            if (baseValue.includes('%')) {
              const numericValue = parseFloat(baseValue.replace('%', ''));
              newValue = numericValue * level;
              valueCell.textContent = newValue.toFixed(2) + '%';
            } else {
              const numericValue = parseFloat(baseValue);
              newValue = numericValue * level;
              valueCell.textContent = (newValue % 1 === 0) ? newValue : Math.round(newValue * 100) / 100;
            }
          });
        });
      });
    }

    // Render utama saat city/level berubah
    function renderEnchantList() {
      const city = document.getElementById('citySelect').value;
      const levelStr = document.getElementById('levelSelect').value;
      const level = parseInt(levelStr);
      const container = document.getElementById('enchantData');

      // Tampilkan header konteks sesuai pilihan
      setContextHeader(city, levelStr);

      if (city && enchantDataByCity[city] && level) {
        container.innerHTML = enchantDataByCity[city];
        updateTableStats(level);
        container.style.display = 'block';
      } else {
        container.innerHTML = '';
        container.style.display = 'none';
      }
    }

    // Event listeners
    document.getElementById('citySelect').addEventListener('change', renderEnchantList);
    document.getElementById('levelSelect').addEventListener('change', renderEnchantList);

    // Reset filter
    document.getElementById('resetFilter').addEventListener('click', function () {
      document.getElementById('citySelect').value = '';
      document.getElementById('levelSelect').value = '';
      setContextHeader('', '');
      const container = document.getElementById('enchantData');
      container.innerHTML = '';
      container.style.display = 'none';
    });
  </script>

  <!-- Data untuk tab Enchantment List -->
  <script src="<?= base_url('assets/enchantconv/js/enchantlist.js'); ?>"></script>

  <script>
    window.ENCHANT_CONVERSION_DATA_URL = "<?= site_url('enchantconversion/data'); ?>";
  </script>

  <!-- Kalkulator (pastikan file ini sudah berisi perbaikan nama batu per Equipment) -->
  <script src="<?= base_url('assets/enchantconv/js/enchantconv.js'); ?>"></script>

  <!-- Validasi & UX guard -->
  <script>
    (function () {
      const form = document.getElementById('enchantForm');
      const equipmentTypeSelect = document.getElementById('equipmentType');
      const weaponTypeContainer = document.getElementById('weaponTypeContainer');
      const weaponTypeSelect = document.getElementById('weaponType');
      const calcBtn = document.getElementById('calcBtn');
      const resultDiv = document.getElementById('result');
      const errorDiv  = document.getElementById('formError');

      function showError(msg){
        errorDiv.innerHTML = msg;
        errorDiv.style.display = 'block';
      }
      function hideError(){
        errorDiv.style.display = 'none';
        errorDiv.innerHTML = '';
      }

      function baseValid() {
        if (!equipmentTypeSelect.value) return false;
        if (equipmentTypeSelect.value === 'Weapon' && !weaponTypeSelect.value) return false;
        return true;
      }

      function toggleWeaponType() {
        if (equipmentTypeSelect.value === 'Weapon') {
          weaponTypeContainer.style.display = 'flex';
          weaponTypeSelect.setAttribute('required', '');
        } else {
          weaponTypeContainer.style.display = 'none';
          weaponTypeSelect.removeAttribute('required');
          weaponTypeSelect.value = '';
        }
      }

      function syncTargetCityEnable() {
        [1,2,3].forEach(i => {
          const startSel = document.getElementById('startingCity' + i);
          const targetSel = document.getElementById('targetCity' + i);
          targetSel.disabled = !startSel.value;
        });
      }

      function refreshSubmitState() {
        calcBtn.disabled = !baseValid();
      }

      equipmentTypeSelect.addEventListener('change', () => {
        toggleWeaponType();
        refreshSubmitState();
        hideError();
      });
      weaponTypeSelect.addEventListener('change', () => {
        refreshSubmitState();
        hideError();
      });
      [1,2,3].forEach(i => {
        document.getElementById('startingCity' + i).addEventListener('change', syncTargetCityEnable);
      });

      // Init states
      toggleWeaponType();
      syncTargetCityEnable();
      refreshSubmitState();

      // SUBMIT GUARD:
      // - Jika tidak valid: blok & tampilkan error (di #formError)
      // - Jika valid: biarkan event submit MENERUS ke listener lain (enchantconv.js)
      function onFormSubmit(e) {
        const passThrough = form.dataset.passThrough === '1';
        if (passThrough) return; // sudah dilewatkan - jangan blok lagi

        hideError(); // bersihkan error lama

        if (!baseValid()) {
          e.preventDefault(); // blok kirim
          // JANGAN mengubah class/warna #result agar tetap alert-info
          const msg = !equipmentTypeSelect.value
            ? '<strong>Oops!</strong> Pilih dulu <em>Equipment Type</em>.'
            : '<strong>Oops!</strong> Untuk <em>Weapon</em>, pilih dulu <em>Weapon Type</em>.';
          showError(msg);
          return;
        }

        // Valid => izinkan listener kalkulator (di enchantconv.js)
        form.dataset.passThrough = '1';
        setTimeout(() => { delete form.dataset.passThrough; }, 0);
      }

      form.addEventListener('submit', onFormSubmit);
    })();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>


