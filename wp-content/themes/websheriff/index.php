<?php

get_header();

$blog_title = get_field('blog_title', 'option');;
$blog_text = get_field('blog_text', 'option');;

global $wp_query;

// Blog page
if (isset($wp_query) && (bool)$wp_query->is_posts_page) :
    $id = get_option('page_for_posts');
    $label = get_field('blog_label', 'option');
    $title = get_field('blog_title', 'option');
    $text = get_field('blog_text', 'option');

    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'orderby'        => 'post_date',
        'order'          => 'desc',
        'posts_per_page' => 9,
        'paged'          => get_query_var('paged'),
    ];

    $query = new WP_Query($args);
    ?>

    <section class="hero light-blue center">
        <div class="container">
            <div class="flex-wrapper">
                <div class="content">
                    <?php if (empty($blog_title) === false) : ?>
                        <h1><?php echo $blog_title; ?></h1>
                    <?php endif; ?>

                    <?php if (empty($blog_text) === false) {
                        echo $blog_text;
                    } ?>
                </div>
            </div>
        </div>
    </section>

    <section class='blog-archive'>
        <div class='container'>
            <div class='categories' data-aos="fade-up">
                <ul>
                    <li>
                        <a
                            href='<?php echo home_url('/nieuws') ?>'
                            class='btn small active'
                        >
                            Bekijk alles
                        </a>
                    </li>

                    <?php
                    $cat_args = [
                        'exclude'    => [1],
                        'option_all' => 'All',
                        'type'       => 'category',
                    ];

                    $categories = get_categories($cat_args);

                    foreach ($categories as $cat) : ?>
                        <li>
                            <a
                                class="btn small"
                                data-category='<?php echo $cat->term_id ?>'
                                href='<?php echo get_category_link($cat->term_id); ?>'><?php echo $cat->name ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class='post-grid'>
                <?php

                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                        $id = get_the_id();
                        $featured_image = get_the_post_thumbnail_url($post, 'large');
                        $thumbnail_id = get_post_thumbnail_id($post);
                        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        $author_id = $post->post_author;
                        $cat = get_the_terms($id, 'category');
                        ?>

                        <div data-aos="fade-up" class="single-post">
                            <?php if (empty($featured_image) === false) : ?>
                                <span class="image">
                                    <img src="<?php echo $featured_image; ?>"
                                         alt="<?php echo $alt; ?>">
                                </span>
                            <?php endif; ?>

                            <div class="content">
                                <?php if (empty($cat) === false) : ?>
                                    <span class="btn small">
                                        <?php echo $cat[0]->name; ?>
                                    </span>
                                <?php endif; ?>

                                <h3><?php echo get_the_title($id); ?></h3>

                                <div class="time-to-read"><?php echo get_reading_time($post); ?> minuten leestijd</div>

                                <p><?php echo get_the_excerpt(); ?></p>

                                <a href="<?php echo get_the_permalink($id); ?>" class="btn-ghost">Lees verder</a>
                            </div>
                        </div>
                    <?php
                    endwhile; ?>
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
// Normal page
else :
    if (have_posts()) : while (have_posts()) : the_post();
        the_content();
    endwhile;
    endif;
endif;

get_footer();

