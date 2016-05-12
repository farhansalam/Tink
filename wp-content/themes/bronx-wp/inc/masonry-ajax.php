<?php
add_action("wp_ajax_nopriv_thb_ajax", "thb_load_more_posts");
add_action("wp_ajax_thb_ajax", "thb_load_more_posts");

function thb_load_more_posts() {
	$count = $_POST['count'];
	$page = $_POST['page'];
	
  $args = array(
		'paged'	=> $page,
		'post_status' => 'publish',
  	'no_found_rows' => true,
		'suppress_filters' => 0
  );
	
	$query = new WP_Query( $args );
	if ($query->have_posts()) :  while ($query->have_posts()) : $query->the_post(); ?>
		<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('small-12 medium-6 large-4 item post columns'); ?> id="post-<?php the_ID(); ?>" role="article">
			<?php 
				$format = get_post_format();
				$masonry = 1;
				$formats = get_theme_support( 'post-formats' );
				if ($format && in_array($format, $formats[0] ) ) {
					include(locate_template( 'inc/postformats/'.$format.'.php' ));
				} else {
					include(locate_template( 'inc/postformats/standard.php' ));
				}
			?>
			<header class="post-title entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_attr(get_the_title()) ), '</a></h2>' ); ?>
			</header>
			<?php get_template_part( 'inc/postformats/post-meta' ); ?>
			
			<div class="post-content entry-content ">
				<?php echo thb_excerpt(200, '&hellip;'); ?>
			</div>
			<?php get_template_part( 'inc/postformats/post-meta' ); ?>
		</article>
	<?php
	endwhile; else : endif; 
	die();
}
?>