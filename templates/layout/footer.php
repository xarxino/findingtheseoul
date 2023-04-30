<footer>
    <div class="relative z-10 flex flex-col items-center justify-center gap-16 py-24 bg-zinc-100 after:bg-hangul after:bg-center after:bg-50% after:bg-repeat after:-z-10 after:opacity-[3%] after:absolute after:-inset-0">
        <h3>Monthly Korea insights, straight to your inbox</h3>
        <form class="flex flex-col gap-4 md:flex-row md:gap-8">
            <input type="email" name="email" placeholder="Your email address" class="px-4 py-2 border rounded-full border-black/20 min-w-[400px] bg-zin-100 focus:outline-red-700">
            <button type="submit" class="px-6 py-3 text-white transition bg-red-700 rounded-full hover:bg-red-800">Subscribe</button>
        </form>
    </div>
    <div class="flex flex-col gap-12 py-24 text-white bg-black">
        <div class="container flex justify-between gap-4">
            <div class="flex justify-between gap-16">
                <?php
                $parent_categories = get_terms([
                    'taxonomy' => 'category',
                    'parent' => 0,
                    'hide_empty' => false,
                    'exclude' => get_option('default_category')
                ]);

                foreach ($parent_categories as $parent_category) :
                ?>
                    <div class="flex flex-col gap-4">
                        <h4 class="font-sans text-base font-bold leading-none uppercase"><?= $parent_category->name; ?></h4>
                        <ul class="flex flex-col gap-4">
                            <?php
                            $child_categories = get_terms([
                                'taxonomy' => 'category',
                                'child_of' => $parent_category->term_id,
                                'hide_empty' => false
                            ]);

                            foreach ($child_categories as $child_category) :
                            ?>
                                <li>
                                    <a href="<?= get_category_link($child_category->term_id); ?>" class="text-white"><?= $child_category->name; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="flex flex-col gap-4">
                <h4 class="font-sans text-base font-bold leading-none uppercase"><?= esc_attr_e('Contact us', 'textdomain'); ?></h4>
                <div class="flex flex-col gap-4">
                    <div class="font-semibold"><?= esc_attr_e('Organizations', 'textdomain'); ?></div>
                    <a href="#" class="flex items-center gap-2 text-white/50 group ">
                        <?= esc_attr_e('Get in touch', 'textdomain'); ?>
                        <i class="ph ph-arrow-right"></i> </a>
                </div>
            </div>
        </div>
        <div class="container flex justify-between gap-4 pt-8 border-t border-white/10">
            <div class="flex items-center justify-between gap-12">
                <?php if (has_nav_menu('social-menu')) : ?>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'social-menu',
                        'menu_class' => 'flex gap-6',
                    ]);
                    ?>
                <?php endif; ?>
            </div>
            <div class="flex items-center gap-2">
                <i class="ph ph-translate"></i>
                <span><?= esc_attr_e('English', 'textdomain'); ?></span>
            </div>
        </div>
        <div class="container flex items-center gap-8">
            <a href="#" class="text-white"><?= esc_attr_e('Privacy & Security', 'textdomain'); ?></a>
            <a href="#" class="text-white"><?= esc_attr_e('Terms of Use', 'textdomain'); ?></a>
        </div>
        <div class="container flex items-center justify-between">
            <div class="opacity-50">
                <?php bloginfo('title'); ?> &copy; 2015 - <?= date('Y'); ?>
            </div>
            <a href="https://www.tomgraafmans.com" target="_blank" class="flex items-end gap-1 text-xl font-extrabold tracking-[-2px] uppercase transition text-white/50">Tom</a>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>

</html>