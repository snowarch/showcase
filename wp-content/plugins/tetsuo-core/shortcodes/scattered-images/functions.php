<?php

if ( ! function_exists( 'tetsuo_core_add_scattered_images_shortcodes' ) ) {
	function tetsuo_core_add_scattered_images_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'TetsuoCore\CPT\Shortcodes\ScatteredImages\ScatteredImages'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'tetsuo_core_filter_add_vc_shortcode', 'tetsuo_core_add_scattered_images_shortcodes' );
}

if ( ! function_exists( 'tetsuo_core_set_scattered_images_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for scattered images shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function tetsuo_core_set_scattered_images_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-scattered-images';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'tetsuo_core_filter_add_vc_shortcodes_custom_icon_class', 'tetsuo_core_set_scattered_images_icon_class_name_for_vc_shortcodes' );
}