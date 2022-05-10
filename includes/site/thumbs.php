<?php
add_theme_support( 'post-thumbnails' );
add_image_size( 'ex-large', 1920, 1080 );
add_image_size( 'large', 1366 );
add_image_size( 'medium', 768 );
add_image_size( 'small', 600 );
add_image_size( 'extra-small', 338 );
add_image_size( 'tiny', 180 );

set_post_thumbnail_size( 600, array( 'top', 'left')  );

function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');