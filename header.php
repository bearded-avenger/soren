<!DOCTYPE html>

<html <?php language_attributes(); ?> <?php soren_html_schema(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<?php do_action('soren_after_header'); //action ?>
<body <?php body_class(); ?>>
<?php do_action('soren_inside_top_body'); //action 





