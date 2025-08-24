<?php

if ( ! function_exists( 'tetsuo_edge_logo_meta_box_map' ) ) {
	function tetsuo_edge_logo_meta_box_map() {
		
		$logo_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'tetsuo_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'tetsuo' ),
				'name'  => 'logo_meta'
			)
		);

        tetsuo_edge_create_meta_box_field(
            array(
                'name'        => 'edgtf_logo_text_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Logo Text', 'tetsuo' ),
                'description' => esc_html__( 'If no text is set for the logo, the image will be displayed. Note: Bare in mind that the Logo Text has to be removed in General Options as well, so the image can be displayed instead of text.', 'tetsuo' ),
                'parent'      => $logo_meta_box,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        tetsuo_edge_create_meta_box_field(
            array(
                'type'          => 'text',
                'name'          => 'edgtf_logo_text_font_size_meta',
                'label'         => esc_html__( 'Text Logo Font Size', 'tetsuo' ),
                'args'          => array(
                    'col_width' => 3,
                    'suffix' => esc_html__( 'px / em', 'tetsuo' )
                ),
                'parent'        => $logo_meta_box
            )
        );
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'tetsuo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'tetsuo' ),
				'parent'      => $logo_meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'tetsuo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'tetsuo' ),
				'parent'      => $logo_meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'tetsuo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'tetsuo' ),
				'parent'      => $logo_meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'tetsuo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'tetsuo' ),
				'parent'      => $logo_meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'tetsuo' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'tetsuo' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_logo_meta_box_map', 47 );
}