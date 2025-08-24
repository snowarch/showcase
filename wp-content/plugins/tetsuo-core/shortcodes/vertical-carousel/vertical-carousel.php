<?php
namespace TetsuoCore\CPT\Shortcodes\VerticalCarousel;

use TetsuoCore\Lib;

class VerticalCarousel implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'edgtf_vertical_carousel';

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
                    'name'                      => esc_html__('Vertical Carousel', 'tetsuo-core'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by TETSUO', 'tetsuo-core' ),
                    'icon'                      => 'icon-wpb-vertical-carousel extended-custom-icon',
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
                            'type'       => 'param_group',
                            'heading'    => esc_html__('Items', 'tetsuo-core'),
                            'param_name' => 'items',
                            'value'      => '',
                            'params'     => array(
                                array(
                                    'type'        => 'attach_image',
                                    'param_name'  => 'image',
                                    'heading'     => esc_html__('Image', 'tetsuo-core'),
                                    'description' => esc_html__('Select image from media library', 'tetsuo-core')
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'title',
                                    'heading'     => esc_html__('Text', 'tetsuo-core'),
                                    'admin_label' => true
                                ),
                                array(
                                    'type'        => 'textarea',
                                    'param_name'  => 'description',
                                    'heading'     => esc_html__('Description', 'tetsuo-core'),
                                    'save_always' => true,
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link_1',
                                    'heading'    => esc_html__('Link 1', 'tetsuo-core')
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link_text_1',
                                    'heading'    => esc_html__('Link Text 1', 'tetsuo-core'),
							        'dependency' => array( 'element' => 'link_1', 'not_empty' => true )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link_2',
                                    'heading'    => esc_html__('Link 2', 'tetsuo-core')
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link_text_2',
                                    'heading'    => esc_html__('Link Text 2', 'tetsuo-core'),
							        'dependency' => array( 'element' => 'link_2', 'not_empty' => true )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'touch_devices_link',
                                    'heading'    => esc_html__('Touch Devices Link', 'tetsuo-core'),
                                    'description' => esc_html__('This link will be used placed over image on touch devices only.', 'tetsuo-core')
                                ),
                            )
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
            'items'    => '',
            'touch_devices_link' => ''
        );

        $params = shortcode_atts($args, $atts);
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['content'] = $content;
        $params['items'] = json_decode(urldecode($params['items']), true);

        $html = tetsuo_core_get_shortcode_module_template_part('templates/vertical-carousel-template', 'vertical-carousel', '', $params);

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

        if (!empty($params['skin'])) {
            $holderClasses[] = 'edgtf-vc-skin-' . $params['skin'];
        }

        return implode(' ', $holderClasses);
    }
}