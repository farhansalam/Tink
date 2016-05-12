<?php

// Main Styles
function thb_main_styles() {
		 $url_prefix = is_ssl() ? 'https:' : 'http:';
		 // Register 
		 wp_register_style('thb-foundation', THB_THEME_ROOT . '/assets/css/foundation.min.css', null, null);
	 	 wp_register_style("thb-fa", THB_THEME_ROOT . '/assets/css/font-awesome.min.css', null, null);
		 wp_register_style('thb-app', THB_THEME_ROOT .  "/assets/css/app.css", null, null);
		 
		 // Enqueue
		 wp_enqueue_style('thb-foundation');
		 wp_enqueue_style('thb-fa');
		 wp_enqueue_style('thb-app');
		 wp_enqueue_style('style', get_stylesheet_uri(), null, null);	
		 
		 $thb_custom_css = '
		   .hesperiden.tparrows.tp-leftarrow,
		   .slick-nav.slick-prev {
		     cursor: url("'.THB_THEME_ROOT.'/assets/img/arrow-left.svg"), 
		     				url("'.THB_THEME_ROOT.'/assets/img/arrow-left.cur"), w-resize;
		   }
		   .arrows-light  .hesperiden.tparrows.tp-leftarrow,
		   .arrows-light .slick-nav.slick-prev {
		     cursor: url("'.THB_THEME_ROOT.'/assets/img/arrow-left-light.svg"), 
		     				url("'.THB_THEME_ROOT.'/assets/img/arrow-left-light.cur"), w-resize;
		   }
		   .hesperiden.tparrows.tp-rightarrow,
		   .slick-nav.slick-next {
		     cursor: url("'.THB_THEME_ROOT.'/assets/img/arrow-right.svg"), 
		     				url("'.THB_THEME_ROOT.'/assets/img/arrow-right.cur"), e-resize;
		   }
		   .arrows-light .hesperiden.tparrows.tp-rightarrow,
		   .arrows-light .slick-nav.slick-next {
		     cursor: url("'.THB_THEME_ROOT.'/assets/img/arrow-right-light.svg"), 
		     				url("'.THB_THEME_ROOT.'/assets/img/arrow-right-light.cur"), e-resize;
		   }
		  ';
		 wp_add_inline_style( 'thb-app', $thb_custom_css );
}

add_action('wp_enqueue_scripts', 'thb_main_styles');


// Main Scripts
function thb_register_js() {
	
	if (!is_admin()) {
		$url_prefix = is_ssl() ? 'https:' : 'http:';
		// Register 
		wp_register_script('thb-modernizr', THB_THEME_ROOT . '/assets/js/plugins/modernizr.custom.min.js', 'jquery', null);
		wp_register_script('thb-gmapdep', $url_prefix.'//maps.google.com/maps/api/js?sensor=false', false, null, false);
		wp_register_script('thb-tweenmax', $url_prefix.'//cdnjs.cloudflare.com/ajax/libs/gsap/1.15.0/TweenMax.min.js', 'false', null, TRUE);
		wp_register_script('thb-tweenmax-scrollto', $url_prefix.'//cdnjs.cloudflare.com/ajax/libs/gsap/1.15.0/plugins/ScrollToPlugin.min.js', 'false', null, TRUE);
		wp_register_script('thb-vendor', THB_THEME_ROOT . '/assets/js/vendor.min.js', 'jquery', null, TRUE);
		wp_register_script('thb-app', THB_THEME_ROOT . '/assets/js/app.min.js', 'jquery', null, TRUE);
		
		
		// Enqueue
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
		wp_enqueue_script('thb-tweenmax');
		wp_enqueue_script('thb-tweenmax-scrollto');
		wp_enqueue_script('thb-modernizr');
		wp_enqueue_script('thb-vendor');
		wp_enqueue_script('thb-app');
		wp_localize_script( 'thb-app', 'themeajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
		
		
	}
}
add_action('wp_enqueue_scripts', 'thb_register_js');

// Admin Scripts
function thb_admin_scripts() {
	wp_register_script('thb-admin-meta', THB_THEME_ROOT .'/assets/js/admin-meta.min.js', array('jquery'));
	wp_enqueue_script('thb-admin-meta');
	
	wp_register_style("thb-admin-css", THB_THEME_ROOT . "/assets/css/admin.css");
	wp_enqueue_style('thb-admin-css'); 
	if (class_exists('WPBakeryVisualComposerAbstract')) {
		wp_enqueue_style( 'vc_extra_css', THB_THEME_ROOT . '/assets/css/vc_extra.css' );
	}
}
add_action('admin_enqueue_scripts', 'thb_admin_scripts');

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
/* WooCommerce */
if(class_exists('woocommerce')) {
	function thb_woocommerce_scripts() {
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
	}
	add_action('wp_enqueue_scripts', 'thb_woocommerce_scripts');
}
?>