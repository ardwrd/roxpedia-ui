<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ROXPEDIA">
  <meta name="description" content="Official Ragnarok X GvG Merit Rankings for guild R A W on ROXPEDIA.">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="ROXPEDIA - GvG R A W Leaderboard">
  <meta property="og:description" content="Official Ragnarok X GvG Merit Rankings for guild R A W.">
  <meta property="og:image" content="<?= base_url('assets/og-image.png') ?>">
  <meta property="og:url" content="<?= site_url('gvg-raw') ?>">
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ROXPEDIA - GvG R A W Leaderboard">
  <meta name="twitter:description" content="Official Ragnarok X GvG Merit Rankings for guild R A W.">
  <meta name="twitter:image" content="<?= base_url('assets/og-image.png') ?>">
  <link rel="canonical" href="<?= site_url('gvg-raw') ?>">
  <title>ROXPEDIA - GvG R A W Leaderboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/roxpedia-theme.css') ?>">
  <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" rel="stylesheet">

  <style>
    .guild-raw-page .card {
      border-color: rgba(var(--bs-secondary-rgb), 0.45);
    }

    .guild-raw-page .card-header {
      border-top-left-radius: var(--bs-card-inner-border-radius) !important;
      border-top-right-radius: var(--bs-card-inner-border-radius) !important;
      border-bottom-left-radius: 0 !important;
      border-bottom-right-radius: 0 !important;
    }

    .guild-raw-page .table-wrap {
      max-height: 70vh;
      overflow: auto;
    }

    .guild-raw-page thead th {
      position: sticky;
      top: 0;
      z-index: 1;
      background: var(--bs-body-bg);
    }

    .guild-raw-page .metric-card {
      min-height: 100%;
    }

    .guild-raw-page .mono {
      font-variant-numeric: tabular-nums;
    }
  </style>
</head>

<body class="rox-app guild-raw-page">
  <div class="container py-3 py-md-4 rox-shell">
    <header>
      <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom rox-site-header">
        <a href="<?= site_url('') ?>" class="text-decoration-none text-reset d-flex align-items-center">
          <img src="<?= base_url('assets/logo.png') ?>" data-logo-dark="<?= base_url('assets/logo.png') ?>" data-logo-light="<?= base_url('assets/logo-navy.png') ?>" alt="ROXPEDIA Logo" height="30" class="me-2 rox-brand-mark">
        </a>

        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto align-items-center gap-2">
          <a class="me-2 py-2 link-body-emphasis text-decoration-none" href="<?= site_url('') ?>">Home</a>
          <a class="me-2 py-2 link-body-emphasis text-decoration-none" href="<?= site_url('aboutus') ?>">About</a>
          <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="<?= site_url('documentation') ?>">Documentation</a>
          <button class="btn btn-outline-secondary btn-sm" id="themeToggle" type="button" aria-label="Toggle theme" data-light-label="Light mode" data-dark-label="Dark mode">
            <span>Light mode</span>
          </button>
        </nav>
      </div>

      <div class="pricing-header p-3 pb-md-4 mx-auto text-center mb-4">
        <h1 class="display-5 fw-medium text-body-emphasis mb-3">
          <i class="fa-solid fa-shield-halved me-2 text-warning"></i>
          GvG R A W Leaderboard
        </h1>
        <p class="col-12 col-md-10 col-lg-8 mx-auto fs-6 text-secondary mb-0">
          Pulls the official Ragnarok X website ranking API, then shows only entries for guild <strong><?= esc($defaultGuild) ?></strong>.
        </p>
      </div>
    </header>

    <main>
      <div id="statusAlert" class="alert alert-secondary">Loading server list...</div>

      <div class="card mb-3">
        <div class="card-header bg-body-tertiary border-secondary py-3">
          <div class="d-flex align-items-center">
            <i class="fa-solid fa-server me-2 text-info"></i>
            <h5 class="mb-0">Server Selection</h5>
          </div>
        </div>
        <div class="card-body">
          <div class="alert alert-info bg-info bg-opacity-10 border-info-subtle text-body small mb-4">
            This page only shows official ROX GvG entries for guild <strong><?= esc($defaultGuild) ?></strong>. Change the zone or server to reload the ranking.
          </div>

          <div class="row g-3 align-items-end">
            <div class="col-12 col-lg-4">
              <label for="zoneSelect" class="form-label fw-semibold">Zone</label>
              <select class="form-select" id="zoneSelect" name="zone_id" disabled>
                <option>Loading zone list...</option>
              </select>
            </div>

            <div class="col-12 col-lg-5">
              <label for="serverSelect" class="form-label fw-semibold">Server</label>
              <select class="form-select" id="serverSelect" name="server_id" disabled>
                <option>Select a zone first</option>
              </select>
            </div>

            <div class="col-12 col-lg-3 d-grid">
              <button type="button" class="btn btn-warning fw-semibold" id="loadButton" disabled>
                <i class="fa-solid fa-rotate me-2"></i>
                Reload Leaderboard
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-md-4">
          <div class="card metric-card bg-body-tertiary">
            <div class="card-body">
              <div class="text-secondary small mb-1">Guild</div>
              <div class="fs-5 fw-semibold" id="summaryGuild"><?= esc($defaultGuild) ?></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card metric-card bg-body-tertiary">
            <div class="card-body">
              <div class="text-secondary small mb-1">Selected Server</div>
              <div class="fs-6 fw-semibold" id="summaryServer">-</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card metric-card bg-body-tertiary">
            <div class="card-body">
              <div class="text-secondary small mb-1">Matching Rows</div>
              <div class="fs-5 fw-semibold mono" id="summaryCount">0</div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-body-tertiary border-secondary py-3 d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
            <i class="fa-solid fa-ranking-star me-2 text-warning"></i>
            <h5 class="mb-0">Leaderboard</h5>
          </div>
          <a href="https://www.ragnarokx.com/main/ranking" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary btn-sm">
            Official Page
          </a>
        </div>
        <div class="card-body p-0">
          <div class="table-wrap">
            <table class="table table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col" class="text-center" style="width: 72px;">#</th>
                  <th scope="col">Nickname</th>
                  <th scope="col">Guild</th>
                  <th scope="col" class="text-center">Level</th>
                  <th scope="col">Battle Data</th>
                  <th scope="col" class="text-end">Score</th>
                  <th scope="col">Updated</th>
                </tr>
              </thead>
              <tbody id="leaderboardBody">
                <tr>
                  <td colspan="7" class="text-center text-secondary py-5">Waiting for data.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

    <footer class="pt-3 mt-4 text-body-secondary border-top">
      <p>&copy; <span id="current-year"></span> ROXPEDIA. Data source: official Ragnarok X ranking website.</p>
    </footer>
  </div>

  <script>
    const SERVERLIST_URL = <?= json_encode(site_url('api/gvg-raw/serverlist')) ?>;
    const LEADERBOARD_URL = <?= json_encode(site_url('api/gvg-raw/leaderboard')) ?>;
    const DEFAULT_GUILD = <?= json_encode($defaultGuild) ?>;
    const zoneSelect = document.getElementById('zoneSelect');
    const serverSelect = document.getElementById('serverSelect');
    const loadButton = document.getElementById('loadButton');
    const statusAlert = document.getElementById('statusAlert');
    const leaderboardBody = document.getElementById('leaderboardBody');
    const summaryGuild = document.getElementById('summaryGuild');
    const summaryServer = document.getElementById('summaryServer');
    const summaryCount = document.getElementById('summaryCount');

    let zones = [];

    function setStatus(message, type = 'secondary') {
      statusAlert.className = `alert alert-${type}`;
      statusAlert.textContent = message;
    }

    function escapeHtml(value) {
      return String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
    }

    function formatDate(unixSeconds) {
      if (!unixSeconds) {
        return '-';
      }

      const date = new Date(Number(unixSeconds) * 1000);
      if (Number.isNaN(date.getTime())) {
        return '-';
      }

      return date.toLocaleString();
    }

    function formatNumber(value) {
      const num = Number(value);
      if (!Number.isFinite(num)) {
        return escapeHtml(value);
      }

      return num.toLocaleString();
    }

    async function fetchJson(url) {
      const response = await fetch(url, {
        headers: {
          'Accept': 'application/json'
        }
      });

      let payload = {};
      try {
        payload = await response.json();
      } catch (error) {
        payload = {};
      }

      if (!response.ok) {
        throw new Error(payload.error || 'Request failed.');
      }

      return payload;
    }

    function readParams() {
      const params = new URLSearchParams(window.location.search);
      return {
        zone: params.get('zone') || '',
        server: params.get('server') || '',
      };
    }

    function syncParams() {
      const params = new URLSearchParams(window.location.search);
      params.delete('guild');
      params.set('zone', zoneSelect.value || '');
      params.set('server', serverSelect.value || '');
      window.history.replaceState({}, '', `${window.location.pathname}?${params.toString()}`);
    }

    function getSelectedZone() {
      return zones.find((zone) => String(zone.id) === String(zoneSelect.value)) || null;
    }

    function populateZones(selectedZoneId = '') {
      zoneSelect.innerHTML = '';

      if (zones.length === 0) {
        zoneSelect.innerHTML = '<option value="">No zone data available</option>';
        zoneSelect.disabled = true;
        return;
      }

      zones.forEach((zone) => {
        const option = document.createElement('option');
        option.value = zone.id;
        option.textContent = zone.name;
        zoneSelect.appendChild(option);
      });

      zoneSelect.disabled = false;

      if (selectedZoneId && zones.some((zone) => String(zone.id) === String(selectedZoneId))) {
        zoneSelect.value = String(selectedZoneId);
      }
    }

    function populateServers(selectedServerId = '') {
      const zone = getSelectedZone();
      serverSelect.innerHTML = '';

      if (!zone || !Array.isArray(zone.servers) || zone.servers.length === 0) {
        serverSelect.innerHTML = '<option value="">No server available</option>';
        serverSelect.disabled = true;
        loadButton.disabled = true;
        summaryServer.textContent = '-';
        return;
      }

      zone.servers.forEach((server) => {
        const option = document.createElement('option');
        option.value = server.id;
        option.textContent = server.name;
        serverSelect.appendChild(option);
      });

      serverSelect.disabled = false;
      loadButton.disabled = false;

      if (selectedServerId && zone.servers.some((server) => String(server.id) === String(selectedServerId))) {
        serverSelect.value = String(selectedServerId);
      }

      const selectedOption = serverSelect.options[serverSelect.selectedIndex];
      summaryServer.textContent = selectedOption ? `${zone.name} / ${selectedOption.text}` : '-';
    }

    function renderRows(rows) {
      if (!Array.isArray(rows) || rows.length === 0) {
        leaderboardBody.innerHTML = `
          <tr>
            <td colspan="7" class="text-center text-secondary py-5">No matching rows found for this guild on the selected server.</td>
          </tr>
        `;
        return;
      }

      leaderboardBody.innerHTML = rows.map((row) => `
        <tr>
          <td class="text-center fw-semibold mono">${formatNumber(row.ranking)}</td>
          <td>${escapeHtml(row.role_name || '-')}</td>
          <td><span class="badge text-bg-warning text-dark">${escapeHtml(row.guild_name || '-')}</span></td>
          <td class="text-center mono">${escapeHtml(row.role_level || '-')}</td>
          <td>${escapeHtml(row.battle_data || '-')}</td>
          <td class="text-end mono">${formatNumber(row.gvg_score || 0)}</td>
          <td>${escapeHtml(formatDate(row.battle_time))}</td>
        </tr>
      `).join('');
    }

    async function loadLeaderboard() {
      const guild = DEFAULT_GUILD;
      const zoneId = zoneSelect.value;
      const serverId = serverSelect.value;

      if (!zoneId || !serverId) {
        setStatus('Please choose a zone and server first.', 'warning');
        return;
      }

      summaryGuild.textContent = guild;
      summaryCount.textContent = '...';
      leaderboardBody.innerHTML = `
        <tr>
          <td colspan="7" class="text-center text-secondary py-5">Loading leaderboard...</td>
        </tr>
      `;
      setStatus('Loading official GvG ranking data...', 'secondary');
      syncParams();

      try {
        const params = new URLSearchParams({
          zone_id: zoneId,
          server_id: serverId,
          guild_name: guild,
        });
        const payload = await fetchJson(`${LEADERBOARD_URL}?${params.toString()}`);
        renderRows(payload.results || []);
        summaryCount.textContent = formatNumber(payload.count || 0);
        setStatus(`Loaded ${payload.count || 0} row(s) for guild ${guild}.`, 'success');
      } catch (error) {
        summaryCount.textContent = '0';
        leaderboardBody.innerHTML = `
          <tr>
            <td colspan="7" class="text-center text-danger py-5">Failed to load leaderboard data.</td>
          </tr>
        `;
        setStatus(error.message || 'Failed to load leaderboard data.', 'danger');
      }
    }

    async function initPage() {
      const params = readParams();
      summaryGuild.textContent = DEFAULT_GUILD;

      try {
        const payload = await fetchJson(SERVERLIST_URL);
        zones = Array.isArray(payload.zones) ? payload.zones : [];
        populateZones(params.zone);
        populateServers(params.server);
        syncParams();
        await loadLeaderboard();
      } catch (error) {
        zoneSelect.innerHTML = '<option value="">Failed to load zone list</option>';
        serverSelect.innerHTML = '<option value="">Failed to load server list</option>';
        zoneSelect.disabled = true;
        serverSelect.disabled = true;
        loadButton.disabled = true;
        setStatus(error.message || 'Failed to load server list.', 'danger');
      }
    }

    zoneSelect.addEventListener('change', () => {
      populateServers();
      syncParams();
      loadLeaderboard();
    });

    serverSelect.addEventListener('change', () => {
      const zone = getSelectedZone();
      const selectedOption = serverSelect.options[serverSelect.selectedIndex];
      summaryServer.textContent = zone && selectedOption ? `${zone.name} / ${selectedOption.text}` : '-';
      syncParams();
      loadLeaderboard();
    });

    loadButton.addEventListener('click', async () => {
      await loadLeaderboard();
    });

    document.getElementById('current-year').textContent = new Date().getFullYear();

    (function() {
      const toggle = document.getElementById('themeToggle');
      if (!toggle) return;

      const label = toggle.querySelector('span');
      const lightLabel = toggle.dataset.lightLabel || 'Light mode';
      const darkLabel = toggle.dataset.darkLabel || 'Dark mode';
      const logos = document.querySelectorAll('[data-logo-light][data-logo-dark]');
      const getTheme = () => localStorage.getItem('rox_theme') || document.documentElement.getAttribute('data-bs-theme') || 'dark';
      const setLabel = (theme) => {
        if (label) label.textContent = theme === 'dark' ? lightLabel : darkLabel;
      };
      const setLogos = (theme) => {
        logos.forEach((img) => {
          const light = img.getAttribute('data-logo-light');
          const dark = img.getAttribute('data-logo-dark');
          if (theme === 'light' && light) {
            img.setAttribute('src', light);
          } else if (dark) {
            img.setAttribute('src', dark);
          }
        });
      };

      const currentTheme = getTheme();
      setLabel(currentTheme);
      setLogos(currentTheme);

      toggle.addEventListener('click', () => {
        const current = getTheme();
        const next = current === 'dark' ? 'light' : 'dark';
        localStorage.setItem('rox_theme', next);
        document.documentElement.setAttribute('data-bs-theme', next);
        setLabel(next);
        setLogos(next);
      });
    })();

    initPage();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
