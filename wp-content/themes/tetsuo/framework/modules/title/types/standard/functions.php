<?php

if ( ! function_exists( 'tetsuo_edge_set_title_standard_type_for_options' ) ) {
	/**
	 * This function set standard title type value for title options map and meta boxes
	 */
	function tetsuo_edge_set_title_standard_type_for_options( $type ) {
		$type['standard'] = esc_html__( 'Standard', 'tetsuo' );
		
		return $type;
	}
	
	add_filter( 'tetsuo_edge_filter_title_type_global_option', 'tetsuo_edge_set_title_standard_type_for_options' );
	add_filter( 'tetsuo_edge_filter_title_type_meta_boxes', 'tetsuo_edge_set_title_standard_type_for_options' );
}

if ( ! function_exists( 'tetsuo_edge_set_title_standard_type_as_default_options' ) ) {
	/**
	 * This function set default title type value for global title option map
	 */
	function tetsuo_edge_set_title_standard_type_as_default_options( $type ) {
		$type = 'standard';
		
		return $type;
	}
	
	add_filter( 'tetsuo_edge_filter_default_title_type_global_option', 'tetsuo_edge_set_title_standard_type_as_default_options' );
}