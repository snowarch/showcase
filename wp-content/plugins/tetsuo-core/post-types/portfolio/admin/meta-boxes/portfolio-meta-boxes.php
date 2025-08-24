<?php

if ( ! function_exists( 'tetsuo_core_map_portfolio_meta' ) ) {
	function tetsuo_core_map_portfolio_meta() {
		global $tetsuo_edge_global_Framework;
		
		$tetsuo_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$tetsuo_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$tetsuo_portfolio_images = new TetsuoEdgeClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'tetsuo-core' ), '', '', 'portfolio_images' );
		$tetsuo_edge_global_Framework->edgtMetaBoxes->addMetaBox( 'portfolio_images', $tetsuo_portfolio_images );
		
		$tetsuo_portfolio_image_gallery = new TetsuoEdgeClassMultipleImages( 'edgtf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'tetsuo-core' ), esc_html__( 'Choose your portfolio images', 'tetsuo-core' ) );
		$tetsuo_portfolio_images->addChild( 'edgtf-portfolio-image-gallery', $tetsuo_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$tetsuo_portfolio_images_videos = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'tetsuo-core' ),
				'name'  => 'edgtf_portfolio_images_videos'
			)
		);
		tetsuo_edge_add_repeater_field(
			array(
				'name'        => 'edgtf_portfolio_single_upload',
				'parent'      => $tetsuo_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'tetsuo-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'tetsuo-core' ),
						'options' => array(
							'image' => esc_html__('Image','tetsuo-core'),
							'video' => esc_html__('Video','tetsuo-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'tetsuo-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'tetsuo-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'tetsuo-core'),
							'vimeo' => esc_html__('Vimeo', 'tetsuo-core'),
							'self' => esc_html__('Self Hosted', 'tetsuo-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'tetsuo-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'tetsuo-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'tetsuo-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$tetsuo_additional_sidebar_items = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'tetsuo-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		tetsuo_edge_add_repeater_field(
			array(
				'name'        => 'edgtf_portfolio_properties',
				'parent'      => $tetsuo_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'tetsuo-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'tetsuo-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'tetsuo-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'tetsuo-core' )
					)
				)
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_core_map_portfolio_meta', 40 );
}