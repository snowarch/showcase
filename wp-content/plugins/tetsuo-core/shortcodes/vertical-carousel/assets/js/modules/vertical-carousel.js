(function ($) {
    'use strict';

    var verticalCarousel = {};
    edgtf.modules.verticalCarousel = verticalCarousel;

    verticalCarousel.edgtfVerticalCarousel = edgtfVerticalCarousel;
    verticalCarousel.edgtfOnDocumentReady = edgtfOnDocumentReady;

    $(document).ready(edgtfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtfOnDocumentReady() {
        edgtfVerticalCarousel();
    }

    /**
     * Init vertical carousel shortcode
     */
    function edgtfVerticalCarousel() {
        var carousels = $('#edgtf-vertical-carousel');

        if (carousels.length) {
            carousels.each(function () {
                var carousel = $(this),
                    swiperInstance = carousel.find('.swiper-container'),
                    content = carousel.find('.edgtf-vc-item-content'),
                    transitionSpeed = 500;

                var fullscreenCalcs = function () {
                    var heightVal = edgtf.windowHeight - carousel.offset().top;

                    if (edgtf.body.hasClass('edgtf-paspartu-enabled')) {
                        var passepartoutSize = parseInt($('.edgtf-wrapper').css('padding-top'));

                        heightVal -= passepartoutSize;
                    }

                    carousel.css('height', heightVal);
                };

                var dragTrigger = function () {
                    var xPosStart = 0,
                        xPos;

                    $(document).on('touchstart', carousel, function (e) {
                        xPosStart = e.originalEvent.touches[0].pageX;
                    }).on('touchmove', carousel, function (e) {
                        xPos = e.originalEvent.touches[0].pageX;

                        if (xPos > xPosStart) {
                            swiperSlider.slideNext(transitionSpeed);
                        } else {
                            swiperSlider.slidePrev(transitionSpeed);
                        }
                    }).on('touchend', carousel, function () {
                        xPosStart = 0;
                        xPos = 0;
                    });
                };

                var setActiveContent = function() {
                    var activeIndex = carousel.find('.swiper-slide-active').data('index');
                    content.removeClass('edgtf-active');
                    content.filter('[data-index='+activeIndex+']').addClass('edgtf-active');
                }

                var setCounter = function() {
                    var currentNav = carousel.find('.edgtf-vc-total');
                    currentNav.text(content.length);
                }

                var updateCounter = function() {
                    var currentNav = carousel.find('.edgtf-vc-current');
                    currentNav.text(carousel.find('.swiper-slide-active').data('index') + 1);
                }

                var swiperSlider = new Swiper(swiperInstance, {
                    autoplay: {
                        delay: 3500,
                    },
                    loop: true,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    direction: 'vertical',
                    speed: transitionSpeed,
                    mousewheel: {
                        eventsTarged: '#edgtf-vertical-carousel'
                    },
                    parallax: true,
                    init: false,
                    navigation: {
                        nextEl: '.edgtf-vc-down',
                        prevEl: '.edgtf-vc-up',
                    },
                });

                swiperSlider.on('init', function () {
                    fullscreenCalcs();
                    dragTrigger();
                    setCounter();
                });

                swiperSlider.on('slideChangeTransitionStart', function(){
                    setActiveContent();
                    updateCounter();
                });  

                $(window).on('load', function () {
                    carousel.addClass('edgtf-initialized');
                    swiperSlider.init();
                });

                $(window).resize(function () {
                    setTimeout(function () {
                        fullscreenCalcs();
                    }, 200);
                });
            });
        }
    }
})(jQuery);
