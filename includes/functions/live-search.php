<?php

/**
 * This function adds Livesearch to the website.
 */

// Enqueue the JavaScript file
function livesearch_enqueue_scripts()
{

    wp_enqueue_script('livesearch-js', get_stylesheet_directory_uri() . '/assets/src/modules/livesearch.js', array(), '1.0.0', true);

    // Pass data to the 'livesearch-ajax-script' script using the 'wp_localize_script()' function.
    wp_localize_script('livesearch-ajax-script', 'livesearch_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    $categories_page_id = 1; // Replace this with the ID of your categories page
    $tags_page_id = 2; // Replace this with the ID of your tags archive page

    wp_localize_script('livesearch-js', 'livesearch_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'post_archive_link' => get_post_type_archive_link('post'),
        'categories_archive_link' => get_permalink($categories_page_id),
        'tags_archive_link' => get_permalink($tags_page_id),
    ));
}

add_action('wp_enqueue_scripts', 'livesearch_enqueue_scripts');

/**
 * This function handles the AJAX request for live search.
 */
function livesearch()
{
    // Sanitize the search query parameter.
    $query = sanitize_text_field($_GET['query']);

    // Fetch posts that match the search query.
    $post_args = array(
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
        's' => $query,
        'posts_per_page' => -1,
    );

    $post_query = new WP_Query($post_args);
    $posts = array();

    if ($post_query->have_posts()) {
        // Loop through the posts and add them to the $posts array.
        while ($post_query->have_posts()) {
            $post_query->the_post();
            $posts[] = array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            );
        }
        wp_reset_postdata();
    }

    // Fetch categories that match the search query.
    $category_args = array(
        'taxonomy' => 'category',
        'name__like' => $query,
        'exclude' => array(get_cat_ID('Uncategorized')),
    );

    $categories = get_terms($category_args);
    $category_results = array();

    foreach ($categories as $category) {
        $category_results[] = array(
            'name' => $category->name,
            'url' => get_category_link($category->term_id),
        );
    }

    // Fetch tags that match the search query.
    $tag_args = array(
        'taxonomy' => 'post_tag',
        'name__like' => $query,
    );

    $tags = get_terms($tag_args);
    $tag_results = array();

    foreach ($tags as $tag) {
        $tag_results[] = array(
            'name' => $tag->name,
            'url' => get_tag_link($tag->term_id),
        );
    }

    // Fetch pages that match the search query.
    $page_args = array(
        'post_type' => 'page',
        'post_status' => 'publish',
        's' => $query
    );

    $page_query = new WP_Query($page_args);
    $pages = array();

    if ($page_query->have_posts()) {
        // Loop through the pages and add them to the $pages array.
        while ($page_query->have_posts()) {
            $page_query->the_post();
            $pages[] = array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            );
        }
        wp_reset_postdata();
    }

    // Send a JSON response with the search results.
    wp_send_json_success(
        array(
            'posts' => $posts,
            'categories' => $category_results,
            'tags' => $tag_results,
            'pages' => $pages,
        )
    );
}

add_action('wp_ajax_livesearch', 'livesearch');
add_action('wp_ajax_nopriv_livesearch', 'livesearch');
