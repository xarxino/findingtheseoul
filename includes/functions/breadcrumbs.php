<?php
function theme_breadcrumbs()
{
    $delimiter = '<i class="text-gray-400 ph ph-caret-right"></i>    ';
    $home = '<i class="ph ph-house"></i>';
    $currentBefore = '<span class="font-medium text-red-700">';
    $currentAfter = '</span>';

    global $post;
    $output = '';
    $homeLink = get_bloginfo('url');

    if (is_home() || is_front_page()) {
        return '<a href="' . $homeLink . '">' . $home . '</a>';
    }

    $output .= '<a href="' . $homeLink . '">' . $home . '</a>' . $delimiter;

    if (is_single() && !is_attachment()) {
        $cat = get_the_category();
        if ($cat) {
            $cat = $cat[0];
            $output .= get_category_parents($cat, TRUE, $delimiter);
        }
        $output .= $currentBefore;
        $output .= get_the_title();
        $output .= $currentAfter;
    } elseif (is_category()) {
        $cat = get_queried_object();
        if ($cat->parent != 0) {
            $output .= get_category_parents($cat->parent, TRUE, $delimiter);
        }
        $output .= $currentBefore;
        $output .= single_cat_title('', FALSE);
        $output .= $currentAfter;
    } elseif (is_page() && !$post->post_parent) {
        $output .= $currentBefore;
        $output .= get_the_title();
        $output .= $currentAfter;
    } elseif (is_page() && $post->post_parent) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_post($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) {
            $output .= $crumb . $delimiter;
        }
        $output .= $currentBefore;
        $output .= get_the_title();
        $output .= $currentAfter;
    } elseif (is_search()) {
        $search_query = get_search_query();
        $total_results = $wp_query->found_posts;
        if ($search_query) {
            $output .= $currentBefore . 'Search results for "' . $search_query . '"' . $currentAfter;
        } else {
            $output .= $currentBefore . 'You didn\'t enter a search term.' . $currentAfter;
        }

        // Check if search query has any results
        if ($total_results == 0) {
            $output .= $currentBefore . 'No results found for "' . $search_query . '"' . $currentAfter;
        }
    } elseif (is_tag()) {
        $output .= $currentBefore . 'Posts tagged "' . single_tag_title('', FALSE) . '"' . $currentAfter;
    } elseif (is_author()) {
        $author = get_queried_object();
        $output .= $currentBefore . 'Articles posted by ' . $author->display_name . $currentAfter;
    } elseif (is_404()) {
        $output .= $currentBefore . 'Error 404' . $currentAfter;
    }

    return $output;
}
