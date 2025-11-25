<?php
$cards = get_field('cards');

$id = get_field('id');
?>

<section
    class="cta-cards"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <?php if (empty($cards) === false) : ?>
            <div class="flex-wrapper">
                <?php foreach ($cards as $card) : ?>
                    <div class="card" data-aos="fade-up">
                        <?php if (empty($card['title']) === false) : ?>
                            <h3><?php echo $card['title']; ?></h3>

                            <?php if (empty($card['text']) === false) {
                                echo $card['text'];
                            } ?>

                            <?php if (empty($card['button']) === false) {
                                echo sprintf('<a href="%s" target="%s" class="btn">%s</a>', $card['button']['url'], $card['button']['target'], $card['button']['title']);
                            } ?>

                            <?php if (empty($card['meta']) === false) : ?>
                                <p class="light"><?php echo $card['meta']; ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
