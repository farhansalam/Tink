<?php function thb_iconbox( $atts, $content = null ) {
    extract(shortcode_atts(array(
    		'type'			 => 'top type1',
       	'image'      => '',
       	'color'      => '',
       	'icon'			 => '',
       	'icon_color' => false,
       	'content_color' => false,
       	'heading'		 => '',
       	'heading_color' => false,
       	'animation'	 => false
    ), $atts));
	$btn = '';
	
	// Image & Icon
	if ($image) {
		$img_id = preg_replace('/[^\d]/', '', $image);
		$img = wp_get_attachment_image($img_id, 'full', false, array(
			'alt'   => trim(strip_tags( get_post_meta($img_id, '_wp_attachment_image_alt', true) )),
		));
  } else {
  	$icon = '<i class="fa '.$icon.'"></i>';
  }

	// Content
	
	$out = '<div class="iconbox '.$type.' '.$animation.'">';

	$out .= '<span' . ($image ? ' class="img"' : '') .' ' . ($icon_color ? ' style="color: '.$icon_color.'"' : '') .'>' . ($image ? $img : $icon) .'</span>';

	$out .= '<div class="content">';
		$out .= '<h6' . ($heading_color ? ' style="color: '.$heading_color.'"' : '').'>'.$heading.'</h6>';
		$out .= '<div' . ($content_color ? ' style="color: '.$content_color.'"' : '').'>'.$content.'</div>';
	$out .= '</div>
	</div>';
  return $out;
}
add_shortcode('thb_iconbox', 'thb_iconbox');
