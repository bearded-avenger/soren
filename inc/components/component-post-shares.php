<?php

/**
  	* Social sharing for posts
  	*
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	*
*/
if (!function_exists('soren_post_shares')):

	function soren_post_shares(){

		$twitter = sprintf('<a href="http://twitter.com/share?text=%s&amp;url=%s">share on twitter</a>', get_permalink(),get_permalink());
		$facebook = sprintf('<a href="http://www.facebook.com/sharer.php?u=%s&amp;t=%s">share on twitter</a>', get_permalink(),get_the_title());
		
		$out = sprintf('<section class="soren-post-shares">%s%s</section>',$twitter, $facebook);
		return apply_filters('soren_post_share_output', $out);
	}

endif;
