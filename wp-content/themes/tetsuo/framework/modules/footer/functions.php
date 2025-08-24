<?php

if ( ! function_exists( 'tetsuo_edge_register_footer_sidebar' ) ) {
	function tetsuo_edge_register_footer_sidebar() {
		
		$show_footer_top    = tetsuo_edge_options()->getOptionValue( 'show_footer_top' ) !== 'yes' ? false : true;
		$show_footer_bottom = tetsuo_edge_options()->getOptionValue( 'show_footer_bottom' ) !== 'yes' ? false : true;
		
		if ( $show_footer_top ) {
			
			register_sidebar(
				array(
					'id'            => 'footer_top_column_1',
					'name'          => esc_html__( 'Footer Top Column 1', 'tetsuo' ),
					'description'   => esc_html__( 'Widgets added here will appear in the first column of top footer area', 'tetsuo' ),
					'before_widget' => '<div id="%1$s" class="widget edgtf-footer-column-1 %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
					'after_title'   => '</h5></div>'
				)
			);
			
			register_sidebar(
				array(
					'id'            => 'footer_top_column_2',
					'name'          => esc_html__( 'Footer Top Column 2', 'tetsuo' ),
					'description'   => esc_html__( 'Widgets added here will appear in the second column of top footer area', 'tetsuo' ),
					'before_widget' => '<div id="%1$s" class="widget edgtf-footer-column-2 %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
					'after_title'   => '</h5></div>'
				)
			);
			
			register_sidebar(
				array(
					'id'            => 'footer_top_column_3',
					'name'          => esc_html__( 'Footer Top Column 3', 'tetsuo' ),
					'description'   => esc_html__( 'Widgets added here will appear in the third column of top footer area', 'tetsuo' ),
					'before_widget' => '<div id="%1$s" class="widget edgtf-footer-column-3 %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
					'after_title'   => '</h5></div>'
				)
			);
			
			register_sidebar(
				array(
					'id'            => 'footer_top_column_4',
					'name'          => esc_html__( 'Footer Top Column 4', 'tetsuo' ),
					'description'   => esc_html__( 'Widgets added here will appear in the fourth column of top footer area', 'tetsuo' ),
					'before_widget' => '<div id="%1$s" class="widget edgtf-footer-column-4 %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
					'after_title'   => '</h5></div>'
				)
			);
		}
		
		if ( $show_footer_bottom ) {
			
			register_sidebar(
				array(
					'id'            => 'footer_bottom_column_1',
					'name'          => esc_html__( 'Footer Bottom Column 1', 'tetsuo' ),
					'description'   => esc_html__( 'Widgets added here will appear in the first column of bottom footer area', 'tetsuo' ),
					'before_widget' => '<div id="%1$s" class="widget edgtf-footer-bottom-column-1 %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
					'after_title'   => '</h5></div>'
				)
			);
			
			register_sidebar(
				array(
					'id'            => 'footer_bottom_column_2',
					'name'          => esc_html__( 'Footer Bottom Column 2', 'tetsuo' ),
					'description'   => esc_html__( 'Widgets added here will appear in the second column of bottom footer area', 'tetsuo' ),
					'before_widget' => '<div id="%1$s" class="widget edgtf-footer-bottom-column-2 %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
					'after_title'   => '</h5></div>'
				)
			);
			
			register_sidebar(
				array(
					'id'            => 'footer_bottom_column_3',
					'name'          => esc_html__( 'Footer Bottom Column 3', 'tetsuo' ),
					'description'   => esc_html__( 'Widgets added here will appear in the third column of bottom footer area', 'tetsuo' ),
					'before_widget' => '<div id="%1$s" class="widget edgtf-footer-bottom-column-3 %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
					'after_title'   => '</h5></div>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'tetsuo_edge_register_footer_sidebar' );
}

if ( ! function_exists( 'tetsuo_edge_get_footer' ) ) {
	/**
	 * Loads footer HTML
	 */
	function tetsuo_edge_get_footer() {
		$parameters          = array();
		$page_id             = tetsuo_edge_get_page_id();
		$disable_footer_meta = get_post_meta( $page_id, 'edgtf_disable_footer_meta', true );
        $uncovering_footer_meta = tetsuo_edge_get_meta_field_intersect( 'uncovering_footer', $page_id );
        $uncovering_footer      = $uncovering_footer_meta === 'yes' ? 'edgtf-footer-uncover' : '';
		
		$parameters['display_footer']        = $disable_footer_meta === 'yes' ? false : true;
		$parameters['display_footer_top']    = tetsuo_edge_show_footer_top();
		$parameters['display_footer_bottom'] = tetsuo_edge_show_footer_bottom();
        $parameters['holder_classes']        = $uncovering_footer;
		
		tetsuo_edge_get_module_template_part( 'templates/footer', 'footer', '', $parameters );
	}
	
	add_action( 'tetsuo_edge_get_footer_template', 'tetsuo_edge_get_footer' );
}

if ( ! function_exists( 'tetsuo_edge_show_footer_top' ) ) {
	/**
	 * Check footer top showing
	 * Function check value from options and checks if footer columns are empty.
	 * return bool
	 */
	function tetsuo_edge_show_footer_top() {
		$footer_top_flag = false;
		
		//check value from options and meta field on current page
		$option_flag = ( tetsuo_edge_get_meta_field_intersect( 'show_footer_top' ) === 'yes' ) ? true : false;
		
		//check footer columns.If they are empty, disable footer top
		$columns_flag = false;
		for ( $i = 1; $i <= 4; $i ++ ) {
			$footer_columns_id = 'footer_top_column_' . $i;
			if ( is_active_sidebar( $footer_columns_id ) ) {
				$columns_flag = true;
				break;
			}
		}
		
		if ( $option_flag && $columns_flag ) {
			$footer_top_flag = true;
		}
		
		return $footer_top_flag;
	}
}

if ( ! function_exists( 'tetsuo_edge_show_footer_bottom' ) ) {
	/**
	 * Check footer bottom showing
	 * Function check value from options and checks if footer columns are empty.
	 * return bool
	 */
	function tetsuo_edge_show_footer_bottom() {
		$footer_bottom_flag = false;
		
		//check value from options and meta field on current page
		$option_flag = ( tetsuo_edge_get_meta_field_intersect( 'show_footer_bottom' ) === 'yes' ) ? true : false;
		
		//check footer columns.If they are empty, disable footer bottom
		$columns_flag = false;
		for ( $i = 1; $i <= 3; $i ++ ) {
			$footer_columns_id = 'footer_bottom_column_' . $i;
			if ( is_active_sidebar( $footer_columns_id ) ) {
				$columns_flag = true;
				break;
			}
		}
		
		if ( $option_flag && $columns_flag ) {
			$footer_bottom_flag = true;
		}
		
		return $footer_bottom_flag;
	}
}

if (!function_exists('tetsuo_edge_get_fixed_video_background')) {
    function tetsuo_edge_get_fixed_video_background() {
        // prepare vars
        $params = array();
        $post_id = tetsuo_edge_get_page_id();
        $params['fixed_video_background'] = tetsuo_edge_get_meta_field_intersect('show_fixed_video_background');

        // if fixed video background is enabled for current post/page
        if ($params['fixed_video_background'] === 'yes') {
            // fetch meta values as params to pass to template
            $params['video'] = tetsuo_edge_get_meta_field_intersect('fixed_video_background_url');
            $params['image'] = tetsuo_edge_get_meta_field_intersect('fixed_video_background_fallback_image');

            // fetch meta values to generate params and pass to template
            $color = tetsuo_edge_get_meta_field_intersect('shader_color_over_fixed_video_background');
            if ($color === '') {
                $color = '#000000';
            }
            $opacity = tetsuo_edge_get_meta_field_intersect('shader_over_fixed_video_background_opacity');
            if ($opacity === '') {
                $opacity = '0.3';
            }
            $background_color = tetsuo_edge_rgba_color($color, $opacity);

            // if mobile user
            if (wp_is_mobile()) {
                // if poster image is set merge image and shader into background image property
                if ($params['image'] !== '') {
                    $params['shader_style'] = 'background-image:linear-gradient(' . $background_color . ',' . $background_color . '), url(' . $params['image'] . ')';
                } // use only shader
                else {
                    $params['shader_style'] = 'background:' . $background_color;
                }

            } // if not mobile user
            else {
                $params['shader_style'] = 'background-color:' . $background_color;
            }

            tetsuo_edge_get_module_template_part('templates/parts/fixed-video-background', 'footer', '', $params);
        }
    }
}

if ( ! function_exists( 'tetsuo_edge_get_footer_top' ) ) {
	/**
	 * Return footer top HTML
	 */
	function tetsuo_edge_get_footer_top() {
		$parameters = array();

		//get number of top footer columns
		$parameters['footer_top_columns'] = explode(' ', tetsuo_edge_options()->getOptionValue( 'footer_top_columns' ));
		
		//get footer top grid/full width class
		$parameters['footer_top_grid_class'] = tetsuo_edge_get_meta_field_intersect('footer_in_grid') === 'yes' ? 'edgtf-grid' : 'edgtf-full-width';
		
		//get footer top other classes
		$footer_top_classes = array();
		
		//footer alignment
		$footer_top_alignment = tetsuo_edge_options()->getOptionValue( 'footer_top_columns_alignment' );
		$footer_top_classes[] = ! empty( $footer_top_alignment ) ? 'edgtf-footer-top-alignment-' . esc_attr( $footer_top_alignment ) : '';
		
		$footer_top_classes = apply_filters( 'tetsuo_edge_filter_footer_top_classes', $footer_top_classes );
		
		$parameters['footer_top_classes'] = implode( ' ', $footer_top_classes );
		
		tetsuo_edge_get_module_template_part( 'templates/parts/footer-top', 'footer', '', $parameters );
	}
}

if ( ! function_exists( 'tetsuo_edge_get_footer_bottom' ) ) {
	/**
	 * Return footer bottom HTML
	 */
	function tetsuo_edge_get_footer_bottom() {
		$parameters = array();

		//get number of bottom footer columns
		$parameters['footer_bottom_columns'] = explode(' ', tetsuo_edge_options()->getOptionValue( 'footer_bottom_columns' ));
		
		//get footer top grid/full width class
		$parameters['footer_bottom_grid_class'] = tetsuo_edge_get_meta_field_intersect('footer_in_grid') === 'yes' ? 'edgtf-grid' : 'edgtf-full-width';
		
		//get footer top other classes
		$footer_bottom_classes = array();
		$footer_bottom_classes = apply_filters( 'tetsuo_edge_filter_footer_bottom_classes', $footer_bottom_classes );
		
		$parameters['footer_bottom_classes'] = implode( ' ', $footer_bottom_classes );
		
		tetsuo_edge_get_module_template_part( 'templates/parts/footer-bottom', 'footer', '', $parameters );
	}
}

if ( ! function_exists( 'tetsuo_edge_footer_holder_style' ) ) {
	/**
	 * Function that return container style
	 */
	function tetsuo_edge_footer_holder_style( $style ) {
		$current_style = '';
		$page_id       = tetsuo_edge_get_page_id();
		$class_prefix  = tetsuo_edge_get_unique_page_class( $page_id, true );
		
		/***** footer top style - begin *****/
		
		$footer_top_selector         = $class_prefix . ' .edgtf-page-footer .edgtf-footer-top-holder';
		$footer_top_background_color = get_post_meta( $page_id, 'edgtf_footer_top_background_color_meta', true );
		
		if ( ! empty( $footer_top_background_color ) ) {
			$current_style .= tetsuo_edge_dynamic_css( $footer_top_selector, array( 'background-color' => $footer_top_background_color ) );
		}
		
		/***** footer top style - end *****/
		
		/***** footer bottom style - begin *****/
		
		$footer_bottom_selector         = $class_prefix . ' .edgtf-page-footer .edgtf-footer-bottom-holder';
		$footer_bottom_background_color = get_post_meta( $page_id, 'edgtf_footer_bottom_background_color_meta', true );
		
		if ( ! empty( $footer_bottom_background_color ) ) {
			$current_style .= tetsuo_edge_dynamic_css( $footer_bottom_selector, array( 'background-color' => $footer_bottom_background_color ) );
		}
		
		/***** footer bottom style - end *****/
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'tetsuo_edge_filter_add_page_custom_style', 'tetsuo_edge_footer_holder_style' );
}