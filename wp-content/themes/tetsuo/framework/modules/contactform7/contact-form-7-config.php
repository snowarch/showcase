<?php

if ( ! function_exists('tetsuo_edge_contact_form_map') ) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function tetsuo_edge_contact_form_map() {
		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'tetsuo'),
			'param_name' => 'html_class',
			'value' => array(
				esc_html__('Default', 'tetsuo') => 'default',
				esc_html__('Custom Style 1', 'tetsuo') => 'cf7_custom_style_1',
				esc_html__('Custom Style 2', 'tetsuo') => 'cf7_custom_style_2',
				esc_html__('Custom Style 3', 'tetsuo') => 'cf7_custom_style_3'
			),
			'description' => esc_html__('You can style each form element individually in Edge Options > Contact Form 7', 'tetsuo')
		));
	}
	
	add_action('vc_after_init', 'tetsuo_edge_contact_form_map');
}