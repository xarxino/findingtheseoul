<?php

/**
 * This function enqueues the necessary scripts and styles for the Finding the Seoul theme.
 */
function enqueue_findingtheseoul_assets()
{
    // Enqueue the bundled CSS file, if it exists
    if (file_exists(get_stylesheet_directory() . '/assets/dist/main.css')) {
        wp_enqueue_style('findingtheseoul-style', get_stylesheet_directory_uri() . '/assets/dist/main.css', array(), null);
    }

    // Enqueue the bundled JavaScript file, if it exists
    if (file_exists(get_stylesheet_directory() . '/assets/dist/main.js')) {
        wp_enqueue_script('findingtheseoul-script', get_stylesheet_directory_uri() . '/assets/dist/main.js', array(), null, true);
    }

    // Enqueue the theme's Google Fonts.
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Marcellus&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(),
        null
    );
}

add_action('wp_enqueue_scripts', 'enqueue_findingtheseoul_assets');

function enqueue_dashicons()
{
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'enqueue_dashicons');


/**
 * This function adds Livesearch to the website.
 */

function enqueue_livesearch_assets()
{
    // Pass data to the 'livesearch-ajax-script' script using the 'wp_localize_script()' function.
    wp_localize_script('livesearch-ajax-script', 'livesearch_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_livesearch_assets');
