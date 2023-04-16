<?php get_template_part('partials/header');; ?>

<main class="container ">
    <h1 class="text-4xl font-bold"><?php single_cat_title(); ?></h1>
    <div class="grid gap-6 mt-8">
        <?php while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="block hover:text-blue-500">
                <h2 class="text-2xl font-bold"><?php the_title(); ?></h2>
                <div class="text-gray-500 text-sm mt-2"><?php the_date(); ?></div>
                <div class="prose mt-2"><?php the_excerpt(); ?></div>
            </a>
        <?php endwhile; ?>
    </div>
</main>

<?php get_template_part('partials/footer');; ?>