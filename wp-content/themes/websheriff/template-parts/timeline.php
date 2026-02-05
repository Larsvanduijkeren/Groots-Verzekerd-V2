<?php
    $title = get_field('title');
    $text = get_field('text');
    $cards = get_field('cards');
    
    $id = get_field('id');
?>

<section
    class="timeline"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <?php if (!empty($title)) : ?>
            <div class="intro center" data-aos="fade-up">
                <h2><?php echo $title; ?></h2>
                
                <?php if (!empty($text)) {
                    echo $text;
                } ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($cards)) : ?>
            <div class="slider" data-aos="fade-up">
                <?php foreach ($cards as $card) : ?>
                    <div class="card">
                        <?php if (empty($card['image']) === false) : ?>
                            <span class="image">
                                <?php if (empty($card['year']) === false) : ?>
                                    <span class="year"><?php echo $card['year']; ?></span>
                                <?php endif; ?>

                                <img src="<?php echo $card['image']['sizes']['large']; ?>"
                                     alt="<?php echo $card['image']['alt']; ?>">
                            </span>
                        <?php endif; ?>

                        <div class="content">
                            <?php if (empty($card['title']) === false) : ?>
                                <h3 class="h4"><?php echo $card['title']; ?></h3>
                            <?php endif; ?>
                            
                            <?php if (empty($card['text']) === false) {
                                echo $card['text'];
                            } ?>
                        </div>
                    </div>
                
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
