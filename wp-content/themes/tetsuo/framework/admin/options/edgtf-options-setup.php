<?php

if ( ! function_exists( 'tetsuo_edge_admin_map_init' ) ) {
	function tetsuo_edge_admin_map_init() {
		do_action( 'tetsuo_edge_action_before_options_map' );
		
		foreach ( glob( EDGE_FRAMEWORK_ROOT_DIR . '/admin/options/*/*.php' ) as $module_load ) {
			include_once $module_load;
		}
		
		do_action( 'tetsuo_edge_action_options_map' );
		
		do_action( 'tetsuo_edge_action_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'tetsuo_edge_admin_map_init', 1 );
}