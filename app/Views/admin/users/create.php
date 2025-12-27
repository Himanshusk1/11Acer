<?php
$page_title = $page_title ?? 'Add User';
$roles = $roles ?? ['buyer', 'agent', 'builder', 'individual', 'admin'];
$errors = session('errors') ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <style>
        :root {
            --admin-primary: #198754;
            --admin-primary-dark: #0f5132;
            --admin-primary-light: #e6fae6;
            --admin-bg: #f5f8f6;
            --card-shadow: 0 25px 60px rgba(13, 27, 19, 0.09);
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-bg);
            color: #1c2a21;
            min-height: 100vh;
        }
        body.dark-mode {
            background-color: #111618;
            color: #e8f1ec;
        }
        body.dark-mode .sidebar,
        body.dark-mode .form-card {
            background: rgba(20, 26, 24, 0.92);
            color: #e8f1ec;
            border-color: rgba(255, 255, 255, 0.08);
        }
        body.dark-mode .nav-link {
            color: #cdd8d2;
        }
        body.dark-mode .nav-link.active {
            color: #fff;
        }
        body.dark-mode .form-card .form-label {
            color: #e8f1ec;
        }
        body.dark-mode .form-card .form-control,
        body.dark-mode .form-card .form-select {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.12);
            color: #e8f1ec;
        }
        body.dark-mode .form-card .form-control::placeholder {
            color: rgba(232, 241, 236, 0.7);
        }
        .sidebar {
            background: rgba(17, 26, 21, 0.92);
            backdrop-filter: blur(18px);
            color: #f0fff6;
            padding: 2rem 1.5rem;
            box-shadow: 10px 0 30px rgba(8, 12, 10, 0.4);
        }
        .sidebar-header {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .sidebar-header span {
            color: var(--admin-primary);
        }
        .nav h6 {
            color: rgba(255, 255, 255, 0.55);
            letter-spacing: 0.08em;
            font-size: 0.7rem;
            text-transform: uppercase;
            margin: 1.25rem 0 0.6rem;
        }
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #adb5bd;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s;
        }
        .nav-link .icon {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: #fff;
            transform: translateX(6px);
        }
        .nav-link.active {
            background-color: var(--admin-primary);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 12px 25px rgba(25, 135, 84, 0.35);
        }
        .main-content {
            margin-left: 260px;
            padding: 2.5rem 2.5rem 3rem;
        }
        .form-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid rgba(25, 135, 84, 0.08);
            box-shadow: var(--card-shadow);
            padding: 2rem;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.6rem 0.85rem;
        }
        .form-label {
            font-weight: 600;
            color: #1c2a21;
        }
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
                padding: 1.75rem 1.5rem 2.5rem;
            }
        }
    </style>
</head>
<body>
    <?= view('admin/partials/sidebar', ['active' => 'users']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Control Center']) ?>

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <p class="text-uppercase text-muted small mb-1">Control center</p>
                <h1 class="h4 mb-0">Add User</h1>
            </div>
            <a href="<?= site_url('admin') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to dashboard
            </a>
        </div>

        <div class="form-card">
            <?php if (! empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <strong>We could not save the user.</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($errors as $message): ?>
                            <li><?= esc($message) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('admin/users') ?>" class="row g-4">
                <?= csrf_field() ?>
                <div class="col-md-6">
                    <label for="full_name" class="form-label">Full name</label>
                    <input type="text" name="full_name" id="full_name" value="<?= esc(old('full_name')) ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Choose role</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= esc($role) ?>" <?= old('role') === $role ? 'selected' : '' ?>><?= esc(ucfirst($role)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="<?= esc(old('email')) ?>" class="form-control" placeholder="example@domain.com">
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Phone</label>
                    <input type="text" name="phone_number" id="phone_number" value="<?= esc(old('phone_number')) ?>" class="form-control" placeholder="Include country code if needed">
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" id="city" value="<?= esc(old('city')) ?>" class="form-control" placeholder="Optional">
                </div>
                <div class="col-12">
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-2"></i>Save user
                        </button>
                        <a href="<?= site_url('admin') ?>" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <div id="sidebar-backdrop" class="backdrop d-none"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('admin-sidebar');
            const toggler = document.getElementById('sidebar-toggler');
            const backdrop = document.getElementById('sidebar-backdrop');
            const darkToggle = document.getElementById('dark-mode-toggle');
            const THEME_KEY = 'adminTheme';
            const savedTheme = localStorage.getItem(THEME_KEY);

            const setTheme = (mode) => {
                const next = mode === 'dark' ? 'dark' : 'light';
                document.body.classList.toggle('dark-mode', next === 'dark');
                localStorage.setItem(THEME_KEY, next);
            };

            setTheme(savedTheme || 'light');

            if (toggler && sidebar) {
                toggler.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    if (backdrop) {
                        backdrop.classList.toggle('d-none');
                        backdrop.classList.toggle('visible');
                    }
                });
            }

            if (backdrop && sidebar) {
                backdrop.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    backdrop.classList.add('d-none');
                    backdrop.classList.remove('visible');
                });
            }

            if (darkToggle) {
                darkToggle.addEventListener('click', function() {
                    const next = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
                    setTheme(next);
                });
            }
        });
    </script>
</body>
</html>
