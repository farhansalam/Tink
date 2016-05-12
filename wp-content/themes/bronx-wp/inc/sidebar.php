<?php
function thb_register_sidebars() {
	register_sidebar(array('name' => __('Blog Sidebar','bronx'), 'id' => 'blog', 'description' => __('The sidebar visible in the blog page','bronx'), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
	
	register_sidebar(array('name' => __('Shop Sidebar','bronx'), 'id' => 'shop', 'description' => __('The sidebar visible in the shop page, if its enabled in theme options','bronx'), 'before_widget' => '<div id="%1$s" class="widget cf %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
}
add_action( 'widgets_init', 'thb_register_sidebars' );
function thb_sidebar_setup() {
	$sidebars = ot_get_option('sidebars');
	if(!empty($sidebars)) {
		foreach($sidebars as $sidebar) {
			register_sidebar( array(
				'name' => $sidebar['title'],
				'id' => $sidebar['id'],
				'description' => '',
				'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h6>',
				'after_title' => '</h6>',
			));
		}
	}
}
add_action( 'after_setup_theme', 'thb_sidebar_setup' );
?>