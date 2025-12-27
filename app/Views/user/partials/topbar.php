<header class="topbar" id="user-topbar">
    <div class="topbar-inner">
        <button class="navbar-toggler" type="button" id="sidebar-toggler"><i class="bi bi-list"></i></button>
        <div class="topbar-meta">
            <p class="text-uppercase text-muted small mb-0">Member Control Center</p>
            <h1 class="h5 mb-0">Dashboard Overview</h1>
        </div>
        <div class="topbar-actions">
            <button class="btn btn-outline-secondary d-inline-flex align-items-center gap-2" id="dashboard-back-btn">
                <i class="bi bi-arrow-left"></i> Back
            </button>
            <a href="<?= site_url('post-your-property') ?>" class="btn btn-outline-success d-none d-md-inline-flex align-items-center gap-2"><i class="bi bi-lightning-charge"></i> Post Now</a>
            <div class="dropdown topbar-user">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width:36px;height:36px;">
                        <?= esc(substr($initials,0,1)) ?>
                    </div>
                    <div class="ms-2 d-none d-sm-flex flex-column text-start">
                        <strong><?= esc($userFullName) ?></strong>
                        <small class="text-muted"><?= esc($userRole) ?></small>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="#section-account" data-target="section-account">Profile</a></li>
                    <li><a class="dropdown-item" href="#section-payments" data-target="section-payments">Billing</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="<?= site_url('api/auth/logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
