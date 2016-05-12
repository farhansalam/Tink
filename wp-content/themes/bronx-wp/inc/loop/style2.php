<div class="row">
	<div class="small-12 columns">
		<section class="row masonry blog-masonry" id="infinitescroll" data-count="<?php echo esc_attrget_option('posts_per_page')); ?>" data-total="<?php echo esc_attr($wp_query->max_num_pages); ?>">
		  <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('small-12 medium-6 large-4 item post columns'); ?> id="post-<?php the_ID(); ?>" role="article">
					<?php 
						$masonry = 1;
						include(locate_template( 'inc/postformats/image.php' ));
					?>
					<header class="post-title entry-header">
						<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_attr(get_the_title()) ), '</a></h2>' ); ?>
					</header>	
					<div class="post-content entry-content ">
						<?php echo thb_excerpt(200, '&hellip;'); ?>
					</div>
					<?php get_template_part( 'inc/postformats/post-meta' ); ?>
				</article>
		  <?php endwhile; else : ?>
		    <p><?php _e( 'Please add posts from your WordPress admin page.', 'bronx' ); ?></p>
		  <?php endif; ?>
		</section>
	</div>
</div>
<?php get_footer(); ?>