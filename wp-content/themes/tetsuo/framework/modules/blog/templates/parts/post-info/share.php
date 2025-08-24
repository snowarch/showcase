<?php
$share_type = isset( $share_type ) ? $share_type : 'list';
$icon_font = 'font-awesome';
?>
<?php if ( tetsuo_edge_core_plugin_installed() && tetsuo_edge_options()->getOptionValue( 'enable_social_share' ) === 'yes' && tetsuo_edge_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="edgtf-blog-share">
		<h5 class="edgtf-blog-share-text"><?php esc_html_e( 'Share:', 'tetsuo' ); ?></h5> <?php echo tetsuo_edge_get_social_share_html( array( 'type' => $share_type, 'icon_type' => $icon_font ) ); ?>
	</div>
<?php } ?>