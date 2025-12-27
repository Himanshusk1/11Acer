<?php
$page_title = 'Commercial Real Estate | 11 Acer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/responsive.css') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/favicon/favicon-16x16.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <link rel="manifest" href="<?= base_url('images/favicon/site.webmanifest') ?>">
    <style>
        :root {
            --brand:#198754;
            --brand-dark:#0f2d27;
            --brand-soft:#e6f2ec;
            --muted:#6c757d;
            --surface:#ffffff;
            --background:#f7faf8;
            --shadow:0 25px 70px rgba(15,29,22,0.12);
            --radius:20px;
        }
        body { font-family:'Inter',system-ui,-apple-system,'Segoe UI',sans-serif; background:var(--background); color:#0f2d27; }
        h1,h2,h3,h4,h5,h6 { font-weight:600; }
        .btn-brand { background:var(--brand); border-color:var(--brand); color:#fff; border-radius:999px; padding:0.65rem 1.75rem; font-weight:600; box-shadow:0 18px 30px rgba(25,135,84,0.25); }
        .btn-brand:hover { background:#157247; border-color:#157247; color:#fff; }
        .btn-brand-outline { border-radius:999px; border:1.5px solid var(--brand); color:var(--brand); padding:0.65rem 1.5rem; font-weight:600; }
        .btn-brand-outline:hover { background:var(--brand); color:#fff; }
        .section-title { max-width:620px; margin:0 auto 2.5rem; text-align:center; }
        .section-title p { color:var(--muted); }
        .hero-commercial { position:relative; overflow:hidden; border-radius:28px; padding:clamp(2rem,4vw,3.5rem); background:linear-gradient(135deg,rgba(15,45,39,0.92),rgba(20,88,64,0.85)), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=80') center/cover; color:#fff; box-shadow:var(--shadow); min-height: clamp(380px, 60vh, 520px); }
        .hero-commercial h1 { font-size: clamp(2rem, 4.8vw, 3.5rem); line-height: 1.2; }
        .hero-commercial .lead { font-size: clamp(1rem, 2.2vw, 1.25rem); }
        .hero-tag { text-transform:uppercase; letter-spacing:0.2em; font-size:0.75rem; color:rgba(255,255,255,0.7); }
        .hero-metrics { display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:1.25rem; margin-top:2rem; }
        .hero-metric { min-width:0; }
        .hero-metric h4 { font-size:clamp(1.5rem,3.8vw,2.25rem); margin-bottom:0.35rem; }
        .content-card { background:var(--surface); border-radius:var(--radius); padding:1.75rem; box-shadow:var(--shadow); height:100%; border:1px solid rgba(25,135,84,0.08); }
        .content-card .icon-shape { width:50px; height:50px; border-radius:16px; background:var(--brand-soft); color:var(--brand); display:grid; place-items:center; font-size:1.3rem; margin-bottom:1rem; }
        .category-card { background:#fff; border-radius:var(--radius); padding:1.5rem; border:1px solid rgba(25,135,84,0.1); transition:transform 0.2s ease, box-shadow 0.2s ease; height:100%; }
        .category-card:hover { transform:translateY(-6px); box-shadow:var(--shadow); }
        .listing-card { border-radius:24px; overflow:hidden; background:#fff; border:1px solid rgba(25,135,84,0.12); box-shadow:0 25px 50px rgba(8,16,12,0.08); height:100%; display:flex; flex-direction:column; }
        .listing-card img { height:220px; object-fit:cover; width:100%; display:block; }
        .listing-card-body { padding:1.5rem; flex:1; }
        .badge-soft { background:var(--brand-soft); color:var(--brand-dark); border-radius:999px; font-size:0.75rem; padding:0.2rem 0.75rem; }
        .feature-grid { --bs-gutter-x:1.5rem; }
        .feature-item { background:#fff; border-radius:var(--radius); padding:1.25rem; border:1px solid rgba(25,135,84,0.08); box-shadow:var(--shadow); }
        .hotspot-card { border-radius:var(--radius); padding:1.5rem; background:linear-gradient(135deg,#fff,rgba(230,242,236,0.75)); border:1px solid rgba(25,135,84,0.15); }
        .testimonial-card { border-radius:var(--radius); background:#fff; border:1px solid rgba(25,135,84,0.12); padding:1.75rem; box-shadow:var(--shadow); height:100%; }
        .faq-accordion .accordion-button { font-weight:600; border-radius:var(--radius); }
        .cta-banner { border-radius:28px; background:linear-gradient(135deg,rgba(25,135,84,0.12),rgba(15,45,39,0.9)); color:#fff; padding:3rem; box-shadow:var(--shadow); position:relative; overflow:hidden; }
        .cta-banner::after { content:""; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1400&q=80') center/cover; opacity:0.12; }
        .cta-banner > * { position:relative; }
        .contact-card { border-radius:var(--radius); padding:2rem; background:#fff; border:1px solid rgba(25,135,84,0.1); box-shadow:var(--shadow); }
        .city-chip { border-radius:999px; background:#fff; border:1px solid rgba(25,135,84,0.2); padding:0.45rem 1.5rem; box-shadow:var(--shadow); }
        @media (max-width:991.98px) {
            .hero-commercial { padding:2rem; }
            .cta-banner { padding:2.25rem; }
            .contact-card form .d-flex { flex-wrap:wrap; }
        }
        @media (max-width:767.98px) {
            .hero-commercial { padding:1.75rem; min-height:auto; border-radius:0 0 1.5rem 1.5rem; text-align:center; }
            .hero-commercial .d-flex { justify-content:center; }
        }
        @media (max-width:575.98px) {
            .content-card { padding:1.35rem; }
            .listing-card img { height:200px; }
        }
    </style>
</head>
<body>
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-value" content="<?= csrf_hash() ?>">
    <?= $this->include('layouts/loader', ['loaderMessage' => 'Preparing premium commercial spaces...']) ?>

    <?= $this->include('layouts/header') ?>

    <main class="py-5">
        <div class="container">
            <section class="hero-commercial mb-5" data-aos="fade-up">
                <p class="hero-tag">Commercial real estate</p>
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <h1 class="display-5 fw-bold mb-3">Unlock Growth with Grade-A Commercial Properties</h1>
                        <p class="lead">11 Acer curates high-performing office, retail, industrial and land assets across Indiawith data-backed advisory, seamless leasing and end-to-end transaction support.</p>
                        <div class="cta-actions d-flex gap-3 mt-4">
                            <a href="#listings" class="btn btn-brand">Explore Listings</a>
                            <a href="#schedule" class="btn btn-brand-outline">Book a Consultation</a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="hero-metrics">
                            <div class="hero-metric">
                                <h4>450+</h4>
                                <p class="mb-0 text-white-50">Commercial mandates executed</p>
                            </div>
                            <div class="hero-metric">
                                <h4>12M+ sq.ft</h4>
                                <p class="mb-0 text-white-50">Grade-A inventory under advisory</p>
                            </div>
                            <div class="hero-metric">
                                <h4>30+ cities</h4>
                                <p class="mb-0 text-white-50">Pan-India presence</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="py-5">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <p class="hero-tag text-muted">Why choose us</p>
                    <h2>Strategic partners for every commercial ambition</h2>
                    <p>From institutional investors to growing startups, we structure data-driven deals, mitigate risk, and accelerate occupancy for superior ROI.</p>
                </div>
                <div class="row g-4 auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4">
                    <div class="col" data-aos="fade-up" data-aos-delay="50">
                        <div class="content-card">
                            <div class="icon-shape"><i class="bi bi-graph-up"></i></div>
                            <h5>Investment Advisory</h5>
                            <p class="mb-0 text-muted">Market intelligence, asset underwriting and financial models designed to preserve capital while maximizing yield.</p>
                        </div>
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="100">
                        <div class="content-card">
                            <div class="icon-shape"><i class="bi bi-buildings"></i></div>
                            <h5>Grade-A Inventory</h5>
                            <p class="mb-0 text-muted">Exclusive offices, high-street retail, warehousing and industrial campuses available across key micro-markets.</p>
                        </div>
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="150">
                        <div class="content-card">
                            <div class="icon-shape"><i class="bi bi-lightning-charge"></i></div>
                            <h5>Faster Occupancy</h5>
                            <p class="mb-0 text-muted">Tenant vetting, fit-out coordination and digital marketing funnels keep your commercial asset income-ready.</p>
                        </div>
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="200">
                        <div class="content-card">
                            <div class="icon-shape"><i class="bi bi-shield-check"></i></div>
                            <h5>Compliance & Legal</h5>
                            <p class="mb-0 text-muted">Title diligence, lease structuring and RERA-compliant documentation handled by our in-house legal desk.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-white">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <p class="hero-tag text-muted">Commercial portfolio</p>
                    <h2>Diverse spaces engineered for productivity</h2>
                </div>
                <div class="row g-4 auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-3">
                    <?php
                    $categories = [
                        ['title'=>'Premium Offices','desc'=>'Column-free floor plates, LEED-certified towers and tech-enabled workspaces.','icon'=>'bi-laptop','delay'=>0],
                        ['title'=>'Retail & High Streets','desc'=>'Ground-floor retail pods, malls and mixed-use high street blocks.','icon'=>'bi-shop-window','delay'=>50],
                        ['title'=>'Warehousing & Logistics','desc'=>'Grade-A industrial sheds with dock levellers, racking and 3PL infra.','icon'=>'bi-box-seam','delay'=>100],
                        ['title'=>'Commercial Land Parcels','desc'=>'Investment-grade zoned plots with clear titles for build-to-suit.','icon'=>'bi-map','delay'=>150],
                        ['title'=>'Co-working & Flex','desc'=>'Plug-and-play managed offices, enterprise pods and innovation hubs.','icon'=>'bi-people','delay'=>200],
                        ['title'=>'Hospitality Assets','desc'=>'Business hotels & serviced apartments for corporate stays.','icon'=>'bi-building','delay'=>250],
                    ];
                    foreach ($categories as $category): ?>
                        <div class="col" data-aos="fade-up" data-aos-delay="<?= esc($category['delay']) ?>">
                            <div class="category-card h-100">
                                <div class="icon-shape mb-3"><i class="bi <?= esc($category['icon']) ?>"></i></div>
                                <h5><?= esc($category['title']) ?></h5>
                                <p class="text-muted mb-0"><?= esc($category['desc']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="py-5" id="highlights">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <p class="hero-tag text-muted">Highlights</p>
                    <h2>Operational excellence built into every mandate</h2>
                </div>
                <div class="row g-4 feature-grid auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="col">
                        <div class="feature-item h-100">
                            <h6 class="text-uppercase text-muted">Integrated analytics</h6>
                            <p class="mb-1 fw-semibold">Heatmaps, vacancy rates & rental benchmarks updated weekly.</p>
                            <small class="text-muted">Powered by our proprietary CRE Pulse dashboard.</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-item h-100">
                            <h6 class="text-uppercase text-muted">Tenant experience</h6>
                            <p class="mb-1 fw-semibold">End-to-end onboarding, facility partners and CX playbooks.</p>
                            <small class="text-muted">Curated to sustain retention and low downtime.</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-item h-100">
                            <h6 class="text-uppercase text-muted">Sustainable builds</h6>
                            <p class="mb-1 fw-semibold">Green specs, solar-ready rooftops & smart automation.</p>
                            <small class="text-muted">Reduce opex while fulfilling ESG mandates.</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-item h-100">
                            <h6 class="text-uppercase text-muted">Capital partnerships</h6>
                            <p class="mb-1 fw-semibold">Access to AIFs, REIT desks and institutional buyers.</p>
                            <small class="text-muted">Structured exits, strata sales & pre-leasing strategies.</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-white" id="listings">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <p class="hero-tag text-muted">Featured stock</p>
                    <h2>Top commercial listings ready for immediate move-in</h2>
                </div>
                <div class="row g-4 auto-grid row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <?php
                        $commercialCards = [];
                        if (!empty($commercialListings)) {
                            foreach ($commercialListings as $listing) {
                                $details = $listing['details'] ?? [];
                                $typeLabel = $listing['property_type'] ?? ($details['sub_property_type'] ?? 'Commercial');
                                $location = trim(implode(', ', array_filter([$listing['locality'] ?? '', $listing['city'] ?? ''])));
                                $areaLabel = isset($details['area_sqft']) ? number_format($details['area_sqft']) . ' sq.ft' : 'Flexible size';
                                $priceRaw = $listing['pricing']['price'] ?? null;
                                $priceLabel = $priceRaw ? '₹ ' . number_format($priceRaw) : 'Price available on request';
                                $badge = ($listing['transaction_type'] ?? '') === 'rent' ? 'For Rent' : 'For Sale';
                                $cta = ($listing['transaction_type'] ?? '') === 'rent' ? 'Take a Tour' : 'View Sale';
                                $propertyId = $listing['id'] ?? $listing['property_id'] ?? $listing['propertyId'] ?? null;
                                $cardLink = site_url('post-your-property');
                                if (!empty($propertyId)) {
                                    $cardLink = site_url('property') . '?id=' . urlencode($propertyId);
                                }
                                $commercialCards[] = [
                                    'title' => $listing['property_name'] ?? 'Premium space',
                                    'city' => $location ?: 'Multiple cities',
                                    'type' => $typeLabel,
                                    'price' => $priceLabel,
                                    'area' => $areaLabel,
                                    'badge' => $badge,
                                    'cta' => $cta,
                                    'img' => $details['hero_image'] ?? base_url('images/property.png'),
                                    'link' => $cardLink
                                ];
                            }
                        }
                        $delay = 0;
                        if (empty($commercialCards)) {
                            $commercialCards = [
                                ['title'=>'Skyline Infinity Park','city'=>'BKC, Mumbai','type'=>'Grade-A Office','price'=>'₹ 250 / sq.ft per month','area'=>'32,000 sq.ft','badge'=>'For Rent','cta'=>'Enquire','img'=>'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1200&q=80','link'=>site_url('post-your-property')],
                                ['title'=>'Orbit One High Street','city'=>'Golf Course Road, Gurugram','type'=>'Retail High Street','price'=>'₹ 620 per sq.ft','area'=>'8,500 sq.ft','badge'=>'For Sale','cta'=>'Take a Tour','img'=>'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80','link'=>site_url('post-your-property')],
                                ['title'=>'Gateway Logistics Hub','city'=>'Oragadam, Chennai','type'=>'Warehouse BTS','price'=>'₹ 23 / sq.ft','area'=>'1,20,000 sq.ft','badge'=>'For Rent','cta'=>'Enquire','img'=>'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80','link'=>site_url('post-your-property')],
                                ['title'=>'Vertex Co-lab Center','city'=>'Koregaon Park, Pune','type'=>'Managed Co-working','price'=>'₹ 7,500 per seat','area'=>'320 seats','badge'=>'For Rent','cta'=>'Take a Tour','img'=>'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80','link'=>site_url('post-your-property')],
                                ['title'=>'Harbor Edge Business Bay','city'=>'Gachibowli, Hyderabad','type'=>'Investment Sale','price'=>'₹ 78 Cr','area'=>'85,000 sq.ft','badge'=>'For Sale','cta'=>'View Sale','img'=>'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1200&q=80','link'=>site_url('post-your-property')],
                                ['title'=>'Zenith Corporate Tower','city'=>'Electronic City, Bengaluru','type'=>'Full Building Lease','price'=>'₹ 190 / sq.ft','area'=>'55,000 sq.ft','badge'=>'For Rent','cta'=>'Enquire','img'=>'https://images.unsplash.com/photo-1486304873000-235643847519?auto=format&fit=crop&w=1200&q=80','link'=>site_url('post-your-property')],
                            ];
                        }
                        foreach ($commercialCards as $card): ?>
                            <div class="col" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                                <div class="listing-card h-100">
                                    <img loading="lazy" src="<?= esc($card['img']) ?>" alt="<?= esc($card['title']) ?>">
                                    <div class="listing-card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge-soft"><?= esc($card['badge']) ?></span>
                                            <small class="text-muted"><i class="bi bi-geo-alt"></i> <?= esc($card['city']) ?></small>
                                        </div>
                                        <h5><?= esc($card['title']) ?></h5>
                                        <p class="text-muted mb-3">Area: <?= esc($card['area']) ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong><?= esc($card['price']) ?></strong>
                                            <a href="<?= esc($card['link']) ?>" class="btn btn-sm btn-brand-outline"><?= esc($card['cta']) ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $delay += 60; endforeach; ?>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="cta-banner text-center" data-aos="fade-up">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8 text-lg-start">
                            <p class="hero-tag text-white-50">Landlords & developers</p>
                            <h2 class="mb-3 text-white">List your commercial property with our institutional desk</h2>
                            <p class="mb-0 text-white-75">Dedicated asset managers, premium marketing, tenant screening and deal structuring to keep your spaces fully leased.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="<?= site_url('post-your-property') ?>" class="btn btn-brand">List a Property</a>
                            <a href="<?= site_url('services') ?>" class="btn btn-brand-outline mt-3">Discover Services</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-white">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <p class="hero-tag text-muted">Hotspots</p>
                    <h2>City-wise commercial corridors we specialize in</h2>
                </div>
                <div class="row g-4 auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-3">
                    <?php
                    $hotspotCities = $cityCorridors ?? [];
                    $delay = 0;
                    foreach ($hotspotCities as $city): ?>
                        <div class="col" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                            <div class="hotspot-card h-100">
                                <h5 class="mb-2"><i class="bi bi-geo-alt text-success me-2"></i><?= esc($city['name']) ?></h5>
                                <p class="mb-0 text-muted"><?= esc($city['areas']) ?></p>
                            </div>
                        </div>
                    <?php $delay += 60; endforeach; ?>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-4" data-aos="fade-up" data-aos-delay="100">
                    <?php foreach ($cityCorridorChips ?? [] as $chip): ?>
                        <span class="city-chip"><?= esc($chip) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="section-title text-lg-start text-center">
                            <p class="hero-tag text-muted">Success stories</p>
                            <h2>Trusted by enterprise occupiers & institutional landlords</h2>
                        </div>
                        <div class="accordion faq-accordion" id="faqAccordion">
                            <?php
                            $faqs = [
                                ['question'=>'How do you shortlist properties for corporate occupiers?','answer'=>'We conduct requirement workshops, benchmark rents, evaluate floor efficiencies, compliance, ESG readiness and present curated options with virtual walkthroughs.'],
                                ['question'=>'What support do landlords receive?','answer'=>'Dedicated asset managers drive leasing funnels, run digital campaigns, negotiate leases, supervise fit-outs and manage audits till handover.'],
                                ['question'=>'Do you help with investment sales or strata deals?','answer'=>'Yes, our investment advisory team structures strata sales, REIT exits, pre-leased sales and forward-purchase transactions with institutional partners.'],
                            ];
                            $idx = 0;
                            foreach ($faqs as $faq):
                                $idx++;
                                $show = $idx === 1 ? 'show' : '';
                                $collapsed = $idx === 1 ? '' : 'collapsed';
                            ?>
                                <div class="accordion-item mb-3 border-0 shadow-sm rounded-4">
                                    <h2 class="accordion-header" id="heading<?= $idx ?>">
                                        <button class="accordion-button <?= $collapsed ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $idx ?>" aria-expanded="<?= $idx === 1 ? 'true' : 'false' ?>" aria-controls="collapse<?= $idx ?>">
                                            <?= esc($faq['question']) ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $idx ?>" class="accordion-collapse collapse <?= $show ?>" aria-labelledby="heading<?= $idx ?>" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body text-muted">
                                            <?= esc($faq['answer']) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="row g-4 auto-grid row-cols-1">
                            <?php
                            $testimonials = [
                                ['name'=>'Neha Kapoor','role'=>'Head of Workplace, Fintech Unicorn','quote'=>'11 Acer completed our 120,000 sq.ft consolidation in under 90 days with zero downtime. Their fit-out and legal teams were priceless.'],
                                ['name'=>'Ravi Menon','role'=>'Asset Manager, Institutional Fund','quote'=>'Their data-backed leasing program improved our NOI by 18% across three Grade-A IT parks. Exceptional tenant relationships.'],
                                ['name'=>'Sanjay Tiwari','role'=>'Founder, D2C Logistics','quote'=>'From land acquisition to built-to-suit warehouse delivery, the CRE team handled every milestone seamlessly.'],
                            ];
                            $delay = 0;
                            foreach ($testimonials as $testimonial): ?>
                                <div class="col" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                                    <div class="testimonial-card">
                                        <p class="mb-3 text-muted fst-italic">"<?= esc($testimonial['quote']) ?>"</p>
                                        <h6 class="mb-0"><?= esc($testimonial['name']) ?></h6>
                                        <small class="text-muted"><?= esc($testimonial['role']) ?></small>
                                    </div>
                                </div>
                            <?php $delay += 60; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-white" id="schedule">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="contact-card">
                            <p class="hero-tag text-muted mb-2">Schedule a visit</p>
                            <h3 class="mb-3">Co-create your commercial roadmap with our CRE strategists</h3>
                            <form class="row g-3" id="commercial-visit-form" novalidate>
                                <?= csrf_field() ?>
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="Enter name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Company Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="you@company.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="+91 98765 43210" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Requirement</label>
                                    <select class="form-select" name="requirement">
                                        <option value="Office lease">Office lease</option>
                                        <option value="Retail">Retail</option>
                                        <option value="Industrial / Warehouse">Industrial / Warehouse</option>
                                        <option value="Land / Investment">Land / Investment</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" name="message" rows="3" placeholder="Tell us about your timeline, size and city preference" required></textarea>
                                </div>
                                <div class="col-12 d-flex flex-column flex-md-row gap-3">
                                    <button type="submit" class="btn btn-brand" data-role="submit">Request Callback</button>
                                    <button type="button" class="btn btn-brand-outline">Download Commercial Deck</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="content-card h-100">
                            <h4>Need immediate assistance?</h4>
                            <p class="text-muted">Our CRE desk is live Monday to Saturday, 9:00 AM - 9:00 PM IST.</p>
                            <div class="d-flex flex-column gap-2">
                                <div><i class="bi bi-telephone text-success me-2"></i><strong>+91 75758 53652</strong></div>
                                <div><i class="bi bi-envelope text-success me-2"></i>commercial@36brokinghub.com</div>
                                <div><i class="bi bi-compass text-success me-2"></i>Level 16, One World Center, Mumbai</div>
                            </div>
                            <hr>
                            <ul class="list-unstyled mb-0 text-muted">
                                <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i>24-hour document turnaround</li>
                                <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i>Virtual & physical site tours</li>
                                <li><i class="bi bi-check2-circle text-success me-2"></i>Dedicated post-transaction onboarding</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('js/script.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.AOS?.init({ duration:700, once:true, offset:80 });
        });

        (function () {
            const form = document.getElementById('commercial-visit-form');
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
                submitButton.textContent = isSubmitting ? 'Sending...' : 'Request Callback';
            };

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const fullName = form.full_name.value.trim();
                const email = form.email.value.trim().toLowerCase();
                const phone = form.phone.value.trim();
                const requirement = form.requirement.value.trim();
                const message = form.message.value.trim();

                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const phonePattern = /^[0-9\-\+\(\) ]{8,20}$/;

                if (fullName.length < 3 || !emailPattern.test(email) || !phonePattern.test(phone) || message.length < 10) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing details',
                        text: 'Kindly share a valid name, email, phone, and at least 10 characters about your requirement.',
                    });
                    return;
                }

                toggleButton(true);

                const tokenName = resolveTokenName();
                const tokenValue = resolveTokenValue();

                const requestPayload = {
                    full_name: fullName,
                    email,
                    phone,
                    requirement,
                    message,
                };

                if (tokenName && tokenValue) {
                    requestPayload[tokenName] = tokenValue;
                }

                try {
                    const response = await fetch('<?= site_url('api/commercial/visit') ?>', {
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
                        title: 'Visit request sent',
                        text: data.message || 'A commercial advisor will connect with you shortly.',
                        timer: 3200,
                        showConfirmButton: false,
                    });
                    form.reset();
                } catch (error) {
                    Swal.fire({ icon: 'error', title: 'Network error', text: 'Unable to submit your request. Please try again shortly.' });
                } finally {
                    toggleButton(false);
                }
            });
        })();
    </script>
</body>
</html>