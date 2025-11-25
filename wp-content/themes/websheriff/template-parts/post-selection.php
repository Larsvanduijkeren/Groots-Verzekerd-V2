<?php
$id = get_field('id');
?>

<section
    class="post-selection"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>post-selection</h2>
    </div>
</section>
