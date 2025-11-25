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
$phone = get_field('phone', 'option');
$email = get_field('email', 'option');
$app_link = get_field('app_link', 'option');
$buttons = get_field('buttons', 'option');
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
        <div class='flex-wrapper'>
            <a href='/' class='logo'>
                Logo Groots Verzekerd
                <?php
                if (empty($logo) === false) : ?>
                    <img src='<?php echo $logo['sizes']['large']; ?>' alt=''>
                <?php endif; ?>
            </a>
            <div class="header-wrapper">
                <div class="top-wrapper">
                    <?php wp_nav_menu(['theme_location' => 'header-top-nav']); ?>

                    <div class="right">
                        <?php if(empty($phone) === false) : ?>
                            <a class="phone" href="tel:<?php echo $phone; ?>">
                                <?php echo $phone; ?>
                            </a>
                        <?php endif; ?>

                        <?php if(empty($email) === false) : ?>
                            <a class="email" href="mailto:<?php echo $email; ?>">
                                Email
                            </a>
                        <?php endif; ?>

<?php if(empty($app_link) === false) : ?>
    <a href="<?php echo $app_link; ?>" target="_blank">
        Log in
    </a>
<?php endif; ?>
                    </div>
                </div>

                <div class="bottom-wrapper">
                    <?php wp_nav_menu(['theme_location' => 'main-nav']); ?>

                    <?php if(empty($buttons) === false) :
                        $class = 'btn-ghost';
                        ?>
<div class="header-buttons">
    <?php foreach ($buttons as $key => $button) :
        if($key === 1) {
            $class = 'btn';
        }
        ?>
        <?php if(empty($button['button']) === false) {
            echo sprintf('<a href="%s" target="%s" class="%s">%s</a>', $button['button']['url'], $button['button']['target'], $class, $button['button']['title']);
        } ?>
    <?php endforeach; ?>
</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<main id="main-content" class="page-content" role="main">
