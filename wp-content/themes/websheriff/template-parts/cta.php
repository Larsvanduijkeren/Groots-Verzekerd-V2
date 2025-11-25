<?php
$id = get_field('id');
?>

<section
    class="cta"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>cta</h2>
    </div>
</section>
