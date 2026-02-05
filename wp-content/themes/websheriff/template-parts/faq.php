<?php
    $title = get_field('title');
    $text = get_field('text');
    $selection = get_field('selection');
    
    $id = get_field('id');
    
    $questions = [];
    
    if (!empty($selection)) {
        $args = [
            'post_type'      => 'question',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'asc',
            'tax_query'      => [
                [
                    'taxonomy' => 'question_category',
                    'terms'    => $selection,
                    'operator' => 'IN',
                ],
            ],
        ];
        
        $query = new WP_Query($args);
        $questions = $query->posts;
    }
?>

<section
    class="faq"
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
        
        <?php if (empty($questions) === false) : ?>
            <div class="accordion" data-aos="fade-up">
                <?php foreach ($questions as $question) :
                    $answer = get_field('answer', $question);
                    ?>
                    <div class="question">
                        <h4><?php echo get_the_title($question); ?></h4>

                        <div class="answer">
                            <?php if (empty($answer) === false) {
                                echo $answer;
                            } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
