<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file.
	You have been warned!

-------------------------------------------------------------------------------------*/

// Define Theme Name for localization
define('THB_THEME_ROOT', get_template_directory_uri());
define('THB_THEME_ROOT_ABS', get_template_directory());

// Translation
add_action('after_setup_theme', 'lang_setup');
function lang_setup(){
	load_theme_textdomain('bronx', THB_THEME_ROOT_ABS . '/inc/languages');
}

// Option-Tree Theme Mode
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_override_forced_textarea_simple', '__return_true' );
add_filter( 'ot_header_logo_link', function() { return '<a href="http://fuelthemes.net" target="_blank">Fuel Themes</a>'; });
require get_template_directory() .'/inc/ot-fonts.php';
require get_template_directory() .'/inc/ot-radioimages.php';
require get_template_directory() .'/inc/ot-metaboxes.php';
require get_template_directory() .'/inc/ot-themeoptions.php';
require get_template_directory() .'/inc/ot-functions.php';

if ( ! class_exists( 'OT_Loader' ) ) {
	require get_template_directory() .'/admin/ot-loader.php';
}

// Script Calls
require get_template_directory() .'/inc/script-calls.php';

// Excerpts
require get_template_directory() .'/inc/excerpts.php';

// Post Formats
add_theme_support('post-formats', array('video', 'image', 'gallery'));

// Masonry Load More
require get_template_directory() .'/inc/masonry-ajax.php';

// TGM Plugin Activation Class
if ( is_admin() ) {
	require get_template_directory() .'/inc/class-tgm-plugin-activation.php';
	require get_template_directory() .'/inc/plugins.php';
}

// Add Menu Support
require get_template_directory() .'/inc/wp3menu.php';

// Enable Sidebars
require get_template_directory() .'/inc/sidebar.php';

// Related Posts
require get_template_directory() .'/inc/related.php';

// Misc 
require get_template_directory() .'/inc/misc.php';

// CSS Output of Theme Options
require get_template_directory() .'/inc/selection.php';

// WPML Support
require get_template_directory() .'/inc/wpml.php';

// Theme Info
require get_template_directory() .'/inc/theme_info.php';

// AQ Resizer
require get_template_directory() .'/inc/aq_resizer.php';

// WooCommerce Settings specific for theme
require get_template_directory() .'/inc/woocommerce.php';
require get_template_directory() .'/inc/woocommerce-category-image.php';
// Visual Composer Integration
require get_template_directory() .'/inc/visualcomposer.php';

// Shortcode Generator & Shortcodes (+)
require get_template_directory() .'/inc/tinymce/tinymce-class.php';	
require get_template_directory() .'/inc/tinymce/shortcode-processing.php';

// WordPress Importer
if ( is_admin() ) {
	if(!class_exists('WP_Import'))
		require_once( trailingslashit(THB_THEME_ROOT_ABS) . 'inc/wordpress-importer/wordpress-importer.php');
		require_once( trailingslashit(THB_THEME_ROOT_ABS) . 'inc/import.php');
}

/* WC Vendors Disable WooCommerce Password Strength Requirement */
function wcvendors_remove_password_strength() {
	  if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		    wp_dequeue_script( 'wc-password-strength-meter' );
	  }
}
add_action( 'wp_print_scripts', 'wcvendors_remove_password_strength', 100 );
?>