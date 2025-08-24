<div class="edgtf-fixed-video-background-holder">
    <div class="edgtf-shader" <?php tetsuo_edge_inline_style($shader_style); ?>></div>

    <?php if (!wp_is_mobile()): ?>
        <video src="<?php echo esc_url($video); ?>" loop autoplay muted poster="<?php echo esc_url($image); ?>"></video>
    <?php endif; ?>
</div>