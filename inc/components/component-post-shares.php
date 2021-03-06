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

		$twitter = sprintf('<a class="soren-twitter-share" href="http://twitter.com/share?text=%s&amp;url=%s" target="_blank"><i class="sorencon sorencon-twitter"></i></a>', get_permalink(),get_permalink());
		$facebook = sprintf('<a class="soren-facebook-share" href="http://www.facebook.com/sharer.php?u=%s&amp;t=%s" target="_blank"><i class="sorencon sorencon-facebook"></i></a>', get_permalink(),get_the_title());

		$out = sprintf('%s%s',$twitter, $facebook);
		return apply_filters('soren_post_share_output', $out);
	}

endif;

