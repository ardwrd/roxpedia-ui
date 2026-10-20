<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="author" content="Cherubim">
  <meta name="description" content="Find out the rewards that can be obtained after reaching a certain favor level with NPCs.">
  <meta name="keywords" content="NPC Favor List, ROX NPCs, Favor Quests, Ragnarok X Favor System, NPC Relationships, NPC Rewards">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <meta property="og:title" content="ROXPEDIA - NPC Favor List">
  <meta property="og:description" content="Find out the rewards that can be obtained after reaching a certain favor level with NPCs.">
  <meta property="og:image" content="<?= base_url('assets/og-image.png') ?>">
  <meta property="og:url" content="<?= site_url('npc') ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ROXPEDIA">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ROXPEDIA - NPC Favor List">
  <meta name="twitter:description" content="Find out the rewards that can be obtained after reaching a certain favor level with NPCs.">
  <meta name="twitter:image" content="<?= base_url('assets/og-image.png') ?>">
  <meta name="twitter:site" content="@ROXPEDIA">

  <link rel="canonical" href="<?= site_url('npc') ?>">
  <meta http-equiv="content-language" content="en">

  <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
  <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

  <meta name="google-site-verification" content="cxt3123s02hc4oV1vvtBet28W6DuOE-sW34bATAtD-c" />
  <meta name="generator" content="Hugo 0.122.0">

  <title>ROXPEDIA - NPC Favor List</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">

    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-10">
          <div class="card border-secondary mb-4">
            <div class="card-body">
              <h5 class="card-title mb-1">NPC Favorites and Rewards</h5>
              <p class="card-text text-secondary small mb-3">
                Select a location to view NPC data and their additional favor rewards.
              </p>

              <div class="mb-3">
                <label for="locationDropdown" class="form-label">Select Location</label>
                <select class="form-select form-select-sm" id="locationDropdown">
                  <option value="common-npc">Common NPC</option>
                  <option value="prontera">Prontera</option>
                  <option value="prontera-south-gate">Prontera South Gate</option>
                  <option value="izlude-island">Izlude Island</option>
                  <option value="morroc">Morroc</option>
                  <option value="payon">Payon</option>
                  <option value="alberta">Alberta</option>
                  <option value="geffen">Geffen</option>
                  <option value="glast-heim">Glast Heim</option>
                  <option value="comodo">Comodo</option>
                  <option value="umbala">Umbala</option>
                  <option value="juno">Juno</option>
                </select>
              </div>

              <div class="table-responsive">
                <table class="table table-sm table-bordered align-middle mb-0" id="npcTable">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">NPC</th>
                      <th scope="col">Favorites</th>
                      <th scope="col">Additional Favor Rewards</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Filled by JavaScript -->
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script>
    const npcData = <?= json_encode($npcData) ?>;

    function updateTable(selectedLocation) {
      const tableBody = document.querySelector("#npcTable tbody");
      tableBody.innerHTML = "";

      const data = npcData[selectedLocation] || [];

      data.forEach((item) => {
        const row = document.createElement("tr");
        const npcImage = item.npc_image ?
          "<?= base_url('assets/img/items/') ?>" + item.npc_image :
          "<?= base_url('assets/img/npc.png') ?>";
        row.innerHTML = `
          <td>
            <div class="d-flex align-items-center gap-2">
              <img src="${npcImage}" alt="NPC" class="rounded border border-secondary object-fit-contain" width="36" height="36">
              <div>${item.npc}</div>
            </div>
          </td>
          <td>${item.favorites}</td>
          <td>${item.rewards}</td>
        `;
        tableBody.appendChild(row);
      });
    }

    const dropdown = document.getElementById("locationDropdown");
    dropdown.addEventListener("change", (event) => {
      updateTable(event.target.value);
    });

    updateTable("common-npc");

    document.getElementById('current-year').textContent = new Date().getFullYear();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

