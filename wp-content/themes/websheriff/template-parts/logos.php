<?php
$title = get_field('title');
$logos = get_field('logos');

$id = get_field('id');
?>

<section
    class="logos"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <?php if (empty($title) === false) : ?>
            <h2 data-aos="fade-up" class="h4"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if (empty($logos) === false) : ?>
            <div class="logos-slider" data-aos="fade-up">
                <?php foreach ($logos as $logo) : ?>
                    <?php if (empty($logo) === false) : ?>
                        <div class="slide">
                            <span class="image">
                                <img src="<?php echo $logo['sizes']['medium']; ?>" alt="<?php echo $logo['alt']; ?>">
                            </span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
