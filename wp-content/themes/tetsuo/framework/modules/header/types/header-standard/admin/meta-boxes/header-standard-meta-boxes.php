<?php

if ( ! function_exists( 'tetsuo_edge_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function tetsuo_edge_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'tetsuo_edge_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'tetsuo_edge_header_standard_meta_map' ) ) {
	function tetsuo_edge_header_standard_meta_map( $parent ) {
		$hide_dep_options = tetsuo_edge_get_hide_dep_for_header_standard_meta_boxes();
		
		tetsuo_edge_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'edgtf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'tetsuo' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'tetsuo' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'tetsuo' ),
					'left'   => esc_html__( 'Left', 'tetsuo' ),
					'right'  => esc_html__( 'Right', 'tetsuo' ),
					'center' => esc_html__( 'Center', 'tetsuo' )
				),
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_additional_header_area_meta_boxes_map', 'tetsuo_edge_header_standard_meta_map' );
}