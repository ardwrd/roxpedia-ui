<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Haste Calculator - ROXPEDIA</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">

    <!-- Header -->
    <?= view('partials/site_header') ?>

    <!-- Main -->
    <main class="col-lg-12">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h3 class="mb-1">Haste Calculator</h3>
          <p class="text-secondary mb-0">Simulasikan <b>Final Haste</b>-mu, cek status cap tiap skill, dan lihat <b>kebutuhan Haste</b>-nya.</p>
        </div>
        <a href="<?= function_exists('previous_url') ? previous_url() : (function_exists('site_url') ? site_url('') : '/') ?>" class="btn btn-outline-secondary">
          <i class="fa-solid fa-arrow-left-long me-1"></i> Back
        </a>
      </div>

      <div class="row g-4">
        <!-- LEFT: Inputs -->
        <div class="col-12 col-lg-5">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-3"><i class="fa-solid fa-sliders me-2 text-primary"></i>Inputs</h5>

              <div class="mb-3">
                <label class="form-label fw-semibold">Haste (angka mentah)</label>
                <input type="number" inputmode="numeric" id="inp-haste" class="form-control" min="0" step="1" value="1964">
                <div class="form-text">Total Haste dari stat/gear. Contoh: <kbd class="px-1">1964</kbd></div>
              </div>

              <div class="mb-2 form-check">
                <input class="form-check-input" type="checkbox" id="chk-use-pet" checked>
                <label class="form-check-label" for="chk-use-pet">
                  Gunakan Pet / Buff yang memberi <em>Final Haste</em>
                </label>
              </div>

              <div id="wrap-pet" class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label fw-semibold">Final Haste dari Pet/Buff (%)</label>
                  <input type="number" id="inp-fh-bonus" class="form-control" min="0" step="0.01" value="40.41">
                  <div class="form-text">Contoh: Pet Ghoul = <kbd class="px-1">40.41 %</kbd></div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label fw-semibold">Cap Global (%)</label>
                  <input type="number" id="inp-cap-global" class="form-control" min="50" max="95" step="0.1" value="95">
                  <div class="form-text">
                    <b>Cap Global</b> = batas maksimum efek Haste secara sistem. Default <b>95%</b>.
                    Jika total Final Haste melewati angka ini, efeknya tetap dibatasi di sini.
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Pilih Skill</label>
                <select id="inp-skill" class="form-select">
                  <option value="LB">Lightning Bolt</option>
                  <option value="SG">Storm Gust</option>
                  <option value="LoV">Lord of Vermilion</option>
                  <option value="CL">Chain Lightning</option>
                </select>
              </div>

              <!-- Cast Level slider (LB only) -->
              <div id="wrap-castlevel" class="mb-3 d-none">
                <label class="form-label fw-semibold">Cast Level (Lightning Bolt)</label>
                <input type="range" class="form-range" min="0" max="100" step="1" id="inp-castlevel" value="100">
                <div class="d-flex justify-content-between">
                  <small class="text-secondary">0 %</small>
                  <small class="text-secondary">100 %</small>
                </div>
                <div class="form-text">100 % slider ~= menghapus 39.13 % dari Variable Channeling LB.</div>
              </div>

              <button id="btn-calc" class="btn btn-primary w-100 mt-1">
                <i class="fa-solid fa-calculator me-1"></i>Hitung Sekarang
              </button>
            </div>
          </div>
        </div>

        <!-- RIGHT: Results -->
        <div class="col-12 col-lg-7">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-3"><i class="fa-solid fa-square-poll-vertical me-2 text-primary"></i>Results</h5>

              <div class="border-start border-4 border-primary bg-primary bg-opacity-10 rounded p-3 mb-3">
                <i class="fa-solid fa-circle-info me-2"></i>
                Hasil di bawah = efek Haste kamu saat ini. Panel <b>Kebutuhan</b> akan menunjukkan
                berapa <b>Final Haste</b> & <b>Haste (raw)</b> yang diperlukan untuk mencapai cap (jika memungkinkan).
              </div>

              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <div class="p-3 rounded border h-100">
                    <div class="small text-secondary">Final Haste dari Haste</div>
                    <div class="fs-4 fw-semibold" id="out-fh-from-haste">0 %</div>
                    <div class="small text-secondary">Rumus = 0.0000733 x Haste</div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="p-3 rounded border h-100">
                    <div class="small text-secondary">Total Final Haste</div>
                    <div class="fs-4 fw-semibold" id="out-total-fh">0 %</div>
                    <div class="small text-secondary">Termasuk Pet/Buff (jika dicentang), dibatasi Cap Global</div>
                  </div>
                </div>
              </div>

              <hr class="my-4">

              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <div class="p-3 rounded border h-100">
                    <div class="small text-secondary">Variable Cooldown Final</div>
                    <div class="fs-4 fw-semibold" id="out-vcd-final">-</div>
                    <div class="small text-secondary">Fixed CD: <span id="out-fixedcd">-</span></div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="p-3 rounded border h-100">
                    <div class="small text-secondary">Variable Channeling Final</div>
                    <div class="fs-4 fw-semibold" id="out-vct-final">-</div>
                    <div class="small text-secondary">Fixed CT: <span id="out-fixedct">-</span></div>
                  </div>
                </div>
              </div>

              <div id="out-status" class="alert text-center fw-semibold d-none" role="alert"></div>

              <!-- Rekomendasi Level -->
              <div class="mt-3">
                <h6 class="mb-2"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>Rekomendasi Level Skill</h6>
                <div id="rec-box" class="border border-secondary rounded p-2 small text-secondary">Isi input lalu klik <b>Hitung Sekarang</b> untuk melihat saran level.</div>
              </div>

              <!-- Kebutuhan -->
              <div class="mt-3">
                <h6 class="mb-2"><i class="fa-solid fa-flag-checkered me-2"></i>Kebutuhan untuk Cap</h6>
                <div id="need-box" class="border border-secondary rounded p-2 small text-secondary">
                  Panel ini akan menampilkan kebutuhan <b>Total Final Haste</b> dan <b>Haste (raw)</b>:
                  tanpa pet & dengan pet (jika dicentang). Jika mustahil karena <em>Cap Global</em> atau <em>batas skill</em>, akan diberi keterangan.
                </div>
              </div>

              <div class="mt-3 small text-secondary" id="out-breakdown"></div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // ===== Konstanta & preset dari data kamu =====
    const HASTE_TO_PERCENT = 0.0000733; // 0.00733% per 1 Haste
    const PRESETS = {
        Ragnarok X: Next Generation images & contents ? Gravity Co. / Lee MyoungJin (Studio DDTS).
        name: 'Lightning Bolt',
        baseVCD: 0,
        fixedCD: 0,
        baseVCT: 9,
        fixedCT: 1,
        capSkill: 1.00,
        castLevelRateMax: 0.3913
      },
      SG: {
        name: 'Storm Gust',
        baseVCD: 24,
        fixedCD: 3,
        baseVCT: 0,
        fixedCT: 0.6,
        capSkill: 0.95,
        castLevelRateMax: 0
      },
      LoV: {
        name: 'Lord of Vermilion',
        baseVCD: 24,
        fixedCD: 2.5,
        baseVCT: 0,
        fixedCT: 0.6,
        capSkill: 1.00,
        castLevelRateMax: 0
      },
      CL: {
        name: 'Chain Lightning',
        baseVCD: 28,
        fixedCD: 4,
        baseVCT: 0,
        fixedCT: 0,
        capSkill: 0.814,
        castLevelRateMax: 0
      }
    };

    // ===== Model empiris "sisa minimum" per level (dari SS kamu) =====
    // SG: Lv1=0s, Lv10=1.2s -> linear
    function capRemainSG(level) {
      return Math.max(0, (level - 1) * (1.2 / 9));
    }
    // CL: Lv1..9=0s, Lv10=5.2s
    function capRemainCL(level) {
      return (level === 10) ? 5.2 : 0;
    }
    // LoV: semua level 0s (bisa 0 penuh)
    function capRemainLoV(level) {
      return 0;
    }

    // Base variable per level (estimasi linear dari data):
    // SG: Lv1=6s, Lv10=24s -> +2s/level (rumus: 4 + 2*lv)
    function baseVcdSG(level) {
      return 4 + 2 * level;
    }
    // CL: Lv9=26s, Lv10=28s -> +2s/level (rumus: 8 + 2*lv)
    function baseVcdCL(level) {
      return 8 + 2 * level;
    }
    // LoV: samakan dengan SG jika dipakai lintas level
    function baseVcdLoV(level) {
      return 4 + 2 * level;
    }

    // LB (VCT) per level (approx, fokus ke LB MAX=9s):
    function baseVctLB(level) {
      return (level >= 10) ? 9 : (level >= 9 ? 8 : 7 + 0.125 * level);
    }

    // ===== UI toggles =====
    const elSkill = document.getElementById('inp-skill');
    const wrapCast = document.getElementById('wrap-castlevel');
    const chkUsePet = document.getElementById('chk-use-pet');
    const wrapPet = document.getElementById('wrap-pet');

    function toggleCast() {
      wrapCast.classList.toggle('d-none', elSkill.value !== 'LB');
    }

    function togglePet() {
      wrapPet.classList.toggle('d-none', !chkUsePet.checked);
    }
    elSkill.addEventListener('change', toggleCast);
    chkUsePet.addEventListener('change', togglePet);
    toggleCast();
    togglePet();

    function fmtPct(x) {
      return (x * 100).toFixed(2) + ' %';
    }

    function fmtSec(x) {
      return x.toFixed(2) + ' s';
    }

    function clamp(x, a, b) {
      return Math.max(a, Math.min(b, x));
    }

    // ===== Rekomendasi level (seperti versi sebelumnya) =====
    function recommendLevel(totalFH, skillKey) {
      if (skillKey === 'LB') {
        const needRate = Math.max(0, 1 - totalFH); // proporsi base yang mesti dihapus slider
        const sliderPct = Math.min(100, (needRate / PRESETS.LB.castLevelRateMax) * 100);
        const canFull = (needRate <= PRESETS.LB.castLevelRateMax + 1e-6);
        return `<b>Lightning Bolt</b>: ${canFull ? 'Bisa Full Cap' : 'Belum Cap'}
            <div>Minimal slider: <b>${sliderPct.toFixed(1)}%</b> (maks 100%)</div>
            <div class="text-secondary">Catatan: slider 100% ~= hapus 39.13% dari Variable Channeling.</div>`;
      }

      let best = {
        level: 1,
        final: Infinity,
        raw: 0,
        cap: 0
      };
      for (let lv = 1; lv <= 10; lv++) {
        let baseV = 0,
          capR = 0;
        if (skillKey === 'SG') {
          baseV = baseVcdSG(lv);
          capR = capRemainSG(lv);
        } else if (skillKey === 'CL') {
          baseV = baseVcdCL(lv);
          capR = capRemainCL(lv);
        } else if (skillKey === 'LoV') {
          baseV = baseVcdLoV(lv);
          capR = capRemainLoV(lv);
        }

        const raw = baseV * (1 - totalFH);
        const finalVar = Math.min(raw, capR);
        if (finalVar < best.final - 1e-6) {
          best = {
            level: lv,
            final: finalVar,
            raw: raw,
            cap: capR
          };
        }
      }
      const label = (best.final <= 0.0001) ? 'Full Cap' : 'Belum Cap';
      return `<b>${PRESETS[skillKey].name}</b>: ${label}
          <div>Rekomendasi level: <b>Lv.${best.level}</b></div>
          <div>Sisa variable (perkiraan): <b>${fmtSec(best.final)}</b></div>
          <div class="text-secondary">Raw tanpa mekanik skill: ${fmtSec(best.raw)} | Batas sisa minimum level tsb: ${fmtSec(best.cap)}</div>`;
    }

    // ===== Panel Kebutuhan (tanpa & dengan pet) =====
    function needPanel(totalFH, capGlobal, usePet, petFH, skillKey) {
      // Target: 0s variable (Full Cap) BILA memungkinkan oleh "sisa minimum" skill di suatu level.
      // Rumus kebutuhan TotalFH (untuk level tertentu):
      //   baseV * (1 - TotalFH) <= capRemain(level)
      //   => TotalFH >= 1 - capRemain/ baseV
      // Kita pilih level "termudah" (paling kecil TotalFH req).
      if (skillKey === 'LB') {
        // Untuk LB (VCT), syarat full cap = totalFH >= castLevelRate (sesuai slider user)
        const slider = (+document.getElementById('inp-castlevel').value || 0) / 100;
        const castRate = PRESETS.LB.castLevelRateMax * slider; // proporsi yang dihapus slider
        const fhNeed = castRate; // totalFH minimal
        const impossible = fhNeed > capGlobal + 1e-9;
        const needRawNoPet = clamp(fhNeed, 0, 1); // tanpa pet
        const needRawWithPet = clamp(Math.max(0, fhNeed - (usePet ? petFH : 0)), 0, 1);
        const hasteNoPet = Math.ceil(needRawNoPet / HASTE_TO_PERCENT);
        const hasteWithPet = Math.ceil(needRawWithPet / HASTE_TO_PERCENT);
        return `<div><b>Target Full Cap LB</b> (sesuai slider saat ini)</div>
            <div>Diperlukan Total Final Haste >= <b>${fmtPct(fhNeed)}</b> ${impossible?'<span class="badge bg-danger ms-1">Terhalang Cap Global</span>':''}</div>
            <div class="mt-1">Tanpa pet: butuh Haste >= <b>${hasteNoPet}</b> (~ ${fmtPct(needRawNoPet)})</div>
            <div>Dengan pet${usePet?' (aktif)':''}: butuh Haste >= <b>${hasteWithPet}</b> (~ ${fmtPct(needRawWithPet)})</div>`;
      }

      // Non-LB (pakai model per level)
      let best = {
        level: 1,
        fhNeed: Infinity,
        capR: 0,
        baseV: 0
      };
      for (let lv = 1; lv <= 10; lv++) {
        let baseV = 0,
          capR = 0;
        if (skillKey === 'SG') {
          baseV = baseVcdSG(lv);
          capR = capRemainSG(lv);
        } else if (skillKey === 'CL') {
          baseV = baseVcdCL(lv);
          capR = capRemainCL(lv);
        } else if (skillKey === 'LoV') {
          baseV = baseVcdLoV(lv);
          capR = capRemainLoV(lv);
        }

        // jika capR == 0 -> bisa 0s murni, syarat: TotalFH >= 1 - 0/baseV = 1
        // (tetapi LoV empiris di data kamu bisa 0s meski TotalFH < 1 karena ada mekanik internal.
        // Agar konsisten dengan data: bila capR==0, kita set fhNeed=totalFH yang membuat raw<=0 -> fhNeed=1.0 (konservatif).
        let fhNeed = 1.0 - (capR / baseV);
        fhNeed = clamp(fhNeed, 0, 1);

        // pilih yang butuh FH paling kecil
        if (fhNeed < best.fhNeed - 1e-9) {
          best = {
            level: lv,
            fhNeed,
            capR,
            baseV
          };
        }
      }

      const impossible = best.fhNeed > capGlobal + 1e-9;
      const needRawNoPet = clamp(best.fhNeed, 0, 1);
      const needRawWithPet = clamp(Math.max(0, best.fhNeed - (usePet ? petFH : 0)), 0, 1);
      const hasteNoPet = Math.ceil(needRawNoPet / HASTE_TO_PERCENT);
      const hasteWithPet = Math.ceil(needRawWithPet / HASTE_TO_PERCENT);

      // Jika best.fhNeed == 1 dan secara empiris skill tsb memang tak bisa 0 di level tinggi (mis. SG10, CL10),
      // user masih dibantu oleh level rekomendasi (panel atas) untuk memilih level yang lebih "masuk akal".
      return `<div><b>Target Full Cap</b> (level termudah: Lv.${best.level})</div>
          <div>Diperlukan Total Final Haste >= <b>${fmtPct(best.fhNeed)}</b> ${impossible?'<span class="badge bg-danger ms-1">Terhalang Cap Global</span>':''}</div>
          <div class="mt-1">Tanpa pet: butuh Haste >= <b>${hasteNoPet}</b> (~ ${fmtPct(needRawNoPet)})</div>
          <div>Dengan pet${usePet?' (aktif)':''}: butuh Haste >= <b>${hasteWithPet}</b> (~ ${fmtPct(needRawWithPet)})</div>
          <div class="text-secondary mt-1">Jika requirement melebihi Cap Global atau skill punya sisa minimum di level tertentu, gunakan <b>Rekomendasi Level</b> di atas.</div>`;
    }

    // ===== Kalkulasi utama =====
    function fmtSec(x) {
      return x.toFixed(2) + ' s';
    }

    function fmtPct(x) {
      return (x * 100).toFixed(2) + ' %';
    }

    function calculate() {
      const haste = +document.getElementById('inp-haste').value || 0;
      const usePet = document.getElementById('chk-use-pet').checked;
      const fhBonus = (usePet ? (+document.getElementById('inp-fh-bonus').value || 0) : 0) / 100;
      const capGlobal = (+document.getElementById('inp-cap-global').value || 95) / 100;
      const skillKey = document.getElementById('inp-skill').value;
      const castSlider = (+document.getElementById('inp-castlevel').value || 0) / 100;

      const S = PRESETS[skillKey];

      // 1) FH dari Haste & Total
      const fhFromHaste = haste * HASTE_TO_PERCENT;
      const totalFH = Math.min(capGlobal, fhFromHaste + fhBonus);

      // 2) Effective reduction utk VCD (cap per-skill)
      const effectiveReduction = Math.min(totalFH, S.capSkill);

      // 3) Hitung VCD & VCT
      const vcdFinal = S.baseVCD * (1 - effectiveReduction);
      const castRate = (skillKey === 'LB') ? S.castLevelRateMax * castSlider : 0;
      const vctFinal = Math.max(0, S.baseVCT * (1 - totalFH) - (S.baseVCT * castRate));

      // 4) Status alert
      const isVCDZero = S.baseVCD > 0 && vcdFinal <= 0.0001;
      const isVCTZero = S.baseVCT > 0 && vctFinal <= 0.0001;
      const outStatus = document.getElementById('out-status');
      let statusClass = 'alert-secondary',
        statusText = '';
      if ((S.baseVCD === 0 || isVCDZero) && (S.baseVCT === 0 || isVCTZero)) {
        statusClass = 'alert-success';
        statusText = 'Full Cap - seluruh komponen variabel skill ini sudah 0.';
      } else {
        statusClass = 'alert-warning';
        statusText = 'Belum Cap - masih ada Variable Cooldown atau Channeling tersisa.';
      }

      // 5) Tampilkan angka utama
      document.getElementById('out-fh-from-haste').textContent = fmtPct(fhFromHaste);
      document.getElementById('out-total-fh').textContent = fmtPct(totalFH);
      document.getElementById('out-vcd-final').textContent = (S.baseVCD > 0) ? (vcdFinal.toFixed(2) + ' s') : '-';
      document.getElementById('out-vct-final').textContent = (S.baseVCT > 0) ? (vctFinal.toFixed(2) + ' s') : '-';
      document.getElementById('out-fixedcd').textContent = (S.fixedCD > 0) ? (S.fixedCD.toFixed(2) + ' s') : '-';
      document.getElementById('out-fixedct').textContent = (S.fixedCT > 0) ? (S.fixedCT.toFixed(2) + ' s') : '-';

      outStatus.className = 'alert text-center fw-semibold ' + statusClass;
      outStatus.textContent = statusText;

      // 6) Rekomendasi Level
      document.getElementById('rec-box').innerHTML = recommendLevel(totalFH, skillKey);

      // 7) Panel Kebutuhan
      const needHTML = needPanel(totalFH, capGlobal, usePet, fhBonus, skillKey);
      document.getElementById('need-box').innerHTML = needHTML;

      // 8) Breakdown
      document.getElementById('out-breakdown').innerHTML =
        `<div>Skill: <b>${S.name}</b></div>
    <div>Cap per-skill: <b>${fmtPct(S.capSkill)}</b>${(S.capSkill<1?' (dibatasi skill)':'')}</div>
    ${skillKey==='LB'?`<div>Cast Level saat ini: <b>${(castSlider*100).toFixed(0)}%</b> (maks ${(S.castLevelRateMax*100).toFixed(2)}%)</div>`:''}
    <div class="mt-1">CD Total = Fixed CD + VCD Final = ${(S.fixedCD||0).toFixed(2)} s + ${vcdFinal.toFixed(2)} s</div>
    <div>Cast Total = Fixed CT + VCT Final = ${(S.fixedCT||0).toFixed(2)} s + ${vctFinal.toFixed(2)} s</div>`;
    }

    document.getElementById('btn-calc').addEventListener('click', calculate);
    calculate();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>

