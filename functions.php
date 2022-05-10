<?php
// error_reporting(E_ALL);
// ini_set('display_errors', true);
// ini_set('display_startup_errors', FALSE);

function stop_heartbeat() {
    wp_deregister_script('heartbeat');
}
add_action( 'init', 'stop_heartbeat', 1 );

function no_wordpress_errors(){
    return 'Oh Noes!';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

function attachment_image_link_remove_filter( $content ) {
    $content = preg_replace(array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}','{ wp-image-[0-9]*" /></a>}'),array('<img', '" />'), $content);
    return $content;
}
add_filter( 'the_content', 'attachment_image_link_remove_filter' );

function noneofthisnonsense(){
    global $post;
    //wp_deregister_script('jquery');
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'wp-block-library' );
}
add_action('wp_enqueue_scripts', 'noneofthisnonsense');

function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
   
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
   
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if( 'dns-prefetch' == $relation_type ) {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    return $urls;
}

function theme_setup() {
    add_theme_support('title-tag');
}
add_action( 'after_setup_theme', 'theme_setup' );

function get_copyright(){
    $copysymbol = '&copy;';
    $copyname = get_bloginfo('name');
    $copyyear = date('Y');
    return $copysymbol.' '.$copyname.' '.$copyyear;
}

include "includes/includes.php";