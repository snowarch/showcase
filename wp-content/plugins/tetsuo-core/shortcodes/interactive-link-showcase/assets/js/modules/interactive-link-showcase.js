(function($) {
    'use strict';

    var interactiveLinkShowcase = {};
    edgtf.modules.interactiveLinkShowcase = interactiveLinkShowcase;

    interactiveLinkShowcase.edgtfInitInteractiveLinkShowcase = edgtfInitInteractiveLinkShowcase;


    interactiveLinkShowcase.edgtfOnDocumentReady = edgtfOnDocumentReady;
    interactiveLinkShowcase.edgtfOnWindowResize = edgtfOnWindowResize;

    $(document).ready(edgtfOnDocumentReady);
    $(window).resize(edgtfOnWindowResize);


    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfInitInteractiveLinkShowcase();
        edgtfILSSplitHover();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtfOnWindowResize() {
    }

    /**
     * Init item showcase shortcode
     */
    function edgtfInitInteractiveLinkShowcase() {
        var ilsShortcodes = $('.edgtf-ils');

        if (ilsShortcodes.length && !edgtf.htmlEl.hasClass('touch')) {
            ilsShortcodes.each(function(){
                var ilsShortcode = $(this),
                    imagesHolder  = ilsShortcode.find('.edgtf-ils-images-holder'),
                    singleImage = imagesHolder.find('.edgtf-ils-item-image'),
                    singleLink  = ilsShortcode.find('.edgtf-ils-item-link');

                //init
                imagesHolder.addClass('edgtf-changing-image');

                ilsShortcode.waitForImages(function(){
                    ilsShortcode.addClass('edgtf-loaded');
                    singleImage.eq(0).addClass('edgtf-active');
                    imagesHolder
                        .removeClass('edgtf-changing-image')
                        .one(edgtf.transitionEnd, function(){
                            singleLink.eq(0).addClass('edgtf-active');
                        });
                });

                //image change logic
                singleLink.on('mouseenter', function() {
                    var hoveredLink = $(this),
                        currentLink = singleLink.filter('.edgtf-active'),
                        currentImage = singleImage.filter('.edgtf-active'),
                        index = hoveredLink.parent().index();

                    //retrigger hovered link index if moving faster
                    singleLink.on('mousemove', function(){
                        index = $(this).parent().index();
                    });

                    //remove current active
                    imagesHolder.addClass('edgtf-changing-image');
                    currentLink.removeClass('edgtf-active');
                    hoveredLink.addClass('edgtf-active');

                    //set new active
                    imagesHolder.one(edgtf.transitionEnd, function(){
                        imagesHolder.removeClass('edgtf-changing-image');
                        currentImage.removeClass('edgtf-active');
                        singleImage.eq(index).addClass('edgtf-active');
                    });
                });
            });
        }
    }

    
    /***
     * Split Hover effect trigger
     */
    function edgtfILSSplitHover() {
        var splitHoverList = $('.edgtf-ils-with-split-hover');

        if (splitHoverList.length && !edgtf.body.hasClass('edgtf-ms-explorer') && !edgtf.body.hasClass('edgtf-ms-edge')) {
            var items = splitHoverList.find('.edgtf-ils-item-link');
			items.length && items.each(function () { edgtf.modules.common.edgtfSplitHoverAnimation($(this)); });
        }
    } 

})(jQuery);
