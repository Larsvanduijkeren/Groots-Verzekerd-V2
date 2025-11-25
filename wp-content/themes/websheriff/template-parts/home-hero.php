<?php
$id = get_field('id');
?>

<section
    class="home-hero"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>home-hero</h2>
    </div>
</section>
