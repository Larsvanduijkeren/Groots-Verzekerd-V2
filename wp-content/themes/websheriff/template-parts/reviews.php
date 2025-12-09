<?php
$title = get_field('title');
$text = get_field('text');
$buttons = get_field('buttons');
$reviews_title = get_field('reviews_title');
$reviews_button = get_field('reviews_button');
$reviews_taxonomy = get_field('reviews_taxonomy');

$reviews_score = get_field('reviews_score');
$reviews_logo = get_field('reviews_logo');

$id = get_field('id');


$reviews = [];

if (!empty($reviews_taxonomy)) {
    $args = [
        'post_type'      => 'review',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'asc',
        'tax_query'      => [
            [
                'taxonomy' => 'review_category',
                'terms'    => $reviews_taxonomy,
                'operator' => 'IN',
            ],
        ],
    ];

    $query = new WP_Query($args);
    $reviews = $query->posts;
}

?>

<section
    class="reviews light-blue"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <?php if (empty($title) === false) : ?>
            <div class="intro center" data-aos="fade-up">
                <h2><?php echo $title; ?></h2>

                <?php if (empty($text) === false) {
                    echo $text;
                } ?>

                <?php if (empty($buttons) === false) : ?>
                    <div class="buttons">
                        <?php foreach ($buttons as $key => $button) :
                            $class = 'dark-blue';

                            if ($key === 1) {
                                $class = '';
                            }

                            if (empty($button['button']) === false) {
                                echo sprintf('<a href="%s" target="%s" class="btn %s">%s</a>', $button['button']['url'], $button['button']['target'], $class, $button['button']['title']);
                            } ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($reviews) === false) : ?>
            <div class="reviews-wrapper" data-aos="fade-up">
                <?php foreach ($reviews as $key => $review) :
                    $score = get_field('score', $review);
                    $text = get_field('content', $review);
                    $author = get_field('author', $review);

                    if ($key === 1) : ?>
                        <div class="review-cta">
                            <?php if (empty($reviews_score) === false) : ?>
                                <div class="reviews-score">
                                    <span class="score">
                                        <?php echo $reviews_score; ?>
                                    </span>

                                    <?php if (empty($reviews_logo) === false) : ?>
                                        <span class="logo">
                                            <img
                                                src="<?php echo $reviews_logo['sizes']['large']; ?>"
                                                alt="<?php echo $reviews_logo['alt']; ?>"
                                            >
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (empty($reviews_title) === false) : ?>
                                <h3><?php echo $reviews_title; ?></h3>
                            <?php endif; ?>

                            <?php if (empty($reviews_button) === false) {
                                echo sprintf('<a href="%s" target="%s" class="btn-ghost">%s</a>', $reviews_button['url'], $reviews_button['target'], $reviews_button['title']);
                            } ?>
                        </div>
                    <?php endif; ?>
                    <div class="review-wrap">
                        <div class="review">
                            <div class="rating">
                                <?php for ($i = 0; $i < $score; $i++) : ?>
                                    <span class="star"></span>
                                <?php endfor; ?>
                            </div>

                            <?php if (empty($text) === false) : ?>
                                <p><?php echo $text; ?></p>
                            <?php endif; ?>

                            <?php if (empty($author) === false) : ?>
                                <span class="author"><?php echo $author; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
