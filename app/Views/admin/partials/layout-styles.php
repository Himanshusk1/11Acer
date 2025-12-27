<?php
if (defined('ADMIN_LAYOUT_STYLES_RENDERED')) {
    return;
}
define('ADMIN_LAYOUT_STYLES_RENDERED', true);
$adminSidebarWidth = $sidebarWidth ?? '260px';
$adminTopbarHeight = $topbarHeight ?? '70px';
?>
<style>
:root {
    --admin-sidebar-width: <?= $adminSidebarWidth ?>;
    --admin-topbar-height: <?= $adminTopbarHeight ?>;
}

body {
    overflow-x: hidden;
}

.sidebar,
#admin-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: var(--admin-sidebar-width);
    padding: 2rem 1.5rem;
    background: rgba(17, 26, 21, 0.92);
    color: #f0fff6;
    box-shadow: 10px 0 30px rgba(8, 12, 10, 0.4);
    backdrop-filter: blur(18px);
    overflow-y: auto;
    overscroll-behavior: contain;
    scroll-behavior: smooth;
    transition: transform 0.3s ease;
    z-index: 1030;
}

.sidebar::-webkit-scrollbar,
#admin-sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track,
#admin-sidebar::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar::-webkit-scrollbar-thumb,
#admin-sidebar::-webkit-scrollbar-thumb {
    background: rgba(180, 186, 189, 0.55);
    border-radius: 999px;
}

.sidebar::-webkit-scrollbar-thumb:hover,
#admin-sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(180, 186, 189, 0.75);
}

.sidebar,
#admin-sidebar {
    scrollbar-width: thin;
    scrollbar-color: rgba(180, 186, 189, 0.65) transparent;
}

.topbar {
    position: fixed;
    top: 0;
    left: var(--admin-sidebar-width);
    right: 0;
    height: var(--admin-topbar-height);
    background-color: #fff;
    border-bottom: 1px solid rgba(25, 135, 84, 0.08);
    padding: 0 2rem;
    display: flex;
    align-items: center;
    z-index: 1020;
    box-shadow: 0 10px 30px rgba(15, 28, 22, 0.08);
    transition: left 0.3s ease, padding 0.3s ease;
}

.sidebar-header {
    font-size: 1.5rem;
    font-weight: 700;
    color: #ffffff;
    text-align: center;
    margin-bottom: 2.2rem;
}

.sidebar-header span {
    color: var(--admin-primary, #198754);
}

.sidebar .nav {
    padding-left: 0;
}

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
    transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
}

.sidebar .nav-link .icon {
    font-size: 1.1rem;
}

.sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    transform: translateX(6px);
}

.sidebar .nav-link.active {
    background-color: var(--admin-primary, #198754);
    color: #ffffff;
    font-weight: 600;
    box-shadow: 0 12px 25px rgba(25, 135, 84, 0.35);
}

body.dark-mode .topbar {
    background-color: rgba(18, 26, 23, 0.92);
    border-color: rgba(255, 255, 255, 0.08);
    color: #ebf5ed;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
}

.topbar.topbar-align-right {
    left: 0;
    right: 0;
    width: 100%;
    padding: 0;
}

.topbar .topbar-inner {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.topbar.topbar-align-right .topbar-inner {
    margin-left: auto;
    width: min(1200px, 100%);
    padding: 0 2rem;
    justify-content: flex-end;
}

.topbar .navbar-toggler {
    display: none;
    border: none;
    background: transparent;
    color: var(--admin-primary, #198754);
    padding: 0;
}

.topbar .navbar-toggler:focus {
    outline: none;
    box-shadow: none;
}

.topbar .topbar-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.topbar.topbar-align-right .topbar-actions {
    flex-wrap: nowrap;
}

.icon-btn {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    border: 1px solid rgba(25, 135, 84, 0.25);
    background: #fff;
    color: var(--admin-primary, #198754);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.icon-btn:hover {
    background: var(--admin-primary, #198754);
    color: #fff;
    box-shadow: 0 12px 20px rgba(25, 135, 84, 0.3);
}

body.dark-mode .icon-btn {
    background: rgba(255, 255, 255, 0.08);
    color: #eaf6ef;
    border-color: rgba(255, 255, 255, 0.12);
}

body.dark-mode .icon-btn:hover {
    background: rgba(25, 135, 84, 0.6);
    color: #fff;
}

.main-content {
    margin-left: var(--admin-sidebar-width);
    margin-top: var(--admin-topbar-height);
    padding: 2.5rem 2.7rem 3rem;
    min-height: calc(100vh - var(--admin-topbar-height));
    transition: margin 0.3s ease, padding 0.3s ease;
}

.filter-bar {
    display: flex;
    gap: 0.75rem;
}

.table-wrapper .table-responsive,
.recent-actions-card .table-responsive,
.glass-card .table-responsive,
.table-responsive {
    overflow-x: auto;
    border-radius: 22px;
}

#sidebar-backdrop.backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.55);
    z-index: 1000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

#sidebar-backdrop.backdrop.visible:not(.d-none) {
    opacity: 1;
    pointer-events: auto;
    z-index: 1025;
}

@media (min-width: 992px) {
    .topbar.topbar-align-right .topbar-inner {
        padding-left: clamp(1rem, 6vw, 5rem);
    }
}

@media (max-width: 1199.98px) {
    .main-content {
        padding: 2.2rem 2rem 2.5rem;
    }
    .filter-bar {
        width: 100%;
    }
    .table-responsive table {
        min-width: 720px;
    }
}

@media (max-width: 991.98px) {
    .sidebar,
    #admin-sidebar {
        transform: translateX(-100%);
        box-shadow: 10px 0 30px rgba(8, 12, 10, 0.4);
    }
    .sidebar.active,
    #admin-sidebar.active {
        transform: translateX(0);
    }
    .topbar,
    .topbar.topbar-align-right {
        left: 0;
        padding: 0 1.25rem;
    }
    .topbar.topbar-align-right .topbar-inner {
        margin-left: 0;
        width: 100%;
        padding: 0;
        justify-content: space-between;
    }
    .topbar .navbar-toggler {
        display: inline-flex;
    }
    .topbar.topbar-align-right .topbar-actions {
        flex-wrap: wrap;
    }
    .main-content {
        margin-left: 0;
        padding: 2rem 1.5rem 2.5rem;
    }
    .filter-bar > * {
        flex: 1 1 calc(50% - 0.75rem);
        min-width: 0;
    }
    .table-wrapper .table-responsive,
    .recent-actions-card .table-responsive,
    .glass-card .table-responsive {
        border-radius: 18px;
    }
    .table-responsive table {
        min-width: 820px;
    }
}

@media (max-width: 575.98px) {
    .topbar,
    .topbar.topbar-align-right {
        height: 64px;
        padding: 0 1rem;
    }
    .main-content {
        margin-top: 64px;
        padding: 1.6rem 1.25rem 2rem;
    }
    .topbar-actions strong {
        display: none;
    }
    .filter-bar > * {
        flex: 1 1 100%;
    }
    .quick-actions .btn,
    .filter-bar .btn,
    .btn-stack-mobile .btn {
        width: 100%;
    }
    .table-responsive table {
        min-width: 920px;
    }
    .pagination {
        flex-wrap: wrap;
        gap: 0.4rem;
        justify-content: center !important;
    }
}
</style>
