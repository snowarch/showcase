<?php

if ( ! function_exists( 'tetsuo_edge_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function tetsuo_edge_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_sticky_sidebar_widget' );
}