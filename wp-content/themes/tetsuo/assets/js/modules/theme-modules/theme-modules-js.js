(function($) {
	"use strict";

    var blog = {};
    edgtf.modules.blog = blog;

    blog.edgtfOnDocumentReady = edgtfOnDocumentReady;
    blog.edgtfOnWindowLoad = edgtfOnWindowLoad;
    blog.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(document).ready(edgtfOnDocumentReady);
    $(window).on('load', edgtfOnWindowLoad);
    $(window).scroll(edgtfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitAudioPlayer();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtfOnWindowLoad() {
	    edgtfInitBlogPagination().init();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtfOnWindowScroll() {
	    edgtfInitBlogPagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function edgtfInitAudioPlayer() {
	    var players = $('audio.edgtf-blog-audio');
	
	    if (players.length) {
		    players.mediaelementplayer({
			    audioWidth: '100%'
		    });
	    }
    }
	
	/**
	 * Initializes blog pagination functions
	 */
	function edgtfInitBlogPagination(){
		var holder = $('.edgtf-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edgtf-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgtfGlobalVars.vars.edgtfAddForAdminBar;
			
			if(!thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll-started') && edgtf.scroll + edgtf.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.edgtf-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('edgtf-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgtf.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edgtf-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;

			var nonceHolder = $('input[name*="edgtf_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();


			if(nextPage <= maxNumPages){
				loadingItem.addClass('edgtf-showing');
				
				var ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'tetsuo_edge_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtfGlobalVars.vars.edgtfAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('edgtf-grid-masonry-list')){
								edgtfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								edgtf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), thisHolderInner.find('.edgtf-masonry-grid-sizer').width());
							} else {
								edgtfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								edgtfInitAudioPlayer();
								edgtf.modules.common.edgtfOwlSlider();
								edgtf.modules.common.edgtfFluidVideo();
                                edgtf.modules.common.edgtfInitSelfHostedVideoPlayer();
                                edgtf.modules.common.edgtfSelfHostedVideoSize();
								
								if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
									edgtf.modules.common.edgtfStickySidebarWidget().reInit();
								}

                                // Trigger event.
                                $( document.body ).trigger( 'blog_list_load_more_trigger' );

							}, 400);
						});
						
						if(thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('edgtf-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edgtf-blog-pag-load-more').hide();
			}
		};
		
		var edgtfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgtf-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var edgtfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgtf-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgtf-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgtf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function ($) {
	"use strict";
	
	var footer = {};
    edgtf.modules.footer = footer;
	
	footer.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(window).on('load', edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	 
	function edgtfOnWindowLoad() {
		uncoveringFooter();
	}
	
	function uncoveringFooter() {
		var uncoverFooter = $('body:not(.error404) .edgtf-footer-uncover');

		if (uncoverFooter.length && !edgtf.htmlEl.hasClass('touch')) {

			var footer = $('footer'),
				footerHeight = footer.outerHeight(),
				content = $('.edgtf-content');
			
			var uncoveringCalcs = function () {
				content.css('margin-bottom', footerHeight);
				footer.css('height', footerHeight);
			};


			//set
			uncoveringCalcs();
			
			$(window).resize(function () {
				//recalc
				footerHeight = footer.find('.edgtf-footer-inner').outerHeight();
				uncoveringCalcs();
			});
		}
	}
	
})(jQuery);
(function($) {
	"use strict";
	
	var header = {};
	edgtf.modules.header = header;
	
	header.edgtfSetDropDownMenuPosition     = edgtfSetDropDownMenuPosition;
	header.edgtfSetDropDownWideMenuPosition = edgtfSetDropDownWideMenuPosition;
	
	header.edgtfOnDocumentReady = edgtfOnDocumentReady;
	header.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(document).ready(edgtfOnDocumentReady);
	$(window).on('load', edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtfOnDocumentReady() {
		edgtfSetDropDownMenuPosition();
		setTimeout(function(){
			edgtfDropDownMenu();
		}, 100);
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfSetDropDownWideMenuPosition();
	}
	
	/**
	 * Set dropdown position
	 */
	function edgtfSetDropDownMenuPosition() {
		var menuItems = $('.edgtf-drop-down > ul > li.narrow.menu-item-has-children');
		
		if (menuItems.length) {
			menuItems.each(function (i) {
				var thisItem = $(this),
					menuItemPosition = thisItem.offset().left,
					dropdownHolder = thisItem.find('.second'),
					dropdownMenuItem = dropdownHolder.find('.inner ul'),
					dropdownMenuWidth = dropdownMenuItem.outerWidth(),
					menuItemFromLeft = edgtf.windowWidth - menuItemPosition;
				
				if (edgtf.body.hasClass('edgtf-boxed')) {
					menuItemFromLeft = edgtf.boxedLayoutWidth - (menuItemPosition - (edgtf.windowWidth - edgtf.boxedLayoutWidth ) / 2);
				}
				
				var dropDownMenuFromLeft; //has to stay undefined because 'dropDownMenuFromLeft < dropdownMenuWidth' conditional will be true
				
				if (thisItem.find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}
				
				dropdownHolder.removeClass('right');
				dropdownMenuItem.removeClass('right');
				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					dropdownHolder.addClass('right');
					dropdownMenuItem.addClass('right');
				}
			});
		}
	}
	
	/**
	 * Set dropdown wide position
	 */
	function edgtfSetDropDownWideMenuPosition(){
		var menuItems = $(".edgtf-drop-down > ul > li.wide");
		
		if(menuItems.length) {
			menuItems.each( function(i) {
                var menuItem = $(this);
				var menuItemSubMenu = menuItem.find('.second');
				
				if(menuItemSubMenu.length && !menuItemSubMenu.hasClass('left_position') && !menuItemSubMenu.hasClass('right_position')) {
					menuItemSubMenu.css('left', 0);
					
					var left_position = menuItemSubMenu.offset().left;
					
					if(edgtf.body.hasClass('edgtf-boxed')) {
                        //boxed layout case
                        var boxedWidth = $('.edgtf-boxed .edgtf-wrapper .edgtf-wrapper-inner').outerWidth();
						left_position = left_position - (edgtf.windowWidth - boxedWidth) / 2;
						menuItemSubMenu.css({'left': -left_position, 'width': boxedWidth});

					} else if(edgtf.body.hasClass('edgtf-wide-dropdown-menu-in-grid')) {
                        //wide dropdown in grid case
                        menuItemSubMenu.css({'left': -left_position + (edgtf.windowWidth - edgtf.gridWidth()) / 2, 'width': edgtf.gridWidth()});

                    }
                    else {
                        //wide dropdown full width case
                        menuItemSubMenu.css({'left': -left_position, 'width': edgtf.windowWidth});

					}
				}
			});
		}
	}
	
	function edgtfDropDownMenu() {
		var menu_items = $('.edgtf-drop-down > ul > li');
		
		menu_items.each(function() {
			var thisItem = $(this);
			
			if(thisItem.find('.second').length) {
				thisItem.waitForImages(function(){
					var dropDownHolder = thisItem.find('.second'),
						dropDownHolderHeight = !edgtf.menuDropdownHeightSet ? dropDownHolder.outerHeight() : 0;
					
					if(thisItem.hasClass('wide')) {
						var tallest = 0,
							dropDownSecondItem = dropDownHolder.find('> .inner > ul > li');
						
						dropDownSecondItem.each(function() {
							var thisHeight = $(this).outerHeight();
							
							if(thisHeight > tallest) {
								tallest = thisHeight;
							}
						});
						
						dropDownSecondItem.css('height', '').height(tallest);
						
						if (!edgtf.menuDropdownHeightSet) {
							dropDownHolderHeight = dropDownHolder.outerHeight();
						}
					}
					
					if (!edgtf.menuDropdownHeightSet) {
						dropDownHolder.height(0);
					}
					
					if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
						thisItem.on("touchstart mouseenter", function() {
							dropDownHolder.css({
								'height': dropDownHolderHeight,
								'overflow': 'visible',
								'visibility': 'visible',
								'opacity': '1'
							});
						}).on("mouseleave", function() {
							dropDownHolder.css({
								'height': '0px',
								'overflow': 'hidden',
								'visibility': 'hidden',
								'opacity': '0'
							});
						});
					} else {
						if (edgtf.body.hasClass('edgtf-dropdown-animate-height')) {
							var animateConfig = {
								interval: 0,
								over: function () {
									setTimeout(function () {
										dropDownHolder.addClass('edgtf-drop-down-start').css({
											'visibility': 'visible',
											'height': '0',
											'opacity': '1'
										});
										dropDownHolder.stop().animate({
											'height': dropDownHolderHeight
										}, 300, 'easeInOutQuint', function () {
											dropDownHolder.css('overflow', 'visible');
										});
									}, 100);
								},
								timeout: 100,
								out: function () {
									dropDownHolder.stop().animate({
										'height': '0',
										'opacity': 0
									}, 100, function () {
										dropDownHolder.css({
											'overflow': 'hidden',
											'visibility': 'hidden'
										});
									});
									
									dropDownHolder.removeClass('edgtf-drop-down-start');
								}
							};
							
							thisItem.hoverIntent(animateConfig);
						} else {
							var config = {
								interval: 0,
								over: function () {
									setTimeout(function () {
										dropDownHolder.addClass('edgtf-drop-down-start').stop().css({'height': dropDownHolderHeight});
									}, 150);
								},
								timeout: 150,
								out: function () {
									dropDownHolder.stop().css({'height': '0'}).removeClass('edgtf-drop-down-start');
								}
							};
							
							thisItem.hoverIntent(config);
						}
					}
				});
			}
		});
		
		$('.edgtf-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which === 1){
				var $this = $(this);
				
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
		});
		
		edgtf.menuDropdownHeightSet = true;
	}
	
})(jQuery);
(function($) {
    'use strict';

    var like = {};
    
    like.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function edgtfOnDocumentReady() {
        edgtfLikes();
    }

    function edgtfLikes() {
        $(document).on('click','.edgtf-like', function() {
			var likeLink = $(this),
				id = likeLink.attr('id'),
				postID = likeLink.data('post-id'),
				type = '';

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'tetsuo_edge_like',
                likes_id: id,
                type: type,
				like_nonce: $('#edgtf_like_nonce_'+postID).val()
            };

            var like = $.post(edgtfGlobalVars.vars.edgtfAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function($) {
    "use strict";

    var sidearea = {};
    edgtf.modules.sidearea = sidearea;

    sidearea.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSideArea();
    }
	
	/**
	 * Show/hide side area
	 */
    function edgtfSideArea() {
		var wrapper = $('.edgtf-wrapper'),
			sideMenu = $('.edgtf-side-menu'),
			sideMenuButtonOpen = $('a.edgtf-side-menu-button-opener'),
			cssClass,
			//Flags
			slideFromRight = false,
			slideWithContent = false,
			slideUncovered = false;
		
		if (edgtf.body.hasClass('edgtf-side-menu-slide-from-right')) {
			$('.edgtf-cover').remove();
			cssClass = 'edgtf-right-side-menu-opened';
			wrapper.prepend('<div class="edgtf-cover"/>');
			slideFromRight = true;
		} else if (edgtf.body.hasClass('edgtf-side-menu-slide-with-content')) {
			cssClass = 'edgtf-side-menu-open';
			slideWithContent = true;
		} else if (edgtf.body.hasClass('edgtf-side-area-uncovered-from-content')) {
			cssClass = 'edgtf-right-side-menu-opened';
			slideUncovered = true;
		}
		
		$('a.edgtf-side-menu-button-opener, a.edgtf-close-side-menu').on('click', function (e) {
			e.preventDefault();
	
	        if (!sideMenuButtonOpen.hasClass('opened')) {
		        sideMenuButtonOpen.addClass('opened');
		        edgtf.body.addClass(cssClass);
		
		        if (slideFromRight) {
			        $('.edgtf-wrapper .edgtf-cover').on('click', function () {
				        edgtf.body.removeClass('edgtf-right-side-menu-opened');
				        sideMenuButtonOpen.removeClass('opened');
			        });
		        }
		
		        if (slideUncovered) {
			        sideMenu.css({
				        'visibility': 'visible'
			        });
		        }
		
		        var currentScroll = $(window).scrollTop();
		        $(window).scroll(function () {
			        if (Math.abs(edgtf.scroll - currentScroll) > 400) {
				        edgtf.body.removeClass(cssClass);
				        sideMenuButtonOpen.removeClass('opened');
				        if (slideUncovered) {
					        var hideSideMenu = setTimeout(function () {
						        sideMenu.css({'visibility': 'hidden'});
						        clearTimeout(hideSideMenu);
					        }, 400);
				        }
			        }
		        });
            } else {
	            sideMenuButtonOpen.removeClass('opened');
	            edgtf.body.removeClass(cssClass);
	
	            if (slideUncovered) {
		            var hideSideMenu = setTimeout(function () {
			            sideMenu.css({'visibility': 'hidden'});
			            clearTimeout(hideSideMenu);
		            }, 400);
	            }
            }
	
	        if (slideWithContent) {
		        e.stopPropagation();
		
		        wrapper.on('click', function () {
			        e.preventDefault();
			        sideMenuButtonOpen.removeClass('opened');
			        edgtf.body.removeClass('edgtf-side-menu-open');
		        });
	        }
        });

        if(sideMenu.length){
            edgtf.modules.common.edgtfInitPerfectScrollbar().init(sideMenu);
        }
    }

})(jQuery);

(function ($) {
	"use strict";
	
	var subscribePopup = {};
	edgtf.modules.subscribePopup = subscribePopup;
	
	subscribePopup.edgtfOnWindowLoad = edgtfOnWindowLoad;
	
	$(window).on('load', edgtfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgtfOnWindowLoad() {
		edgtfSubscribePopup();
	}
	
	function edgtfSubscribePopup() {
		var popupOpener = $('.edgtf-subscribe-popup-holder'),
			popupClose = $('.edgtf-sp-close');
		
		if (popupOpener.length) {
			var popupPreventHolder = popupOpener.find('.edgtf-sp-prevent'),
				disabledPopup = 'no';
			
			if (popupPreventHolder.length) {
				var isLocalStorage = popupOpener.hasClass('edgtf-sp-prevent-cookies'),
					popupPreventInput = popupPreventHolder.find('.edgtf-sp-prevent-input'),
					preventValue = popupPreventInput.data('value');
				
				if (isLocalStorage) {
					disabledPopup = localStorage.getItem('disabledPopup');
					sessionStorage.removeItem('disabledPopup');
				} else {
					disabledPopup = sessionStorage.getItem('disabledPopup');
					localStorage.removeItem('disabledPopup');
				}
				
				popupPreventHolder.children().on('click', function (e) {
					if ( preventValue !== 'yes' ) {
						preventValue = 'yes';
						popupPreventInput.addClass('edgtf-sp-prevent-clicked').data('value', 'yes');
					} else {
						preventValue = 'no';
						popupPreventInput.removeClass('edgtf-sp-prevent-clicked').data('value', 'no');
					}
					
					if (preventValue === 'yes') {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'yes');
						} else {
							sessionStorage.setItem('disabledPopup', 'yes');
						}
					} else {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'no');
						} else {
							sessionStorage.setItem('disabledPopup', 'no');
						}
					}
				});
			}
			
			if (disabledPopup !== 'yes') {
				if (edgtf.body.hasClass('edgtf-sp-opened')) {
					edgtf.body.removeClass('edgtf-sp-opened');
					edgtf.modules.common.edgtfEnableScroll();
				} else {
					edgtf.body.addClass('edgtf-sp-opened');
					edgtf.modules.common.edgtfDisableScroll();
				}
				
				popupClose.on('click', function (e) {
					e.preventDefault();
					
					edgtf.body.removeClass('edgtf-sp-opened');
					edgtf.modules.common.edgtfEnableScroll();
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode === 27) { //KeyCode for ESC button is 27
						edgtf.body.removeClass('edgtf-sp-opened');
						edgtf.modules.common.edgtfEnableScroll();
					}
				});
			}
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var title = {};
    edgtf.modules.title = title;

    title.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
	function edgtfParallaxTitle() {
		var parallaxBackground = $('.edgtf-title-holder.edgtf-bg-parallax');
		
		if (parallaxBackground.length > 0 && edgtf.windowWidth > 1024) {
			var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('edgtf-bg-parallax-zoom-out'),
				titleHeight = parseInt(parallaxBackground.data('height')),
				imageWidth = parseInt(parallaxBackground.data('background-width')),
				parallaxRate = titleHeight / 10000 * 7,
				parallaxYPos = -(edgtf.scroll * parallaxRate),
				adminBarHeight = edgtfGlobalVars.vars.edgtfAddForAdminBar;
			
			parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
			
			if (parallaxBackgroundWithZoomOut) {
				parallaxBackground.css({'background-size': imageWidth - edgtf.scroll + 'px auto'});
			}
			
			//set position of background on window scroll
			$(window).scroll(function () {
				parallaxYPos = -(edgtf.scroll * parallaxRate);
				parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
				
				if (parallaxBackgroundWithZoomOut) {
					parallaxBackground.css({'background-size': imageWidth - edgtf.scroll + 'px auto'});
				}
			});
		}
	}

})(jQuery);

(function($) {
    'use strict';

    var woocommerce = {};
    edgtf.modules.woocommerce = woocommerce;

    woocommerce.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfInitQuantityButtons();
        edgtfInitSelect2();
	    edgtfInitSingleProductLightbox();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function edgtfInitQuantityButtons() {
		$(document).on('click', '.edgtf-quantity-minus, .edgtf-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.edgtf-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('edgtf-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function edgtfInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.edgtf-woocommerce-page .edgtf-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function edgtfInitSingleProductLightbox() {
		var item = $('.edgtf-woo-single-page.edgtf-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof edgtf.modules.common.edgtfPrettyPhoto === "function") {
				edgtf.modules.common.edgtfPrettyPhoto();
			}
		}
	}

})(jQuery);
(function($) {
    "use strict";

    var headerMinimal = {};
    edgtf.modules.headerMinimal = headerMinimal;
	
	headerMinimal.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function edgtfFullscreenMenu() {
	    var popupMenuOpener = $( 'a.edgtf-fullscreen-menu-opener');
	    
        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".edgtf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.edgtf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.edgtf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.edgtf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.edgtf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.edgtf-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            edgtf.modules.common.edgtfInitPerfectScrollbar().init(popupMenuHolderOuter);

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(edgtf.windowHeight);
            });

            if (edgtf.body.hasClass('edgtf-fade-push-text-right')) {
                cssClass = 'edgtf-push-nav-right';
                fadeRight = true;
            } else if (edgtf.body.hasClass('edgtf-fade-push-text-top')) {
                cssClass = 'edgtf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('edgtf-fm-opened')) {
                    popupMenuOpener.addClass('edgtf-fm-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-fade-out').addClass('edgtf-fullscreen-menu-opened edgtf-fullscreen-fade-in');
                    edgtf.body.removeClass(cssClass);
                    edgtf.modules.common.edgtfDisableScroll();
                    
                    $(document).keyup(function(e){
                        if (e.keyCode === 27 ) {
                            popupMenuOpener.removeClass('edgtf-fm-opened');
                            edgtf.body.removeClass('edgtf-fullscreen-menu-opened edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                            edgtf.body.addClass(cssClass);
                            edgtf.modules.common.edgtfEnableScroll();

                            $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200);
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('edgtf-fm-opened');
                    edgtf.body.removeClass('edgtf-fullscreen-menu-opened edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                    edgtf.body.addClass(cssClass);
                    edgtf.modules.common.edgtfEnableScroll();

                    $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200);
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent(),
					thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

                if (thisItemParent.hasClass('has_sub')) {
	                var submenu = thisItemParent.find('> ul.sub_menu');
	
	                if (submenu.is(':visible')) {
		                submenu.slideUp(450, 'easeInOutQuint');
		                thisItemParent.removeClass('open_sub');
	                } else {
		                thisItemParent.addClass('open_sub');
		
		                if(thisItemParentSiblingsWithDrop.length === 0) {
			                submenu.slideDown(400, 'easeInOutQuint');
		                } else {
							thisItemParent.closest('li.menu-item').siblings().find('.menu-item').removeClass('open_sub');
			                thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
				                submenu.slideDown(400, 'easeInOutQuint');
			                });
		                }
	                }
                }
                
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which === 1) {
                        popupMenuOpener.removeClass('edgtf-fm-opened');
                        edgtf.body.removeClass('edgtf-fullscreen-menu-opened');
                        edgtf.body.removeClass('edgtf-fullscreen-fade-in').addClass('edgtf-fullscreen-fade-out');
                        edgtf.body.addClass(cssClass);
                        $("nav.edgtf-fullscreen-menu ul.sub_menu").slideUp(200);
                        edgtf.modules.common.edgtfEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var headerVertical = {};
    edgtf.modules.headerVertical = headerVertical;
	
	headerVertical.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfVerticalMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var edgtfVerticalMenu = function() {
	    var verticalMenuObject = $('.edgtf-vertical-menu-area');

	    /**
	     * Checks if vertical area is scrollable (if it has edgtf-with-scroll class)
	     *
	     * @returns {bool}
	     */
	    var verticalAreaScrollable = function () {
		    return verticalMenuObject.hasClass('edgtf-with-scroll');
	    };
	
	    /**
	     * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
	     */
	    var initNavigation = function () {
		    var verticalNavObject = verticalMenuObject.find('.edgtf-vertical-menu');

		    if (verticalNavObject.hasClass('edgtf-vertical-dropdown-below')) {
				dropdownClickToggle();
			} else if (verticalNavObject.hasClass('edgtf-vertical-dropdown-side')) {
				dropdownFloat();
			}
		
		    /**
		     * Initializes click toggle navigation type. Works the same for touch and no-touch devices
		     */
		    function dropdownClickToggle() {
			    var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
			
			    menuItems.each(function () {
				    var elementToExpand = $(this).find(' > .second, > ul');
				    var menuItem = this;
				    var dropdownOpener = $(this).find('> a');
				    var slideUpSpeed = 'fast';
				    var slideDownSpeed = 'slow';
				
				    dropdownOpener.on('click tap', function (e) {
					    e.preventDefault();
					    e.stopPropagation();
					
					    if (elementToExpand.is(':visible')) {
						    $(menuItem).removeClass('open');
						    elementToExpand.slideUp(slideUpSpeed);
					    } else if (dropdownOpener.parent().parent().children().hasClass('open') && dropdownOpener.parent().parent().parent().hasClass('edgtf-vertical-menu')) {
						    $(this).parent().parent().children().removeClass('open');
						    $(this).parent().parent().children().find(' > .second').slideUp(slideUpSpeed);
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed);
					    } else {
						
						    if (!$(this).parents('li').hasClass('open')) {
							    menuItems.removeClass('open');
							    menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    if ($(this).parent().parent().children().hasClass('open')) {
							    $(this).parent().parent().children().removeClass('open');
							    $(this).parent().parent().children().find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed);
					    }
				    });
			    });
		    }


			/**
			 * Initializes click float navigation type
			 */
			function dropdownFloat() {
				var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
				var allDropdowns = menuItems.find(' > .second > .inner > ul, > ul');

				menuItems.each(function() {
					var elementToExpand = $(this).find(' > .second > .inner > ul, > ul');
					var menuItem = this;

					if(Modernizr.touch) {
						var dropdownOpener = $(this).find('> a');

						dropdownOpener.on('click tap', function(e) {
							e.preventDefault();
							e.stopPropagation();

							if(elementToExpand.hasClass('edgtf-float-open')) {
								elementToExpand.removeClass('edgtf-float-open');
								$(menuItem).removeClass('open');
							} else {
								if(!$(this).parents('li').hasClass('open')) {
									menuItems.removeClass('open');
									allDropdowns.removeClass('edgtf-float-open');
								}

								elementToExpand.addClass('edgtf-float-open');
								$(menuItem).addClass('open');
							}
						});
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$(this).hoverIntent({
							over: function() {
								elementToExpand.addClass('edgtf-float-open');
								$(menuItem).addClass('open');
							},
							out: function() {
								elementToExpand.removeClass('edgtf-float-open');
								$(menuItem).removeClass('open');
							},
							timeout: 300
						});
					}
				});
			}
	    };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                edgtf.modules.common.edgtfInitPerfectScrollbar().init(verticalMenuObject);
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();
                }
            }
        };
    };

})(jQuery);
(function($) {
    "use strict";

    var headerVerticalClosed = {};
    edgtf.modules.headerVerticalClosed = headerVerticalClosed;
	
	headerVerticalClosed.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfVerticalClosedMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var edgtfVerticalClosedMenu = function() {
	    var verticalMenuObject = $('.edgtf-header-vertical-closed .edgtf-vertical-menu-area');

        var initHiddenVerticalArea = function() {
            var verticalLogo = $('.edgtf-vertical-area-bottom-logo');
            var verticalMenuOpener = verticalMenuObject.find('.edgtf-vertical-area-opener');
            var scrollPosition = 0;

            verticalMenuOpener.on('click tap', function() {
                if(isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            $(window).scroll(function() {
                if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                verticalMenuObject.removeClass('active');

                if(verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                verticalMenuObject.addClass('active');

                if(verticalLogo.length) {
                    verticalLogo.addClass('active');
                }
                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initHiddenVerticalArea();
                }
            }
        };
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var mobileHeader = {};
	edgtf.modules.mobileHeader = mobileHeader;
	
	mobileHeader.edgtfOnDocumentReady = edgtfOnDocumentReady;
	mobileHeader.edgtfOnWindowResize = edgtfOnWindowResize;
	
	$(document).ready(edgtfOnDocumentReady);
	$(window).resize(edgtfOnWindowResize);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function edgtfOnDocumentReady() {
		edgtfInitMobileNavigation();
		edgtfInitMobileNavigationScroll();
		edgtfMobileHeaderBehavior();
	}
	
	/*
        All functions to be called on $(window).resize() should be in this function
    */
	function edgtfOnWindowResize() {
		edgtfInitMobileNavigationScroll();
	}
	
	function edgtfInitMobileNavigation() {
		var navigationOpener = $('.edgtf-mobile-header .edgtf-mobile-menu-opener'),
			navigationHolder = $('.edgtf-mobile-header .edgtf-mobile-nav'),
			dropdownOpener = $('.edgtf-mobile-nav .mobile_arrow, .edgtf-mobile-nav h6, .edgtf-mobile-nav a.edgtf-mobile-no-link');
		
		//whole mobile menu opening / closing
		if (navigationOpener.length && navigationHolder.length) {
			navigationOpener.on('tap click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				
				if (navigationHolder.is(':visible')) {
					navigationHolder.slideUp(450, 'easeInOutQuint');
					navigationOpener.removeClass('edgtf-mobile-menu-opened');
				} else {
					navigationHolder.slideDown(450, 'easeInOutQuint');
					navigationOpener.addClass('edgtf-mobile-menu-opened');
				}
			});
		}
		
		//dropdown opening / closing
		if (dropdownOpener.length) {
			dropdownOpener.each(function () {
				var thisItem = $(this),
					initialNavHeight = navigationHolder.outerHeight();

				thisItem.on('tap click', function (e) {
					var thisItemParent = thisItem.parent('li'),
						thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

					if (thisItemParent.hasClass('has_sub')) {
						var submenu = thisItemParent.find('> ul.sub_menu');

						if (submenu.is(':visible')) {
							submenu.slideUp(450, 'easeInOutQuint');
							thisItemParent.removeClass('edgtf-opened');
							navigationHolder.stop().animate({'height': initialNavHeight}, 300);
						} else {
							thisItemParent.addClass('edgtf-opened');

							if (thisItemParentSiblingsWithDrop.length === 0) {
								thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
									navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
								});
							} else {
								thisItemParent.siblings().removeClass('edgtf-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
									navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
								});
							}
						}
					}
				});
			});
		}
		
		$('.edgtf-mobile-nav a, .edgtf-mobile-logo-wrapper a').on('click tap', function (e) {
			if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
				navigationHolder.slideUp(450, 'easeInOutQuint');
				navigationOpener.removeClass("edgtf-mobile-menu-opened");
			}
		});
	}
	
	function edgtfInitMobileNavigationScroll() {
		if (edgtf.windowWidth <= 1024) {
			var mobileHeader = $('.edgtf-mobile-header'),
				mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
				navigationHolder = mobileHeader.find('.edgtf-mobile-nav'),
				navigationHeight = navigationHolder.outerHeight(),
				windowHeight = edgtf.windowHeight - 100;
			
			//init scrollable menu
			var scrollHeight = mobileHeaderHeight + navigationHeight > windowHeight ? windowHeight - mobileHeaderHeight : navigationHeight;

			navigationHolder.height(scrollHeight);
            edgtf.modules.common.edgtfInitPerfectScrollbar().init(navigationHolder);
		}
	}
	
	function edgtfMobileHeaderBehavior() {
		var mobileHeader = $('.edgtf-mobile-header'),
			mobileMenuOpener = mobileHeader.find('.edgtf-mobile-menu-opener'),
			mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
		
		if (edgtf.body.hasClass('edgtf-content-is-behind-header') && mobileHeaderHeight > 0 && edgtf.windowWidth <= 1024) {
			$('.edgtf-content').css('marginTop', -mobileHeaderHeight);
		}
		
		if (edgtf.body.hasClass('edgtf-sticky-up-mobile-header')) {
			var stickyAppearAmount,
				adminBar = $('#wpadminbar');
			
			var docYScroll1 = $(document).scrollTop();
			stickyAppearAmount = mobileHeaderHeight + edgtfGlobalVars.vars.edgtfAddForAdminBar;
			
			$(window).scroll(function () {
				var docYScroll2 = $(document).scrollTop();
				
				if (docYScroll2 > stickyAppearAmount) {
					mobileHeader.addClass('edgtf-animate-mobile-header');
				} else {
					mobileHeader.removeClass('edgtf-animate-mobile-header');
				}
				
				if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('edgtf-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
					mobileHeader.removeClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', 0);
					
					if (adminBar.length) {
						mobileHeader.find('.edgtf-mobile-header-inner').css('top', 0);
					}
				} else {
					mobileHeader.addClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', stickyAppearAmount);
				}
				
				docYScroll1 = $(document).scrollTop();
			});
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var stickyHeader = {};
    edgtf.modules.stickyHeader = stickyHeader;
	
	stickyHeader.isStickyVisible = false;
	stickyHeader.stickyAppearAmount = 0;
	stickyHeader.behaviour = '';
	
	stickyHeader.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    if(edgtf.windowWidth > 1024) {
		    edgtfHeaderBehaviour();
	    }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function edgtfHeaderBehaviour() {
        var header = $('.edgtf-page-header'),
	        stickyHeader = $('.edgtf-sticky-header'),
            fixedHeaderWrapper = $('.edgtf-fixed-wrapper'),
	        fixedMenuArea = fixedHeaderWrapper.children('.edgtf-menu-area'),
	        fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.edgtf-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
	        stickyAppearAmount,
	        headerAppear;
        
        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - edgtfGlobalVars.vars.edgtfAddForAdminBar : 0;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-up'):
                edgtf.modules.stickyHeader.behaviour = 'edgtf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(edgtfGlobalVars.vars.edgtfTopBarHeight) + parseInt(edgtfGlobalVars.vars.edgtfLogoAreaHeight) + parseInt(edgtfGlobalVars.vars.edgtfMenuAreaHeight) + parseInt(edgtfGlobalVars.vars.edgtfStickyHeaderHeight);
	            
                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();
					
                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        edgtf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .second').removeClass('edgtf-drop-down-start');
                        edgtf.body.removeClass('edgtf-sticky-header-appear');
                    } else {
                        edgtf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    edgtf.body.addClass('edgtf-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case edgtf.body.hasClass('edgtf-sticky-header-on-scroll-down-up'):
                edgtf.modules.stickyHeader.behaviour = 'edgtf-sticky-header-on-scroll-down-up';

                if(edgtfPerPageVars.vars.edgtfStickyScrollAmount !== 0){
                    edgtf.modules.stickyHeader.stickyAppearAmount = parseInt(edgtfPerPageVars.vars.edgtfStickyScrollAmount);
                } else {
                    edgtf.modules.stickyHeader.stickyAppearAmount = parseInt(edgtfGlobalVars.vars.edgtfTopBarHeight) + parseInt(edgtfGlobalVars.vars.edgtfLogoAreaHeight) + parseInt(edgtfGlobalVars.vars.edgtfMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function(){
                    if(edgtf.scroll < edgtf.modules.stickyHeader.stickyAppearAmount) {
                        edgtf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgtf-main-menu .second').removeClass('edgtf-drop-down-start');
	                    edgtf.body.removeClass('edgtf-sticky-header-appear');
                    }else{
                        edgtf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    edgtf.body.addClass('edgtf-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case edgtf.body.hasClass('edgtf-fixed-on-scroll'):
                edgtf.modules.stickyHeader.behaviour = 'edgtf-fixed-on-scroll';
                var headerFixed = function(){
	
	                if(edgtf.scroll <= headerMenuAreaOffset) {
		                fixedHeaderWrapper.removeClass('fixed');
		                edgtf.body.removeClass('edgtf-fixed-header-appear');
		                header.css('margin-bottom', '0');
	                } else {
		                fixedHeaderWrapper.addClass('fixed');
		                edgtf.body.addClass('edgtf-fixed-header-appear');
		                header.css('margin-bottom', fixedMenuAreaHeight + 'px');
	                }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var searchCoversHeader = {};
    edgtf.modules.searchCoversHeader = searchCoversHeader;

    searchCoversHeader.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
        edgtfSearchCoversHeader();
    }

    /**
     * Init Search Types
     */
    function edgtfSearchCoversHeader() {
        if (edgtf.body.hasClass('edgtf-search-covers-header')) {

            var searchOpener = $('a.edgtf-search-opener');

            if (searchOpener.length > 0) {
                searchOpener.each(function () {
                    var thisOpener = $(this);
                    thisOpener.on('click', function (e) {
                        e.preventDefault();

                        var thisSearchOpener = $(this),
                            searchFormHeight,
                            searchFormHeaderHolder = $('.edgtf-page-header'),
                            searchFormTopHeaderHolder = $('.edgtf-top-bar'),
                            searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.edgtf-fixed-wrapper.fixed'),
                            searchFormMobileHeaderHolder = $('.edgtf-mobile-header'),
                            searchForm = $('.edgtf-search-cover'),
                            searchFormIsInTopHeader = !!thisSearchOpener.parents('.edgtf-top-bar').length,
                            searchFormIsInFixedHeader = !!thisSearchOpener.parents('.edgtf-fixed-wrapper.fixed').length,
                            searchFormIsInStickyHeader = !!thisSearchOpener.parents('.edgtf-sticky-header').length,
                            searchFormIsInMobileHeader = !!thisSearchOpener.parents('.edgtf-mobile-header').length;

                        searchForm.removeClass('edgtf-is-active');

                        //Find search form position in header and height
                        if (searchFormIsInTopHeader) {
                            searchFormHeight = searchFormTopHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active edgtf-opener-in-top-header');
                            
                        } else if (searchFormIsInFixedHeader) {
                            searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');

                        } else if (searchFormIsInStickyHeader) {
                            searchFormHeight = searchFormHeaderHolder.find('.edgtf-sticky-header').outerHeight();
                            searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');

                        } else if (searchFormIsInMobileHeader) {
                            if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                                searchFormHeight = searchFormMobileHeaderHolder.children('.edgtf-mobile-header-inner').outerHeight();
                            } else {
                                searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
                            }

                            searchFormMobileHeaderHolder.find('.edgtf-search-cover').addClass('edgtf-is-active');

                        } else {
                            searchFormHeight = searchFormHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.edgtf-search-cover').addClass('edgtf-is-active');
                        }

                        if (searchForm.hasClass('edgtf-is-active')) {
                            searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
                        }

                        searchForm.find('.edgtf-search-close').on('click', function (e) {
                            e.preventDefault();
                            searchForm.stop(true).fadeOut(450, function () {
                                if (searchForm.hasClass('edgtf-opener-in-top-header')) {
                                    searchForm.removeClass('edgtf-opener-in-top-header');
                                }
                            });

                            searchForm.removeClass('edgtf-is-active');
                        });

                        searchForm.blur(function () {
                            searchForm.stop(true).fadeOut(450, function () {
                                if (searchForm.hasClass('edgtf-opener-in-top-header')) {
                                    searchForm.removeClass('edgtf-opener-in-top-header');
                                }
                            });

                            searchForm.removeClass('edgtf-is-active');
                        });

                        $(window).scroll(function () {
                            searchForm.stop(true).fadeOut(450, function () {
                                if (searchForm.hasClass('edgtf-opener-in-top-header')) {
                                    searchForm.removeClass('edgtf-opener-in-top-header');
                                }
                            });

                            searchForm.removeClass('edgtf-is-active');
                        });
                    });
                });
            }
        }
    }

})(jQuery);

(function($) {
    "use strict";

    var searchFullscreen = {};
    edgtf.modules.searchFullscreen = searchFullscreen;

    searchFullscreen.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtfOnDocumentReady() {
	    edgtfSearchFullscreen();
    }
	
	/**
	 * Init Search Types
	 */
	function edgtfSearchFullscreen() {
        if ( edgtf.body.hasClass( 'edgtf-fullscreen-search' ) ) {

            var searchOpener = $('a.edgtf-search-opener');

            if (searchOpener.length > 0) {

                var searchHolder = $('.edgtf-fullscreen-search-holder'),
                    searchClose = $('.edgtf-search-close');

                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('edgtf-animate')) {
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-out');
                        edgtf.body.removeClass('edgtf-search-fade-in');
                        searchHolder.removeClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').val('');
                            searchHolder.find('.edgtf-search-field').blur();
                        }, 300);

                        edgtf.modules.common.edgtfEnableScroll();
                    } else {
                        edgtf.body.addClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                        edgtf.body.removeClass('edgtf-search-fade-out');
                        searchHolder.addClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').focus();
                        }, 900);

                        edgtf.modules.common.edgtfDisableScroll();
                    }

                    searchClose.on('click', function (e) {
                        e.preventDefault();
                        edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                        edgtf.body.addClass('edgtf-search-fade-out');
                        searchHolder.removeClass('edgtf-animate');

                        setTimeout(function () {
                            searchHolder.find('.edgtf-search-field').val('');
                            searchHolder.find('.edgtf-search-field').blur();
                        }, 300);

                        edgtf.modules.common.edgtfEnableScroll();
                    });

                    // //Close on click away
                    // $(document).mouseup(function (e) {
                    //     var container = $(".edgtf-form-holder-inner");
                    //
                    //     if (!container.is(e.target) && container.has(e.target).length === 0) {
                    //         e.preventDefault();
                    //         edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                    //         edgtf.body.addClass('edgtf-search-fade-out');
                    //         searchHolder.removeClass('edgtf-animate');
                    //
                    //         setTimeout(function () {
                    //             searchHolder.find('.edgtf-search-field').val('');
                    //             searchHolder.find('.edgtf-search-field').blur();
                    //         }, 300);
                    //
                    //         edgtf.modules.common.edgtfEnableScroll();
                    //     }
                    // });

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            edgtf.body.removeClass('edgtf-fullscreen-search-opened edgtf-search-fade-in');
                            edgtf.body.addClass('edgtf-search-fade-out');
                            searchHolder.removeClass('edgtf-animate');

                            setTimeout(function () {
                                searchHolder.find('.edgtf-search-field').val('');
                                searchHolder.find('.edgtf-search-field').blur();
                            }, 300);

                            edgtf.modules.common.edgtfEnableScroll();
                        }
                    });
                });

                //Text input focus change
                var inputSearchField = $('.edgtf-fullscreen-search-holder .edgtf-search-field'),
                    inputSearchLine = $('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line');

                inputSearchField.focus(function () {
                    inputSearchLine.css('width', '100%');
                });

                inputSearchField.blur(function () {
                    inputSearchLine.css('width', '0');
                });
            }
        }
	}

})(jQuery);

(function($) {
    "use strict";

    var blogListSC = {};
    edgtf.modules.blogListSC = blogListSC;
    
    blogListSC.edgtfOnWindowLoad = edgtfOnWindowLoad;
    blogListSC.edgtfOnWindowScroll = edgtfOnWindowScroll;

    $(window).on('load', edgtfOnWindowLoad);
    $(window).scroll(edgtfOnWindowScroll);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtfOnWindowLoad() {
        edgtfInitBlogListShortcodePagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtfOnWindowScroll() {
        edgtfInitBlogListShortcodePagination().scroll();
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function edgtfInitBlogListShortcodePagination(){
        var holder = $('.edgtf-blog-list-holder');

        var initStandardPagination = function(thisHolder) {
            var standardLink = thisHolder.find('.edgtf-bl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisHolder) {
            var loadMoreButton = thisHolder.find('.edgtf-blog-pag-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function(thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - edgtfGlobalVars.vars.edgtfAddForAdminBar;

            if(!thisHolder.hasClass('edgtf-bl-pag-infinite-scroll-started') && edgtf.scroll + edgtf.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function(thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.edgtf-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if(thisHolder.hasClass('edgtf-bl-pag-standard-shortcodes')) {
                thisHolder.data('next-page', pagedLink);
            }

            if(thisHolder.hasClass('edgtf-bl-pag-infinite-scroll')) {
                thisHolder.addClass('edgtf-bl-pag-infinite-scroll-started');
            }

            var loadMoreDatta = edgtf.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.edgtf-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

			var nonceHolder = $('input[name*="edgtf_blog_load_more_nonce_"]');

			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();


			if(nextPage <= maxNumPages){
                if(thisHolder.hasClass('edgtf-bl-pag-standard-shortcodes')) {
                    loadingItem.addClass('edgtf-showing edgtf-standard-pag-trigger');
                    thisHolder.addClass('edgtf-bl-pag-standard-shortcodes-animate');
                } else {
                    loadingItem.addClass('edgtf-showing');
                }

                var ajaxData = edgtf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'tetsuo_edge_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: edgtfGlobalVars.vars.edgtfAjaxUrl,
                    success: function (data) {
                        if(!thisHolder.hasClass('edgtf-bl-pag-standard-shortcodes')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html;

                        if(thisHolder.hasClass('edgtf-bl-pag-standard-shortcodes')) {
                            edgtfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('edgtf-bl-masonry')){
                                    edgtfInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    edgtfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);

                                    if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
                                        edgtf.modules.common.edgtfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('edgtf-bl-masonry')){
                                    edgtfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    edgtfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);

                                    if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
                                        edgtf.modules.common.edgtfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        }

                        if(thisHolder.hasClass('edgtf-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('edgtf-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if(nextPage === maxNumPages){
                thisHolder.find('.edgtf-blog-pag-load-more').hide();
            }
        };

        var edgtfInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.edgtf-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.edgtf-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.edgtf-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.edgtf-pag-next a');

            standardPagNumericItem.removeClass('edgtf-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('edgtf-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var edgtfInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('edgtf-showing edgtf-standard-pag-trigger');
            thisHolder.removeClass('edgtf-bl-pag-standard-shortcodes-animate');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
                    edgtf.modules.common.edgtfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var edgtfInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('edgtf-showing edgtf-standard-pag-trigger');
            thisHolder.removeClass('edgtf-bl-pag-standard-shortcodes-animate');
            thisHolderInner.html(responseHtml);
        };

        var edgtfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('edgtf-showing');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof edgtf.modules.common.edgtfStickySidebarWidget === 'function') {
                    edgtf.modules.common.edgtfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var edgtfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('edgtf-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('edgtf-bl-pag-standard-shortcodes')) {
                            initStandardPagination(thisHolder);
                        }

                        if(thisHolder.hasClass('edgtf-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if(thisHolder.hasClass('edgtf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('edgtf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

})(jQuery);