<?php

if ( ! function_exists( 'tetsuo_edge_get_hide_dep_for_top_header_area_meta_boxes' ) ) {
	function tetsuo_edge_get_hide_dep_for_top_header_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'tetsuo_edge_filter_top_header_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'tetsuo_edge_header_top_area_meta_options_map' ) ) {
	function tetsuo_edge_header_top_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = tetsuo_edge_get_hide_dep_for_top_header_area_meta_boxes();
		
		$top_header_container = tetsuo_edge_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name'   => 'top_area_style',
				'title'  => esc_html__( 'Top Area', 'tetsuo' )
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_top_bar_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Top Bar', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will show header top bar area', 'tetsuo' ),
				'parent'        => $top_header_container,
				'options'       => tetsuo_edge_get_yes_no_select_array(),
			)
		);
		
		$top_bar_container = tetsuo_edge_add_admin_container_no_style(
			array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $top_header_container,
				'dependency' => array(
					'show' => array(
						'edgtf_top_bar_meta' => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_top_bar_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar In Grid', 'tetsuo' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'tetsuo' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => tetsuo_edge_get_yes_no_select_array()
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'   => 'edgtf_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Top Bar Background Color', 'tetsuo' ),
				'parent' => $top_bar_container
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Background Color Transparency', 'tetsuo' ),
				'description' => esc_html__( 'Set top bar background color transparenct. Value should be between 0 and 1', 'tetsuo' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_top_bar_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar Border', 'tetsuo' ),
				'description'   => esc_html__( 'Set border on top bar', 'tetsuo' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => tetsuo_edge_get_yes_no_select_array()
			)
		);
		
		$top_bar_border_container = tetsuo_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'show' => array(
						'edgtf_top_bar_border_meta' => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_top_bar_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'tetsuo' ),
				'description' => esc_html__( 'Choose color for top bar border', 'tetsuo' ),
				'parent'      => $top_bar_border_container
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_additional_header_area_meta_boxes_map', 'tetsuo_edge_header_top_area_meta_options_map', 10, 1 );
}