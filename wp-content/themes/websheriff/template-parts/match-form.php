<?php
$title = get_field('title');
$text = get_field('text');
$match_questions = get_field('match_questions');
$rating_text = get_field('rating_text');

$main_form_shortcode = get_field('main_form_shortcode');
$main_form_title = get_field('main_form_title');
$main_form_text = get_field('main_form_text');

$contact_image = get_field('contact_image');
$contact_name = get_field('contact_name');
$contact_text = get_field('contact_text');

$no_match_icon = get_field('no_match_icon');
$no_match_title = get_field('no_match_title');
$no_match_text = get_field('no_match_text');
$no_match_button = get_field('no_match_button');

$id = get_field('id');
?>

<section
    class="match-form"
    id="<?php if (empty($id) === false) {
            echo $id;
        } ?>">
    <div class="container">
        <div class="card" data-aos="fade-up">
            <div class="step match-check">
                <div class="content">
                    <?php if (empty($title) === false) : ?>
                        <h2><?php echo $title; ?></h2>
                    <?php endif; ?>

                    <?php if (empty($text) === false) {
                        echo $text;
                    } ?>

                    <div class="contact">
                        <?php if (empty($contact_image) === false) : ?>
                            <div class="info">
                                <?php if (empty($contact_name) === false) : ?>
                                    <strong><?php echo $contact_name; ?></strong>
                                <?php endif; ?>

                                <?php if (empty($contact_text) === false) : ?>
                                    <p><?php echo $contact_text; ?></p>
                                <?php endif; ?>
                            </div>


                            <img src="<?php echo $contact_image['sizes']['medium']; ?>"
                                alt="<?php echo $contact_image['alt']; ?>">
                        <?php endif; ?>
                    </div>


                    <?php if (empty($rating_text) === false) : ?>
                        <p class="rating-text">
                            <?php echo $rating_text; ?>
                        </p>
                    <?php endif; ?>
                </div>

                <?php if (empty($match_questions) === false) : ?>
                    <form class="match-questions-form">
                        <div class="match-questions">
                            <?php foreach ($match_questions as $index => $question) : ?>
                                <div class="match-question">
                                    <?php if (empty($question['icon']) === false) : ?>
                                        <img class="style-svg" src="<?php echo $question['icon']['sizes']['medium']; ?>" alt="<?php echo $question['icon']['alt']; ?>">
                                    <?php endif; ?>

                                    <div class="question"><?php echo $question['question']; ?></div>
                                    <div class="question-options">
                                        <label class="option-label">
                                            <input type="radio" name="match_question_<?php echo $index; ?>" value="yes">
                                            <span class="option-text">Ja</span>
                                        </label>
                                        <label class="option-label">
                                            <input type="radio" name="match_question_<?php echo $index; ?>" value="no">
                                            <span class="option-text">Nee</span>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p class="match-form-error hide" aria-live="polite">Beantwoord alle vragen om door te gaan.</p>
                        <button type="submit" class="match-check-btn btn">Zijn wij een match?</button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="step hide match-form-step">
                <div class="form">
                    <?php if (empty($main_form_title) === false) : ?>
                        <h2><?php echo $main_form_title; ?></h3>
                        <?php endif; ?>

                        <?php if (empty($main_form_text) === false) {
                            echo $main_form_text;
                        } ?>

                        <?php if (empty($main_form_shortcode) === false) {
                            echo do_shortcode($main_form_shortcode);
                        } ?>
                </div>
            </div>

            <div class="step hide no-match">
                <div class="content no-match-content">

                    <?php if (empty($no_match_icon) === false) : ?>
                        <img src="<?php echo $no_match_icon['sizes']['medium']; ?>" alt="<?php echo $no_match_icon['alt']; ?>">
                    <?php endif; ?>

                    <?php if (empty($no_match_title) === false) : ?>
                        <h2><?php echo $no_match_title; ?></h2>
                    <?php endif; ?>

                    <?php if (empty($no_match_text) === false) {
                        echo $no_match_text;
                    } ?>

                    <?php if (empty($no_match_button) === false) : ?>
                        <a href="<?php echo $no_match_button['url']; ?>" class="btn"><?php echo $no_match_button['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>