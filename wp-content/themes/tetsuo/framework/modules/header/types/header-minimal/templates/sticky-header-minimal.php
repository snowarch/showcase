<?php do_action('tetsuo_edge_action_after_sticky_header'); ?>

<div class="edgtf-sticky-header">
    <?php do_action('tetsuo_edge_action_after_sticky_menu_html_open'); ?>
    <div class="edgtf-sticky-holder">
        <?php if ($sticky_header_in_grid) : ?>
        <div class="edgtf-grid">
            <?php endif; ?>
            <div class=" edgtf-vertical-align-containers">
                <div class="edgtf-position-left"><!--
                 --><div class="edgtf-position-left-inner">
                        <?php if (!$hide_logo) {
                            tetsuo_edge_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="edgtf-position-right"><!--
                 --><div class="edgtf-position-right-inner">
                        <a href="javascript:void(0)" <?php tetsuo_edge_class_attribute( $fullscreen_menu_icon_class ); ?>>
                            <span class="edgtf-fullscreen-menu-close-icon">
                                <?php echo tetsuo_edge_get_icon_sources_html( 'fullscreen_menu', true ); ?>
                            </span>
                            <span class="edgtf-fullscreen-menu-opener-icon">
                                <?php echo tetsuo_edge_get_icon_sources_html( 'fullscreen_menu' ); ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($sticky_header_in_grid) : ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php do_action('tetsuo_edge_action_after_sticky_header'); ?>
