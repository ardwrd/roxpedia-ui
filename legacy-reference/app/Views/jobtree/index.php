<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ROXPEDIA Team">
    <meta name="description" content="Browse Ragnarok X job database with tier progression, base class, and skill counts.">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="ROXPEDIA - Job Database">
    <meta property="og:description" content="Explore all ROX jobs, progression tiers, and skill overview.">
    <meta property="og:image" content="<?= base_url('assets/img/job/job_1100.png') ?>">
    <meta property="og:url" content="<?= site_url('job-database') ?>">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ROXPEDIA - Job Database">
    <meta name="twitter:description" content="Explore all ROX jobs, progression tiers, and skill overview.">
    <meta name="twitter:image" content="<?= base_url('assets/img/job/job_1100.png') ?>">

    <link rel="canonical" href="<?= site_url('job-database') ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

    <title>ROXPEDIA - Job Database</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">

    <style>
        .job-icon-wrap {
            width: 84px;
            height: 84px;
            background: rgba(255, 255, 255, .03);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .job-icon-wrap img {
            width: 72px;
            height: 72px;
            object-fit: contain;
        }
    </style>
</head>

<body class="bg-body-tertiary">
    <?php
    if (!function_exists('job_tier_label')) {
        function job_tier_label($type): string
        {
            $n = (int)$type;
            $map = [
                0 => 'Novice',
                1 => 'First Job',
                2 => 'Second Job',
                3 => 'Transcendent',
                4 => 'Third Job',
                5 => 'Fourth Job',
            ];
            return $map[$n] ?? ('Tier ' . $n);
        }
    }

    if (!function_exists('job_tier_badge')) {
        function job_tier_badge($type): string
        {
            $n = (int)$type;
            $map = [
                0 => 'text-bg-secondary',
                1 => 'text-bg-info',
                2 => 'text-bg-primary',
                3 => 'text-bg-warning',
                4 => 'text-bg-success',
                5 => 'text-bg-danger',
            ];
            return $map[$n] ?? 'text-bg-secondary';
        }
    }
    ?>

    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <div class="mb-3 text-center">
                <h1 class="h3 mb-1">Job Database</h1>
                <p class="text-secondary mb-0">Browse all jobs, progression tiers, and core skill overview.</p>
            </div>

            <form method="GET" class="row g-3 mb-3" id="searchForm">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search job..."
                        value="<?= esc($search ?? '') ?>" aria-label="Search jobs">
                </div>

                <div class="col-md-3">
                    <select name="basic_job" class="form-select" aria-label="Base Job">
                        <option value="">All Base Jobs</option>
                        <?php foreach (($baseJobOptions ?? []) as $opt): ?>
                            <?php $val = (string)($opt['basic_job_id'] ?? ''); ?>
                            <option value="<?= esc($val) ?>" <?= ((string)($basicJob ?? '') === $val) ? 'selected' : '' ?>>
                                <?= esc($opt['basic_job_name'] ?? ('Job #' . $val)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="tier" class="form-select" aria-label="Tier">
                        <option value="">All Tiers</option>
                        <?php for ($t = 0; $t <= 5; $t++): ?>
                            <option value="<?= $t ?>" <?= ((string)($tier ?? '') === (string)$t) ? 'selected' : '' ?>>
                                <?= esc(job_tier_label($t)) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Apply</button>
                        <a href="?" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <div class="small text-secondary mb-3">
                Showing <?= number_format((int)($totalRows ?? 0)) ?> jobs.
            </div>

            <div class="row" id="jobGrid">
                <?php if (!empty($jobs)): ?>
                    <?php foreach ($jobs as $job): ?>
                        <?php
                        $id = (int)($job['id'] ?? 0);
                        $preId = (int)($job['pre_job_id'] ?? 0);
                        $basicId = (int)($job['basic_job_id'] ?? 0);
                        $iconMain = base_url('assets/img/job/job_' . $id . '.png');
                        $iconPre = $preId > 0 ? base_url('assets/img/job/job_' . $preId . '.png') : '';
                        $iconBasic = $basicId > 0 ? base_url('assets/img/job/job_' . $basicId . '.png') : '';
                        ?>
                        <div class="col-sm-6 col-lg-4 mb-4">
                            <div class="card h-100" onclick="window.location.href='<?= site_url('job-database/detail/' . $id) ?>';" style="cursor:pointer;">
                                <div class="card-body d-flex gap-3">
                                    <div class="job-icon-wrap flex-shrink-0">
                                        <img src="<?= esc($iconMain) ?>"
                                            data-pre="<?= esc($iconPre) ?>"
                                            data-basic="<?= esc($iconBasic) ?>"
                                            onerror="if(!this.dataset.step){this.dataset.step='1';if(this.dataset.pre){this.src=this.dataset.pre;return;}}if(this.dataset.step==='1'){this.dataset.step='2';if(this.dataset.basic){this.src=this.dataset.basic;return;}}this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';"
                                            alt="<?= esc($job['job_name'] ?? ('Job #' . $id)) ?>">
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                            <h5 class="card-title mb-0"><?= esc($job['job_name'] ?? ('Job #' . $id)) ?></h5>
                                            <span class="badge <?= job_tier_badge($job['type'] ?? 0) ?> small fw-semibold">
                                                <?= esc(job_tier_label($job['type'] ?? 0)) ?>
                                            </span>
                                        </div>

                                        <p class="card-text small mb-1">
                                            Base: <?= esc($job['basic_job_name'] ?? ('Job #' . (int)($job['basic_job_id'] ?? 0))) ?>
                                        </p>
                                        <p class="card-text small mb-2">
                                            Pre-Job: <?= ((int)($job['pre_job_id'] ?? 0) > 0) ? esc($job['pre_job_name'] ?? ('Job #' . (int)$job['pre_job_id'])) : '-' ?>
                                        </p>

                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge text-bg-primary small">Skills <?= esc((string)($job['skill_count'] ?? 0)) ?></span>
                                            <span class="badge text-bg-warning small">Talent <?= esc((string)($job['talent_count'] ?? 0)) ?></span>
                                            <span class="badge text-bg-secondary small">ID <?= $id ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning mb-0">No jobs found for current filter.</div>
                    </div>
                <?php endif; ?>
            </div>

            <nav>
                <ul class="pagination justify-content-center mt-4">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>

