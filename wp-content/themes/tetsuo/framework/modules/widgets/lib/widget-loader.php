<?php

if ( ! function_exists( 'tetsuo_edge_register_widgets' ) ) {
    function tetsuo_edge_register_widgets() {
        $widgets = apply_filters( 'tetsuo_edge_filter_register_widgets', $widgets = array() );

        if(tetsuo_edge_core_plugin_installed()) {
            foreach ($widgets as $widget) {
                tetsuo_edge_create_wp_widget($widget);
            }
        }
    }

    add_action( 'widgets_init', 'tetsuo_edge_register_widgets' );
}