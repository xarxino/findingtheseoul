<?php get_template_part('templates/layout/header'); ?>

<main>
	<div class="container">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('templates/components/post'); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part('templates/components/post', 'none'); ?>
		<?php endif; ?>
	</div>
</main>

<?php get_template_part('templates/layout/footer'); ?>