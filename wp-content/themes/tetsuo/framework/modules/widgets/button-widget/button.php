<?php

class TetsuoEdgeClassButtonWidget extends TetsuoEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_button_widget',
			esc_html__( 'Tetsuo Button Widget', 'tetsuo' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'tetsuo' ) )
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
					'solid'   => esc_html__( 'Solid', 'tetsuo' ),
					'outline' => esc_html__( 'Outline', 'tetsuo' ),
					'simple'  => esc_html__( 'Simple', 'tetsuo' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'tetsuo' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'tetsuo' ),
					'medium' => esc_html__( 'Medium', 'tetsuo' ),
					'large'  => esc_html__( 'Large', 'tetsuo' ),
					'huge'   => esc_html__( 'Huge', 'tetsuo' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'tetsuo' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'tetsuo' ),
				'default' => esc_html__( 'Button Text', 'tetsuo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'tetsuo' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'tetsuo' ),
				'options' => tetsuo_edge_get_link_target_array()
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'tetsuo' )
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'tetsuo' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'tetsuo' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'tetsuo' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'tetsuo' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'tetsuo' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'tetsuo' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'tetsuo' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'tetsuo' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'tetsuo' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'tetsuo' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'tetsuo' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget edgtf-button-widget">';
			echo do_shortcode( "[edgtf_button $params]" ); // XSS OK
		echo '</div>';
	}
}