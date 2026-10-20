<!doctype html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ROXPEDIA Team">
    <meta name="description" content="ROXPEDIA public API documentation with OpenAPI 3.1 and Swagger UI.">
    <meta name="keywords" content="ROXPEDIA API, OpenAPI, Swagger UI, Ragnarok X API">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="ROXPEDIA - API Documentation">
    <meta property="og:description" content="Explore the ROXPEDIA public API through OpenAPI 3.1 and Swagger UI.">
    <meta property="og:image" content="<?= base_url('assets/og-image.png') ?>">
    <meta property="og:url" content="<?= site_url('documentation') ?>">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ROXPEDIA - API Documentation">
    <meta name="twitter:description" content="Explore the ROXPEDIA public API through OpenAPI 3.1 and Swagger UI.">
    <meta name="twitter:image" content="<?= base_url('assets/og-image.png') ?>">
    <link rel="canonical" href="<?= site_url('documentation') ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">
    <title>ROXPEDIA - API Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swagger-ui-dist@5/swagger-ui.css">
</head>

<body class="bg-body-tertiary">
    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <section class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <span class="badge text-bg-primary mb-3">OpenAPI 3.1</span>
                            <h1 class="display-6 fw-semibold mb-3">ROXPEDIA Public API Documentation</h1>
                            <p class="lead text-secondary mb-4">Standardized docs for the current public monster and item endpoints, including a machine-readable spec and Swagger UI.</p>
                            <div class="d-flex flex-wrap gap-2">
                                <a class="btn btn-primary" href="<?= esc($openApiUrl) ?>" target="_blank" rel="noopener">OpenAPI JSON</a>
                                <a class="btn btn-outline-secondary" href="#swagger-reference">Swagger UI</a>
                                <a class="btn btn-outline-secondary" href="<?= esc($apiBaseUrl) ?>" target="_blank" rel="noopener">API Base URL</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-body-tertiary border-0">
                                <div class="card-body">
                                    <h2 class="h6 text-uppercase text-secondary mb-3">Connection Info</h2>
                                    <dl class="row mb-0 g-2 small">
                                        <dt class="col-4">Base URL</dt>
                                        <dd class="col-8 mb-0"><code><?= esc($apiBaseUrl) ?></code></dd>
                                        <dt class="col-4">Auth</dt>
                                        <dd class="col-8 mb-0">none</dd>
                                        <dt class="col-4">Format</dt>
                                        <dd class="col-8 mb-0">application/json</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <span class="badge text-bg-success mb-3">Contract</span>
                            <h2 class="h5">Tool-friendly</h2>
                            <p class="text-secondary mb-0">Import the OpenAPI JSON directly into Postman, Swagger UI, or code generation tools.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <span class="badge text-bg-info mb-3">Surface</span>
                            <h2 class="h5">Read-only endpoints</h2>
                            <p class="text-secondary mb-0">This public API currently documents list and detail reads for monsters and detail reads for items.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <span class="badge text-bg-secondary mb-3">Localization</span>
                            <h2 class="h5">Primary lang values</h2>
                            <p class="mb-2"><?= esc(implode(', ', $supportedLangs)) ?></p>
                            <p class="text-secondary small mb-0">Legacy aliases may still be normalized internally, but only database-backed primary languages are documented here.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-2 mb-3">
                        <div>
                            <h2 class="h4 mb-1">Current public paths</h2>
                            <p class="text-secondary mb-0">Endpoint summary for the ROXPEDIA API.</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Method</th>
                                    <th>Path</th>
                                    <th>Purpose</th>
                                    <th>Key params</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge text-bg-success">GET</span></td>
                                    <td><code>/api/monsters</code></td>
                                    <td>Paginated monster list, filters, and EXP helper data.</td>
                                    <td><code>search</code>, <code>rp</code>, <code>bodily</code>, <code>page</code>, <code>limit</code></td>
                                </tr>
                                <tr>
                                    <td><span class="badge text-bg-success">GET</span></td>
                                    <td><code>/api/monsters/{id}</code></td>
                                    <td>Monster detail, skills, recommendations, and drops.</td>
                                    <td><code>id</code>, <code>lang</code></td>
                                </tr>
                                <tr>
                                    <td><span class="badge text-bg-success">GET</span></td>
                                    <td><code>/api/items/{id}</code></td>
                                    <td>Item detail and crafting usage.</td>
                                    <td><code>id</code>, <code>lang</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h2 class="h4 mb-3">Reference examples</h2>
                    <pre class="bg-dark text-light rounded-3 p-3 small overflow-auto mb-0"><code>curl "<?= esc($apiBaseUrl) ?>/monsters?search=Poring&amp;limit=5"

curl "<?= esc($apiBaseUrl) ?>/monsters/10001?lang=en"

curl "<?= esc($apiBaseUrl) ?>/items/10403012?lang=en"</code></pre>
                </div>
            </section>

            <section id="swagger-reference" class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-2 mb-3">
                        <div>
                            <h2 class="h4 mb-1">Swagger UI</h2>
                            <p class="text-secondary mb-0">Generated from the same OpenAPI JSON served by ROXPEDIA.</p>
                        </div>
                        <div class="small text-secondary">Use Try it out for the public read-only endpoints.</div>
                    </div>
                    <div id="swagger-ui"></div>
                </div>
            </section>
        </main>

        <?= view('partials/site_footer') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@5/swagger-ui-standalone-preset.js"></script>
    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();

        window.ui = SwaggerUIBundle({
            url: <?= json_encode($openApiUrl) ?>,
            dom_id: '#swagger-ui',
            deepLinking: true,
            docExpansion: 'list',
            defaultModelsExpandDepth: 0,
            defaultModelExpandDepth: 3,
            displayRequestDuration: true,
            filter: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: 'BaseLayout'
        });
    </script>
</body>

</html>
