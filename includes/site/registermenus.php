<?php
function registerMenus(){

    register_nav_menus(array(
        'main_menu' => __( 'Main Menu' )
    ));

}
add_action( 'init', 'registerMenus' );