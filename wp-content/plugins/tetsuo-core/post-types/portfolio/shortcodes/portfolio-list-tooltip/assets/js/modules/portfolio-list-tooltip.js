(function($) {
    'use strict';

    var portfolioListTooltip = {};
    edgtf.modules.portfolioListTooltip = portfolioListTooltip;

    portfolioListTooltip.edgtfPortfolioListTooltip = edgtfPortfolioListTooltip;


    portfolioListTooltip.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfPortfolioListTooltip();
        edgtfPLTSplitHover();
    }


    /*
     * Init Image Tooltip shortcode
     */
    function edgtfPortfolioListTooltip() {
        var holder = $('.edgtf-image-tooltip');

        if (holder.length) {
            holder.each(function () {
                $(this).tooltip({
                    animation: true,
                    html: true
                });
            });
        }
    }


    /***
     * Split Hover effect trigger
     */
    function edgtfPLTSplitHover() {
        var splitHoverList = $('.edgtf-plt-with-split-hover');

        if (splitHoverList.length) {
            var items = splitHoverList.find('.edgtf-plti-title-holder');
			items.length && items.each(function () { edgtf.modules.common.edgtfSplitHoverAnimation($(this)); });
        }
    } 

})(jQuery);