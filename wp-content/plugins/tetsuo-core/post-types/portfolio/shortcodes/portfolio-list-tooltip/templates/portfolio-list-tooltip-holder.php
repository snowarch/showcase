<div class="edgtf-portfolio-list-tooltip-holder <?php echo esc_attr($holder_classes); ?>">
	<h2 class="edgtf-plt-inner clearfix">
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list-tooltip', 'portfolio-list-tooltip-item', '', $params);
				endwhile;
			else: ?>
                <p class="edgtf-plt-not-found"><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'tetsuo-core' ); ?></p>
			<?php endif;
		
			wp_reset_postdata();
		?>
	</h2>
</div>