<?php

if (!function_exists('tetsuo_core_enqueue_scripts_for_portfolio_list_tooltip_shortcodes')) {
    /**
     * Function that includes all necessary 3rd party scripts for this shortcode
     */
    function tetsuo_core_enqueue_scripts_for_portfolio_list_tooltip_shortcodes() {
        wp_enqueue_script('bootstrap-tooltip', TETSUO_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list-tooltip/assets/js/plugins/bootstrap-tooltip.js', array('jquery'), false, true);
    }

    add_action('tetsuo_edge_action_enqueue_third_party_scripts', 'tetsuo_core_enqueue_scripts_for_portfolio_list_tooltip_shortcodes');
}

if ( ! function_exists( 'tetsuo_core_add_portfolio_list_tooltip_shortcode' ) ) {
	function tetsuo_core_add_portfolio_list_tooltip_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'TetsuoCore\CPT\Shortcodes\Portfolio\PortfolioListTooltip'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'tetsuo_core_filter_add_vc_shortcode', 'tetsuo_core_add_portfolio_list_tooltip_shortcode' );
}

if ( ! function_exists( 'tetsuo_core_set_portfolio_list_tooltip_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for portfolio list - tooltip shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function tetsuo_core_set_portfolio_list_tooltip_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-list-tooltip';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'tetsuo_core_filter_add_vc_shortcodes_custom_icon_class', 'tetsuo_core_set_portfolio_list_tooltip_icon_class_name_for_vc_shortcodes' );
}