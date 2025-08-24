<?php

tetsuo_edge_get_single_post_format_html( $blog_single_type );

do_action( 'tetsuo_edge_action_after_article_content' );

tetsuo_edge_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

tetsuo_edge_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );

tetsuo_edge_get_module_template_part( 'templates/parts/single/comments', 'blog' );