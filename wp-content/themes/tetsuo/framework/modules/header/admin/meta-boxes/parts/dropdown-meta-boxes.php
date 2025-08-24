<?php

if ( ! function_exists( 'tetsuo_edge_get_hide_dep_for_dropdown_meta_boxes' ) ) {
	function tetsuo_edge_get_hide_dep_for_dropdown_meta_boxes() {
		$hide_dep_options = apply_filters( 'tetsuo_edge_filter_dropdown_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'tetsuo_edge_dropdown_meta_options_map' ) ) {
	function tetsuo_edge_dropdown_meta_options_map( $header_meta_box ) {
		$hide_dep_widgets 			= tetsuo_edge_get_hide_dep_for_dropdown_meta_boxes();

		$dropdown_container = tetsuo_edge_add_admin_container_no_style(
			array(
				'type'       => 'container',
				'name'       => 'dropdown_container',
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
				'parent' => $dropdown_container,
				'name'   => 'dropdown_styles',
				'title'  => esc_html__( 'Dropdown Styles', 'tetsuo' )
			)
		);


		tetsuo_edge_create_meta_box_field(
			array(
				'parent'        => $dropdown_container,
				'type'          => 'text',
				'name'          => 'edgtf_dropdown_top_position_meta',
				'label'         => esc_html__( 'Dropdown Position', 'tetsuo' ),
				'description'   => esc_html__( 'Enter value in percentage of entire header height', 'tetsuo' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => '%'
				)
			)
		);

        tetsuo_edge_create_meta_box_field(
            array(
                'name'          => 'edgtf_wide_dropdown_menu_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Wide Dropdown Menu In Grid', 'tetsuo' ),
                'description'   => esc_html__( 'Set wide dropdown menu to be in grid', 'tetsuo' ),
                'parent'        => $dropdown_container,
                'default_value' => '',
                'options'       => tetsuo_edge_get_yes_no_select_array()
            )
        );

        $wide_dropdown_menu_in_grid_container = tetsuo_edge_add_admin_container(
            array(
                'type'            => 'container',
                'name'            => 'wide_dropdown_menu_in_grid_container',
                'parent'          => $dropdown_container,
                'dependency' => array(
                    'show' => array(
                        'edgtf_wide_dropdown_menu_in_grid_meta'  => 'no'
                    )
                )
            )
        );

        tetsuo_edge_create_meta_box_field(
            array(
                'name'        => 'edgtf_wide_dropdown_menu_content_in_grid_meta',
                'type'          => 'select',
                'label'       => esc_html__( 'Wide Dropdown Menu Content In Grid', 'tetsuo' ),
                'description' => esc_html__( 'Set wide dropdown menu content to be in grid', 'tetsuo' ),
                'parent'      => $wide_dropdown_menu_in_grid_container,
                'default_value' => '',
                'options'       => tetsuo_edge_get_yes_no_select_array()
            )
        );
			
	
		
		do_action( 'tetsuo_edge_dropdown_additional_meta_boxes_map', $dropdown_container );
	}
	
	add_action( 'tetsuo_edge_action_dropdown_meta_boxes_map', 'tetsuo_edge_dropdown_meta_options_map', 10, 1 );
}