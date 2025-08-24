<?php
namespace TetsuoCore\CPT\Shortcodes\FullScreenCarousel;

use TetsuoCore\Lib;

class FullScreenCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_fullscreen_carousel';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Fullscreen Carousel', 'tetsuo-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by TETSUO', 'tetsuo-core' ),
					'icon'                      => 'icon-wpb-fullscreen-carousel extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
					'params'                    => array(
                        array(
                            'type' => 'param_group',
                            'heading' => esc_html__( 'Carousel Items', 'tetsuo-core' ),
                            'param_name' => 'carousel_items',
                            'params' => array(
                            	array(
                            	    'type'        => 'attach_image',
                            	    'param_name'  => 'item_image',
                            	    'heading'     => esc_html__( 'Item Image', 'tetsuo-core' ),
                            	),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'item_title',
                                    'heading'     => esc_html__( 'Item Title', 'tetsuo-core' ),
                                    'admin_label' => true
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'item_link',
                                    'heading'    => esc_html__( 'Item Link', 'tetsuo-core' )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'item_link_text',
                                    'heading'    => esc_html__( 'Item Link Text', 'tetsuo-core' ),
									'dependency'  => array( 'element' => 'item_link', 'not_empty' => true )
                                ),
                            )
                        ),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'change_slides_on_scroll',
						    'heading'  => esc_html__( 'Change Slides On Scroll', 'tetsuo-core' ),
							'value'      => array_flip( tetsuo_edge_get_yes_no_select_array( false, true ) ),
						    'save_always' => true,
						    'admin_label' => true,
						    'group'     => esc_html__( 'Layout and Behavior', 'tetsuo-core' ),
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'enable_progress_indicator',
						    'heading'  => esc_html__( 'Enable Progress Indicator', 'tetsuo-core' ),
							'value'      => array_flip( tetsuo_edge_get_yes_no_select_array( false, true ) ),
						    'save_always' => true,
						    'admin_label' => true,
						    'group'     => esc_html__( 'Layout and Behavior', 'tetsuo-core' ),
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'enable_gradient',
						    'heading'  => esc_html__( 'Enable Gradient', 'tetsuo-core' ),
							'value'      => array_flip( tetsuo_edge_get_yes_no_select_array( false, true ) ),
						    'save_always' => true,
						    'admin_label' => true,
						    'group'     => esc_html__( 'Layout and Behavior', 'tetsuo-core' ),
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'skin',
						    'heading'  => esc_html__( 'Skin', 'tetsuo-core' ),
							'value'      => array(
								esc_html__( 'Light', 'edge-core' )   => 'light',
								esc_html__( 'Dark', 'edge-core' )  => 'dark'
							),
						    'save_always' => true,
						    'admin_label' => true,
						    'group'     => esc_html__( 'Layout and Behavior', 'tetsuo-core' ),
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'items_link_target',
						    'heading'     => esc_html__( 'Items Link Target', 'tetsuo-core' ),
						    'value'       => array_flip( tetsuo_edge_get_link_target_array() ),
						    'save_always' => true,
						    'group'     => esc_html__( 'Layout and Behavior', 'tetsuo-core' ),
						)
                    )
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
            'carousel_items'            	=> '',
            'change_slides_on_scroll'		=> '',
            'enable_progress_indicator' 	=> '',
            'items_link_target'     		=> '',
            'enable_gradient'            	=> '',
            'skin'            				=> '',
		);
		
		$params = shortcode_atts($args, $atts);
		$params['holder_classes'] = $this->getHolderClasses($params);
        $params['content'] = $content;
        $params['carousel_items'] = json_decode(urldecode($params['carousel_items']), true);

		$html = tetsuo_core_get_shortcode_module_template_part('templates/fullscreen-carousel-template', 'fullscreen-carousel', '', $params);
		
		return $html;
	}


	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses($params){
		$holderClasses = array();

		$holderClasses[] = 'edgtf-fullscreen-carousel-holder';

		if ($params['change_slides_on_scroll'] == 'yes') {
			$holderClasses[] = 'edgtf-fsc-slide-on-scroll';
		}

		if ($params['enable_progress_indicator'] == 'yes') {
			$holderClasses[] = 'edgtf-fsc-with-progress-indicator';
		}

		if ($params['enable_gradient'] == 'yes') {
			$holderClasses[] = 'edgtf-fsc-with-gradient';
		}

		if (!empty($params['skin'])) {
			$holderClasses[] = 'edgtf-fsc-'.$params['skin'].'-skin';
		}

		return implode(' ', $holderClasses);
	}
}