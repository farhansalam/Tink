<?php
function thb_wc_setup() {
	if ( !class_exists( 'WooCommerce' ) ) {
		 function is_account_page() {
		 	return false;
		 }
		 function is_shop() {
		 	return false;
		 }
		 function is_product_category(){
		 	return false;
		 }
		 function is_cart(){
		 	return false;
		 }
		 function is_checkout(){
		 	return false;
		 }
		 function is_woocommerce(){
		 	return false;
		 }
	}
}
add_action( 'plugins_loaded', 'thb_wc_setup' );

/* Account Page & not logged in */
function thb_accountpage_notloggedin() {
	$cond = true;
	if(class_exists('woocommerce')) {
		if (is_account_page()) { 
			if (is_user_logged_in()) {
				$cond = true;
			} else {
				$cond = false;
			}
		} else {
			$cond = true;
		}
	}
	return $cond;
}

/* Reviews Tab */
function thb_reviews_setup() {
	if ( ot_get_option('shop_reviews_tab') == 'off' ) {
		add_filter( 'woocommerce_product_tabs', 'thb_remove_reviews_tab', 98);
		function thb_remove_reviews_tab($tabs) {
			unset($tabs['reviews']);
			return $tabs;
		}
	}
}
add_action( 'after_setup_theme', 'thb_reviews_setup' );

/* Hide Admin bar for users */
function thb_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  	show_admin_bar(false);
	}
}

add_action('after_setup_theme', 'thb_remove_admin_bar');

/* Side Cart */
function thb_side_cart() {
 	echo '<nav id="side-cart"></nav>';
}
add_action( 'thb_side_cart', 'thb_side_cart',3 );

/* Side Cart Update */
function thb_woocomerce_side_cart_update($fragments) {
	ob_start();
	?>
	<nav id="side-cart">
		<div id="cart-container" class="cart-container <?php if (WC()->cart->cart_contents_count < 1) { ?>empty<?php }?>">
		 	<header class="item">
		 		<h6><?php _e('SHOPPING BAG','bronx'); ?></h6>
		 		<a href="#" class="panel-close"></a>
		 	</header>
			<?php if (WC()->cart->cart_contents_count>0) : ?>
				<div class="custom_scroll" id="side-cart-scroll">
					<div>
						<ul>
						<?php foreach (WC()->cart->cart_contents as $cart_item_key => $cart_item) :
						    $_product = $cart_item['data'];
						    if ($_product->exists() && $cart_item['quantity']>0) :?>
								<li class="item cf">
									<figure>
										<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
											if ( ! $_product->is_visible() )
												echo $thumbnail;
											else
												printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
										?>
									</figure>
								
									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">×</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __('Remove this item','bronx') ), $cart_item_key ); ?>
								
									<div class="list_content">
										<?php
										 $product_title = $_product->get_title();
									       echo '<h5><a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a></h5>';
									       echo '<span class="quantity">'.$cart_item['quantity'].'</span><span class="cross">×</span>';
									       echo '<div class="price">'.woocommerce_price($_product->get_price()).'</div>';
									       
									       echo WC()->cart->get_item_data( $cart_item );
										?>
									</div>
								</li>
						<?php endif; endforeach; ?>
						</ul>
						<div class="subtotal item">
						    <?php _e('Subtotal', 'bronx'); ?><?php echo WC()->cart->get_cart_total(); ?>
						</div>
					</div>
				</div>
				
			
				<div class="buttons item">
					<a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="btn grey large full"><?php _e('Continue', 'bronx'); ?></a>
			
					<a href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>" class="btn green large full"><?php _e('Checkout', 'bronx'); ?></a>
				</div>
			</div>
			<?php else: ?>
				<div class="table">
					<div>
						<div class="cart-empty text-center">
							<figure class="item"></figure>
							<p class="message item"><?php _e( 'Your cart is currently empty.', 'bronx') ?></p>
							<?php do_action( 'woocommerce_cart_is_empty' ); ?>
						
							<p class="return-to-shop item"><a class="button black" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Return To Shop', 'bronx' ) ?></a></p>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		<div class="spacer"></div>
	</nav>
	<?php
	$fragments['#side-cart'] = ob_get_clean();
	return $fragments;

}
add_filter('add_to_cart_fragments', 'thb_woocomerce_side_cart_update');

/* Header Cart */
function thb_quick_cart() {
 if(class_exists('woocommerce')) {
 ?>
	<a id="quick_cart" data-target="open-cart" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart','bronx'); ?>">
		<svg version="1.1" id="quick_cart_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="24px" height="20px" viewBox="0 -1 24 18" xml:space="preserve">
		<path d="M17.354,15.165c-0.894,0-1.624,0.734-1.624,1.627c0,0.895,0.73,1.604,1.624,1.604
			c0.893,0,1.604-0.709,1.604-1.604C18.958,15.899,18.25,15.165,17.354,15.165z M11.188,15.165c-0.894,0-1.626,0.734-1.626,1.627
			c0,0.895,0.733,1.604,1.626,1.604c0.893,0,1.626-0.709,1.626-1.604C12.814,15.899,12.081,15.165,11.188,15.165z M7.939,5.214h13.067
			l-1.779,6.79H9.719L7.939,5.214z M7.848,13.339l0.225,0.801h12.78l0.226-0.801l2.358-8.904l0.356-1.359H7.387L6.83,0.938
			L6.605,0.138H1.329c-0.038-0.002-0.073-0.002-0.112,0H1.215l0,0C0.622,0.165,0.163,0.67,0.193,1.264
			C0.227,1.856,0.734,2.31,1.327,2.276h3.63l0.51,1.936"/>
		</svg>
		
		<span class="cart_count" id="cart_count"><?php echo WC()->cart->cart_contents_count; ?></span>
	</a>
<?php }
}
add_action( 'thb_quick_cart', 'thb_quick_cart',3 );

/* Header Wishlist */
function thb_quick_wishlist() {
 ?>
	<?php if(class_exists('YITH_WCWL')) { ?>
		<a href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>" title="<?php _e('Wishlist', 'bronx'); ?>" id="quick_wishlist">
			<svg version="1.1" id="quick_wishlist_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 -1 20 18" xml:space="preserve">
			<path stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M3.297,10.22c-1.568-1.564-2.25-3.278-2.25-4.812
				c0-2.616,1.717-4.361,4.322-4.361c2.427,0,3.257,1.143,4.678,2.797c1.421-1.654,2.25-2.797,4.677-2.797
				c2.606,0,4.323,1.745,4.323,4.361c0,1.534-0.681,3.249-2.25,4.812l-6.75,6.827L3.297,10.22z"/>
			</svg>
			<span class="wishlist_count" id="wishlist_count"><?php echo yith_wcwl_count_products(); ?></span>
		</a>
	<?php } ?>
<?php
}
add_action( 'thb_quick_wishlist', 'thb_quick_wishlist',3 );

/* Product Badges */
function thb_product_badge() {
 global $post, $product;
 	if (thb_out_of_stock()) {
		echo '<span class="badge out-of-stock">' . __( 'Out of Stock', 'bronx' ) . '</span>';
	} else if ( $product->is_on_sale() ) {
		if (ot_get_option('shop_sale_badge', 'text') == 'discount') {
			if ($product->product_type == 'variable') {
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1 ->regular_price;
					$sales_price = $variable_product1 ->sale_price;
					$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);
			} else if ($product->product_type == 'simple'){
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			}
		} else {
			echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'.__( 'Sale','bronx' ).'</span>', $post, $product);
		}
	} else {
		$postdate 		= get_the_time( 'Y-m-d' );			// Post date
		$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
		$newness = ot_get_option('shop_newness', 7);
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
			echo '<span class="badge new">' . __( 'Just Arrived', 'bronx' ) . '</span>';
		}
		
	}
}
add_action( 'thb_product_badge', 'thb_product_badge',3 );

/* WOOCOMMERCE CART LINK */
function thb_woocomerce_ajax_cart_update($fragments) {
	if(class_exists('woocommerce')) {

		ob_start();
		?>
			<span class="cart_count" id="cart_count"><?php echo WC()->cart->cart_contents_count; ?></span>
			
			<script type="text/javascript">// <![CDATA[
			jQuery(function($){
				window.favicon.badge(<?php echo WC()->cart->cart_contents_count; ?>);
			});// ]]>
			</script>
		<?php
		$fragments['#cart_count'] = ob_get_clean();
		return $fragments;
	}
}
add_filter('add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update');


/* Image Dimensions */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'thb_woocommerce_image_dimensions', 1 );

function thb_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '350',	// px
		'height'	=> '435',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '640',	// px
		'height'	=> '800',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '80',	// px
		'height'	=> '90',	// px
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/* Products per Page */
function thb_ppp_setup() {
	if( isset( $_GET['show_products']) ){
		$getproducts = $_GET['show_products'];
		if ($getproducts == "all") {
	    	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ) );
	    } else {
	    	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$getproducts.';' ) );
	    }
	} else {
	    $products_per_page = ot_get_option('shop_product_count', 12);
	    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_per_page . ';' ), 20 );
	}
}
add_action( 'after_setup_theme', 'thb_ppp_setup' );

/* Shop Page - Remove orderby & breadcrumb */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'thb_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

/* Product Page - Move tabs */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );

/* Product Page - Move breadcrumbs */
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_action( 'thb_woocommerce_product_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );

/* Product Page - Remove Sale Flash */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' , 10);

/* Product Page - Remove Related Products */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/* Product Page - Move Upsells */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 70 );

/* Product Page - Move Sharing to top */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 35 );

/* Product Page - Move Rating to top */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 0 );

/* Product Page - Add Sizing Guide */
add_action( 'woocommerce_after_add_to_cart_button', 'thb_social_product', 29 );
add_action( 'woocommerce_after_add_to_cart_button', 'thb_sizing_guide', 30 );

/* Cart Page - Move Cross Sells */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );


/* Sizing Guide */
function thb_sizing_guide() {
	$sizing_guide = get_post_meta(get_the_ID(), 'sizing_guide', true);
	$sizing_guide_content = get_post_meta(get_the_ID(), 'sizing_guide_content', true);
	$sizing_guide_text = get_post_meta(get_the_ID(), 'sizing_guide_text', true);
	
	$text = $sizing_guide_text ? $sizing_guide_text : __("VIEW SIZING GUIDE", 'bronx');
	
	if ($sizing_guide == 'on') {
		echo '<a href="#sizing-popup" rel="inline" class="sizing_guide"><svg version="1.1" id="sizing_guide_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="16.007px" height="16.165px" viewBox="0 0 16.007 16.165" enable-background="new 0 0 16.007 16.165" xml:space="preserve">
		<path fill="#010101" d="M0.65,8.988c0.043,0.01,0.088,0.017,0.135,0.017h0.119l-0.74-0.741v0.118c0,0.047,0.006,0.092,0.016,0.137
			L0.65,8.988z"/>
		<path fill="#010101" d="M7.102,15.322c0,0.045,0.007,0.092,0.016,0.135l0.471,0.471c0.043,0.01,0.088,0.016,0.135,0.016h0.119
			l-0.741-0.742V15.322z"/>
		<path fill="#010101" d="M7.102,14.789l1.153,1.154h0.004c0.07,0,0.136-0.014,0.199-0.035l-1.355-1.355V14.789L7.102,14.789z"/>
		<polygon fill="#010101" points="7.102,13.49 8.881,15.269 8.881,15.031 7.102,13.25 "/>
		<path fill="#010101" d="M7.102,14.068v0.072l1.607,1.609c0.04-0.043,0.072-0.092,0.099-0.141l-1.706-1.707V14.068z"/>
		<path fill="#010101" d="M0.358,7.396l1.607,1.608h0.239L0.499,7.298C0.448,7.326,0.4,7.357,0.358,7.396z"/>
		<polygon fill="#010101" points="2.855,9.005 1.075,7.224 0.836,7.224 2.616,9.005 "/>
		<path fill="#010101" d="M1.555,9.005L0.199,7.649C0.178,7.712,0.164,7.778,0.164,7.847v0.005l1.152,1.152L1.555,9.005L1.555,9.005z"
			/>
		<polygon fill="#010101" points="5.388,7.224 8.881,10.718 8.881,10.48 5.626,7.224 "/>
		<polygon fill="#010101" points="10.628,9.005 7.102,5.479 7.102,5.717 10.389,9.005 "/>
		<polygon fill="#010101" points="6.688,7.224 8.881,9.417 8.881,9.208 6.898,7.224 "/>
		<polygon fill="#010101" points="7.102,7.018 9.089,9.005 9.328,9.005 7.102,6.779 "/>
		<polygon fill="#010101" points="7.102,6.367 9.739,9.005 9.978,9.005 7.102,6.128 "/>
		<polygon fill="#010101" points="6.038,7.224 8.881,10.067 8.881,9.829 6.277,7.224 "/>
		<path fill="#010101" d="M15.654,8.829L14.05,7.224h-0.238l1.702,1.704C15.564,8.899,15.613,8.868,15.654,8.829z"/>
		<path fill="#010101" d="M14.461,7.224l1.349,1.35c0.021-0.062,0.034-0.125,0.034-0.192V8.368l-1.144-1.144H14.461z"/>
		<polygon fill="#010101" points="13.391,7.224 13.162,7.224 14.941,9.005 15.18,9.005 13.4,7.224 "/>
		<path fill="#010101" d="M15.37,7.244c-0.047-0.011-0.098-0.02-0.148-0.02h-0.109l0.732,0.732V7.847c0-0.052-0.009-0.101-0.021-0.149
			L15.37,7.244z"/>
		<path fill="#010101" d="M8.881,1.406L7.737,0.262H7.725c-0.067,0-0.13,0.014-0.192,0.033l1.349,1.349V1.406z"/>
		<path fill="#010101" d="M8.881,2.131V2.056L7.279,0.453c-0.04,0.042-0.072,0.088-0.1,0.139l1.703,1.702V2.131z"/>
		<polygon fill="#010101" points="8.881,2.715 8.881,2.705 7.102,0.926 7.102,1.165 8.881,2.944 "/>
		<path fill="#010101" d="M8.881,0.885c0-0.052-0.008-0.102-0.021-0.15L8.409,0.283C8.36,0.271,8.312,0.262,8.259,0.262h-0.11
			l0.732,0.732V0.885z"/>
		<path fill="#010101" d="M15.222,11.087h-2.454V9.005h-0.189l-1.78-1.781H10.56l1.78,1.781h-0.412l-1.779-1.781H9.91l1.78,1.781
			h-0.412L9.499,7.224H9.259l1.781,1.781h-0.052v2.083H8.84L7.102,9.349v0.239l1.5,1.5H8.19L7.102,9.999v0.239l0.85,0.849H7.54
			L7.102,10.65v0.238l0.2,0.199H5.018V9.004H4.806l-1.78-1.781H2.787l1.78,1.781H4.484v2.617h6.505v0.713H4.484v2.986
			c0,0.047-0.041,0.09-0.089,0.09H3.86c-0.047,0-0.089-0.043-0.089-0.09v-2.986H0.785c-0.048,0-0.088-0.041-0.088-0.088V11.71
			c0-0.047,0.041-0.09,0.088-0.09h2.986V9.005H3.505l-1.78-1.781H1.588H1.486l1.78,1.781H3.239v2.083H0.785
			c-0.342,0-0.622,0.281-0.622,0.623v0.535c0,0.342,0.279,0.621,0.622,0.621h2.454v2.455c0,0.34,0.28,0.621,0.622,0.621h0.535
			c0.343,0,0.622-0.281,0.622-0.621v-2.455h2.112l1.752,1.752V14.38l-1.513-1.514h0.413l1.101,1.102V13.73l-0.863-0.863H8.43
			l0.452,0.451V13.08l-0.213-0.213h2.32v2.455c0,0.34,0.28,0.621,0.622,0.621h0.535c0.342,0,0.623-0.281,0.623-0.621v-2.455h2.453
			c0.341,0,0.622-0.279,0.622-0.621V11.71C15.844,11.369,15.563,11.087,15.222,11.087z M15.31,12.246c0,0.047-0.042,0.088-0.089,0.088
			h-2.453v-0.713h2.454c0.046,0,0.088,0.043,0.088,0.09V12.246L15.31,12.246z"/>
		<polygon fill="#010101" points="2.375,7.224 2.137,7.224 3.917,9.005 4.155,9.005 "/>
		<path fill="#010101" d="M4.484,7.224h0.254l1.78,1.781h0.239l-1.78-1.781h0.042V5.117h2.135L8.88,6.846V6.607l-1.49-1.49h0.412
			L8.88,6.196V5.957l-0.84-0.84h0.411L8.88,5.545V5.307L8.691,5.117h2.298v2.107h0.222l1.779,1.781h0.239l-1.78-1.781h0.412
			l1.779,1.781h0.238l-1.779-1.781h0.411l1.781,1.781h0.237L12.75,7.224h0.019V5.117h2.454c0.341,0,0.622-0.28,0.622-0.623V3.959
			c0-0.342-0.281-0.622-0.622-0.622h-2.454V0.885c0-0.342-0.28-0.623-0.622-0.623h-0.535c-0.342,0-0.622,0.28-0.622,0.623v2.453H8.862
			l-1.76-1.761v0.239l1.522,1.522H8.212l-1.11-1.111v0.239l0.872,0.872H7.562l-0.46-0.46v0.239l0.223,0.222H5.018V0.885
			c0-0.342-0.28-0.623-0.623-0.623H3.86c-0.342,0-0.622,0.28-0.622,0.623v2.453H0.785c-0.342,0-0.622,0.28-0.622,0.622v0.535
			c0,0.343,0.279,0.623,0.622,0.623h2.454v2.107h0.199l1.78,1.781h0.239l-1.78-1.781h0.096V5.117h0.712V7.224L4.484,7.224z
			 M4.484,3.337H3.771V0.885c0-0.048,0.042-0.089,0.089-0.089h0.535c0.047,0,0.088,0.042,0.088,0.089V3.337L4.484,3.337z"/>
		<polygon fill="#010101" points="5.867,9.005 6.106,9.005 4.326,7.224 4.087,7.224 "/></svg> '.$text.'</a>';
		
		?>
		<aside id="sizing-popup" class="mfp-hide theme-popup text-left">
				<?php echo do_shortcode($sizing_guide_content); ?>
		</aside>
		<?php
	}
}

/* Product Page - Catalog Mode */
function thb_catalog_setup() {
	$catalog_mode = ot_get_option('shop_catalog_mode', 'off');
	if ($catalog_mode == 'on') {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}
}
add_action( 'after_setup_theme', 'thb_catalog_setup' );


/* Change breadcrumb delimiter */
add_filter( 'woocommerce_breadcrumb_defaults', 'thb_change_breadcrumb_delimiter' );
function thb_change_breadcrumb_delimiter( $defaults ) { 
    $defaults['delimiter'] = ' <span>/</span> ';
    return $defaults;
}

/* Redirect to Homepage when customer log out */
add_filter('logout_url', 'thb_new_logout_url', 10, 2);
function thb_new_logout_url($logouturl, $redir) {
	$redirect = get_option('siteurl');
	return $logouturl . '&amp;redirect_to=' . urlencode($redirect);
}
?>
