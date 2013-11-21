<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Soren
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h2 class="soren-entry-title" itemprop="title"><?php the_title();?></h2>
	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'soren' ) ); ?>

</article><!-- #post-## -->