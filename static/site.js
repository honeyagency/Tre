jQuery(document).ready(function($) {
    $('.icon-burger').on('click touchstart', function(event) {
        event.preventDefault();
        $('body').toggleClass('open');
    });
});

function getCustomPosts(category, posttype) {
    var prevPostId;
    $.post(ajaxUrl, { // POST request
        action: "get_posts", // references to the function get_prev_ajax_handler() specified in functions.php 
        id: id // data
    }, function(prevPostId) { // callback function using returned data
        console.log(prevPostId) // do what thou wilt
    });
}