<?php

if ( ! function_exists( 'tetsuo_edge_map_general_meta' ) ) {
	function tetsuo_edge_map_general_meta() {
		
		$general_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'tetsuo_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'tetsuo' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'tetsuo' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'tetsuo' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'tetsuo' ),
				'parent'        => $general_meta_box
			)
		);
		
		$edgtf_content_padding_group = tetsuo_edge_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'tetsuo' ),
				'description' => esc_html__( 'Define styles for Content area', 'tetsuo' ),
				'parent'      => $general_meta_box
			)
		);
		
			$edgtf_content_padding_row = tetsuo_edge_add_admin_row(
				array(
					'name'   => 'edgtf_content_padding_row',
					'parent' => $edgtf_content_padding_group
				)
			);
			
				tetsuo_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'tetsuo' ),
						'parent'      => $edgtf_content_padding_row
					)
				);
				
				tetsuo_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'tetsuo' ),
						'parent'        => $edgtf_content_padding_row
					)
				);
				
				tetsuo_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'tetsuo' ),
						'options'       => tetsuo_edge_get_yes_no_select_array(),
						'parent'        => $edgtf_content_padding_row
					)
				);
		
			$edgtf_content_padding_row_1 = tetsuo_edge_add_admin_row(
				array(
					'name'   => 'edgtf_content_padding_row_1',
					'next'   => true,
					'parent' => $edgtf_content_padding_group
				)
			);
		
				tetsuo_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'tetsuo' ),
						'parent' => $edgtf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				tetsuo_edge_create_meta_box_field(
					array(
						'name'    => 'edgtf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'tetsuo' ),
						'parent'  => $edgtf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'tetsuo' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'tetsuo' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'tetsuo' ),
					'edgtf-grid-1300' => esc_html__( '1300px', 'tetsuo' ),
					'edgtf-grid-1200' => esc_html__( '1200px', 'tetsuo' ),
					'edgtf-grid-1100' => esc_html__( '1100px', 'tetsuo' ),
					'edgtf-grid-1000' => esc_html__( '1000px', 'tetsuo' ),
					'edgtf-grid-800'  => esc_html__( '800px', 'tetsuo' )
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'tetsuo' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'tetsuo' ),
				'options'     => tetsuo_edge_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);

        tetsuo_edge_create_meta_box_field(
            array(
                'name'          => 'edgtf_content_grid_lines_meta',
                'type'          => 'select',
                'label'         => esc_html__('Grid Lines in Page Background', 'tetsuo'),
                'description'   => esc_html__('If you would like to enable a set of lines in the page background, choose how many lines you would like to display. The lines will be placed on the page grid.', 'tetsuo'),
                'parent'        => $general_meta_box,
                'options'       => array(
                    "" => "",
                    "none" => esc_html__("None", 'tetsuo'),
                    "2" => "3 lines",
                    "3" => "4 lines",
                    "4" => "5 lines",
                    "5" => "6 lines",
                    "6" => "7 lines"
                ),
            )
        );

        $lines_container_meta = tetsuo_edge_add_admin_container(
            array(
                'parent'          => $general_meta_box,
                'name'            => 'lines_container_meta',
                'dependency' => array(
                    'hide' => array(
                        'edgtf_content_grid_lines_meta'  => array('','none'),
                    )
                )
            )
        );

        tetsuo_edge_create_meta_box_field(
            array(
                'name'          => 'edgtf_content_grid_lines_skin_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Grid Lines Skin', 'tetsuo' ),
                'description'   => esc_html__( 'Choose skin for background grid lines', 'tetsuo' ),
                'parent'        => $lines_container_meta,
                'options'       => array(
                    ''      => '',
                    'light'  => esc_html__( 'Light', 'tetsuo' ),
                    'dark' => esc_html__( 'Dark', 'tetsuo' )
                )
            )
        );
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'    => 'edgtf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'tetsuo' ),
				'parent'  => $general_meta_box,
				'options' => tetsuo_edge_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = tetsuo_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				tetsuo_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'tetsuo' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'tetsuo' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				tetsuo_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'tetsuo' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'tetsuo' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				tetsuo_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'tetsuo' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'tetsuo' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				tetsuo_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'tetsuo' ),
						'description'   => esc_html__( 'Choose background image attachment', 'tetsuo' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'tetsuo' ),
							'fixed'  => esc_html__( 'Fixed', 'tetsuo' ),
							'scroll' => esc_html__( 'Scroll', 'tetsuo' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/

        /***************** Fixed Video Background - start **********************/

        tetsuo_edge_create_meta_box_field(
            array(
                'name' => 'edgtf_show_fixed_video_background_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Fixed Video Background', 'tetsuo'),
                'description' => esc_html__('Enable this option to show fixed video background on this page/post.', 'tetsuo'),
                'parent' => $general_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'tetsuo'),
                    'yes' => esc_html__('Yes', 'tetsuo'),
                    'no' => esc_html__('No', 'tetsuo'),
                )
            )
        );

        $show_fixed_video_background_meta_container = tetsuo_edge_add_admin_container(
            array(
                'parent' => $general_meta_box,
                'name' => 'edgtf_show_fixed_video_background_meta_container',
                'dependency' => array(
                    'hide' => array(
                        'edgtf_show_fixed_video_background_meta'  => array('','no')
                    )
                )
            )
        );

        tetsuo_edge_create_meta_box_field(
            array(
                'name' => 'edgtf_fixed_video_background_url_meta',
                'type' => 'text',
                'label' => esc_html__('Video MP4', 'tetsuo'),
                'description' => esc_html__('Enter video URL for MP4 format', 'tetsuo'),
                'parent' => $show_fixed_video_background_meta_container
            )
        );

        tetsuo_edge_create_meta_box_field(
            array(
                'name' => 'edgtf_shader_color_over_fixed_video_background_meta',
                'type' => 'color',
                'label' => esc_html__('Overlay Shader Color', 'tetsuo'),
                'description' => esc_html__('Choose the shader color over video.', 'tetsuo'),
                'parent' => $show_fixed_video_background_meta_container
            )
        );

        tetsuo_edge_create_meta_box_field(
            array(
                'name' => 'edgtf_shader_over_fixed_video_background_opacity_meta',
                'type' => 'text',
                'label' => esc_html__('Overlay Shader Opacity', 'tetsuo'),
                'description' => esc_html__('Choose a transparency for the fixed video background shader color (0 = fully transparent, 1 = opaque)', 'tetsuo'),
                'parent' => $show_fixed_video_background_meta_container,
                'args' => array(
                    'col_width' => 2,
                )
            )
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'parent' => $general_meta_box,
                'label' => esc_html__('Animate Overlay On Scroll', 'tetsuo'),
				'name' => 'edgtf_animate_overlay_meta',
				'type' => 'select',
                'default_value' => '',
                'dependency' => array(
                    'hide' => array(
                        'edgtf_shader_color_over_fixed_video_background_meta'  => array('')
                    )
				),
				'options' => array(
					'' => esc_html__('Default', 'tetsuo'),
					'yes' => esc_html__('Yes', 'tetsuo'),
					'no' => esc_html__('No', 'tetsuo'),
				)
            )
		);

        tetsuo_edge_create_meta_box_field(
            array(
                'name' => 'edgtf_fixed_video_background_fallback_image_meta',
                'type' => 'image',
                'label' => esc_html__('Video Image', 'tetsuo'),
                'description' => esc_html__('Upload video image', 'tetsuo'),
                'parent' => $show_fixed_video_background_meta_container
            )
        );

        /***************** Fixed Video Background - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'tetsuo' ),
				'parent'        => $general_meta_box,
				'options'       => tetsuo_edge_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = tetsuo_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'edgtf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				tetsuo_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'tetsuo' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'tetsuo' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				tetsuo_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'tetsuo' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'tetsuo' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				tetsuo_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'tetsuo' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'tetsuo' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				tetsuo_edge_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'tetsuo' ),
						'options'       => tetsuo_edge_get_yes_no_select_array(),
					)
				);
		
				tetsuo_edge_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'tetsuo' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'tetsuo' ),
						'options'       => tetsuo_edge_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Enable Website Song - begin **********************/

		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_enable_website_song_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Audio Button on Page', 'tetsuo' ),
				'parent'        => $general_meta_box,
				'options'       => tetsuo_edge_get_yes_no_select_array(),
			)
		);

		/***************** Enable Website Song - end **********************/

		/***************** Smooth Page Transitions Layout - begin **********************/
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'tetsuo' ),
				'parent'        => $general_meta_box,
				'options'       => tetsuo_edge_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = tetsuo_edge_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				tetsuo_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'tetsuo' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'tetsuo' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => tetsuo_edge_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = tetsuo_edge_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'edgtf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					tetsuo_edge_create_meta_box_field(
						array(
							'name'   => 'edgtf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'tetsuo' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = tetsuo_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'tetsuo' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'tetsuo' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = tetsuo_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					tetsuo_edge_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'edgtf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'tetsuo' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'tetsuo' ),
								'tetsuo_spinner'        => esc_html__( 'Tetsuo Spinner', 'tetsuo' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'tetsuo' ),
								'pulse'                 => esc_html__( 'Pulse', 'tetsuo' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'tetsuo' ),
								'cube'                  => esc_html__( 'Cube', 'tetsuo' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'tetsuo' ),
								'stripes'               => esc_html__( 'Stripes', 'tetsuo' ),
								'wave'                  => esc_html__( 'Wave', 'tetsuo' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'tetsuo' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'tetsuo' ),
								'atom'                  => esc_html__( 'Atom', 'tetsuo' ),
								'clock'                 => esc_html__( 'Clock', 'tetsuo' ),
								'mitosis'               => esc_html__( 'Mitosis', 'tetsuo' ),
								'lines'                 => esc_html__( 'Lines', 'tetsuo' ),
								'fussion'               => esc_html__( 'Fussion', 'tetsuo' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'tetsuo' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'tetsuo' )
							)
						)
					);
					
					tetsuo_edge_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'edgtf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'tetsuo' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);

					tetsuo_edge_create_meta_box_field(
						array(
							'type'         => 'image',
							'name'          => 'edgtf_smooth_pt_spinner_image_meta',
							'label'         => esc_html__( 'Preloader Image', 'tetsuo' ),
							'parent'        => $row_pt_spinner_animation_meta,
							'dependency' => array(
								'show' => array(
									'edgtf_smooth_pt_spinner_type_meta' => 'tetsuo_spinner'
								)
							)
						)
					);
					
					tetsuo_edge_create_meta_box_field(
						array(
							'name'        => 'edgtf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'tetsuo' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'tetsuo' ),
							'options'     => tetsuo_edge_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'tetsuo' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'tetsuo' ),
				'parent'      => $general_meta_box,
				'options'     => tetsuo_edge_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_map_general_meta', 10 );
}

if ( ! function_exists( 'tetsuo_edge_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function tetsuo_edge_container_background_style( $style ) {
		$page_id      = tetsuo_edge_get_page_id();
		$class_prefix = tetsuo_edge_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .edgtf-wrapper .edgtf-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'edgtf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'edgtf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'edgtf_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = tetsuo_edge_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'tetsuo_edge_filter_add_page_custom_style', 'tetsuo_edge_container_background_style' );
}