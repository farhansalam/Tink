<?php function thb_product( $atts, $content = null ) {
	if (class_exists('woocommerce')) {
    extract(shortcode_atts(array(
       	'product_sort' => 'best-sellers',
       	'item_count' => '4',
       	'columns' => '4',
       	'cat' => '',
       	'product_ids' => ''
    ), $atts));
	global $woocommerce;
			
	$args = array();
	
	if ($product_sort == "latest-products") {
		$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
				'posts_per_page' => $item_count
			);	    
	} else if ($product_sort == "featured-products") {			
		$args = array(
			    'post_type' => 'product',
			    'post_status' => 'publish',
					'ignore_sticky_posts'   => 1,
			    'meta_key' => '_featured',
			    'meta_value' => 'yes',
			    'posts_per_page' => $item_count
			);
	} else if ($product_sort == "top-rated") {
		add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
				
		$args = array(
		    'post_type' => 'product',
		    'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
		    'posts_per_page' => $item_count
		);
		$args['meta_query'] = $woocommerce->query->get_meta_query();
	
	} else if ($product_sort == "sale-products") {
		$args = array(
			  'post_type' => 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
				'posts_per_page' => $item_count,
				'meta_query'     => array(
	        'relation' => 'OR',
	        array( // Simple products type
	            'key'           => '_sale_price',
	            'value'         => 0,
	            'compare'       => '>',
	            'type'          => 'numeric'
	        ),
	        array( // Variable products type
	            'key'           => '_min_variation_sale_price',
	            'value'         => 0,
	            'compare'       => '>',
	            'type'          => 'numeric'
	        )
	    	)
			);
	} else if ($product_sort == "by-category"){
		$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
				'product_cat' => $cat,
				'posts_per_page' => $item_count,
				'no_found_rows' => true,
			);	    
	} else if ($product_sort == "by-id"){
		$product_id_array = explode(',', $product_ids);
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'post__in'		=> $product_id_array,
			'posts_per_page' => 99,
			'no_found_rows' => true,
			'orderby'		=> 'post__in'
		);	    
	} else {
		$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
				'posts_per_page' => $item_count,
				'meta_key' 		=> 'total_sales',
				'orderby' 		=> 'meta_value'
			);	    
	}
	$products = new WP_Query( $args );
 	
 	ob_start();
 	
 	switch($columns) {
 		case '3':
 			$columns = 'small-6 medium-4 large-4';
 			break;
 		case '4':
 			$columns = 'small-6 medium-6 large-3';
 			break;	
 		case '5':
 			$columns = 'small-6 medium-4 large-24';
 			break;
 		case '6':
 			$columns = 'small-6 medium-4 large-2';
 			break;
 	}
 	$catalog_mode = ot_get_option('shop_catalog_mode', 'off');
 	
	if ( $products->have_posts() ) { ?> 
			
		<div class="products shortcode row" data-equal=">.post">
		
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<?php
					$product = wc_get_product( $products->post->ID ); 
					$attachment_ids = $product->get_gallery_attachment_ids(); 
				?>
				<article itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" <?php post_class("post item ".$columns." columns"); ?>>
				
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
					<?php
						$image_html = "";
				
						if ( has_post_thumbnail() ) {
							$image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );					
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
						<h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
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
		
			<?php endwhile; // end of the loop. ?>
		 
		</div>
	   
	<?php }
	     
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_postdata();
   remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
	   
  return $out;
	}
}
add_shortcode('thb_product', 'thb_product');
