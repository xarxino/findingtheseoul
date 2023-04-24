<?php
$separator = '<span class="dashicons dashicons-arrow-right"></span>';
?>

<ul class="flex items-center gap-4 py-4">
    <li>
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <span class="dashicons dashicons-admin-home"></span>
        </a>
    </li>
    <?php if (is_category()) : ?>
        <?php $category = get_queried_object(); ?>
        <?php if ($category->parent) : ?>
            <?php
            $ancestors = get_ancestors($category->cat_ID, 'category');
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) :
                $ancestor_category = get_category($ancestor);
                $catlink = get_category_link($ancestor);
                echo '<li>' . $separator . '</li>';
                echo '<li><a href="' . esc_url($catlink) . '">' . $ancestor_category->name . '</a></li>';
            endforeach;
            ?>
        <?php endif; ?>
        <li>
            <?php single_cat_title(); ?>
        </li>
    <?php elseif (is_single()) : ?>
        <?php
        $categories = get_the_category();
        $matched_category = null;
        foreach ($categories as $category) {
            if (cat_is_ancestor_of($category->cat_ID, get_queried_object_id())) {
                $matched_category = $category;
                break;
            }
        }
        if ($matched_category) :
            $catlink = get_category_link($matched_category->term_id);
            echo '<li>' . $separator . '</li>';
            echo '<li><a href="' . esc_url($catlink) . '">' . $matched_category->name . '</a></li>';
        endif;
        ?>
        <li>
            <?php echo esc_html(get_the_title()); ?>
        </li>
    <?php elseif (is_page()) : ?>
        <?php
        if (isset($post) && $post->post_parent) :
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) :
                echo '<li>' . $separator . '</li>';
                echo '<li><a href="' . get_permalink($ancestor) . '">' . esc_html(get_the_title($ancestor)) . '</a></li>';
            endforeach;
        endif;
        ?>
        <li>
            <?php echo esc_html(get_the_title()); ?>
        </li>
    <?php endif; ?>
</ul>