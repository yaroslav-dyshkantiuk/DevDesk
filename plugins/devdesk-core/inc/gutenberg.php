<?php
function ddab_register_blocks() {
    if(!function_exists('register_block_type')){
        return;
    }
    wp_register_script('dd-about', plugins_url('/blocks/js/dd-about.js', __FILE__), ['wp-blocks','wp-element','wp-editor'],'1.0');
    wp_register_style('dd-about',  plugins_url('/blocks/css/dd-about.css', __FILE__), [],'1.0');

    register_block_type('ddab/dd-about', ['style' => 'dd-about', 'editor_script' => 'dd-about']);
}
add_action('init', 'ddab_register_blocks');