<?php get_header();

$id = get_the_id();
$short_description = get_field('short_description');
$image = get_field('image');
$hours = get_field('hours');
$contract = get_field('contract');
$location = get_field('location');

$add_testimonial = get_field('add_testimonial');
$testimonial_title = get_field('testimonial_title');
$testimonial_text = get_field('testimonial_text');
$testimonial_author = get_field('testimonial_author');
$testimonial_image = get_field('testimonial_image');

$vacancy_cta_title = get_field('vacancy_cta_title', 'option');
$vacancy_cta_text = get_field('vacancy_cta_text', 'option');
$vacancy_cta_image = get_field('vacancy_cta_image', 'option');
$vacancy_cta_author = get_field('vacancy_cta_author', 'option');

$vacancy_timeline = get_field('vacancy_timeline', 'option');
$vacancy_form = get_field('vacancy_form', 'option');

$id = get_the_id();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <section class="home-hero light-blue">
            <div class="container">
                <div class="flex-wrapper">
                    <div class="content">
                        <span class="label">Vacature</span>
                        <h1><?php the_title(); ?></h1>

                        <?php if (empty($short_description) === false) {
                            echo $short_description;
                        } ?>

                        <a href="#solliciteren" class="btn">Solliciteer direct</a>

                        <div class="meta">
                            <?php if (empty($hours) === false) : ?>
                                <span class="hours"><?php echo $hours; ?></span>
                            <?php endif; ?>

                            <?php if (empty($contract) === false) : ?>
                                <span class="contract"><?php echo $contract; ?></span>
                            <?php endif; ?>

                            <?php if (empty($location) === false) : ?>
                                <span class="location"><?php echo $location; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (empty($image) === false) : ?>
                        <span class="image">
                            <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">

                            <svg height="0" width="0">
                                <defs>
                                    <clipPath id="imageCloverClip" clipPathUnits="objectBoundingBox">
                                        <path id="Path_5329" data-name="Path 5329"
                                            d="M0.731,0.136 L0.752,0.257 C0.76,0.301,0.785,0.341,0.823,0.366 L0.926,0.433 C1,0.514,1,0.706,0.864,0.731 L0.743,0.752 C0.699,0.76,0.659,0.785,0.634,0.823 L0.567,0.926 C0.486,1,0.294,1,0.269,0.864 L0.248,0.743 C0.24,0.699,0.215,0.659,0.177,0.634 L0.074,0.567 C-0.05,0.486,-0.01,0.294,0.136,0.269 L0.257,0.248 C0.301,0.24,0.341,0.215,0.366,0.177 L0.433,0.074 C0.514,-0.05,0.706,-0.01,0.731,0.136 L0.731,0.136"
                                            fill="none" stroke="#e02c39" stroke-width="3" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="vacancy-content">
            <div class="container">
                <div class="flex-wrapper">
                    <div class="content" data-aos="fade-up">
                        <?php the_content(); ?>

                        <?php if (empty($add_testimonial) === false) : ?>
                            <div class="testimonial">
                                <div class="info">
                                    <h4><?php echo $testimonial_title; ?></h4>
                                    <p><?php echo $testimonial_text; ?></p>
                                    <span class="author"><?php echo $testimonial_author; ?></p>
                                </div>

                                <?php if (empty($testimonial_image) === false) : ?>
                                    <img src="<?php echo $testimonial_image['sizes']['large']; ?>" alt="<?php echo $testimonial_image['alt']; ?>">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class='sidebar' data-aos="fade-up">
                        <div class='sticky'>
                            <div class="card">
                                <?php if (empty($vacancy_cta_title) === false) : ?>
                                    <h3><?php echo $vacancy_cta_title; ?></h3>
                                <?php endif; ?>

                                <?php if (empty($vacancy_cta_text) === false) {
                                    echo $vacancy_cta_text;
                                } ?>

                                <?php if (empty($vacancy_cta_author) === false) : ?>
                                    <div class="author">
                                        <?php if (empty($vacancy_cta_image) === false) : ?>
                                            <img src="<?php echo $vacancy_cta_image['sizes']['large']; ?>" alt="<?php echo $vacancy_cta_image['alt']; ?>">
                                        <?php endif; ?>

                                        <div class="info">
                                            <span class="name"><?php echo $vacancy_cta_author; ?></span>

                                            <a href="#solliciteren" class="btn">Solliciteer direct</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if (!empty($vacancy_timeline)) : ?>
            <?php get_template_part('template-parts/timeline', null, ['timeline' => $vacancy_timeline]); ?>
        <?php endif; ?>

        <?php if (!empty($vacancy_form)) : ?>
            <?php get_template_part('template-parts/form', null, ['form' => $vacancy_form]); ?>
        <?php endif; ?>

<?php
    endwhile;
endif;

get_footer(); ?>