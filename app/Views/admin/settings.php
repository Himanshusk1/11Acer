<?php
$page_title = 'Admin Settings - 36 Broking Hub';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <style>
    :root {
      --admin-primary: #198754;
      --admin-primary-dark: #0f5132;
      --admin-primary-soft: rgba(25, 135, 84, 0.08);
      --admin-primary-light: #e6fae6;
      --surface-base: #f6f8f5;
      --surface-card: #ffffff;
      --surface-dark: #111618;
      --border-subtle: #dfe6df;
      --text-muted: #6c757d;
      --shadow-soft: 0 20px 50px rgba(13, 27, 19, 0.1);
    }

    * { box-sizing: border-box; }

    body {
      min-height: 100vh;
      font-family: 'Inter', sans-serif;
      background: var(--surface-base);
      color: #101828;
      overflow-x: hidden;
    }

    body.dark-mode {
      background: var(--surface-dark);
      color: #e8f1ec;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      width: 260px;
      background: rgba(17, 26, 21, 0.92);
      backdrop-filter: blur(18px);
      color: #f0fff6;
      padding: 2rem 1.5rem;
      transition: all 0.3s ease;
      z-index: 1030;
      box-shadow: 10px 0 30px rgba(8, 12, 10, 0.4);
    }

    .sidebar-header {
      font-size: 1.5rem;
      font-weight: 700;
      color: #fff;
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .sidebar-header span { color: var(--admin-primary); }

    .sidebar .nav h6 {
      color: rgba(255, 255, 255, 0.55);
      letter-spacing: 0.08em;
      font-size: 0.7rem;
      text-transform: uppercase;
      margin: 1.25rem 0 0.6rem;
    }

    .sidebar .nav-link {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      color: #adb5bd;
      border-radius: 8px;
      margin-bottom: 0.5rem;
      transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s;
    }

    .sidebar .nav-link .icon { font-size: 1.1rem; }

    .sidebar .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.08);
      color: #fff;
      transform: translateX(6px);
    }

    .sidebar .nav-link.active {
      background-color: var(--admin-primary);
      color: #fff;
      font-weight: 600;
      box-shadow: 0 12px 25px rgba(25, 135, 84, 0.35);
    }

    .topbar {
      position: fixed;
      top: 0;
      left: 260px;
      right: 0;
      height: 70px;
      background-color: #fff;
      border-bottom: 1px solid rgba(25, 135, 84, 0.08);
      padding: 0 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      z-index: 1020;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(15, 28, 22, 0.08);
    }

    .topbar .navbar-toggler {
      display: none;
      border: 0;
      background: transparent;
      color: #0f172a;
    }

    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .icon-btn {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      border: 1px solid rgba(25, 135, 84, 0.25);
      background: #fff;
      color: var(--admin-primary);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }

    .icon-btn:hover {
      background: var(--admin-primary);
      color: #fff;
      box-shadow: 0 12px 20px rgba(25, 135, 84, 0.3);
    }

    .backdrop {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1025;
    }

    body.dark-mode .sidebar,
    body.dark-mode .topbar {
      background: rgba(20, 26, 24, 0.92);
      color: inherit;
      border-color: rgba(255, 255, 255, 0.08);
    }

    body.dark-mode .icon-btn {
      background: rgba(255, 255, 255, 0.08);
      border-color: rgba(255, 255, 255, 0.1);
      color: #f6fbf7;
    }

    body.dark-mode .icon-btn:hover {
      background: var(--admin-primary);
      color: #fff;
    }

    body.dark-mode .nav-link,
    body.dark-mode .nav h6 { color: rgba(255, 255, 255, 0.75); }

    body.dark-mode .nav-link.active { color: #fff; }

    body.dark-mode .settings-card,
    body.dark-mode .system-card,
    body.dark-mode .alert,
    body.dark-mode .collapsible-card {
      background: rgba(20, 26, 24, 0.95);
      color: inherit;
      border-color: rgba(255, 255, 255, 0.08);
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35);
    }

    a { text-decoration: none; }

    .main-content {
      margin-left: 260px;
      margin-top: 70px;
      padding: 2.5rem 3rem 3rem;
      min-height: 100vh;
    }

    .page-header {
      background: var(--surface-card);
      border-radius: 22px;
      padding: 2rem;
      border: 1px solid var(--border-subtle);
      box-shadow: var(--shadow-soft);
      margin-bottom: 2rem;
    }

    body.dark-mode .page-header {
      background: rgba(20, 26, 24, 0.92);
    }

    .settings-card,
    .system-card {
      background: var(--surface-card);
      border-radius: 22px;
      border: 1px solid rgba(16, 24, 40, 0.08);
      box-shadow: var(--shadow-soft);
      padding: 1.75rem;
      position: relative;
      overflow: hidden;
    }

    .settings-card::after {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at top right, rgba(25, 135, 84, 0.12), transparent 55%);
      pointer-events: none;
    }

    .settings-card > * { position: relative; z-index: 2; }

    .section-title {
      font-weight: 700;
      font-size: 1.2rem;
    }

    .form-control,
    .form-select {
      border-radius: 14px;
      border: 1px solid rgba(16, 24, 40, 0.08);
      padding: 0.65rem 0.95rem;
      background-color: #fff;
      box-shadow: inset 0 1px 2px rgba(16, 24, 40, 0.06);
    }

    body.dark-mode .form-control,
    body.dark-mode .form-select {
      background: rgba(255, 255, 255, 0.04);
      color: #f8f9fa;
      border-color: rgba(255, 255, 255, 0.12);
    }

    .avatar-preview {
      width: 110px;
      height: 110px;
      border-radius: 18px;
      object-fit: cover;
      border: 3px solid rgba(25, 135, 84, 0.25);
      box-shadow: 0 15px 30px rgba(25, 135, 84, 0.18);
    }

    .form-switch .form-check-input {
      width: 3rem;
      height: 1.5rem;
      border-radius: 999px;
    }

    .form-switch .form-check-input:checked {
      background-color: var(--admin-primary);
      border-color: var(--admin-primary);
    }

    .badge-soft {
      background: var(--admin-primary-soft);
      color: var(--admin-primary);
      border-radius: 999px;
      padding: 0.2rem 0.75rem;
      font-weight: 600;
    }

    .collapsible-trigger {
      border: 0;
      background: transparent;
      color: var(--text-muted);
    }

    .system-info-list li {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.4rem 0;
      border-bottom: 1px dashed rgba(16, 24, 40, 0.08);
      font-size: 0.95rem;
    }

    .system-info-list li:last-child { border-bottom: 0; }

    .progress {
      height: 0.65rem;
      border-radius: 999px;
    }

    .alert {
      border-radius: 18px;
      border: 0;
      padding: 1rem 1.25rem;
    }

    @media (max-width: 991.98px) {
      .sidebar { left: -260px; }
      .sidebar.active { left: 0; }
      .main-content {
        margin-left: 0;
        padding: 1.75rem 1.5rem 2.5rem;
      }
      .topbar {
        left: 0;
        padding: 0 1.25rem;
      }
      .topbar .navbar-toggler { display: block; }
      .topbar-actions { gap: 0.5rem; }
      .icon-btn { width: 36px; height: 36px; }
    }

    @media (max-width: 575.98px) {
      .settings-card,
      .system-card,
      .page-header {
        padding: 1.25rem;
      }
      .topbar { height: 64px; }
    }

    /* Layout overflow overrides */
    .main-content {
      width: 100% !important;
      max-width: 100% !important;
      overflow-x: hidden !important;
    }

    .settings-card,
    .system-card,
    .page-header {
      width: 100% !important;
      max-width: 100% !important;
      overflow-x: hidden !important;
    }

    .row {
      margin-right: 0 !important;
    }

    .col-xl-5,
    .col-xl-7 {
      max-width: 100% !important;
      overflow: hidden !important;
    }

    @media (min-width: 992px) {
      body.sidebar-fixed .main-content {
        margin-left: 260px;
        width: calc(100vw - 260px) !important;
        max-width: calc(100vw - 260px) !important;
      }
    }

    @media (max-width: 991.98px) {
      body.sidebar-fixed .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body class="admin-settings-page sidebar-fixed">
  <?php
    $defaultAvatar = base_url('images/36_profile.png');
    $profile = $profileSettings ?? [
      'name'  => 'Admin User',
      'email' => 'admin@example.com',
      'phone' => '+91 00000 00000',
      'photo' => $defaultAvatar,
    ];
    $appSettings = $appSettings ?? ['dark_mode' => false, 'email_notifications' => true, 'maintenance_mode' => false];
    $security = $security ?? ['last_login' => date('d M Y, h:i A'), 'ip_address' => '127.0.0.1'];
    $systemInfo = $systemInfo ?? [
      'appVersion' => '1.0.0',
      'phpVersion' => PHP_VERSION,
      'mysqlStatus' => ['ok' => true, 'message' => 'Connected'],
      'storageUsage' => ['used' => 0, 'limit' => 1024 * 1024 * 1024, 'percent' => 0],
    ];
    $storageUsedMb = $systemInfo['storageUsage']['used'] / (1024 * 1024);
    $storageLimitMb = $systemInfo['storageUsage']['limit'] / (1024 * 1024);
    $successMessage = session('settings_success');
    $errorBag = session('settings_errors');
  ?>
  <?= view('admin/partials/sidebar', ['active' => 'settings']) ?>
  <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => $userRole ?? 'Platform Admin']) ?>

  <main class="main-content" id="main-content">
    <section class="page-header" data-aos="fade-up">
      <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start gap-3">
        <div>
          <p class="badge-soft mb-3">Control Center</p>
          <h1 class="h3 mb-2">Admin Settings</h1>
          <p class="text-muted mb-0">Manage your profile, platform toggles, and system health checkpoints in one place.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
          <a href="<?= site_url('/admin') ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>Back to dashboard</a>
          <button class="btn btn-success" id="quick-save"><i class="bi bi-cloud-check me-2"></i>Quick save</button>
        </div>
      </div>
    </section>

    <?php if (! empty($successMessage)): ?>
      <div class="alert alert-success d-flex align-items-center gap-3" data-aos="fade-up">
        <i class="bi bi-check-circle-fill fs-4"></i>
        <div>
          <strong>Success:</strong> <?= esc($successMessage) ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if (! empty($errorBag) && is_array($errorBag)): ?>
      <div class="alert alert-danger" data-aos="fade-up">
        <div class="d-flex align-items-center gap-3 mb-2">
          <i class="bi bi-exclamation-triangle-fill fs-4"></i>
          <strong>Update blocked</strong>
        </div>
        <ul class="mb-0 ps-3">
          <?php foreach ($errorBag as $error): ?>
            <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="row g-4">
      <div class="col-12 col-xl-7">
        <div class="settings-card mb-4" data-aos="fade-up">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <p class="text-muted mb-1">Profile Settings</p>
              <h2 class="section-title mb-0">Your admin identity</h2>
            </div>
            <button class="collapsible-trigger d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#profileSettingsCollapse" aria-expanded="true" aria-controls="profileSettingsCollapse">
              <i class="bi bi-chevron-down"></i>
            </button>
          </div>
          <div class="collapse show" id="profileSettingsCollapse">
            <form action="<?= site_url('/admin/settings/profile') ?>" method="post" enctype="multipart/form-data" class="row g-3" novalidate>
              <?= csrf_field() ?>
              <div class="col-12 d-flex align-items-center gap-3 flex-wrap">
                <img src="<?= esc($profile['photo']) ?>" alt="Admin avatar" class="avatar-preview" id="profile-photo-preview">
                <div>
                  <label class="form-label fw-semibold">Change profile photo</label>
                  <input type="file" class="form-control" name="profile_photo" id="profile-photo-input" accept="image/png,image/jpeg">
                  <small class="text-muted">PNG or JPG up to 2 MB.</small>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Admin name</label>
                <input type="text" class="form-control" name="name" value="<?= old('name', $profile['name']) ?>" placeholder="Enter full name" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= old('email', $profile['email']) ?>" placeholder="name@company.com" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?= old('phone', $profile['phone']) ?>" placeholder="+91 90000 00000" required>
              </div>
              <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4"><i class="bi bi-save me-2"></i>Save changes</button>
              </div>
            </form>
          </div>
        </div>

        <div class="settings-card" data-aos="fade-up" data-aos-delay="80">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <p class="text-muted mb-1">Security</p>
              <h2 class="section-title mb-0">Session & device safety</h2>
            </div>
            <button class="collapsible-trigger d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#securitySettingsCollapse" aria-expanded="true" aria-controls="securitySettingsCollapse">
              <i class="bi bi-chevron-down"></i>
            </button>
          </div>
          <div class="collapse show" id="securitySettingsCollapse">
            <div class="row g-3">
              <div class="col-md-6">
                <div class="border rounded-4 p-3 h-100">
                  <p class="text-muted mb-1">Last login</p>
                  <h5 class="mb-0"><?= esc($security['last_login']) ?></h5>
                </div>
              </div>
              <div class="col-md-6">
                <div class="border rounded-4 p-3 h-100">
                  <p class="text-muted mb-1">Session IP address</p>
                  <h5 class="mb-0"><?= esc($security['ip_address']) ?></h5>
                </div>
              </div>
              <div class="col-12">
                <div class="d-flex flex-wrap gap-2">
                  <a href="<?= site_url('api/auth/logout') ?>" class="btn btn-outline-danger flex-grow-1"><i class="bi bi-box-arrow-right me-2"></i>Logout from all devices</a>
                  <a href="<?= site_url('/admin') ?>" class="btn btn-outline-secondary flex-grow-1"><i class="bi bi-shield-lock me-2"></i>Review access logs</a>
                </div>
              </div>
              <div class="col-12">
                <div class="alert alert-warning mb-0">
                  <strong>Heads up:</strong> Changing security preferences immediately invalidates active sessions.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-5">
        <div class="settings-card mb-4" data-aos="fade-up" data-aos-delay="60">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <p class="text-muted mb-1">Application</p>
              <h2 class="section-title mb-0">Platform preferences</h2>
            </div>
            <button class="collapsible-trigger d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#appSettingsCollapse" aria-expanded="true" aria-controls="appSettingsCollapse">
              <i class="bi bi-chevron-down"></i>
            </button>
          </div>
          <div class="collapse show" id="appSettingsCollapse">
            <form action="<?= site_url('/admin/settings/app') ?>" method="post" class="d-flex flex-column gap-3" novalidate>
              <?= csrf_field() ?>
              <div class="form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="settings-dark-mode" name="dark_mode" <?= old('dark_mode', $appSettings['dark_mode']) ? 'checked' : '' ?>>
                <label class="form-check-label ms-2" for="settings-dark-mode">
                  <span class="fw-semibold">Enable dark mode</span>
                  <small class="d-block text-muted">Synchronizes with the live admin theme toggle.</small>
                </label>
              </div>
              <div class="form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="settings-email-notifications" name="email_notifications" <?= old('email_notifications', $appSettings['email_notifications']) ? 'checked' : '' ?>>
                <label class="form-check-label ms-2" for="settings-email-notifications">
                  <span class="fw-semibold">Enable email notifications</span>
                  <small class="d-block text-muted">Send product and moderation alerts to your inbox.</small>
                </label>
              </div>
              <div class="form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="settings-maintenance" name="maintenance_mode" <?= old('maintenance_mode', $appSettings['maintenance_mode']) ? 'checked' : '' ?>>
                <label class="form-check-label ms-2" for="settings-maintenance">
                  <span class="fw-semibold">Maintenance mode</span>
                  <small class="d-block text-muted">Temporarily pause public access and show a holding screen.</small>
                </label>
              </div>
              <div class="d-flex justify-content-end pt-2">
                <button type="submit" class="btn btn-success px-4"><i class="bi bi-toggle-on me-2"></i>Save settings</button>
              </div>
            </form>
          </div>
        </div>

        <div class="system-card" data-aos="fade-up" data-aos-delay="120">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <p class="text-muted mb-1">System info</p>
              <h2 class="section-title mb-0">Environment health</h2>
            </div>
            <span class="badge-soft"><i class="bi bi-cpu me-1"></i>Live</span>
          </div>
          <ul class="system-info-list list-unstyled mb-0">
            <li><span>App version</span><span class="fw-semibold"><?= esc($systemInfo['appVersion']) ?></span></li>
            <li><span>PHP version</span><span class="fw-semibold"><?= esc($systemInfo['phpVersion']) ?></span></li>
            <li>
              <span>MySQL status</span>
              <span class="fw-semibold text-<?= $systemInfo['mysqlStatus']['ok'] ? 'success' : 'danger' ?>">
                <?= esc($systemInfo['mysqlStatus']['message']) ?>
              </span>
            </li>
            <li class="flex-column align-items-start">
              <div class="d-flex justify-content-between w-100">
                <span>Storage usage</span>
                <span class="fw-semibold"><?= number_format($storageUsedMb, 1) ?> / <?= number_format($storageLimitMb, 0) ?> MB</span>
              </div>
              <div class="progress mt-2">
                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $systemInfo['storageUsage']['percent'] ?>%" aria-valuenow="<?= $systemInfo['storageUsage']['percent'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </li>
          </ul>
          <div class="alert alert-info mt-3 mb-0">
            <i class="bi bi-info-circle me-2"></i>
            Need more capacity? Contact support to upgrade the storage tier.
          </div>
        </div>
      </div>
    </div>
  </main>

  <div id="sidebar-backdrop" class="backdrop d-none"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const photoInput = document.getElementById('profile-photo-input');
      const photoPreview = document.getElementById('profile-photo-preview');
      const darkModeToggle = document.getElementById('settings-dark-mode');
      const quickSaveButton = document.getElementById('quick-save');
      const THEME_KEY = 'adminTheme';

      if (photoInput) {
        photoInput.addEventListener('change', function(event) {
          const file = event.target.files[0];
          if (!file) return;
          const reader = new FileReader();
          reader.onload = function(e) { photoPreview.src = e.target.result; };
          reader.readAsDataURL(file);
        });
      }

      const applyTheme = (mode) => {
        const next = mode === 'dark' ? 'dark' : 'light';
        document.body.classList.toggle('dark-mode', next === 'dark');
        localStorage.setItem(THEME_KEY, next);
      };

      const savedTheme = localStorage.getItem(THEME_KEY);
      if (savedTheme) {
        applyTheme(savedTheme);
        if (darkModeToggle) {
          darkModeToggle.checked = savedTheme === 'dark';
        }
      }

      if (darkModeToggle) {
        darkModeToggle.addEventListener('change', function() {
          applyTheme(this.checked ? 'dark' : 'light');
        });
        if (darkModeToggle.checked) {
          applyTheme('dark');
        }
      }

      if (quickSaveButton) {
        quickSaveButton.addEventListener('click', function() {
          const form = document.querySelector('#appSettingsCollapse form');
          if (form) {
            form.requestSubmit();
          }
        });
      }

      const sidebar = document.getElementById('admin-sidebar');
      const toggler = document.getElementById('sidebar-toggler');
      const backdrop = document.getElementById('sidebar-backdrop');
      const darkToggle = document.getElementById('dark-mode-toggle');

      const toggleSidebar = () => {
        sidebar.classList.toggle('active');
        backdrop.classList.toggle('d-none');
      };

      if (toggler) { toggler.addEventListener('click', toggleSidebar); }
      if (backdrop) { backdrop.addEventListener('click', toggleSidebar); }

      if (darkToggle) {
        darkToggle.addEventListener('click', function() {
          const next = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
          applyTheme(next);
        });
      }

      if (window.AOS) {
        AOS.init({ duration: 650, once: true, offset: 80, easing: 'ease-out-quart' });
      }
    });
  </script>
</body>
</html>
