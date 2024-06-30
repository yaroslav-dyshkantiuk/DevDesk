<?php

class Elementor_Slider_Widget extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'devdesk_slider';
	}

	public function get_title() {
		return esc_html__( 'Devdesk Slider', 'devdesk-core' );
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
<div class="container-fluid p-0" style="margin-bottom: 90px;">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            
                <?php 
                if ( $settings['slider'] ) {
                    echo '<div class="carousel-inner">';
                    foreach (  $settings['slider'] as $item ) { ?>
                        <div class="carousel-item active">
                            <img class="w-100" src="<?php echo esc_html($item['image']['url']); ?>" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase mb-md-3"><?php echo esc_html($item['devdesk_title_one']); ?></h4>
                                    <h1 class="display-1 text-white mb-md-4"><?php echo esc_html($item['devdesk_title_two']); ?></h1>
                                    <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    echo '</div>';
                }
                
                ?>
                
                
            
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
<?php



	}

}