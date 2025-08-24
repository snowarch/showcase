<?php
namespace TetsuoCore\CPT\Shortcodes\Separator;

use TetsuoCore\Lib;

class Separator implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_separator';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Separator', 'tetsuo-core' ),
					'base'                    => $this->base,
					'category'                => esc_html__( 'by TETSUO', 'tetsuo-core' ),
					'icon'                    => 'icon-wpb-separator extended-custom-icon',
					'show_settings_on_create' => true,
					'class'                   => 'wpb_vc_separator',
					'custom_markup'           => '<div></div>',
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'tetsuo-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'tetsuo-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'type',
							'heading'    => esc_html__( 'Type', 'tetsuo-core' ),
							'value'      => array(
								esc_html__( 'Normal', 'tetsuo-core' )     => 'normal',
								esc_html__( 'Full Width', 'tetsuo-core' ) => 'full-width'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'position',
							'heading'    => esc_html__( 'Position', 'tetsuo-core' ),
							'value'      => array(
								esc_html__( 'Center', 'tetsuo-core' ) => 'center',
								esc_html__( 'Left', 'tetsuo-core' )   => 'left',
								esc_html__( 'Right', 'tetsuo-core' )  => 'right'
							),
							'dependency' => array( 'element' => 'type', 'value' => array( 'normal' ) )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'color',
							'heading'    => esc_html__( 'Color', 'tetsuo-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'border_style',
							'heading'     => esc_html__( 'Style', 'tetsuo-core' ),
							'value'       => array(
								esc_html__( 'Default', 'tetsuo-core' ) => '',
								esc_html__( 'Dashed', 'tetsuo-core' )  => 'dashed',
								esc_html__( 'Solid', 'tetsuo-core' )   => 'solid',
								esc_html__( 'Dotted', 'tetsuo-core' )  => 'dotted'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'width',
							'heading'    => esc_html__( 'Width (px or %)', 'tetsuo-core' ),
							'dependency' => array( 'element' => 'type', 'value' => array( 'normal' ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'thickness',
							'heading'    => esc_html__( 'Thickness (px)', 'tetsuo-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'margin',
							'heading'    => esc_html__( 'Margin (px or %)', 'tetsuo-core' ),
                            'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'tetsuo-core' )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'  => '',
			'type'          => '',
			'position'      => 'center',
			'color'         => '',
			'border_style'  => '',
			'width'         => '',
			'thickness'     => '',
			'margin'    => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		
		$html = tetsuo_core_get_shortcode_module_template_part( 'templates/separator-template', 'separator', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['position'] ) ? 'edgtf-separator-' . $params['position'] : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgtf-separator-' . $params['type'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( $params['color'] !== '' ) {
			$styles[] = 'border-color: ' . $params['color'];
		}
		
		if ( $params['border_style'] !== '' ) {
			$styles[] = 'border-style: ' . $params['border_style'];
		}
		
		if ( $params['width'] !== '' ) {
			if ( tetsuo_edge_string_ends_with( $params['width'], '%' ) || tetsuo_edge_string_ends_with( $params['width'], 'px' ) ) {
				$styles[] = 'width: ' . $params['width'];
			} else {
				$styles[] = 'width: ' . tetsuo_edge_filter_px( $params['width'] ) . 'px';
			}
		}
		
		if ( $params['thickness'] !== '' ) {
			$styles[] = 'border-bottom-width: ' . tetsuo_edge_filter_px( $params['thickness'] ) . 'px';
		}
		
		if ( $params['margin'] !== '' ) {
            $styles[] = 'margin: ' . $params['margin'];
		}
		
		return implode( ';', $styles );
	}
}
