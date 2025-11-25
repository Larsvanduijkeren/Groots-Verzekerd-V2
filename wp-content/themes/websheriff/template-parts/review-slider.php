<?php
$id = get_field('id');
?>

<section
    class="review-slider"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>review-slider</h2>
    </div>
</section>
