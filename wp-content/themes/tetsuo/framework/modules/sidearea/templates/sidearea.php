<section class="edgtf-side-menu">
	<a <?php tetsuo_edge_class_attribute( $close_icon_classes ); ?> href="#">
		<?php echo tetsuo_edge_get_icon_sources_html( 'side_area', true ); ?>
	</a>
	<?php if ( is_active_sidebar( 'sidearea' ) ) {
		dynamic_sidebar( 'sidearea' );
	} ?>
</section>