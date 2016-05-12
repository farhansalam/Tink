<div class="row">
	<section class="small-12 large-9 columns cf blog-section">
	  <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
			<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" role="article">
				<?php 
					$format = get_post_format();
					$masonry = 0;
					$formats = get_theme_support( 'post-formats' );
					if ($format && in_array($format, $formats[0] ) ) {
						include(locate_template( 'inc/postformats/'.$format.'.php' ));
					} else {
						include(locate_template( 'inc/postformats/standard.php' ));
					}
				?>
				<header class="post-title entry-header">
					<?php the_title( sprintf( '<h3 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_attr(get_the_title()) ), '</a></h3>' ); ?>
				</header>
				
				<div class="post-content entry-content">
					<?php echo thb_excerpt(200, '&hellip;'); ?>
				</div>
				<?php get_template_part( 'inc/postformats/post-meta' ); ?>
			</article>
	  <?php endwhile; ?>
	  <?php the_posts_pagination(array(
	  	'prev_text' 	=> '<span>'.__( "&larr;", 'bronx' ).'</span>',
	  	'next_text' 	=> '<span>'.__( "&rarr;", 'bronx' ).'</span>',
	  )); ?>
	  <?php else : ?>
	    <p><?php _e( 'Please add posts from your WordPress admin page.', 'bronx' ); ?></p>
	  <?php endif; ?>
	</section>
	<?php get_sidebar(); ?>
</div>