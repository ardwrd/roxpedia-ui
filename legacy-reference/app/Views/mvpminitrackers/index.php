<?php
// app/Views/mvpminitrackers/index.php  (FULL VERSION - COPAS)
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ROXPEDIA - MVP & Mini Trackers</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">

    <!-- Top header optimized for mobile -->
    <?= view('partials/site_header') ?>

    <?php if (session('error')): ?>
      <div class="alert alert-danger"><?= esc(session('error')) ?></div>
    <?php endif; ?>
    <?php if (!empty($storageError)): ?>
      <div class="alert alert-danger"><?= esc((string) $storageError) ?></div>
    <?php endif; ?>

    <!-- Title Card optimized -->
    <div class="card bg-body-tertiary border-secondary mb-3">
      <div class="card-body py-2 py-md-3">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2">
          <div class="mb-2 mb-md-0">
            <h4 class="mb-1 fs-5 fs-md-4">MVP & Mini Trackers</h4>
            <p class="mb-0 text-secondary small">
              Room-based tracker (TTL 24h). Attempts reset at <?= esc($resetAt ?? '05:00 (GMT+7)') ?>.
            </p>
          </div>

          <div class="d-flex gap-2 align-self-stretch align-self-md-center">
            <?php if (($mode ?? 'landing') === 'room'): ?>
              <button class="btn btn-outline-secondary btn-sm px-2 px-md-3" id="btnCopyLink" data-link="<?= esc($roomUrl) ?>" type="button" title="Copy Room Link">
                <i class="fa-solid fa-link"></i>
                <span class="d-none d-md-inline ms-1">Copy Link</span>
              </button>
            <?php endif; ?>

            <form method="post" action="<?= site_url('mvpminitrackers/create-room'); ?>" class="m-0">
              <?= csrf_field(); ?>
              <button class="btn btn-success btn-sm px-2 px-md-3" type="submit">
                <i class="fa-solid fa-plus"></i>
                <span class="d-none d-md-inline ms-1">Create Room</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php if (($mode ?? 'landing') !== 'room'): ?>

      <!-- Landing Join Card - optimized -->
      <div class="card bg-body-tertiary border-secondary">
        <div class="card-body py-3">
          <div class="row g-2 g-md-3 align-items-center">
            <div class="col-12">
              <label class="form-label mb-1">Join Room (token)</label>
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" id="joinToken" placeholder="Paste token from room link">
                <button class="btn btn-primary" id="btnJoinRoom" type="button">
                  <i class="fa-solid fa-right-to-bracket"></i>
                  <span class="d-none d-md-inline ms-1">Join Room</span>
                </button>
              </div>
              <div class="form-text text-secondary small mt-1">
                Example: <?= rtrim(site_url('mvpminitrackers/room'), '/') ?>/<b>token</b>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Active Rooms (token hidden) + Token Input per row -->
      <div class="card bg-body-tertiary border-secondary mt-3">
        <div class="card-header py-2">
          <div class="fw-semibold fs-6">Active Rooms</div>
          <div class="text-secondary" style="font-size:11px;">
            Token is never shown. Paste your token/link to join.
          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-dark table-sm align-middle mb-0">
              <thead>
                <tr>
                  <th class="ps-2 ps-md-3">Room</th>
                  <th style="width:140px;">Expires</th>
                  <th style="width:90px;" class="text-center">Timers</th>
                  <th style="width:90px;" class="text-center">Chars</th>
                  <th style="min-width:220px;">Token</th>
                  <th style="width:90px;" class="pe-2 pe-md-3"></th>
                </tr>
              </thead>
              <tbody id="activeRoomsRows">
                <?php $rooms = $rooms ?? []; ?>
                <?php if (empty($rooms)): ?>
                  <tr>
                    <td colspan="6" class="text-secondary py-3 text-center">No active rooms</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($rooms as $r): ?>
                    <tr>
                      <td class="ps-2 ps-md-3">
                        <div class="fw-semibold" style="font-size:14px;">Room #<?= (int)$r['id'] ?></div>
                        <div class="text-secondary" style="font-size:11px;">TTL 24h - GMT+7</div>
                      </td>

                      <td style="font-size:12px;">
                        <?= esc(date('m-d H:i', strtotime($r['expires_at'] ?? ''))) ?>
                      </td>

                      <td class="text-center">
                        <span class="badge bg-secondary"><?= (int)($r['total_timers'] ?? 0) ?></span>
                      </td>

                      <td class="text-center">
                        <span class="badge bg-secondary"><?= (int)($r['total_characters'] ?? 0) ?></span>
                      </td>

                      <td>
                        <input
                          type="text"
                          class="form-control form-control-sm room-token-input"
                          placeholder="Paste token or full room link"
                          autocomplete="off"
                          inputmode="text">
                      </td>

                      <td class="text-end pe-2 pe-md-3">
                        <button type="button" class="btn btn-primary btn-sm btn-join-room">
                          Join
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div class="form-text text-secondary small px-2 px-md-3 py-2">
            Have rooms token? join your party team!
          </div>
        </div>
      </div>

    <?php else: ?>

      <!-- Room Badges optimized for mobile -->
      <div class="d-flex flex-wrap gap-1 gap-md-2 align-items-center mb-3">

        <!-- Room ID (untuk komunikasi) -->
        <span class="badge bg-primary text-wrap small px-2 py-1" style="font-size:0.75rem;">
          Room #<?= (int)($room['id'] ?? 0) ?>
        </span>

        <!-- Short token preview (UI/mobile context only) -->
        <span class="badge bg-secondary text-wrap small px-2 py-1" style="font-size:0.75rem;">
          <?= esc(substr($roomToken, 0, 6)) ?>...
        </span>

        <!-- Expiry -->
        <span class="badge bg-secondary text-wrap small px-2 py-1" style="font-size:0.75rem;">
          <span class="d-none d-md-inline">Expires: </span>
          <?= esc(date('m-d H:i', strtotime($room['expires_at'] ?? '-'))) ?>
        </span>

      </div>


      <div class="row g-3">
        <!-- RIGHT: Attempts (mobile first) -->
        <div class="col-12 col-lg-5 order-0 order-lg-1">
          <div class="card bg-body-tertiary border-secondary">
            <div class="card-header d-flex align-items-center justify-content-between py-2">
              <div>
                <div class="fw-semibold fs-6">Attempts</div>
                <div class="text-secondary" style="font-size:11px;">Per character. Reset at <?= esc($resetAt) ?>.</div>
              </div>
              <button class="btn btn-primary btn-sm px-2 px-md-3" id="btnAddChar" type="button">
                <i class="fa-solid fa-user-plus"></i>
                <span class="d-none d-md-inline ms-1">Add Character</span>
              </button>
            </div>

            <div class="card-body py-2">
              <div class="text-secondary small mb-2" id="attemptWindowText"></div>
              <div id="charactersWrap" class="vstack gap-2">
                <div class="text-secondary small">Loading...</div>
              </div>
            </div>
          </div>
        </div>

        <!-- LEFT: Timers (desktop first) -->
        <div class="col-12 col-lg-7 order-1 order-lg-0">
          <!-- Add Timer optimized -->
          <div class="card bg-body-tertiary border-secondary mb-3">
            <div class="card-header py-2">
              <div class="fw-semibold fs-6">Add Timer</div>
              <div class="text-secondary" style="font-size:11px;">Enter countdown hours, minutes, and seconds (manual).</div>
            </div>
            <div class="card-body py-2">
              <div class="row g-2 g-md-3">
                <div class="col-12 col-md-4">
                  <label class="form-label mb-1 small">Type</label>
                  <select class="form-select form-select-sm" id="timerType">
                    <option value="MVP">MVP</option>
                    <option value="MINI">MINI</option>
                  </select>
                </div>

                <div class="col-12 col-md-8">
                  <label class="form-label mb-1 small">Boss</label>
                  <select class="form-select form-select-sm" id="timerBoss"></select>
                  <div class="form-text text-secondary small" id="bossSub">-</div>
                </div>

                <div class="col-4">
                  <label class="form-label mb-1 small">Hours</label>
                  <input type="number" min="0" class="form-control form-control-sm" id="timerHours" value="0">
                </div>

                <div class="col-4">
                  <label class="form-label mb-1 small">Minutes</label>
                  <input type="number" min="0" max="59" class="form-control form-control-sm" id="timerMinutes" value="0">
                </div>

                <div class="col-4">
                  <label class="form-label mb-1 small">Seconds</label>
                  <input type="number" min="0" max="59" class="form-control form-control-sm" id="timerSeconds" value="0" placeholder="0-59">
                </div>

                <div class="col-12">
                  <div class="form-text text-secondary small mt-1">
                    Tip: enter <b>-5 seconds</b> from in-game seconds to avoid delay.
                  </div>
                </div>

                <div class="col-12 d-grid mt-1">
                  <button class="btn btn-success btn-sm" id="btnAddTimer" type="button">
                    <i class="fa-solid fa-plus me-1"></i> Add Timer
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Active Timers optimized -->
          <div class="card bg-body-tertiary border-secondary">
            <div class="card-header d-flex align-items-center justify-content-between py-2">
              <div>
                <div class="fw-semibold fs-6">Active Timers</div>
                <div class="text-secondary" style="font-size:11px;">Countdown updates using server time.</div>
              </div>
              <button class="btn btn-outline-secondary btn-sm px-2" id="btnReloadTimers" type="button" title="Reload">
                <i class="fa-solid fa-rotate"></i>
                <span class="d-none d-md-inline ms-1">Reload</span>
              </button>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-dark table-sm align-middle mb-0">
                  <thead>
                    <tr>
                      <th class="ps-2 ps-md-3">Boss</th>
                      <th class="d-none d-md-table-cell" style="width:150px;">Spawn At</th>
                      <th style="width:100px;" class="pe-2">Countdown</th>
                      <th style="width:85px;" class="pe-2 pe-md-3"></th>
                    </tr>
                  </thead>
                  <tbody id="timerRows">
                    <tr>
                      <td colspan="4" class="text-secondary py-3 text-center">Loading...</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form-text text-secondary small px-2 px-md-3 py-2">
                <span class="d-block d-md-inline">The <b>Died</b> button resets timer:</span>
                <span class="d-block d-md-inline ms-0 ms-md-1"><b>MVP 3 hours</b>, <b>MINI 2 hours</b>.</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php endif; ?>

    <!-- Footer optimized -->
    <?= view('partials/site_footer') ?>

  </div>

  <!-- Modal: Add Character -->
  <div class="modal fade" id="modalAddChar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-body-tertiary border-secondary">
        <div class="modal-header py-2">
          <h5 class="modal-title fs-6">Add Character</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="formAddChar">
          <?= csrf_field(); ?>
          <div class="modal-body py-2">
            <div class="mb-2">
              <label class="form-label small">Character Name</label>
              <input type="text" class="form-control form-control-sm" id="charName" name="name" placeholder="e.g. Cherubim" autocomplete="off">
              <div class="form-text text-secondary small">Max 5 characters per room.</div>
            </div>
            <div class="alert alert-danger d-none small py-1" id="charErr"></div>
          </div>

          <div class="modal-footer py-2">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary btn-sm">
              <i class="fa-solid fa-check me-1"></i> Add
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    const MODE = <?= json_encode($mode ?? 'landing') ?>;
    const ROOM_TOKEN = <?= json_encode($roomToken ?? null) ?>;

    const BOSSES_MVP = <?= json_encode($bossesMvp ?? []) ?>;
    const BOSSES_MINI = <?= json_encode($bossesMini ?? []) ?>;

    const BONUS_LABELS = <?= json_encode($bonusTypes ?? []) ?>;

    // Image base: assets/img/boss/ID.png
    const BOSS_IMG_BASE = <?= json_encode(rtrim(base_url('assets/img/boss/'), '/') . '/') ?>;

    // ---------------- Utilities ----------------
    function toast(msg, type = 'success') {
      const el = document.createElement('div');
      el.className = 'alert alert-' + type + ' position-fixed bottom-0 end-0 m-2 m-md-3 p-2';
      el.style.zIndex = 2000;
      el.style.fontSize = '14px';
      el.textContent = msg;
      document.body.appendChild(el);
      setTimeout(() => el.remove(), 1600);
    }

    function getTokenFromInput(v) {
      v = (v || '').trim();
      if (!v) return '';
      const m = v.match(/mvpminitrackers\/room\/([a-f0-9]{16,64})/i);
      if (m && m[1]) return m[1];
      return v;
    }

    function fmt(n) {
      return String(n).padStart(2, '0');
    }

    function escapeHtml(s) {
      return String(s ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", "&#039;");
    }

    // ---------------- Landing ----------------
    if (document.getElementById('btnJoinRoom')) {
      document.getElementById('btnJoinRoom').addEventListener('click', () => {
        const raw = document.getElementById('joinToken').value;
        const tok = getTokenFromInput(raw);
        if (!tok) return alert('Token is empty.');
        window.location.href = <?= json_encode(site_url('mvpminitrackers/room/')) ?> + tok;
      });
    }

    // Landing: per-row join (Active Rooms table)
    (function() {
      const tbody = document.getElementById('activeRoomsRows');
      if (!tbody) return;

      tbody.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-join-room');
        if (!btn) return;

        const tr = btn.closest('tr');
        const input = tr ? tr.querySelector('.room-token-input') : null;
        const raw = input ? input.value : '';
        const tok = getTokenFromInput(raw);

        if (!tok) return alert('Token is empty.');
        window.location.href = <?= json_encode(site_url('mvpminitrackers/room/')) ?> + tok;
      });
    })();

    const btnCopy = document.getElementById('btnCopyLink');
    if (btnCopy) {
      btnCopy.addEventListener('click', async () => {
        const link = btnCopy.getAttribute('data-link');
        try {
          await navigator.clipboard.writeText(link);
          toast('Room link copied');
        } catch (e) {
          alert('Copy failed. Link: ' + link);
        }
      });
    }

    // ---------------- Timers (mobile optimized) ----------------
    let serverNow = 0;
    let timers = [];
    let tick = null;
    const timerRowCache = new Map();

    async function loadTimers() {
      const res = await fetch(<?= json_encode(site_url('mvpminitrackers/timers/')) ?> + ROOM_TOKEN, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const json = await res.json().catch(() => null);
      if (!json || !json.ok) return;

      timers = json.timers || [];
      serverNow = parseInt(json.server_now, 10) || 0;

      renderTimersOnce();

      if (tick) clearInterval(tick);
      tick = setInterval(() => {
        serverNow++;
        updateCountdownOnly();
      }, 1000);

      updateCountdownOnly();
    }

    function renderTimersOnce() {
      const tbody = document.getElementById('timerRows');
      if (!tbody) return;

      tbody.innerHTML = '';
      timerRowCache.clear();

      if (!timers.length) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-secondary py-3 text-center">No timers</td></tr>';
        return;
      }

      timers.forEach(t => {
        const tr = document.createElement('tr');

        const bossId = (t.boss_id != null) ? String(t.boss_id) : '';
        const bossStaticId = (t.boss_static_id != null) ? String(t.boss_static_id) : bossId;
        const bossName = (t.boss_name && String(t.boss_name).trim() !== '') ? String(t.boss_name) : (bossId ? ('Boss#' + bossId) : 'Boss');
        const bossType = (t.boss_type && String(t.boss_type).trim() !== '') ? String(t.boss_type) : '-';

        const spawn = t.spawn_location ? String(t.spawn_location) : '-';
        const levelCap = (t.level_cap != null && String(t.level_cap).trim() !== '') ? String(t.level_cap) : '-';

        const imgSrc = bossStaticId ? (BOSS_IMG_BASE + encodeURIComponent(bossStaticId) + '.png') : '';

        // Boss cell - optimized for mobile
        const tdBoss = document.createElement('td');
        tdBoss.className = 'align-middle ps-2 ps-md-3';

        const wrap = document.createElement('div');
        wrap.className = 'd-flex align-items-center gap-1 gap-md-2';

        // Gambar boss (desktop only)
        if (imgSrc) {
          const imgContainer = document.createElement('div');
          imgContainer.className = 'd-flex align-items-center justify-content-center rounded border border-secondary flex-shrink-0 overflow-hidden bg-body-tertiary';
          imgContainer.style.width = '35px';
          imgContainer.style.height = '35px';
          imgContainer.classList.add('d-none', 'd-md-flex');

          const img = document.createElement('img');
          img.src = imgSrc;
          img.alt = bossName;
          img.className = 'object-fit-contain w-100 h-100';

          img.onerror = () => {
            imgContainer.innerHTML = '<i class="fa-solid fa-skull text-secondary small"></i>';
            imgContainer.classList.remove('border');
          };

          imgContainer.appendChild(img);
          wrap.appendChild(imgContainer);
        }

        const info = document.createElement('div');
        info.style.minWidth = '0';
        info.style.flex = '1';
        info.innerHTML = `
      <div class="fw-semibold text-truncate" style="font-size:14px;">${escapeHtml(bossName)}</div>
      <div class="text-secondary d-none d-md-block" style="font-size:11px;">
        ${escapeHtml(bossType)} - ${escapeHtml(spawn)}
      </div>
      <div class="text-secondary d-block d-md-none" style="font-size:11px;">
        ${escapeHtml(bossType)} - Lv ${escapeHtml(levelCap)}
      </div>
      <div class="text-secondary d-none d-md-block" style="font-size:11px;">
        Level Cap: ${escapeHtml(levelCap)}
      </div>
    `;
        wrap.appendChild(info);
        tdBoss.appendChild(wrap);

        // Spawn At - hidden on mobile
        const tdEndAt = document.createElement('td');
        tdEndAt.className = 'align-middle d-none d-md-table-cell';
        tdEndAt.style.width = '150px';
        tdEndAt.textContent = t.end_at ? String(t.end_at) : '-';

        // Countdown
        const tdCd = document.createElement('td');
        tdCd.className = 'align-middle pe-2';
        tdCd.style.width = '100px';
        const badge = document.createElement('span');
        badge.className = 'badge bg-secondary';
        badge.style.fontSize = '12px';
        badge.textContent = '--:--:--';
        tdCd.appendChild(badge);

        // Actions - compact for mobile
        const tdAct = document.createElement('td');
        tdAct.className = 'text-end align-middle pe-2 pe-md-3';
        tdAct.style.width = '85px';

        const btnWrap = document.createElement('div');
        btnWrap.className = 'd-flex gap-1 justify-content-end';

        const btnDied = document.createElement('button');
        btnDied.type = 'button';
        btnDied.className = 'btn btn-outline-warning btn-sm px-2';
        btnDied.innerHTML = '<i class="fa-solid fa-skull"></i>';
        btnDied.title = 'Mark as died';
        btnDied.addEventListener('click', () => markDied(t.id));

        const btnDel = document.createElement('button');
        btnDel.type = 'button';
        btnDel.className = 'btn btn-outline-danger btn-sm px-2';
        btnDel.innerHTML = '<i class="fa-solid fa-trash"></i>';
        btnDel.title = 'Delete timer';
        btnDel.addEventListener('click', () => deleteTimer(t.id));

        btnWrap.appendChild(btnDied);
        btnWrap.appendChild(btnDel);
        tdAct.appendChild(btnWrap);

        tr.appendChild(tdBoss);
        tr.appendChild(tdEndAt);
        tr.appendChild(tdCd);
        tr.appendChild(tdAct);

        tbody.appendChild(tr);
        timerRowCache.set(String(t.id), {
          countdownEl: badge
        });
      });
    }

    function updateCountdownOnly() {
      if (!timers.length) return;
      timers.forEach(t => {
        const cached = timerRowCache.get(String(t.id));
        if (!cached) return;

        let diff = (parseInt(t.end_ts, 10) || 0) - serverNow;
        if (diff < 0) diff = 0;

        const h = Math.floor(diff / 3600);
        const m = Math.floor((diff % 3600) / 60);
        const s = diff % 60;

        cached.countdownEl.textContent = `${fmt(h)}:${fmt(m)}:${fmt(s)}`;
      });
    }

    async function deleteTimer(id) {
      const fd = new FormData();
      fd.append('room_token', ROOM_TOKEN);
      fd.append('timer_id', id);
      fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

      const res = await fetch(<?= json_encode(site_url('mvpminitrackers/timers/delete')) ?>, {
        method: 'POST',
        body: fd,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const json = await res.json().catch(() => null);
      if (json && json.ok === false) {
        return alert(json.msg || 'Failed deleting timer.');
      }

      await loadTimers();
    }

    async function markDied(id) {
      if (!confirm('Confirm boss died? The timer will be reset automatically.')) return;

      const fd = new FormData();
      fd.append('room_token', ROOM_TOKEN);
      fd.append('timer_id', id);
      fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

      const res = await fetch(<?= json_encode(site_url('mvpminitrackers/timers/died')) ?>, {
        method: 'POST',
        body: fd,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const json = await res.json().catch(() => null);
      if (!json || !json.ok) {
        return alert((json && json.msg) ? json.msg : ('Failed resetting timer. (HTTP ' + res.status + ')'));
      }

      toast('Timer reset');
      await loadTimers();
    }

    // Boss select binding
    function setBossOptions(type) {
      const sel = document.getElementById('timerBoss');
      const sub = document.getElementById('bossSub');
      if (!sel) return;

      const list = (type === 'MVP') ? BOSSES_MVP : BOSSES_MINI;
      sel.innerHTML = '';

      if (!list.length) {
        const opt = document.createElement('option');
        opt.value = '';
        opt.textContent = 'No bosses';
        sel.appendChild(opt);
        if (sub) sub.textContent = '-';
        return;
      }

      list.forEach(b => {
        const opt = document.createElement('option');
        opt.value = b.id;
        opt.textContent = b.name;
        const levelCap = (b.level_cap != null && String(b.level_cap).trim() !== '') ? String(b.level_cap) : '-';
        opt.setAttribute('data-sub', `${b.spawn_location || '-'} - Lv Cap ${levelCap}`);
        sel.appendChild(opt);
      });

      const first = sel.options[0];
      if (sub) sub.textContent = first ? (first.getAttribute('data-sub') || '-') : '-';
    }

    if (document.getElementById('timerType')) {
      setBossOptions(document.getElementById('timerType').value);

      document.getElementById('timerType').addEventListener('change', (e) => {
        setBossOptions(e.target.value);
      });

      document.getElementById('timerBoss').addEventListener('change', (e) => {
        const sub = document.getElementById('bossSub');
        const opt = e.target.options[e.target.selectedIndex];
        if (sub) sub.textContent = opt ? (opt.getAttribute('data-sub') || '-') : '-';
      });
    }

    // Add Timer (manual seconds)
    const btnAddTimer = document.getElementById('btnAddTimer');
    if (btnAddTimer) {
      btnAddTimer.addEventListener('click', async () => {
        const bossType = document.getElementById('timerType').value;
        const bossId = document.getElementById('timerBoss').value;

        const hours = parseInt(document.getElementById('timerHours').value || '0', 10);
        const minutes = parseInt(document.getElementById('timerMinutes').value || '0', 10);
        const seconds = parseInt(document.getElementById('timerSeconds').value || '0', 10);

        if (!bossId) return alert('Please select a boss.');
        if (!Number.isFinite(hours) || hours < 0) return alert('Invalid hours.');
        if (!Number.isFinite(minutes) || minutes < 0 || minutes > 59) return alert('Minutes must be 0-59.');
        if (!Number.isFinite(seconds) || seconds < 0 || seconds > 59) return alert('Seconds must be 0-59.');

        const delta = (hours * 3600) + (minutes * 60) + seconds;
        if (delta <= 0) return alert('Duration must be greater than 0.');

        const fd = new FormData();
        fd.append('room_token', ROOM_TOKEN);
        fd.append('boss_type', bossType);
        fd.append('boss_id', bossId);
        fd.append('hours', String(hours));
        fd.append('minutes', String(minutes));
        fd.append('seconds', String(seconds));
        fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

        const res = await fetch(<?= json_encode(site_url('mvpminitrackers/timers/add')) ?>, {
          method: 'POST',
          body: fd,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        const json = await res.json().catch(() => null);
        if (!json || !json.ok) {
          return alert((json && json.msg) ? json.msg : ('Failed adding timer. (HTTP ' + res.status + ')'));
        }

        toast('Timer added');
        await loadTimers();
      });
    }

    const btnReloadTimers = document.getElementById('btnReloadTimers');
    if (btnReloadTimers) btnReloadTimers.addEventListener('click', loadTimers);

    // ---------------- Attempts ----------------
    async function loadAttempts() {
      const res = await fetch(<?= json_encode(site_url('mvpminitrackers/attempts/')) ?> + ROOM_TOKEN, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });
      const json = await res.json().catch(() => null);
      if (!json || !json.ok) return;

      const wrap = document.getElementById('charactersWrap');
      wrap.innerHTML = '';

      const win = json.window || {};
      const winEl = document.getElementById('attemptWindowText');
      if (winEl) {
        winEl.textContent = 'Window: ' + (win.start || '-') + ' -> ' + (win.end || '-') + ' (reset 05:00)';
      }

      const chars = json.characters || [];
      const attempts = json.attempts || {};

      if (!chars.length) {
        wrap.innerHTML = '<div class="text-secondary small">No characters yet. Click "Add Character".</div>';
        return;
      }

      chars.forEach(c => {
        const cid = c.id;

        const card = document.createElement('div');
        card.className = 'card bg-body-tertiary border-secondary';

        card.innerHTML = `
      <div class="card-body py-2">
        <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
          <div class="fw-semibold" style="font-size:14px;">${escapeHtml(c.name)}</div>
          <button class="btn btn-outline-danger btn-sm px-2" data-remove="${cid}" title="Remove" type="button">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>

        <div class="mb-2">
          <div class="text-secondary" style="font-size:11px;">MVP</div>
          <div class="row g-1 g-md-2 mt-1" data-row="MVP"></div>
        </div>

        <div>
          <div class="text-secondary" style="font-size:11px;">MINI</div>
          <div class="row g-1 g-md-2 mt-1" data-row="MINI"></div>
        </div>
      </div>
    `;

        ['MVP', 'MINI'].forEach(bt => {
          const row = card.querySelector(`[data-row="${bt}"]`);
          const st = (attempts[cid] && attempts[cid][bt]) ? attempts[cid][bt] : {};

          Object.keys(BONUS_LABELS).forEach(bk => {
            const obj = st[bk] || {
              remaining: 0,
              max: 0
            };
            const remaining = Number(obj.remaining || 0);
            const maxv = Number(obj.max || 0);

            const col = document.createElement('div');
            col.className = 'col-12 col-md-6';

            const group = document.createElement('div');
            group.className = 'd-flex align-items-stretch gap-1';

            const badge = document.createElement('div');
            badge.className = 'flex-grow-1 badge text-start d-flex align-items-center px-2 py-1 ' +
              (remaining > 0 ? 'bg-secondary' : 'bg-body-tertiary border border-secondary');
            badge.style.fontSize = '11px';
            badge.title = BONUS_LABELS[bk];
            badge.textContent = `${BONUS_LABELS[bk].substring(0, 3)}: ${remaining}/${maxv}`;

            const minus = document.createElement('button');
            minus.type = 'button';
            minus.className = 'btn btn-outline-danger btn-sm px-2';
            minus.innerHTML = '<i class="fa-solid fa-minus small"></i>';
            minus.disabled = (remaining <= 0);

            minus.addEventListener('click', () => updateAttempt(cid, bt, bk, -1, badge, minus));
            badge.addEventListener('contextmenu', (e) => {
              e.preventDefault();
              updateAttempt(cid, bt, bk, +1, badge, minus);
            });

            group.appendChild(badge);
            group.appendChild(minus);
            col.appendChild(group);
            row.appendChild(col);
          });
        });

        card.querySelector('[data-remove]').addEventListener('click', () => removeCharacter(cid));
        wrap.appendChild(card);
      });
    }

    async function updateAttempt(characterId, bossType, bonusType, delta, badgeEl, minusEl) {
      const fd = new FormData();
      fd.append('room_token', ROOM_TOKEN);
      fd.append('character_id', characterId);
      fd.append('boss_type', bossType);
      fd.append('bonus_type', bonusType);
      fd.append('delta', delta);
      fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

      const res = await fetch(<?= json_encode(site_url('mvpminitrackers/attempts/update')) ?>, {
        method: 'POST',
        body: fd,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const json = await res.json().catch(() => null);
      if (!json || !json.ok) {
        return alert((json && json.msg) ? json.msg : ('Failed updating attempt. (HTTP ' + res.status + ')'));
      }

      const remaining = Number(json.remaining || 0);
      const maxv = Number(json.max || 0);

      badgeEl.textContent = `${BONUS_LABELS[bonusType].substring(0, 3)}: ${remaining}/${maxv}`;
      minusEl.disabled = (remaining <= 0);
    }

    async function removeCharacter(characterId) {
      const fd = new FormData();
      fd.append('room_token', ROOM_TOKEN);
      fd.append('character_id', characterId);
      fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

      const res = await fetch(<?= json_encode(site_url('mvpminitrackers/character/remove')) ?>, {
        method: 'POST',
        body: fd,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const json = await res.json().catch(() => null);
      if (!json || !json.ok) {
        return alert((json && json.msg) ? json.msg : ('Failed removing character. (HTTP ' + res.status + ')'));
      }

      toast('Character removed');
      await loadAttempts();
    }

    // Add Character modal flow
    const modalAddChar = new bootstrap.Modal(document.getElementById('modalAddChar'));
    const btnAddChar = document.getElementById('btnAddChar');
    if (btnAddChar) {
      btnAddChar.addEventListener('click', () => {
        document.getElementById('charErr').classList.add('d-none');
        document.getElementById('charName').value = '';
        modalAddChar.show();
        setTimeout(() => document.getElementById('charName').focus(), 200);
      });
    }

    const formAddChar = document.getElementById('formAddChar');
    if (formAddChar) {
      formAddChar.addEventListener('submit', async (e) => {
        e.preventDefault();

        const err = document.getElementById('charErr');
        err.classList.add('d-none');
        err.textContent = '';

        const name = (document.getElementById('charName').value || '').trim();
        if (!name) {
          err.textContent = 'Character name cannot be empty.';
          err.classList.remove('d-none');
          return;
        }

        const fd = new FormData();
        fd.append('room_token', ROOM_TOKEN);
        fd.append('name', name);
        fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

        const res = await fetch(<?= json_encode(site_url('mvpminitrackers/character/add')) ?>, {
          method: 'POST',
          body: fd,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        const json = await res.json().catch(() => null);
        if (!json || !json.ok) {
          err.textContent = (json && json.msg) ? json.msg : ('Failed adding character. (HTTP ' + res.status + ')');
          err.classList.remove('d-none');
          return;
        }

        modalAddChar.hide();
        toast('Character added');
        await loadAttempts();
      });
    }

    // Auto init
    if (MODE === 'room') {
      loadTimers();
      loadAttempts();
    }
  </script>

</body>

</html>

