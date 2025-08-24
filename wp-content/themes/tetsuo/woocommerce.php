<?php
/*
Template Name: WooCommerce
*/
?>
<?php
$edgtf_sidebar_layout  = tetsuo_edge_sidebar_layout();
$edgtf_grid_space_meta = tetsuo_edge_options()->getOptionValue( 'woo_list_grid_space' );
$edgtf_holder_classes  = ! empty( $edgtf_grid_space_meta ) ? 'edgtf-grid-' . $edgtf_grid_space_meta . '-gutter' : '';

get_header();
tetsuo_edge_get_title();
get_template_part( 'slider' );
do_action('tetsuo_edge_action_before_main_content');

//Woocommerce content
if ( ! is_singular( 'product' ) ) { ?>
	<div class="edgtf-container">
		<div class="edgtf-container-inner clearfix">
			<div class="edgtf-grid-row <?php echo esc_attr( $edgtf_holder_classes ); ?>">
				<div <?php echo tetsuo_edge_get_content_sidebar_class(); ?>>
					<?php tetsuo_edge_woocommerce_content(); ?>
				</div>
				<?php if ( $edgtf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo tetsuo_edge_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="edgtf-container">
		<div class="edgtf-container-inner clearfix">
			<?php tetsuo_edge_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>