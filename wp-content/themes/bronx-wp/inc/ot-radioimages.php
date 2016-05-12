<?php

function thb_filter_radio_images( $array, $field_id ) {
  
  /* only run the filter where the field ID is my_radio_images */
  if ( $field_id == 'sidebar_position' ) {
    $array = array(
      array(
        'value'   => 'left-sidebar',
        'label'   => __( 'Left Sidebar', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/left-sidebar.png'
      ),
      array(
        'value'   => 'right-sidebar',
        'label'   => __( 'Right Sidebar', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/right-sidebar.png'
      )
    );
  }
  if ( $field_id == 'slider_position' ) {
    $array = array(
      array(
        'value'   => 'slider-left',
        'label'   => __( 'Left Aligned Slider', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/slider-left.png'
      ),
      array(
        'value'   => 'slider-right',
        'label'   => __( 'Right Aligned Slider', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/slider-right.png'
      )
    );
  }
  if ( $field_id == 'footer_columns' ) {
    $array = array(
      array(
        'value'   => 'fourcolumns',
        'label'   => __( 'Four Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/four-columns.png'
      ),
      array(
        'value'   => 'threecolumns',
        'label'   => __( 'Three Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/three-columns.png'
      ),
      array(
        'value'   => 'twocolumns',
        'label'   => __( 'Two Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/two-columns.png'
      ),
      array(
        'value'   => 'doubleleft',
        'label'   => __( 'Double Left Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/doubleleft-columns.png'
      ),
      array(
        'value'   => 'doubleright',
        'label'   => __( 'Double Right Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/doubleright-columns.png'
      ),
      array(
        'value'   => 'fivecolumns',
        'label'   => __( 'Five Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/five-columns.png'
      ),
      array(
        'value'   => 'onecolumns',
        'label'   => __( 'Single Column', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/one-columns.png'
      )
      
    );
  }
  
  if ( $field_id == 'portfolio_columns' ) {
    $array = array(
      array(
        'value'   => 'three',
        'label'   => __( 'Four Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/four-columns.png'
      ),
      array(
        'value'   => 'four',
        'label'   => __( 'Three Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/three-columns.png'
      ),
      array(
        'value'   => 'six',
        'label'   => __( 'Two Columns', 'option-tree' ),
        'src'     => THB_THEME_ROOT . '/assets/img/admin/two-columns.png'
      )
      
    );
  }
  return $array;
  
}
add_filter( 'ot_radio_images', 'thb_filter_radio_images', 10, 2 );

function thb_filter_options_name() {
	return __('<a href="http://fuelthemes.net">Fuel Themes</a>', 'bronx');
}
add_filter( 'ot_header_version_text', 'thb_filter_options_name', 10, 2 );


function thb_filter_upload_name() {
	return __('Send to Theme Options', 'bronx');
}
add_filter( 'ot_upload_text', 'thb_filter_upload_name', 10, 2 );

function thb_header_list() {
	echo '<li class="theme_link"><a href="http://fuelthemes.ticksy.com/" target="_blank">Support Forum</a></li>';
	echo '<li class="theme_link right"><a href="http://shareasale.com/r.cfm?b=699877&u=1144095&m=41388&urllink=&afftrack=" target="_blank">Recommended Hosting</a></li>';
	echo '<li class="theme_link right"><a href="https://wpml.org/?aid=85928&affiliate_key=PIP3XupfKQOZ" target="_blank">Purchase WPML</a></li>';
}
add_filter( 'ot_header_list', 'thb_header_list' );

function thb_filter_typography_fields( $array, $field_id ) {

   if ( $field_id == "title_type" ) {
      $array = array( 'font-family');
   }

   return $array;

}

add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields', 10, 2 );

function thb_filter_typography_fields2( $array, $field_id ) {
	
   $fields = array('menu_left_type', 'menu_right_type');
   if ( in_array($field_id, $fields )) {
      $array = array('font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'text-decoration', 'text-transform', 'line-height', 'letter-spacing');
   }

   return $array;

}

add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields2', 10, 2 );