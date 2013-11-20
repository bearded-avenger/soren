<?php

class sorenScriptLoader {

	const version = '1.0';

	public function __construct(){

		add_action('wp_enqueue_scripts', array($this,'load_scripts'));
	}

	public function load_scripts(){

		wp_enqueue_script('jquery');
		wp_enqueue_style('soren-style', 		SOREN_THEME_URL.'/less/style.less', self::version, true);

	}
}
new sorenScriptLoader;