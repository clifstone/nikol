<?php
function aboutsection_func( $atts ) {

    extract(shortcode_atts(array(
        'posttype' => 'aboutsection',
        'helperclass' => ''
    ), $atts));

    $args = array(
        'post_type' => $posttype,
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    $sectionwrapperstart = '<section id="aboutsections" class="aboutsections"><div class="wrapper">';
    $sectionwrapperend = '</div></section>';
    
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $id = get_the_id();
            $title = get_the_title();

            include get_template_directory().'/includes/frags/thumb.php';

            $mcRand = rand( 0 , 999999 );

            $wrapperstart = '<div class="postsection '.$helperclass.' aboutsection" data-id="'.$mcRand.'"><div class="wrapper">';
            $wrapperend = '</div></div>';

            ob_start();
                the_content();
                $thecontent = ob_get_contents();
            ob_end_clean();

            $postsection .= '
            '.$wrapperstart.'
            <div class="section-title">
                <h2>'.$title.'</h2>
            </div>
            <div class="grid">
                <div class="thumb-wrapper">
                    <div class="wrapper">
                        '.$thumb.'
                    </div>
                </div>
                <div class="the-content">
                    <div class="wrapper">
                        '.$thecontent.'
                    </div>
                </div>
            </div>
            '.$wrapperend.'
            ';

        }
    }
    wp_reset_postdata();

    return $sectionwrapperstart.$postsection.$sectionwrapperend;

}

add_shortcode( 'aboutsection', 'aboutsection_func' );