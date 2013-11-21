<?php

get_header();

	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			/* Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

		endwhile;

	else :

		get_template_part( 'content', 'none' );

	endif;


get_footer();
