<?php
$title = get_field('title');
$text = get_field('text');
$cards = get_field('cards');

$id = get_field('id');
?>

<section
    class="contact-cards"
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

        <?php if (empty($cards) === false) : ?>
            <div class="flex-wrapper">
                <?php foreach ($cards as $card) : ?>
                    <div class="card" data-aos="fade-up">
                        <?php if (empty($card['icon']) === false) : ?>
                            <img class="style-svg" src="<?php echo $card['icon']['sizes']['medium']; ?>"
                                 alt="<?php echo $card['icon']['alt']; ?>">
                        <?php endif; ?>

                        <?php if (empty($card['title']) === false) : ?>
                            <h3><?php echo $card['title']; ?></h3>
                        <?php endif; ?>

                        <?php if (empty($card['text']) === false) {
                            echo $card['text'];
                        } ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
