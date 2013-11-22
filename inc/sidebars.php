<?php
/**
	* Loads the sidebars for the theme
 	*
 	* @category   Sidebars
 	* @package    Soren
 	* @author     Nick Haskins <email@nickhaskins.com>
 	* @copyright  2013 Nick Haskins
 	* @license    http://www.gnu.org/licenses/gpl-2.0.html  GNU General Public License v2 or later
 	* @version    Release: 1.0
 	*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Only run if sidebars kosher
if ( function_exists('register_sidebar') ) {
	new SorenSidebars;
}
class SorenSidebars {

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