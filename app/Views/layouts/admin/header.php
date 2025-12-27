<?php
$activePage = $active_page ?? '';
$layoutVariant = $layoutVariant ?? 'default';
$defaultAvatar = base_url('images/36_profile.png');
?>

<nav class="sidebar" id="admin-sidebar">
    <h3 class="sidebar-header">36Broking<span>.</span></h3>
    <?php if ($layoutVariant === 'properties'): ?>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link<?= $activePage === 'admin' ? ' active' : '' ?>" href="<?= site_url('/admin') ?>">
                    <i class="bi bi-grid-fill icon"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= $activePage === 'admin' ? ' active' : '' ?>" href="<?= site_url('/admin') ?>">
                    <i class="bi bi-people-fill icon"></i>User Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= $activePage === 'admin-properties' ? ' active' : '' ?>" href="<?= site_url('/admin/properties') ?>">
                    <i class="bi bi-building-fill icon"></i>Property Listings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= $activePage === 'admin-payments' ? ' active' : '' ?>" href="<?= site_url('/admin/payments') ?>">
                    <i class="bi bi-currency-dollar icon"></i>Payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-gear-fill icon"></i>Settings
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link" href="#">
                    <i class="bi bi-box-arrow-left icon"></i>Logout
                </a>
            </li>
        </ul>
    <?php else: ?>
        <ul class="nav flex-column">
            <h6>Overview</h6>
            <li class="nav-item"><a class="nav-link<?= $activePage === 'admin' ? ' active' : '' ?>" href="<?= site_url('/admin') ?>"><i class="bi bi-grid-fill icon"></i> Dashboard</a></li>
            <h6>Management</h6>
            <li class="nav-item"><a class="nav-link<?= $activePage === 'admin' ? ' active' : '' ?>" href="<?= site_url('/admin') ?>"><i class="bi bi-people-fill icon"></i> User Management</a></li>
            <li class="nav-item"><a class="nav-link<?= $activePage === 'admin-properties' ? ' active' : '' ?>" href="<?= site_url('/admin/properties') ?>"><i class="bi bi-building-fill icon"></i> Property Listings</a></li>
            <h6>Finance</h6>
            <li class="nav-item"><a class="nav-link<?= $activePage === 'admin-payments' ? ' active' : '' ?>" href="<?= site_url('/admin/payments') ?>"><i class="bi bi-currency-dollar icon"></i> Payments</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-gear-fill icon"></i> Settings</a></li>
            <li class="nav-item mt-auto"><a class="nav-link" href="#"><i class="bi bi-box-arrow-left icon"></i> Logout</a></li>
        </ul>
    <?php endif; ?>
</nav>

<?php if ($layoutVariant === 'properties'): ?>
<header class="topbar">
    <button class="navbar-toggler" type="button" id="sidebar-toggler"><i class="bi bi-list fs-2"></i></button>
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-ghost btn-sm d-none d-md-inline-flex align-items-center gap-2"><i class="bi bi-bell"></i>Alerts</button>
        <div class="dropdown">
            <a href="#" class="profile-chip dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= esc($defaultAvatar) ?>" alt="Admin" width="32" height="32" class="rounded-circle">
                <div class="text-start">
                    <div class="fw-semibold">Admin User</div>
                    <small class="text-muted">Super Admin</small>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
<?php else: ?>
<header class="topbar">
    <button class="navbar-toggler" type="button" id="sidebar-toggler"><i class="bi bi-list fs-2"></i></button>
    <div class="topbar-actions">
        <button class="icon-btn" id="dark-mode-toggle" title="Toggle dark mode"><i class="bi bi-moon-stars"></i></button>
        <button class="icon-btn" title="Notifications"><i class="bi bi-bell"></i></button>
        <button class="icon-btn" title="Settings"><i class="bi bi-sliders"></i></button>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= esc($defaultAvatar) ?>" alt="Admin" width="32" height="32" class="rounded-circle me-2">
                <strong>Admin User</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
<?php endif; ?>
