<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="page-padding">
<div class="row">
	<div class="small-12 medium-10 medium-centered xlarge-8 columns">
		<div class="your-order-header">
				<div data-equal=".order-details">
					<div class="order-container">
						<?php _e( 'Order','bronx' ); ?> <span><?php echo $order->get_order_number(); ?></span>
					</div>
					<div class="row">
						<div class="small-12 medium-4 columns order-details"><label><?php _e( 'Date','bronx' ); ?></label>
						<?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></div>
						<div class="small-12 medium-4 columns order-details"><label><?php _e( 'Total','bronx' ); ?></label>
						<?php echo $order->get_formatted_order_total(); ?></div>
						<div class="small-12 medium-4 columns order-details"><label><?php _e( 'Payment method','bronx' ); ?></label>
						<?php echo $order->payment_method_title; ?></div>
					</div>
				</div>
		</div>
		<div class="order-status<?php if ( $order->has_status( 'failed' ) ) : ?> failed<?php endif; ?>">
			<h6><?php printf( __( 'Your order is currently <u>%s</u>.', 'woocommerce' ), wc_get_order_status_name( $order->get_status() ) ); ?></h6>
		</div>
		<div class="your-order-container">
				<?php if ( $order->has_status( 'failed' ) ) : ?>
						<p><?php
							if ( is_user_logged_in() )
								_e( 'Please attempt your purchase again or go to your account page.','bronx' );
							else
								_e( 'Please attempt your purchase again.','bronx' );
						?></p>
				
						<p>
							<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay','bronx' ) ?></a>
							<?php if ( is_user_logged_in() ) : ?>
							<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account','bronx' ); ?></a>
							<?php endif; ?>
						</p>
				<?php endif; ?>
				<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
				<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
		</div>
	</div>
</div>
</div>