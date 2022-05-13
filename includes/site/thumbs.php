<?php

function wpdocs_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'exex-large', 2048 );
    add_image_size( 'ex-large', 1920 );
    add_image_size( 'large', 1536 );
    add_image_size( 'medium', 1024 );
    add_image_size( 'small', 600 );
    add_image_size( 'extra-small', 338 );
    add_image_size( 'tiny', 180 );
    set_post_thumbnail_size( 600, array( 'top', 'left')  );
}
add_action( 'after_setup_theme', 'wpdocs_theme_setup' );

function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');