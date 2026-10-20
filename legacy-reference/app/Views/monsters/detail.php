<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($monster['name']) ?> Details | ROXPEDIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container py-4">

        <?php
        helper('badge');
        if (!function_exists('nf')) {
            function nf($v, int $dec = 0): string
            {
                return number_format((float)($v ?? 0), $dec);
            }
        }
        if (!function_exists('fmt_rate')) {
            function fmt_rate($v): ?string
            {
                if ($v === null || $v === '') return null;
                $x = (float)$v;
                if ($x <= 0) return null;
                $dec = 3;
                if ($x < 0.01) $dec = 6;
                $s = number_format($x, $dec, '.', '');
                $s = rtrim(rtrim($s, '0'), '.');
                return $s;
            }
        }
        if (!function_exists('skill_type_label')) {
            function skill_type_label($v): string
            {
                if ($v === null || $v === '') return '-';
                $n = (int)$v;
                $map = [0 => 'Unknown', 1 => 'Active', 2 => 'Passive'];
                return $map[$n] ?? ('Type ' . $n);
            }
        }
        if (!function_exists('target_type_label')) {
            function target_type_label($v): string
            {
                if ($v === null || $v === '') return '-';
                $n = (int)$v;
                $map = [0 => 'Unknown', 1 => 'Enemy', 2 => 'Self', 3 => 'Ally', 4 => 'Ground'];
                return $map[$n] ?? ('Target ' . $n);
            }
        }

        $propLabel = (string)($monster['property_name'] ?? '');
        if ($propLabel === '' && !empty($monster['property_id'])) {
            $propLabel = 'Property ' . (int)$monster['property_id'];
        }

        $imgId = (int)($monster['res_id'] ?? 0);
        if ($imgId <= 0) $imgId = (int)($monster['static_id'] ?? 0);
        if ($imgId <= 0) $imgId = (int)($monster['id'] ?? 0);
        $imgFile = $imgId > 0 ? ($imgId . '.png') : 'placeholder.png';

        $summaryStats = [
            ['label' => 'Level', 'value' => nf($monster['level'] ?? 0)],
            ['label' => 'Max HP', 'value' => nf($monster['max_hp'] ?? 0)],
            ['label' => 'Base EXP', 'value' => nf($monster['base_exp'] ?? 0)],
            ['label' => 'Job EXP', 'value' => nf($monster['job_exp'] ?? 0)],
            ['label' => 'Zeny', 'value' => nf($monster['zeny'] ?? 0)],
        ];

        $attributeRows = [
            ['label' => 'P.DEF Level', 'value' => nf($monster['p_def_level'] ?? 0)],
            ['label' => 'Final P.DEF Increase', 'value' => nf(($monster['final_p_def'] ?? 0) * 100, 1) . '%'],
            ['label' => 'M.DEF Level', 'value' => nf($monster['m_def_level'] ?? 0)],
            ['label' => 'Final M.DEF Increase', 'value' => nf(($monster['final_m_def'] ?? 0) * 100, 1) . '%'],
            ['label' => 'Dodge Rate', 'value' => nf(($monster['flee_percentage'] ?? 0) * 100, 1) . '%'],
            ['label' => 'Dodge Level', 'value' => nf($monster['flee_level'] ?? 0)],
            ['label' => 'Crit Resist Rate', 'value' => nf(($monster['anti_crit_percentage'] ?? 0) * 100, 1) . '%'],
            ['label' => 'Crit Resist Level', 'value' => nf($monster['anti_crit_level'] ?? 0)],
        ];
        ?>

        <?= view('partials/site_header') ?>

        <main>
            <div class="d-flex flex-wrap gap-2 mb-3">
                <button onclick="window.history.back();" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                <a href="<?= site_url('monsters') ?>" class="btn btn-outline-secondary">All Monsters</a>
            </div>

            <section class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center g-4">
                        <div class="col-md-3 text-center">
                            <div class="rounded-4 border bg-body-tertiary d-flex align-items-center justify-content-center mx-auto" style="width: 220px; height: 220px;">
                                <img src="<?= base_url('assets/img/monster/' . esc($imgFile)) ?>"
                                    onerror="this.onerror=null;this.src='<?= base_url('assets/img/monster/placeholder.png') ?>';"
                                    class="img-fluid"
                                    style="width: 180px; height: 180px; object-fit: contain;"
                                    alt="<?= esc($monster['name']) ?>">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <span class="badge text-bg-primary mb-3">Monster Detail</span>
                            <h1 class="display-6 fw-semibold mb-3"><?= esc($monster['name']) ?></h1>

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?php if ($propLabel !== ''): ?>
                                    <span class="badge <?= badge_css_class($propLabel) ?> small fw-semibold"><?= esc($propLabel) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($monster['race_name'])): ?>
                                    <span class="badge <?= badge_css_class($monster['race_name']) ?> small fw-semibold"><?= esc($monster['race_name']) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($monster['bodily_name'])): ?>
                                    <span class="badge <?= badge_size_class($monster['bodily_name']) ?> small fw-semibold"><?= esc($monster['bodily_name']) ?></span>
                                <?php endif; ?>
                            </div>

                            <p class="text-secondary mb-3">
                                <?= $monster['description'] !== '' ? nl2br(esc((string)$monster['description'])) : 'No description available for this monster.' ?>
                            </p>

                            <div class="small text-secondary">
                                <i class="fa-solid fa-location-dot me-1"></i><?= esc($monster['spawn_location'] ?? 'Unknown') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row row-cols-2 row-cols-md-3 row-cols-xl-5 g-3 mb-4">
                <?php foreach ($summaryStats as $stat): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="small text-uppercase text-secondary mb-1"><?= esc($stat['label']) ?></div>
                                <div class="fw-semibold"><?= esc($stat['value']) ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-body-tertiary">
                            <h5 class="mb-0">Combat Attributes</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Max HP</td>
                                            <td><?= nf($monster['max_hp']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>P.DEF Level</td>
                                            <td><?= nf($monster['p_def_level']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Final P.DEF Increase</td>
                                            <td><?= nf(($monster['final_p_def'] ?? 0) * 100, 1) ?>%</td>
                                        </tr>
                                        <tr>
                                            <td>M.DEF Level</td>
                                            <td><?= nf($monster['m_def_level']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Final M.DEF Increase</td>
                                            <td><?= nf(($monster['final_m_def'] ?? 0) * 100, 1) ?>%</td>
                                        </tr>
                                        <tr>
                                            <td>Dodge Rate</td>
                                            <td><?= nf(($monster['flee_percentage'] ?? 0) * 100, 1) ?>%</td>
                                        </tr>
                                        <tr>
                                            <td>Dodge Level</td>
                                            <td><?= nf($monster['flee_level']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Crit Resist Rate</td>
                                            <td><?= nf(($monster['anti_crit_percentage'] ?? 0) * 100, 1) ?>%</td>
                                        </tr>
                                        <tr>
                                            <td>Crit Resist Level</td>
                                            <td><?= nf($monster['anti_crit_level']) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 d-flex flex-column">
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header bg-body-tertiary">
                            <h5 class="mb-0">Spawn Location</h5>
                        </div>
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <img src="<?= base_url('assets/img/location/' . esc($location_image)) ?>"
                                class="img-fluid rounded mb-3 mx-auto"
                                style="max-width: 320px; width: 100%; height: 180px; object-fit: contain;"
                                alt="<?= esc($monster['spawn_location'] ?? 'Unknown') ?>"
                                onerror="this.onerror=null;this.style.display='none';">
                            <h6 class="mb-0"><?= esc($monster['spawn_location'] ?? 'Unknown') ?></h6>
                        </div>
                    </div>

                    <div class="card mt-3 shadow-sm">
                        <div class="card-header bg-body-tertiary d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Monster Skills</h5>
                        </div>

                        <div class="card-body p-0">
                            <?php if (!empty($monsterSkills)): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($monsterSkills as $skill): ?>
                                        <?php
                                        $skillName = (string)($skill['skill_name'] ?? '');
                                        if ($skillName === '') $skillName = 'Skill #' . (int)($skill['skill_id'] ?? 0);

                                        $skillId = (int)($skill['skill_id'] ?? 0);
                                        $staticId = (int)($skill['static_id'] ?? 0);
                                        $resId = (int)($skill['res_id'] ?? 0);
                                        $iconCandidates = array_values(array_unique(array_filter([$staticId, $resId, $skillId], static fn($v) => $v > 0)));
                                        $skillIcon = !empty($iconCandidates)
                                            ? base_url('assets/img/items/' . $iconCandidates[0] . '.png')
                                            : base_url('assets/logo.png');
                                        $fallbackIcon = isset($iconCandidates[1])
                                            ? base_url('assets/img/items/' . $iconCandidates[1] . '.png')
                                            : '';
                                        $fallbackIcon2 = isset($iconCandidates[2])
                                            ? base_url('assets/img/items/' . $iconCandidates[2] . '.png')
                                            : '';

                                        $maxLv  = $skill['max_level'] ?? null;
                                        $range  = $skill['max_range'] ?? null;
                                        ?>
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3 d-flex align-items-center justify-content-center bg-body-secondary rounded p-2">
                                                    <img src="<?= esc($skillIcon) ?>"
                                                        data-fallback="<?= esc($fallbackIcon) ?>"
                                                        data-fallback2="<?= esc($fallbackIcon2) ?>"
                                                        onerror="if(!this.dataset.step){this.dataset.step='1';if(this.dataset.fallback){this.src=this.dataset.fallback;return;}}if(this.dataset.step==='1'){this.dataset.step='2';if(this.dataset.fallback2){this.src=this.dataset.fallback2;return;}}this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';"
                                                        class="img-fluid"
                                                        style="width:32px;height:32px;object-fit:contain;"
                                                        alt="<?= esc($skillName) ?>">
                                                </div>

                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                                        <div class="fw-semibold"><?= esc($skillName) ?></div>
                                                    </div>

                                                    <small class="text-secondary d-block mt-1">
                                                        <?= esc(skill_type_label($skill['skill_type'] ?? null)) ?>
                                                        &bull; <?= esc(target_type_label($skill['target_type'] ?? null)) ?>
                                                        <?php if ($maxLv !== null && $maxLv !== ''): ?>
                                                            &bull; Max Lv <?= esc($maxLv) ?>
                                                        <?php endif; ?>
                                                        <?php if ($range !== null && $range !== ''): ?>
                                                            &bull; Range <?= esc($range) ?>
                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <div class="p-3 text-muted">No skills available for this monster.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h5 class="mb-0">Monster Drop List</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($monsterDrops)): ?>
                        <div class="d-flex flex-column gap-2">
                            <?php foreach ($monsterDrops as $drop): ?>
                                <?php
                                $isCard = ((int)($drop['is_card'] ?? 0) === 1) || ((int)($drop['item_type_group_id'] ?? 0) === 1);

                                $itemResId = (int)($drop['item_res_id'] ?? 0);
                                $itemStaticId = (int)($drop['item_static_id'] ?? 0);
                                $itemIdForImage = $itemResId > 0 ? $itemResId : $itemStaticId;

                                if ($isCard) {
                                    $cardMonsterId = (int)($drop['card_monster_id'] ?? ($monster['id'] ?? 0));
                                    $imageFile   = 'cards/' . $cardMonsterId . '.png';
                                    $placeholder = base_url('assets/img/cards/placeholder.png');
                                    $fallbackImg = '';
                                } else {
                                    $imageFile   = 'items/' . $itemIdForImage . '.png';
                                    $placeholder = base_url('assets/img/items/placeholder.png');
                                    $fallbackImg = ($itemResId > 0 && $itemStaticId > 0 && $itemStaticId !== $itemResId)
                                        ? base_url('assets/img/items/' . $itemStaticId . '.png')
                                        : '';
                                }

                                $imgSrc = base_url('assets/img/' . $imageFile);

                                $meta = [];
                                if (!empty($drop['drop_kind'])) $meta[] = ucfirst((string)$drop['drop_kind']);
                                if (!empty($drop['amount']))    $meta[] = 'x' . (int)$drop['amount'];
                                if (isset($drop['weight']) && $drop['weight'] !== null) $meta[] = 'Weight ' . (int)$drop['weight'];

                                $rateStr = fmt_rate($drop['drop_rate_pct'] ?? null);
                                if ($rateStr !== null) $meta[] = 'Rate ' . $rateStr . '%';

                                if (isset($drop['is_bind'])) $meta[] = ((int)$drop['is_bind'] === 1) ? 'Bind' : 'Unbind';
                                if (isset($drop['is_valuable']) && (int)$drop['is_valuable'] === 1) $meta[] = 'Valuable';
                                $meta = array_filter($meta);

                                $displayName = (string)($drop['item_name'] ?? '');
                                if ($displayName === '') $displayName = $isCard ? ('Card #' . ($monster['id'] ?? 0)) : ('Item #' . $itemIdForImage);

                                $typeLabel = (string)($drop['item_type_name'] ?? '');
                                if ($typeLabel === '') $typeLabel = $isCard ? 'Card' : 'Unknown Type';
                                $itemDetailUrl = ($itemStaticId > 0) ? site_url('items/detail/' . $itemStaticId) : null;

                                ?>

                                <div class="card p-2">
                                    <?php if ($itemDetailUrl !== null): ?>
                                        <a href="<?= esc($itemDetailUrl) ?>" class="text-decoration-none text-reset d-block">
                                        <?php endif; ?>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-body-secondary rounded p-2 me-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width: 72px; height: 72px;">
                                                <img src="<?= esc($imgSrc) ?>"
                                                    onerror="<?= $isCard || $fallbackImg === ''
                                                                    ? "this.onerror=null;this.src='" . esc($placeholder) . "';"
                                                                    : "if(!this.dataset.fallback){this.dataset.fallback=1;this.src='" . esc($fallbackImg) . "';}else{this.onerror=null;this.src='" . esc($placeholder) . "';}" ?>"
                                                    alt="<?= esc($displayName) ?>"
                                                    class="img-fluid"
                                                    style="width: 56px; height: 56px; object-fit: contain;">
                                            </div>

                                            <div class="flex-grow-1">
                                                <div class="fw-semibold"><?= esc($displayName) ?></div>
                                                <small class="text-muted">
                                                    <?= esc($typeLabel) ?>
                                                    <?php if (!empty($meta)): ?>
                                                        <?php $metaEsc = array_map('esc', $meta); ?>
                                                        <span class="ms-2 text-secondary">&bull; <?= implode(' &bull; ', $metaEsc) ?></span>
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                        </div>
                                        <?php if ($itemDetailUrl !== null): ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">This monster doesn't drop any items.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-body-tertiary">
                    <h5 class="mb-0">Monsters in the same level range</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($recommendedMonsters)): ?>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <?php foreach ($recommendedMonsters as $recMonster): ?>
                                <div class="col">
                                    <div class="card h-100 position-relative">
                                        <div class="d-flex flex-row h-100">
                                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center p-2"
                                                style="width: 88px; height: 88px;">
                                                <?php
                                                $recImgId = (int)($recMonster['res_id'] ?? 0);
                                                if ($recImgId <= 0) $recImgId = (int)($recMonster['static_id'] ?? 0);
                                                if ($recImgId <= 0) $recImgId = (int)($recMonster['id'] ?? 0);
                                                $recImgFile = $recImgId > 0 ? ($recImgId . '.png') : 'placeholder.png';
                                                ?>
                                                <img src="<?= base_url('assets/img/monster/' . esc($recImgFile)) ?>"
                                                    class="img-fluid"
                                                    style="width: 72px; height: 72px; object-fit: contain;"
                                                    alt="<?= esc($recMonster['name']) ?>"
                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/img/monster/placeholder.png') ?>';">
                                            </div>
                                            <div class="flex-grow-1 p-2">
                                                <div class="card-body p-0">
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="card-title me-2 mb-0 text-truncate"><?= esc($recMonster['name']) ?></h6>
                                                        <span class="badge text-bg-primary small"><?= esc($recMonster['level']) ?></span>
                                                    </div>

                                                    <div class="d-flex flex-wrap mt-2 gap-1">
                                                        <?php
                                                        $recPropLabel = (string)($recMonster['property_name'] ?? '');
                                                        if ($recPropLabel === '' && !empty($recMonster['property_id'])) {
                                                            $recPropLabel = 'Property ' . (int)$recMonster['property_id'];
                                                        }
                                                        ?>
                                                        <?php if ($recPropLabel !== ''): ?>
                                                            <span class="badge <?= badge_css_class($recPropLabel) ?> small fw-semibold"><?= esc($recPropLabel) ?></span>
                                                        <?php endif; ?>
                                                        <?php if (!empty($recMonster['race_name'])): ?>
                                                            <span class="badge <?= badge_css_class($recMonster['race_name']) ?> small fw-semibold"><?= esc($recMonster['race_name']) ?></span>
                                                        <?php endif; ?>
                                                        <?php if (!empty($recMonster['bodily_name'])): ?>
                                                            <span class="badge <?= badge_size_class($recMonster['bodily_name']) ?> small fw-semibold"><?= esc($recMonster['bodily_name']) ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?= site_url('monsters/detail/' . $recMonster['id']) ?>" class="stretched-link" aria-label="View <?= esc($recMonster['name']) ?>"></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No recommended monsters found within 3 levels range.</p>
                    <?php endif; ?>
                </div>
            </div>

        </main>

        <?= view('partials/site_footer') ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

