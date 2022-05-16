<?php

$mcThumb_exexlarge = wp_get_attachment_image_src( get_post_thumbnail_id(), 'exex-large' );
$mcThumb_exlarge = wp_get_attachment_image_src( get_post_thumbnail_id(), 'ex-large' );
$mcThumb_large = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
$mcThumb_medium = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
$mcThumb_small = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small' );
$mcThumb_extra_small = wp_get_attachment_image_src( get_post_thumbnail_id(), 'extra-small' );
$mcThumb_tiny = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tiny' );
$imgalt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
($imgalt) ? ($thmbalt = $imgalt) : ($thmbalt = get_the_excerpt());

($mcThumb_small[0]) ? ( list($width, $height, $type, $attr) = getimagesize($mcThumb_extra_small[0]) ) : ( '' );

$thas = getAspectRatio($width, $height);
$format = itemformat($width, $height);

$thepicture = '
<picture>
    <source media="(min-width: 1920px)" srcset="'.$mcThumb_exexlarge[0].'">
    <source media="(min-width: 1366px)" srcset="'.$mcThumb_exlarge[0].'">
    <source media="(min-width: 768px)" srcset="'.$mcThumb_medium[0].'">
    <source media="(min-width: 320px)" srcset="'.$mcThumb_small[0].'">
    <img src="'.$mcThumb_extra_small[0].'" alt="'.$thmbalt.'" loading="lazy">
</picture>
';

$thumb = '
<figure class="thumb has-sizer" style="--thAs:'.$thas.'%">
    <div class="wrapper">
        '.$thepicture.'
    </div>
</figure>
';