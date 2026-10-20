<!doctype html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Cherubim">
    <meta name="description" content="<?= lang('About.meta_description') ?>">
    <meta name="keywords" content="<?= lang('About.meta_keywords') ?>">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">

    <!-- OpenGraph / Social Media -->
    <meta property="og:title" content="<?= lang('About.meta_title') ?>">
    <meta property="og:description" content="<?= lang('About.meta_description') ?>">
    <meta property="og:image" content="<?= base_url('assets/og-image.png') ?>">
    <meta property="og:url" content="<?= site_url('aboutus') ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ROXPEDIA">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= lang('About.meta_title') ?>">
    <meta name="twitter:description" content="<?= lang('About.meta_description') ?>">
    <meta name="twitter:image" content="<?= base_url('assets/og-image.png') ?>">
    <meta name="twitter:site" content="@ROXPEDIA">

    <!-- Canonical & Language -->
    <link rel="canonical" href="<?= site_url('aboutus') ?>">
    <meta http-equiv="content-language" content="<?= service('request')->getLocale() ?>">

    <!-- Favicon & PWA -->
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url('apple-touch-icon.png') ?>">

    <meta name="google-site-verification" content="cxt3123s02hc4oV1vvtBet28W6DuOE-sW34bATAtD-c" />

    <meta name="generator" content="Hugo 0.122.0">
    <title><?= lang('About.meta_title') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="bg-body-tertiary">
    <div class="container py-4">
        <?= view('partials/site_header') ?>

        <main>
            <section class="text-center mb-5">
                <h1><?= lang('About.hero_title') ?></h1>
                <p class="lead"><?= lang('About.hero_lead') ?></p>
            </section>

            <section class="row mb-4">
                <div class="col-lg-12">
                    <p>
                        <?= lang('About.paragraph_1') ?>
                    </p>
                    <p>
                        <?= lang('About.paragraph_2') ?>
                    </p>
                    <p>
                        <?= lang('About.paragraph_3') ?>
                    </p>
                    <p>
                        <?= lang('About.paragraph_4') ?>
                    </p>
                    <p>
                        <?= lang('About.paragraph_5') ?>
                    </p>
                </div>
            </section>

            <!-- Static Thanks List Section -->
            <section class="row mb-4">
                <div class="col-lg-12">
                    <h2><?= lang('About.thanks_title') ?></h2>
                    <p>
                        <?= lang('About.thanks_intro') ?>
                    </p>
                    <ul>
                        <li>
                            <?= lang('About.thanks_1') ?>
                        </li>
                        <li>
                            <?= lang('About.thanks_2') ?>
                        </li>
                        <li>
                            <?= lang('About.thanks_3') ?>
                        </li>
                        <li>
                            <?= lang('About.thanks_4') ?>
                        </li>
                        <li>
                            <?= lang('About.thanks_5') ?>
                        </li>
                    </ul>
                </div>
            </section>
        </main>

        <?= view('partials/site_footer') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>

