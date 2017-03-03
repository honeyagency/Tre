jQuery(document).ready(function($) {
	$('.icon-burger').on('click touchstart', function(event) {
		event.preventDefault();
		$('body').toggleClass('open');
	});
});