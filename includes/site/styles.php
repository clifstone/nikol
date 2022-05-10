<?php

function loadstyles() {
    global $template_directory;
    $stylever = '1.0.0';
    echo '<link rel="preload" href="'.$template_directory.'/assets/css/own-carousel.min.css?v='.$stylever.'" as="style"  onload="this.rel=\'stylesheet\'" >';
    echo '<link rel="preload" href="'.$template_directory.'/assets/css/sitestyles.css?v='.$stylever.'" as="style"  onload="this.rel=\'stylesheet\'" >';
    echo '<link rel="preload" href="'.$template_directory.'/assets/fonts/baseicons/style.min.css?v='.$stylever.'" as="style"  onload="this.rel=\'stylesheet\'" >';
}
add_action( 'wp_head', 'loadstyles', 4);