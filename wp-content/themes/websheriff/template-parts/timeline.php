<?php
$id = get_field('id');
?>

<section
    class="timeline"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>timeline</h2>
    </div>
</section>
