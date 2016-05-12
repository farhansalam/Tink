<?php
/**
 * Additional Information tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information','bronx' ) );
?>
<div class="row">
	<div class="small-12 medium-8 medium-centered large-6 columns">
		<div class="text-center">
			<h2><?php _e( 'Additional Information', 'woocommerce' ); ?></h2>
		</div>
<?php $product->list_attributes(); ?>
	</div>
</div>