<?php

if ( ! function_exists( 'tetsuo_edge_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function tetsuo_edge_register_social_icons_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_social_icons_widget' );
}