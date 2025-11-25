<?php
$id = get_field('id');
?>

<section
    class="hero"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>hero</h2>
    </div>
</section>
