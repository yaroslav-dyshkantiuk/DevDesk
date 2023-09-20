<?php
/*
 * Plugin Name:         Devdesk Core
 * Plugin URI:          http://#
 * Description:         A plugin that implements Devdesk functionality
 * Version:             1.0
 * Author:              Yaroslav
 * Author URI:          #
 * License:             GPLv3 or later
 * Text Domain:         devdesk-core
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require plugin_dir_path(__FILE__) . '/inc/widget-about.php';
require plugin_dir_path(__FILE__) . '/inc/metaboxes.php';
require plugin_dir_path(__FILE__) . '/inc/acf.php';
require plugin_dir_path(__FILE__) . '/inc/custom-post-type.php';
require plugin_dir_path(__FILE__) . '/inc/elementor.php';
	

