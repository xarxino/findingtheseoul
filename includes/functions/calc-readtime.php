<?php
// Define the calculateReadingTime() function in custom-functions.php
function calculateReadingTime($content)
{
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // assuming 200 words per minute reading speed
    echo '<span class="dashicons dashicons-clock"></span>' . $reading_time . ' ' . esc_html__('min.', 'textdomain');
}
