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

		$options['soren_ga'] = array(
			'name' 	=> __('Google Analytics Tracking ID', 'soren'),
			'id' 	=> 'soren_ga',
			'default' 	=> ' ',
			'type' 	=> 'text'
		);

		$options['soren_fb_app_id'] = array(
			'name' 	=> __('Facebook APP ID', 'soren'),
			'id' 	=> 'soren_fb_app_id',
			'default' 	=> ' ',
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
			'default'	=> $options['bg_color']['default']
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_color', array(
			'label' => $options['bg_color']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[bg_color]'
		) ) );

		// Link Color
		$wp_customize->add_setting( 'soren_options[link_color]', array(
			'type' => 'option',
			'default'	=> $options['link_color']['default']
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label' => $options['link_color']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[link_color]'
		) ) );

		// Text Color
		$wp_customize->add_setting( 'soren_options[text_color]', array(
			'type' => 'option',
			'default'	=> $options['text_color']['default']
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
			'label' => $options['text_color']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[text_color]'

		) ) );

		// Header Color
		$wp_customize->add_setting( 'soren_options[header_color]', array(
			'type' => 'option',
			'default'	=> $options['header_color']['default']
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
			'label' => $options['header_color']['name'],
			'section' => 'soren_appearence',
			'settings' => 'soren_options[header_color]'
		) ) );

		// Font Size
		$wp_customize->add_setting( 'soren_options[font_size]', array(
			'type' => 'option',
			'default'	=> $options['font_size']['default']
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

		// Scoial Integration
		$wp_customize->add_section( 'soren_advanced', array(
			'title' => __( 'Social Integration', 'soren' ),
			'priority' => 112
		) );

		// GA
		$wp_customize->add_setting( 'soren_options[soren_ga]', array(
			'default' => $options['soren_ga']['default'],
			'type' => 'option',
			 'sanitize_callback' => self::sanitize_int(),
		) );
		$wp_customize->add_control( 'soren_ga', array(
			'label' => $options['soren_ga']['name'],
			'section' => 'soren_advanced',
			'settings' => 'soren_options[soren_ga]',
			'type' => $options['soren_ga']['type']
		) );

		// FB APP ID
		$wp_customize->add_setting( 'soren_options[soren_fb_app_id]', array(
			'default' => $options['soren_fb_app_id']['default'],
			'type' => 'option',
			'sanitize_callback' => self::sanitize_int(),
		) );
		$wp_customize->add_control( 'soren_fb_app_id', array(
			'label' => $options['soren_fb_app_id']['name'],
			'section' => 'soren_advanced',
			'settings' => 'soren_options[soren_fb_app_id]',
			'type' => $options['soren_fb_app_id']['type']
		) );

		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	public static function header_output() {
      	?>
      	<!--Customizer CSS-->
      	<style type='text/css'>
           	<?php self::generate_css('.soren-big-head', 'background-image', 'soren_options[soren_header_img]'); ?>
      	</style>
      	<!--/Customizer CSS-->
      	<?php
   	}

   	public static function live_preview() {
      	wp_enqueue_script('soren-themecustomizer',SOREN_THEME_URL.'/js/theme-customizer.js', array( 'jquery','customize-preview' ),	self::version, true);
   	}

    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      	$return = '';
      	$mod = get_option($mod_name);
      	if ( ! empty( $mod ) ) {

         	$return = sprintf('%s { %s:%s; }',$selector,$style,$prefix.$mod.$postfix);
         	if ( $echo ) {
            	echo $return;
         	}
      	}
      	return $return;
    }

    // Sanitize Footer Text
	private static function sanitize_footer_text( $input = '' ) {
	    return stripslashes_deep( $input );
	}

	private static function sanitize_text_field( $input = ''  ) {
		return sanitize_text_field( $input );
	}

	private static function sanitize_int( $input = ''  ) {
		return wp_filter_nohtml_kses( round( $input ) );

	}


}
// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'sorenCustomizer' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'sorenCustomizer' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'sorenCustomizer' , 'live_preview' ) );