<div class="edgtf-social-share-holder edgtf-text <?php echo esc_attr( $holder_classes ); ?>">
	<?php if ( ! empty( $title ) ) { ?>
		<p class="edgtf-social-title"><?php echo esc_html( $title ); ?></p>
	<?php } ?>
	<ul>
		<?php foreach ( $networks as $net ) {
			echo wp_kses( $net, array(
				'li'   => array(
					'class' => true
				),
				'a'    => array(
					'itemprop' => true,
					'class'    => true,
					'href'     => true,
					'target'   => true,
					'onclick'  => true
				),
				'span' => array(
					'class' => true
				)
			) );
		} ?>
	</ul>
</div>