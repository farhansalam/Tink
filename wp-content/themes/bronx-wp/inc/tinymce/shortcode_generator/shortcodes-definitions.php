<?php

#-----------------------------------------------------------------
# Elements 
#-----------------------------------------------------------------

$thb_shortcodes['header_2'] = array( 
	'type'=>'heading', 
	'title'=>__('Elements')
);
$thb_shortcodes['thb_button'] = array( 
	'type'=>'regular', 
	'title'=>__('Button', 'bronx' ), 
	'attr'=>array(
		'size'=>array(
			'type'=>'radio', 
			'title'=>__('Size', 'bronx'),
			'opt'=>array(
				'small'=>'Small',
				'medium'=>'Medium',
				'large'=>'Large'
			)
		),
		'color'=>array(
			'type'=>'radio', 
			'title'=>__('Color', 'bronx'),
			'opt'=>array(
				'black' =>  'Black',
				'white' =>  'White',
				'green' =>  'Green',
				'yellow' =>  'Yellow',
				'white-transparent' =>  'White Transparent',
				'black-transparent' =>  'Black Transparent'
			)
		),
		'animation'=>array(
			'type'=>'radio', 
			'title'=>__('Animation', 'bronx'),
			'opt'=>array(
				"" => "None",
				"animation right-to-left" => "Left",
				"animation left-to-right" => "Right",
				"animation bottom-to-top" => "Top",
				"animation top-to-bottom" => "Bottom",
				"animation scale" => "Scale",
				"animation fade-in" => "Fade"
			)
		),
		'icon'=>array(
			'type'=>'text', 
			'title'=>__('Icon', 'bronx')
		),
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Buton Text', 'bronx')
		),
		'link'=>array(
			'type'=>'text', 
			'title'=>__('Buton Link', 'bronx')
		),
		'target_blank'=> array(
			'type'=>'checkbox', 
			'title'=>__('Open in New Window?', 'bronx' ),
			'desc'=>'Opens the button link in new window'
		)
	)
);
$thb_shortcodes['quote'] = array( 
	'type'=>'regular', 
	'title'=>__('Quotes', 'bronx'), 
	'attr'=>array( 
		'align'=>array(
			'type'=>'radio', 
			'title'=>__('Alignment', 'bronx'), 
			'opt'=>array(
				'normal'=>'Normal',
				'left'=>'Pull Left',
				'right'=>'Pull Right'
			)
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Content', 'bronx')
		),
		'author'=>array(
			'type'=>'text', 
			'title'=>'Quote Author'
		)
		
	)
);
$thb_shortcodes['tags'] = array( 
	'type'=>'regular', 
	'title'=>__('Highlights', 'bronx' ), 
	'attr'=>array(
		'color'=>array(
			'type'=>'radio', 
			'title'=>__('Color', 'bronx'),
			'opt'=>array(
				'blue'=>'Accent',
				'gray'=>'Gray',
			)
		),
		'text'=>array(
			'type'=>'text', 
			'title'=>__('Text', 'bronx')
		)
	)
);
$thb_shortcodes['dropcap'] = array( 
	'type'=>'regular', 
	'title'=>__('Dropcap', 'bronx' ),
	'attr'=>array( 
		'boxed'=>array(
			'type'=>'radio', 
			'title'=>__('Style', 'bronx'),
			'opt'=>array(
				'style1'=>'Style 1',
				'style2'=>'Style 2'
			)
		),
	)
);

$thb_shortcodes['single_icon'] = array( 
	'type'=>'regular', 
	'title'=>__('Single Icon', 'bronx'), 
	'attr'=>array( 
		'icon'=>array(
			'type'=>'select', 
			'title'=>__('Icon', 'bronx'),
			'values'=> thb_getIconArray()
		),
		'size'=>array(
			'type'=>'radio', 
			'title'=>__('Icon Size', 'bronx'),
			'opt'=>array(
				'icon-1x'=>'1x',
				'icon-2x'=>'2x',
				'icon-3x'=>'3x',
				'icon-4x'=>'4x'
			)
		),
		'boxed'=> array(
			'type'=>'checkbox', 
			'title'=>__('Boxed?', 'bronx'),
			'desc'=>'Boxed contains the icon inside a box'
		),
		'icon_link'=>array(
			'type'=>'text', 
			'title'=>__('Icon Link', 'bronx'),
			'desc'=>'If you would like to link the icon to an url, enter it here. (Boxed option should be checked)'
		)
	)
);
?>