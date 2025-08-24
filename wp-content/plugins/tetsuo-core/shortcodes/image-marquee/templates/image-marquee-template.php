<div class="edgtf-image-marquee-holder <?php echo esc_attr($holder_classes); ?>">
	<?php if ($marquee_type == 'with-content') : ?>
	    <div class="edgtf-im-content-holder">
			<?php if (!empty($content_image)) : ?>
        		<img src="<?php echo wp_get_attachment_url($content_image); ?>" alt="<?php echo get_the_title($content_image) ?>" />
			<?php endif; ?>
			<?php if (!empty($bold_title) || !empty($regular_title)) : ?>
				<h2 class="edgtf-im-title" <?php echo tetsuo_edge_get_inline_style($titles_color); ?>>
					<?php if (!empty($bold_title)) : ?>
						<span class="edgtf-im-bold-title"><?php echo esc_attr($bold_title); ?></span>
					<?php endif; ?>
					<?php if (!empty($regular_title)) : ?>
						<span class="edgtf-im-regular-title">
                            <span class="edgtf-im-regular-title-inner"><?php echo wp_kses($regular_title, array('br' => true, 'span' => array('class' => true))); ?></span>
                        </span>
					<?php endif; ?>
				</h2>
			<?php endif; ?>
			<?php if (!empty($button_text)) : ?>
				<?php echo tetsuo_edge_get_button_html($button_params); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php 
	    $element_types = array('original','aux');
	?>
	<div class="edgtf-image-marquee">
	    <?php foreach ($element_types as $element_type) : ?>
	        <div class="edgtf-image edgtf-<?php echo esc_attr($element_type); ?>">
	            <img src="<?php echo wp_get_attachment_url($marquee_image); ?>" alt="<?php echo get_the_title($marquee_image) ?>" />
	        </div>
		<?php endforeach; ?>
    </div>
</div>