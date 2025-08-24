<?php

class TetsuoEdgeClassAuthorInfoWidget extends TetsuoEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_author_info_widget',
			esc_html__( 'Tetsuo Author Info Widget', 'tetsuo' ),
			array( 'description' => esc_html__( 'Add author info element to widget areas', 'tetsuo' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'extra_class',
				'title' => esc_html__( 'Custom CSS Class', 'tetsuo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_bottom_margin',
				'title' => esc_html__( 'Widget Bottom Margin (px)', 'tetsuo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'author_username',
				'title' => esc_html__( 'Author Username', 'tetsuo' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		$extra_class = '';
		if ( ! empty( $instance['extra_class'] ) ) {
			$extra_class = $instance['extra_class'];
		}
		
		$widget_styles = array();
		if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
			$widget_styles[] = 'margin-bottom: ' . tetsuo_edge_filter_px( $instance['widget_bottom_margin'] ) . 'px';
		}
		
		$authorID = 1;
		if ( ! empty( $instance['author_username'] ) ) {
			$author = get_user_by( 'login', $instance['author_username'] );
			
			if ( $author ) {
				$authorID = $author->ID;
			}
		}
		
		$author_info = get_the_author_meta( 'description', $authorID );
		?>
		
		<div class="widget edgtf-author-info-widget <?php echo esc_attr( $extra_class ); ?>" <?php echo tetsuo_edge_get_inline_style( $widget_styles ); ?>>
			<div class="edgtf-aiw-inner">
				<a itemprop="url" class="edgtf-aiw-image" href="<?php echo esc_url( get_author_posts_url( $authorID ) ); ?>">
					<?php echo tetsuo_edge_kses_img( get_avatar( $authorID, 240 ) ); ?>
				</a>
				<?php if ( $author_info !== "" ) { ?>
                    <div class="edgtf-widget-title-holder">
                        <h4 class="edgtf-aiw-title"><?php esc_html_e( 'About Author', 'tetsuo' ); ?></h4>
                    </div>

					<p itemprop="description" class="edgtf-aiw-text"><?php echo wp_kses_post( $author_info ); ?></p>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}