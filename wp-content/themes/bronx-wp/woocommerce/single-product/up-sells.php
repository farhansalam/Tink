<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => 4,
	'orderby'             => 'rand',
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

?>


<?php

if ( $products->have_posts() ) : ?>
<div class="related products">

	<div class="text-center"><h2><?php _e('You Might Also Like', 'bronx'); ?></h2></div>

	<div class="row">
	
		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; // end of the loop. ?>

	</div>

</div>
<?php endif;

wp_reset_postdata();
