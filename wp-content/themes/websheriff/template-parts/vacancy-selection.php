<?php
$title = get_field('title');
$text = get_field('text');
$selection = get_field('selection');
$id = get_field('id');

$vacancies = [];

if (!empty($selection)) {
    $args = [
        'post_type'      => 'vacancy',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'asc',
        'tax_query'      => [
            [
                'taxonomy' => 'vacancy_category',
                'terms'    => $selection,
                'operator' => 'IN',
            ],
        ],
    ];

    $query = new WP_Query($args);
    $vacancies = $query->posts;
}
?>

<section
    class="vacancy-selection light-blue"
    id="<?php if (!empty($id)) {
        echo esc_attr($id);
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

        <?php if (!empty($vacancies)) : ?>
            <div class="flex-wrapper">
                <?php
                global $post;

                foreach ($vacancies as $vacancy) :
                    $post = $vacancy;
                    setup_postdata($post);

                    $vacancy_short_description = get_field('short_description', $post->ID);
                    $vacancy_position_filled = get_field('position_filled', $post->ID);
                    ?>
                    <div class="single-vacancy <?php if ($vacancy_position_filled) {
                        echo 'filled';
                    } ?>" data-aos="fade-up">
                        <h3><?php echo get_the_title($vacancy); ?></h3>

                        <?php if (empty($vacancy_short_description) === false) {
                            echo $vacancy_short_description;
                        } ?>

                        <?php if ($vacancy_position_filled) : ?>
                            <span class="btn-ghost">
                                Positie vervuld
                            </span>
                        <?php else : ?>
                            <a href="<?php echo get_the_permalink($vacancy); ?>" class="btn">
                                Bekijk vacature
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
