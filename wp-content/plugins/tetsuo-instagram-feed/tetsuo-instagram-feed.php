<?php
/*
Plugin Name: Tetsuo Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Edge Themes
Version: 2.0.1
*/
define('TETSUO_INSTAGRAM_FEED_VERSION', '2.0.1');
define('TETSUO_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('TETSUO_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'TETSUO_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'TETSUO_INSTAGRAM_ASSETS_PATH', TETSUO_INSTAGRAM_ABS_PATH . '/assets' );
define( 'TETSUO_INSTAGRAM_ASSETS_URL_PATH', TETSUO_INSTAGRAM_URL_PATH . 'assets' );
define( 'TETSUO_INSTAGRAM_SHORTCODES_PATH', TETSUO_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'TETSUO_INSTAGRAM_SHORTCODES_URL_PATH', TETSUO_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'tetsuo_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function tetsuo_instagram_theme_installed() {
        return defined( 'EDGE_ROOT' );
    }
}

if ( ! function_exists( 'tetsuo_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function tetsuo_instagram_feed_text_domain() {
		load_plugin_textdomain( 'tetsuo-instagram-feed', false, TETSUO_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'tetsuo_instagram_feed_text_domain' );
}