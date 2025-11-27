<?php
$title = get_field('title');
$text = get_field('text');
$questions = get_field('questions');

$id = get_field('id');
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
                <?php foreach ($questions as $question) : ?>
                    <div class="question">
                        <?php if (empty($question['question']) === false) : ?>
                            <h4><?php echo $question['question']; ?></h4>
                        <?php endif; ?>

                        <?php if (empty($question['answer']) === false) : ?>
                            <div class="answer"><?php echo $question['answer']; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
