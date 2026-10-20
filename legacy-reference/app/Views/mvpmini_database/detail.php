<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ROXPEDIA Team">
    <meta name="description" content="MVP/Mini boss details with location, level cap, and drop preview.">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="<?= esc($boss['name'] ?? 'Boss') ?> - MVP / Mini Database">
    <meta property="og:description" content="View boss information and drop preview.">
    <meta property="og:image" content="<?= base_url('assets/img/mvpmini.png') ?>">
    <meta property="og:url" content="<?= site_url('mvpmini-database/detail/' . (int)($boss['id'] ?? 0)) ?>">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($boss['name'] ?? 'Boss') ?> - MVP / Mini Database">
    <meta name="twitter:description" content="View boss information and drop preview.">
    <meta name="twitter:image" content="<?= base_url('assets/img/mvpmini.png') ?>">

    <link rel="canonical" href="<?= site_url('mvpmini-database/detail/' . (int)($boss['id'] ?? 0)) ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

    <title><?= esc($boss['name'] ?? 'Boss') ?> Details | ROXPEDIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
</head>

<body class="bg-body-tertiary">
    <?php
    helper('badge');
    if (!function_exists('boss_type_label')) {
        function boss_type_label($v): string
        {
            $n = (int)$v;
            return $n === 1 ? 'MVP' : ($n === 2 ? 'MINI' : ('TYPE ' . $n));
        }
    }
    $typeLabel = boss_type_label($boss['boss_type'] ?? 0);
    $typeClass = ($typeLabel === 'MVP') ? 'text-bg-danger' : 'text-bg-warning';
    $imageId = (int)($boss['static_id'] ?? 0);
    $imageFile = $imageId > 0 ? ($imageId . '.png') : 'placeholder.png';
    $descRaw = trim((string)($boss['description_text'] ?? ($boss['description'] ?? '')));
    $descRaw = preg_replace('/^jayw\s*/i', '', $descRaw);
    $description = preg_match('/^(MVPDes_|WorldBossActivityTips_)/', $descRaw) ? '' : $descRaw;
    ?>

    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <div class="d-flex justify-content-start mb-3">
                <a href="<?= site_url('mvpmini-database') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="row g-4">
                <div class="col-md-4 d-flex">
                    <div class="card w-100 d-flex justify-content-center align-items-center p-3">
                        <img src="<?= base_url('assets/img/boss/' . esc($imageFile)) ?>"
                            onerror="this.onerror=null;this.src='<?= base_url('assets/img/monster/placeholder.png') ?>';"
                            class="img-fluid mx-auto object-fit-contain"
                            width="180"
                            height="180"
                            alt="<?= esc($boss['name'] ?? 'Boss') ?>">
                    </div>
                </div>

                <div class="col-md-8 d-flex">
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?= esc($boss['name'] ?? 'Unknown Boss') ?></h5>

                            <div class="d-flex flex-wrap mb-3 gap-1">
                                <span class="badge <?= $typeClass ?> small fw-semibold"><?= esc($typeLabel) ?></span>
                                <span class="badge text-bg-primary small fw-semibold">Level Cap <?= esc((string)($boss['level_cap'] ?? '-')) ?></span>
                                <?php
                                $propLabel = (string)($boss['property_name'] ?? '');
                                if ($propLabel === '' && !empty($boss['property_id'])) {
                                    $propLabel = 'Property ' . (int)$boss['property_id'];
                                }
                                if ($propLabel === '') {
                                    $propLabel = 'Property -';
                                }

                                $raceLabel = (string)($boss['race_name'] ?? '');
                                if ($raceLabel === '' && !empty($boss['race_id'])) {
                                    $raceLabel = 'Race ' . (int)$boss['race_id'];
                                }
                                if ($raceLabel === '') {
                                    $raceLabel = 'Race -';
                                }

                                $bodilyLabel = (string)($boss['bodily_name'] ?? '');
                                if ($bodilyLabel === '' && !empty($boss['bodily_id'])) {
                                    $bodilyLabel = 'Bodily ' . (int)$boss['bodily_id'];
                                }
                                if ($bodilyLabel === '') {
                                    $bodilyLabel = 'Bodily -';
                                }
                                ?>
                                <span class="badge <?= badge_css_class($propLabel) ?> small fw-semibold"><?= esc($propLabel) ?></span>
                                <span class="badge <?= badge_css_class($raceLabel) ?> small fw-semibold"><?= esc($raceLabel) ?></span>
                                <span class="badge <?= badge_size_class($bodilyLabel) ?> small fw-semibold"><?= esc($bodilyLabel) ?></span>
                            </div>

                            <p class="card-text mb-1"><strong>Spawn:</strong> <?= esc($boss['spawn_location'] ?? 'Unknown') ?></p>

                            <?php if ($description !== ''): ?>
                                <hr>
                                <p class="card-text mb-0"><?= nl2br(esc((string) $description)) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-1">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-body-tertiary">
                            <h5 class="mb-0">Rank Drop Preview</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($rankDrops)): ?>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach ($rankDrops as $drop): ?>
                                        <?php $itemId = (int)($drop['item_id'] ?? 0); ?>
                                        <?php $imageId = (int)($drop['image_id'] ?? $itemId); ?>
                                        <?php $isCard = ((int)($drop['is_card'] ?? 0) === 1); ?>
                                        <?php $cardMonsterId = (int)($drop['card_monster_id'] ?? 0); ?>
                                        <?php
                                        $imgSrc = $isCard && $cardMonsterId > 0
                                            ? base_url('assets/img/cards/' . $cardMonsterId . '.png')
                                            : base_url('assets/img/items/' . $imageId . '.png');
                                        $fallbackSrc = base_url('assets/img/items/' . $imageId . '.png');
                                        ?>
                                        <div class="card p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-body-secondary rounded p-2 me-3 d-flex align-items-center justify-content-center flex-shrink-0">
                                                    <img src="<?= esc($imgSrc) ?>"
                                                        onerror="if(!this.dataset.fallback){this.dataset.fallback=1;this.src='<?= esc($fallbackSrc) ?>';}else{this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';}"
                                                        class="img-fluid object-fit-contain"
                                                        width="48"
                                                        height="48"
                                                        alt="<?= esc($drop['item_name'] ?? ('Item #' . $itemId)) ?>">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold"><?= esc($drop['item_name'] ?? ('Item #' . $itemId)) ?></div>
                                                    <small class="text-secondary">Item #<?= esc((string)$itemId) ?> | Entries <?= esc((string)($drop['entries'] ?? 0)) ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted mb-0">No rank drop preview data.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-body-tertiary">
                            <h5 class="mb-0">Rare Drop Preview</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($rareDrops)): ?>
                                <div class="d-flex flex-column gap-2 overflow-auto">
                                    <?php foreach ($rareDrops as $drop): ?>
                                        <?php $itemId = (int)($drop['item_id'] ?? 0); ?>
                                        <?php $imageId = (int)($drop['image_id'] ?? $itemId); ?>
                                        <?php $isCard = ((int)($drop['is_card'] ?? 0) === 1); ?>
                                        <?php $cardMonsterId = (int)($drop['card_monster_id'] ?? 0); ?>
                                        <?php
                                        $imgSrc = $isCard && $cardMonsterId > 0
                                            ? base_url('assets/img/cards/' . $cardMonsterId . '.png')
                                            : base_url('assets/img/items/' . $imageId . '.png');
                                        $fallbackSrc = base_url('assets/img/items/' . $imageId . '.png');
                                        ?>
                                        <div class="card p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-body-secondary rounded p-2 me-3 d-flex align-items-center justify-content-center flex-shrink-0">
                                                    <img src="<?= esc($imgSrc) ?>"
                                                        onerror="if(!this.dataset.fallback){this.dataset.fallback=1;this.src='<?= esc($fallbackSrc) ?>';}else{this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';}"
                                                        class="img-fluid object-fit-contain"
                                                        width="48"
                                                        height="48"
                                                        alt="<?= esc($drop['item_name'] ?? ('Item #' . $itemId)) ?>">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold"><?= esc($drop['item_name'] ?? ('Item #' . $itemId)) ?></div>
                                                    <small class="text-secondary">
                                                        Item #<?= esc((string)$itemId) ?> | Lv Range <?= esc((string)($drop['min_level'] ?? '-')) ?>-<?= esc((string)($drop['max_level'] ?? '-')) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted mb-0">No rare drop preview data.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-body-tertiary">
                    <h5 class="mb-0">Bosses in Similar Level Range</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($recommendedBosses)): ?>
                        <div class="row row-cols-1 row-cols-md-3 g-3">
                            <?php foreach ($recommendedBosses as $rec): ?>
                                <?php
                                $recImgId = (int)($rec['static_id'] ?? 0);
                                $recImg = $recImgId > 0 ? ($recImgId . '.png') : 'placeholder.png';
                                ?>
                                <div class="col">
                                    <div class="card h-100 position-relative">
                                        <div class="d-flex flex-row h-100">
                                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center p-2">
                                                <img src="<?= base_url('assets/img/boss/' . esc($recImg)) ?>"
                                                    class="img-fluid object-fit-contain"
                                                    width="72"
                                                    height="72"
                                                    alt="<?= esc($rec['name'] ?? 'Boss') ?>"
                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/img/monster/placeholder.png') ?>';">
                                            </div>
                                            <div class="flex-grow-1 p-2">
                                                <h6 class="mb-1 text-truncate"><?= esc($rec['name'] ?? 'Unknown') ?></h6>
                                                <small class="text-secondary d-block"><?= esc($rec['spawn_location'] ?? 'Unknown') ?></small>
                                                <span class="badge text-bg-primary small mt-2">Lv <?= esc((string)($rec['level_cap'] ?? '-')) ?></span>
                                            </div>
                                        </div>
                                        <a href="<?= site_url('mvpmini-database/detail/' . (int)$rec['id']) ?>" class="stretched-link" aria-label="View <?= esc($rec['name'] ?? 'Boss') ?>"></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">No recommended bosses found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>

        <?= view('partials/site_footer') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

