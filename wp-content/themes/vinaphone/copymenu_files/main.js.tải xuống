/* 
 *  Created by
 *  Đông Hoàng <donghoang.nguyen@gmail.com>
 */
(function ($) {
    $('.menu-line .button').click(function () {
        $('#header').toggleClass('open');
    });
    $('.search-btn .button').click(function (event) {
        event.stopPropagation();
        $('#header').addClass('searching');        
    });
    $('#header .form-inline').click(function(event){
       event.stopPropagation(); 
    });
    $(document).click(function () {
        $('#header').removeClass('searching');
    });
})(jQuery);