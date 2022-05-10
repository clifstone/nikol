<?php
function theme_option_page(){ ?>

    <div class="wrap">
        <header>
            <h1>Theme Settings</h1>
        </header>

        <div class="settings-tab">
            <form method="post" action="options.php">
                <?php
                    settings_fields("logo_option");
                    do_settings_sections("logo-options");
                    submit_button();
                ?>
            </form>
        </div>

        <div class="settings-tab">
        <form method="post" action="options.php">
                <?php
                    settings_fields("sidebarlogo_option");
                    do_settings_sections("sidebarlogo-options");
                    submit_button();
                ?>
            </form>
        </div>
        
        <div class="settings-tab">
            <form method="post" action="options.php">
                <?php
                    settings_fields("social_options");
                    do_settings_sections("social-options");
                    submit_button();
                ?>
            </form>
        </div>
        
        
        <div class="gtag-tab">
            <form method="post" action="options.php">
                <?php
                    settings_fields("gtag_section");
                    do_settings_sections("gtag-code");
                    submit_button();
                ?>
            </form>
            
        </div>
        
        <footer>

        </footer>
    </div>

<?php }
include "mastheadlogo.php";
include "sidebarlogo.php";
include "social.php";
include "analytics.php";

function add_theme_menu_item(){
    add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-settings", "theme_option_page", null, 99);
}
add_action("admin_menu", "add_theme_menu_item");