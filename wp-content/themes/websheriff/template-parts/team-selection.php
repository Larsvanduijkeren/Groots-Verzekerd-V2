<?php
$id = get_field('id');
?>

<section
    class="team-selection"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>team-selection</h2>
    </div>
</section>
