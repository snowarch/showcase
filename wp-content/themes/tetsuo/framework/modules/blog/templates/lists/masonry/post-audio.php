<?php
$post_classes[] = 'edgtf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-heading">
            <?php tetsuo_edge_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
    </div>
</article>