<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="edgtf-tags-holder">
    <div class="edgtf-tags">
        <?php the_tags('', ' <span>/</span> ', ''); ?>
    </div>
</div>
<?php } ?>