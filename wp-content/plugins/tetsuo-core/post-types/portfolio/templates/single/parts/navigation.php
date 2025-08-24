<?php if(tetsuo_edge_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = tetsuo_edge_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';


    /* Single navigation section - SETTING PARAMS */
    $post_navigation = array(
            'prev' => array(
                    'mark' => '<span class="edgtf-ps-nav-mark ion-ios-arrow-thin-left"></span>',
                    'label' => '<span class="edgtf-ps-nav-label">'.esc_html__('Previous Project', 'tetsuo').'</span>'
            ),
            'next' => array(
                    'mark' => '<span class="edgtf-ps-nav-mark ion-ios-arrow-thin-right"></span>',
                    'label' => '<span class="edgtf-ps-nav-label">'.esc_html__('Next Project', 'tetsuo').'</span>'
            )
    );

    if($nav_same_category){
        if(get_previous_post(true, '', 'portfolio-category') !== ""){
            $post_navigation['prev']['post'] = get_previous_post(true, '', 'portfolio-category');
        }
        if(get_next_post(true, '', 'portfolio-category') !== ""){
            $post_navigation['next']['post'] = get_next_post(true, '', 'portfolio-category');
        }
    } else {
        if(get_previous_post() !== ""){
            $post_navigation['prev']['post'] = get_previous_post();
        }
        if(get_next_post() !== ""){
            $post_navigation['next']['post'] = get_next_post();
        }
    }


    ?>

<div class="edgtf-ps-navigation">
    <?php endif;

    /* Single navigation section - RENDERING */
    foreach (array('prev', 'next') as $nav_type) {
        if (isset($post_navigation[$nav_type]['post'])) { ?>
            <?php $edgtf_nav_class = get_the_post_thumbnail($post_navigation[$nav_type]['post']->ID) == '' ? 'edgtf-no-nav-image' : '';  ?>
            <a itemprop="url" class="edgtf-ps-<?php echo esc_attr($nav_type); ?> <?php echo esc_attr($edgtf_nav_class); ?>" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
                <div class="edgtf-ps-navigation-thumb">
                    <?php echo get_the_post_thumbnail($post_navigation[$nav_type]['post']->ID, 'thumbnail'); ?>
                </div>
                <div class="edgtf-ps-navigation-holder">
                    <?php echo wp_kses($post_navigation[$nav_type]['label'], array('span' => array('class' => true))); ?>
                </div>
            </a>

        <?php }
    }
    ?>
</div>
