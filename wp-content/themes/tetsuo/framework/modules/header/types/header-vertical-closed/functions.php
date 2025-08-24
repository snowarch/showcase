<?php

if ( ! function_exists( 'tetsuo_edge_register_header_vertical_closed_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function tetsuo_edge_register_header_vertical_closed_type( $header_types ) {
		$header_type = array(
			'header-vertical-closed' => 'TetsuoEdgeNamespace\Modules\Header\Types\HeaderVerticalClosed'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'tetsuo_edge_init_register_header_vertical_closed_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function tetsuo_edge_init_register_header_vertical_closed_type() {
		add_filter( 'tetsuo_edge_filter_register_header_type_class', 'tetsuo_edge_register_header_vertical_closed_type' );
	}
	
	add_action( 'tetsuo_edge_action_before_header_function_init', 'tetsuo_edge_init_register_header_vertical_closed_type' );
}

if ( ! function_exists( 'tetsuo_edge_include_header_vertical_closed_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function tetsuo_edge_include_header_vertical_closed_menu( $menus ) {
		if ( ! array_key_exists( 'vertical-navigation', $menus ) ) {
			$menus['vertical-navigation'] = esc_html__( 'Vertical Navigation', 'tetsuo' );
		}
		
		return $menus;
	}
	
	if ( tetsuo_edge_check_is_header_type_enabled( 'header-vertical-closed' ) ) {
		add_filter( 'tetsuo_edge_filter_register_headers_menu', 'tetsuo_edge_include_header_vertical_closed_menu' );
	}
}

if ( ! function_exists( 'tetsuo_edge_get_header_vertical_closed_main_menu' ) ) {
	/**
	 * Loads vertical menu HTML
	 */
	function tetsuo_edge_get_header_vertical_closed_main_menu() {
		tetsuo_edge_get_module_template_part( 'templates/vertical-closed-navigation', 'header/types/header-vertical-closed' );
	}
}

if ( ! function_exists( 'tetsuo_edge_vertical_closed_header_holder_class' ) ) {
	/**
	 * Return holder class for this header type html
	 */
	function tetsuo_edge_vertical_closed_header_holder_class() {
		$center_content = tetsuo_edge_get_meta_field_intersect( 'vertical_header_center_content', tetsuo_edge_get_page_id() );
		$holder_class   = $center_content === 'yes' ? 'edgtf-vertical-alignment-center' : 'edgtf-vertical-alignment-top';
		
		return $holder_class;
	}
}

if ( ! function_exists( 'tetsuo_edge_get_vertical_closed_header_icon_class' ) ) {
	/**
	 * Loads vertical closed icon class
	 */
	function tetsuo_edge_get_vertical_closed_header_icon_class() {
		$classes = array(
			'edgtf-vertical-area-opener'
		);
		
		$classes[] = tetsuo_edge_get_icon_sources_class( 'vertical_closed', 'edgtf-vertical-area-opener' );

		return $classes;
	}
}