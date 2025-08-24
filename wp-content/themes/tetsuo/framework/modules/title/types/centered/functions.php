<?php

if ( ! function_exists( 'tetsuo_edge_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function tetsuo_edge_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'tetsuo' );
		
		return $type;
	}
	
	add_filter( 'tetsuo_edge_filter_title_type_global_option', 'tetsuo_edge_set_title_centered_type_for_options' );
	add_filter( 'tetsuo_edge_filter_title_type_meta_boxes', 'tetsuo_edge_set_title_centered_type_for_options' );
}