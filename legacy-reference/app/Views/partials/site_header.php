<?php

$request = service('request');
$path = trim((string) $request->getUri()->getPath(), '/');

$aboutLabel = lang('Home.nav_about');
if ($aboutLabel === 'Home.nav_about') {
    $aboutLabel = 'About';
}

$supportLabel = lang('Home.nav_support');
if ($supportLabel === 'Home.nav_support') {
    $supportLabel = 'Support';
}

$navItems = [
    [
        'href' => site_url('aboutus'),
        'label' => $aboutLabel,
        'active' => $path === 'aboutus',
    ],
    [
        'href' => site_url('documentation'),
        'label' => 'Documentation',
        'active' => $path === 'documentation',
    ],
    [
        'href' => 'https://sociabuzz.com/cherubim/support',
        'label' => $supportLabel,
        'active' => false,
    ],
];
?>
<header class="mb-4">
    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 border-bottom pb-3">
        <a href="<?= site_url('') ?>" class="d-inline-flex align-items-center text-decoration-none text-body-emphasis">
            <img src="<?= base_url('assets/logo.png') ?>" alt="ROXPEDIA Logo" height="32" class="me-2">
        </a>
        <ul class="nav small flex-wrap justify-content-start justify-content-lg-end gap-2">
            <?php foreach ($navItems as $item): ?>
                <?php
                $linkClass = 'nav-link px-0 px-lg-2 text-body-secondary';
                if ($item['active']) {
                    $linkClass .= ' active fw-semibold text-body-emphasis';
                }
                ?>
                <li class="nav-item">
                    <a class="<?= esc($linkClass) ?>" href="<?= esc($item['href']) ?>"><?= esc($item['label']) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</header>
