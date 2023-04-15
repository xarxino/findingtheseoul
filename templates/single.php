<?php get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="entry-meta">
            <p>Posted on <?php the_date(); ?> by <?php the_author(); ?></p>
        </div>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>