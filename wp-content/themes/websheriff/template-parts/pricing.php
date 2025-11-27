<?php
$title = get_field('title');
$text = get_field('text');
$plans = get_field('plans');
$button = get_field('button');
$meta = get_field('meta');

$id = get_field('id');
?>

<section
    class="pricing"
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
            </div>
        <?php endif; ?>

        <?php if (empty($plans) === false) : ?>
            <div class="flex-wrapper">
                <?php foreach ($plans as $plan) : ?>
                    <div class="plan" data-aos="fade-up">
                        <?php if (empty($plan['icon']) === false) : ?>
                            <img class="style-svg" src="<?php echo $plan['icon']['sizes']['medium']; ?>"
                                 alt="<?php echo $plan['icon']['alt']; ?>">
                        <?php endif; ?>

                        <?php if (empty($plan['title']) === false) : ?>
                            <h3><?php echo $plan['title']; ?></h3>
                        <?php endif; ?>

                        <?php if (empty($plan['pricing']) === false) : ?>
                            <p class="price"><?php echo $plan['pricing']; ?></p>
                        <?php endif; ?>

                        <?php if (empty($plan['text']) === false) {
                            echo $plan['text'];
                        } ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($button) === false) : ?>
            <div class="extra" data-aos="fade-up">
                <?php if (empty($button) === false) {
                    echo sprintf('<a href="%s" target="%s" class="btn">%s</a>', $button['url'], $button['target'], $button['title']);
                } ?>

                <?php if (empty($meta) === false) : ?>
                    <p class="light"><?php echo $meta; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
