<?php

if ( ! function_exists( 'tetsuo_edge_get_hide_dep_for_header_standard_options' ) ) {
	function tetsuo_edge_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'tetsuo_edge_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'tetsuo_edge_header_standard_map' ) ) {
	function tetsuo_edge_header_standard_map( $parent ) {
		$hide_dep_options = tetsuo_edge_get_hide_dep_for_header_standard_options();
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'tetsuo' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'tetsuo' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'tetsuo' ),
					'left'   => esc_html__( 'Left', 'tetsuo' ),
					'center' => esc_html__( 'Center', 'tetsuo' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_additional_header_menu_area_options_map', 'tetsuo_edge_header_standard_map' );
}