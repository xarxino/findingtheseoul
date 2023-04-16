<?php

/**
 * This function enqueues the necessary scripts and styles for the Finding the Seoul theme.
 */
function enqueue_findingtheseoul_assets()
{
    // Enqueue the 'findingtheseoul-bundle' script.
    wp_enqueue_script('findingtheseoul-bundle', get_theme_file_uri('/assets/dist/bundle.js'), null, '1.0', true);

    // Enqueue the 'findingtheseoul-style' style.
    wp_enqueue_style('findingtheseoul-style', get_theme_file_uri('/assets/dist/styles.css'), null, '1.0');

    // Enqueue Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Marcellus&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(),
        null
    );
}

add_action('wp_enqueue_scripts', 'enqueue_findingtheseoul_assets');

/**
 * This function adds Livesearch to the website.
 */

function enqueue_livesearch_assets()
{
    // Enqueue the 'livesearch-ajax-script' script, which handles live search functionality.
    wp_enqueue_script('livesearch-ajax-script', get_theme_file_uri('/assets/src/js/livesearch.js'), array('jquery'), '1.0', true);

    // Pass data to the 'livesearch-ajax-script' script using the 'wp_localize_script()' function.
    wp_localize_script('livesearch-ajax-script', 'livesearch_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_livesearch_assets');
