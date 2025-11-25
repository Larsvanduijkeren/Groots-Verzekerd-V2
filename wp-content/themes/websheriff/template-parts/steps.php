<?php
$id = get_field('id');
?>

<section
    class="steps"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>steps</h2>
    </div>
</section>
