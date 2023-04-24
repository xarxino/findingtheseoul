<?php get_template_part('templates/layout/header'); ?>

<main class="container py-16">
    <?php while (have_posts()):
        the_post(); ?>
        <h1>
            <?php the_title(); ?>
        </h1>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
</main>

<?php get_template_part('templates/layout/footer'); ?>