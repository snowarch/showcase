<?php

if ( ! function_exists( 'tetsuo_edge_footer_options_map' ) ) {
	function tetsuo_edge_footer_options_map() {

		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'tetsuo' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = tetsuo_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'tetsuo' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'tetsuo' ),
				'parent'        => $footer_panel
			)
		);

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'tetsuo' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'tetsuo' ),
                'parent'        => $footer_panel,
            )
        );

		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'tetsuo' ),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = tetsuo_edge_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'tetsuo' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'tetsuo' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'tetsuo' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'tetsuo' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'tetsuo' ),
					'left'   => esc_html__( 'Left', 'tetsuo' ),
					'center' => esc_html__( 'Center', 'tetsuo' ),
					'right'  => esc_html__( 'Right', 'tetsuo' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'tetsuo' ),
				'description' => esc_html__( 'Set background color for top footer area', 'tetsuo' ),
				'parent'      => $show_footer_top_container
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'tetsuo' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'tetsuo' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'tetsuo' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'tetsuo' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'tetsuo' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}

	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_footer_options_map', tetsuo_edge_set_options_map_position( 'footer' ) );
}