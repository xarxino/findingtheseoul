<div class="relative">
    <form role="search" method="get" class="flex items-center" action="<?= esc_url(home_url('/')); ?>">
        <div class="relative flex items-center gap-8">
            <label for="search-input" class="sr-only">
                <?= esc_attr__('Search', 'textdomain'); ?>
            </label>
            <input type="search" id="search-input" placeholder="<?= esc_attr__('Search', 'textdomain'); ?>" name="s"
                value="<?= get_search_query(); ?>"
                class="flex-1 py-2 pl-4 pr-12 h-10 text-black rounded-full border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-red-700 focus:border-transparent transition min-w-full lg:min-w-[25rem] live-search-input"
                autocomplete="off" />
            <button type="submit"
                class="absolute inset-y-0 right-0 flex items-center justify-center w-10 h-10 px-4 text-white transition bg-red-700 rounded-full hover:bg-red-800"
                aria-label="<?= esc_attr__('Submit search', 'textdomain'); ?>">
                <span class="dashicons dashicons-search"></span>
            </button>
        </div>
    </form>
    <div class="absolute left-0 z-20 flex-col hidden w-full gap-4 p-8 mt-2 bg-white border border-zinc-200 shadow-md rounded-b-md live-search-results"
        aria-live="polite">
        <div class="hidden loading-animation">
            <?= esc_html__('Loading...', 'textdomain'); ?>
        </div>
    </div>
</div>