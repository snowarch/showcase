<?php

if ( ! function_exists( 'tetsuo_edge_map_post_link_meta' ) ) {
	function tetsuo_edge_map_post_link_meta() {
		$link_post_format_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'tetsuo' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'tetsuo' ),
				'description' => esc_html__( 'Enter link', 'tetsuo' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_map_post_link_meta', 24 );
}