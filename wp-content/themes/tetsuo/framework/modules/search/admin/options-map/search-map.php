<?php

if ( ! function_exists( 'tetsuo_edge_get_search_types_options' ) ) {
    function tetsuo_edge_get_search_types_options() {
        $search_type_options = apply_filters( 'tetsuo_edge_filter_search_type_global_option', $search_type_options = array() );

        return $search_type_options;
    }
}

if ( ! function_exists( 'tetsuo_edge_search_options_map' ) ) {
	function tetsuo_edge_search_options_map() {
		
		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'tetsuo' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = tetsuo_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'tetsuo' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'search_page_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Layout', 'tetsuo' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set layout. Default is in grid.', 'tetsuo' ),
				'parent'        => $search_page_panel,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'tetsuo' ),
					'full-width' => esc_html__( 'Full Width', 'tetsuo' )
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'search_page_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'tetsuo' ),
				'description'   => esc_html__( "Choose a sidebar layout for search page", 'tetsuo' ),
				'default_value' => 'no-sidebar',
				'options'       => tetsuo_edge_get_custom_sidebars_options(),
				'parent'        => $search_page_panel
			)
		);
		
		$tetsuo_custom_sidebars = tetsuo_edge_get_custom_sidebars();
		if ( count( $tetsuo_custom_sidebars ) > 0 ) {
			tetsuo_edge_add_admin_field(
				array(
					'name'        => 'search_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'tetsuo' ),
					'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'tetsuo' ),
					'parent'      => $search_page_panel,
					'options'     => $tetsuo_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		$search_panel = tetsuo_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'tetsuo' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen',
				'label'         => esc_html__( 'Select Search Type', 'tetsuo' ),
				'description'   => esc_html__( "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'tetsuo' ),
				'options'       => tetsuo_edge_get_search_types_options()
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Search Icon Source', 'tetsuo' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'tetsuo' ),
				'options'       => tetsuo_edge_get_icon_sources_array( false, false )
			)
		);

		$search_icon_pack_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $search_icon_pack_container,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Search Icon Pack', 'tetsuo' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'tetsuo' ),
				'options'       => tetsuo_edge_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$search_svg_path_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'svg_path'
					)
				)
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_icon_svg_path',
				'label'       => esc_html__( 'Search Icon SVG Path', 'tetsuo' ),
				'description' => esc_html__( 'Enter your search icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'tetsuo' ),
			)
		);

		tetsuo_edge_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_close_icon_svg_path',
				'label'       => esc_html__( 'Search Close Icon SVG Path', 'tetsuo' ),
				'description' => esc_html__( 'Enter your search close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'tetsuo' ),
			)
		);

        tetsuo_edge_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'search_sidebar_columns',
                'parent'        => $search_panel,
                'default_value' => '3',
                'label'         => esc_html__( 'Search Sidebar Columns', 'tetsuo' ),
                'description'   => esc_html__( 'Choose number of columns for FullScreen search sidebar area', 'tetsuo' ),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_sidebar_columns_dependency', $dependency_array = array())
					)
				)
            )
        );
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'tetsuo' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'tetsuo' ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_in_grid_dependency', $dependency_array = array())
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'tetsuo' )
			)
		);

		$search_icon_pack_icon_styles_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_icon_styles_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $search_icon_pack_icon_styles_container,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'tetsuo' ),
				'description'   => esc_html__( 'Set size for icon', 'tetsuo' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = tetsuo_edge_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'tetsuo' ),
				'description' => esc_html__( 'Define color style for icon', 'tetsuo' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = tetsuo_edge_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'tetsuo' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'tetsuo' )
			)
		);
		
		$enable_search_icon_text_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'dependency' => array(
					'show' => array(
						'enable_search_icon_text' => 'yes'
					)
				)
			)
		);
		
		$enable_search_icon_text_group = tetsuo_edge_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'tetsuo' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'tetsuo' )
			)
		);
		
		$enable_search_icon_text_row = tetsuo_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'tetsuo' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'tetsuo' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = tetsuo_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'tetsuo' ),
				'default_value' => '',
				'options'       => tetsuo_edge_get_text_transform_array()
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'tetsuo' ),
				'default_value' => '-1',
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'tetsuo' ),
				'default_value' => '',
				'options'       => tetsuo_edge_get_font_style_array(),
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'tetsuo' ),
				'default_value' => '',
				'options'       => tetsuo_edge_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = tetsuo_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'tetsuo' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_search_options_map', tetsuo_edge_set_options_map_position( 'search' ) );
}