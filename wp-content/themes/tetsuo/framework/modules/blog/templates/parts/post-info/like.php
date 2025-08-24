<?php if(tetsuo_edge_core_plugin_installed()) { ?>
    <div class="edgtf-blog-like">
        <?php if( function_exists('tetsuo_edge_get_like') ) tetsuo_edge_get_like(); ?>
    </div>
<?php } ?>