<div <?php tetsuo_edge_class_attribute($si_slasses); ?>>
    <?php if($layout == 'right') : ?>
        <div class="edgtf-si-text-content-holder" <?php echo tetsuo_edge_get_inline_attrs($parallax_data_1); ?>>
            <div class="edgtf-si-title-holder">
                <h2 class="edgtf-si-title"><?php echo esc_attr($title); ?></h2>
            </div>
            <div class="edgtf-si-text-holder">
                <p class="edgtf-si-text"><?php echo esc_attr($text); ?></p>
            </div>
            <div class="edgtf-si-button-holder" <?php echo tetsuo_edge_get_inline_style($button_holder_styles); ?>>
                <div class="edgtf-si-button"><?php echo tetsuo_edge_get_button_html($button_parameters); ?></div>
            </div>
        </div>
    <?php endif; ?>
	<div class="edgtf-si-images-holder">
		<div class="edgtf-si-hero-image-holder" <?php echo tetsuo_edge_get_inline_attrs($parallax_data_2); ?>>
			<a href="<?php echo esc_url($hero_image_link) ?>" target="<?php echo esc_attr($hero_image_link_target);?>">
                <div class="edgtf-si-hero-inner-image-holder">
				    <img src="<?php echo wp_get_attachment_url($hero_image); ?>" alt="<?php echo get_the_title($hero_image);?>">
                </div>
			</a>
		</div>
		<div class="edgtf-si-aux-image-holder edgtf-si-aux-image-1" <?php echo tetsuo_edge_get_inline_attrs($parallax_data_1); ?>>
			<a href="<?php echo esc_url($aux_image_1_link) ?>" target="<?php echo esc_attr($aux_image_1_link_target);?>">
                <div class="edgtf-si-aux-inner-image-holder">
				    <img src="<?php echo wp_get_attachment_url($aux_image_1); ?>" alt="<?php echo get_the_title($aux_image_1);?>">
                </div>
			</a>
		</div>
		<div class="edgtf-si-aux-image-holder edgtf-si-aux-image-2" <?php echo tetsuo_edge_get_inline_attrs($parallax_data_3); ?>>
			<a href="<?php echo esc_url($aux_image_2_link) ?>" target="<?php echo esc_attr($aux_image_2_link_target);?>">
                <div class="edgtf-si-aux-inner-image-holder">
				    <img src="<?php echo wp_get_attachment_url($aux_image_2); ?>" alt="<?php echo get_the_title($aux_image_2);?>">
                </div>
			</a>
		</div>
	</div>
    <?php if($layout == 'left') : ?>
        <div class="edgtf-si-text-content-holder" <?php echo tetsuo_edge_get_inline_attrs($parallax_data_1); ?>>
            <div class="edgtf-si-title-holder">
                <h2 class="edgtf-si-title"><?php echo esc_attr($title); ?></h2>
            </div>
            <div class="edgtf-si-text-holder">
                <p class="edgtf-si-text"><?php echo esc_attr($text); ?></p>
            </div>
            <div class="edgtf-si-button-holder" <?php echo tetsuo_edge_get_inline_style($button_holder_styles); ?>>
                <div class="edgtf-si-button"><?php echo tetsuo_edge_get_button_html($button_parameters); ?></div>
            </div>
        </div>
    <?php endif; ?>
</div>