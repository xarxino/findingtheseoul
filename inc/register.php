<?php

/**
 * This function adds SVG support by modifying the upload MIME types.
 *
 * @param array $mimes An array of allowed MIME types.
 * @return array The modified array of allowed MIME types.
 */
function add_svg_support($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

// Add the custom MIME type filter.
add_filter('upload_mimes', 'add_svg_support');


/**
 * This function registers navigation menus.
 */
function register_findingtheseoul_menus()
{
    // Register the 'Primary Menu' and 'Footer Menu' navigation menus.
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'findingtheseoul'),
        'footer' => __('Footer Menu', 'findingtheseoul'),
    ));
}

// Add the custom navigation menu registration action.
add_action('init', 'register_findingtheseoul_menus');
