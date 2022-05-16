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
        'nocontrols' => false
    ), $atts));

    $mcRand = rand( 0 , 999999 );
    $x = 0;

    ($nocontrols) ? ( $controls = '' ) : ( $controls = '<div class="own-carousel__control supergallery-overlay-controls"><button id="carousel_prev-'.$mcRand.'" class="control__prev controlbtn prev"><div class="wrapper"><i class="i-chevron-thin-left"></i></div></button><button id="carousel_next-'.$mcRand.'" class="control__next controlbtn next"><div class="wrapper"><i class="i-chevron-thin-right"></i></div></button></div><button class="controlbtn closebtn"><div class="wrapper"><i class="i-close"></i></div></button>' );

    $wrapperstart = '<div class="supergallery" data-id="'.$mcRand.'"><div class="wrapper">';
    $wrapperend = '</div></div>';
    $overlaystart = '<div id="supergallery-overlay-'.$mcRand.'" class="supergallery-overlay" data-id="'.$mcRand.'"><div class="wrapper"><div id="carousel-'.$mcRand.'" class="own-carousel__container" style="--width:100%"><div class="own-carousel__outer"><div class="own-carousel">';
    $overlayend = '</div></div></div></div>'.$controls.'</div>';

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
                    '.$thepicture.'
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
            <div class="own-carousel__item">
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
        echo '
        <script>
            window.addEventListener("load", () => {

                let theCarousel = document.querySelector("#carousel-'.$mcRand.'"),
                    carouselPrevBtn = document.querySelector("#carousel_prev-'.$mcRand.'"),
                    carouselNextBtn = document.querySelector("#carousel_next-'.$mcRand.'");

                theCarousel.ownCarousel({
                    itemPerRow:1, 
                    itemWidth:100,
                    loop:true
                });

                responsive();

                carouselPrevBtn.addEventListener("click", () => {
                    theCarousel.moveSlide(-1);
                });
                carouselNextBtn.addEventListener("click", () => {
                    theCarousel.moveSlide(1);
                    console.log(theCarousel.index);
                });
                
            });
        </script>
        ';

    }, 10001);

    return $wrapperstart.$galleryarticles.$wrapperend;

}

add_shortcode( 'supergallery', 'supergallery_func' );