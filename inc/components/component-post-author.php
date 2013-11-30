<?php

/**
  	* Show the post author with links to posts, along with any bio and web stuff set in user meta
  	*
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	* @since 1.0
  	*
*/
if (!function_exists('soren_post_author')):

	function soren_post_author($extended = '', $avatarsize = 80, $link = false, $clean = false, $postedby = 'Posted by'){

        global $post;
        setup_postdata($post);

        ob_start();
            the_author_meta('url');
        $author_out_link = ob_get_clean();

        $default_avatar = false;
        $author_email = get_the_author_meta('email', $post->post_author);
        $author_name = get_the_author();
        $author_url = get_author_posts_url(  get_the_author_meta( 'ID' ));
        $author_first = get_the_author_meta('first_name', $post->post_author);
        $author_desc = get_the_author_meta('description', $post->post_author);
        $google_profile = get_the_author_meta( 'google_profile' );

        $author = (true == $link) ? sprintf('<h6 class="media-heading"><a class="soren-fader" href="%s">%s</a></h6>', $author_url, $author_name) : sprintf('<h6 class="media-heading">%s</h6>', $author_name);

        if (true == $clean) { ?>

            <a class="thumbnail" href="<?php echo $author_out_link; ?>" target="_blank"><?php echo get_avatar( $author_email, $avatarsize, $default_avatar); ?></a>

        	<?php if (true == $extended) { ?>

        		<small class="soren-author-note"><?php _e($postedby, 'soren');?></small>
        		<?php echo $author;?>
        		<p class="soren-author-details"><?php echo $author_desc; ?></p>
            	<?php if( $author_out_link != '' ) {
                	printf( '<a href="%s" class="btn btn-default soren-author-link" target="_blank">More of %s  &nbsp;&rsaquo;</a> ', $author_out_link, $author_first);
            	}

            } else { ?>
                <small class="soren-author-note"><?php _e($postedby, 'soren');?></small>
                <?php echo $author;
            }

        } else { ?>
	        <section class="media soren-post-author">
	            <div class="pull-left">
	                <a class="thumbnail" href="<?php echo $author_out_link; ?>" target="_blank">
	                    <?php echo get_avatar( $author_email, $avatarsize, $default_avatar); ?>
	                </a>
	            </div>
	            <div class="media-body">
	            	<?php if (true == $extended) { ?>
		            	<div class="row">
		            		<div class="col-md-8 soren-author-details-wrap">
		                		<small class="soren-author-note"><?php _e($postedby, 'soren');?></small>
		                		<?php echo $author;?>
		                		<p class="soren-author-details"><?php echo $author_desc; ?></p>
		                	</div>
		                	<div class="col-md-4 soren-author-extended-wrap">
			                	<?php if( $author_out_link != '' ) {
			                    	printf( '<a href="%s" class="btn btn-default soren-author-link" target="_blank">More of %s  &nbsp;&rsaquo;</a> ', $author_out_link, $author_first);
			                	} ?>
			                </div>
		                </div>
	                <?php } else { ?>
		                <small class="soren-author-note"><?php _e($postedby, 'soren');?></small>
		                <?php echo $author;?>
	                <?php }?>
	            </div>
	        </section><?php }
    }

endif;

