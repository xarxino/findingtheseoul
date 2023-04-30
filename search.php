<?php get_template_part('templates/layout/header');
$search_query = get_search_query();
?>

<div class="max-w-6xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
    <h1 class="mb-8 text-3xl font-bold">
        <?php printf(__('Search Results for: %s', 'textdomain'), '<span class="text-blue-500">' . get_search_query() . '</span>'); ?>
    </h1>

    <?php if (have_posts()) : ?>
        <ul>
            <?php while (have_posts()) :
                the_post(); ?>
                <li>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="text-gray-500"><?php the_author(); ?> | <?php the_date(); ?> | <?php the_category(', '); ?></p>
                    <div class="mb-4 text-zinc-700">
                        <?php the_excerpt(); ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php the_posts_pagination(
            array(
                'prev_text' => __('Previous', 'textdomain'),
                'next_text' => __('Next', 'textdomain'),
            )
        ); ?>

    <?php else : ?>
        <p>
            <?php _e('Sorry, no results were found.', 'textdomain'); ?>
        </p>
    <?php endif; ?>
</div>

<?php get_template_part('templates/layout/footer'); ?>