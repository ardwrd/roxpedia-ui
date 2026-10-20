<?php

$footerRights = lang('Home.footer_rights');
if ($footerRights === 'Home.footer_rights') {
    $footerRights = 'Created by <strong>ROXPEDIA Team</strong> All rights reserved.';
}

$footerCopyright = lang('Home.footer_copyright');
if ($footerCopyright === 'Home.footer_copyright') {
    $footerCopyright = 'Ragnarok X: Next Generation related images and contents are copyrighted by Gravity Co. and Lee MyoungJin (Studio DDTS).';
}
?>
<footer class="pt-4 mt-4 text-body-secondary border-top">
    <p class="mb-0">&copy; <span id="current-year"></span> <?= $footerRights ?><br><?= esc($footerCopyright) ?></p>
</footer>
<script>
    (function() {
        var yearElement = document.getElementById('current-year');
        if (yearElement) {
            yearElement.textContent = new Date().getFullYear();
        }
    })();
</script>
