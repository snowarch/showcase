<?php

if ( ! function_exists( 'tetsuo_edge_portfolio_category_additional_fields' ) ) {
	function tetsuo_edge_portfolio_category_additional_fields() {
		
		$fields = tetsuo_edge_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		tetsuo_edge_add_taxonomy_field(
			array(
				'name'   => 'edgtf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'tetsuo-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_custom_taxonomy_fields', 'tetsuo_edge_portfolio_category_additional_fields' );
}