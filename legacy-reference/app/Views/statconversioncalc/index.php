<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="Stat Conversion Calculator (Primary + Secondary) based on SEA (Post-Sep 2025) sheets.">
  <meta name="keywords" content="Ragnarok X, ROX, Stat Conversion, Primary Stat, Secondary Stat, Calculator, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <meta property="og:title" content="ROXPEDIA - Stat Conversion Calculator">
  <meta property="og:description" content="Primary and Secondary stat conversion calculators based on SEA (Post-Sep 2025) sheets.">
  <meta property="og:image" content="<?= base_url('assets/img/roxdjp.png'); ?>">
  <meta property="og:url" content="<?= site_url('stat-conversion'); ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ROXPEDIA - Stat Conversion Calculator">
  <meta name="twitter:description" content="Primary and Secondary stat conversion calculators based on SEA (Post-Sep 2025) sheets.">
  <meta name="twitter:image" content="<?= base_url('assets/img/roxdjp.png'); ?>">
  <meta name="twitter:site" content="@ROXPEDIA">

  <link rel="canonical" href="<?= site_url('stat-conversion'); ?>">
  <meta http-equiv="content-language" content="en">

  <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
  <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

  <title>ROXPEDIA - Stat Conversion Calculator</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <!-- Header -->
    <?= view('partials/site_header') ?>

    <main>
      <!-- Page Title Section -->
      <div class="text-center mb-4">
        <h2 class="fw-bold mb-1">Stat Conversion Calculator</h2>
        <p class="text-secondary mb-0">
          Calculate Primary and Secondary stat conversions with clear breakdowns and automatic scaling.
        </p>
      </div>

      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xxl-9">
          <div class="card">
            <div class="card-body">

              <!-- Tabs (Bootstrap only) -->
              <ul class="nav nav-pills gap-2" id="statTabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active fw-semibold" id="primary-tab" data-bs-toggle="pill" data-bs-target="#primary"
                    type="button" role="tab" aria-controls="primary" aria-selected="true">
                    Primary Stat Conversion
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fw-semibold" id="secondary-tab" data-bs-toggle="pill" data-bs-target="#secondary"
                    type="button" role="tab" aria-controls="secondary" aria-selected="false">
                    Secondary Stat Conversion
                  </button>
                </li>
              </ul>

            </div>

            <div class="card-body pt-0">
              <div class="tab-content" id="statTabsContent">

                <!-- ===================== PRIMARY TAB ===================== -->
                <div class="tab-pane fade show active" id="primary" role="tabpanel" aria-labelledby="primary-tab" tabindex="0">
                  <div class="border rounded p-3 bg-body-secondary bg-opacity-25 mb-3">
                    <div class="fw-semibold small mb-1">Important Notes</div>
                    <ul class="small mb-0 ps-4">
                      <li>The conversion uses the sheet formula and works beyond 3000 stats.</li>
                      <li>The formula for HP and SP is actually the same as the other stat.</li>
                      <li>The only thing that is different is, VIT to HP conversion scale with Base Level.</li>
                      <li>Since Base Level scaling data is largely unknown, Max HP and Max SP are shown as <strong>N/A</strong>.</li>
                    </ul>
                  </div>

                  <div class="row g-4">
                    <!-- Input -->
                    <div class="col-12 col-xl-5">
                      <div class="card h-100">
                        <div class="card-body">
                          <h6 class="mb-3">Primary Stats Input</h6>

                          <form class="row g-3" onsubmit="return false;">
                            <?php foreach (['STR', 'AGI', 'VIT', 'INT', 'DEX', 'LUK'] as $s): ?>
                              <div class="col-6">
                                <label class="form-label"><?= $s ?></label>
                                <input type="number"
                                  class="form-control stat-input"
                                  id="stat<?= $s ?>"
                                  min="0"
                                  value="0">
                              </div>
                            <?php endforeach; ?>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Result -->
                    <div class="col-12 col-xl-7">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                            <h6 class="mb-0">Results</h6>

                            <div class="form-check form-switch m-0">
                              <input class="form-check-input" type="checkbox" role="switch" id="breakdownToggle">
                              <label class="form-check-label small" for="breakdownToggle">Show breakdown</label>
                            </div>
                          </div>

                          <div class="table-responsive">
                            <table class="table table-sm align-middle">
                              <thead class="table-dark">
                                <tr>
                                  <th>Output Stat</th>
                                  <th class="text-end">Total</th>

                                  <th class="text-end breakdown-col d-none">STR</th>
                                  <th class="text-end breakdown-col d-none">AGI</th>
                                  <th class="text-end breakdown-col d-none">VIT</th>
                                  <th class="text-end breakdown-col d-none">INT</th>
                                  <th class="text-end breakdown-col d-none">DEX</th>
                                  <th class="text-end breakdown-col d-none">LUK</th>
                                </tr>
                              </thead>
                              <tbody id="primaryOutputBody">
                                <tr>
                                  <td colspan="2" class="text-center text-secondary">
                                    Enter stats to calculate conversion
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>

                          <div class="small text-secondary mt-2">
                            Calculation runs automatically whenever you change any input.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ===================== SECONDARY TAB ===================== -->
                <div class="tab-pane fade" id="secondary" role="tabpanel" aria-labelledby="secondary-tab" tabindex="0">
                  <div class="border rounded p-3 bg-body-secondary bg-opacity-25 mb-3">
                    <div class="fw-semibold small mb-1">Secondary Notes</div>
                    <ul class="small mb-0 ps-4">
                      <li>This converter maps Secondary Stats to Final Stats (%, seconds, or hits).</li>
                      <li>Formulas depend on the sheet constants. If unknown, output is shown as <strong>N/A</strong>.</li>
                    </ul>
                  </div>

                  <div class="row g-4">
                    <!-- Input -->
                    <div class="col-12 col-xl-5">
                      <div class="card h-100">
                        <div class="card-body">
                          <h6 class="mb-3">Secondary Stats Input</h6>

                          <form class="row g-3" onsubmit="return false;">
                            <div class="col-12">
                              <label class="form-label">P.PEN / P.DEF</label>
                              <input type="number" class="form-control sec-input" id="secPPenDef" min="0" value="0">
                            </div>

                            <div class="col-12">
                              <label class="form-label">M.PEN / M.DEF</label>
                              <input type="number" class="form-control sec-input" id="secMPenDef" min="0" value="0">
                            </div>

                            <div class="col-12">
                              <label class="form-label">Haste</label>
                              <input type="number" class="form-control sec-input" id="secHaste" min="0" value="0">
                              <div class="form-text">Will output V.CDR (s) and V.CTR (hit)</div>
                            </div>

                            <div class="col-12">
                              <label class="form-label">Final Haste (optional)</label>
                              <input type="number" class="form-control sec-input" id="secFinalHastePct" min="0" step="0.01" value="0">
                              <div class="form-text">If you already have Final Haste %, it can be converted too.</div>
                            </div>

                            <div class="col-12">
                              <label class="form-label">Hit</label>
                              <input type="number" class="form-control sec-input" id="secHit" min="0" value="0">
                            </div>

                            <div class="col-12">
                              <label class="form-label">Flee</label>
                              <input type="number" class="form-control sec-input" id="secFlee" min="0" value="0">
                            </div>

                            <div class="col-12">
                              <label class="form-label">Crit</label>
                              <input type="number" class="form-control sec-input" id="secCrit" min="0" value="0">
                            </div>

                            <div class="col-12">
                              <label class="form-label">Anti-Crit</label>
                              <input type="number" class="form-control sec-input" id="secAntiCrit" min="0" value="0">
                            </div>

                            <div class="col-12">
                              <label class="form-label">ASPD</label>
                              <input type="number" class="form-control sec-input" id="secAspd" min="0" value="0">
                            </div>

                            <div class="col-12">
                              <label class="form-label">Final ASPD (optional)</label>
                              <input type="number" class="form-control sec-input" id="secFinalAspdPct" min="0" step="0.01" value="0">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Result -->
                    <div class="col-12 col-xl-7">
                      <div class="card h-100">
                        <div class="card-body">
                          <h6 class="mb-3">Results</h6>

                          <div class="table-responsive">
                            <table class="table table-sm align-middle">
                              <thead class="table-dark">
                                <tr>
                                  <th>Conversion</th>
                                  <th class="text-end">Input</th>
                                  <th class="text-end">Output</th>
                                </tr>
                              </thead>
                              <tbody id="secondaryOutputBody">
                                <tr>
                                  <td colspan="3" class="text-center text-secondary">
                                    Enter secondary stats to calculate conversion
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>

                          <div class="small text-secondary mt-2">
                            Note: Secondary formulas must match your sheet constants (we'll fill them next).
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- tab content -->
            </div>
          </div>
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // ===================== PRIMARY (sheet-aligned formula) =====================
    const primaryOutputBodyEl = document.getElementById('primaryOutputBody');
    const breakdownToggle = document.getElementById('breakdownToggle');

    function setBreakdownVisible(isOn) {
      document.querySelectorAll('.breakdown-col').forEach(el => el.classList.toggle('d-none', !isOn));
    }

    function floor100(x) {
      return Math.floor(x / 100) * 100;
    }

    // baseMul: linear multiplier
    // sqPct: square term percent as decimal (0.2% => 0.002)
    // stepMul: remainder slope multiplier
    function formula(x, baseMul, sqPct, stepMul) {
      const v = Math.max(0, Number(x || 0));
      const f = floor100(v);
      const r = v - f;
      const sqTerm = (f * f) * sqPct;
      const stepTerm = r * ((f / 100) * stepMul);
      return (v * baseMul) + sqTerm + stepTerm;
    }

    function fmt(n) {
      return n === null ? '<span class="badge bg-secondary">N/A</span>' : Math.round(n).toLocaleString('en-US');
    }

    function primaryRows(STR, AGI, VIT, INT, DEX, LUK) {
      return [{
          name: 'P.ATK',
          STR: formula(STR, 4, 0.002, 0.2),
          AGI: null,
          VIT: null,
          INT: null,
          DEX: formula(DEX, 4, 0.002, 0.2),
          LUK: formula(LUK, 0.5, 0.00025, 0.025),
          naTotal: false
        },
        {
          name: 'M.ATK',
          STR: null,
          AGI: null,
          VIT: null,
          INT: formula(INT, 4, 0.002, 0.2),
          DEX: null,
          LUK: null,
          naTotal: false
        },
        {
          name: 'Max HP',
          STR: null,
          AGI: null,
          VIT: null,
          INT: null,
          DEX: null,
          LUK: null,
          naTotal: true
        },
        {
          name: 'Max SP',
          STR: null,
          AGI: null,
          VIT: null,
          INT: null,
          DEX: null,
          LUK: null,
          naTotal: true
        },

        {
          name: 'P.DEF',
          STR: null,
          AGI: null,
          VIT: formula(VIT, 2, 0.001, 0.1),
          INT: null,
          DEX: null,
          LUK: null,
          naTotal: false
        },
        {
          name: 'M.DEF',
          STR: null,
          AGI: null,
          VIT: null,
          INT: formula(INT, 2, 0.001, 0.1),
          DEX: null,
          LUK: null,
          naTotal: false
        },
        {
          name: 'ASPD',
          STR: null,
          AGI: formula(AGI, 2, 0.001, 0.1),
          VIT: null,
          INT: null,
          DEX: null,
          LUK: null,
          naTotal: false
        },
        {
          name: 'Haste',
          STR: null,
          AGI: null,
          VIT: null,
          INT: null,
          DEX: formula(DEX, 2, 0.001, 0.1),
          LUK: null,
          naTotal: false
        },
        {
          name: 'Hit',
          STR: null,
          AGI: null,
          VIT: null,
          INT: null,
          DEX: formula(DEX, 2, 0.001, 0.1),
          LUK: null,
          naTotal: false
        },
        {
          name: 'Flee',
          STR: null,
          AGI: formula(AGI, 2, 0.001, 0.1),
          VIT: null,
          INT: null,
          DEX: null,
          LUK: null,
          naTotal: false
        },
        {
          name: 'Crit',
          STR: null,
          AGI: null,
          VIT: null,
          INT: null,
          DEX: null,
          LUK: formula(LUK, 2, 0.001, 0.1),
          naTotal: false
        },
        {
          name: 'Anti-Crit',
          STR: null,
          AGI: null,
          VIT: null,
          INT: null,
          DEX: null,
          LUK: formula(LUK, 2, 0.001, 0.1),
          naTotal: false
        },
      ];
    }

    function renderPrimary() {
      const STR = Number(document.getElementById('statSTR').value || 0);
      const AGI = Number(document.getElementById('statAGI').value || 0);
      const VIT = Number(document.getElementById('statVIT').value || 0);
      const INT = Number(document.getElementById('statINT').value || 0);
      const DEX = Number(document.getElementById('statDEX').value || 0);
      const LUK = Number(document.getElementById('statLUK').value || 0);

      const showBreakdown = breakdownToggle.checked;
      setBreakdownVisible(showBreakdown);

      const rows = primaryRows(STR, AGI, VIT, INT, DEX, LUK);

      let html = '';
      rows.forEach(r => {
        const parts = [r.STR, r.AGI, r.VIT, r.INT, r.DEX, r.LUK].filter(v => typeof v === 'number');
        const total = r.naTotal ? null : (parts.length ? parts.reduce((a, b) => a + b, 0) : 0);

        html += `
          <tr>
            <td>${r.name}</td>
            <td class="text-end">${fmt(total)}</td>
            ${showBreakdown ? `
              <td class="text-end">${fmt(r.STR ?? null)}</td>
              <td class="text-end">${fmt(r.AGI ?? null)}</td>
              <td class="text-end">${fmt(r.VIT ?? null)}</td>
              <td class="text-end">${fmt(r.INT ?? null)}</td>
              <td class="text-end">${fmt(r.DEX ?? null)}</td>
              <td class="text-end">${fmt(r.LUK ?? null)}</td>
            ` : ``}
          </tr>
        `;
      });

      primaryOutputBodyEl.innerHTML = html;
    }

    document.querySelectorAll('.stat-input').forEach(el => el.addEventListener('input', renderPrimary));
    breakdownToggle.addEventListener('change', renderPrimary);

    // ===================== SECONDARY (placeholders for constants) =====================
    const secondaryOutputBodyEl = document.getElementById('secondaryOutputBody');

    function fmtPct(v) {
      if (v === null) return '<span class="badge bg-secondary">N/A</span>';
      return (v * 100).toFixed(2) + '%';
    }

    function fmtNum(v) {
      if (v === null) return '<span class="badge bg-secondary">N/A</span>';
      return Number(v).toLocaleString('en-US');
    }

    function fmtSec(v) {
      if (v === null) return '<span class="badge bg-secondary">N/A</span>';
      return Number(v).toFixed(2);
    }

    // IMPORTANT:
    // Fill these with your sheet constants/formulas.
    // Below are deliberately N/A until you provide the exact formulas.
    function secondaryCalc(input) {
      // Return values as:
      //  - percent as decimal (0.6821 for 68.21%)
      //  - seconds as number (10.41)
      //  - "hit" as number (2.60)
      return {
        pPenDefFinal: null,
        mPenDefFinal: null,
        hasteToVCDR: null,
        hasteToVCTR: null,
        finalHasteToVCDR: null,
        finalHasteToVCTR: null,
        hitToFinalHit: null,
        fleeToFinalFlee: null,
        critToFinalCrit: null,
        antiCritToFinalAntiCrit: null,
        aspdToFinalAspd: null,
        finalAspdToHps: null,
      };
    }

    function renderSecondary() {
      const input = {
        pPenDef: Number(document.getElementById('secPPenDef').value || 0),
        mPenDef: Number(document.getElementById('secMPenDef').value || 0),
        haste: Number(document.getElementById('secHaste').value || 0),
        finalHastePct: Number(document.getElementById('secFinalHastePct').value || 0),
        hit: Number(document.getElementById('secHit').value || 0),
        flee: Number(document.getElementById('secFlee').value || 0),
        crit: Number(document.getElementById('secCrit').value || 0),
        antiCrit: Number(document.getElementById('secAntiCrit').value || 0),
        aspd: Number(document.getElementById('secAspd').value || 0),
        finalAspdPct: Number(document.getElementById('secFinalAspdPct').value || 0),
      };

      const out = secondaryCalc(input);

      const rows = [{
          label: 'P.PEN/DEF -> Final P.PEN/DEF',
          in: fmtNum(input.pPenDef),
          out: fmtPct(out.pPenDefFinal)
        },
        {
          label: 'M.PEN/DEF -> Final M.PEN/DEF',
          in: fmtNum(input.mPenDef),
          out: fmtPct(out.mPenDefFinal)
        },
        {
          label: 'Haste -> V.CDR (s)',
          in: fmtNum(input.haste),
          out: fmtSec(out.hasteToVCDR)
        },
        {
          label: 'Haste -> V.CTR (hit)',
          in: fmtNum(input.haste),
          out: fmtNum(out.hasteToVCTR)
        },
        {
          label: 'Final Haste -> V.CDR (s)',
          in: (input.finalHastePct ? input.finalHastePct.toFixed(2) + '%' : '0%'),
          out: fmtSec(out.finalHasteToVCDR)
        },
        {
          label: 'Final Haste -> V.CTR (hit)',
          in: (input.finalHastePct ? input.finalHastePct.toFixed(2) + '%' : '0%'),
          out: fmtNum(out.finalHasteToVCTR)
        },
        {
          label: 'Hit -> Final Hit',
          in: fmtNum(input.hit),
          out: fmtPct(out.hitToFinalHit)
        },
        {
          label: 'Flee -> Final Flee',
          in: fmtNum(input.flee),
          out: fmtPct(out.fleeToFinalFlee)
        },
        {
          label: 'Crit -> Final Crit',
          in: fmtNum(input.crit),
          out: fmtPct(out.critToFinalCrit)
        },
        {
          label: 'Anti-Crit -> Final Anti-Crit',
          in: fmtNum(input.antiCrit),
          out: fmtPct(out.antiCritToFinalAntiCrit)
        },
        {
          label: 'ASPD -> Final ASPD',
          in: fmtNum(input.aspd),
          out: fmtPct(out.aspdToFinalAspd)
        },
        {
          label: 'Final ASPD -> Hit per second',
          in: (input.finalAspdPct ? input.finalAspdPct.toFixed(2) + '%' : '0%'),
          out: fmtSec(out.finalAspdToHps)
        },
      ];

      let html = '';
      rows.forEach(r => {
        html += `
          <tr>
            <td>${r.label}</td>
            <td class="text-end">${r.in}</td>
            <td class="text-end">${r.out}</td>
          </tr>
        `;
      });

      secondaryOutputBodyEl.innerHTML = html;
    }

    document.querySelectorAll('.sec-input').forEach(el => el.addEventListener('input', renderSecondary));

    // Init
    renderPrimary();
    renderSecondary();
  </script>
</body>

</html>

