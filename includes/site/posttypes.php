<?php
function about() {

    $labels = array(
        'name'                => _x( 'About Sections', 'Post Type General Name', '' ),
        'singular_name'       => _x( 'About Section', 'Post Type Singular Name', '' ),
        'menu_name'           => __( 'About Sections', '' ),
        'parent_item_colon'   => __( 'Parent About Section', '' ),
        'all_items'           => __( 'All About Sections', '' ),
        'view_item'           => __( 'View About Section', '' ),
        'add_new_item'        => __( 'Add New About Section', '' ),
        'add_new'             => __( 'Add About Section', '' ),
        'edit_item'           => __( 'Edit About Section', '' ),
        'update_item'         => __( 'Update About Section', '' ),
        'search_items'        => __( 'Search About Section', '' ),
        'not_found'           => __( 'Not Found', '' ),
        'not_found_in_trash'  => __( 'Not found in Trash', '' ),
    );
        
    $args = array(
        'label'               => __( 'About Section', '' ),
        'description'         => __( 'About Sections', '' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
        'show_in_graphql' => true,
        'graphql_single_name' => 'AboutSection',
        'graphql_plural_name' => 'AboutSections',
    );
    register_post_type( 'AboutSection', $args );
}

function AppearancesSection() {

    $labels = array(
        'name'                => _x( 'Appearance Sections', 'Post Type General Name', '' ),
        'singular_name'       => _x( 'Appearance Section', 'Post Type Singular Name', '' ),
        'menu_name'           => __( 'Appearance Sections', '' ),
        'parent_item_colon'   => __( 'Parent Appearance Section', '' ),
        'all_items'           => __( 'All Appearance Sections', '' ),
        'view_item'           => __( 'View Appearance Section', '' ),
        'add_new_item'        => __( 'Add New Appearance Section', '' ),
        'add_new'             => __( 'Add Appearance Section', '' ),
        'edit_item'           => __( 'Edit Appearance Section', '' ),
        'update_item'         => __( 'Update Appearance Section', '' ),
        'search_items'        => __( 'Search Appearance Section', '' ),
        'not_found'           => __( 'Not Found', '' ),
        'not_found_in_trash'  => __( 'Not found in Trash', '' ),
    );
        
    $args = array(
        'label'               => __( 'Appearance Section', '' ),
        'description'         => __( 'Appearance Sections', '' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'thumbnail', 'revisions', 'custom-fields' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
        'show_in_graphql' => true,
        'graphql_single_name' => 'AppearancesSection',
        'graphql_plural_name' => 'AppearancesSections',
    );
    register_post_type( 'AppearancesSection', $args );
}
    
    add_action( 'init', 'about', 0 );
    add_action( 'init', 'AppearancesSection', 0 );