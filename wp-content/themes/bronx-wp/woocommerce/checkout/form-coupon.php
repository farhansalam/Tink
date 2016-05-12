<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = '<div class="checkout-quick-coupon">'.apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) ).' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a></div>';

echo $info_message;
?>
<div class="row">
	<div class="small-12 medium-centered medium-6 large-6 xlarge-4 columns text-center">
<form class="checkout_coupon" method="post">
	<input type="text" name="coupon_code" class="input-text full" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" value="" />
	<input type="submit" class="button outline apply_coupon yellow small" name="apply_coupon" value="<?php _e( 'Apply', 'woocommerce' ); ?>" />
</form>
	</div>
</div>