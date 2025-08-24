<?php

if ( ! function_exists( 'tetsuo_edge_get_subscribe_popup' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function tetsuo_edge_get_subscribe_popup() {
		
		if ( tetsuo_edge_options()->getOptionValue( 'enable_subscribe_popup' ) === 'yes' && ( tetsuo_edge_options()->getOptionValue( 'subscribe_popup_contact_form' ) !== '' || tetsuo_edge_options()->getOptionValue( 'subscribe_popup_title' ) !== '' ) ) {
			tetsuo_edge_load_subscribe_popup_template();
		}
	}
	
	//Get subscribe popup HTML
	add_action( 'tetsuo_edge_action_before_page_header', 'tetsuo_edge_get_subscribe_popup' );
}

if ( ! function_exists( 'tetsuo_edge_load_subscribe_popup_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function tetsuo_edge_load_subscribe_popup_template() {
		$parameters                       = array();
		$parameters['title']              = tetsuo_edge_options()->getOptionValue( 'subscribe_popup_title' );
		$parameters['subtitle']           = tetsuo_edge_options()->getOptionValue( 'subscribe_popup_subtitle' );
		$background_image_meta            = tetsuo_edge_options()->getOptionValue( 'subscribe_popup_background_image' );
		$parameters['background_styles']  = ! empty( $background_image_meta ) ? 'background-image: url(' . esc_url( $background_image_meta ) . ')' : '';
		$parameters['contact_form']       = tetsuo_edge_options()->getOptionValue( 'subscribe_popup_contact_form' );
		$parameters['contact_form_style'] = tetsuo_edge_options()->getOptionValue( 'subscribe_popup_contact_form_style' );
		$parameters['enable_prevent']     = tetsuo_edge_options()->getOptionValue( 'enable_subscribe_popup_prevent' );
		$parameters['prevent_behavior']   = tetsuo_edge_options()->getOptionValue( 'subscribe_popup_prevent_behavior' );
		
		$holder_classes   = array();
		$holder_classes[] = $parameters['enable_prevent'] === 'yes' ? 'edgtf-prevent-enable' : 'edgtf-prevent-disable';
		$holder_classes[] = ! empty( $parameters['prevent_behavior'] ) ? 'edgtf-prevent-' . $parameters['prevent_behavior'] : 'edgtf-prevent-session';
		$holder_classes[] = ! empty( $background_image_meta ) ? 'edgtf-sp-has-image' : '';
		
		$parameters['holder_classes'] = implode( ' ', $holder_classes );
		
		tetsuo_edge_get_module_template_part( 'templates/subscribe-popup', 'subscribe-popup', '', $parameters );
	}
}