<?php
/**
 * @package Soren
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'soren' ) ); ?>

</article><!-- #post-## -->