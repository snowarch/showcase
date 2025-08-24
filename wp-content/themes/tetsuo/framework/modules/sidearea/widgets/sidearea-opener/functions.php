<?php

if ( ! function_exists( 'tetsuo_edge_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function tetsuo_edge_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_sidearea_opener_widget' );
}