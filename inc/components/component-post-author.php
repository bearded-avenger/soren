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

	function soren_post_author(){

        global $post;
        setup_postdata($post);

        ob_start();
            the_author_meta('url');
        $link = ob_get_clean();

        $default_avatar = false;
        $author_email = get_the_author_meta('email', $post->post_author);
        $author_name = get_the_author();
        $author_first = get_the_author_meta('first_name', $post->post_author);
        $author_desc = get_the_author_meta('description', $post->post_author);
        $google_profile = get_the_author_meta( 'google_profile' );

		?>
        <section class="media soren-post-author">
            <div class="pull-left">
                <a class="thumbnail" href="<?php echo $link; ?>" target="_blank">
                    <?php echo get_avatar( $author_email, '80', $default_avatar); ?>
                </a>
            </div>
            <div class="media-body">
            	<div class="row">
            		<div class="col-md-8">
                		<small class="soren-author-note"><?php _e('Posted By', 'soren');?></small>
                		<h6 class="media-heading"><?php echo $author_name ?></h6>
                		<p class="soren-author-details"><?php echo $author_desc; ?></p>
                	</div>
                	<div class="col-md-4">

                	<?php if( $link != '' )
                    	printf( '<a href="%s" class="btn btn-default soren-author-link" target="_blank">More of %s  &nbsp;&rsaquo;</a> ', $link, $author_first);

                	?>
                </div>
                </div>
            </div>
        </section><?php
    }

endif;

