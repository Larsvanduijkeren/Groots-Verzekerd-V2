<?php
$title = get_field('title');
$text = get_field('text');
$values = get_field('values');

$id = get_field('id');
?>

<section
    class="values"
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

        <?php if (empty($values) === false) : ?>
            <div class="flex-wrapper">
                <?php foreach ($values as $value) : ?>
                    <div class="value" data-aos="fade-up">
                        <?php if (empty($value['icon']) === false) : ?>
                            <img class="style-svg" src="<?php echo $value['icon']['sizes']['medium']; ?>"
                                 alt="<?php echo $value['icon']['alt']; ?>">
                        <?php endif; ?>

                        <?php if (empty($value['label']) === false) : ?>
                            <p class="h5"><?php echo $value['label']; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
