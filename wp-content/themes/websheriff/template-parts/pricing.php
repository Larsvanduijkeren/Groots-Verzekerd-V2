<?php
$id = get_field('id');
?>

<section
    class="pricing"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>pricing</h2>
    </div>
</section>
