<aside class="post-meta">
	<ul>
		<?php if(has_category()) { ?>
		<li><?php the_category(', '); ?> / </li>
		<?php } ?>
		<li><time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time> / </li>
		<li><?php _e("by", 'bronx'); ?> <?php the_author_posts_link(); ?></li>
	</ul>
</aside>