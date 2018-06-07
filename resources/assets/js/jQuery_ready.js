$("document").ready(function($){
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
	var nav = $('#main-menu-container');

	$(window).scroll(function () {
		if ($(this).scrollTop() > 125) {
			nav.addClass("bg-black").delay(1500).slideDown(500);
		} else {

			nav.removeClass("bg-black");
		}
	});
});
$(window).scroll(function(){
	$('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
});