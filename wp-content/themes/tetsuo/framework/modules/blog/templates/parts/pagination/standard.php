<?php
if($max_num_pages > 1) {
	$number_of_pages = $max_num_pages;
	$current_page    = $paged;
	$range           = 3;
	?>
	
	<div class="edgtf-blog-pagination">
		<ul>
			<?php if ($current_page > 1) { ?>
				<li class="edgtf-pag-prev">
					<a itemprop="url" href="<?php echo esc_url(get_pagenum_link($current_page - 1)); ?>">
                        <svg width="10px" height="21px" viewBox="0 0 9.999 21.257">
                            <path fill="currentColor" d="M2,5.045l5.253,5.583L2,16.212V5.045 M0,0v21.257l9.999-10.629L0,0L0,0z"/>
                        </svg>
					</a>
				</li>
			<?php } ?>
			<?php for ($i=1; $i <= $number_of_pages; $i++) { ?>
				<?php if (!($i >= $current_page + $range+1 || $i <= $current_page - $range-1) || $number_of_pages <= $range ) { ?>
					<?php if($current_page == $i) { ?>
						<li class="edgtf-pag-number edgtf-pag-active">
							<a href="#"><?php echo esc_attr($i); ?></a>
						</li>
					<?php } else { ?>
						<li class="edgtf-pag-number">
							<a itemprop="url" href="<?php echo get_pagenum_link($i); ?>"><?php echo esc_attr($i); ?></a>
						</li>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<?php if ($current_page < $number_of_pages) { ?>
				<li class="edgtf-pag-next">
					<a itemprop="url" href="<?php echo esc_url(get_pagenum_link($current_page + 1)); ?>">
                        <svg width="10px" height="21px" viewBox="0 0 9.999 21.257">
                            <path fill="currentColor" d="M2,5.045l5.253,5.583L2,16.212V5.045 M0,0v21.257l9.999-10.629L0,0L0,0z"/>
                        </svg>
					</a>
				</li>
			<?php } ?>
		</ul>
	</div>
	
	<div class="edgtf-blog-pagination-wp">
		<?php echo get_the_posts_pagination(); ?>
	</div>
	
	<?php
}