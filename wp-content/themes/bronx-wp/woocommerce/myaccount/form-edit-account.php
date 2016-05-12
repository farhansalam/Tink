<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.7
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $current_user;

$user = $current_user;
?>

<?php wc_print_notices(); ?>
<div class="row">
<div class="small-12 small-centered medium-8 large-4 columns">
	<div class="text-center"><h3><?php _e( 'My Account', 'bronx' ); ?></h3></div>
	<form action="" method="post">
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
		<div class="row">
			<div class="small-12 columns">
				<label for="account_first_name"><?php _e( 'First name', 'bronx' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text full" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
			</div>
			<div class="small-12 columns">
				<label for="account_last_name"><?php _e( 'Last name', 'bronx' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text full" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
			</div>
			<div class="small-12 columns">
				<label for="account_email"><?php _e( 'Email address', 'bronx' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text full" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</div>
	
			<div class="small-12 columns">
					<label for="password_current"><?php _e( 'Current Password <small>(leave blank to leave unchanged)</small>', 'bronx' ); ?></label>
					<input type="password" class="input-text full" name="password_current" id="password_current" />
			</div>
			<div class="small-12 columns">
					<label for="password_1"><?php _e( 'New Password <small>(leave blank to leave unchanged)</small>', 'bronx' ); ?></label>
					<input type="password" class="input-text full" name="password_1" id="password_1" />
			</div>
			<div class="small-12 columns">
					<label for="password_2"><?php _e( 'Confirm New Password', 'bronx' ); ?></label>
					<input type="password" class="input-text full" name="password_2" id="password_2" />
			</div>
			<?php do_action( 'woocommerce_edit_account_form' ); ?>
			<div class="small-12 columns text-center">
				<?php wp_nonce_field( 'save_account_details' ); ?>
				<p><input type="submit" class="button black small" name="save_account_details" value="<?php _e( 'Save changes', 'bronx' ); ?>" /></p>
				<input type="hidden" name="action" value="save_account_details" />
				
				
			</div>
		</div>
		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</form>
</div>
</div>