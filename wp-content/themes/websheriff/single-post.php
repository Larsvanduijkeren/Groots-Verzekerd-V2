<?php get_header();

$id = get_the_id();
$date = date_i18n('d/m/Y', strtotime(get_post($id)->post_date));
$featured_image = get_the_post_thumbnail_url($id, 'large');
$thumbnail_id = get_post_thumbnail_id($id);
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
$time_to_read = get_field('time_to_read');
$cat = get_the_category($id)[0];
$author_id = get_the_author_meta('ID');
$author_job_description = get_field('job_description', 'user_' . $author_id);

$id = get_the_id();
$cat_id = get_the_category($id)[0]->term_id;
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class='hero light-blue center'>
        <div class='container'>
            <div class='flex-wrapper'>
                <div data-aos="fade-up" class='content'>
                    <h1 class="h2"><?php echo get_the_title(); ?></h1>

                    <p><?php echo get_the_excerpt(); ?></p>

                    <a href="<?php echo get_the_permalink(get_option('page_for_posts')); ?>" class="btn">
                        Bekijk alle artikelen
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="post-content">
        <div class="container">
            <div class="post-wrapper">
                <div class='sidebar' data-aos="fade-up">
                    <div class='sticky'>
                        <h4>Inhoud</h4>

                        <div class="group">
                            <div class='index'></div>
                        </div>

                        <div class="group">
                            <h4>Auteur</h4>
                            <div class="author">
                                <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>

                                <div class="author-info">
                                    <span class="name"><?php echo get_the_author(); ?></span>

                                    <?php if (empty($author_job_description) === false) : ?>
                                        <span class="job"><?php echo $author_job_description; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <div class="share">
                                <div class="social">
                                    <div class="clipboard"></div>

                                    <a href="http://twitter.com/share?url=<?php echo get_the_permalink(); ?>"
                                       class="twitter large">
                                        Twitter
                                    </a>

                                    <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>&t=<?php echo get_the_title(); ?>"
                                       class="facebook large">
                                        Facebook
                                    </a>

                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo get_the_permalink(); ?>"
                                       class="linkedin large">
                                        Linkedin
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content" data-aos="fade-up">
                    <?php the_content(); ?>
                </div>
            </div>

        </div>
    </section>

    <?php
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 3,
        'cat' => $cat_id,
        'post__not_in' => [$id],
    ];

    $query = new WP_Query($args);
    if ($query->have_posts()) :
        ?>

        <section class='posts-selection light-blue'>
            <div class='container'>
                <div class="intro" data-aos="fade-up">
                    <div class="wrapper">
                        <h2>Gerelateerde artikelen</h2>
                    </div>
                </div>

                <div class='post-grid'>
                    <?php

                    if ($query->have_posts()) :
                        while ($query->have_posts()) :
                            $query->the_post();
                            $id = get_the_id();
                            $featured_image = get_the_post_thumbnail_url($post, 'large');
                            $thumbnail_id = get_post_thumbnail_id($post);
                            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            $author_id = $post->post_author;
                            $cat = get_the_terms($id, 'category');
                            ?>

                            <div data-aos="fade-up" class="single-post">
                                <?php if (empty($featured_image) === false) : ?>
                                    <span class="image">
                                        <img src="<?php echo $featured_image; ?>"
                                             alt="<?php echo $alt; ?>">
                                    </span>
                                <?php endif; ?>

                                <div class="content">
                                    <?php if (empty($cat) === false) : ?>
                                        <span class="btn small">
                                            <?php echo $cat[0]->name; ?>
                                        </span>
                                    <?php endif; ?>

                                    <h3><?php echo get_the_title($id); ?></h3>

                                    <div class="time-to-read"><?php echo get_reading_time($post); ?> minuten leestijd
                                    </div>

                                    <p><?php echo get_the_excerpt(); ?></p>

                                    <a href="<?php echo get_the_permalink($id); ?>" class="btn-ghost">Lees verder</a>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    endif; ?>
                </div>
            </div>
        </section>
    <?php endif;
endwhile;
endif;

get_footer(); ?>
