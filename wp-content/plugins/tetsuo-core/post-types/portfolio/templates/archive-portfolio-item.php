<?php
get_header();
tetsuo_edge_get_title();
do_action( 'tetsuo_edge_action_before_main_content' ); ?>
<div class="edgtf-container edgtf-default-page-template">
	<?php do_action( 'tetsuo_edge_action_after_container_open' ); ?>
	<div class="edgtf-container-inner clearfix">
		<?php
			$tetsuo_taxonomy_id   = get_queried_object_id();
			$tetsuo_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$tetsuo_taxonomy      = ! empty( $tetsuo_taxonomy_id ) ? get_term_by( 'id', $tetsuo_taxonomy_id, $tetsuo_taxonomy_type ) : '';
			$tetsuo_taxonomy_slug = ! empty( $tetsuo_taxonomy ) ? $tetsuo_taxonomy->slug : '';
			$tetsuo_taxonomy_name = ! empty( $tetsuo_taxonomy ) ? $tetsuo_taxonomy->taxonomy : '';
			
			tetsuo_core_get_archive_portfolio_list( $tetsuo_taxonomy_slug, $tetsuo_taxonomy_name );
		?>
	</div>
	<?php do_action( 'tetsuo_edge_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
