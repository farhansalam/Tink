<?php function thb_postgrid( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'item_count' => '3',
       	'source' => 'most-recent',
	   		'cat' => '',
	   		'post_ids' => '',
	   		'tag_slugs' => '',
	   		'author_ids' => '',
       	'columns' => '3',
       	'excluded_tag_ids' => '',
       	'excluded_cat_ids' => '',
    ), $atts));

	$args = array(
		'nopaging' => 0, 
		'post_type'=>'post', 
		'post_status' => 'publish', 
		'ignore_sticky_posts' => 1,
		'no_found_rows' => true,
		'suppress_filters' => 0
	);
	
	if ($source == 'most-recent') {
		$excluded_tag_ids = explode(',',$excluded_tag_ids);
		$excluded_cat_ids = explode(',',$excluded_cat_ids);
		$args = wp_parse_args( 
			array(
				'posts_per_page' => $item_count,
				'tag__not_in' => $excluded_tag_ids,
				'category__not_in' => $excluded_cat_ids
			)
		, $args );

	} else if ($source == 'by-category') {
	 	if (!empty($cat)) {
	 		$cats = explode(',',$cat);
	 		$args = wp_parse_args( 
	 			array(
	 				'posts_per_page' => $item_count,
	 				'category__in' => $cats
	 			)
	 		, $args );	
	 	}
	} else if ($source == 'by-id') {
		$post_id_array = explode(',', $post_ids);
		
		$args = wp_parse_args( 
			array(
				'post__in' => $post_id_array,
				'posts_per_page' => 99
			)
		, $args );	
	} else if ($source == 'by-tag') {
		$post_tag_array = explode(',', $tag_slugs);
		
		$args = wp_parse_args( 
			array(
				'posts_per_page' => $item_count,
				'tag_slug__in' => $post_tag_array
			)
		, $args );	
	} else if ($source == 'by-share') {
		
		$args = wp_parse_args( 
			array(
				'posts_per_page' => $item_count,
				'meta_key' => 'thb_pssc_counts',  
				'orderby' => 'meta_value_num'
			)
		, $args );	
	} else if ($source == 'by-author') {
		$post_author_array = explode(',', $author_ids);
		
		$args = wp_parse_args( 
			array(
				'posts_per_page' => $item_count,
				'author__in' => $post_author_array
			)
		, $args );	
	}
	$posts = new WP_Query( $args );
 	
 	ob_start();
 	
	if ( $posts->have_posts() ) { ?>
		<?php switch($columns) {
			case 2:
				$col = 'medium-6 large-6';
				break;
			case 3:
				$col = 'medium-4 large-4';
				break;
			case 4:
				$col = 'medium-6 large-3';
				break;
		} ?>
			<div class="row posts" data-equal=">.columns">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class('small-12 '.$col.' post columns'); ?> id="post-<?php the_ID(); ?>" role="article">
						<figure class="post-gallery">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('bronx-blog-grid'); ?>
							</a>
						</figure>
						<header class="post-title entry-header">
							<?php the_title( sprintf( '<h3 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), esc_attr(get_the_title()) ), '</a></h3>' ); ?>
						</header>	
						<div class="post-content entry-content ">
							<?php echo thb_excerpt(200, '&hellip;'); ?>
						</div>
						<?php get_template_part( 'inc/postformats/post-meta' ); ?>
					</article>
				<?php endwhile; // end of the loop. ?>
			</div>
   <?php
	 }
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_postdata();
     
  return $out;
}
add_shortcode('thb_postgrid', 'thb_postgrid');