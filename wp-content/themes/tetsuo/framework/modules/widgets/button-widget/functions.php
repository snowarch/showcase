<?php

if ( ! function_exists( 'tetsuo_edge_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function tetsuo_edge_register_button_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_button_widget' );
}