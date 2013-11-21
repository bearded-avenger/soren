<?php

class sorenScriptLoader {

	const version = '1.0';

	public function __construct(){

		add_action('wp_enqueue_scripts', array($this,'load_scripts'));
	}

	public function load_scripts(){

		wp_enqueue_script('jquery');
		wp_enqueue_style('soren-style', 		SOREN_THEME_URL.'/less/style.less', self::version, true);

		// push nav
		wp_register_script('soren-menu', 			SOREN_THEME_URL.'/js/pushy.min.js', true);
		wp_register_script('soren-modernizer', 		SOREN_THEME_URL.'/js/modernizr-2.6.2.min.js', true);

	}
}
new sorenScriptLoader;