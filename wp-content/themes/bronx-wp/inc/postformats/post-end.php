<?php $posttags = get_the_tags(); ?>
<?php if (!empty($posttags)) { ?>
<footer class="article-tags entry-footer">
	<?php
	if ($posttags) {
		$return = '';
		foreach($posttags as $tag) {
			$return .= '<a href="'. get_tag_link($tag->term_id).'" title="'. get_tag_link($tag->name).'" class="tag-link">' . $tag->name . '</a> ';
		}
		echo substr($return, 0, -1);
	} ?>
</footer>
<?php } ?>
<?php if (ot_get_option('article_author', 'on') == 'on') { ?> 
<section class="authorpage">
	<?php do_action('thb_author'); ?>
</section>
<?php } ?>