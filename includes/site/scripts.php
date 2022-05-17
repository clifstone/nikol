<?php

function headerscripts(){
    global $template_directory;
    echo '<link rel="preload" href="'.$template_directory.'/assets/js/inview.js" as="script">';
    echo '<link rel="preload" href="'.$template_directory.'/assets/js/postscribe.js" as="script">';
    //echo '<link rel="preload" href="'.$template_directory.'/assets/js/own-carousel.min.js" as="script">';
    echo '<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/glide.min.js" as="script">';
    echo '<link rel="preload" href="'.$template_directory.'/assets/js/base.js" as="script">';
}
add_action( 'wp_head', 'headerscripts', 3);

function footerScripts(){
    global $template_directory;
    echo '<script>!function(e){"function"==typeof define&&define.amd?define(e):e()}(function(){var e,t=["scroll","wheel","touchstart","touchmove","touchenter","touchend","touchleave","mouseout","mouseleave","mouseup","mousedown","mousemove","mouseenter","mousewheel","mouseover"];if(function(){var e=!1;try{var t=Object.defineProperty({},"passive",{get:function(){e=!0}});window.addEventListener("test",null,t),window.removeEventListener("test",null,t)}catch(e){}return e}()){var n=EventTarget.prototype.addEventListener;e=n,EventTarget.prototype.addEventListener=function(n,o,r){var i,s="object"==typeof r&&null!==r,u=s?r.capture:r;(r=s?function(e){var t=Object.getOwnPropertyDescriptor(e,"passive");return t&&!0!==t.writable&&void 0===t.set?Object.assign({},e):e}(r):{}).passive=void 0!==(i=r.passive)?i:-1!==t.indexOf(n)&&!0,r.capture=void 0!==u&&u,e.call(this,n,o,r)},EventTarget.prototype.addEventListener._original=e}});</script>';
    echo '<script async src="'.$template_directory.'/assets/js/inview.js"></script>';
    echo '<script async src="'.$template_directory.'/assets/js/postscribe.js"></script>';
    //echo '<script async src="'.$template_directory.'/assets/js/own-carousel.min.js"></script>';
    echo '<script async src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/glide.min.js"></script>';
    echo '<script async src="'.$template_directory.'/assets/js/base.js"></script>';
}
add_action( 'wp_footer', 'footerScripts', 99);