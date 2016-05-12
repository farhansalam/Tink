<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}


// Increase loop count
$woocommerce_loop['loop']++;
$attachment_ids = $product->get_gallery_attachment_ids();
$catalog_mode = ot_get_option('shop_catalog_mode', 'off');
$shop_columns = isset($_GET['shop_columns']) ? htmlspecialchars($_GET['shop_columns']) : ot_get_option('shop_columns', '4');

switch($shop_columns) {
	case '2':
		$columns = 'small-6';
		break;
	case '3':
		$columns = 'small-6 medium-4 large-4';
		break;
	case '4':
		$columns = 'small-6 medium-4 large-3';
		break;	
	case '5':
		$columns = 'small-6 medium-4 large-24';
		break;
	case '6':
		$columns = 'small-6 medium-4 large-2';
		break;
}
?>

<article itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" <?php post_class("post item ".$columns." columns"); ?>>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<?php
		$image_html = "";

		if ( has_post_thumbnail() ) {
			$image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );					
		} else if ( wc_placeholder_img_src() ) {
			$image_html = wc_placeholder_img( 'shop_catalog' );
		}
	?>
	<figure class="product-image">
		<?php do_action( 'thb_product_badge'); ?>
		<?php echo thb_wishlist_button(); ?>
		<?php 
			if ($attachment_ids) {
					
					echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'" class="fade">'.$image_html.'</a>';	

						
					if ( get_post_meta( $attachment_ids[0], '_woocommerce_exclude_image', true ) ) { continue; }
						
					echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'" class="fade">'.wp_get_attachment_image( $attachment_ids[0], 'shop_catalog' ).'</a>';	

								
			} else {
					echo '<a href="'.get_the_permalink().'" title="'. the_title_attribute(array('echo' => 0)).'">'.$image_html.'</a>';	
			}
		?>
		<?php wc_get_template( 'loop/add-to-cart.php' ); ?>
	</figure>
	<header class="post-title<?php if ($catalog_mode == 'on') { echo ' catalog-mode'; } ?>">
		<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
		<?php if ($catalog_mode != 'on') { ?>
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		<?php } ?>
	</header>
	
</article><!-- end product -->