<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php tetsuo_edge_inline_style($button_styles); ?> <?php tetsuo_edge_class_attribute($button_classes); ?> <?php echo tetsuo_edge_get_inline_attrs($button_data); ?> <?php echo tetsuo_edge_get_inline_attrs($button_custom_attrs); ?>>
    <?php if($type === 'outline') { ?>
            <span class="edgtf-btn-overlay"></span>
    <?php } ?>
    <?php if($type === 'simple') { ?>
        <span class="edgtf-split-item-prim"><?php echo esc_html($text); ?></span>
        <span class="edgtf-split-item-sec"><?php echo esc_html($text); ?></span>
    <?php } else { ?>
        <span class="edgtf-btn-text"><?php echo esc_html($text); ?></span>
        <?php echo tetsuo_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
    <?php } ?>
</a>