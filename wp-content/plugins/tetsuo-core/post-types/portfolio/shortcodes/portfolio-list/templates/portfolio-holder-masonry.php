<div class="edgtf-portfolio-list-holder edgtf-grid-list edgtf-grid-masonry-list edgtf-disable-bottom-space <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/filter', '', $params); ?>
	<div class="edgtf-pl-inner edgtf-outer-space edgtf-masonry-list-wrapper clearfix">
		<div class="edgtf-masonry-grid-sizer"></div>
		<div class="edgtf-masonry-grid-gutter"></div>
		<?php 
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item', $item_type, $params);
				endwhile;
			else:
				echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	
	<?php echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'pagination/'.$pagination_type, '', $params, $additional_params); ?>
</div>