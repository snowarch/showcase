<?php

if ( ! function_exists( 'tetsuo_edge_social_options_map' ) ) {
	function tetsuo_edge_social_options_map() {

	    $page = '_social_page';
		
		tetsuo_edge_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__( 'Social Networks', 'tetsuo' ),
				'icon'  => 'fa fa-share-alt'
			)
		);
		
		/**
		 * Enable Social Share
		 */
		$panel_social_share = tetsuo_edge_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_social_share',
				'title' => esc_html__( 'Enable Social Share', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Social Share', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will allow social share on networks of your choice', 'tetsuo' ),
				'parent'        => $panel_social_share
			)
		);
		
		$panel_show_social_share_on = tetsuo_edge_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_show_social_share_on',
				'title'           => esc_html__( 'Show Social Share On', 'tetsuo' ),
				'dependency' => array(
					'show' => array(
						'enable_social_share'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_post',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Posts', 'tetsuo' ),
				'description'   => esc_html__( 'Show Social Share on Blog Posts', 'tetsuo' ),
				'parent'        => $panel_show_social_share_on
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_page',
				'default_value' => 'no',
				'label'         => esc_html__( 'Pages', 'tetsuo' ),
				'description'   => esc_html__( 'Show Social Share on Pages', 'tetsuo' ),
				'parent'        => $panel_show_social_share_on
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
		do_action('tetsuo_edge_action_post_types_social_share', $panel_show_social_share_on);
		
		/**
		 * Social Share Networks
		 */
		$panel_social_networks = tetsuo_edge_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_social_networks',
				'title'           => esc_html__( 'Social Networks', 'tetsuo' ),
				'dependency' => array(
					'hide' => array(
						'enable_social_share'  => 'no'
					)
				)
			)
		);
		
		/**
		 * Facebook
		 */
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'facebook_title',
				'title'  => esc_html__( 'Share on Facebook', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Facebook', 'tetsuo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_facebook_share_container = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'enable_facebook_share_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_facebook_share'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'facebook_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'tetsuo' ),
				'parent'        => $enable_facebook_share_container
			)
		);
		
		/**
		 * Twitter
		 */
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'twitter_title',
				'title'  => esc_html__( 'Share on Twitter', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_twitter_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Twitter', 'tetsuo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_twitter_share_container = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'enable_twitter_share_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_twitter_share'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'twitter_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'tetsuo' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'twitter_via',
				'default_value' => '',
				'label'         => esc_html__( 'Via', 'tetsuo' ),
				'parent'        => $enable_twitter_share_container
			)
		);

		/**
		 * Linked In
		 */
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'linkedin_title',
				'title'  => esc_html__( 'Share on LinkedIn', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_linkedin_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via LinkedIn', 'tetsuo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_linkedin_container = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'enable_linkedin_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_linkedin_share'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'linkedin_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'tetsuo' ),
				'parent'        => $enable_linkedin_container
			)
		);
		
		/**
		 * Tumblr
		 */
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'tumblr_title',
				'title'  => esc_html__( 'Share on Tumblr', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_tumblr_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Tumblr', 'tetsuo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_tumblr_container = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'enable_tumblr_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_tumblr_share'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'tumblr_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'tetsuo' ),
				'parent'        => $enable_tumblr_container
			)
		);
		
		/**
		 * Pinterest
		 */
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'pinterest_title',
				'title'  => esc_html__( 'Share on Pinterest', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_pinterest_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Pinterest', 'tetsuo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_pinterest_container = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'enable_pinterest_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_pinterest_share'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'pinterest_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'tetsuo' ),
				'parent'        => $enable_pinterest_container
			)
		);
		
		/**
		 * VK
		 */
		tetsuo_edge_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'vk_title',
				'title'  => esc_html__( 'Share on VK', 'tetsuo' )
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_vk_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via VK', 'tetsuo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_vk_container = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'enable_vk_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_vk_share'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'vk_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'tetsuo' ),
				'parent'        => $enable_vk_container
			)
		);
		
		if ( defined( 'TETSUO_TWITTER_FEED_VERSION' ) ) {
			$twitter_panel = tetsuo_edge_add_admin_panel(
				array(
					'title' => esc_html__( 'Twitter', 'tetsuo' ),
					'name'  => 'panel_twitter',
					'page'  => '_social_page'
				)
			);
			
			tetsuo_edge_add_admin_twitter_button(
				array(
					'name'   => 'twitter_button',
					'parent' => $twitter_panel
				)
			);
		}
		
		if ( defined( 'TETSUO_INSTAGRAM_FEED_VERSION' ) ) {
			$instagram_panel = tetsuo_edge_add_admin_panel(
				array(
					'title' => esc_html__( 'Instagram', 'tetsuo' ),
					'name'  => 'panel_instagram',
					'page'  => '_social_page'
				)
			);
			
			tetsuo_edge_add_admin_instagram_button(
				array(
					'name'   => 'instagram_button',
					'parent' => $instagram_panel
				)
			);
		}
		
		/**
		 * Open Graph
		 */
		$panel_open_graph = tetsuo_edge_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_open_graph',
				'title' => esc_html__( 'Open Graph', 'tetsuo' ),
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_open_graph',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Open Graph', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will allow usage of Open Graph protocol on your site', 'tetsuo' ),
				'parent'        => $panel_open_graph
			)
		);
		
		$enable_open_graph_container = tetsuo_edge_add_admin_container(
			array(
				'name'            => 'enable_open_graph_container',
				'parent'          => $panel_open_graph,
				'dependency' => array(
					'show' => array(
						'enable_open_graph'  => 'yes'
					)
				)
			)
		);
		
		tetsuo_edge_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'open_graph_image',
				'default_value' => EDGE_ASSETS_ROOT . '/img/open_graph.jpg',
				'label'         => esc_html__( 'Default Share Image', 'tetsuo' ),
				'parent'        => $enable_open_graph_container,
				'description'   => esc_html__( 'Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'tetsuo' ),
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
        do_action('tetsuo_edge_action_social_options', $page);
	}
	
	add_action( 'tetsuo_edge_action_options_map', 'tetsuo_edge_social_options_map', tetsuo_edge_set_options_map_position( 'social' ) );
}