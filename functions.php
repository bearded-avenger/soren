<?php

class sorenThemeFunctions {

	const version = '0.9.1';

	public function __construct(){

		// Set some constants
		define('SOREN_THEME_DIR', dirname(__FILE__));
		define('SOREN_THEME_URL', get_template_directory_uri());

		// Includes]
		require_once(SOREN_THEME_DIR.'/inc/sidebars.php');
		require_once(SOREN_THEME_DIR.'/inc/scripts.php');
		require_once(SOREN_THEME_DIR.'/inc/options.php');
		require_once(SOREN_THEME_DIR.'/inc/style-automation.php');
		
		if(!class_exists('wp_less')){
			require_once( SOREN_THEME_DIR.'/inc/wp-less.php' );
		}

        if( !class_exists( 'CMB_Meta_Box' ) ) {
    		require_once(SOREN_THEME_DIR.'/libs/custom-meta-boxes/custom-meta-boxes.php' );
    	}

		// Custom Nav Menus
		if ( function_exists( 'register_nav_menus' ) ){
			$this->nav();
		}

		// Run the rest
		add_action('init', 				array($this,'theme_supports'));
		add_action('init', 				array($this,'image_sizes'),2);
		add_filter('body_class',		array($this,'browser_body_class'));
	}



	public function nav(){

		register_nav_menus(
			array(
			  'main_nav' => 'Main Nav',
			  'footer_nav' => 'Footer Nav'
			)
		);

	}

	public function image_sizes() {

		set_post_thumbnail_size( 300, 225, true ); // default post thumbnail size
		add_image_size( 'product-image',  300, 225, true ); // product thumbnail
		add_image_size( 'product-image-large',  800, 600, true ); // main product image
	}

	public function browser_body_class($classes) {

	    global $is_gecko, $is_IE, $is_opera, $is_safari, $is_chrome;

	    if($is_gecko)      $classes[] = 'gecko';
	    elseif($is_opera)  $classes[] = 'opera';
	    elseif($is_safari) $classes[] = 'safari';
	    elseif($is_chrome) $classes[] = 'chrome';
	    elseif($is_IE)     $classes[] = 'ie';
	    else               $classes[] = 'ur-browsur-sucks';

	    $classes[] = 'soren-responsive';

	    return $classes;

	}

	public function theme_supports(){
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5' );
	}

}
new sorenThemeFunctions;