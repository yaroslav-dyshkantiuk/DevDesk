<?php
/*
* Template name: Homepage Template
*/
get_header();
?>

<div class="cars">
<?php 
    $paged = get_query_var('page') ? get_query_var('page') : 1;
    $args = array(
        'post_type' => 'car',
        'paged' => $paged,
        'posts_per_page' => 2,

    );
    $cars = new WP_Query($args);

    if ($cars->have_posts()) {
        while ($cars->have_posts()) {
            $cars->the_post();
            get_template_part('partials/content');
        } 
        devdesk_paginate($cars);
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
            get_template_part('partials/content', 'car');
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

