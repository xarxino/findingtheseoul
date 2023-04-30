<?php
// Define the calculateReadingTime() function in custom-functions.php
function calculateReadingTime($content)
{
    $word_count = str_word_count(strip_tags($content));
    echo '<i class="ph ph-clock"></i>' . (ceil($word_count / 200)) . ' ' . __('min.', 'textdomain');
}
