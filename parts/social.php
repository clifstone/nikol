<?php

$socialexpander = '<button class="social-expander headerbtn" aria-label="Click here to expand the '.get_bloginfo().' '.$iconname.' social panel"><div class="wrapper"><i class="i-dots-three-horizontal"></i></div></button>';
$socialbegin = '<div class="social"><div class="socialbtns-container">'.$socialexpander.'<div class="socialbtns">';
$socialend = '</div></div></div>';

ob_start();
$socialopts = array(array('fb_url','fb', 'facebook'), array('tw_url', 'tw', 'twitter'), array('ig_url', 'ig', 'instagram'), array('et_url', 'et', 'etsy'), array('pt_url', 'pt', 'pinterest'), array('yt_url', 'yt', 'youtube'));

function printSocialBtn($url, $classname, $iconname){
    echo '<a href="'.get_option($url).'" target="_blank" rel="nofollow noopener noreferrer"  class="socialbtn '.$classname.' headerbtn" name="Click here to visit the '.get_bloginfo().' '.$iconname.' page"><span class="wrapper" class="socialbtnimg"><i class="i-'.$iconname.'"></i></span></a>';
}

foreach($socialopts as $socialopt){
    (get_option($socialopt[0])) ? printSocialBtn($socialopt[0], $socialopt[1], $socialopt[2]) : '';
}
$socialbtns = ob_get_contents();
ob_end_clean();

echo $socialbegin.$socialbtns.$socialend;