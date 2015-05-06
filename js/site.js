(function($){
    $('body').on('click', '.mobile-nav', function(e) {
        e.preventDefault();
        $('.page-wrapper').toggleClass('active');
        $('.modal-bg').toggleClass('active');
    });
    $('body').on('click', '.modal-bg', function(e) {
        e.preventDefault();
        $('.page-wrapper').removeClass('active');
        $('.modal-bg').removeClass('active');   
    });

    if ( $('textarea.expand').length > 0 ) {

        $('textarea.expand').on('change', function(e) {
            if ( $(this).val() !== '' ) {
                $(this).removeClass('expand');
            } else {
                $(this).addClass('expand');
            }
        });
    }
})(jQuery);

window.addEventListener("hashchange", function(event) {
    var element = document.getElementById(location.hash.substring(1));

    if (element) {
        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
            element.tabIndex = -1;
        }
        element.focus();
    }
}, false);