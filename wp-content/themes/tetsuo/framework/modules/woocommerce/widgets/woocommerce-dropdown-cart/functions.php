<?php

if ( ! function_exists( 'tetsuo_edge_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function tetsuo_edge_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'TetsuoEdgeClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'tetsuo_edge_filter_register_widgets', 'tetsuo_edge_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'tetsuo_edge_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function tetsuo_edge_get_dropdown_cart_icon_class() {
		$classes = array(
			'edgtf-header-cart'
		);
		
		$classes[] = tetsuo_edge_get_icon_sources_class( 'dropdown_cart', 'edgtf-header-cart' );
		
		return $classes;
	}
}