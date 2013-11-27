<?php
/**
	* Automates colors with live LESS preprocessing
 	*
 	* @category   Styles
 	* @package    Soren
 	* @author     Nick Haskins <email@nickhaskins.com>
 	* @copyright  2013 Nick Haskins
 	* @license    http://www.gnu.org/licenses/gpl-2.0.html  GNU General Public License v2 or later
 	* @version    Release: 1.0
 	*
*/

class sorenStyleAutomation {

	public function __construct(){

		add_filter( 'less_vars', array($this,'custom_colors'), 10, 2 );
	}


	public function custom_colors($vars){

		$opts 		 = get_option('soren_options') ? get_option('soren_options') : false;
		$fontsize 	 = isset($opts['font_size']) ? $opts['font_size'] : false;
		$fontfamily  = isset($opts['font_face']) ? $opts['font_face'] : false;
		$fontserif   = isset($opts['font_face_serif']) ? $opts['font_face_serif'] : false;
		$bgcolor 	 = isset($opts['bg_color']) ? $opts['bg_color'] : false;
		$linkcolor 	 = isset($opts['link_color']) ? $opts['link_color'] : false;
		$textcolor 	 = isset($opts['text_color']) ? $opts['text_color'] : false;
		$headercolor = isset($opts['header_color']) ? $opts['header_color'] : false;

		// width
		$vars[ 'soren-width' ]      	=  $this->width().'px';

		// type
		$vars['soren-font-size'] 		= $fontsize ? $fontsize : '22px';
		$vars['soren-font-sans-serif'] 	= $fontfamily ? $fontfamily : 'Open Sans';
		$vars['soren-font-serif'] 		= $fontserif ? $fontserif : 'Droid Serif';
		
		// color vars
		$vars[ 'soren-bg-color' ] 		= $bgcolor ? $bgcolor : '#EAEAEA';
		$vars[ 'soren-link-color' ]   	= $linkcolor ? $linkcolor : '#07a1cd';
		$vars[ 'soren-text-color' ] 	= $textcolor ? $textcolor : '#444444';
		$vars[ 'soren-headings-color' ]   = $headercolor ? $headercolor : '#222222';


		// helper vars
		$vars[ 'invert-dark' ]	 	=  soren_color_invert();
		$vars[ 'invert-light' ]		=  soren_color_invert( 'light' );

    	return apply_filters('soren_less_vars',$vars);

	}

	public function width(){

		$opts = get_option('soren_options') ? get_option('soren_options') : false;
		$width = isset($opts['soren_width']) ? $opts['soren_width'] : 800;

		if ( ! isset( $content_width ) )
		$content_width = $width;

		return apply_filters('soren_width',$content_width);
	}

}
new sorenStyleAutomation;