<?php
/* Theme Support */
function thb_theme_setup() {
	add_theme_support( 'custom-background', array( 'default-color' => 'ffffff') );
	add_theme_support( 'title-tag' );
	
	/* Editor Styling */
	add_editor_style();
	
	/* Required Settings */
	if(!isset($content_width)) $content_width = 1170;
	add_theme_support( 'automatic-feed-links' );
	
	/* Image Settings */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 70, 60, true );
	add_image_size('bronx-blog-masonry', 445, 9999, false );
	add_image_size('bronx-blog-grid', 420, 400, true );
	add_image_size('bronx-blog-post', 1000, 480, true );
	add_image_size('bronx-blog-detail', 1160, 600, true );
	
	if (false === get_option("medium_crop")) {
	    add_option("medium_crop", "1");
	} else {
	    update_option("medium_crop", "1");
	}
	  
	/* HTML5 Galleries */
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
	
	/* WooCommerce Support */
	add_theme_support( 'woocommerce' );
	
	/* Multi Currency */
	if ( class_exists('WCML_WC_MultiCurrency')) {
		global $WCML_WC_MultiCurrency;
		remove_action('woocommerce_product_meta_start', array($WCML_WC_MultiCurrency, 'currency_switcher'));
	}
}
add_action( 'after_setup_theme', 'thb_theme_setup' );

/* Set Revolution Slider Setting */
function thb_revsliderSetAsTheme() {
	if(function_exists( 'set_revslider_as_theme' )){ set_revslider_as_theme(); }
}
add_action( 'init', 'thb_revsliderSetAsTheme' );

/* Category Rel Fix */
function remove_category_list_rel( $output ) {
    return str_replace( ' rel="category tag"', '', $output );
}
add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' );

/* Custom GRAvatar */
function thb_gravatar ($avatar_defaults) {
	$myavatar = THB_THEME_ROOT . '/assets/img/avatar.png';
	$avatar_defaults[$myavatar] = 'THB Gravatar';
	return $avatar_defaults;
}
add_filter('avatar_defaults', 'thb_gravatar');


/* Author FB, TW & G+ Links */
function my_new_contactmethods( $contactmethods ) {
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter URL';
	// Add Facebook
	$contactmethods['facebook'] = 'Facebook URL';
	// Add Google+
	$contactmethods['googleplus'] = 'Google Plus URL';
	
	return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

/* Font Awesome Array */
function thb_getIconArray(){
	$icons = array(
			'' => '',
			'fa-adjust' => 'Adjust',
			'fa-adn' => 'Adn',
			'fa-align-center' => 'Align center',
			'fa-align-justify' => 'Align justify',
			'fa-align-left' => 'Align left',
			'fa-align-right' => 'Align right',
			'fa-ambulance' => 'Ambulance',
			'fa-anchor' => 'Anchor',
			'fa-android' => 'Android',
			'fa-angellist' => 'Angellist',
			'fa-angle-double-down' => 'Angle double down',
			'fa-angle-double-left' => 'Angle double left',
			'fa-angle-double-right' => 'Angle double right',
			'fa-angle-double-up' => 'Angle double up',
			'fa-angle-down' => 'Angle down',
			'fa-angle-left' => 'Angle left',
			'fa-angle-right' => 'Angle right',
			'fa-angle-up' => 'Angle up',
			'fa-apple' => 'Apple',
			'fa-archive' => 'Archive',
			'fa-area-chart' => 'Area chart',
			'fa-arrow-circle-down' => 'Arrow circle down',
			'fa-arrow-circle-left' => 'Arrow circle left',
			'fa-arrow-circle-o-down' => 'Arrow circle o down',
			'fa-arrow-circle-o-left' => 'Arrow circle o left',
			'fa-arrow-circle-o-right' => 'Arrow circle o right',
			'fa-arrow-circle-o-up' => 'Arrow circle o up',
			'fa-arrow-circle-right' => 'Arrow circle right',
			'fa-arrow-circle-up' => 'Arrow circle up',
			'fa-arrow-down' => 'Arrow down',
			'fa-arrow-left' => 'Arrow left',
			'fa-arrow-right' => 'Arrow right',
			'fa-arrow-up' => 'Arrow up',
			'fa-arrows' => 'Arrows',
			'fa-arrows-alt' => 'Arrows alt',
			'fa-arrows-h' => 'Arrows h',
			'fa-arrows-v' => 'Arrows v',
			'fa-asterisk' => 'Asterisk',
			'fa-at' => 'At',
			'fa-backward' => 'Backward',
			'fa-ban' => 'Ban',
			'fa-bar-chart' => 'Bar chart',
			'fa-barcode' => 'Barcode',
			'fa-bars' => 'Bars',
			'fa-bed' => 'Bed',
			'fa-beer' => 'Beer',
			'fa-behance' => 'Behance',
			'fa-behance-square' => 'Behance square',
			'fa-bell' => 'Bell',
			'fa-bell-o' => 'Bell o',
			'fa-bell-slash' => 'Bell slash',
			'fa-bell-slash-o' => 'Bell slash o',
			'fa-bicycle' => 'Bicycle',
			'fa-binoculars' => 'Binoculars',
			'fa-birthday-cake' => 'Birthday cake',
			'fa-bitbucket' => 'Bitbucket',
			'fa-bitbucket-square' => 'Bitbucket square',
			'fa-bold' => 'Bold',
			'fa-bolt' => 'Bolt',
			'fa-bomb' => 'Bomb',
			'fa-book' => 'Book',
			'fa-bookmark' => 'Bookmark',
			'fa-bookmark-o' => 'Bookmark o',
			'fa-briefcase' => 'Briefcase',
			'fa-btc' => 'Btc',
			'fa-bug' => 'Bug',
			'fa-building' => 'Building',
			'fa-building-o' => 'Building o',
			'fa-bullhorn' => 'Bullhorn',
			'fa-bullseye' => 'Bullseye',
			'fa-bus' => 'Bus',
			'fa-buysellads' => 'Buysellads',
			'fa-calculator' => 'Calculator',
			'fa-calendar' => 'Calendar',
			'fa-calendar-o' => 'Calendar o',
			'fa-camera' => 'Camera',
			'fa-camera-retro' => 'Camera retro',
			'fa-car' => 'Car',
			'fa-caret-down' => 'Caret down',
			'fa-caret-left' => 'Caret left',
			'fa-caret-right' => 'Caret right',
			'fa-caret-square-o-down' => 'Caret square o down',
			'fa-caret-square-o-left' => 'Caret square o left',
			'fa-caret-square-o-right' => 'Caret square o right',
			'fa-caret-square-o-up' => 'Caret square o up',
			'fa-caret-up' => 'Caret up',
			'fa-cart-arrow-down' => 'Cart arrow down',
			'fa-cart-plus' => 'Cart plus',
			'fa-cc' => 'Cc',
			'fa-cc-amex' => 'Cc amex',
			'fa-cc-discover' => 'Cc discover',
			'fa-cc-mastercard' => 'Cc mastercard',
			'fa-cc-paypal' => 'Cc paypal',
			'fa-cc-stripe' => 'Cc stripe',
			'fa-cc-visa' => 'Cc visa',
			'fa-certificate' => 'Certificate',
			'fa-chain-broken' => 'Chain broken',
			'fa-check' => 'Check',
			'fa-check-circle' => 'Check circle',
			'fa-check-circle-o' => 'Check circle o',
			'fa-check-square' => 'Check square',
			'fa-check-square-o' => 'Check square o',
			'fa-chevron-circle-down' => 'Chevron circle down',
			'fa-chevron-circle-left' => 'Chevron circle left',
			'fa-chevron-circle-right' => 'Chevron circle right',
			'fa-chevron-circle-up' => 'Chevron circle up',
			'fa-chevron-down' => 'Chevron down',
			'fa-chevron-left' => 'Chevron left',
			'fa-chevron-right' => 'Chevron right',
			'fa-chevron-up' => 'Chevron up',
			'fa-child' => 'Child',
			'fa-circle' => 'Circle',
			'fa-circle-o' => 'Circle o',
			'fa-circle-o-notch' => 'Circle o notch',
			'fa-circle-thin' => 'Circle thin',
			'fa-clipboard' => 'Clipboard',
			'fa-clock-o' => 'Clock o',
			'fa-cloud' => 'Cloud',
			'fa-cloud-download' => 'Cloud download',
			'fa-cloud-upload' => 'Cloud upload',
			'fa-code' => 'Code',
			'fa-code-fork' => 'Code fork',
			'fa-codepen' => 'Codepen',
			'fa-coffee' => 'Coffee',
			'fa-cog' => 'Cog',
			'fa-cogs' => 'Cogs',
			'fa-columns' => 'Columns',
			'fa-comment' => 'Comment',
			'fa-comment-o' => 'Comment o',
			'fa-comments' => 'Comments',
			'fa-comments-o' => 'Comments o',
			'fa-compass' => 'Compass',
			'fa-compress' => 'Compress',
			'fa-connectdevelop' => 'Connectdevelop',
			'fa-copyright' => 'Copyright',
			'fa-credit-card' => 'Credit card',
			'fa-crop' => 'Crop',
			'fa-crosshairs' => 'Crosshairs',
			'fa-css3' => 'Css3',
			'fa-cube' => 'Cube',
			'fa-cubes' => 'Cubes',
			'fa-cutlery' => 'Cutlery',
			'fa-dashcube' => 'Dashcube',
			'fa-database' => 'Database',
			'fa-delicious' => 'Delicious',
			'fa-desktop' => 'Desktop',
			'fa-deviantart' => 'Deviantart',
			'fa-diamond' => 'Diamond',
			'fa-digg' => 'Digg',
			'fa-dot-circle-o' => 'Dot circle o',
			'fa-download' => 'Download',
			'fa-dribbble' => 'Dribbble',
			'fa-dropbox' => 'Dropbox',
			'fa-drupal' => 'Drupal',
			'fa-eject' => 'Eject',
			'fa-ellipsis-h' => 'Ellipsis h',
			'fa-ellipsis-v' => 'Ellipsis v',
			'fa-empire' => 'Empire',
			'fa-envelope' => 'Envelope',
			'fa-envelope-o' => 'Envelope o',
			'fa-envelope-square' => 'Envelope square',
			'fa-eraser' => 'Eraser',
			'fa-eur' => 'Eur',
			'fa-exchange' => 'Exchange',
			'fa-exclamation' => 'Exclamation',
			'fa-exclamation-circle' => 'Exclamation circle',
			'fa-exclamation-triangle' => 'Exclamation triangle',
			'fa-expand' => 'Expand',
			'fa-external-link' => 'External link',
			'fa-external-link-square' => 'External link square',
			'fa-eye' => 'Eye',
			'fa-eye-slash' => 'Eye slash',
			'fa-eyedropper' => 'Eyedropper',
			'fa-facebook' => 'Facebook',
			'fa-facebook-official' => 'Facebook official',
			'fa-facebook-square' => 'Facebook square',
			'fa-fast-backward' => 'Fast backward',
			'fa-fast-forward' => 'Fast forward',
			'fa-fax' => 'Fax',
			'fa-female' => 'Female',
			'fa-fighter-jet' => 'Fighter jet',
			'fa-file' => 'File',
			'fa-file-archive-o' => 'File archive o',
			'fa-file-audio-o' => 'File audio o',
			'fa-file-code-o' => 'File code o',
			'fa-file-excel-o' => 'File excel o',
			'fa-file-image-o' => 'File image o',
			'fa-file-o' => 'File o',
			'fa-file-pdf-o' => 'File pdf o',
			'fa-file-powerpoint-o' => 'File powerpoint o',
			'fa-file-text' => 'File text',
			'fa-file-text-o' => 'File text o',
			'fa-file-video-o' => 'File video o',
			'fa-file-word-o' => 'File word o',
			'fa-files-o' => 'Files o',
			'fa-film' => 'Film',
			'fa-filter' => 'Filter',
			'fa-fire' => 'Fire',
			'fa-fire-extinguisher' => 'Fire extinguisher',
			'fa-flag' => 'Flag',
			'fa-flag-checkered' => 'Flag checkered',
			'fa-flag-o' => 'Flag o',
			'fa-flask' => 'Flask',
			'fa-flickr' => 'Flickr',
			'fa-floppy-o' => 'Floppy o',
			'fa-folder' => 'Folder',
			'fa-folder-o' => 'Folder o',
			'fa-folder-open' => 'Folder open',
			'fa-folder-open-o' => 'Folder open o',
			'fa-font' => 'Font',
			'fa-forumbee' => 'Forumbee',
			'fa-forward' => 'Forward',
			'fa-foursquare' => 'Foursquare',
			'fa-frown-o' => 'Frown o',
			'fa-futbol-o' => 'Futbol o',
			'fa-gamepad' => 'Gamepad',
			'fa-gavel' => 'Gavel',
			'fa-gbp' => 'Gbp',
			'fa-gift' => 'Gift',
			'fa-git' => 'Git',
			'fa-git-square' => 'Git square',
			'fa-github' => 'Github',
			'fa-github-alt' => 'Github alt',
			'fa-github-square' => 'Github square',
			'fa-glass' => 'Glass',
			'fa-globe' => 'Globe',
			'fa-google' => 'Google',
			'fa-google-plus' => 'Google plus',
			'fa-google-plus-square' => 'Google plus square',
			'fa-google-wallet' => 'Google wallet',
			'fa-graduation-cap' => 'Graduation cap',
			'fa-gratipay' => 'Gratipay',
			'fa-h-square' => 'H square',
			'fa-hacker-news' => 'Hacker news',
			'fa-hand-o-down' => 'Hand o down',
			'fa-hand-o-left' => 'Hand o left',
			'fa-hand-o-right' => 'Hand o right',
			'fa-hand-o-up' => 'Hand o up',
			'fa-hdd-o' => 'Hdd o',
			'fa-header' => 'Header',
			'fa-headphones' => 'Headphones',
			'fa-heart' => 'Heart',
			'fa-heart-o' => 'Heart o',
			'fa-heartbeat' => 'Heartbeat',
			'fa-history' => 'History',
			'fa-home' => 'Home',
			'fa-hospital-o' => 'Hospital o',
			'fa-html5' => 'Html5',
			'fa-ils' => 'Ils',
			'fa-inbox' => 'Inbox',
			'fa-indent' => 'Indent',
			'fa-info' => 'Info',
			'fa-info-circle' => 'Info circle',
			'fa-inr' => 'Inr',
			'fa-instagram' => 'Instagram',
			'fa-ioxhost' => 'Ioxhost',
			'fa-italic' => 'Italic',
			'fa-joomla' => 'Joomla',
			'fa-jpy' => 'Jpy',
			'fa-jsfiddle' => 'Jsfiddle',
			'fa-key' => 'Key',
			'fa-keyboard-o' => 'Keyboard o',
			'fa-krw' => 'Krw',
			'fa-language' => 'Language',
			'fa-laptop' => 'Laptop',
			'fa-lastfm' => 'Lastfm',
			'fa-lastfm-square' => 'Lastfm square',
			'fa-leaf' => 'Leaf',
			'fa-leanpub' => 'Leanpub',
			'fa-lemon-o' => 'Lemon o',
			'fa-level-down' => 'Level down',
			'fa-level-up' => 'Level up',
			'fa-life-ring' => 'Life ring',
			'fa-lightbulb-o' => 'Lightbulb o',
			'fa-line-chart' => 'Line chart',
			'fa-link' => 'Link',
			'fa-linkedin' => 'Linkedin',
			'fa-linkedin-square' => 'Linkedin square',
			'fa-linux' => 'Linux',
			'fa-list' => 'List',
			'fa-list-alt' => 'List alt',
			'fa-list-ol' => 'List ol',
			'fa-list-ul' => 'List ul',
			'fa-location-arrow' => 'Location arrow',
			'fa-lock' => 'Lock',
			'fa-long-arrow-down' => 'Long arrow down',
			'fa-long-arrow-left' => 'Long arrow left',
			'fa-long-arrow-right' => 'Long arrow right',
			'fa-long-arrow-up' => 'Long arrow up',
			'fa-magic' => 'Magic',
			'fa-magnet' => 'Magnet',
			'fa-male' => 'Male',
			'fa-map-marker' => 'Map marker',
			'fa-mars' => 'Mars',
			'fa-mars-double' => 'Mars double',
			'fa-mars-stroke' => 'Mars stroke',
			'fa-mars-stroke-h' => 'Mars stroke h',
			'fa-mars-stroke-v' => 'Mars stroke v',
			'fa-maxcdn' => 'Maxcdn',
			'fa-meanpath' => 'Meanpath',
			'fa-medium' => 'Medium',
			'fa-medkit' => 'Medkit',
			'fa-meh-o' => 'Meh o',
			'fa-mercury' => 'Mercury',
			'fa-microphone' => 'Microphone',
			'fa-microphone-slash' => 'Microphone slash',
			'fa-minus' => 'Minus',
			'fa-minus-circle' => 'Minus circle',
			'fa-minus-square' => 'Minus square',
			'fa-minus-square-o' => 'Minus square o',
			'fa-mobile' => 'Mobile',
			'fa-money' => 'Money',
			'fa-moon-o' => 'Moon o',
			'fa-motorcycle' => 'Motorcycle',
			'fa-music' => 'Music',
			'fa-neuter' => 'Neuter',
			'fa-newspaper-o' => 'Newspaper o',
			'fa-openid' => 'Openid',
			'fa-outdent' => 'Outdent',
			'fa-pagelines' => 'Pagelines',
			'fa-paint-brush' => 'Paint brush',
			'fa-paper-plane' => 'Paper plane',
			'fa-paper-plane-o' => 'Paper plane o',
			'fa-paperclip' => 'Paperclip',
			'fa-paragraph' => 'Paragraph',
			'fa-pause' => 'Pause',
			'fa-paw' => 'Paw',
			'fa-paypal' => 'Paypal',
			'fa-pencil' => 'Pencil',
			'fa-pencil-square' => 'Pencil square',
			'fa-pencil-square-o' => 'Pencil square o',
			'fa-phone' => 'Phone',
			'fa-phone-square' => 'Phone square',
			'fa-picture-o' => 'Picture o',
			'fa-pie-chart' => 'Pie chart',
			'fa-pied-piper' => 'Pied piper',
			'fa-pied-piper-alt' => 'Pied piper alt',
			'fa-pinterest' => 'Pinterest',
			'fa-pinterest-p' => 'Pinterest p',
			'fa-pinterest-square' => 'Pinterest square',
			'fa-plane' => 'Plane',
			'fa-play' => 'Play',
			'fa-play-circle' => 'Play circle',
			'fa-play-circle-o' => 'Play circle o',
			'fa-plug' => 'Plug',
			'fa-plus' => 'Plus',
			'fa-plus-circle' => 'Plus circle',
			'fa-plus-square' => 'Plus square',
			'fa-plus-square-o' => 'Plus square o',
			'fa-power-off' => 'Power off',
			'fa-print' => 'Print',
			'fa-puzzle-piece' => 'Puzzle piece',
			'fa-qq' => 'Qq',
			'fa-qrcode' => 'Qrcode',
			'fa-question' => 'Question',
			'fa-question-circle' => 'Question circle',
			'fa-quote-left' => 'Quote left',
			'fa-quote-right' => 'Quote right',
			'fa-random' => 'Random',
			'fa-rebel' => 'Rebel',
			'fa-recycle' => 'Recycle',
			'fa-reddit' => 'Reddit',
			'fa-reddit-square' => 'Reddit square',
			'fa-refresh' => 'Refresh',
			'fa-renren' => 'Renren',
			'fa-repeat' => 'Repeat',
			'fa-reply' => 'Reply',
			'fa-reply-all' => 'Reply all',
			'fa-retweet' => 'Retweet',
			'fa-road' => 'Road',
			'fa-rocket' => 'Rocket',
			'fa-rss' => 'Rss',
			'fa-rss-square' => 'Rss square',
			'fa-rub' => 'Rub',
			'fa-scissors' => 'Scissors',
			'fa-search' => 'Search',
			'fa-search-minus' => 'Search minus',
			'fa-search-plus' => 'Search plus',
			'fa-sellsy' => 'Sellsy',
			'fa-server' => 'Server',
			'fa-share' => 'Share',
			'fa-share-alt' => 'Share alt',
			'fa-share-alt-square' => 'Share alt square',
			'fa-share-square' => 'Share square',
			'fa-share-square-o' => 'Share square o',
			'fa-shield' => 'Shield',
			'fa-ship' => 'Ship',
			'fa-shirtsinbulk' => 'Shirtsinbulk',
			'fa-shopping-cart' => 'Shopping cart',
			'fa-sign-in' => 'Sign in',
			'fa-sign-out' => 'Sign out',
			'fa-signal' => 'Signal',
			'fa-simplybuilt' => 'Simplybuilt',
			'fa-sitemap' => 'Sitemap',
			'fa-skyatlas' => 'Skyatlas',
			'fa-skype' => 'Skype',
			'fa-slack' => 'Slack',
			'fa-sliders' => 'Sliders',
			'fa-slideshare' => 'Slideshare',
			'fa-smile-o' => 'Smile o',
			'fa-sort' => 'Sort',
			'fa-sort-alpha-asc' => 'Sort alpha asc',
			'fa-sort-alpha-desc' => 'Sort alpha desc',
			'fa-sort-amount-asc' => 'Sort amount asc',
			'fa-sort-amount-desc' => 'Sort amount desc',
			'fa-sort-asc' => 'Sort asc',
			'fa-sort-desc' => 'Sort desc',
			'fa-sort-numeric-asc' => 'Sort numeric asc',
			'fa-sort-numeric-desc' => 'Sort numeric desc',
			'fa-soundcloud' => 'Soundcloud',
			'fa-space-shuttle' => 'Space shuttle',
			'fa-spinner' => 'Spinner',
			'fa-spoon' => 'Spoon',
			'fa-spotify' => 'Spotify',
			'fa-square' => 'Square',
			'fa-square-o' => 'Square o',
			'fa-stack-exchange' => 'Stack exchange',
			'fa-stack-overflow' => 'Stack overflow',
			'fa-star' => 'Star',
			'fa-star-half' => 'Star half',
			'fa-star-half-o' => 'Star half o',
			'fa-star-o' => 'Star o',
			'fa-steam' => 'Steam',
			'fa-steam-square' => 'Steam square',
			'fa-step-backward' => 'Step backward',
			'fa-step-forward' => 'Step forward',
			'fa-stethoscope' => 'Stethoscope',
			'fa-stop' => 'Stop',
			'fa-street-view' => 'Street view',
			'fa-strikethrough' => 'Strikethrough',
			'fa-stumbleupon' => 'Stumbleupon',
			'fa-stumbleupon-circle' => 'Stumbleupon circle',
			'fa-subscript' => 'Subscript',
			'fa-subway' => 'Subway',
			'fa-suitcase' => 'Suitcase',
			'fa-sun-o' => 'Sun o',
			'fa-superscript' => 'Superscript',
			'fa-table' => 'Table',
			'fa-tablet' => 'Tablet',
			'fa-tachometer' => 'Tachometer',
			'fa-tag' => 'Tag',
			'fa-tags' => 'Tags',
			'fa-tasks' => 'Tasks',
			'fa-taxi' => 'Taxi',
			'fa-tencent-weibo' => 'Tencent weibo',
			'fa-terminal' => 'Terminal',
			'fa-text-height' => 'Text height',
			'fa-text-width' => 'Text width',
			'fa-th' => 'Th',
			'fa-th-large' => 'Th large',
			'fa-th-list' => 'Th list',
			'fa-thumb-tack' => 'Thumb tack',
			'fa-thumbs-down' => 'Thumbs down',
			'fa-thumbs-o-down' => 'Thumbs o down',
			'fa-thumbs-o-up' => 'Thumbs o up',
			'fa-thumbs-up' => 'Thumbs up',
			'fa-ticket' => 'Ticket',
			'fa-times' => 'Times',
			'fa-times-circle' => 'Times circle',
			'fa-times-circle-o' => 'Times circle o',
			'fa-tint' => 'Tint',
			'fa-toggle-off' => 'Toggle off',
			'fa-toggle-on' => 'Toggle on',
			'fa-train' => 'Train',
			'fa-transgender' => 'Transgender',
			'fa-transgender-alt' => 'Transgender alt',
			'fa-trash' => 'Trash',
			'fa-trash-o' => 'Trash o',
			'fa-tree' => 'Tree',
			'fa-trello' => 'Trello',
			'fa-trophy' => 'Trophy',
			'fa-truck' => 'Truck',
			'fa-try' => 'Try',
			'fa-tty' => 'Tty',
			'fa-tumblr' => 'Tumblr',
			'fa-tumblr-square' => 'Tumblr square',
			'fa-twitch' => 'Twitch',
			'fa-twitter' => 'Twitter',
			'fa-twitter-square' => 'Twitter square',
			'fa-umbrella' => 'Umbrella',
			'fa-underline' => 'Underline',
			'fa-undo' => 'Undo',
			'fa-university' => 'University',
			'fa-unlock' => 'Unlock',
			'fa-unlock-alt' => 'Unlock alt',
			'fa-upload' => 'Upload',
			'fa-usd' => 'Usd',
			'fa-user' => 'User',
			'fa-user-md' => 'User md',
			'fa-user-plus' => 'User plus',
			'fa-user-secret' => 'User secret',
			'fa-user-times' => 'User times',
			'fa-users' => 'Users',
			'fa-venus' => 'Venus',
			'fa-venus-double' => 'Venus double',
			'fa-venus-mars' => 'Venus mars',
			'fa-viacoin' => 'Viacoin',
			'fa-video-camera' => 'Video camera',
			'fa-vimeo-square' => 'Vimeo square',
			'fa-vine' => 'Vine',
			'fa-vk' => 'Vk',
			'fa-volume-down' => 'Volume down',
			'fa-volume-off' => 'Volume off',
			'fa-volume-up' => 'Volume up',
			'fa-weibo' => 'Weibo',
			'fa-weixin' => 'Weixin',
			'fa-whatsapp' => 'Whatsapp',
			'fa-wheelchair' => 'Wheelchair',
			'fa-wifi' => 'Wifi',
			'fa-windows' => 'Windows',
			'fa-wordpress' => 'Wordpress',
			'fa-wrench' => 'Wrench',
			'fa-xing' => 'Xing',
			'fa-xing-square' => 'Xing square',
			'fa-yahoo' => 'Yahoo',
			'fa-yelp' => 'Yelp',
			'fa-youtube' => 'Youtube',
			'fa-youtube-play' => 'Youtube play',
			'fa-youtube-square' => 'Youtube square'
		);
  return $icons;
}


/* Thb Header Search */
function thb_quick_search() {
 ?>
	<a href="#searchpopup" rel="inline" data-class="quick-search" id="quick_search">
		<svg version="1.1" id="quick_search_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 -1 20 18" xml:space="preserve">
		<g>
			<g>
				<path d="M18.96,16.896l-4.973-4.926c1.02-1.255,1.633-2.846,1.633-4.578c0-4.035-3.312-7.317-7.385-7.317S0.849,3.358,0.849,7.393
					c0,4.033,3.313,7.316,7.386,7.316c1.66,0,3.188-0.552,4.422-1.471l4.998,4.95c0.181,0.179,0.416,0.268,0.652,0.268
					c0.235,0,0.472-0.089,0.652-0.268C19.32,17.832,19.32,17.253,18.96,16.896z M2.693,7.393c0-3.027,2.485-5.489,5.542-5.489
					c3.054,0,5.541,2.462,5.541,5.489c0,3.026-2.486,5.489-5.541,5.489C5.179,12.882,2.693,10.419,2.693,7.393z"/>
			</g>
		</g>
		</svg>
	</a>
<?php
	function thb_add_searchform() { 
	$search_results = ot_get_option('search_results');
	?>
	   <aside id="searchpopup" class="mfp-hide theme-popup large">
   			<label><?php _e('What are you looking for?', 'bronx'); ?></label>
   			<?php if($search_results =='products' && class_exists( 'WooCommerce' )) { get_product_search_form(); } else { get_search_form(); } ?>
	   </aside>
	<?php
	}
	add_action( 'wp_footer', 'thb_add_searchform', 100 );
}
add_action( 'thb_quick_search', 'thb_quick_search',3 );

/* Thb Newsletter Popup */
function thb_popup() {
	if(!is_admin() && ($popup = ot_get_option('popup') == 'on')) {
		$popup_interval = ot_get_option('popup-interval', 1);
		if (!isset($_COOKIE['bronx-popup'])) {
			$popup_content = ot_get_option('popup_content');
	 		?>
			<aside id="popup" rel="inline-auto" class="mfp-hide theme-popup subscription" data-class="popup">
				<?php if ($popup_content) { echo do_shortcode($popup_content); } ?>
				<form class="newsletter-form" action="#" method="post">   
					<input placeholder="<?php _e("Your E-Mail",'bronx'); ?>" type="text" name="widget_subscribe" class="widget_subscribe">
					<button type="submit" name="submit"><?php _e("&rarr;",'bronx'); ?></button>
				</form>
				<div class="result"></div>
			</aside>
			<?php 
			
		}
	}
}
add_action( 'thb_popup', 'thb_popup',3 );

function thb_popup_cookie() {
	$popup_interval = ot_get_option('popup-interval', 1);
	$time = '';
	switch ($popup_interval) {
		case '0':
			$time = 0;
			break;
		case '1':
			$time = DAY_IN_SECONDS;
			break;
		case '2':
			$time = DAY_IN_SECONDS * 2;
			break;
		case '3':
			$time = DAY_IN_SECONDS * 3;
			break;
		case '7':
			$time = WEEK_IN_SECONDS;
			break;
		case '14':
			$time = WEEK_IN_SECONDS * 2;
			break;
		case '21':
			$time = WEEK_IN_SECONDS * 3;
			break;
		case '30':
			$time = DAY_IN_SECONDS * 30;
			break;
	}
	if ($time && !isset($_COOKIE['bronx-popup'])) {
		setcookie('bronx-popup', '1', time() + $time, COOKIEPATH, COOKIE_DOMAIN, false);
	} else {
		setcookie('bronx-popup', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN );	
	}
}
add_action( 'init', 'thb_popup_cookie');

/* Author */
function thb_author($id) {
	$id = $id ? $id : get_the_author_meta( 'ID' );
	?>
	<?php echo get_avatar( $id , '164'); ?>
	<div class="author-content">
		<h5><a href="<?php echo esc_url(get_author_posts_url( $id )); ?>"><?php the_author_meta('display_name', $id ); ?></a></h5>
		<p><?php the_author_meta('description', $id ); ?></p>
		<?php if(get_the_author_meta('url', $id ) != '') { ?>
			<a href="<?php echo esc_url(get_the_author_meta('url', $id )); ?>"><i class="fa fa-link"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('twitter', $id ) != '') { ?>
			<a href="<?php echo esc_url(get_the_author_meta('twitter', $id )); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('facebook', $id ) != '') { ?>
			<a href="<?php echo esc_url(get_the_author_meta('facebook', $id )); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if(get_the_author_meta('googleplus', $id ) != '') { ?>
			<a href="<?php echo esc_url(get_the_author_meta('googleplus', $id )); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_author', 'thb_author',3 );


/* Social Icons */
function thb_social_header() {
	?>
	<?php if (ot_get_option('fb_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('fb_link_header')); ?>" class="facebook icon-1x" target="_blank"><i class="fa fa-facebook"></i></a>
	<?php } ?>
	<?php if (ot_get_option('pinterest_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('pinterest_link_header')); ?>" class="pinterest icon-1x" target="_blank"><i class="fa fa-pinterest"></i></a>
	<?php } ?>
	<?php if (ot_get_option('twitter_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('twitter_link_header')); ?>" class="twitter icon-1x" target="_blank"><i class="fa fa-twitter"></i></a>
	<?php } ?>
	<?php if (ot_get_option('linkedin_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('linkedin_link_header')); ?>" class="linkedin icon-1x" target="_blank"><i class="fa fa-linkedin"></i></a>
	<?php } ?>
	<?php if (ot_get_option('instragram_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('instragram_link_header')); ?>" class="instagram icon-1x" target="_blank"><i class="fa fa-instagram"></i></a>
	<?php } ?>
	<?php if (ot_get_option('xing_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('xing_link_header')); ?>" class="xing icon-1x" target="_blank"><i class="fa fa-xing"></i></a>
	<?php } ?>
	<?php if (ot_get_option('tumblr_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('tumblr_link_header')); ?>" class="tumblr icon-1x" target="_blank"><i class="fa fa-tumblr"></i></a>
	<?php } ?>
	<?php if (ot_get_option('vk_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('vk_link_header')); ?>" class="vk icon-1x" target="_blank"><i class="fa fa-vk"></i></a>
	<?php } ?>
	<?php if (ot_get_option('googleplus_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('googleplus_link_header')); ?>" class="google-plus icon-1x" target="_blank"><i class="fa fa-google-plus"></i></a>
	<?php } ?>
	<?php if (ot_get_option('soundcloud_link')) { ?>
	<a href="<?php echo esc_url(ot_get_option('soundcloud_link')); ?>" class="soundcloud icon-1x" target="_blank"><i class="fa fa-soundcloud"></i></a>
	<?php } ?>
	<?php if (ot_get_option('dribbble_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('dribbble_link_header')); ?>" class="dribbble icon-1x" target="_blank"><i class="fa fa-dribbble"></i></a>
	<?php } ?>
	<?php if (ot_get_option('youtube_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('youtube_link_header')); ?>" class="youtube icon-1x" target="_blank"><i class="fa fa-youtube"></i></a>
	<?php } ?>
	<?php if (ot_get_option('spotify_link_header')) { ?>
	<a href="<?php echo esc_url(ot_get_option('spotify_link_header')); ?>" class="spotify icon-1x" target="_blank"><i class="fa fa-spotify"></i></a>
	<?php } ?>
	<?php
}
add_action( 'thb_social_header', 'thb_social_header',3 );

function thb_social_product($id = false) {
	$id = $id ? $id : get_the_ID();
	$permalink = get_permalink($id);
	$title = the_title_attribute(array('echo' => 0, 'post' => $id) );
	$image_id = get_post_thumbnail_id($id);
	$image = wp_get_attachment_image_src($image_id,'full');
	$twitter_user = ot_get_option('twitter_bar_username', 'anteksiler');
	$sharing_type = ot_get_option('sharing_buttons') ? ot_get_option('sharing_buttons') : array();
 ?>
 	<?php if (!empty($sharing_type)) { ?>
 	<div class="share-container">
		<aside class="share-article">
			<a href="#" class="product_share"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="16.007px" height="19.996px" viewBox="0 0 16.007 19.996" enable-background="new 0 0 16.007 19.996" xml:space="preserve">
					<path d="M7.644,1.797v11.937h0.918V1.851l3.203,3.151l0.697-0.686L8.076,0L3.689,4.315l0.697,0.686L7.644,1.797z M11.013,7.188
						v0.799l4.19,0.011v11.2h-14.4v-11.2l4.389-0.011V7.188H0v12.808h16.007V7.188H11.013z"/>
			</svg> <?php _e('Share This Product', 'bronx'); ?></a>
			<div class="icons">
				<div class="inner">
			<?php if (in_array('facebook',$sharing_type)) { ?>
			<a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="boxed-icon facebook social"><i class="fa fa-facebook"></i></a>
			<?php } ?>
			<?php if (in_array('twitter',$sharing_type)) { ?>
			<a href="<?php echo 'https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . get_bloginfo( 'name' ) . ''; ?>" class="boxed-icon twitter social "><i class="fa fa-twitter"></i></a>
			<?php } ?>
			<?php if (in_array('google-plus',$sharing_type)) { ?>
			<a href="<?php echo 'http://plus.google.com/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon google-plus social"><i class="fa fa-google-plus"></i></a>
			<?php } ?>
			<?php if (in_array('pinterest',$sharing_type)) { ?>
			<a href="<?php echo 'http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . ''; ?>" class="boxed-icon pinterest social" nopin="nopin" data-pin-no-hover="true"><i class="fa fa-pinterest"></i></a>
			<?php } ?>
				</div>
			</div>
		</aside>
	</div>
	<?php } ?>
<?php
}
add_action( 'thb_social_product', 'thb_social_product', 3, 3 );

/* Payment Icons */
function thb_payment() {
?>
	<?php if (ot_get_option('payment_visa') != 'off') { ?>
		<figure class="paymenttypes visa"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_mc') != 'off') { ?>
		<figure class="paymenttypes mc"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_pp') != 'off') { ?>
		<figure class="paymenttypes paypal"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_discover') != 'off') { ?>
		<figure class="paymenttypes discover"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_amazon') != 'off') { ?>
		<figure class="paymenttypes amazon"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_stripe') != 'off') { ?>
		<figure class="paymenttypes stripe"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_amex') != 'off') { ?>
		<figure class="paymenttypes amex"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_diners') != 'off') { ?>
		<figure class="paymenttypes diners"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_wallet') != 'off') { ?>
		<figure class="paymenttypes wallet"></figure>
	<?php } ?>
<?php
}
add_action( 'thb_payment', 'thb_payment',3 );

/* Mobile Menu */
function thb_mobile_menu() {
	$ls = ot_get_option('subheader_ls') == 'on';
	$cs = (ot_get_option('subheader_cs') == 'on' && !is_account_page()) && shortcode_exists('currency_switcher');
	$col = ( ($ls && !$cs) || (!$ls && $cs)) ? 'small-12' : 'small-6';
	?>
		<nav id="mobile-menu">
			<?php if ($ls || $cs) { ?>
			<div class="row full-width-row no-padding no-row-padding">
				<?php if ($ls) { ?>
				<div class="<?php echo esc_attr($col);?> columns">
					<?php if ($ls) { do_action( 'thb_language_switcher' ); } ?>
				</div>
				<?php } ?>
				<?php if ($cs) { ?>
				<div class="<?php echo esc_attr($col);?> columns">
					<?php if ($cs) { ?>
					<div class="select-wrapper currency_switcher"><?php do_action('currency_switcher'); ?></div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="custom_scroll" id="menu-scroll">
				<div>
					<?php if(has_nav_menu('mobile-menu')) { ?>
					  <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'mobile-menu', 'walker' => new thb_mobileDropdown ) ); ?>
					<?php } else { ?>
						<ul class="mobile-menu">
							<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>"><?php esc_html_e( 'Please assign a menu', 'bronx' ); ?></a></a></li>
						</ul>
					<?php } ?>
					<div class="social-links">
						<?php do_action( 'thb_social_header' ); ?>
					</div>
					<nav class="subheader-menu">
						<?php if (has_nav_menu('acc-menu-in') && is_user_logged_in()) { ?>
						  <?php wp_nav_menu( array( 'theme_location' => 'acc-menu-in', 'depth' => 1, 'container' => false ) ); ?>
						<?php } else if (has_nav_menu('acc-menu-out') && !is_user_logged_in()) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'acc-menu-out', 'depth' => 1, 'container' => false ) ); ?>
						<?php } ?>
					</nav> 
					<div class="menu-footer">
						<?php echo do_shortcode(ot_get_option('menu_footer')); ?>
					</div>
				</div>
			</div>
		</nav>
	<?php
}
add_action( 'thb_mobile_menu', 'thb_mobile_menu',3 );

/* Header Container Check */
function thb_header_container($header_container) {
	$cond = true;
	if(class_exists('woocommerce')) {
		if (is_shop() || is_product_category() || is_account_page() || is_cart() || is_checkout() || $header_container == 'on') {
			$cond = true;
		} else {
			$cond = false;
		}
	} else if ( $header_container == 'on' ) {
		$cond = true;
	} else {
		$cond = false;	
	}
	return $cond;
}

/* Post Categories Array */
function thb_blogCategories(){
	$blog_categories = get_categories();
	$out = array();
	foreach($blog_categories as $category) {
		$out[$category->name] = $category->cat_ID;
	}
	return $out;
}

/* Product Categories Array */
function thb_productCategories(){
	if(class_exists('woocommerce')) {
		
		$args = array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false
		);
		
		$product_categories = get_terms( 'product_cat', $args );
		$out = array();
		if ($product_categories) {
			foreach($product_categories as $product_category) {
				$out[$product_category->name.' ID: '.$product_category->term_id] = $product_category->slug;
			}
		}
		return $out;
	}
	
}
/* Out of Stock Check */
function thb_out_of_stock() {
  global $post;
  $id = $post->ID;
  $status = get_post_meta($id, '_stock_status',true);
  
  if ($status == 'outofstock') {
  	return true;
  } else {
  	return false;
  }
}

/* WishList Button*/
function thb_wishlist_button() {

	global $product; 
	
	if ( class_exists( 'YITH_WCWL_UI' ) )  {
		$url = YITH_WCWL()->get_wishlist_url();
		$product_type = $product->product_type;
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;
		
		if( ! empty( $default_wishlists ) ){
			$default_wishlist = $default_wishlists[0]['ID'];
		}
		else{
			$default_wishlist = false;
		}

		$exists = YITH_WCWL()->is_product_in_wishlist( $product->id, $default_wishlist );
		
		$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';
		
		$html  = '<div class="yith-wcwl-add-to-wishlist add-to-wishlist-'.$product->id.'">'; 
    $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row
    
    $html .= $exists ? ' hide" style="display:none;"' : ' show"';
    
    $html .= '><a href="' . htmlspecialchars(YITH_WCWL()->get_addtowishlist_url()) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><span class="text">'.__( "Wishlist", 'bronx' ).'</span> <svg version="1.1" class="wishlist_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 -1 20 18" xml:space="preserve">
    <path stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M3.297,10.22c-1.568-1.564-2.25-3.278-2.25-4.812
    	c0-2.616,1.717-4.361,4.322-4.361c2.427,0,3.257,1.143,4.678,2.797c1.421-1.654,2.25-2.797,4.677-2.797
    	c2.606,0,4.323,1.745,4.323,4.361c0,1.534-0.681,3.249-2.25,4.812l-6.75,6.827L3.297,10.22z"/>
    </svg></a>';
    $html .= '</div>';
		
		$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url($url) . '" class="add_to_wishlist"><span class="text">'.__( "Wishlist", 'bronx' ).'</span> <svg version="1.1" class="wishlist_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 -1 20 18" xml:space="preserve">
		<path stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M3.297,10.22c-1.568-1.564-2.25-3.278-2.25-4.812
			c0-2.616,1.717-4.361,4.322-4.361c2.427,0,3.257,1.143,4.678,2.797c1.421-1.654,2.25-2.797,4.677-2.797
			c2.606,0,4.323,1.745,4.323,4.361c0,1.534-0.681,3.249-2.25,4.812l-6.75,6.827L3.297,10.22z"/>
		</svg></a></div>';
		$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url($url) . '"><span class="text">'.__( "Wishlist", 'bronx' ).'</span> <svg version="1.1" class="wishlist_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 -1 20 18" xml:space="preserve">
		<path stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M3.297,10.22c-1.568-1.564-2.25-3.278-2.25-4.812
			c0-2.616,1.717-4.361,4.322-4.361c2.427,0,3.257,1.143,4.678,2.797c1.421-1.654,2.25-2.797,4.677-2.797
			c2.606,0,4.323,1.745,4.323,4.361c0,1.534-0.681,3.249-2.25,4.812l-6.75,6.827L3.297,10.22z"/>
		</svg></a></div>';
		$html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';
		
		$html .= '</div>';
		
		return $html;
		
	}

}

/* WishList Button*/
function thb_wishlist_button_productpage() {

	global $product; 
	
	if ( class_exists( 'YITH_WCWL_UI' ) )  {
		$url = YITH_WCWL()->get_wishlist_url();
		$product_type = $product->product_type;
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;
		
		if( ! empty( $default_wishlists ) ){
			$default_wishlist = $default_wishlists[0]['ID'];
		}
		else{
			$default_wishlist = false;
		}

		$exists = YITH_WCWL()->is_product_in_wishlist( $product->id, $default_wishlist );
		
		$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button grey"' : 'class="add_to_wishlist single_add_to_wishlist button grey"';
		
		$html  = '<div class="yith-wcwl-add-to-wishlist add-to-wishlist-'.$product->id.'">'; 
    $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row
    
    $html .= $exists ? ' hide" style="display:none;"' : ' show"';
    
    $html .= '><a href="' . htmlspecialchars(YITH_WCWL()->get_addtowishlist_url()) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><span class="text">'.__( "Add to Wishlist", 'bronx' ).'</span> </a>';
    $html .= '</div>';
		
		$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url($url) . '" class="add_to_wishlist button grey"><span class="text">'.__( "Added on Wishlist", 'bronx' ).'</span></a></div>';
		$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url($url) . '" class="button grey"><span class="text">'.__( "Already on Wishlist", 'bronx' ).'</span></a></div>';
		$html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';
		
		$html .= '</div>';
		
		return $html;
		
	}

}

function thb_product_nav() {
	global $wp_query, $post;

	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	?>
	<nav role="navigation" class="post_nav">      
     <?php previous_post_link( '%link', '<i class="fa fa-caret-left"></i>'. __( 'PREV', 'bronx') ); ?>
     <?php next_post_link( '%link', __( 'NEXT', 'bronx').'<i class="fa fa-caret-right"></i>' ); ?>
	</nav>
	<?php
}

/* Human time */
function thb_human_time_diff_enhanced( $duration = 60 ) {

	$post_time = get_the_time('U');
	$human_time = '';

	$time_now = date('U');

	// use human time if less that $duration days ago (60 days by default)
	// 60 seconds * 60 minutes * 24 hours * $duration days
	if ( $post_time > $time_now - ( 60 * 60 * 24 * $duration ) ) {
		$human_time = sprintf( __( '%s ago', 'bronx'), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
	} else {
		$human_time = get_the_date();
	}

	return $human_time;

}

// Custom filter function to modify default gallery shortcode output
function get_id($inc = false) {
  static $id;
  if ($inc) {
    $id++;
  }
  return $id;
}
add_filter(
  'post_gallery',
  function() {
    get_id(true);
    add_filter('wp_get_attachment_link', function($link) {
      $id = get_id();
      return str_replace('<a href=', '<a class="fresco" data-fresco-group="group-'.$id.'" data-fresco-group-options="thumbnails: false, overflow: true" data-fresco-type="image" href=', $link);
    });
  }
);
// Do Shortcodes inside widgets
add_filter('widget_text', 'do_shortcode');

// thb Tag Cloud Size
function tag_cloud_filter($args = array()) {
   $args['smallest'] = 11;
   $args['largest'] = 11;
   $args['unit'] = 'px';
   $args['format']= 'list';
   return $args;
}

add_filter('widget_tag_cloud_args', 'tag_cloud_filter', 90);
add_filter('widget_product_tag_cloud_args', 'tag_cloud_filter', 90);
/*--------------------------------------------------------------------*/                							
/*  ADD DASHBOARD LINK			                							
/*--------------------------------------------------------------------*/
function admin_menu_new_items() {
    global $submenu;
    $submenu['index.php'][500] = array( 'Fuelthemes.net', 'manage_options' , 'http://fuelthemes.net/?ref=wp_sidebar' ); 
}
add_action( 'admin_menu' , 'admin_menu_new_items' );


/*--------------------------------------------------------------------*/         							
/*  FOOTER TYPE EDIT									 					
/*--------------------------------------------------------------------*/
function thb_footer_admin () {  
  return 'Thank you for choosing <a href="http://fuelthemes.net/?ref=wp_footer" target="blank">Fuel Themes</a>.';  
}
add_filter('admin_footer_text', 'thb_footer_admin'); 
?>