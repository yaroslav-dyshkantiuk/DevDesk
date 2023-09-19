<?php

class Devdesk_About_Widget extends WP_Widget {
    function __construct(){
        parent::__construct('devdesk_about_widget', esc_html__('About Widget', 'devdesk'), array('description' => esc_html__('Our First Widget', 'devdesk')));
    }

    public function widget($args, $instance){
        // frontend
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $text = apply_filters('the_content', $instance['text']); 

        echo $before_widget;

        if($title) {
            echo $before_title . esc_html($title) . $after_title;
        }
        if($text) {
            echo wp_kses_post( $text );
        }

        echo $after_widget;
    }

    public function form($instance) {
        // backend
        if(isset($instance['title'])){
            $title = $instance['title'];
        } else {
            $title = '';
        }

        if(isset($instance['text'])){
            $text = $instance['text'];
        } else {
            $text = '';
        }

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php esc_html_e('Title', 'devdesk'); ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>">
                <?php esc_html_e('Text', 'devdesk'); ?>
            </label>
            <textarea type="text" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>">
                <?php echo esc_attr($text); ?>
            </textarea>
        </p>

        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['text'] = strip_tags($new_instance['text']);

        return $instance;
    }
}

function devdesk_register_about_widget() {
	register_widget( 'devdesk_about_widget' );
}
add_action( 'widgets_init', 'devdesk_register_about_widget' );