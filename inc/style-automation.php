<?php

class sorenStyleAutomation {

	public function __construct(){

		add_filter( 'less_vars', array($this,'custom_colors'), 10, 2 );
	}


	public function custom_colors($vars){

		$opts 		 = get_option('soren_options') ? get_option('soren_options') : false;
		$fontsize 	 = isset($opts['font_size']) ? $opts['font_size'] : false;
		$bgcolor 	 = isset($opts['bg_color']) ? $opts['bg_color'] : false;
		$linkcolor 	 = isset($opts['link_color']) ? $opts['link_color'] : false;
		$textcolor 	 = isset($opts['text_color']) ? $opts['text_color'] : false;
		$headercolor = isset($opts['header_color']) ? $opts['header_color'] : false;

		// width
		$vars[ 'soren-width' ]      =  $this->width().'px';

		// type
		$vars['soren-font-size'] 		= $fontsize ? $fontsize : '22px';
		
		// color vars
		$vars[ 'soren-bg-color' ] 		= $bgcolor ? $bgcolor : '#EAEAEA';
		$vars[ 'soren-link-color' ]   	= $linkcolor ? $linkcolor : '#07a1cd';
		$vars[ 'soren-text-color' ] 	= $textcolor ? $textcolor : '#444444';
		$vars[ 'soren-headings-color' ]   = $headercolor ? $headercolor : '#222222';


		// helper vars
		$vars[ 'invert-dark' ]	 	=  $this->invert();
		$vars[ 'invert-light' ]		=  $this->invert( 'light' );

    	return apply_filters('soren_less_vars',$vars);

	}

	public function width(){

		if ( ! isset( $content_width ) )
		$content_width = 800;

		return apply_filters('soren_width',$content_width);
	}

	private function invert( $mode = 'dark', $delta = 5 ){

		if($mode == 'light'){

			if($this->color_detect() == -2)
				return 2*$delta;
			elseif($this->color_detect() == -1)
				return 1.5*$delta;
			elseif($this->color_detect() == 1)
				return -1.7*$delta;
			else
				return $delta;

		}else{
			if($this->color_detect() == -2)
				return -(2*$delta);
			elseif($this->color_detect() == -1)
				return -$delta;
			else
				return $delta;
		}
	}

	private function color_detect(){

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
new sorenStyleAutomation;