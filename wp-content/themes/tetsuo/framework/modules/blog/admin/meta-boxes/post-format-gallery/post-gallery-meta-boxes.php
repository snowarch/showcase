<?php

if ( ! function_exists( 'tetsuo_edge_map_post_gallery_meta' ) ) {
	
	function tetsuo_edge_map_post_gallery_meta() {
		$gallery_post_format_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'tetsuo' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		tetsuo_edge_add_multiple_images_field(
			array(
				'name'        => 'edgtf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'tetsuo' ),
				'description' => esc_html__( 'Choose your gallery images', 'tetsuo' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_map_post_gallery_meta', 21 );
}
