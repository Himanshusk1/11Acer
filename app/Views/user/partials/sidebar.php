<aside class="sidebar" id="user-sidebar">
    <div class="sidebar-fixed">
        <div class="sidebar-header">36Broking<span>Hub</span></div>
        <div class="sidebar-profile d-flex align-items-center gap-3">
            <div class="sidebar-profile-avatar"><?= esc($initials) ?></div>
            <div>
                <p class="mb-0 fw-semibold"><?= esc($userFullName) ?></p>
                <small class="text-muted text-white-50"><?= esc($userRole) ?></small>
            </div>
        </div>
    </div>

    <div class="sidebar-scroll" data-simplebar>
        <div class="section-label">Workspace</div>
        <ul class="nav flex-column dash-nav">
            <li class="nav-item"><a class="nav-link active" href="#section-account" data-target="section-account"><i class="bi bi-person-lines-fill"></i> Account Center</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('post-your-property') ?>"><i class="bi bi-building-add"></i> Post Property</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-listings" data-target="section-listings"><i class="bi bi-card-list"></i> My Listings</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-messages" data-target="section-messages"><i class="bi bi-chat-dots"></i> Messages</a></li>
            <li class="nav-item"><a class="nav-link" href="#section-payments" data-target="section-payments"><i class="bi bi-credit-card"></i> Payments</a></li>
            <li class="nav-item mt-3"><a class="nav-link" href="<?= site_url('api/auth/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
        <div class="sidebar-cta">
            <p class="mb-2 small text-white-50">Ready to list something new?</p>
            <a href="<?= site_url('post-your-property') ?>" class="btn btn-brand btn-sm">Post Property</a>
        </div>
    </div>
</aside>

<div class="backdrop" id="sidebar-backdrop"></div>
