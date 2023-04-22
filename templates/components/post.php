<?php

// Use the calculateReadingTime() function in your template file
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
);
$query = new WP_Query($args);

// Display the remaining posts in the grid
if ($query->have_posts()) :
    $post_count = 0;
    while ($query->have_posts()) :
        $query->the_post();
        if ($post_count > 0) :
            $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
            <article class="flex flex-col gap-4">
                <a href="<?php the_permalink(); ?>">
                    <img class="h-[18.75rem] md:h-[21.875rem] lg:h-[25rem] object-cover w-full" src="<?php echo $featured_image_url; ?>" alt="<?php the_title(); ?>">
                </a>
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <?php echo calculateReadingTime(get_the_content()); ?>
                        </div>
                        <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>">
                            <div class="flex items-center gap-2">
                                <span class="dashicons dashicons-tag"></span>
                                <span>
                                    <?php echo get_the_category()[0]->name; ?>
                                </span>
                            </div>
                        </a>
                        <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>">
                            <div class="flex items-center gap-2">
                                <span class="dashicons dashicons-calendar"></span>
                                <span>
                                    <?php echo get_the_date(); ?>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h2 class="text-4xl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="excerpt line-clamp-3"><?php the_excerpt() ?></div>
                    </div>
                </div>
                <a href="<?php the_permalink(); ?>" class="flex items-center self-start gap-2 font-semibold text-black">
                    Read more
                    <span class="dashicons dashicons-arrow-right-alt"></span>
                </a>
            </article>

<?php
        endif;
        $post_count++;
    endwhile;
    wp_reset_postdata();
else :
    echo "<p>No posts found.</p>";
endif;
