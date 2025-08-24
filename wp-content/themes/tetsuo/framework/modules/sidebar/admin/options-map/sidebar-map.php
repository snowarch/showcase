<?php

if ( ! function_exists( 'tetsuo_edge_sidebar_options_map' ) ) {
	function tetsuo_edge_sidebar_options_map() {
		
		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'tetsuo' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = tetsuo_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'tetsuo' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		tetsuo_edge_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'tetsuo' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'tetsuo' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => tetsuo_edge_get_custom_sidebars_options()
		) );
		
		$tetsuo_custom_sidebars = tetsuo_edge_get_custom_sidebars();
		if ( count( $tetsuo_custom_sidebars ) > 0 ) {
			tetsuo_edge_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'tetsuo' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'tetsuo' ),
				'parent'      => $sidebar_panel,
				'options'     => $tetsuo_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_sidebar_options_map', tetsuo_edge_set_options_map_position( 'sidebar' ) );
}