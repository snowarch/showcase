<?php if ( tetsuo_edge_options()->getOptionValue( 'enable_social_share' ) == 'yes' && tetsuo_edge_options()->getOptionValue( 'enable_social_share_on_portfolio_item' ) == 'yes' ) : ?>
	<div class="edgtf-ps-info-item edgtf-ps-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo tetsuo_edge_get_social_share_html( array( 'type'  => 'list', 'title' => esc_attr__( 'Share:', 'tetsuo-core' ) ) ); ?>
	</div>
<?php endif; ?>