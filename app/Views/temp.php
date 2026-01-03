<?php
$page_title = '11 Acer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <style>
        :root {
            --page-background: #f4f6fb;
            --section-muted: #eef3f1;
            --card-background: #ffffff;
            --card-dark: #0f2f23;
            --text-primary: #1e293b;
            --text-muted: #6b7a90;
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
            font-family: "Inter", sans-serif;
            background: var(--page-background);
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        main {
            padding-bottom: 120px;
        }

        .section-block {
            padding: 80px 0;
        }

        .section-block + .section-block {
            border-top: 1px solid rgba(15, 45, 35, 0.06);
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

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(22, 163, 74, 0.12);
            color: var(--primary-600);
        }

        .pill-light {
            background: rgba(76, 175, 80, 0.08);
            color: #0f5132;
        }

        .action-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(15, 45, 35, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--text-primary);
            transition: all 0.2s ease;
        }

        .action-icon:hover {
            background: var(--primary-600);
            color: #ffffff;
            border-color: var(--primary-600);
        }

        .btn-soft-primary {
            background: var(--primary-600);
            border-radius: 999px;
            border: none;
            color: #ffffff;
            padding: 14px 30px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .btn-soft-primary:hover {
            background: #15803d;
            color: #ffffff;
        }

        .btn-soft-outline {
            border-radius: 999px;
            border: 1px solid rgba(22, 163, 74, 0.2);
            color: var(--primary-600);
            padding: 14px 30px;
            font-weight: 600;
            font-size: 0.95rem;
            background: transparent;
        }

        .btn-soft-outline:hover {
            border-color: var(--primary-600);
            color: #ffffff;
            background: var(--primary-600);
        }

        .hero-section {
            position: relative;
            padding: clamp(84px, 9vw, 140px) 0 clamp(64px, 8vw, 120px);
            background: linear-gradient(135deg, #0f2f23 0%, #145232 55%, rgba(244, 246, 251, 0.1) 100%);
            color: rgba(255, 255, 255, 0.94);
            overflow: hidden;
        }

        .hero-section::after {
            content: "";
            position: absolute;
            top: -140px;
            right: -160px;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(74, 222, 128, 0.28) 0%, rgba(15, 47, 35, 0) 70%);
            opacity: 0.8;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: clamp(32px, 4vw, 60px);
            align-items: center;
        }

        .hero-copy {
            display: grid;
            gap: clamp(18px, 2vw, 30px);
            max-width: 580px;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(34, 197, 94, 0.14);
            backdrop-filter: blur(6px);
            color: #f8fafc;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .hero-title {
            margin: 0;
            font-size: clamp(2.4rem, 4vw, 3.2rem);
            font-weight: 700;
            line-height: 1.15;
            color: #ffffff;
        }

        .hero-subtitle {
            margin: 0;
            font-size: 1.05rem;
            line-height: 1.7;
            color: rgba(241, 245, 249, 0.78);
        }

        .hero-metrics {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
        }

        .hero-metric {
            min-width: 120px;
        }

        .hero-metric strong {
            display: block;
            font-size: clamp(1.8rem, 3vw, 2.4rem);
            font-weight: 700;
            color: #ffffff;
        }

        .hero-metric span {
            display: block;
            color: rgba(203, 213, 225, 0.85);
            font-size: 0.9rem;
            margin-top: 6px;
        }

        .hero-search-card {
            background: #ffffff;
            border-radius: var(--radius-large);
            padding: clamp(28px, 3vw, 36px);
            box-shadow: 0 38px 70px -38px rgba(10, 35, 26, 0.65);
            position: relative;
            color: var(--text-primary);
        }

        .hero-search-heading {
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .hero-search-subtitle {
            margin: 0 0 24px;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .hero-search-card .form-label {
            font-weight: 600;
            color: var(--text-primary);
        }

        .hero-search-card .form-control,
        .hero-search-card .form-select {
            border-radius: 14px;
            border-color: rgba(15, 45, 35, 0.18);
            padding: 12px 16px;
            box-shadow: none;
        }

        .hero-search-card .form-control:focus,
        .hero-search-card .form-select:focus {
            border-color: rgba(34, 197, 94, 0.6);
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.18);
        }

        .hero-search-card .btn-success {
            border-radius: 999px;
            padding: 14px 22px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 16px 30px -18px rgba(34, 197, 94, 0.85);
        }

        .hero-quick-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .hero-quick-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 999px;
            background: rgba(34, 197, 94, 0.12);
            color: var(--primary-600);
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .hero-quick-link:hover {
            background: rgba(34, 197, 94, 0.2);
            color: var(--primary-600);
        }

        .hero-assurance {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .hero-assurance i {
            color: var(--primary-600);
            font-size: 1.05rem;
        }

        .featured-card {
            background: linear-gradient(125deg, #f8fffb 0%, #f2fbf4 40%, #eef9f3 100%);
            border-radius: var(--radius-large);
            padding: clamp(28px, 3vw, 48px);
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }

        .featured-card::after {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.16) 0%, rgba(23, 146, 68, 0) 70%);
            top: -120px;
            right: -140px;
        }

        .featured-card-inner {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: clamp(24px, 4vw, 56px);
            position: relative;
            z-index: 1;
        }

        .featured-meta {
            display: grid;
            gap: 16px;
        }

        .featured-meta h3 {
            font-size: clamp(1.9rem, 3vw, 2.45rem);
            font-weight: 600;
            margin: 0;
        }

        .featured-meta p {
            margin: 0;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .featured-price {
            color: var(--primary-600);
            font-size: clamp(2rem, 4vw, 2.9rem);
            font-weight: 700;
        }

        .featured-meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 14px;
            margin: 20px 0 30px;
        }

        .meta-chip {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(22, 163, 74, 0.08);
            color: var(--primary-600);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .featured-sidebar {
            background: rgba(255, 255, 255, 0.8);
            border-radius: var(--radius-medium);
            padding: 24px;
            border: 1px solid rgba(22, 163, 74, 0.08);
            backdrop-filter: blur(10px);
            display: grid;
            gap: 20px;
        }

        .featured-sidebar .property-overview {
            display: grid;
            gap: 16px;
        }

        .property-overview-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed rgba(23, 146, 68, 0.15);
            font-size: 0.92rem;
            color: var(--text-muted);
        }

        .property-overview-item:last-child {
            border-bottom: 0;
        }

        .property-overview-item strong {
            color: var(--text-primary);
            font-weight: 600;
        }

        .featured-image {
            position: relative;
            border-radius: var(--radius-medium);
            overflow: hidden;
            height: 220px;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .featured-image::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.3) 100%);
        }

        .featured-image-caption {
            position: absolute;
            left: 20px;
            bottom: 18px;
            color: #ffffff;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .category-card {
            border-radius: var(--radius-medium);
            background: var(--card-background);
            padding: 28px;
            box-shadow: 0 18px 40px -24px rgba(15, 45, 35, 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 30px 50px -30px rgba(15, 45, 35, 0.45);
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
        }

        .category-card:nth-child(1) .icon-shape { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .category-card:nth-child(2) .icon-shape { background: linear-gradient(135deg, #6366f1, #4338ca); }
        .category-card:nth-child(3) .icon-shape { background: linear-gradient(135deg, #f97316, #ea580c); }
        .category-card:nth-child(4) .icon-shape { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
        .category-card:nth-child(5) .icon-shape { background: linear-gradient(135deg, #ec4899, #db2777); }
        .category-card:nth-child(6) .icon-shape { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

        .category-card h5 {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .category-card p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.92rem;
        }

        .project-card {
            position: relative;
            border-radius: var(--radius-large);
            overflow: hidden;
            min-height: 340px;
            display: flex;
            align-items: flex-end;
            color: #ffffff;
            box-shadow: 0 25px 60px -30px rgba(18, 18, 18, 0.6);
        }

        .project-card img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .project-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(10, 24, 18, 0.05) 0%, rgba(5, 22, 14, 0.85) 100%);
        }

        .project-card:hover img {
            transform: scale(1.05);
        }

        .project-info {
            position: relative;
            z-index: 2;
            padding: 28px;
            width: 100%;
        }

        .project-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(6px);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .project-info h5 {
            font-size: 1.3rem;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .project-info p {
            margin: 0;
            font-size: 0.95rem;
        }

        .project-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-top: 16px;
        }

        .project-meta span {
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.85);
        }

        .project-meta .btn {
            border-radius: 999px;
            padding: 10px 22px;
            font-weight: 600;
            border-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .project-meta .btn:hover {
            background: #ffffff;
            color: var(--primary-600);
        }

        .choice-card {
            background: var(--card-background);
            border-radius: var(--radius-medium);
            padding: 32px;
            box-shadow: 0 20px 50px -30px rgba(15, 45, 35, 0.4);
            height: 100%;
        }

        .choice-card .choice-icon {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary-600);
            background: rgba(22, 163, 74, 0.12);
            margin-bottom: 18px;
        }

        .choice-card h5 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .choice-card p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .locality-card {
            border-radius: var(--radius-regular);
            background: var(--card-background);
            padding: 24px;
            box-shadow: 0 22px 48px -30px rgba(15, 45, 35, 0.45);
            height: 100%;
        }

        .locality-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }

        .locality-header h6 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
        }

        .trend-badge {
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(22, 163, 74, 0.1);
            color: var(--primary-600);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .locality-meta {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .locality-change {
            font-weight: 600;
            color: var(--primary-600);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .locality-change.down {
            color: #dc2626;
        }

        .city-stat-card {
            background: var(--card-background);
            border-radius: var(--radius-medium);
            padding: 28px;
            box-shadow: 0 25px 60px -32px rgba(15, 45, 35, 0.5);
            height: 100%;
            display: grid;
            gap: 18px;
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .stat-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-600);
        }

        .stat-subtext {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.92rem;
        }

        .progress-bar-wrapper {
            height: 10px;
            border-radius: 999px;
            background: rgba(22, 163, 74, 0.12);
            overflow: hidden;
        }

        .progress-indicator {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(135deg, #22c55e 0%, #0ea5e9 100%);
        }

        .builder-track {
            background: linear-gradient(135deg, #0d3326 0%, #0f1e18 100%);
            border-radius: var(--radius-large);
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        .builder-track::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at right, rgba(34, 197, 94, 0.25) 0%, transparent 55%);
        }

        .builder-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 22px;
            padding: 28px 20px;
            text-align: center;
            backdrop-filter: blur(6px);
            color: #ffffff;
            min-height: 160px;
        }

        .builder-logo {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            margin: 0 auto 18px;
            background: rgba(255, 255, 255, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .builder-card h6 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .builder-card span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .testimonials-section {
            background: linear-gradient(180deg, #0f2f23 0%, #0a1f19 100%);
            border-radius: var(--radius-large);
            padding: 72px 56px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .testimonials-section::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(34, 197, 94, 0.2) 0%, transparent 60%);
        }

        .testimonial-card {
            background: rgba(16, 44, 32, 0.65);
            border-radius: var(--radius-medium);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 40px;
            height: 100%;
            display: grid;
            gap: 18px;
            backdrop-filter: blur(8px);
        }

        .testimonial-quote {
            font-size: 1.05rem;
            line-height: 1.7;
            margin: 0;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .author-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .testimonial-author strong {
            display: block;
            font-weight: 600;
            font-size: 1rem;
        }

        .testimonial-author span {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .rating-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(34, 197, 94, 0.16);
            color: #bbf7d0;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .property-card {
            background: var(--card-background);
            border-radius: var(--radius-medium);
            box-shadow: 0 25px 55px -32px rgba(15, 45, 35, 0.45);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .property-card img {
            height: 200px;
            object-fit: cover;
        }

        .property-body {
            padding: 24px;
            display: grid;
            gap: 16px;
        }

        .property-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .property-price {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-600);
        }

        .property-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .property-meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .accordion.custom-accordion .accordion-item {
            border: none;
            border-radius: var(--radius-medium);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 18px 40px -28px rgba(15, 45, 35, 0.45);
            margin-bottom: 16px;
            overflow: hidden;
        }

        .custom-accordion .accordion-button {
            padding: 20px 26px;
            font-weight: 600;
            font-size: 1rem;
            color: var(--text-primary);
            background: transparent;
        }

        .custom-accordion .accordion-button:not(.collapsed) {
            color: var(--primary-600);
            background: rgba(22, 163, 74, 0.08);
            box-shadow: inset 0 -1px 0 rgba(22, 163, 74, 0.1);
        }

        .custom-accordion .accordion-body {
            padding: 0 26px 24px;
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        @media (max-width: 991.98px) {
            .hero-section {
                padding: 72px 0 90px;
            }

            .hero-metrics {
                gap: 20px;
            }

            .hero-search-card {
                margin-top: 12px;
            }

            .section-block {
                padding: 60px 0;
            }

            .section-heading {
                align-items: flex-start;
            }

            .featured-card {
                padding: 36px 24px;
            }

            .testimonials-section {
                padding: 56px 32px;
            }
        }

        @media (max-width: 575.98px) {
            .hero-section {
                padding: 64px 0 72px;
            }

            .hero-copy {
                gap: 16px;
            }

            .hero-title {
                font-size: 2.1rem;
            }

            .hero-search-card {
                padding: 24px;
            }

            .hero-metrics {
                flex-direction: column;
            }

            main {
                padding-bottom: 80px;
            }

            .section-block {
                padding: 48px 0;
            }

            .section-heading {
                margin-bottom: 28px;
            }

            .choice-card,
            .locality-card,
            .city-stat-card,
            .property-card {
                border-radius: 18px;
            }

            .featured-card::after {
                width: 220px;
                height: 220px;
                top: -70px;
                right: -50px;
            }

            .testimonials-section {
                padding: 44px 24px;
            }

            .testimonial-card {
                padding: 28px;
            }
        }
    </style>
</head>
<body>
    <?= $this->include('layouts/header') ?>

    <section class="hero-section">
        <div class="container">
            <div class="hero-inner">
                <div class="hero-copy">
                    <span class="hero-pill"><i class="bi bi-stars"></i> Trusted property advisors</span>
                    <h1 class="hero-title">Find your next home with our end-to-end guidance</h1>
                    <p class="hero-subtitle">Book verified site visits, compare loan offers, and close with confidence backed by our 24x7 on-ground team.</p>
                    <div class="hero-metrics">
                        <div class="hero-metric">
                            <strong>3.2K+</strong>
                            <span>Families moved in happily</span>
                        </div>
                        <div class="hero-metric">
                            <strong>980</strong>
                            <span>Builder &amp; bank partners</span>
                        </div>
                        <div class="hero-metric">
                            <strong>24x7</strong>
                            <span>Dedicated concierge desk</span>
                        </div>
                    </div>
                </div>
                <div class="hero-search-card">
                    <h2 class="hero-search-heading">Plan your site visit in minutes</h2>
                    <p class="hero-search-subtitle">Tell us where and what you are looking for. We will curate shortlisted projects instantly.</p>
                    <form class="hero-search-form" action="<?= site_url('properties') ?>" method="get">
                        <div class="mb-3">
                            <label class="form-label" for="heroLocation">Preferred location</label>
                            <input type="text" class="form-control form-control-lg" id="heroLocation" name="q" placeholder="City, locality or project name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="heroConfiguration">Configuration</label>
                            <select id="heroConfiguration" name="configuration" class="form-select form-select-lg">
                                <option value="">Select</option>
                                <option value="1bhk">1 BHK</option>
                                <option value="2bhk">2 BHK</option>
                                <option value="3bhk">3 BHK</option>
                                <option value="4bhk">4 BHK+</option>
                                <option value="villa">Villa</option>
                                <option value="plot">Plot</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="heroBudget">Budget range</label>
                            <select id="heroBudget" name="budget" class="form-select form-select-lg">
                                <option value="">Any</option>
                                <option value="25">Below ₹25 Lakh</option>
                                <option value="50">₹25 Lakh - ₹50 Lakh</option>
                                <option value="100">₹50 Lakh - ₹1 Cr</option>
                                <option value="200">₹1 Cr - ₹2 Cr</option>
                                <option value="200+">Above ₹2 Cr</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100">Search Homes</button>
                    </form>
                    <div class="hero-quick-links">
                        <a class="hero-quick-link" href="<?= site_url('properties') ?>"><i class="bi bi-compass"></i> Explore listings</a>
                        <a class="hero-quick-link" href="<?= site_url('services') ?>"><i class="bi bi-people"></i> Talk to experts</a>
                        <a class="hero-quick-link" href="<?= site_url('contact') ?>"><i class="bi bi-calendar-check"></i> Book a visit</a>
                    </div>
                    <div class="hero-assurance"><i class="bi bi-shield-check"></i> Zero brokerage on direct builder inventory</div>
                </div>
            </div>
        </div>
    </section>

    <main class="py-5">
        <section class="section-block section-featured">
            <div class="container">
                <div class="section-heading">
                    <div>
                        <p class="section-eyebrow">Featured Property</p>
                        <h2 class="section-title">Find selected properties for your future</h2>
                        <p class="section-subtitle">Our premium listings handpicked by real estate advisors</p>
                    </div>
                    <a class="link-cta" href="#">View all <i class="bi bi-arrow-up-right"></i></a>
                </div>
                <div class="featured-card">
                    <div class="featured-card-inner">
                        <div class="featured-meta">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                <span class="pill"><i class="bi bi-star-fill"></i> Featured</span>
                                <span class="pill-light"><i class="bi bi-award"></i> Luxury</span>
                            </div>
                            <h3>Azure Haven Residences</h3>
                            <p>89 Satori Plaza, Dallas, TX 75227, USA</p>
                            <p>Experience luxury living in this modern residence featuring floor-to-ceiling glass, a private sky lounge, and an expansive rooftop infinity pool overlooking the city skyline.</p>
                            <div class="featured-meta-grid">
                                <span class="meta-chip"><i class="bi bi-houses"></i> 4 Bed</span>
                                <span class="meta-chip"><i class="bi bi-droplet-half"></i> 3 Bath</span>
                                <span class="meta-chip"><i class="bi bi-arrows-fullscreen"></i> 2,640 sqft</span>
                                <span class="meta-chip"><i class="bi bi-car-front"></i> 2 Car</span>
                            </div>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="#" class="btn-soft-primary">View Details</a>
                                <a href="#" class="btn-soft-outline">Schedule Visit</a>
                            </div>
                        </div>
                        <div class="featured-sidebar">
                            <div class="d-flex align-items-start justify-content-between gap-3">
                                <div>
                                    <span class="text-uppercase text-muted fw-semibold" style="font-size: 0.78rem;">Starting from</span>
                                    <div class="featured-price">₹ 2,350,000</div>
                                    <p class="mb-1 text-muted small">ID: 02617 • Available now</p>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="#" class="action-icon"><i class="bi bi-share"></i></a>
                                    <a href="#" class="action-icon"><i class="bi bi-heart"></i></a>
                                </div>
                            </div>
                            <div class="property-overview">
                                <div class="property-overview-item">
                                    <span>Estimated EMI</span>
                                    <strong>₹ 1.28 L / month</strong>
                                </div>
                                <div class="property-overview-item">
                                    <span>Price per sqft</span>
                                    <strong>₹ 890</strong>
                                </div>
                                <div class="property-overview-item">
                                    <span>Year built</span>
                                    <strong>2025</strong>
                                </div>
                                <div class="property-overview-item">
                                    <span>Neighborhood score</span>
                                    <strong>9.4 / 10</strong>
                                </div>
                            </div>
                            <div class="featured-image">
                                <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1200&q=80" alt="Azure Haven Residences exterior">
                                <div class="featured-image-caption"><i class="bi bi-camera-video"></i> Virtual tour available</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block">
            <div class="container">
                <div class="section-heading">
                    <div>
                        <p class="section-eyebrow">Trending Property Categories</p>
                        <h2 class="section-title">Explore our popular property types</h2>
                        <p class="section-subtitle">Curated for every lifestyle, from premium villas to smart studios</p>
                    </div>
                    <a class="link-cta" href="#">See all categories <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-2">
                        <div class="category-card">
                            <div class="icon-shape"><i class="bi bi-house-heart-fill"></i></div>
                            <h5>Ready to Move Homes</h5>
                            <p>12,560+ properties</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-2">
                        <div class="category-card">
                            <div class="icon-shape"><i class="bi bi-building-fill-check"></i></div>
                            <h5>Premium Estates</h5>
                            <p>7,840+ projects</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-2">
                        <div class="category-card">
                            <div class="icon-shape"><i class="bi bi-gem"></i></div>
                            <h5>Luxury Villas</h5>
                            <p>5,320+ listings</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-2">
                        <div class="category-card">
                            <div class="icon-shape"><i class="bi bi-briefcase-fill"></i></div>
                            <h5>Commercial Offices</h5>
                            <p>3,950+ spaces</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-2">
                        <div class="category-card">
                            <div class="icon-shape"><i class="bi bi-people-fill"></i></div>
                            <h5>Co-working Hubs</h5>
                            <p>1,860+ options</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-2">
                        <div class="category-card">
                            <div class="icon-shape"><i class="bi bi-shop-window"></i></div>
                            <h5>Retail Spaces</h5>
                            <p>2,410+ stores</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block">
            <div class="container">
                <div class="section-heading">
                    <div>
                        <p class="section-eyebrow">Featured Projects in Major Cities</p>
                        <h2 class="section-title">Discover premium projects across India</h2>
                        <p class="section-subtitle">High-demand projects with record absorption and gated amenities</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="project-card">
                            <img src="https://images.unsplash.com/photo-1505691723518-36a5ac3be353?auto=format&fit=crop&w=800&q=80" alt="Mumbai skyline">
                            <div class="project-info">
                                <span class="project-badge"><i class="bi bi-activity"></i> Trending</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block">
            <div class="container">
                <div class="section-heading">
                    <div>
                        <p class="section-eyebrow">Recently Viewed</p>
                        <h2 class="section-title">Properties you showed interest in</h2>
                        <p class="section-subtitle">Pick up where you left off with curated recommendations</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="property-card">
                            <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80" alt="Premium condo">
                            <div class="property-body">
                                <div class="property-header">
                                    <h6 class="mb-0">Premium Skyline Condo</h6>
                                    <span class="property-price">₹1.2 Cr</span>
                                </div>
                                <p class="text-muted mb-0">Lower Parel, Mumbai • 2 Bed</p>
                                <div class="property-meta">
                                    <span><i class="bi bi-arrows-fullscreen"></i> 1,320 sqft</span>
                                    <span><i class="bi bi-calendar3"></i> Ready 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="property-card">
                            <img src="https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?auto=format&fit=crop&w=900&q=80" alt="Luxury villa">
                            <div class="property-body">
                                <div class="property-header">
                                    <h6 class="mb-0">Lakeview Signature Villa</h6>
                                    <span class="property-price">₹3.5 Cr</span>
                                </div>
                                <p class="text-muted mb-0">Whitefield, Bengaluru • 4 Bed</p>
                                <div class="property-meta">
                                    <span><i class="bi bi-tree"></i> Private lawn</span>
                                    <span><i class="bi bi-lightning"></i> Smart home</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="property-card">
                            <img src="https://images.unsplash.com/photo-1595526114035-0d45c109cd33?auto=format&fit=crop&w=900&q=80" alt="Smart apartment">
                            <div class="property-body">
                                <div class="property-header">
                                    <h6 class="mb-0">Smart Downtown Residences</h6>
                                    <span class="property-price">₹2.8 Cr</span>
                                </div>
                                <p class="text-muted mb-0">Cyber City, Gurugram • 3 Bed</p>
                                <div class="property-meta">
                                    <span><i class="bi bi-wifi"></i> IoT enabled</span>
                                    <span><i class="bi bi-building"></i> Sky lounge</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="property-card">
                            <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80" alt="Garden apartment">
                            <div class="property-body">
                                <div class="property-header">
                                    <h6 class="mb-0">Garden Grove Residences</h6>
                                    <span class="property-price">₹2.2 Cr</span>
                                </div>
                                <p class="text-muted mb-0">Baner, Pune • 3 Bed</p>
                                <div class="property-meta">
                                    <span><i class="bi bi-thermometer-high"></i> Climate control</span>
                                    <span><i class="bi bi-shield-check"></i> 24x7 security</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block">
            <div class="container">
                <div class="section-heading text-center">
                    <div>
                        <p class="section-eyebrow">FAQs about Buying & Selling</p>
                        <h2 class="section-title">Your top questions answered</h2>
                        <p class="section-subtitle">Find clarity on financing, legal paperwork, and closing timelines</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="accordion custom-accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqOneHeading">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne" aria-expanded="true" aria-controls="faqOne">
                                        How do I fix my budget?
                                    </button>
                                </h2>
                                <div id="faqOne" class="accordion-collapse collapse show" aria-labelledby="faqOneHeading" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Begin by understanding your disposable income, ongoing liabilities, and expected appreciation. Our advisors map EMI scenarios with multiple banks to derive an optimal budget with comfortable outflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqTwoHeading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo" aria-expanded="false" aria-controls="faqTwo">
                                        What documents are required for buying a property?
                                    </button>
                                </h2>
                                <div id="faqTwo" class="accordion-collapse collapse" aria-labelledby="faqTwoHeading" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Typically you need identity proofs, address proof, PAN, income statements, and for resale, title deed, encumbrance certificate, and NOC. We curate a document checklist tailored to your property type.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqThreeHeading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree" aria-expanded="false" aria-controls="faqThree">
                                        How long does registration usually take?
                                    </button>
                                </h2>
                                <div id="faqThree" class="accordion-collapse collapse" aria-labelledby="faqThreeHeading" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Once the sale agreement is executed, registration typically takes 7-10 working days depending on the sub-registrar office schedule. We assist with slot booking, stamp duty estimation, and on-site coordination.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqFourHeading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqFour" aria-expanded="false" aria-controls="faqFour">
                                        Can I get assistance with home loans?
                                    </button>
                                </h2>
                                <div id="faqFour" class="accordion-collapse collapse" aria-labelledby="faqFourHeading" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, our finance desk partners with leading banks to offer pre-approved loan programs, rate negotiation, and digital paperwork to accelerate disbursement and minimize hassles.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqFiveHeading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqFive" aria-expanded="false" aria-controls="faqFive">
                                        What support do you provide post purchase?
                                    </button>
                                </h2>
                                <div id="faqFive" class="accordion-collapse collapse" aria-labelledby="faqFiveHeading" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        From interior consultations, rental management, to utility setup—we remain your single touchpoint. Our property care team monitors possession status and escalates delays immediately.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?= $this->include('layouts/footer') ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>