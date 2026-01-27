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
            <div class="slider" data-aos="fade-up">
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
                    <div class="single-team-member" >
                        <?php if (!empty($team_image)) : ?>
                            <span class="image">
                                <img src="<?php echo esc_url($team_image['sizes']['large']); ?>"
                                     alt="<?php echo esc_attr($team_image['alt']); ?>">

                                <svg height="0" width="0">
                                    <defs>
                                        <clipPath id="imageCloverClip" clipPathUnits="objectBoundingBox">
                                            <path id="Path_5329" data-name="Path 5329"
                                                  d="M0.731,0.136 L0.752,0.257 C0.76,0.301,0.785,0.341,0.823,0.366 L0.926,0.433 C1,0.514,1,0.706,0.864,0.731 L0.743,0.752 C0.699,0.76,0.659,0.785,0.634,0.823 L0.567,0.926 C0.486,1,0.294,1,0.269,0.864 L0.248,0.743 C0.24,0.699,0.215,0.659,0.177,0.634 L0.074,0.567 C-0.05,0.486,-0.01,0.294,0.136,0.269 L0.257,0.248 C0.301,0.24,0.341,0.215,0.366,0.177 L0.433,0.074 C0.514,-0.05,0.706,-0.01,0.731,0.136 L0.731,0.136"
                                                  fill="none" stroke="#e02c39" stroke-width="3"/>
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg height="0" width="0">
                                    <defs>
                                        <clipPath id="imageBubbleClip" clipPathUnits="objectBoundingBox">
                                            <path id="Path_5329" data-name="Path 5329"
                                                  d="M0.5,0 C0.224,0,0,0.224,0,0.5 C0,0.572,0.015,0.64,0.042,0.702 C0.044,0.706,0.046,0.711,0.049,0.715 C0.049,0.716,0.049,0.717,0.05,0.717 C0.061,0.74,0.059,0.767,0.049,0.791 L0.021,0.856 C-0.013,0.934,0.066,1,0.144,0.979 L0.209,0.951 C0.233,0.941,0.26,0.941,0.284,0.951 C0.349,0.982,0.422,1,0.5,1 C0.776,1,1,0.776,1,0.5 C1,0.224,0.776,0,0.5,0"
                                                  fill="none" stroke="#e02c39" stroke-width="3"/>
                                        </clipPath>
                                    </defs>
                                </svg>

                                <svg height="0" width="0">
                                    <defs>
                                        <clipPath id="imageHouseClip" clipPathUnits="objectBoundingBox">
                                            <path id="Path_5329" data-name="Path 5329"
                                                  d="M0.819,1 H0.181 C0.081,1,0,0.934,0,0.852 V0.364 C0,0.32,0.024,0.278,0.066,0.25 L0.384,0.034 C0.451,-0.011,0.549,-0.011,0.616,0.034 L0.934,0.25 C0.976,0.278,1,0.32,1,0.364 V0.852 C1,0.934,0.919,1,0.819,1"
                                                  fill="none" stroke="#e02c39" stroke-width="3"/>
                                        </clipPath>
                                    </defs>
                                </svg>
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
