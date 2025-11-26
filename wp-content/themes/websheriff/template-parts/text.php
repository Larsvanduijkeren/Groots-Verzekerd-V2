<?php
$alignment = get_field('alignment');
$background = get_field('background');
$title = get_field('title');
$text = get_field('text');
$buttons = get_field('buttons');

$id = get_field('id');
?>

<section
    class="text <?php echo $alignment . ' ' . $background; ?>"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <div class="content">
            <?php if (empty($title) === false) : ?>
                <h2><?php echo $title; ?></h2>
            <?php endif; ?>

            <?php if (empty($text) === false) {
                echo $text;
            } ?>

            <?php if (empty($buttons) === false) :
                $class = 'btn';
                ?>
                <div class="buttons <?php echo $alignment; ?>">
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
    </div>
</section>
