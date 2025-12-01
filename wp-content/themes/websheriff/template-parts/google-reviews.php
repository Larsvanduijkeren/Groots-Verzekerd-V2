<?php
$title = get_field('title');
$review_cards = get_field('review_cards');
$google_reviews_shortcode = get_field('google_reviews_shortcode');

$id = get_field('id');
?>

<section
    class="google-reviews"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <div class="card" data-aos="fade-up">
            <div class="top-wrap">
                <div class="content">
                    <?php if (empty($title) === false) : ?>
                        <h2 class="h3"><?php echo $title; ?></h2>
                    <?php endif; ?>
                </div>

                <?php if (empty($review_cards) === false) : ?>
                    <?php foreach ($review_cards as $card) : ?>
                        <div class="review-card">
                            <?php if (empty($card['logo']) === false) : ?>
                                <img src="<?php echo $card['logo']['sizes']['medium']; ?>"
                                     alt="<?php echo $card['logo']['alt']; ?>">
                            <?php endif; ?>

                            <?php if (empty($card['text']) === false) : ?>
                                <p><?php echo $card['text']; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if (empty($google_reviews_shortcode) === false) {
                echo do_shortcode($google_reviews_shortcode);
            } ?>
        </div>
    </div>
</section>
