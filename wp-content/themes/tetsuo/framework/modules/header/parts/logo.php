<?php
$attachment_meta = tetsuo_edge_get_attachment_meta_from_url( $logo_image );
$hwstring        = ! empty( $attachment_meta ) ? image_hwstring( $attachment_meta['width'], $attachment_meta['height'] ) : '';

if ( ! empty( $logo_image_dark ) ) {
	$attachment_meta_dark = tetsuo_edge_get_attachment_meta_from_url( $logo_image_dark );
	$hwstring_dark        = ! empty( $attachment_meta_dark ) ? image_hwstring( $attachment_meta_dark['width'], $attachment_meta_dark['height'] ) : '';
}

if ( ! empty( $logo_image_light ) ) {
	$attachment_meta_light = tetsuo_edge_get_attachment_meta_from_url( $logo_image_light );
	$hwstring_light        = ! empty( $attachment_meta_light ) ? image_hwstring( $attachment_meta_light['width'], $attachment_meta_light['height'] ) : '';
}

?>

<?php do_action( 'tetsuo_edge_action_before_site_logo' ); ?>
	
	<div class="edgtf-logo-wrapper">
		<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php $logo_text == '' ? tetsuo_edge_inline_style( $logo_styles ) : ''; ?>>
            <?php if ($logo_text == '') { ?>
                <img itemprop="image" class="edgtf-normal-logo" src="<?php echo esc_url( $logo_image ); ?>" <?php echo wp_kses( $hwstring, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'logo', 'tetsuo' ); ?>"/>
                <?php if ( ! empty( $logo_image_dark ) ) { ?><img itemprop="image" class="edgtf-dark-logo" src="<?php echo esc_url( $logo_image_dark ); ?>" <?php echo wp_kses( $hwstring_dark, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'dark logo', 'tetsuo' ); ?>"/><?php } ?>
                <?php if ( ! empty( $logo_image_light ) ) { ?><img itemprop="image" class="edgtf-light-logo" src="<?php echo esc_url( $logo_image_light ); ?>" <?php echo wp_kses( $hwstring_light, array( 'width'  => true, 'height' => true ) ); ?> alt="<?php esc_attr_e( 'light logo', 'tetsuo' ); ?>"/><?php } ?>
            <?php } else { ?>
                <span class="edgtf-logo-text" data-text="<?php echo esc_html($logo_text); ?>">
                    <?php echo esc_html($logo_text); ?>
                </span>
            <?php } ?>
		</a>
	</div>

<?php do_action( 'tetsuo_edge_action_after_site_logo' ); ?>