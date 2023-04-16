<?php get_template_part('partials/header');; ?>

<main class="container">
    <?php while (have_posts()) : the_post(); ?>
        <h1 class="text-4xl font-bold"><?php the_title(); ?></h1>
        <div class="text-gray-500 text-sm mt-2 mb-4">
            <p>Posted on <?php the_date(); ?> by <?php the_author(); ?></p>
        </div>
        <div class="flex flex-col gap-4">
            <?php
            if (function_exists('the_content')) {
                the_content();
            } else {
                echo wp_kses_post(get_the_content());
            }
            ?>
        </div>
    <?php endwhile; ?>
</main>

<?php get_template_part('partials/footer');; ?>