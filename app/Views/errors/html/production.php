<?php
$page_title = lang('Errors.whoops');
$page_robots = 'noindex, nofollow';
?>
<!doctype html>
<html>
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
<style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>
</head>
<body>

    <div class="container text-center">

        <h1 class="headline"><?= lang('Errors.whoops') ?></h1>

        <p class="lead"><?= lang('Errors.weHitASnag') ?></p>

    </div>

</body>

</html>
