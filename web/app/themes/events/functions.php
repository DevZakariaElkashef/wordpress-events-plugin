<?php


// Hook to load styles and scripts properly
function events_theme_assets()
{
    // Load the custom CSS file from the child theme's CSS folder
    wp_enqueue_style('events-style', get_stylesheet_directory_uri() . '/css/styles.css');

    // Load Bootstrap JS from the CDN
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), null, true);

    // Load your custom JS file from the child theme
    wp_enqueue_script('events-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), null, true);
}

// Hook the function to the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'events_theme_assets');
