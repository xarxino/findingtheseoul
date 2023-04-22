<?php

/**
 * This function modifies the template file path to look for template files in the 'templates' directory.
 *
 * @param string $template The original template file path.
 * @return string The modified template file path.
 */
function custom_template_folder($template)
{
    $new_template = null;

    $templates = array(
        'single' => array('templates/single.php', 'single.php'),
        'archive' => array('templates/archive.php', 'archive.php'),
        'front_page' => array('templates/front-page.php', 'front-page.php'),
        'page' => array('templates/page.php', 'page.php'),
        'search' => array('templates/search.php', 'search.php')
    );

    foreach ($templates as $type => $template_files) {
        if (call_user_func("is_$type")) {
            $new_template = locate_template($template_files, false);
            break;
        }
    }

    if ($new_template) {
        return $new_template;
    }

    return $template;
}
add_filter('template_include', 'custom_template_folder', 99);