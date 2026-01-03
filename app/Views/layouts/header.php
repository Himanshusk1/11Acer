<link rel="stylesheet" href="<?= base_url('CSS/header.css') ?>">

<!-- Navbar Structure -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container-fluid">
        
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="<?= base_url('images/PNG.png') ?>" class="img-fluid" height="45" alt="Logo">
        </a>

        <!-- Mobile Toggler (Triggers Offcanvas) -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas Menu (Side Drawer for Mobile) -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            
            <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <!-- Centered Links -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
                    
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'buyers') ? 'active' : '' ?>" href="<?= site_url('/properties') ?>">
                            Buyers
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'commercial') ? 'active' : '' ?>" href="<?= site_url('commercial') ?>">Tenants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'residential') ? 'active' : '' ?>" href="<?= site_url('residential') ?>">Owner/Builder</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'services') ? 'active' : '' ?>" href="<?= site_url('services') ?>">Agents/Broker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'about') ? 'active' : '' ?>" href="<?= site_url('about') ?>">Construction Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'about') ? 'active' : '' ?>" href="<?= site_url('about') ?>">Insights</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_page) && $active_page == 'contact') ? 'active' : '' ?>" href="<?= site_url('contact') ?>">Contact</a>
                    </li>
                </ul>

                <!-- Right Side Actions -->
                <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-3 mt-3 mt-lg-0" style="white-space: nowrap;">

                    <!-- User / Login -->
                    <?php if (session()->get('isLoggedIn')): ?>
                        <div class="dropdown">
                            <a href="#" class="btn btn-dark dropdown-toggle rounded-pill px-4" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> <?= session()->get('full_name') ?: 'User' ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                                <li><a class="dropdown-item" href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= site_url('api/auth/logout') ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">
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