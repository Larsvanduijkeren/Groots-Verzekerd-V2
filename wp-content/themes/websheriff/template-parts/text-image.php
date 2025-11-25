<?php
$id = get_field('id');
?>

<section
    class="text-image"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>text-image</h2>
    </div>
</section>
