<?php

if ( ! function_exists( 'tetsuo_edge_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function tetsuo_edge_reset_options_map() {
		
		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'tetsuo' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = tetsuo_edge_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'tetsuo' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'tetsuo' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_reset_options_map', tetsuo_edge_set_options_map_position( 'reset' ) );
}