<?php

if ( ! function_exists( 'tetsuo_edge_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function tetsuo_edge_register_icon_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_icon_widget' );
}