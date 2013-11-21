<?php

/**
  	* Generates an off canvas menu toggled via menu button
  	*
  	* * loads menu.js
  	* * loads modernizer for css3 transitions
  	*
  	* Theme Authors - just drop the function in your chld theme functions.php and pass optional arguments
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	*
  	* @since 1.0
  	*
  	* @param int    $depth  How many levels should the menu be
  	* @param string $menuclass Add optional classes to the menu ul
  	* @param string $containerclass Add optional classes to the nav container
*/
if (!function_exists('soren_push_nav')):

	function soren_push_nav($depth = '', $menuclass = '', $containerclass = ''){

		wp_enqueue_script('soren-menu');
		wp_enqueue_script('soren-modernizer');

		wp_nav_menu( 
			array( 
			'theme_location' => 'main_nav',
			'menu_class' => 'unstyled',
			'container_class' => 'pushy pushy-left',
			'container'			=> 'nav',
			'fallback_cb'     => 'soren_nav_fallback',
		) );
		?><div class="menu-btn">☰</div>
		<div class="site-overlay"></div><?php
	}

endif;

