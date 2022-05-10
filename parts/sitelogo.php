<?php

$mastlogo = get_option('logo_url');
$sidebarlogo = get_option('sidebarlogo_url');

if( $args['logo'] === 'masthead' || $args['logo'] === null){
    $mclogo = $mastlogo;
    $mclogoclass = 'mastlogo';
}else if( $args['logo'] === 'sidebar'){
    $mclogo = $sidebarlogo;
    $mclogoclass = 'sidebarlogo';
}

echo '
<figure class="site-logo '.$mclogoclass.'">
    <a href="'.home_url().'" aria-label="'.get_bloginfo().' Homepage">
        <img class="logo-img" src="'.$mclogo.'" alt="'.get_bloginfo().' site logo" width="1" height="1" />
    </a>
</figure>
';