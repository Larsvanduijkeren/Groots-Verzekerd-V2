<?php
$id = get_field('id');
?>

<section
    class="faq"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>faq</h2>
    </div>
</section>
