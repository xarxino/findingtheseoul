<?php get_header(); ?>

<main>
    <h1><?php single_cat_title(); ?></h1>
    <?php while (have_posts()) : the_post(); ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>