<div class="edgtf-price-table edgtf-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-pt-inner" <?php echo tetsuo_edge_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="edgtf-pt-title-holder">
				<span class="edgtf-pt-title" <?php echo tetsuo_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
			</li>
			<li class="edgtf-pt-prices">
				<span class="edgtf-pt-value" <?php echo tetsuo_edge_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
				<span class="edgtf-pt-price" <?php echo tetsuo_edge_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
			</li>
			<li class="edgtf-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="edgtf-pt-button">
					<?php echo tetsuo_edge_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'medium'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>