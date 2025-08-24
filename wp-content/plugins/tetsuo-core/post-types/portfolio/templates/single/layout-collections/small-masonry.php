<?php
$masonry_classes   = '';
$number_of_columns = tetsuo_edge_get_meta_field_intersect( 'portfolio_single_masonry_columns_number' );
if ( ! empty( $number_of_columns ) ) {
	$masonry_classes .= ' edgtf-' . $number_of_columns . '-columns';
}
$space_between_items = tetsuo_edge_get_meta_field_intersect( 'portfolio_single_masonry_space_between_items' );
if ( ! empty( $space_between_items ) ) {
	$masonry_classes .= ' edgtf-' . $space_between_items . '-space';
}
?>
<div class="edgtf-grid-row">
	<div class="edgtf-grid-col-8">
		<div class="edgtf-ps-image-holder edgtf-grid-list edgtf-grid-masonry-list edgtf-fixed-masonry-items <?php echo esc_attr($masonry_classes); ?>">
			<div class="edgtf-ps-image-inner edgtf-outer-space edgtf-masonry-list-wrapper">
				<div class="edgtf-masonry-grid-sizer"></div>
				<div class="edgtf-masonry-grid-gutter"></div>
				<?php
				$media = tetsuo_core_get_portfolio_single_media(true);
				
				if(is_array($media) && count($media)) : ?>
					<?php foreach($media as $single_media) : ?>
						<div class="edgtf-ps-image edgtf-item-space <?php echo esc_attr($single_media['holder_classes']); ?>">
							<?php tetsuo_core_get_portfolio_single_media_html($single_media); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="edgtf-grid-col-4">
		<div class="edgtf-ps-info-holder edgtf-ps-info-sticky-holder">
			<?php
			//get portfolio content section
			tetsuo_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
			
			//get portfolio custom fields section
			tetsuo_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio categories section
			tetsuo_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
			
			//get portfolio date section
			tetsuo_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio tags section
			tetsuo_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
			
			//get portfolio share section
			tetsuo_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>