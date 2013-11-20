<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Flyte
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'flyte' ) ); ?>

</article><!-- #post-## -->