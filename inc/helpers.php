<?php


if (!function_exists('soren_html_schema')):
	function soren_html_schema(){

	 	$base = 'http://schema.org/';

	 	$type = '';
	    switch ($type):

	    	case (is_single()):
	    		$type = "Article";
	    	break;
	    	case (is_author()):
	    		$type = "ProfilePage";
	    	break;
	    	case (is_search()):
	    		$type = "SearchResultsPage";
	    	break;
	    	case (is_post_type_archive('downloads')):
	    		$type = "Store";
	    	break;
	    	case ('downloads' == get_post_type()):
	    		$type = "Product";
	    	break;
	    	default:
	    		$type = "Article";
	    	break;

	    endswitch;

	    echo 'itemscope="itemscope" itemtype="' . $base . $type . '"';
	}
endif;

// push nav
if (!function_exists('soren_push_nav')):

	function soren_push_nav(){

		wp_enqueue_script('soren-menu');
		wp_enqueue_script('soren-modernizer');


		wp_nav_menu( 
			array( 
			'theme_location' => 'main_nav',
			'menu_class' => 'unstyled',
			'container_class' => 'pushy pushy-left',
			'container'			=> 'nav'
		) );
		?><div class="menu-btn">☰</div>
		<div class="site-overlay"></div><?php
	}

endif;