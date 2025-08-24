<?php

if ( ! function_exists( 'tetsuo_core_reviews_map' ) ) {
	function tetsuo_core_reviews_map() {
		
		$reviews_panel = tetsuo_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'tetsuo-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'tetsuo-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'tetsuo-core' ),
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'tetsuo-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'tetsuo-core' ),
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_additional_page_options_map', 'tetsuo_core_reviews_map', 75 ); //one after elements
}