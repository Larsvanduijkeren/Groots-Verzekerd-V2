<?php
$id = get_field('id');
?>

<section
    class="google-reviews"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2 data-aos="fade-up">google-reviews</h2>
    </div>
</section>
