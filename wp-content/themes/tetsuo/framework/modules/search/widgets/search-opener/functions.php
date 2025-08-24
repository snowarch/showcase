<?php

if ( ! function_exists( 'tetsuo_edge_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function tetsuo_edge_register_search_opener_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_search_opener_widget' );
}