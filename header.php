<?php

class sorenThemeHeader {

	function __construct(){

		$this->header();
	}

	function html_schema(){

	 	$base = 'http://schema.org/';

	    // Is single post

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

	    echo 'itemscope="itemscope" itemtype="' . $base . $type . '"';
	}

	function header(){

		?>
		<!DOCTYPE html>

		<html <?php language_attributes(); ?> <?php $this->html_schema(); ?>>
		<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>
		</head>

		<body <?php body_class(); ?>>

	<?php }

}
new sorenThemeHeader;














