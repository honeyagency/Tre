<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::get_context();
$post            = new TimberPost();
$context['post'] = $post;
if (is_page('home')) {
    $context['home'] = prepareHomepageFields();
} elseif (is_page('projects')) {
    if (!empty($_GET["cat"])) {
        $context['projPage'] = prepareProjectsPage();
        $cat                 = $_GET["cat"];
        if (is_numeric($cat)) {
            $category = get_the_category_by_id($cat);
        }
        $context['currentCat'] = $category;
    } else {
        $cat = null;
    }
    $context['projects'] = getCustomPosts('project', -0, $cat, 'date', null, null);
} elseif (is_page('services')) {
    $context['services'] = prepareServicesPage();
} elseif (is_page('about')) {
    $context['about'] = prepareAboutPage();
}

Timber::render(array('page-' . $post->post_name . '.twig', 'page.twig'), $context);
