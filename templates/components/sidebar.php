<?php
$categories = get_categories(array(
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false,
    'parent' => 0,
));

if (!empty($categories)) :
?>
    <aside class="w-full h-full min-w-[200px] max-w-[250px] flex flex-col gap-8 ">
        <h3>Categories</h3>
        <div class="flex flex-col gap-8">
            <?php foreach ($categories as $category) :
                if ($category->name == 'Uncategorized') continue; // skip Uncategorized category
                $subcategories = get_categories(array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => false,
                    'parent' => $category->term_id,
                ));
            ?>
                <div class="flex flex-col gap-4">
                    <h5><?= $category->name ?></h5>
                    <?php if (empty($subcategories)) : ?>
                        <p class="text-zinc-400">No subcategories found.</p>
                    <?php else : ?>
                        <ul class="flex flex-col gap-2">

                            <?php $current_category = get_queried_object();
                            foreach ($subcategories as $subcategory) : ?>
                                <li>
                                    <a href="<?= get_category_link($subcategory->term_id) ?>" <?= $subcategory->term_id === $current_category->term_id ? 'class="font-medium text-red-700"' : '' ?>>
                                        <?= $subcategory->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </aside>
<?php endif; ?>