<?php

if ( ! function_exists( 'tetsuo_edge_logo_options_map' ) ) {
	function tetsuo_edge_logo_options_map() {
		
		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'tetsuo' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = tetsuo_edge_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'tetsuo' )
			)
		);
		
		$hide_logo_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);

        tetsuo_edge_add_admin_field(
            array(
                'name'          => 'logo_text',
                'type'          => 'text',
                'default_value' => 'Tetsuo',
                'label'         => esc_html__( 'Logo Text', 'tetsuo' ),
                'parent'        => $hide_logo_container,
                'description'   => esc_html__( 'If no text is set for the logo, the image will be displayed.', 'tetsuo' ),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        tetsuo_edge_add_admin_field(
			array(
				'name'          => 'animate_logo',
                'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Animated Logo Text', 'tetsuo' ),
				'parent'        => $hide_logo_container,
			)
		);

        //logo text
        $group_logo_text = tetsuo_edge_add_admin_group(
            array(
                'name'        => 'group_logo_text',
                'title'       => esc_html__( 'Logo Text Style', 'tetsuo' ),
                'description' => esc_html__( 'Define styles for logo text', 'tetsuo' ),
                'parent'      => $hide_logo_container
            )
        );

        $row_logo_text_1 = tetsuo_edge_add_admin_row(
            array(
                'name'   => 'row_logo_text_1',
                'parent' => $group_logo_text
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'colorsimple',
                'name'          => 'logo_text_color',
                'default_value' => '',
                'label'         => esc_html__( 'Text Color', 'tetsuo' ),
                'parent'        => $row_logo_text_1
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'textsimple',
                'name'          => 'logo_text_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'tetsuo' ),
                'args'          => array(
                    'suffix' => esc_html__( 'px / em', 'tetsuo' )
                ),
                'parent'        => $row_logo_text_1
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'textsimple',
                'name'          => 'logo_text_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'tetsuo' ),
                'args'          => array(
                    'suffix' => esc_html__( 'px / em', 'tetsuo' )
                ),
                'parent'        => $row_logo_text_1
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'selectblanksimple',
                'name'          => 'logo_text_text_transform',
                'default_value' => '',
                'label'         => esc_html__( 'Text Transform', 'tetsuo' ),
                'options'       => tetsuo_edge_get_text_transform_array(),
                'parent'        => $row_logo_text_1
            )
        );

        $row_logo_text_2 = tetsuo_edge_add_admin_row(
            array(
                'name'   => 'row_logo_text_2',
                'parent' => $group_logo_text,
                'next'   => true
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'fontsimple',
                'name'          => 'logo_text_google_fonts',
                'default_value' => '-1',
                'label'         => esc_html__( 'Font Family', 'tetsuo' ),
                'parent'        => $row_logo_text_2
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'selectblanksimple',
                'name'          => 'logo_text_font_style',
                'default_value' => '',
                'label'         => esc_html__( 'Font Style', 'tetsuo' ),
                'options'       => tetsuo_edge_get_font_style_array(),
                'parent'        => $row_logo_text_2
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'selectblanksimple',
                'name'          => 'logo_text_font_weight',
                'default_value' => '',
                'label'         => esc_html__( 'Font Weight', 'tetsuo' ),
                'options'       => tetsuo_edge_get_font_weight_array(),
                'parent'        => $row_logo_text_2
            )
        );

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'textsimple',
                'name'          => 'logo_text_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'tetsuo' ),
                'args'          => array(
                    'suffix' => esc_html__( 'px / em', 'tetsuo' )
                ),
                'parent'        => $row_logo_text_2
            )
        );

		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'tetsuo' ),
				'parent'        => $hide_logo_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'tetsuo' ),
				'parent'        => $hide_logo_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'tetsuo' ),
				'parent'        => $hide_logo_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'tetsuo' ),
				'parent'        => $hide_logo_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'tetsuo' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_logo_options_map', tetsuo_edge_set_options_map_position( 'logo' ) );
}