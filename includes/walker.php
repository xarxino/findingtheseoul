<?php
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{
    // function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    // {
    //     $indent = ($depth) ? str_repeat("\t", $depth) : '';

    //     $classes = empty($item->classes) ? array() : (array) $item->classes;
    //     $classes[] = 'menu-item-' . $item->ID;
    //     $classes[] = 'relative';

    //     if (in_array('menu-item-has-children', $item->classes)) {
    //         $classes[] = 'group';
    //     }

    //     $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

    //     $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
    //     $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

    //     $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
    //     $id = $id ? ' id="' . esc_attr($id) . '"' : '';

    //     $output .= $indent . '<li' . $id . $class_names . '>';

    //     $atts = array();
    //     $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
    //     $atts['target'] = !empty($item->target) ? $item->target : '';
    //     $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
    //     $atts['href'] = !empty($item->url) ? $item->url : '';

    //     $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

    //     $attributes = '';
    //     foreach ($atts as $attr => $value) {
    //         if (!empty($value)) {
    //             $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
    //             $attributes .= ' ' . $attr . '="' . $value . '"';
    //         }
    //     }

    //     $title = apply_filters('the_title', $item->title, $item->ID);
    //     $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

    //     $item_output = $args->before;
    //     $item_output .= '<a' . $attributes . ' class="flex items-center gap-2 px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-900">';
    //     $item_output .= $args->link_before . $title . $args->link_after;

    //     if (in_array('menu-item-has-children', $item->classes)) {
    //         $item_output .= '<div class="absolute top-0 right-0 pt-1 pl-1 text-gray-400 transition duration-200 ease-in-out cursor-pointer w-7 h-7 group-hover:text-gray-500">';
    //     }

    //     $item_output .= '</a>';
    //     $item_output .= $args->after;

    //     $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    // }

    // function start_lvl(&$output, $depth = 0, $args = array())
    // {
    //     $indent = str_repeat("\t", $depth);
    //     $output .= "\n$indent<ul class=\"pt-2 absolute left-0 hidden mt-2 w-auto bg-white rounded-md shadow-lg py-2 z-50 text-gray-700 text-sm divide-y divide-gray-100 group-hover:block min-w-[10rem]\" role=\"menu\">\n";
    // }

}