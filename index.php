<?php get_template_part('partials/header');; ?>

<main>
    <div class="container">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="bg-white rounded-lg shadow p-6">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="text-gray-500 text-sm mb-4">
                            <span class="mr-2"><?php echo get_the_date(); ?></span>
                            <span>by <?php the_author_posts_link(); ?></span>
                        </div>
                        <div class="mb-4">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:underline">Read more &rarr;</a>
                    </article>
                <?php endwhile; ?>
                <div class="pagination">
                    <?php echo paginate_links(); ?>
                </div>
            <?php else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_template_part('partials/footer');; ?>