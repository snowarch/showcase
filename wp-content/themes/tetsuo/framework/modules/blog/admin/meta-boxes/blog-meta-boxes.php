<?php

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'tetsuo_edge_map_blog_meta' ) ) {
	function tetsuo_edge_map_blog_meta() {
		$edgtf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$edgtf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'tetsuo' ),
				'name'  => 'blog_meta'
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'tetsuo' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'tetsuo' ),
				'parent'      => $blog_meta_box,
				'options'     => $edgtf_blog_categories
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'tetsuo' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'tetsuo' ),
				'parent'      => $blog_meta_box,
				'options'     => $edgtf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'tetsuo' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'tetsuo' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'tetsuo' ),
					'in-grid'    => esc_html__( 'In Grid', 'tetsuo' ),
					'full-width' => esc_html__( 'Full Width', 'tetsuo' )
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'tetsuo' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'tetsuo' ),
				'parent'      => $blog_meta_box,
				'options'     => tetsuo_edge_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'tetsuo' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'tetsuo' ),
				'options'     => tetsuo_edge_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'tetsuo' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'tetsuo' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'tetsuo' ),
					'fixed'    => esc_html__( 'Fixed', 'tetsuo' ),
					'original' => esc_html__( 'Original', 'tetsuo' )
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'tetsuo' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'tetsuo' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'tetsuo' ),
					'standard'        => esc_html__( 'Standard', 'tetsuo' ),
					'load-more'       => esc_html__( 'Load More', 'tetsuo' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'tetsuo' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'tetsuo' )
				)
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'edgtf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'tetsuo' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'tetsuo' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_map_blog_meta', 30 );
}