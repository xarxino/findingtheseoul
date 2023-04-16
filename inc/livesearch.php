<?php

/**
 * This function handles the AJAX request for live search.
 */

function my_live_search()
{
    // Sanitize the search query parameter.
    $query = sanitize_text_field($_GET['query']);

    // Fetch posts that match the search query.
    $post_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        's' => $query
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
        'name__like' => $query
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
        'name__like' => $query
    );

    $tags = get_terms($tag_args);
    $tag_results = array();

    foreach ($tags as $tag) {
        $tag_results[] = array(
            'name' => $tag->name,
            'url' => get_tag_link($tag->term_id),
        );
    }

    // Send a JSON response with the search results.
    wp_send_json_success(array(
        'posts' => $posts,
        'categories' => $category_results,
        'tags' => $tag_results
    ));
}

add_action('wp_ajax_my_live_search', 'my_live_search');
add_action('wp_ajax_nopriv_my_live_search', 'my_live_search');
