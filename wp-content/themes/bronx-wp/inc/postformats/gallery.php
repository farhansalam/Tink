<?php 
	$id = get_the_ID();
	$attachments = get_post_meta($id, 'pp_gallery_slider', TRUE);
	$attachment_array = explode(',', $attachments);
	$rev_slider_alias = get_post_meta($id, 'rev_slider_alias', TRUE);
?>
<?php if ($rev_slider_alias) {?>
	<div class="post-gallery">
		<?php putRevSlider($rev_slider_alias); ?>
	</div>
<?php  } else { ?>
	<div class="post-gallery">
		<div class="carousel slick" data-columns="1" data-navigation="true">
				<?php foreach ($attachment_array as $attachment) : ?>
				    <?php 
				    	if ($masonry) {
				    		echo wp_get_attachment_image($attachment, 'bronx-blog-masonry');
				    	} else if (!is_singular()) {
				    		echo wp_get_attachment_image($attachment, 'bronx-blog-post');
				    	} else {
				    		echo wp_get_attachment_image($attachment, 'bronx-blog-detail');
				    	}
				    ?>
				<?php endforeach; ?>
			</div>
	</div>
<?php } ?>