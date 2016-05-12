<?php
/**
 * My Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Addresses', 'bronx' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing Address', 'bronx' ),
		'shipping' => __( 'Shipping Address', 'bronx' )
	), $customer_id );
} else {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', 'bronx' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  __( 'Billing Address', 'bronx' )
	), $customer_id );
}

$col = 1;
?>
<div class="row">
<div class="small-12 small-centered medium-6 large-4 columns text-center">
	<div class="text-center"><h3><?php echo $page_title; ?></h3></div>

	<p>
		<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'bronx' ) ); ?>
	</p>
	<div class="row">
		<?php foreach ( $get_addresses as $name => $title ) : ?>
			<div class="small-12 columns address">
				<div class="smalltitle"><?php echo $title; ?></div>
				<address>
					<?php
						$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
							'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
							'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
							'company'     => get_user_meta( $customer_id, $name . '_company', true ),
							'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
							'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
							'city'        => get_user_meta( $customer_id, $name . '_city', true ),
							'state'       => get_user_meta( $customer_id, $name . '_state', true ),
							'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
							'country'     => get_user_meta( $customer_id, $name . '_country', true )
						), $customer_id, $name );
		
						$formatted_address = WC()->countries->get_formatted_address( $address );
		
						if ( ! $formatted_address )
							_e( 'You have not set up this type of address yet.','bronx' );
						else
							echo $formatted_address;
					?>
				</address>
				<div class="shop-buttons">
					<a href="<?php echo wc_get_endpoint_url( 'edit-address', $name ); ?>" class="edit-address button small"><?php _e( 'Edit', 'woocommerce' ); ?></a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
</div>