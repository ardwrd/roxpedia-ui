<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shadow Smelt - ROXPEDIA</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <!-- Header -->
    <?= view('partials/site_header') ?>

    <div class="text-center mb-3">
      <h3 class="mb-1">Shadow Smelt</h3>
      <p class="text-secondary mb-0">
        Calculate Blessing Marks, Luminary/Horcrux yields, and Upgrade Costs for Shadow Equipment.
      </p>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#bm" type="button" role="tab">Blessing Mark</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#lh" type="button" role="tab">Luminary / Horcrux</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#upg" type="button" role="tab">Upgrade Cost</button>
      </li>
    </ul>

    <div class="tab-content border border-top-0 rounded-bottom p-3 bg-body-tertiary">
      <!-- TAB 1: Blessing Mark -->
      <div class="tab-pane fade show active" id="bm" role="tabpanel" tabindex="0">
        <div class="row g-3">
          <div class="col-12 col-lg-7">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="mb-3"><i class="fa-solid fa-coins me-2"></i>Blessing Mark Calculator</h5>

                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="form-label mb-1">Rarity</label>
                    <select id="bm_rarity" class="form-select">
                      <option value="White">White</option>
                      <option value="Blue">Blue</option>
                      <option value="Gold">Gold</option>
                      <option value="Special">Special (Knuckle)</option>
                    </select>
                    <div class="small text-secondary mt-1">
                      White &amp; Blue use <b>Level</b>. Gold uses <b>Tier</b>. Special is fixed 30 BM.
                    </div>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label mb-1">Weapon Type</label>
                    <select id="bm_weap" class="form-select">
                      <option value="1H">1H</option>
                      <option value="2H">2H</option>
                      <option value="Shield">Shield</option>
                      <option value="Dagger">Dagger</option>
                    </select>
                  </div>

                  <!-- Level -->
                  <div class="col-12 col-md-6" id="bm_level_box">
                    <label class="form-label mb-1">Level</label>
                    <select id="bm_level" class="form-select">
                      <option>25</option>
                      <option>40</option>
                      <option>50</option>
                      <option>60</option>
                      <option>70</option>
                      <option>80</option>
                      <option>90</option>
                      <option>100</option>
                      <option>110</option>
                      <option>120</option>
                    </select>
                  </div>

                  <!-- Tier (Gold) with boss names -->
                  <div class="col-12 col-md-6 d-none" id="bm_tier_box">
                    <label class="form-label mb-1">Tier (Gold / Boss Group)</label>
                    <select id="bm_tier" class="form-select">
                      <option value="T0">T0 - Mistress, Phreeoni, Kraken, Eddga</option>
                      <option value="T1">T1 - Mistress I, Phreeoni I, Kraken I, Eddga I</option>
                      <option value="T2">T2 - Maya, Orc Hero, Pharaoh, Orc Lord</option>
                      <option value="T3">T3 - Doppelganger, Amon Ra</option>
                      <option value="T4">T4 - Time Holder, Morroc</option>
                      <option value="T5">T5 - Tao Gunka, Lost Dragon</option>
                      <option value="T6">T6 - Lord of the Dead, Fallen Bishop</option>
                    </select>
                    <div class="small text-secondary mt-1">Tier is grouped by boss families.</div>
                  </div>

                  <!-- Ascension (White) -->
                  <div class="col-12 col-md-6 d-none" id="bm_asc_box">
                    <label class="form-label mb-1">Ascension (White)</label>
                    <select id="bm_asc" class="form-select">
                      <option value="0">None</option>
                      <option value="1">Asc I (+10)</option>
                      <option value="2">Asc II (+20)</option>
                      <option value="3">Asc III (+30)</option>
                      <option value="4">Asc IV (+40)</option>
                      <option value="5">Asc V (+50)</option>
                      <option value="6">Asc VI (+60)</option>
                    </select>
                    <div class="small text-secondary mt-1">Effective level = Level + (Asc x 10). Snaps to the next breakpoint.</div>
                  </div>

                  <div class="col-12 d-flex gap-2">
                    <button type="button" id="bm_calc" class="btn btn-primary"><i class="fa-solid fa-calculator me-2"></i>Calculate</button>
                    <button type="button" id="bm_reset" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left me-2"></i>Reset</button>
                  </div>
                </div>

                <div id="bm_alert" class="alert alert-danger mt-3 d-none"></div>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-5">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="mb-3"><i class="fa-solid fa-list-check me-2"></i>Result</h5>
                <div id="bm_result_empty" class="text-secondary">No calculation yet.</div>
                <div id="bm_result" class="d-none">
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Rarity</span><span id="bm_rarity_out"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Weapon Type</span><span id="bm_weap_out"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1" id="bm_level_row"><span class="text-secondary">Level</span><span id="bm_level_out" class="font-monospace"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1 d-none" id="bm_tier_row"><span class="text-secondary">Tier</span><span id="bm_tier_out" class="font-monospace"></span></div>
                  <hr>
                  <div class="d-flex align-items-center justify-content-between"><span class="fw-semibold">Blessing Marks</span><span id="bm_value" class="h4 font-monospace mb-0"></span></div>
                </div>
                <small class="d-block text-secondary mt-3">
                  Special note: <em>Lord Heavy/Light Knuckle gives fixed 30 BM.</em>
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB 2: Luminary / Horcrux -->
      <div class="tab-pane fade" id="lh" role="tabpanel" tabindex="0">
        <div class="row g-3">
          <div class="col-12 col-lg-7">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="mb-3"><i class="fa-solid fa-sun me-2"></i>Luminary / Horcrux Calculator</h5>

                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="form-label mb-1">Rarity</label>
                    <select id="lh_rarity" class="form-select">
                      <option value="White">White (Luminary)</option>
                      <option value="Blue">Blue (Luminary)</option>
                      <option value="Gold">Gold (Horcrux)</option>
                    </select>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label mb-1">Weapon Type</label>
                    <select id="lh_weap" class="form-select">
                      <option value="1H">1H</option>
                      <option value="2H">2H</option>
                      <option value="Shield">Shield</option>
                      <option value="Dagger">Dagger</option>
                    </select>
                  </div>

                  <!-- Level for White/Blue -->
                  <div class="col-12 col-md-6" id="lh_level_box">
                    <label class="form-label mb-1">Level</label>
                    <select id="lh_level" class="form-select">
                      <option>25</option>
                      <option>40</option>
                      <option>50</option>
                      <option>60</option>
                      <option>70</option>
                      <option>80</option>
                      <option>90</option>
                      <option>100</option>
                      <option>110</option>
                      <option>120</option>
                    </select>
                  </div>

                  <!-- Tier (Gold) with boss names -->
                  <div class="col-12 col-md-6 d-none" id="lh_tier_box">
                    <label class="form-label mb-1">Tier (Gold / Boss Group)</label>
                    <select id="lh_tier" class="form-select">
                      <option value="T0">T0 - Mistress, Phreeoni, Kraken, Eddga</option>
                      <option value="T1">T1 - Mistress I, Phreeoni I, Kraken I, Eddga I</option>
                      <option value="T2">T2 - Maya, Orc Hero, Pharaoh, Orc Lord</option>
                      <option value="T3">T3 - Doppelganger, Amon Ra</option>
                      <option value="T4">T4 - Time Holder, Morroc</option>
                      <option value="T5">T5 - Tao Gunka, Lost Dragon</option>
                      <option value="T6">T6 - Lord of the Dead, Fallen Bishop</option>
                    </select>
                    <div class="small text-secondary mt-1">Stages map to tiers; labels show the boss groups.</div>
                  </div>

                  <div class="col-12 d-flex gap-2">
                    <button type="button" id="lh_calc" class="btn btn-primary"><i class="fa-solid fa-calculator me-2"></i>Calculate</button>
                    <button type="button" id="lh_reset" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left me-2"></i>Reset</button>
                  </div>
                </div>

                <div id="lh_alert" class="alert alert-danger mt-3 d-none"></div>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-5">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="mb-3"><i class="fa-solid fa-list-check me-2"></i>Result</h5>
                <div id="lh_result_empty" class="text-secondary">No calculation yet.</div>
                <div id="lh_result" class="d-none">
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Rarity</span><span id="lh_rarity_out"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Weapon Type</span><span id="lh_weap_out"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1" id="lh_level_row"><span class="text-secondary">Level</span><span id="lh_level_out" class="font-monospace"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1 d-none" id="lh_tier_row"><span class="text-secondary">Tier</span><span id="lh_tier_out" class="font-monospace"></span></div>
                  <hr>
                  <div class="d-flex align-items-center justify-content-between"><span class="fw-semibold">Yield</span><span id="lh_value" class="h4 font-monospace mb-0"></span></div>
                </div>
                <small class="d-block text-secondary mt-3">Numbers match the sheet you provided.</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB 3: Upgrade Cost -->
      <div class="tab-pane fade" id="upg" role="tabpanel" tabindex="0">
        <div class="row g-3">
          <div class="col-12 col-lg-7">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="mb-3"><i class="fa-solid fa-arrow-up-right-dots me-2"></i>Shadow Equipment Upgrade Cost</h5>

                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="form-label mb-1">Category</label>
                    <select id="upg_cat" class="form-select">
                      <option value="cat1">1H + Shield</option>
                      <option value="cat2">2H / Dual-Dagger</option>
                    </select>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label mb-1">Target Level</label>
                    <select id="upg_level" class="form-select">
                      <option value="1">Lv.0 -> Lv.1</option>
                      <option value="2">Lv.1 -> Lv.2</option>
                      <option value="3">Lv.2 -> Lv.3</option>
                      <option value="4">Lv.3 -> Lv.4</option>
                      <option value="5">Lv.4 -> Lv.5</option>
                      <option value="6">Lv.5 -> Lv.6</option>
                      <option value="7">Lv.6 -> Lv.7</option>
                      <option value="8">Lv.7 -> Lv.8</option>
                      <option value="9">Lv.8 -> Lv.9</option>
                      <option value="10">Lv.9 -> Lv.10</option>
                    </select>
                    <div class="small text-secondary mt-1">Choose the step you want to view or sum up to.</div>
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="upg_sum" checked>
                      <label class="form-check-label" for="upg_sum">Sum from Lv.0 to the selected target</label>
                    </div>
                  </div>

                  <div class="col-12 d-flex gap-2">
                    <button type="button" id="upg_calc" class="btn btn-primary"><i class="fa-solid fa-calculator me-2"></i>Calculate</button>
                    <button type="button" id="upg_reset" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left me-2"></i>Reset</button>
                  </div>
                </div>

                <div id="upg_alert" class="alert alert-danger mt-3 d-none"></div>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-5">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="mb-3"><i class="fa-solid fa-list-check me-2"></i>Result</h5>
                <div id="upg_result_empty" class="text-secondary">No calculation yet.</div>
                <div id="upg_result" class="d-none">
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Category</span><span id="upg_cat_out"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Range</span><span id="upg_range_out" class="font-monospace"></span></div>
                  <hr>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Zeny</span><span id="upg_zeny" class="font-monospace"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Guild Contribution</span><span id="upg_gc" class="font-monospace"></span></div>
                  <div class="d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 py-1"><span class="text-secondary">Luminary</span><span id="upg_lum" class="font-monospace"></span></div>
                  <div class="d-flex align-items-center justify-content-between"><span class="text-secondary">Horcrux</span><span id="upg_hor" class="font-monospace"></span></div>
                </div>
                <small class="d-block text-secondary mt-3">
                  Luminary / Horcrux amounts are grouped by tier (I, II, III, IV).
                </small>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- /UPGRADE COST -->
    </div>

    <!-- Footer -->
    <?= view('partials/site_footer') ?>
  </div>

  <!-- ====== BM data (exact values) ====== -->
  <script>
    const BM_WHITE = {
      '1H': {
        25: 2,
        40: 4,
        50: 6,
        60: 9,
        70: 13,
        80: 20,
        90: 30,
        100: 45,
        110: 66,
        120: 100
      },
      '2H': {
        25: 3,
        40: 6,
        50: 9,
        60: 13,
        70: 20,
        80: 30,
        90: 45,
        100: 67,
        110: 99,
        120: 150
      },
      'Shield': {
        25: 1,
        40: 2,
        50: 3,
        60: 4,
        70: 6,
        80: 10,
        90: 15,
        100: 22,
        110: 33,
        120: 50
      },
      'Dagger': {
        25: 1,
        40: 3,
        50: 4,
        60: 6,
        70: 10,
        80: 15,
        90: 22,
        100: 33,
        110: 49,
        120: 75
      }
    };
    const BM_BLUE = {
      '1H': {
        25: 6,
        40: 13,
        50: 20,
        60: 30,
        70: 45,
        80: 66,
        90: 100,
        100: 150,
        110: 220,
        120: 333
      },
      '2H': {
        25: 10,
        40: 20,
        50: 30,
        60: 45,
        70: 67,
        80: 100,
        90: 150,
        100: 220,
        110: 330,
        120: 500
      },
      'Shield': {
        25: 3,
        40: 6,
        50: 10,
        60: 15,
        70: 22,
        80: 33,
        90: 50,
        100: 75,
        110: 110,
        120: 166
      },
      'Dagger': {
        25: 5,
        40: 10,
        50: 15,
        60: 22,
        70: 33,
        80: 50,
        90: 75,
        100: 110,
        110: 165,
        120: 250
      }
    };
    const BM_GOLD = {
      '1H': {
        T0: 300,
        T1: 450,
        T2: 660,
        T3: 990,
        T4: 1500,
        T5: 2250,
        T6: 3000
      },
      '2H': {
        T0: 450,
        T1: 675,
        T2: 990,
        T3: 1485,
        T4: 2250,
        T5: 3375,
        T6: 4500
      },
      'Shield': {
        T0: 150,
        T1: 225,
        T2: 330,
        T3: 495,
        T4: 750,
        T5: 1125,
        T6: 1500
      },
      'Dagger': {
        T0: 225,
        T1: 337,
        T2: 495,
        T3: 742,
        T4: 1125,
        T5: 1687,
        T6: 2250
      }
    };
    const SPECIAL_KNUCKLE_BM = 30;

    const TIER_LABELS = {
      T0: 'Mistress, Phreeoni, Kraken, Eddga',
      T1: 'Mistress I, Phreeoni I, Kraken I, Eddga I',
      T2: 'Maya, Orc Hero, Pharaoh, Orc Lord',
      T3: 'Doppelganger, Amon Ra',
      T4: 'Time Holder, Morroc',
      T5: 'Tao Gunka, Lost Dragon',
      T6: 'Lord of the Dead, Fallen Bishop'
    };

    const WHITE_BREAKPOINTS = [25, 40, 50, 60, 70, 80, 90, 100, 110, 120];

    function computeBM(rarity, weap, levelOrSnap, tier) {
      if (rarity === 'Special') return SPECIAL_KNUCKLE_BM;
      if (rarity === 'Gold') {
        const r = BM_GOLD[weap];
        return r ? (r[tier] ?? null) : null;
      }
      const table = (rarity === 'White') ? BM_WHITE : BM_BLUE;
      const row = table[weap];
      return row ? (row[levelOrSnap] ?? null) : null;
    }
  </script>

  <!-- ====== Luminary/Horcrux data file ====== -->
  <script>
    const LHDATA_URL = <?= function_exists('base_url')
                          ? json_encode(base_url('assets/shadowsmelt/js/smelt-data.js'))
                          : json_encode('/assets/shadowsmelt/js/smelt-data.js') ?>;
    const s = document.createElement('script');
    s.src = LHDATA_URL;
    document.head.appendChild(s);
  </script>

  <!-- ====== Upgrade Cost (from your image) ====== -->
  <script>
    // Each step is 1..10 (0->1 .. 9->10)
    // Store as: { z: number, gc: number, lum: {I:0,II:0,III:0,IV:0}, hor: {I:0,II:0,III:0,IV:0} }
    // 1H + Shield
    const UPG_CAT1 = [
      null,
      {
        z: 25600,
        gc: 4,
        lum: {
          I: 36,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 51200,
        gc: 8,
        lum: {
          I: 0,
          II: 36,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 128000,
        gc: 20,
        lum: {
          I: 0,
          II: 45,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 256000,
        gc: 40,
        lum: {
          I: 0,
          II: 0,
          III: 90,
          IV: 0
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 512000,
        gc: 80,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 90
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 1280000,
        gc: 200,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 225
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 2560000,
        gc: 400,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 600,
          II: 0,
          III: 0,
          IV: 0
        }
      }, // 400+200 I
      {
        z: 3840000,
        gc: 600,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 900,
          II: 0,
          III: 0,
          IV: 0
        }
      }, // 600+300 I
      {
        z: 5120000,
        gc: 800,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 600,
          III: 0,
          IV: 0
        }
      }, // 400+200 II
      {
        z: 6400000,
        gc: 1000,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 750,
          III: 0,
          IV: 0
        }
      } // 500+250 II
    ];

    // 2H / Dual-Dagger
    const UPG_CAT2 = [
      null,
      {
        z: 25600,
        gc: 4,
        lum: {
          I: 36,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 51200,
        gc: 8,
        lum: {
          I: 0,
          II: 36,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 128000,
        gc: 20,
        lum: {
          I: 0,
          II: 45,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 256000,
        gc: 40,
        lum: {
          I: 0,
          II: 0,
          III: 90,
          IV: 0
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 512000,
        gc: 80,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 90
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 1280000,
        gc: 200,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 225
        },
        hor: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 2560000,
        gc: 400,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 600,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 3840000,
        gc: 600,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 900,
          II: 0,
          III: 0,
          IV: 0
        }
      },
      {
        z: 5120000,
        gc: 800,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 600,
          III: 0,
          IV: 0
        }
      },
      {
        z: 6400000,
        gc: 1000,
        lum: {
          I: 0,
          II: 0,
          III: 0,
          IV: 0
        },
        hor: {
          I: 0,
          II: 750,
          III: 0,
          IV: 0
        }
      }
    ];

    function addStage(a, b) {
      return {
        I: a.I + b.I,
        II: a.II + b.II,
        III: a.III + b.III,
        IV: a.IV + b.IV
      };
    }

    function fmtStages(obj) {
      const parts = [];
      if (obj.I) parts.push(`${obj.I} I`);
      if (obj.II) parts.push(`${obj.II} II`);
      if (obj.III) parts.push(`${obj.III} III`);
      if (obj.IV) parts.push(`${obj.IV} IV`);
      return parts.length ? parts.join(' + ') : '-';
    }
  </script>

  <!-- ====== Wiring & logic (BM / LH / Upgrade) ====== -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Fallbacks if data file hasn't loaded yet
      window.getLuminaryAmount = window.getLuminaryAmount || function() {
        return null
      };
      window.getHorcruxAmount = window.getHorcruxAmount || function() {
        return null
      };

      /* -------- BM wiring -------- */
      const bmRarity = document.getElementById('bm_rarity');
      const bmWeap = document.getElementById('bm_weap');
      const bmLevelB = document.getElementById('bm_level_box');
      const bmTierB = document.getElementById('bm_tier_box');
      const bmAscB = document.getElementById('bm_asc_box');
      const bmLevel = document.getElementById('bm_level');
      const bmTier = document.getElementById('bm_tier');
      const bmAsc = document.getElementById('bm_asc');
      const bmAlert = document.getElementById('bm_alert');

      function syncBMFields() {
        const r = bmRarity.value;
        bmWeap.disabled = (r === 'Special');
        if (r === 'Gold') {
          bmLevelB.classList.add('d-none');
          bmTierB.classList.remove('d-none');
          bmAscB.classList.add('d-none');
        } else if (r === 'Special') {
          bmLevelB.classList.add('d-none');
          bmTierB.classList.add('d-none');
          bmAscB.classList.add('d-none');
        } else {
          bmLevelB.classList.remove('d-none');
          bmTierB.classList.add('d-none');
          bmAscB.classList.toggle('d-none', r !== 'White');
        }
      }
      bmRarity.addEventListener('change', syncBMFields);
      syncBMFields();

      document.getElementById('bm_calc').addEventListener('click', (e) => {
        e.preventDefault();
        bmAlert.classList.add('d-none');
        bmAlert.textContent = '';

        const rarity = bmRarity.value,
          weap = bmWeap.value,
          lvl = parseInt(bmLevel.value, 10);
        const tier = bmTier.value,
          asc = (rarity === 'White') ? parseInt(bmAsc.value, 10) : 0;

        // snap for White
        let snapped = lvl;
        if (rarity === 'White') {
          const eff = lvl + asc * 10;
          snapped = WHITE_BREAKPOINTS.find(b => b >= eff) ?? 120;
        }

        const val = computeBM(rarity, weap, snapped, tier);
        if (val == null) {
          bmAlert.textContent = (rarity === 'Gold') ?
            `Oops! Missing BM for ${rarity} ${weap} ${tier}.` :
            (rarity === 'Special' ? `Special Knuckle is fixed to 30 BM.` : `Oops! Missing BM for ${rarity} ${weap} (snapped Lv.${snapped}).`);
          bmAlert.classList.remove('d-none');
          return;
        }

        document.getElementById('bm_result_empty').classList.add('d-none');
        document.getElementById('bm_result').classList.remove('d-none');
        document.getElementById('bm_rarity_out').textContent = rarity;
        document.getElementById('bm_weap_out').textContent = weap;
        document.getElementById('bm_value').textContent = Number(val).toLocaleString();

        const lvlRow = document.getElementById('bm_level_row');
        const tierRow = document.getElementById('bm_tier_row');

        if (rarity === 'Gold') {
          lvlRow.classList.add('d-none');
          tierRow.classList.remove('d-none');
          const label = `${tier} - ${TIER_LABELS[tier] || ''}`;
          document.getElementById('bm_tier_out').textContent = label;
        } else if (rarity === 'Special') {
          lvlRow.classList.add('d-none');
          tierRow.classList.add('d-none');
        } else {
          tierRow.classList.add('d-none');
          lvlRow.classList.remove('d-none');
          document.getElementById('bm_level_out').textContent = snapped;
        }
      });

      document.getElementById('bm_reset').addEventListener('click', () => {
        bmRarity.value = 'White';
        bmWeap.value = '1H';
        bmLevel.value = '25';
        bmTier.value = 'T0';
        bmAsc.value = '0';
        syncBMFields();
        document.getElementById('bm_result').classList.add('d-none');
        document.getElementById('bm_result_empty').classList.remove('d-none');
        bmAlert.classList.add('d-none');
        bmAlert.textContent = '';
      });

      /* -------- Lum/Hor wiring -------- */
      const lhRarity = document.getElementById('lh_rarity');
      const lhWeap = document.getElementById('lh_weap');
      const lhLevelB = document.getElementById('lh_level_box');
      const lhTierB = document.getElementById('lh_tier_box');
      const lhLevel = document.getElementById('lh_level');
      const lhTier = document.getElementById('lh_tier');
      const lhAlert = document.getElementById('lh_alert');

      function syncLHFields() {
        const r = lhRarity.value;
        if (r === 'Gold') {
          lhLevelB.classList.add('d-none');
          lhTierB.classList.remove('d-none');
        } else {
          lhLevelB.classList.remove('d-none');
          lhTierB.classList.add('d-none');
        }
      }
      lhRarity.addEventListener('change', syncLHFields);
      syncLHFields();

      document.getElementById('lh_calc').addEventListener('click', (e) => {
        e.preventDefault();
        lhAlert.classList.add('d-none');
        lhAlert.textContent = '';
        const r = lhRarity.value,
          w = lhWeap.value,
          lvl = parseInt(lhLevel.value, 10),
          t = lhTier.value;
        let val = (r === 'Gold') ? getHorcruxAmount(w, t) : getLuminaryAmount(r, w, lvl);

        if (val == null) {
          lhAlert.textContent = (r === 'Gold') ? `Oops! No Horcrux yield for ${w} ${t}.` : `Oops! No Luminary yield for ${r} ${w} Lv.${lvl}.`;
          lhAlert.classList.remove('d-none');
          return;
        }
        document.getElementById('lh_result_empty').classList.add('d-none');
        document.getElementById('lh_result').classList.remove('d-none');
        document.getElementById('lh_rarity_out').textContent = r;
        document.getElementById('lh_weap_out').textContent = w;
        document.getElementById('lh_value').textContent = Number(val).toLocaleString();

        const lvlRow = document.getElementById('lh_level_row');
        const tierRow = document.getElementById('lh_tier_row');
        if (r === 'Gold') {
          lvlRow.classList.add('d-none');
          tierRow.classList.remove('d-none');
          const label = `${t} - ${TIER_LABELS[t] || ''}`;
          document.getElementById('lh_tier_out').textContent = label;
        } else {
          lvlRow.classList.remove('d-none');
          tierRow.classList.add('d-none');
          document.getElementById('lh_level_out').textContent = lvl;
        }
      });

      document.getElementById('lh_reset').addEventListener('click', () => {
        lhRarity.value = 'White';
        lhWeap.value = '1H';
        lhLevel.value = '25';
        lhTier.value = 'T0';
        syncLHFields();
        document.getElementById('lh_result').classList.add('d-none');
        document.getElementById('lh_result_empty').classList.remove('d-none');
        lhAlert.classList.add('d-none');
        lhAlert.textContent = '';
      });

      /* -------- Upgrade Cost wiring -------- */
      const upgCat = document.getElementById('upg_cat');
      const upgLevel = document.getElementById('upg_level');
      const upgSum = document.getElementById('upg_sum');
      const upgAlert = document.getElementById('upg_alert');

      function getStepData(cat, step) {
        const arr = (cat === 'cat1') ? UPG_CAT1 : UPG_CAT2;
        return arr[step];
      }

      function sumRange(cat, toStep) {
        let z = 0,
          gc = 0,
          lum = {
            I: 0,
            II: 0,
            III: 0,
            IV: 0
          },
          hor = {
            I: 0,
            II: 0,
            III: 0,
            IV: 0
          };
        for (let s = 1; s <= toStep; s++) {
          const it = getStepData(cat, s);
          z += it.z;
          gc += it.gc;
          lum = addStage(lum, it.lum);
          hor = addStage(hor, it.hor);
        }
        return {
          z,
          gc,
          lum,
          hor,
          from: 0,
          to: toStep
        };
      }

      function singleStep(cat, step) {
        const it = getStepData(cat, step);
        return {
          z: it.z,
          gc: it.gc,
          lum: it.lum,
          hor: it.hor,
          from: step - 1,
          to: step
        };
      }

      document.getElementById('upg_calc').addEventListener('click', () => {
        upgAlert.classList.add('d-none');
        upgAlert.textContent = '';
        const cat = upgCat.value;
        const step = parseInt(upgLevel.value, 10);
        const res = upgSum.checked ? sumRange(cat, step) : singleStep(cat, step);

        document.getElementById('upg_result_empty').classList.add('d-none');
        document.getElementById('upg_result').classList.remove('d-none');
        document.getElementById('upg_cat_out').textContent = (cat === 'cat1') ? '1H + Shield' : '2H / Dual-Dagger';
        document.getElementById('upg_range_out').textContent = `Lv.${res.from} -> Lv.${res.to}`;

        document.getElementById('upg_zeny').textContent = res.z.toLocaleString();
        document.getElementById('upg_gc').textContent = res.gc.toLocaleString();
        document.getElementById('upg_lum').textContent = fmtStages(res.lum);
        document.getElementById('upg_hor').textContent = fmtStages(res.hor);
      });

      document.getElementById('upg_reset').addEventListener('click', () => {
        upgCat.value = 'cat1';
        upgLevel.value = '1';
        upgSum.checked = true;
        document.getElementById('upg_result').classList.add('d-none');
        document.getElementById('upg_result_empty').classList.remove('d-none');
        upgAlert.classList.add('d-none');
        upgAlert.textContent = '';
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>

