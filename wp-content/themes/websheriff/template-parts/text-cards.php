<?php
$order = get_field('order');
$label = get_field('label');
$title = get_field('title');
$text = get_field('text');
$buttons = get_field('buttons');
$cards = get_field('cards');

$id = get_field('id');
?>

<section
    class="text-cards <?php echo $order; ?>"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <div class="flex-wrapper">
            <div class="content" data-aos="fade-up">
                <?php if (empty($label) === false) : ?>
                    <span class="text-label"><?php echo $label; ?></span>
                <?php endif; ?>

                <?php if (empty($title) === false) : ?>
                    <h2><?php echo $title; ?></h2>
                <?php endif; ?>

                <?php if (empty($text) === false) {
                    echo $text;
                } ?>

                <?php if (empty($buttons) === false) :
                    $class = 'btn';
                    ?>
                    <div class="buttons">
                        <?php foreach ($buttons as $key => $button) :
                            if ($key === 1) {
                                $class = 'btn-ghost';
                            }
                            ?>
                            <?php if (empty($button['button']) === false) {
                            echo sprintf('<a href="%s" target="%s" class="%s">%s</a>', $button['button']['url'], $button['button']['target'], $class, $button['button']['title']);
                        } ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (empty($cards) === false) : ?>
                <div class="cards" data-aos="fade-up">
                    <div class="cards-wrapper">
                        <?php foreach ($cards as $card) : ?>
                            <div class="card">
                                <?php if (empty($card['icon']) === false) : ?>
                                    <img class="style-svg" src="<?php echo $card['icon']['sizes']['medium']; ?>"
                                         alt="<?php echo $card['icon']['alt']; ?>">
                                <?php endif; ?>

                                <?php if (empty($card['text']) === false) {
                                    echo $card['text'];
                                } ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
