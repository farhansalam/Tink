<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$shop_product_style = isset($_GET['shop_product_style']) ? htmlspecialchars($_GET['shop_product_style']) : ot_get_option('shop_product_style', 'style1');
?>
<div class="single_product_bar">
	<div class="row">
		<div class="medium-10 columns text-left">
			<?php do_action('thb_woocommerce_product_breadcrumb'); ?>
		</div>
		<div class="medium-2 columns text-right hide-for-small">
			<?php echo thb_product_nav(); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="small-12 columns">
<article itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('post product-page '.$shop_product_style); ?>>
	<div class="row"<?php if ($shop_product_style == 'style2') { ?> data-equal=">.columns" data-row-detection="true"<?php } ?>>
			<div class="small-12 <?php echo ($shop_product_style == 'style1' ? 'large-6' : 'large-7'); ?> columns product-gallery carousel-container">
				<?php do_action( 'woocommerce_product_thumbnails' ); ?>  
		    <?php
		        /**
		         * woocommerce_show_product_images hook
		         *
		         * @hooked woocommerce_show_product_sale_flash - 10
		         * @hooked woocommerce_show_product_images - 20
		         * 
		         */
		        do_action( 'woocommerce_before_single_product_summary' );
		    ?>
		    <?php
	          /**
	           * woocommerce_after_single_product_summary hook
	           *
	           * @hooked woocommerce_output_related_products - 20
	           */
	          do_action( 'woocommerce_after_single_product_summary' );
	      ?>
		 	</div>
		  <div class="small-12 <?php echo ($shop_product_style == 'style1' ? 'large-6' : 'large-5 table'); ?> columns product-information">
		  	<?php if ($shop_product_style == 'style2') { ?><div><?php } ?>
				<?php
		  		/**
		  		 * woocommerce_before_single_product hook
		  		 *
		  		 * @hooked woocommerce_show_messages - 10
		  		 */
		  		 do_action( 'woocommerce_before_single_product' );
		  	?>  
		    <?php
	        /**
	        	 * woocommerce_single_product_summary hook
	        	 *
	        	 * @hooked woocommerce_template_single_title - 5
	        	 * @hooked woocommerce_template_single_rating - 10
	        	 * @hooked woocommerce_template_single_price - 10
	        	 * @hooked woocommerce_template_single_excerpt - 20
	        	 * @hooked woocommerce_template_single_add_to_cart - 30
	        	 * @hooked woocommerce_template_single_meta - 40
	        	 * @hooked woocommerce_template_single_sharing - 50
	        	 */
	        do_action( 'woocommerce_single_product_summary' );
		    ?>
		    <?php if ($shop_product_style == 'style2') { ?></div><?php } ?>
		  </div>
	</div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</article><!-- #product-<?php the_ID(); ?> -->
	</div>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?> 