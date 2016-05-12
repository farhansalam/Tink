<?php if ( has_post_thumbnail() ) { ?>
<figure class="post-gallery">
	<?php
	    $image_id = get_post_thumbnail_id();
	    $image_link = wp_get_attachment_image_src($image_id,'full');
	    $image_title = esc_attr( $image_id );
	?>
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($image_title); ?>">
		<?php 
			if ($masonry) {
				the_post_thumbnail('bronx-blog-masonry'); 
			} else if (!is_singular()) {
				the_post_thumbnail('bronx-blog-post'); 
			} else {
				the_post_thumbnail('bronx-blog-detail'); 
			}
		?>
	</a>
</figure>
<?php } ?>