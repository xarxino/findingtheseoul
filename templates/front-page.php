<?php
get_template_part('templates/layout/header');

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 1
);
$query = new WP_Query($args);

if (have_posts()) {
    $categories = get_the_category();
    $main_category = $categories[0]->name;
    $post_date = get_the_date();
}
?>

<main>
    <?php
    if ($query->have_posts()) :
        $query->the_post();
        $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>
        <div class="min-h-[60vh] md:min-h-[60vh] lg:min-h-[70vh] flex flex-col justify-end pb-16 bg-no-repeat bg-cover bg-center relative after:bg-black/50 after:absolute after:inset-0 after:z-0" style="background-image: url('<?php echo $featured_image_url; ?>')">
            <div class="container relative z-10 ">
                <div class="flex flex-col max-w-4xl gap-4 text-white md:gap-6 lg:gap-8">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                    <a href="<?php the_permalink(); ?>" class="flex items-center self-start justify-center gap-2 px-8 py-3 font-semibold text-white transition border border-white group hover:bg-white hover:text-red-700 hover:border-transparent">
                        Read more
                        <span class="dashicons dashicons-arrow-right-alt !text-white group-hover:!text-red-700"></span>
                    </a>
                </div>
            </div>
        </div>
    <?php
        wp_reset_postdata();
    endif;
    ?>
    <section class="flex flex-col gap-4 py-4 md:gap-8 lg:gap-12 xl:gap-16 md:py-8 lg:py-16 xl:py-24">
        <div class="container flex flex-col gap-4 md:gap-8 lg:gap-12 xl:gap-16">
            <div class="flex items-center justify-center gap-12 before:block before:w-full before:h-px before:bg-black/10 after:block after:w-full after:h-px after:bg-black/10">
                <h2 class="flex justify-center whitespace-nowrap">
                    Our most recent
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 2xl:grid-cols-3">
                <?php
                $args = array(
                    'posts_per_page' => 9, // Number of posts to show
                    'post__not_in'   => get_option('sticky_posts'), // Exclude sticky posts
                    'offset'         => 1 // Offset the most recent post
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                        $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        $category = get_the_category()[0];
                        $category_link = esc_url(get_category_link($category->term_id));
                        $post_date = get_the_date();
                        $post_permalink = esc_url(get_the_permalink());
                ?>
                        <article class="flex flex-col gap-4">
                            <a href="<?php echo $post_permalink; ?>">
                                <div class="overflow-hidden">
                                    <img class="h-[18.75rem] md:h-[21.875rem] lg:h-[25rem] object-cover w-full transition-all duration-500 ease-in-out transform hover:scale-110" src="<?php echo $featured_image_url; ?>" alt="<?php the_title(); ?>">
                                </div>
                            </a>

                            <div class="flex flex-col gap-4 pl-5 border-l-4 border-black">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2 font-medium">
                                        <?php echo calculateReadingTime(get_the_content()); ?>
                                    </div>
                                    <a href="<?php echo $category_link; ?>">
                                        <div class="flex items-center gap-2">
                                            <span class="dashicons dashicons-tag"></span>
                                            <span class="font-semibold">
                                                <?php echo $category->name; ?>
                                            </span>
                                        </div>
                                    </a>
                                    <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>">
                                        <div class="flex items-center gap-2">
                                            <span class="dashicons dashicons-calendar"></span>
                                            <span class="font-semibold">
                                                <?php echo $post_date; ?>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-4xl"><a href="<?php echo $post_permalink; ?>"><?php the_title(); ?></a></h2>
                                    <div class="text-zinc-500 excerpt line-clamp-3"><?php the_excerpt() ?></div>
                                </div>
                            </div>
                            <a href="<?php echo $post_permalink; ?>" class="flex items-center self-start gap-2 font-medium text-black">
                                Read more
                                <span class="dashicons dashicons-arrow-right-alt"></span>
                            </a>
                        </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo "<p>No posts found.</p>";
                endif;
                ?>

            </div>
        </div>
    </section>

    <section class="relative z-10 flex flex-col items-center justify-center gap-16 py-24 md:gap-8 lg:gap-12 xl:gap-16 md:py-8 lg:py-16 xl:py-24 bg-zinc-100 after:bg-hangul after:bg-center after:bg-repeat after:-z-10 after:opacity-5 after:absolute after:-inset-0">
        <h2><?php echo $main_category; ?></h2>
        <div class="flex flex-col gap-4">
            <?php
            foreach ($categories as $category) {
                // Skip "Travel Guides" and its subcategories
                if ($category->name == 'Travel Guides') {
                    continue;
                }
            ?>
                <ul class="flex gap-24">
                    <?php
                    $subcategories = get_categories(array(
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => false,
                        'parent' => $category->term_id,
                        'exclude' => array(1) // exclude Uncategorized category
                    ));

                    // Display a message if there are no subcategories
                    if (empty($subcategories)) {
                    ?>
                        <p class="text-zinc-400">No subcategories found.</p>
                        <?php
                    } else {
                        foreach ($subcategories as $subcategory) {
                            $image_url = $subcategory->image_url ? $subcategory->image_url : 'https://via.placeholder.com/150';
                        ?>
                            <li class="flex flex-col items-center gap-6">
                                <h4 class="text-xl"><?php echo $subcategory->name; ?></h4>
                                <a href="<?php echo get_category_link($subcategory->term_id); ?>" class="w-full">
                                    <div class="w-full overflow-hidden">
                                        <img class="object-cover w-full h-full transition-all duration-500 ease-in-out transform hover:scale-110" src="<?php echo $image_url; ?>" alt="<?php echo $subcategory->name; ?>">
                                    </div>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            <?php
            }
            ?>
        </div>
    </section>





</main>
<?php get_template_part('templates/layout/footer'); ?>