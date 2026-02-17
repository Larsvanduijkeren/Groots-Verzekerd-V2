<?php
function add_gutenberg_category($categories, $post)
{
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'websheriff',
                'title' => __('Websheriff custom Blocks', 'websheriff'),
            ],
        ]
    );
}

add_filter('block_categories_all', 'add_gutenberg_category', 10, 2);

// Register ACF field blocks
add_action('acf/init', function () {
    if (function_exists('acf_register_block')) {

        $blocks = [
            'hero'                => 'Hero',
            'home-hero'           => 'Home Hero',
            'cta-cards'           => 'CTA Cards',
            'logos'               => 'Logos',
            'steps'               => 'Steps',
            'review-slider'       => 'Review Slider',
            'values'              => 'Values',
            'team-selection'      => 'Team Selection',
            'post-selection'      => 'Post Selection',
            'reviews'      => 'Reviews',
            'insurance-selection' => 'Insurance Selection',
            'text'                => 'Text',
            'text-image'          => 'Text Image',
            'timeline'            => 'Timeline',
            'cta'                 => 'CTA',
            'documents'           => 'Documents',
            'contact-cards'       => 'Contact Cards',
            'form'                => 'Form',
            'emergency-contacts'  => 'Emergency Contacts',
            'faq'                 => 'FAQ',
            'text-cards'          => 'Text Cards',
            'vacancy-selection'   => 'Vacancy Selection',
            'pricing'             => 'Pricing',
            'match-form'          => 'Match Form',
        ];

        foreach ($blocks as $name => $title) {
            acf_register_block([
                'name'            => $name,
                'mode'            => 'auto',
                'title'           => __($title),
                'render_callback' => 'render_callback',
                'category'        => 'websheriff',
                'icon'            => 'editor-code',
                'supports'        => [
                    'align' => 'left',
                ],
            ]);
        }
    }
});

// Acf fieldblock render callback
function render_callback($block)
{
// convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);
// include a template part from within the "template-parts/block" folder
    locate_template("template-parts/{$slug}.php", true, false);
}

// Set allowed blocks
add_filter('allowed_block_types_all', function ($block_types, $post) {
    $blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
    $output = [];

    if ($post->post->post_type === 'post' || $post->post->post_type === 'job') {
        foreach ($blocks as $block) {
            $allowed_blocks = [
                'core/paragraph',
                'core/heading',
                'core/list',
                'core/list-item',
                'core/image',
                'acf/cta-links',
            ];

            if (in_array($block->name, $allowed_blocks)) {
                $output[] = $block->name;
            }
        };
    } else {
        foreach ($blocks as $block) {
            if (substr($block->name, 0, 3) === 'acf') {
                $output[] = $block->name;
            }
        };
    }

    return $output;
}, 10, 2);
