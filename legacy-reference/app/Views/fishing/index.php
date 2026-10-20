<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Cherubim">
  <meta name="description" content="Browse all fishing spots in Ragnarok X Next Generation and see detailed bait and drop rate information.">
  <meta name="keywords" content="ROX Fishing, Ragnarok X Fishing, Fishing Spots, Bait, Drop Rate, ROXPEDIA">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <title>ROXPEDIA - Fishing Spots</title>

  <!-- BOOTSTRAP 5.3 ONLY - NO CUSTOM CSS -->
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
    <!-- HEADER SAMA PERSIS DENGAN INDEX UTAMA -->
    <?= view('partials/site_header') ?>

    <main>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <div class="card border-secondary mb-4">
            <div class="card-header bg-body-tertiary border-secondary py-2">
              <div class="d-flex align-items-center">
                <i class="fa-solid fa-map-location-dot me-2 text-primary"></i>
                <h5 class="mb-0">Available Fishing Locations</h5>
                <span class="badge bg-secondary ms-2"><?= count($locations) ?> spots</span>
              </div>
            </div>

            <div class="card-body">
              <!-- Filter/Search Bar (Optional) -->
              <div class="row mb-4">
                <div class="col-12">
                  <div class="input-group">
                    <span class="input-group-text bg-body-tertiary border-secondary">
                      <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                    </span>
                    <input type="text" class="form-control bg-body border-secondary" id="spotSearch" placeholder="Search fishing spots...">
                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                      <i class="fa-solid fa-xmark"></i>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Fishing Spots Grid -->
              <div class="row g-3" id="spotsContainer">
                <?php $no = 1; ?>
                <?php foreach ($locations as $loc): ?>
                  <div class="col-12 col-sm-6 col-lg-4 spot-card">
                    <a href="<?= site_url('fishing/spot/' . urlencode($loc['slug'])); ?>" class="text-decoration-none">
                      <div class="card h-100 border-secondary">
                        <div class="card-body">
                          <div class="d-flex align-items-start">
                            <div class="spot-index-badge me-3 d-inline-flex align-items-center justify-content-center rounded-circle border border-secondary bg-secondary bg-opacity-10 flex-shrink-0">
                              <span class="fw-semibold"><?= $no; ?></span>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="card-title mb-1 fw-semibold">
                                <?= esc($loc['location']); ?>
                              </h6>
                              <div class="small text-secondary d-flex align-items-center">
                                <i class="fa-solid fa-water me-1"></i>
                                <span>Fishing Spot</span>
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
                                <?= esc($loc['description']); ?>
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

              <!-- No Results Message (Hidden by Default) -->
              <div id="noResults" class="text-center py-5 d-none">
                <i class="fa-solid fa-fish fa-3x text-secondary mb-3"></i>
                <h6 class="text-secondary mb-2">No Fishing Spots Found</h6>
                <p class="text-secondary small mb-0">Try a different search term</p>
              </div>
            </div>
          </div>

          <!-- Quick Tips -->
          <div class="alert alert-dark border-secondary small">
            <div class="d-flex">
              <i class="fa-solid fa-lightbulb mt-1 me-2 text-warning"></i>
              <div>
                <div class="fw-semibold mb-1">Fishing Tips:</div>
                <div class="mb-1">- Different spots have different bait effectiveness and drop rates</div>
                <div class="mb-0">- Check individual spot pages for detailed stamina usage and rewards</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- FOOTER SAMA DENGAN INDEX UTAMA -->
    <?= view('partials/site_footer') ?>
  </div>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Set current year in footer
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // Search functionality for fishing spots
    document.getElementById('spotSearch').addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase().trim();
      const spotCards = document.querySelectorAll('.spot-card');
      const noResults = document.getElementById('noResults');
      let visibleCount = 0;

      spotCards.forEach(card => {
        const spotName = card.querySelector('.card-title').textContent.toLowerCase();
        const spotDescription = card.querySelector('.small.text-secondary')?.textContent.toLowerCase() || '';

        if (searchTerm === '' || spotName.includes(searchTerm) || spotDescription.includes(searchTerm)) {
          card.classList.remove('d-none');
          visibleCount++;
        } else {
          card.classList.add('d-none');
        }
      });

      // Show/hide no results message
      if (visibleCount === 0 && searchTerm !== '') {
        noResults.classList.remove('d-none');
      } else {
        noResults.classList.add('d-none');
      }
    });

    // Clear search functionality
    document.getElementById('clearSearch').addEventListener('click', function() {
      document.getElementById('spotSearch').value = '';
      document.getElementById('spotSearch').dispatchEvent(new Event('input'));
      document.getElementById('spotSearch').focus();
    });


    // Focus search on Ctrl+F
    document.addEventListener('keydown', function(e) {
      if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
        e.preventDefault();
        document.getElementById('spotSearch').focus();
      }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
      // Check for URL search parameter
      const urlParams = new URLSearchParams(window.location.search);
      const searchParam = urlParams.get('search');
      if (searchParam) {
        document.getElementById('spotSearch').value = searchParam;
        document.getElementById('spotSearch').dispatchEvent(new Event('input'));
      }
    });
  </script>
</body>

</html>


