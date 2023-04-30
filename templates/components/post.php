<article class="flex flex-col gap-4">
    <a href="<?= get_permalink() ?>" class="overflow-hidden">
        <img class="h-[18.75rem] md:h-[21.875rem] lg:h-[25rem] object-cover w-full transition-all duration-500 ease-in-out transform hover:scale-110" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" alt="<?= get_the_title() ?>">
    </a>
    <div class="flex flex-col gap-4 pl-5 border-l-4 border-black">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 font-medium"><?= calculateReadingTime(get_the_content()) ?></div>
            <?php $categories = get_the_category(); ?>
            <?php if ($categories) : ?>
                <?php $subcategory = get_categories(array('parent' => $categories[0]->cat_ID)); ?>
                <?php if ($subcategory) : ?>
                    <a href="<?= esc_url(get_category_link($subcategory[0]->term_id)) ?>">
                        <div class="flex items-center gap-2"><i class="ph ph-tag"></i><span class="font-semibold"><?= $subcategory[0]->name ?></span></div>
                    </a>
                <?php else : ?>
                    <a href="<?= esc_url(get_category_link($categories[0]->term_id)) ?>">
                        <div class="flex items-center gap-2"><i class="ph ph-tag"></i><span class="font-semibold"><?= $categories[0]->name ?></span></div>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <a href="<?= esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))) ?>">
                <div class="flex items-center gap-2"><i class="ph ph-calendar"></i></span><span class="font-semibold"><?= get_the_date() ?></span></div>
            </a>
        </div>

        <div class="flex flex-col gap-2">
            <h2 class="text-4xl"><a href="<?= get_permalink() ?>"><?= get_the_title() ?></a></h2>
            <div class="text-zinc-500 excerpt"><?php wp_trim_excerpt(the_excerpt(), 32, '..'); ?></div>
        </div>
    </div>
    <a href="<?= get_permalink() ?>" class="flex items-center self-start gap-2 font-medium text-black">Read more<i class="ph ph-arrow-right"></i></a>
</article>