var favicon,
		menuscroll;

(function ($, window, _) {
	'use strict';
    
    var lastTime = 0,
        vendors = ['ms', 'moz', 'webkit', 'o'];
	
    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
    }
 
    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
    }
 
    if (!window.cancelAnimationFrame){
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
    }
    
	var $doc = $(document),
			win = $(window),
			Modernizr = window.Modernizr;

	var SITE = SITE || {};
	
	SITE = {
		init: function() {
			var self = this,
					obj;
			
			for (obj in self) {
				if ( self.hasOwnProperty(obj)) {
					var _method =  self[obj];
					if ( _method.selector !== undefined && _method.init !== undefined ) {
						if ( $(_method.selector).length > 0 ) {
							_method.init();
						}
					}
				}
			}
		},
		fixedHeader: {
			selector: '.header.tofixed',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				if ($('body.snap').length < 1) {
					container.clone().addClass('fixed header--dark').removeClass('header--light transparent').prependTo('#wrapper');
					
					var fixedmenu = $('.header.fixed');
					win.scroll(function(){
						base.scroll(fixedmenu);
					});
				}
			},
			scroll: function (container) {
				var animationOffset = container.data('offset'),
						wOffset = win.scrollTop(),
						stick = container.data('stick-class') + ' header--dark',
						unstick = container.data('unstick-class') + ' header--dark';
						
				if (wOffset > animationOffset) {
					if (container.hasClass(unstick)) {
						container.removeClass(unstick);
					}
					if (!container.hasClass(stick)) {
						setTimeout(function () {
							container.addClass(stick);
						}, 10);
					}
				} else if ((wOffset < animationOffset && (wOffset > 0))) {
					if(container.hasClass(stick)) {
						container.removeClass(stick);
						container.addClass(unstick);
					}
				} else {
					container.removeClass(stick);
					container.removeClass(unstick);
				}
			}
			
		},
		responsiveNav: {
			selector: '#wrapper',
			init: function() {
				var base = this,
					container = $(base.selector),
					cc = $('.click-capture'),
					target = $('#quick_cart, .mobile-toggle').data('target'),
					span = $('#mobile-menu').find('.mobile-menu li:has(".sub-menu")>a span');
				
				
				$('#quick_cart, .mobile-toggle').on('click', function() {
					var that = $(this),
							target= that.data('target'),
							t = -1,
							z = -1;

					container.removeClass('open-menu open-cart').addClass(target);
					
					return false;
				});
				cc.on('click', function() {
					container.removeClass('open-menu open-cart');
				});
				
				span.on('click', function(){
					var that = $(this),
							parent = that.parents('a'),
							menu = parent.next('.sub-menu');
					
					if (parent.hasClass('active')) {
						parent.removeClass('active');
						menu.slideUp('200', function() {
							setTimeout(function () {
								window.menuscroll.refresh();
							}, 10);
						});
					} else {
						parent.addClass('active');
						menu.slideDown('200', function() {
							setTimeout(function () {
								window.menuscroll.refresh();
							}, 10);
						});
					}
					
					return false;
				});
				
			}
		},
		updateCart: {
			selector: '#quick_cart',
			init: function() {
				var base = this,
					container = $(base.selector);
				$('body').bind('added_to_cart', SITE.updateCart.update_cart_dropdown);
			},
			update_cart_dropdown: function(event) {
				if ($('body').hasClass('woocommerce-cart')) {
					location.reload();	
				} else {
					$('#quick_cart').trigger('click');	
				}
			}
		},
		navDropdown: {
			selector: '.sf-menu',
			init: function() {
				var base = this,
						container = $(base.selector),
						item = container.find('li.menu-item-has-children');
						
					item.each(function() {
						var that = $(this),
								offset = that.offset(),
								dropdown = that.find('>.sub-menu'),
								children = that.find('li.menu-item-has-children');

						that.hoverIntent(
							function () {
								that.addClass('sfHover');
								dropdown.fadeIn();
								$(this).find('>a').addClass('active');
								
							},
							function () {
								that.removeClass('sfHover');
								dropdown.hide();
								$(this).find('>a').removeClass('active');
							}
						);
						
					});
					
			}
		},
		onePageScroll: {
			selector: '.sf-menu',
			init: function() {
				var base = this,
					container = $(base.selector),
					links = container.find('a'),
					ah = $('#wpadminbar').outerHeight(),
					fh = $('.header.fixed').outerHeight();
					
				links.on('click', function(){
					var _this = $(this),
						url = _this.attr('href'),
						hash = url.indexOf("#") !== -1 ? url.substring(url.indexOf("#")+1) : '',
						pos = hash ? $('#'+hash).offset().top - ah - fh : 0;
						
					if (hash) {
						TweenMax.to(window, win.height() / 500, {scrollTo:{y:pos}, ease:Quart.easeOut});
						return false;
					} else {
						return true;	
					}
					
				});
					
			}
		},
		fullHeightContent: {
			selector: '.full-height-content',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				base.control(container);
				
				win.resize(_.debounce(function(){
					base.control(container);
				}, 50));
				
			},
			control: function(container) {
				var hh = (($('.header:not(.transparent, .fixed)').length || $('.header-container').length) ? $('.header').outerHeight() : 0),
						a = $('#wpadminbar'),
						ah = (a ? a.outerHeight() : 0);
				
				console.log(hh, ah);
				container.each(function() {
					var _this = $(this),
						height = win.height() - hh - ah;
						
					_this.css('min-height',height);
					
				});
			}
		},
		carousel: {
			selector: '.slick',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector);
				
				container.each(function() {
					var that = $(this),
						columns = that.data('columns'),
						navigation = (that.data('navigation') === true ? true : false),
						autoplay = (that.data('autoplay') === false ? false : true),
						pagination = (that.data('pagination') === true ? true : false),
						center = (that.data('center') ? that.data('center') : false),
						disablepadding = (that.data('disablepadding') ? that.data('disablepadding') : false),
						vertical = (that.data('vertical') === true ? true : false),
						asNavFor = that.data('asnavfor');
					
					var args = {
						dots: pagination,
						arrows: navigation,
						infinite: true,
						speed: 1000,
						centerMode: center,
						slidesToShow: columns,
						slidesToScroll: 1,
						autoplay: autoplay,
						centerPadding: (disablepadding ? 0 : '50px'),
						autoplaySpeed: 4000,
						pauseOnHover: true,
						vertical: vertical,
						verticalSwiping: vertical,
						focusOnSelect: true,
						prevArrow: '<button type="button" class="slick-nav slick-prev"></button>',
						nextArrow: '<button type="button" class="slick-nav slick-next"></button>',
						responsive: [
							{
								breakpoint: 1025,
								settings: {
									slidesToShow: (columns < 3 ? columns : (vertical ? columns-1 :3)),
									centerPadding: (disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 780,
								settings: {
									slidesToShow: (columns < 2 ? columns : (vertical ? columns-1 :2)),
									centerPadding: (disablepadding ? 0 : '30px')
								}
							},
							{
								breakpoint: 640,
								settings: {
									slidesToShow: 1,
									centerPadding: (disablepadding ? 0 : '15px')
								}
							}
						]
					};
					if (asNavFor && $(asNavFor).is(':visible')) {
						args.asNavFor = asNavFor;	
					}
					if (that.hasClass('product-images') || that.data('fade')) {
						args.fade = true;
					}
					if (that.hasClass('product-images') && that.parents('.post').hasClass('style2')) {
						that.on('setPosition', function(event, slick, currentSlide, nextSlide){
							$('.product-images').waitForImages(function() {
								that.waitForImages(function() {
									var oh = that.outerHeight(),
											sh = $('.product-thumbnails').outerHeight(),
											diff = (oh - sh) / 2;
									
									$('.product-thumbnails').css({
											marginTop: diff
									});
								});
							});
						});
						that.on('beforeChange', function(event,slick,slide,nextSlide) {
							$('.product-thumbnails').find('.slick-slide').removeClass('slick-current').eq(nextSlide).addClass('slick-current');
						});
					}
					
					that.slick(args);
				});
			}
		},
		infiniteScroll: {
			selector: '#infinitescroll',
			init: function() {
				var base = this,
					container = $(base.selector),
					loading = container.data('loading'),
					nomore = container.data('nomore'),
					count = container.data('count'),
					total = container.data('total'),
					page = 2;
				
				var scrollFunction = _.debounce(function(){
					if (win.scrollTop() >= $doc.height() - win.height() - 60) {
						win.off("scroll", scrollFunction);
						container.addClass('loading');
						$.post( themeajax.url, { 
							action: 'thb_ajax',
							count : count,
							page : page
						}, function(data){
							
							var d = $.parseHTML(data),
									l = ($(d).length - 1) / 2;
							
							container.removeClass('loading');
							win.on('scroll', scrollFunction);
									
							if (page > total) {
								win.off('scroll', scrollFunction);
								return false;
							} else {
								page++;
								$(d).appendTo(container).hide().imagesLoaded(function() {
									$(d).show();
									container.isotope( 'appended', $(d) );
									container.isotope('layout');
								});
							}
							
						});
					}
				}, 30);
				
				win.scroll(scrollFunction);
	
			}
		},
		masonry: {
			selector: '.masonry',
			init: function() {
				var base = this,
				container = $(base.selector);
								
				container.each(function() {
					var that = $(this);
					
					win.load(function() {
						that.isotope({
							layoutMode: 'packery',
							itemSelector : '.columns',
							transitionDuration : '0.5s',
							masonry: {
								columnWidth: '.item'
							}
						});
					});
				});
			}
		},
		magnificInline: {
			selector: '[rel="inline"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var eclass = ($(this).data('class') ? $(this).data('class') : ''),
							cls_btn = $(this).attr('id') === 'quick_search' ? false : true;
					
					$(this).magnificPopup({
						type:'inline',
						midClick: true,
						mainClass: 'mfp ' + eclass,
						removalDelay: 250,
						closeBtnInside: cls_btn,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close"></button>'
					});
				});
	
			}
		},
		magnificAuto: {
			selector: '[rel="inline-auto"]',
			init: function() {
				var base = this,
					container = $(base.selector);
					
				container.each(function() {
					var _this = $(this),
							eclass = (_this.data('class') ? _this.data('class') : ''),
							target = '#'+ _this.attr('id');
					$.magnificPopup.open({
						type:'inline',
						items: {
							src: target,
							type: 'inline'
						},
						midClick: true,
						mainClass: 'mfp ' + eclass,
						removalDelay: 250,
						closeBtnInside: true,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close"></button>'
					});
				});
			}
		},
		parallax_bg: {
			selector: 'div[role="main"]',
			init: function() {
				var base = this,
					container = $(base.selector);
				if(!Modernizr.touch){ 
					$.stellar({
						horizontalScrolling: false,
						verticalOffset: 40
					});
				}
			}
		},
		shareArticleDetail: {
			selector: '.share-article',
			init: function() {
				var base = this,
						container = $(base.selector),
						link = container.find('.product_share'),
						icons = container.find('.icons'),
						social = container.find('.social'),
						tl = new TimelineMax({paused:true, onStart: function() { icons.css('display', 'block'); }, onReverseComplete: function() {icons.css('display', 'none'); } });
						
				link.on('click', function() {return false;});
				social.on('click', function() {
					var left = (screen.width/2)-(640/2),
							top = (screen.height/2)-(440/2)-100;
					window.open($(this).attr('href'), 'mywin', 'left='+left+',top='+top+',width=640,height=440,toolbar=0');
					return false;
				});
				
				tl
					.add(TweenMax.fromTo(icons, 0.25, {y: '6', autoAlpha: 0}, {y: '-2', autoAlpha: 1}));
					
				container.hoverIntent(function() {
					tl.timeScale(1).play();
				}, function() {
					tl.timeScale(0.5).reverse();
				});
			}
		},
		custom_scroll: {
			selector: '.custom_scroll',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.each(function() {
					var _this = $(this);
					
					var newScroll = new IScroll('#'+_this.attr('id'), {
						scrollbars: true,
						mouseWheel: true,
						click: true,
						interactiveScrollbars: true,
						shrinkScrollbars: 'scale',
						fadeScrollbars: true
					});
					if (_this.attr('id') === 'menu-scroll') {
						menuscroll = newScroll;	
					}
					
					_this.on('touchmove', function (e) { e.preventDefault(); });
				});		 
				
			}
		},
		wpml: {
			selector: '#thb_language_selector',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.on('change', function () {
				var url = $(this).val(); // get selected value
					if (url) { // require a URL
						window.location = url; // redirect
					}
					return false;
				});
			}
		},
		shop: {
			selector: '.products .product',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var that = $(this);
					
					that
					.find('.add_to_cart_button').on('click', function() {
						if ($(this).data('added-text') !== '') {
							$(this).text($(this).data('added-text'));
						}
					});
					
				}); // each
	
			}
		},
		variations: {
			selector: '.variations_form input[name=variation_id]',
			init: function() {
				var base = this,
					container = $(base.selector),
					org = $('.single-price.single_variation').html();
				
				container.on('change', function() {
					var that = $(this),
						val = that.val(),
						phtml,
						images = $('#product-images');

					setTimeout(function(){
						if (val) {
							phtml = that.parents('.variations_form').find('.single_variation span.price').html();
						} else {
							phtml = org;	
						}
						$('.price.single_variation').html(phtml);
					}, 100);
					
					if ($('.variations_form').length) {
						var variations = [],
								values;
						
						$('.variations_form').find('select').each(function(){
							variations.push(this.value);
						});
						values = variations.join(",");
						if ($('select[name=attribute_pa_color]').length) {
							var v = ($('.variations_form select option:selected').val()),
									i = images.find('figure[data-variation="'+values+'"]').data('slick-index');
								
							if (v) {
								images.slick('slickGoTo', i);
							}
						}
					}
				});
			}
		},
		reviews: {
			selector: '#respond',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.on( 'click', 'p.stars a', function(){
					var that = $(this);
					
					setTimeout(function(){ that.prevAll().addClass('active'); }, 10);
				});
			}
		},
		myaccount: {
			selector: '#my-account-nav',
			init: function() {
				var base = this,
					container = $(base.selector),
					links = container.find('a'),
					li = container.find('li'),
					tabs = $('.tab-pane');
				
				links.on('click', function() {
					var that = $(this),
						target = $(that.attr('href'));
					
					li.removeClass('active');
					that.parent('li').addClass('active');
					tabs.removeClass('active').hide(0, function() {
						target.addClass('active').show();
					});
					return false;
				});
			}
		},
		login_register: {
			selector: '#customer_login',
			init: function() {
				
				var create = $('#create-account'),
						login = $('#login-account');
				
				
				create.on('click', function() {
						TweenMax.fromTo($('.login-container'), 0.2, {opacity:1, display:'block', y: 0}, {opacity:0,display:'none', y: 50, onComplete: function() { 
								TweenMax.fromTo($('.register-container'), 0.2, {opacity:0, display:'none', y:50}, {opacity:1,display:'block', y: 0});
							}
						});
						return false;
				});
				
				login.on('click', function() {
						TweenMax.fromTo($('.register-container'), 0.2, {opacity:1, display:'block', y: 0}, {opacity:0,display:'none', y: 50,
							onComplete: function() { 
								TweenMax.fromTo($('.login-container'), 0.2, {opacity:0, display:'none', y: 50}, {opacity:1,display:'block', y: 0});
							}	
						});
						
						
						return false;
				});
			}
		},
		products: {
			selector: '.product-category',
			init: function() {
				
				var cats = $('.product-category');
						
				
				cats.each(function() {
					var _this = $(this),
							span = _this.find('span'),
							figure = _this.find('figure'),
							h2 = _this.find('h2'),
							tl = new TimelineMax({paused:true});
						
						tl
							.add(TweenLite.to(span, 0.25, {left: '-100%'}))
							.add(TweenMax.to(figure, 0.20, { opacity:0.2 }), "-=0.1")
							.add(TweenLite.fromTo(h2 ,0.15, { opacity:0, scale:0.97}, { opacity:1, scale:1}), "-=0.1");
							
						_this.hoverIntent(function() {
							tl.timeScale(0.5).play();
						}, function() {
							tl.timeScale(0.5).reverse();
						});
				});
			}
		},
		parsley: {
			selector: '.comment-form, .wpcf7-form',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				if ($.fn.parsley) {
					container.parsley();
				}
			}
		},
		quantity: {
			selector: '.quantity',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				// Quantity buttons
				$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
			
				$doc.on( 'click', '.plus, .minus', function() {
			
					// Get values
					var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
						currentVal	= parseFloat( $qty.val() ),
						max			= parseFloat( $qty.attr( 'max' ) ),
						min			= parseFloat( $qty.attr( 'min' ) ),
						step		= $qty.attr( 'step' );
			
					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) { currentVal = 0; }
					if ( max === '' || max === 'NaN' ) { max = ''; }
					if ( min === '' || min === 'NaN' ) { min = 0; }
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) { step = 1; }
			
					// Change the value
					if ( $( this ).is( '.plus' ) ) {
			
						if ( max && ( max === currentVal || currentVal > max ) ) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}
			
					} else {
			
						if ( min && ( min === currentVal || currentVal < min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( currentVal - parseFloat( step ) );
						}
			
					}
			
					// Trigger change event
					$qty.trigger( 'change' );
			
				});
			}	
		},
		page_scroll: {
			selector: '.page_scroll',
			init: function() {
				var base = this,
						container = $(base.selector),
						nav = $('.header nav');
				
				nav.onePageNav({
					currentClass: 'current-menu-item',
					changeHash: false,
					topOffset: 100,
					scrollSpeed: 750
				});
			}	
		},
		snap_scroll: {
			selector: '.snap_scroll',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				SITE.snap_scroll.setHeight();
				container.waitForImages(function() {
					container
						.find('>.row').each(function() {
								var _this = $(this),
										max_width = _this.hasClass('max_width') ? 'max_width' : '',
										np = _this.hasClass('no-padding') ? 'no-padding' : '';
										
								_this.find('>.columns').wrapAll('<div class="row '+max_width+' '+np+'"></div>');
							}).end()
						.onepage_scroll({
							sectionContainer: '.snap_scroll>.row',
							animationTime: 1000,
							pagination: true,
							loop: true,
							updateURL: false,
							keyboard: false,
							responsiveFallback: 768,
							afterMove: function(index) {
								SITE.animation.control();
							},
							init: function() {
								SITE.animation.control();
							}
						});
						container.addClass('loaded');
						if ($('.subheader').length) {
							$('.onepage-pagination').addClass('subheader-present');	
						}
				});
				
			},
			setHeight: function() {
				var base = this,
					container = $(base.selector),
					ah = ($('#wpadminbar') ? $('#wpadminbar').outerHeight() : 0),
					sh = (($('.subheader') && $('.subheader').is(":visible")) ? $('.subheader').outerHeight() : 0),
					hh = (($('.header:not(.transparent)').length || $('.header-container').length) ? $('.header:not(.fixed)').outerHeight() : 0),
					w = win.height() - ah - sh - hh;
				
				if (win.width() > 768) {
					container.height(w);
				}
			}
		},
		contact: {
			selector: '.contact_map',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.each(function() {
					var that = $(this),
						mapzoom = that.data('map-zoom'),
						maplat = that.data('map-center-lat'),
						maplong = that.data('map-center-long'),
						pinlatlong = that.data('latlong'),
						pinimage = that.data('pin-image'),
						style = that.data('map-style'),
						mapstyle;
						
						switch(style) {
							case 0:
								break;
							case 1:
								mapstyle = [{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]},{},{"featureType":"road.highway","stylers":[{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"road"},{},{"featureType":"landscape","stylers":[{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]}];
								break;
							case 2:
								mapstyle = [{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]}];
								break;
							case 3:
								mapstyle = [{"featureType":"poi","stylers":[{"visibility":"off"}]},{"stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"elementType":"labels","stylers":[{"gamma":0.26},{"visibility":"off"}]},{"featureType":"road","stylers":[{"lightness":0},{"saturation":0},{"hue":"#ffffff"},{"gamma":0}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"lightness":50},{"saturation":0},{"hue":"#ffffff"}]},{"featureType":"administrative.province","stylers":[{"visibility":"on"},{"lightness":-50}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}];
								break;
							case 4:
								mapstyle = [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}];
								break;
							case 5:
								mapstyle = [{"featureType":"landscape","stylers":[{"hue":"#F1FF00"},{"saturation":-27.4},{"lightness":9.4},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#0099FF"},{"saturation":-20},{"lightness":36.4},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#00FF4F"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FFB300"},{"saturation":-38},{"lightness":11.2},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00B6FF"},{"saturation":4.2},{"lightness":-63.4},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#9FFF00"},{"saturation":0},{"lightness":0},{"gamma":1}]}];
								break;
							case 6:
								mapstyle = [{"stylers":[{"hue":"#2c3e50"},{"saturation":250}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":50},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]}];
								break;
							case 7:
								mapstyle = [{"stylers":[{"hue":"#16a085"},{"saturation":0}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]}];
								break;
							case 8:
								mapstyle = [{"featureType":"all","stylers":[{"hue":"#0000b0"},{"invert_lightness":"true"},{"saturation":-30}]}];
								break;
							case 9:
								mapstyle = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];
								break;
							case 10:
								mapstyle = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#ff6a6a"},{"lightness":"0"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ff6a6a"},{"lightness":"75"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"lightness":"75"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.bus","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"weight":"0.01"},{"hue":"#ff0028"},{"lightness":"0"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#80e4d8"},{"lightness":"25"},{"saturation":"-23"}]}];
								break;
							case 11:
								mapstyle = [{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#e9e5dc"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"poi.medical","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"poi.sports_complex","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54},{"visibility":"off"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"water","elementType":"all","stylers":[{"saturation":43},{"lightness":-11},{"color":"#89cada"}]}];
								break;
						}
					
					var centerlatLng = new google.maps.LatLng(maplat,maplong);
					
					var mapOptions = {
						center: centerlatLng,
						styles: mapstyle,
						zoom: mapzoom,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						scrollwheel: false,
						panControl: false,
						zoomControl: false,
						mapTypeControl: false,
						scaleControl: false,
						streetViewControl: false
					};
					
					var map = new google.maps.Map(that[0], mapOptions);
					
					google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
						if(pinimage.length > 0) {
							var pinimageLoad = new Image();
							pinimageLoad.src = pinimage;
							
							$(pinimageLoad).load(function(){
								base.setMarkers(map, pinlatlong, pinimage);
							});
						}
						else {
							base.setMarkers(map, pinlatlong, pinimage);
						}
					});
				});
			},
			setMarkers: function(map, pinlatlong, pinimage) {
				var infoWindows = [];
				
				function showPin (i) {
					var latlong_array = pinlatlong[i].lat_long.split(','),
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(latlong_array[0],latlong_array[1]),
							map: map,
							animation: google.maps.Animation.DROP,
							icon: pinimage,
							optimized: false
						}),
						contentString = '<div class="marker-info-win">'+
						'<img src="'+pinlatlong[i].image+'" class="image" />' +
						'<div class="marker-inner-win">'+
						'<h1 class="marker-heading">'+pinlatlong[i].title+'</h1>'+
						'<p>'+pinlatlong[i].information+'</p>'+ 
						'</div></div>';
					
					// info windows 
					var infowindow = new InfoBox({
							alignBottom: true,
							content: contentString,
							disableAutoPan: false,
							maxWidth: 380,
							closeBoxMargin: "10px 10px 10px 10px",
							closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
							pixelOffset: new google.maps.Size(-190, -103),
							zIndex: null,
							infoBoxClearance: new google.maps.Size(1, 1)
					});
					infoWindows.push(infowindow);
					
					google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
							infoWindows[i].open(map, this);
						};
					})(marker, i));
				}
				
				for (var i = 0; i + 1 <= pinlatlong.length; i++) {  
					setTimeout(showPin, i * 250, i);
				}
			}
		},
		newsletter: {
			selector: '.newsletter-form',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.submit(function() {	
					container.next('.result').load($('body').data('themeurl')+'/inc/subscribe_save.php', {email: container.find('.widget_subscribe').val()},
					function() {
						$(this).slideDown(200).delay(5000).slideUp(200);
					});
					return false;
				});
			}
		},
		equalHeights: {
			selector: '[data-equal]',
			init: function() {
				var base = this,
						container = $(base.selector);
				container.each(function(){
					var that = $(this),
							children = that.data("equal"),
							row = that.data('row-detection') ? that.data('row-detection') : false;
					
					that.find(children).matchHeight({
						byRow: row,
						property: 'min-height'
					});	
					that.waitForImages(function() {
						that.find(children).matchHeight({
							byRow: row,
							property: 'min-height'
						});
					});
					 
				});
			}
		},
		favicon: {
			selector: 'body',
			init: function() {
				var base = this,
						container = $(base.selector),
						count = container.data('cart-count');
					favicon = new Favico({
							bgColor : '#59c379',
							textColor : '#fff'
					});
				favicon.badge(count);
			}
		},
		animation: {
			selector: '#content-container .animation',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				base.control(container);
				
				win.scroll(function(){
					base.control(container);
				});
			},
			control: function(element) {
				var t = -1,
						snap = $(SITE.snap_scroll.selector);

				if (snap.length > 0) {
					snap.find('.section.active').find('.animation').each(function () {
						
						var that = $(this);
							t++;
							setTimeout(function () {
								that.addClass("animate");
							}, 200 * t);
					});
				} else {
					element.filter(':in-viewport').each(function () {
						var that = $(this);
							t++;
						
						setTimeout(function () {
							that.addClass("animate");
						}, 200 * t);
						
					});
				}
			}
		}
	};
	
	// on Resize & Scroll
	win.resize(_.debounce(function(){
		SITE.snap_scroll.setHeight();
	}, 50));
	win.scroll(function(){
		
	});
	
	$doc.ready(function() {
		SITE.init();
	});

})(jQuery, this, _);