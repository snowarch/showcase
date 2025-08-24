<?php
namespace TetsuoCore\CPT\Shortcodes\imageMarquee;

use TetsuoCore\Lib;

class imageMarquee implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'edgtf_image_marquee';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                      => esc_html__('Image Marquee', 'tetsuo-core'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__('by TETSUO', 'tetsuo-core'),
                    'icon'                      => 'icon-wpb-image-marquee extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'marquee_type',
                            'heading'     => esc_html__('Marquee Type', 'tetsuo-core'),
                            'value'       => array(
                                esc_html__('Simple', 'tetsuo-core')       => 'simple',
                                esc_html__('With Content', 'tetsuo-core') => 'with-content'
                            ),
                            'admin_label' => true,
                            'group'       => esc_html__('Marquee Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'marquee_layout',
                            'heading'     => esc_html__('Marquee Layout', 'tetsuo-core'),
                            'value'       => array(
                                esc_html__('Default', 'tetsuo-core')     => 'default',
                                esc_html__('Full Height', 'tetsuo-core') => 'full-height'
                            ),
                            'admin_label' => true,
                            'group'       => esc_html__('Marquee Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'marquee_image',
                            'heading'     => esc_html__('Marquee Image', 'tetsuo-core'),
                            'description' => esc_html__('Select image from media library', 'tetsuo-core'),
                            'group'       => esc_html__('Marquee Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'content_image',
                            'heading'     => esc_html__('Content Image', 'tetsuo-core'),
                            'description' => esc_html__('Select image from media library', 'tetsuo-core'),
                            'dependency'  => array('element' => 'marquee_type', 'value' => 'with-content'),
                            'group'       => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'bold_title',
                            'heading'     => esc_html__('Bold Title', 'tetsuo-core'),
                            'dependency'  => array('element' => 'marquee_type', 'value' => 'with-content'),
                            'admin_label' => true,
                            'group'       => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'regular_title',
                            'heading'     => esc_html__('Regular Title', 'tetsuo-core'),
                            'dependency'  => array('element' => 'marquee_type', 'value' => 'with-content'),
                            'admin_label' => true,
                            'group'       => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'regular_title_italic_words',
                            'heading'     => esc_html__('Italic Words', 'tetsuo-core'),
                            'description' => esc_html__('Enter the positions of the words you would like to become italic. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to be become italic, you would enter "1,3,4")', 'tetsuo-core'),
                            'dependency'  => array('element' => 'regular_title', 'not_empty' => true),
                            'group'       => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'regular_title_dot',
                            'heading'     => esc_html__('Enable Emphasized Dot', 'tetsuo-core'),
                            'value'       => array_flip(tetsuo_edge_get_yes_no_select_array(false, true)),
                            'dependency'  => array('element' => 'regular_title', 'not_empty' => true),
                            'save_always' => true,
                            'group'       => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'titles_color',
                            'heading'    => esc_html__('Titles Color', 'tetsuo-core'),
                            'dependency' => array('element' => 'marquee_type', 'value' => 'with-content'),
                            'group'      => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'button_text',
                            'heading'     => esc_html__('Button Text', 'tetsuo-core'),
                            'dependency'  => array('element' => 'marquee_type', 'value' => 'with-content'),
                            'admin_label' => true,
                            'group'       => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'button_link',
                            'heading'     => esc_html__('Button Link', 'tetsuo-core'),
                            'dependency'  => array('element' => 'button_text', 'not_empty' => true),
                            'admin_label' => true,
                            'group'       => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_color',
                            'heading'    => esc_html__('Button Color', 'tetsuo-core'),
                            'dependency' => array('element' => 'button_text', 'not_empty' => true),
                            'group'      => esc_html__('Content Options', 'tetsuo-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_background_color',
                            'heading'    => esc_html__('Button Background Color', 'tetsuo-core'),
                            'dependency' => array('element' => 'button_text', 'not_empty' => true),
                            'group'      => esc_html__('Content Options', 'tetsuo-core')
                        ),
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'marquee_type'               => 'simple',
            'marquee_layout'             => 'default',
            'marquee_image'              => '',
            'content_image'              => '',
            'bold_title'                 => '',
            'regular_title'              => '',
            'regular_title_italic_words' => '',
            'regular_title_dot'          => '',
            'titles_color'               => '',
            'button_text'                => '',
            'button_link'                => '',
            'button_color'               => '',
            'button_background_color'    => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['titles_color'] = $this->getTitlesStyles($params);
        $params['regular_title'] = $this->getModifiedRegularTitle($params);
        $params['button_params'] = $this->getButtonParameters($params);

        $html = tetsuo_core_get_shortcode_module_template_part('templates/image-marquee-template', 'image-marquee', '', $params);

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['marquee_layout']) ? 'edgtf-im-' . $params['marquee_layout'] : '';
        $holderClasses[] = !empty($params['marquee_type']) ? 'edgtf-im-' . $params['marquee_type'] : '';
        $holderClasses[] = $params['regular_title_dot'] === 'yes' ? 'edgtf-im-regular-title-dot' : '';

        return implode(' ', $holderClasses);
    }

    private function getTitlesStyles($params) {
        $styles = array();

        if (!empty($params['titles_color'])) {
            $styles[] = 'color: ' . $params['titles_color'];
        }

        return implode(';', $styles);
    }

    private function getModifiedRegularTitle($params) {
        $subtitle = $params['regular_title'];
        $subtitle_italic_words = str_replace(' ', '', $params['regular_title_italic_words']);

        if (!empty($subtitle)) {
            $italic_words = explode(',', $subtitle_italic_words);
            $split_subtitle = explode(' ', $subtitle);

            if (!empty($subtitle_italic_words)) {
                foreach ($italic_words as $value) {
                    if (!empty($split_subtitle[$value - 1])) {
                        $split_subtitle[$value - 1] = '<span class="edgtf-im-regular-title-italic">' . $split_subtitle[$value - 1] . '</span>';
                    }
                }
            }

            $subtitle = implode(' ', $split_subtitle);
        }

        return $subtitle;
    }

    private function getButtonParameters($params) {
        $button_params_array = array();

        if (!empty($params['button_text'])) {
            $button_params_array['text'] = $params['button_text'];
        }

        if (!empty($params['button_link'])) {
            $button_params_array['link'] = $params['button_link'];
        }

        if (!empty($params['button_color'])) {
            $button_params_array['color'] = $params['button_color'];
        }

        if (!empty($params['button_background_color'])) {
            $button_params_array['background_color'] = $params['button_background_color'];
        }

        $button_params_array['type'] = 'solid';
        $button_params_array['size'] = 'large';
        $button_params_array['target'] = '_blank';
        $button_params_array['custom_class'] = 'edgtf-im-btn';
        $button_params_array['icon_pack'] = 'font_awesome';
        $button_params_array['fa_icon'] = 'fa-chevron-right';
        $button_params_array['icon_class'] = 'edgtf-btn-icon';

        return $button_params_array;
    }
}