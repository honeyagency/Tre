<?php
function getCustomPosts($posttype = '', $limit = '', $category = '', $order = 'title', $excluded = null, $tag = null)
{

    if (is_numeric($category)) {
        $category = get_cat_name($category);
    }

    $args = array(
        'posts_per_page' => $limit,
        'post_type'      => $posttype,
        'order'          => 'DESC',
        'orderby'        => $order,

    );

    // Begin statememnts to append the $args array, just so the arrays stay light and clean.

    // If there's a category to filter by, we're gonna go ahead and do that
    if ($category != null) {
        $args['category_name'] = $category;
    }
    if ($tag != null) {
        $args['tag'] = $tag;
    }
    // If there's an excluded post (for example, the current post) we add that here
    if ($excluded != null) {
        $args['post__not_in'] = array($excluded);
    }
// print_r($args);
    $loop = new WP_Query($args);

    // Empty array for the terms

    if ($loop->have_posts()) {
        while ($loop->have_posts()) {

            // Setting up post data
            $loop->the_post();

            // Fill the array with post data we changed in getSinglePost
            $array[] = getSinglePost($posttype, null);
        }

        // Restores original Post Data
        wp_reset_postdata();

        // Returns an array of terms.
        if ($limit === 1) {
            $array = $array['0'];
        }

        return $array;

    }
}

function getSinglePost($posttype = null, $specificid = null)
{
    if ($specificid != null) {
        $postId = $specificid[0];
    } else {
        $postId = get_the_id();
    }

    if ($posttype == 'project') {
        $postinfo = prepareProjectFields($postId);
    } else {
        $postinfo = null;
    }

    $attachedimage = new TimberImage(get_post_thumbnail_id($postId));
    $categories    = get_the_category($postId);

    // setup an array to change the post data returned
    $singlePostArray = array(
        'date'       => strtotime(get_the_date($postId)),
        'id'         => $postId,
        'title'      => get_the_title($postId),
        'categories' => $categories,
        'tags'       => get_the_tags($postId),
        'post_type'  => $posttype,
        'image'      => $attachedimage,
        'link'       => get_permalink($postId),
        'postinfo'   => $postinfo,
    );

    // Restores original Post Data
    wp_reset_postdata();

    return $singlePostArray;
}
