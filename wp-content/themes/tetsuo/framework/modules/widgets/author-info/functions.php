<?php

if ( ! function_exists( 'tetsuo_edge_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function tetsuo_edge_register_author_info_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_author_info_widget' );
}