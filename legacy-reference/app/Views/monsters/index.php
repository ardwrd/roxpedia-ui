<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Cherubim">
    <meta name="description" content="Access all of the monster information from their HP, defense to dropped materials.">
    <meta name="keywords" content="Monster Database, ROX Monsters, Ragnarok X, Monster Guide, Monster Locations, Monster Drops">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">

    <meta property="og:title" content="ROXPEDIA - Monster Database">
    <meta property="og:description" content="Access all of the monster information from their HP, defense to dropped materials.">
    <meta property="og:image" content="<?= base_url('assets/img/monster.png') ?>">
    <meta property="og:url" content="<?= site_url('monsters') ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ROXPEDIA">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ROXPEDIA - Monster Database">
    <meta name="twitter:description" content="Access all of the monster information from their HP, defense to dropped materials.">
    <meta name="twitter:image" content="<?= base_url('assets/img/monster.png') ?>">
    <meta name="twitter:site" content="@ROXPEDIA">

    <link rel="canonical" href="<?= site_url('monsters') ?>">
    <meta http-equiv="content-language" content="en">

    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

    <title>ROXPEDIA - Monster Database</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
    <style>
        .badge-attr-shadow {
            background: #7c3aed;
            color: #f5f3ff;
        }

        .badge-size-small {
            background: #06b6d4;
            color: #062022;
        }

        .badge-size-medium {
            background: #f59e0b;
            color: #1f2937;
        }

        .badge-size-large {
            background: #64748b;
            color: #f8fafc;
        }

        .badge-size-giant {
            background: #be123c;
            color: #fff1f2;
        }
    </style>
</head>

<body class="bg-body-tertiary">
    <?php
    helper('badge');
    $expDefaults = $expDefaults ?? [
        'charLevel'     => 1,
        'partySize'     => '1',
        'uniqueClasses' => 1,
        'worldLevel'    => 150,
        'useOdin'       => false,
        'exactAbove50'  => false,
    ];
    $filteredMonsterCount = is_array($monstersForCalc ?? null)
        ? count($monstersForCalc)
        : count($monsters ?? []);
    ?>

    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <section class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4 p-lg-5">
                    <div class="row g-4">
                        <div class="col-12 col-lg-9 col-xl-8">
                            <span class="badge text-bg-primary mb-3">Monster Database</span>
                            <h1 class="display-6 fw-semibold mb-3">Find the right monster faster</h1>
                            <p class="lead text-secondary mb-4">Search, filter, and compare monsters with EXP recommendations, drops, and quick access to detail pages.</p>
                            <div class="d-flex flex-wrap gap-2">
                                <a class="btn btn-primary" href="#monster-results">Browse Monsters</a>
                                <a class="btn btn-outline-secondary" href="<?= site_url('documentation') ?>">API Documentation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row g-4">
                <div class="col-lg-4 col-xl-3">
                    <div class="position-sticky" style="top: 1rem;">
                        <form method="GET" class="card shadow-sm mb-4" id="searchForm">
                            <div class="card-body">
                                <h2 class="h5 mb-1">Filters</h2>
                                <p class="text-secondary small mb-3">Narrow the monster list quickly.</p>

                                <div class="mb-3">
                                    <label class="form-label" for="monsterSearch">Search</label>
                                    <input id="monsterSearch" type="text" name="search" class="form-control" placeholder="Search monster..." value="<?= esc($search ?? '') ?>" aria-label="Search monsters">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="monsterBodily">Size</label>
                                    <select id="monsterBodily" name="bodily" class="form-select" aria-label="Bodily">
                                        <option value="">All Sizes</option>
                                        <?php foreach (($bodily ?? []) as $b): ?>
                                            <option value="<?= esc($b['num']) ?>" <?= ((string)($bodilySelected ?? '') === (string)($b['num'])) ? 'selected' : '' ?>><?= esc($b['name'] ?? '-') ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="monsterRaceProperty">Race / Property</label>
                                    <select id="monsterRaceProperty" name="rp" class="form-select" aria-label="Race Property">
                                        <option value="">All Races &amp; Properties</option>
                                        <?php foreach (($raceProperty ?? []) as $opt): ?>
                                            <?php
                                            $kind = (string)($opt['kind'] ?? '');
                                            $num  = (string)($opt['num'] ?? '');
                                            $name = (string)($opt['name'] ?? '');
                                            if ($kind === '' || $num === '' || $name === '') continue;
                                            if (strtolower($kind) === 'property' && strtolower($name) === 'undead') continue;
                                            $value = strtolower($kind) . ':' . $num;
                                            $label = ($kind === 'Race' || strtolower($kind) === 'race') ? ('Race: ' . $name) : ('Property: ' . $name);
                                            ?>
                                            <option value="<?= esc($value) ?>" <?= ((string)($rpSelected ?? '') === (string)$value) ? 'selected' : '' ?>><?= esc($label) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="<?= site_url('monsters') ?>" class="btn btn-outline-secondary">Reset</a>
                                </div>
                            </div>
                        </form>

                        <section class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h2 class="h5 mb-1">EXP Calculator</h2>
                                <p class="text-secondary small mb-3">Preview solo and party EXP from the current filters.</p>

                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="form-label">Your Level</label>
                                        <select id="charLevel" class="form-select exp-control">
                                            <?php for ($i = 1; $i <= 160; $i++): ?>
                                                <option value="<?= $i ?>" <?= $i == (int)$expDefaults['charLevel'] ? 'selected' : '' ?>><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Party Size</label>
                                        <select id="partySize" class="form-select exp-control">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <option value="<?= $i ?>" <?= ((string)$i === (string)($expDefaults['partySize'] ?? '1')) ? 'selected' : '' ?>><?= $i ?></option>
                                            <?php endfor; ?>
                                            <option value="2c" <?= ((string)($expDefaults['partySize'] ?? '') === '2c') ? 'selected' : '' ?>>2 + Couple</option>
                                            <option value="3c" <?= ((string)($expDefaults['partySize'] ?? '') === '3c') ? 'selected' : '' ?>>3 + Couple</option>
                                            <option value="4c" <?= ((string)($expDefaults['partySize'] ?? '') === '4c') ? 'selected' : '' ?>>4 + Couple</option>
                                            <option value="5c" <?= ((string)($expDefaults['partySize'] ?? '') === '5c') ? 'selected' : '' ?>>5 + Couple</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Unique Classes</label>
                                        <select id="uniqueClasses" class="form-select exp-control">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <option value="<?= $i ?>" <?= $i == (int)$expDefaults['uniqueClasses'] ? 'selected' : '' ?>><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">World Level</label>
                                        <select id="worldLevel" class="form-select exp-control">
                                            <?php for ($i = 1; $i <= 160; $i++): ?>
                                                <option value="<?= $i ?>" <?= $i == (int)$expDefaults['worldLevel'] ? 'selected' : '' ?>><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input exp-control" type="checkbox" id="useOdin" <?= !empty($expDefaults['useOdin']) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="useOdin">Use 5x EXP (Odin)</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input exp-control" type="checkbox" id="exactAbove50" <?= !empty($expDefaults['exactAbove50']) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="exactAbove50">Base EXP &gt; 50%</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div id="exp-recommendation" class="card shadow-sm">
                            <div class="card-body">
                                <h2 class="h6 mb-2">Best Matches</h2>
                                <div class="alert alert-secondary py-2 mb-0 small">Adjust the EXP Calculator above to view recommended monsters for Burning Odin and AFK without Odin.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-xl-9">
                    <section id="monster-results" class="card shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                                <div>
                                    <h2 class="h4 mb-1">Monster Results</h2>
                                    <p class="text-secondary mb-0">Scan the core info first, then open the detail page when you need full stats, drops, or skills.</p>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge text-bg-primary">Filtered: <span id="monsterCountValueInline"><?= number_format($filteredMonsterCount) ?></span></span>
                                    <span class="badge text-bg-secondary" id="monsterPageValueInline">Page <?= (int)($page ?? 1) ?> / <?= (int)($total_pages ?? 1) ?></span>
                                </div>
                            </div>

                            <div class="row g-4" id="monsterGrid">
                <?php if (!empty($monsters)): ?>
                    <?php foreach ($monsters as $monster): ?>
                        <?php
                        $id = (int)($monster['id'] ?? 0);
                        $imgId = (int)($monster['res_id'] ?? 0);
                        if ($imgId <= 0) $imgId = (int)($monster['static_id'] ?? 0);
                        if ($imgId <= 0) $imgId = $id;
                        $img = $imgId > 0 ? ($imgId . '.png') : 'placeholder.png';
                        ?>
                        <div class="col-12 col-xl-6 monster-col">
                            <div class="card h-100 shadow-sm monster-row position-relative"
                                onclick="window.location.href='<?= site_url('monsters/detail/' . $id); ?>';"
                                style="cursor: pointer;"
                                data-level="<?= (int)($monster['level'] ?? 1); ?>"
                                data-base-exp="<?= (float)($monster['base_exp'] ?? 0); ?>"
                                data-job-exp="<?= (float)($monster['job_exp'] ?? 0); ?>">
                                <div class="card-body">
                                    <div class="d-flex gap-3">
                                        <div class="rounded-3 border bg-body-tertiary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 88px; height: 88px;">
                                            <img src="<?= base_url('assets/img/monster/' . esc($img)); ?>"
                                                onerror="this.onerror=null;this.src='<?= base_url('assets/img/monster/placeholder.png') ?>';"
                                                class="img-fluid"
                                                style="max-width: 72px; max-height: 72px; object-fit: contain;"
                                                alt="<?= esc($monster['name'] ?? 'Unknown'); ?>">
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                                <h3 class="h5 mb-0"><?= esc($monster['name'] ?? 'Unknown') ?></h3>
                                                <span class="badge text-bg-primary">Lv <?= esc($monster['level'] ?? 'N/A') ?></span>
                                            </div>

                                            <div class="d-flex flex-wrap gap-1 mb-2">
                                                <?php
                                                $prop = (string)($monster['property_name'] ?? '');
                                                if ($prop === '' && !empty($monster['property_id'])) {
                                                    $prop = 'Property ' . (int)$monster['property_id'];
                                                }
                                                if ($prop !== '') {
                                                    $badge = badge_css_class($prop);
                                                    echo '<span class="badge ' . $badge . ' small fw-semibold">' . esc($prop) . '</span>';
                                                }

                                                $raceName = (string)($monster['race_name'] ?? '');
                                                if ($raceName !== '') {
                                                    $badge = badge_css_class($raceName);
                                                    echo '<span class="badge ' . $badge . ' small fw-semibold">' . esc($raceName) . '</span>';
                                                }

                                                $bodilyName = (string)($monster['bodily_name'] ?? '');
                                                if ($bodilyName !== '') {
                                                    $badge = badge_size_class($bodilyName);
                                                    echo '<span class="badge ' . $badge . ' small fw-semibold">' . esc($bodilyName) . '</span>';
                                                }
                                                ?>
                                            </div>

                                            <p class="small text-secondary mb-3">
                                                <i class="fa-solid fa-location-dot me-1"></i><?= esc($monster['spawn_location'] ?? 'Unknown') ?>
                                            </p>

                                            <div class="row row-cols-2 g-2">
                                                <div class="col">
                                                    <div class="border rounded-3 p-2 h-100 bg-body-tertiary">
                                                        <div class="small text-uppercase text-secondary">Base EXP</div>
                                                        <div class="fw-semibold"><?= number_format((float)($monster['base_exp'] ?? 0)) ?></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="border rounded-3 p-2 h-100 bg-body-tertiary">
                                                        <div class="small text-uppercase text-secondary">Job EXP</div>
                                                        <div class="fw-semibold"><?= number_format((float)($monster['job_exp'] ?? 0)) ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3 exp-result small lh-sm"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning mb-0">Tidak ada monster yang cocok.</div>
                    </div>
                <?php endif; ?>
            </div>

            <nav class="mt-4" aria-label="Monster pagination">
                <ul class="pagination justify-content-center mb-0" id="monsterPagination">
                    <?php
                    $page = (int)($page ?? 1);
                    $total_pages = (int)($total_pages ?? 1);

                    $start = max(1, $page - 2);
                    $end   = min($total_pages, $page + 2);

                    if ($page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => 1])) . '"><i class="fas fa-angle-double-left"></i></a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => $page - 1])) . '"><i class="fas fa-angle-left"></i></a></li>';
                    }

                    for ($i = $start; $i <= $end; $i++) {
                        echo '<li class="page-item' . ($i == $page ? ' active' : '') . '"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => $i])) . '">' . $i . '</a></li>';
                    }

                    if ($page < $total_pages) {
                        echo '<li class="page-item"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => $page + 1])) . '"><i class="fas fa-angle-right"></i></a></li>';
                        echo '<li class="page-item"><a class="page-link" href="?' . http_build_query(array_merge($_GET, ['page' => $total_pages])) . '"><i class="fas fa-angle-double-right"></i></a></li>';
                    }
                    ?>
                </ul>
            </nav>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <?= view('partials/site_footer') ?>
    </div>

    <script>
        (function() {
            const form = document.getElementById('searchForm');
            if (!form) return;

            const searchInput = form.querySelector('input[name="search"]');
            const selectFilters = form.querySelectorAll('select');
            const grid = document.getElementById('monsterGrid');
            const pagination = document.getElementById('monsterPagination');
            const apiBaseUrl = "<?= site_url('api/monsters') ?>";
            const detailBaseUrl = "<?= site_url('monsters/detail'); ?>/";
            const imgBaseUrl = "<?= base_url('assets/img/monster/') ?>";
            let fetchToken = 0;
            let typingTimer = null;

            const badgeMap = <?= json_encode(badge_variant_map(), JSON_UNESCAPED_UNICODE) ?>;
            const sizeBadgeMap = <?= json_encode(badge_size_class_map(), JSON_UNESCAPED_UNICODE) ?>;

            function escapeHtml(v) {
                return String(v ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }

            function normalizeBadgeKey(label) {
                return String(label || '')
                    .trim()
                    .toLowerCase()
                    .replace(/^(race|property|bodily|size)\s*(?:[:\-]\s*)?/i, '')
                    .replace(/[_\s]+/g, '-')
                    .replace('demihuman', 'demi-human')
                    .replace('semi-human', 'demi-human')
                    .replace(/[^a-z0-9\-]/g, '');
            }

            function badgeClass(label) {
                const key = normalizeBadgeKey(label);
                if (key === 'shadow') {
                    return 'badge-attr-shadow';
                }
                return 'text-bg-' + (badgeMap[key] || 'secondary');
            }

            function sizeBadgeClass(label) {
                const key = normalizeBadgeKey(label);
                return sizeBadgeMap[key] || 'text-bg-secondary';
            }

            function renderBadge(label, kind = 'default') {
                if (!label) return '';
                const cls = kind === 'size' ? sizeBadgeClass(label) : badgeClass(label);
                return `<span class="badge ${cls} small fw-semibold text-capitalize">${escapeHtml(label)}</span>`;
            }

            function renderBodilyOptions(options, selectedValue) {
                const bodilySelect = form.querySelector('select[name="bodily"]');
                if (!bodilySelect) return;

                let html = '<option value="">All Sizes</option>';
                (Array.isArray(options) ? options : []).forEach((opt) => {
                    const value = String(opt?.num ?? '');
                    const name = String(opt?.name ?? '');
                    if (!value || !name) return;

                    const selected = String(selectedValue ?? '') === value ? ' selected' : '';
                    html += `<option value="${escapeHtml(value)}"${selected}>${escapeHtml(name)}</option>`;
                });

                bodilySelect.innerHTML = html;
            }

            function renderRacePropertyOptions(options, selectedValue) {
                const rpSelect = form.querySelector('select[name="rp"]');
                if (!rpSelect) return;

                let html = '<option value="">All Races &amp; Properties</option>';
                (Array.isArray(options) ? options : []).forEach((opt) => {
                    const kindRaw = String(opt?.kind ?? '');
                    const num = String(opt?.num ?? '');
                    const name = String(opt?.name ?? '');
                    if (!kindRaw || !num || !name) return;
                    if (kindRaw.toLowerCase() === 'property' && name.toLowerCase() === 'undead') return;

                    const kind = kindRaw.toLowerCase();
                    const value = `${kind}:${num}`;
                    const label = kind === 'race'
                        ? `Race: ${name}`
                        : `Property: ${name}`;
                    const selected = String(selectedValue ?? '') === value ? ' selected' : '';

                    html += `<option value="${escapeHtml(value)}"${selected}>${escapeHtml(label)}</option>`;
                });

                rpSelect.innerHTML = html;
            }

            function updateSummary(totalCount, page, totalPages) {
                const countValue = document.getElementById('monsterCountValue');
                const countValueInline = document.getElementById('monsterCountValueInline');
                const pageValue = document.getElementById('monsterPageValue');
                const pageValueInline = document.getElementById('monsterPageValueInline');
                const totalText = Number(totalCount || 0).toLocaleString();
                const pageText = `${Number(page || 1)} / ${Number(totalPages || 1)}`;

                if (countValue) countValue.textContent = totalText;
                if (countValueInline) countValueInline.textContent = totalText;
                if (pageValue) pageValue.textContent = pageText;
                if (pageValueInline) pageValueInline.textContent = `Page ${pageText}`;
            }

            function buildMonsterCard(monster) {
                const id = Number(monster.id || 0);
                let imgId = Number(monster.res_id || 0);
                if (imgId <= 0) imgId = Number(monster.static_id || 0);
                if (imgId <= 0) imgId = id;
                const img = imgId > 0 ? `${imgBaseUrl}${imgId}.png` : `${imgBaseUrl}placeholder.png`;

                const name = monster.name || 'Unknown';
                const level = Number(monster.level || 1);
                const spawn = monster.spawn_location || 'Unknown';
                const baseExp = Number(monster.base_exp || 0);
                const jobExp = Number(monster.job_exp || 0);
                const propertyLabel = monster.property_name || (monster.property_id ? `Property ${monster.property_id}` : '');

                return `
                    <div class="col-12 col-xl-6 monster-col">
                        <div class="card h-100 shadow-sm monster-row position-relative"
                            onclick="window.location.href='${detailBaseUrl}${id}';"
                            style="cursor: pointer;"
                            data-level="${level}"
                            data-base-exp="${baseExp}"
                            data-job-exp="${jobExp}">
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <div class="rounded-3 border bg-body-tertiary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 88px; height: 88px;">
                                        <img src="${img}"
                                            onerror="this.onerror=null;this.src='${imgBaseUrl}placeholder.png';"
                                            class="img-fluid"
                                            style="max-width: 72px; max-height: 72px; object-fit: contain;"
                                            alt="${escapeHtml(name)}">
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                            <h3 class="h5 mb-0">${escapeHtml(name)}</h3>
                                            <span class="badge text-bg-primary">Lv ${level}</span>
                                        </div>

                                        <div class="d-flex flex-wrap gap-1 mb-2">
                                            ${renderBadge(propertyLabel)}
                                            ${renderBadge(monster.race_name || '')}
                                            ${renderBadge(monster.bodily_name || '', 'size')}
                                        </div>

                                        <p class="small text-secondary mb-3">
                                            <i class="fa-solid fa-location-dot me-1"></i>${escapeHtml(spawn)}
                                        </p>

                                        <div class="row row-cols-2 g-2">
                                            <div class="col">
                                                <div class="border rounded-3 p-2 h-100 bg-body-tertiary">
                                                    <div class="small text-uppercase text-secondary">Base EXP</div>
                                                    <div class="fw-semibold">${baseExp.toLocaleString()}</div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="border rounded-3 p-2 h-100 bg-body-tertiary">
                                                    <div class="small text-uppercase text-secondary">Job EXP</div>
                                                    <div class="fw-semibold">${jobExp.toLocaleString()}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3 exp-result small lh-sm"></div>
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
                        <div class="alert alert-warning mb-0">Tidak ada monster yang cocok.</div>
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
                const rows = Array.isArray(data.monsters) ? data.monsters : [];
                const calcRows = Array.isArray(data.monstersForCalc) ? data.monstersForCalc : [];

                renderRacePropertyOptions(data.raceProperty, data.rpSelected);
                renderBodilyOptions(data.bodily, data.bodilySelected);
                updateSummary(calcRows.length || rows.length, data.page || 1, data.total_pages || 1);

                if (!rows.length) {
                    renderEmptyState();
                } else {
                    if (grid) {
                        grid.innerHTML = rows.map(buildMonsterCard).join('');
                    }
                }

                if (Array.isArray(data.monstersForCalc)) {
                    window.MONSTERS_FOR_CALC = data.monstersForCalc;
                }

                renderPagination(data.page || 1, data.total_pages || 1);

                if (typeof window.recalcAllMonstersExp === 'function') {
                    window.recalcAllMonstersExp();
                }
            }

            function updateBrowserUrlFromParams(params) {
                const clean = new URLSearchParams(params.toString());
                clean.delete('ajax');

                if (!clean.get('search')) clean.delete('search');
                if (!clean.get('rp')) clean.delete('rp');
                if (!clean.get('bodily')) clean.delete('bodily');
                if (!clean.get('type')) clean.delete('type');

                const query = clean.toString();
                const target = query ? `${window.location.pathname}?${query}` : window.location.pathname;
                window.history.replaceState({}, '', target);
            }

            async function fetchMonsters(page) {
                const params = new URLSearchParams(new FormData(form));
                params.set('page', String(page || 1));

                const token = ++fetchToken;
                try {
                    const response = await fetch(`${apiBaseUrl}?${params.toString()}`, {
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
                    console.error('Monster search failed', err);
                }
            }

            function scheduleSearch() {
                if (typingTimer) window.clearTimeout(typingTimer);
                typingTimer = window.setTimeout(function() {
                    fetchMonsters(1);
                }, 180);
            }

            selectFilters.forEach(function(el) {
                el.addEventListener('change', function() {
                    fetchMonsters(1);
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', scheduleSearch);
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        fetchMonsters(1);
                    }
                });
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                fetchMonsters(1);
            });

            if (pagination) {
                pagination.addEventListener('click', function(e) {
                    const btn = e.target.closest('[data-page]');
                    if (btn) {
                        const page = Number(btn.getAttribute('data-page') || 1);
                        fetchMonsters(page > 0 ? page : 1);
                        return;
                    }

                    const link = e.target.closest('a.page-link[href]');
                    if (!link) return;
                    e.preventDefault();
                    const url = new URL(link.href, window.location.origin);
                    const page = Number(url.searchParams.get('page') || 1);
                    fetchMonsters(page > 0 ? page : 1);
                });
            }

            if (grid && !grid.querySelector('.monster-col')) {
                fetchMonsters(<?= (int)($page ?? 1) ?>);
            }
        })();

        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        window.MONSTERS_FOR_CALC = <?= json_encode(
                                        array_map(function ($m) {
                                            return [
                                                'id'             => (int)($m['id'] ?? 0),
                                                'name'           => $m['name'] ?? 'Unknown',
                                                'level'          => (int)($m['level'] ?? 1),
                                                'base_exp'       => (float)($m['base_exp'] ?? 0),
                                                'job_exp'        => (float)($m['job_exp'] ?? 0),
                                                'spawn_location' => $m['spawn_location'] ?? '',
                                            ];
                                        }, $monstersForCalc ?? []),
                                        JSON_UNESCAPED_UNICODE
                                    ); ?>;

        const MONSTER_DETAIL_BASE_URL = "<?= site_url('monsters/detail'); ?>/";
        const MONSTER_IMG_BASE_URL = "<?= base_url('assets/img/monster/') ?>";
    </script>

    <script>
        let hasUserInteractedWithExp = false;

        function getExpSettings() {
            const charLevel = parseInt(document.getElementById('charLevel')?.value || '1', 10);

            const partyRaw = String(document.getElementById('partySize')?.value || '1');
            const coupleExp = partyRaw.toLowerCase().endsWith('c');
            const partySize = parseInt(partyRaw, 10) || 1;

            const uniqueClasses = parseInt(document.getElementById('uniqueClasses')?.value || '1', 10);
            let worldLevel = parseInt(document.getElementById('worldLevel')?.value || '150', 10);
            const useOdin = document.getElementById('useOdin')?.checked || false;
            const exactAbove50 = document.getElementById('exactAbove50')?.checked || false;

            if (isNaN(worldLevel)) worldLevel = 150;
            worldLevel = Math.min(Math.max(worldLevel, 1), 160);

            return {
                charLevel,
                partySize: Math.min(Math.max(partySize, 1), 5),
                uniqueClasses: Math.min(Math.max(uniqueClasses, 1), 5),
                worldLevel,
                useOdin,
                exactAbove50,
                coupleExp
            };
        }

        function getLevelPenalty(charLevel, monsterLevel) {
            const diff = Math.abs(charLevel - monsterLevel);
            if (diff <= 3) return 1.0;
            if (diff <= 6) return 0.8;
            return 0.1;
        }

        function getPartyCoefficient(partySize, uniqueClasses, coupleExp) {
            const partySizeBonus = [1.00, 1.10, 1.20, 1.30, 1.40];
            const uniqueClassBonus = [1.00, 1.05, 1.10, 1.15, 1.20];

            const sizeIdx = Math.min(Math.max(partySize, 1), 5) - 1;
            const classIdx = Math.min(Math.max(uniqueClasses, 1), 5) - 1;

            const couple = coupleExp ? 1.05 : 1.00;
            return partySizeBonus[sizeIdx] * uniqueClassBonus[classIdx] * couple;
        }

        function getWorldLevelOdinMultiplier(worldLevel, charLevel, useOdin) {
            if (!useOdin) return 1;
            const diff = worldLevel - charLevel;

            if (diff < 30) return 5;
            if (diff <= 49) return 10;
            if (diff <= 69) return 9;
            if (diff <= 89) return 8;
            if (diff <= 99) return 7;
            return 6;
        }

        function calculateExpForMonster(monster, settings) {
            const baseExp = monster.baseExp;
            const jobExp = monster.jobExp;
            const mLevel = monster.level;

            const lvlPenalty = getLevelPenalty(settings.charLevel, mLevel);
            const partyCoeff = getPartyCoefficient(settings.partySize, settings.uniqueClasses, settings.coupleExp);
            const odinMult = getWorldLevelOdinMultiplier(settings.worldLevel, settings.charLevel, settings.useOdin);

            const soloBaseNoOdin = baseExp * lvlPenalty;
            const soloJobNoOdin = jobExp * lvlPenalty;

            const soloBaseOdin = soloBaseNoOdin * odinMult;
            const soloJobOdin = soloJobNoOdin * odinMult;

            const totalBaseParty = baseExp * lvlPenalty * partyCoeff;
            const totalJobParty = jobExp * lvlPenalty * partyCoeff;

            const partyBaseNoOdinEach = totalBaseParty / settings.partySize;
            const partyJobNoOdinEach = totalJobParty / settings.partySize;

            const partyBaseOdinEach = partyBaseNoOdinEach * odinMult;
            const partyJobOdinEach = partyJobNoOdinEach * odinMult;

            const round = (v) => Math.round(v);

            const scoreOdin = partyBaseOdinEach + partyJobOdinEach;
            const scoreNoOdin = partyBaseNoOdinEach + partyJobNoOdinEach;

            return {
                soloBaseNoOdin: round(soloBaseNoOdin),
                soloJobNoOdin: round(soloJobNoOdin),
                soloBaseOdin: round(soloBaseOdin),
                soloJobOdin: round(soloJobOdin),
                partyBaseNoOdinEach: round(partyBaseNoOdinEach),
                partyJobNoOdinEach: round(partyJobNoOdinEach),
                partyBaseOdinEach: round(partyBaseOdinEach),
                partyJobOdinEach: round(partyJobOdinEach),
                rawBase: baseExp,
                rawJob: jobExp,
                scoreOdin: scoreOdin,
                scoreNoOdin: scoreNoOdin
            };
        }

        function recalcAllMonstersExp() {
            const settings = getExpSettings();
            const grid = document.getElementById('monsterGrid');
            const recEl = document.getElementById('exp-recommendation');
            if (!grid) return;

            const cols = Array.from(grid.querySelectorAll('.monster-col'));

            cols.forEach(col => {
                const row = col.querySelector('.monster-row');
                if (!row) return;

                const level = parseInt(row.dataset.level || '1', 10);
                const baseExp = parseFloat(row.dataset.baseExp || '0');
                const jobExp = parseFloat(row.dataset.jobExp || '0');

                const cell = row.querySelector('.exp-result');
                if (!baseExp && !jobExp) {
                    if (cell) cell.innerHTML = '';
                    return;
                }

                const result = calculateExpForMonster({
                    level,
                    baseExp,
                    jobExp
                }, settings);

                if (cell) {
                    cell.innerHTML = `
                <div class="table-responsive">
                    <table class="table table-borderless table-sm mb-1 text-info">
                        <thead>
                            <tr>
                                <th class="small fw-semibold">Mode</th>
                                <th class="small fw-semibold">No Odin</th>
                                <th class="small fw-semibold">With Odin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="small">Solo</td>
                                <td class="small">
                                    Base: ${result.soloBaseNoOdin.toLocaleString()}<br>
                                    Job: ${result.soloJobNoOdin.toLocaleString()}
                                </td>
                                <td class="small">
                                    Base: ${result.soloBaseOdin.toLocaleString()}<br>
                                    Job: ${result.soloJobOdin.toLocaleString()}
                                </td>
                            </tr>
                            <tr>
                                <td class="small">Party (each)</td>
                                <td class="small">
                                    Base: ${result.partyBaseNoOdinEach.toLocaleString()}<br>
                                    Job: ${result.partyJobNoOdinEach.toLocaleString()}
                                </td>
                                <td class="small">
                                    Base: ${result.partyBaseOdinEach.toLocaleString()}<br>
                                    Job: ${result.partyJobOdinEach.toLocaleString()}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="small text-secondary">
                        Raw (DB) Base: ${result.rawBase.toLocaleString()} / Job: ${result.rawJob.toLocaleString()}
                    </div>
                </div>
            `;
                }
            });

            if (!hasUserInteractedWithExp) {
                if (recEl) {
                    recEl.innerHTML = `
                <div class="alert alert-secondary py-2 mb-0 small">
                    Adjust the EXP Calculator above to view recommended monsters for Burning Odin and AFK without Odin.
                </div>
            `;
                }
                return;
            }

            let allForCalc = (window.MONSTERS_FOR_CALC || []).map(m => {
                const level = parseInt(m.level || 1, 10);
                const baseExp = parseFloat(m.base_exp || 0);
                const jobExp = parseFloat(m.job_exp || 0);
                const result = calculateExpForMonster({
                    level,
                    baseExp,
                    jobExp
                }, settings);
                return {
                    data: m,
                    level,
                    result
                };
            });

            const playerLevel = settings.charLevel;
            const inRange = allForCalc.filter(m => Math.abs(m.level - playerLevel) <= 5);

            function pickBelowAndAbove(list, scoreKey) {
                const below = list.filter(m => m.level <= playerLevel).sort((a, b) => b.result[scoreKey] - a.result[scoreKey]);
                const above = list.filter(m => m.level > playerLevel).sort((a, b) => b.result[scoreKey] - a.result[scoreKey]);
                const picked = [];
                if (below.length > 0) picked.push(below[0]);
                if (above.length > 0) picked.push(above[0]);
                return picked;
            }

            const bestOdin = pickBelowAndAbove(inRange, "scoreOdin");
            const bestNoOdin = pickBelowAndAbove(inRange, "scoreNoOdin");

            function renderMonsterMiniCard(item) {
                const m = item.data;
                const name = m.name || 'Unknown';
                const level = m.level || 'N/A';
                const img = (m.id ? (MONSTER_IMG_BASE_URL + m.id + '.png') : '');
                const url = MONSTER_DETAIL_BASE_URL + m.id;

                const baseOdin = item.result.partyBaseOdinEach;
                const jobOdin = item.result.partyJobOdinEach;
                const baseNo = item.result.partyBaseNoOdinEach;
                const jobNo = item.result.partyJobNoOdinEach;

                return `
            <a href="${url}" class="text-decoration-none text-reset">
                <div class="d-flex flex-column align-items-center text-center mb-3">
                    ${img ? `<img src="${img}" onerror="this.onerror=null;this.src='${MONSTER_IMG_BASE_URL}placeholder.png';" alt="${name}" class="rounded mb-1" style="width:60px;height:60px;object-fit:contain;">` : ''}
                    <div class="fw-semibold">${name}</div>
                    <div class="small text-secondary">(Level ${level})</div>
                    <div class="small mt-1">
                        <div><span class="fw-semibold">Base:</span> ${baseNo.toLocaleString()} <span class="text-success">(${baseOdin.toLocaleString()}/Odin)</span></div>
                        <div><span class="fw-semibold">Job:</span> ${jobNo.toLocaleString()} <span class="text-success">(${jobOdin.toLocaleString()}/Odin)</span></div>
                    </div>
                </div>
            </a>
        `;
            }

            const hasOdinRec = bestOdin.length > 0;
            const hasNoOdinRec = bestNoOdin.length > 0;

            if (recEl) {
                if (!hasOdinRec && !hasNoOdinRec) {
                    recEl.innerHTML = `
                <div class="alert alert-warning py-2 mb-0 small">
                    No monsters within the Ã‚Â±5 level range match your current settings.
                </div>
            `;
                } else {
                    recEl.innerHTML = `
                <div class="card">
                    <div class="card-header py-2">
                        <span class="fw-semibold">Recommended Monsters</span>
                        <span class="small text-secondary ms-2">
                            Selected from monsters within Ã‚Â±5 levels of your current level (one below and one above when available).
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3">
                            <div class="col-md-6 border-end border-secondary-subtle">
                                <div class="fw-semibold text-uppercase small mb-2">Best for Burning Odin</div>
                                ${hasOdinRec ? bestOdin.map(renderMonsterMiniCard).join('') : '<div class="small text-secondary">No recommendations available.</div>'}
                            </div>
                            <div class="col-md-6">
                                <div class="fw-semibold text-uppercase small mb-2">Best for AFK without Odin</div>
                                ${hasNoOdinRec ? bestNoOdin.map(renderMonsterMiniCard).join('') : '<div class="small text-secondary">No recommendations available.</div>'}
                            </div>
                        </div>
                    </div>
                </div>
            `;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            recalcAllMonstersExp();
            document.querySelectorAll('.exp-control').forEach(el => {
                el.addEventListener('change', function() {
                    hasUserInteractedWithExp = true;
                    recalcAllMonstersExp();
                });
            });
        });
    </script>
</body>

</html>

