<?php
$title = get_field('title');
$text = get_field('text');
$button = get_field('button');

$phone = get_field('phone', 'option');
$email = get_field('email', 'option');

$id = get_field('id');
?>

<section
    class="cta"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <div class="flex-wrapper">
            <div class="content" data-aos="fade-up">
                <?php if (empty($title) === false) : ?>
                    <h2><?php echo $title; ?></h2>
                <?php endif; ?>

                <?php if (empty($text) === false) {
                    echo $text;
                } ?>
            </div>

            <div class="button-wrap" data-aos="fade-up">
                <?php if(empty($button) === false) {
                    echo sprintf('<a href="%s" target="%s" class="btn">%s</a>', $button['url'], $button['target'], $button['title']);
                } ?>

                <?php if (empty($phone) === false) : ?>
                    <a class="phone" href="tel:<?php echo $phone; ?>">
                        <?php echo $phone; ?>
                    </a>
                <?php endif; ?>

                <?php if (empty($email) === false) : ?>
                    <a class="email" href="mailto:<?php echo $email; ?>">
                        <?php echo $email; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
