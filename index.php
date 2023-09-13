<?php get_header(); ?>
<div>
<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			get_template_part('partials/content');
		}
		// posts_nav_link(' . ', esc_html__('Prev', 'devdesk'), esc_html__('Next', 'devdesk'));
?>
	<div class="pagination">
		<?php echo paginate_links(); ?>
	</div>
<?php
	} else {
		get_template_part('partials/content', 'none');
	}
?>
</div>
<p>index.php</p>
<?php
// get_sidebar();
get_footer();
