<?php
    $title = get_field('title');
    $text = get_field('text');
    $buttons = get_field('buttons');
    $alignment = get_field('alignment');
    $cta_title = get_field('cta_title');
    $cta_text = get_field('cta_text');
    $cta_image = get_field('cta_image');
    $rating_text = get_field('rating_text', 'option');
    
    $id = get_field('id');
?>

<section
    class="hero light-blue <?php echo $alignment; ?>"
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
            </div>
            
            <?php if (empty($cta_title) === false) : ?>
                <div class="cta <?php if(empty($cta_image) === false) {
                    echo 'has-image';
                } ?>">
                    <div class="info">
                        <h2 class="h4"><?php echo $cta_title; ?></h2>
                        
                        <?php if (empty($cta_text) === false) {
                            echo $cta_text;
                        } ?>
                        
                        <?php if (empty($rating_text) === false) : ?>
                            <p class="rating-text"><?php echo $rating_text; ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (empty($cta_image) === false) : ?>
                        <img src="<?php echo $cta_image['sizes']['medium']; ?>" alt="<?php echo $cta_image['alt']; ?>">
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
