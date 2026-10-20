<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="Calculate taxes for Rare Items (Auction) and Normal Trade based on in-game tax policy.">
  <meta name="keywords" content="ROXPEDIA, ROX Tax, Rare Item Tax, Normal Trade Tax, Ragnarok X, Exchange Tax">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <meta property="og:title" content="ROXPEDIA - Tax Calculator">
  <meta property="og:description" content="Calculate taxes for Rare Items (Auction) and Normal Trade based on in-game tax policy.">
  <meta property="og:image" content="<?= base_url('assets/img/roxdjp.png') ?>">
  <meta property="og:url" content="<?= site_url('rareitemtaxcalc') ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ROXPEDIA - Tax Calculator">
  <meta name="twitter:description" content="Calculate taxes for Rare Items (Auction) and Normal Trade based on in-game tax policy.">
  <meta name="twitter:image" content="<?= base_url('assets/img/roxdjp.png') ?>">

  <link rel="canonical" href="<?= site_url('rareitemtaxcalc') ?>">
  <meta http-equiv="content-language" content="en">

  <title>ROXPEDIA - Tax Calculator</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">

    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-md-10">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="taxTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tab-rare-tab"
                data-bs-toggle="tab" data-bs-target="#tab-rare"
                type="button" role="tab" aria-controls="tab-rare" aria-selected="true">
                Rare Items (Auction)
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-normal-tab"
                data-bs-toggle="tab" data-bs-target="#tab-normal"
                type="button" role="tab" aria-controls="tab-normal" aria-selected="false">
                Normal (Trade)
              </button>
            </li>
          </ul>

          <!-- Tab content -->
          <div class="tab-content p-3 border border-top-0 rounded-bottom bg-body-tertiary" id="taxTabsContent">

            <!-- ===================== TAB 1: RARE ITEMS (AUCTION) ===================== -->
            <div class="tab-pane fade show active" id="tab-rare" role="tabpanel" aria-labelledby="tab-rare-tab" tabindex="0">

              <div class="mb-3">
                <h5 class="mb-1">Rare Items (Auction) Tax</h5>
                <div class="text-secondary small">
                  Input in <b>Diamond</b>. Output shows the <b>Net Crystall</b> you receive after tax.
                  <br><small>1 Diamond = 10 Crystall</small>
                </div>
              </div>

              <div class="text-start mb-3">
                <p class="mb-2"><strong>Tax Policy (Progressive / Marginal):</strong></p>
                <ul class="mb-0">
                  <li>0 ~ 50,000 Diamond: 5% tax</li>
                  <li>50,001 ~ 100,000 Diamond: 10% tax</li>
                  <li>100,001 ~ 200,000 Diamond: 15% tax</li>
                  <li>200,001 and above Diamond: 20% tax</li>
                </ul>
              </div>

              <div class="mb-3 d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-outline-primary rare-btn" value="100000">100,000 Diamond</button>
                <button type="button" class="btn btn-outline-primary rare-btn" value="150000">150,000 Diamond</button>
                <button type="button" class="btn btn-outline-primary rare-btn" value="200000">200,000 Diamond</button>
                <button type="button" class="btn btn-outline-primary rare-btn" value="400500">400,500 Diamond</button>
                <button type="button" class="btn btn-outline-primary rare-btn" value="480000">480,000 Diamond</button>
              </div>

              <div class="mb-3">
                <label for="rarePrice" class="form-label">Enter Item Price (Diamond)</label>
                <input type="number" class="form-control" id="rarePrice" name="rarePrice" min="0" step="1" value="0" required>
              </div>

              <!-- Result -->
              <div id="rareResult" class="alert alert-info mb-0" role="status" aria-live="polite">
                <div class="d-flex justify-content-between"><span>Tax (Diamond)</span><b id="rareTax">0</b></div>
                <hr class="my-2">
                <div class="d-flex justify-content-between"><span>Net Received (Crystall)</span><b id="rareCrystall">0</b></div>
              </div>

            </div>

            <!-- ===================== TAB 2: NORMAL (TRADE) ===================== -->
            <div class="tab-pane fade" id="tab-normal" role="tabpanel" aria-labelledby="tab-normal-tab" tabindex="0">

              <div class="mb-3">
                <h5 class="mb-1">Normal (Trade) Tax</h5>
                <div class="text-secondary small">
                  Input in <b>Crystall</b>. Tax is calculated using <b>Progressive / Marginal</b> tiers (in-game style).
                </div>
              </div>

              <div class="text-start mb-3">
                <p class="mb-2"><strong>Tiered Tax (Progressive / Marginal):</strong></p>
                <ul class="mb-0">
                  <li>0 ~ 500,000 Crystall: Normal 10% | VIP Card 10%</li>
                  <li>500,001 ~ 1,000,000 Crystall: Normal 20% | VIP Card 10%</li>
                  <li>1,000,001 ~ 1,500,000 Crystall: Normal 25% | VIP Card 20%</li>
                  <li>1,500,001 and above Crystall: Normal 25% | VIP Card 25%</li>
                </ul>
              </div>

              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="vipToggle">
                <label class="form-check-label" for="vipToggle">Use VIP Card Tax Rate</label>
              </div>

              <div class="mb-3 d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-outline-primary normal-btn" value="500000">500,000 Crystall</button>
                <button type="button" class="btn btn-outline-primary normal-btn" value="750000">750,000 Crystall</button>
                <button type="button" class="btn btn-outline-primary normal-btn" value="1000000">1,000,000 Crystall</button>
                <button type="button" class="btn btn-outline-primary normal-btn" value="1500000">1,500,000 Crystall</button>
                <button type="button" class="btn btn-outline-primary normal-btn" value="2500000">2,500,000 Crystall</button>
              </div>

              <div class="mb-3">
                <label for="normalPrice" class="form-label">Enter Transaction Amount (Crystall)</label>
                <input type="number" class="form-control" id="normalPrice" name="normalPrice" min="0" step="1" value="0" required>
              </div>

              <div id="normalResult" class="alert alert-info mb-0" role="status" aria-live="polite">
                <div class="d-flex justify-content-between"><span>Overall Effective Tax Rate</span><b id="normalRate">0%</b></div>
                <div class="d-flex justify-content-between"><span>Tax (Crystall)</span><b id="normalTax">0</b></div>
                <hr class="my-2">
                <div class="d-flex justify-content-between"><span>Net Received (Crystall)</span><b id="normalNet">0</b></div>
              </div>

            </div>

          </div><!-- /tab-content -->

        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <script>
    // ===================== RARE (AUCTION) =====================
    const RARE_TIERS = [{
        upTo: 50000,
        rate: 0.05
      },
      {
        upTo: 100000,
        rate: 0.10
      },
      {
        upTo: 200000,
        rate: 0.15
      },
      {
        upTo: Infinity,
        rate: 0.20
      },
    ];

    function calcRare(priceDiamond) {
      const price = Math.max(0, Number(priceDiamond || 0));

      let tax = 0;
      let remaining = price;
      let prevCap = 0;

      for (const tier of RARE_TIERS) {
        const cap = tier.upTo;
        const taxable = Math.max(0, Math.min(remaining, cap - prevCap));
        tax += taxable * tier.rate;

        remaining -= taxable;
        prevCap = cap;
        if (remaining <= 0) break;
      }

      const taxInt = Math.round(tax);
      const netDiamondInt = Math.round(price - taxInt);

      // Back to 1 Diamond = 10 Crystall
      const crystallInt = Math.round(netDiamondInt * 10);

      return {
        taxInt,
        crystallInt
      };
    }

    function renderRare(value) {
      const {
        taxInt,
        crystallInt
      } = calcRare(value);

      document.getElementById('rareTax').innerText = taxInt.toLocaleString();
      document.getElementById('rareCrystall').innerText = crystallInt.toLocaleString();
    }

    document.querySelectorAll('.rare-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const price = Number(this.value);
        document.getElementById('rarePrice').value = price;
        renderRare(price);
      });
    });

    document.getElementById('rarePrice').addEventListener('input', function() {
      renderRare(Number(this.value || 0));
    });

    // ===================== NORMAL (TRADE) =====================
    const NORMAL_TIERS = [{
        upTo: 500000,
        normal: 0.10,
        vip: 0.10
      },
      {
        upTo: 1000000,
        normal: 0.20,
        vip: 0.10
      },
      {
        upTo: 1500000,
        normal: 0.25,
        vip: 0.20
      },
      {
        upTo: Infinity,
        normal: 0.25,
        vip: 0.25
      },
    ];

    function calcNormal(amountCrystall, useVip) {
      const amount = Math.max(0, Number(amountCrystall || 0));

      let tax = 0;
      let remaining = amount;
      let prevCap = 0;

      for (const tier of NORMAL_TIERS) {
        const cap = tier.upTo;
        const rate = useVip ? tier.vip : tier.normal;

        const taxable = Math.max(0, Math.min(remaining, cap - prevCap));
        tax += taxable * rate;

        remaining -= taxable;
        prevCap = cap;
        if (remaining <= 0) break;
      }

      const taxInt = Math.round(tax);
      const netInt = Math.round(amount - taxInt);
      const effectiveRate = amount > 0 ? (taxInt / amount) : 0;

      return {
        effectiveRate,
        taxInt,
        netInt
      };
    }

    function renderNormal(value) {
      const useVip = document.getElementById('vipToggle').checked;
      const {
        effectiveRate,
        taxInt,
        netInt
      } = calcNormal(value, useVip);

      document.getElementById('normalRate').innerText = (effectiveRate * 100).toFixed(2) + "%";
      document.getElementById('normalTax').innerText = taxInt.toLocaleString();
      document.getElementById('normalNet').innerText = netInt.toLocaleString();
    }

    document.querySelectorAll('.normal-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const amount = Number(this.value);
        document.getElementById('normalPrice').value = amount;
        renderNormal(amount);
      });
    });

    document.getElementById('normalPrice').addEventListener('input', function() {
      renderNormal(Number(this.value || 0));
    });

    document.getElementById('vipToggle').addEventListener('change', function() {
      renderNormal(Number(document.getElementById('normalPrice').value || 0));
    });

    // Year
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // Init
    renderRare(0);
    renderNormal(0);
  </script>

</body>

</html>

