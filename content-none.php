<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Soren
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'soren' ) ); ?>

</article><!-- #post-## -->