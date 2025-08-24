<?php do_action('tetsuo_edge_action_before_page_header'); ?>

<aside class="edgtf-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
    <div class="edgtf-vertical-menu-area-inner">
		<a href="#" <?php tetsuo_edge_class_attribute( $vertical_closed_icon_class ); ?>>
			<span class="edgtf-vertical-area-close-icon">
				<?php echo tetsuo_edge_get_icon_sources_html( 'vertical_closed', true ); ?>
			</span>
			<span class="edgtf-vertical-area-opener-icon">
				<?php echo tetsuo_edge_get_icon_sources_html( 'vertical_closed' ); ?>
			</span>
		</a>
        <div class="edgtf-vertical-area-background"></div>
        <?php if(!$hide_logo) {
			tetsuo_edge_get_logo();
        } ?>
        <?php tetsuo_edge_get_header_vertical_closed_main_menu(); ?>
        <div class="edgtf-vertical-area-widget-holder">
			<?php tetsuo_edge_get_header_widget_area_one(); ?>
        </div>
    </div>
</aside>
<div class="edgtf-vertical-area-bottom-logo">
	<div class="edgtf-vertical-area-bottom-logo-inner">
		<?php if(!$hide_logo) {
			tetsuo_edge_get_logo();
		} ?>
	</div>
</div>

<?php do_action('tetsuo_edge_action_after_page_header'); ?>