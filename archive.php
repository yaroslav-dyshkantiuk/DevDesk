<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DevDesk
 */

get_header();
?>

	<div>
		<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
		</header>

		<?php if(have_posts()) : while(have_posts()) : the_post() ; ?>
			<?php get_template_part('partials/content'); ?>
		<?php endwhile; else : ?>
			<?php get_template_part('partials/content', 'none'); ?>
		<?php endif; ?>
		
    </div>

	</div>

<?php
// get_sidebar();
get_footer();
