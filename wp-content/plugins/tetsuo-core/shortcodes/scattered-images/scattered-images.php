<?php

namespace TetsuoCore\CPT\Shortcodes\ScatteredImages;

use TetsuoCore\Lib;

class ScatteredImages implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'edgtf_scattered_images';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                      => esc_html__('Scattered Images', 'tetsuo-core'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-scattered-images extended-custom-icon',
            'category'                  => 'by TETSUO',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Layout', 'tetsuo-core'),
                    'param_name'  => 'layout',
                    'value'       => array(
                        esc_html__('Images on the left', 'tetsuo-core')  => 'left',
                        esc_html__('Images on the right', 'tetsuo-core') => 'right'
                    ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_image_shadow',
                    'heading'     => esc_html__('Enable Shadow on Images', 'tetsuo-core'),
                    'value'       => array_flip(tetsuo_edge_get_yes_no_select_array(false)),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'skin',
                    'heading'     => esc_html__('Skin', 'tetsuo-core'),
                    'value'       => array(
                        esc_html__('Default', 'tetsuo-core') => '',
                        esc_html__('Dark', 'tetsuo-core')    => 'edgtf-dark-skin',
                    ),
                    'save_always' => true,
                    'group'       => esc_html__('Typography', 'tetsuo-core'),
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Title', 'tetsuo-core'),
                    'param_name'  => 'title',
                    'group'       => esc_html__('Typography', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => esc_html__('Text', 'tetsuo-core'),
                    'param_name' => 'text',
                    'group'      => esc_html__('Typography', 'tetsuo-core'),
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'button_text',
                    'heading'     => esc_html__('Button Text', 'tetsuo-core'),
                    'value'       => esc_html__('View Project', 'tetsuo-core'),
                    'save_always' => true,
                    'group'       => esc_html__('Button Style', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'button_top_margin',
                    'heading'    => esc_html__('Button Top Margin (px)', 'tetsuo-core'),
                    'dependency' => array('element' => 'layout', 'value' => array('simple')),
                    'group'      => esc_html__('Button Style', 'tetsuo-core')
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'button_link',
                    'heading'    => esc_html__('Button Link', 'tetsuo-core'),
                    'group'      => esc_html__('Button Style', 'tetsuo-core')
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'button_target',
                    'heading'    => esc_html__('Button Link Target', 'tetsuo-core'),
                    'value'      => array_flip(tetsuo_edge_get_link_target_array()),
                    'group'      => esc_html__('Button Style', 'tetsuo-core')
                ),
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__('Hero Image', 'tetsuo-core'),
                    'param_name'  => 'hero_image',
                    'description' => esc_html__('This image along with the textual content will set the overall shortcode height.', 'tetsuo-core'),
                    'group'       => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__('Hero Image Link', 'tetsuo-core'),
                    'param_name' => 'hero_image_link',
                    'dependency' => array('element' => 'hero_image', 'not_empty' => true),
                    'group'      => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Hero Image Link Target', 'tetsuo-core'),
                    'param_name' => 'hero_image_link_target',
                    'value'      => array(
                        esc_html__('Self', 'tetsuo-core')  => '_self',
                        esc_html__('Blank', 'tetsuo-core') => '_blank'
                    ),
                    'dependency' => array('element' => 'hero_image_link', 'not_empty' => true),
                    'group'      => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__('Aux Image 1', 'tetsuo-core'),
                    'param_name' => 'aux_image_1',
                    'dependency' => array('element' => 'hero_image', 'not_empty' => true),
                    'group'      => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__('Aux Image Link', 'tetsuo-core'),
                    'param_name' => 'aux_image_1_link',
                    'dependency' => array('element' => 'aux_image_1', 'not_empty' => true),
                    'group'      => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Hero Image Link Target', 'tetsuo-core'),
                    'param_name' => 'aux_image_1_link_target',
                    'value'      => array(
                        esc_html__('Self', 'tetsuo-core')  => '_self',
                        esc_html__('Blank', 'tetsuo-core') => '_blank'
                    ),
                    'dependency' => array('element' => 'aux_image_1_link', 'not_empty' => true),
                    'group'      => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__('Aux Image 2', 'tetsuo-core'),
                    'param_name' => 'aux_image_2',
                    'dependency' => array('element' => 'hero_image', 'not_empty' => true),
                    'group'      => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__('Hero Image Link', 'tetsuo-core'),
                    'param_name' => 'aux_image_2_link',
                    'dependency' => array('element' => 'aux_image_2', 'not_empty' => true),
                    'group'      => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Hero Image Link Target', 'tetsuo-core'),
                    'param_name' => 'aux_image_2_link_target',
                    'value'      => array(
                        esc_html__('Self', 'tetsuo-core')  => '_self',
                        esc_html__('Blank', 'tetsuo-core') => '_blank'
                    ),
                    'dependency' => array('element' => 'aux_image_2_link', 'not_empty' => true),
                    'group'      => esc_html__('Images', 'tetsuo-core'),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Enable Parallax', 'tetsuo-core'),
                    'param_name' => 'enable_parallax',
                    'value'      => array(
                        esc_html__('Yes', 'tetsuo-core') => 'yes',
                        esc_html__('No', 'tetsuo-core')  => 'no'
                    ),
                    'group'      => esc_html__('Additional Options', 'tetsuo-core'),
                ),
            )
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'layout'                  => 'left',
            'enable_image_shadow'     => 'no',
            'skin'                    => '',
            'title'                   => '',
            'title_color'             => '',
            'text'                    => '',
            'text_color'              => '',
            'hero_image'              => '',
            'hero_image_link'         => '',
            'hero_image_link_target'  => '_self',
            'aux_image_1'             => '',
            'aux_image_1_link'        => '',
            'aux_image_1_link_target' => '_self',
            'aux_image_2'             => '',
            'aux_image_2_link'        => '',
            'aux_image_2_link_target' => '_self',
            'enable_parallax'         => 'yes',
            'button_text'             => 'VIEW PROJECT',
            'button_top_margin'       => '',
            'button_link'             => '',
            'button_target'           => '_self',
        );

        //Extract params for use in method
        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['si_slasses'] = $this->getSIClasses($params);
        $params['button_holder_styles'] = $this->getButtonHolderStyles($params);
        $params['button_parameters'] = $this->getButtonParameters($params);
        $params['parallax_data_1'] = $this->getParallaxData1($params);
        $params['parallax_data_2'] = $this->getParallaxData2($params);
        $params['parallax_data_3'] = $this->getParallaxData3($params);

        $html = tetsuo_core_get_shortcode_module_template_part('templates/scattered-images-template', 'scattered-images', '', $params);

        return $html;

    }

    private function getButtonHolderStyles($params) {
        $styles = array();

        if (!empty($params['button_top_margin']) && $params['layout'] === 'simple') {
            $styles[] = 'margin-top: ' . tetsuo_edge_filter_px($params['button_top_margin']) . 'px';
        }

        return implode(';', $styles);
    }

    private function getButtonParameters($params) {
        $button_params_array = array();

        if (!empty($params['button_text'])) {
            $button_params_array['text'] = $params['button_text'];
        }

        if (!empty($params['button_link'])) {
            $button_params_array['link'] = $params['button_link'];
        }

        $button_params_array['target'] = !empty($params['button_target']) ? $params['button_target'] : '_self';

        $button_params_array['type'] = 'outline';

        if (!empty($params['button_size'])) {
            $button_params_array['size'] = 'medium';
        }

        return $button_params_array;
    }

    /**
     * Returns array of HTML classes for Scattered Images shortcode
     *
     * @param $params
     *
     * @return array
     */
    private function getSIClasses($params) {
        $si_classes = array('edgtf-scattered-images');

        if (!empty($params['layout'])) {
            $si_classes[] = 'edgtf-si-' . $params['layout'];
        }

        $si_classes[] = !empty($params['skin']) ? $params['skin'] : '';

        $si_classes[] = $params['enable_image_shadow'] === 'yes' ? 'edgtf-has-shadow' : '';

        if (!empty($params['enable_parallax'])) {
            $si_classes[] = 'edgtf-si-parallax-' . $params['enable_parallax'];
        }

        return $si_classes;
    }

    public function getParallaxData1($params) {
        $parallaxData = array();

        if ($params['enable_parallax'] === 'yes') {
            $y_absolute = rand(40, 100);
            $smoothness = 20; //1 is for linear, non-animated parallax

            $parallaxData['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
        }

        return $parallaxData;
    }

    public function getParallaxData2($params) {
        $parallaxData = array();

        if ($params['enable_parallax'] === 'yes') {
            $y_absolute = rand(-80, -120);
            $smoothness = 20; //1 is for linear, non-animated parallax

            $parallaxData['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
        }

        return $parallaxData;
    }


    public function getParallaxData3($params) {
        $parallaxData = array();

        if ($params['enable_parallax'] === 'yes') {
            $y_absolute = rand(-60, -100);
            $smoothness = 20; //1 is for linear, non-animated parallax

            $parallaxData['data-parallax'] = '{&quot;y&quot;: ' . $y_absolute . ', &quot;smoothness&quot;: ' . $smoothness . '}';
        }

        return $parallaxData;
    }
}