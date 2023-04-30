<?php get_template_part('templates/layout/header'); ?>

<!-- Hero -->
<?php
$query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 1, 'order' => 'DESC'));
if ($query->have_posts()) :
	$query->the_post();
?>
	<section class="min-h-[60vh] md:min-h-[60vh] lg:min-h-[70vh] flex flex-col justify-end pb-16 bg-no-repeat bg-cover bg-center relative after:bg-gradient-to-tr after:from-black after:absolute after:inset-0 after:z-0" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>')">
		<div class="container relative z-10 ">
			<div class="flex flex-col max-w-4xl gap-4 text-white md:gap-6 lg:gap-8">
				<h1><?php the_title(); ?></h1>
				<a href="<?php the_permalink(); ?>" class="flex items-center self-start justify-center gap-2 px-8 py-3 font-semibold text-white transition border border-white group hover:bg-white hover:text-red-700 hover:border-transparent">
					Read more
					<span class="dashicons dashicons-arrow-right-alt !text-white group-hover:!text-red-700"></span>
				</a>
			</div>
		</div>
	</section>
<?php wp_reset_postdata();
endif; ?>

<!-- Recent Posts -->
<section class="py-4 md:py-8 lg:py-16 xl:py-24">
	<div class="container flex flex-col gap-4 md:gap-8 lg:gap-12 xl:gap-16">
		<h2 class="flex justify-center whitespace-nowrap">Our most recent</h2>
		<div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
			<?php
			$query = new WP_Query(array(
				'posts_per_page' => 6,
				'post__not_in' => get_option('sticky_posts'),
				'offset' => 1
			));
			if ($query->have_posts()) :
				while ($query->have_posts()) :
					$query->the_post();
					get_template_part('templates/components/post');
				endwhile;
				wp_reset_postdata();
			else :
				echo "<p>No posts found.</p>";
			endif;
			?>
		</div>
	</div>
</section>

<!-- Explore Korea -->
<section class="relative z-10 flex flex-col items-center justify-center gap-16 py-24 bg-zinc-100 after:bg-hangul after:bg-center after:bg-50% after:bg-repeat after:-z-10 after:opacity-[3%] after:absolute after:-inset-0">
	<?php
	$explore_korea_category = get_category_by_slug('explore-korea');
	$categories = $explore_korea_category ? array($explore_korea_category) : array();

	foreach ($categories as $category) :
		$subcategories = get_categories(array(
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => false,
			'parent' => $category->term_id,
			'exclude' => array(1) // exclude Uncategorized category
		));
	?>

		<h2><?= $category->name ?></h2>
		<div class="container flex flex-col gap-4">
			<?php if (empty($subcategories)) : ?>
				<p class="text-zinc-400">No subcategories found.</p>
			<?php else : ?>
				<ul class="flex items-center justify-center gap-16">
					<?php foreach ($subcategories as $subcategory) :
						$thumbnail_url = wp_get_attachment_image_src(get_term_meta($subcategory->term_id, 'thumbnail_id', true), 'category-thumbnail')[0] ?? 'https://via.placeholder.com/150';
					?>
						<li>
							<a href="<?= get_category_link($subcategory->term_id) ?>" class="flex flex-col items-center justify-center w-full h-full gap-6 group">
								<h4 class="text-xl"><?= $subcategory->name ?></h4>
								<div class="flex justify-center w-48 h-48 overflow-hidden rounded-full">
									<img class="object-cover w-48 h-48 transition-all duration-500 ease-in-out transform rounded-full group-hover:scale-110" src="<?= esc_url($thumbnail_url) ?>" alt="<?= $subcategory->name ?>">
								</div>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</section>


<section>
	<div class="container flex flex-col items-center justify-center gap-16 py-24">
		<h2 class="flex justify-center whitespace-nowrap">
			What we're up to
		</h2>
		<?php echo do_shortcode('[instagram-feed feed=1]'); ?>
	</div>
</section>
</main>
<?php get_template_part('templates/layout/footer'); ?>