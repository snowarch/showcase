<?php

if ( ! function_exists( 'tetsuo_edge_map_post_quote_meta' ) ) {
	function tetsuo_edge_map_post_quote_meta() {
		$quote_post_format_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'tetsuo' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'tetsuo' ),
				'description' => esc_html__( 'Enter Quote text', 'tetsuo' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'tetsuo' ),
				'description' => esc_html__( 'Enter Quote author', 'tetsuo' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_map_post_quote_meta', 25 );
}