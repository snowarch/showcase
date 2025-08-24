<?php

if ( ! function_exists( 'tetsuo_edge_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function tetsuo_edge_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'tetsuo' );
		
		return $templates;
	}
	
	add_filter( 'tetsuo_edge_filter_register_blog_templates', 'tetsuo_edge_register_blog_standard_template_file' );
}

if ( ! function_exists( 'tetsuo_edge_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function tetsuo_edge_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'tetsuo' );
		
		return $options;
	}
	
	add_filter( 'tetsuo_edge_filter_blog_list_type_global_option', 'tetsuo_edge_set_blog_standard_type_global_option' );
}