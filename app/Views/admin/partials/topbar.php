<?php
$session = session();
$profileSettings = $session->get('admin_profile_settings') ?? [];

$showDarkToggle = $showDarkToggle ?? false;
$defaultAvatar = base_url('images/36_profile.png');

$resolvedName = isset($userName) ? trim((string) $userName) : '';
if ($resolvedName === '') {
    $resolvedName = trim((string) ($profileSettings['name'] ?? $session->get('full_name') ?? 'Admin User'));
}
$userName = $resolvedName;

$resolvedRole = isset($userRole) ? trim((string) $userRole) : '';
if ($resolvedRole === '') {
    $resolvedRole = (string) ($profileSettings['role'] ?? $session->get('role') ?? 'Super Admin');
}
$roleForDisplay = str_replace(['_', '-'], ' ', $resolvedRole);
if ($roleForDisplay === strtolower($roleForDisplay)) {
    $userRole = ucwords($roleForDisplay);
} else {
    $userRole = $roleForDisplay;
}

    $avatarUrl = $profileSettings['photo'] ?? $session->get('admin_profile_photo') ?? $defaultAvatar;
echo view('admin/partials/layout-styles');
?>
<header class="topbar topbar-align-right">
    <div class="topbar-inner">
        <button class="navbar-toggler" type="button" id="sidebar-toggler">
            <i class="bi bi-list fs-2"></i>
        </button>
        <div class="topbar-actions">
            <a class="btn btn-outline-success d-none d-md-inline-flex align-items-center gap-2" href="<?= site_url('/') ?>">
                <i class="bi bi-house-door"></i>
                <span>Back to main page</span>
            </a>
            <a class="icon-btn d-inline-flex d-md-none" href="<?= site_url('/') ?>" title="Back to main site">
                <i class="bi bi-house-door"></i>
            </a>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= esc($avatarUrl) ?>" alt="Admin" width="32" height="32" class="rounded-circle me-2">
                    <div class="d-flex flex-column text-start">
                        <strong><?= esc($userName) ?></strong>
                        <small class="text-muted"><?= esc($userRole) ?></small>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small shadow">
                    <li><a class="dropdown-item" href="<?= site_url('/admin/settings?tab=profile') ?>">Profile</a></li>
                    <li><a class="dropdown-item" href="<?= site_url('/admin/settings') ?>">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="<?= site_url('api/auth/logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
