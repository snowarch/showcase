<?php
namespace TetsuoCore\CPT\Shortcodes\SocialShare;

use TetsuoCore\Lib;

class SocialShare implements Lib\ShortcodeInterface
{
    private $base;
    private $socialNetworks;

    function __construct() {
        $this->base = 'edgtf_social_share';
        $this->socialNetworks = array(
            'facebook',
            'twitter',
            'linkedin',
            'tumblr',
            'pinterest',
            'vk'
        );
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function getSocialNetworks() {
        return $this->socialNetworks;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                      => esc_html__('Social Share', 'tetsuo-core'),
                    'base'                      => $this->getBase(),
                    'icon'                      => 'icon-wpb-social-share extended-custom-icon',
                    'category'                  => esc_html__('by TETSUO', 'tetsuo-core'),
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'skin',
                            'heading'     => esc_html__('Skin', 'tetsuo-core'),
                            'value'       => array(
                                esc_html__('Default', 'tetsuo-core') => '',
                                esc_html__('Dark', 'tetsuo-core')    => 'edgtf-dark-skin',
                            ),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'type',
                            'heading'    => esc_html__('Type', 'tetsuo-core'),
                            'value'      => array(
                                esc_html__('List', 'tetsuo-core')     => 'list',
                                esc_html__('Dropdown', 'tetsuo-core') => 'dropdown',
                                esc_html__('Text', 'tetsuo-core')     => 'text'
                            )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'icon_type',
                            'heading'    => esc_html__('Icons Type', 'tetsuo-core'),
                            'value'      => array(
                                esc_html__('Font Awesome', 'tetsuo-core') => 'font-awesome',
                                esc_html__('Font Elegant', 'tetsuo-core') => 'font-elegant'
                            ),
                            'dependency' => array('element' => 'type', 'value' => array('list', 'dropdown'))
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'title',
                            'heading'    => esc_html__('Social Share Title', 'tetsuo-core')
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'skin'      => '',
            'type'      => 'list',
            'icon_type' => 'font-elegant',
            'title'     => ''
        );
        $params = shortcode_atts($args, $atts);

        //Is social share enabled
        $params['enable_social_share'] = (tetsuo_edge_options()->getOptionValue('enable_social_share') == 'yes') ? true : false;

        //Is social share enabled for post type
        $post_type = str_replace('-', '_', get_post_type());
        $params['enabled'] = (tetsuo_edge_options()->getOptionValue('enable_social_share_on_' . $post_type) == 'yes') ? true : false;

        //Social Networks Data
        $params['networks'] = $this->getSocialNetworksParams($params);
        $params['holder_classes'] = $this->getHolderClasses( $params );

        $html = '';

        if ($params['enable_social_share']) {
            if ($params['enabled']) {
                $html .= tetsuo_core_get_shortcode_module_template_part('templates/' . $params['type'], 'social-share', '', $params);
            }
        }

        return $html;
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';

        return implode( ' ', $holderClasses );
    }

    /**
     * Get Social Networks data to display
     * @return array
     */
    private function getSocialNetworksParams($params) {
        $networks = array();
        $icons_type = $params['icon_type'];
        $type = $params['type'];

        foreach ($this->socialNetworks as $net) {
            $html = '';

            if (tetsuo_edge_options()->getOptionValue('enable_' . $net . '_share') == 'yes') {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                $params = array(
                    'name' => $net,
                    'type' => $type
                );

                $params['link'] = $this->getSocialNetworkShareLink($net, $image);

                if ($type == 'text') {
                    $params['text'] = $this->getSocialNetworkText($net);
                } else {
                    $params['icon'] = $this->getSocialNetworkIcon($net, $icons_type);
                }

                $params['custom_icon'] = (tetsuo_edge_options()->getOptionValue($net . '_icon')) ? tetsuo_edge_options()->getOptionValue($net . '_icon') : '';

                $html = tetsuo_core_get_shortcode_module_template_part('templates/parts/network', 'social-share', '', $params);
            }

            $networks[$net] = $html;
        }

        return $networks;
    }

    /**
     * Get share link for networks
     *
     * @param $net
     * @param $image
     * @return string
     */
    private function getSocialNetworkShareLink($net, $image) {
        switch ($net) {
            case 'facebook':
                if (wp_is_mobile()) {
                    $link = 'window.open(\'http://m.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '\');';
                } else {
                    $link = 'window.open(\'http://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
                }
                break;
            case 'twitter':
            case 'twitter':
                $count_char = (isset($_SERVER['https'])) ? 23 : 22;
                $twitter_via = (tetsuo_edge_options()->getOptionValue('twitter_via') !== '') ? esc_attr__( ' via ', 'tetsuo-core' ) . tetsuo_edge_options()->getOptionValue('twitter_via') . ' ' : '';
                $link        = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( tetsuo_edge_the_excerpt_max_charlength( $count_char ) . $twitter_via ) . ' ' . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
                break;
            case 'linkedin':
                $link = 'popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'tumblr':
                $link = 'popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'pinterest':
                $media = ( $image ) ? '&amp;image=' . urlencode( $image[0] ) : '';
                $link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . urlencode(get_the_title()) . $media . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'vk':
                $media = ( $image ) ? '&amp;image=' . urlencode( $image[0] ) : '';
                $link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . $media . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            default:
                $link = '';
        }

        return $link;
    }

    private function getSocialNetworkIcon($net, $type) {
        switch ($net) {
            case 'facebook':
                $icon = ($type == 'font-elegant') ? 'social_facebook' : 'fab fa-facebook-f';
                break;
            case 'twitter':
                $icon = ($type == 'font-elegant') ? 'social_twitter' : 'fab fa-twitter';
                break;
            case 'linkedin':
                $icon = ($type == 'font-elegant') ? 'social_linkedin' : 'fab fa-linkedin-in';
                break;
            case 'tumblr':
                $icon = ($type == 'font-elegant') ? 'social_tumblr' : 'fab fa-tumblr';
                break;
            case 'pinterest':
                $icon = ($type == 'font-elegant') ? 'social_pinterest' : 'fab fa-pinterest';
                break;
            case 'vk':
                $icon = 'fab fa-vk';
                break;
            default:
                $icon = '';
        }

        return $icon;
    }

    private function getSocialNetworkText($net) {
        switch ($net) {
            case 'facebook':
                $text = esc_html__('fb', 'tetsuo-core');
                break;
            case 'twitter':
                $text = esc_html__('tw', 'tetsuo-core');
                break;
            case 'linkedin':
                $text = esc_html__('lnkd', 'tetsuo-core');
                break;
            case 'tumblr':
                $text = esc_html__('tmb', 'tetsuo-core');
                break;
            case 'pinterest':
                $text = esc_html__('pin', 'tetsuo-core');
                break;
            case 'vk':
                $text = esc_html__('vk', 'tetsuo-core');
                break;
            default:
                $text = '';
        }

        return $text;
    }
}