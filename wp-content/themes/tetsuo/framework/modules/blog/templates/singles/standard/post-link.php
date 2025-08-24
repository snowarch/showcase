<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-text-main">
                    <div class="edgtf-post-mark">
                        <span class="icon_link edgtf-link-mark"></span>
                    </div>
                    <?php tetsuo_edge_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
        <div class="edgtf-post-additional-content">
            <?php the_content(); ?>
        </div>
        <div class="edgtf-post-info-bottom clearfix">
            <?php tetsuo_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
            <?php tetsuo_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
            <?php tetsuo_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>

            <?php tetsuo_edge_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
            <?php tetsuo_edge_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>

            <?php
            if(tetsuo_edge_options()->getOptionValue('show_tags_area_blog') === 'yes') {
                tetsuo_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params);
            } ?>
        </div>

        <div class="edgtf-post-info-bottom-below">
            <?php tetsuo_edge_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
        </div>
    </div>

</article>