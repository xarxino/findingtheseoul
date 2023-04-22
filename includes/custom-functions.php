<?php
function post_categories()
{
    $categories = get_the_category();
    $main_category = $categories[0]; // Get the first category as the main category
    $sub_categories = array_slice($categories, 1); // Get the remaining categories as subcategories
?>
    <div class="mt-2 mb-4 text-sm text-gray-500">
        <p>Posted in <a href="<?php echo esc_url(get_category_link($main_category->term_id)); ?>"><?php echo esc_html($main_category->name); ?></a></p>
        <?php if (!empty($sub_categories)) : ?>
            <p>Subcategories:
                <?php foreach ($sub_categories as $category) { ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class='hover:text-red-700 hover:underline'><?php echo esc_html($category->name); ?></a>,
                <?php } ?>
            </p>
        <?php endif; ?>
        <p>Posted on
            <?php the_date(); ?> by
            <?php the_author(); ?>
        </p>
    </div>
<?php }

// Define the calculateReadingTime() function in custom-functions.php
function calculateReadingTime($content)
{
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // assuming 200 words per minute reading speed
    echo '<span class="dashicons dashicons-clock"></span>' . $reading_time . ' ' . esc_html__('minutes', 'textdomain');
}