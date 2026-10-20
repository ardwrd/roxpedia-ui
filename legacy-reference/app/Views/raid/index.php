<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ROXPEDIA Team">
    <meta name="description" content="Explore every Trial Illusion raid with stage breakdowns, boss details, and reward pool data in one place.">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="ROXPEDIA - Trial Illusion">
    <meta property="og:description" content="Explore Trial Illusion raids with stage breakdowns, boss details, and reward pool data.">
    <meta property="og:image" content="<?= base_url('assets/img/raids.png') ?>">
    <meta property="og:url" content="<?= site_url('raids') ?>">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ROXPEDIA - Trial Illusion">
    <meta name="twitter:description" content="Explore Trial Illusion raids with stage breakdowns, boss details, and reward pool data.">
    <meta name="twitter:image" content="<?= base_url('assets/img/raids.png') ?>">

    <link rel="canonical" href="<?= site_url('raids') ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

    <title>ROXPEDIA - Trial Illusion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="bg-body-tertiary">
    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <section class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4 p-lg-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-12">
                            <span class="badge text-bg-primary mb-3">Trial Illusion</span>
                            <h1 class="display-6 fw-semibold mb-3">Trial Illusion Raid Database</h1>
                            <p class="lead text-secondary mb-4">Explore every Trial Illusion raid with stage breakdowns, boss details, and reward pool data from Roxpedia's parsed game database.</p>
                            <div class="d-flex flex-wrap gap-2">
                                <a class="btn btn-primary" href="#raid-grid">Browse Raids</a>
                                <a class="btn btn-outline-secondary" href="<?= site_url('documentation') ?>">API Documentation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="raid-grid" class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                        <div>
                            <h2 class="h4 mb-1">Raid Overview</h2>
                            <p class="text-secondary mb-0">Open any raid to see its parsed stage data, reward pools, and boss lineup.</p>
                        </div>
                        <span class="badge text-bg-secondary"><?= number_format(count($raids ?? [])) ?> raids</span>
                    </div>

                    <div class="row g-4">
                        <?php if (!empty($raids)): ?>
                            <?php foreach ($raids as $raid): ?>
                                <div class="col-12 col-xl-6">
                                    <a href="<?= site_url('raid/detail/' . ($raid['slug'] ?? '')) ?>" class="card h-100 shadow-sm text-decoration-none text-body">
                                        <div class="card-body">
                                            <div class="d-flex gap-3">
                                                <div class="rounded-3 border bg-body-tertiary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 96px; height: 96px;">
                                                    <img
                                                        src="<?= base_url('assets/img/raid/' . ($raid['image'] ?? 'RaidMonster_2510.png')) ?>"
                                                        onerror="this.onerror=null;this.src='<?= base_url('assets/img/raids.png') ?>';"
                                                        alt="<?= esc($raid['name'] ?? 'Raid') ?>"
                                                        class="img-fluid"
                                                        style="max-width: 80px; max-height: 80px; object-fit: contain;">
                                                </div>

                                                <div class="flex-grow-1">
                                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                                        <h3 class="h5 mb-0"><?= esc($raid['name'] ?? 'Unknown Raid') ?></h3>
                                                        <?php if (!empty($raid['chapter'])): ?>
                                                            <span class="badge text-bg-light border"><?= esc($raid['chapter']) ?></span>
                                                        <?php endif; ?>
                                                    </div>

                                                    <p class="text-secondary mb-3"><?= esc($raid['short_description'] ?? '') ?></p>

                                                    <div class="row g-2 small">
                                                        <div class="col-sm-6">
                                                            <div class="border rounded-3 p-2 h-100">
                                                                <div class="text-secondary">Final Boss</div>
                                                                <div class="fw-semibold"><?= esc($raid['boss_name'] ?? 'Unknown Boss') ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="border rounded-3 p-2 h-100">
                                                                <div class="text-secondary">Unlock Level</div>
                                                                <div class="fw-semibold">Base Lv. <?= number_format((int) ($raid['unlock_level'] ?? 0)) ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="border rounded-3 p-2 h-100">
                                                                <div class="text-secondary">Server Level</div>
                                                                <div class="fw-semibold">
                                                                    <?= number_format((int) ($raid['server_level_min'] ?? 0)) ?>
                                                                    -
                                                                    <?= number_format((int) ($raid['server_level_max'] ?? 0)) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="border rounded-3 p-2 h-100">
                                                                <div class="text-secondary">Stage Rows</div>
                                                                <div class="fw-semibold">
                                                                    <?= number_format((int) ($raid['stage_count'] ?? 0)) ?>
                                                                    across
                                                                    <?= number_format((int) ($raid['difficulty_count'] ?? 0)) ?>
                                                                    difficulties
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-warning mb-0">No Trial Illusion data is available in the current database.</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </main>

        <?= view('partials/site_footer') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
