<?php

class Elementor_Cars_Widget extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'devdesk_cars';
	}

	public function get_title() {
		return esc_html__( 'Devdesk Cars', 'devdesk-core' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


        $this->add_control(
			'devdesk_title_one',
			[
				'label' => esc_html__( 'Title One', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'devdesk_title_two',
			[
				'label' => esc_html__( 'Title Two', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
				'default' => ''
			]
		);

		
		
		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

?>
<!-- Rent A Car Start -->
<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center"><?php echo $settings['devdesk_title_one']; ?></h1>
            <h1 class="display-4 text-uppercase text-center mb-5"><?php echo $settings['devdesk_title_two']; ?></h1>
            <div class="row">
                
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$cars = new WP_Query(array('post_type'=>'car','posts_per_page'=>3,'paged' => $paged));
				
				if($cars->have_posts()) : while($cars->have_posts()) : $cars->the_post(); ?>
				

					<?php get_template_part('partials/content', 'car'); ?> 

				<?php endwhile; ?>
					<div class="pagination">
						<?php devdesk_paginate($cars); ?>
					</div>
				<?php
				else : ?>

					<?php get_template_part('partials/content', 'none'); ?> 

				<?php endif;
				wp_reset_postdata();
				?>

            </div>
        </div>
    </div>
    <!-- Rent A Car End -->
<?php



	}

}