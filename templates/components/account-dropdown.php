<?php
$is_user_logged_in = is_user_logged_in();

if ($is_user_logged_in) {
    $current_user = wp_get_current_user();
    $avatar_url = get_avatar_url($current_user->ID, array('size' => 64));
    $display_name = ucfirst($current_user->display_name);
?>
    <div class="relative">
        <a href="#" class="flex items-center gap-2" id="user-dropdown-toggle">
            <img src="<?= $avatar_url ?>" alt="<?= $display_name ?>" class="w-8 h-8 rounded-full">
            <span class="text-sm font-medium">
                <?= $display_name ?>
            </span>
            <span class="dashicons dashicons-arrow-down-alt2"></span>
        </a>
        <div class="absolute right-0 z-50 hidden w-48 mt-2 bg-white rounded-lg shadow-lg top-full" id="user-dropdown-menu">
            <a href="<?= esc_url(get_edit_profile_url($current_user->ID)) ?>" class="flex items-center px-4 py-2 hover:bg-gray-100">
                <span class="mr-2 dashicons dashicons-admin-users"></span>
                <span class="text-black">
                    <?= esc_html__('My Account', 'textdomain') ?>
                </span>
            </a>
            <a href="<?= esc_url(wp_logout_url()) ?>" class="flex items-center px-4 py-2 hover:bg-gray-100">
                <span class="mr-2 dashicons dashicons-migrate"></span>
                <span class="text-black">
                    <?= esc_html__('Log out', 'textdomain') ?>
                </span>
            </a>
        </div>
    </div>
    <script type="module">
        const dropdownToggle = document.querySelector('#user-dropdown-toggle');
        const dropdownMenu = document.querySelector('#user-dropdown-menu');
        dropdownToggle.addEventListener('click', (event) => {
            event.preventDefault();
            dropdownMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', (event) => {
            const isClickInside = dropdownToggle.contains(event.target) || dropdownMenu.contains(event.target);
            if (!isClickInside) {
                dropdownMenu.classList.add('hidden');
            }
        });
        window.addEventListener('scroll', (event) => {
            dropdownMenu.classList.add('hidden');
        });
    </script>
<?php } else { ?>
    <div class="relative flex gap-2">
        <a href="<?= esc_url(wp_login_url()) ?>" class="flex items-center gap-2 group">
            <span class="dashicons dashicons-admin-users <?= $is_user_logged_in ? 'group-hover:text-red-700' : '' ?>"></span>
            <span><?= $is_user_logged_in ? 'My Account' : 'Log in' ?></span>
        </a>
        <span class="text-gray-400"><?= $is_user_logged_in ? '' : 'or' ?></span>
        <a href="<?= esc_url(wp_registration_url()) ?>" class="flex items-center gap-2 group">
            <span class="dashicons dashicons-plus-alt <?= $is_user_logged_in ? 'hidden' : 'group-hover:text-red-700' ?>"></span>
            <span><?= $is_user_logged_in ? '' : 'Sign up' ?></span>
        </a>
    </div>
<?php } ?>