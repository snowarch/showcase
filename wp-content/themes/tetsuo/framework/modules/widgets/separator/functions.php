<?php

if ( ! function_exists( 'tetsuo_edge_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function tetsuo_edge_register_separator_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_separator_widget' );
}