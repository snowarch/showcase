<?php

if ( ! function_exists('tetsuo_edge_website_song_options_map') ) {

	function tetsuo_edge_website_song_options_map() {

		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '_website_song_page',
				'title' => esc_html__('Website Song', 'tetsuo'),
				'icon'  => 'fa fa-play-circle'
			)
		);

		/**
		 * Enable Website Song
		 */
		$panel_website_song = tetsuo_edge_add_admin_panel(array(
			'page'  => '_website_song_page',
			'name'  => 'panel_website_song',
			'title' => esc_html__('Enable Song on Load', 'tetsuo')
		));

		tetsuo_edge_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_website_song',
			'default_value'	=> 'no',
			'label'			=> esc_html__('Enable Audio Button', 'tetsuo'),
			'parent'		=> $panel_website_song
		));

		$panel_song_on_load = tetsuo_edge_add_admin_panel(array(
			'page'  			=> '_website_song_page',
			'name'  			=> 'enable_website_song',
			'title' 			=> esc_html__('Website Song', 'tetsuo'),
		));

		tetsuo_edge_add_admin_field(array(
			'type'			=> 'file',
			'name'			=> 'song_source',
			'default_value'	=> '',
			'label'			=> esc_html__('Audio File', 'tetsuo'),
			'parent'		=> $panel_song_on_load,
			'label'			=> esc_html__('Song file source', 'tetsuo'),
		));
	}

	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_website_song_options_map');
}