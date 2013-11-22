<?php
/**
  	* Adds a custom CSS editor to the Appearence menu. This may be moved into a separate plugin.
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	*
*/
class sorenCustomCSSEditor {

	function __construct(){

		add_action( 'admin_enqueue_scripts', array($this,'custom_css_scripts' ));
		add_action( 'admin_menu', array($this,'custom_css_admin_page' ));
		add_action( 'admin_init', array($this,'register_custom_css_setting' ));
		add_action( 'wp_head', array($this,'display_custom_css' ));

	}

	function custom_css_scripts( $hook ) {
	    if ( 'appearance_page_custom_css_admin_page_content' == $hook ) {
	        wp_enqueue_script( 'ace_code_highlighter_js', SOREN_THEME_URL.'/libs/ace/ace.js', '', SOREN_THEME_VERSION, true );
	        wp_enqueue_script( 'ace_mode_js', SOREN_THEME_URL.'/libs/ace/mode-css.js', array( 'ace_code_highlighter_js' ), SOREN_THEME_VERSION, true );
	        wp_enqueue_script( 'custom_css_js', SOREN_THEME_URL.'/libs/ace/custom-css.js', array( 'jquery', 'ace_code_highlighter_js' ), SOREN_THEME_VERSION, true );
	    }
	}

	function custom_css_admin_page() {
	    add_theme_page( 'Custom CSS',  __( 'Custom CSS','soren' ), 'edit_theme_options', 'custom_css_admin_page_content', array($this,'custom_css_admin_page_content') );
	}

	function register_custom_css_setting() {
	    register_setting( 'custom_css', 'custom_css',  array($this,'custom_css_validation'));
	}

	function custom_css_admin_page_content() {
	    // The default message that will appear
	    $custom_css_default = __( '/*
			Welcome to the Custom CSS editor!

			Please add all your custom CSS here and avoid modifying the core theme files, since that\'ll make upgrading the theme problematic. Your custom CSS will be loaded after the theme\'s stylesheets, which means that your rules will take precedence. Just add your CSS here for what you want to change, you don\'t need to copy all the theme\'s style.css content.
			*/' );
	    $custom_css = get_option( 'custom_css', $custom_css_default );
	    ?>
	    <div class="wrap">
	        <div id="icon-themes" class="icon32"></div>
	        <h2><?php _e( 'Custom CSS' ); ?></h2>
	        <?php if ( ! empty( $_GET['settings-updated'] ) ) echo '<div id="message" class="updated"><p><strong>' . __( 'Custom CSS updated.' ) . '</strong></p></div>'; ?>

	        <form id="custom_css_form" method="post" action="options.php" style="margin-top: 15px;">

	            <?php settings_fields( 'custom_css' ); ?>

	            <div id="custom_css_container">
	                <div name="custom_css" id="custom_css" style="border: 1px solid #DFDFDF; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; width: 100%; height: 400px; position: relative;"></div>
	            </div>

	            <textarea id="custom_css_textarea" name="custom_css" style="display: none;"><?php echo $custom_css; ?></textarea>
	            <p><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" /></p>
	        </form>
	    </div>
	<?php
	}

	function custom_css_validation( $input ) {
	    if ( ! empty( $input['custom_css'] ) )
	        $input['custom_css'] = trim( $input['custom_css'] );
	    return $input;
	}


	function display_custom_css() {

		$custom_css = get_option( 'custom_css' );
		if ( ! empty( $custom_css ) ) { ?>
			<style type="text/css">
			    <?php
			    	echo '/* Soren Custom CSS */' . "\n";
			    	echo $custom_css . "\n";
			    ?>
			</style>
	    <?php }
	}


}

new sorenCustomCSSEditor;

