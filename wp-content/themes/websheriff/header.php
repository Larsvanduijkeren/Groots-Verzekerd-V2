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
$mega_menus = get_field('mega_menus', 'option');
$usps = get_field('usps', 'option');
$short_rating_text = get_field('short_rating_text', 'option');

?>

<span class="hamburger">
    <span class="line line-1"></span>
    <span class="line line-2"></span>
</span>

<div class='mobile-nav'>
    <div class='content'>
        <div class='nav'>
            <div class='flex-wrapper'>
                <?php wp_nav_menu(['theme_location' => 'header-nav']); ?>
            </div>

            <?php if (empty($buttons) === false) :
                $class = 'btn-ghost';
                ?>
                <div class="header-buttons">
                    <?php foreach ($buttons as $key => $button) :
                        if ($key === 1) {
                            $class = 'btn';
                        }
                        ?>
                        <?php if (empty($button['button']) === false) {
                        echo sprintf('<a href="%s" target="%s" class="%s">%s</a>', $button['button']['url'], $button['button']['target'], $class, $button['button']['title']);
                    } ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="top-bar">
    <div class="container">
        <div class="flex-wrapper">
            <?php if (empty($usps) === false) : ?>
                <div class="usps">
                    <?php foreach ($usps as $usp) : ?>
                        <?php if (empty($usp['usp']) === false) : ?>
                            <div class="usp"><?php echo $usp['usp']; ?></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="rating-text">
                <?php if (empty($short_rating_text) === false) {
                    echo $short_rating_text;
                } ?>
            </div>
        </div>
    </div>
</div>

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
                        <?php if (empty($phone) === false) : ?>
                            <a class="phone" href="tel:<?php echo $phone; ?>">
                                <?php echo $phone; ?>
                            </a>
                        <?php endif; ?>

                        <?php if (empty($email) === false) : ?>
                            <a class="email" href="mailto:<?php echo $email; ?>">
                                Email
                            </a>
                        <?php endif; ?>

                        <?php if (empty($app_link) === false) : ?>
                            <a class="log-in" href="<?php echo $app_link; ?>" target="_blank">
                                Log in
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bottom-wrapper">
                    <?php wp_nav_menu(['theme_location' => 'main-nav']); ?>

                    <?php if (empty($buttons) === false) :
                        $class = 'btn-ghost';
                        ?>
                        <div class="header-buttons">
                            <?php foreach ($buttons as $key => $button) :
                                if ($key === 1) {
                                    $class = 'btn';
                                }
                                ?>
                                <?php if (empty($button['button']) === false) {
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

<?php if (empty($mega_menus) === false) : ?>
    <?php foreach ($mega_menus as $menu) : ?>
        <?php if (empty($menu['trigger_class']) === false) : ?>
            <div class="mega-menu" data-trigger="<?php echo $menu['trigger_class']; ?>">
                <span class="overlay"></span>

                <div class="menu-wrap">
                    <div class="container">
                        <?php if (empty($menu['title']) === false) : ?>
                            <div class="go-back"><?php echo $menu['title']; ?></div>
                        <?php endif; ?>

                        <div class="content-wrapper">
                            <?php if (empty($menu['content_columns']) === false) : ?>
                                <?php foreach ($menu['content_columns'] as $column) : ?>
                                    <div class="column <?php echo $column['style']; ?>">
                                        <?php if ($column['style'] === 'menu') : ?>
                                            <?php if (empty($column['menu_link']) === false) {
                                                echo sprintf('<a href="%s" target="%s" class="h4">%s</a>', $column['menu_link']['url'], $column['menu_link']['target'], $column['menu_link']['title']);
                                            } ?>

                                            <?php if (empty($column['menu']) === false) : ?>
                                                <div class="column-menu">
                                                    <?php foreach ($column['menu'] as $menu_item) : ?>
                                                        <div class="menu-item">
                                                            <?php if (empty($menu_item['image']) === false) : ?>
                                                                <img
                                                                    src="<?php echo $menu_item['image']['sizes']['medium']; ?>"
                                                                    alt="<?php echo $menu_item['image']['alt']; ?>">
                                                            <?php endif; ?>

                                                            <div class="menu-item-info">
                                                                <?php if (empty($menu_item['link']) === false) {
                                                                    echo sprintf('<a href="%s" target="%s">%s</a>', $menu_item['link']['url'], $menu_item['link']['target'], $menu_item['link']['title']);
                                                                } ?>

                                                                <?php if (empty($menu_item['description']) === false) : ?>
                                                                    <p><?php echo $menu_item['description']; ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($column['style'] === 'card') : ?>
                                            <div class="card">
                                                <?php if (empty($column['card_image']) === false) : ?>
                                                    <span class="image">
                                                        <img
                                                            src="<?php echo $column['card_image']['sizes']['large']; ?>"
                                                            alt="<?php echo $column['card_image']['alt']; ?>">
                                                    </span>

                                                    <?php if (empty($column['card_title']) === false) : ?>
                                                        <div
                                                            class="h4"><?php echo $column['card_title']; ?></div>
                                                    <?php endif; ?>

                                                    <?php if (empty($column['card_text']) === false) {
                                                        echo $column['card_text'];
                                                    } ?>

                                                    <?php if (empty($column['card_link']) === false) {
                                                        echo sprintf('<a href="%s" target="%s" class="btn">%s</a>', $column['card_link']['url'], $column['card_link']['target'], $column['card_link']['title']);
                                                    } ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<main id="main-content" class="page-content" role="main">
