<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?> 
</head>

<body <?php body_class(); ?>>

<header class="my-logo">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo home_url(); ?>">The Wave</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php wp_nav_menu(array(
                    'theme_location' => 'header-menu',  
                    'menu_class' => 'navbar-nav ms-auto', 
                    'container' => false,  
                    'depth' => 2,  
                    'fallback_cb' => false, 
                )); ?>
            </div>
        </div>
    </nav>
</header>



</body>
</html>