<?php if($filter == 'yes') {
	$filter_categories    = $this_object->getFilterCategories($params);
	$filter_holder_styles = $this_object->getFilterHolderStyles($params);
	$filter_styles        = $this_object->getFilterStyles($params);
	?>
	<div class="edgtf-pl-filter-holder" <?php tetsuo_edge_inline_style($filter_holder_styles); ?>>

		<div class="edgtf-plf-inner" <?php tetsuo_edge_inline_style($filter_styles); ?>>

			<?php
			if(is_array($filter_categories) && count($filter_categories)){ ?>

                <a class="edgtf-pl-filter-toggle" href="#">
                    <svg x="0px" y="0px" width="20px" height="27px" viewBox="0 0 19.998 26.997" enable-background="new 0 0 19.998 26.997" xml:space="preserve">
                        <g>
                            <polygon fill="currentColor" points="3.938,0 1.938,0 1.938,15.992 0,15.992 0,21.992 1.938,21.992 1.938,26.997 3.938,26.997
                                3.938,21.992 6,21.992 6,15.992 3.938,15.992 	"/>
                            <polygon fill="currentColor" points="10.999,0 8.999,0 8.999,6.034 6.999,6.034 6.999,12.034 8.999,12.034 8.999,26.997 10.999,26.997
                                10.999,12.034 12.999,12.034 12.999,6.034 10.999,6.034 	"/>
                            <polygon fill="currentColor" points="19.998,15.992 18.061,15.992 18.061,0 16.061,0 16.061,15.992 13.998,15.992 13.998,21.992
                                16.061,21.992 16.061,26.997 18.061,26.997 18.061,21.992 19.998,21.992 	"/>
                        </g>
                    </svg>

                    <span>Filter</span>
                </a>

				<ul>
					<li class="edgtf-pl-filter" data-filter="">
						<span><?php esc_html_e('Show all', 'tetsuo-core')?></span>
					</li>
					<?php foreach($filter_categories as $cat) { ?>
						<li class="edgtf-pl-filter" data-filter=".portfolio-category-<?php echo esc_attr($cat->slug); ?>">
							<span><?php echo esc_html($cat->name); ?></span>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>
<?php } ?>
