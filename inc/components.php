<?php

/**
  	* Generates an off canvas menu toggled via menu button
  	*
  	* * loads menu.js
  	* * loads modernizer for css3 transitions
  	*
  	* Theme Authors - just drop the function in your chld theme functions.php and pass optional arguments
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	*
  	* @since 1.0
  	*
  	* @param int    $depth  How many levels should the menu be
  	* @param string $menuclass Add optional classes to the menu ul
  	* @param string $containerclass Add optional classes to the nav container
*/
if (!function_exists('soren_push_nav')):

	function soren_push_nav($depth = '', $menuclass = '', $containerclass = ''){

		wp_enqueue_script('soren-menu');
		wp_enqueue_script('soren-modernizer');

		wp_nav_menu( 
			array( 
			'theme_location' => 'main_nav',
			'menu_class' => 'unstyled',
			'container_class' => 'pushy pushy-left',
			'container'			=> 'nav',
			'fallback_cb'     => 'soren_nav_fallback',
		) );
		?><div class="menu-btn">☰</div>
		<div class="site-overlay"></div><?php
	}

endif;

/**
  	* Generates an unstyled list of images, in different types, from a Wordpress media gallery
  	*
  	* User creates, and inserts a Wordpress media gallery into any post or page
  	* Regex helper is used to get the ids from the shortcode, and passes them into post__in query
  	*
  	*
  	*
  	* @author  Nick Haskins <email@nickhaskins.com>
  	*
  	* @since 1.0
  	*
  	* @param string $type Pass the type of gallery - default, grid
  	* @param string $size Pass the size of any registered image size. default is full
  	*
*/
if (!function_exists('soren_gallery')):

	function soren_gallery($type = 'default',$size = 'full'){

		global $post;
		$id                 = $post->ID;

       	$shortcode_args = shortcode_parse_atts(soren_gallery_match('/\[gallery\s(.*)\]/isU', $post->post_content));

        $ids = $shortcode_args["ids"];

        $args = array(
            'include'                => $ids,
	        'post_status'            => 'inherit',
	        'post_type'              => 'attachment',
	        'post_mime_type'         => 'image',
	        'order'                  => 'menu_order ID',
	        'orderby'                => 'post__in', //required to order results based on order specified the "include" param
		);

        $images = get_posts(apply_filters('soren_gallery_args',$args));
        $out = '';

        if ($images):

        	if ('default' == $type) {

		        $out  = '';
		        $out .= sprintf('<section class="soren-gallery soren-gallery-%s"><ul class="slides unstyled">',$id);

		            foreach($images as $image):

		                $img  = wp_get_attachment_image_src($image->ID, $size);
		                $alt  = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
		                $out .= sprintf('<li><img src="%s" alt="%s" /></li>',$img[0],$alt);

		            endforeach;

		        $out .= '</ul></section>';

		    } elseif ('grid' == $type) {

	        	wp_enqueue_script('soren-grid-gallery');

				?>
				<script>
					jQuery(document).ready(function(){
					    jQuery('.soren-grid-gallery.soren-grid-gallery-<?php echo $id;?>').imagesLoaded(function() {
					        var options = {
					          	autoResize: true,
					          	container: jQuery('.soren-grid-gallery.soren-grid-gallery-<?php echo $id;?>'),
					          	offset: <?php echo $atts['pinspace'];?>,
					          	flexibleWidth: <?php echo $atts['pinwidth'];?>
					        };
					        var handler = jQuery('.soren-grid-gallery.soren-grid-gallery-<?php echo $id;?> figure');
					        jQuery(handler).wookmark(options);
					    });
					});
				</script><?php

		        $out  = '';
		        $out .= sprintf('<section class="soren-grid-gallery soren-grid-gallery-%s">',$id);

					foreach($images as $image):

						$image 	= wp_get_attachment_image($image->ID, $size, false, array('class' => 'soren-grid-gallery-image'));
		               	$out 	.= sprintf('<figure class="soren-grid-gallery-item">%s</figure>',$image);

		            endforeach;

		        $out .= '</section>';

		    }

		   return apply_filters('soren_gallery_output',$out);


        endif;
	}

endif;
