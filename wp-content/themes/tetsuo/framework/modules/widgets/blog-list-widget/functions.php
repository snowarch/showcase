<?php

if ( ! function_exists( 'tetsuo_edge_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function tetsuo_edge_register_blog_list_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_blog_list_widget' );
}