<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) 
	return;
?>

<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
	<div class="row">
		<div class="small-12 medium-4 large-3 medium-centered columns">
	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

			<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text full" name="username" id="username" />

			<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input class="input-text full" type="password" name="password" id="password" />
	
			<?php do_action( 'woocommerce_login_form' ); ?>

			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<div class="row">
				<div class="columns">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check"/><label for="rememberme" class="custom_label"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
			<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="lost_password"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
				</div>
			</div>
			<p>
			<input type="submit" class="button outline login_button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
			</p>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
			

	<?php do_action( 'woocommerce_login_form_end' ); ?>
		</div>
	</div>
</form>
	