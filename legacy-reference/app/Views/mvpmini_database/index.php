<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ROXPEDIA Team">
    <meta name="description" content="Browse MVP and Mini boss database for Ragnarok X: Next Generation with spawn maps, level caps, and drop preview.">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="ROXPEDIA - MVP / Mini Database">
    <meta property="og:description" content="MVP and Mini boss database with location, level cap, and drop preview.">
    <meta property="og:image" content="<?= base_url('assets/img/mvpmini.png') ?>">
    <meta property="og:url" content="<?= site_url('mvpmini-database') ?>">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ROXPEDIA - MVP / Mini Database">
    <meta name="twitter:description" content="MVP and Mini boss database with location, level cap, and drop preview.">
    <meta name="twitter:image" content="<?= base_url('assets/img/mvpmini.png') ?>">

    <link rel="canonical" href="<?= site_url('mvpmini-database') ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

    <title>ROXPEDIA - MVP / Mini Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
</head>

<body class="bg-body-tertiary">
    <?php
    if (!function_exists('boss_type_label')) {
        function boss_type_label($v): string
        {
            $n = (int)$v;
            return $n === 1 ? 'MVP' : ($n === 2 ? 'MINI' : ('TYPE ' . $n));
        }
    }
    ?>

    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <div class="mb-3 text-center">
                <h1 class="h3 mb-1">MVP / Mini Database</h1>
                <p class="text-secondary mb-0">Boss list with location and level cap.</p>
            </div>

            <form method="GET" class="row g-3 mb-4" id="searchForm">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search boss..."
                        value="<?= esc($search ?? '') ?>" aria-label="Search bosses">
                </div>

                <div class="col-md-2">
                    <select name="boss_type" class="form-select" aria-label="Boss Type">
                        <option value="">All Boss</option>
                        <option value="1" <?= ((string)($bossType ?? '') === '1') ? 'selected' : '' ?>>MVP</option>
                        <option value="2" <?= ((string)($bossType ?? '') === '2') ? 'selected' : '' ?>>MINI</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <select name="scene_id" class="form-select" aria-label="Scene">
                        <option value="">All Locations</option>
                        <?php foreach (($scenes ?? []) as $scene): ?>
                            <option value="<?= esc((string)$scene['scene_id']) ?>" <?= ((string)($sceneId ?? '') === (string)$scene['scene_id']) ? 'selected' : '' ?>>
                                <?= esc($scene['scene_name'] ?? ('Scene ' . $scene['scene_id'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <a href="?" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>

            <div class="row" id="bossGrid">
                <?php if (!empty($bosses)): ?>
                    <?php foreach ($bosses as $boss): ?>
                        <?php
                        $id = (int)($boss['id'] ?? 0);
                        $imgId = (int)($boss['static_id'] ?? $id);
                        $img = $imgId > 0 ? ($imgId . '.png') : '0.png';
                        $typeLabel = boss_type_label($boss['boss_type'] ?? 0);
                        $typeClass = ($typeLabel === 'MVP') ? 'text-bg-danger' : 'text-bg-warning';
                        ?>
                        <div class="col-sm-6 col-lg-4 mb-4 boss-col">
                            <div class="card h-100" onclick="window.location.href='<?= site_url('mvpmini-database/detail/' . $id) ?>';" role="button" tabindex="0">
                                <div class="row g-0 h-100 align-items-center">
                                    <div class="col-4 d-flex justify-content-center p-2">
                                        <img src="<?= base_url('assets/img/boss/' . esc($img)) ?>"
                                            onerror="this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';"
                                            class="img-fluid rounded-start object-fit-contain"
                                            width="80"
                                            height="80"
                                            alt="<?= esc($boss['name'] ?? 'Unknown') ?>">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <h5 class="card-title mb-0"><?= esc($boss['name'] ?? 'Unknown') ?></h5>
                                                <span class="badge <?= $typeClass ?> small fw-semibold"><?= esc($typeLabel) ?></span>
                                            </div>
                                            <p class="card-text small mb-1">
                                                Location: <?= esc($boss['spawn_location'] ?? 'Unknown') ?>
                                            </p>
                                            <p class="card-text small mb-0">Level Cap: <?= esc((string)($boss['level_cap'] ?? '-')) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning mb-0">No MVP/Mini data found for current filter.</div>
                    </div>
                <?php endif; ?>
            </div>

            <nav>
                <ul class="pagination justify-content-center mt-4" id="bossPagination">
                    <?php
                    $page = (int)($page ?? 1);
                    $totalPages = max(1, (int)($totalPages ?? 1));
                    $start = max(1, $page - 2);
                    $end = min($totalPages, $page + 2);
                    if ($page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => 1])) . '"><i class="fas fa-angle-double-left"></i></a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => $page - 1])) . '"><i class="fas fa-angle-left"></i></a></li>';
                    }
                    for ($i = $start; $i <= $end; $i++) {
                        echo '<li class="page-item' . ($i === $page ? ' active' : '') . '"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => $i])) . '">' . $i . '</a></li>';
                    }
                    if ($page < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => $page + 1])) . '"><i class="fas fa-angle-right"></i></a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '"><i class="fas fa-angle-double-right"></i></a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </main>

        <?= view('partials/site_footer') ?>
    </div>

    <script>
        (function() {
            const form = document.getElementById('searchForm');
            if (!form) return;

            const searchInput = form.querySelector('input[name="search"]');
            const selectFilters = form.querySelectorAll('select');
            const grid = document.getElementById('bossGrid');
            const pagination = document.getElementById('bossPagination');
            const detailBaseUrl = "<?= site_url('mvpmini-database/detail') ?>";
            const imgBaseUrl = "<?= base_url('assets/img/boss/') ?>";
            const fallbackImg = "<?= base_url('assets/logo.png') ?>";
            let fetchToken = 0;
            let typingTimer = null;

            function escapeHtml(v) {
                return String(v ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }

            function typeInfo(value) {
                const n = Number(value || 0);
                if (n === 1) return {
                    label: 'MVP',
                    className: 'text-bg-danger'
                };
                if (n === 2) return {
                    label: 'MINI',
                    className: 'text-bg-warning'
                };
                return {
                    label: `TYPE ${n}`,
                    className: 'text-bg-secondary'
                };
            }

            function buildBossCard(boss) {
                const id = Number(boss.id || 0);
                const imgId = Number(boss.static_id || boss.id || 0);
                const imgSrc = imgId > 0 ? `${imgBaseUrl}${imgId}.png` : fallbackImg;
                const name = boss.name || 'Unknown';
                const location = boss.spawn_location || 'Unknown';
                const levelCap = boss.level_cap || '-';
                const type = typeInfo(boss.boss_type);

                return `
                    <div class="col-sm-6 col-lg-4 mb-4 boss-col">
                        <div class="card h-100" onclick="window.location.href='${detailBaseUrl}/${id}';" role="button" tabindex="0">
                            <div class="row g-0 h-100 align-items-center">
                                <div class="col-4 d-flex justify-content-center p-2">
                                    <img src="${imgSrc}"
                                        onerror="this.onerror=null;this.src='${fallbackImg}';"
                                        class="img-fluid rounded-start object-fit-contain"
                                        width="80"
                                        height="80"
                                        alt="${escapeHtml(name)}">
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <h5 class="card-title mb-0">${escapeHtml(name)}</h5>
                                            <span class="badge ${type.className} small fw-semibold">${type.label}</span>
                                        </div>
                                        <p class="card-text small mb-1">Location: ${escapeHtml(location)}</p>
                                        <p class="card-text small mb-0">Level Cap: ${escapeHtml(levelCap)}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            function renderEmptyState() {
                if (!grid) return;
                grid.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-warning mb-0">No MVP/Mini data found for current filter.</div>
                    </div>
                `;
            }

            function buildPaginationItem(page, label, active) {
                const activeClass = active ? ' active' : '';
                return `<li class="page-item${activeClass}"><button type="button" class="page-link" data-page="${page}">${label}</button></li>`;
            }

            function renderPagination(page, totalPages) {
                if (!pagination) return;
                const current = Math.max(1, Number(page || 1));
                const total = Math.max(1, Number(totalPages || 1));

                if (total <= 1) {
                    pagination.innerHTML = '';
                    return;
                }

                const start = Math.max(1, current - 2);
                const end = Math.min(total, current + 2);
                let html = '';

                if (current > 1) {
                    html += buildPaginationItem(1, '<i class="fas fa-angle-double-left"></i>', false);
                    html += buildPaginationItem(current - 1, '<i class="fas fa-angle-left"></i>', false);
                }

                for (let i = start; i <= end; i++) {
                    html += buildPaginationItem(i, String(i), i === current);
                }

                if (current < total) {
                    html += buildPaginationItem(current + 1, '<i class="fas fa-angle-right"></i>', false);
                    html += buildPaginationItem(total, '<i class="fas fa-angle-double-right"></i>', false);
                }

                pagination.innerHTML = html;
            }

            function applyData(data) {
                const rows = Array.isArray(data.bosses) ? data.bosses : [];
                if (!rows.length) {
                    renderEmptyState();
                } else if (grid) {
                    grid.innerHTML = rows.map(buildBossCard).join('');
                }

                renderPagination(data.page || 1, data.totalPages || 1);
            }

            function updateBrowserUrlFromParams(params) {
                const clean = new URLSearchParams(params.toString());
                clean.delete('ajax');

                if (!clean.get('search')) clean.delete('search');
                if (!clean.get('boss_type')) clean.delete('boss_type');
                if (!clean.get('scene_id')) clean.delete('scene_id');

                const query = clean.toString();
                const target = query ? `${window.location.pathname}?${query}` : window.location.pathname;
                window.history.replaceState({}, '', target);
            }

            async function fetchBosses(page) {
                const params = new URLSearchParams(new FormData(form));
                params.set('page', String(page || 1));
                params.set('ajax', '1');

                const token = ++fetchToken;
                try {
                    const response = await fetch(`${window.location.pathname}?${params.toString()}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    if (!response.ok) return;
                    const data = await response.json();
                    if (token !== fetchToken) return;
                    applyData(data);
                    updateBrowserUrlFromParams(params);
                } catch (err) {
                    console.error('Boss search failed', err);
                }
            }

            function scheduleSearch() {
                if (typingTimer) window.clearTimeout(typingTimer);
                typingTimer = window.setTimeout(function() {
                    fetchBosses(1);
                }, 180);
            }

            selectFilters.forEach(function(el) {
                el.addEventListener('change', function() {
                    fetchBosses(1);
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', scheduleSearch);
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        fetchBosses(1);
                    }
                });
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                fetchBosses(1);
            });

            if (pagination) {
                pagination.addEventListener('click', function(e) {
                    const btn = e.target.closest('[data-page]');
                    if (btn) {
                        const page = Number(btn.getAttribute('data-page') || 1);
                        fetchBosses(page > 0 ? page : 1);
                        return;
                    }

                    const link = e.target.closest('a.page-link[href]');
                    if (!link) return;
                    e.preventDefault();
                    const url = new URL(link.href, window.location.origin);
                    const page = Number(url.searchParams.get('page') || 1);
                    fetchBosses(page > 0 ? page : 1);
                });
            }
        })();

        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>

