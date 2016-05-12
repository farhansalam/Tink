<?php function thb_selection() {
	$id =  $id = get_queried_object_id();
	echo thb_google_webfont();
?>
<style>
/* Options set in the admin page */
body { 
	<?php thb_typeecho(ot_get_option('body_type'), false, 'Josefin Sans'); ?>
	color: <?php echo ot_get_option('text_color'); ?>;
}
<?php if(ot_get_option('title_type')) { ?>
h1,h2,h3,h4,h5,h6 {
	<?php thb_typeecho(ot_get_option('title_type')); ?>	
}
<?php } ?>
/* Header */
@media only screen and (min-width: 40.063em) {
	.header {
		<?php thb_paddingecho(ot_get_option('header_spacing')); ?>
	}
}
.header {
	<?php thb_bgecho(ot_get_option('header_bg')); ?>
}
.post-type-archive-product .header-container {
	<?php thb_bgecho(ot_get_option('header_bg_shop')); ?>
}
<?php if ( class_exists( 'WooCommerce' ) ) { ?>
.term-<?php echo esc_attr($id); ?> .header-container {
	background-image: url(<?php echo thb_get_category_header($id); ?>);
}
<?php } ?>
.woocommerce-account .header-container {
	<?php thb_bgecho(ot_get_option('header_bg_myaccount')); ?>
}
.woocommerce-cart .header-container {
	<?php thb_bgecho(ot_get_option('header_bg_cart')); ?>
}
.woocommerce-checkout .header-container {
	<?php thb_bgecho(ot_get_option('header_bg_checkout')); ?>
}

/* Logo Height */
.header_container .header .logo .logoimg,
#customer_login .logo .logoimg {
	max-height: <?php thb_measurementecho(ot_get_option('logo_height'), array('27', 'px')); ?>;
}

/* Accent Color */
<?php if ($accent_color = ot_get_option('accent_color')) { ?>
a:not(.btn):hover, .subheader .subheader-menu ul > li a:hover, .header .menu-holder ul li a.sfHover, .header .menu-holder ul li a.current-menu-item, .header.header--dark .sf-menu > li > a:hover, .header.header--light .sf-menu > li > a:hover, .post .post-meta a[rel="author"], .widget.widget_price_filter .price_slider_amount .button, .slick-nav:hover, .more-link,#side-cart .subtotal span, #comments h2 span, #comments ol.commentlist .comment .reply, #comments ol.commentlist .comment .reply a,.comment-respond .comment-reply-title small,.price.single-price > .amount,.price.single-price ins .amount,.shop_table tbody tr td.order-status.approved,.shop_table tbody tr td.product-quantity .wishlist-in-stock, .checkout-quick-login a, .checkout-quick-coupon a, .payment_methods li .about_paypal, #my-account .my-account-nav li.active a, #my-account .my-account-nav li:hover a, .terms label a, .thb_tabs .tabs dd.active a, .thb_tabs .tabs li.active a, .thb_tour .tabs dd.active a, .thb_tour .tabs li.active a, .toggle .title.wpb_toggle_title_active, .vc_tta-container .vc_tta-tabs.vc_general .vc_tta-tab.vc_active > a, .product .product-information .sizing_guide:hover {
  color: <?php echo esc_attr($accent_color); ?>;
}

#my-account .my-account-nav li.active path, #my-account .my-account-nav li:hover path,
.product .product-information .share-article:hover path, .product .product-information .share-article:hover polygon,
.product .product-information .sizing_guide:hover path, .product .product-information .sizing_guide:hover polygon {
	fill:  <?php echo esc_attr($accent_color); ?>;	
}
.widget.widget_price_filter .price_slider .ui-slider-handle, .slick.dark-pagination .slick-dots li.slick-active button, input[type="text"]:focus, input[type="password"]:focus, input[type="date"]:focus, input[type="datetime"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="time"]:focus, input[type="url"]:focus, textarea:focus, .custom_check + .custom_label:hover:before, [class^="tag-link"]:hover, .product .product-thumbnails figure.slick-center img, .btn.green, .button.green, input[type=submit].green, .notification-box.information, .btn.white:hover, .button.white:hover, input[type=submit].white:hover, .btn.black:hover, .shop_table.wishlist .btn:hover, .button.black:hover, .shop_table.wishlist .button:hover, input[type=submit].black:hover, .shop_table.wishlist input[type=submit]:hover {
  border-color: <?php echo esc_attr($accent_color); ?>;
}

.header .account-holder a > span.cart_count, .widget.widget_price_filter .price_slider .ui-slider-range, .slick.dark-pagination .slick-dots li.slick-active button, .custom_check + .custom_label:after, [class^="tag-link"]:hover, .comment-respond:before, .products .product .product-image .add_to_cart:hover, .btn.green, .button.green, input[type=submit].green, .toggle .title.wpb_toggle_title_active:after, .btn.black:hover, .shop_table.wishlist .btn:hover, .button.black:hover, .shop_table.wishlist .button:hover, input[type=submit].black:hover, .shop_table.wishlist input[type=submit]:hover, .btn.white:hover, .button.white:hover, input[type=submit].white:hover {
	background: <?php echo esc_attr($accent_color); ?>;	
}
.btn.green:hover, .button.green:hover, input[type=submit].green:hover {
	background: <?php echo thb_adjustColorLightenDarken($accent_color, 10); ?>;
	border-color: <?php echo thb_adjustColorLightenDarken($accent_color, 10); ?>;
}
<?php } ?>

/* Menu */
<?php if ($menu_margin = ot_get_option('header_menu_margin')) { ?>
.header .menu-holder ul > li {
	margin-right: <?php echo esc_attr($menu_margin[0].$menu_margin[1]); ?>;
}
<?php } ?>
<?php if ($menu_left = ot_get_option('menu_left_type')) { ?>
.header .menu-holder ul > li > a {
	<?php thb_typeecho($menu_left); ?>	
}
<?php } ?>
<?php if ($submenu_left = ot_get_option('menu_left_submenu_type')) { ?>
.header .menu-holder ul.sub-menu li a {
	<?php thb_typeecho($submenu_left); ?>	
}
<?php } ?>

/* Mobile Menu */
<?php if ($menu_mobile = ot_get_option('menu_mobile_type')) { ?>
.mobile-menu li a {
	<?php thb_typeecho($menu_mobile); ?>	
}
<?php } ?>
<?php if ($submenu_mobile = ot_get_option('menu_mobile_submenu_type')) { ?>
.mobile-menu .sub-menu li a {
	<?php thb_typeecho($submenu_mobile); ?>	
}
<?php } ?>

/* Menu Colors for dark/light backgrounds */
<?php if ($menu_color_light = ot_get_option('menu_color_light')) { ?>

<?php } ?>

<?php if ($menu_color_dark = ot_get_option('menu_color_dark')) { ?>

<?php } ?>

/* Page Specific */
.page-id-<?php echo esc_attr($id); ?> #wrapper,
.postid-<?php echo esc_attr($id); ?> #wrapper {
	<?php thb_bgecho( get_post_meta($id, 'page_bg', true)); ?>
}
/* Page Header */
.page-id-<?php echo esc_attr($id); ?> .header-container {
	<?php thb_bgecho( get_post_meta($id, 'header_bg', true)); ?>
}

/* Newsletter */
<?php if ($popup_bg = ot_get_option('popup_bg')) { ?>
#popup {
	<?php thb_bgecho($popup_bg); ?>
}
<?php } ?>

/* Shop Badges */
<?php if ($badge_sale = ot_get_option('badge_sale')) { ?>
.badge.onsale {
	background: <?php echo $badge_sale;?>;
}
<?php } ?>
<?php if ($badge_outofstock = ot_get_option('badge_outofstock')) { ?>
.badge.out-of-stock {
	background: <?php echo $badge_outofstock;?>;
}
<?php } ?>
<?php if ($badge_justarrived= ot_get_option('badge_justarrived')) { ?>
.badge.new{
	background: <?php echo $badge_justarrived;?>;
}
<?php } ?>

/* Footer */
.thb_subscribe {
	<?php thb_bgecho(ot_get_option('subscribe_bg')); ?>
}
#footer {
	<?php thb_bgecho(ot_get_option('footer_bg')); ?>
}

/* Extra CSS */
<?php 
echo ot_get_option('extra_css');
?>
</style>
<?php } ?>
<?php add_action('wp_head', 'thb_selection'); ?>