<?php
namespace TetsuoCore\CPT\Shortcodes\PricingTable;

use TetsuoCore\Lib;

class PricingTableItem implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'edgtf_pricing_table_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                      => esc_html__('Pricing Table Item', 'tetsuo-core'),
                    'base'                      => $this->base,
                    'icon'                      => 'icon-wpb-pricing-table-item extended-custom-icon',
                    'category'                  => esc_html__('by TETSUO', 'tetsuo-core'),
                    'allowed_container_element' => 'vc_row',
                    'as_child'                  => array('only' => 'edgtf_pricing_table'),
                    'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'custom_class',
                            'heading'     => esc_html__('Custom CSS Class', 'tetsuo-core'),
                            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'skin',
                            'heading'     => esc_html__('Skin', 'tetsuo-core'),
                            'value'       => array(
                                esc_html__('Light', 'edge-core') => 'light',
                                esc_html__('Dark', 'edge-core')  => 'dark'
                            ),
                            'save_always' => true,
                            'admin_label' => true,
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'set_active_item',
                            'heading'     => esc_html__('Set Item As Active', 'tetsuo-core'),
                            'value'       => array_flip(tetsuo_edge_get_yes_no_select_array(false)),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'content_background_color',
                            'heading'    => esc_html__('Content Background Color', 'tetsuo-core')
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title',
                            'heading'     => esc_html__('Title', 'tetsuo-core'),
                            'value'       => esc_html__('Basic Plan', 'tetsuo-core'),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_color',
                            'heading'    => esc_html__('Title Color', 'tetsuo-core'),
                            'dependency' => array('element' => 'title', 'not_empty' => true)
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'price',
                            'heading'    => esc_html__('Price', 'tetsuo-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'price_color',
                            'heading'    => esc_html__('Price Color', 'tetsuo-core'),
                            'dependency' => array('element' => 'price', 'not_empty' => true)
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'currency',
                            'heading'     => esc_html__('Currency', 'tetsuo-core'),
                            'description' => esc_html__('Default mark is $', 'tetsuo-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'currency_color',
                            'heading'    => esc_html__('Currency Color', 'tetsuo-core'),
                            'dependency' => array('element' => 'currency', 'not_empty' => true)
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'button_text',
                            'heading'     => esc_html__('Button Text', 'tetsuo-core'),
                            'value'       => esc_html__('BUY NOW', 'tetsuo-core'),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link',
                            'heading'    => esc_html__('Button Link', 'tetsuo-core'),
                            'dependency' => array('element' => 'button_text', 'not_empty' => true)
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'button_type',
                            'heading'     => esc_html__('Button Type', 'tetsuo-core'),
                            'value'       => array(
                                esc_html__('Solid', 'tetsuo-core')   => 'solid',
                                esc_html__('Outline', 'tetsuo-core') => 'outline'
                            ),
                            'save_always' => true,
                            'dependency'  => array('element' => 'button_text', 'not_empty' => true)
                        ),
                        array(
                            'type'       => 'textarea_html',
                            'param_name' => 'content',
                            'heading'    => esc_html__('Content', 'tetsuo-core'),
                            'value'      => '<li>content content content</li><li>content content content</li><li>content content content</li>'
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class'             => '',
            'skin'                     => 'light',
            'set_active_item'          => 'no',
            'content_background_color' => '',
            'title'                    => '',
            'title_color'              => '',
            'price'                    => '100',
            'price_color'              => '',
            'currency'                 => '$',
            'currency_color'           => '',
            'button_text'              => '',
            'link'                     => '',
            'button_type'              => 'outline'
        );
        $params = shortcode_atts($args, $atts);

        $params['content'] = preg_replace('#^<\/p>|<p>$#', '', $content); // delete p tag before and after content
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['holder_styles'] = $this->getHolderStyles($params);
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['price_styles'] = $this->getPriceStyles($params);
        $params['currency_styles'] = $this->getCurrencyStyles($params);
        $params['button_type'] = !empty($params['button_type']) ? $params['button_type'] : $args['button_type'];

        $html = tetsuo_core_get_shortcode_module_template_part('templates/pricing-table-template', 'pricing-table', '', $params);

        return $html;
    }

    private function getHolderClasses($params) {
        $holderClasses = array();

        $holderClasses[] = !empty($params['custom_class']) ? esc_attr($params['custom_class']) : '';
        $holderClasses[] = $params['set_active_item'] === 'yes' ? 'edgtf-pt-active-item' : '';
        $holderClasses[] = !empty( $params['skin'] ) ? 'edgtf-'. $params['skin']. '-skin' : '';

        return implode(' ', $holderClasses);
    }

    private function getHolderStyles($params) {
        $itemStyle = array();

        if (!empty($params['content_background_color'])) {
            $itemStyle[] = 'background-color: ' . $params['content_background_color'];
        }

        return implode(';', $itemStyle);
    }

    private function getTitleStyles($params) {
        $itemStyle = array();

        if (!empty($params['title_color'])) {
            $itemStyle[] = 'color: ' . $params['title_color'];
        }

        return implode(';', $itemStyle);
    }

    private function getPriceStyles($params) {
        $itemStyle = array();

        if (!empty($params['price_color'])) {
            $itemStyle[] = 'color: ' . $params['price_color'];
        }

        return implode(';', $itemStyle);
    }

    private function getCurrencyStyles($params) {
        $itemStyle = array();

        if (!empty($params['currency_color'])) {
            $itemStyle[] = 'color: ' . $params['currency_color'];
        }

        return implode(';', $itemStyle);
    }
}