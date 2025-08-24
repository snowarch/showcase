<?php

if ( ! function_exists( 'tetsuo_core_map_testimonials_meta' ) ) {
	function tetsuo_core_map_testimonials_meta() {
		$testimonial_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'tetsuo-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'tetsuo-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'tetsuo-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'tetsuo-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'tetsuo-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'tetsuo-core' ),
				'description' => esc_html__( 'Enter author name', 'tetsuo-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'tetsuo-core' ),
				'description' => esc_html__( 'Enter author job position', 'tetsuo-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_core_map_testimonials_meta', 95 );
}