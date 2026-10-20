<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="Pet Simulator is a comprehensive tool to help you manage your pet's growth. It calculates EXP requirements, tracks essential items, calculates advancement cost, and estimates rewards for releasing your pet. Perfect for optimizing your pet's development!">
  <meta name="keywords" content="Pet Simulator, Ragnarok X, Pet Training, ROX Pets, ROX Simulator, Pet Breeding">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <!-- OpenGraph -->
  <meta property="og:title" content="ROXPEDIA - Pet Simulator">
  <meta property="og:description" content="Pet Simulator is a comprehensive tool to help you manage your pet's growth. It calculates EXP requirements, tracks essential items, calculate advancement cost, and estimates rewards for releasing your pet. Perfect for optimizing your pet's development!">
  <meta property="og:image" content="<?= base_url('assets/img/pet.png') ?>">
  <meta property="og:url" content="<?= site_url('petsimulator') ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ROXPEDIA - Pet Simulator">
  <meta name="twitter:description" content="Pet Simulator is a comprehensive tool to help you manage your pet's growth. It calculates EXP requirements, tracks essential items, calculate advancement cost, and estimates rewards for releasing your pet. Perfect for optimizing your pet's development!">
  <meta name="twitter:image" content="<?= base_url('assets/img/pet.png') ?>">
  <meta name="twitter:site" content="@ROXPEDIA">

  <link rel="canonical" href="<?= site_url('petsimulator') ?>">
  <meta http-equiv="content-language" content="en">

  <title>ROXPEDIA - Pet Simulator</title>

  <!-- BOOTSTRAP 5.3 ONLY - NO CUSTOM CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" rel="stylesheet">

  <!-- CSRF vars for CI4 -->
  <script>
    var CSRF_NAME = '<?= csrf_token() ?>';
    var CSRF_HASH = '<?= csrf_hash() ?>';
  </script>
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <!-- HEADER STANDAR -->
    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <!-- MAIN CARD -->
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <i class="fa-solid fa-calculator me-2 text-info"></i>
                  <h5 class="mb-0">Pet Simulator</h5>
                </div>
              </div>
            </div>

            <div class="card-body">
              <!-- TABS -->
              <ul class="nav nav-tabs" id="card-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pet-exp-simulator-tab" data-bs-toggle="tab" data-bs-target="#pet-exp-simulator" type="button" role="tab">
                    <i class="fa-solid fa-chart-line me-1 d-md-none"></i>
                    <span class="d-none d-md-inline">Pet EXP</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pet-evolution-simulator-tab" data-bs-toggle="tab" data-bs-target="#pet-evolution-simulator" type="button" role="tab">
                    <i class="fa-solid fa-star me-1 d-md-none"></i>
                    <span class="d-none d-md-inline">Advancement Cost</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pet-advance-manual-tab" data-bs-toggle="tab" data-bs-target="#pet-advance-manual" type="button" role="tab">
                    <i class="fa-solid fa-hand-pointer me-1 d-md-none"></i>
                    <span class="d-none d-md-inline">Advance Manual</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pet-release-simulator-tab" data-bs-toggle="tab" data-bs-target="#pet-release-simulator" type="button" role="tab">
                    <i class="fa-solid fa-gift me-1 d-md-none"></i>
                    <span class="d-none d-md-inline">Pet Release</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pet-database-tab" data-bs-toggle="tab" data-bs-target="#pet-database" type="button" role="tab">
                    <i class="fa-solid fa-database me-1 d-md-none"></i>
                    <span class="d-none d-md-inline">Pet Database</span>
                  </button>
                </li>
              </ul>

              <div class="tab-content mt-3">
                <!-- ================= PET EXP TAB ================= -->
                <div class="tab-pane fade show active" id="pet-exp-simulator" role="tabpanel">
                  <div class="alert alert-info bg-info bg-opacity-10 border-info-subtle text-body small mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Quick EXP planner. Drop your current level/EXP and get an estimate for items, cost, and time to target.
                  </div>
                  <div class="row g-4">
                    <!-- INPUT CARD -->
                    <div class="col-12 col-xl-5">
                      <div class="card border-secondary h-100">
                        <div class="card-header bg-body-tertiary border-secondary py-2">
                          <div class="d-flex align-items-center">
                            <i class="fa-solid fa-sliders me-2 text-info"></i>
                            <h6 class="mb-0">Input</h6>
                          </div>
                        </div>

                        <div class="card-body">
                          <form id="expForm" class="row g-3">
                            <div class="col-12">
                              <label for="petQuality" class="form-label fw-semibold">
                                <i class="fa-solid fa-crown me-1"></i>Pet Quality
                              </label>
                              <select class="form-select" id="petQuality" name="petQuality" required>
                                <option value="" disabled selected>Select a Quality</option>
                                <option value="white">White</option>
                                <option value="purple">Purple</option>
                                <option value="gold">Gold</option>
                              </select>
                              <div class="form-text small text-secondary mt-1">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                Affects EXP curve per level
                              </div>
                            </div>

                            <div class="col-md-6">
                              <label for="currentPetLevel" class="form-label fw-semibold">
                                <i class="fa-solid fa-arrow-up me-1"></i>Current Level
                              </label>
                              <input type="number" class="form-control" id="currentPetLevel" name="currentPetLevel" placeholder="1" required min="1" max="60">
                            </div>

                            <div class="col-md-6">
                              <label for="targetPetLevel" class="form-label fw-semibold">
                                <i class="fa-solid fa-bullseye me-1"></i>Target Level
                              </label>
                              <input type="number" class="form-control" id="targetPetLevel" name="targetPetLevel" placeholder="60" required min="1" max="60">
                            </div>

                            <div class="col-12">
                              <label for="currentExpPet" class="form-label fw-semibold">
                                <i class="fa-solid fa-gauge me-1"></i>Current EXP
                              </label>
                              <input type="number" class="form-control" id="currentExpPet" name="currentExpPet" placeholder="0" required min="0">
                              <div class="form-text small text-secondary mt-1">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                Remaining EXP = Sum(level EXP) - Current EXP
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="kafraVIP" name="kafraVIP">
                                <label class="form-check-label" for="kafraVIP">
                                  <i class="fa-solid fa-gem me-1"></i>Activate Kafra VIP (affects items only)
                                </label>
                              </div>
                            </div>

                            <!-- Pet Food Price & Owned Pet Food (STACKED) -->
                            <div class="col-12">
                              <label for="petFoodPrice" class="form-label fw-semibold mb-1">
                                <i class="fa-solid fa-coins me-1"></i>Pet Food Price (Crystal)
                              </label>
                              <input type="number" class="form-control" id="petFoodPrice" name="petFoodPrice" placeholder="e.g. 35" min="0" step="1">
                              <div class="form-text small text-secondary mt-1">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                Pet Food price (Crystal) as listed on your server
                              </div>
                            </div>

                            <div class="col-12">
                              <label for="ownedPetFood" class="form-label fw-semibold mb-1">
                                <i class="fa-solid fa-box me-1"></i>Owned Pet Food (pcs)
                              </label>
                              <input type="number" class="form-control" id="ownedPetFood" name="ownedPetFood" placeholder="e.g. 120" min="0" step="1">
                              <div class="form-text small text-secondary mt-1">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                1 Pet Food = 200 EXP
                              </div>
                            </div>

                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- RESULTS CARD -->
                    <div class="col-12 col-xl-7">
                      <div class="card border-secondary h-100">
                        <div class="card-header bg-body-tertiary border-secondary py-2">
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                              <i class="fa-solid fa-chart-column me-2 text-success"></i>
                              <h6 class="mb-0">Results</h6>
                            </div>
                            <span class="text-secondary small">Auto-calculated on input</span>
                          </div>
                        </div>

                        <div class="card-body">
                          <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                              <div class="card bg-body-tertiary border-secondary h-100">
                                <div class="card-body text-center p-3">
                                  <div class="text-secondary small mb-2">
                                    <i class="fa-solid fa-fire me-1"></i>EXP Needed
                                  </div>
                                  <div class="fs-4 fw-bold text-info" id="expResult">-</div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="card bg-body-tertiary border-secondary h-100">
                                <div class="card-body text-center p-3">
                                  <div class="text-secondary small mb-2">
                                    <i class="fa-solid fa-box-open me-1"></i>Items Required
                                  </div>
                                  <div class="fw-bold" id="itemsResult">-</div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row g-3 mb-4">
                            <div class="col-12">
                              <div class="card bg-body-tertiary border-secondary">
                                <div class="card-body p-3">
                                  <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-25 rounded p-2 me-3">
                                      <i class="fa-solid fa-coins text-warning"></i>
                                    </div>
                                    <div>
                                      <div class="text-secondary small">Pet Food Cost (Crystal)</div>
                                      <div class="fs-4 fw-bold text-warning" id="petFoodCost">-</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row g-3 mb-4">
                            <div class="col-md-6">
                              <div class="card bg-body-tertiary border-secondary h-100">
                                <div class="card-body text-center p-3">
                                  <div class="text-secondary small mb-2">
                                    <i class="fa-solid fa-calendar-day me-1"></i>Days to Target
                                  </div>
                                  <div class="fs-4 fw-bold text-primary" id="daysToTarget">-</div>
                                  <div class="text-secondary small mt-2">
                                    Non VIP: 1,500 EXP/day<br>
                                    VIP: 2,500 EXP/day
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="card bg-body-tertiary border-secondary h-100">
                                <div class="card-body text-center p-3">
                                  <div class="text-secondary small mb-2">
                                    <i class="fa-solid fa-calendar-alt me-1"></i>Days to Max (Lv 60)
                                  </div>
                                  <div class="fs-4 fw-bold text-success" id="daysToMax">-</div>
                                  <div class="text-secondary small mt-2">
                                    From current level & EXP
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="card bg-body-tertiary border-secondary">
                            <div class="card-body p-3">
                              <div class="d-flex align-items-center mb-2">
                                <div class="bg-info bg-opacity-25 rounded p-2 me-3">
                                  <i class="fa-solid fa-calculator text-info"></i>
                                </div>
                                <div>
                                  <div class="text-secondary small">Projected Level (using all Pet Food)</div>
                                  <div class="fw-bold" id="petFoodProjection">
                                    Enter your owned Pet Food to see projection
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div><!-- /card-body -->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ================= EVOLUTION TAB ================= -->
                <div class="tab-pane fade" id="pet-evolution-simulator" role="tabpanel">
                  <div class="alert alert-warning bg-warning bg-opacity-10 border-warning-subtle text-body small mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    This is an estimator. It totals expected materials and cost from your current star to target star for planning before you tap.
                  </div>
                  <div class="row g-4">
                    <div class="col-12 col-xl-5">
                      <div class="card border-secondary h-100">
                        <div class="card-header bg-body-tertiary border-secondary py-2">
                          <div class="d-flex align-items-center">
                            <i class="fa-solid fa-sliders me-2 text-warning"></i>
                            <h6 class="mb-0">Prices & Selection</h6>
                          </div>
                        </div>

                        <div class="card-body">
                          <form id="evolutionForm" class="row g-3">
                            <div class="col-12">
                              <label class="form-label fw-semibold">
                                <i class="fa-solid fa-gem me-1"></i>Spirit Stone Prices
                              </label>
                              <div class="row g-2">
                                <div class="col-md-6">
                                  <input type="number" class="form-control spiritStonePrice" id="spiritStonePrice1" placeholder="Level I" required>
                                </div>
                                <div class="col-md-6">
                                  <input type="number" class="form-control spiritStonePrice" id="spiritStonePrice2" placeholder="Level II" required>
                                </div>
                                <div class="col-md-6">
                                  <input type="number" class="form-control spiritStonePrice" id="spiritStonePrice3" placeholder="Level III" required>
                                </div>
                                <div class="col-md-6">
                                  <input type="number" class="form-control spiritStonePrice" id="spiritStonePrice4" placeholder="Level IV" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <label class="form-label fw-semibold">
                                <i class="fa-solid fa-scale-balanced me-1"></i>Scale Prices
                              </label>
                              <div class="row g-2">
                                <div class="col-md-6">
                                  <input type="number" class="form-control scalePrice" id="scalePrice1" placeholder="Level I" required>
                                </div>
                                <div class="col-md-6">
                                  <input type="number" class="form-control scalePrice" id="scalePrice2" placeholder="Level II" required>
                                </div>
                                <div class="col-md-6">
                                  <input type="number" class="form-control scalePrice" id="scalePrice3" placeholder="Level III" required>
                                </div>
                                <div class="col-md-6">
                                  <input type="number" class="form-control scalePrice" id="scalePrice4" placeholder="Level IV" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <label for="evolutionPetQuality" class="form-label fw-semibold">
                                <i class="fa-solid fa-crown me-1"></i>Pet Quality
                              </label>
                              <select class="form-select" id="evolutionPetQuality" name="petQuality" required>
                                <option value="" disabled selected>Select a Quality</option>
                                <option value="white">White</option>
                                <option value="purple">Purple</option>
                                <option value="gold">Gold</option>
                              </select>
                            </div>

                            <div class="col-md-6">
                              <label for="currentStar" class="form-label fw-semibold">
                                <i class="fa-solid fa-star me-1"></i>Current Star
                              </label>
                              <select class="form-select" id="currentStar" name="currentStar" required>
                                <option value="" disabled selected>Select Current Star</option>
                              </select>
                            </div>

                            <div class="col-md-6">
                              <label for="targetStar" class="form-label fw-semibold">
                                <i class="fa-solid fa-bullseye me-1"></i>Target Star
                              </label>
                              <select class="form-select" id="targetStar" name="targetStar" required>
                                <option value="" disabled selected>Select Target Star</option>
                              </select>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-xl-7">
                      <div class="card border-secondary h-100">
                        <div class="card-header bg-body-tertiary border-secondary py-2">
                          <div class="d-flex align-items-center">
                            <i class="fa-solid fa-chart-pie me-2 text-warning"></i>
                            <h6 class="mb-0">Evolution Summary</h6>
                          </div>
                        </div>

                        <div class="card-body">
                          <div id="evolutionResult" class="mb-3">
                            Choose the pet quality and star levels to calculate the evolution materials.
                          </div>

                          <div class="card bg-body-tertiary border-secondary mb-3">
                            <div class="card-body p-3">
                              <div class="text-secondary small mb-2">
                                <i class="fa-solid fa-sack-dollar me-1"></i>Total Cost
                              </div>
                              <div id="totalCost">
                                Total cost for Scale and Spirit Stone will be displayed here
                              </div>
                            </div>
                          </div>
                        </div><!--/card-body-->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ================= ADVANCE MANUAL TAB ================= -->
                <div class="tab-pane fade" id="pet-advance-manual" role="tabpanel">
                  <div class="alert alert-primary bg-primary bg-opacity-10 border-primary-subtle text-body small mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    This is a simulator. Click one attempt at a time to mimic in-game advance flow and track real-time usage/cost.
                  </div>
                  <div class="row g-4">
                    <div class="col-12 col-xl-5">
                      <div class="card border-secondary h-100">
                        <div class="card-header bg-body-tertiary border-secondary py-2">
                          <div class="d-flex align-items-center">
                            <i class="fa-solid fa-gamepad me-2 text-info"></i>
                            <h6 class="mb-0">Manual Advance Control</h6>
                          </div>
                        </div>

                        <div class="card-body">
                          <form id="manualAdvanceForm" class="row g-3" onsubmit="return false;">
                            <div class="col-12">
                              <label for="manualPetId" class="form-label fw-semibold">
                                <i class="fa-solid fa-paw me-1"></i>Pet
                              </label>
                              <select class="form-select" id="manualPetId">
                                <option value="" selected disabled>Select Pet</option>
                              </select>
                              <div class="form-text small text-secondary mt-1">
                                Select a pet first, then set star range and mode.
                              </div>
                            </div>

                            <div class="col-12">
                              <label class="form-label fw-semibold">
                                <i class="fa-solid fa-crown me-1"></i>Rarity
                              </label>
                              <div>
                                <span id="manualPetQualityBadge" class="badge text-bg-secondary text-uppercase">-</span>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <label for="manualCurrentStar" class="form-label fw-semibold">
                                <i class="fa-solid fa-star me-1"></i>Current Star
                              </label>
                              <select class="form-select" id="manualCurrentStar">
                                <option value="" selected disabled>Select Current Star</option>
                              </select>
                            </div>

                            <div class="col-md-6">
                              <label for="manualTargetStar" class="form-label fw-semibold">
                                <i class="fa-solid fa-bullseye me-1"></i>Target Star
                              </label>
                              <select class="form-select" id="manualTargetStar">
                                <option value="" selected disabled>Select Target Star</option>
                              </select>
                            </div>

                            <div class="col-12">
                              <label class="form-label fw-semibold">
                                <i class="fa-solid fa-sliders me-1"></i>Mode
                              </label>
                              <div class="d-flex gap-4">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="manualMode" id="manualModeCraft" value="craft" checked>
                                  <label class="form-check-label" for="manualModeCraft">Craft (Own Items)</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="manualMode" id="manualModeBuy" value="buy">
                                  <label class="form-check-label" for="manualModeBuy">Full Buy Exchange</label>
                                </div>
                              </div>
                            </div>

                            <div class="col-12" id="manualCraftInputs">
                              <div class="card bg-body-tertiary border-secondary mb-3">
                                <div class="card-body p-3">
                                  <div class="small fw-semibold mb-2">Owned Spirit Stone (per tier)</div>
                                  <div class="row g-2">
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedSpirit" data-tier="1" placeholder="Tier I"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedSpirit" data-tier="2" placeholder="Tier II"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedSpirit" data-tier="3" placeholder="Tier III"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedSpirit" data-tier="4" placeholder="Tier IV"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="card bg-body-tertiary border-secondary mb-3">
                                <div class="card-body p-3">
                                  <div class="small fw-semibold mb-2">Owned Scale (per tier)</div>
                                  <div class="row g-2">
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedScale" data-tier="1" placeholder="Tier I"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedScale" data-tier="2" placeholder="Tier II"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedScale" data-tier="3" placeholder="Tier III"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedScale" data-tier="4" placeholder="Tier IV"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="card bg-body-tertiary border-secondary">
                                <div class="card-body p-3">
                                  <div class="small fw-semibold mb-2">Owned Adv. Pill (I-IV)</div>
                                  <div class="row g-2">
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedPill" data-tier="1" placeholder="Pill I"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedPill" data-tier="2" placeholder="Pill II"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedPill" data-tier="3" placeholder="Pill III"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualOwnedPill" data-tier="4" placeholder="Pill IV"></div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12 d-none" id="manualBuyInputs">
                              <div class="card bg-body-tertiary border-secondary mb-3">
                                <div class="card-body p-3">
                                  <div class="small fw-semibold mb-2">Spirit Stone Price (per tier)</div>
                                  <div class="row g-2">
                                    <div class="col-6"><input type="number" min="0" class="form-control manualPriceSpirit" data-tier="1" placeholder="Tier I"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualPriceSpirit" data-tier="2" placeholder="Tier II"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualPriceSpirit" data-tier="3" placeholder="Tier III"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualPriceSpirit" data-tier="4" placeholder="Tier IV"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="card bg-body-tertiary border-secondary">
                                <div class="card-body p-3">
                                  <div class="small fw-semibold mb-2">Scale Price (per tier)</div>
                                  <div class="row g-2">
                                    <div class="col-6"><input type="number" min="0" class="form-control manualPriceScale" data-tier="1" placeholder="Tier I"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualPriceScale" data-tier="2" placeholder="Tier II"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualPriceScale" data-tier="3" placeholder="Tier III"></div>
                                    <div class="col-6"><input type="number" min="0" class="form-control manualPriceScale" data-tier="4" placeholder="Tier IV"></div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12 d-grid gap-2">
                              <button type="button" id="manualSessionBtn" class="btn btn-outline-info">
                                <i class="fa-solid fa-rotate me-1"></i>Start / Reset Session
                              </button>
                              <button type="button" id="manualClickBtn" class="btn btn-info text-dark fw-semibold" disabled>
                                <i class="fa-solid fa-hand-pointer me-1"></i>Advance 1 Click
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-xl-7">
                      <div class="card border-secondary h-100">
                        <div class="card-header bg-body-tertiary border-secondary py-2">
                          <div class="d-flex align-items-center">
                            <i class="fa-solid fa-chart-line me-2 text-info"></i>
                            <h6 class="mb-0">Manual Session Result</h6>
                          </div>
                        </div>

                        <div class="card-body">
                          <div id="manualStatusAlert" class="alert alert-secondary py-2 mb-3">
                            Configure your pet and click <b>Start / Reset Session</b>.
                          </div>

                          <div class="card bg-body-tertiary border-secondary mb-3">
                            <div class="card-body p-3" id="manualProgressSummary">
                              Session not started.
                            </div>
                          </div>

                          <div class="card bg-body-tertiary border-secondary mb-3">
                            <div class="card-body p-3" id="manualResourceSummary">
                              Materials usage will appear here.
                            </div>
                          </div>

                          <div class="card bg-body-tertiary border-secondary mb-3">
                            <div class="card-body p-3" id="manualCostSummary">
                              Cost summary will appear here.
                            </div>
                          </div>

                          <div class="card bg-body-tertiary border-secondary">
                            <div class="card-header border-secondary py-2 small fw-semibold">
                              Session Log
                            </div>
                            <ul class="list-group list-group-flush small" id="manualLogList">
                              <li class="list-group-item bg-body-tertiary text-secondary">No activity yet.</li>
                            </ul>
                          </div>
                        </div><!--/card-body-->
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ================= RELEASE TAB ================= -->
                <div class="tab-pane fade" id="pet-release-simulator" role="tabpanel">
                  <div class="alert alert-success bg-success bg-opacity-10 border-success-subtle text-body small mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Thinking of releasing a pet? This gives a quick reward preview so you can decide if it is worth it.
                  </div>
                  <div class="row g-4">
                    <div class="col-12 col-xl-5">
                      <div class="card border-secondary h-100">
                        <div class="card-header bg-body-tertiary border-secondary py-2">
                          <div class="d-flex align-items-center">
                            <i class="fa-solid fa-sliders me-2 text-success"></i>
                            <h6 class="mb-0">Input</h6>
                          </div>
                        </div>

                        <div class="card-body">
                          <form id="releaseForm" class="row g-3">
                            <div class="col-12">
                              <label for="petReleaseQuality" class="form-label fw-semibold">
                                <i class="fa-solid fa-crown me-1"></i>Pet Quality
                              </label>
                              <select class="form-select" id="petReleaseQuality" name="petReleaseQuality" required>
                                <option value="" disabled selected>Select a Quality</option>
                                <option value="white">White</option>
                                <option value="purple">Purple</option>
                                <option value="gold">Gold</option>
                              </select>
                            </div>

                            <div class="col-md-6">
                              <label for="petReleaseLevel" class="form-label fw-semibold">
                                <i class="fa-solid fa-arrow-up me-1"></i>Pet Level
                              </label>
                              <input type="number" class="form-control" id="petReleaseLevel" name="petReleaseLevel" placeholder="1-60" required min="1" max="60">
                            </div>

                            <div class="col-md-6">
                              <label for="petStar" class="form-label fw-semibold">
                                <i class="fa-solid fa-star me-1"></i>Pet Star
                              </label>
                              <input type="number" class="form-control" id="petStar" name="petStar" placeholder="1-9" required min="1" max="9">
                            </div>

                            <div class="col-12">
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="isEvolved" name="isEvolved">
                                <label class="form-check-label" for="isEvolved">
                                  <i class="fa-solid fa-arrows-rotate me-1"></i>Is Pet Evolved?
                                </label>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-xl-7">
                      <div class="card border-secondary h-100">
                        <div class="card-header bg-body-tertiary border-secondary py-2">
                          <div class="d-flex align-items-center">
                            <i class="fa-solid fa-gift me-2 text-success"></i>
                            <h6 class="mb-0">Release Rewards</h6>
                          </div>
                        </div>

                        <div class="card-body">
                          <div id="releaseResult">
                            Please provide your pet's data to calculate the release rewards.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ================= PET DATABASE TAB ================= -->
                <div class="tab-pane fade" id="pet-database" role="tabpanel">
                  <div class="alert alert-secondary bg-secondary bg-opacity-10 border-secondary-subtle text-body small mb-3">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Pet lookup zone. Check names, rarity, and talents fast when picking what to build next.
                  </div>
                  <div class="card border-secondary">
                    <div class="card-header bg-body-tertiary border-secondary py-2">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                          <i class="fa-solid fa-database me-2 text-primary"></i>
                          <h6 class="mb-0">Pet Database</h6>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                          <label for="filterRarity" class="mb-0 text-secondary small">
                            <i class="fa-solid fa-filter me-1"></i>Filter
                          </label>
                          <select class="form-select form-select-sm" id="filterRarity" style="min-width:160px">
                            <option value="all">All</option>
                            <option value="white">White</option>
                            <option value="purple">Purple</option>
                            <option value="gold">Gold</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0" id="petDatabaseTable">
                          <thead>
                            <tr>
                              <th style="width:180px" class="small fw-semibold">
                                <i class="fa-solid fa-paw me-1"></i>Name
                              </th>
                              <th style="width:90px" class="small fw-semibold text-center">
                                <i class="fa-solid fa-crown me-1"></i>Rarity
                              </th>
                              <th class="small fw-semibold">
                                <i class="fa-solid fa-wand-magic-sparkles me-1"></i>Talent Description
                              </th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div><!-- /tab-content -->
            </div><!-- /card-body -->
          </div><!-- /main card -->
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // ================== COMMON HELPERS ==================
    const manualAdvanceData = <?= json_encode(
                                $manualAdvanceData ?? [],
                                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
                              ); ?>;
    const starLimits = (manualAdvanceData && manualAdvanceData.starLimits) ?
      manualAdvanceData.starLimits :
      {
        white: {
          min: 1,
          max: 5
        },
        purple: {
          min: 3,
          max: 7
        },
        gold: {
          min: 5,
          max: 9
        }
      };

    function populateStarDropdown(selectElement, minStar, maxStar, placeholderText) {
      const ph = placeholderText || 'Select Star';
      selectElement.innerHTML = `<option value="" disabled selected>${ph}</option>`;
      for (let i = minStar; i <= maxStar; i++) {
        const opt = document.createElement('option');
        opt.value = i;
        opt.textContent = `${i}*`;
        selectElement.appendChild(opt);
      }
    }

    document.getElementById('evolutionPetQuality').addEventListener('change', function() {
      const pq = this.value;
      const cur = document.getElementById('currentStar');
      const tgt = document.getElementById('targetStar');
      if (pq in starLimits) {
        const {
          min,
          max
        } = starLimits[pq];
        populateStarDropdown(cur, min, max, 'Select Current Star');
        populateStarDropdown(tgt, min, max, 'Select Target Star');
      } else {
        cur.innerHTML = '<option value="" disabled selected>Select Current Star</option>';
        tgt.innerHTML = '<option value="" disabled selected>Select Target Star</option>';
      }
    });

    function clampLevel($el) {
      let v = parseInt($el.val(), 10);
      if (isNaN(v)) return;
      if (v < 1) v = 1;
      if (v > 60) v = 60;
      if (String(v) !== $el.val()) $el.val(v);
    }
    $('#currentPetLevel,#targetPetLevel,#petReleaseLevel').on('input', function() {
      clampLevel($(this));
    });

    function clampStar($el) {
      let v = parseInt($el.val(), 10);
      if (isNaN(v)) return;
      if (v < 1) v = 1;
      if (v > 9) v = 9;
      if (String(v) !== $el.val()) $el.val(v);
    }
    $('#petStar').on('input', function() {
      clampStar($(this));
    });

    const fmt = (n) => Number(n || 0).toLocaleString();

    // Pet Food Cost cache
    let lastPetFoodNeeded = 0;

    function updatePetFoodCostFromCache() {
      const price = parseFloat($('#petFoodPrice').val());
      if (!isFinite(price) || price < 0) {
        $('#petFoodCost').text('-');
        return;
      }
      const total = Math.round((Number(lastPetFoodNeeded) || 0) * price);
      $('#petFoodCost').text(fmt(total));
    }

    // ---- EXP ----
    function resetExpUI() {
      $("#expResult").text("-");
      $("#itemsResult").html("-");
      $("#daysToTarget").text("-");
      $("#daysToMax").text("-");
      $("#petFoodCost").text("-");
      $('#petFoodProjection').text('Enter your owned Pet Food to see projection');
      lastPetFoodNeeded = 0;
    }

    function calculateExp() {
      var petQuality = $('#petQuality').val();
      var currentLevel = $('#currentPetLevel').val();
      var currentExp = $('#currentExpPet').val();
      var targetLevel = $('#targetPetLevel').val();
      var kafraVIP = $('#kafraVIP').is(':checked') ? 'on' : 'off';
      var ownedPetFood = $('#ownedPetFood').val();

      if (!petQuality || !currentLevel || currentExp === '' || !targetLevel) {
        resetExpUI();
        return;
      }

      // 1) To target
      $.ajax({
        type: "POST",
        url: "<?= site_url('petsimulator/calculate-exp'); ?>",
        data: {
          [CSRF_NAME]: CSRF_HASH,
          petQuality: petQuality,
          currentPetLevel: currentLevel,
          currentExpPet: currentExp,
          targetPetLevel: targetLevel,
          kafraVIP: kafraVIP,
          petFoodOwned: ownedPetFood
        },
        success: function(res) {
          if (res.error) {
            $("#expResult").text("Error");
            $("#itemsResult").html("-");
            $("#daysToTarget").text("-");
            $("#daysToMax").text("-");
            $("#petFoodCost").text("-");
            $('#petFoodProjection').text('Error calculating projection');
            lastPetFoodNeeded = 0;
            return;
          }

          $("#expResult").text(fmt(res.expNeeded));

          const pat = Number(res.itemsNeeded?.pat || 0);
          const hpat = Number(res.itemsNeeded?.heartwarmingPat || 0);
          const pfood = Number(res.itemsNeeded?.petFood || 0);

          lastPetFoodNeeded = pfood;

          $("#itemsResult").html(
            `<div class="small">Pat: <span class="fw-bold">${fmt(pat)}</span></div>` +
            `<div class="small">Heartwarming Pat: <span class="fw-bold">${fmt(hpat)}</span></div>` +
            `<div class="small">Pet Food: <span class="fw-bold">${fmt(pfood)}</span></div>`
          );

          updatePetFoodCostFromCache();

          const need = Number(res.expNeeded || 0);
          if (need <= 0) {
            $("#daysToTarget").html('<span class="text-success">Target reached</span>');
          } else {
            const dNoVip = Math.ceil(need / 1500);
            const dVip = Math.ceil(need / 2500);
            $("#daysToTarget").html(`
              <div class="small">Non Kafra VIP: <span class="fw-bold">${fmt(dNoVip)} day(s)</span></div>
              <div class="small">Kafra VIP: <span class="fw-bold">${fmt(dVip)} day(s)</span></div>
            `);
          }

          // Projection from backend
          if (res.projection && Number(ownedPetFood) > 0) {
            const p = res.projection;
            const maxLevel = 60;
            let txt;
            if (p.projectedLevel >= maxLevel) {
              txt = `Using all ${fmt(p.petFoodOwned)} Pet Food will bring your pet to <span class="fw-bold">Lv ${maxLevel}</span> (Max).`;
            } else {
              txt = `Using all ${fmt(p.petFoodOwned)} Pet Food, your pet will reach approximately <span class="fw-bold">Lv ${p.projectedLevel}</span> with <span class="fw-bold">${fmt(p.projectedExp)}</span> EXP into that level.`;
            }
            $('#petFoodProjection').html(txt);
          } else {
            $('#petFoodProjection').text('Enter your owned Pet Food to see projection');
          }

          // 2) To Max (Lv 60)
          $.ajax({
            type: "POST",
            url: "<?= site_url('petsimulator/calculate-exp'); ?>",
            data: {
              [CSRF_NAME]: CSRF_HASH,
              petQuality: petQuality,
              currentPetLevel: currentLevel,
              currentExpPet: currentExp,
              targetPetLevel: 60,
              kafraVIP: kafraVIP,
              petFoodOwned: ownedPetFood
            },
            success: function(rm) {
              if (rm.error) {
                $("#daysToMax").text("-");
                return;
              }
              const expMax = Number(rm.expNeeded || 0);
              if (expMax <= 0) {
                $("#daysToMax").html('<span class="text-success">Max level reached</span>');
              } else {
                const n = Math.ceil(expMax / 1500);
                const v = Math.ceil(expMax / 2500);
                $("#daysToMax").html(`
                  <div class="small">Non Kafra VIP: <span class="fw-bold">${fmt(n)} day(s)</span></div>
                  <div class="small">Kafra VIP: <span class="fw-bold">${fmt(v)} day(s)</span></div>
                `);
              }
            },
            error: function() {
              $("#daysToMax").text("-");
            }
          });
        },
        error: function() {
          $("#expResult").text("Error");
          $("#itemsResult").html("-");
          $("#daysToTarget").text("-");
          $("#daysToMax").text("-");
          $("#petFoodCost").text("-");
          $('#petFoodProjection').text('Error calculating projection');
          lastPetFoodNeeded = 0;
        }
      });
    }

    // Trigger recalculation on inputs
    $('#petQuality,#currentPetLevel,#currentExpPet,#targetPetLevel,#kafraVIP,#ownedPetFood').on('input change', calculateExp);

    // Pet Food price changes: just recompute using cached petFood count
    $('#petFoodPrice').on('input change', function() {
      updatePetFoodCostFromCache();
    });

    // ---- Evolution ----
    function calculateEvolution() {
      var petQuality = $('#evolutionPetQuality').val();
      var currentStar = parseInt($('#currentStar').val(), 10);
      var targetStar = parseInt($('#targetStar').val(), 10);

      if (!petQuality || !currentStar || !targetStar || currentStar >= targetStar) {
        $("#evolutionResult").text("Please fill out all fields correctly.");
        $("#totalCost").text("Total cost for Scale and Spirit Stone will be displayed here");
        return;
      }

      var spiritStonePrices = [],
        scalePrices = [];
      $('.spiritStonePrice').each(function() {
        let p = parseFloat($(this).val());
        if (isNaN(p)) p = 0;
        spiritStonePrices.push(p);
      });
      $('.scalePrice').each(function() {
        let p = parseFloat($(this).val());
        if (isNaN(p)) p = 0;
        scalePrices.push(p);
      });

      $.ajax({
        type: "POST",
        url: "<?= site_url('petsimulator/calculate-evolution'); ?>",
        data: {
          [CSRF_NAME]: CSRF_HASH,
          petQuality: petQuality,
          currentStar: currentStar,
          targetStar: targetStar,
          spiritStonePrice: spiritStonePrices,
          scalePrice: scalePrices
        },
        success: function(r) {
          if (r.error) {
            $("#evolutionResult").text(r.error);
            return;
          }

          let html = `
            <div class="mb-3">
              <div class="fw-semibold mb-2">Total Materials</div>
              <div class="small">Spirit Stone: <span class="fw-bold">${fmt(r.totalMaterials.spiritStone)}</span></div>
              <div class="small">Scale: <span class="fw-bold">${fmt(r.totalMaterials.scale)}</span></div>
              <div class="small">Adv. Pill: <span class="fw-bold">${fmt(r.totalMaterials.advPill)}</span></div>
            </div>
            <div class="fw-semibold mb-2">Material Details</div>
          `;

          r.materialDetails.forEach(d => {
            const reqPointText = (d.requiredPoints !== null && d.requiredPoints !== undefined) ?
              `<div class="small">Required Points: <span class="fw-bold">${fmt(d.requiredPoints)}</span></div>` :
              '';
            html += `
              <div class="border border-secondary rounded p-2 mb-2">
                <div class="fw-semibold">${d.level}</div>
                ${reqPointText}
                <div class="small">Spirit Stone: <span class="fw-bold">${fmt(d.spiritStone)}</span> (Cost: ${fmt(d.spiritStoneCost)})</div>
                <div class="small">Scale: <span class="fw-bold">${fmt(d.scale)}</span> (Cost: ${fmt(d.scaleCost)})</div>
                <div class="small">Adv. Pill: <span class="fw-bold">${fmt(d.advPill)}</span> (Cost: ${fmt(d.advPillCost)} ${d.advPillCurrency})</div>
              </div>
            `;
          });

          $("#evolutionResult").html(html);

          $("#totalCost").html(`
            <div class="small">Spirit Stone Cost: <span class="fw-bold">${fmt(r.totalCost.spiritStone)}</span></div>
            <div class="small">Scale Cost: <span class="fw-bold">${fmt(r.totalCost.scale)}</span></div>
            <div class="small mt-2 fw-semibold">Adv. Pill Cost</div>
            <div class="small">Crystal: <span class="fw-bold">${fmt(r.totalCost.advPill.Crystal)}</span></div>
            <div class="small">Diamond: <span class="fw-bold">${fmt(r.totalCost.advPill.Diamond)}</span></div>
          `);
        },
        error: function() {
          $("#evolutionResult").text("There was an error processing your request.");
        }
      });
    }
    $('#evolutionPetQuality,#currentStar,#targetStar,.spiritStonePrice,.scalePrice').on('input change', calculateEvolution);

    // ---- Release ----
    function calculatePetRelease() {
      var petQuality = $('#petReleaseQuality').val();
      var petLevel = $('#petReleaseLevel').val();
      var petStar = $('#petStar').val();
      var isEvolved = $('#isEvolved').is(':checked') ? 'on' : 'off';

      if (!petQuality || !petLevel || !petStar) {
        $("#releaseResult").text("Please provide your pet's data to calculate the release rewards.");
        return;
      }

      $.ajax({
        type: "POST",
        url: "<?= site_url('petsimulator/calculate-pet-release'); ?>",
        data: {
          [CSRF_NAME]: CSRF_HASH,
          petReleaseQuality: petQuality,
          petReleaseLevel: petLevel,
          petStar: petStar,
          isEvolved: isEvolved
        },
        success: function(r) {
          if (r.error) {
            $("#releaseResult").text(r.error);
            return;
          }

          $("#releaseResult").html(`
            <div class="row g-3">
              <div class="col-md-6">
                <div class="card bg-body-tertiary border-secondary h-100">
                  <div class="card-body text-center p-3">
                    <div class="text-secondary small mb-2">
                      <i class="fa-solid fa-bowl-food me-1"></i>Pet Food
                    </div>
                    <div class="fs-4 fw-bold text-warning">${fmt(r.petFood)}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card bg-body-tertiary border-secondary h-100">
                  <div class="card-body text-center p-3">
                    <div class="text-secondary small mb-2">
                      <i class="fa-solid fa-box me-1"></i>Advancement Box
                    </div>
                    <div class="fs-4 fw-bold text-info">${fmt(r.advancementBox)}</div>
                  </div>
                </div>
              </div>
            </div>
          `);
        },
        error: function() {
          $("#releaseResult").text("There was an error processing your request.");
        }
      });
    }
    $('#petReleaseQuality,#petReleaseLevel,#petStar,#isEvolved').on('input change', calculatePetRelease);

    // ---- Advance Manual ----
    const manualPointsPerClick = Number(manualAdvanceData?.pointsPerClick || 3);
    const manualPets = Array.isArray(manualAdvanceData?.pets) ? manualAdvanceData.pets : [];
    const manualEvolutionConfig = manualAdvanceData?.evolutionConfig || {};
    const manualAdvPillPrices = manualAdvanceData?.advPillPrices || {};
    const manualPetsById = {};
    manualPets.forEach(p => {
      manualPetsById[String(p.id)] = p;
    });
    let manualSession = null;

    function getTierInputs(selector) {
      const out = [0, 0, 0, 0];
      $(selector).each(function() {
        const tier = parseInt($(this).data('tier'), 10);
        let val = parseFloat($(this).val());
        if (!isFinite(val) || val < 0) val = 0;
        if (tier >= 1 && tier <= 4) out[tier - 1] = val;
      });
      return out;
    }

    function sumArr(arr) {
      return (arr || []).reduce((a, b) => a + Number(b || 0), 0);
    }

    function getRarityBadgeClass(rarity) {
      if (rarity === 'gold') return 'text-bg-warning text-dark';
      if (rarity === 'purple') return 'text-bg-primary';
      return 'text-bg-secondary';
    }

    function getManualStepCfg(session) {
      const qualitySteps = manualEvolutionConfig?.[session.quality] || {};
      const stepRaw = qualitySteps?.[session.currentStar] || qualitySteps?.[String(session.currentStar)] || null;
      if (!stepRaw) return null;
      const tier = Number(stepRaw.tier || 1);
      const materials = stepRaw.materials || {};
      const requiredPoints = Number(stepRaw.requiredPoints || (Number(stepRaw.clicks || 0) * manualPointsPerClick) || 0);
      return {
        tier,
        requiredPoints,
        materials: {
          spiritStone: Number(materials.spiritStone || 0),
          scale: Number(materials.scale || 0),
          advPill: Number(materials.advPill || 0),
        }
      };
    }

    function setManualStatus(message, type = 'secondary') {
      const cls = `alert alert-${type} py-2 mb-3`;
      $('#manualStatusAlert').attr('class', cls).html(message);
    }

    function renderManualLog() {
      const $list = $('#manualLogList');
      $list.empty();
      if (!manualSession || !manualSession.logs || manualSession.logs.length === 0) {
        $list.append('<li class="list-group-item bg-body-tertiary text-secondary">No activity yet.</li>');
        return;
      }
      manualSession.logs.slice(0, 20).forEach(log => {
        $list.append(`<li class="list-group-item bg-body-tertiary border-secondary text-body">${log}</li>`);
      });
    }

    function renderManualSession() {
      if (!manualSession) {
        $('#manualProgressSummary').text('Session not started.');
        $('#manualResourceSummary').text('Materials usage will appear here.');
        $('#manualCostSummary').text('Cost summary will appear here.');
        $('#manualClickBtn').prop('disabled', true);
        renderManualLog();
        return;
      }

      const step = getManualStepCfg(manualSession);
      const targetReached = manualSession.currentStar >= manualSession.targetStar;
      const noNextConfig = !step && !targetReached;
      const clickDisabled = targetReached || noNextConfig || manualSession.done;
      $('#manualClickBtn').prop('disabled', clickDisabled);

      let stepText = '-';
      if (step) {
        const needed = Math.max(0, step.requiredPoints - manualSession.pointsInStep);
        stepText = `Current step ${manualSession.currentStar} -> ${manualSession.currentStar + 1} | Points ${fmt(manualSession.pointsInStep)} / ${fmt(step.requiredPoints)} | Need ${fmt(needed)} more`;
      } else if (targetReached) {
        stepText = `Target reached at Star ${manualSession.currentStar}`;
      } else {
        stepText = `No advancement config found for star ${manualSession.currentStar}`;
      }

      $('#manualProgressSummary').html(`
        <div class="small text-secondary mb-1">Pet</div>
        <div class="fw-semibold mb-2">${manualSession.petName} (${manualSession.quality.toUpperCase()})</div>
        <div class="small">Current Star: <span class="fw-bold">${manualSession.currentStar}</span></div>
        <div class="small">Target Star: <span class="fw-bold">${manualSession.targetStar}</span></div>
        <div class="small">Total Clicks: <span class="fw-bold">${fmt(manualSession.totalClicks)}</span></div>
        <div class="small mt-2">${stepText}</div>
      `);

      const c = manualSession.consumed;
      const spiritRows = c.spirit.map((v, i) => `<div class="small">Spirit Tier ${i+1}: <span class="fw-bold">${fmt(v)}</span></div>`).join('');
      const scaleRows = c.scale.map((v, i) => `<div class="small">Scale Tier ${i+1}: <span class="fw-bold">${fmt(v)}</span></div>`).join('');
      const pillRows = c.pill.map((v, i) => `<div class="small">Adv Pill ${i+1}: <span class="fw-bold">${fmt(v)}</span></div>`).join('');

      let remainingHtml = '';
      if (manualSession.mode === 'craft') {
        const o = manualSession.owned;
        remainingHtml = `
          <hr class="my-2">
          <div class="small fw-semibold mb-1">Remaining Items</div>
          ${o.spirit.map((v,i)=>`<div class="small">Spirit Tier ${i+1}: <span class="fw-bold">${fmt(v)}</span></div>`).join('')}
          ${o.scale.map((v,i)=>`<div class="small">Scale Tier ${i+1}: <span class="fw-bold">${fmt(v)}</span></div>`).join('')}
          ${o.pill.map((v,i)=>`<div class="small">Adv Pill ${i+1}: <span class="fw-bold">${fmt(v)}</span></div>`).join('')}
        `;
      }

      $('#manualResourceSummary').html(`
        <div class="small fw-semibold mb-1">Consumed Items</div>
        ${spiritRows}
        ${scaleRows}
        ${pillRows}
        ${remainingHtml}
      `);

      if (manualSession.mode === 'buy') {
        $('#manualCostSummary').html(`
          <div class="small">Spirit Stone Cost: <span class="fw-bold">${fmt(Math.round(manualSession.cost.spirit))}</span></div>
          <div class="small">Scale Cost: <span class="fw-bold">${fmt(Math.round(manualSession.cost.scale))}</span></div>
          <div class="small mt-2 fw-semibold">Adv. Pill Cost</div>
          <div class="small">Crystal: <span class="fw-bold">${fmt(Math.round(manualSession.cost.advPillCrystal))}</span></div>
          <div class="small">Diamond: <span class="fw-bold">${fmt(Math.round(manualSession.cost.advPillDiamond))}</span></div>
        `);
      } else {
        $('#manualCostSummary').html('<div class="small text-secondary">Craft mode: cost is not calculated (using owned items).</div>');
      }

      renderManualLog();
    }

    function clearManualSession(statusMessage = '') {
      manualSession = null;
      if (statusMessage) {
        setManualStatus(statusMessage, 'secondary');
      }
      renderManualSession();
    }

    function populateManualPetDropdown() {
      const $sel = $('#manualPetId');
      $sel.empty();
      $sel.append('<option value="" selected disabled>Select Pet</option>');
      manualPets.forEach(p => {
        $sel.append(`<option value="${p.id}">${p.name} (${String(p.rarity || '').toUpperCase()})</option>`);
      });
    }

    function syncManualPetQualityAndStars() {
      const pet = manualPetsById[$('#manualPetId').val() || ''];
      const $badge = $('#manualPetQualityBadge');
      if (!pet) {
        $badge.text('-').attr('class', 'badge text-bg-secondary text-uppercase');
        $('#manualCurrentStar').html('<option value="" selected disabled>Select Current Star</option>');
        $('#manualTargetStar').html('<option value="" selected disabled>Select Target Star</option>');
        return;
      }

      const rarity = String(pet.rarity || 'white').toLowerCase();
      $badge.text(rarity).attr('class', `badge ${getRarityBadgeClass(rarity)} text-uppercase`);
      const lim = starLimits[rarity] || {
        min: 1,
        max: 9
      };
      populateStarDropdown(document.getElementById('manualCurrentStar'), lim.min, lim.max, 'Select Current Star');
      populateStarDropdown(document.getElementById('manualTargetStar'), lim.min, lim.max, 'Select Target Star');
    }

    function syncManualModePanels() {
      const mode = $('input[name="manualMode"]:checked').val() || 'craft';
      $('#manualCraftInputs').toggleClass('d-none', mode !== 'craft');
      $('#manualBuyInputs').toggleClass('d-none', mode !== 'buy');
    }

    function startManualSession() {
      const pet = manualPetsById[$('#manualPetId').val() || ''];
      const currentStar = parseInt($('#manualCurrentStar').val(), 10);
      const targetStar = parseInt($('#manualTargetStar').val(), 10);
      const mode = $('input[name="manualMode"]:checked').val() || 'craft';

      if (!pet || !currentStar || !targetStar || currentStar >= targetStar) {
        setManualStatus('Please select pet, current star, and target star correctly.', 'danger');
        clearManualSession();
        return;
      }

      const quality = String(pet.rarity || '').toLowerCase();
      if (!manualEvolutionConfig?.[quality]) {
        setManualStatus('Advancement config for this rarity is unavailable.', 'danger');
        clearManualSession();
        return;
      }

      manualSession = {
        petId: Number(pet.id),
        petName: pet.name,
        quality,
        currentStar,
        targetStar,
        pointsInStep: 0,
        totalClicks: 0,
        mode,
        done: false,
        consumed: {
          spirit: [0, 0, 0, 0],
          scale: [0, 0, 0, 0],
          pill: [0, 0, 0, 0],
        },
        owned: {
          spirit: getTierInputs('.manualOwnedSpirit'),
          scale: getTierInputs('.manualOwnedScale'),
          pill: getTierInputs('.manualOwnedPill'),
        },
        buyPrices: {
          spirit: getTierInputs('.manualPriceSpirit'),
          scale: getTierInputs('.manualPriceScale'),
        },
        cost: {
          spirit: 0,
          scale: 0,
          advPillCrystal: 0,
          advPillDiamond: 0,
        },
        logs: [
          `Session started for ${pet.name} (${quality.toUpperCase()}) from Star ${currentStar} to ${targetStar}.`
        ],
      };

      setManualStatus('Session started. Click "Advance 1 Click" to simulate.', 'info');
      renderManualSession();
    }

    function runManualAdvanceClick() {
      if (!manualSession) {
        setManualStatus('Start a session first.', 'warning');
        return;
      }
      if (manualSession.done || manualSession.currentStar >= manualSession.targetStar) {
        manualSession.done = true;
        setManualStatus('Target star already reached.', 'success');
        renderManualSession();
        return;
      }

      const step = getManualStepCfg(manualSession);
      if (!step) {
        manualSession.done = true;
        manualSession.logs.unshift(`No config found for Star ${manualSession.currentStar}. Session stopped.`);
        setManualStatus('No advancement configuration found for this step.', 'danger');
        renderManualSession();
        return;
      }

      const tierIdx = Math.max(0, Math.min(3, step.tier - 1));
      const needSpirit = step.materials.spiritStone;
      const needScale = step.materials.scale;
      const needPill = step.materials.advPill;

      if (manualSession.mode === 'craft') {
        const hasEnough =
          manualSession.owned.spirit[tierIdx] >= needSpirit &&
          manualSession.owned.scale[tierIdx] >= needScale &&
          manualSession.owned.pill[tierIdx] >= needPill;
        if (!hasEnough) {
          manualSession.logs.unshift(`Insufficient items at tier ${step.tier}. Click stopped.`);
          setManualStatus(`Not enough items for tier ${step.tier} in craft mode.`, 'danger');
          renderManualSession();
          return;
        }

        manualSession.owned.spirit[tierIdx] -= needSpirit;
        manualSession.owned.scale[tierIdx] -= needScale;
        manualSession.owned.pill[tierIdx] -= needPill;
      } else {
        manualSession.cost.spirit += needSpirit * (manualSession.buyPrices.spirit[tierIdx] || 0);
        manualSession.cost.scale += needScale * (manualSession.buyPrices.scale[tierIdx] || 0);
        const pillCfg = manualAdvPillPrices?.[step.tier] || manualAdvPillPrices?.[String(step.tier)] || {
          currency: 'Crystal',
          price: 0
        };
        const pillCost = needPill * Number(pillCfg.price || 0);
        const curr = String(pillCfg.currency || 'Crystal').toLowerCase();
        if (curr === 'diamond') {
          manualSession.cost.advPillDiamond += pillCost;
        } else {
          manualSession.cost.advPillCrystal += pillCost;
        }
      }

      manualSession.consumed.spirit[tierIdx] += needSpirit;
      manualSession.consumed.scale[tierIdx] += needScale;
      manualSession.consumed.pill[tierIdx] += needPill;
      manualSession.totalClicks += 1;
      manualSession.pointsInStep += manualPointsPerClick;

      manualSession.logs.unshift(
        `Click #${manualSession.totalClicks}: +${manualPointsPerClick} points on Star ${manualSession.currentStar} step (Tier ${step.tier}).`
      );

      while (manualSession.pointsInStep >= step.requiredPoints) {
        manualSession.pointsInStep -= step.requiredPoints;
        manualSession.currentStar += 1;
        manualSession.logs.unshift(`Star up! Now at Star ${manualSession.currentStar}.`);

        if (manualSession.currentStar >= manualSession.targetStar) {
          manualSession.done = true;
          manualSession.pointsInStep = 0;
          manualSession.logs.unshift(`Target reached at Star ${manualSession.currentStar}.`);
          setManualStatus('Target star reached.', 'success');
          break;
        }
        break;
      }

      if (!manualSession.done) {
        setManualStatus('Manual click recorded.', 'info');
      }
      renderManualSession();
    }

    function initManualAdvance() {
      populateManualPetDropdown();
      syncManualPetQualityAndStars();
      syncManualModePanels();
      renderManualSession();

      $('#manualPetId').on('change', function() {
        syncManualPetQualityAndStars();
        clearManualSession('Pet changed. Start session again.');
      });
      $('#manualCurrentStar,#manualTargetStar').on('change', function() {
        clearManualSession('Star input changed. Start session again.');
      });
      $('input[name="manualMode"]').on('change', function() {
        syncManualModePanels();
        clearManualSession('Mode changed. Start session again.');
      });
      $('#manualSessionBtn').on('click', startManualSession);
      $('#manualClickBtn').on('click', runManualAdvanceClick);
    }

    // ---- Pet Database (Dynamic from DB) ----
    const petDatabase = <?= json_encode(
                          $petDatabase ?? [],
                          JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
                        ); ?>;

    function renderPetTable(rarity = 'all') {
      const tbody = $("#petDatabaseTable tbody");
      tbody.empty();

      const filtered = rarity === 'all' ? petDatabase : petDatabase.filter(p => p.rarity === rarity);

      if (filtered.length === 0) {
        tbody.append('<tr><td colspan="3" class="text-center text-secondary py-4">No pet data available.</td></tr>');
        return;
      }

      filtered.forEach(p => {
        const badge =
          p.rarity === 'gold' ? '<span class="badge text-bg-warning text-dark text-uppercase">gold</span>' :
          p.rarity === 'purple' ? '<span class="badge text-bg-primary text-uppercase">purple</span>' :
          '<span class="badge text-bg-secondary text-uppercase">white</span>';

        tbody.append(`
          <tr>
            <td class="fw-semibold small">${p.name}</td>
            <td class="text-center">${badge}</td>
            <td class="small">${p.talent}</td>
          </tr>
        `);
      });
    }

    // Render DB only when tab opened
    $('button[data-bs-toggle="tab"][data-bs-target="#pet-database"]').on('shown.bs.tab', function() {
      renderPetTable($('#filterRarity').val() || 'all');
    });

    $('#filterRarity').on('change', function() {
      renderPetTable(this.value);
    });

    // Auto-run on load
    $(function() {
      initManualAdvance();
      calculateExp();
      $('button[data-bs-toggle="tab"][data-bs-target="#pet-exp-simulator"]').on('shown.bs.tab', function() {
        calculateExp();
      });
    });
  </script>
</body>

</html>

