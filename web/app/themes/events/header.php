<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php wp_title('|', true, 'right'); ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->

    <?php wp_head(); ?>
</head>

<body>

    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('/') ?>"><?= __('Events', 'events') ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                    // Check if the menu is set for the 'main_menu' location
                    if (has_nav_menu('main_menu')) :
                        wp_nav_menu(array(
                            'theme_location' => 'main_menu', // Menu location in WordPress
                            'container' => false,            // No container around the menu
                            'items_wrap' => '%3$s',          // Only the list items, no surrounding <ul>
                            'depth' => 2,                    // Allows for sub-menu support (depth = 2)
                            'fallback_cb' => false,          // Do not display a fallback if no menu is set
                            'menu_class' => 'navbar-nav ms-auto', // Custom classes for the <ul> element
                            'menu_id' => 'main-nav',         // Custom ID for the <ul> element
                            'link_class' => 'nav-link',      // Custom class for the <a> elements (menu links)
                            'items_class' => 'nav-item',     // Custom class for the <li> elements (menu items)
                        ));
                    else :
                        // Fallback if no menu is set for this location
                        echo '<li class="nav-item"><a class="nav-link" href="#">Home</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="#">About</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>';
                        echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>';
                    endif;
                    ?>
                </ul>



            </div>
        </div>
    </nav>