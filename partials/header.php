<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="container flex flex-col items-center justify-between ">
        <div class="flex flex-col">
            <?php if (has_custom_logo()) : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="mr-4"><?php the_custom_logo(); ?></a>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <h1><?php bloginfo('name'); ?></h1>
                    <?php if (get_bloginfo('description')) : ?><p class="text-sm"><?php bloginfo('description'); ?></p><?php endif; ?>
                </a>
            <?php endif; ?>
            <?php if (has_nav_menu('primary')) : ?>
                <nav class="hidden lg:block">
                    <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'flex items-center')); ?>
                </nav>
            <?php endif; ?>
        </div>

        <div class="flex items-center gap-4">
            <div class="relative">
                <form role="search" method="get" class="flex items-center" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="relative flex items-center gap-8">
                        <label for="search-input" class="sr-only"><?php echo esc_attr__('Search', 'textdomain'); ?></label>
                        <input type="search" id="search-input" placeholder="<?php echo esc_attr__('Search', 'textdomain'); ?>" name="s" value="<?php echo get_search_query(); ?>" class="flex-1 py-2 pl-4 pr-12 text-black rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-red-700 focus:border-transparent transition min-w-full lg:min-w-[600px] live-search-input" autocomplete="off" />
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-4 bg-red-700 hover:bg-red-800 transition text-white rounded-full" aria-label="<?php echo esc_attr__('Submit search', 'textdomain'); ?>">
                            <i data-feather="search"></i>
                        </button>
                    </div>
                </form>
                <div class="hidden absolute z-10 bg-white border border-gray-200 shadow-md rounded-b-lg w-full left-0 mt-2 live-search-results p-8 flex-col gap-4" aria-live="polite">
                    <div class="loading-animation hidden">Loading...</div>
                </div>
            </div>


            <?php if (!is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(wp_login_url()); ?>" class="button flex items-center gap-2 mr-4"><?php echo esc_html__('Log in', 'textdomain'); ?><i data-feather="log-in"></i></a>
            <?php else : ?>
                <a href="<?php echo esc_url(wp_logout_url()); ?>" class="button flex items-center gap-2 mr-4"><?php echo esc_html__('Log out', 'textdomain'); ?><i data-feather="log-out"></i></a>
            <?php endif; ?>
        </div>
    </header>