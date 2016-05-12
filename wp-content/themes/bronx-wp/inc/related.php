<?php
// Related Blog Posts
function thb_get_blog_posts_related_by_taxonomy($post_id, $args=array()) {
  $tags = wp_get_post_tags($post_id);
  $query = new WP_Query();
  if (count($tags)) {
	  $tagIDs = array();
	  $tagcount = count($tags);
	  for ($i = 0; $i < $tagcount; $i++) {
	    $tagIDs[$i] = $tags[$i]->term_id;
	  }
	  $args = wp_parse_args($args,array(
	    'tag__in' => $tagIDs,
	    'post__not_in' => array($post_id),
	    'ignore_sticky_posts'=> 1,
	  	'showposts' => 3,
	  	'no_found_rows' => true
	  ));
	  $query = new WP_Query($args);
	  wp_reset_postdata();
	}
  return $query;
}

// Related Posts by Category
function thb_get_blog_posts_related_by_category($post_id, $args=array()) {
	$post_categories = wp_get_post_categories( $post_id );
  $args = wp_parse_args($args,array(
    'category__in' => $post_categories,
    'post__not_in' => array($post_id),
    'ignore_sticky_posts'=> 1,
    'orderby' => 'rand',
  	'showposts' => 3,
  	'no_found_rows' => true
  ));
  $query = new WP_Query($args);
	wp_reset_postdata();
  return $query;
}
?>