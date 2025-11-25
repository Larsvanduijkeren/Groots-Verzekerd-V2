<?php
$id = get_field('id');
?>

<section
    class="values"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>values</h2>
    </div>
</section>
