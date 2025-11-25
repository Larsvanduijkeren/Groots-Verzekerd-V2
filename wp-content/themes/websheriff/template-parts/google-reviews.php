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
        <h2>google-reviews</h2>
    </div>
</section>
