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
    <?= view('partials/site_header') ?>

    <main class="col-lg-12">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h3 class="mb-1">Haste Calculator</h3>
          <p class="text-secondary mb-0">Simulasikan <b>Final Haste</b>-mu, cek status cap tiap skill, dan lihat <b>kebutuhan Haste</b>-nya.</p>
        </div>
        <a href="#" class="btn btn-outline-secondary">
          <i class="fa-solid fa-arrow-left-long me-1"></i> Back
        </a>
      </div>

      <div class="row g-4">
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
                <label class="form-check-label" for="chk-use-pet">Gunakan Pet / Buff yang memberi <em>Final Haste</em></label>
              </div>
              <div id="wrap-pet" class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label class="form-label fw-semibold">Final Haste dari Pet/Buff (%)</label>
                  <input type="number" id="inp-fh-bonus" class="form-control" min="0" step="0.01" value="40.41">
                  <div class="form-text">Contoh: Pet Ghoul = <kbd class="px-1">40.41 %</kbd></div>
                </div>
              </div>
              <button id="btn-calc" class="btn btn-primary w-100 mt-1">
                <i class="fa-solid fa-calculator me-1"></i>Hitung Sekarang
              </button>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-7">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-3"><i class="fa-solid fa-square-poll-vertical me-2 text-primary"></i>Results</h5>
              <div class="border-start border-4 border-primary bg-primary bg-opacity-10 rounded p-3 mb-3">
                <i class="fa-solid fa-circle-info me-2"></i>
                Hasil di bawah = efek Haste kamu saat ini. Akan muncul kebutuhan Final Haste & Haste (raw) untuk cap skill.
              </div>
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <div class="p-3 rounded border h-100">
                    <div class="small text-secondary">Final Haste dari Haste</div>
                    <div class="fs-4 fw-semibold" id="out-fh-from-haste">0 %</div>
                    <div class="small text-secondary">Dihitung berdasarkan rumus konversi segmentasi</div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="p-3 rounded border h-100">
                    <div class="small text-secondary">Total Final Haste</div>
                    <div class="fs-4 fw-semibold" id="out-total-fh">0 %</div>
                    <div class="small text-secondary">Termasuk dari bonus Pet/Buff</div>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div id="out-status" class="alert text-center fw-semibold d-none" role="alert"></div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>
  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    function convertHasteToFinalPercent(haste) {
      let segment = 1;
      let remaining = haste;
      let totalPercent = 0;
      while (remaining > 0) {
        let needed = segment * 50;
        if (remaining >= needed) {
          totalPercent += 0.5;
          remaining -= needed;
          segment++;
        } else {
          totalPercent += (remaining / needed) * 0.5;
          break;
        }
      }
      return totalPercent * 100;
    }

    function calculate() {
      const haste = +document.getElementById('inp-haste').value || 0;
      const usePet = document.getElementById('chk-use-pet').checked;
      const fhBonus = usePet ? (+document.getElementById('inp-fh-bonus').value || 0) : 0;

      const fhFromHaste = convertHasteToFinalPercent(haste);
      const totalFH = fhFromHaste + fhBonus;

      document.getElementById('out-fh-from-haste').textContent = fhFromHaste.toFixed(2) + ' %';
      document.getElementById('out-total-fh').textContent = totalFH.toFixed(2) + ' %';

      const outStatus = document.getElementById('out-status');
      outStatus.className = 'alert text-center fw-semibold alert-info';
      outStatus.textContent = 'Perhitungan selesai. Total Final Haste telah dihitung.';
    }

    document.getElementById('btn-calc').addEventListener('click', calculate);
    calculate();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
