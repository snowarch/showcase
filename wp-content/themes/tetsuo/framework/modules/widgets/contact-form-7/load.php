<?php

if ( tetsuo_edge_contact_form_7_installed() ) {
	include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_cf7_widget' );
}

if ( ! function_exists( 'tetsuo_edge_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function tetsuo_edge_register_cf7_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassContactForm7Widget';
		
		return $widgets;
	}
}