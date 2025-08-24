<?php

if ( ! function_exists( 'tetsuo_core_enqueue_scripts_for_uncovering_sections_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function tetsuo_core_enqueue_scripts_for_uncovering_sections_shortcodes() {
		wp_enqueue_script( 'curtain', TETSUO_CORE_SHORTCODES_URL_PATH . '/uncovering-sections/assets/js/plugins/curtain.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'tetsuo_edge_action_enqueue_third_party_scripts', 'tetsuo_core_enqueue_scripts_for_uncovering_sections_shortcodes' );
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edgtf_Uncovering_Sections extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Edgtf_Uncovering_Sections_Item extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'tetsuo_core_add_uncovering_sections_shortcodes' ) ) {
	function tetsuo_core_add_uncovering_sections_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'TetsuoCore\CPT\Shortcodes\UncoveringSections\UncoveringSections',
			'TetsuoCore\CPT\Shortcodes\UncoveringSections\UncoveringSectionsItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'tetsuo_core_filter_add_vc_shortcode', 'tetsuo_core_add_uncovering_sections_shortcodes' );
}

if ( ! function_exists( 'tetsuo_core_set_uncovering_sections_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for full screen sections holder shortcode
	 */
	function tetsuo_core_set_uncovering_sections_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.vc_shortcodes_container.wpb_edgtf_uncovering_sections_item { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'tetsuo_core_filter_add_vc_shortcodes_custom_style', 'tetsuo_core_set_uncovering_sections_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'tetsuo_core_set_uncovering_sections_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for full screen sections holder shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function tetsuo_core_set_uncovering_sections_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-uncovering-sections';
		$shortcodes_icon_class_array[] = '.icon-wpb-uncovering-sections-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'tetsuo_core_filter_add_vc_shortcodes_custom_icon_class', 'tetsuo_core_set_uncovering_sections_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'tetsuo_core_set_uncovering_sections_header_top_custom_styles' ) ) {
    /**
     * Function that set custom icon class name for full screen sections holder shortcode to set our icon for Visual Composer shortcodes panel
     */
    function tetsuo_core_set_uncovering_sections_header_top_custom_styles() {
        $top_header_height = tetsuo_edge_options()->getOptionValue( 'top_bar_height' );

        if ( ! empty( $top_header_height ) ) {
            echo tetsuo_edge_dynamic_css( '.edgtf-uncovering-section-on-page:not(.edgtf-header-bottom).edgtf-header-top-enabled .edgtf-top-bar', array( 'top' => '-' . tetsuo_edge_filter_px( $top_header_height ) . 'px' ) );
            echo tetsuo_edge_dynamic_css( '.edgtf-uncovering-section-on-page:not(.edgtf-header-bottom).edgtf-header-top-enabled:not(.edgtf-sticky-header-appear) .edgtf-page-header', array( 'top' => tetsuo_edge_filter_px( $top_header_height ) . 'px' ) );
        }
    }

    add_action( 'tetsuo_edge_action_style_dynamic', 'tetsuo_core_set_uncovering_sections_header_top_custom_styles' );
}