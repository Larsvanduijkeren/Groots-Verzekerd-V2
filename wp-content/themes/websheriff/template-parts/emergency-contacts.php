<?php
$title = get_field('title');
$text = get_field('text');
$cards = get_field('cards');

$id = get_field('id');
?>

<section
    class="emergency-contacts"
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
                            <h3 class="h5"><?php echo $card['title']; ?></h3>
                        <?php endif; ?>

<?php if(empty($card['phone']) === false) : ?>
    <a href="tel:<?php echo $card['phone']; ?>">
        <?php echo $card['phone']; ?>
    </a>
<?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
