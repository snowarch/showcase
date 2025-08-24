<?php

namespace TetsuoCore\Lib;

/**
 * interface PostTypeInterface
 * @package TetsuoCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}