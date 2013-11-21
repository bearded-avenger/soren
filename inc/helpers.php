<?php

/**
  	* Adds schema to the thml tag depending on the current page view
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	*
*/
if (!function_exists('soren_html_schema')){
	function soren_html_schema(){

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

	    echo 'itemscope="itemscope" itemtype="http://schema.org'.$type.'"';
	}
}


/**
  	* Provides a fallback for the push nav
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	*
*/
if (!function_exists('soren_nav_fallback')){}
	function soren_nav_fallback(){
		printf('<nav class="pushy push-left"><ul id="soren_nav_fallback" class="unstyled">%s</ul></nav>', wp_list_pages( 'title_li=&sort_column=menu_order&depth=1&echo=0') );
	}
}


/**
  	* Used within the soren_gallery function, to search the post for post ids
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	*
*/
if (!function_exists('soren_gallery_match')){}
    function soren_gallery_match( $regex, $content ) {
        preg_match($regex, $content, $matches);
        return $matches[1];
    }
}