<?php
	$id = get_queried_object_id();
	$header_transparent = $header_container = '';
	$header = ot_get_option('header', 'on');
	$fixed_header = ot_get_option('fixed_header', 'on') == 'on' ? 'tofixed' : '';
	$header_cart = ot_get_option('header_cart');
	$header_search = ot_get_option('header_search');
	$header_wishlist = ot_get_option('header_wishlist');
	$header_color = ot_get_option('header_color','header--light');
	$page_menu = (get_post_meta($id, 'page_menu', true) !== '' ? get_post_meta($id, 'page_menu', true) : false);
	if(class_exists('woocommerce')) {
		if (is_shop()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option('header_color_shop') ? ot_get_option('header_color_shop') : 'header--dark';
		}
		if (is_product_category()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option('header_color_product_category') ? ot_get_option('header_color_product_category') : 'header--dark';
		}
		if (is_account_page()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option('header_color_myaccount') ? ot_get_option('header_color_myaccount') : 'header--dark';
		}
		if (is_cart()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option('header_color_cart') ? ot_get_option('header_color_cart') : 'header--dark';
		}
		if (is_checkout()) {
			$header_transparent = 'transparent';
			$header_color = ot_get_option('header_color_checkout') ? ot_get_option('header_color_checkout') : 'header--dark';
		}
	}
	if (get_post_meta($id, 'header_override', true) == 'on') {
		$header = get_post_meta($id, 'header', true);
		$header_container = get_post_meta($id, 'header_container', true);
		$header_transparent = get_post_meta($id, 'header_transparent', true) == 'on' ? 'transparent' : '';
		$header_color = get_post_meta($id, 'header_color', true) ? get_post_meta($id, 'header_color', true) : 'header--dark';
	}
?>
<?php if ($header != 'off') { ?>

	<?php if (thb_header_container($header_container)) { 
		echo '<div class="header-container">';
	} ?>
	<!-- Start Header -->
	<header class="header <?php echo esc_attr($header_transparent.' '.$header_color.' '.$fixed_header);?>" data-offset="400" data-stick-class="header--slide" data-unstick-class="header--unslide"  role="banner">
		<div class="row" data-equal=">.columns" data-row-detection="true">
			<div class="small-12 medium-6 xlarge-3 columns logo small-only-text-center">
				<?php if (ot_get_option('logo')) { $logo = ot_get_option('logo'); } else { $logo = THB_THEME_ROOT. '/assets/img/logo-light.png'; } ?>
				<?php if (ot_get_option('logo_dark')) { $logo_dark = ot_get_option('logo_dark'); } else { $logo_dark = THB_THEME_ROOT. '/assets/img/logo-dark.png'; } ?>
				<a href="<?php echo home_url(); ?>" class="logolink">
					<img src="<?php echo esc_url($logo); ?>" class="logoimg logo--light" alt="<?php bloginfo('name'); ?>"/>
					<img src="<?php echo esc_url($logo_dark); ?>" class="logoimg logo--dark" alt="<?php bloginfo('name'); ?>"/>
				</a>
			</div>
			<div class="small-12 xlarge-6 columns menu-holder">
					<nav role="navigation">
						<?php if ($page_menu) { ?>
							<?php wp_nav_menu( array( 'menu' => $page_menu, 'depth' => 3, 'container' => false, 'menu_class' => 'sf-menu', 'walker' => new thb_OnePageMenu  ) ); ?>
						<?php } else if (has_nav_menu('nav-menu')) { ?>
						  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'sf-menu', 'walker' => new thb_OnePageMenu  ) ); ?>
						<?php } else if ( current_user_can( 'edit_theme_options' ) ) { ?>
						    <ul class="sf-menu">
						        <li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu', 'bronx' ); ?></a></li>
						    </ul>
						<?php } ?>
					</nav>
			</div>
			
			<div class="small-12 medium-6 xlarge-3 columns account-holder small-only-text-center">
				<a href="#" data-target="open-menu" class="mobile-toggle"><i class="fa fa-bars"></i></a>
				<?php if ($header_search != 'off') { do_action( 'thb_quick_search' ); } ?>
				<?php if ($header_wishlist != 'off') { do_action( 'thb_quick_wishlist' ); } ?>
				<?php if ($header_cart != 'off') { do_action( 'thb_quick_cart' ); } ?>
			</div>
		</div>
	</header>
	
	
	<?php if (thb_header_container($header_container)) { ?>
			<div id="page-title" class="table">
				<div>
					<h1 class="page-title">
						<?php 
							if(is_woocommerce()) {
								woocommerce_page_title(); 
							} else {
								echo get_the_title($id);
							}
						?>
					</h1>
				</div>
			</div>
		</div>
	<?php } ?>
	<!-- End Header -->
<?php } ?>