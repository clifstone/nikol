<?php
function sidebarlogo_section_description(){
    echo '<h3 style="border-bottom:1px solid rgba(0,0,0,0.3); padding:32px 0 8px; margin:8px 0 0">Sidebar Logo</h3>';
}

function render_sidebarlogo($args){
    $asidestr = implode($args);
    switch($asidestr){
        case 'asideLogURL': ?>
            <div class="aside-img-box">
                <?php if(get_option('sidebarlogo_url')){ ?>
                    <img id="sidebarlogo_img" src="<?php echo get_option('sidebarlogo_url'); ?>" alt="" />
                <?php }else{ ?>
                    <img id="sidebarlogo_img" src="<?php echo get_template_directory_uri(); ?>/images/upload-placeholder.png" alt="" />
                <?php } ?>
            </div>
            
            <input type="text" name="sidebarlogo_url" id="sidebarlogo_url" value="<?php echo get_option('sidebarlogo_url'); ?>" />
            <input type="file" name="sidebarlogo_file" id="sidebarlogo_file">
            <input type="submit" id="sidebarlogo_uploadimg" name="sidebarlogo_upload" onclick="uploadSidebarlogo();return false;" value="UPLOAD">
            <script>

                function uploadSidebarlogo(){
                    var formData = new FormData();
                    formData.append("action", "upload-attachment");

                    var asideFileInputElement = document.getElementById("sidebarlogo_file");

                    formData.append("async-upload", asideFileInputElement.files[0]);
                    formData.append("name", asideFileInputElement.files[0].name);

                    <?php $aside_nonce = wp_create_nonce('media-form'); ?>
                    formData.append("_wpnonce", "<?php echo $aside_nonce; ?>");

                    var asidexhr = new XMLHttpRequest();
                        asidexhr.onreadystatechange=function(){
                            if (asidexhr.readyState==4 && asidexhr.status==200){
                                var asideDerples = JSON.parse(asidexhr.responseText),
                                    asideFartles = asideDerples.data.url;
                                document.getElementById('sidebarlogo_url').value = asideFartles;
                                document.getElementById('sidebarlogo_img').src = asideFartles;
                            }
                        }

                    asidexhr.open("POST","<?php echo admin_url(); ?>async-upload.php",true);
                    asidexhr.send(formData);
                }

            </script>
        <?php break;
    }
}

function add_sidebarlogo_setting(){
    add_settings_section( 'sidebarlogo_section', '', 'sidebarlogo_section_description', 'sidebarlogo-options');
    add_settings_field('sidebarlogo_url', '', 'render_sidebarlogo', 'sidebarlogo-options', 'sidebarlogo_section', $args = array('asideLogURL'));
    register_setting( 'sidebarlogo_option', 'sidebarlogo_url');
}
add_action('admin_init','add_sidebarlogo_setting');