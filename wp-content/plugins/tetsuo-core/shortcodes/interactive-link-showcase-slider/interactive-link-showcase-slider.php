<?php

namespace TetsuoCore\CPT\Shortcodes\InteractiveLinkShowcaseSlider;

use TetsuoCore\Lib;

class InteractiveLinkShowcaseSlider implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'edgtf_interactive_link_showcase_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'     => esc_html__('Interactive Link Showcase - Slider', 'tetsuo-core'),
                    'base'     => $this->getBase(),
                    'category' => esc_html__('by TETSUO', 'tetsuo-core'),
                    'icon'     => 'icon-wpb-interactive-link-showcase-slider extended-custom-icon',
                    'params'   => array(
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'skin',
                            'heading'     => esc_html__('Link Skin', 'tetsuo-core'),
                            'value'       => array(
                                esc_html__('Default', 'tetsuo-core') => '',
                                esc_html__('Dark', 'tetsuo-core')    => 'dark'
                            ),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'bottom_widget',
                            'heading'     => esc_html__('Bottom Widget Area', 'tetsuo-core'),
                            'value'       => array_merge(
                                array(
                                    '' => ''
                                ),
                                array_flip(tetsuo_edge_get_custom_sidebars())
                            ),
                            'description' => esc_html__('Choose widget area to be shown in bottom of shortcode.', 'tetsuo-core'),
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'background_color',
                            'heading'    => esc_html__('Background Color', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'link_target',
                            'heading'     => esc_html__('Link Target', 'tetsuo-core'),
                            'value'       => array_flip(tetsuo_edge_get_link_target_array()),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'param_group',
                            'param_name' => 'link_items',
                            'heading'    => esc_html__('Link Items', 'tetsuo-core'),
                            'params'     => array(
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'title',
                                    'heading'    => esc_html__('Title', 'tetsuo-core'),
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link',
                                    'heading'    => esc_html__('Link', 'tetsuo-core')
                                ),
                                array(
                                    'type'        => 'attach_image',
                                    'param_name'  => 'image',
                                    'heading'     => esc_html__('Image', 'tetsuo-core'),
                                    'description' => esc_html__('Select image from media library', 'tetsuo-core')
                                )
                            )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'split_hover',
                            'heading'    => esc_html__( 'Enable Split Hover', 'tetsuo-core' ),
                            'value'      => array_flip( tetsuo_edge_get_yes_no_select_array( false ) ),
                            'description'   => esc_html__( 'Enabling this option will trigger theme predefined split hover effect in modern browsers.', 'tetsuo' ),
                        ),
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'skin'          => '',
            'bottom_widget' => '',
			'background_color' => '',
			'link_target'      => '_self',
			'link_items'       => '',
			'split_hover'       => ''
		);
		$params = shortcode_atts($args, $atts);
		
		$params['holder_classes'] = $this->getHolderClasses($params, $args);
		$params['image_holder_styles'] = $this->getImageHolderStyles($params);
		$params['link_items'] = json_decode(urldecode($params['link_items']), true);
		$params['link_target'] = !empty($params['link_target']) ? $params['link_target'] : $args['link_target'];
		
		$html = tetsuo_core_get_shortcode_module_template_part('templates/interactive-link-showcase-slider', 'interactive-link-showcase-slider', '', $params);
		
		return $html;
	}

    private function getHolderClasses($params, $args) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['skin']) ? 'edgtf-ils-skin-' . $params['skin'] : '';

        if ($params['split_hover'] == 'yes' ) {
			$holderClasses[] = 'edgtf-ilss-with-split-hover';
		}

        return implode(' ', $holderClasses);
    }

    private function getImageHolderStyles($params) {
        $styles = array();

        if (!empty($params['background_color'])) {
            $styles[] = 'background-color: ' . $params['background_color'];
        }

        return implode(';', $styles);
    }
}