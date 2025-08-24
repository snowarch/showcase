<?php

/*** Child Theme Function  ***/

if ( !function_exists( 'tetsuo_edge_child_theme_enqueue_scripts' ) ) {
	function tetsuo_edge_child_theme_enqueue_scripts() {
		$parent_style = 'tetsuo-edge-default-style';
		
		wp_enqueue_style( 'tetsuo-edge-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'tetsuo_edge_child_theme_enqueue_scripts' );
}