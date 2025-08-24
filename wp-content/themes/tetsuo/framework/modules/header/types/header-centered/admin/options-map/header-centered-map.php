<?php

if ( ! function_exists( 'tetsuo_edge_get_hide_dep_for_header_centered_options' ) ) {
	function tetsuo_edge_get_hide_dep_for_header_centered_options() {
		$hide_dep_options = apply_filters( 'tetsuo_edge_filter_header_centered_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'tetsuo_edge_header_centered_map' ) ) {
	function tetsuo_edge_header_centered_map( $parent ) {
		$hide_dep_options = tetsuo_edge_get_hide_dep_for_header_centered_options();
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'logo_wrapper_padding_header_centered',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'tetsuo' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'tetsuo' ),
				'args'            => array(
					'col_width' => 3
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_header_logo_area_additional_options', 'tetsuo_edge_header_centered_map' );
}

if ( ! function_exists( 'tetsuo_edge_header_centered_menu_area_map' ) ) {
    function tetsuo_edge_header_centered_menu_area_map( $parent ) {
        $hide_dep_options = tetsuo_edge_get_hide_dep_for_header_centered_options();

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'menu_area_inner_border',
                'default_value' => 'no',
                'label'         => esc_html__( 'Menu Area Inner Border', 'tetsuo' ),
                'description'   => esc_html__( 'Set border on inner menu area', 'tetsuo' ),
                'parent'        => $parent,
                'dependency' => array(
                    'hide' => array(
                        'header_options'  => $hide_dep_options
                    )
                )
            )
        );

        $menu_area_inner_border_container = tetsuo_edge_add_admin_container(
            array(
                'parent'          => $parent,
                'name'            => 'menu_area_inner_border_container',
                'dependency' => array(
                    'hide' => array(
                        'menu_area_inner_border'  => 'no'
                    )
                )
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'        => 'color',
                'name'        => 'menu_area_inner_border_color',
                'label'       => esc_html__( 'Border Color', 'tetsuo' ),
                'description' => esc_html__( 'Set border color for inner menu area', 'tetsuo' ),
                'parent'      => $menu_area_inner_border_container,
                'dependency' => array(
                    'hide' => array(
                        'header_options'  => $hide_dep_options
                    )
                )
            )
        );
    }

    add_action( 'tetsuo_edge_header_menu_area_additional_options', 'tetsuo_edge_header_centered_menu_area_map' );
}