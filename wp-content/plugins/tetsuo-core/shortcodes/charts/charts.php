<?php
namespace TetsuoCore\CPT\Shortcodes\Charts;

use TetsuoCore\Lib;

class Charts implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'edgtf_charts';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        $no_of_datasets = 3;
        $no_of_points = 12;

        /*
         * points tab begin
         */

        // first point group w/o dependency
        $points_array[] = array(
            'type' => 'dropdown',
            'class' => '',
            'heading' => esc_html__('Use Point Group 1', 'tetsuo-core'),
            'param_name' => 'points_1',
            'value' => array(
                esc_html__('Yes', 'tetsuo-core') => 'yes',
                esc_html__('No', 'tetsuo-core') => 'no',
            ),
            'save_always' => true,
            'description' => '',
            'group' => esc_html__('Points', 'tetsuo-core'),
        );

        $points_array[] = array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Point 1 Color', 'tetsuo-core'),
            'param_name' => 'point_1_color',
            'value' => '',
            'group' => esc_html__('Points', 'tetsuo-core'),
        );

        $points_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Point 1 Label', 'tetsuo-core'),
            'param_name' => 'point_1_label',
            'value' => '',
            'group' => esc_html__('Points', 'tetsuo-core'),
        );

        // from second to twelfth w/ dependency
        for ($i = 2; $i <= $no_of_points; $i++) {
            $points_array[] = array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => esc_html__('Use Point Group ', 'tetsuo-core') . $i,
                'param_name' => 'points_' . $i,
                'value' => array(
                    esc_html__('No', 'tetsuo-core') => 'no',
                    esc_html__('Yes', 'tetsuo-core') => 'yes',
                ),
                'save_always' => true,
                'description' => '',
                'group' => esc_html__('Points', 'tetsuo-core'),
                'dependency' => array('element' => 'points_' . ($i - 1), 'value' => 'yes')
            );

            $points_array[] = array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Point ', 'tetsuo-core') . $i . esc_html__(' Color', 'tetsuo-core'),
                'param_name' => 'point_' . $i . '_color',
                'value' => '',
                'group' => esc_html__('Points', 'tetsuo-core'),
                'dependency' => array('element' => 'points_' . $i, 'value' => 'yes')
            );

            $points_array[] = array(
                'type' => 'textfield',
                'heading' => esc_html__('Point ', 'tetsuo-core') . $i . esc_html__(' Label', 'tetsuo-core'),
                'param_name' => 'point_' . $i . '_label',
                'value' => '',
                'group' => esc_html__('Points', 'tetsuo-core'),
                'dependency' => array('element' => 'points_' . $i, 'value' => 'yes')
            );
        }

        /*
         * points tab end
         */

        /*
         * dataset tabs begin
         */

        for ($i = 1; $i <= $no_of_datasets; $i++) { // no of datasets

            $dataset_array[] = array(
                'type' => 'textfield',
                'heading' => esc_html__('Dataset ', 'tetsuo-core') . $i . esc_html__(' Label', 'tetsuo-core'),
                'param_name' => 'dataset_' . $i . '_label',
                'value' => '',
                'group' => esc_html__('Dataset ', 'tetsuo-core') . $i,
            );

            $dataset_array[] = array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Dataset ', 'tetsuo-core') . $i . esc_html__(' Color', 'tetsuo-core'),
                'param_name' => 'dataset_' . $i . '_color',
                'value' => '',
                'group' => esc_html__('Dataset ', 'tetsuo-core') . $i,
                'dependency' => array('element' => 'color_scheme', 'value' => 'dataset')
            );

            for ($j = 1; $j <= $no_of_points; $j++) { // no of points in dataset
                $dataset_array[] = array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Point ', 'tetsuo-core') . $j . esc_html__(' Value', 'tetsuo-core'),
                    'param_name' => 'point_' . $i . '_' . $j,
                    'value' => '',
                    'group' => esc_html__('Dataset ', 'tetsuo-core') . $i,
                    'dependency' => array('element' => 'points_' . $j, 'value' => 'yes')
                );
            }
        }

        /*
         * dataset tabs end
         */

        vc_map(array(
            'name' => esc_html__('Charts', 'tetsuo-core'),
            'base' => $this->base,
            'icon' => 'icon-wpb-charts extended-custom-icon',
            'category' => esc_html__('by TETSUO','tetsuo-core'),
            'allowed_container_element' => 'vc_row',
            'params' => array_merge(
                array(
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'skin',
                        'heading'     => esc_html__( 'Skin', 'tetsuo-core' ),
                        'value'       => array(
                            esc_html__( 'Light', 'tetsuo-core' )   => 'light',
                            esc_html__( 'Dark', 'tetsuo-core' )    => 'dark'
                        ),
                        'save_always' => true,
                        'description' => esc_html__( 'Choose a predefined style for chart elements', 'tetsuo-core' )
                    ),
                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => esc_html__('Type', 'tetsuo-core'),
                        'param_name' => 'type',
                        'value' => array(
                            esc_html__('Line', 'tetsuo-core') => 'line',
                            esc_html__('Vertical Bars', 'tetsuo-core') => 'bar',
                            esc_html__('Horizontal Bars', 'tetsuo-core') => 'horizontalBar',
                            esc_html__('Radar', 'tetsuo-core') => 'radar',
                            esc_html__('Polar', 'tetsuo-core') => 'polarArea',
                            esc_html__('Pie', 'tetsuo-core') => 'pie',
                            esc_html__('Doughnut', 'tetsuo-core') => 'doughnut',
                        ),
                        'save_always' => true,
                        'description' => ''
                    ),

                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => esc_html__('Legend Position', 'tetsuo-core'),
                        'std' => 'right',
                        'param_name' => 'legend_position',
                        'value' => array(
                            esc_html__('Top', 'tetsuo-core') => 'top',
                            esc_html__('Right', 'tetsuo-core') => 'right',
                            esc_html__('Bottom', 'tetsuo-core') => 'bottom',
                            esc_html__('Left', 'tetsuo-core') => 'left',
                        ),
                        'save_always' => true,
                        'description' => ''
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Color Scheme', 'tetsuo-core'),
                        'param_name' => 'color_scheme',
                        'value' => array(
                            esc_html__('One Color per Dataset', 'tetsuo-core') => 'dataset',
                            esc_html__('One Color per Point Group', 'tetsuo-core') => 'point',
                        ),
                        'save_always' => true,
                    ),
                ),
                $points_array,
                $dataset_array
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'type' => '',
            'skin' => '',
            'color_scheme' => '',
            'legend_position' => '',
        );

        $no_of_datasets = 3;
        $no_of_points = 12;

        $point_fields = array();
        $dataset_fields = array();

        for ($i = 1; $i <= $no_of_points; $i++) {
            $point_fields['point_' . $i . '_color'] = '';
            $point_fields['point_' . $i . '_label'] = '';
        }

        for ($i = 1; $i <= $no_of_datasets; $i++) {
            $dataset_fields['dataset_' . $i . '_color'] = '';
            $dataset_fields['dataset_' . $i . '_label'] = '';

            for ($j = 1; $j <= $no_of_points; $j++) {
                $dataset_fields['point_' . $i . '_' . $j] = '';
            }
        }

        $args = array_merge($args, $point_fields, $dataset_fields);
        $params = shortcode_atts($args, $atts);

        // extract params for use in method
        extract($params);

        for ($i = 1; $i <= $no_of_datasets; $i++) {
            $params['dataset_' . $i . '_values'] = $this->getDatasetValues($params, $i, $no_of_points);
        }
        $params['no_of_used_datasets'] = $this->getNoOfUsedDatasets($params, $no_of_datasets);
        $params['point_group_labels'] = $this->getPointGroupLabels($params, $no_of_points);
        $params['point_group_colors'] = $this->getPointGroupColors($params, $no_of_points);

        //var_dump($params);

        $html = '';
        $html .= '<div class="edgtf-charts" ';

        // inline data begin
        $html .= ' '. $this->getDataAttribute('type', $params['type']);
        $html .= ' '. $this->getDataAttribute('skin', $params['skin']);
        $html .= ' '. $this->getDataAttribute('no_of_used_datasets', $params['no_of_used_datasets']);
        for ($i = 1; $i <= $params['no_of_used_datasets']; $i++) {
            $html .= ' '.$this->getDataAttribute('dataset_' . $i, $params['dataset_' . $i . '_values']);
        }
        $html .= ' '. $this->getDataAttribute('point_group_labels', $params['point_group_labels']);
        $html .= ' '. $this->getDataAttribute('point_group_colors', $params['point_group_colors']);
        for ($i = 1; $i <= $params['no_of_used_datasets']; $i++) {
            $html .= ' '. $this->getDataAttribute('dataset_' . $i . '_label', $params['dataset_' . $i . '_label']);
            $html .= ' '. $this->getDataAttribute('dataset_' . $i . '_color', $params['dataset_' . $i . '_color']);
        }
        $html .= ' '.$this->getDataAttribute('color_scheme', $params['color_scheme']);
        $html .= ' '.$this->getDataAttribute('legend_position', $params['legend_position']);

        // inline data end

        $html .= '>';
        $html .= tetsuo_core_get_shortcode_module_template_part('templates/charts', 'charts', '', $params);
        $html .= '</div>';
        return $html;
    }

    /*
     * convert dataset values from shortcode into usable string
     *
     * @params $params - mixed, shortcode params
     * @params $dataset - integer, current dataset, since function is being called from loop
     * @params $no_of_points - integer, total number of points
     *
     * @return string
     */
    private function getDatasetValues($params, $dataset, $no_of_points) {
        $dataset_values = array();

        for ($i = 1; $i <= $no_of_points; $i++) {

            if ($params['point_' . $dataset . '_' . $i] != '')
                $dataset_values[] = $params['point_' . $dataset . '_' . $i];
        }

        $dataset_values = implode(',', $dataset_values);

        return $dataset_values;
    }

    /*
     * create data attribute for inline print in html
     *
     * @params $title - string, name of the data attribute
     * @params $raw_attribute - string, value of the data attribute
     *
     * @return string
     */
    private function getDataAttribute($title, $raw_attribute) {

        $data_attribute = 'data-' . $title . '="' . $raw_attribute . '"';

        //var_dump($data_attribute);

        return $data_attribute;
    }

    /*
     * determine how many datasets are being used in shortcode
     *
     * @params $params - mixed, shortcode params
     * @params $no_of_datasets - integer, total number of datasets available in shortcode interface
     *
     * @return integer
     */
    private function getNoOfUsedDatasets($params, $no_of_datasets) {

        for ($i = $no_of_datasets; $i >= 1; $i--) {
            if ($params['dataset_' . $i . '_values'] != '') {
                return $i;
            }
        }
    }

    /*
     *
     */
    private function getPointGroupLabels($params, $no_of_labels) {
        $point_group_labels = array();

        for ($i = 1; $i <= $no_of_labels; $i++) {

            if ($params['point_' . $i . '_label'] != '')
                $point_group_labels[] = $params['point_' . $i . '_label'];
        }

        $point_group_labels = implode(',', $point_group_labels);

        return $point_group_labels;
    }

    /*
     *
     */
    private function getPointGroupColors($params, $no_of_labels) {
        $point_group_colors = array();

        for ($i = 1; $i <= $no_of_labels; $i++) {

            if ($params['point_' . $i . '_color'] != '')
                $point_group_colors[] = $params['point_' . $i . '_color'];
        }

        $point_group_colors = implode(',', $point_group_colors);

        return $point_group_colors;
    }
}