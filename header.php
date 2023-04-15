<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="bg-white shadow-lg">
        <div class="container mx-auto flex items-center justify-between py-4 px-8">
            <div class="flex items-center">
                <?php if (has_custom_logo()) : ?>
                    <div class="mr-4"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                    <h1 class="text-xl font-bold"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php endif; ?>
                <?php if (has_nav_menu('primary')) : ?>
                    <nav class="hidden lg:block">
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'flex items-center')); ?>
                    </nav>
                <?php endif; ?>
            </div>
            <div class="flex items-center">
                <form role="search" method="get" class="mr-4" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" placeholder="<?php echo esc_attr__('Search', 'textdomain'); ?>" name="s" value="<?php echo get_search_query(); ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <?php if (!is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(wp_login_url()); ?>" class="button flex items-center gap-2 mr-4"><?php echo esc_html__('Log in', 'textdomain'); ?><span class="feather feather-log-in"></span></a>
                <?php else : ?>
                    <a href="<?php echo esc_url(wp_logout_url()); ?>" class="button flex items-center gap-2 mr-4"><?php echo esc_html__('Log out', 'textdomain'); ?><span class="feather feather-log-out"></span></a>
                <?php endif; ?>
            </div>
        </div>
    </header>