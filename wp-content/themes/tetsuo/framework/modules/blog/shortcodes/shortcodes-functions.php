<?php

if ( ! function_exists( 'tetsuo_edge_include_blog_shortcodes' ) ) {
	function tetsuo_edge_include_blog_shortcodes() {
		foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( tetsuo_edge_core_plugin_installed() ) {
		add_action( 'tetsuo_core_action_include_shortcodes_file', 'tetsuo_edge_include_blog_shortcodes' );
	}
}
