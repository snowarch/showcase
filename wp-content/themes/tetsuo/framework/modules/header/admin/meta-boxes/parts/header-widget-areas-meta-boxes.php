<?php

if ( ! function_exists( 'tetsuo_edge_get_hide_dep_for_header_widget_areas_meta_boxes' ) ) {
	function tetsuo_edge_get_hide_dep_for_header_widget_areas_meta_boxes() {
		$hide_dep_options = apply_filters( 'tetsuo_edge_filter_header_widget_areas_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'tetsuo_edge_get_hide_dep_for_header_widget_area_two_meta_boxes' ) ) {
	function tetsuo_edge_get_hide_dep_for_header_widget_area_two_meta_boxes() {
		$hide_dep_options = apply_filters( 'tetsuo_edge_filter_header_widget_area_two_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'tetsuo_edge_header_widget_areas_meta_options_map' ) ) {
	function tetsuo_edge_header_widget_areas_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets 			= tetsuo_edge_get_hide_dep_for_header_widget_areas_meta_boxes();
		$hide_dep_widget_area_two 	= tetsuo_edge_get_hide_dep_for_header_widget_area_two_meta_boxes();
		
		$header_widget_areas_container = tetsuo_edge_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_widget_areas_container',
				'parent'     => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta' => $hide_dep_widgets
					)
				),
				'args'       => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $header_widget_areas_container,
				'name'   => 'header_widget_areas',
				'title'  => esc_html__( 'Widget Areas', 'tetsuo' )
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_disable_header_widget_areas_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Widget Areas', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will hide widget areas from header', 'tetsuo' ),
				'parent'        => $header_widget_areas_container,
			)
		);

		$header_custom_widget_areas_container = tetsuo_edge_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'header_custom_widget_areas_container',
				'parent'     => $header_widget_areas_container,
				'dependency' => array(
					'hide' => array(
						'edgtf_disable_header_widget_areas_meta' => 'yes'
					)
				)
			)
		);
					
		$tetsuo_custom_sidebars = tetsuo_edge_get_custom_sidebars();
		if ( count( $tetsuo_custom_sidebars ) > 0 ) {
			tetsuo_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_custom_header_widget_area_one_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area One', 'tetsuo' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'tetsuo' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $tetsuo_custom_sidebars
				)
			);
		}

		if ( count( $tetsuo_custom_sidebars ) > 0 ) {
			tetsuo_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_custom_header_widget_area_two_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Header Widget Area Two', 'tetsuo' ),
					'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'tetsuo' ),
					'parent'      => $header_custom_widget_areas_container,
					'options'     => $tetsuo_custom_sidebars,
					'dependency' => array(
						'hide' => array(
							'edgtf_header_type_meta' => $hide_dep_widget_area_two
						)
					)
				)
			);
		}
		
		do_action( 'tetsuo_edge_header_widget_areas_additional_meta_boxes_map', $header_widget_areas_container );
	}
	
	add_action( 'tetsuo_edge_action_header_widget_areas_meta_boxes_map', 'tetsuo_edge_header_widget_areas_meta_options_map', 10, 1 );
}