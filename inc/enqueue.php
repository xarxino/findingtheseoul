<?php


// Enqueue main.js
function enqueue_findingtheseoul_assets()
{
    wp_enqueue_script('findingtheseoul-bundle', get_theme_file_uri('/assets/dist/bundle.js'), null, '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_findingtheseoul_assets');
