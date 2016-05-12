<?php function thb_add_to_cart( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'id'     				=> '',
       	'title'					=> false,
       	'price' 				=> false,
       	'size' 					=> 'small',
       	'color'					=> 'black-transparent',
       	'align'					=> 'text-center'
    ), $atts));
	
	$out = '';
	global $post;
	if ( ! empty( $id ) ) {
		$product_data = get_post( $id );
	}
	$product = wc_setup_product_data( $product_data );
	
	if ( ! $product ) {
		return '';
	}
	ob_start();

	?>
	<div class="product_add_to_cart_shortcode <?php echo esc_attr($align); ?>">
	<?php if ( $title == 'true' ) { ?>
		<h5><a href="<?php echo esc_url($product->get_permalink()); ?>" title="<?php echo esc_attr($product->get_title()); ?>"><?php echo esc_attr($product->get_title()); ?></a></h5>
	<?php } ?>
	<?php if ( $price == 'true' ) { ?>
		<div class="price"><?php echo $product->get_price_html(); ?></div>
	<?php } ?>
	<?php
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn add_to_cart '.$size.' '.$color.' %s product_type_%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				$product->is_purchasable() ? 'add_to_cart_button' : '',
				esc_attr( $product->product_type ),
				esc_html( $product->add_to_cart_text() )
			),
		$product );
	?>
	</div>
	<?php
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	wc_setup_product_data($post);
  return $out;
}
add_shortcode('thb_add_to_cart', 'thb_add_to_cart');
