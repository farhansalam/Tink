<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart<?php if (sizeof($attributes) >1) { echo ' multiple-variations'; } ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
			<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
	<div class="variations">
		<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
				<div class="select-wrapper">
					<select id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo sanitize_title( $name ); ?>" data-attribute_name="attribute_<?php echo sanitize_title( $name ); ?>">
						<option value=""><?php echo wc_attribute_label( $name ); ?></option>
						<?php
							if ( is_array( $options ) ) {

								if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
									$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
								} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
									$selected_value = $selected_attributes[ sanitize_title( $name ) ];
								} else {
									$selected_value = '';
								}

								// Get terms if this is a taxonomy - ordered
								if ( taxonomy_exists( $name ) ) {

									$terms = wc_get_product_terms( $product->id, $name, array( 'fields' => 'all' ) );

									foreach ( $terms as $term ) {
										if ( ! in_array( $term->slug, $options ) ) {
											continue;
										}
										echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
									}

								} else {

									foreach ( $options as $option ) {
										echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
									}

								}
							}
						?>
					</select>
			</div>
  	<?php endforeach;?>
	</div>	
	
	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<div class="single_variation_wrap" style="display: none;"></div>

	<?php
		/**
		 * woocommerce_before_single_variation Hook
		 */
		do_action( 'woocommerce_before_single_variation' );
	?>
		<label class="qtylabel"><?php _e( 'QTY', 'bronx' ); ?></label>
		<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
		<div class="cf"></div>
		<div class="variations_button">
				
				<button type="submit" class="single_add_to_cart_button button green"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
				<?php echo thb_wishlist_button_productpage(); ?>
				<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
				<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
				<input type="hidden" name="variation_id" class="variation_id" value="" />
			</div>
		
	<?php
		/**
		 * woocommerce_after_single_variation Hook
		 */
		do_action( 'woocommerce_after_single_variation' );
	?>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	
	<?php endif; ?>

</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>