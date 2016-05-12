<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) return;

$info_message = '<div class="checkout-quick-login">'.apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?','bronx' ) ).' <a href="#" class="showlogin">' . __( 'Click here to login','bronx' ) . '</a></div>';
echo $info_message;
?>

<?php
	woocommerce_login_form(
		array(
			'message'  => __( 'If you have shopped with us before, please enter your details in the boxes below.','bronx' ),
			'redirect' => get_permalink( wc_get_page_id( 'checkout' ) ),
			'hidden'   => true
		)
	);
?>