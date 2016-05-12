<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

?>
<?php
	$shop_columns = isset($_GET['shop_columns']) ? $_GET['shop_columns'] : ot_get_option('shop_columns', '4');
	$sidebar_pos = isset($_GET['sidebar']) ? $_GET['sidebar'] : ot_get_option('shop_sidebar', 'no');
?>
<div class="products row">
	<aside class="grid_switcher <?php if($sidebar_pos == 'right') { echo 'left-align'; } ?>">
		<span><?php _e('GRID', 'bronx'); ?></span>
		<a href="<?php echo add_query_arg(array ('shop_columns' => '6')); ?>" class="sgrid <?php if ($shop_columns == '6') { echo 'active'; } ?>">6</a>
		<a href="<?php echo add_query_arg(array ('shop_columns' => '5')); ?>" class="sgrid <?php if ($shop_columns == '5') { echo 'active'; } ?>">5</a>
		<a href="<?php echo add_query_arg(array ('shop_columns' => '4')); ?>" class="sgrid <?php if ($shop_columns == '4') { echo 'active'; } ?>">4</a>
		<a href="<?php echo add_query_arg(array ('shop_columns' => '3')); ?>" class="sgrid <?php if ($shop_columns == '3') { echo 'active'; } ?>">3</a>
	</aside>