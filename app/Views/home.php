    <?php
    $page_title = '11 Acer';
    $request = service('request');
    $searchQuery = trim((string) $request->getGet('query'));
    $searchPropertyType = trim((string) $request->getGet('property_type'));
    $searchListingType = trim((string) $request->getGet('listing_type'));
    $searchBudget = trim((string) $request->getGet('budget'));
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'assets/includes/seo-meta.php'; ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        .section-block+.section-block {
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
            background: linear-gradient(135deg, #00C950, #00A63E) !important;
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



        /* right side decorative ball */
        .category-card::after {
            content: "";
            position: absolute;
            top: -40px;
            right: -40px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(0, 200, 120, 0.12);
            /* default soft green */
        }



        /* optional hover effect */
        .category-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.1);
        }

        /* ==============================
   CATEGORY CARD BASE
============================== */
        .category-card {
            position: relative;
            background: #ffffff;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.1);
        }

        .category-card h5 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .category-card p {
            font-size: 14px;
            color: #6c757d;
        }

        /* ==============================
   ICON BASE STYLE
============================== */
        .icon-shape {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: #ffffff;
            font-size: 22px;
            z-index: 2;
            position: relative;
        }

        /* ==============================
   RIGHT SIDE DECORATIVE BALL
============================== */
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

        /* ==============================
   CARD COLOR VARIANTS
============================== */

        /* 🟢 Ready to Move Homes */
        .card-green .icon-shape {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .card-green::after {
            background: rgba(34, 197, 94, 0.14);
        }

        /* 🟣 Premium Estates */
        .card-purple .icon-shape {
            background: linear-gradient(135deg, #6366f1, #4338ca);
        }

        .card-purple::after {
            background: rgba(99, 102, 241, 0.14);
        }

        /* 🟠 Luxury Villas */
        .card-green-light .icon-shape {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        .card-green-light::after {
            background: rgba(249, 115, 22, 0.14);
        }

        /* 🔵 Commercial Offices */
        .card-orange .icon-shape {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
        }

        .card-orange::after {
            background: rgba(14, 165, 233, 0.14);
        }

        /* 💗 Co-working Hubs */
        .card-red .icon-shape {
            background: linear-gradient(135deg, #ec4899, #db2777);
        }

        .card-red::after {
            background: rgba(236, 72, 153, 0.14);
        }

        /* 🟪 Retail Spaces */
        .card-pink .icon-shape {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .card-pink::after {
            background: rgba(139, 92, 246, 0.14);
        }

        /* ==============================
   WHY CHOOSE US SECTION
============================== */
        .why-choose-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #ffffff 0%, #f4fbf7 100%);
        }

        .why-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .why-header p {
            font-size: 15px;
            color: #6b7280;
            max-width: 640px;
            margin: 0 auto;
        }

        /* ==============================
   WHY CARD
============================== */
        .why-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px 22px;
            text-align: center;
            height: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .why-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12);
        }

        .why-card h5 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .why-card p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
        }

        /* ==============================
   ICON STYLE
============================== */
        .why-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            color: #ffffff;
            font-size: 22px;
        }

        /* icon colors */
        .bg-green {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .bg-purple {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .bg-orange {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        /* ==============================
   POPULAR LOCALITIES
============================== */
        .popular-localities-section {
            background: #ffffff;
        }

        /* ==============================
   LOCALITY CARD
============================== */
        .locality-card-v2 {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px 22px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .locality-card-v2:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.12);
        }

        /* ==============================
   TOP AREA
============================== */
        .locality-top {
            display: flex;
            gap: 14px;
            margin-bottom: 16px;
        }

        .locality-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #e8f8ef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #22c55e;
            font-size: 20px;
            flex-shrink: 0;
        }

        .locality-info h5 {
            font-size: 15px;
            font-weight: 600;
        }

        /* ==============================
   TREND BADGE
============================== */
        .trend-badge {
            background: #e8f8ef;
            color: #16a34a;
            font-size: 11px;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* ==============================
   BOTTOM AREA
============================== */
        .locality-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 12px;
        }

        .price-growth {
            font-size: 14px;
            font-weight: 600;
            color: #22c55e;
        }

        /* ==============================
   CITY PRICE SECTION
============================== */
        .city-stats-section {
            background: linear-gradient(180deg, #ffffff 0%, #f4fbf7 100%);
        }

        /* ==============================
   CITY PRICE CARD
============================== */
        .city-price-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 22px 24px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .city-price-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.12);
        }

        /* ==============================
   TOP AREA
============================== */
        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .card-top h5 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .card-top h4 {
            font-size: 18px;
            font-weight: 700;
            color: #16a34a;
        }

        /* ==============================
   GROWTH PILL
============================== */
        .growth-pill {
            font-size: 13px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .growth-pill.positive {
            background: #dcfce7;
            color: #16a34a;
        }

        .growth-pill.negative {
            background: #fee2e2;
            color: #dc2626;
        }

        /* ==============================
   BOTTOM AREA
============================== */
        .card-bottom {
            margin-top: 6px;
        }

        .activity-bar {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
        }

        .activity-bar span {
            display: block;
            height: 100%;
            background: #0f172a;
            border-radius: 999px;
        }

        /* ==============================
   TOP BUILDERS SECTION
============================== */
        .top-builders-section {
            background: #ffffff;
        }

        /* ==============================
   BUILDER CARD
============================== */
        .builder-card-v2 {
            background: #ffffff;
            border-radius: 16px;
            padding: 18px 16px 20px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
            text-align: left;
            height: 100%;
            transition: all 0.3s ease;
        }

        .builder-card-v2:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.12);
        }

        /* ==============================
   LOGO AREA
============================== */
        .builder-logo {
            width: 100%;
            height: 120px;
            background: #f3f4f6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            overflow: hidden;
        }

        .builder-logo img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }

        .logo-placeholder {
            width: 100%;
            height: 100%;
            background: #f3f4f6;
            border-radius: 12px;
        }

        /* ==============================
   TEXT
============================== */
        .builder-card-v2 h5 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .builder-card-v2 .projects {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        /* ==============================
   RATING
============================== */
        .rating {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        .rating i {
            color: #facc15;
            font-size: 14px;
        }
        /* ==============================
   TESTIMONIALS SECTION
============================== */
.testimonials-section-v2 {
    padding: 90px 0;
    background: radial-gradient(
        circle at top left,
        #0f172a 0%,
        #064e3b 45%,
        #052e1c 100%
    );
}

/* ==============================
   CARD
============================== */
.testimonial-card-v2 {
    position: relative;
    height: 100%;
    padding: 36px 34px;
    border-radius: 20px;
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.12),
        rgba(255, 255, 255, 0.05)
    );
    border: 1px solid rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(14px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    color: #ffffff;
}

/* ==============================
   QUOTE ICON
============================== */
.quote-icon {
    font-size: 46px;
    font-weight: 700;
    color: #22c55e;
    margin-bottom: 10px;
}

/* ==============================
   TEXT
============================== */
.testimonial-text {
    font-size: 16px;
    line-height: 1.7;
    color: #e5e7eb;
    margin-bottom: 22px;
}

/* ==============================
   STARS
============================== */
.stars {
    display: flex;
    gap: 6px;
    margin-bottom: 22px;
}

.stars i {
    color: #facc15;
    font-size: 16px;
}

/* ==============================
   USER INFO
============================== */
.testimonial-user {
    display: flex;
    align-items: center;
    gap: 14px;
}

.avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: transparent;
}

.testimonial-user h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #ffffff;
}

.testimonial-user span {
    font-size: 13px;
    color: #d1d5db;
}

        </style>
    </head>

    <body>
        <?= $this->include('layouts/loader') ?>

        <?= $this->include('layouts/header') ?>
        <?php
        $listingModes = [
            ['label' => 'Buy', 'value' => 'buy'],
            ['label' => 'Rent', 'value' => 'rent'],
            ['label' => 'Sell', 'value' => 'sell'],
            ['label' => 'PG', 'value' => 'pg'],
        ];
        $activeListingType = $searchListingType ?: $listingModes[0]['value'];
        ?>
        <section class="hero" data-aos="fade-down" data-aos-delay="100">
            <div id="heroBackgroundCarousel"
                class="carousel slide carousel-fade hero-bg-carousel position-absolute top-0 start-0 w-100 h-100"
                data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100">
                        <img src="https://images.unsplash.com/photo-1505691723518-36a5ac3be353?auto=format&fit=crop&w=1600&q=80"
                            class="d-block w-100 h-100 object-fit-cover" alt="Luxury penthouse exterior">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="https://images.unsplash.com/photo-1502003148287-a82ef80a6abc?auto=format&fit=crop&w=1600&q=80"
                            class="d-block w-100 h-100 object-fit-cover" alt="Modern residential skyline">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1600&q=80"
                            class="d-block w-100 h-100 object-fit-cover" alt="Contemporary home interior">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1600&q=80"
                            class="d-block w-100 h-100 object-fit-cover" alt="Modern living room">
                    </div>
                </div>
            </div>
            <div class="hero-bg-overlay position-absolute top-0 start-0 w-100 h-100"></div>
            <div class="hero-search-meta z-1">
                <span class="text-white text-bold"><i class="bi bi-patch-check-fill"></i>95% Customer
                    Satisfaction</span>
            </div>
            <div class="hero-content position-relative">
                <h1 data-aos="fade-down" data-aos-delay="140">Find Your Dream Property</h1>
                <p class="text-white" data-aos="fade-down" data-aos-delay="160">Discover the perfect place to call home
                    from our extensive listings</p>

                <div class="hero-search-card" data-aos="fade-up" data-aos-delay="180">
                    <div class="hero-search-mode rounded-3" role="tablist" aria-label="Search segment control">
                        <?php foreach ($listingModes as $index => $mode): ?>
                        <?php
                            $isActiveMode = ($activeListingType === $mode['value']);
                            $buttonClasses = $isActiveMode ? 'active' : '';
                            $ariaPressed = $isActiveMode ? 'true' : 'false';
                        ?>
                        <button type="button" class="<?= $buttonClasses ?> rounded-3 border"
                            aria-pressed="<?= $ariaPressed ?>" data-listing-value="<?= esc($mode['value']) ?>">
                            <?= esc($mode['label']) ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                    <?php
                $propertyTypes = [
                    'Apartment',
                    'Villa',
                    'Townhouse',
                    'Penthouse',
                    'Compound',
                    'Duplex',
                    'Full Floor',
                    'Half Floor',
                    'Whole Building',
                    'Bulk Rent Unit',
                    'Bungalow',
                    'Hotel & Hotel Apartment'
                ];
                $budgetOptions = [
                    ['label' => 'Up to ₹50k', 'value' => 'up_to_50k'],
                    ['label' => '₹50k - ₹1 L', 'value' => '50k_1l'],
                    ['label' => '₹1 L - ₹2 L', 'value' => '1l_2l'],
                    ['label' => '₹2 L - ₹3 L', 'value' => '2l_3l'],
                    ['label' => '₹3 L - ₹5 L', 'value' => '3l_5l'],
                    ['label' => '₹5 L - ₹8 L', 'value' => '5l_8l'],
                    ['label' => '₹8 L - ₹12 L', 'value' => '8l_12l'],
                    ['label' => 'Above ₹12 L', 'value' => 'above_12l']
                ];
                $bedroomOptions = [
                    ['label' => 'Studio', 'value' => 'studio'],
                    ['label' => '1', 'value' => '1'],
                    ['label' => '2', 'value' => '2'],
                    ['label' => '3', 'value' => '3'],
                    ['label' => '4', 'value' => '4'],
                    ['label' => '5', 'value' => '5'],
                    ['label' => '6', 'value' => '6'],
                    ['label' => '7', 'value' => '7'],
                    ['label' => '7+', 'value' => '7_plus']
                ];
                $bathroomOptions = [
                    ['label' => '1', 'value' => '1'],
                    ['label' => '2', 'value' => '2'],
                    ['label' => '3', 'value' => '3'],
                    ['label' => '4', 'value' => '4'],
                    ['label' => '5', 'value' => '5'],
                    ['label' => '6', 'value' => '6'],
                    ['label' => '7', 'value' => '7'],
                    ['label' => '7+', 'value' => '7_plus']
                ];
                ?>
                    <form class="hero-search-form d-flex flex-wrap flex-lg-nowrap align-items-stretch gap-2"
                        action="<?= site_url('properties') ?>" method="get">
                        <div class="search-field border rounded-3">
                            <i class="bi bi-search"></i>
                            <input type="text" name="query" placeholder="City, community or building"
                                aria-label="Search location" value="<?= esc($searchQuery) ?>">
                        </div>
                        <div class="filter-dropdown border rounded-3" style="width: 42%;">
                            <button type="button" class="filter-btn" data-dropdown-target="propertyTypeDropdown"
                                aria-haspopup="true" aria-expanded="false" style="width: 100%;">
                                <span class="filter-label" id="propertyTypeLabel" data-default="Property Type">Property
                                    Type</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <div class="dropdown-panel border rounded-3" id="propertyTypeDropdown">
                                <p class="dropdown-heading">Property type</p>
                                <div class="dropdown-list">
                                    <?php foreach ($propertyTypes as $type): ?>
                                    <button type="button" class="dropdown-option" data-value="<?= $type ?>"
                                        data-input="propertyTypeInput"
                                        data-label="propertyTypeLabel"><?= $type ?></button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <input type="hidden" name="property_type" id="propertyTypeInput"
                                value="<?= esc($searchPropertyType) ?>">
                        </div>
                        <div class="filter-dropdown border rounded-3" data-dropdown-priority="2">
                            <button type="button" class="filter-btn" data-dropdown-target="budgetDropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="filter-label" id="budgetLabel" data-default="Budget">Budget</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <div class="dropdown-panel" id="budgetDropdown">
                                <p class="dropdown-heading">Budget range</p>
                                <div class="dropdown-list">
                                    <?php foreach ($budgetOptions as $option): ?>
                                    <button type="button" class="dropdown-option"
                                        data-value="<?= esc($option['value']) ?>" data-input="budgetInput"
                                        data-label="budgetLabel"><?= esc($option['label']) ?></button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <input type="hidden" name="budget" id="budgetInput" value="<?= esc($searchBudget) ?>">
                        </div>
                        <input type="hidden" name="listing_type" id="listingTypeInput"
                            value="<?= esc($activeListingType) ?>">
                        <button type="submit" class="search-submit rounded-3 btn btn-success gap-3"><i
                                class="bi bi-search"></i>Search</button>
                    </form>
                    <div class="popular-searches mt-3 d-flex gap-3" data-aos="fade-up" data-aos-delay="200">
                        <span>Popular Searches:</span>

                        <span class="text-success d-flex align-items-center gap-2">
                            <i class="bi bi-house-door-fill"></i> 2BHK in Bangalore
                        </span>

                        <span class="text-success d-flex align-items-center gap-2">
                            <i class="bi bi-house-door-fill"></i> 3BHK in Mumbai
                        </span>

                        <span class="text-success d-flex align-items-center gap-2">
                            <i class="bi bi-house-door-fill"></i> 1BHK in Delhi
                        </span>
                    </div>

                </div>
            </div>
        </section>

        <?= $this->include('layouts/modal') ?>



        <main class="mt-5">
            <!-- FEATURED PROPERTY SECTION -->
            <section class="section-block section-featured">
                <div class="container">
                    <div class="section-heading">Neighborhood score
                        <div>
                            <p class="section-eyebrow">Featured Property</p>
                            <h2 class="section-title">Find selected properties for your future</h2>
                            <p class="section-subtitle">Hand-picked properties by our team</p>
                        </div>
                        <a class="link-cta border rounded-3 btn" href="#">View all <i
                                class="bi bi-arrow-up-right"></i></a>
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
                                <p>Experience luxury living in this modern residence featuring floor-to-ceiling glass, a
                                    private sky lounge, and an expansive rooftop infinity pool overlooking the city
                                    skyline.</p>
                                <div class="featured-meta-grid">
                                    <span class="meta-chip"><i class="bi bi-houses"></i> 4 Bed</span>
                                    <span class="meta-chip"><i class="bi bi-droplet-half"></i> 3 Bath</span>
                                    <span class="meta-chip"><i class="bi bi-arrows-fullscreen"></i> 2,640 sq</span>
                                    <span class="meta-chip"><i class="bi bi-car-front"></i> 2 Car</span>
                                </div>
                                <div class="flex-wrap gap-3">
                                    <a href="#" class="btn-soft-primary btn border rounded-3 w-100">View Details</a>
                                </div>
                            </div>
                            <div class="featured-sidebar">
                                <div class="d-flex align-items-start justify-content-between gap-3">
                                    <div>
                                        <span class="text-uppercase text-muted fw-semibold"
                                            style="font-size: 0.78rem;">Starting from</span>
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
                                </div>
                                <div class="featured-image">
                                    <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1200&q=80"
                                        alt="Azure Haven Residences exterior">
                                    <div class="featured-image-caption"><i class="bi bi-camera-video"></i> Virtual tour
                                        available</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- TRENDING PROPERTY CATEGORIES -->
            <section class="section-block">
                <div class="container">
                    <div class="section-heading">
                        <div>
                            <p class="section-eyebrow">Trending Property Categories</p>
                            <h2 class="section-title">Explore our popular property types</h2>
                            <p class="section-subtitle">
                                Curated for every lifestyle, from premium villas to smart studios
                            </p>
                        </div>
                        <a class="link-cta" href="#">See all categories <i class="bi bi-arrow-right"></i></a>
                    </div>

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
            </section>

            <!-- FEATURED PROJECTS IN MAJOR CITIES -->
            <section class="featured-projects-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading">
                        <div>
                            <h2 class="section-title">Featured Projects in Major Cities</h2>
                            <p class="section-subtitle">Curated projects with RERA approvals and quick possession</p>
                        </div>
                    </div>
                    <?php
                        $cityImages = [
                            'Mumbai'     => 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=600&q=80',
                            'Delhi'      => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=600&q=80',
                            'Bengaluru'  => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80',
                            'Hyderabad'  => 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?auto=format&fit=crop&w=600&q=80',
                            'default'    => 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=600&q=80'
                        ];

                        $projectCards = [];
                        if (!empty($trendingCities)) {
                            foreach ($trendingCities as $item) {
                                $cityName = $item['city'] ?? 'City';
                                $label = number_format($item['listing_count']) . ' live listings';
                                $projectCards[] = [
                                    'image'       => $cityImages[$cityName] ?? $cityImages['default'],
                                    'city'        => ucwords(strtolower($cityName)),
                                    'title'       => 'Dynamic projects',
                                    'subtitle'    => $label,
                                    'info'        => 'Top-rated developers',
                                    'badge'       => 'Trending',
                                    'cta'         => 'Explore Listings',
                                    'link'        => site_url('properties')
                                ];
                            }
                        }

                        if (empty($projectCards)) {
                            $defaults = [
                                ['city' => 'Mumbai', 'title' => 'Skyline Imperial', 'subtitle' => '2 & 3 BHK • ₹95 L onwards', 'info' => 'RERA approved', 'image' => $cityImages['Mumbai']],
                                ['city' => 'Bengaluru', 'title' => 'Emerald Enclave', 'subtitle' => '2 & 3 BHK • ₹88 L onwards', 'info' => 'Ready possession', 'image' => $cityImages['Bengaluru']],
                                ['city' => 'Hyderabad', 'title' => 'Lakeview Heights', 'subtitle' => 'Legendary waterfront Villas', 'info' => 'Premium lifestyle', 'image' => $cityImages['Hyderabad']],
                                ['city' => 'Delhi NCR', 'title' => 'Aurora Enclave', 'subtitle' => 'Modern 3 & 4 BHK', 'info' => '9+ active towers', 'image' => $cityImages['Delhi']],
                            ];
                            foreach ($defaults as $default) {
                                $projectCards[] = array_merge($default, ['badge' => 'Featured', 'cta' => 'Enquire', 'link' => site_url('properties')]);
                            }
                        }
                    ?>
                    <div class="row g-4">
                        <?php foreach ($projectCards as $index => $project): ?>
                        <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?= 220 + ($index * 60) ?>">
                            <div class="project-card">
                                <img src="<?= esc($project['image']) ?>" alt="<?= esc($project['city']) ?>"
                                    class="project-thumb">
                                <div class="project-info">
                                    <p class="project-city mb-1"><i
                                            class="bi bi-geo-alt text-success me-1"></i><?= esc($project['city']) ?></p>
                                    <h5><?= esc($project['title']) ?></h5>
                                    <p class="small mb-2"><?= esc($project['subtitle']) ?></p>
                                    <p class="small text-success mb-2"><?= esc($project['info']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-light text-success"><?= esc($project['badge']) ?></span>
                                        <a href="<?= esc($project['link'], 'attr') ?>"
                                            class="btn btn-sm btn-outline-success rounded-pill"><?= esc($project['cta']) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- WHY CHOOSE US SECTION -->
            <section class="why-choose-section">
                <div class="container">
                    <div class="why-header text-center mb-5">
                        <h2>Why Choose Us</h2>
                        <p>
                            We provide the best real estate experience with our comprehensive services and
                            dedicated support
                        </p>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="why-card">
                                <div class="why-icon bg-green">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h5>Trusted By Thousands</h5>
                                <p>
                                    Over 50,000+ satisfied customers trust us with their property needs
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="why-card">
                                <div class="why-icon bg-green">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <h5>Quick Property Listings</h5>
                                <p>
                                    Get your property listed within 24 hours with our streamlined process
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="why-card">
                                <div class="why-icon bg-purple">
                                    <i class="bi bi-award"></i>
                                </div>
                                <h5>Award Winning Service</h5>
                                <p>
                                    Recognized as the best real estate platform for 3 consecutive years
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="why-card">
                                <div class="why-icon bg-orange">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <h5>24/7 Customer Support</h5>
                                <p>
                                    Our dedicated support team is always ready to assist you
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- POPULAR LOCALITIES -->
            <section class="popular-localities-section py-5">
                <div class="container">
                    <div class="section-heading mb-4">
                        <div>
                            <h2 class="section-title">Popular Localities</h2>
                            <p class="section-subtitle">Most searched neighborhoods</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <?php
                $popularLocalityCards = is_array($popularLocalityCards ?? null) ? $popularLocalityCards : [];
                if (empty($popularLocalityCards)) {
                    $popularLocalityCards = [
                        [
                            'title' => 'Koramangala',
                            'badge' => 'Bengaluru • 1200+ listings',
                            'growth' => 12,
                        ],
                        [
                            'title' => 'Powai',
                            'badge' => 'Mumbai • 980+ listings',
                            'growth' => 10,
                        ],
                        [
                            'title' => 'Sector 62',
                            'badge' => 'Noida • 760+ listings',
                            'growth' => 8,
                        ],
                    ];
                }
            ?>
                        <?php foreach ($popularLocalityCards as $index => $locality): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="locality-card-v2">
                                <div class="locality-top">
                                    <div class="locality-icon">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>

                                    <div class="locality-info">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <h5 class="mb-0"><?= esc($locality['title']) ?></h5>

                                            <?php if ($index % 2 === 0): ?>
                                            <span class="trend-badge">
                                                <i class="bi bi-graph-up"></i> Trending
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                        <p class="text-muted small mb-0">
                                            <?= esc($locality['badge']) ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="locality-bottom">
                                    <span class="text-muted small">Price Growth</span>
                                    <?php $growthPercent = (int) ($locality['growth'] ?? rand(5, 15)); ?>
                                    <span class="price-growth">+<?= esc($growthPercent) ?>%</span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="city-stats-section py-5">
                <div class="container">
                    <div class="section-heading mb-4">
                        <div>
                            <h2 class="section-title">City-wise Real Estate Prices</h2>
                            <p class="section-subtitle">Average price per sqft in major cities</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <?php
                $cityStatsCards = is_array($cityStatsCards ?? null) ? $cityStatsCards : [];

                if (empty($cityStatsCards) && !empty($cityStats) && is_array($cityStats)) {
                    $counts = array_map(static fn($item) => (int) ($item['listing_count'] ?? 0), $cityStats);
                    $maxCount = max($counts ?: [1]) ?: 1;

                    foreach ($cityStats as $stat) {
                        $count = (int) ($stat['listing_count'] ?? 0);
                        $cityStatsCards[] = [
                            'city' => ucwords(strtolower($stat['city'] ?? 'City')),
                            'avg_price' => $stat['avg_price'] ?? null,
                            'growth' => $stat['growth'] ?? ($count >= 0 ? 5 : -3),
                            'progress' => min(100, max(10, (int) round(($count / $maxCount) * 100))),
                        ];
                    }
                }

                if (empty($cityStatsCards)) {
                    $cityStatsCards = [
                        ['city' => 'Mumbai', 'avg_price' => 9450, 'growth' => 6, 'progress' => 82],
                        ['city' => 'Delhi NCR', 'avg_price' => 8750, 'growth' => 5, 'progress' => 76],
                        ['city' => 'Bengaluru', 'avg_price' => 8120, 'growth' => 7, 'progress' => 72],
                        ['city' => 'Hyderabad', 'avg_price' => 7680, 'growth' => 4, 'progress' => 68],
                    ];
                }
            ?>
                        <?php foreach ($cityStatsCards as $index => $stat): ?>
                        <?php
                    $isPositive = $stat['growth'] >= 0;
                    $progressWidth = $stat['progress'] ?: 60;
                    $priceLabel = is_numeric($stat['avg_price'])
                        ? '₹' . number_format($stat['avg_price']) . ' / sqft'
                        : 'Price data unavailable';
                ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="city-price-card">
                                <div class="card-top">
                                    <div>
                                        <h5><?= esc($stat['city']) ?></h5>
                                        <h4><?= esc($priceLabel) ?></h4>
                                    </div>

                                    <span class="growth-pill <?= $isPositive ? 'positive' : 'negative' ?>">
                                        <?= $isPositive ? '↗' : '↘' ?> <?= esc($stat['growth']) ?>%
                                    </span>
                                </div>

                                <div class="card-bottom">
                                    <div class="d-flex justify-content-between small text-muted mb-1">
                                        <span>Market Activity</span>
                                        <span><?= esc($progressWidth) ?>%</span>
                                    </div>
                                    <div class="activity-bar">
                                        <span style="width: <?= esc($progressWidth) ?>%"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <?php $builderImages = [
                        'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&amp;fit=crop&amp;w=200&amp;q=80',
                        'https://images.unsplash.com/photo-1430285561322-7808604715df?auto=format&amp;fit=crop&amp;w=200&amp;q=80',
                        'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&amp;fit=crop&amp;w=200&amp;q=80',
                        'https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?auto=format&amp;fit=crop&amp;w=200&amp;q=80',
                        'https://images.unsplash.com/photo-1430285561322-7808604715df?auto=format&amp;fit=crop&amp;w=200&amp;q=80'
                    ]; ?>

            <!-- TOP BUILDERS & DEVELOPERS -->
            <section class="top-builders-section py-5">
                <div class="container">
                    <div class="section-heading mb-4">
                        <div>
                            <h2 class="section-title">Top Builders & Developers</h2>
                            <p class="section-subtitle">
                                Trusted names in real estate development
                            </p>
                        </div>
                    </div>

                    <?php
                        $builderCards = is_array($builderCards ?? null) ? $builderCards : [];

                        if (empty($builderCards) && !empty($topBuilders) && is_array($topBuilders)) {
                            foreach ($topBuilders as $item) {
                                $builderCards[] = [
                                    'name' => $item['name'] ?? 'Builder Name',
                                    'projects' => (int) ($item['project_count'] ?? 0),
                                    'rating' => number_format((float) ($item['rating'] ?? 4.5), 1),
                                    'logo' => $item['logo'] ?? null,
                                ];
                            }
                        }

                        if (empty($builderCards)) {
                            $builderCards = [
                                [
                                    'name' => 'Prestige Group',
                                    'projects' => 127,
                                    'rating' => 4.8,
                                    'logo' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=200&q=80',
                                ],
                                [
                                    'name' => 'DLF Limited',
                                    'projects' => 98,
                                    'rating' => 4.7,
                                    'logo' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=200&q=80',
                                ],
                                [
                                    'name' => 'Godrej Properties',
                                    'projects' => 85,
                                    'rating' => 4.6,
                                    'logo' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=200&q=80',
                                ],
                                [
                                    'name' => 'Lodha Group',
                                    'projects' => 142,
                                    'rating' => 4.9,
                                    'logo' => 'https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=200&q=80',
                                ],
                                [
                                    'name' => 'Brigade Group',
                                    'projects' => 73,
                                    'rating' => 4.5,
                                    'logo' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=200&q=80',
                                ],
                                [
                                    'name' => 'Sobha Limited',
                                    'projects' => 68,
                                    'rating' => 4.5,
                                    'logo' => 'https://images.unsplash.com/photo-1430285561322-7808604715df?auto=format&fit=crop&w=200&q=80',
                                ],
                            ];
                        }
                        ?>


                    <div class="row g-4">
                        <?php foreach ($builderCards as $index => $builder): ?>
                        <div class="col-lg-2 col-md-4 col-6">
                            <div class="builder-card-v2">
                                <div class="builder-logo">
                                    <?php if (!empty($builder['logo'])): ?>
                                    <img src="<?= esc($builder['logo']) ?>" alt="<?= esc($builder['name']) ?>">
                                    <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1472289065668-ce650ac443d2?auto=format&fit=crop&w=200&q=80" alt="<?= esc($builder['name']) ?>">
                                    <?php endif; ?>
                                </div>

                                <h5><?= esc($builder['name']) ?></h5>
                                <p class="projects"><?= esc($builder['projects']) ?> Projects</p>

                                <div class="rating">
                                    <i class="bi bi-star-fill"></i>
                                    <span><?= esc($builder['rating']) ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>


            <!-- CUSTOMER TESTIMONIALS -->
<?php
$testimonials = is_array($testimonials ?? null) ? $testimonials : [];

if (empty($testimonials)) {
    $testimonials = [
        [
            'message' => 'Outstanding experience! The team helped me find my dream home within my budget. Their attention to detail and customer service is exceptional.',
            'name' => 'Sarah Mitchell',
            'role' => 'Property Buyer',
            'rating' => 5,
        ],
        [
            'message' => 'Professional, reliable, and efficient. I have invested in multiple properties through this platform and the ROI has been excellent.',
            'name' => 'Michael Chen',
            'role' => 'Real Estate Investor',
            'rating' => 5,
        ],
    ];
}
?>
<section class="testimonials-section-v2">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <h2 class="section-title text-white">Customer Stories</h2>
            <p class="section-subtitle text-light">
                Hear what our satisfied customers have to say about their experience
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="col-lg-6">
                    <div class="testimonial-card-v2">
                        <div class="quote-icon">“</div>

                        <p class="testimonial-text">
                            "<?= esc($testimonial['message']) ?>"
                        </p>

                        <div class="stars">
                            <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php endfor; ?>
                        </div>

                        <div class="testimonial-user">
                            <div class="avatar"></div>
                            <div>
                                <h6><?= esc($testimonial['name']) ?></h6>
                                <span><?= esc($testimonial['role']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


            <!-- RECENTLY VIEWED / RECOMMENDED -->
            <section class="recommended-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading">
                        <div>
                            <h2 class="section-title">Recently Viewed</h2>
                            <p class="section-subtitle">Curated recommendations based on your activity</p>
                        </div>
                        <!-- <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left"></i></button>
                            <button class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-right"></i></button>
                        </div> -->
                    </div>
                    <?php
                        $recentCards = [];
                        if (!empty($recentProperties)) {
                            foreach ($recentProperties as $prop) {
                                $details = $prop['details'] ?? [];
                                $priceRaw = $prop['pricing']['price'] ?? null;
                                $priceLabel = $priceRaw ? '₹' . number_format($priceRaw) : 'Contact for price';
                                $typeLabel = $prop['property_type'] ?? ($details['sub_property_type'] ?? 'Property');
                                $locationLabel = trim(join(', ', array_filter([$prop['locality'] ?? '', $prop['city'] ?? ''])));
                                $propertyId = $prop['id'] ?? $prop['property_id'] ?? $prop['propertyId'] ?? null;
                                $recentCards[] = [
                                    'title' => $prop['property_name'] ?? $typeLabel,
                                    'price' => $priceLabel,
                                    'location' => $locationLabel ?: 'Location',
                                    'type' => $typeLabel,
                                    'area' => isset($details['area_sqft']) ? ($details['area_sqft'] . ' sq.ft') : 'Area TBD',
                                    'image' => base_url('images/property.png'),
                                    'link' => $propertyId ? site_url('property?id=' . rawurlencode($propertyId)) : site_url('properties')
                                ];
                            }
                        }
                        if (empty($recentCards)) {
                            $recentCards = [
                                ['title' => 'Emerald Enclave', 'price' => '₹78 L • 2 BHK', 'location' => 'Wakad, Pune', 'type' => 'Apartment', 'area' => '950 sq.ft', 'image' => 'https://images.unsplash.com/photo-1507089947368-19c1da9775ae?auto=format&fit=crop&w=600&q=80', 'link' => site_url('properties')],
                                ['title' => 'Skyview Residences', 'price' => '₹1.2 Cr • 3 BHK', 'location' => 'Powai, Mumbai', 'type' => 'Apartment', 'area' => '1,200 sq.ft', 'image' => 'https://images.unsplash.com/photo-1501183638710-841dd1904471?auto=format&fit=crop&w=600&q=80', 'link' => site_url('properties')],
                                ['title' => 'Hillside Vista', 'price' => '₹98 L • 2 BHK', 'location' => 'Whitefield, Bengaluru', 'type' => 'Apartment', 'area' => '1,100 sq.ft', 'image' => 'https://images.unsplash.com/photo-1493666438817-866a91353ca9?auto=format&fit=crop&w=600&q=80', 'link' => site_url('properties')],
                                ['title' => 'Riverside Loft', 'price' => '₹65 L • 1 RK', 'location' => 'Bandra, Mumbai', 'type' => 'Studio', 'area' => '650 sq.ft', 'image' => 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=600&q=80', 'link' => site_url('properties')],
                            ];
                        }
                    ?>
                    <div class="row g-4">
                        <?php foreach ($recentCards as $index => $card): ?>
                        <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?= 220 + ($index * 30) ?>">
                            <div class="recommended-card">
                                <img src="<?= esc($card['image']) ?>" alt="<?= esc($card['title']) ?>"
                                    class="img-fluid rounded">
                                <div class="mt-3">
                                    <h6><?= esc($card['title']) ?></h6>
                                    <p class="mb-1 text-success fw-semibold"><?= esc($card['price']) ?></p>
                                    <small class="text-muted"><?= esc($card['location']) ?> •
                                        <?= esc($card['area']) ?></small>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span
                                            class="badge bg-success-subtle text-success"><?= esc($card['type']) ?></span>
                                        <a href="<?= esc($card['link'], 'attr') ?>"
                                            class="btn btn-outline-success btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- PROPERTY FAQ SECTION -->
            <section class="faq-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading text-center">
                        <div>
                            <h2 class="section-title">FAQs about Buying & Selling</h2>
                            <p class="section-subtitle">Quick answers for first-time buyers, investors, and landlords
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="accordion" id="faqAccordion">
                                <?php $faqs = [
                                    ['q' => 'How do I schedule a site visit ?', 'a' => 'Use the “Schedule Visit” button on any listing, pick a slot, and our team confirms within 30 minutes.'],
                                    ['q' => 'Is my listing verified before going live ?', 'a' => 'Yes, our verification team reviews ownership docs, photos, and location before activating.'],
                                    ['q' => 'Can I talk to a loan specialist ?', 'a' => 'Absolutely. Our banking partners help with eligibility checks and instant sanction letters.'],
                                    ['q' => 'Do you assist with rental agreements ?', 'a' => 'We provide lawyer-drafted digital agreements and doorstep biometric registration in select cities.'],
                                ]; ?>
                                <?php foreach ($faqs as $idx => $faq): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqHeading<?= $idx ?>">
                                        <button class="accordion-button <?= $idx !== 0 ? 'collapsed' : '' ?>"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqCollapse<?= $idx ?>"
                                            aria-expanded="<?= $idx === 0 ? 'true' : 'false' ?>"
                                            aria-controls="faqCollapse<?= $idx ?>">
                                            <?= $faq['q'] ?>
                                        </button>
                                    </h2>
                                    <div id="faqCollapse<?= $idx ?>"
                                        class="accordion-collapse collapse <?= $idx === 0 ? 'show' : '' ?>"
                                        aria-labelledby="faqHeading<?= $idx ?>" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <?= $faq['a'] ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?= $this->include('layouts/footer') ?>

        <script src="<?= base_url('js/script.js') ?>"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var heroModeButtons = document.querySelectorAll('.hero-search-mode button');
            var listingTypeInput = document.getElementById('listingTypeInput');

            // Keep listing type buttons and hidden input in sync.
            function setActiveListingMode(value) {
                var normalized = (value || '').toString().toLowerCase();
                var matchedButton = null;

                heroModeButtons.forEach(function(modeButton) {
                    var buttonValue = (modeButton.getAttribute('data-listing-value') || '')
                        .toLowerCase();
                    if (!matchedButton && normalized && buttonValue === normalized) {
                        matchedButton = modeButton;
                    }
                });

                if (!matchedButton && heroModeButtons.length) {
                    matchedButton = heroModeButtons[0];
                    normalized = (matchedButton.getAttribute('data-listing-value') || '').toLowerCase();
                }

                heroModeButtons.forEach(function(modeButton) {
                    var buttonValue = (modeButton.getAttribute('data-listing-value') || '')
                        .toLowerCase();
                    var isActive = matchedButton ? buttonValue === normalized : false;
                    modeButton.classList.toggle('active', isActive);
                    modeButton.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });

                if (listingTypeInput) {
                    listingTypeInput.value = matchedButton ? (matchedButton.getAttribute(
                        'data-listing-value') || '') : '';
                }
            }

            heroModeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    setActiveListingMode(button.getAttribute('data-listing-value'));
                });
            });

            if (heroModeButtons.length) {
                var initialMode = listingTypeInput && listingTypeInput.value ?
                    listingTypeInput.value :
                    heroModeButtons[0].getAttribute('data-listing-value');
                setActiveListingMode(initialMode);
            }

            var dropdownButtons = document.querySelectorAll('[data-dropdown-target]');
            var dropdownPanels = document.querySelectorAll('.dropdown-panel');

            function closeDropdowns() {
                dropdownPanels.forEach(function(panel) {
                    panel.classList.remove('open');
                });
                dropdownButtons.forEach(function(btn) {
                    btn.classList.remove('open');
                    btn.setAttribute('aria-expanded', 'false');
                });
            }

            dropdownButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    var targetId = button.getAttribute('data-dropdown-target');
                    var panel = document.getElementById(targetId);
                    if (!panel) {
                        return;
                    }
                    var isOpen = panel.classList.contains('open');
                    closeDropdowns();
                    if (!isOpen) {
                        panel.classList.add('open');
                        button.classList.add('open');
                        button.setAttribute('aria-expanded', 'true');
                    }
                });
            });

            document.addEventListener('click', function(event) {
                if (!event.target.closest('.filter-dropdown')) {
                    closeDropdowns();
                }
            });

            var propertyTypeInput = document.getElementById('propertyTypeInput');
            var propertyTypeLabel = document.getElementById('propertyTypeLabel');
            var budgetInput = document.getElementById('budgetInput');
            var budgetLabel = document.getElementById('budgetLabel');
            var propertyOptions = document.querySelectorAll('.dropdown-option[data-input]');

            function syncDropdownSelection(inputEl, labelEl, value) {
                if (!inputEl || !labelEl) {
                    return;
                }
                var normalized = (value || '').toString();
                var optionSelector = '.dropdown-option[data-input="' + inputEl.id + '"]';
                var buttons = Array.prototype.slice.call(document.querySelectorAll(optionSelector));
                buttons.forEach(function(btn) {
                    btn.classList.remove('selected');
                });
                if (!normalized) {
                    labelEl.textContent = labelEl.dataset.default;
                    return;
                }
                var match = buttons.find(function(btn) {
                    return (btn.getAttribute('data-value') || '').toLowerCase() === normalized
                        .toLowerCase();
                });
                if (match) {
                    match.classList.add('selected');
                    labelEl.textContent = match.textContent.trim();
                } else {
                    labelEl.textContent = normalized;
                }
            }

            function syncPropertyTypeLabel(value) {
                syncDropdownSelection(propertyTypeInput, propertyTypeLabel, value);
            }

            function syncBudgetLabel(value) {
                syncDropdownSelection(budgetInput, budgetLabel, value);
            }

            propertyOptions.forEach(function(option) {
                option.addEventListener('click', function() {
                    var inputId = option.getAttribute('data-input');
                    var labelId = option.getAttribute('data-label');
                    var input = document.getElementById(inputId);
                    var label = document.getElementById(labelId);
                    var dropdown = option.closest('.dropdown-panel');
                    if (!input || !label || !dropdown) {
                        return;
                    }
                    var alreadySelected = option.classList.contains('selected');
                    dropdown.querySelectorAll('.dropdown-option[data-input="' + inputId + '"]')
                        .forEach(function(btn) {
                            btn.classList.remove('selected');
                        });
                    if (alreadySelected) {
                        input.value = '';
                        label.textContent = label.dataset.default;
                        if (inputId === 'propertyTypeInput') {
                            syncPropertyTypeLabel('');
                        }
                        if (inputId === 'budgetInput') {
                            syncBudgetLabel('');
                        }
                    } else {
                        option.classList.add('selected');
                        input.value = option.getAttribute('data-value');
                        label.textContent = option.textContent.trim();
                        if (inputId === 'propertyTypeInput') {
                            syncPropertyTypeLabel(input.value);
                        }
                        if (inputId === 'budgetInput') {
                            syncBudgetLabel(input.value);
                        }
                    }
                    closeDropdowns();
                });
            });

            if (propertyTypeInput && propertyTypeInput.value) {
                syncPropertyTypeLabel(propertyTypeInput.value);
            }

            if (budgetInput && budgetInput.value) {
                syncBudgetLabel(budgetInput.value);
            }

            var chipButtons = document.querySelectorAll('.chip-button');

            function updateBedsBathsLabel() {
                var label = document.getElementById('bedsBathsLabel');
                if (!label) {
                    return;
                }
                var defaultText = label.dataset.default;
                var bedroomsInput = document.getElementById('bedroomsInput');
                var bathroomsInput = document.getElementById('bathroomsInput');
                var parts = [];
                if (bedroomsInput && bedroomsInput.value) {
                    var bedLabel = bedroomsInput.dataset.label || bedroomsInput.value;
                    if (bedLabel.toLowerCase() === 'studio') {
                        parts.push('Studio');
                    } else {
                        parts.push(bedLabel + ' Beds');
                    }
                }
                if (bathroomsInput && bathroomsInput.value) {
                    var bathLabel = bathroomsInput.dataset.label || bathroomsInput.value;
                    parts.push(bathLabel + ' Baths');
                }
                label.textContent = parts.length ? parts.join(', ') : defaultText;
            }

            chipButtons.forEach(function(chip) {
                chip.addEventListener('click', function() {
                    var inputId = chip.getAttribute('data-input-target');
                    var input = document.getElementById(inputId);
                    if (!input) {
                        return;
                    }
                    var group = chip.closest('.chip-group');
                    var isActive = chip.classList.contains('selected');
                    group.querySelectorAll('.chip-button').forEach(function(btn) {
                        if (btn.getAttribute('data-input-target') === inputId) {
                            btn.classList.remove('selected');
                        }
                    });
                    if (isActive) {
                        input.value = '';
                        delete input.dataset.label;
                    } else {
                        chip.classList.add('selected');
                        input.value = chip.getAttribute('data-value');
                        input.dataset.label = chip.getAttribute('data-label');
                    }
                    updateBedsBathsLabel();
                });
            });
        });
        </script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const apiUrl = '<?= site_url('api/property/all') ?>';
            const propertyUrl = '<?= site_url('property') ?>';
            const container = document.getElementById('featured-properties-row');
            if (!container) {
                return;
            }

            const placeholder = document.getElementById('featured-properties-loading');
            const fallbackImage = '<?= base_url('images/Property Image.png') ?>';
            const currencyFormatter = new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'INR',
                maximumFractionDigits: 0
            });

            function formatPrice(value) {
                if (value === undefined || value === null || value === '') {
                    return 'Contact for price';
                }
                const amount = Number(value);
                if (Number.isNaN(amount)) {
                    return value.toString();
                }
                return currencyFormatter.format(amount);
            }

            function formatArea(value) {
                if (value === undefined || value === null || value === '') {
                    return 'Area data not available';
                }
                const areaValue = Number(value);
                if (Number.isNaN(areaValue)) {
                    return value.toString();
                }
                return `${areaValue.toLocaleString()} sq.ft`;
            }

            function renderCard(property, index) {
                const details = property.details || {};
                const media = Array.isArray(property.media) ? property.media : [];
                const primaryMedia = media[0] || {};
                const imageUrl = primaryMedia.file_url || primaryMedia.url || primaryMedia.fileUrl ||
                    fallbackImage;
                const title = property.property_name || details.title || details.sub_property_type || property
                    .property_type || 'Property';
                const locationParts = [
                    property.locality || details.locality || details.sublocality,
                    property.city || details.city
                ].filter(Boolean);
                const location = locationParts.length ? locationParts.join(', ') : 'Location';
                const priceLabel = formatPrice((property.pricing && property.pricing.price) ? property.pricing
                    .price : property.price);
                const areaLabel = formatArea(details.area_sqft);
                const possession = details.availability ? details.availability.replace(/_/g, ' ') :
                    'Available soon';
                const detailSpec = details.sub_property_type || property.property_type || 'Listing';
                const delay = Math.min(600, 260 + (index * 40));

                return `
                    <div class="col-xl-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="${delay}">
                        <a href="${propertyUrl}?id=${encodeURIComponent(property.id)}" class="text-decoration-none text-reset" aria-label="View ${title}">
                            <div class="card property-card">
                                <img src="${imageUrl}" class="card-img-top" alt="${title}">
                                <span class="badge new-badge">Verified</span>
                                <i class="bi bi-heart heart-icon"></i>
                                <div class="card-body">
                                    <h5 class="card-title">${title}</h5>
                                    <p class="card-price">${priceLabel}</p>
                                    <p class="card-specs mb-0">${detailSpec} • ${areaLabel} • ${location}</p>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <span class="text-muted small">${possession}</span>
                                        <button class="btn btn-sm btn-outline-success rounded-pill">Details</button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>`;
            }

            function buildFeaturedList(items) {
                const candidates = Array.isArray(items) ? items.slice(0, 6) : [];
                if (!candidates.length) {
                    container.innerHTML =
                        '<div class="col-12 text-center py-5">No featured properties available.</div>';
                    placeholder?.remove();
                    return;
                }
                container.innerHTML = candidates.map(renderCard).join('');
                placeholder?.remove();
            }

            async function loadFeaturedProperties() {
                try {
                    const response = await fetch(apiUrl);
                    if (!response.ok) {
                        throw new Error(`Failed to fetch (${response.status})`);
                    }
                    const payload = await response.json();
                    let items = [];
                    if (Array.isArray(payload)) {
                        items = payload;
                    } else if (payload && Array.isArray(payload.data)) {
                        items = payload.data;
                    } else if (payload && payload.status === 'success' && Array.isArray(payload.data)) {
                        items = payload.data;
                    }
                    buildFeaturedList(items);
                } catch (error) {
                    console.error('Failed to load featured properties', error);
                    container.innerHTML =
                        `<div class="col-12 text-center text-danger py-5">Failed to load featured properties. ${error.message}</div>`;
                    placeholder?.remove();
                }
            }

            loadFeaturedProperties();
        });
        </script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoCard = document.getElementById('videoAdCard');
            const video = document.getElementById('videoAdMedia');
            const closeBtn = document.getElementById('videoAdClose');
            const unmuteBtn = document.getElementById('videoAdUnmute');
            const footerNote = videoCard ? videoCard.querySelector('.video-ad-footer span') : null;
            if (!videoCard || !video) {
                return;
            }
            let showTimer = setTimeout(function() {
                videoCard.classList.add('visible');
                video.play().catch(function() {});
            }, 5000);

            const setAudioState = function(enableSound) {
                const shouldEnable = Boolean(enableSound);
                video.muted = !shouldEnable;
                if (shouldEnable) {
                    video.play().catch(function() {});
                    videoCard.classList.add('interactive');
                } else {
                    videoCard.classList.remove('interactive');
                }
                if (unmuteBtn) {
                    unmuteBtn.textContent = shouldEnable ? 'Mute' : 'Unmute';
                }
                if (footerNote) {
                    footerNote.textContent = shouldEnable ?
                        'Sound on. Tap to mute.' :
                        'Tap to enable sound.';
                }
            };

            const toggleAudio = function(event) {
                if (event) {
                    event.stopPropagation();
                }
                setAudioState(video.muted);
            };

            video.addEventListener('click', toggleAudio);
            unmuteBtn?.addEventListener('click', toggleAudio);

            closeBtn?.addEventListener('click', function() {
                videoCard.classList.remove('visible');
                videoCard.classList.add('closing');
                video.pause();
                setAudioState(false);
                clearTimeout(showTimer);
            });

            setAudioState(false);
        });
        </script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>