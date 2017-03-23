jQuery(document).ready(function($) {
    $('.icon-burger').on('click touchstart', function(event) {
        event.preventDefault();
        $('body').toggleClass('open');
        if ($('nav').hasClass('cananimate') == true) {} else {
            $('nav').addClass('cananimate');
        }
    });
});
var myLazyLoad = new LazyLoad({
    threshold: 500,
    throttle: 30,
    show_while_loading: false,
});