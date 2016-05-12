<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
$attachment_ids = $product->get_gallery_attachment_ids();
?>
<?php if( $product->has_child() && $product->is_type( 'variable' )) { 
			$available_variations = $product->get_available_variations();
		}
?>
<div id="product-images" class="carousel slick product-images" data-navigation="true" data-autoplay="false" rel="gallery" data-columns="1" data-asnavfor="#product-thumbnails">
            
		<?php if ( $attachment_ids ) {						
				
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					$image_src_link = wp_get_attachment_image_src($attachment_id,'full');
					$src = wp_get_attachment_image_src( $attachment_id, false, '' );
					$src_small = wp_get_attachment_image_src( $attachment_id,  apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
					
					$image_title = esc_attr( get_the_title( $attachment_id ) );
					$attr = '';
					if (isset($available_variations)) {
						foreach($available_variations as $prod_variation) {
						  if ($src_small[0] == $prod_variation['image_src']) {
						  	$attr = implode(',', $prod_variation['attributes']);
						  }
						}
					}
					?>
						<figure itemprop="image" class="easyzoom" data-variation="<?php echo $attr; ?>">
							<a href="<?php echo $src[0]; ?>" itemprop="image" class="fresco" data-fresco-group="product_images" data-fresco-group-options="overflow: true" data-fresco-type="image"><img src="<?php echo $src_small[0]; ?>" title="<?php echo $image_title; ?>" /></a>
						</figure>
					
					<?php
				}
			}
		?>
</div>