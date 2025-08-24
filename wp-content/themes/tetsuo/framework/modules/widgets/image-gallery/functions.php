<?php

if ( ! function_exists( 'tetsuo_edge_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function tetsuo_edge_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_image_gallery_widget' );
}