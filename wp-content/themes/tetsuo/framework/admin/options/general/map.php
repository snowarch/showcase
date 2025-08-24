<?php

if ( ! function_exists( 'tetsuo_edge_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function tetsuo_edge_general_options_map() {
		
		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'tetsuo' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = tetsuo_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'tetsuo' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'tetsuo' ),
				'parent'        => $panel_design_style
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'tetsuo' ),
				'parent'        => $panel_design_style
			)
		);
		
		$additional_google_fonts_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'tetsuo' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'tetsuo' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'tetsuo' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'tetsuo' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'tetsuo' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'tetsuo' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'tetsuo' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'tetsuo' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'tetsuo' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'tetsuo' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'tetsuo' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'tetsuo' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'tetsuo' ),
					'100i' => esc_html__( '100 Thin Italic', 'tetsuo' ),
					'200'  => esc_html__( '200 Extra-Light', 'tetsuo' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'tetsuo' ),
					'300'  => esc_html__( '300 Light', 'tetsuo' ),
					'300i' => esc_html__( '300 Light Italic', 'tetsuo' ),
					'400'  => esc_html__( '400 Regular', 'tetsuo' ),
					'400i' => esc_html__( '400 Regular Italic', 'tetsuo' ),
					'500'  => esc_html__( '500 Medium', 'tetsuo' ),
					'500i' => esc_html__( '500 Medium Italic', 'tetsuo' ),
					'600'  => esc_html__( '600 Semi-Bold', 'tetsuo' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'tetsuo' ),
					'700'  => esc_html__( '700 Bold', 'tetsuo' ),
					'700i' => esc_html__( '700 Bold Italic', 'tetsuo' ),
					'800'  => esc_html__( '800 Extra-Bold', 'tetsuo' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'tetsuo' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'tetsuo' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'tetsuo' )
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'tetsuo' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'tetsuo' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'tetsuo' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'tetsuo' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'tetsuo' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'tetsuo' ),
					'greek'        => esc_html__( 'Greek', 'tetsuo' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'tetsuo' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'tetsuo' )
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'tetsuo' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is ##ec4e00', 'tetsuo' ),
				'parent'      => $panel_design_style
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'tetsuo' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #111111', 'tetsuo' ),
				'parent'      => $panel_design_style
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'tetsuo' ),
				'description' => esc_html__( 'Choose the background image for page content', 'tetsuo' ),
				'parent'      => $panel_design_style
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will set the background image as a repeating pattern throughout the page, otherwise the image will appear as the cover background image', 'tetsuo' ),
				'parent'        => $panel_design_style
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'tetsuo' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'tetsuo' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'tetsuo' ),
				'parent'        => $panel_design_style
			)
		);
		
			$boxed_container = tetsuo_edge_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed'  => 'yes'
						)
					)
				)
			);
		
				tetsuo_edge_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'tetsuo' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'tetsuo' ),
						'parent'      => $boxed_container
					)
				);
				
				tetsuo_edge_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'tetsuo' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'tetsuo' ),
						'parent'      => $boxed_container
					)
				);
				
				tetsuo_edge_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'tetsuo' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'tetsuo' ),
						'parent'      => $boxed_container
					)
				);
				
				tetsuo_edge_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'tetsuo' ),
						'description'   => esc_html__( 'Choose background image attachment', 'tetsuo' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'tetsuo' ),
							'fixed'  => esc_html__( 'Fixed', 'tetsuo' ),
							'scroll' => esc_html__( 'Scroll', 'tetsuo' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'tetsuo' ),
				'parent'        => $panel_design_style
			)
		);
		
			$paspartu_container = tetsuo_edge_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu'  => 'yes'
						)
					)
				)
			);
		
				tetsuo_edge_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'tetsuo' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'tetsuo' ),
						'parent'      => $paspartu_container
					)
				);
				
				tetsuo_edge_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'tetsuo' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'tetsuo' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				tetsuo_edge_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'tetsuo' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'tetsuo' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				tetsuo_edge_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'tetsuo' )
					)
				);
		
				tetsuo_edge_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'tetsuo' ),
						'description' => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'tetsuo' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => 'edgtf-grid-1300',
				'label'         => esc_html__( 'Initial Width of Content', 'tetsuo' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'tetsuo' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'edgtf-grid-1300' => esc_html__( '1300px - default', 'tetsuo' ),
					'edgtf-grid-1200' => esc_html__( '1200px', 'tetsuo' ),
                    'edgtf-grid-1100' => esc_html__( '1100px', 'tetsuo' ),
					'edgtf-grid-1000' => esc_html__( '1000px', 'tetsuo' ),
					'edgtf-grid-800'  => esc_html__( '800px', 'tetsuo' )
				)
			)
		);

        tetsuo_edge_add_admin_field(
            array(
                'name'          => 'content_grid_lines',
                'type'          => 'select',
                'default_value' => 'none',
                'label'         => esc_html__('Grid Lines in Page Background', 'tetsuo'),
                'description'   => esc_html__('If you would like to enable a set of lines in the page background, choose how many lines you would like to display. The lines will be placed on the page grid.', 'tetsuo'),
                'parent'        => $panel_design_style,
                'options'       => array(
                    "none" => esc_html__("None", 'tetsuo'),
                    "2" => "3 lines",
                    "3" => "4 lines",
                    "4" => "5 lines",
                    "5" => "6 lines",
                    "6" => "7 lines"
                ),
            )
        );

        $lines_container = tetsuo_edge_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'lines_container',
                'dependency' => array(
                    'hide' => array(
                        'content_grid_lines'  => 'none'
                    )
                )
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'name'          => 'content_grid_lines_skin',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Grid Lines Skin', 'tetsuo' ),
                'description'   => esc_html__( 'Choose skin for background grid lines', 'tetsuo' ),
                'parent'        => $lines_container,
                'options'       => array(
                    'light'  => esc_html__( 'Light', 'tetsuo' ),
                    'dark' => esc_html__( 'Dark', 'tetsuo' )
                )
            )
        );


        tetsuo_edge_add_admin_field(
            array(
                'name'          => 'theme_skin',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Default Skin', 'tetsuo' ),
                'description'   => esc_html__( 'Choose skin for your Site', 'tetsuo' ),
                'parent'        => $panel_design_style,
                'options'       => array(
                    ''       => esc_html__( 'Dark', 'tetsuo' ),
                    'light'  => esc_html__( 'Light', 'tetsuo' )
                )
            )
        );
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'tetsuo' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'tetsuo' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = tetsuo_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'tetsuo' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'tetsuo' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'tetsuo' ),
				'parent'        => $panel_settings
			)
		);
		
			$page_transitions_container = tetsuo_edge_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions'  => 'yes'
						)
					)
				)
			);
		
				tetsuo_edge_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'tetsuo' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'tetsuo' ),
						'parent'        => $page_transitions_container
					)
				);
				
				$page_transition_preloader_container = tetsuo_edge_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes'
							)
						)
					)
				);
				
					tetsuo_edge_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'tetsuo' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = tetsuo_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'tetsuo' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'tetsuo' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = tetsuo_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					tetsuo_edge_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'tetsuo' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
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
					
					tetsuo_edge_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'tetsuo' ),
							'parent'        => $row_pt_spinner_animation
						)
					);

					tetsuo_edge_add_admin_field(
						array(
							'type'          => 'image',
							'name'          => 'smooth_pt_spinner_image',
							'label'         => esc_html__( 'Preloader Image', 'tetsuo' ),
							'parent'        => $row_pt_spinner_animation,
							'dependency'    => array(
								'show'  => array(
									'smooth_pt_spinner_type' => 'tetsuo_spinner'
								)
							)
						)
					);
					
					tetsuo_edge_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'tetsuo' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'tetsuo' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'tetsuo' ),
				'parent'        => $panel_settings
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'tetsuo' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = tetsuo_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'tetsuo' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'tetsuo' ),
				'parent'      => $panel_custom_code
			)
		);

		$panel_google_api = tetsuo_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'tetsuo' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'tetsuo' ),
				'parent'      => $panel_google_api
			)
		);

        tetsuo_edge_add_admin_field(
            array(
                'name' => 'show_fixed_video_background',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Show Fixed Video Background', 'tetsuo'),
                'description' => esc_html__('Enable this option to show fixed video background on this page/post.', 'tetsuo'),
                'parent' => $panel_design_style,
            )
        );

        $show_fixed_video_background_container = tetsuo_edge_add_admin_container(
            array(
                'parent' => $panel_design_style,
                'name' => 'show_fixed_video_background_container',
                'dependency' => array(
                    'show' => array(
                        'show_fixed_video_background'  => 'yes'
                    )
                )

            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'name' => 'fixed_video_background_url',
                'type' => 'text',
                'label' => esc_html__('Video MP4', 'tetsuo'),
                'description' => esc_html__('Enter video URL for MP4 format', 'tetsuo'),
                'parent' => $show_fixed_video_background_container
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'name' => 'shader_color_over_fixed_video_background',
                'type' => 'color',
                'label' => esc_html__('Overlay Shader Color', 'tetsuo'),
                'description' => esc_html__('Choose the shader color over video.', 'tetsuo'),
                'parent' => $show_fixed_video_background_container
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'name' => 'shader_over_fixed_video_background_opacity',
                'type' => 'text',
                'label' => esc_html__('Overlay Shader Opacity', 'tetsuo'),
                'description' => esc_html__('Choose a transparency for the fixed video background shader color (0 = fully transparent, 1 = opaque)', 'tetsuo'),
                'parent' => $show_fixed_video_background_container,
                'args' => array(
                    'col_width' => 2,
                )
            )
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name' => 'animate_overlay',
				'type' => 'yesno',
                'label' => esc_html__('Animate Overlay On Scroll', 'tetsuo'),
                'default_value' => 'no',
                'dependency' => array(
				'hide' => array(
						'shader_over_fixed_video_background_opacity'  => array('')
					)
				),
				'parent' => $show_fixed_video_background_container,
            )
		);

        tetsuo_edge_add_admin_field(
            array(
                'name' => 'fixed_video_background_fallback_image',
                'type' => 'image',
                'label' => esc_html__('Video Image', 'tetsuo'),
                'description' => esc_html__('Upload video image', 'tetsuo'),
                'parent' => $show_fixed_video_background_container
            )
        );
	}
	
	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_general_options_map', tetsuo_edge_set_options_map_position( 'general' ) );
}

if ( ! function_exists( 'tetsuo_edge_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function tetsuo_edge_page_general_style( $style ) {
		$current_style = '';
		$page_id       = tetsuo_edge_get_page_id();
		$class_prefix  = tetsuo_edge_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = tetsuo_edge_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = tetsuo_edge_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = tetsuo_edge_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = tetsuo_edge_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.edgtf-boxed .edgtf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= tetsuo_edge_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_header_selector                = array(
			'.edgtf-paspartu-enabled .edgtf-page-header .edgtf-fixed-wrapper.fixed',
			'.edgtf-paspartu-enabled .edgtf-sticky-header',
			'.edgtf-paspartu-enabled .edgtf-mobile-header.mobile-header-appear .edgtf-mobile-header-inner'
		);
		$paspartu_header_appear_selector         = array(
			'.edgtf-paspartu-enabled.edgtf-fixed-paspartu-enabled .edgtf-page-header .edgtf-fixed-wrapper.fixed',
			'.edgtf-paspartu-enabled.edgtf-fixed-paspartu-enabled .edgtf-sticky-header.header-appear',
			'.edgtf-paspartu-enabled.edgtf-fixed-paspartu-enabled .edgtf-mobile-header.mobile-header-appear .edgtf-mobile-header-inner'
		);
		
		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();
		
		$paspartu_color = tetsuo_edge_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = tetsuo_edge_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( tetsuo_edge_string_ends_with( $paspartu_width, '%' ) || tetsuo_edge_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
				
				$paspartu_clean_width      = tetsuo_edge_string_ends_with( $paspartu_width, '%' ) ? tetsuo_edge_filter_suffix( $paspartu_width, '%' ) : tetsuo_edge_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = tetsuo_edge_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
				
				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.edgtf-paspartu-enabled .edgtf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= tetsuo_edge_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= tetsuo_edge_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= tetsuo_edge_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}
		
		$paspartu_responsive_width = tetsuo_edge_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( tetsuo_edge_string_ends_with( $paspartu_responsive_width, '%' ) || tetsuo_edge_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
				
				$paspartu_clean_width      = tetsuo_edge_string_ends_with( $paspartu_responsive_width, '%' ) ? tetsuo_edge_filter_suffix( $paspartu_responsive_width, '%' ) : tetsuo_edge_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = tetsuo_edge_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . tetsuo_edge_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . tetsuo_edge_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . tetsuo_edge_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'tetsuo_edge_filter_add_page_custom_style', 'tetsuo_edge_page_general_style' );
}