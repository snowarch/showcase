<div id="edgtf-vertical-carousel" class="<?php echo esc_attr($holder_classes); ?>">
        <?php if(!empty($items)) { ?>
            <div class="edgtf-vc-images-holder" >
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                    <?php $i = 0; ?>
                    <?php foreach($items as $item) : ?>
                        <?php if(isset($item['image'])) { ?>
                            <div class="swiper-slide"  data-index="<?php echo esc_attr($i)?>">
                                <?php if(isset($item['touch_devices_link'])) { ?>
                                    <a class="edgtf-touch-link" href="<?php echo esc_url($item['touch_devices_link']); ?>"></a>
                                <?php } ?>
                                <div class="edgtf-vc-item-image">
                                    <?php echo wp_get_attachment_image($item['image'], 'full'); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="edgtf-vc-content-holder">
		        <?php $j = 0; ?>
                <?php foreach($items as $item) : ?>
                    <div class="edgtf-vc-item-content" data-index="<?php echo esc_attr($j)?>">
                        <div class="edgtf-vc-item-content-inner">
                            <?php if(isset($item['title'])) { ?>
                                <h1 class="edgtf-vc-item-title"><?php echo esc_attr($item['title']); ?></h1>
                            <?php } ?>
                            <?php echo tetsuo_edge_execute_shortcode( 'edgtf_separator', array(
                                'type' => 'normal',
                                'position' => 'left',
                                'width' => '81px',
                                'thickness' => '7px',
                                'margin' => '5px 0 25px'
                            )); ?>
                            <?php if(isset($item['description'])) { ?>
                                <p class="edgtf-vc-item-description"><?php echo esc_attr($item['description']); ?></p>
                            <?php } ?>
                            <div class="edgtf-vc-btns">
                                <?php if(isset($item['link_1'])) { ?>
                                    <?php echo tetsuo_edge_get_button_html(array(
                                        'link' => $item['link_1'],
                                        'text' => $item['link_text_1'],
                                        'type' => 'outline',
                                        'size' => 'medium',
                                    )); ?>
                                <?php } ?>
                                <?php if(isset($item['link_2'])) { ?>
                                    <?php echo tetsuo_edge_get_button_html(array(
                                        'link' => $item['link_2'],
                                        'text' => $item['link_text_2'],
                                        'type' => 'outline',
                                        'size' => 'medium',
                                    )); ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
		            <?php $j++; ?>
                <?php endforeach; ?>
            </div>
        <?php } ?>
        <div class="edgtf-vc-nav">
            <div class="edgtf-vc-counter">
                <span class="edgtf-vc-current">1</span>
                <span class="edgtf-vc-sep">/</span>
                <span class="edgtf-vc-total">5</span>
            </div>
            <div class="edgtf-vc-arrows">
                <span class="edgtf-vc-up">
                    <svg width="15px" height="9px">
                        <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                        d="M14.991,7.499 L13.544,8.991 L7.447,2.703 L1.380,8.960 L0.008,7.546 L6.902,0.436 L7.098,0.638 L7.718,-0.001 L14.991,7.499 Z"/>
                    </svg>
                </span>
                <span class="edgtf-vc-down">
                    <svg width="15px" height="9px">
                        <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                        d="M14.991,1.501 L7.718,9.001 L7.098,8.362 L6.902,8.564 L0.008,1.454 L1.380,0.040 L7.447,6.297 L13.544,0.009 L14.991,1.501 Z"/>
                    </svg>
                </span>
            </div>
        </div>
    <?php
    if ( ! empty( $bottom_widget ) && is_active_sidebar( $bottom_widget ) ) { ?>
        <div class="edgtf-vc-widget-bottom">
            <?php dynamic_sidebar( $bottom_widget ); ?>
        </div>
    <?php } ?>
</div>