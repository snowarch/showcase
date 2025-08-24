<?php

if ( ! function_exists( 'tetsuo_core_include_reviews_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function tetsuo_core_include_reviews_shortcodes_files() {
		foreach ( glob( TETSUO_CORE_ABS_PATH . '/reviews/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'tetsuo_core_action_include_shortcodes_file', 'tetsuo_core_include_reviews_shortcodes_files' );
}