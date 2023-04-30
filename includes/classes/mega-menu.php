<?php

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{
    // override the start_lvl method to customize the sub-menu HTML markup
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\" flex flex-col gap-2\">\n";
    }

    // override the start_el method to customize the list item HTML markup
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        if ($depth == 0) {
            $output .= $indent . '<li class="flex flex-col gap-4">';
            $output .= '<span class="text-2xl font-display">' . $item->title . '</span>';
        } else {
            $output .= $indent . '<li>';
            $output .= '<a href="' . $item->url . '">' . $item->title . '</a>';
        }
    }
}
