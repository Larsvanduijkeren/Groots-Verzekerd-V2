<?php
$id = get_field('id');
?>

<section
    class="insurance-selection"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>insurance-selection</h2>
    </div>
</section>
