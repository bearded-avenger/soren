<?php

if (!function_exists('soren_post_nav')) {

	function soren_post_nav($adjacent = false){

    	$class = $adjacent ? 'adjacent' : false;

    	?>
    	<nav class="soren-post-nav <?php echo $class;?>" role="navigation" itemprop ><?php

	    	if ($adjacent) {

	    		$prev = get_adjacent_post(true,'',true); 
	    		$prevlink = get_permalink(get_adjacent_post(false,'',true));

				$next = get_adjacent_post(false,'',false);
				$nextlink = get_permalink(get_adjacent_post(false,'',false));

				if ($prevlink != get_permalink()) {
	        		?><a class="soren-post-adjacent previous" href="<?php echo $prevlink;?>">
        				<?php echo get_the_post_thumbnail($prev->ID, array(68,68, true) ); ?>
        				<p><?php _e('Previous Post','soren');?></p>
						<h6 class="soren-post-adjacent-title" itemprop="title"><?php echo $prev->post_title; ?></h6>
					</a>
				<?php }

				if ($nextlink != get_permalink()) {
					?><a class="soren-post-adjacent next" href="<?php echo $nextlink;?>">
						<?php echo get_the_post_thumbnail($next->ID, array(68,68, true) ); ?>
						<p><?php _e('Next Post','soren');?></p>
						<h6 class="soren-post-adjacent-title" itemprop="title"><?php echo $next->post_title; ?></h6>
					</a>
				<?php }

	    	} else {

			    previous_post_link('%link','Previous');
			    next_post_link('%link','Next');

	        }

        ?></nav><?php
	}
}