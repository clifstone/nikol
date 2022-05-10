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
            $link = get_the_permalink();
            $etsylink = get_post_meta($id, "etsylink", true);
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

            $mcRand = rand( 0 , 999999 );

            $wrapperstart = '<div class="postsection '.$helperclass.' aboutsection" data-id="'.$mcRand.'"><div class="wrapper">';
            $wrapperend = '</div></div>';
            
            $thepicture = '
            <picture>
                <source media="(min-width: 1920px)" srcset="'.$mcThumb_exlarge[0].'">
                <source media="(min-width: 1366px)" srcset="'.$mcThumb_large[0].'">
                <source media="(min-width: 768px)" srcset="'.$mcThumb_medium[0].'">
                <source media="(min-width: 320px)" srcset="'.$mcThumb_small[0].'">
                <img src="'.$mcThumb_tiny[0].'" alt="'.$thmbalt.'" loading="lazy">
            </picture>
            ';

            $thumb = '
            <div class="thumb-wrapper">
                <div class="wrapper">
                    <figure class="thumb has-sizer" style="--thAs:'.$thas.'%">
                        <div class="wrapper">
                            '.$thepicture.'
                        </div>
                    </figure>
                </div>
            </div>
            
            ';

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
                '.$thumb.'
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