<?php
$page_title = 'Service Enquiries - Admin - 11 Acer';
$formatDateTime = static function (?string $value): string {
    if (! $value) {
        return '—';
    }
    return date('M d, Y H:i', strtotime($value));
};
$truncate = static function (?string $value, int $length = 150): string {
    $text = trim((string) $value);
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length - 3) . '...';
};
$summary = $summary ?? ['total' => 0, 'last24h' => 0, 'last7d' => 0];
$recentEnquiries = $recentEnquiries ?? [];
$popularServices = $popularServices ?? [];
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <meta name='csrf-token-name' content='<?= csrf_token() ?>'>
    <meta name='csrf-token-value' content='<?= csrf_hash() ?>'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap' rel='stylesheet'>
    <link rel='icon' type='image/x-icon' href='<?= base_url('images/favicon/favicon.ico') ?>'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css'>
    <title><?= esc($page_title) ?></title>
    <?= view('admin/partials/layout-styles') ?>
    <?= view('admin/partials/dashboard-theme') ?>
    <style>
        .main-content {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        @media (min-width: 992px) {
            .main-content {
                width: calc(100vw - var(--admin-sidebar-width));
                max-width: calc(100vw - var(--admin-sidebar-width));
            }
        }

        .badge-live {
            background: rgba(25, 135, 84, 0.12);
            color: #198754;
            border-radius: 999px;
            padding: 0.25rem 0.85rem;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .glass-card .progress {
            height: 6px;
            border-radius: 999px;
        }

        .glass-card .progress-bar {
            border-radius: 999px;
        }

        .recent-actions-card .table thead th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .table-card {
            background: linear-gradient(180deg, #ffffff 0%, #f0f5f0 100%);
            border-radius: 22px;
            border: 1px solid rgba(16, 24, 40, 0.08);
            box-shadow: 0 15px 45px rgba(28, 51, 36, 0.08);
            padding: 1.75rem;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .table-card h5 {
            font-weight: 600;
        }

        .table-card .table-responsive {
            border-radius: 14px;
            overflow-x: auto;
            overflow-y: visible;
            -webkit-overflow-scrolling: touch;
        }

        .table-card .table {
            margin-bottom: 0;
        }

        .table-card .table thead th {
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #6c757d;
            border-bottom: 1px solid rgba(223, 230, 223, 1);
            background: #ecf3ec;
            white-space: nowrap;
        }

        .table-card .table tbody td {
            vertical-align: middle;
            border-color: rgba(16, 24, 40, 0.04);
            white-space: nowrap;
        }

        .table-card .table tbody tr:hover {
            background: rgba(25, 135, 84, 0.04);
        }

        .table-card .table .enquiry-message {
            white-space: normal;
        }

        .table-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(25, 135, 84, 0.35) transparent;
            scroll-behavior: smooth;
        }

        .table-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: rgba(25, 135, 84, 0.35);
            border-radius: 999px;
        }

        .table-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        @media (max-width: 991.98px) {
            .table-card .table {
                min-width: 960px;
            }
        }

        @media (max-width: 575.98px) {
            .card-grid {
                grid-template-columns: 1fr;
            }

            .table-card {
                padding: 1.25rem;
            }

            .main-content {
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <?= view('admin/partials/sidebar', ['active' => 'service-enquiries']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Support Ops']) ?>

    <main class='main-content container-fluid' id='main-content'>
        <section class='hero-panel mb-4' data-aos='fade-up'>
            <span class='badge-soft'><i class='bi bi-chat-square-text-fill'></i> Service Enquiries</span>
            <div class='row align-items-center mt-3 g-4'>
                <div class='col-lg-7'>
                    <h1 class='h3 mb-3'>Every ask. Every service.</h1>
                    <p class='text-muted mb-4'>Monitor inbound service requests, surface the busiest services, and keep the help desk responsive.</p>
                    <div class='card-grid'>
                        <div class='stat-card text-center'>
                            <p class='text-muted small mb-1'>Total enquiries</p>
                            <h3 class='mb-1'><?= esc(number_format($summary['total'] ?? 0)) ?></h3>
                            <span class='stat-meta'>Overall</span>
                        </div>
                        <div class='stat-card text-center'>
                            <p class='text-muted small mb-1'>Last 24 hours</p>
                            <h3 class='mb-1'><?= esc(number_format($summary['last24h'] ?? 0)) ?></h3>
                            <span class='stat-meta'>Fresh priority</span>
                        </div>
                        <div class='stat-card text-center'>
                            <p class='text-muted small mb-1'>Last 7 days</p>
                            <h3 class='mb-1'><?= esc(number_format($summary['last7d'] ?? 0)) ?></h3>
                            <span class='stat-meta'>Weekly wave</span>
                        </div>
                    </div>
                </div>
                <div class='col-lg-5'>
                    <div class='glass-card h-100 d-flex flex-column justify-content-between'>
                        <div>
                            <h5 class='mb-1'>Desk readiness</h5>
                            <p class='text-muted small mb-0'>Pick the busiest enquiries and loop in specialists.</p>
                        </div>
                        <div class='d-flex flex-column gap-1'>
                            <div class='d-flex justify-content-between align-items-center'>
                                <span class='text-muted'>Response time</span>
                                <strong>Under 4h</strong>
                            </div>
                            <div class='progress' style='height: 6px;'>
                                <div class='progress-bar bg-success' role='progressbar' style='width: 72%;'></div>
                            </div>
                            <div class='d-flex justify-content-between align-items-center mt-2'>
                                <span class='text-muted'>Satisfied rate</span>
                                <strong>94%</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class='table-card' data-aos='fade-up'>
            <div class='d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3'>
                <div>
                    <h5 class='mb-1'>Latest enquiries</h5>
                    <p class='text-muted small mb-0'>New submissions appear at the top. Click to copy or follow up.</p>
                </div>
                <span class='badge-live px-3 py-2'>Realtime</span>
            </div>
            <div class='table-responsive table-scroll'>
                <table class='table align-middle table-hover mb-0'>
                    <thead class='table-light'>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentEnquiries)): ?>
                            <tr>
                                <td colspan='7' class='text-center text-muted fst-italic'>No enquiries yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recentEnquiries as $index => $row): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($row['name'] ?? '—') ?></td>
                                    <td><?= esc($row['email'] ?? '—') ?></td>
                                    <td><?= esc($row['phone'] ?? '—') ?></td>
                                            <td><span class='badge bg-success-light text-success'><?= esc($row['service_title'] ?? '—') ?></span></td>
                                            <td class='enquiry-message'><small><?= esc($truncate($row['message'] ?? '—', 120)) ?></small></td>
                                    <td><small class='text-muted'><?= esc($formatDateTime($row['created_at'] ?? null)) ?></small></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <div class='glass-card' data-aos='fade-up'>
            <div class='d-flex justify-content-between align-items-center mb-3'>
                <div>
                    <h5 class='mb-1'>Popular services</h5>
                    <p class='text-muted small mb-0'>Know which services the audience needs most.</p>
                </div>
                <span class='badge bg-info-light text-info'>Top 5</span>
            </div>
            <div class='row g-3'>
                <?php if (empty($popularServices)): ?>
                    <div class='col-12 text-center text-muted fst-italic'>No trends available yet.</div>
                <?php else: ?>
                    <?php foreach ($popularServices as $service): ?>
                        <div class='col-sm-6 col-lg-4'>
                            <div class='stat-card h-100 border border-success border-2'>
                                <p class='text-muted small mb-1'><?= esc($service['service_title'] ?? '—') ?></p>
                                <h4 class='mb-1'><?= esc(number_format((int) ($service['enquiry_count'] ?? 0))) ?></h4>
                                <span class='stat-meta'>Enquiries received</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <div id='sidebar-backdrop' class='backdrop d-none'></div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js'></script>
    <script>
    (function () {
        'use strict';

        document.addEventListener('DOMContentLoaded', function () {
            const body = document.body;
            const sidebar = document.getElementById('admin-sidebar');
            const toggler = document.getElementById('sidebar-toggler');
            const backdrop = document.getElementById('sidebar-backdrop');
            const darkToggle = document.getElementById('dark-mode-toggle');
            const THEME_KEY = 'adminTheme';

            const applyTheme = (mode) => {
                body.classList.toggle('dark-mode', mode === 'dark');
                localStorage.setItem(THEME_KEY, mode);
            };

            applyTheme(localStorage.getItem(THEME_KEY) || 'light');

            darkToggle?.addEventListener('click', () => {
                applyTheme(body.classList.contains('dark-mode') ? 'light' : 'dark');
            });

            const showBackdrop = () => {
                if (!backdrop) { return; }
                backdrop.classList.remove('d-none');
                backdrop.classList.add('visible');
            };

            const hideBackdrop = () => {
                if (!backdrop) { return; }
                backdrop.classList.remove('visible');
                backdrop.classList.add('d-none');
            };

            const showSidebar = () => {
                sidebar?.classList.add('active');
                showBackdrop();
            };

            const hideSidebar = () => {
                sidebar?.classList.remove('active');
                hideBackdrop();
            };

            toggler?.addEventListener('click', () => {
                if (!sidebar) { return; }
                sidebar.classList.contains('active') ? hideSidebar() : showSidebar();
            });

            backdrop?.addEventListener('click', hideSidebar);

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 992) {
                    hideSidebar();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    hideSidebar();
                }
            });

            window.AOS?.init({
                duration: 700,
                once: true,
                offset: 80,
                easing: 'ease-out-quart'
            });

            document.querySelectorAll('.stat-card').forEach((card) => {
                card.addEventListener('mousemove', (event) => {
                    const bounds = card.getBoundingClientRect();
                    card.style.setProperty('--mouse-x', `${event.clientX - bounds.left}px`);
                    card.style.setProperty('--mouse-y', `${event.clientY - bounds.top}px`);
                });
                card.addEventListener('mouseleave', () => {
                    card.style.removeProperty('--mouse-x');
                    card.style.removeProperty('--mouse-y');
                });
            });
        });
    })();
    </script>
</body>
</html>