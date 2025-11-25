<?php
$id = get_field('id');
?>

<section
    class="contact-cards"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>contact-cards</h2>
    </div>
</section>
