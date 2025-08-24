(function($) {
    'use strict';

    var interactiveLinkShowcaseSlider = {};
    edgtf.modules.interactiveLinkShowcaseSlider = interactiveLinkShowcaseSlider;

    interactiveLinkShowcaseSlider.edgtfInitInteractiveLinkShowcaseSlider = edgtfInitInteractiveLinkShowcaseSlider;
    interactiveLinkShowcaseSlider.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
		edgtfInitInteractiveLinkShowcaseSlider();
        edgtfILSSSplitHover();
    }

    /**
     * Init item showcase shortcode
     */
    function edgtfInitInteractiveLinkShowcaseSlider() {
        var interactiveLinkShowcase = $('.edgtf-ilss-holder');
	
	    if (interactiveLinkShowcase.length) {
		    interactiveLinkShowcase.each(function(){
			    var thisInteractiveLinkShowcase = $(this),
				    singleImage = thisInteractiveLinkShowcase.find('.edgtf-ils-item-image'),
				    singleLink  = thisInteractiveLinkShowcase.find('.edgtf-ils-item-link'),
			        triggerItem = thisInteractiveLinkShowcase.hasClass('edgtf-ils-type-slider') ? singleLink : singleLink.children(),
				    firstActiveItem = thisInteractiveLinkShowcase.hasClass('edgtf-ils-type-slider') ? 0 : 2;
			    
			    singleImage.eq(firstActiveItem).addClass('edgtf-active');
			    thisInteractiveLinkShowcase.find('.edgtf-ils-item-link[data-index="'+firstActiveItem+'"]').addClass('edgtf-active');
			
			    if (thisInteractiveLinkShowcase.hasClass('edgtf-ils-type-slider')) {
			    	var swiperInstance = thisInteractiveLinkShowcase.find('.swiper-container'),
                		swiperSlider = new Swiper (swiperInstance, {
                			loop: true,
                			centeredSlides: true,
                			slidesPerView: 'auto',
                			speed: 1202,
                			mousewheel: true,
                			init: false
			    		});

			    	swiperSlider.on('init', function(){
			    		interactiveLinkShowcase.addClass('edgtf-initialized');

			    		thisInteractiveLinkShowcase.on('click', function(e) {
			    			var activeSlide = thisInteractiveLinkShowcase.find('.swiper-slide-active');

			    			if (e.pageX < activeSlide.offset().left) {
								activeSlide.e.preventDefault();
			    				e.stopImmediatePropagation();
			    				swiperSlider.slidePrev();
			    				return false;
			    			}

			    			if (e.pageX > activeSlide.offset().left + activeSlide.outerWidth()) {
								activeSlide.e.preventDefault();
			    				e.stopImmediatePropagation();
			    				swiperSlider.slideNext();
			    				return false;
			    			}
			    		});
			    	});


                	swiperSlider.on('slideChangeTransitionStart', function(){
				    	thisInteractiveLinkShowcase.find('.swiper-slide').removeClass('edgtf-active');
				    	singleImage.removeClass('edgtf-active');
				    	var activeIndex = thisInteractiveLinkShowcase.find('.swiper-slide-active').addClass('edgtf-active').data('index');
				    	singleImage.filter('[data-index='+activeIndex+']').addClass('edgtf-active');
				    });

				    thisInteractiveLinkShowcase.waitForImages(function(){
                    	swiperSlider.init();
				    });
			    }
		    });
	    }
	}
	
	/***
     * Split Hover effect trigger
     */
    function edgtfILSSSplitHover() {
        var splitHoverList = $('.edgtf-ilss-with-split-hover');

        if (splitHoverList.length && !edgtf.body.hasClass('edgtf-ms-explorer') && !edgtf.body.hasClass('edgtf-ms-edge')) {
            var items = splitHoverList.find('.edgtf-ils-item-link span');
			items.length && items.each(function () { edgtf.modules.common.edgtfSplitHoverAnimation($(this)); });
        }
    } 


})(jQuery);