<?php
$title = get_field('title');
$text = get_field('text');
$buttons = get_field('buttons');
$meta = get_field('meta');
$image = get_field('image');
$image_label = get_field('image_label');
$rating_text = get_field('rating_text', 'option');

$id = get_field('id');
?>

<section
    class="home-hero light-blue"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <div class="flex-wrapper">
            <div class="content">
                <?php if (empty($title) === false) : ?>
                    <h1><?php echo $title; ?></h1>
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

                <?php if (empty($meta) === false) : ?>
                    <p class="light"><?php echo $meta; ?></p>
                <?php endif; ?>
            </div>

            <?php if (empty($image) === false) : ?>
                <span class="image">
                    <?php if (empty($image_label) === false) : ?>
                        <span class="image-label"><?php echo $image_label; ?></span>
                    <?php endif; ?>

                    <?php if (empty($rating_text) === false) : ?>
                        <span class="rating-text"><?php echo $rating_text; ?></span>
                    <?php endif; ?>

                    <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">

                    <svg height="0" width="0">
                        <defs>
                            <clipPath id="imageCloverClip" clipPathUnits="objectBoundingBox">
                                <path id="Path_5329" data-name="Path 5329"
                                      d="M0.731,0.136 L0.752,0.257 C0.76,0.301,0.785,0.341,0.823,0.366 L0.926,0.433 C1,0.514,1,0.706,0.864,0.731 L0.743,0.752 C0.699,0.76,0.659,0.785,0.634,0.823 L0.567,0.926 C0.486,1,0.294,1,0.269,0.864 L0.248,0.743 C0.24,0.699,0.215,0.659,0.177,0.634 L0.074,0.567 C-0.05,0.486,-0.01,0.294,0.136,0.269 L0.257,0.248 C0.301,0.24,0.341,0.215,0.366,0.177 L0.433,0.074 C0.514,-0.05,0.706,-0.01,0.731,0.136 L0.731,0.136"
                                      fill="none" stroke="#e02c39" stroke-width="3"/>
                            </clipPath>
                        </defs>
                    </svg>
                </span>
            <?php endif; ?>
        </div>
    </div>
</section>
