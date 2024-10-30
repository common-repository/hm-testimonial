(function($) {

    // USE STRICT
    "use strict";

    var hmtColorPicker = ['#hmt_navigation_icon_color', '#hmt_navigation_hover_bg_color', '#hmt_pagination_color', '#hmt_pagination_active_color', '#hmt_button_text_color'];

    $.each(hmtColorPicker, function(index, value) {
        $(value).wpColorPicker();
    });

    $('.hmt-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

})(jQuery);