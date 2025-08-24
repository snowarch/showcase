<?php

if ( ! function_exists( 'tetsuo_edge_portfolio_options_map' ) ) {
	function tetsuo_edge_portfolio_options_map() {
		
		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'tetsuo-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = tetsuo_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'tetsuo-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'tetsuo-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'tetsuo-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'tetsuo-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'tetsuo-core' ),
				'parent'        => $panel_archive,
				'options'       => tetsuo_edge_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'tetsuo-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'tetsuo-core' ),
				'default_value' => 'normal',
				'options'       => tetsuo_edge_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'tetsuo-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'tetsuo-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'tetsuo-core' ),
					'landscape' => esc_html__( 'Landscape', 'tetsuo-core' ),
					'portrait'  => esc_html__( 'Portrait', 'tetsuo-core' ),
					'square'    => esc_html__( 'Square', 'tetsuo-core' )
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'tetsuo-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'tetsuo-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'tetsuo-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'tetsuo-core' )
				)
			)
		);
		
		$panel = tetsuo_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'tetsuo-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'tetsuo-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'tetsuo-core' ),
				'parent'        => $panel,
				'options'       => array(
					'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'tetsuo-core' ),
					'images'            => esc_html__( 'Portfolio Images', 'tetsuo-core' ),
					'small-images'      => esc_html__( 'Portfolio Small Images', 'tetsuo-core' ),
					'slider'            => esc_html__( 'Portfolio Slider', 'tetsuo-core' ),
					'small-slider'      => esc_html__( 'Portfolio Small Slider', 'tetsuo-core' ),
					'gallery'           => esc_html__( 'Portfolio Gallery', 'tetsuo-core' ),
					'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'tetsuo-core' ),
					'masonry'           => esc_html__( 'Portfolio Masonry', 'tetsuo-core' ),
					'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'tetsuo-core' ),
					'custom'            => esc_html__( 'Portfolio Custom', 'tetsuo-core' ),
					'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'tetsuo-core' )
				)
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'tetsuo-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'tetsuo-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => tetsuo_edge_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'tetsuo-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'tetsuo-core' ),
				'default_value' => 'normal',
				'options'       => tetsuo_edge_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'tetsuo-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'tetsuo-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => tetsuo_edge_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'tetsuo-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'tetsuo-core' ),
				'default_value' => 'normal',
				'options'       => tetsuo_edge_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'tetsuo-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'tetsuo-core' ),
					'yes' => esc_html__( 'Yes', 'tetsuo-core' ),
					'no'  => esc_html__( 'No', 'tetsuo-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'tetsuo-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'tetsuo-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'tetsuo-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'tetsuo-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'tetsuo-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'tetsuo-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'tetsuo-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'tetsuo-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'tetsuo-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'tetsuo-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_portfolio_options_map', tetsuo_edge_set_options_map_position( 'portfolio' ) );
}