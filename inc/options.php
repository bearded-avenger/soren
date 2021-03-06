<?php

class sorenCustomizer {

	const version = '1.0';

	private function opt_name() {

		$sorenopts = get_option('soren_options');
		$sorenopts['id'] = 'soren_options';
		update_option('soren_options', $sorenopts);
	}

	// set defaults
	public static function default_opts() {

		$options = array();

		$options['bg_color'] = array(
			'name' 	=> __('Background Color', 'soren'),
			'id' 	=> 'bg_color',
			'default' 	=> '#FFFFFF',
			'type' 	=> 'color'
		);

		$options['link_color'] = array(
			'name' 	=> __('Link Color', 'soren'),
			'id' 	=> 'link_color',
			'default' 	=> '#07a1cd',
			'type' 	=> 'color'
		);

		$options['text_color'] = array(
			'name' 	=> __('Text Color', 'soren'),
			'id' 	=> 'soren_text_text',
			'default' 	=> '#444444',
			'type' 	=> 'color'
		);

		$options['header_color'] = array(
			'name' 	=> __('Headings Color', 'soren'),
			'id' 	=> 'soren_header_text',
			'default' 	=> '#222222',
			'type' 	=> 'color'
		);

		$options['font_size'] = array(
			'name' 	=> __('Font Size', 'soren'),
			'id' 	=> 'font_size',
			'default' 	=> '22px',
			'type' 	=> 'select'
		);

		$options['soren_width'] = array(
			'name' 	=> __('Maxiumum Content Width', 'soren'),
			'id' 	=> 'soren_width',
			'default' 	=> 800,
			'type' 	=> 'text'
		);

		return apply_filters('soren_default_options',$options);
	}

	public static function register($wp_customize){

		$options = self::default_opts();

		// APPEARENCE
		$wp_customize->add_section( 'soren_appearence', array(
			'title' => __( 'Appearence', 'soren' ),
			'priority' => 100
		) );

		// BG Color
		$wp_customize->add_setting( 'soren_options[bg_color]', array(
			'type' => 'option',
			'default'	=> $options['bg_color']['default'],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_color', array(
			'label' => $options['bg_color']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[bg_color]'
		) ) );

		// Link Color
		$wp_customize->add_setting( 'soren_options[link_color]', array(
			'type' => 'option',
			'default'	=> $options['link_color']['default'],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label' => $options['link_color']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[link_color]'
		) ) );

		// Text Color
		$wp_customize->add_setting( 'soren_options[text_color]', array(
			'type' => 'option',
			'default'	=> $options['text_color']['default'],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
			'label' => $options['text_color']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[text_color]'

		) ) );

		// Header Color
		$wp_customize->add_setting( 'soren_options[header_color]', array(
			'type' => 'option',
			'default'	=> $options['header_color']['default'],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
			'label' => $options['header_color']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[header_color]'
		) ) );

		// Font Size
		$wp_customize->add_setting( 'soren_options[font_size]', array(
			'type' => 'option',
			'default'	=> $options['font_size']['default'],
			'sanitize_callback' => self::sanitize_int()
		) );
		$wp_customize->add_control( 'font_size', array(
			'label' => $options['font_size']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[font_size]',
			'type' => $options['font_size']['type'],
			'choices' => array(
				'16px' => '16px',
				'17px' => '17px',
				'18px' => '18px',
				'19px' => '19px',
				'20px' => '20px',
				'21px' => '21px',
				'22px' => '22px',
				'23px' => '23px',
				'24px' => '24px',
				'25px' => '25px',
				'26px' => '26px',
				'27px' => '27px',
				'28px' => '28px'

			)
		) );

		// Width
		$wp_customize->add_setting( 'soren_options[soren_width]', array(
			'default' => $options['soren_width']['default'],
			'type' => 'option',
			'sanitize_callback' => self::sanitize_int(),
		) );
		$wp_customize->add_control( 'soren_width', array(
			'label' => $options['soren_width']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[soren_width]',
			'type' => $options['soren_width']['type']
		) );

		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

   	public static function live_preview() {
      	wp_enqueue_script('soren-themecustomizer',SOREN_THEME_URL.'/js/soren-theme-customizer.min.js', array( 'jquery','customize-preview' ),	self::version, true);
   	}

   	// sanitize text input. allow some html but definitely no scripts and close tags if they left them open
	private  static function sanitize_text_field( $input = ''  ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}

	// sanitize integer
	private static function sanitize_int( $input = ''  ) {

	    if( is_numeric( $input ) ) {
	        return intval( $input );
	    }

	}

}
// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'sorenCustomizer' , 'register' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'sorenCustomizer' , 'live_preview' ) );