<?php
$defaultTitle = '36Broking | Trusted Real Estate Marketplace';
$defaultDescription = 'Explore verified residential and commercial listings with 36Broking. Discover, list, and secure properties with personalized guidance across India.';
$defaultKeywords = '36Broking, Sachiva Web & Security, real estate, property listings, buy property, sell property, rent property, commercial space, residential projects';

$pageTitle = trim($page_title ?? '') ?: $defaultTitle;
$pageDescription = trim($page_description ?? '') ?: $defaultDescription;
$pageKeywords = trim($page_keywords ?? '') ?: $defaultKeywords;
$pageRobots = trim($page_robots ?? '') ?: 'index, follow';
$pageThemeColor = trim($page_theme_color ?? '') ?: '#0b1f3a';
$pageOgType = trim($page_og_type ?? '') ?: 'website';
$pageOgImage = trim($page_og_image ?? '') ?: base_url('images/home.png');
$twitterCreator = trim($twitter_creator ?? '') ?: '@SachivaSecurity';

$request = service('request');
$canonicalUrl = base_url();
if ($request && method_exists($request, 'getUri')) {
    $uri = $request->getUri();
    if ($uri instanceof \CodeIgniter\HTTP\URI) {
        $clean = clone $uri;
        $clean->setQuery('');
        $clean->setFragment('');
        $canonicalUrl = rtrim((string) $clean, '/') ?: base_url();
    }
}
$pageUrl = $canonicalUrl;
?>
<title><?= esc($pageTitle) ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?= esc($pageDescription) ?>">
<meta name="keywords" content="<?= esc($pageKeywords) ?>">
<meta name="theme-color" content="<?= esc($pageThemeColor) ?>">
<meta name="robots" content="<?= esc($pageRobots) ?>">
<link rel="canonical" href="<?= esc($pageUrl) ?>">

<meta name="author" content="Sumit Rathor — https://sumitrathor.rf.gd/">
<meta name="author" content="Himanshu Singh Kiyariya — https://himanshusk.rf.gd/">
<meta name="publisher" content="Sachiva Web & Security — https://sachiva.in/">

<meta property="og:title" content="<?= esc($pageTitle) ?>">
<meta property="og:description" content="<?= esc($pageDescription) ?>">
<meta property="og:type" content="<?= esc($pageOgType) ?>">
<meta property="og:url" content="<?= esc($pageUrl) ?>">
<meta property="og:image" content="<?= esc($pageOgImage) ?>">
<meta property="og:site_name" content="36Broking">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="<?= esc($twitterCreator) ?>">
<meta name="twitter:title" content="<?= esc($pageTitle) ?>">
<meta name="twitter:description" content="<?= esc($pageDescription) ?>">
<meta name="twitter:image" content="<?= esc($pageOgImage) ?>">

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Sachiva Web & Security',
    'url' => 'https://sachiva.in/',
    'founder' => [
        [
            '@type' => 'Person',
            'name' => 'Sumit Rathor',
            'url' => 'https://sumitrathor.rf.gd/'
        ],
        [
            '@type' => 'Person',
            'name' => 'Himanshu Singh Kiyariya',
            'url' => 'https://himanshusk.rf.gd/'
        ]
    ],
    'creator' => 'Sachiva Web & Security',
    'maintainer' => 'Sachiva Web & Security'
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>
