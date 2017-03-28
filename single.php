<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context                 = Timber::get_context();
$post                    = Timber::query_post();
$context['post']         = $post;
$context['comment_form'] = TimberHelper::get_comment_form();
if ('project' == get_post_type()) {
    $context['project'] = prepareProjectFields();
    $next               = json_decode(json_encode(get_next_post(null, null)), true);

    $nextId = $next['ID'];
    if (!empty($nextId)) {
        $nextPost = getSinglePost('project', array($nextId), true);
    } else {
        $nextPost = null;
    }

    $previous   = json_decode(json_encode(get_previous_post(null, null)), true);
    $previousId = $previous['ID'];

    $previousId = $previous['ID'];
    if (!empty($previousId)) {
        $previousPost = getSinglePost('project', array($previousId), true);
    } else {
        $previousPost = null;
    }

    $context['prevnext'] = array(
        'next' => $nextPost,
        'prev' => $previousPost,
    );
}

if (post_password_required($post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'), $context);
}
