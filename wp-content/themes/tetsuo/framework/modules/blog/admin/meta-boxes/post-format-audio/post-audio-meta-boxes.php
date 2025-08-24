<?php

if ( ! function_exists( 'tetsuo_edge_map_post_audio_meta' ) ) {
	function tetsuo_edge_map_post_audio_meta() {
		$audio_post_format_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'tetsuo' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'tetsuo' ),
				'description'   => esc_html__( 'Choose audio type', 'tetsuo' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'tetsuo' ),
					'self'            => esc_html__( 'Self Hosted', 'tetsuo' )
				)
			)
		);
		
		$edgtf_audio_embedded_container = tetsuo_edge_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'edgtf_audio_embedded_container'
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'tetsuo' ),
				'description' => esc_html__( 'Enter audio URL', 'tetsuo' ),
				'parent'      => $edgtf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'tetsuo' ),
				'description' => esc_html__( 'Enter audio link', 'tetsuo' ),
				'parent'      => $edgtf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_map_post_audio_meta', 23 );
}