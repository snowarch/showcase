<li class="edgtf-uss-item <?php echo esc_attr($holder_classes); ?>" <?php echo tetsuo_edge_get_inline_attrs($holder_data); ?>>
    <div class="edgtf-uss-image-holder" <?php echo tetsuo_edge_get_inline_attrs($image_data); ?> <?php tetsuo_edge_inline_style($holder_styles); ?>></div>
    <div class="edgtf-uss-item-outer">
        <div class="edgtf-uss-item-inner" <?php tetsuo_edge_inline_style($item_inner_styles); ?>>
            <?php echo do_shortcode($content); ?>
        </div>
	</div>
	<?php if(!empty($link)) { ?>
		<a itemprop="url" class="edgtf-uss-item-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
	<?php } ?>
</li>