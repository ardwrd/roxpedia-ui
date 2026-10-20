<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ROXPEDIA Team">
    <meta name="description" content="<?= esc(($raid['name'] ?? 'Trial Illusion') . ' dynamic stage and reward pool details from Roxpedia.') ?>">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="<?= esc('ROXPEDIA - ' . ($raid['name'] ?? 'Trial Illusion')) ?>">
    <meta property="og:description" content="<?= esc($raid['short_description'] ?? '') ?>">
    <meta property="og:image" content="<?= base_url('assets/img/raid/' . ($raid['image'] ?? 'RaidMonster_2510.png')) ?>">
    <meta property="og:url" content="<?= site_url('raid/detail/' . ($raid['slug'] ?? '')) ?>">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc('ROXPEDIA - ' . ($raid['name'] ?? 'Trial Illusion')) ?>">
    <meta name="twitter:description" content="<?= esc($raid['short_description'] ?? '') ?>">
    <meta name="twitter:image" content="<?= base_url('assets/img/raid/' . ($raid['image'] ?? 'RaidMonster_2510.png')) ?>">

    <link rel="canonical" href="<?= site_url('raid/detail/' . ($raid['slug'] ?? '')) ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

    <title><?= esc(($raid['name'] ?? 'Trial Illusion') . ' - ROXPEDIA') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<?php
$summaryRewards = $raid['summary_rewards'] ?? ['personal' => [], 'team' => []];
$stageGroups = $raid['stage_groups'] ?? [];
$shortDescription = trim((string) ($raid['short_description'] ?? ''));
$fullDescription = trim((string) ($raid['description'] ?? ''));
$heroDescription = $shortDescription !== '' ? $shortDescription : $fullDescription;
$showFullLore = $fullDescription !== '' && $fullDescription !== $heroDescription;

$poolTitleFor = static function (array $pool): string {
    $entries = $pool['entries'] ?? [];
    $itemNames = [];
    foreach ($entries as $entry) {
        $name = trim((string) ($entry['item_name'] ?? ''));
        if ($name !== '') {
            $itemNames[] = $name;
        }
    }

    $itemNames = array_values(array_unique($itemNames));

    if (count($itemNames) === 1) {
        return $itemNames[0];
    }

    if (count($itemNames) === 2) {
        return $itemNames[0] . ' / ' . $itemNames[1];
    }

    if (! empty($itemNames)) {
        return count($itemNames) . ' possible items';
    }

    return trim((string) ($pool['label'] ?? 'Reward Pool'));
};

$renderPoolAccordion = static function (array $pools, string $accordionId, string $emptyMessage) use ($poolTitleFor): string {
    ob_start();
    if (empty($pools)): ?>
        <div class="alert alert-secondary mb-0"><?= esc($emptyMessage) ?></div>
    <?php else: ?>
        <div class="accordion accordion-flush" id="<?= esc($accordionId) ?>">
            <?php foreach ($pools as $poolIndex => $pool): ?>
                <?php
                $collapseId = $accordionId . '-item-' . $poolIndex;
                $entries = $pool['entries'] ?? [];
                $itemCount = count($entries);
                $poolTitle = $poolTitleFor($pool);
                ?>
                <div class="accordion-item border rounded-3 mb-3">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed py-3" type="button" data-bs-toggle="collapse" data-bs-target="#<?= esc($collapseId) ?>" aria-expanded="false" aria-controls="<?= esc($collapseId) ?>">
                            <span class="d-flex flex-wrap align-items-center gap-2 me-3">
                                <span class="fw-semibold"><?= esc($poolTitle) ?></span>
                                <span class="badge text-bg-secondary"><?= esc($pool['chance_label'] ?? '-') ?></span>
                                <?php if (! empty($pool['random_times'])): ?>
                                    <span class="badge text-bg-light border">Rolled <?= number_format((int) $pool['random_times']) ?>x</span>
                                <?php endif; ?>
                                <span class="badge text-bg-light border"><?= number_format($itemCount) ?> item<?= $itemCount === 1 ? '' : 's' ?></span>
                            </span>
                        </button>
                    </h3>
                    <div id="<?= esc($collapseId) ?>" class="accordion-collapse collapse" data-bs-parent="#<?= esc($accordionId) ?>">
                        <div class="accordion-body pt-2">
                            <div class="list-group list-group-flush">
                                <?php foreach ($entries as $entry): ?>
                                    <div class="list-group-item px-0">
                                        <div class="d-flex flex-column flex-md-row align-items-md-start justify-content-between gap-2">
                                            <div>
                                                <div class="fw-semibold"><?= esc($entry['item_name'] ?? '-') ?></div>
                                                <?php if (! empty($entry['note'])): ?>
                                                    <div class="small text-secondary mt-1"><?= esc(str_replace('Â·', '-', (string) $entry['note'])) ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge text-bg-light border">Amount <?= esc($entry['amount_label'] ?? '-') ?></span>
                                                <span class="badge text-bg-light border">Share <?= esc($entry['share_label'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif;

    return (string) ob_get_clean();
};
?>

<body class="bg-body-tertiary">
    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <div class="mb-3">
                <a href="<?= site_url('raids') ?>" class="btn btn-outline-secondary btn-sm">&larr; Back to Trial Illusion</a>
            </div>

            <section class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4 p-lg-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-12 col-lg-8">
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge text-bg-primary">Trial Illusion</span>
                                <?php if (! empty($raid['chapter'])): ?>
                                    <span class="badge text-bg-light border"><?= esc($raid['chapter']) ?></span>
                                <?php endif; ?>
                            </div>

                            <h1 class="display-6 fw-semibold mb-3"><?= esc($raid['name'] ?? 'Unknown Raid') ?></h1>
                            <p class="lead text-secondary mb-3"><?= esc($heroDescription) ?></p>

                            <?php if ($showFullLore): ?>
                                <div class="mb-4">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#raid-lore" aria-expanded="false" aria-controls="raid-lore">
                                        Read Full Lore
                                    </button>
                                    <div class="collapse mt-3" id="raid-lore">
                                        <div class="small text-secondary mb-0"><?= esc($fullDescription) ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge text-bg-light border">Boss: <?= esc($raid['boss_name'] ?? 'Unknown Boss') ?></span>
                                <span class="badge text-bg-light border">Unlock Lv. <?= number_format((int) ($raid['unlock_level'] ?? 0)) ?></span>
                                <span class="badge text-bg-light border">Server Lv. <?= number_format((int) ($raid['server_level_min'] ?? 0)) ?> - <?= number_format((int) ($raid['server_level_max'] ?? 0)) ?></span>
                                <span class="badge text-bg-light border">Bid Time <?= number_format((int) ($raid['team_bid_minutes'] ?? 0)) ?> min</span>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="rounded-4 border bg-body-tertiary d-flex align-items-center justify-content-center p-4 h-100">
                                <img
                                    src="<?= base_url('assets/img/raid/' . ($raid['image'] ?? 'RaidMonster_2510.png')) ?>"
                                    onerror="this.onerror=null;this.src='<?= base_url('assets/img/raids.png') ?>';"
                                    alt="<?= esc($raid['name'] ?? 'Raid') ?>"
                                    class="img-fluid"
                                    style="max-width: 240px; max-height: 240px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row g-3 mb-4">
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-secondary small text-uppercase mb-2">Stage Groups</div>
                            <div class="h5 mb-0"><?= number_format(count($stageGroups)) ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-secondary small text-uppercase mb-2">Stage Rows</div>
                            <div class="h5 mb-0"><?= number_format(array_sum(array_map(static fn(array $group): int => count($group['entries'] ?? []), $stageGroups))) ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-secondary small text-uppercase mb-2">Difficulty Tiers</div>
                            <div class="h5 mb-0">4</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-secondary small text-uppercase mb-2">Ranking Opens</div>
                            <div class="h5 mb-0">
                                <?php if (! empty($raid['ranking_open_limit_days'])): ?>
                                    <?= number_format((int) $raid['ranking_open_limit_days']) ?> days
                                <?php else: ?>
                                    Immediate
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="row g-3 align-items-lg-center">
                        <div class="col-lg-4">
                            <h2 class="h5 mb-1">Stage Explorer</h2>
                            <p class="text-secondary mb-0">Choose a stage first, then switch difficulty. Reward pools stay collapsed until you open them.</p>
                        </div>
                        <div class="col-lg-8">
                            <?php if (! empty($stageGroups)): ?>
                                <div class="nav nav-pills flex-nowrap overflow-auto gap-2 pb-2" id="stage-tabs" role="tablist" aria-label="Stage groups">
                                    <?php foreach ($stageGroups as $groupIndex => $group): ?>
                                        <?php $isStageActive = $groupIndex === 0; ?>
                                        <button
                                            class="nav-link text-nowrap <?= $isStageActive ? 'active' : '' ?>"
                                            id="stage-tab-<?= (int) $groupIndex ?>"
                                            data-bs-toggle="pill"
                                            data-bs-target="#stage-pane-<?= (int) $groupIndex ?>"
                                            type="button"
                                            role="tab"
                                            aria-controls="stage-pane-<?= (int) $groupIndex ?>"
                                            aria-selected="<?= $isStageActive ? 'true' : 'false' ?>">
                                            <?= esc($group['title'] ?? 'Stage') ?>
                                            <span class="badge text-bg-light border ms-1"><?= number_format(count($group['entries'] ?? [])) ?></span>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <?php if (! empty($raid['pool_notice'])): ?>
                        <div class="alert alert-light border mb-4">
                            <div class="fw-semibold mb-1">Parsed Reward Notes</div>
                            <div class="small text-secondary mb-0"><?= esc($raid['pool_notice']) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (! empty($stageGroups)): ?>
                        <div class="tab-content" id="stage-tab-content">
                            <?php foreach ($stageGroups as $groupIndex => $group): ?>
                                <?php
                                $stageEntries = $group['entries'] ?? [];
                                $activeStagePane = $groupIndex === 0;
                                $defaultDifficultyId = 0;
                                foreach ($stageEntries as $candidateStage) {
                                    if ((int) ($candidateStage['difficulty'] ?? 0) === 3) {
                                        $defaultDifficultyId = (int) ($candidateStage['id'] ?? 0);
                                        break;
                                    }
                                }
                                if ($defaultDifficultyId === 0 && ! empty($stageEntries)) {
                                    $defaultDifficultyId = (int) ($stageEntries[0]['id'] ?? 0);
                                }
                                ?>
                                <div class="tab-pane fade <?= $activeStagePane ? 'show active' : '' ?>" id="stage-pane-<?= (int) $groupIndex ?>" role="tabpanel" aria-labelledby="stage-tab-<?= (int) $groupIndex ?>" tabindex="0">
                                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
                                        <div>
                                            <h2 class="h4 mb-1"><?= esc($group['title'] ?? 'Stage') ?></h2>
                                            <p class="text-secondary mb-0">Only one difficulty stays open at a time, so the page stays compact on desktop and mobile.</p>
                                        </div>
                                        <div class="nav nav-pills flex-nowrap overflow-auto gap-2 pb-2" id="difficulty-tabs-<?= (int) $groupIndex ?>" role="tablist" aria-label="<?= esc($group['title'] ?? 'Stage') ?> difficulties">
                                            <?php foreach ($stageEntries as $entryIndex => $stage): ?>
                                                <?php $isDifficultyActive = (int) ($stage['id'] ?? 0) === $defaultDifficultyId; ?>
                                                <button
                                                    class="nav-link text-nowrap <?= $isDifficultyActive ? 'active' : '' ?>"
                                                    id="difficulty-tab-<?= (int) ($stage['id'] ?? 0) ?>"
                                                    data-bs-toggle="pill"
                                                    data-bs-target="#difficulty-pane-<?= (int) ($stage['id'] ?? 0) ?>"
                                                    type="button"
                                                    role="tab"
                                                    aria-controls="difficulty-pane-<?= (int) ($stage['id'] ?? 0) ?>"
                                                    aria-selected="<?= $isDifficultyActive ? 'true' : 'false' ?>">
                                                    <?= esc($stage['difficulty_label'] ?? ('Difficulty ' . ($entryIndex + 1))) ?>
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="tab-content">
                                        <?php foreach ($stageEntries as $stage): ?>
                                            <?php $isDifficultyActive = (int) ($stage['id'] ?? 0) === $defaultDifficultyId; ?>
                                            <div class="tab-pane fade <?= $isDifficultyActive ? 'show active' : '' ?>" id="difficulty-pane-<?= (int) ($stage['id'] ?? 0) ?>" role="tabpanel" aria-labelledby="difficulty-tab-<?= (int) ($stage['id'] ?? 0) ?>" tabindex="0">
                                                <div class="row g-3 mb-4">
                                                    <div class="col-md-6 col-xl-3">
                                                        <div class="border rounded-3 p-3 h-100">
                                                            <div class="text-secondary small text-uppercase mb-2">Boss</div>
                                                            <div class="fw-semibold"><?= esc($stage['boss_name'] ?? 'Unknown Boss') ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3">
                                                        <div class="border rounded-3 p-3 h-100">
                                                            <div class="text-secondary small text-uppercase mb-2">EXP</div>
                                                            <div class="fw-semibold"><?= number_format((int) ($stage['experience'] ?? 0)) ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3">
                                                        <div class="border rounded-3 p-3 h-100">
                                                            <div class="text-secondary small text-uppercase mb-2">Zeny</div>
                                                            <div class="fw-semibold"><?= number_format((int) ($stage['zeny'] ?? 0)) ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3">
                                                        <div class="border rounded-3 p-3 h-100">
                                                            <div class="text-secondary small text-uppercase mb-2">Team Scale</div>
                                                            <div class="fw-semibold"><?= number_format((int) ($stage['min_team_scale'] ?? 0)) ?> - <?= number_format((int) ($stage['team_scale'] ?? 0)) ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-3 mb-4">
                                                    <div class="col-md-6 col-xl-4">
                                                        <div class="border rounded-3 p-3 h-100">
                                                            <div class="text-secondary small text-uppercase mb-2">Revives</div>
                                                            <div class="fw-semibold"><?= number_format((int) ($stage['revive_times'] ?? 0)) ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-4">
                                                        <div class="border rounded-3 p-3 h-100">
                                                            <div class="text-secondary small text-uppercase mb-2">Battle Time</div>
                                                            <div class="fw-semibold"><?= number_format((int) ($stage['battle_time'] ?? 0)) ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-4">
                                                        <div class="border rounded-3 p-3 h-100">
                                                            <div class="text-secondary small text-uppercase mb-2">Open Time</div>
                                                            <div class="fw-semibold"><?= number_format((int) ($stage['open_time'] ?? 0)) ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if (! empty($stage['active_condition_text'])): ?>
                                                    <div class="alert alert-light border mb-4">
                                                        <strong>Active Condition:</strong> <?= esc($stage['active_condition_text']) ?>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="row g-4">
                                                    <div class="col-12 col-xl-6">
                                                        <div class="card border h-100">
                                                            <div class="card-body">
                                                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                                                                    <h3 class="h6 mb-0">Personal Reward Pools</h3>
                                                                    <span class="badge text-bg-light border"><?= number_format(count($stage['personal_rewards'] ?? [])) ?> pools</span>
                                                                </div>
                                                                <?= $renderPoolAccordion($stage['personal_rewards'] ?? [], 'personal-pools-' . (int) ($stage['id'] ?? 0), 'No parsed personal pool is available for this difficulty.') ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-xl-6">
                                                        <div class="card border h-100">
                                                            <div class="card-body">
                                                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                                                                    <h3 class="h6 mb-0">Team Reward Pools</h3>
                                                                    <span class="badge text-bg-light border"><?= number_format(count($stage['team_rewards'] ?? [])) ?> pools</span>
                                                                </div>
                                                                <?= $renderPoolAccordion($stage['team_rewards'] ?? [], 'team-pools-' . (int) ($stage['id'] ?? 0), 'No parsed team pool is available for this difficulty.') ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning mb-0">No stage data is available for this raid.</div>
                    <?php endif; ?>
                </div>
            </section>

            <?php if (! empty($summaryRewards['personal']) || ! empty($summaryRewards['team'])): ?>
                <section class="accordion mb-4" id="advanced-raid-data">
                    <div class="accordion-item border rounded-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#advanced-raid-data-body" aria-expanded="false" aria-controls="advanced-raid-data-body">
                                Advanced Raid-Level Pools
                            </button>
                        </h2>
                        <div id="advanced-raid-data-body" class="accordion-collapse collapse" data-bs-parent="#advanced-raid-data">
                            <div class="accordion-body p-4">
                                <div class="row g-4">
                                    <div class="col-12 col-xl-6">
                                        <div class="card border h-100">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                                                    <h3 class="h6 mb-0">Raid-Level Personal Pools</h3>
                                                    <span class="badge text-bg-light border"><?= number_format(count($summaryRewards['personal'] ?? [])) ?> pools</span>
                                                </div>
                                                <?= $renderPoolAccordion($summaryRewards['personal'] ?? [], 'raid-summary-personal', 'No raid-level personal pool is available in the current source set.') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-xl-6">
                                        <div class="card border h-100">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                                                    <h3 class="h6 mb-0">Raid-Level Team Pools</h3>
                                                    <span class="badge text-bg-light border"><?= number_format(count($summaryRewards['team'] ?? [])) ?> pools</span>
                                                </div>
                                                <?= $renderPoolAccordion($summaryRewards['team'] ?? [], 'raid-summary-team', 'No raid-level team pool is available in the current source set.') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </main>

        <?= view('partials/site_footer') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
