<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); 

?>
<?php 
	
	$sidebar_pos = isset($_GET['sidebar']) ? $_GET['sidebar'] : ot_get_option('shop_sidebar', 'no');
	
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
<?php 
	if ($categories && ($product_categories === 'both')) {
	echo '<ul class="shop_subcategories">';
	woocommerce_product_subcategories(); 
	echo '</ul>';
	}
?>
<div class="row">
	<div class="small-12 columns">
<?php
	/**
	 * woocommerce_before_main_content hook
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 */
	do_action('woocommerce_before_main_content');
?>
<?php if($sidebar_pos != 'no') { ?>
	<section class="<?php if($sidebar_pos !== 'no') { echo 'small-12 large-9';} else { echo 'small-12'; } ?> columns <?php if ($sidebar_pos == 'left')  { echo 'large-push-3'; } ?>" id="shop-page">
<?php } else { ?>
	<section id="shop-page">
<?php } ?>
	

		<div class="shop_bar">
		    <div class="row">
		        <div class="small-12 medium-6 columns breadcrumbs">
		            <?php do_action('thb_woocommerce_product_breadcrumb'); ?>
		        </div>
		        <div class="small-12 medium-6 columns ordering">
                <?php if ( have_posts() ) : ?>
                		<?php do_action( 'thb_before_shop_loop_result_count' ); ?>
                    <?php do_action( 'thb_before_shop_loop_catalog_ordering' ); ?>
                <?php endif; ?>
		        </div>
		    </div>
		</div>
		
		<?php do_action( 'woocommerce_before_shop_loop' ); ?>
		
		

		<?php if ( have_posts() ) : ?>
			<?php woocommerce_product_loop_start(); ?>
				<?php
					if (!is_paged() && $categories && ($product_categories === 'only')) {
						woocommerce_product_subcategories(); 
					} 
				?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>
					
				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>


                      
 	</section>
	<?php if($sidebar_pos != 'no') { ?>
	    <?php get_sidebar('shop'); ?>
	<?php } ?>
	</div>
</div><!-- end row -->

<?php get_footer('shop'); ?>