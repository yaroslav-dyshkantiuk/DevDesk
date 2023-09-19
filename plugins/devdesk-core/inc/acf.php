<?php
function devdesk_acf_metaboxes(){
    acf_add_local_field_group(array(
        'key' => 'acf_carsettings' ,
        'title' => 'Car Settings For ACF from code',
        'fields' => array(
            array(
                'key' => 'custom_price',
                'label' => 'Car Price',
                'name' => 'custom_price',
                'type' => 'text',
            ),
            array(
                'key' => 'custom_engine_type',
                'label' => 'Car Engine Type',
                'name' => 'custom_engine',
                'type' => 'select',
                'choices' => array(
                    'manual' => esc_html__('Manual', 'devdesk'),
                    'automatic' => esc_html__('Automatic', 'devdesk'),
                ),
                'allow_null' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'car',
                ),
            ),
        ),
        'menu_order' => 0,
        'positon' => 'normal', // side | acf_after_title
        'style' => 'default', // seamless
        'label_placement' => 'top', //left
        'instruction_placement' => 'label', // field
        'hide_on_screen' => array(),
    ));
}

add_action('acf/init', 'devdesk_acf_metaboxes');