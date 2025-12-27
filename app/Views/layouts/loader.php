<?php
$loaderId = isset($loaderId) && is_string($loaderId) ? trim($loaderId) : 'loader-overlay';
$loaderMinDuration = isset($loaderMinDuration) && is_numeric($loaderMinDuration) ? (int) $loaderMinDuration : 1000;
$defaultLogo = base_url('images/logo.jpg');
$loaderLogo = isset($loaderLogo) && is_string($loaderLogo) && trim($loaderLogo) !== '' ? trim($loaderLogo) : $defaultLogo;
$loaderMessage = isset($loaderMessage) && is_string($loaderMessage) && trim($loaderMessage) !== '' ? trim($loaderMessage) : 'Loading...';
?>
<style>
    #<?= esc($loaderId) ?> {
        position: fixed;
        inset: 0;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        z-index: 1050;
        transition: opacity 0.4s ease;
    }

    #<?= esc($loaderId) ?>.fade-out {
        opacity: 0;
        pointer-events: none;
    }

    #<?= esc($loaderId) ?> .loader-spinner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
    }
</style>
<div id="<?= esc($loaderId) ?>">
    <div class="loader-spinner">
        <img src="<?= esc($loaderLogo) ?>" alt="Logo" height="60">
        <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">11 Acer Loading...</span>
        </div>
        <div class="mt-2 text-success fw-bold"><?= esc($loaderMessage) ?></div>
    </div>
</div>
<script>
(function() {
    const overlayId = <?= json_encode($loaderId) ?>;
    const minDuration = <?= json_encode($loaderMinDuration) ?>;
    document.addEventListener('DOMContentLoaded', function () {
        const overlay = document.getElementById(overlayId);
        if (!overlay) {
            return;
        }
        const start = Date.now();
        window.addEventListener('load', function () {
            const elapsed = Date.now() - start;
            const remaining = minDuration - elapsed;
            setTimeout(function () {
                overlay.classList.add('fade-out');
                setTimeout(function () {
                    overlay.style.display = 'none';
                }, 500);
            }, remaining > 0 ? remaining : 0);
        });
    });
})();
</script>
