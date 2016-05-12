<?php function thb_grid( $atts, $content = null ) {
	if (class_exists('woocommerce')) {
    extract(shortcode_atts(array(
       	'style' => 'style1',
       	'cat' => ''
    ), $atts));
	
	$args = $product_categories = $category_ids = array();
	$cats = explode(",", $cat);
	
	
	foreach ($cats as $cat) {
		$c = get_term_by('slug',$cat,'product_cat');
		
		if($c) {
			array_push($category_ids, $c->term_id);
		}
	}
	
	$args = array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => '0',
		'include'	=> $category_ids
	);
	
	$product_categories = get_terms( 'product_cat', $args );
 	ob_start();
 	$i = 1;
	?>
	<?php
		if ( $product_categories ) { ?>
				<div class="row masonry category-<?php echo esc_attr($style); ?>">
			<?php foreach ( $product_categories as $category ) {
				if ($style == "style1") {
					switch($i) {
						case 1:
						case 8:
						case 11:
							$imagesize = array("800","720");
							$articlesize = 'small-12 medium-12 large-6';
							break;
						case 2:
						case 3:
						case 4:
						case 5:
						case 6:
						case 7:
						case 9:
						case 10:
						default:
							$imagesize=array("385","342");
							$articlesize = 'small-6 large-3';
							break;
					} 
				} else if($style == "style2") {
					
					switch($i) {
						case 1:
						case 6:
						case 11:
							$imagesize = array("735","745");
							$articlesize = 'small-12 medium-12 large-6';
							break;
						case 2:
						case 7:
						case 12:
							$imagesize=array("735","458");
							$articlesize = 'small-12 medium-12 large-6';
							break;
						case 3:
						case 8:
						case 12:
							$imagesize=array("735","445");
							$articlesize = 'small-12 medium-12 large-6';
							break;
						case 4:
						case 9:
						case 14:
							$imagesize=array("735","597");
							$articlesize = 'small-12 medium-12 large-6';
							break;
						case 5:
						case 10:
						case 15:
							$imagesize=array("735","370");
							$articlesize = 'small-12 medium-12 large-6';
							break;
					}	
				}
				?>
				<div class="<?php echo esc_attr($articlesize); ?> columns">
					<article class="product-category">
						<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
						<span><?php echo esc_attr($category->name); ?></span>
						
						<div class="title">
							<h2><a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" title="<?php echo esc_attr($category->name); ?>"><?php echo esc_attr($category->name); ?></a></h2>
						</div>
						
						<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" title="<?php echo esc_attr($category->name); ?>">
						<figure>
						
							<?php
									$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
		
									if ( $thumbnail_id ) {
									  $image = wp_get_attachment_url( $thumbnail_id );
									  $image = aq_resize( $image, $imagesize[0], $imagesize[1], true, true, true);
									  
									  if ( !$image ) {
									  	echo __('Please upload a larger image for this category', 'bronx');
									  } else {
									  	echo '<img src="' . $image. '" alt="' . esc_attr( $category->name ) . '" width="' . $imagesize[0] . '" height="' .$imagesize[1] . '" />';	
									  }
									  
									} else {
									  echo __('Please upload an image for this category', 'bronx');
									}
								?>
							
						</figure>
						</a>
							<?php
								/**
								 * woocommerce_after_subcategory_title hook
								 */
								do_action( 'woocommerce_after_subcategory_title', $category );
							?>
					
						<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
					</article>
				</div>
				<?php 
				$i++;
			} ?>
			</div>
		<?php }
		woocommerce_reset_loop();  
	?>
	   
	<?php 
	     
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   wp_reset_postdata();
	   
  return $out;
	}
}
add_shortcode('thb_grid', 'thb_grid');
