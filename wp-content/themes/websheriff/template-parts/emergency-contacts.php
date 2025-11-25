<?php
$id = get_field('id');
?>

<section
    class="emergency-contacts"
    id="<?php if (empty($id) === false) {
        echo $id;
    } ?>"
>
    <div class="container">
        <h2>emergency-contacts</h2>
    </div>
</section>
