<?php get_template_part('templates/layout/header');
$category = get_queried_object();
$cat_id = $category->term_id;
$parent_category = get_term_by('id', $category->parent, 'category');
?>

<div class="container flex gap-12">

    <?php get_template_part('templates/components/sidebar'); ?>

    <div class="flex flex-col gap-12">
        
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <h1><?php echo $parent_category ? $parent_category->name : $category->name; ?></h1>
                <?php if ($category->parent) : ?>
                    <h3 class="text-gray-400"><?php echo $category->name; ?></h3>
                <?php endif; ?>
            </div>
            <?php if (category_description()) : ?>
                <?= str_replace('<p>', '<p class="text-zinc-500">', get_term_field('description', $category->term_id, 'category')); ?>
            <?php endif; ?>
        </div>

        <?php
        $hero_query = new WP_Query(array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 4,
            'cat'            => $cat_id,
        ));
        if ($hero_query->have_posts()) :
            while ($hero_query->have_posts()) :
                $hero_query->the_post();
                get_template_part('templates/components/post');
            endwhile;
            wp_reset_postdata();
        endif; ?>

        <?php
        $query = new WP_Query(array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 6,
            'offset'         => 4,
            'cat'            => $cat_id,
        ));
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                get_template_part('templates/components/post');
            endwhile;
            wp_reset_postdata();
        else : ?>
            <div class="flex flex-col items-center justify-center gap-4 p-4 text-center border rounded-md text-zinc-500 bg-zinc-50 border-zinc-100">
                <h2>:(</h2>
                <p>Sorry, there are no posts yet for this category. Check back soon!</p>
            </div>
        <?php endif; ?>
    </div>

</div>
</main>

<?php get_template_part('templates/layout/footer'); ?>