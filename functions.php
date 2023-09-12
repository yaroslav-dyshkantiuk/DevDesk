<?php
/**
 * DevDesk functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DevDesk
 */




 function devdesk_enqueue_scripts() {
	wp_enqueue_style('devdesk-general', get_template_directory_uri().'/assets/css/general.css', array(), '1.0', 'all');
	wp_enqueue_script('devdesk-script', get_template_directory_uri().'/assets/js/script.js', array(), '1.0', true);
 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
 add_action('wp_enqueue_scripts', 'devdesk_enqueue_scripts');

function devdesk_theme_setup() {
	register_nav_menus(array(
		'header_nav' => 'Header Navigation',
		'footer_nav' => 'Footer Navigation'
	));

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'post-thumbnails' );

	add_theme_support('post-formats', 
		array(
			'video',
			'quote',
			'image',
			'gallery'
		));
	add_post_type_support( 'cars', 'post-formats');
		 
	

	load_theme_textdomain( 'devdesk', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'devdesk_theme_setup', 0);

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

function custom_taxonomy_flush_rewrite() {
	global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action('init', 'custom_taxonomy_flush_rewrite');

function devdesk_rewrite_rules(){
	devdesk_register_post_type();
	flush_rewrite_rules();
}
add_action('after_switch_theme', 'devdesk_rewrite_rules');








if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function devdesk_setup() {


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/




	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'devdesk_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'devdesk_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function devdesk_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'devdesk_content_width', 640 );
}
add_action( 'after_setup_theme', 'devdesk_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function devdesk_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'devdesk' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'devdesk' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'devdesk_widgets_init' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

