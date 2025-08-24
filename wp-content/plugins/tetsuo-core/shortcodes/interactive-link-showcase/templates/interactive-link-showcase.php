<div class="<?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-ils-holder">
        <?php if(!empty($link_items)) { ?>
            <div class="edgtf-ils-content-holder">
                <?php foreach($link_items as $link_item):?>
                    <?php if(isset($link_item['title'])) { ?>
                    <div class="edgtf-ils-item-content">
                        <?php if(isset($link_item['image'])) { ?>
                            <div class="edgtf-ils-item-content-touch">
                                <?php echo wp_get_attachment_image($link_item['image'], 'full');?>
                            </div>
                        <?php } ?>
                        <a class="edgtf-ils-item-link" itemprop="url" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link_item['link']) ?>">
                            <?php echo esc_html($link_item['title']);?>
                        </a>
                    </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
            <div class="edgtf-ils-images-holder" >
                <?php foreach($link_items as $link_item):?>
                    <?php if(isset($link_item['image'])) {
                            $image_params = wp_get_attachment_image_src($link_item['image'], 'full');
                        ?>
                        <div class="edgtf-ils-item-image">
                            <div class="edgtf-ils-background-image" style="background-image: url(<?php echo esc_url($image_params[0]); ?>)"></div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        <?php } ?>
        <div class="edgtf-ils-bgrnd"></div>
	</div>
    <?php
    if ( ! empty( $bottom_widget ) && is_active_sidebar( $bottom_widget ) ) { ?>
        <div class="edgtf-ils-widget-bottom">
            <?php dynamic_sidebar( $bottom_widget ); ?>
        </div>
    <?php } ?>
</div>