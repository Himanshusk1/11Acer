<?php
if (defined('ADMIN_DASHBOARD_THEME_RENDERED')) {
    return;
}
define('ADMIN_DASHBOARD_THEME_RENDERED', true);
?>
<style>
    :root {
        --admin-primary-dark: #0f5132;
        --admin-primary-light: #e6fae6;
        --surface: #ffffff;
        --surface-muted: #f5f8f6;
        --border-color: rgba(25, 135, 84, 0.12);
        --text-muted: #6c7c72;
        --shadow-soft: 0 25px 60px rgba(13, 27, 19, 0.09);
        --shadow-hover: 0 35px 80px rgba(13, 27, 19, 0.14);
        --blur: 22px;
        --dark-bg: #0a100e;
        --dark-surface: rgba(18, 26, 23, 0.92);
        --dark-border: rgba(255, 255, 255, 0.08);
    }

    .topbar .topbar-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .topbar .btn.btn-outline-success {
        border-radius: 12px;
        border-width: 2px;
        font-weight: 600;
        padding: 0.45rem 1.05rem;
        transition: all 0.2s ease;
    }

    .topbar .btn.btn-outline-success:hover {
        background: var(--admin-primary, #198754);
        color: #fff;
        border-color: var(--admin-primary, #198754);
        box-shadow: 0 10px 24px rgba(25, 135, 84, 0.35);
    }

    .topbar .icon-btn {
        flex-shrink: 0;
    }

    .btn-stack-mobile .btn,
    .topbar .btn.btn-outline-success {
        border-radius: 12px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: radial-gradient(circle at top, #f3fbf6 0%, #ecf3ed 45%, #e7ede7 100%);
        color: #1c2b20;
        min-height: 100vh;
        overflow-x: hidden;
        position: relative;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background: radial-gradient(circle at 10% 20%, rgba(25, 135, 84, 0.15), transparent 45%),
                    radial-gradient(circle at 80% 0%, rgba(15, 81, 50, 0.15), transparent 40%);
        opacity: 0.7;
        pointer-events: none;
    }

    body.dark-mode {
        background: var(--dark-bg);
        color: #ebf5ed;
    }

    body.dark-mode::before {
        opacity: 0.3;
    }

    body.dark-mode .sidebar,
    body.dark-mode .topbar,
    body.dark-mode .hero-panel,
    body.dark-mode .stat-card,
    body.dark-mode .glass-card,
    body.dark-mode .analytics-card,
    body.dark-mode .table-wrapper,
    body.dark-mode .timeline-card,
    body.dark-mode .recent-actions-card {
        background: var(--dark-surface);
        border-color: var(--dark-border);
        color: inherit;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
    }

    body.dark-mode .stat-card .icon {
        background: rgba(25, 135, 84, 0.16);
    }

    body.dark-mode .table-wrapper .table thead,
    body.dark-mode .recent-actions-card .table thead {
        background: rgba(255, 255, 255, 0.05);
    }

    body.dark-mode .filter-bar .form-control,
    body.dark-mode .filter-bar .form-select {
        background: rgba(255, 255, 255, 0.08);
        border-color: transparent;
        color: #f4fcf8;
    }

    body.dark-mode .icon-btn {
        background: rgba(255, 255, 255, 0.08);
        color: #eaf6ef;
    }

    body.dark-mode .icon-btn:hover {
        background: rgba(25, 135, 84, 0.6);
        color: #fff;
    }

    body.dark-mode .text-muted,
    body.dark-mode .stat-meta,
    body.dark-mode .table p,
    body.dark-mode .table small {
        color: #d6e2d9 !important;
    }

    body.dark-mode .table thead th,
    body.dark-mode .recent-actions-card .table thead th {
        color: #f7fcf8;
        border-color: rgba(255, 255, 255, 0.08);
    }

    body.dark-mode .table tbody td {
        border-color: rgba(255, 255, 255, 0.08);
    }

    body.dark-mode .badge {
        background: rgba(25, 135, 84, 0.25);
        color: #eafff1;
    }

    body.dark-mode .hero-panel {
        border-color: rgba(255, 255, 255, 0.12);
    }

    .hero-panel {
        background: linear-gradient(135deg, rgba(25, 135, 84, 0.28), rgba(25, 135, 84, 0.08));
        border-radius: 32px;
        padding: 2rem 2.4rem;
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(25, 135, 84, 0.18);
    }

    .hero-panel::after {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.45), transparent 65%);
        opacity: 0.7;
        z-index: 0;
    }

    .hero-panel > * {
        position: relative;
        z-index: 1;
    }

    .hero-panel .badge-soft {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 0.72rem;
    }

    .quick-actions .btn {
        border-radius: 14px;
        padding: 0.65rem 1.6rem;
        font-weight: 600;
        border-width: 1.5px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .quick-actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .btn-brand {
        background: var(--admin-primary);
        border-color: var(--admin-primary);
        color: #fff;
    }

    .btn-brand:hover {
        background: var(--admin-primary-dark);
        border-color: var(--admin-primary-dark);
    }

    .hero-metrics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
    }

    .hero-metric {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 18px;
        padding: 1rem;
        color: #000000ff;
        backdrop-filter: blur(16px);
    }

    .hero-metric span {
        font-size: 0.85rem;
        opacity: 0.85;
    }

    .glass-card,
    .stat-card,
    .analytics-card,
    .table-wrapper,
    .timeline-card,
    .recent-actions-card {
        background: var(--surface);
        border-radius: 24px;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-soft);
        padding: 1.6rem;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: var(--mouse-y, 50%);
        left: var(--mouse-x, 50%);
        transform: translate(-50%, -50%);
        width: 0;
        height: 0;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(25, 135, 84, 0.15), transparent 60%);
        transition: width 0.4s ease, height 0.4s ease;
        pointer-events: none;
    }

    .stat-card:hover::after {
        width: 220px;
        height: 220px;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
    }

    .stat-card .icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: rgba(25, 135, 84, 0.12);
        color: var(--admin-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }

    .stat-meta {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .analytics-card h5 {
        font-weight: 600;
    }

    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 0.85rem;
        margin-top: 1rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-flex;
    }

    .table-wrapper {
        margin-top: 1rem;
    }

    .table-wrapper .table-responsive {
        border-radius: 22px;
        overflow: hidden;
    }

    .table {
        margin: 0;
    }

    .table thead {
        background: linear-gradient(120deg, rgba(25, 135, 84, 0.1), rgba(25, 135, 84, 0.02));
    }

    .table thead th {
        border: none;
        font-size: 0.85rem;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }

    .table tbody tr {
        transition: background 0.2s ease;
    }

    .table tbody tr:hover {
        background: rgba(25, 135, 84, 0.05);
    }

    .table tbody td {
        border-bottom: 1px solid rgba(25, 135, 84, 0.08);
    }

    .table tbody td .btn {
        border-radius: 999px;
    }

    .badge {
        border-radius: 999px;
        font-weight: 500;
        padding: 0.35rem 0.75rem;
    }

    .badge.bg-success-light {
        background: rgba(25, 135, 84, 0.14);
        color: var(--admin-primary);
    }

    .badge.bg-warning-light {
        background: rgba(255, 193, 7, 0.2);
        color: #a37000;
    }

    .badge.bg-danger-light {
        background: rgba(220, 53, 69, 0.18);
        color: #c82333;
    }

    .badge.bg-info-light {
        background: rgba(13, 202, 240, 0.15);
        color: #0aa2c0;
    }

    .filter-bar {
        gap: 0.75rem;
    }

    .filter-bar .form-control,
    .filter-bar .form-select {
        border-radius: 14px;
        border: 1px solid var(--border-color);
        padding: 0.6rem 1rem;
        min-width: 180px;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .filter-bar .form-control:focus,
    .filter-bar .form-select:focus {
        border-color: var(--admin-primary);
        box-shadow: 0 0 0 0.15rem rgba(25, 135, 84, 0.2);
    }

    .timeline-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .timeline-list li {
        position: relative;
        padding-left: 1.9rem;
        margin-bottom: 1.2rem;
    }

    .timeline-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 6px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--admin-primary);
        box-shadow: 0 0 0 6px rgba(25, 135, 84, 0.15);
    }

    .timeline-list li:last-child {
        margin-bottom: 0;
    }

    .status-progress {
        height: 8px;
        border-radius: 999px;
        background: rgba(25, 135, 84, 0.12);
        overflow: hidden;
    }

    .status-progress .progress-bar {
        border-radius: 999px;
    }

    @media (max-width: 1199.98px) {
        .hero-panel {
            padding: 1.8rem;
        }
        .glass-card,
        .stat-card,
        .analytics-card,
        .table-wrapper,
        .timeline-card,
        .recent-actions-card {
            padding: 1.4rem;
        }
    }

    @media (max-width: 991.98px) {
        .hero-panel {
            border-radius: 26px;
        }
        .hero-metrics {
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        }
    }

    @media (max-width: 575.98px) {
        .hero-panel {
            padding: 1.4rem;
            border-radius: 22px;
        }
        .quick-actions .btn {
            width: 100%;
        }
        .filter-bar {
            width: 100%;
        }
        .filter-bar .form-control,
        .filter-bar .form-select {
            min-width: 0;
            width: 100%;
        }
    }
</style>
