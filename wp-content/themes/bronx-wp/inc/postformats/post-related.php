<!-- Start Related Posts -->
<?php
	global $post; 
  $postId = $post->ID;
  $query = thb_get_blog_posts_related_by_category($postId); 
?>
<?php if ($query->have_posts()) : ?>
<aside class="related-posts cf hide-on-print">
	<div class="row">
	<h4 class="related-title"><?php _e( 'Related News', 'bronx' ); ?></h4>
  <?php while ($query->have_posts()) : $query->the_post(); ?>             
    <div class="small-12 medium-4 columns">
    	<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" role="article">
    		<?php if ( has_post_thumbnail() ) { ?>
    		<figure class="post-gallery fresco">
    			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('bronx-blog-post'); ?></a>
    		</figure>
    		<?php } ?>
    		<header class="post-title">
    			<?php the_title( sprintf( '<h4 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_attr(get_the_title()) ), '</a></h4>' ); ?>
    		</header>
    		<div class="post-content">
    			<?php echo thb_excerpt(200, '&hellip;'); ?>
    		</div>
    		<?php get_template_part( 'inc/postformats/post-meta' ); ?>
    	</article>
    </div>
  <?php endwhile; ?>
  </div>
</aside>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<!-- End Related Posts -->