<?php
function devdesk_register_post_type(){
	$labels = array(
		'name'                  => esc_html_x( 'Cars', 'Post type general name', 'devdesk' ),
		'singular_name'         => esc_html_x( 'Car', 'Post type singular name', 'devdesk' ),
		'menu_name'             => esc_html_x( 'Cars', 'Admin Menu text', 'devdesk' ),
		'name_admin_bar'        => esc_html_x( 'Car', 'Add New on Toolbar', 'devdesk' ),
		'add_new'               => esc_html__( 'Add New', 'devdesk' ),
		'add_new_item'          => esc_html__( 'Add New Car', 'devdesk' ),
		'new_item'              => esc_html__( 'New Car', 'devdesk' ),
		'edit_item'             => esc_html__( 'Edit Car', 'devdesk' ),
		'view_item'             => esc_html__( 'View Car', 'devdesk' ),
		'all_items'             => esc_html__( 'All Cars', 'devdesk' ),
		'search_items'          => esc_html__( 'Search Cars', 'devdesk' ),
		'parent_item_colon'     => esc_html__( 'Parent Cars:', 'devdesk' ),
		'not_found'             => esc_html__( 'No cars found.', 'devdesk' ),
		'not_found_in_trash'    => esc_html__( 'No cars found in Trash.', 'devdesk' ),
		'featured_image'        => esc_html_x( 'Car Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'devdesk' ),
		'set_featured_image'    => esc_html_x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'devdesk' ),
		'remove_featured_image' => esc_html_x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'devdesk' ),
		'use_featured_image'    => esc_html_x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'devdesk' ),
		'archives'              => esc_html_x( 'Car archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'devdesk' ),
		'insert_into_item'      => esc_html_x( 'Insert into car', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'devdesk' ),
		'uploaded_to_this_item' => esc_html_x( 'Uploaded to this car', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'devdesk' ),
		'filter_items_list'     => esc_html_x( 'Filter cars list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'devdesk' ),
		'items_list_navigation' => esc_html_x( 'Cars list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'devdesk' ),
		'items_list'            => esc_html_x( 'Cars list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'devdesk' ),
	);
	$args = array(
		'label' => esc_html__('cars', 'devdesk'),
		'labels' => $labels,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes', 'post-formats'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'cars'),
		'show_in_rest' => true,
	);
	register_post_type('car', $args);

	unset($args);
	unset($labels);

}
add_action('init', 'devdesk_register_post_type');

function devdesk_register_taxonomy(){

	$labels = array(
	'name'              => esc_html_x( 'Brands', 'taxonomy general name', 'devdesk' ),
	'singular_name'     => esc_html_x( 'Brand', 'taxonomy singular name', 'devdesk' ),
	'search_items'      => esc_html__( 'Search Brands', 'devdesk' ),
	'all_items'         => esc_html__( 'All Brands', 'devdesk' ),
	'parent_item'       => esc_html__( 'Parent Brand', 'devdesk' ),
	'parent_item_colon' => esc_html__( 'Parent Brand:', 'devdesk' ),
	'edit_item'         => esc_html__( 'Edit Brand', 'devdesk' ),
	'update_item'       => esc_html__( 'Update Brand', 'devdesk' ),
	'add_new_item'      => esc_html__( 'Add New Brand', 'devdesk' ),
	'new_item_name'     => esc_html__( 'New Brand Name', 'devdesk' ),
	'menu_name'         => esc_html__( 'Brand', 'devdesk' ),
	);

	$args = array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'rewrite' => array('slug' => 'brands'),
		'query_war' => true,
		'show_in_rest' => true,
	);

	register_taxonomy('brand', array('car'), $args);

	unset($args);
	unset($labels);

	$labels = array(
	'name'              => esc_html_x( 'Manufactures', 'taxonomy general name', 'devdesk' ),
	'singular_name'     => esc_html_x( 'Manufacture', 'taxonomy singular name', 'devdesk' ),
	'search_items'      => esc_html__( 'Search Manufactures', 'devdesk' ),
	'all_items'         => esc_html__( 'All Manufactures', 'devdesk' ),
	'parent_item'       => esc_html__( 'Parent Manufacture', 'devdesk' ),
	'parent_item_colon' => esc_html__( 'Parent Manufacture:', 'devdesk' ),
	'edit_item'         => esc_html__( 'Edit Manufacture', 'devdesk' ),
	'update_item'       => esc_html__( 'Update Manufacture', 'devdesk' ),
	'add_new_item'      => esc_html__( 'Add New Manufacture', 'devdesk' ),
	'new_item_name'     => esc_html__( 'New Manufacture Name', 'devdesk' ),
	'menu_name'         => esc_html__( 'Manufacture', 'devdesk' ),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'rewrite' => array('slug' => 'manufactures'),
		'query_war' => true,
		'show_admin_column' => 'true',
		'show_in_rest' => true,
	);

	register_taxonomy('manufacture', array('car'), $args);
}
add_action('init', 'devdesk_register_taxonomy');