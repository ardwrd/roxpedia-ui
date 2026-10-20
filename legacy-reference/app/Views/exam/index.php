<?php
$langLabels = ['en', 'th', 'cn', 'tw', 'vn', 'in'];
$countO   = array_sum(array_map(fn($q) => (int)$q['answer_index'] === 1 ? 1 : 0, $questions));
$countX   = array_sum(array_map(fn($q) => (int)$q['answer_index'] === 2 ? 1 : 0, $questions));
$countExp = array_sum(array_map(fn($q) => !empty($q['explanation']) ? 1 : 0, $questions));
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="ROXPEDIA OX Quiz Answers - Find all answers to the OX quiz questions.">
  <meta name="keywords" content="OX Quiz, Ragnarok X, ROX Quiz Answers, OX Answers, Game Quiz, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <title>ROXPEDIA - OX Quiz Answers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">

    <!-- HEADER -->
    <?= view('partials/site_header') ?>

    <!-- TITLE - same style as shadowsmelt -->
    <div class="text-center mb-4">
      <h3 class="mb-1">OX Quiz Answers</h3>
      <p class="text-secondary mb-0">
        Find all answers to the new OX quiz questions. Available in both languages.
      </p>
    </div>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <div class="card border-secondary mb-4">

            <!-- Card Header -->
            <div class="card-header bg-body-tertiary border-secondary py-2">
              <div class="d-flex align-items-center flex-wrap gap-2">
                <i class="fa-solid fa-circle-question me-1 text-warning"></i>
                <h5 class="mb-0 me-2">OX Quiz Answer Database</h5>
                <span class="badge bg-secondary" id="visibleCount"><?= $total ?></span>
                <div class="ms-md-auto d-flex gap-1 flex-wrap mt-1 mt-md-0">
                  <?php foreach ($langLabels as $code): ?>
                    <a href="<?= site_url('exam/' . $code) ?>"
                      class="btn btn-sm <?= $lang === $code ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill fw-semibold"
                      title="<?= $langs[$code] ?>">
                      <?= strtoupper($code) ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div class="card-body pb-0">
              <!-- Search + Filter row -->
              <div class="row g-2 mb-3">
                <div class="col-12 col-md-7">
                  <div class="input-group">
                    <span class="input-group-text bg-body-tertiary border-secondary">
                      <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                    </span>
                    <input type="text" id="searchInput"
                      class="form-control bg-body border-secondary"
                      placeholder="Search questions or explanations..."
                      autocomplete="off">
                    <button class="btn btn-outline-secondary" type="button" id="clearSearch" title="Clear search">
                      <i class="fa-solid fa-xmark"></i>
                    </button>
                  </div>
                </div>
                <div class="col-12 col-md-5 d-flex gap-2 align-items-center flex-wrap">
                  <span class="text-secondary small">Filter:</span>
                  <button class="btn btn-sm btn-outline-secondary filter-btn active" data-filter="all">All</button>
                  <button class="btn btn-sm btn-outline-success filter-btn" data-filter="1">O (True)</button>
                  <button class="btn btn-sm btn-outline-danger filter-btn" data-filter="2">X (False)</button>
                  <button class="btn btn-sm btn-outline-warning filter-btn" data-filter="explained">
                    <i class="fa-solid fa-lightbulb fa-xs"></i> Has Tip
                  </button>
                </div>
              </div>

              <!-- Stats badges -->
              <div class="d-flex gap-2 flex-wrap mb-3">
                <span class="badge text-bg-secondary">Total: <?= $total ?></span>
                <span class="badge text-bg-success">O (True): <?= $countO ?></span>
                <span class="badge text-bg-danger">X (False): <?= $countX ?></span>
                <span class="badge text-bg-warning text-dark">
                  <i class="fa-solid fa-lightbulb fa-xs me-1"></i>Has explanation: <?= $countExp ?>
                </span>
              </div>
            </div>

            <!-- Question list -->
            <div class="list-group list-group-flush" id="questionList">
              <?php foreach ($questions as $i => $row):
                $isTrue = (int)$row['answer_index'] === 1;
                $hasExp = !empty($row['explanation']);
              ?>
                <div class="list-group-item bg-transparent border-bottom border-secondary py-3 q-item"
                  data-answer="<?= $row['answer_index'] ?>"
                  data-explained="<?= $hasExp ? '1' : '0' ?>">
                  <div class="d-flex justify-content-between align-items-start gap-2">
                    <span class="badge bg-body-tertiary text-secondary small flex-shrink-0 mt-1"><?= $i + 1 ?></span>
                    <div class="flex-grow-1">
                      <span class="text-body small q-text"><?= htmlspecialchars($row['question']) ?></span>
                      <?php if ($hasExp): ?>
                        <div class="small text-body-secondary mt-1 d-flex align-items-center gap-1">
                          <i class="fa-solid fa-lightbulb fa-xs flex-shrink-0 text-warning"></i>
                          <span class="q-exp"><?= htmlspecialchars($row['explanation']) ?></span>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="flex-shrink-0 text-center">
                      <span class="badge <?= $isTrue ? 'bg-success' : 'bg-danger' ?> fs-6 fw-bold lh-1 px-2 py-2 d-block">
                        <?= $isTrue ? 'O' : 'X' ?>
                      </span>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- No results -->
            <div id="noResults" class="text-center text-secondary py-5 d-none">
              <i class="fa-solid fa-circle-xmark fa-2x mb-2 d-block"></i>
              <p class="mb-0">No questions match your search.</p>
              <button class="btn btn-sm btn-outline-secondary mt-3" id="clearAll">Clear filters</button>
            </div>

          </div>
        </div>
      </div>
    </main>

    <?= view('partials/site_footer') ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('current-year').textContent = new Date().getFullYear();

    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearch');
    const clearAllBtn = document.getElementById('clearAll');
    const visibleCount = document.getElementById('visibleCount');
    const noResults = document.getElementById('noResults');
    const items = Array.from(document.querySelectorAll('.q-item'));
    const filterBtns = document.querySelectorAll('.filter-btn');
    let currentFilter = 'all';

    function highlight(node, term) {
      if (!node._origText) node._origText = node.textContent;
      if (!term) {
        node.innerHTML = node._origText;
        return;
      }
      const escaped = term.replace(/[\\^$.*+?()[\]{}|]/g, '\\$&');
      const re = new RegExp('(' + escaped + ')', 'gi');
      node.innerHTML = node._origText.replace(re, '<mark>$1</mark>');
    }

    function applyFilters() {
      const term = searchInput.value.trim().toLowerCase();
      let visible = 0;
      items.forEach(function(item) {
        const qTextEl = item.querySelector('.q-text');
        const qExpEl = item.querySelector('.q-exp');
        const answer = item.dataset.answer;
        const hasExp = item.dataset.explained === '1';
        const qText = qTextEl ? (qTextEl._origText || qTextEl.textContent) : '';
        const expText = qExpEl ? (qExpEl._origText || qExpEl.textContent) : '';

        let passFilter = true;
        if (currentFilter === '1' || currentFilter === '2') {
          passFilter = answer === currentFilter;
        } else if (currentFilter === 'explained') {
          passFilter = hasExp;
        }
        const passSearch = !term || qText.toLowerCase().includes(term) || expText.toLowerCase().includes(term);
        const show = passFilter && passSearch;
        item.classList.toggle('d-none', !show);
        if (show) {
          visible++;
          if (qTextEl) highlight(qTextEl, term);
          if (qExpEl) highlight(qExpEl, term);
        } else {
          if (qTextEl && qTextEl._origText) qTextEl.innerHTML = qTextEl._origText;
          if (qExpEl && qExpEl._origText) qExpEl.innerHTML = qExpEl._origText;
        }
      });
      visibleCount.textContent = visible;
      noResults.classList.toggle('d-none', visible > 0);
    }

    searchInput.addEventListener('input', applyFilters);
    clearSearchBtn.addEventListener('click', function() {
      searchInput.value = '';
      applyFilters();
      searchInput.focus();
    });
    clearAllBtn.addEventListener('click', function() {
      searchInput.value = '';
      currentFilter = 'all';
      filterBtns.forEach(b => b.classList.toggle('active', b.dataset.filter === 'all'));
      applyFilters();
    });
    filterBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        currentFilter = this.dataset.filter;
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        applyFilters();
      });
    });
  </script>
</body>

</html>

