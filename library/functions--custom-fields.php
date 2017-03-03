<?php

function prepareProjectFields()
{
    $gridImageId = get_field('field_58b0c0f20d46e');
    if (!empty($gridImageId)) {
        $gridImage = new TimberImage($gridImageId);
    } else {
        $gridImage = null;
    }

    $projectGallery = get_field('field_58b0c152364cb');
    if (!empty($projectGallery)) {
        foreach ($projectGallery as $image) {
            $galleryArray[] = new TimberImage($image['id']);
        }
    } else {
        $galleryArray = null;
    }

    $section = array(
        'date'       => get_field('field_58b0c0bb0d46c'),
        'grid_image' => $gridImage,
        'content'    => get_field('field_58b0c1100d470'),
        'details'    => get_field('field_58b0c11b0d471'),
        'gallery'    => $galleryArray,
    );
    return $section;
}
