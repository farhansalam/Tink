<?php $sidebar_pos = isset($_GET['sidebar']) ? htmlspecialchars($_GET['sidebar']) : ot_get_option('shop_sidebar', 'no'); ?>

<aside class="sidebar woo small-12 medium-12 large-3 columns<?php if ($sidebar_pos == 'left') { echo ' large-pull-9'; }?>" role="complementary">
	<?php 
	
		##############################################################################
		# Shop Page Sidebar
		##############################################################################
	
	 	?>
	<?php dynamic_sidebar('shop'); ?>
</aside>