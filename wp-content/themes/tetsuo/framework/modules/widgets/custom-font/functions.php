<?php

if ( ! function_exists( 'tetsuo_edge_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function tetsuo_edge_register_custom_font_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_custom_font_widget' );
}