<?php

/**
 * This file is used to initialize the theme.
 *
 * @package _s
 */

add_theme_support('align-wide'); // Enables support for wide alignment class for Gutenberg blocks.
add_theme_support('automatic-feed-links'); // Enables post and comment RSS feed links to head.
add_theme_support('custom-logo'); // Adds theme support for custom logo.
add_theme_support('customize-selective-refresh-widgets'); // Adds theme support for selective refresh for widgets.
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script')); // Adds theme support for HTML5 markup.
add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio')); // Adds theme support for post formats.
add_theme_support('post-thumbnails'); // Adds theme support for featured images.
add_theme_support('responsive-embeds'); // Adds theme support for responsive embedded content.
add_theme_support('title-tag'); // Adds theme support for title tag.
add_theme_support('wp-block-styles'); // Adds support for editor styles.

require_once('includes/custom-functions.php'); // Loads custom functions.
require_once('includes/enqueue.php'); // Loads theme styles and scripts.
require_once('includes/livesearch.php'); // Loads live search functions.
require_once('includes/register.php'); // Loads register scripts.
require_once('includes/templates.php'); // Loads theme templates.
require_once('includes/walker.php'); // Loads custom walker functions.
require_once('includes/breadcrumbs.php'); // Loads breadcrumbs functions.