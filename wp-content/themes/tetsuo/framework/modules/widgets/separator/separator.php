<?php

class TetsuoEdgeClassSeparatorWidget extends TetsuoEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_separator_widget',
			esc_html__( 'Tetsuo Separator Widget', 'tetsuo' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'tetsuo' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'tetsuo' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'tetsuo' ),
					'full-width' => esc_html__( 'Full Width', 'tetsuo' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'tetsuo' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'tetsuo' ),
					'left'   => esc_html__( 'Left', 'tetsuo' ),
					'right'  => esc_html__( 'Right', 'tetsuo' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'tetsuo' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'tetsuo' ),
					'dashed' => esc_html__( 'Dashed', 'tetsuo' ),
					'dotted' => esc_html__( 'Dotted', 'tetsuo' )
				)
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'tetsuo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'tetsuo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'tetsuo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'tetsuo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'tetsuo' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}


        $top_margin = $instance['top_margin'];
        $bottom_margin = $instance['bottom_margin'];

		if($top_margin =='') {
		    $top_margin = '10px';
        } else {
            if ( ! tetsuo_edge_string_ends_with( $top_margin, '%' ) && ! tetsuo_edge_string_ends_with( $top_margin, 'px' ) ) {
                $top_margin .= 'px';
            }
        }

        if($bottom_margin =='') {
            $bottom_margin = '10px';
        } else {
            if ( ! tetsuo_edge_string_ends_with( $bottom_margin, '%' ) && ! tetsuo_edge_string_ends_with( $bottom_margin, 'px' ) ) {
                $bottom_margin .= 'px';
            }
        }
        $instance['margin'] = $top_margin . ' 0 ' .$bottom_margin;
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget edgtf-separator-widget">';
			echo do_shortcode( "[edgtf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}