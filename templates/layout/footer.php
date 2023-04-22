<footer class="flex flex-col gap-12 py-24 text-white bg-black">
    <div class="container flex justify-between gap-4">
        <div class="flex justify-between gap-16">
            <div class="flex flex-col gap-4">
                <h4 class="text-base font-bold leading-none uppercase font-body">Explore Korea</h4>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="#" class="text-white">Travel Guides</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Culture & History</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Events & Festivals</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Expat Life</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Interviews</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col gap-4">
                <h4 class="text-base font-bold leading-none uppercase font-body">K-Food</h4>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="#" class="text-white">Traditional Dishes</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Street Food & Markets</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Recipes</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Restaurant Reviews</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col gap-4">
                <h4 class="text-base font-bold leading-none uppercase font-body">Resources</h4>
                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="#" class="text-white">Language Learning</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Book & Film Reviews</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Recommended Products</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Useful Apps & Websites</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <h4 class="text-base font-bold leading-none uppercase font-body">Contact us</h4>
            <div class="flex flex-col gap-4">
                <div class="font-semibold">Organizations</div>
                <a href="#" class="flex items-center gap-2 text-white/50 group ">
                    Get in touch
                    <span class="dashicons dashicons-arrow-right-alt"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="container flex justify-between gap-4 pt-8 border-t border-white/10">
        <div class="flex items-center justify-between gap-12">
            <?php
            if (has_nav_menu('social-menu')) {
                wp_nav_menu(
                    array(
                        'theme_location' => 'social-menu',
                        'menu_class' => 'flex gap-6',
                        'link_before' => '<span class="dashicons">',
                        'link_after' => '</span>',
                    )
                );
            }
            ?>
        </div>
        <div class="flex items-center gap-2">
            <span class="dashicons dashicons-translation"></span>
            <span>English</span>
        </div>
    </div>

    <div class="container flex items-center gap-8">
        <a href="#" class="text-white">Privacy & Security</a>
        <a href="#" class="text-white">Terms of Use</a>
    </div>

    <div class="container flex items-center justify-between">
        <div class="opacity-50">
        <?php bloginfo('title'); ?> &copy; 2015 - <?php echo date('Y'); ?>
        </div>
        <a href="https://www.tomgraafmans.com" target="_blank" class="flex items-end gap-1 text-xl font-extrabold tracking-[-2px] uppercase transition text-white/50">Tom</a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>