(function(window, $) {

    // USE STRICT
    "use strict";

    $('.flexslider').flexslider({
        animation: hmtSliderOption.hmt_animation,
        easing: "swing",
        direction: hmtSliderOption.hmt_direction,
        slideshow: hmtSliderOption.hmt_autoplay,
        slideshowSpeed: hmtSliderOption.hmt_autoplay_speed,
        animationSpeed: 600,
        controlNav: true, // pagination
        directionNav: true, //prev/next
        prevText: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        nextText: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
    });

})(window, jQuery);