<?php
namespace TetsuoCore\CPT\Shortcodes\InteractiveLinkShowcase;

use TetsuoCore\Lib;

class InteractiveLinkShowcase implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'edgtf_interactive_link_showcase';

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
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                      => esc_html__('Interactive Link Showcase', 'tetsuo-core'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by TETSUO', 'tetsuo-core' ),
                    'icon'                      => 'icon-wpb-interactive-link-showcase extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'skin',
                            'heading'    => esc_html__('Skin', 'tetsuo-core'),
                            'value'      => array(
                                esc_html__('Light', 'tetsuo-core') => 'light',
                                esc_html__('Dark', 'tetsuo-core')  => 'dark'
                            )
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
                            'type'        => 'dropdown',
                            'param_name'  => 'target',
                            'heading'     => esc_html__('Link Target', 'tetsuo-core'),
                            'value'       => array_flip(tetsuo_edge_get_link_target_array()),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'param_group',
                            'heading'    => esc_html__('Link Items', 'tetsuo-core'),
                            'param_name' => 'link_items',
                            'value'      => '',
                            'params'     => array(
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'title',
                                    'heading'     => esc_html__('Text', 'tetsuo-core'),
                                    'save_always' => true,
                                    'admin_label' => true
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
                                ),
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

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'skin'          => 'light',
            'bottom_widget' => '',
            'target'        => '_self',
            'link_items'    => '',
			'split_hover'	=> ''
        );

        $params = shortcode_atts($args, $atts);
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['content'] = $content;
        $params['link_items'] = json_decode(urldecode($params['link_items']), true);

        $html = tetsuo_core_get_shortcode_module_template_part('templates/interactive-link-showcase', 'interactive-link-showcase', '', $params);

        return $html;
    }

    /**
     * Generates holder classes
     *
     * @param $params
     *
     * @return string
     */
    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = 'edgtf-ils';
        if (!empty($params['skin'])) {
            $holderClasses[] = 'edgtf-ils-skin-' . $params['skin'];
        }
        
		if ($params['split_hover'] == 'yes' ) {
			$holderClasses[] = 'edgtf-ils-with-split-hover';
		}

        return implode(' ', $holderClasses);
    }
}