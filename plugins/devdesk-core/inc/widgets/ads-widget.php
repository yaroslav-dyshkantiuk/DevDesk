<?php

class Elementor_Ads_Widget extends \Elementor\Widget_Base {

	
	public function get_name() {
		return 'devdesk_ads';
	}

	public function get_title() {
		return esc_html__( 'Devdesk Ads', 'devdesk-core' );
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
			'devdesk_title_left',
			[
				'label' => esc_html__( 'Title Left', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Want to be driver?',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'devdesk_title_two',
			[
				'label' => esc_html__( 'Title Right', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
				'default' => 'Looking for a car?'
			]
		);

		$this->add_control(
			'image_left',
			[
				'label' => __( 'Choose Image Left', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'image_right',
			[
				'label' => __( 'Choose Image Right', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


        $this->add_control(
			'devdesk_description_left',
			[
				'label' => esc_html__( 'Description Left', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
				'default' => 'Lorem justo sit sit ipsum eos lorem kasd, kasd labore',
			]
		);
        $this->add_control(
			'devdesk_description_right',
			[
				'label' => esc_html__( 'Description Left', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
				'default' => 'Lorem justo sit sit ipsum eos lorem kasd, kasd labore',
            ]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

?>
<div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0">
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-secondary d-flex align-items-center justify-content-between" style="height: 350px;">
                        <img class="img-fluid flex-shrink-0 ml-n5 w-50 mr-4" src="<?php echo esc_url($settings['image_left']['url']); ?>" alt="">
                        <div class="text-right">
                            <?php if($settings['devdesk_title_left']){ ?><h3 class="text-uppercase text-light mb-3"><?php echo esc_html($settings['devdesk_title_left']); ?></h3><?php } ?>
                            <p class="mb-4"><?php echo esc_html($settings['devdesk_description_left']); ?></p>
                            <a class="btn btn-primary py-2 px-4" href="">Start Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-0">
                    <div class="px-5 bg-dark d-flex align-items-center justify-content-between" style="height: 350px;">
                        <div class="text-left">
                            <h3 class="text-uppercase text-light mb-3"><?php echo esc_html($settings['devdesk_title_left']); ?></h3>
                            <p class="mb-4"><?php echo esc_html($settings['devdesk_description_right']); ?></p>
                            <a class="btn btn-primary py-2 px-4" href=""><?php esc_html_e('Start Now','devdesk'); ?></a>
                        </div>
                        <img class="img-fluid flex-shrink-0 mr-n5 w-50 ml-4" src="<?php echo esc_url($settings['image_right']['url']); ?>" alt="">
                    </div>
                </div>
            </div>
    </div>
    </div>
<?php



	}

}