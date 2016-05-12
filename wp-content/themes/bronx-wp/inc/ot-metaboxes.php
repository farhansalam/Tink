<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'thb_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */


function thb_custom_meta_boxes() {

  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $post_meta_box_video = array(
    
    'id'          => 'post_meta_video',
    'title'       => 'Video Settings',
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Video URL',
        'id'          => 'post_video',
        'type'        => 'textarea-simple',
        'desc'        => 'Video URL. You can find a list of websites you can embed here: <a href="http://codex.wordpress.org/Embeds">Wordpress Embeds</a>',
        'std'         => '',
        'rows'        => '5'
      ),
      array(
        'label'       => 'Is this a Vimeo video?',
        'id'          => 'post_video_vimeo',
        'desc'        => 'This adjustes the widescreen height so that vimeo vidoes are displayed correctly.',
        'std'         => '',
        'type'        => 'checkbox',
        'choices'     => array( 
          array(
            'value'       => 'vimeo',
            'label'       => 'This is a Vimeo video. '
          )
        )
      )
    )
  );
  
  $post_meta_box_sidebar_gallery = array(
    'id'        => 'meta_box_sidebar_gallery',
    'title'     => 'Gallery',
    'pages'     => array('post'),
    'context'   => 'side',
    'priority'  => 'low',
    'fields'    => array(
      array(
        'id' => 'pp_gallery_slider',
        'type' => 'gallery',
        'desc' => '',
        'post_type' => 'post'
      )
     )
   );
  
	$product_meta_box = array(
	  'id'          => 'product_settings',
	  'title'       => 'Product Page Settings',
	  'pages'       => array( 'product' ),
	  'context'     => 'normal',
	  'priority'    => 'high',
	  'fields'      => array(
		  array(
		    'label'       => 'Enable Sizing Guide',
		    'id'          => 'sizing_guide',
		    'type'        => 'on_off',
		    'desc'        => 'Enabling the sizing guide will add a link to the product page that will open the below content in a lightbox.',
		    'std'         => 'off'
		  ),
		  array(
		  	'label'       => 'Sizing Guide Text',
		  	'id'          => 'sizing_guide_text',
		  	'type'        => 'text',
		  	'desc'        => 'You can override the sizing guide text here',
		  	'rows'        => '1',
		  	'condition'   => 'sizing_guide:is(on)'
		  ),
		  array(
				'label'       => 'Sizing Guide Content',
				'id'          => 'sizing_guide_content',
				'type'        => 'textarea',
				'desc'        => 'You can insert your sizin guide content here. Preferablly an image.',
				'std'         => '',
				'rows'        => '5',
    	  	'condition'   => 'sizing_guide:is(on)'
		  )
		)
	);
  $page_metabox = array(
    'id'          => 'post_metaboxes_combined',
    'title'       => 'Page Settings',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
    	array(
    	  'id'          => 'tab0',
    	  'label'       => 'Header Settings',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => 'Display Page Title?',
    	  'id'          => 'page_title',
    	  'type'        => 'on_off',
    	  'desc'        => 'The page title will display in different sections depending on your header style.',
    	  'std'         => 'off'
    	),
    	array(
    	  'label'       => 'Override Global Header?',
    	  'id'          => 'header_override',
    	  'type'        => 'on_off',
    	  'desc'        => 'You can override global header styles here',
    	  'std'         => 'off'
    	),
    	array(
    	  'label'       => 'Display Sub-Header',
    	  'id'          => 'subheader',
    	  'type'        => 'on_off',
    	  'desc'        => 'Would you like to display the Sub-Header?',
    	  'std'         => 'on',
    	  'condition'   => 'header_override:is(on)'
    	),
    	array(
    	  'label'       => 'Display Header',
    	  'id'          => 'header',
    	  'type'        => 'on_off',
    	  'desc'        => 'Would you like to display the Header?',
    	  'std'         => 'on',
    	  'condition'   => 'header_override:is(on)'
    	),
			array(
			  'label'       => 'Header Items Color',
			  'id'          => 'header_color',
			  'type'        => 'radio',
			  'desc'        => 'Which Header item color would you like to use?',
			  'choices'     => array(
			    array(
			      'label'       => 'Light Items',
			      'value'       => 'header--dark'
			    ),
			    array(
			      'label'       => 'Dark Items',
			      'value'       => 'header--light'
			    )
			  ),
			  'std'         => 'header--light',
			  'condition'   => 'header:is(on),header_override:is(on)'
			),
			array(
			  'label'       => 'Header Transparency',
			  'id'          => 'header_transparent',
			  'type'        => 'on_off',
			  'desc'        => 'Would you like to enable Header Transparency? This will place the header above the content.',
			  'std'         => 'off',
			  'condition'   => 'header:is(on),header_override:is(on)'
			),
			array(
			  'label'       => 'Use header background?',
			  'id'          => 'header_container',
			  'type'        => 'on_off',
			  'desc'        => 'Would you like to display the header background image?',
			  'std'         => 'on',
			  'condition'   => 'header:is(on),header_override:is(on)'
			),
			array(
			  'label'       => 'Header Background',
			  'id'          => 'header_bg',
			  'type'        => 'background',
			  'desc'        => 'Background settings for the header',
			  'condition'   => 'header:is(on),header_override:is(on),header_container:is(on)'
			),
    	array(
    	  'id'          => 'tab1',
    	  'label'       => 'Footer Override',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => 'Override Global Footer?',
    	  'id'          => 'footer_override',
    	  'type'        => 'on_off',
    	  'desc'        => 'You can override global footer settings here',
    	  'std'         => 'off'
    	),
    	array(
    	  'label'       => 'Display Newsletter Subscription Area?',
    	  'id'          => 'footer_newsletter',
    	  'type'        => 'on_off',
    	  'desc'        => 'Would you like to display the Newsletter form? <small>You can download the newsletter list by navigating to <a href="'.THB_THEME_ROOT.'/inc/subscribers.csv">'.THB_THEME_ROOT.'/inc/subscribers.csv</a></small>',
    	  'std'         => 'on',
    	  'condition'   => 'footer_override:is(on)'
    	),
    	array(
    	  'label'       => 'Display Footer',
    	  'id'          => 'footer',
    	  'type'        => 'on_off',
    	  'desc'        => 'Would you like to display the Footer?',
    	  'std'         => 'on',
    	  'condition'   => 'footer_override:is(on)'
    	),
      array(
        'id'          => 'tab4',
        'label'       => 'Revolution Slider',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Revolution Slider Alias',
        'id'          => 'rev_slider_alias',
        'type'        => 'revslider-select',
        'desc'        => 'If you would like to display Revolution Slider on top of this page, please enter the slider alias',
        'std'         => '',
        'rows'        => '1'
      ),
      array(
        'label'       => 'Use Dark or Light Arrows and Bullets?',
        'id'          => 'rev_slider_white',
        'type'        => 'radio',
        'desc'        => 'You can choose to use either dark or light arrows hee',
        'choices'     => array(
          array(
            'label'       => 'Light Arrows',
            'value'       => 'arrows-light'
          ),
          array(
            'label'       => 'Dark Arrows',
            'value'       => 'arrows-dark'
          )
        ),
        'std'         => 'arrows-dark',
        'condition'   => 'rev_slider_alias:not()'
      ),
      array(
        'id'          => 'tab5',
        'label'       => 'Navigation',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Select Page Primary Menu',
        'id'          => 'page_menu',
        'type'        => 'menu_select',
        'desc'        => 'If you select a menu here, it will override the main navigation menu.'
      ),
      array(
        'id'          => 'tab6',
        'label'       => 'Snap To Scroll',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Enable Snap To Scroll Effect?',
        'id'          => 'snap_scroll',
        'desc'        => 'This enables the one page snap to scroll feature. When you scroll, the screen will snap to sections',
        'std'         => 'off',
        'type'        => 'on_off',
        
      )
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
   
   
	ot_register_meta_box( $post_meta_box_video );
	ot_register_meta_box( $post_meta_box_sidebar_gallery);
	ot_register_meta_box( $page_metabox );
  ot_register_meta_box( $product_meta_box );
}