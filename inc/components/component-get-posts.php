<?php
/**
  	* Get Posts
  	*
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	* @param string $category pass a category id to pull posts from that category
  	* @param int $num pass a number to limit number of posts
  	*
*/
if (!function_exists('soren_get_posts')):

	function soren_post_list($category = '', $num = 5, $more = false){

		$args = array(
			'posts_per_page' => $num,
			'category__in' => $category
		);
		$q = new wp_query($args);

		if ($q->have_posts()): 

			while($q->have_posts()): $q->the_post();

				?><article id="featured-<?php the_ID(); ?>" <?php post_class(); ?>><?php

					?><a class="soren-post-image-link soren-fader" href="<?php the_permalink();?>"><?php the_post_thumbnail(array(100,100));?></a>

					<h5 itemprop="title"><a class="soren-fader" href="<?php the_permalink();?>"><?php the_title(); ?></a></h5><?php

					the_excerpt();

					if ($more):
						?><a class="soren-read-more soren-fader" href="<?php the_permalink();?>">More</a><?php
					endif;

				?></article><?php

			endwhile;

		else:
			_e('No posts found.','hobson');
		endif;

		wp_reset_query();
	}

endif;
