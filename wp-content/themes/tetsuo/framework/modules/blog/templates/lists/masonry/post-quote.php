<?php
$post_classes[] = 'edgtf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-text-main">
                    <?php tetsuo_edge_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                    <div class="edgtf-post-mark">
                        <span class="icon_quotations_alt2 edgtf-quote-mark"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>