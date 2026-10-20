<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ROXPEDIA">
  <meta name="description" content="Browse all gardening locations in Ragnarok X Next Generation and check plant/drop details per area.">
  <meta name="robots" content="index, follow">
  <title>ROXPEDIA - Gardening Locations</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" rel="stylesheet">
  <style>
    .spot-index-badge {
      flex: 0 0 2.5rem;
      width: 2.5rem;
      height: 2.5rem;
      min-width: 2.5rem;
      padding: 0;
      line-height: 1;
    }
  </style>
</head>

<body class="bg-body-tertiary">
  <div class="container py-4">
    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2">
              <div class="d-flex align-items-center">
                <i class="fa-solid fa-map-location-dot me-2 text-primary"></i>
                <h5 class="mb-0">Available Gardening Locations</h5>
                <span class="badge bg-secondary ms-2"><?= count($locations) ?> spots</span>
              </div>
            </div>

            <div class="card-body">
              <div class="row mb-4">
                <div class="col-12">
                  <div class="input-group">
                    <span class="input-group-text bg-body-tertiary border-secondary">
                      <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                    </span>
                    <input type="text" class="form-control bg-body border-secondary" id="spotSearch" placeholder="Search gardening locations...">
                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                      <i class="fa-solid fa-xmark"></i>
                    </button>
                  </div>
                </div>
              </div>

              <div class="row g-3" id="spotsContainer">
                <?php $no = 1; ?>
                <?php foreach ($locations as $loc): ?>
                  <div class="col-12 col-sm-6 col-lg-4 spot-card">
                    <a href="<?= site_url('gardening/spot/' . urlencode((string) ($loc['slug'] ?? ''))) ?>" class="text-decoration-none">
                      <div class="card h-100 border-secondary">
                        <div class="card-body">
                          <div class="d-flex align-items-start">
                            <div class="spot-index-badge me-3 d-inline-flex align-items-center justify-content-center rounded-circle border border-secondary bg-secondary bg-opacity-10 flex-shrink-0">
                              <span class="fw-semibold"><?= $no; ?></span>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="card-title mb-1 fw-semibold"><?= esc((string) ($loc['location'] ?? '-')) ?></h6>
                              <div class="small text-secondary d-flex align-items-center mb-1">
                                <i class="fa-solid fa-leaf me-1"></i>
                                <span><?= (int) ($loc['plant_count'] ?? 0) ?> plants</span>
                              </div>
                              <div class="small text-secondary d-flex align-items-center">
                                <i class="fa-solid fa-chart-line me-1"></i>
                                <span>Min Lv <?= (int) ($loc['min_level'] ?? 1) ?></span>
                              </div>
                            </div>
                            <div class="ms-2">
                              <i class="fa-solid fa-chevron-right text-secondary"></i>
                            </div>
                          </div>

                          <?php if (!empty($loc['description'])): ?>
                            <div class="mt-3 pt-2 border-top border-secondary">
                              <p class="small text-secondary mb-0">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                <?= esc((string) $loc['description']) ?>
                              </p>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </a>
                  </div>
                  <?php $no++; ?>
                <?php endforeach; ?>
              </div>

              <div id="noResults" class="text-center py-5 d-none">
                <i class="fa-solid fa-seedling fa-3x text-secondary mb-3"></i>
                <h6 class="text-secondary mb-2">No Location Found</h6>
                <p class="text-secondary small mb-0">Try a different search term</p>
              </div>
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

    const searchInput = document.getElementById('spotSearch');
    const clearBtn = document.getElementById('clearSearch');
    const spotCards = document.querySelectorAll('.spot-card');
    const noResults = document.getElementById('noResults');

    function applySearch() {
      const searchTerm = (searchInput.value || '').toLowerCase().trim();
      let visibleCount = 0;

      spotCards.forEach((card) => {
        const spotName = (card.querySelector('.card-title')?.textContent || '').toLowerCase();
        const cardText = (card.textContent || '').toLowerCase();

        if (searchTerm === '' || spotName.includes(searchTerm) || cardText.includes(searchTerm)) {
          card.classList.remove('d-none');
          visibleCount++;
        } else {
          card.classList.add('d-none');
        }
      });

      if (visibleCount === 0 && searchTerm !== '') {
        noResults.classList.remove('d-none');
      } else {
        noResults.classList.add('d-none');
      }
    }

    searchInput.addEventListener('input', applySearch);
    clearBtn.addEventListener('click', () => {
      searchInput.value = '';
      applySearch();
      searchInput.focus();
    });
  </script>
</body>

</html>


