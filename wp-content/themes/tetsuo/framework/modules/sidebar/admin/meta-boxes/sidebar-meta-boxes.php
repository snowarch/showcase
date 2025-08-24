<?php

if ( ! function_exists( 'tetsuo_edge_map_sidebar_meta' ) ) {
	function tetsuo_edge_map_sidebar_meta() {
		$edgtf_sidebar_meta_box = tetsuo_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'tetsuo_edge_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'tetsuo' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		tetsuo_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'tetsuo' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'tetsuo' ),
				'parent'      => $edgtf_sidebar_meta_box,
                'options'       => tetsuo_edge_get_custom_sidebars_options( true )
			)
		);
		
		$edgtf_custom_sidebars = tetsuo_edge_get_custom_sidebars();
		if ( count( $edgtf_custom_sidebars ) > 0 ) {
			tetsuo_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'tetsuo' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'tetsuo' ),
					'parent'      => $edgtf_sidebar_meta_box,
					'options'     => $edgtf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'tetsuo_edge_action_meta_boxes_map', 'tetsuo_edge_map_sidebar_meta', 31 );
}