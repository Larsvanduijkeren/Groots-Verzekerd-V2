<?php
$style = get_field('style');
$title = get_field('title');
$text = get_field('text');
$include_rating = get_field('include_rating');
$add_contact_person = get_field('add_contact_person');
$contact_cards = get_field('contact_cards');
$contact_image = get_field('contact_image');
$contact_name = get_field('contact_name');
$contact_text = get_field('contact_text');
$buttons = get_field('buttons');
$form_title = get_field('form_title');
$form_text = get_field('form_text');
$form_shortcode = get_field('form_shortcode');
$form_meta = get_field('form_meta');
$rating_text = get_field('rating_text', 'option');

$id = get_field('id');
?>

<section
    class="form <?php echo $style; ?>"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <div class="card">
            <div class="flex-wrapper">
                <div class="content" data-aos="fade-up">
                    <?php if (empty($title) === false) : ?>
                        <h2 class="h1"><?php echo $title; ?></h2>
                    <?php endif; ?>

                    <?php if (empty($text) === false) {
                        echo $text;
                    } ?>

                    <?php if (empty($contact_cards) === false) : ?>
                        <?php foreach ($contact_cards as $card) : ?>
                            <div class="contact-card">
                                <div class="title-wrap">
                                    <?php if (empty($card['icon']) === false) : ?>
                                        <img class="style-svg" src="<?php echo $card['icon']['sizes']['medium']; ?>"
                                             alt="<?php echo $card['icon']['alt']; ?>">
                                    <?php endif; ?>

                                    <?php if (empty($card['title']) === false) : ?>
                                        <h4><?php echo $card['title']; ?></h4>
                                    <?php endif; ?>
                                </div>

                                <?php if (empty($card['text']) === false) {
                                    echo $card['text'];
                                } ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if ($include_rating) : ?>
                        <p class="rating-text">
                            <?php echo $rating_text; ?>
                        </p>
                    <?php endif; ?>

                    <?php if (empty($add_contact_person) === false) : ?>
                        <div class="contact">
                            <?php if (empty($contact_image) === false) : ?>
                                <img src="<?php echo $contact_image['sizes']['medium']; ?>"
                                     alt="<?php echo $contact_image['alt']; ?>">

                                <div class="info">
                                    <?php if (empty($contact_name) === false) : ?>
                                        <strong><?php echo $contact_name; ?></strong>
                                    <?php endif; ?>

                                    <?php if (empty($contact_text) === false) : ?>
                                        <p><?php echo $contact_text; ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

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

                <div class="form" data-aos="fade-up">
                    <?php if (empty($form_title) === false) : ?>
                        <h3><?php echo $form_title; ?></h3>
                    <?php endif; ?>

                    <?php if (empty($form_text) === false) {
                        echo $form_text;
                    } ?>

                    <?php if (!is_admin() && empty($form_shortcode) === false) {
                        echo do_shortcode($form_shortcode);
                    } ?>

                    <?php if (empty($form_meta) === false) : ?>
                        <p class="light"><?php echo $form_meta; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
