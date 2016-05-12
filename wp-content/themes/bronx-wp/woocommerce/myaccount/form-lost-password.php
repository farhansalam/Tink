<?php
/**
 * Lost password form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div id="customer_login" class="full-height-content table">
	<div>
		<div class="small-12 small-centered medium-6 large-4 xlarge-3 columns text-center">
			<?php wc_print_notices();  ?>
			
			<form method="post" class="row lost_reset_password">
				<div class="small-12 medium-8 small-centered columns">
				<?php	if( 'lost_password' == $args['form'] ) : ?>
					<?php if( 'lost_password' == $args['form'] ) : ?>
						<p><strong><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? ','bronx' ) ); ?></strong></p>
					<?php else : ?>
						<p><strong><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.','bronx') ); ?></strong></p>
					<?php endif; ?>
					
					<input class="input-text full" type="text" name="user_login" id="user_login" placeholder="<?php _e( 'Username or email address', 'woocommerce' ); ?>" />
		
				<?php else : ?>
						<p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce') ); ?></p>
						
						<input type="password" class="input-text full" name="password_1" id="password_1" placeholder="<?php _e( 'New password', 'woocommerce' ); ?>" />

						<input type="password" class="input-text full" name="password_2" id="password_2" placeholder="<?php _e( 'Re-enter new password', 'woocommerce' ); ?>" />
		
					<input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
					<input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />
				<?php endif; ?>
				
					<?php do_action( 'woocommerce_lostpassword_form' ); ?>

					<input type="hidden" name="wc_reset_password" value="true" />
					<input type="submit" class="button" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'woocommerce' ) : __( 'Save', 'woocommerce' ); ?>" />
				<?php wp_nonce_field( $args['form'] ); ?>
				</div>
			</form>
		</div>
	</div>
	<div class="back_home">
		<a href="<?php echo home_url(); ?>"><?php _e( 'Back to','bronx' ); ?> <?php bloginfo('name'); ?></a>
	</div>
</div>