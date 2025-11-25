<?php
$title = get_field('title');
$cards = get_field('cards');
$rating_text = get_field('rating_text', 'option');

$id = get_field('id');
?>

<section
    class="steps blue"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <?php if (empty($title) === false) : ?>
            <div class="intro center" data-aos="fade-up">
                <h2><?php echo $title; ?></h2>

                <?php if (empty($rating_text) === false) : ?>
                    <span class="rating-text"><?php echo $rating_text; ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($cards) === false) : ?>
            <div class="flex-wrapper">
                <?php foreach ($cards as $card) : ?>
                    <div class="card" data-aos="fade-up">
                        <?php if (empty($card['icon']) === false) : ?>
                            <img src="<?php echo $card['icon']['sizes']['medium']; ?>"
                                 alt="<?php echo $card['icon']['alt']; ?>">
                        <?php endif; ?>

                        <?php if (empty($card['title']) === false) : ?>
                            <h3 class="h4"><?php echo $card['title']; ?></h3>
                        <?php endif; ?>

                        <?php if (empty($card['text']) === false) {
                            echo $card['text'];
                        } ?>

                        <?php if (empty($card['button']) === false) {
                            echo sprintf('<a href="%s" target="%s" class="btn">%s</a>', $card['button']['url'], $card['button']['target'], $card['button']['title']);
                        } ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
