<?php

if (has_post_thumbnail()) {
    $image_src = get_the_post_thumbnail_url(get_the_ID());
} else {
    $image_src = TETSUO_CORE_CPT_URL_PATH . '/portfolio/assets/img/portfolio_featured_image.jpg';
    var_dump($image_src);
}

?>

<span class="edgtf-plt-item">
    <a itemprop="url" class="edgtf-plti-link edgtf-image-tooltip" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>" data-toggle="tooltip" data-placement="top"
       title="<img width='300' height='300' src= '<?php echo esc_html($image_src); ?>' />">
        <span class="edgtf-plti-title-holder"><?php echo esc_attr(get_the_title()); ?></span>
        <img width='300' height='300' class="edgtf-preload-image" src="<?php echo esc_html($image_src); ?>" alt="<?php esc_html__('Preloaded Image', 'tetsuo-core'); ?>">
    </a>
</span>