<?php

if ( ! function_exists( 'tetsuo_core_add_dropcaps_shortcodes' ) ) {
	function tetsuo_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'TetsuoCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'tetsuo_core_filter_add_vc_shortcode', 'tetsuo_core_add_dropcaps_shortcodes' );
}