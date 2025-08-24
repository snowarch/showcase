<?php

if ( ! function_exists( 'tetsuo_edge_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function tetsuo_edge_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_recent_posts_widget' );
}