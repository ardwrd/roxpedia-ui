<?php

/** @var array<int, array<string, mixed>> $levels */
$levels = $levels ?? [];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="ROXPEDIA Home System - Home Level Quests and requirements by level.">
  <meta name="robots" content="index, follow">
  <title>Home System - Level Quests | ROXPEDIA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <?= view('partials/site_header') ?>

    <main>
      <div class="card border-secondary mb-4">
        <div class="card-header bg-body-tertiary border-secondary py-2 py-md-3">
          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <i class="fa-solid fa-stairs me-2 text-info"></i>
              <h5 class="mb-0">Level Progression Requirements</h5>
            </div>
            <a href="<?= site_url('home-system'); ?>" class="btn btn-outline-secondary btn-sm">
              <i class="fa-solid fa-arrow-left me-1"></i>
              <span class="d-none d-md-inline">Back to Home</span>
            </a>
          </div>
        </div>

        <div class="card-body">
          <?php if (empty($levels)): ?>
            <div class="alert alert-secondary border-secondary mb-0">
              <i class="fa-solid fa-circle-info me-2"></i>No level quest data found.
            </div>
          <?php else: ?>
            <div class="accordion" id="questAccordion">
              <?php foreach ($levels as $idx => $level): ?>
                <?php
                $levelId = (int) ($level['id'] ?? 0);
                $tasks = $level['tasks'] ?? [];
                $unlockBuildings = $level['unlock_buildings'] ?? [];
                $open = $idx === 0;
                $rewardName = trim((string) ($level['reward_item_name'] ?? ''));
                ?>
                <div class="accordion-item border-secondary mb-3 bg-body-tertiary">
                  <h2 class="accordion-header" id="heading<?= $levelId; ?>">
                    <button
                      class="accordion-button <?= $open ? '' : 'collapsed'; ?> bg-body-tertiary text-body"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#collapse<?= $levelId; ?>"
                      aria-expanded="<?= $open ? 'true' : 'false'; ?>"
                      aria-controls="collapse<?= $levelId; ?>">
                      <span class="fw-semibold"><?= esc((string) ($level['level_name'] ?? 'Lv.0')); ?></span>
                      <span class="badge text-bg-info ms-3"><?= count($tasks); ?> quests</span>
                    </button>
                  </h2>

                  <div
                    id="collapse<?= $levelId; ?>"
                    class="accordion-collapse collapse <?= $open ? 'show' : ''; ?>"
                    aria-labelledby="heading<?= $levelId; ?>"
                    data-bs-parent="#questAccordion">
                    <div class="accordion-body">
                      <div class="row g-3 mb-3">
                        <div class="col-6 col-md-3">
                          <div class="bg-black bg-opacity-25 rounded p-2 text-center">
                            <div class="text-secondary small">Exp Required</div>
                            <div class="fw-semibold text-warning"><?= number_format((int) ($level['exp_required'] ?? 0)); ?></div>
                          </div>
                        </div>
                        <div class="col-6 col-md-3">
                          <div class="bg-black bg-opacity-25 rounded p-2 text-center">
                            <div class="text-secondary small">Upgrade Time</div>
                            <div class="fw-semibold"><?= esc((string) ($level['cost_time_label'] ?? '0 min')); ?></div>
                          </div>
                        </div>
                        <div class="col-6 col-md-3">
                          <div class="bg-black bg-opacity-25 rounded p-2 text-center">
                            <div class="text-secondary small">Furniture Limit</div>
                            <div class="fw-semibold text-success"><?= (int) ($level['furniture_limit'] ?? 0); ?></div>
                          </div>
                        </div>
                        <div class="col-6 col-md-3">
                          <div class="bg-black bg-opacity-25 rounded p-2 text-center h-100">
                            <div class="text-secondary small">Reward</div>
                            <div class="fw-semibold text-info"><?= esc($rewardName !== '' ? $rewardName : 'Reward Item'); ?></div>
                          </div>
                        </div>
                      </div>

                      <?php if (!empty($unlockBuildings)): ?>
                        <div class="mb-3">
                          <div class="small text-secondary mb-2">Unlock Building Targets</div>
                          <div class="d-flex flex-wrap gap-2">
                            <?php foreach ($unlockBuildings as $unlock): ?>
                              <span class="badge bg-secondary"><?= esc((string) $unlock); ?></span>
                            <?php endforeach; ?>
                          </div>
                        </div>
                      <?php endif; ?>

                      <div class="small text-secondary mb-2">Quest List</div>
                      <?php if (empty($tasks)): ?>
                        <div class="alert alert-secondary border-secondary mb-0">No quest found for this level.</div>
                      <?php else: ?>
                        <div class="list-group">
                          <?php foreach ($tasks as $task): ?>
                            <?php
                            $taskRewardName = trim((string) ($task['drop_item_name'] ?? ''));
                            ?>
                            <div class="list-group-item bg-body-tertiary text-body border-secondary">
                              <div>
                                <div class="fw-semibold mb-1"><?= esc((string) ($task['text'] ?? '')); ?></div>
                                <div class="small text-secondary mb-1">
                                  Target: <?= (int) ($task['times'] ?? 0); ?>
                                </div>
                                <div class="small text-info">Reward: <?= esc($taskRewardName !== '' ? $taskRewardName : 'Reward'); ?></div>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

