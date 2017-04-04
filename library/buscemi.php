<?php

// Adding documentation to the dash
function bc_dashboard_widget_function()
{
    $docs_template = get_template_directory() . '/library/docs.php';
    load_template($docs_template);
}
function bc_add_dashboard_widgets()
{
    wp_add_dashboard_widget('wp_dashboard_widget', 'Buscemi Docs', 'bc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'bc_add_dashboard_widgets');

// add ie conditional html5 shim to header
function add_ie_html5_shim()
{
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

// Remove WP 4.2 emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Getting rid of WP Default jquery and adding from google
if (!is_admin()) {
    add_action("wp_enqueue_scripts", "jquery_enqueue", 11);
}

function jquery_enqueue()
{
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/app/vendors/jquery-3.2.0.min.js', null, false, false);

}

function localInstall()
{
    $url = get_site_url();
    $tld = end(explode(".", parse_url($url, PHP_URL_HOST))); // echos "com"
    if ($tld == 'dev') {
        $res = true;
    } else {

        $res = false;
    }
    return ($res);
}

// Enqueuing all of our scripts and styles
function buscemi_scripts()
{
    wp_enqueue_script('jquery');
    if (localInstall() == true) {
        $reloadScript = 'http://localhost:35729/livereload.js';
        wp_register_script('livereload', $reloadScript, null, false, true);
        wp_enqueue_script('livereload');
    }
    wp_register_script('lazyload', get_template_directory_uri() . '/app/vendors/lazyload.min.js', null, false, false);
    wp_enqueue_script('lazyload');
    wp_register_script('picturefill', get_template_directory_uri() . '/app/vendors/picturefill.min.js', null, false, false);
    wp_enqueue_script('picturefill');
// wp_register_script( $handle, $src, $deps, $ver, $in_footer );
    wp_enqueue_style('buscemi_style', get_template_directory_uri() . '/app/main.min.css', null, null, null);
    wp_enqueue_script('buscemi_script', get_template_directory_uri() . '/app/app.min.js', array('jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'buscemi_scripts');

add_filter( 'script_loader_tag', function ( $tag, $handle ) {

    if ( 'jquery' !== $handle )
        return $tag;

    return str_replace( ' src', 'charset="UTF-8" src', $tag );
}, 10, 2 );


// Allowing SVG preveiw in WP Upload
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Setting up ACF options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

function filter_ptags_on_images($content)
{
    return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

require_once 'functions--custom-posts.php';
require_once 'functions--custom-fields.php';
