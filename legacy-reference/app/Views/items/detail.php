<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc((string)($item['item_name'] ?? 'Item')) ?> Details | ROXPEDIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
</head>

<body class="bg-body-tertiary">
    <div class="container py-4">
        <?php
        if (!function_exists('nf')) {
            function nf($v, int $dec = 0): string
            {
                return number_format((float)($v ?? 0), $dec);
            }
        }
        if (!function_exists('fmt_rate_item')) {
            function fmt_rate_item($v): ?string
            {
                if ($v === null || $v === '') return null;
                $x = (float)$v;
                if ($x <= 0) return null;
                $dec = 3;
                if ($x < 0.01) $dec = 6;
                $s = number_format($x, $dec, '.', '');
                return rtrim(rtrim($s, '0'), '.');
            }
        }
        ?>

        <?= view('partials/site_header') ?>

        <main>
            <div class="d-flex justify-content-start mb-3">
                <button onclick="window.history.back();" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </div>

            <?php
            $itemName = (string)($item['item_name'] ?? 'Item');
            $itemType = (string)($item['item_type_name'] ?? 'Unknown Type');
            $itemDesc = (string)($item['description'] ?? '');

            $resId = (int)($item['item_res_id'] ?? 0);
            $staticId = (int)($item['item_static_id'] ?? 0);
            $imgId = $resId > 0 ? $resId : ($staticId > 0 ? $staticId : (int)($item['id'] ?? 0));
            $imgFile = $imgId > 0 ? ($imgId . '.png') : 'placeholder.png';

            $isCard = ((int)($item['is_card'] ?? 0) === 1);
            $cardDetail = is_array($item['card_detail'] ?? null) ? $item['card_detail'] : [];
            $droppedBy = is_array($item['dropped_by'] ?? null) ? $item['dropped_by'] : [];
            $dismantleOutputs = is_array($item['dismantle_outputs'] ?? null) ? $item['dismantle_outputs'] : [];
            $craftingTargets = is_array($item['crafting_targets'] ?? null) ? $item['crafting_targets'] : [];
            $isCraftingMaterial = ((int)($item['is_crafting_material'] ?? 0) === 1);
            ?>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="bg-body-secondary rounded p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 88px; height: 88px;">
                            <img src="<?= base_url('assets/img/items/' . esc($imgFile)) ?>"
                                onerror="this.onerror=null;this.src='<?= base_url('assets/img/items/placeholder.png') ?>';"
                                alt="<?= esc($itemName) ?>"
                                class="img-fluid"
                                style="width: 68px; height: 68px; object-fit: contain;">
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="mb-2"><?= esc($itemName) ?></h3>
                            <span class="badge text-bg-warning mb-2"><?= esc($itemType) ?></span>
                            <?php if ($itemDesc !== ''): ?>
                                <p class="mb-0 text-secondary"><?= esc($itemDesc) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-body-tertiary">
                    <h5 class="mb-0">Item Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <?php if (!$isCard): ?>
                            <div class="col-md-6">
                                <div class="p-2 border rounded h-100">
                                    <div class="small text-secondary">Sell Price</div>
                                    <div class="fw-semibold"><?= nf($item['sell_price'] ?? 0) ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-6">
                            <div class="p-2 border rounded h-100">
                                <div class="small text-secondary">Weight</div>
                                <div class="fw-semibold"><?= nf($item['weight'] ?? 0) ?></div>
                            </div>
                        </div>
                        <?php if (!$isCard): ?>
                            <div class="col-md-6">
                                <div class="p-2 border rounded h-100">
                                    <div class="small text-secondary">Vending Lowest Price</div>
                                    <div class="fw-semibold"><?= nf($item['vending_low_price'] ?? 0) ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-2 border rounded h-100">
                                    <div class="small text-secondary">Vending Highest Price</div>
                                    <div class="fw-semibold"><?= nf($item['vending_high_price'] ?? 0) ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-6">
                            <div class="p-2 border rounded h-100">
                                <div class="small text-secondary">Stackable</div>
                                <div class="fw-semibold"><?= ((int)($item['stackable'] ?? 0) === 1) ? 'Yes' : 'No' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-2 border rounded h-100">
                                <div class="small text-secondary">Max Stack</div>
                                <div class="fw-semibold"><?= nf($item['max_stack'] ?? 0) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($isCard): ?>
                <?php
                $cardEffects = is_array($cardDetail['effects'] ?? null) ? $cardDetail['effects'] : [];
                $awakeningEffects = is_array($cardDetail['awakening_effects'] ?? null) ? $cardDetail['awakening_effects'] : [];
                $unlockExp = $cardDetail['unlock_adventure_exp'] ?? null;
                $awakeningCategories = is_array($cardDetail['awakening_categories'] ?? null) ? $cardDetail['awakening_categories'] : [];
                $cardMonsterId = (int)($cardDetail['monster_id'] ?? 0);
                if ($cardMonsterId <= 0 && !empty($droppedBy)) {
                    $cardMonsterId = (int)($droppedBy[0]['monster_id'] ?? 0);
                }
                $cardImageId = (int)($cardDetail['card_image_id'] ?? 0);
                if ($cardImageId <= 0) {
                    $cardImageId = $staticId > 0 ? $staticId : (int)($item['id'] ?? 0);
                }
                $cardArt = $cardImageId > 0 ? ($cardImageId . '.png') : '';
                $cardArtSrc = $cardArt !== '' ? base_url('assets/img/cards/' . $cardArt) : base_url('assets/logo.png');
                $cardArtSecondary = $cardArt !== '' ? base_url('assets/img/card/' . $cardArt) : base_url('assets/logo.png');
                $cardArtFallback = $cardMonsterId > 0
                    ? base_url('assets/img/monster/' . $cardMonsterId . '.png')
                    : base_url('assets/img/items/' . $imgFile);
                $unlockIcon = base_url('assets/img/misc/adventure_exp.png');
                $unlockIconFallback = base_url('assets/img/items/Icon_Exp.png');
                ?>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <img src="<?= esc($cardArtSrc) ?>"
                                    onerror="if(!this.dataset.f1){this.dataset.f1=1;this.src='<?= esc($cardArtSecondary) ?>';}else if(!this.dataset.f2){this.dataset.f2=1;this.src='<?= esc($cardArtFallback) ?>';}else{this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';}"
                                    alt="<?= esc($itemName) ?>"
                                    class="img-fluid rounded"
                                    style="max-height: 240px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="h5 mb-2">Card Effect</h4>
                                <?php if (!empty($cardEffects)): ?>
                                    <?php foreach ($cardEffects as $effect): ?>
                                        <div class="mb-1"><?= esc((string)($effect['label'] ?? '')) ?></div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-muted">No card effect data.</div>
                                <?php endif; ?>

                                <?php if (!empty($awakeningEffects)): ?>
                                    <h4 class="h5 mb-2 mt-4">Awakening Effect</h4>
                                    <?php foreach ($awakeningEffects as $effect): ?>
                                        <div class="mb-1"><?= esc((string)($effect['label'] ?? '')) ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <h4 class="h5 mb-2 mt-4">Unlock Adventure Exp</h4>
                                <?php if ($unlockExp !== null): ?>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-body-secondary rounded p-1 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                            <img src="<?= esc($unlockIcon) ?>"
                                                onerror="if(!this.dataset.fallback){this.dataset.fallback=1;this.src='<?= esc($unlockIconFallback) ?>';}else{this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';}"
                                                alt="Unlock EXP"
                                                style="width: 22px; height: 22px; object-fit: contain;">
                                        </div>
                                        <span>+ <?= nf($unlockExp) ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="text-muted">No unlock EXP data.</div>
                                <?php endif; ?>

                                <h4 class="h5 mb-2 mt-4">Awakening Category</h4>
                                <?php if (!empty($awakeningCategories)): ?>
                                    <div class="row g-2">
                                        <?php foreach ($awakeningCategories as $cat): ?>
                                            <?php
                                            $catName = (string)($cat['name'] ?? '');
                                            $catIcon = trim((string)($cat['icon'] ?? ''));
                                            $catIconSrc = $catIcon !== '' ? base_url('assets/img/awakening/' . $catIcon . '.png') : base_url('assets/logo.png');
                                            $catIconFallback1 = $catIcon !== '' ? base_url('assets/img/card_awakening/' . $catIcon . '.png') : base_url('assets/logo.png');
                                            $catIconFallback2 = $catIcon !== '' ? base_url('assets/img/items/' . $catIcon . '.png') : base_url('assets/logo.png');
                                            ?>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="bg-body-secondary rounded p-1 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 30px; height: 30px;">
                                                        <img src="<?= esc($catIconSrc) ?>"
                                                            onerror="if(!this.dataset.f1){this.dataset.f1=1;this.src='<?= esc($catIconFallback1) ?>';}else if(!this.dataset.f2){this.dataset.f2=1;this.src='<?= esc($catIconFallback2) ?>';}else{this.onerror=null;this.src='<?= base_url('assets/logo.png') ?>';}"
                                                            alt="<?= esc($catName) ?>"
                                                            style="width: 22px; height: 22px; object-fit: contain;">
                                                    </div>
                                                    <span><?= esc($catName) ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="text-muted">No awakening category data.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!$isCard && !empty($craftingTargets)): ?>
                <div class="card mb-4">
                    <div class="card-header bg-body-tertiary">
                        <h5 class="mb-0">Crafting Information</h5>
                    </div>
                    <div class="accordion" id="craftingAccordion">
                        <?php foreach ($craftingTargets as $index => $craft): ?>
                            <?php
                            $targetName = (string)($craft['item_name'] ?? ('Item #' . (int)($craft['item_id'] ?? 0)));
                            $targetId = (int)($craft['item_id'] ?? 0);
                            $targetResId = (int)($craft['item_res_id'] ?? 0);
                            $targetStaticId = (int)($craft['item_static_id'] ?? 0);
                            $targetImg = $targetResId > 0 ? $targetResId : ($targetStaticId > 0 ? $targetStaticId : $targetId);
                            $materials = $craft['materials'] ?? [];
                            $accordionId = 'craft_' . $index;
                            $headerText = $targetName;
                            ?>
                            <div class="accordion-item border-0 border-bottom">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= esc($accordionId) ?>" aria-expanded="false" aria-controls="<?= esc($accordionId) ?>">
                                        <div class="d-flex align-items-center w-100">
                                            <div class="bg-body-secondary rounded p-1 me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                                <img src="<?= base_url('assets/img/items/' . esc($targetImg . '.png')) ?>"
                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/img/items/placeholder.png') ?>';"
                                                    alt="<?= esc($targetName) ?>"
                                                    class="img-fluid"
                                                    style="width: 28px; height: 28px; object-fit: contain;">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-semibold"><?= esc($headerText) ?></div>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="<?= esc($accordionId) ?>" class="accordion-collapse collapse" data-bs-parent="#craftingAccordion">
                                    <div class="accordion-body p-0">
                                        <?php if (!empty($materials)): ?>
                                            <div class="list-group list-group-flush">
                                                <?php foreach ($materials as $material): ?>
                                                    <?php
                                                    $matName = (string)($material['item_name'] ?? ('Item #' . (int)($material['item_id'] ?? 0)));
                                                    $matId = (int)($material['item_id'] ?? 0);
                                                    $matResId = (int)($material['item_res_id'] ?? 0);
                                                    $matStaticId = (int)($material['item_static_id'] ?? 0);
                                                    $matImg = $matResId > 0 ? $matResId : ($matStaticId > 0 ? $matStaticId : $matId);
                                                    $matQty = (int)($material['quantity'] ?? 0);
                                                    ?>
                                                    <a href="<?= site_url('items/detail/' . $matId) ?>" class="list-group-item list-group-item-action d-flex align-items-center text-decoration-none text-reset">
                                                        <div class="bg-body-secondary rounded p-1 me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                                            <img src="<?= base_url('assets/img/items/' . esc($matImg . '.png')) ?>"
                                                                onerror="this.onerror=null;this.src='<?= base_url('assets/img/items/placeholder.png') ?>';"
                                                                alt="<?= esc($matName) ?>"
                                                                class="img-fluid"
                                                                style="width: 28px; height: 28px; object-fit: contain;">
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div><?= esc($matName) ?></div>
                                                        </div>
                                                        <div class="text-secondary">x <?= nf($matQty) ?></div>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="p-3 text-muted small">No materials required.</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!$isCraftingMaterial): ?>
                <div class="card mb-4">
                    <div class="card-header bg-body-tertiary">
                        <h5 class="mb-0">Dropped By</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($droppedBy)): ?>
                            <div class="row row-cols-1 row-cols-md-2 g-2">
                                <?php foreach ($droppedBy as $dropper): ?>
                                    <?php
                                    $monsterId = (int)($dropper['monster_id'] ?? 0);
                                    $monsterName = (string)($dropper['monster_name'] ?? ('Monster #' . $monsterId));
                                    $monsterResId = (int)($dropper['monster_res_id'] ?? $monsterId);
                                    $rateStr = fmt_rate_item($dropper['drop_rate_pct'] ?? null);
                                    ?>
                                    <div class="col">
                                        <a href="<?= site_url('monsters/detail/' . $monsterId) ?>" class="text-decoration-none text-reset d-flex align-items-center p-2 border rounded h-100">
                                            <div class="bg-body-secondary rounded p-1 me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                                <img src="<?= base_url('assets/img/monster/' . esc($monsterResId . '.png')) ?>"
                                                    onerror="this.onerror=null;this.src='<?= base_url('assets/img/monster/placeholder.png') ?>';"
                                                    alt="<?= esc($monsterName) ?>"
                                                    class="img-fluid"
                                                    style="width: 28px; height: 28px; object-fit: contain;">
                                            </div>
                                            <div class="flex-grow-1">
                                                <span><?= esc($monsterName) ?></span>
                                                <?php if ($rateStr !== null): ?>
                                                    <span class="text-secondary">(<?= esc($rateStr) ?>%)</span>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mb-0">No monster drop data found for this item.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($isCard || !empty($dismantleOutputs)): ?>
                <div class="card mb-4">
                    <div class="card-header bg-body-tertiary">
                        <h5 class="mb-0">Dismantle Information</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if (!empty($dismantleOutputs)): ?>
                            <div class="list-group list-group-flush">
                                <?php foreach ($dismantleOutputs as $output): ?>
                                    <?php
                                    $outName = (string)($output['item_name'] ?? ('Item #' . (int)($output['item_id'] ?? 0)));
                                    $outId = (int)($output['item_id'] ?? 0);
                                    $outResId = (int)($output['item_res_id'] ?? 0);
                                    $outStaticId = (int)($output['item_static_id'] ?? 0);
                                    $outImg = $outResId > 0 ? $outResId : ($outStaticId > 0 ? $outStaticId : $outId);
                                    $outAmount = (int)($output['amount'] ?? 0);
                                    ?>
                                    <a href="<?= site_url('items/detail/' . $outId) ?>" class="list-group-item list-group-item-action d-flex align-items-center text-decoration-none text-reset">
                                        <div class="bg-body-secondary rounded p-1 me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                            <img src="<?= base_url('assets/img/items/' . esc($outImg . '.png')) ?>"
                                                onerror="this.onerror=null;this.src='<?= base_url('assets/img/items/placeholder.png') ?>';"
                                                alt="<?= esc($outName) ?>"
                                                class="img-fluid"
                                                style="width: 28px; height: 28px; object-fit: contain;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div><?= esc($outName) ?></div>
                                        </div>
                                        <div class="text-secondary">x <?= nf($outAmount) ?></div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="p-3 text-muted">No dismantle data found for this item.</div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>

        <?= view('partials/site_footer') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

