<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Soren
 */

get_header();


	while ( have_posts() ) : the_post();

		get_template_part( 'content', 'single' );
		
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();

	endwhile;


get_footer();