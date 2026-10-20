<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ROXPEDIA Team">
    <meta name="description" content="Job detail page with progression path, core skills, and talent skills.">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="<?= esc(($job['job_name'] ?? 'Job') . ' - Job Database') ?>">
    <meta property="og:description" content="View job progression, core skills, and talents for Ragnarok X.">
    <meta property="og:image" content="<?= base_url('assets/img/job/job_' . (int)($job['id'] ?? 0) . '.png') ?>">
    <meta property="og:url" content="<?= site_url('job-database/detail/' . (int)($job['id'] ?? 0)) ?>">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc(($job['job_name'] ?? 'Job') . ' - Job Database') ?>">
    <meta name="twitter:description" content="View job progression, core skills, and talents for Ragnarok X.">
    <meta name="twitter:image" content="<?= base_url('assets/img/job/job_' . (int)($job['id'] ?? 0) . '.png') ?>">

    <link rel="canonical" href="<?= site_url('job-database/detail/' . (int)($job['id'] ?? 0)) ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

    <title><?= esc($job['job_name'] ?? 'Job') ?> - ROXPEDIA Job Database</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
    <style>
        .job-icon-wrap {
            width: 168px;
            height: 168px;
            background: rgba(255, 255, 255, .03);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .job-icon-wrap img {
            width: 144px;
            height: 144px;
            object-fit: contain;
        }

        .skill-icon {
            width: 52px;
            height: 52px;
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

    if (!function_exists('skill_type_label')) {
        function skill_type_label($type): string
        {
            $n = (int)$type;
            $map = [
                0 => 'Unknown',
                1 => 'Active',
                2 => 'Passive',
                3 => 'Toggle',
                4 => 'System',
            ];
            return $map[$n] ?? ('Type ' . $n);
        }
    }

    $id = (int)($job['id'] ?? 0);
    $preId = (int)($job['pre_job_id'] ?? 0);
    $basicId = (int)($job['basic_job_id'] ?? 0);
    $iconMain = base_url('assets/img/job/job_' . $id . '.png');
    $iconPre = $preId > 0 ? base_url('assets/img/job/job_' . $preId . '.png') : '';
    $iconBasic = $basicId > 0 ? base_url('assets/img/job/job_' . $basicId . '.png') : '';
    ?>

    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <div class="d-flex justify-content-start mb-3">
                <a href="<?= site_url('job-database') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="row g-4">
                <div class="col-md-4 d-flex">
                    <div class="card w-100 d-flex justify-content-center align-items-center p-3">
                        <div class="job-icon-wrap">
                            <img src="<?= esc($iconMain) ?>"
                                data-pre="<?= esc($iconPre) ?>"
                                data-basic="<?= esc($iconBasic) ?>"
                                onerror="if(!this.dataset.step){this.dataset.step='1';if(this.dataset.pre){this.src=this.dataset.pre;return;}}if(this.dataset.step==='1'){this.dataset.step='2';if(this.dataset.basic){this.src=this.dataset.basic;return;}}this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';"
                                alt="<?= esc($job['job_name'] ?? ('Job #' . $id)) ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-8 d-flex">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title mb-2"><?= esc($job['job_name'] ?? ('Job #' . $id)) ?></h3>

                            <div class="d-flex flex-wrap gap-1 mb-3">
                                <span class="badge <?= job_tier_badge($job['type'] ?? 0) ?> small fw-semibold">
                                    <?= esc(job_tier_label($job['type'] ?? 0)) ?>
                                </span>
                                <span class="badge text-bg-primary small fw-semibold">Skills <?= esc((string)($job['skill_count'] ?? 0)) ?></span>
                                <span class="badge text-bg-warning small fw-semibold">Talent <?= esc((string)($job['talent_count'] ?? 0)) ?></span>
                                <span class="badge text-bg-secondary small fw-semibold">Job ID <?= $id ?></span>
                            </div>

                            <div class="row row-cols-1 row-cols-md-2 g-2 small">
                                <div><strong>Base Job:</strong> <?= esc($job['basic_job_name'] ?? ('Job #' . $basicId)) ?></div>
                                <div><strong>Pre-Job:</strong> <?= $preId > 0 ? esc($job['pre_job_name'] ?? ('Job #' . $preId)) : '-' ?></div>
                                <div><strong>Class Branch:</strong> <?= esc((string)($job['class_branch_id'] ?? 0)) ?></div>
                                <div><strong>Job Line:</strong> <?= esc((string)($job['job_line_id'] ?? 0)) ?></div>
                            </div>

                            <?php if (!empty($progressionPath)): ?>
                                <hr>
                                <div class="small">
                                    <strong>Progression Path:</strong>
                                    <?php foreach ($progressionPath as $idx => $row): ?>
                                        <?php if ($idx > 0): ?> <span class="text-secondary">&raquo;</span> <?php endif; ?>
                                        <a href="<?= site_url('job-database/detail/' . (int)($row['id'] ?? 0)) ?>" class="text-decoration-none">
                                            <?= esc($row['job_name'] ?? ('Job #' . (int)($row['id'] ?? 0))) ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($branchPath)): ?>
                                <div class="small mt-1">
                                    <strong>Current Branch:</strong>
                                    <?php foreach ($branchPath as $idx => $row): ?>
                                        <?php if ($idx > 0): ?> <span class="text-secondary">&raquo;</span> <?php endif; ?>
                                        <a href="<?= site_url('job-database/detail/' . (int)($row['id'] ?? 0)) ?>" class="text-decoration-none">
                                            <?= esc($row['job_name'] ?? ('Job #' . (int)($row['id'] ?? 0))) ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-1">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-body-tertiary d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Core Skills</h5>
                            <span class="badge text-bg-primary"><?= count($jobSkills ?? []) ?></span>
                        </div>
                        <div class="card-body p-0">
                            <?php if (!empty($jobSkills)): ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($jobSkills as $skill): ?>
                                        <?php
                                        $skillId = (int)($skill['skill_id'] ?? 0);
                                        $staticId = (int)($skill['static_id'] ?? 0);
                                        $resId = (int)($skill['res_id'] ?? 0);
                                        $iconCandidates = array_values(array_unique(array_filter([$staticId, $resId, $skillId], static fn($v) => $v > 0)));
                                        $icon = !empty($iconCandidates)
                                            ? base_url('assets/img/items/' . $iconCandidates[0] . '.png')
                                            : base_url('assets/logo.png');
                                        $fallbackIcon = isset($iconCandidates[1])
                                            ? base_url('assets/img/items/' . $iconCandidates[1] . '.png')
                                            : '';
                                        $fallbackIcon2 = isset($iconCandidates[2])
                                            ? base_url('assets/img/items/' . $iconCandidates[2] . '.png')
                                            : '';
                                        $desc = trim((string)($skill['skill_desc'] ?? ''));
                                        ?>
                                        <div class="list-group-item">
                                            <div class="d-flex gap-3">
                                                <div class="bg-body-secondary rounded p-2 d-flex align-items-center justify-content-center flex-shrink-0">
                                                    <img src="<?= esc($icon) ?>"
                                                        data-fallback="<?= esc($fallbackIcon) ?>"
                                                        data-fallback2="<?= esc($fallbackIcon2) ?>"
                                                        onerror="if(!this.dataset.step){this.dataset.step='1';if(this.dataset.fallback){this.src=this.dataset.fallback;return;}}if(this.dataset.step==='1'){this.dataset.step='2';if(this.dataset.fallback2){this.src=this.dataset.fallback2;return;}}this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';"
                                                        class="skill-icon"
                                                        alt="<?= esc($skill['skill_name'] ?? ('Skill #' . $skillId)) ?>">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold"><?= esc($skill['skill_name'] ?? ('Skill #' . $skillId)) ?></div>
                                                    <div class="small text-secondary">
                                                        ID <?= $skillId ?> &bull; <?= esc(skill_type_label($skill['skill_type'] ?? 0)) ?>
                                                        &bull; Max Lv <?= esc((string)($skill['max_level'] ?? '-')) ?>
                                                        &bull; Range <?= esc((string)($skill['max_range'] ?? '-')) ?>
                                                    </div>
                                                    <?php if ($desc !== ''): ?>
                                                        <div class="small mt-1"><?= esc($desc) ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="p-3 text-muted">No skill data found for this job.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-body-tertiary d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Talent Skills</h5>
                            <span class="badge text-bg-warning"><?= count($talentSkills ?? []) ?></span>
                        </div>
                        <div class="card-body p-0">
                            <?php if (!empty($talentSkills)): ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($talentSkills as $skill): ?>
                                        <?php
                                        $skillId = (int)($skill['skill_id'] ?? 0);
                                        $staticId = (int)($skill['static_id'] ?? 0);
                                        $resId = (int)($skill['res_id'] ?? 0);
                                        $iconCandidates = array_values(array_unique(array_filter([$staticId, $resId, $skillId], static fn($v) => $v > 0)));
                                        $icon = !empty($iconCandidates)
                                            ? base_url('assets/img/items/' . $iconCandidates[0] . '.png')
                                            : base_url('assets/logo.png');
                                        $fallbackIcon = isset($iconCandidates[1])
                                            ? base_url('assets/img/items/' . $iconCandidates[1] . '.png')
                                            : '';
                                        $fallbackIcon2 = isset($iconCandidates[2])
                                            ? base_url('assets/img/items/' . $iconCandidates[2] . '.png')
                                            : '';
                                        $desc = trim((string)($skill['skill_desc'] ?? ''));
                                        ?>
                                        <div class="list-group-item">
                                            <div class="d-flex gap-3">
                                                <div class="bg-body-secondary rounded p-2 d-flex align-items-center justify-content-center flex-shrink-0">
                                                    <img src="<?= esc($icon) ?>"
                                                        data-fallback="<?= esc($fallbackIcon) ?>"
                                                        data-fallback2="<?= esc($fallbackIcon2) ?>"
                                                        onerror="if(!this.dataset.step){this.dataset.step='1';if(this.dataset.fallback){this.src=this.dataset.fallback;return;}}if(this.dataset.step==='1'){this.dataset.step='2';if(this.dataset.fallback2){this.src=this.dataset.fallback2;return;}}this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';"
                                                        class="skill-icon"
                                                        alt="<?= esc($skill['skill_name'] ?? ('Skill #' . $skillId)) ?>">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold"><?= esc($skill['skill_name'] ?? ('Skill #' . $skillId)) ?></div>
                                                    <div class="small text-secondary">
                                                        ID <?= $skillId ?>
                                                        &bull; Lv <?= esc((string)($skill['talent_level'] ?? '-')) ?>
                                                        &bull; <?= esc(skill_type_label($skill['skill_type'] ?? 0)) ?>
                                                    </div>
                                                    <?php if ($desc !== ''): ?>
                                                        <div class="small mt-1"><?= esc($desc) ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="p-3 text-muted">No talent skill data found for this job.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-body-tertiary">
                    <h5 class="mb-0">Related Jobs (Same Base)</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($relatedJobs)): ?>
                        <div class="row row-cols-1 row-cols-md-3 g-3">
                            <?php foreach ($relatedJobs as $row): ?>
                                <?php
                                $rid = (int)($row['id'] ?? 0);
                                $rpre = (int)($row['pre_job_id'] ?? 0);
                                $rbasic = (int)($row['basic_job_id'] ?? 0);
                                $ricon = base_url('assets/img/job/job_' . $rid . '.png');
                                $riconPre = $rpre > 0 ? base_url('assets/img/job/job_' . $rpre . '.png') : '';
                                $riconBasic = $rbasic > 0 ? base_url('assets/img/job/job_' . $rbasic . '.png') : '';
                                ?>
                                <div class="col">
                                    <div class="card h-100 position-relative">
                                        <div class="card-body d-flex gap-2">
                                            <div class="bg-body-secondary rounded p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width:64px;height:64px;">
                                                <img src="<?= esc($ricon) ?>"
                                                    data-pre="<?= esc($riconPre) ?>"
                                                    data-basic="<?= esc($riconBasic) ?>"
                                                    onerror="if(!this.dataset.step){this.dataset.step='1';if(this.dataset.pre){this.src=this.dataset.pre;return;}}if(this.dataset.step==='1'){this.dataset.step='2';if(this.dataset.basic){this.src=this.dataset.basic;return;}}this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';"
                                                    style="width:52px;height:52px;object-fit:contain;"
                                                    alt="<?= esc($row['job_name'] ?? ('Job #' . $rid)) ?>">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-semibold"><?= esc($row['job_name'] ?? ('Job #' . $rid)) ?></div>
                                                <div class="small text-secondary"><?= esc(job_tier_label($row['type'] ?? 0)) ?></div>
                                            </div>
                                        </div>
                                        <a href="<?= site_url('job-database/detail/' . $rid) ?>" class="stretched-link" aria-label="View <?= esc($row['job_name'] ?? ('Job #' . $rid)) ?>"></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">No related jobs found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>

        <?= view('partials/site_footer') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

