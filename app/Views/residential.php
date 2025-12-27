<?php
$page_title = 'Residential Properties | 11 Acer';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <?= csrf_meta() ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/responsive.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/favicon/favicon-16x16.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <link rel="manifest" href="<?= base_url('images/favicon/site.webmanifest') ?>">
    <style>
        :root {
            --brand: #198754;
            --brand-dark: #126945;
            --text-dark: #1f2a2e;
            --text-muted: #6b7b85;
            --surface: #ffffff;
            --surface-mute: #f7f9fb;
            --shadow: 0 20px 40px rgba(25, 135, 84, 0.12);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7f8;
            color: var(--text-dark);
        }

        .residential-page section {
            padding: clamp(2.5rem, 5vw, 4rem) 0;
        }

        .section-heading {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--text-muted);
            max-width: 720px;
        }

        .res-hero {
            position: relative;
            background-image: linear-gradient(120deg, rgba(15, 33, 36, 0.85), rgba(25, 135, 84, 0.8)), url('https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            border-bottom-left-radius: 2rem;
            border-bottom-right-radius: 2rem;
            min-height: clamp(360px, 65vh, 540px);
            display: flex;
            align-items: center;
            color: #ffffff;
            overflow: hidden;
        }

        .res-hero h1 {
            font-size: clamp(2.1rem, 5vw, 3.6rem);
            line-height: 1.2;
        }

        .res-hero .lead {
            font-size: clamp(1rem, 2.3vw, 1.25rem);
        }

        .res-hero .badge {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            padding: 0.65rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .res-hero .hero-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .res-card{
            color: black;
        }

        .res-card,
        .feature-card,
        .listing-card,
        .city-card,
        .testimonial-card,
        .faq-card,
        .contact-card {
            background: var(--surface);
            border: 0;
            border-radius: 1.25rem;
            box-shadow: var(--shadow);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .res-card:hover,
        .feature-card:hover,
        .listing-card:hover,
        .city-card:hover,
        .testimonial-card:hover,
        .faq-card:hover,
        .contact-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(4, 34, 27, 0.12);
        }

        .res-card-icon,
        .feature-icon,
        .amenity-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(25, 135, 84, 0.12);
            color: var(--brand);
            font-size: 1.5rem;
        }

        .listing-card img {
            border-top-left-radius: 1.25rem;
            border-top-right-radius: 1.25rem;
            height: clamp(200px, 28vw, 240px);
            object-fit: cover;
            width: 100%;
            display: block;
        }

        .listing-card .price-tag {
            color: var(--brand);
            font-weight: 700;
            font-size: 1.15rem;
        }

        .city-card {
            background: radial-gradient(circle at top right, rgba(25, 135, 84, 0.18), rgba(255, 255, 255, 1));
        }

        .amenity-box {
            background: var(--surface);
            border-radius: 1.25rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
        }

        .testimonial-card {
            padding: 2rem;
        }

        .testimonial-card .quote {
            font-style: italic;
            color: var(--text-muted);
        }

        .cta-banner,
        .contact-banner {
            background: linear-gradient(120deg, #0b1f1c, var(--brand-dark));
            color: #ffffff;
            border-radius: 1.5rem;
            padding: 3rem;
            box-shadow: 0 25px 60px rgba(12, 48, 40, 0.4);
        }

        .faq-card button {
            font-weight: 600;
            color: var(--text-dark);
        }

        .faq-card button:focus {
            box-shadow: none;
        }

        .contact-card {
            padding: 2rem;
        }

        @media (max-width: 991.98px) {
            .section-heading {
                font-size: 1.9rem;
            }
        }

        @media (max-width: 767px) {
            .res-hero {
                border-radius: 0 0 1.5rem 1.5rem;
                text-align: center;
                min-height: auto;
                padding: 2.5rem 0;
            }

            .cta-banner,
            .contact-banner {
                padding: 2rem;
            }

            .residential-page section {
                padding: 2.5rem 0;
            }
        }
    </style>
</head>
<body>
    <?= $this->include('layouts/loader') ?>

    <?= $this->include('layouts/header') ?>

    <main class="residential-page">
        <!-- Hero -->
        <section class="res-hero py-5">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <span class="badge text-uppercase mb-3">Residential Collection</span>
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="display-4 fw-semibold mb-3">Find Your Next Residential Address</h1>
                        <p class="lead mb-4">Curated apartments, villas, studio spaces, and premium plots across India's fastest-growing micro-markets. Experience elevated living with personalized advisory.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="<?= site_url('post-your-property') ?>" class="btn btn-brand px-4 py-3">Explore Listings</a>
                            <a href="<?= site_url('contact') ?>" class="btn btn-brand-outline px-4 py-3">Talk to an Advisor</a>
                        </div>
                    </div>
                    <div class="col-lg-5 ms-auto mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                        <div class="res-card p-4 h-100">
                            <h5 class="text-uppercase text-muted mb-3">In Focus</h5>
                            <div class="hero-stats">
                                <div>
                                    <h3 class="fw-bold mb-1">480+</h3>
                                    <p class="mb-0 text-muted">Active Listings</p>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-1">72</h3>
                                    <p class="mb-0 text-muted">Luxury Towers</p>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-1">95%</h3>
                                    <p class="mb-0 text-muted">Client Satisfaction</p>
                                </div>
                            </div>
                            <div class="mt-4 d-flex align-items-center gap-3">
                                <div class="feature-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">RERA Certified Advisors</h6>
                                    <p class="mb-0 text-muted small">Dedicated residential desk for seamless buying, selling & leasing.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories -->
        <section class="container" id="residential-categories">
            <div class="row align-items-center mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Residential Categories</h2>
                    <p class="section-subtitle">From boutique builder floors to gated high-rises, explore residential formats tailored for investors, end-users, and rental yields.</p>
                </div>
            </div>
            <div class="row g-4 auto-grid row-cols-1 row-cols-sm-2 row-cols-md-3">
                <?php $categories = [
                    ['icon' => 'bi-building', 'title' => 'Apartments / Flats', 'info' => 'Smart layouts, skyline views, and branded residences in top towers.'],
                    ['icon' => 'bi-house-heart', 'title' => 'Villas / Independent Houses', 'info' => 'Private plots, landscaped lawns, and luxury villa communities.'],
                    ['icon' => 'bi-geo-alt', 'title' => 'Plots / Land', 'info' => 'Curated land banks for custom homes and long-term appreciation.'],
                    ['icon' => 'bi-door-open', 'title' => 'Studio / Co-living', 'info' => 'Efficient studio homes and co-living assets near business districts.'],
                    ['icon' => 'bi-columns', 'title' => 'Builder Floors', 'info' => 'Exclusive low-density floors with premium finishes and lift access.'],
                ]; ?>
                <?php foreach ($categories as $index => $category): ?>
                    <div class="col" data-aos="fade-up" data-aos-delay="<?= 150 + ($index * 80) ?>">
                        <div class="res-card p-4 h-100">
                            <div class="res-card-icon mb-3">
                                <i class="bi <?= $category['icon'] ?>"></i>
                            </div>
                            <h5 class="fw-semibold mb-2"><?= $category['title'] ?></h5>
                            <p class="mb-0 text-muted"><?= $category['info'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Featured Listings -->
        <section class="container" id="featured-residential">
            <div class="row align-items-center mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Featured Residential Listings</h2>
                    <p class="section-subtitle">Handpicked inventory spanning gated communities, golf-view villas, and ready-to-move options with flexible payment plans.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0" data-aos="fade-left">
                    <a href="<?= site_url('properties') ?>" class="btn btn-brand-outline px-4">View All Residential</a>
                </div>
            </div>
            <div class="row g-4 auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-3">
                <?php
                    $listingCards = [];
                    if (!empty($residentialListings)) {
                        foreach ($residentialListings as $listing) {
                            $details = $listing['details'] ?? [];
                            $locationParts = array_filter([$listing['locality'] ?? '', $listing['city'] ?? '']);
                            $areaSqft = $details['area_sqft'] ?? null;
                            $areaLabel = $areaSqft ? number_format($areaSqft) . ' sq.ft' : 'Flexible size';
                            $priceRaw = $listing['pricing']['price'] ?? null;
                            $priceLabel = $priceRaw ? '₹ ' . number_format($priceRaw) : 'Price on request';
                            $bedLabel = $details['sub_property_type'] ?? $listing['property_type'] ?? 'Residential';
                            $listingCards[] = [
                                'id' => $listing['id'] ?? null,
                                'title' => $listing['property_name'] ?? 'Premium residence',
                                'location' => $locationParts ? implode(', ', $locationParts) : 'Pan-India',
                                'price' => $priceLabel,
                                'beds' => ucwords(str_replace('_', ' ', $bedLabel)),
                                'size' => $areaLabel,
                                'img' => $details['hero_image'] ?? base_url('images/property.png'),
                            ];
                        }
                    }

                    if (empty($listingCards)) {
                        $listingCards = [
                            ['title' => 'Skyline Crest Residences', 'location' => 'Sector 150, Noida', 'price' => '₹2.15 Cr onwards', 'beds' => '4 BHK', 'size' => '2,850 sq.ft', 'img' => 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=900&q=80'],
                            ['title' => 'Aria Botanica Villas', 'location' => 'Doddaballapura, Bengaluru', 'price' => '₹3.45 Cr onwards', 'beds' => '5 BHK', 'size' => '4,200 sq.ft', 'img' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=900&q=80'],
                            ['title' => 'The Crestline Floors', 'location' => 'Golf Course Extn., Gurugram', 'price' => '₹1.95 Cr onwards', 'beds' => '3.5 BHK', 'size' => '2,150 sq.ft', 'img' => 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80'],
                            ['title' => 'Bayfront Co-Living', 'location' => 'Wadala, Mumbai', 'price' => '₹85 L onwards', 'beds' => 'Studio', 'size' => '620 sq.ft', 'img' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=900&q=80'],
                            ['title' => 'Aurora Parkland Plots', 'location' => 'Tellapur, Hyderabad', 'price' => '₹38,000 / sq.yd', 'beds' => 'Open Plot', 'size' => '300 sq.yd', 'img' => 'https://images.unsplash.com/photo-1459535653751-d571815e906b?auto=format&fit=crop&w=900&q=80'],
                            ['title' => 'Summit Heights Residences', 'location' => 'Pimpri, Pune', 'price' => '₹1.35 Cr onwards', 'beds' => '3 BHK', 'size' => '1,820 sq.ft', 'img' => 'https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?auto=format&fit=crop&w=900&q=80'],
                        ];
                    }
                    foreach ($listingCards as $index => $listing): ?>
                    <div class="col" data-aos="fade-up" data-aos-delay="<?= 150 + ($index * 60) ?>">
                        <div class="listing-card h-100">
                            <img src="<?= esc($listing['img']) ?>" alt="<?= esc($listing['title']) ?>">
                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-light text-dark fw-semibold"><?= esc($listing['beds']) ?></span>
                                    <span class="price-tag"><?= esc($listing['price']) ?></span>
                                </div>
                                <h5 class="fw-semibold mb-1"><?= esc($listing['title']) ?></h5>
                                <p class="text-muted mb-3"><i class="bi bi-geo-alt-fill me-1 text-success"></i><?= esc($listing['location']) ?></p>
                                <div class="d-flex justify-content-between text-muted small">
                                    <span><i class="bi bi-arrows-fullscreen me-1"></i><?= esc($listing['size']) ?></span>
                                    <span><i class="bi bi-calendar-week me-1"></i>Ready 2026</span>
                                </div>
                                <div class="mt-4 d-flex gap-2">
                                    <?php
                                        $detailUrl = site_url('properties');
                                        if (!empty($listing['id'])) {
                                            $propertyId = esc($listing['id'], 'url');
                                            $detailUrl = site_url('property') . '?id=' . $propertyId;
                                        }
                                    ?>
                                    <a href="<?= esc($detailUrl) ?>" class="btn btn-brand flex-grow-1">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="container" id="why-residential">
            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Why Choose Us for Residential</h2>
                    <p class="section-subtitle">Deep relationships with developers, exclusive mandate inventory, and advisory teams focused purely on residential transformations.</p>
                </div>
            </div>
            <div class="row g-4 auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-4">
                <?php $features = [
                    ['icon' => 'bi-people', 'title' => 'Dedicated Residential Desk', 'desc' => 'Specialist advisors for primary, resale, leasing, and investment mandates.'],
                    ['icon' => 'bi-award', 'title' => 'RERA Compliance', 'desc' => 'Transparent documentation backed by due diligence and site intelligence.'],
                    ['icon' => 'bi-graph-up-arrow', 'title' => 'Market Intelligence', 'desc' => 'Hyper-local demand mapping, pricing benchmarks, and absorption trends.'],
                    ['icon' => 'bi-hand-thumbs-up', 'title' => '360° Concierge', 'desc' => 'Site visits, home loan partners, fit-out advisory, and post-sale service.'],
                ]; ?>
                <?php foreach ($features as $index => $feature): ?>
                    <div class="col" data-aos="fade-up" data-aos-delay="<?= 150 + ($index * 80) ?>">
                        <div class="feature-card h-100 p-4">
                            <div class="feature-icon mb-3">
                                <i class="bi <?= $feature['icon'] ?>"></i>
                            </div>
                            <h6 class="fw-semibold mb-2"><?= $feature['title'] ?></h6>
                            <p class="mb-0 text-muted"><?= $feature['desc'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- City Hotspots -->
        <section class="container" id="city-hotspots">
            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">City-wise Hotspots</h2>
                    <p class="section-subtitle">Premium neighborhoods redefining residential demand with social infrastructure, rapid connectivity, and lifestyle upgrades.</p>
                </div>
            </div>
            <div class="row g-4 auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-3">
                <?php $cities = [
                    ['city' => 'Gurugram', 'area' => 'Golf Course Extn. | Dwarka Exp.', 'stats' => '7.8% QoQ price growth', 'tag' => 'Luxury & Premium'],
                    ['city' => 'Mumbai', 'area' => 'Worli | BKC | Wadala', 'stats' => 'High rental yields 4.5%', 'tag' => 'Waterfront Living'],
                    ['city' => 'Bengaluru', 'area' => 'Whitefield | North Bangalore', 'stats' => 'Tech micro-markets surge', 'tag' => 'IT Corridors'],
                    ['city' => 'Hyderabad', 'area' => 'Kokapet | Tellapur', 'stats' => 'Investors eye plotted dev.', 'tag' => 'Emerging Clusters'],
                    ['city' => 'Pune', 'area' => 'Baner | Hinjawadi', 'stats' => 'End-user demand spike', 'tag' => 'Urban Lifestyle'],
                    ['city' => 'Noida', 'area' => 'Sector 150 | 45', 'stats' => 'Townships & sports hubs', 'tag' => 'Green Living'],
                ]; ?>
                <?php foreach ($cities as $index => $city): ?>
                    <div class="col" data-aos="zoom-in" data-aos-delay="<?= 150 + ($index * 60) ?>">
                        <div class="city-card p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0"><?= $city['city'] ?></h5>
                                <span class="badge bg-dark-subtle text-dark"><?= $city['tag'] ?></span>
                            </div>
                            <p class="mb-1 text-muted"><?= $city['area'] ?></p>
                            <p class="fw-semibold text-success mb-0"><?= $city['stats'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Amenities -->
        <section class="container" id="amenities">
            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Amenities & Lifestyle Highlights</h2>
                    <p class="section-subtitle">Every residential asset is screened for wellness-focused amenities and community experiences curated for residents.</p>
                </div>
            </div>
            <div class="row g-4 amenities-grid auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-3" data-aos="fade-up" data-aos-delay="150">
                <?php $amenities = [
                    ['icon' => 'bi-droplet', 'title' => 'Resort Pools & Decks', 'desc' => 'Temperature-controlled lap pools, aqua decks, and floating cabanas.'],
                    ['icon' => 'bi-tree', 'title' => 'Central Greens', 'desc' => '2-10 acre landscaped podiums with jogging tracks and meditation zones.'],
                    ['icon' => 'bi-lightning-charge', 'title' => 'Smart & Sustainable', 'desc' => 'EV-ready parking, solar rooftops, air-purifying plantations.'],
                    ['icon' => 'bi-door-closed', 'title' => 'Security & Access', 'desc' => 'App-enabled visitor management, e-keys, and 5-tier surveillance.'],
                    ['icon' => 'bi-emoji-smile', 'title' => 'Community Life', 'desc' => 'Sky lounges, co-working pods, crafts studios, and kids learning labs.'],
                    ['icon' => 'bi-heart-pulse', 'title' => 'Wellness Suites', 'desc' => 'In-house spa suites, Pilates studios, and boutique fitness partners.'],
                ]; ?>
                <?php foreach ($amenities as $amenity): ?>
                    <div class="col">
                        <div class="amenity-box h-100">
                            <div class="amenity-icon">
                                <i class="bi <?= $amenity['icon'] ?>"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold mb-1"><?= $amenity['title'] ?></h6>
                                <p class="text-muted mb-0"><?= $amenity['desc'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="container" id="testimonials">
            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Trusted by Residential Buyers & Sellers</h2>
                    <p class="section-subtitle">Stories from homeowners, investors, and NRI clients who discovered their dream residence with 11 Acer.</p>
                </div>
            </div>
            <div class="row g-4 auto-grid row-cols-1 row-cols-md-2 row-cols-lg-3">
                <?php $testimonials = [
                    ['name' => 'Vidhi & Raghav Malhotra', 'title' => 'Upgraded to a golf-view villa', 'quote' => '“The residential advisory team negotiated developer offers we never had access to. Site visits were curated, transparent, and decisive.”'],
                    ['name' => 'Sushmita Das', 'title' => 'Investment in smart studio', 'quote' => '“Data-backed guidance on rental yields and future Metro connectivity made my purchase in Mumbai effortless.”'],
                    ['name' => 'Arjun Balakrishnan', 'title' => 'NRI Plot Purchase', 'quote' => '“Legal vetting, virtual walkthroughs, and loan coordination were wrapped up in record time.”'],
                ]; ?>
                <?php foreach ($testimonials as $index => $testimonial): ?>
                    <div class="col" data-aos="fade-up" data-aos-delay="<?= 160 + ($index * 80) ?>">
                        <div class="testimonial-card h-100">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="feature-icon">
                                    <i class="bi bi-chat-quote"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?= $testimonial['name'] ?></h6>
                                    <p class="text-muted small mb-0"><?= $testimonial['title'] ?></p>
                                </div>
                            </div>
                            <p class="quote mb-0"><?= $testimonial['quote'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- CTA -->
        <section class="container" id="post-property">
            <div class="cta-banner" data-aos="zoom-in" data-aos-delay="150">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="fw-semibold mb-3">Post Your Residential Property</h2>
                        <p class="mb-0">Get your project featured across our buyer network with targeted digital showcases, NRI outreach, and curated site visits.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="<?= site_url('post-your-property') ?>" class="btn btn-light px-4 py-3 fw-semibold">Start Listing</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="container" id="res-faqs">
            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Residential FAQs</h2>
                    <p class="section-subtitle">Clarity on financing, documentation, and transactions for first-time buyers and seasoned investors alike.</p>
                </div>
            </div>
            <div class="faq-card" data-aos="fade-up" data-aos-delay="150">
                <div class="accordion accordion-flush" id="resFaqAccordion">
                    <?php $faqs = [
                        ['question' => 'Do you assist with home loan processing?', 'answer' => 'Yes. We partner with leading banks and NBFCs to secure preferential rates, faster sanction timelines, and doorstep documentation.'],
                        ['question' => 'Can I schedule virtual tours before visiting?', 'answer' => 'Our advisors host HD video walkthroughs, drone previews, and interactive floor plans for NRIs and outstation buyers.'],
                        ['question' => 'How do you verify residential projects?', 'answer' => 'We conduct legal vetting, construction audits, and RERA compliance checks before onboarding any inventory.'],
                        ['question' => 'Do you manage property resale and leasing?', 'answer' => 'Absolutely. Dedicated resale and leasing desks ensure optimized pricing, tenant screening, and agreement support.'],
                    ]; ?>
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading<?= $index ?>">
                                <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="faqCollapse<?= $index ?>">
                                    <?= $faq['question'] ?>
                                </button>
                            </h2>
                            <div id="faqCollapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="faqHeading<?= $index ?>" data-bs-parent="#resFaqAccordion">
                                <div class="accordion-body">
                                    <?= $faq['answer'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Contact CTA -->
        <section class="container" id="res-contact">
            <div class="contact-banner" data-aos="fade-up" data-aos-delay="150">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <h2 class="fw-semibold mb-3">Schedule a Private Residential Visit</h2>
                        <p class="mb-0">Block calendar slots with our residential strategists for guided walkthroughs, price discovery, and closing assistance.</p>
                    </div>
                    <div class="col-lg-5">
                        <div class="contact-card bg-white text-dark">
                            <h6 class="fw-semibold mb-3">Connect with Us</h6>
                            <form class="row g-3" id="residential-lead-form" novalidate>
                                <?= csrf_field() ?>
                                <div class="col-12">
                                    <label class="form-label visually-hidden" for="residential-full-name">Full Name</label>
                                    <input type="text" class="form-control" id="residential-full-name" name="full_name" placeholder="Full Name" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label visually-hidden" for="residential-email">Email Address</label>
                                    <input type="email" class="form-control" id="residential-email" name="email" placeholder="Email Address" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label visually-hidden" for="residential-city">Preferred City</label>
                                    <input type="text" class="form-control" id="residential-city" name="preferred_city" placeholder="Preferred City">
                                </div>
                                <div class="col-12">
                                    <label class="form-label visually-hidden" for="residential-message">Requirement</label>
                                    <textarea class="form-control" id="residential-message" name="message" rows="3" placeholder="Tell us about your requirement" required></textarea>
                                </div>
                                <div class="col-12 d-grid">
                                    <button type="submit" class="btn btn-brand" data-role="submit">Request Call Back</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="<?= base_url('js/script.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init({
            once: true,
            duration: 900,
            easing: 'ease-out-cubic'
        });

        (function () {
            const form = document.getElementById('residential-lead-form');
            if (!form) {
                return;
            }

            const submitButton = form.querySelector('[data-role="submit"]');
            const tokenNameMeta = document.querySelector('meta[name="csrf-token-name"]');
            const tokenValueMeta = document.querySelector('meta[name="csrf-token-value"]');
            const csrfInput = form.querySelector('input[type="hidden"]');

            const resolveTokenName = () => (tokenNameMeta?.content || csrfInput?.name || '<?= csrf_token() ?>');
            const resolveTokenValue = () => (tokenValueMeta?.content || csrfInput?.value || '<?= csrf_hash() ?>');

            const refreshTokens = (payload) => {
                if (!payload) {
                    return;
                }
                if (payload.csrfToken) {
                    if (tokenNameMeta) {
                        tokenNameMeta.content = payload.csrfToken;
                    }
                    if (csrfInput) {
                        csrfInput.name = payload.csrfToken;
                    }
                }
                if (payload.csrfHash) {
                    if (tokenValueMeta) {
                        tokenValueMeta.content = payload.csrfHash;
                    }
                    if (csrfInput) {
                        csrfInput.value = payload.csrfHash;
                    }
                }
            };

            const extractErrors = (payload) => {
                if (payload?.errors && typeof payload.errors === 'object') {
                    return Object.values(payload.errors).join('\n');
                }
                if (payload?.messages && typeof payload.messages === 'object') {
                    return Object.values(payload.messages).join('\n');
                }
                return payload?.message || 'Please review the highlighted fields.';
            };

            const toggleButton = (isSubmitting) => {
                if (!submitButton) {
                    return;
                }
                submitButton.disabled = isSubmitting;
                submitButton.textContent = isSubmitting ? 'Sending...' : 'Request Call Back';
            };

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const fullName = form.full_name.value.trim();
                const email = form.email.value.trim().toLowerCase();
                const preferredCity = form.preferred_city.value.trim();
                const message = form.message.value.trim();

                if (!fullName || !email || message.length < 10) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing details',
                        text: 'Kindly fill all required fields with at least 10 characters in the requirement box.',
                    });
                    return;
                }

                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    Swal.fire({ icon: 'warning', title: 'Invalid email', text: 'Please provide a valid email address.' });
                    return;
                }

                toggleButton(true);

                const tokenName = resolveTokenName();
                const tokenValue = resolveTokenValue();

                const requestPayload = {
                    full_name: fullName,
                    email,
                    preferred_city: preferredCity,
                    message,
                };

                if (tokenName && tokenValue) {
                    requestPayload[tokenName] = tokenValue;
                }

                try {
                    const response = await fetch('<?= site_url('api/residential/lead') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': tokenValue,
                        },
                        body: JSON.stringify(requestPayload),
                        credentials: 'same-origin',
                    });

                    const data = await response.json().catch(() => ({}));
                    refreshTokens(data);

                    if (!response.ok || data.status !== 'success') {
                        Swal.fire({ icon: 'error', title: 'Please review the form', text: extractErrors(data) });
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Enquiry sent',
                        text: data.message || 'Your residential advisor will reach out shortly.',
                        timer: 3200,
                        showConfirmButton: false,
                    });
                    form.reset();
                } catch (error) {
                    Swal.fire({ icon: 'error', title: 'Network error', text: 'Unable to send your request. Please try again shortly.' });
                } finally {
                    toggleButton(false);
                }
            });
        })();
    </script>
</body>
</html>