<?php
$content_styles = $this_object->getStandardContentStyles($params);

echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params); ?>

<div class="edgtf-pli-text-holder" <?php tetsuo_edge_inline_style($content_styles); ?>>
	<div class="edgtf-pli-text-wrapper">
		<div class="edgtf-pli-text">
			<?php echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', $item_style, $params); ?>
			
			<?php echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>

			<?php echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/images-count', $item_style, $params); ?>
			
			<?php echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/excerpt', $item_style, $params); ?>
		</div>
	</div>
</div>