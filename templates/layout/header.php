<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="flex flex-col">
        <div class="container flex flex-row items-center justify-between py-2 md:py-3">
            <div class="flex flex-col md:items-center md:flex-row md:gap-4 lg:gap-8">
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
            </div>
            <?php get_template_part('templates/components/search-form') ?>
            <div class="flex items-center gap-4">
                <?php get_template_part('templates/components/account-dropdown') ?>
            </div>
        </div>
        <?php wp_nav_menu(
            array(
                'theme_location' => 'primary',
                'menu_class' => 'container flex flex-row items-center gap-4 md:gap-8 lg:gap-12',
                'container_class' => 'bg-zinc-100 py-4',
                'depth' => 1,
                'link_before' => '<span class="flex font-medium text-black transition hover:text-red-700">',
                'link_after' => '</span>'
            )
        ); ?>
        <?php if (!is_front_page()) : ?>
            <div class="border-b border-zinc-200">
                <div class="container">
                    <?php get_template_part('templates/components/breadcrumbs') ?>
                </div>
            </div>
        <?php endif; ?>
    </header>