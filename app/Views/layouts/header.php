<link rel="stylesheet" href="<?= base_url('CSS/header.css') ?>">

<style>
    .navbar .nav-link {
    font-weight: 500;
    color: #333;
    padding: 0.5rem 0.75rem;
}

.navbar .nav-link.active {
    color: #0d6efd;
}

.navbar .nav-link:hover {
    color: #0d6efd;
}

.navbar-brand img {
    max-height: 42px;
}

.page-loader {
    position: fixed;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    z-index: 2000;
    transition: opacity 0.4s ease, visibility 0.4s ease;
}

.page-loader.is-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

.page-loader__content {
    width: min(320px, 80%);
    text-align: center;
}

.page-loader__logo {
    width: 120px;
    margin: 0 auto 16px;
    display: block;
}

.page-loader__bar {
    height: 6px;
    border-radius: 999px;
    background: rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 14px;
}

.page-loader__progress {
    height: 100%;
    width: 0;
    background: linear-gradient(90deg, #00c950, #00a63e);
    transition: width 0.2s ease-out;
}

.page-loader__percent {
    font-weight: 600;
    font-size: 1.125rem;
    color: #212529;
}

</style>

<div id="pageLoader" class="page-loader">
    <div class="page-loader__content">
        <img class="page-loader__logo" src="<?= base_url('images/PNG.png') ?>" alt="11 Acre Logo" loading="lazy">
        <div class="page-loader__bar">
            <div class="page-loader__progress" data-loader-bar></div>
        </div>
        <div class="page-loader__percent" data-loader-percent>0%</div>
    </div>
</div>

<nav class="navbar navbar-expand-lg sticky-top bg-white border-bottom" style="linear-gradient(135deg, #00C950, #00A63E) !important;}">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="<?= base_url('images/PNG.png') ?>" height="42" alt="11 Acre Logo">
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler shadow-none border-0"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#   Navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="mainNavbar">
            <div class="offcanvas-header border-bottom">
                <h5 class="fw-semibold mb-0">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column flex-lg-row align-items-lg-center">

                <!-- Center Menu -->
                <ul class="navbar-nav mx-lg-auto gap-lg-3 text-center text-lg-start">

                    <li class="nav-item">
                        <a class="nav-link <?= ($active_page ?? '')=='buyers'?'active':'' ?>" href="<?= site_url('properties') ?>">Buyers</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($active_page ?? '')=='tenants'?'active':'' ?>" href="<?= site_url('tenants') ?>">Tenants</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($active_page ?? '')=='owner'?'active':'' ?>" href="<?= site_url('owner-builder') ?>">Owner / Builder</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($active_page ?? '')=='agents'?'active':'' ?>" href="<?= site_url('agents-broker') ?>">Agents / Broker</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('about') ?>">Construction</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('insights') ?>">Insights</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('contact') ?>">Contact</a>
                    </li>
                </ul>

                <!-- Right Action -->
                <div class="mt-4 mt-lg-0 ms-lg-3 text-center text-lg-end">

                    <?php if (session()->get('isLoggedIn')): ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-dark rounded-pill px-4 dropdown-toggle"
                                    data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                <?= session()->get('full_name') ?: 'User' ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item" href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= site_url('api/auth/logout') ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="#" class="btn btn-success px-4"
                           data-bs-toggle="modal"
                           data-bs-target="#loginModal">
                            Login / Register
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Scripts for AOS and SweetAlert (Preserved from your code) -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url('js/header.js') ?>" defer></script>