(function($){
	$( '.mobile-nav' ).click(function() {
		event.preventDefault();
		$('.page-wrapper').toggleClass('active');
	});
})(jQuery);