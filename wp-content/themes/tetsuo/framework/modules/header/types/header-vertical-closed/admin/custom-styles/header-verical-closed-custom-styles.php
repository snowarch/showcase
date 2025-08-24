<?php

if ( ! function_exists( 'tetsuo_edge_vertical_closed_icon_styles' ) ) {
	function tetsuo_edge_vertical_closed_icon_styles() {
		$icon_color       = tetsuo_edge_options()->getOptionValue( 'vertical_closed_icon_color' );
		$icon_hover_color = tetsuo_edge_options()->getOptionValue( 'vertical_closed_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.edgtf-vertical-area-opener:hover'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo tetsuo_edge_dynamic_css( '.edgtf-vertical-area-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo tetsuo_edge_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			) );
		}
	}
	
	add_action( 'tetsuo_edge_action_style_dynamic', 'tetsuo_edge_vertical_closed_icon_styles' );
}