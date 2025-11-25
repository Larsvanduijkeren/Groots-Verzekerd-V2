<?php
$id = get_field('id');
?>

<section
    class="form"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>form</h2>
    </div>
</section>
