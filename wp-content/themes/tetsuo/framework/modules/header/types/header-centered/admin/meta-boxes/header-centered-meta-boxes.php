<?php

if ( ! function_exists( 'tetsuo_edge_get_hide_dep_for_header_centered_meta_boxes' ) ) {
	function tetsuo_edge_get_hide_dep_for_header_centered_meta_boxes() {
		$hide_dep_options = apply_filters( 'tetsuo_edge_filter_header_centered_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'tetsuo_edge_header_centered_meta_map' ) ) {
	function tetsuo_edge_header_centered_meta_map( $parent ) {
		$hide_dep_options = tetsuo_edge_get_hide_dep_for_header_centered_meta_boxes();
		
		tetsuo_edge_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'edgtf_logo_wrapper_padding_header_centered_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'tetsuo' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'tetsuo' ),
				'args'            => array(
					'col_width' => 3
				),
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_header_logo_area_additional_meta_boxes_map', 'tetsuo_edge_header_centered_meta_map', 10, 1 );
}

if ( ! function_exists( 'tetsuo_edge_header_centered_menu_area_meta_map' ) ) {
    function tetsuo_edge_header_centered_menu_area_meta_map( $parent ) {
        $hide_dep_options = tetsuo_edge_get_hide_dep_for_header_centered_meta_boxes();

        tetsuo_edge_create_meta_box_field(
            array(
                'name'          => 'edgtf_menu_area_inner_border_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Menu Area Inner Border', 'tetsuo' ),
                'description'   => esc_html__( 'Set border on inner menu area', 'tetsuo' ),
                'parent'        => $parent,
                'default_value' => '',
                'options'       => tetsuo_edge_get_yes_no_select_array(),
                'args'            => array(
                    'col_width' => 3
                ),
                'dependency' => array(
                    'hide' => array(
                        'edgtf_header_type_meta'  => $hide_dep_options
                    )
                )
            )
        );

        $menu_area_inner_border_bottom_color_container = tetsuo_edge_add_admin_container(
            array(
                'type'            => 'container',
                'name'            => 'menu_area_inner_border_bottom_color_container',
                'parent'          => $parent,
                'dependency' => array(
                    'show' => array(
                        'edgtf_menu_area_inner_border_meta'  => 'yes'
                    )
                )
            )
        );

        tetsuo_edge_create_meta_box_field(
            array(
                'name'        => 'edgtf_menu_area_inner_border_color_meta',
                'type'        => 'color',
                'label'       => esc_html__( 'Border Color', 'tetsuo' ),
                'description' => esc_html__( 'Choose color of menu area inner bottom border', 'tetsuo' ),
                'parent'      => $menu_area_inner_border_bottom_color_container,
                'args'            => array(
                    'col_width' => 3
                ),
                'dependency' => array(
                    'hide' => array(
                        'edgtf_header_type_meta'  => $hide_dep_options
                    )
                )
            )
        );
    }

    add_action( 'tetsuo_edge_header_menu_area_additional_meta_boxes_map', 'tetsuo_edge_header_centered_menu_area_meta_map', 10, 1 );
}