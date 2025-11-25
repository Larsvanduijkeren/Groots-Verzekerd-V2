<?php

get_header();

global $wp_query;

$blog_title = get_field('blog_title', 'option');
$blog_text = get_field('blog_text', 'option');
$blog_card_text = get_field('blog_card_text', 'option');

// Blog page
if (isset($wp_query) && (bool)$wp_query->is_posts_page) :
    $id = get_option('page_for_posts');

    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'orderby'        => 'post_date',
        'order'          => 'desc',
        'posts_per_page' => 12,
        'paged'          => get_query_var('paged'),
    ];

    $query = new WP_Query($args);
    ?>

    <section class="simple-hero blue">
        <div class="container">
            <div class="flex-wrapper">
                <div class="content" data-aos="fade-up">
                    <?php if (empty($blog_title) === false) : ?>
                        <h1><?php echo $blog_title; ?></h1>
                    <?php endif; ?>

                    <?php if (empty($blog_text) === false) {
                        echo $blog_text;
                    } ?>


                    <div class="categories">
                        <a
                            href='<?php echo get_permalink(get_option('page_for_posts')) ?>'
                            class='btn white'
                        >
                            Alles
                        </a>

                        <?php
                        $cat_args = [
                            'exclude'    => [1],
                            'option_all' => 'All',
                            'type'       => 'category',
                        ];

                        $categories = get_categories($cat_args);

                        foreach ($categories as $cat) : ?>
                            <a
                                class="btn-ghost white"
                                data-category='<?php echo $cat->term_id ?>'
                                href='<?php echo get_category_link($cat->term_id); ?>'><?php echo $cat->name ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (empty($blog_card_text) === false) : ?>
                    <div class="card" data-aos="fade-up">
                        <?php echo $blog_card_text; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class='blog-archive'>
        <div class='container'>
            <div class='post-grid'>
                <?php

                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                        $id = get_the_id();
                        $featured_image = get_the_post_thumbnail_url($id, 'large');
                        $thumbnail_id = get_post_thumbnail_id($id);
                        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        $author_id = get_post_field('post_author', $id);
                        $cat = get_the_terms($id, 'category');
                        ?>

                        <a data-aos="fade-up" href="<?php echo get_the_permalink($id); ?>" class="single-post">
                            <?php if (empty($featured_image) === false) : ?>
                                <span class="image">
                                    <img src="<?php echo $featured_image; ?>"
                                         alt="<?php echo $alt; ?>">
                                </span>
                            <?php endif; ?>

                            <div class="content">
                                <h3><?php echo get_the_title($id); ?></h3>

                                <?php the_excerpt(); ?>

                                <span class="author">
                                    <?php echo get_avatar($author_id, 60); ?>

                                    <?php echo get_the_author_meta('display_name', $author_id); ?>
                                </span>

                                <div class="wrap">
                                    <span class="btn blue">Lees verder</span>

                                    <?php if (empty($cat) === false) : ?>
                                        <span class="cat btn beige small">
                                            <?php echo $cat[0]->name; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>

                    <?php endwhile; ?>
                    <div class="pagination" data-aos="fade-up">
                        <?php
                        echo paginate_links([
                            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total'        => $query->max_num_pages,
                            'current'      => max(1, get_query_var('paged')),
                            'format'       => '?paged=%#%',
                            'show_all'     => false,
                            'type'         => 'plain',
                            'end_size'     => 2,
                            'mid_size'     => 1,
                            'prev_next'    => false,
                            'prev_text'    => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                            'next_text'    => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                            'add_args'     => false,
                            'add_fragment' => '',
                        ]);
                        ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php

    $post = get_post(get_option('page_for_posts'));
    $content = apply_filters('the_content', $post->post_content);
    echo $content;

// Normal page
else :
    if (have_posts()) : while (have_posts()) : the_post();
        the_content();
    endwhile;
    endif;
endif;

get_footer();

