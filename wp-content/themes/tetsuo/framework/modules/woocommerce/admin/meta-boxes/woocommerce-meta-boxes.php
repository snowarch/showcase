<?php

if ( ! function_exists( 'tetsuo_edge_map_woocommerce_meta' ) ) {
	function tetsuo_edge_map_woocommerce_meta() {
		
		$woocommerce_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'tetsuo' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'tetsuo' ),
				'description' => esc_html__( 'Choose image layout when it appears in Edge Product List - Masonry layout shortcode', 'tetsuo' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'tetsuo' ),
					'small'              => esc_html__( 'Small', 'tetsuo' ),
					'large-width'        => esc_html__( 'Large Width', 'tetsuo' ),
					'large-height'       => esc_html__( 'Large Height', 'tetsuo' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'tetsuo' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'tetsuo' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'tetsuo' ),
				'options'       => tetsuo_edge_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'tetsuo' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'tetsuo' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_map_woocommerce_meta', 99 );
}