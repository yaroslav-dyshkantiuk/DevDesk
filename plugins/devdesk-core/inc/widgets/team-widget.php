<?php

class Elementor_Team_Widget extends \Elementor\Widget_Base {

	public function get_script_depends(){
		if(\Elementor\Plugin::$instance->preview->is_preview_mode()){
			wp_register_script('dd-team', plugins_url('/js/dd-team.js', __FILE__), ['elementor-frontend'], ' 1.0', true);
			return ['dd-team'];
		}
		return [];
	}
	
	public function get_name() {
		return 'devdesk_team';
	}

	public function get_title() {
		return esc_html__( 'Devdesk Team', 'devdesk-core' );
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'devdesk_title_one',
			[
				'label' => esc_html__( 'Title One', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'devdesk_title_two',
			[
				'label' => esc_html__( 'Title Two', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
				'default' => ''
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'slider',
			[
				'label' => __( 'Slider', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ devdesk_title_one }}}',
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

?>

<div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="display-1 text-primary text-center">04</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Meet Our Team</h1>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                
                <?php 
                if ( $settings['slider'] ) {
                    
                    foreach (  $settings['slider'] as $item ) { ?>
                        <div class="team-item">
                            <img class="img-fluid w-100" src="<?php echo esc_url($item['image']['url']) ?>" alt="">
                            <div class="position-relative py-4">
                                <h4 class="text-uppercase"><?php echo esc_html($item['devdesk_title_one']); ?></h4>
                                <p class="m-0"><?php echo esc_html($item['devdesk_title_two']); ?></p>
                                <div class="team-social position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                                    <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php }
                   
                }
                
                ?>
            </div>
        </div>
    </div>
                
                
             
<?php



	}

}