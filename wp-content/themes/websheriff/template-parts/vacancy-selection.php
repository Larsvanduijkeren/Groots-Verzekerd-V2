<?php
$id = get_field('id');
?>

<section
    class="vacancy-selection"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>vacancy-selection</h2>
    </div>
</section>
