<?php

if ( ! function_exists( 'tetsuo_core_map_portfolio_settings_meta' ) ) {
	function tetsuo_core_map_portfolio_settings_meta() {
		$meta_box = tetsuo_edge_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'tetsuo-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		tetsuo_edge_create_meta_box_field( array(
			'name'        => 'edgtf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'tetsuo-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'tetsuo-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'tetsuo-core' ),
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
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'tetsuo-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'tetsuo-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => tetsuo_edge_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'tetsuo-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'tetsuo-core' ),
				'default_value' => '',
				'options'       => tetsuo_edge_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = tetsuo_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'tetsuo-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'tetsuo-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => tetsuo_edge_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'tetsuo-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'tetsuo-core' ),
				'default_value' => '',
				'options'       => tetsuo_edge_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'tetsuo-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'tetsuo-core' ),
				'parent'        => $meta_box,
				'options'       => tetsuo_edge_get_yes_no_select_array()
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'tetsuo-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'tetsuo-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'tetsuo-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'tetsuo-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'tetsuo-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'tetsuo-core' ),
				'parent'      => $meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'tetsuo-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'tetsuo-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'tetsuo-core' ),
					'small'              => esc_html__( 'Small', 'tetsuo-core' ),
					'large-width'        => esc_html__( 'Large Width', 'tetsuo-core' ),
					'large-height'       => esc_html__( 'Large Height', 'tetsuo-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'tetsuo-core' )
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'tetsuo-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'tetsuo-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'tetsuo-core' ),
					'large-width' => esc_html__( 'Large Width', 'tetsuo-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'tetsuo-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'tetsuo-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_core_map_portfolio_settings_meta', 41 );
}