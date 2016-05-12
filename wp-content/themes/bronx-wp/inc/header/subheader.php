<?php 
	$id = get_queried_object_id();
	
	if (get_post_meta($id, 'header_override', true) == 'on') {
		$subheader = get_post_meta($id, 'subheader', true);
	} else {
		$subheader = ot_get_option('subheader');
	}
?>
<?php if ($subheader != 'off') { ?>
<!-- Start Sub Header -->
<div class="subheader show-for-large-up">
	<div class="row full-width-row">
		<div class="small-12 medium-6 columns">
			<?php if (ot_get_option('subheader_ls') == 'on') { do_action( 'thb_language_switcher' ); } ?>
			<?php if ((ot_get_option('subheader_cs') == 'on' && !is_account_page()) && shortcode_exists('currency_switcher')) { ?>
			<div class="select-wrapper currency_switcher"><?php do_action('currency_switcher'); ?></div>
			<?php } ?>
			<?php if ($subheader_text = ot_get_option('subheader_Text','*Free two-day shipping and returns')) { ?>
			<p><?php _e($subheader_text, 'bronx'); ?></p>
			<?php } ?>
		</div>
		<div class="small-12 medium-6 columns text-right">
			<nav class="subheader-menu">
				<?php if (has_nav_menu('acc-menu-in') && is_user_logged_in()) { ?>
				  <?php wp_nav_menu( array( 'theme_location' => 'acc-menu-in', 'depth' => 1, 'container' => false ) ); ?>
				<?php } else if (has_nav_menu('acc-menu-out') && !is_user_logged_in()) { ?>
					<?php wp_nav_menu( array( 'theme_location' => 'acc-menu-out', 'depth' => 1, 'container' => false ) ); ?>
				<?php } ?> 
			</nav>
		</div>
	</div>
</div>
<!-- End Sub Header -->
<?php } ?>