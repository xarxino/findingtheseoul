<?php

/********************************
 * Enqueue theme assets
 ***************************** */
function enqueue_findingtheseoul_assets()
{
    // Enqueue the theme's bundled JS file.
    wp_enqueue_script('findingtheseoul-scripts', get_template_directory_uri() . '/assets/dist/bundle.js', array(), '1.0.0', true);

    // Enqueue the theme's bundled CSS file.
    wp_enqueue_style('findingtheseoul-styles', get_template_directory_uri() . '/assets/dist/bundle.css', array(), '1.0.0');

    // Enqueue Dashicons for the backend.
    wp_enqueue_style('dashicons');

    // Enqueue the theme's Google Fonts.
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Marcellus&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(),
        null
    );
}

// Add the custom enqueue action.
add_action('wp_enqueue_scripts', 'enqueue_findingtheseoul_assets');

/********************************
 * Register navigation menus
 ***************************** */
function register_findingtheseoul_menus()
{
    // Register the 'Primary Menu' and 'Footer Menu' navigation menus.
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'findingtheseoul'),
            'footer' => __('Footer Menu', 'findingtheseoul'),
        )
    );
}

// Add the custom navigation menu registration action.
add_action('init', 'register_findingtheseoul_menus');

/********************************
 * Add SVG support
 ***************************** */
function add_svg_support($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

// Add the custom MIME type filter.
add_filter('upload_mimes', 'add_svg_support');

/********************************
 * Add theme support
 ***************************** */
add_theme_support('automatic-feed-links');
add_theme_support('custom-logo');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio'));
add_theme_support('post-thumbnails');
add_theme_support('responsive-embeds');
add_theme_support('title-tag');
add_theme_support('wp-block-styles');

// Dark mode support.
add_theme_support('dark-editor-style');
add_theme_support('dark-mode');

// Gutenberg theme support.
add_theme_support('align-wide');
add_theme_support('editor-styles');
add_theme_support('category-thumbnails');


/********************************
 * Register custom post types
 ***************************** */
function add_category_thumbnail_support()
{
    $taxonomy = 'category'; // Replace with your desired taxonomy name
    $args = get_taxonomy($taxonomy); // Get the taxonomy object
    $args->show_in_rest = true; // Make the taxonomy available in the REST API
    $args->rest_base = $taxonomy; // Set the REST API base to the taxonomy name
    $args->rest_controller_class = 'WP_REST_Terms_Controller'; // Use the WP_REST_Terms_Controller class for the REST API
    $args->thumbnail = true; // Enable support for category thumbnails
    register_taxonomy($taxonomy, 'post', (array) $args); // Register the taxonomy with the modified arguments
}

add_action('init', 'add_category_thumbnail_support', 11); // Hook the function to the init action with a priority of 11
