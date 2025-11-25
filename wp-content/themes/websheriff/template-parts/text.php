<?php
$id = get_field('id');
?>

<section
    class="text"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>text</h2>
    </div>
</section>
