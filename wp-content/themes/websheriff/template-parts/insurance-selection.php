<?php
$title = get_field('title');
$text = get_field('text');
$selection = get_field('selection');
$id = get_field('id');

$insurances = [];

if (!empty($selection)) {
    $args = [
        'post_type'      => 'insurance',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'asc',
        'tax_query'      => [
            [
                'taxonomy' => 'insurance_category',
                'terms'    => $selection,
                'operator' => 'IN',
            ],
        ],
    ];

    $query = new WP_Query($args);
    $insurances = $query->posts;
}
?>

<section
    class="insurance-selection"
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

        <?php if (!empty($insurances)) : ?>
            <div class="flex-wrapper">
                <?php
                global $post;

                foreach ($insurances as $insurance) :
                    $post = $insurance;
                    setup_postdata($post);

                    $insurance_short_description = get_field('short_description', $post->ID);
                    $insurance_cta_label = get_field('cta_label', $post->ID);
                    ?>
                    <div class="single-insurance" data-aos="fade-up">
                        <h3><?php echo get_the_title($insurance); ?></h3>

                        <?php if (empty($insurance_short_description) === false) {
                            echo $insurance_short_description;
                        } ?>

                        <a href="<?php echo get_the_permalink($insurance); ?>" class="btn">
                            Meer informatie
                        </a>

                        <?php if (empty($insurance_cta_label) === false) : ?>
                            <p class="light"><?php echo $insurance_cta_label; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
