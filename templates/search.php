<?php get_template_part('partials/header');; ?>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-8"><?php printf(__('Search Results for: %s', 'textdomain'), '<span class="text-blue-500">' . get_search_query() . '</span>'); ?></h1>

    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <?php while (have_posts()) : the_post(); ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <img class="w-full h-48 object-cover" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                        </a>
                    <?php endif; ?>
                    <div class="p-4">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="text-gray-700 mb-4"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"><?php _e('Read more', 'textdomain'); ?></a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <?php the_posts_pagination(array(
            'prev_text' => __('Previous', 'textdomain'),
            'next_text' => __('Next', 'textdomain'),
        )); ?>

    <?php else : ?>
        <p><?php _e('Sorry, no results were found.', 'textdomain'); ?></p>
    <?php endif; ?>
</div>

<?php get_template_part('partials/footer');; ?>