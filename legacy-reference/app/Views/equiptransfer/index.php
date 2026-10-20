<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="Calculate the diamond cost for weapon transfer, including Poring Diamond and Kafra VIP discounts.">
  <meta name="keywords" content="Weapon Transfer, ROX Weapon Calculator, Weapon Upgrade, Weapon Refinement, Kafra VIP, Poring Diamond, Diamond Cost, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">
  
  <title>ROXPEDIA - Advanced Weapon Inherit Calculator</title>
  
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
          <div class="card border-secondary">
            <div class="card-body">
              <h5 class="card-title mb-4">
                <i class="fa-solid fa-calculator me-2"></i>Weapon Transfer Cost Calculator
              </h5>
              
              <form id="calculatorForm">
                <!-- Weapon Type -->
                <div class="row mb-4">
                  <label for="weaponType" class="col-sm-4 col-form-label fw-semibold">Weapon Type</label>
                  <div class="col-sm-8">
                    <select id="weaponType" name="weaponType" class="form-select" required>
                      <option value="1H">One-Handed Weapon</option>
                      <option value="Shield">Shield</option>
                      <option value="1H+Shield">One-Handed + Shield</option>
                      <option value="2H">Two-Handed Weapon</option>
                      <option value="Dual-Dagger">Dual-Dagger</option>
                    </select>
                  </div>
                </div>

                <!-- Weapon Quality -->
                <div class="row mb-4">
                  <label for="weaponQuality" class="col-sm-4 col-form-label fw-semibold">Weapon Quality</label>
                  <div class="col-sm-8">
                    <select id="weaponQuality" name="weaponQuality" class="form-select" required>
                      <option value="White">White</option>
                      <option value="Blue">Blue</option>
                      <option value="Gold">Gold</option>
                    </select>
                  </div>
                </div>

                <!-- Dynamic Fields Container -->
                <div id="dynamicFieldsContainer" class="mb-4">
                  <!-- Dynamic form fields will be appended here -->
                </div>

                <div class="border-top border-secondary pt-4 mb-4">
                  <!-- Discount Options -->
                  <h6 class="mb-3">
                    <i class="fa-solid fa-percent me-2"></i>Discount Options
                  </h6>
                  
                  <!-- Kafra VIP -->
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label fw-semibold">Kafra VIP</label>
                    <div class="col-sm-8">
                      <select name="kafraTier" class="form-select" required>
                        <option value="No VIP">No VIP</option>
                        <option value="Tier I">Tier I</option>
                        <option value="Tier II">Tier II</option>
                        <option value="Tier III">Tier III</option>
                      </select>
                    </div>
                  </div>

                  <!-- Poring Diamond -->
                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label fw-semibold">Poring Diamond</label>
                    <div class="col-sm-8">
                      <select name="poringDiamond" class="form-select" required>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Calculate Button -->
                <div class="row mb-3">
                  <div class="col-12">
                    <button type="button" class="btn btn-primary w-100" id="calculateButton">
                      <i class="fa-solid fa-calculator me-2"></i>Calculate Total Cost
                    </button>
                  </div>
                </div>
              </form>

              <!-- Result Alert -->
              <div id="totalCostAlert" class="alert alert-info mt-4" style="display:none;">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-coins fa-2x me-3 text-warning"></i>
                  <div>
                    <h6 class="mb-1 fw-bold">Total Transfer Cost</h6>
                    <div class="fs-4 fw-bold" id="totalCost">0</div>
                    <div class="small text-secondary">Diamonds required for weapon transfer</div>
                  </div>
                </div>
              </div>
              
              <!-- Quick Tips -->
              <div class="alert alert-dark border-secondary small mt-4">
                <div class="d-flex">
                  <i class="fa-solid fa-lightbulb mt-1 me-2 text-warning"></i>
                  <div>
                    <div class="fw-semibold mb-1">Quick Tips:</div>
                    <div class="mb-1">- Kafra VIP provides discounts based on tier level</div>
                    <div class="mb-0">- Poring Diamond gives additional 20% discount on transfer cost</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- FOOTER YANG BENAR (SAMA DENGAN INDEX UTAMA) -->
    <?= view('partials/site_footer') ?>
  </div>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Set current year in footer
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // Format number function (consistent with other scripts)
    const fmt = n => Number(n || 0).toLocaleString('en-US');

    // Generate enchantment lines HTML
    function generateEnchantmentLines(prefix) {
      const cities = [
        'Prontera', 'Morroc', 'Izlude Island', 'Alberta', 
        'Payon', 'Geffen', 'Glast Heim', 'Comodo', 
        'Umbala', 'Juno'
      ];
      
      let html = '';
      
      for (let i = 1; i <= 3; i++) {
        const inputId = `enchantmentLine${i}_${prefix}`;
        const selectId = `city${i}_${prefix}`;
        const label = i === 1 ? 'Slot 1' : i === 2 ? 'Slot 2' : 'Slot 3';
        
        html += `
          <div class="row mb-3">
            <label for="${inputId}" class="col-sm-4 col-form-label small">Enchantment Line (${label})</label>
            <div class="col-6 col-sm-4">
              <input type="number" id="${inputId}" name="${inputId}" class="form-control form-control-sm" placeholder="Level" min="1" max="15" required>
            </div>
            <div class="col-6 col-sm-4">
              <select id="${selectId}" name="${selectId}" class="form-select form-select-sm" required>
                ${cities.map(city => `<option value="${city}">${city}</option>`).join('')}
              </select>
            </div>
          </div>
        `;
      }
      
      return html;
    }

    // Render form fields based on weapon type
    function renderFormFields(weaponType) {
      const container = document.getElementById('dynamicFieldsContainer');
      container.innerHTML = '';

      if (weaponType === "1H+Shield") {
        container.innerHTML = `
          <div class="border-bottom border-secondary pb-3 mb-4">
            <h6 class="mb-3">
              <i class="fa-solid fa-sword me-2"></i>Main Weapon
            </h6>
            <div class="row mb-3">
              <label for="upgradingLevel_main" class="col-sm-4 col-form-label small">Upgrading Level</label>
              <div class="col-sm-8">
                <input type="number" id="upgradingLevel_main" name="upgradingLevel_main" class="form-control form-control-sm" placeholder="Enter level" min="0" max="100" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="refinementLevel_main" class="col-sm-4 col-form-label small">Refinement Level</label>
              <div class="col-sm-8">
                <input type="number" id="refinementLevel_main" name="refinementLevel_main" class="form-control form-control-sm" placeholder="Enter level" min="0" max="15" required>
              </div>
            </div>
            ${generateEnchantmentLines('main')}
          </div>
          
          <div class="pt-3">
            <h6 class="mb-3">
              <i class="fa-solid fa-shield me-2"></i>Shield
            </h6>
            <div class="row mb-3">
              <label for="upgradingLevel_shield" class="col-sm-4 col-form-label small">Upgrading Level</label>
              <div class="col-sm-8">
                <input type="number" id="upgradingLevel_shield" name="upgradingLevel_shield" class="form-control form-control-sm" placeholder="Enter level" min="0" max="100" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="refinementLevel_shield" class="col-sm-4 col-form-label small">Refinement Level</label>
              <div class="col-sm-8">
                <input type="number" id="refinementLevel_shield" name="refinementLevel_shield" class="form-control form-control-sm" placeholder="Enter level" min="0" max="15" required>
              </div>
            </div>
            ${generateEnchantmentLines('shield')}
          </div>
        `;
      } else if (weaponType === "Dual-Dagger") {
        container.innerHTML = `
          <div class="border-bottom border-secondary pb-3 mb-4">
            <h6 class="mb-3">
              <i class="fa-solid fa-dagger me-2"></i>Dagger 1
            </h6>
            <div class="row mb-3">
              <label for="upgradingLevel_1" class="col-sm-4 col-form-label small">Upgrading Level</label>
              <div class="col-sm-8">
                <input type="number" id="upgradingLevel_1" name="upgradingLevel_1" class="form-control form-control-sm" placeholder="Enter level" min="0" max="100" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="refinementLevel_1" class="col-sm-4 col-form-label small">Refinement Level</label>
              <div class="col-sm-8">
                <input type="number" id="refinementLevel_1" name="refinementLevel_1" class="form-control form-control-sm" placeholder="Enter level" min="0" max="15" required>
              </div>
            </div>
            ${generateEnchantmentLines('1')}
          </div>
          
          <div class="pt-3">
            <h6 class="mb-3">
              <i class="fa-solid fa-dagger me-2"></i>Dagger 2
            </h6>
            <div class="row mb-3">
              <label for="upgradingLevel_2" class="col-sm-4 col-form-label small">Upgrading Level</label>
              <div class="col-sm-8">
                <input type="number" id="upgradingLevel_2" name="upgradingLevel_2" class="form-control form-control-sm" placeholder="Enter level" min="0" max="100" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="refinementLevel_2" class="col-sm-4 col-form-label small">Refinement Level</label>
              <div class="col-sm-8">
                <input type="number" id="refinementLevel_2" name="refinementLevel_2" class="form-control form-control-sm" placeholder="Enter level" min="0" max="15" required>
              </div>
            </div>
            ${generateEnchantmentLines('2')}
          </div>
        `;
      } else {
        container.innerHTML = `
          <div class="row mb-3">
            <label for="upgradingLevel" class="col-sm-4 col-form-label fw-semibold">Upgrading Level</label>
            <div class="col-sm-8">
              <input type="number" id="upgradingLevel" name="upgradingLevel" class="form-control" placeholder="Enter upgrading level" min="0" max="100" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="refinementLevel" class="col-sm-4 col-form-label fw-semibold">Refinement Level</label>
            <div class="col-sm-8">
              <input type="number" id="refinementLevel" name="refinementLevel" class="form-control" placeholder="Enter refinement level" min="0" max="15" required>
            </div>
          </div>
          <div class="mt-4 pt-3 border-top border-secondary">
            <h6 class="mb-3">
              <i class="fa-solid fa-gem me-2"></i>Enchantment Lines
            </h6>
            ${generateEnchantmentLines('')}
          </div>
        `;
      }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
      // Render initial form fields
      renderFormFields(document.getElementById('weaponType').value);
      
      // Add event listener for weapon type change
      document.getElementById('weaponType').addEventListener('change', function() {
        renderFormFields(this.value);
      });
      
      // Add event listener for calculate button
      document.getElementById('calculateButton').addEventListener('click', function() {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Calculating...';
        
        const formData = new FormData(document.getElementById('calculatorForm'));
        const data = Object.fromEntries(formData.entries());
        
        // Simulate calculation (replace with actual API call)
        setTimeout(() => {
          // This is a mock calculation - replace with actual API call
          let baseCost = 10000;
          
          // Simple mock calculation based on inputs
          if (data.weaponType === '2H') baseCost *= 1.5;
          if (data.weaponQuality === 'Gold') baseCost *= 2;
          if (data.weaponQuality === 'Blue') baseCost *= 1.5;
          
          // Apply discounts
          if (data.kafraTier === 'Tier I') baseCost *= 0.95;
          if (data.kafraTier === 'Tier II') baseCost *= 0.90;
          if (data.kafraTier === 'Tier III') baseCost *= 0.85;
          if (data.poringDiamond === 'Yes') baseCost *= 0.80;
          
          const totalCost = Math.round(baseCost);
          
          // Display result
          document.getElementById('totalCost').textContent = fmt(totalCost);
          document.getElementById('totalCostAlert').style.display = 'block';
          
          // Scroll to result
          document.getElementById('totalCostAlert').scrollIntoView({ 
            behavior: 'smooth', 
            block: 'nearest' 
          });
          
          // Reset button
          btn.disabled = false;
          btn.innerHTML = '<i class="fa-solid fa-calculator me-2"></i>Calculate Total Cost';
          
        }, 1000); // Simulate API delay
      });
    });
  </script>
</body>
</html>

