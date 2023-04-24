<?php
function post_categories()
{
    $categories = get_the_category();
    $main_category = $categories[0]; // Get the first category as the main category
    $sub_categories = array_slice($categories, 1); // Get the remaining categories as subcategories
?>
    <div class="mt-2 mb-4 text-sm text-zinc-500">
        <p>Posted in <a href="<?= esc_url(get_category_link($main_category->term_id)) ?>"><?= esc_html($main_category->name) ?></a></p>
        <?php if (!empty($sub_categories)) : ?>
            <p>Subcategories:
                <?php foreach ($sub_categories as $category) : ?>
                    <a href="<?= esc_url(get_category_link($category->term_id)) ?>" class='hover:text-red-700 hover:underline'><?= esc_html($category->name) ?></a>,
                <?php endforeach; ?>
            </p>
        <?php endif; ?>
        <p>Posted on <?= the_date() ?> by <?= the_author() ?></p>
    </div>
<?php } ?>