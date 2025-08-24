<?php
namespace TetsuoCore\CPT\Shortcodes\AnimatedLink;

use TetsuoCore\Lib;

class AnimatedLink implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_animated_link';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Animated Link', 'tetsuo-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by TETSUO', 'tetsuo-core' ),
					'icon'                      => 'icon-wpb-animated-link extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'text',
							'heading'     => esc_html__( 'Text', 'tetsuo-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Link', 'tetsuo-core' ),
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'target',
							'heading'    => esc_html__( 'Target', 'tetsuo-core' ),
							'value'      => array_flip( tetsuo_edge_get_link_target_array() ),
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'color',
							'heading'    => esc_html__( 'Color', 'tetsuo-core' ),
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'tetsuo-core' ),
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'text'                   => '',
			'link'             		 => '',
			'target'            	 => '_self',
			'color'                  => '',
			'background_color'                  => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['color_styles'] = $this->getColorStyles( $params );
		$params['bg_styles'] = $this->getBgStyles( $params );
		
		$html = tetsuo_core_get_shortcode_module_template_part( 'templates/animated-link-template', 'animated-link', '', $params );
		
		return $html;
	}
	
	private function getColorStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] )) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		return implode( ';', $styles );
	}

	private function getBgStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] )) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
}