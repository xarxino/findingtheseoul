<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header id="header-static" class="relative bg-white">
        <div class="container flex flex-row items-center justify-between py-2 md:py-3">
            <div class="flex flex-col">
                <?php if (has_custom_logo()) : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="mr-4"><?php the_custom_logo(); ?></a>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <h1>
                            <?php bloginfo('name'); ?>
                        </h1>
                        <?php if (get_bloginfo('description')) : ?>
                            <p class="text-sm">
                                <?php bloginfo('description'); ?>
                            </p>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="relative">
                <form role="search" method="get" class="flex items-center" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="relative flex items-center gap-8">
                        <label for="search-input" class="sr-only"><?php esc_attr_e('Search', 'textdomain'); ?></label>
                        <input type="search" id="search-input" placeholder="<?php esc_attr_e('Search', 'textdomain'); ?>" name="s" value="<?php echo get_search_query(); ?>" class="flex-1 py-2 pl-4 pr-12 h-10 text-black rounded-full border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-red-700 focus:border-transparent transition min-w-full lg:min-w-[25rem]" autocomplete="off" />
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center justify-center w-10 h-10 px-4 text-white transition bg-red-700 rounded-full hover:bg-red-800" aria-label="<?php esc_attr_e('Submit search', 'textdomain'); ?>"><i class="ph ph-magnifying-glass"></i></button>
                    </div>
                </form>

                <div class="absolute left-0 z-20 flex-col hidden w-full gap-4 p-8 mt-2 bg-white border shadow-md border-zinc-200 rounded-b-md live-search-results" aria-live="polite">
                    <div class="hidden loading-animation"><?= esc_html__('Loading...', 'textdomain'); ?></div>
                </div>
            </div>
            <button id="mega-menu__button" class="flex items-center gap-2">
                <i id="mega-menu__button-icon" class="ph ph-list"></i>
            </button>
            <div id="mega-menu" class="absolute left-0 right-0 z-50 hidden transition bg-white shadow-xl top-full rounded-b-md">
                <?php wp_nav_menu(array(
                    'theme_location' => 'header',
                    'container_class' => 'border-t border-zinc-200 py-8',
                    'menu_class' => 'container flex flex-col gap-4 text-zinc-900 md:flex-row md:gap-8 lg:gap-12',
                    'depth' => 2,
                    'walker' => new Custom_Walker_Nav_Menu(), // add this line
                )); ?>
            </div>
        </div>
    </header>
    <?php if (!is_front_page()) : ?>
        <div class="py-3 mb-16 border-t breadcrumbs border-zinc-200 bg-zinc-100">
            <div class="container flex items-center">
                <?php echo theme_breadcrumbs(); ?>
            </div>
        </div>
    <?php endif; ?>
    <main id="content" class="mb-16">