<?php
$title = get_field('title');
$text = get_field('text');
$cards = get_field('cards');
$comparison_grid_design = get_field('comparison_grid_design');

$id = get_field('id');
?>

<section
    class="cta-cards <?php if (empty($comparison_grid_design) === false) {
        echo 'comparison-grid-design';
    } ?>"
    id="<?php if (empty($id) === false) {
            echo $id;
        } ?>">
    <div class="container">
        <?php if (empty($title) === false) : ?>
            <div class="intro center" data-aos="fade-up">
                <h2><?php echo $title; ?></h2>

                <?php if (empty($text) === false) : ?>
                    <div class="text">
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($cards) === false) : ?>
            <div class="flex-wrapper">
                <?php foreach ($cards as $card) : ?>
                    <div class="card <?php if (empty($card['add_crosses_to_list_items']) === false) {
                                            echo ' has-crosses';
                                        } if (empty($card['image']) === false) {
                                            echo ' has-image';
                                        } ?>" data-aos="fade-up">
                        
                            <div class="info">
                            <?php if (empty($card['icon']) === false) : ?>
                            <img class="icon" src="<?php echo $card['icon']['sizes']['medium']; ?>"
                                alt="<?php echo $card['icon']['alt']; ?>">
                        <?php endif; ?>
                        <?php if (empty($card['title']) === false) : ?>
                                <h3><?php echo $card['title']; ?></h3>
                                <?php endif; ?>

                                <?php if (empty($card['text']) === false) {
                                    echo $card['text'];
                                } ?>

                                <?php if (empty($card['button']) === false) {
                                    echo sprintf('<a href="%s" target="%s" class="btn">%s</a>', $card['button']['url'], $card['button']['target'], $card['button']['title']);
                                } ?>

                                <?php if (empty($card['meta']) === false) : ?>
                                    <p class="light"><?php echo $card['meta']; ?></p>
                                <?php endif; ?>

                                <?php if (empty($card['rating_text']) === false) : ?>
                                    <p class="rating-text"><?php echo $card['rating_text']; ?></p>
                                <?php endif; ?>
                            </div>

                            <?php if (empty($card['image']) === false) : ?>
                                <img class="person" src="<?php echo $card['image']['sizes']['medium']; ?>"
                                    alt="<?php echo $card['image']['alt']; ?>">
                            <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>