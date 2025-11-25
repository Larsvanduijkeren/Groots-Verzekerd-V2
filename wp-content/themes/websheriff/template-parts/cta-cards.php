<?php
$id = get_field('id');
?>

<section
    class="cta-cards"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>cta-cards</h2>
    </div>
</section>
