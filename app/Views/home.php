    <?php
    $page_title = '36 Broking Hub';
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
    </head>
    <body>
        <?= $this->include('layouts/loader') ?>

        <?= $this->include('layouts/header') ?>
        <?php
        $listingModes = [
            ['label' => 'Rent', 'value' => 'rent'],
            ['label' => 'New Projects', 'value' => 'new_project'],
            ['label' => 'Commercial', 'value' => 'commercial'],
        ];
        $activeListingType = $searchListingType ?: $listingModes[0]['value'];
        ?>
        <section class="hero" data-aos="fade-down" data-aos-delay="100">
            <div id="heroBackgroundCarousel" class="carousel slide carousel-fade hero-bg-carousel position-absolute top-0 start-0 w-100 h-100" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100">
                        <img src="<?= base_url('images/Green and White Modern Simple Minimalist Geometric Abstract Shape Real Esta_20251218_135405_0000_page-0001.jpg') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Luxury penthouse exterior">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?= base_url('images/Green and White Modern Simple Minimalist Geometric Abstract Shape Real Esta_20251218_135405_0000_page-0002.jpg') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Modern residential skyline">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?= base_url('images/Green and White Modern Simple Minimalist Geometric Abstract Shape Real Esta_20251218_135405_0000_page-0003.jpg') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Contemporary home interior">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="<?= base_url('images/Green and White Modern Simple Minimalist Geometric Abstract Shape Real Esta_20251218_135405_0000_page-0004.jpg') ?>" class="d-block w-100 h-100 object-fit-cover" alt="Contemporary home interior">
                    </div>
                </div>
            </div>
            <div class="hero-bg-overlay position-absolute top-0 start-0 w-100 h-100"></div>
            <div class="hero-content position-relative">
                <h1 data-aos="fade-down" data-aos-delay="140">Find Your Dream Property</h1>
                <div class="hero-search-card" data-aos="fade-up" data-aos-delay="180">
                <div class="hero-search-mode" role="tablist" aria-label="Search segment control">
                    <?php foreach ($listingModes as $index => $mode): ?>
                        <?php
                            $isActiveMode = ($activeListingType === $mode['value']);
                            $buttonClasses = $isActiveMode ? 'active' : '';
                            $ariaPressed = $isActiveMode ? 'true' : 'false';
                        ?>
                        <button type="button" class="<?= $buttonClasses ?>" aria-pressed="<?= $ariaPressed ?>" data-listing-value="<?= esc($mode['value']) ?>">
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
                <form class="hero-search-form d-flex flex-wrap flex-lg-nowrap align-items-stretch" action="<?= site_url('properties') ?>" method="get">
                    <div class="search-field">
                        <i class="bi bi-search"></i>
                        <input type="text" name="query" placeholder="City, community or building" aria-label="Search location" value="<?= esc($searchQuery) ?>">
                    </div>
                    <div class="filter-dropdown" style="width: 42%;">
                        <button type="button" class="filter-btn" data-dropdown-target="propertyTypeDropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;">
                            <span class="filter-label" id="propertyTypeLabel" data-default="Property Type">Property Type</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="dropdown-panel" id="propertyTypeDropdown">
                            <p class="dropdown-heading">Property type</p>
                            <div class="dropdown-list">
                                <?php foreach ($propertyTypes as $type): ?>
                                    <button type="button" class="dropdown-option" data-value="<?= $type ?>" data-input="propertyTypeInput" data-label="propertyTypeLabel"><?= $type ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <input type="hidden" name="property_type" id="propertyTypeInput" value="<?= esc($searchPropertyType) ?>">
                    </div>
                    <div class="filter-dropdown" data-dropdown-priority="2">
                        <button type="button" class="filter-btn" data-dropdown-target="budgetDropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="filter-label" id="budgetLabel" data-default="Budget">Budget</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="dropdown-panel" id="budgetDropdown">
                            <p class="dropdown-heading">Budget range</p>
                            <div class="dropdown-list">
                                <?php foreach ($budgetOptions as $option): ?>
                                    <button type="button" class="dropdown-option" data-value="<?= esc($option['value']) ?>" data-input="budgetInput" data-label="budgetLabel"><?= esc($option['label']) ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <input type="hidden" name="budget" id="budgetInput" value="<?= esc($searchBudget) ?>">
                    </div>
                    <input type="hidden" name="listing_type" id="listingTypeInput" value="<?= esc($activeListingType) ?>">
                    <button type="submit" class="search-submit" style="border-radius: 0px 26px 26px 0px;">Search</button>
                </form>
                    <div class="hero-search-meta">
                        <span><i class="bi bi-patch-check-fill"></i> Verified listings daily</span>
                        <span><i class="bi bi-geo-alt"></i> 20+ cities served</span>
                    </div>
                </div>
            </div>
        </section>
        
        <?= $this->include('layouts/modal') ?>



        <main>
            <!-- FEATURED PROPERTY SECTION -->
            <section class="featured-property-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading">
                        <div>
                            <h2 class="section-title" data-aos="fade-up" data-aos-delay="220">Featured Property</h2>
                            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="240">Explore the best properties in your desired locations</p>
                        </div>
                        <a href="<?= site_url('properties') ?>" class="btn btn-outline-success rounded-pill" data-aos="fade-left" data-aos-delay="260">View All</a>
                    </div>
                    <div class="row" id="featured-properties-row">
                        <div class="col-12 text-center" id="featured-properties-loading">
                            <div class="spinner-border text-success" role="status"></div>
                            <p class="mt-3">Loading featured properties...</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- DISCOVER DEALS SECTION -->
            <section class="discover-deals-section py-5" data-aos="fade-up" data-aos-delay="440">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <h2 class="section-title" data-aos="fade-up" data-aos-delay="460">Discover the Best<br>Real Estate Deals</h2>
                            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="480">Find your perfect home from a wide range of properties.</p>
                        </div>
                        <div class="col-lg-6">
                            <img src="<?= base_url('images/Tracking Customers 3 Streamline Brooklyn.png') ?>" class="img-fluid rounded"
                                alt="Real estate deals illustration" data-aos="zoom-in" data-aos-delay="520">
                        </div>
                    </div>
                </div>
            </section>

            <!-- TRENDING PROPERTY CATEGORIES -->
            <section class="trending-categories-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading">
                        <div>
                            <h2 class="section-title">Trending Property Categories</h2>
                            <p class="section-subtitle">Browse popular property types across India</p>
                        </div>
                        <a href="<?= site_url('properties') ?>" class="btn btn-link text-success">See all categories <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <?php
                        $defaultCategories = ['Ready to Move Homes', 'Plots & Land', 'Luxury Villas', 'Commercial Offices', 'Co-working Spaces', 'Rentals'];
                        $categoryCards = [];
                        if (!empty($trendingCategories)) {
                            foreach ($trendingCategories as $item) {
                                $name = $item['property_category'] ?? '';
                                if (!$name) {
                                    continue;
                                }
                                $name = ucwords(str_replace(['_', '-'], ' ', $name));
                                $countLabel = number_format($item['listing_count']) . ' listings';
                                $categoryCards[] = ['name' => $name, 'subtitle' => $countLabel];
                            }
                        }
                        if (empty($categoryCards)) {
                            foreach ($defaultCategories as $default) {
                                $categoryCards[] = ['name' => $default, 'subtitle' => '5,000+ listings'];
                            }
                        }
                    ?>
                    <div class="row g-4">
                        <?php foreach ($categoryCards as $index => $category): ?>
                            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= 200 + ($index * 40) ?>">
                                <div class="category-card">
                                    <div class="icon-circle">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <h5><?= esc($category['name']) ?></h5>
                                    <p class="mb-0"><?= esc($category['subtitle']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
                                    <img src="<?= esc($project['image']) ?>" alt="<?= esc($project['city']) ?>" class="project-thumb">
                                    <div class="project-info">
                                        <p class="project-city mb-1"><i class="bi bi-geo-alt text-success me-1"></i><?= esc($project['city']) ?></p>
                                        <h5><?= esc($project['title']) ?></h5>
                                        <p class="small text-muted mb-2"><?= esc($project['subtitle']) ?></p>
                                        <p class="small text-success mb-2"><?= esc($project['info']) ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-light text-success"><?= esc($project['badge']) ?></span>
                                            <a href="<?= esc($project['link'], 'attr') ?>" class="btn btn-sm btn-outline-success rounded-pill"><?= esc($project['cta']) ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- WHY CHOOSE US SECTION -->
            <section class="why-choose-us-section py-5" data-aos="fade-up" data-aos-delay="540">
                <div class="container">
                    <div class="text-center">
                        <h2 class="section-title" data-aos="fade-up" data-aos-delay="560">Why choose us</h2>
                    </div>
                    <div class="row mt-4">
                        <?php $reasons = [
                            ['title' => 'Over 12 Lac properties', 'text' => '10,000+ properties are added every day.'],
                            ['title' => 'Verified by 36Broking Team', 'text' => 'Photos, videos, and documents verified on site.'],
                            ['title' => 'Large user base', 'text' => 'High intent buyers and tenants across metros.'],
                        ]; ?>
                        <?php foreach ($reasons as $idx => $reason): ?>
                            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= 580 + ($idx * 40) ?>">
                                <div class="choice-card">
                                    <div class="choice-number">0<?= $idx + 1 ?>.</div>
                                    <h5 class="choice-title"><?= $reason['title'] ?></h5>
                                    <p class="choice-text"><?= $reason['text'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- POPULAR LOCALITIES -->
            <section class="popular-localities-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading">
                        <div>
                            <h2 class="section-title">Popular Localities</h2>
                            <p class="section-subtitle">Hand-picked neighbourhoods with high demand</p>
                        </div>
                        <a href="<?= site_url('properties') ?>" class="btn btn-outline-secondary rounded-pill">View Locality Guides</a>
                    </div>
                    <?php
                        $popularLocalityCards = [];
                        if (!empty($popularLocalities)) {
                            foreach ($popularLocalities as $item) {
                                $locality = $item['locality'] ?? '';
                                $city = $item['city'] ?? '';
                                if (!$locality) {
                                    continue;
                                }
                                $popularLocalityCards[] = [
                                    'title' => trim($locality . ($city ? ', ' . $city : '')),
                                    'subtitle' => 'High demand neighbourhood',
                                    'extra' => 'Prime listings live',
                                    'badge' => number_format($item['listing_count'] ?? 0) . ' listings'
                                ];
                            }
                        }
                        if (empty($popularLocalityCards)) {
                            $popularLocalityCards = [
                                ['title' => 'Koramangala, Bengaluru', 'subtitle' => 'Avg price ₹12,500 / sq.ft', 'extra' => 'Schools • Tech Parks • Cafés', 'badge' => '1200+ listings'],
                                ['title' => 'Andheri East, Mumbai', 'subtitle' => 'Avg price ₹15,200 / sq.ft', 'extra' => 'Metros • Offices', 'badge' => '980+ listings'],
                                ['title' => 'Hitech City, Hyderabad', 'subtitle' => 'Avg price ₹10,800 / sq.ft', 'extra' => 'Tech corridors', 'badge' => '850+ listings'],
                                ['title' => 'Kharadi, Pune', 'subtitle' => 'Avg price ₹7,600 / sq.ft', 'extra' => 'IT parks &amp; clubs', 'badge' => '760+ listings'],
                                ['title' => 'Whitefield, Bengaluru', 'subtitle' => 'Avg price ₹11,300 / sq.ft', 'extra' => 'Residential communities', 'badge' => '650+ listings'],
                                ['title' => 'Nungambakkam, Chennai', 'subtitle' => 'Avg price ₹9,900 / sq.ft', 'extra' => 'Luxury high-rises', 'badge' => '580+ listings'],
                            ];
                        }
                    ?>
                    <div class="row g-4">
                        <?php foreach ($popularLocalityCards as $index => $locality): ?>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= 220 + ($index * 40) ?>">
                                <div class="locality-card">
                                    <div>
                                        <h5><?= esc($locality['title']) ?></h5>
                                        <p class="mb-1 text-muted"><?= esc($locality['subtitle']) ?></p>
                                        <p class="mb-0 small"><?= esc($locality['extra']) ?></p>
                                    </div>
                                    <span class="badge bg-success-subtle text-success"><?= esc($locality['badge']) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- CITY-WISE REAL ESTATE STATS -->
            <section class="city-stats-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading text-center">
                        <div>
                            <h2 class="section-title">City-wise Real Estate Pulse</h2>
                            <p class="section-subtitle">Live data compiled from 20k+ verified transactions</p>
                        </div>
                    </div>
                    <?php
                        $cityStatsCards = [];
                        if (!empty($cityStats)) {
                            $maxCount = max(array_column($cityStats, 'listing_count')) ?: 1;
                            foreach ($cityStats as $stat) {
                                $cityName = $stat['city'] ?? 'City';
                                $avgPrice = $stat['avg_price'] ?? null;
                                $count = (int) ($stat['listing_count'] ?? 0);
                                $growth = min(15, max(4, (int) floor($count / 30) + 3));
                                $progress = min(100, round(($count / $maxCount) * 100));
                                $cityStatsCards[] = [
                                    'city' => ucwords(strtolower($cityName)),
                                    'growth' => $growth,
                                    'avg_price' => $avgPrice,
                                    'progress' => $progress,
                                    'count' => $count
                                ];
                            }
                        }
                        if (empty($cityStatsCards)) {
                            $cityStatsCards = [
                                ['city' => 'Mumbai', 'growth' => 6, 'avg_price' => 90, 'progress' => 80, 'count' => 12000],
                                ['city' => 'Delhi NCR', 'growth' => 5, 'avg_price' => 82, 'progress' => 75, 'count' => 10500],
                                ['city' => 'Bengaluru', 'growth' => 7, 'avg_price' => 78, 'progress' => 72, 'count' => 9500],
                                ['city' => 'Hyderabad', 'growth' => 4, 'avg_price' => 70, 'progress' => 68, 'count' => 8500],
                            ];
                        }
                    ?>
                    <div class="row g-4">
                        <?php foreach ($cityStatsCards as $index => $stat): ?>
                            <?php
                                $priceLabel = is_numeric($stat['avg_price']) ? '₹' . number_format($stat['avg_price'], 0) . 'L' : 'Median price info';
                                $progressWidth = $stat['progress'] ?: 60;
                            ?>
                            <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?= 220 + ($index * 40) ?>">
                                <div class="city-stat-card">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0"><?= esc($stat['city']) ?></h5>
                                        <span class="badge bg-light text-success">+<?= esc($stat['growth']) ?>% QoQ</span>
                                    </div>
                                    <p class="mb-1">Median price</p>
                                    <h4><?= esc($priceLabel) ?></h4>
                                    <div class="progress" role="progressbar" aria-label="Price trend" aria-valuenow="<?= esc($progressWidth) ?>" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-success" style="width: <?= esc($progressWidth) ?>%"></div>
                                    </div>
                                    <p class="small text-muted mt-2"><?= number_format($stat['count']) ?> listings • Inventory absorption • Rental yield</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- TOP BUILDERS & DEVELOPERS -->
            <section class="top-builders-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading text-center">
                        <div>
                            <h2 class="section-title">Top Builders & Developers</h2>
                            <p class="section-subtitle">Trusted partners delivering on-time projects</p>
                        </div>
                    </div>
                    <?php $builderImages = [
                        'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&amp;fit=crop&amp;w=200&amp;q=80',
                        'https://images.unsplash.com/photo-1430285561322-7808604715df?auto=format&amp;fit=crop&amp;w=200&amp;q=80',
                        'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&amp;fit=crop&amp;w=200&amp;q=80',
                        'https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?auto=format&amp;fit=crop&amp;w=200&amp;q=80',
                        'https://images.unsplash.com/photo-1430285561322-7808604715df?auto=format&amp;fit=crop&amp;w=200&amp;q=80'
                    ]; ?>
                    <div class="row g-4 justify-content-center">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <?php $builderImage = $builderImages[$i % count($builderImages)]; ?>
                            <div class="col-md-2 col-6" data-aos="fade-up" data-aos-delay="<?= 220 + ($i * 40) ?>">
                                <div class="builder-card">
                                    <img src="<?= $builderImage ?>" alt="Builder Logo">
                                    <p class="mb-0">Heritage Builders</p>
                                    <small class="text-muted">42 projects</small>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </section>

            <!-- CUSTOMER TESTIMONIALS -->
            <section class="testimonials-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="section-heading text-center">
                        <div>
                            <h2 class="section-title">Customer Stories</h2>
                            <p class="section-subtitle">Hear from families who found their dream home</p>
                        </div>
                    </div>
                    <?php $testimonialPhotos = [
                        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&amp;fit=crop&amp;w=160&amp;q=80',
                        'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&amp;fit=crop&amp;w=160&amp;q=80',
                        'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&amp;fit=crop&amp;w=160&amp;q=80'
                    ]; ?>
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php for ($i = 0; $i < 3; $i++): ?>
                                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                                    <div class="testimonial-card mx-auto">
                                        <p class="testimonial-text">“36BrokingHub made our relocation seamless. Verified listings, virtual site visits, and a dedicated expert who negotiated the best deal for us.”</p>
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <img src="<?= $testimonialPhotos[$i % count($testimonialPhotos)] ?>" alt="Client" class="rounded-circle" width="60" height="60">
                                            <div>
                                                <h6 class="mb-0">Rahul & Meera Gupta</h6>
                                                <small class="text-muted">Moved to Bengaluru in Oct 2025</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </section>

            <!-- CALL TO ACTION STRIP -->
            <section class="cta-strip-section py-5" data-aos="fade-up" data-aos-delay="200">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="cta-card gradient-green">
                                <div>
                                    <h3>Post Your Property for FREE</h3>
                                    <p class="mb-0">Reach 1.5M active buyers & tenants instantly.</p>
                                </div>
                                <a href="<?= site_url('post-property') ?>" class="btn btn-light text-success fw-semibold">List Now</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="cta-card gradient-blue">
                                <div>
                                    <h3>Talk to an Expert Advisor</h3>
                                    <p class="mb-0">Dedicated relationship managers for NRI & premium clients.</p>
                                </div>
                                <a href="tel:7575853652" class="btn btn-light text-primary fw-semibold">Call 7575853652</a>
                            </div>
                        </div>
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
                                    <img src="<?= esc($card['image']) ?>" alt="<?= esc($card['title']) ?>" class="img-fluid rounded">
                                    <div class="mt-3">
                                        <h6><?= esc($card['title']) ?></h6>
                                        <p class="mb-1 text-success fw-semibold"><?= esc($card['price']) ?></p>
                                        <small class="text-muted"><?= esc($card['location']) ?> • <?= esc($card['area']) ?></small>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <span class="badge bg-success-subtle text-success"><?= esc($card['type']) ?></span>
                                            <a href="<?= esc($card['link'], 'attr') ?>" class="btn btn-outline-success btn-sm">View</a>
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
                            <p class="section-subtitle">Quick answers for first-time buyers, investors, and landlords</p>
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
                                            <button class="accordion-button <?= $idx !== 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?= $idx ?>" aria-expanded="<?= $idx === 0 ? 'true' : 'false' ?>" aria-controls="faqCollapse<?= $idx ?>">
                                                <?= $faq['q'] ?>
                                            </button>
                                        </h2>
                                        <div id="faqCollapse<?= $idx ?>" class="accordion-collapse collapse <?= $idx === 0 ? 'show' : '' ?>" aria-labelledby="faqHeading<?= $idx ?>" data-bs-parent="#faqAccordion">
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
        <div class="video-ad-card" id="videoAdCard" aria-live="polite">
            <button type="button" class="video-ad-close" id="videoAdClose" aria-label="Close video preview">×</button>
            <div class="video-ad-label">Featured walkthrough</div>
            <p class="video-ad-title">Quick tour from our premium collection</p>
            <video id="videoAdMedia" muted loop playsinline preload="metadata">
                <source src="<?= base_url('videos/vidio_1.mp4') ?>" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
            <div class="video-ad-footer">
                <span>Tap to enable sound.</span>
                <button type="button" class="video-ad-unmute" id="videoAdUnmute">Unmute</button>
            </div>
        </div>
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
                    var buttonValue = (modeButton.getAttribute('data-listing-value') || '').toLowerCase();
                    if (!matchedButton && normalized && buttonValue === normalized) {
                        matchedButton = modeButton;
                    }
                });

                if (!matchedButton && heroModeButtons.length) {
                    matchedButton = heroModeButtons[0];
                    normalized = (matchedButton.getAttribute('data-listing-value') || '').toLowerCase();
                }

                heroModeButtons.forEach(function(modeButton) {
                    var buttonValue = (modeButton.getAttribute('data-listing-value') || '').toLowerCase();
                    var isActive = matchedButton ? buttonValue === normalized : false;
                    modeButton.classList.toggle('active', isActive);
                    modeButton.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });

                if (listingTypeInput) {
                    listingTypeInput.value = matchedButton ? (matchedButton.getAttribute('data-listing-value') || '') : '';
                }
            }

            heroModeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    setActiveListingMode(button.getAttribute('data-listing-value'));
                });
            });

            if (heroModeButtons.length) {
                var initialMode = listingTypeInput && listingTypeInput.value
                    ? listingTypeInput.value
                    : heroModeButtons[0].getAttribute('data-listing-value');
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
                    return (btn.getAttribute('data-value') || '').toLowerCase() === normalized.toLowerCase();
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
                    dropdown.querySelectorAll('.dropdown-option[data-input="' + inputId + '"]').forEach(function(btn) {
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
            const currencyFormatter = new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR', maximumFractionDigits: 0 });

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
                const imageUrl = primaryMedia.file_url || primaryMedia.url || primaryMedia.fileUrl || fallbackImage;
                const title = property.property_name || details.title || details.sub_property_type || property.property_type || 'Property';
                const locationParts = [
                    property.locality || details.locality || details.sublocality,
                    property.city || details.city
                ].filter(Boolean);
                const location = locationParts.length ? locationParts.join(', ') : 'Location';
                const priceLabel = formatPrice((property.pricing && property.pricing.price) ? property.pricing.price : property.price);
                const areaLabel = formatArea(details.area_sqft);
                const possession = details.availability ? details.availability.replace(/_/g, ' ') : 'Available soon';
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
                    container.innerHTML = '<div class="col-12 text-center py-5">No featured properties available.</div>';
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
                    container.innerHTML = `<div class="col-12 text-center text-danger py-5">Failed to load featured properties. ${error.message}</div>`;
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
                    footerNote.textContent = shouldEnable
                        ? 'Sound on. Tap to mute.'
                        : 'Tap to enable sound.';
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