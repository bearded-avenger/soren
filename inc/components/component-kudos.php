<?php

/**
  	* Generates a thumbs up, like, kudos style interactive hotspot
  	*
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	*
*/
if (!function_exists('soren_post_kudos')):

	function soren_post_kudos(){


		$out = sprintf('<section class="soren-post-kudos">kudos yo</section>');
		return apply_filters('soren_post_kudos_output', $out);
	}

endif;

