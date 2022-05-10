<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php
        if(!is_page_template('search.php')){ 
            echo '<meta name="robots" content="index, follow">';
        }else{
            echo '<meta name="robots" content="noindex, follow"/>';
        }

        wp_head();
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <noscript><style>body { opacity:1 }</style></noscript>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="https://schema.org/WebPage" style="opacity:0">
<script>0</script>

<div class="site-wrapper">
    
<header id="masthead" class="siteheader">
    <div class="wrapper grid">
        <?php get_template_part('parts/menubutton'); ?>
        <?php get_template_part( 'parts/sitelogo'); ?>
        <?php get_template_part( 'parts/social'); ?>
    </div>
</header>