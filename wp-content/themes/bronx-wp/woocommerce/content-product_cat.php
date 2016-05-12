<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count
$woocommerce_loop['loop'] ++;

$shop_columns = isset($_GET['shop_columns']) ? htmlspecialchars($_GET['shop_columns']) : ot_get_option('shop_columns', 4);

switch($shop_columns) {
	case '2':
		$columns = 'small-6';
		break;
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
$product_categories = false;

$term 				= get_queried_object();
$parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;
$categories 	= get_terms('product_cat', array('hide_empty' => 0, 'parent' => $parent_id));

/* Shop Page */
if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $product_categories = 'only';
if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $product_categories = 'both';

/* Category Page */
if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $product_categories = 'only';
if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $product_categories = 'both';

if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $product_categories = 'only';
if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $product_categories = 'both';

?>
<?php if (!is_paged() && $categories && ($product_categories === 'only')) { ?>
<div class="item <?php echo $columns; ?> columns">
	<article <?php wc_product_cat_class();?>>
		<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
		<span><?php echo $category->name; ?></span>
		
		<div class="title">
			<h2><a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" title="<?php echo esc_attr($category->name); ?>"><?php echo $category->name; ?></a></h2>
		</div>
		
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" title="<?php echo esc_attr($category->name); ?>"><figure><?php do_action( 'woocommerce_before_subcategory_title', $category ); ?></figure></a>
		
			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>
	
		<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
	</article>
</div>
<?php } ?>
<?php if ($categories && ($product_categories === 'both')) { ?>
<li>
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php echo esc_html($category->name); ?>
		</a>
</li>
<?php } ?>