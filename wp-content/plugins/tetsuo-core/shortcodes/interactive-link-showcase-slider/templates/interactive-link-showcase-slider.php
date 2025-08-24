<div class="edgtf-ilss-holder edgtf-ils-type-slider <?php echo esc_attr( $holder_classes ); ?>">
	<?php if ( ! empty( $link_items ) ) { ?>
		<?php $j = 0; ?>
		<div class="edgtf-ils-image-holder" <?php tetsuo_edge_inline_style( $image_holder_styles ); ?>>
			<?php foreach ( $link_items as $link_item ): ?>
				<?php if ( isset( $link_item['image'] ) ) { ?>
					<?php
						$item_style   = array();
						$item_style[] = 'background-image: url(' . wp_get_attachment_url( $link_item['image'] ) . ')';
					?>
					<div class="edgtf-ils-item-image" data-index="<?php echo esc_attr($j); ?>" <?php tetsuo_edge_inline_style( $item_style ); ?>>
						<?php echo wp_get_attachment_image( $link_item['image'], 'full' ); ?>
					</div>
				<?php 
				$j++;
				} ?>
			<?php endforeach; ?>
		</div>
		<div class="edgtf-ils-content-holder">
			<div class="edgtf-ils-content-inner">
				<div class="edgtf-ils-item-content">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php
								$i = 0;
								
								foreach ( $link_items as $link_item ): ?>
								<?php if ( isset( $link_item['title'] ) ) { ?>
									<a itemprop="url" class="edgtf-ils-item-link swiper-slide" data-index="<?php echo esc_attr($i); ?>" href="<?php echo esc_url( $link_item['link'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
										<span class="edgtf-ils-item-title"><?php echo esc_html( $link_item['title'] ); ?></span>
									</a>
								<?php
								$i++;
								} ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
    <?php
    if ( ! empty( $bottom_widget ) && is_active_sidebar( $bottom_widget ) ) { ?>
        <div class="edgtf-ils-widget-bottom">
            <?php dynamic_sidebar( $bottom_widget ); ?>
        </div>
    <?php } ?>
</div>