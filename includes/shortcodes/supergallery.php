<?php
function supergallery_func( $atts ) {

    extract(shortcode_atts(array(
        'howmany' => '-1',
        'posttype' => 'post',
        'categoryname' => '',
        'tagname' => '',
        'order' => 'date',
        'hasexcerpt' => false,
        'fullitemexcerpt' => false,
        'usehtwo' => '',
        'usehthree' => 'true',
        'usehfour' => '',
        'helperclass' => '',
        'loadmoreonclick' => null,
        'loadmoreonscroll' => null,
        'gridtype' => '',
        'listlabel' => '',
        'ctatext' => '',
        'overlayctatxt' => '',
        'nocontrols' => null
    ), $atts));

    $mcRand = rand( 0 , 999999 );
    $x = 0;

    ($nocontrols) ? ( $controls = '' ) : ( $controls = '<div class="supergallery-overlay-controls" data-glide-el="controls"><button id="carousel_prev-'.$mcRand.'" class="controlbtn prev" data-glide-dir="<"><div class="wrapper"><i class="i-chevron-thin-left"></i></div></button><button id="carousel_next-'.$mcRand.'" class="controlbtn next" data-glide-dir=">"><div class="wrapper"><i class="i-chevron-thin-right"></i></div></button></div>' );

    $wrapperstart = '<div class="supergallery" data-id="'.$mcRand.'"><div class="wrapper">';
    $wrapperend = '</div></div>';
    $carouselcontainersstart = '<div id="carousel-'.$mcRand.'" class="glide" style="--width:100%"><div class="glide__track" data-glide-el="track"><div class="glide__slides">';
    $carouselcontainersend = '</div>'.$controls.'</div></div>';
    $overlaystart = '<div id="supergallery-overlay-'.$mcRand.'" class="supergallery-overlay" data-id="'.$mcRand.'"><div class="wrapper">'.$carouselcontainersstart.'';
    $overlayend = ''.$carouselcontainersend.'</div><button class="controlbtn closebtn"><div class="wrapper"><i class="i-close"></i></div></button></div>';

    $args = array(
        'posts_per_page' => $howmany,
        'post_type' => $posttype,
        'category_name' => $categoryname,
        'tag' => $tagname,
        'orderby' => $order
    );
     
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $id = get_the_id();
            $title = get_the_title();
            $link = get_the_permalink();
            $etsylink = get_post_meta($id, "etsylink", true);
            

            ($hasexcerpt) ? ($itemexcerpt = '<div class="excerpt"><p>'.get_the_excerpt().'</p></div>') : ($itemexcerpt = '');
            ($fullitemexcerpt) ? ($fullitemexcerpt = '<div class="excerpt"><p>'.get_the_excerpt().'</p></div>') : ($fullitemexcerpt = '');
            ($ctatxt) ? ($cta = '<div class="cta"><span>'.$ctatxt.'</span></div>') : ($cta = '');
            ($overlayctatxt) ? ($overlayctatxt) : ($overlayctatxt = 'Buy Now On Etsy');

            ($etsylink) ? ($buynowbtn = '<button class="cta buynow"><a href="'.$etsylink.'" target="_blank" name="Buy '.$title.' Now On Etsy"><span>'.$overlayctatxt.'</span><i class="i-etsy"></i></a></button>') : ($buynowbtn = '');

            include get_template_directory().'/includes/frags/thumb.php';

            $gallerythumb = '
            <figure class="thumb gallery-thumb">
                <div class="wrapper">
                    <picture>
                        <source media="(min-width: 1920px)" srcset="'.$mcThumb_exexlarge[0].'">
                        <source media="(min-width: 1366px)" srcset="'.$mcThumb_exlarge[0].'">
                        <img src="'.$mcThumb_medium[0].'" alt="'.$thmbalt.'" loading="lazy">
                    </picture>
                </div>
            </figure>
            ';

            $galleryarticles .= '
            <article class="gallery-item '.$format.'" data-num="'.$x.'" data-id="'.$mcRand.'" style="--order: '.$x.'">
                <div class="wrapper">
                    <div class="thumb-wrapper">
                        <i class="i-zoom-in1"></i>
                        '.$thumb.'
                    </div>
                    <div class="item-body">
                        <div class="wrapper">
                            <h3 aria-label="'.$title.'" title="'.$title.'"><span>'.$title.'</span></h3>
                            '.$itemexcerpt.'
                            '.$cta.'
                        </div>
                    </div>
                </div>
            </article>
            ';

            $fullgalleryimage .= '
            <div class="glide__slide">
                <div class="overlay-item '.$format.'">
                    <div class="wrapper">
                        '.$gallerythumb.'
                        <div class="item-body">
                            <div class="wrapper">
                                <h3 aria-label="'.$title.'" title="'.$title.'"><span>'.$title.'</span></h3>
                                '.$fullitemexcerpt.'
                                '.$buynowbtn.'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            
            $x++;
        }
    }
    wp_reset_postdata();

    add_action( 'wp_footer', function() use ($overlaystart, $fullgalleryimage, $overlayend, $mcRand) {
        echo $overlaystart.$fullgalleryimage.$overlayend;


    }, 10001);

    return $wrapperstart.$galleryarticles.$wrapperend;

}

add_shortcode( 'supergallery', 'supergallery_func' );