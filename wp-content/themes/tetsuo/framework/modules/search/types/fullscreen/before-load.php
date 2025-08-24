<?php

if ( ! function_exists( 'tetsuo_edge_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function tetsuo_edge_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'tetsuo' );

        return $search_type_options;
    }

    add_filter( 'tetsuo_edge_filter_search_type_global_option', 'tetsuo_edge_set_search_fullscreen_global_option' );
}