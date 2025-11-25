<?php
$id = get_field('id');
?>

<section
    class="logos"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>logos</h2>
    </div>
</section>
