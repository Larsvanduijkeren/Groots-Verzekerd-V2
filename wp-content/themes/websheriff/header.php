<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title('|', true, 'right'); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="format-detection" content="telephone=no">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
wp_body_open();

$logo = get_field('logo', 'option');
?>

<span class="hamburger">
    <span class="line line-1"></span>
    <span class="line line-2"></span>
</span>

<nav class='mobile-nav'>
    <div class='content'>
        <div class='nav'>
            <div class='flex-wrapper'>
                <?php wp_nav_menu(['theme_location' => 'mobile-nav']); ?>

                <?php if (empty($header_button) === false) {
                    echo sprintf('<a class="btn cta-btn" href="%s" target="%s">%s</a>', $header_button['url'], $header_button['target'], $header_button['title']);
                } ?>
            </div>
        </div>
    </div>
</nav>

<header class='header'>
    <div class='container'>
        <div class='top-wrapper'>
            <a href='/' class='logo'>
                Logo Groots Verzekerd
                <?php
                if (empty($logo) === false) : ?>
                    <img src='<?php echo $logo['sizes']['large']; ?>' alt=''>
                <?php endif; ?>
            </a>

            <?php wp_nav_menu(['theme_location' => 'header-nav']); ?>

            <div class="right">
                <?php if (empty($header_button) === false) {
                    echo sprintf('<a href="%s" target="%s" class="btn blue">%s</a>', $header_button['url'], $header_button['target'], $header_button['title']);
                } ?>
            </div>
        </div>

        <div class="bottom-wrapper">
            <?php if (empty($usps) === false) : ?>
                <div class="usps">
                    <?php foreach ($usps as $usp) : ?>
                        <?php if (empty($usp['usp']) === false) : ?>
                            <div class="usp"><?php echo $usp['usp']; ?></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="right">
                <?php if (empty($header_image) === false) : ?>
                        <img src="<?php echo $header_image['sizes']['medium']; ?>"
                             alt="<?php echo $header_image['alt']; ?>">
                <?php endif; ?>

                <?php if (empty($header_extra_button) === false) {
                    echo sprintf('<a href="%s" target="%s" class="btn white small">%s</a>', $header_extra_button['url'], $header_extra_button['target'], $header_extra_button['title']);
                } ?>

                <span class="lang">Lang switch</span>
            </div>
        </div>
</header>

<main id="main-content" class="page-content" role="main">
