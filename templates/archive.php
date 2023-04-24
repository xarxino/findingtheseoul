<?php get_template_part('templates/layout/header'); ?>

<div class="flex">
    <main class="container flex gap-16 py-16">
        <?php
        $categories = get_categories(array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => 0,
        ));

        if (!empty($categories)) {
        ?>
            <aside class="w-full min-w-[200px] max-w-[250px] flex flex-col gap-8 sticky top-0">
                <h3>Categories</h3>
                <div class="flex flex-col gap-4">
                    <?php
                    foreach ($categories as $category) {
                        if ($category->name == 'Uncategorized') {
                            continue; // skip Uncategorized category
                        }
                    ?>
                        <h2 class="text-lg font-bold"><?php echo $category->name; ?></h2>
                        <ul class="flex flex-col gap-2">
                            <?php
                            $subcategories = get_categories(array(
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => false,
                                'parent' => $category->term_id,
                            ));

                            // Display a message if there are no subcategories
                            if (empty($subcategories)) {
                            ?>
                                <p class="text-zinc-400">No subcategories found.</p>
                                <?php
                            } else {
                                foreach ($subcategories as $subcategory) {
                                ?>
                                    <li><a href="<?php echo get_category_link($subcategory->term_id); ?>"><?php echo $subcategory->name; ?></a></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </aside>
        <?php
        }
        ?>


        <div class="flex flex-col gap-12">

            <?php
            $category = get_queried_object();
            $parent_category = get_term_by('id', $category->parent, 'category');
            ?>
            <div class="flex flex-col gap-4">
                <?php if ($parent_category) : ?>
                    <h1><?php echo $parent_category->name; ?></h1>
                    <h2 class="text-3xl text-zinc-500"><?php echo $category->name; ?></h2>
                <?php else : ?>
                    <h1><?php echo $category->name; ?></h1>
                <?php endif; ?>
                <?php if (category_description()) : ?>
                    <?php echo str_replace('<p>', '<p class="text-zinc-500">', get_term_field('description', $category->term_id, 'category')); ?>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <?php if (have_posts()) :
                    while (have_posts()) :
                        the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="block hover:text-red-700">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title_attribute(); ?>" class="mb-4">
                            <h2 class="text-3xl">
                                <?php the_title(); ?>
                            </h2>
                            <div class="mt-2 text-sm text-zinc-500">
                                <?php the_date(); ?>
                            </div>
                            <div class="mt-2 prose">
                                <?php the_excerpt(); ?>
                            </div>
                        </a>
                    <?php endwhile;
                else : ?>
                    <div class="flex items-center justify-center py-4 border text-zinc-500 border-grey-200">
                        <p>Sorry, there are no entries in this category.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<?php get_template_part('templates/layout/footer'); ?>