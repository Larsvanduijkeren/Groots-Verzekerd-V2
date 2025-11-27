</main>

<?php
$logo = get_field('logo', 'option');
$footer_text = get_field('footer_text', 'option');
$footer_title_1 = get_field('footer_title_1', 'option');
$footer_title_2 = get_field('footer_title_2', 'option');
$footer_contact_information = get_field('footer_contact_information', 'option');
$disclaimer = get_field('disclaimer', 'option');
$phone = get_field('phone', 'option');
$email = get_field('email', 'option');

$facebook = get_field('facebook', 'option');
$linkedin = get_field('linkedin', 'option');
$instagram = get_field('instagram', 'option');
?>

<footer class='footer'>
    <div class='container'>
        <div class="flex-wrapper">
            <div class="col">
                <?php if (empty($logo) === false) : ?>
                    <img class="logo" src="<?php echo $logo['sizes']['medium']; ?>" alt="<?php echo $logo['alt']; ?>">
                <?php endif; ?>

                <?php if(empty($footer_text) === false) {
                    echo $footer_text;
                } ?>
            </div>

            <div class="col">
                <?php if (empty($footer_title_1) === false) : ?>
                    <h3 class="h4"><?php echo $footer_title_1; ?></h3>
                <?php endif; ?>

                <?php wp_nav_menu(['theme_location' => 'footer-nav']); ?>
            </div>

            <div class="col">
                <?php if (empty($footer_title_2) === false) : ?>
                    <h3 class="h4"><?php echo $footer_title_2; ?></h3>
                <?php endif; ?>

                <?php if (empty($footer_contact_information) === false) {
                    echo $footer_contact_information;
                } ?>

                <?php if (empty($phone) === false) : ?>
                    <a class="phone btn" href="tel:<?php echo $phone; ?>">
                        <?php echo $phone; ?>
                    </a>
                <?php endif; ?>

                <?php if (empty($email) === false) : ?>
                    <a class="email btn-ghost" href="mailto:<?php echo $email; ?>">
                        <?php echo $email; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="copyright-wrapper">
            <span class="copyright">
                &copy; <?php echo date('Y'); ?> Groots Verzekerd
            </span>

            <div class='social'>
                <?php if (empty($instagram) === false) : ?>
                    <a href='<?php echo $instagram; ?>' target='_blank' class='icon large instagram'>
                        Instagram
                    </a>
                <?php endif; ?>

                <?php if (empty($facebook) === false) : ?>
                    <a href='<?php echo $facebook; ?>' target='_blank' class='icon large facebook'>
                        Facebook
                    </a>
                <?php endif; ?>

                <?php if (empty($linkedin) === false) : ?>
                    <a href='<?php echo $linkedin; ?>' target='_blank' class='icon large linkedin'>
                        Linkedin
                    </a>
                <?php endif; ?>
            </div>

            <span class="to-top">
                Terug naar top
            </span>
        </div>

        <?php if (empty($disclaimer) === false) : ?>
            <div class="disclaimer">
                <?php echo $disclaimer; ?>
            </div>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
