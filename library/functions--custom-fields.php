<?php

function prepareProjectFields($postId = null)
{
    $gridImageId = get_field('field_58b0c0f20d46e', $postId);
    if (!empty($gridImageId)) {
        $gridImage = new TimberImage($gridImageId);
    } else {
        $gridImage = null;
    }

    $projectGallery = get_field('field_58b0c152364cb', $postId);
    if (!empty($projectGallery)) {
        foreach ($projectGallery as $image) {
            $galleryArray[] = new TimberImage($image['id']);
        }
    } else {
        $galleryArray = null;
    }
    if (have_rows('field_58b0c11b0d471')) {
        $details = array();
        while (have_rows('field_58b0c11b0d471')) {
            the_row();
            $details[] = array(
                'title'       => get_sub_field('field_58b0c124eb8a6'),
                'description' => get_sub_field('field_58b0c12beb8a7'),
            );
        }
    } else {
        $details = null;
    }
    $external = array(
        'link' => get_field('field_58bdb072cdf48'),
        'text' => get_field('field_58bdb05ecdf47'),
    );

    // Featured Gallery Content

    $galleryType        = get_field('field_58bdb8b48043a');
    $galleryMainImageId = get_field('field_58bdb9348043c');
    if ($galleryType != 'video' && $galleryMainImageId != null) {
        $galleryMainImage = new TimberImage($galleryMainImageId);
    } else {
        $galleryMainImage = null;
    }

    $galleryFeat = array(
        'type'  => $galleryType,
        'video' => get_field('field_58bdb91e8043b'),
        'image' => $galleryMainImage,
    );

    $section = array(
        'date'       => get_field('field_58b0c0bb0d46c', $postId),
        'grid_image' => $gridImage,
        'content'    => get_field('field_58b0c1100d470', $postId),
        'details'    => $details,
        'external'   => $external,
        'featured'   => $galleryFeat,
        'gallery'    => $galleryArray,
    );
    return $section;
}

function prepareHomepageFields()
{
    $featuredProjectId = get_field('field_58b9cf1ba34dd');
    if ($featuredProjectId != null) {
        $featuredProject = getSinglePost('project', $featuredProjectId);
    } else {
        $featuredProject = null;
    }

    $header = array(
        'header_title'     => get_field('field_58b9cf77a34e0'),
        'featured_project' => $featuredProject,
        'button_title'     => get_field('field_58b9cf54a34df'),
        'button_url'       => get_field('field_58b9cf3fa34de'),
    );

    if (have_rows('field_58b7097a69b07')) {
        $serviceArray = array();
        while (have_rows('field_58b7097a69b07')) {
            the_row();
            $serviceArray[] = array(
                'title'       => get_sub_field('field_58b7098969b08'),
                'description' => get_sub_field('field_58b7098f69b09'),
            );
        }
    } else {
        $serviceArray = null;
    }
    $services = array(
        'title'        => get_field('field_58b7096e69b06'),
        'services'     => $serviceArray,
        'button_title' => get_field('field_58b9c7a882c6b'),
        'button_url'   => get_field('field_58b9c79382c6a'),
    );

    // Who BG image
    $whoImageId = get_field('field_58b9d4e91fb87');
    if (!empty($whoImageId)) {
        $whoImage = new TimberImage($whoImageId);
    } else {
        $whoImage = null;
    }
    $who = array(
        'image'        => $whoImage,
        'title'        => get_field('field_58b9c9c0569e9'),
        'description'  => get_field('field_58b9c9ca569ea'),
        'button_title' => get_field('field_58b9c9d9569eb'),
        'button_url'   => get_field('field_58b9c9fc569ec'),
    );
    $contact = array(
        'title'     => get_field('field_58b9ca5700ede'),
        'shortcode' => get_field('field_58b9ca6100edf'),
    );
    $home = array(
        'header'   => $header,
        'services' => $services,
        'who'      => $who,
        'contact'  => $contact,
    );
    return $home;
}
