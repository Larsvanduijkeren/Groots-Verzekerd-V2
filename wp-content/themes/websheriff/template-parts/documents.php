<?php
$title = get_field('title');
$text = get_field('text');
$cards = get_field('cards');

$id = get_field('id');
?>

<section
    class="documents"
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
                        <?php if (empty($card['title']) === false) : ?>
                            <h3><?php echo $card['title']; ?></h3>
                        <?php endif; ?>

                        <?php if (empty($card['text']) === false) {
                            echo $card['text'];
                        } ?>

                        <?php if (empty($card['download_buttons']) === false) :
                            ?>
                            <div class="buttons">
                                <?php foreach ($card['download_buttons'] as $button) :
                                    ?>
                                    <?php if (empty($button['button']) === false) {
                                    echo sprintf('<a href="%s" target="%s" class="btn-ghost download">%s</a>', $button['button']['url'], $button['button']['target'], $button['button']['title']);
                                } ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (empty($card['extra_button']) === false) {
                            echo sprintf('<a href="%s" target="%s" class="btn-ghost link">%s</a>', $card['extra_button']['url'], $card['extra_button']['target'], $card['extra_button']['title']);
                        } ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
