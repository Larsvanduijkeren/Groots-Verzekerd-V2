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
                                      d="m0.734,0.139 l0.021,0.121 c0.008,0.045,0.034,0.084,0.072,0.109 l0.103,0.067 c0.124,0.081,0.084,0.273,-0.062,0.298 l-0.121,0.021 c-0.045,0.008,-0.084,0.034,-0.109,0.072 l-0.067,0.103 c-0.081,0.124,-0.273,0.084,-0.298,-0.062 l-0.021,-0.121 c-0.008,-0.045,-0.034,-0.084,-0.072,-0.109 l-0.103,-0.067 C-0.047,0.488,-0.008,0.297,0.139,0.272 l0.121,-0.021 c0.045,-0.008,0.084,-0.034,0.109,-0.072 l0.067,-0.103 c0.081,-0.124,0.273,-0.084,0.298,0.062"
                                      fill="none" stroke="#e02c39" stroke-width="3"/>
                            </clipPath>
                        </defs>
                    </svg>
                </span>
            <?php endif; ?>
        </div>
    </div>
</section>
