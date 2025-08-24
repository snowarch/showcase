<?php

if ( ! function_exists( 'tetsuo_edge_like' ) ) {
	/**
	 * Returns TetsuoEdgeClassLike instance
	 *
	 * @return TetsuoEdgeClassLike
	 */
	function tetsuo_edge_like() {
		return TetsuoEdgeClassLike::get_instance();
	}
}

function tetsuo_edge_get_like() {
	
	echo wp_kses( tetsuo_edge_like()->add_like(), array(
		'span'  => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'     => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}