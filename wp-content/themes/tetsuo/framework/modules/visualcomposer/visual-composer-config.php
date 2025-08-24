<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = EDGE_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'tetsuo_edge_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function tetsuo_edge_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'tetsuo_edge_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'tetsuo_edge_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function tetsuo_edge_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Edge Row Content Width', 'tetsuo' ),
				'value'      => array(
					esc_html__( 'Full Width', 'tetsuo' ) => 'full-width',
					esc_html__( 'In Grid', 'tetsuo' )    => 'grid'
				),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Edge Anchor ID', 'tetsuo' ),
				'description' => esc_html__( 'For example "home"', 'tetsuo' ),
				'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Edge Background Color', 'tetsuo' ),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Edge Background Image', 'tetsuo' ),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Edge Background Position', 'tetsuo' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'tetsuo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Edge Disable Background Image', 'tetsuo' ),
				'value'       => array(
					esc_html__( 'Never', 'tetsuo' )        => '',
					esc_html__( 'Below 1280px', 'tetsuo' ) => '1280',
					esc_html__( 'Below 1024px', 'tetsuo' ) => '1024',
					esc_html__( 'Below 768px', 'tetsuo' )  => '768',
					esc_html__( 'Below 680px', 'tetsuo' )  => '680',
					esc_html__( 'Below 480px', 'tetsuo' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'tetsuo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Edge Parallax Background Image', 'tetsuo' ),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Edge Parallax Speed', 'tetsuo' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'tetsuo' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Edge Parallax Section Height (px)', 'tetsuo' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Edge Content Aligment', 'tetsuo' ),
				'value'      => array(
					esc_html__( 'Default', 'tetsuo' ) => '',
					esc_html__( 'Left', 'tetsuo' )    => 'left',
					esc_html__( 'Center', 'tetsuo' )  => 'center',
					esc_html__( 'Right', 'tetsuo' )   => 'right'
				),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'row_vertical_text',
                'heading'    => esc_html__( 'Edge Row Vertical Text', 'tetsuo' ),
                'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'dropdown',
                'param_name' => 'row_vertical_text_align',
                'heading'    => esc_html__( 'Edge Vertical Text Align', 'tetsuo' ),
                'value'      => array(
                    esc_html__( 'Left', 'tetsuo' )    => 'left',
                    esc_html__( 'Right', 'tetsuo' )   => 'right'
                ),
                'dependency' => array( 'element' => 'row_vertical_text', 'not_empty' => true ),
                'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'row_vertical_text_holder_left_offset',
                'heading'    => esc_html__( 'Edge Vertical Text Left Offset', 'tetsuo' ),
                'dependency' => array( 'element' => 'row_vertical_text', 'not_empty' => true ),
                'description' => esc_html__( 'Set the value of left offset in px or %', 'tetsuo' ),
                'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'colorpicker',
                'param_name' => 'row_vertical_text_color',
                'heading'    => esc_html__( 'Edge Vertical Text Color', 'tetsuo' ),
                'dependency' => array( 'element' => 'row_vertical_text', 'not_empty' => true ),
                'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
            )
        );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Edge Row Content Width', 'tetsuo' ),
				'value'      => array(
					esc_html__( 'Full Width', 'tetsuo' ) => 'full-width',
					esc_html__( 'In Grid', 'tetsuo' )    => 'grid'
				),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Edge Background Color', 'tetsuo' ),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Edge Background Image', 'tetsuo' ),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Edge Background Position', 'tetsuo' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'tetsuo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Edge Disable Background Image', 'tetsuo' ),
				'value'       => array(
					esc_html__( 'Never', 'tetsuo' )        => '',
					esc_html__( 'Below 1280px', 'tetsuo' ) => '1280',
					esc_html__( 'Below 1024px', 'tetsuo' ) => '1024',
					esc_html__( 'Below 768px', 'tetsuo' )  => '768',
					esc_html__( 'Below 680px', 'tetsuo' )  => '680',
					esc_html__( 'Below 480px', 'tetsuo' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'tetsuo' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Edge Content Aligment', 'tetsuo' ),
				'value'      => array(
					esc_html__( 'Default', 'tetsuo' ) => '',
					esc_html__( 'Left', 'tetsuo' )    => 'left',
					esc_html__( 'Center', 'tetsuo' )  => 'center',
					esc_html__( 'Right', 'tetsuo' )   => 'right'
				),
				'group'      => esc_html__( 'Edge Settings', 'tetsuo' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( tetsuo_edge_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Edge Enable Passepartout', 'tetsuo' ),
					'value'       => array_flip( tetsuo_edge_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Edge Passepartout Size', 'tetsuo' ),
					'value'       => array(
						esc_html__( 'Tiny', 'tetsuo' )   => 'tiny',
						esc_html__( 'Small', 'tetsuo' )  => 'small',
						esc_html__( 'Normal', 'tetsuo' ) => 'normal',
						esc_html__( 'Large', 'tetsuo' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Edge Disable Side Passepartout', 'tetsuo' ),
					'value'       => array_flip( tetsuo_edge_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Edge Disable Top Passepartout', 'tetsuo' ),
					'value'       => array_flip( tetsuo_edge_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Edge Settings', 'tetsuo' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'tetsuo_edge_vc_row_map' );
}