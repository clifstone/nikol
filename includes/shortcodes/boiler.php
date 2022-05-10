<?php
function shortcodename_func( $atts ) {

    extract(shortcode_atts(array(
        'howmany' => '',
        'post_type' => 'post',
        'category_name' => '',
        'tag_name' => '',
        'order' => 'date',
        'hasexcerpt' => 'false',
        'usehtwo' => '',
        'usehthree' => 'true',
        'usehfour' => '',
        'noheader' => '',
        'nofooter' => '',
        'helperclass' => '',
        'loadmoreonclick' => null,
        'loadmoreonscroll' => null,
    ), $atts));

    $mcRand = rand( 0 , 999999 );
    $x = 0;

    ($howmany) ? ($numof = $howmany) : ($numof = -1);

    $args = array(
        'posts_per_page' => $numof,
        'post_type' => $post_type,
        'category_name' => $category_name,
        'tag' => $tag_name,
        'order' => $order
    );
     
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
        }
    }
    wp_reset_postdata();
}

add_shortcode( 'shortcodename', 'shortcodename_func' );