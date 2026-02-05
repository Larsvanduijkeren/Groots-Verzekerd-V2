<?php
include 'includes/acf-content-blocks.php';
include 'includes/post-types.php';
include 'includes/taxonomies.php';

/**
 * Index status in admin bar
 */
add_action('admin_bar_menu', function ($bar) {
    if (!current_user_can('manage_options')) return;
    
    $noindex = get_option('blog_public') == '0';
    
    $bar->add_node([
        'id'    => 'index-status',
        'title' => sprintf(
            '<span style="background:%s;color:#fff;padding:2px 7px;border-radius:4px;font-size:11px;font-weight:600;">%s</span>',
            $noindex ? '#dc3232' : '#46b450',
            $noindex ? 'No index' : 'Index'
        ),
    ]);
}, 100);

// ACF options page
add_action('init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page();
    }
});

// Add custom image sizes
add_theme_support('post-thumbnails');
add_image_size('full', 2000, 2000, false);

function remove_extra_image_sizes()
{
    foreach (get_intermediate_image_sizes() as $size) {
        if (!in_array($size, ['thumbnail', 'medium', 'large', 'full'])) {
            remove_image_size($size);
        }
    }
}

add_action('init', 'remove_extra_image_sizes');

function get_reading_time($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $minutes = ceil($word_count / 200); // Round up
    return $minutes;
}

add_filter('the_content', 'disable_specific_shortcodes_in_gutenberg', 1);

function disable_specific_shortcodes_in_gutenberg($content)
{
    if (is_admin()) {
        remove_shortcode('wpforms');
    }

    return $content;
}

// Make sure all content is pasted as text
add_filter('tiny_mce_before_init', 'ag_tinymce_paste_as_text');
function ag_tinymce_paste_as_text($init)
{
    $init['paste_as_text'] = true;
    return $init;
}

function enqueue_theme_assets()
{
    $theme_version = wp_get_theme()->get('Version');
    $theme_uri = get_stylesheet_directory_uri();
    $vendor_uri = $theme_uri . '/min/vendor/';
    $min_uri = $theme_uri . '/min/';

    // === STYLES ===
    wp_enqueue_style('theme-main', $min_uri . 'main.css', [], $theme_version, 'all');

    // === SCRIPTS ===
    wp_enqueue_script('jquery'); // Ensure jQuery is available

    wp_enqueue_script('jquery-ui', $vendor_uri . 'jquery-ui.min.js', ['jquery'], null, true);
    wp_enqueue_script('aos', $vendor_uri . 'aos.min.js', [], null, true);
    wp_enqueue_script('lity', $vendor_uri . 'lity.js', [], null, true);
    wp_enqueue_script('slick', $vendor_uri . 'slick.min.js', [], null, true);
    wp_enqueue_script('lenis', $vendor_uri . 'lenis.js', [], null, true);
    wp_enqueue_script('theme-main', $min_uri . 'main.js', [], $theme_version, true);
}

add_action('wp_enqueue_scripts', 'enqueue_theme_assets', 99);

function custom_change_posts_icon()
{
    global $menu;

    foreach ($menu as $key => $item) {
        if ($item[2] === 'edit.php') { // 'edit.php' is the Posts menu slug
            $menu[$key][6] = 'dashicons-image-filter'; // Replace with your desired Dashicon class
            break;
        }
    }
}

add_action('admin_menu', 'custom_change_posts_icon');

function custom_change_media_menu_position()
{
    global $menu;
    $media_menu = null;

    // Find and remove the Media menu
    foreach ($menu as $key => $item) {
        if ($item[2] === 'upload.php') {
            $media_menu = $item;
            unset($menu[$key]);
            break;
        }
    }

    // Reinsert it at a new position (e.g., position 25)
    if ($media_menu) {
        $menu[25] = $media_menu; // Adjust number as needed
        ksort($menu);
    }
}

add_action('admin_menu', 'custom_change_media_menu_position', 999);

function registerMenu()
{
    register_nav_menu('header-top-nav', __('Header Top Nav'));
    register_nav_menu('main-nav', __('Main Nav'));
    register_nav_menu('footer-nav', __('Footer Nav'));
}

add_action('init', 'registerMenu');

// Remove comment support
add_action('admin_menu', 'my_remove_admin_menus');
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}

add_action('init', 'remove_comment_support', 100);

function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}

function mytheme_admin_bar_render()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}

add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

// Styles for gutenberg editor
function custom_gutenberg_assets()
{
    // Enqueue block editor JS
    wp_enqueue_style(
        'custom-gutenberg-stylesheet',
        get_template_directory_uri() . '/min/gutenberg.css',
        [],
        wp_get_theme()->get('Version'), 'all');
}

add_action('enqueue_block_editor_assets', 'custom_gutenberg_assets');

// Move Yoast to bottom
function yoasttobottom()
{
    return 'low';
}

add_filter('wpseo_metabox_prio', 'yoasttobottom');

// Disable notification emails
add_filter('auto_theme_update_send_email', '__return_false');
add_filter('auto_core_update_send_email', '__return_false');
add_filter('auto_plugin_update_send_email', '__return_false');

// Permission for editor edit menus
$role_object = get_role('editor');
$role_object->add_cap('edit_theme_options');

// Shorten strings like post summary
function gen_string($string, $max = 20)
{
    $tok = strtok($string, ' ');
    $sub = '';
    while ($tok !== false && mb_strlen($sub) < $max) {
        if (strlen($sub) + mb_strlen($tok) <= $max) {
            $sub .= $tok . ' ';
        } else {
            break;
        }
        $tok = strtok(' ');
    }
    $sub = trim($sub);
    if (mb_strlen($sub) < mb_strlen($string)) $sub .= '&hellip;';
    return $sub;
}

// Set excerpt length
function my_excerpt_length($length)
{
    return 20;
}

add_filter('excerpt_length', 'my_excerpt_length');
