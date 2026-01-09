<?php
$page_title = 'Property Listings - 11 Acer';
$request = service('request');
$initialQuery = trim((string) $request->getGet('query'));
$initialPropertyType = trim((string) $request->getGet('property_type'));
$initialListingType = trim((string) $request->getGet('listing_type'));
$initialBudget = trim((string) $request->getGet('budget'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Site styles -->
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">

    <style>
        :root {
            --page-background: #f4f6fb;
            --section-muted: #eef3f1;
            --card-background: #ffffff;
            --card-dark: #0f2f23;
            --text-primary: #1e293b;
            --text-muted: #6b7a90;
            --primary-700: #15803d;
            --primary-600: #16a34a;
            --primary-500: #22c55e;
            --primary-400: #4ade80;
            --accent-orange: #fb923c;
            --accent-blue: #4f46e5;
            --accent-pink: #ec4899;
            --accent-purple: #8b5cf6;
            --border-soft: rgba(15, 45, 35, 0.08);
            --shadow-soft: 0 30px 60px -25px rgba(15, 45, 35, 0.25);
            --radius-large: 32px;
            --radius-medium: 24px;
            --radius-regular: 20px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--page-background);
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 600;
            color: var(--text-primary);
        }

        main {
            padding-bottom: 120px;
        }

        .site-footer {
            background-color: var(--card-dark);
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .site-footer h5 {
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
        }

        .site-footer a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
        }

        .site-footer a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .properties-page {
            background: transparent;
        }

        .properties-hero {
            position: relative;
            padding: clamp(84px, 9vw, 130px) 0 clamp(60px, 8vw, 110px);
            background: linear-gradient(135deg, #0f2f23 0%, #145232 55%, rgba(244, 246, 251, 0.08) 100%);
            color: rgba(255, 255, 255, 0.96);
            overflow: hidden;
        }

        .properties-hero::before,
        .properties-hero::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            opacity: 0.75;
        }

        .properties-hero::before {
            width: 320px;
            height: 320px;
            top: -140px;
            left: -160px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, rgba(15, 47, 35, 0) 70%);
        }

        .properties-hero::after {
            width: 420px;
            height: 420px;
            bottom: -160px;
            right: -180px;
            background: radial-gradient(circle, rgba(74, 222, 128, 0.18) 0%, rgba(15, 47, 35, 0) 70%);
        }

        .properties-hero h1,
        .properties-hero p,
        .properties-hero .lead {
            color: rgba(241, 245, 249, 0.9);
        }

        .properties-hero .hero-lead {
            color: rgba(241, 245, 249, 0.78);
        }

        .properties-hero .badge {
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 18px 45px -26px rgba(0, 0, 0, 0.4);
        }

        .hero-content-grid {
            display: grid;
            gap: 22px;
            max-width: 640px;
            position: relative;
            z-index: 2;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 999px;
            background: rgba(34, 197, 94, 0.18);
            color: #f8fafc;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-size: 0.82rem;
        }

        .hero-pill i {
            font-size: 1rem;
        }

        .hero-title {
            font-size: clamp(2.6rem, 4.6vw, 3.5rem);
            line-height: 1.1;
            color: #ffffff;
            margin: 0;
            text-shadow: 0 22px 48px rgba(0, 0, 0, 0.35);
        }

        .hero-cta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
        }

        .btn-hero-primary,
        .btn-hero-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border-radius: 999px;
            padding: 14px 28px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            text-decoration: none;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, #4ade80, #16a34a);
            color: #06150f;
            box-shadow: 0 18px 45px -22px rgba(74, 222, 128, 0.75);
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 26px 55px -24px rgba(74, 222, 128, 0.85);
        }

        .btn-hero-outline {
            border: 1px solid rgba(255, 255, 255, 0.35);
            color: #ffffff;
            backdrop-filter: blur(6px);
            padding: 14px 26px;
        }

        .btn-hero-outline:hover {
            background: rgba(255, 255, 255, 0.14);
            transform: translateY(-2px);
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 18px;
        }

        .hero-stat {
            padding: 18px;
            border-radius: 20px;
            background: rgba(6, 26, 17, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(4px);
            box-shadow: 0 18px 40px -30px rgba(6, 26, 17, 0.65);
        }

        .hero-stat strong {
            display: block;
            font-size: 1.8rem;
            color: #ffffff;
        }

        .hero-stat span {
            display: block;
            color: rgba(255, 255, 255, 0.74);
            font-size: 0.85rem;
            margin-top: 4px;
        }

        .properties-hero-card {
            background: var(--card-background);
            border-radius: var(--radius-large);
            padding: clamp(28px, 3vw, 36px);
            box-shadow: 0 38px 70px -38px rgba(10, 35, 26, 0.65);
            position: relative;
            overflow: hidden;
        }

        .properties-hero-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(140deg, rgba(34, 197, 94, 0.16), rgba(15, 47, 35, 0.05));
            z-index: 0;
        }

        .properties-hero-card h5 {
            font-weight: 600;
            color: var(--text-primary);
        }

        .properties-hero-card ul {
            position: relative;
            z-index: 1;
            color: var(--text-muted);
        }

        .properties-hero-card li {
            font-size: 0.93rem;
            padding: 12px 0;
        }

        .properties-hero-card li i {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(34, 197, 94, 0.14);
            color: var(--primary-600);
            font-size: 1.05rem;
            margin-right: 12px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.45);
        }

        .properties-hero-card p {
            position: relative;
            z-index: 1;
            color: var(--text-muted);
        }

        .hero-card-footer {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid rgba(15, 45, 35, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            position: relative;
            z-index: 1;
        }

        .hero-card-footer i {
            color: var(--primary-600);
        }

        .filter-panel {
            margin-top: clamp(-90px, -8vw, -120px);
            position: relative;
            z-index: 3;
        }

        .filter-card {
            position: relative;
            background: linear-gradient(145deg, rgba(34, 197, 94, 0.09), rgba(15, 47, 35, 0.05));
            border-radius: var(--radius-medium);
            padding: clamp(26px, 3vw, 34px);
            box-shadow: 0 45px 85px -50px rgba(14, 40, 25, 0.65);
            border: 1px solid rgba(34, 197, 94, 0.12);
            backdrop-filter: blur(8px);
            overflow: hidden;
        }

        .filter-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(74, 222, 128, 0.18), transparent 55%), radial-gradient(circle at bottom right, rgba(14, 116, 144, 0.18), transparent 60%);
            z-index: 0;
        }

        .filter-content {
            position: relative;
            z-index: 1;
        }

        .filter-card label {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 0.35rem;
            letter-spacing: 0.02em;
        }

        .filter-field {
            position: relative;
            padding: 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.78);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.35), 0 10px 24px -18px rgba(15, 45, 35, 0.4);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .filter-field:focus-within {
            transform: translateY(-2px);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.45), 0 18px 35px -20px rgba(34, 197, 94, 0.55);
        }

        .filter-card .form-select,
        .filter-card .form-control {
            border-radius: 14px;
            border: 1px solid rgba(15, 45, 35, 0.08);
            padding: 0.75rem 1rem;
            box-shadow: none;
            background: rgba(255, 255, 255, 0.85);
        }

        .filter-card .form-select:focus,
        .filter-card .form-control:focus {
            border-color: rgba(34, 197, 94, 0.65);
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        }

        .filter-card .input-group-text {
            background: rgba(34, 197, 94, 0.12);
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            color: var(--primary-600);
            border: 1px solid rgba(34, 197, 94, 0.18);
            border-right: none;
        }

        .filter-card .form-control {
            border-left: none;
        }

        #clear-filters {
            background: linear-gradient(135deg, #00c950, #00a63e) !important;
            color: #ffffff;
            font-weight: 600;
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 16px 32px -20px rgba(21, 128, 61, 0.55);
        }

        #clear-filters:hover {
            transform: translateY(-1px);
            box-shadow: 0 24px 38px -20px rgba(21, 128, 61, 0.55);
        }

        .properties-wrapper {
            padding: 72px 0 88px;
        }

        .properties-sidebar-card {
            background: var(--card-background);
            border-radius: var(--radius-medium);
            padding: 1.75rem;
            box-shadow: var(--shadow-soft);
        }

        .sticky-sidebar {
            position: sticky;
            top: 100px;
        }

        @media (max-width: 991px) {
            .filter-panel {
                margin-top: 0;
            }

            .sticky-sidebar {
                position: static;
                top: auto;
            }
        }

        .property-listing-card {
            position: relative;
            border-radius: var(--radius-medium);
            background: var(--card-background);
            border: 1px solid rgba(15, 45, 35, 0.06);
            overflow: hidden;
            transition: transform 0.28s ease, box-shadow 0.28s ease;
            box-shadow: 0 35px 75px -40px rgba(15, 45, 35, 0.55);
        }

        .property-listing-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.1), rgba(34, 197, 94, 0.05));
            opacity: 0;
            transition: opacity 0.28s ease;
            z-index: 1;
        }

        .property-listing-card::after {
            content: "";
            position: absolute;
            bottom: -90px;
            right: -90px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(74, 222, 128, 0.28) 0%, rgba(74, 222, 128, 0) 70%);
            transition: transform 0.35s ease, opacity 0.35s ease;
            opacity: 0.6;
            z-index: 0;
        }

        .property-listing-card:hover {
            transform: translateY(-10px) scale(1.01);
            box-shadow: 0 45px 90px -38px rgba(15, 45, 35, 0.65);
        }

        .property-listing-card:hover::before {
            opacity: 1;
        }

        .property-listing-card:hover::after {
            transform: translate(-16px, -16px) scale(1.08);
            opacity: 0.85;
        }

        .property-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .img-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 12px;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 35%, rgba(15, 23, 42, 0.7) 100%);
            color: #ffffff;
            z-index: 2;
        }

        .property-listing-card .card-body,
        .property-listing-card .position-relative {
            position: relative;
            z-index: 2;
        }

        .card-badges {
            display: flex;
            gap: 8px;
        }

        .badge-pill {
            border-radius: 999px;
            padding: 0.35rem 0.65rem;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .property-price {
            font-weight: 700;
            font-size: 1.15rem;
            text-shadow: 0 6px 18px rgba(0, 0, 0, 0.45);
        }

        .card-actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            gap: 8px;
        }

        .card-actions .btn-icon {
            background: rgba(255, 255, 255, 0.92);
            border-radius: 12px;
            padding: 0.35rem 0.55rem;
            border: 1px solid rgba(15, 45, 35, 0.08);
            color: var(--text-primary);
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .card-actions .btn-icon:hover {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: #ffffff;
        }

        .property-listing-card .card-body {
            padding: 1.2rem 1.15rem 1.35rem;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.92), rgba(244, 250, 246, 0.98));
        }

        .property-listing-card .card-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 0.35rem;
        }

        .property-listing-card .card-location {
            color: var(--text-muted);
            font-size: 0.92rem;
        }

        .property-specs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 0.9rem;
        }

        .spec-pill {
            background: rgba(15, 45, 35, 0.07);
            color: var(--text-primary);
            padding: 0.35rem 0.65rem;
            border-radius: 12px;
            font-size: 0.84rem;
            font-weight: 600;
        }

        .agent-logo {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(34, 197, 94, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary-600);
        }

        .btn-outline-success {
            font-weight: 600;
            border-radius: 999px;
            border-color: rgba(34, 197, 94, 0.3);
            color: var(--primary-600);
        }

        .btn-outline-success:hover {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: #ffffff;
        }

        @media (max-width: 767px) {
            .property-img {
                height: 180px;
            }
        }

        .share-modal .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 25px 70px rgba(12, 12, 20, 0.18);
        }

        .share-modal .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .share-modal .modal-body {
            padding-top: 0.5rem;
        }

        .share-link-group input {
            border-top-left-radius: 999px;
            border-bottom-left-radius: 999px;
        }

        .share-link-group .btn {
            border-top-right-radius: 999px;
            border-bottom-right-radius: 999px;
        }

        .share-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.75rem;
            margin-top: 1.25rem;
        }

        .share-chip {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            border-radius: 999px;
            padding: 0.55rem 0.85rem;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid rgba(34, 197, 94, 0.25);
            color: var(--text-primary);
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        .share-chip:hover {
            background-color: var(--primary-600);
            border-color: var(--primary-600);
            color: #ffffff;
        }

        .share-chip i {
            font-size: 1rem;
        }

        .ball-parent {
            position: relative;
            overflow: hidden;
            background: var(--card-background);
        }

        .hero-ball {
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.9;
            z-index: 0;
        }

        .hero-ball-top-right {
            top: -70px;
            right: -70px;
            background: #6fe6a9af;
        }

        .hero-ball-bottom-left {
            bottom: -80px;
            left: -80px;
            background: #a8f0cdad;
        }

        .ball-parent>*:not(.hero-ball) {
            position: relative;
            z-index: 1;
        }

        .categories-panel {
            border-radius: var(--radius-large);
            padding: clamp(32px, 4vw, 48px);
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--border-soft);
            position: relative;
            overflow: hidden;
        }

        .categories-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(34, 197, 94, 0.12), transparent 55%), radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.12), transparent 60%);
            z-index: 0;
        }

        .categories-panel .row {
            position: relative;
            z-index: 1;
        }

        .section-block {
            padding: 80px 0;
        }

        .section-heading {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 40px;
        }

        .section-eyebrow {
            font-size: 0.85rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--primary-600);
            margin-bottom: 8px;
        }

        .section-title {
            margin: 0;
            font-size: clamp(1.75rem, 3vw, 2.5rem);
            font-weight: 600;
        }

        .section-subtitle {
            margin: 8px 0 0;
            color: var(--text-muted);
            font-size: 0.98rem;
        }

        .link-cta {
            font-weight: 600;
            color: var(--primary-600);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .link-cta:hover {
            color: var(--primary-500);
        }

        .category-card {
            position: relative;
            background: var(--card-background);
            border-radius: var(--radius-regular);
            padding: 28px;
            box-shadow: 0 18px 40px -24px rgba(15, 45, 35, 0.35);
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            height: 100%;
        }

        .category-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
            opacity: 0;
            transition: opacity 0.25s ease;
            z-index: 1;
        }

        .category-card::after {
            content: "";
            position: absolute;
            top: -35px;
            right: -35px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            z-index: 1;
        }

        .category-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 44px rgba(15, 45, 35, 0.18);
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-card h5 {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .category-card p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.92rem;
            position: relative;
            z-index: 2;
        }

        .icon-shape {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #ffffff;
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }

        .card-green .icon-shape {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .card-green::after {
            background: rgba(34, 197, 94, 0.14);
        }

        .card-purple .icon-shape {
            background: linear-gradient(135deg, #6366f1, #4338ca);
        }

        .card-purple::after {
            background: rgba(99, 102, 241, 0.18);
        }

        .card-green-light .icon-shape {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        .card-green-light::after {
            background: rgba(249, 115, 22, 0.18);
        }

        .card-orange .icon-shape {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
        }

        .card-orange::after {
            background: rgba(14, 165, 233, 0.18);
        }

        .card-red .icon-shape {
            background: linear-gradient(135deg, #ec4899, #db2777);
        }

        .card-red::after {
            background: rgba(236, 72, 153, 0.18);
        }

        .card-pink .icon-shape {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .card-pink::after {
            background: rgba(139, 92, 246, 0.18);
        }
    </style>
</head>
<body>
    <?= $this->include('layouts/loader') ?>

    <?= $this->include('layouts/header') ?>

    <main class="properties-page">
        <!-- HERO SECTION (aligned with agents page) -->
        <section class="properties-hero">
            <div class="container">
                <div class="row gy-4 align-items-center">
                    <div class="col-lg-7">
                        <div class="hero-content-grid">
                            <span class="hero-pill"><i class="bi bi-stars"></i> Curated by 11 Acer</span>
                            <h1 class="hero-title">Find the Right Property Faster</h1>
                            <p class="hero-lead">Browse curated residential and commercial portfolios, refine results instantly, and unlock spaces tailored to your lifestyle or investments.</p>
                            <div class="hero-cta">
                                <a href="#properties-row" class="btn-hero-primary">Browse Listings <i class="bi bi-arrow-right"></i></a>
                                <a href="<?= site_url('contact') ?>" class="btn-hero-outline">Talk to an Expert</a>
                            </div>
                            <div class="hero-stats">
                                <div class="hero-stat">
                                    <strong>450+</strong>
                                    <span>Verified Listings</span>
                                </div>
                                <div class="hero-stat">
                                    <strong>98%</strong>
                                    <span>Client Satisfaction</span>
                                </div>
                                <div class="hero-stat">
                                    <strong>24x7</strong>
                                    <span>Dedicated Support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="properties-hero-card ball-parent">
                            <span class="hero-ball hero-ball-top-right"></span>
                            <span class="hero-ball hero-ball-bottom-left"></span>
                            <h5 class="fw-bold mb-3">Smart filters. Clean results.</h5>
                            <p class="small mb-3">Our intelligent filters deliver relevant options in real time, crafted for investors, families, and fast-scaling brands.</p>
                            <ul class="list-unstyled text-muted small mb-0">
                                <li class="d-flex align-items-center"><i class="bi bi-funnel"></i> Filter by property type, category, budget, and city in seconds.</li>
                                <li class="d-flex align-items-center"><i class="bi bi-geo-alt"></i> Pinpoint neighbourhoods that match your lifestyle or ROI goals.</li>
                                <li class="d-flex align-items-center"><i class="bi bi-house-check"></i> Compare key highlights before diving into detailed views.</li>
                            </ul>
                            <div class="hero-card-footer">
                                <span class="small text-muted"><i class="bi bi-shield-check me-2"></i>Data refreshed every 30 minutes</span>
                                <a href="<?= site_url('about') ?>" class="link-cta">Why 11 Acer<i class="bi bi-arrow-up-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FILTER PANEL -->
        <section class="filter-panel" data-aos="fade-down">
            <div class="container">
                <div class="filter-card">
                    <div class="filter-content">
                        <div class="row g-3 align-items-end">
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="filter-field">
                                    <label for="filter-query" class="form-label mb-1">Search</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input id="filter-query" type="text" class="form-control" placeholder="City, locality or keyword" value="<?= esc($initialQuery) ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-2">
                                <div class="filter-field">
                                    <label for="filter-property-type" class="form-label mb-1">Property Type</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                        <select id="filter-property-type" class="form-select">
                                            <option value="">All Property</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-2">
                                <div class="filter-field">
                                    <label for="filter-category" class="form-label mb-1">Category</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                                        <select id="filter-category" class="form-select">
                                            <option value="">All Categories</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-2">
                                <div class="filter-field">
                                    <label for="filter-price" class="form-label mb-1">Budget</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                        <select id="filter-price" class="form-select" data-initial-value="<?= esc($initialBudget) ?>">
                                            <option value="">Any Budget</option>
                                            <option value="up_to_50k" <?= $initialBudget === 'up_to_50k' ? 'selected' : '' ?>>Up to ₹50k</option>
                                            <option value="50k_1l" <?= $initialBudget === '50k_1l' ? 'selected' : '' ?>>₹50k - ₹1 L</option>
                                            <option value="1l_2l" <?= $initialBudget === '1l_2l' ? 'selected' : '' ?>>₹1 L - ₹2 L</option>
                                            <option value="2l_3l" <?= $initialBudget === '2l_3l' ? 'selected' : '' ?>>₹2 L - ₹3 L</option>
                                            <option value="3l_5l" <?= $initialBudget === '3l_5l' ? 'selected' : '' ?>>₹3 L - ₹5 L</option>
                                            <option value="5l_8l" <?= $initialBudget === '5l_8l' ? 'selected' : '' ?>>₹5 L - ₹8 L</option>
                                            <option value="8l_12l" <?= $initialBudget === '8l_12l' ? 'selected' : '' ?>>₹8 L - ₹12 L</option>
                                            <option value="above_12l" <?= $initialBudget === 'above_12l' ? 'selected' : '' ?>>Above ₹12 L</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-2">
                                <div class="filter-field">
                                    <label for="filter-city" class="form-label mb-1">City</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <select id="filter-city" class="form-select">
                                            <option value="">All Cities</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-1 d-flex align-items-end justify-content-md-end mt-2 mt-lg-0">
                                <button id="clear-filters" class="btn w-100">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- PROPERTY LISTINGS -->
        <section class="properties-wrapper" data-aos="fade-up">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="h4 mb-1">Property Listings</h2>
                                <p id="results-count" class="text-muted small mb-0"></p>
                            </div>
                            <div class="text-muted small d-flex align-items-center mt-2 mt-lg-0">
                                <i class="bi bi-lightning-charge me-1 text-warning"></i>
                                <span>Updated as new properties go live</span>
                            </div>
                        </div>

                        <div class="row g-4" id="properties-row">
                            <div class="col-12 text-center my-5" id="properties-loading">
                                <div class="spinner-border text-success" role="status"></div>
                                <p class="mt-3">Loading properties...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
               <!-- TRENDING PROPERTY CATEGORIES -->
        <section class="section-block" data-aos="fade-up">
            <div class="container">
                <div class="section-heading">
                    <div>
                        <p class="section-eyebrow">Trending Property Categories</p>
                        <h2 class="section-title">Explore popular property types</h2>
                        <p class="section-subtitle">Hand-picked segments to jump straight into relevant listings.</p>
                    </div>
                    <a class="link-cta" href="<?= site_url('properties') ?>">See all listings <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="categories-panel ball-parent">
                    <span class="hero-ball hero-ball-top-right"></span>
                    <span class="hero-ball hero-ball-bottom-left"></span>
                    <div class="row g-4">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="category-card card-green">
                                <div class="icon-shape"><i class="bi bi-house-heart-fill"></i></div>
                                <h5>Ready to Move Homes</h5>
                                <p>12,560+ properties</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="category-card card-purple">
                                <div class="icon-shape"><i class="bi bi-building-fill-check"></i></div>
                                <h5>Premium Estates</h5>
                                <p>7,840+ projects</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="category-card card-green-light">
                                <div class="icon-shape"><i class="bi bi-gem"></i></div>
                                <h5>Luxury Villas</h5>
                                <p>5,320+ listings</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="category-card card-orange">
                                <div class="icon-shape"><i class="bi bi-briefcase-fill"></i></div>
                                <h5>Commercial Offices</h5>
                                <p>3,950+ spaces</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="category-card card-red">
                                <div class="icon-shape"><i class="bi bi-people-fill"></i></div>
                                <h5>Co-working Hubs</h5>
                                <p>1,860+ options</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="category-card card-pink">
                                <div class="icon-shape"><i class="bi bi-shop-window"></i></div>
                                <h5>Retail Spaces</h5>
                                <p>2,410+ stores</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Share Modal -->
    <div class="modal fade share-modal" id="shareModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="text-uppercase text-muted small mb-1">Share Property</p>
                        <h5 class="modal-title share-property-title mb-0">Property Link</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group share-link-group">
                        <input type="text" class="form-control" id="shareLinkInput" readonly>
                        <button class="btn btn-success" type="button" id="copyShareLink">Copy Link</button>
                    </div>
                    <div class="share-actions">
                        <a href="<?= site_url('properties') ?>" id="shareWhatsApp" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="<?= site_url('properties') ?>" id="shareFacebook" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="<?= site_url('properties') ?>" id="shareInstagram" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                        <a href="<?= site_url('properties') ?>" id="shareX" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-twitter-x"></i> X
                        </a>
                        <a href="<?= site_url('properties') ?>" id="shareLinkedIn" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            (function(){
                const apiUrl = '<?= site_url('api/property/all') ?>';
                const propertyUrl = '<?= site_url('property') ?>';
                const container = document.getElementById('properties-row');
                const loading = document.getElementById('properties-loading');
                const queryInput = document.getElementById('filter-query');
                const typeSelect = document.getElementById('filter-property-type');
                const categorySelect = document.getElementById('filter-category');
                const priceSelect = document.getElementById('filter-price');
                const citySelect = document.getElementById('filter-city');
                const clearBtn = document.getElementById('clear-filters');
                const resultsCount = document.getElementById('results-count');
                const shareModalEl = document.getElementById('shareModal');
                const shareModalInstance = shareModalEl ? new bootstrap.Modal(shareModalEl) : null;
                const shareTitleEl = shareModalEl ? shareModalEl.querySelector('.share-property-title') : null;
                const shareLinkInput = document.getElementById('shareLinkInput');
                const copyShareBtn = document.getElementById('copyShareLink');
                const shareTargets = {
                    whatsapp: document.getElementById('shareWhatsApp'),
                    facebook: document.getElementById('shareFacebook'),
                    instagram: document.getElementById('shareInstagram'),
                    x: document.getElementById('shareX'),
                    linkedin: document.getElementById('shareLinkedIn'),
                };

                const params = new URLSearchParams(window.location.search);
                const initialQueryParam = (params.get('query') || '').trim();
                const initialPropertyTypeParam = (params.get('property_type') || '').trim();
                let listingTypeFilter = (params.get('listing_type') || '').trim().toLowerCase();
                const initialBudgetParam = (params.get('budget') || '').trim();
                const selectBudgetDefault = priceSelect ? (priceSelect.dataset.initialValue || initialBudgetParam) : '';
                if (queryInput && !queryInput.value && initialQueryParam) {
                    queryInput.value = initialQueryParam;
                }
                if (typeSelect && initialPropertyTypeParam) {
                    typeSelect.dataset.initialValue = initialPropertyTypeParam;
                }
                if (priceSelect && selectBudgetDefault && !priceSelect.value) {
                    priceSelect.value = selectBudgetDefault;
                }

                let allProperties = [];

                function safe(v, fallback='-') { return (v !== undefined && v !== null && v !== '') ? v : fallback; }
                function escapeAttr(v) { return String(v ?? '').replace(/"/g, '&quot;'); }

                function renderCard(p, idx = 0) {
                    const rawPrice = (p.pricing && p.pricing.price) ? p.pricing.price : (p.price || p.avg_price || p.price_per_sqft);
                    const price = safe(rawPrice, 'Contact for price');
                    const title = safe(p.property_name || p.title || p.name, 'Untitled Property');
                    const titleAttr = escapeAttr(title);
                    const agent = safe(p.agent_name || p.user_name || 'Agent');
                    const locality = p.locality || (p.details && (p.details.sublocality || p.details.locality)) || '';
                    const city = p.city || (p.details && p.details.city) || '';
                    const location = safe(locality ? `${locality}${city ? ', ' + city : ''}` : city, 'Location');
                    const propType = (p.property_type || (p.details && p.details.sub_property_type) || '').toString();
                    const propCategory = (p.property_category || p.category || '').toString();
                    const firstMedia = (p.media && p.media.length) ? p.media[0] : null;
                    const img = safe(firstMedia ? (firstMedia.file_url || firstMedia.url || firstMedia.fileUrl) : '', '<?= base_url('images/property.png') ?>');
                    const avgPrice = safe(p.avg_price || p.price_per_sqft || p.price, 'N/A');
                    const area = safe(p.area_sqft || (p.details && p.details.area_sqft), 'N/A');
                    const possession = safe(p.possession_status || (p.details && p.details.availability) || 'N/A');

                    const delay = Math.min(600, idx * 60);
                    return `
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="${delay}">
                        <a href="${propertyUrl}?id=${p.id}" class="text-decoration-none text-reset" aria-label="Open property ${titleAttr}">
                            <article class="property-listing-card position-relative" data-id="${p.id}">
                                <div class="position-relative" style="min-height:220px;">
                                    <img src="${img}" class="property-img" alt="${titleAttr}" loading="lazy">
                                    <div class="img-overlay">
                                        <div class="card-badges">
                                            ${(p.is_featured ? '<span class="badge bg-warning badge-pill text-dark">Featured</span>' : '')}
                                            ${(p.is_new ? '<span class="badge bg-success badge-pill">New</span>' : '')}
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end w-100">
                                            <div></div>
                                            <div class="text-end">
                                                <div class="property-price">${price}</div>
                                                <div class="small text-white-50">${propCategory || propType || ''}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-actions">
                                        <button type="button" class="btn-icon share-btn" title="Share" data-share-url="${propertyUrl}?id=${p.id}" data-share-title="${titleAttr}"><i class="bi bi-share"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">${title}</h3>
                                    <div class="card-location">by <strong>${agent}</strong> · ${location}</div>
                                    <div class="property-specs">
                                        <span class="spec-pill">${propCategory || propType || '—'}</span>
                                        <span class="spec-pill">Area: ${area}</span>
                                        <span class="spec-pill">Possession: ${possession}</span>
                                        <span class="spec-pill">Avg: ${avgPrice}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="agent-logo">${(agent || 'A').split(' ').map(s => s[0] || '').slice(0,2).join('')}</div>
                                            <div class="small">
                                                <div class="fw-bold">${agent}</div>
                                                <div class="text-muted">Listing Agent</div>
                                            </div>
                                        </div>
                                        <div style="min-width: 140px;">
                                            <button class="btn btn-outline-success btn-sm w-100">Contact Now</button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </a>
                    </div>`;
                }

                function openShareModal(url, title = 'Property Link') {
                    if (!shareModalInstance || !shareLinkInput) return;
                    const cleanUrl = url || window.location.href;
                    shareLinkInput.value = cleanUrl;
                    if (shareTitleEl) shareTitleEl.textContent = title;

                    const encodedUrl = encodeURIComponent(cleanUrl);
                    const encodedMessage = encodeURIComponent(`${title} - ${cleanUrl}`);

                    shareTargets.whatsapp && (shareTargets.whatsapp.href = `https://wa.me/?text=${encodedMessage}`);
                    shareTargets.facebook && (shareTargets.facebook.href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`);
                    shareTargets.instagram && (shareTargets.instagram.href = `https://www.instagram.com/?url=${encodedUrl}`);
                    shareTargets.x && (shareTargets.x.href = `https://twitter.com/intent/tweet?text=${encodedMessage}`);
                    shareTargets.linkedin && (shareTargets.linkedin.href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`);

                    shareModalInstance.show();
                }

                function parsePrice(val) {
                    if (val === undefined || val === null) return NaN;
                    if (typeof val === 'number') return val;
                    try {
                        // remove commas, currency symbols
                        const cleaned = String(val).replace(/[^0-9.]/g, '');
                        return parseFloat(cleaned) || NaN;
                    } catch(e) { return NaN; }
                }

                function extractTypes(p) {
                    if (!p || typeof p !== 'object') {
                        return [];
                    }
                    const details = p.details || {};
                    const values = [
                        p.property_type,
                        p.type,
                        details.property_type,
                        details.sub_property_type
                    ];
                    return values.filter(Boolean).map((val) => val.toString());
                }
                function extractCategory(p) {
                    return (p.category || p.property_category || (p.details && p.details.category) || '').toString();
                }

                function collectQueryCandidates(p) {
                    if (!p || typeof p !== 'object') {
                        return [];
                    }
                    const details = p.details || {};
                    // Aggregate primary fields so free-text filters cover all relevant labels.
                    return [
                        p.city,
                        p.locality,
                        p.property_name,
                        p.title,
                        details.city,
                        details.locality,
                        details.sublocality,
                        details.sub_locality,
                        details.property_name,
                        details.title
                    ].filter(Boolean).map((val) => val.toString());
                }

                // Budget ranges expressed in INR.
                const budgetRanges = {
                    up_to_50k: { min: 0, max: 50000 },
                    '50k_1l': { min: 50000, max: 100000 },
                    '1l_2l': { min: 100000, max: 200000 },
                    '2l_3l': { min: 200000, max: 300000 },
                    '3l_5l': { min: 300000, max: 500000 },
                    '5l_8l': { min: 500000, max: 800000 },
                    '8l_12l': { min: 800000, max: 1200000 },
                    above_12l: { min: 1200000, max: null }
                };

                function passesBudgetFilter(values, rangeKey) {
                    if (!rangeKey || !budgetRanges[rangeKey]) {
                        return true;
                    }
                    const range = budgetRanges[rangeKey];
                    return values.some(function(val) {
                        if (Number.isNaN(val) || val <= 0) {
                            return false;
                        }
                        if (range.min !== null && val < range.min) {
                            return false;
                        }
                        if (range.max !== null && val > range.max) {
                            return false;
                        }
                        return true;
                    });
                }

                // Interpret hero listing modes inside listings grid.
                function matchesListingType(property, filterValue) {
                    if (!filterValue) {
                        return true;
                    }
                    const target = filterValue.toLowerCase();
                    const transaction = (property.transaction_type || property.transactionType || '').toLowerCase();
                    const category = (property.property_category || property.category || '').toLowerCase();
                    const status = (property.status || '').toLowerCase();
                    const details = property.details || {};
                    const availability = (details.availability || '').toLowerCase();

                    if (target === 'rent') {
                        return transaction.includes('rent');
                    }

                    if (target === 'commercial') {
                        return category.includes('commercial');
                    }

                    if (target === 'new_project') {
                        if (availability && availability !== 'ready_to_move' && availability !== 'ready to move') {
                            return true;
                        }
                        if (details.expected_completion) {
                            return true;
                        }
                        if (category.includes('project')) {
                            return true;
                        }
                        if (status && (status.includes('upcoming') || status.includes('launch'))) {
                            return true;
                        }
                        if (transaction && transaction !== 'rent') {
                            return true;
                        }
                        return false;
                    }

                    return true;
                }

                function populateFilters(items) {
                    const types = new Set();
                    const categories = new Set();
                    const cities = new Set();
                    const initialType = (typeSelect && typeSelect.dataset && typeSelect.dataset.initialValue)
                        ? typeSelect.dataset.initialValue.trim()
                        : '';

                    items.forEach(p => {
                        const typeValues = extractTypes(p);
                        typeValues.forEach((value) => {
                            if (value) {
                                types.add(value);
                            }
                        });
                        const c = extractCategory(p);
                        if (c) categories.add(c);
                        if (p.city) cities.add(p.city);
                        // details may contain city/locality too
                        if (p.details && p.details.city) cities.add(p.details.city);
                    });

                    if (initialType) {
                        types.add(initialType);
                    }

                    // helper to fill a select
                    function fill(selectEl, values, placeholder) {
                        if (!selectEl) return;
                        const cur = selectEl.value || '';
                        selectEl.innerHTML = '';
                        const opt = document.createElement('option'); opt.value = ''; opt.textContent = placeholder; selectEl.appendChild(opt);
                        Array.from(values).sort().forEach(v => {
                            const o = document.createElement('option'); o.value = v; o.textContent = v; selectEl.appendChild(o);
                        });
                        // restore if still available
                        if (cur) selectEl.value = cur;
                    }

                    fill(typeSelect, types, 'All Propertys');
                    fill(categorySelect, categories, 'All Categories');
                    fill(citySelect, cities, 'All Cities');

                    if (typeSelect && initialType) {
                        const normalized = initialType.toLowerCase();
                        const options = Array.prototype.slice.call(typeSelect.options || []);
                        const matched = options.find(function(option) {
                            return option.value.toLowerCase() === normalized;
                        });
                        if (matched) {
                            typeSelect.value = matched.value;
                        } else {
                            typeSelect.value = initialType;
                        }
                    }
                }

                function applyFilters() {
                    const queryVal = queryInput ? queryInput.value.trim().toLowerCase() : '';
                    const typeVal = typeSelect ? typeSelect.value.trim().toLowerCase() : '';
                    const catVal = categorySelect ? categorySelect.value.trim().toLowerCase() : '';
                    const priceVal = priceSelect ? (priceSelect.value || '').trim() : '';
                    const cityVal = citySelect ? citySelect.value.trim().toLowerCase() : '';

                    const filtered = allProperties.filter(p => {
                        const details = p && typeof p === 'object' ? (p.details || {}) : {};

                        if (listingTypeFilter && !matchesListingType(p, listingTypeFilter)) {
                            return false;
                        }

                        if (queryVal) {
                            const queryMatches = collectQueryCandidates(p)
                                .map(value => value.toLowerCase())
                                .some(value => value.includes(queryVal));
                            if (!queryMatches) {
                                return false;
                            }
                        }

                        if (typeVal) {
                            const typeMatches = extractTypes(p)
                                .map(value => value.toLowerCase())
                                .some(value => value.includes(typeVal));
                            if (!typeMatches) {
                                return false;
                            }
                        }

                        if (catVal) {
                            const categoryValue = extractCategory(p).toLowerCase();
                            if (!categoryValue.includes(catVal)) {
                                return false;
                            }
                        }

                        if (cityVal) {
                            const cityCandidates = [
                                p.city,
                                p.locality,
                                details.city,
                                details.locality,
                                details.sublocality,
                                details.sub_locality
                            ].filter(Boolean).map(value => value.toString().toLowerCase());
                            if (!cityCandidates.some(value => value.includes(cityVal))) {
                                return false;
                            }
                        }

                        const rawPrice = parsePrice((p.pricing && p.pricing.price) ? p.pricing.price : (p.price || p.avg_price || p.price_per_sqft));
                        const priceCandidates = [];
                        if (!isNaN(rawPrice) && rawPrice > 0) {
                            priceCandidates.push(rawPrice);
                            if (rawPrice < 100000) {
                                priceCandidates.push(rawPrice * 100000);
                            }
                        }

                        if (priceVal && !passesBudgetFilter(priceCandidates, priceVal)) {
                            return false;
                        }

                        return true;
                    });

                    resultsCount.textContent = `${filtered.length} result${filtered.length !== 1 ? 's' : ''}`;

                    if (!filtered || filtered.length === 0) {
                        container.innerHTML = '<div class="col-12 text-center py-5">No properties found.</div>';
                        return;
                    }

                    container.innerHTML = filtered.map((p, idx) => renderCard(p, idx)).join('');
                }

                async function loadProperties(){
                    try{
                        const res = await fetch(apiUrl);
                        if (!res.ok) throw new Error('Network response not ok: ' + res.status);
                        const payload = await res.json();
                        loading?.remove();

                        let items = [];
                        if (Array.isArray(payload)) items = payload;
                        else if (payload && Array.isArray(payload.data)) items = payload.data;
                        else if (payload && payload.status === 'success' && Array.isArray(payload.data)) items = payload.data;

                        allProperties = items || [];

                        if (!allProperties || allProperties.length === 0) {
                            container.innerHTML = '<div class="col-12 text-center py-5">No properties found.</div>';
                            resultsCount.textContent = '0 results';
                            console.info('Properties API returned empty. Payload:', payload);
                            return;
                        }

                        populateFilters(allProperties);
                        applyFilters();
                    }catch(err){
                        console.error('Error loading properties', err);
                        loading?.remove();
                        container.innerHTML = `<div class="col-12 text-center text-danger py-5">Failed to load properties. ${err.message}</div>`;
                        resultsCount.textContent = '';
                    }
                }

                // wire events
                let queryDebounce;
                if (queryInput) {
                    queryInput.addEventListener('input', () => {
                        clearTimeout(queryDebounce);
                        queryDebounce = setTimeout(applyFilters, 250);
                    });
                }

                [typeSelect, categorySelect, priceSelect, citySelect].forEach(el => {
                    if (!el) return;
                    el.addEventListener('change', applyFilters);
                });
                if (clearBtn) clearBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (queryInput) {
                        queryInput.value = '';
                    }
                    if (typeSelect) {
                        typeSelect.value = '';
                        if (typeSelect.dataset) {
                            typeSelect.dataset.initialValue = '';
                        }
                    }
                    [categorySelect, priceSelect, citySelect].forEach(el => { if (el) el.value = ''; });
                    applyFilters();
                });

                container?.addEventListener('click', (event) => {
                    const shareBtn = event.target.closest('.share-btn');
                    if (!shareBtn) return;
                    event.preventDefault();
                    event.stopPropagation();
                    openShareModal(shareBtn.getAttribute('data-share-url'), shareBtn.getAttribute('data-share-title') || 'Property Link');
                });

                if (copyShareBtn && shareLinkInput) {
                    copyShareBtn.addEventListener('click', async () => {
                        const link = shareLinkInput.value;
                        if (!link) return;
                        try {
                            if (navigator.clipboard?.writeText) {
                                await navigator.clipboard.writeText(link);
                            } else {
                                shareLinkInput.select();
                                document.execCommand('copy');
                                shareLinkInput.blur();
                            }
                            copyShareBtn.textContent = 'Copied!';
                            setTimeout(() => copyShareBtn.textContent = 'Copy Link', 1500);
                        } catch (error) {
                            console.error('Copy failed', error);
                        }
                    });
                }

                document.addEventListener('DOMContentLoaded', loadProperties);
            })();
        </script>
</body>
</html>
