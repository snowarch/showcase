<?php
$attachment_meta = tetsuo_edge_get_attachment_meta_from_url( $logo_image );
$hwstring        = ! empty( $attachment_meta ) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

do_action( 'tetsuo_edge_action_before_mobile_logo' ); ?>

<div class="edgtf-mobile-logo-wrapper">
	<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php $logo_text == '' ? tetsuo_edge_inline_style( $logo_styles ) : ''; ?>>
        <?php if ($logo_text == '') { ?>
            <img itemprop="image" src="<?php echo esc_url( $logo_image ); ?>" <?php echo wp_kses( $hwstring, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'Mobile Logo', 'tetsuo' ); ?>"/>
        <?php } else { ?>
            <span class="edgtf-mobile-logo-text">
                <?php echo esc_html($logo_text); ?>
            </span>
        <?php } ?>
	</a>
</div>

<?php do_action( 'tetsuo_edge_action_after_mobile_logo' ); ?>