<?php 
	$id = get_queried_object_id();
	
	if (get_post_meta($id, 'footer_override', true) == 'on') {
		$footer_newsletter = get_post_meta($id, 'footer_newsletter', true);
		$footer = get_post_meta($id, 'footer', true);
	} else {
		$footer_newsletter = ot_get_option('footer_newsletter');
		$footer = ot_get_option('footer');
	}
?>
		</div><!-- End role["main"] -->
		<?php if (thb_accountpage_notloggedin()) { ?>
			<?php if ($footer_newsletter != 'off') { ?>
			<div class="thb_subscribe">
				<div class="row">
					<div class="small-12 medium-6 medium-centered large-6 columns footer-menu-holder text-center">
					 	<p><?php _e("Subscribe to our newsletter",'bronx'); ?></p>
						<form class="newsletter-form" action="#" method="post">   
							<input placeholder="<?php _e("Your E-Mail",'bronx'); ?>" type="text" name="widget_subscribe" class="widget_subscribe">
							<button type="submit" name="submit"><?php _e("&rarr;",'bronx'); ?></button>
						</form>
						<div class="result"></div>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<?php if ($footer != 'off') { ?>
			<!-- Start Footer -->
			<footer id="footer" role="contentinfo">
				<div class="row">
					<div class="small-12 medium-6 medium-centered large-6 columns footer-menu-holder text-center">
						<?php if(has_nav_menu('footer-menu')) { ?>
						  <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'footer-menu' ) ); ?>
						<?php } ?>
						<p><?php echo ot_get_option('copyright','Copyright 2014 NORTH ONLINE SHOPPING THEME. All RIGHTS RESERVED.'); ?> </p><p>Shared by <!-- Please Do Not Remove Shared Credits Link --><a href='http://www.themes24x7.com/' id="sd">Themes24x7</a><!-- Please Do Not Remove Shared Credits Link --></p>
						<div class="social-links">
							<?php if (ot_get_option('social-payment') == 'social') {?>
							<?php do_action( 'thb_social' ); ?>
							<?php } else if (ot_get_option('social-payment') == 'payment') { ?>
							<?php do_action( 'thb_payment' ); ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer -->
			<?php } ?>
		<?php } ?>
	</section> <!-- End #content-container -->

</div> <!-- End #wrapper -->

<?php do_action( 'thb_popup' );?>
<?php if (ot_get_option('extra_js')) { echo '<script>'.ot_get_option('extra_js').'</script>'; } ?>

<?php 
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 wp_footer(); 
?>
</body>
</html>