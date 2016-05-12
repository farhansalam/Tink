<form role="search" method="get" class="woocommerce-product-search searchform" role="search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<fieldset>
		<input type="search" class="search-field s" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
		<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" />
		<input type="hidden" name="post_type" value="product" />
	</fieldset>
</form>
