<?php
function my_theme_breadcrumbs()
{
    $separator = '<span class="mx-2 text-gray-400">&#x2F;</span>'; // separator HTML
    $home_text = '<span class="dashicons dashicons-admin-home"></span>'; // icon for the 'Home' link
    $show_current = true; // whether to show the current page in the breadcrumbs
    $before = '<span class="font-bold">'; // HTML before the current page
    $after = '</span>'; // HTML after the current page
    $arrow_icon = '<span class="mx-4 text-gray-400 dashicons dashicons-arrow-right-alt2"></span>'; // arrow icon HTML
    $breadcrumb_classes = 'py-4 text-gray-400 hover:text-gray-600'; // classes for the breadcrumb links
    $breadcrumb_container_classes = 'text-gray-600 text-sm font-medium flex items-center'; // classes for the breadcrumb container

    global $post;
    $ancestors = array();
    if ($post) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
    }

    $current_index = 0; // variable to keep track of current breadcrumb index

    echo '<nav class="' . $breadcrumb_container_classes . '">';

    // Add Home breadcrumb
    echo '<a href="' . get_home_url() . '" class="' . $breadcrumb_classes . '">' . $home_text . '</a>' . $arrow_icon;

    // Add category breadcrumbs (if applicable)
    if (is_category() || is_single()) {
        $categories = array();
        if (is_single()) {
            $categories = get_the_category();
        } elseif (is_category()) {
            $categories[] = get_queried_object();
        }

        if (!empty($categories)) {
            $visited = array();
            foreach ($categories as $index => $category) {
                if (in_array($category->term_id, $visited)) {
                    continue;
                }

                // Get direct parent category
                $parent_category = $category;
                if ($parent_category->parent != 0) {
                    $parent_category = get_category($parent_category->parent);
                }

                if (!in_array($parent_category->term_id, $visited)) {
                    $visited[] = $parent_category->term_id;
                    echo '<a href="' . get_category_link($parent_category->term_id) . '" class="' . $breadcrumb_classes . '">' . $parent_category->name . '</a>' . $arrow_icon;
                }

                // Display associated child category if it's not the direct parent
                if ($parent_category->term_id != $category->term_id && !in_array($category->term_id, $visited)) {
                    $visited[] = $category->term_id;
                    echo '<a href="' . get_category_link($category->term_id) . '" class="' . $breadcrumb_classes . '">' . $category->name . '</a>' . $arrow_icon;
                }
            }
        }
    } elseif (is_archive()) {

        // Add the archive title as a breadcrumb
        $archive_title = get_the_archive_title();
        if (!empty($archive_title)) {
            echo $before . $archive_title . $after;
        }
    } // Add ancestor breadcrumbs
    foreach ($ancestors as $index => $ancestor) {
        $current_index++;
        if (!is_single($ancestor) && !is_page($ancestor)) {
            echo '<a href="' . get_permalink($ancestor) . '" class="' . $breadcrumb_classes . '">' . get_the_title($ancestor) . '</a>';
        }
        // Add chevron icon if it's not the last breadcrumb
        if ($current_index < count($ancestors)) {
            echo $arrow_icon;
        }
    }

    // Add current page breadcrumb
    if (is_single() && $show_current || is_page() && $show_current) {
        echo $before . get_the_title() . $after;
    }

    echo '</nav>';
}
// Add the breadcrumb function to the tha_content_while_before hook
add_action('tha_content_while_before', 'my_theme_breadcrumbs');
