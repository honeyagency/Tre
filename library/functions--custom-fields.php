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
    $featuredProjectId = get_field('field_58b9cf1ba34dd', '4');
    if ($featuredProjectId != null) {
        $featuredProject = getSinglePost('project', $featuredProjectId);
    } else {
        $featuredProject = null;
    }

    $header = array(
        'header_title'     => get_field('field_58b9cf77a34e0', '4'),
        'featured_project' => $featuredProject,
        'button_title'     => get_field('field_58b9cf54a34df', '4'),
        'button_url'       => get_field('field_58b9cf3fa34de', '4'),
    );

    if (have_rows('field_58b7097a69b07')) {
        $serviceArray = array();
        while (have_rows('field_58b7097a69b07')) {
            the_row();
            $serviceArray[] = array(
                'title'       => get_sub_field('field_58b7098969b08', '4'),
                'description' => get_sub_field('field_58b7098f69b09', '4'),
            );
        }
    } else {
        $serviceArray = null;
    }
    $services = array(
        'title'        => get_field('field_58b7096e69b06', '4'),
        'services'     => $serviceArray,
        'button_title' => get_field('field_58b9c7a882c6b', '4'),
        'button_url'   => get_field('field_58b9c79382c6a', '4'),
    );

    // Who BG image
    $whoImageId = get_field('field_58b9d4e91fb87', '4');
    if (!empty($whoImageId)) {
        $whoImage = new TimberImage($whoImageId);
    } else {
        $whoImage = null;
    }
    $who = array(
        'image'        => $whoImage,
        'title'        => get_field('field_58b9c9c0569e9', '4'),
        'description'  => get_field('field_58b9c9ca569ea', '4'),
        'button_title' => get_field('field_58b9c9d9569eb', '4'),
        'button_url'   => get_field('field_58b9c9fc569ec', '4'),
    );
    $contact = array(
        'title'     => get_field('field_58b9ca5700ede', '4'),
        'shortcode' => get_field('field_58b9ca6100edf', '4'),
    );
    $home = array(
        'header'   => $header,
        'services' => $services,
        'who'      => $who,
        'contact'  => $contact,
    );
    return $home;
}

function prepareOptionsPage()
{
    $contact = array(
        'title' => get_field('field_58bf3eb9a3175', 'option'),
        'form'  => get_field('field_58bf3ddc34a71', 'option'),
    );
    $footer = array(
        'contact' => $contact,

    );
    $social = array(
        'facebook'  => get_field('field_58bf40315c1f8', 'option'),
        'twitter'   => get_field('field_58bf404d5c1f9', 'option'),
        'instagram' => get_field('field_58bf406f5c1fa', 'option'),
        'linkedin'  => get_field('field_58bf40795c1fb', 'option'),
        'youtube'   => get_field('field_58bf40845c1fc', 'option'),
    );
    $section = array(
        'footer' => $footer,
        'social' => $social,
    );
    return $section;
}
function prepareServicesPage()
{
    if (have_rows('field_58c09ce844470')) {
        $services = array();
        while (have_rows('field_58c09ce844470')) {
            the_row();
            $services[] = array(
                'title'   => get_sub_field('field_58c09d014fc69'),
                'content' => get_sub_field('field_58c09d0d4fc6a'),
                'details' => get_sub_field('field_58c09d2b4fc6b'),
            );
        }
    }
    return $services;
}
