<?php
/**
 * DevDesk functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DevDesk
 */

require get_template_directory() . '/inc/redux-options.php';
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'devdesk_register_required_plugins' );


function devdesk_register_required_plugins() {

	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Devdesk Core', // The plugin name.
			'slug'               => 'devdesk-core', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/devdesk-core.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		array(
			'name'      => 'Advanced Custom Fields (ACF)',
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
		),

		array(
			'name'      => 'Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => true,
		),

	);

	$config = array(
		'id'           => 'devdesk',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}


function devdesk_paginate($query){
	$big = 999999999; // need an unlikely integer

	$paged = '';
	if(is_singular()){
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}

	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $query->max_num_pages,
		'prev_next' => false,
	) );
}

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

	register_sidebar(
		array(
			'name'          => esc_html__( 'Car Pages Sidebar', 'devdesk' ),
			'id'            => 'car-sidebar',
			'description'   => esc_html__( 'Appears as a Sidebar on Car Pages.', 'devdesk' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'devdesk_widgets_init' );


 function devdesk_enqueue_scripts() {
	wp_enqueue_style('devdesk-general', get_template_directory_uri().'/assets/css/general.css', array(), '1.0', 'all');
	wp_enqueue_script('devdesk-script', get_template_directory_uri().'/assets/js/script.js', array('jquery'), '1.0', true);
	wp_enqueue_script('devdesk-ajax', get_template_directory_uri().'/assets/js/ajax.js', array('jquery'), '1.0', true);
	wp_localize_script(
		'devdesk-ajax', 
		'devdesk_ajax_script', 
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce'),
			'string_box' => esc_html__('Hello', 'devdesk'),
			'string_new' => esc_html__('Hello World', 'devdesk'),
		)
	);
 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'devdesk_enqueue_scripts');

function devdesk_ajax_example(){
	if(!wp_verify_nonce($_REQUEST['nonce'], 'ajax-nonce')){
		die;
	}

	if(isset($_REQUEST['string_one'])){
		echo $_REQUEST['string_one'];
	}
	echo "<br>";
	if(isset($_REQUEST['string_two'])){
		echo $_REQUEST['string_two'];
	}

	$cars = new WP_Query(array('post_type' => 'car', 'posts_per_page' => -1));

	if ($cars->have_posts()) {
        while ($cars->have_posts()) {
            $cars->the_post();
            get_template_part('partials/content', 'car');
        } 
    }

    wp_reset_postdata();

	die;
}
add_action('wp_ajax_devdesk_ajax_example', 'devdesk_ajax_example');
add_action('wp_ajax_nopriv_devdesk_ajax_example', 'devdesk_ajax_example');

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
	add_image_size('car-cover', 240, 190, array('left', 'top'));

	update_option('thumbnail_size_w', 190);
	update_option('thumbnail_size_h', 190);
	update_option('thumbnail_crop', 1);

	//reserved size
	//thumb, thumbnail, medium, large, post-thumbnail

	add_theme_support('post-formats', 
		array(
			'video',
			'quote',
			'image',
			'gallery'
		));

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
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

	add_post_type_support( 'cars', 'post-formats');
		 
	

	load_theme_textdomain( 'devdesk', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'devdesk_theme_setup', 0);



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

function devdesk_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'devdesk_content_width', 640 );
}
add_action( 'after_setup_theme', 'devdesk_content_width', 0 );

function devdesk_custom_comments($comment, $args, $depth){

	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard">
		<?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            printf( __( '<cite class="fn">Author: %s</cite>' ), get_comment_author_link() ); ?>
        
			<div class="reply"><?php 
					comment_reply_link( 
						array_merge( 
							$args, 
							array( 
								'add_below' => $add_below, 
								'depth'     => $depth, 
								'max_depth' => $args['max_depth'] 
							) 
						) 
					); ?>
			</div>
		
		</div><?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','geniuscourses' ); ?></em><br/><?php 
        } ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                /* translators: 1: date, 2: time */
                printf( 
                    __('%1$s at %2$s'), 
                    get_comment_date(),  
                    get_comment_time() 
                ); ?>
            </a><?php 
            edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
        </div>
 
        <?php comment_text(); ?>
 
        <?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}