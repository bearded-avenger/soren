<?php
/**
 * @package Soren
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<time class="soren-entry-date" datetime="<?php the_date('F jS, Y'); ?>" itemprop="datePublished" pubdate><?php echo the_time('F jS, Y'); ?></time>

	<h2 class="soren-entry-title" itemprop="title"><a class="soren-fader" href="<?php the_permalink();?>"><?php the_title();?></a></h2>

	<section class="soren-entry-content">
		<?php the_content( __( apply_filters('soren_continue_reading','Continue reading <span class="soren-meta-nav">&raquo;</span>', 'soren' )) ); ?>
	</section>

</article><!-- #post-## -->