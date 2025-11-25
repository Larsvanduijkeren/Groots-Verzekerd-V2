<?php
$title = get_field('title');
$text = get_field('text');
$selection = get_field('selection');

$id = get_field('id');

$reviews = [];

if (!empty($selection)) {
    $args = [
        'post_type'      => 'review',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'asc',
        'tax_query'      => [
            [
                'taxonomy' => 'review_category',
                'terms'    => $selection,
                'operator' => 'IN',
            ],
        ],
    ];

    $query = new WP_Query($args);
    $reviews = $query->posts;
}
?>

<section
    class="review-slider"
    id="<?php if (!empty($id)) {
        echo esc_attr($id);
    } ?>"
>
    <div class="container">
        <?php if (!empty($title)) : ?>
            <div class="intro center" data-aos="fade-up">
                <h2><?php echo $title; ?></h2>

                <?php if (!empty($text)) {
                    echo $text;
                } ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($reviews)) : ?>
            <div class="card" data-aos="fade-up">
                <?php
                global $post;

                foreach ($reviews as $review) :
                    $post = $review;
                    setup_postdata($post);

                    $review_title = get_field('title', $post->ID);
                    $review_content = get_field('content', $post->ID);
                    $review_author = get_field('author', $post->ID);
                    $review_author_role = get_field('author_role', $post->ID);
                    $review_image = get_field('image', $post->ID);
                    ?>
                    <div class="single-review">
                        <div class="flex-wrapper">
                            <div class="content">
                                <?php if (empty($review_title) === false) : ?>
                                    <div class="review-title h3"><?php echo $review_title; ?></div>
                                <?php endif; ?>

                                <?php if (empty($review_content) === false) : ?>
                                    <p><?php echo $review_content; ?></p>
                                <?php endif; ?>

                                <?php if (empty($review_author) === false) : ?>
                                    <span class="author"><?php echo $review_author; ?></span>
                                <?php endif; ?>

                                <?php if (empty($review_author_role) === false) : ?>
                                    <span class="author_role"><?php echo $review_author_role; ?></span>
                                <?php endif; ?>
                            </div>

                            <?php if (empty($review_image) === false) : ?>
                                <span class="image">
                                    <img src="<?php echo $review_image['sizes']['large']; ?>"
                                         alt="<?php echo $review_image['alt']; ?>">
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
