<?php

get_header();

$tag = get_queried_object();
$tag_slug = $tag->slug;

$id = get_option('page_for_posts');
$blog_title = get_field('blog_title', 'option');
$blog_text = get_field('blog_text', 'option');
$blog_image = get_field('blog_image', 'option');

$args = [
    'post_type'      => 'post',
    'tag'            => $tag_slug,
    'posts_per_page' => 9,
    'post_status'    => 'publish',
    'orderby'        => 'post_date',
    'order'          => 'desc',
    'paged'          => get_query_var('paged'),
];

$query = new WP_Query($args);
?>

<section
    class="hero small"
    id="<?php echo $id; ?>"
>
    <div class="container">
        <div class="flex-wrapper">
            <div class="content" data-aos="fade-up">
                <h4 class="label"><?php echo $tag->name; ?></h4>
                <?php if (empty($blog_title) === false) : ?>
                    <h1><?php echo $blog_title; ?></h1>
                <?php endif; ?>

                <?php if (empty($blog_text) === false) {
                    echo $blog_text;
                } ?>

                <div class="buttons">
                    <a href="/trainers/academy" class="btn">
                        Back to the academy
                    </a>
                </div>
            </div>

            <?php if (empty($blog_image) === false) : ?>
                <span class="image" data-aos="fade-up">
                        <img src="<?php echo $blog_image['sizes']['large']; ?>" alt="<?php echo $blog_image['alt']; ?>">
                    </span>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class='blog-archive'>
    <div class='container'>
        <div class='categories' data-aos="fade-up">
            <a class="btn" href='<?php echo get_the_permalink(get_option('page_for_posts')); ?>'>
                All posts
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
                    class="btn <?php if ($cat->slug === get_queried_object()->slug) {
                        echo 'active';
                    } ?>"
                    data-category='<?php echo $cat->term_id ?>'
                    href='<?php echo get_category_link($cat->term_id); ?>'><?php echo $cat->name ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class='posts-grid'>
            <?php

            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    $id = get_the_id();
                    $title = get_the_title($id);
                    $thumbnail = get_the_post_thumbnail_url($id, 'large');
                    $thumbnail_id = get_post_thumbnail_id($id);
                    $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    $intro_text = get_field('intro_text', $id);
                    $date = date_i18n('d/m/Y', strtotime(get_post($id)->post_date));
                    $categories = get_the_category($id);
                    ?>

                    <a
                        data-aos="fade-up"
                        class='single-post'
                        href='<?php
                        the_permalink($id);
                        ?>'
                    >
                        <div class='image'>
                            <img src="<?php echo $thumbnail; ?>" alt="<?php echo $alt; ?>">
                        </div>

                        <div class='content'>
                            <?php if (empty($date) === false) : ?>
                                <span class="date">
                                    <?php echo $date; ?>
                                </span>
                            <?php endif; ?>

                            <?php if (empty($categories) === false) : ?>
                                <h4 class="label"><?php echo $categories[0]->name; ?></h4>
                            <?php endif; ?>

                            <?php if (empty($title) === false) : ?>
                                <h4><?php echo $title; ?></h4>
                            <?php endif; ?>

                            <?php if (empty($intro_text) === false) : ?>
                                <p><?php echo gen_string($intro_text, 100); ?></p>
                            <?php endif; ?>

                            <span class="btn-text">
                                    Read more
                                </span>
                        </div>
                    </a>
                <?php
                endwhile;
                wp_reset_postdata(); ?>
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

                <?php
                wp_reset_postdata();
            endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

