<?php
$id = get_field('id');
?>

<section
    class="documents"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>documents</h2>
    </div>
</section>
