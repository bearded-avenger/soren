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

	    echo 'itemscope="itemscope" itemtype="http://schema.org/'.$type.'"';
	}
}


/**
  	* Provides a fallback for the push nav
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	*
*/
if (!function_exists('soren_nav_fallback')){
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
if (!function_exists('soren_gallery_match')){
    function soren_gallery_match( $regex, $content ) {
        preg_match($regex, $content, $matches);
        return $matches[1];
    }
}

/**
  	* This provides color automation with a check for 50% brightness
  	*
  	* Pass a hex code and it will then check to see if that color is closer to white or black
  	* Mainly so if the user sets black color it returns something else other than black
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	* @param $key pass a hex color
  	*
*/
if (!function_exists('soren_color_sync')){
	function soren_color_sync($key = ''){

		//break up the color in its RGB components
		$r = hexdec(substr($key,0,2));
		$g = hexdec(substr($key,2,2));
		$b = hexdec(substr($key,4,2));

		$yiq = (($r*299)+($g*587)+($b*114))/1000;

		if ($yiq >= 128){
		    $out = soren_darken($key);
		}else{
		    //dark color, use bright font
		    $out = soren_lighten($key);
		}

		return $out;
	}
}
/**
  	* This provides color automation with a check for 50% brightness
  	*
  	* Pass a hex code and it will then check to see if that color is closer to white or black
  	* Mainly so if the user sets black color it returns something else other than black
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	* @param $key pass a hex color
  	*
*/
if (!function_exists('soren_lighten')){

	function soren_lighten($key = '') {

		$col = array(hexdec(substr($key,1,2)),hexdec(substr($key,3,2)),hexdec(substr($key,5,2)));

		$lighten = array(255-(255-$col[0])/2,255-(255-$col[1])/2,255-(255-$col[2])/2);
		$lighten = "#".sprintf("%02X%02X%02X", $lighten[0], $lighten[1], $lighten[2]);

		return $lighten;
	}
}
if (!function_exists('soren_darken')){

	function soren_darken($key = '') {

		$col = array(hexdec(substr($key,1,2)),hexdec(substr($key,3,2)),hexdec(substr($key,5,2)));

		$darken = array($col[0]/2,$col[1]/2,$col[2]/2);
		$darken = "#".sprintf("%02X%02X%02X", $darken[0], $darken[1], $darken[2]);

		return $darken;
	}
}
if (!function_exists('soren_color_invert')){
	function soren_color_invert( $mode = 'dark', $delta = 5 ){

		if($mode == 'light'){

			if(soren_color_detect() == -2)
				return 2*$delta;
			elseif(soren_color_detect() == -1)
				return 1.5*$delta;
			elseif(soren_color_detect() == 1)
				return -1.7*$delta;
			else
				return $delta;

		}else{
			if(soren_color_detect() == -2)
				return -(2*$delta);
			elseif(soren_color_detect() == -1)
				return -$delta;
			else
				return $delta;
		}
	}
}
if (!function_exists('soren_color_detect')){
	function soren_color_detect(){

		$opts = get_option('soren_options') ? get_option('soren_options') : false;
		$bgcolor = isset($opts['bg_color']) ? $opts['bg_color'] : false;

		$hex = str_replace('#', '', $bgcolor);

		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));

		if($r + $g + $b > 750){

			// Light
		    return 1;

		}elseif($r + $g + $b < 120){

			// Really Dark
			return -2;

		}
		elseif($r + $g + $b < 300){

			// Dark
			return -1;

		}else{

			// Meh
		    return false;

		}
	}
}