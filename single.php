<?php get_template_part('templates/layout/header'); ?>

    <?php while (have_posts()) :
        the_post();
        $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // get the full size featured image
    ?>
        <h1>
            <?php the_title(); ?>
        </h1>
        <div class="mt-2 mb-4 text-sm text-zinc-500">
            <p>Posted on
                <?php the_date(); ?> by
                <?php the_author(); ?>
            </p>
        </div>
        <img src="<?php echo $featured_image_url; ?>" alt="<?php the_title_attribute(); ?>" class="mb-4">

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

<?php get_template_part('templates/layout/footer'); ?>