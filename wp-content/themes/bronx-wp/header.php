<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta http-equiv="cleartype" content="on">
	<meta name="HandheldFriendly" content="True">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_site_icon(); ?>
	<?php 
		$id = get_queried_object_id();
		$page_scroll = (get_post_meta($id, 'page_scroll', true) == 'on' ? 'page_scroll' : '');
		$snap_scroll = (get_post_meta($id, 'snap_scroll', true) == 'on' ? 'snap_scroll' : '');
		$rev_slider_alias = get_post_meta($id, 'rev_slider_alias', true);
		$smooth_scroll = (ot_get_option('smooth_scroll') != 'off' ? 'smooth_scroll' : '');
		
	?>
	<?php
		$class = array();
	 	array_push($class, $page_scroll);
	 	if(!empty($snap_scroll)) { 
	 		array_push($class, 'snap');
	 	}
		array_push($class, $smooth_scroll);
	?>
	<?php 
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head(); 
	?>
</head>
<body <?php body_class($class); ?> data-cart-count="<?php if(class_exists('woocommerce')) {echo WC()->cart->cart_contents_count; } ?>" data-themeurl="<?php echo THB_THEME_ROOT; ?>">
<div id="wrapper" class="open">
	
	<!-- Start Mobile Menu -->
	<?php do_action( 'thb_mobile_menu' ); ?>
	<!-- End Mobile Menu -->
	
	<!-- Start Quick Cart -->
	<?php do_action( 'thb_side_cart' ); ?>
	<!-- End Quick Cart -->
	
	<!-- Start Content Container -->
	<section id="content-container">
		<!-- Start Content Click Capture -->
		<div class="click-capture"></div>
		<!-- End Content Click Capture -->
		<?php 
			if (thb_accountpage_notloggedin()) {
				get_template_part( 'inc/header/subheader' );
				get_template_part( 'inc/header/style1' );
			}
		?>
		<?php if (is_page() && $rev_slider_alias) {?>
			<?php $rev_slider_white = get_post_meta($id, 'rev_slider_white', true); ?>
			<div id="home-slider" class="<?php echo esc_attr($rev_slider_white); ?>">
				<?php if (function_exists('putRevSlider')) { putRevSlider($rev_slider_alias); } else { _e('Please Install & Activate Revolution Slider', 'bronx'); }?>
			</div>
		<?php  } ?>
		
		<div role="main" class="<?php echo esc_attr($snap_scroll); ?>">
			<?php if(!empty($snap_scroll)) { ?><div class="ai-dotted ai-indicator"><span class="ai-inner1"></span><span class="ai-inner2"></span><span class="ai-inner3"></span></div><?php } ?>