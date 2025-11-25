<?php
$title     = get_field('title');
$text      = get_field('text');
$selection = get_field('selection');
$id        = get_field('id');

$team_members = [];

if (!empty($selection)) {
    $args = [
        'post_type'      => 'team',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'asc',
        'tax_query'      => [
            [
                'taxonomy' => 'team_category',
                'terms'    => $selection,
                'operator' => 'IN',
            ],
        ],
    ];

    $query        = new WP_Query($args);
    $team_members = $query->posts;
}
?>

<section
    class="team-selection light-blue"
    id="<?php if (!empty($id)) { echo esc_attr($id); } ?>"
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

        <?php if (!empty($team_members)) : ?>
            <div class="flex-wrapper">
                <?php
                global $post;

                foreach ($team_members as $member) :
                    $post = $member;
                    setup_postdata($post);

                    $team_image = get_field('image', $post->ID);
                    $team_role  = get_field('role', $post->ID);
                    $team_phone = get_field('phone', $post->ID);
                    $team_email = get_field('email', $post->ID);
                    ?>
                    <div class="single-team-member" data-aos="fade-up">
                        <?php if (!empty($team_image)) : ?>
                            <span class="image">
                                <img src="<?php echo esc_url($team_image['sizes']['large']); ?>"
                                     alt="<?php echo esc_attr($team_image['alt']); ?>">
                            </span>
                        <?php endif; ?>

                        <h3><?php echo get_the_title($post); ?></h3>

                        <?php if (!empty($team_role)) : ?>
                            <span class="role"><?php echo $team_role; ?></span>
                        <?php endif; ?>

                        <?php the_content(); ?>

                        <div class="contact-info">
                        <?php if (!empty($team_phone)) : ?>
                            <a href="tel:<?php echo esc_attr($team_phone); ?>">
                                <?php echo $team_phone; ?>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($team_email)) : ?>
                            <a href="mailto:<?php echo esc_attr($team_email); ?>">
                                <?php echo $team_email; ?>
                            </a>
                        <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
