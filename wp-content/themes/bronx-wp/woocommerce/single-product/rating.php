<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

$shop_product_style = (isset($_GET['shop_product_style']) ? htmlspecialchars($_GET['shop_product_style']) : ot_get_option('shop_product_style', 'style1'));
?>
<?php if ($shop_product_style == 'style2') { echo thb_wishlist_button(); } ?>
<?php if ( $rating_count > 0 ) : ?>
<div class="woocommerce-product-rating cf" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
	<a class="star-rating" title="<?php printf( __( 'Rated %s out of 5','bronx' ), $average ); ?>" href="#comments">
		<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
			<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'woocommerce' ), '<span itemprop="bestRating">', '</span>' ); ?>
		</span>
	</a>
	
</div>
<?php endif; ?>
<?php if ($rating_count == 0) { ?>
<div class="woocommerce-product-rating cf" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
	<a href="#comments" data-class="review-popup" class="write_first"><?php _e( 'Write the first review','bronx' ); ?></a>
</div>
<?php } ?>