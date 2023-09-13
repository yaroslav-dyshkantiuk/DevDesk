<?php
/*
* Template name: Homepage Template
*/
get_header();
?>

<div class="cars">
<?php 
    $args = array(
        'post_type' => 'car',
        'posts_per_page' => -1,

    );
    $cars = new WP_Query($args);

    if ($cars->have_posts()) {
        while ($cars->have_posts()) {
            $cars->the_post();
            get_template_part('partials/content');
        } 
    } else {
        get_template_part('partials/content', 'none');
    }

    wp_reset_postdata();
?>
</div>
<hr>
<?php 
    unset($args);
    $args = array(
        'post_type' => 'post',
        'author' => 1,
        'posts_per_page' => -1,

    );
    $blogpost = new WP_Query($args);

    if ($blogpost->have_posts()) {
        while ($blogpost->have_posts()) {
            $blogpost->the_post();
            get_template_part('partials/content');
        } 
    } else {
        get_template_part('partials/content', 'none');
    }

    wp_reset_postdata();
?>
<div>

</div>

<?php

// get_sidebar();
get_footer();

