<?php
function appearances_func( $atts ) {

    extract(shortcode_atts(array(
        'posttype' => 'appearancessection',
        'helperclass' => ''
    ), $atts));

    $args = array(
        'post_type' => $posttype,
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    $sectiontitle = '
    <div class="section-title">
        <h2>Upcoming Apperances</h2>
    </div>
    ';

    $sectionwrapperstart = '<section id="appearancesections" class="appearancesections">'.$sectiontitle.'<div class="wrapper">';
    $sectionwrapperend = '</div></section>';
    
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $id = get_the_id();
            $title = get_the_title();
            $appearancedate = get_post_meta($id, "appearancedate", true);
            $appearancelivelink = get_post_meta($id, "appearancelink", true);

            include get_template_directory().'/includes/frags/thumb.php';

            $mcRand = rand( 0 , 999999 );

            $wrapperstart = '<div class="postsection '.$helperclass.' '.$posttype.' appearance" data-id="'.$mcRand.'"><div class="wrapper">';
            $wrapperend = '</div></div>';

            $appearancetitle = '
            <div class="appearancetitle">
                <h3>'.$title.'</h3>
            </div>';

            $theappearancedate = '
            <time class="appearancedate">
                <span>'.$appearancedate.'</span>
            </time>
            ';

            $appearancelink = '
            <a href="'.$appearancelivelink.'" target="_blank" rel="noopener" class="appearancelink">
                <span>Click here for more info</span>
            </a>';

            $postsection .= '
            '.$wrapperstart.'
                '.$thumb.'
                <div class="the-content">
                    <div class="wrapper">
                        '.$theappearancedate.'
                        '.$appearancetitle.'
                        '.$appearancelink.'
                    </div>
                </div>

            '.$wrapperend.'
            ';

        }
    }
    wp_reset_postdata();

    return $sectionwrapperstart.$postsection.$sectionwrapperend;

}

add_shortcode( 'appearances', 'appearances_func' );