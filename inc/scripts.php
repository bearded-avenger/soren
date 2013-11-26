<?php

class sorenScriptLoader {


	public function __construct(){

		add_action('wp_enqueue_scripts', array($this,'load_scripts'));
	}

	public function load_scripts(){

		wp_enqueue_script('jquery');
		wp_enqueue_style('soren-style', 		SOREN_THEME_URL.'/less/style.less', SOREN_THEME_VERSION, true);
		wp_enqueue_script('soren-script', 		SOREN_THEME_URL.'/js/soren.js', array('jquery'),SOREN_THEME_VERSION, true);

		// push nav
		wp_register_script('soren-menu', 			SOREN_THEME_URL.'/js/pushy.min.js', true);
		wp_register_script('soren-modernizer', 		SOREN_THEME_URL.'/js/modernizr-2.6.2.min.js', true);

		// Wookmark
		wp_register_script('soren-grid-gallery', SOREN_THEME_URL.'/js/jquery.wookmark.min.js', true);

	}
}
new sorenScriptLoader;