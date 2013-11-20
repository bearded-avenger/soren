<?php
/**
 	* Sidebars
 	*
 	* @package     Flacker
 	* @subpackage  /libs/custom-meta-boxes
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Only run if sidebars kosher
if ( function_exists('register_sidebar') ) {
	new FlyteSidebars;
}
class FlyteSidebars {

	function __construct(){

		$this->sb();
	}

	function sb(){

		register_sidebars(1, array(
			'name' => 'Footer Sidebar',
			'id' => 'footer_sidebar',
	      	'before_title' => '<h4 class="widget_title">',
	      	'after_title' => '</h4>',
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>'
	    ));
	    register_sidebars(1, array(
			'name' => 'Post Sidebar',
			'id' => 'post_sidebar',
	      	'before_title' => '<h4 class="widget_title">',
	      	'after_title' => '</h4>',
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>'
	    ));
	}

}