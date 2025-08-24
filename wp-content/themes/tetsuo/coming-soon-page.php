<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * tetsuo_edge_action_header_meta hook
	 *
	 * @see tetsuo_edge_header_meta() - hooked with 10
	 * @see tetsuo_edge_user_scalable_meta() - hooked with 10
	 * @see tetsuo_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'tetsuo_edge_action_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * tetsuo_edge_action_after_body_tag hook
	 *
	 * @see tetsuo_edge_get_side_area() - hooked with 10
	 * @see tetsuo_edge_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'tetsuo_edge_action_after_body_tag' ); 
	if ( tetsuo_edge_options()->getOptionValue( 'show_back_button' ) == 'yes' ) { ?>
		<a id='edgtf-back-to-top' href='#'>
			<span class="edgtf-icon-stack">
					<?php tetsuo_edge_icon_collections()->getBackToTopIcon( 'ion_icons' ); ?>
			</span>
			<span class="edgtf-btt-text"><?php esc_html_e( 'Back to Top', 'tetsuo' ) ?></span>
		</a>
	<?php }

	$id = tetsuo_edge_get_page_id();

	if (tetsuo_edge_get_meta_field_intersect('enable_website_song', $id ) === 'yes') { ?>
		<a class="edgtf-website-song edgtf-track-paused">
			<audio src="<?php echo esc_url(tetsuo_edge_options()->getOptionValue('song_source')); ?>"></audio>
			<div class="edgtf-song-play-icon ion-play"></div>
			<div class="edgtf-equalizer">
				<div id="edgtf-equalizer-bar-1" class="edgtf-equalizer-bar noAnim"></div>
				<div id="edgtf-equalizer-bar-2" class="edgtf-equalizer-bar noAnim"></div>
				<div id="edgtf-equalizer-bar-3" class="edgtf-equalizer-bar noAnim"></div>
			</div>
		</a>
	<?php } ?>

	<div class="edgtf-wrapper">
		<div class="edgtf-wrapper-inner">
			<div class="edgtf-content">
				<div class="edgtf-content-inner">
					<?php get_template_part( 'slider' ); ?>
					<div class="edgtf-full-width">
						<div class="edgtf-full-width-inner">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>