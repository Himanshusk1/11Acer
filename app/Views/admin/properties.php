<?php
$page_title = 'Property Listings - Admin - 36 Broking Hub';
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
      --admin-primary-soft: rgba(25, 135, 84, 0.08);
      --surface-base: #f6f8f5;
      --surface-card: #ffffff;
      --surface-muted: #ecf3ec;
      --border-subtle: #dfe6df;
      --text-muted: #6c757d;
      --shadow-soft: 0 15px 45px rgba(28, 51, 36, 0.08);
    }

    * { box-sizing: border-box; }

    html, body {
      min-height: 100%;
      background: var(--surface-base);
      font-family: 'Inter', sans-serif;
      color: #101828;
      overflow-x: hidden;
    }

    body.dark-mode {
      background: #111618;
      color: #e8f1ec;
    }

    body.dark-mode .sidebar,
    body.dark-mode .topbar,
    body.dark-mode .page-header,
    body.dark-mode .stat-card,
    body.dark-mode .filter-card,
    body.dark-mode .table-card {
      background: rgba(20, 26, 24, 0.92);
      border-color: rgba(255, 255, 255, 0.08);
      color: inherit;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35);
    }

    body.dark-mode .table-card .table thead,
    body.dark-mode .table-card .table tbody tr {
      background-color: transparent;
    }

    body.dark-mode .table-card .table thead th {
      color: #f5fbf7;
      border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    body.dark-mode .table-card .table tbody td {
      border-color: rgba(255, 255, 255, 0.08);
    }

    body.dark-mode .filter-card .form-control,
    body.dark-mode .filter-card .form-select {
      background: rgba(255, 255, 255, 0.06);
      border-color: rgba(255, 255, 255, 0.08);
      color: #f8f9fa;
    }

    body.dark-mode .topbar {
      background: rgba(15, 19, 18, 0.92);
      border-bottom-color: rgba(255, 255, 255, 0.08);
      color: #f2f7f4;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.45);
    }

    body.dark-mode .topbar .dropdown-toggle,
    body.dark-mode .topbar .dropdown-toggle strong,
    body.dark-mode .topbar .dropdown-toggle small {
      color: #f2f7f4 !important;
    }

    body.dark-mode .icon-btn {
      background: rgba(255, 255, 255, 0.08);
      border-color: rgba(255, 255, 255, 0.1);
      color: #f5fbf7;
    }

    body.dark-mode .icon-btn:hover {
      background: var(--admin-primary);
      color: #fff;
    }

    body.dark-mode .btn-ghost,
    body.dark-mode .btn-soft-secondary {
      background: rgba(255, 255, 255, 0.08);
      color: #e8f1ec;
      border-color: rgba(255, 255, 255, 0.08);
    }

    body.dark-mode .badge-live,
    body.dark-mode .status-badge {
      background: rgba(25, 135, 84, 0.22);
      color: #dfffe9;
    }

    body.dark-mode .table .btn-outline-dark {
      color: #f8fbf9;
      border-color: rgba(255, 255, 255, 0.3);
    }

    body.dark-mode .table .btn-outline-dark:hover {
      background: rgba(255, 255, 255, 0.15);
      color: #0b0f0c;
    }

    body.dark-mode .text-muted {
      color: #c8d5cd !important;
    }

    body:not(.aos-ready) [data-aos] {
      opacity: 1;
      transform: none;
    }

    a { text-decoration: none; }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      width: 260px;
      background: rgba(17, 26, 21, 0.92);
      color: #f0fff6;
      padding: 2rem 1.5rem;
      z-index: 1030;
      box-shadow: 10px 0 30px rgba(8, 12, 10, 0.4);
      backdrop-filter: blur(18px);
      transition: all 0.3s ease;
    }

    .sidebar-header {
      font-size: 1.5rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 2.5rem;
      color: #fff;
    }

    .sidebar-header span { color: var(--admin-primary); }

    .nav h6 {
      color: rgba(255, 255, 255, 0.55);
      letter-spacing: 0.08em;
      font-size: 0.7rem;
      text-transform: uppercase;
      margin: 1.25rem 0 0.6rem;
    }

    .sidebar .nav-link {
      display: flex;
      align-items: center;
      padding: 0.75rem 1rem;
      color: #adb5bd;
      border-radius: 8px;
      margin-bottom: 0.5rem;
      transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s;
    }

    .sidebar .nav-link .icon {
      margin-right: 0.75rem;
      font-size: 1.1rem;
    }

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
      color: var(--admin-primary);
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

    .main-content {
      margin-top: 70px;
      padding: 2.5rem 3rem 3rem;
      min-height: 100vh;
      width: 100%;
      max-width: 100vw;
      position: relative;
      z-index: 1;
      overflow: visible;
    }
    @media (min-width: 992px) {
      .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
      }
    }

    .page-header {
      background: var(--surface-card);
      border-radius: 18px;
      padding: 2rem;
      margin-bottom: 1.75rem;
      border: 1px solid var(--border-subtle);
      box-shadow: var(--shadow-soft);
    }

    .breadcrumb-soft .breadcrumb {
      margin-bottom: 0.5rem;
      background: transparent;
      padding: 0;
    }

    .breadcrumb-soft .breadcrumb-item + .breadcrumb-item::before {
      color: var(--text-muted);
    }

    .breadcrumb-soft a {
      color: var(--text-muted);
    }

    .page-title {
      font-weight: 700;
      font-size: 1.75rem;
    }

    .badge-live {
      background: var(--admin-primary-soft);
      color: var(--admin-primary);
      border-radius: 999px;
      padding: 0.25rem 0.85rem;
      font-weight: 600;
      font-size: 0.85rem;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .btn-soft-primary {
      background: linear-gradient(120deg, var(--admin-primary), #34c38f);
      color: #fff;
      border: none;
      box-shadow: 0 12px 30px rgba(25, 135, 84, 0.2);
    }

    .btn-soft-secondary {
      background: var(--surface-muted);
      color: #1c1f1c;
      border: 1px solid var(--border-subtle);
    }

    .btn-ghost {
      border: 1px solid rgba(16, 24, 40, 0.12);
      background: transparent;
      color: #101828;
    }

    .btn-soft-primary:hover,
    .btn-soft-secondary:hover,
    .btn-ghost:hover {
      transform: translateY(-1px);
      box-shadow: 0 18px 35px rgba(25, 135, 84, 0.15);
    }
    .hero-actions .btn[disabled],
    .table-card .btn[disabled] {
      opacity: 0.65;
      cursor: not-allowed;
      pointer-events: none;
    }

    .stat-card {
      position: relative;
      background: var(--surface-card);
      border-radius: 20px;
      padding: 1.6rem;
      border: 1px solid rgba(16, 24, 40, 0.05);
      box-shadow: var(--shadow-soft);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card::after {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at top right, rgba(25, 135, 84, 0.18), transparent 55%);
      opacity: 0.9;
      pointer-events: none;
    }

    .stat-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 22px 45px rgba(25, 135, 84, 0.18);
    }

    .stat-icon {
      width: 44px;
      height: 44px;
      border-radius: 14px;
      background: var(--admin-primary-soft);
      color: var(--admin-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
    }

    .stat-card h6 {
      font-size: 0.95rem;
      color: var(--text-muted);
      font-weight: 600;
    }

    .stat-value {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.25rem;
    }

    .stat-meta {
      font-size: 0.85rem;
      color: var(--text-muted);
    }

    .filter-card {
      background: var(--surface-card);
      border-radius: 18px;
      padding: 1.5rem;
      border: 1px solid var(--border-subtle);
      box-shadow: var(--shadow-soft);
      margin-bottom: 1.5rem;
      position: relative;
      z-index: 1;
    }

    .filter-actions {
      margin-top: 1rem;
      display: flex;
      justify-content: flex-end;
      flex-wrap: wrap;
      gap: 0.75rem;
    }

    .page-header,
    .stat-card {
      position: relative;
      z-index: 1;
    }

    .filter-bar {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 0.75rem;
    }

    .input-icon {
      position: relative;
    }

    .input-icon .form-control,
    .input-icon .form-select {
      border-radius: 12px;
      border: 1px solid var(--border-subtle);
      padding-left: 2.4rem;
      height: 46px;
      box-shadow: none;
    }

    .input-icon i {
      position: absolute;
      top: 50%;
      left: 0.9rem;
      transform: translateY(-50%);
      color: var(--text-muted);
    }

    .table-card {
      background: linear-gradient(180deg, var(--surface-card) 0%, #f0f5f0 100%);
      border-radius: 22px;
      border: 1px solid rgba(16, 24, 40, 0.08);
      box-shadow: var(--shadow-soft);
      padding: 1.75rem;
      margin-top: 1.75rem;
      display: block;
      position: relative;
      z-index: 2;
      overflow: visible;
    }

    .table-card h5 {
      font-weight: 600;
    }

    .table-responsive {
      border-radius: 14px;
      overflow-x: auto;
      overflow-y: visible;
      -webkit-overflow-scrolling: touch;
    }

    table thead th {
      font-size: 0.85rem;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: var(--text-muted);
      border-bottom: 1px solid var(--border-subtle);
      background: var(--surface-muted);
    }

    table tbody td {
      vertical-align: middle;
      border-color: rgba(16, 24, 40, 0.035);
    }

    table tbody tr:hover {
      background: rgba(25, 135, 84, 0.04);
    }

    .status-badge {
      border-radius: 999px;
      padding: 0.35rem 0.9rem;
      font-weight: 600;
      font-size: 0.85rem;
    }

    .badge-soft-success {
      background: rgba(25, 135, 84, 0.12);
      color: var(--admin-primary);
    }

    .badge-soft-warning {
      background: rgba(255, 193, 7, 0.18);
      color: #b58102;
    }

    .badge-soft-danger {
      background: rgba(220, 53, 69, 0.15);
      color: #c21f32;
    }

    .btn-table {
      border-radius: 10px;
      padding: 0.35rem 0.85rem;
      font-weight: 500;
    }

    .btn-outline-dark {
      border-color: rgba(16, 24, 40, 0.15);
      color: #101828;
    }

    .pagination .page-link {
      border: none;
      margin: 0 0.2rem;
      border-radius: 999px;
      padding: 0.45rem 1rem;
    }

    .pagination .page-item.active .page-link {
      background: var(--admin-primary);
      color: #fff;
      box-shadow: 0 8px 20px rgba(25, 135, 84, 0.2);
    }

    .backdrop {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 15, 0.45);
      z-index: 1025;
    }

    @media (max-width: 1199.98px) {
      .main-content { padding: 2rem; }
    }

    @media (max-width: 991.98px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.active {
        transform: translateX(0);
      }

      .topbar {
        left: 0;
        padding: 0 1.25rem;
      }

      .topbar .navbar-toggler { display: block; }

      .main-content {
        margin-left: 0;
        padding: 1.75rem 1.25rem 2.5rem;
      }
    }

    @media (max-width: 575.98px) {
      .page-header,
      .filter-card,
      .table-card { padding: 1.25rem; }

      .table-card { margin-top: 1.25rem; }

      .hero-actions .btn { flex: 1 1 100%; }

      .table-responsive { overflow-x: auto; }
    }
  </style>
</head>
<body>
  <?php
    $filters = $filters ?? ['search' => '', 'city' => '', 'type' => '', 'status' => '', 'quick' => ''];
    $filterOptions = $filterOptions ?? ['cities' => [], 'types' => [], 'statuses' => []];
    $quickFilters = $quickFilters ?? [];
    $stats = $stats ?? ['total' => 0, 'published' => 0, 'drafts' => 0, 'flagged' => 0];
    $properties = $properties ?? [];
    $propertiesShown = count($properties);
    $statusClasses = [
      'published' => 'badge-soft-success',
      'draft' => 'badge-soft-warning',
      'flagged' => 'badge-soft-danger',
    ];
    $querySeed = array_filter($filters, function ($value) {
      return $value !== null && $value !== '';
    });
    $buildFilterUrl = static function(array $overrides = []) use ($querySeed) {
      $params = $querySeed;
      foreach ($overrides as $key => $value) {
        if ($value === null || $value === '') {
          unset($params[$key]);
        } else {
          $params[$key] = $value;
        }
      }
      $query = http_build_query($params);
      return current_url() . ($query ? '?' . $query : '');
    };
    $exportUrl = site_url('admin/properties/export') . ($querySeed ? '?' . http_build_query($querySeed) : '');
    $formatPrice = static function($price) {
      if ($price === null || $price === '' || (float) $price === 0.0) {
        return 'Not set';
      }
      $value = (float) $price;
      return '₹ ' . number_format($value, 0, '.', ',');
    };
    $formatDate = static function(?string $date) {
      if (empty($date)) {
        return '--';
      }
      $time = strtotime($date);
      return $time ? date('d M Y', $time) : '--';
    };
    $hasQuickFilter = !empty($filters['quick']) && isset($quickFilters[$filters['quick']]);
    $normalize = static function (?string $value): string {
      return strtolower(trim((string) $value));
    };
  ?>
  <?= view('admin/partials/sidebar', ['active' => 'properties']) ?>
  <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Marketplace Ops']) ?>

  <main class="main-content container-fluid">
    <section class="page-header" data-aos="fade-up">
      <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
        <div>
          <div class="breadcrumb-soft" aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
              <li class="breadcrumb-item"><a href="<?= site_url('/admin') ?>">Admin</a></li>
              <li class="breadcrumb-item active" aria-current="page">Property Listings</li>
            </ol>
          </div>
          <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
            <h1 class="page-title mb-0">Property Listings</h1>
            <span class="badge-live">Realtime sync</span>
          </div>
          <p class="text-muted mb-0">Monitor property performance, audit submissions, and keep your marketplace inventory in perfect health.</p>
        </div>
        <div class="hero-actions">
          <a href="<?= esc($exportUrl) ?>" class="btn btn-ghost"><i class="bi bi-download me-2"></i>Export CSV</a>
          <span class="d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Admin add flow coming soon">
          </span>
        </div>
      </div>
    </section>

    <section class="row g-4 mb-3">
      <div class="col-sm-6 col-xl-3" data-aos="fade-up">
        <div class="stat-card h-100">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <h6>Total Properties</h6>
            <div class="stat-icon"><i class="bi bi-building"></i></div>
          </div>
          <div class="stat-value"><?= number_format((int) ($stats['total'] ?? 0)) ?></div>
          <div class="stat-meta text-success">Showing <?= number_format($propertiesShown) ?> in view</div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="60">
        <div class="stat-card h-100">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <h6>Published</h6>
            <div class="stat-icon"><i class="bi bi-cloud-check"></i></div>
          </div>
          <div class="stat-value"><?= number_format((int) ($stats['published'] ?? 0)) ?></div>
          <div class="stat-meta text-success">Live marketplace coverage</div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
        <div class="stat-card h-100">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <h6>Drafts</h6>
            <div class="stat-icon"><i class="bi bi-folder2"></i></div>
          </div>
          <div class="stat-value"><?= number_format((int) ($stats['drafts'] ?? 0)) ?></div>
          <div class="stat-meta text-warning">Need ops review</div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="180">
        <div class="stat-card h-100">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <h6>Flagged</h6>
            <div class="stat-icon"><i class="bi bi-flag"></i></div>
          </div>
          <div class="stat-value text-danger"><?= number_format((int) ($stats['flagged'] ?? 0)) ?></div>
          <div class="stat-meta text-danger">Escalate within SLA</div>
        </div>
      </div>
    </section>

    <section class="filter-card" data-aos="fade-up">
      <form method="get" action="<?= current_url() ?>" class="w-100">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
          <h5 class="mb-0">Smart Filters</h5>
          <div class="d-flex gap-2 flex-wrap">
            <span class="badge-live px-3 py-2">Updated <?= esc(date('M j, g:i A')) ?></span>
            <a href="<?= current_url() ?>" class="btn btn-link text-decoration-none text-success p-0">Reset filters</a>
          </div>
        </div>
        <div class="filter-bar">
          <div class="input-icon">
            <i class="bi bi-search"></i>
                 <input type="text"
                   class="form-control"
                   name="search"
                   value="<?= esc($filters['search'] ?? '') ?>"
                   placeholder="Search by title, city or owner"
                   data-property-filter="search">
          </div>
          <div class="input-icon">
            <i class="bi bi-geo-alt"></i>
            <select class="form-select" name="city" data-property-filter="city">
              <option value="">City</option>
              <?php foreach ($filterOptions['cities'] as $city): ?>
                <option value="<?= esc($city) ?>" <?= (($filters['city'] ?? '') === $city) ? 'selected' : '' ?>><?= esc(ucwords($city)) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="input-icon">
            <i class="bi bi-layers"></i>
            <select class="form-select" name="type" data-property-filter="type">
              <option value="">Type</option>
              <?php foreach ($filterOptions['types'] as $type): ?>
                <option value="<?= esc($type) ?>" <?= (($filters['type'] ?? '') === $type) ? 'selected' : '' ?>><?= esc(ucwords($type)) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="input-icon">
            <i class="bi bi-check2-circle"></i>
            <select class="form-select" name="status" data-property-filter="status">
              <option value="">Status</option>
              <?php foreach ($filterOptions['statuses'] as $status): ?>
                <option value="<?= esc($status) ?>" <?= (($filters['status'] ?? '') === $status) ? 'selected' : '' ?>><?= esc(ucwords($status)) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <input type="hidden" name="quick" value="<?= esc($filters['quick'] ?? '') ?>">
        <div class="filter-actions">
          <button type="submit" class="btn btn-soft-primary"><i class="bi bi-sliders me-1"></i>Apply filters</button>
          <a href="<?= current_url() ?>" class="btn btn-link text-decoration-none text-success p-0">Reset filters</a>
        </div>
      </form>
    </section>

    <section class="table-card" data-aos="fade-up">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
          <h5 class="mb-1">All Properties</h5>
          <p class="text-muted small mb-0"
             data-properties-count
             data-total="<?= (int) ($stats['total'] ?? 0) ?>"
             data-template="Showing {visible} of {total} total records.">
            Showing <?= number_format($propertiesShown) ?> of <?= number_format((int) ($stats['total'] ?? 0)) ?> total records.
          </p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
          <?php if (!empty($quickFilters)): ?>
          <div class="btn-group">
            <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-funnel me-1"></i><?= $hasQuickFilter ? esc($quickFilters[$filters['quick']]) : 'Quick Filters' ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <?php foreach ($quickFilters as $key => $label): ?>
                <li><a class="dropdown-item <?= (($filters['quick'] ?? '') === $key) ? 'active' : '' ?>" href="<?= esc($buildFilterUrl(['quick' => $key])) ?>"><?= esc($label) ?></a></li>
              <?php endforeach; ?>
              <?php if ($hasQuickFilter): ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?= esc($buildFilterUrl(['quick' => null])) ?>">Clear quick filter</a></li>
              <?php endif; ?>
            </ul>
          </div>
          <?php endif; ?>
          <span class="d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Auto-assignment workflow is in progress">
            <button class="btn btn-soft-primary btn-sm" type="button" disabled aria-disabled="true"><i class="bi bi-lightning-charge me-1"></i>Auto-assign</button>
          </span>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-middle table-hover mb-0" data-properties-table>
          <thead class="table-light">
            <tr>
              <th>S. No.</th>
              <th>ID</th>
              <th>Title</th>
              <th>Owner</th>
              <th>Type</th>
              <th>City</th>
              <th>Date</th>
              <th>Price</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($properties)): ?>
              <tr data-empty-row>
                <td colspan="10" class="text-center text-muted py-5">
                  <div class="fw-semibold mb-1">No properties found</div>
                  <small>Try adjusting the filters or <a href="<?= current_url() ?>">clear them</a> to see all listings.</small>
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($properties as $index => $property): ?>
                <?php
                  $statusKey = strtolower($property['status'] ?? '');
                  $statusClass = $statusClasses[$statusKey] ?? 'badge-soft-warning';
                  $statusLabel = !empty($property['status']) ? ucwords(str_replace('_', ' ', $property['status'])) : 'Pending';
                  $ownerLabel = !empty($property['owner_name'])
                    ? $property['owner_name'] . (!empty($property['owner_identifier']) ? ' (#' . $property['owner_identifier'] . ')' : '')
                    : 'User #' . ($property['user_id'] ?? '--');
                  $cityKey = $normalize($property['city'] ?? '');
                  $typeKey = $normalize($property['property_type'] ?? '');
                  $searchHaystack = $normalize(implode(' ', [
                    $property['id'] ?? '',
                    $property['property_name'] ?? '',
                    $ownerLabel,
                    $property['property_type'] ?? '',
                    $property['city'] ?? '',
                    $property['transaction_type'] ?? '',
                    $property['property_category'] ?? '',
                    $statusLabel
                  ]));
                ?>
                <tr
                  data-property-row
                  data-search="<?= esc($searchHaystack) ?>"
                  data-city="<?= esc($cityKey) ?>"
                  data-type="<?= esc($typeKey) ?>"
                  data-status="<?= esc($statusKey) ?>"
                >
                  <td><?= $index + 1 ?></td>
                  <td><?= esc($property['id'] ?? '--') ?></td>
                  <td>
                    <div class="fw-semibold mb-1"><?= esc($property['property_name'] ?? 'Untitled property') ?></div>
                    <small class="text-muted">
                      <?= esc(ucwords($property['transaction_type'] ?? 'n/a')) ?> &middot;
                      <?= esc(ucwords($property['property_category'] ?? 'n/a')) ?>
                    </small>
                  </td>
                  <td><?= esc($ownerLabel) ?></td>
                  <td><?= esc(ucwords($property['property_type'] ?? '--')) ?></td>
                  <td><?= esc($property['city'] ?? '--') ?></td>
                  <td><?= esc($formatDate($property['created_at'] ?? null)) ?></td>
                  <td><?= esc($formatPrice($property['price'] ?? null)) ?></td>
                  <td><span class="status-badge <?= esc($statusClass) ?>"><?= esc($statusLabel) ?></span></td>
                  <td class="text-end">
                    <a href="<?= esc(site_url('/property/' . ($property['id'] ?? ''))) ?>" class="btn btn-outline-dark btn-sm btn-table me-1">View</a>
                    <form method="post" action="<?= esc(site_url('/admin/post/' . ($property['id'] ?? '') . '/delete')) ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <button type="submit" class="btn btn-danger btn-sm btn-table" data-swal-confirm data-swal-title="Delete post" data-swal-text="Delete post <?= esc($property['id'] ?? '--') ?>?">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr class="text-center text-muted fst-italic d-none" data-empty-row>
                <td colspan="10">No properties match the selected filters.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <nav class="mt-4 d-none" aria-label="Property pagination" data-properties-pagination>
        <ul class="pagination justify-content-end flex-wrap mb-0">
          <li class="page-item disabled" data-page-control="prev"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>
          <li class="page-item disabled" data-page-control="next"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
    </section>
  </main>

  <div id="sidebar-backdrop" class="backdrop d-none"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      if (window.bootstrap && window.bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
          new window.bootstrap.Tooltip(tooltipTriggerEl);
        });
      }
      const sidebar = document.getElementById('admin-sidebar');
      const toggler = document.getElementById('sidebar-toggler');
      const backdrop = document.getElementById('sidebar-backdrop');
      const dropdown = document.querySelector('.topbar .dropdown');
      const darkToggle = document.getElementById('dark-mode-toggle');
      const THEME_KEY = 'adminTheme';
      const savedTheme = localStorage.getItem(THEME_KEY);
      const markAOSReady = () => {
        if (!document.body.classList.contains('aos-ready')) {
          document.body.classList.add('aos-ready');
        }
      };

      const setTheme = (mode) => {
        const next = mode === 'dark' ? 'dark' : 'light';
        document.body.classList.toggle('dark-mode', next === 'dark');
        localStorage.setItem(THEME_KEY, next);
      };

      setTheme(savedTheme || 'light');

      if (darkToggle) {
        darkToggle.addEventListener('click', () => {
          const next = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
          setTheme(next);
        });
      }

      const toggleSidebar = () => {
        sidebar.classList.toggle('active');
        backdrop.classList.toggle('d-none');
      };

      if (toggler) {
        toggler.addEventListener('click', toggleSidebar);
      }

      const closeSidebar = () => {
        sidebar.classList.remove('active');
        backdrop.classList.add('d-none');
      };

      if (backdrop) {
        backdrop.addEventListener('click', closeSidebar);
      }

      window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
          closeSidebar();
        }
      });

      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          closeSidebar();
        }
      });

      if (dropdown) {
        dropdown.addEventListener('show.bs.dropdown', () => dropdown.classList.add('active'));
        dropdown.addEventListener('hide.bs.dropdown', () => dropdown.classList.remove('active'));
      }

      if (window.AOS) {
        AOS.init({ duration: 650, once: true, offset: 80, easing: 'ease-out-quart' });
        markAOSReady();
      } else {
        markAOSReady();
      }

      const propertiesTable = document.querySelector('[data-properties-table]');
      const propertiesPagination = document.querySelector('[data-properties-pagination]');
      const propertiesCountIndicator = document.querySelector('[data-properties-count]');

      if (propertiesTable && propertiesPagination) {
        const propertyRows = Array.from(propertiesTable.querySelectorAll('tbody tr[data-property-row]'));
        if (!propertyRows.length) {
          propertiesPagination.classList.add('d-none');
        } else {
          const filters = {
            search: document.querySelector('[data-property-filter="search"]'),
            city: document.querySelector('[data-property-filter="city"]'),
            type: document.querySelector('[data-property-filter="type"]'),
            status: document.querySelector('[data-property-filter="status"]')
          };

          const emptyRow = propertiesTable.querySelector('tr[data-empty-row]');
          const paginationList = propertiesPagination.querySelector('.pagination');
          const prevControl = propertiesPagination.querySelector('li[data-page-control="prev"]');
          const nextControl = propertiesPagination.querySelector('li[data-page-control="next"]');
          const formatNumber = (value) => new Intl.NumberFormat().format(value);
          const template = propertiesCountIndicator?.dataset.template || 'Showing {visible} of {total} total records.';
          const totalRecords = Number(propertiesCountIndicator?.dataset.total || propertyRows.length);

          const ROWS_PER_PAGE = 10;
          let currentPage = 1;
          let totalPages = 1;

          const normalize = (value) => (value || '').toLowerCase();

          const getFilteredRows = () => {
            const searchTerm = normalize(filters.search?.value);
            const cityValue = normalize(filters.city?.value);
            const typeValue = normalize(filters.type?.value);
            const statusValue = normalize(filters.status?.value);

            return propertyRows.filter((row) => {
              if (searchTerm && !(row.dataset.search || '').includes(searchTerm)) {
                return false;
              }
              if (cityValue && (row.dataset.city || '') !== cityValue) {
                return false;
              }
              if (typeValue && (row.dataset.type || '') !== typeValue) {
                return false;
              }
              if (statusValue && (row.dataset.status || '') !== statusValue) {
                return false;
              }
              return true;
            });
          };

          const updateCountIndicator = (pageCount) => {
            if (!propertiesCountIndicator) return;
            propertiesCountIndicator.textContent = template
              .replace('{visible}', formatNumber(pageCount))
              .replace('{total}', formatNumber(totalRecords));
          };

          const setEmptyState = (visible) => {
            if (!emptyRow) return;
            emptyRow.classList.toggle('d-none', visible !== 0);
          };

          const updatePaginationControls = (total) => {
            if (!paginationList) return;
            paginationList.querySelectorAll('li[data-page-number]').forEach((item) => item.remove());
            const insertionPoint = nextControl || null;
            for (let page = 1; page <= total; page += 1) {
              const li = document.createElement('li');
              li.className = `page-item${page === currentPage ? ' active' : ''}`;
              li.dataset.pageNumber = String(page);
              const link = document.createElement('a');
              link.className = 'page-link';
              link.href = '#';
              link.textContent = page;
              li.appendChild(link);
              if (insertionPoint) {
                paginationList.insertBefore(li, insertionPoint);
              } else {
                paginationList.appendChild(li);
              }
            }

            prevControl?.classList.toggle('disabled', currentPage === 1 || total === 0);
            nextControl?.classList.toggle('disabled', currentPage === total || total === 0);
          };

          const renderTable = () => {
            const filteredRows = getFilteredRows();
            totalPages = filteredRows.length ? Math.max(1, Math.ceil(filteredRows.length / ROWS_PER_PAGE)) : 0;
            if (currentPage > totalPages && totalPages !== 0) {
              currentPage = totalPages;
            }

            propertyRows.forEach((row) => row.classList.add('d-none'));

            if (!filteredRows.length) {
              setEmptyState(0);
              updatePaginationControls(0);
              propertiesPagination.classList.add('d-none');
              updateCountIndicator(0);
              return;
            }

            const start = (currentPage - 1) * ROWS_PER_PAGE;
            const pageRows = filteredRows.slice(start, start + ROWS_PER_PAGE);
            pageRows.forEach((row) => row.classList.remove('d-none'));
            setEmptyState(pageRows.length);
            updatePaginationControls(totalPages);
            propertiesPagination.classList.toggle('d-none', totalPages <= 1);
            updateCountIndicator(pageRows.length);
          };

          const resetAndRender = () => {
            currentPage = 1;
            renderTable();
          };

          Object.values(filters).forEach((input) => {
            if (!input) return;
            const eventName = input.tagName === 'INPUT' ? 'input' : 'change';
            input.addEventListener(eventName, resetAndRender);
          });

          propertiesPagination.addEventListener('click', (event) => {
            const control = event.target.closest('li');
            if (!control) return;
            if (!control.dataset.pageControl && !control.dataset.pageNumber) return;
            event.preventDefault();

            if (control.dataset.pageControl === 'prev' && currentPage > 1) {
              currentPage -= 1;
              renderTable();
              return;
            }

            if (control.dataset.pageControl === 'next' && currentPage < totalPages) {
              currentPage += 1;
              renderTable();
              return;
            }

            if (control.dataset.pageNumber) {
              const requested = Number(control.dataset.pageNumber);
              if (!Number.isNaN(requested) && requested !== currentPage) {
                currentPage = requested;
                renderTable();
              }
            }
          });

          resetAndRender();
        }
      }
    });
  </script>
</body>
</html>
