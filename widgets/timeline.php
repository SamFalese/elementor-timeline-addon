<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Selective Post Lisitngs Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @author richie.harris@singlemindconsulting.com
 * @since 1.0.0
 */
class Timeline_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @author richie.harris@singlemindconsulting.com
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Elementor-timeline-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @author richie.harris@singlemindconsulting.com
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Timeline widget', 'ea-timeline' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @author richie.harris@singlemindconsulting.com
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-time-line';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @author richie.harris@singlemindconsulting.com
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return '';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @author richie.harris@singlemindconsulting.com
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @author richie.harris@singlemindconsulting.com
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'timeline', 'milestone', 'tree' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @author richie.harris@singlemindconsulting.com
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'timeline_section',
			[
				'label' => esc_html__( 'Timeline', 'ea-timeline' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'ea-timeline' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'ea-timeline' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_icon',
			[
				'label' => esc_html__( 'Icon', 'ea-timeline' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);

		// $repeater->add_control(
		// 	'list_color',
		// 	[
		// 		'label' => esc_html__( 'Color', 'ea-timeline' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		//'selectors' => [ '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}' ],
		// 	]
		// );


		$repeater->add_control(
			'list_content', [
				'label' => esc_html__( 'Content', 'ea-timeline' ),
				// 'type' => \Elementor\Controls_Manager::WYSIWYG,
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'List Content' , 'ea-timeline' ),
				'show_label' => false,
			]
		);


		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'ea-timeline' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'ea-timeline' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'ea-timeline' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'ea-timeline' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'ea-timeline' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @author richie.harris@singlemindconsulting.com
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		ob_start();
		$settings = $this->get_settings_for_display();
		$settings = $this->get_settings_for_display();

		echo '<div id="timeline" class="smc-timeline-wrapper">';
			echo '<div class="smc-timeline" style="padding:0px">';
					echo '<div class="smc-progress-bar" style="z-index:1001;width:4px;top:0;bottom:0!important;position:absolute;background:#ffffff9e;">'.
						'<div class="smc-progress-bar-inner-line" style="background: rgb(255, 163, 64);"></div>'.
					'</div>';

					if ( $settings['list'] ) {
						echo '<div class="smc-site-wrap" style="padding-top: 50px; padding-bottom:0">';
						foreach (  $settings['list'] as $item ) {
							echo '<div class="timeline-box">'.
										'<div class="timeline-info">'.
											'<h3 class="elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">' . $item['list_title'] . '</h3>'.
											'<p>'. $item['list_content'] . '</p>'.
										'</div>'.
									'<div class="timeline-icon">'.
										'<div class="my-icon-wrapper">';
											\Elementor\Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] );
										echo '</div>'.
									'</div>'.
							'</div>';
						}
						echo '<div class="arrow-down">'.
							'<img src="'. get_template_directory_uri() . '/images/up-2.png" alt="arrow-down" style="opacity: 0.8;">'.
						'</div>';

						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		// echo '<progress min="0" max="100" value="0"></progress>';

		// echo '<div class="progress-container">'.
	  //   '<div class="progress-bar" id="myBar"></div>'.
	  // '</div>';

		echo ob_get_clean();
	}

	protected function content_template() {
		?>
		<# if ( settings.list.length ) { #>
		<dl>
			<# _.each( settings.list, function( item ) { #>
				<dt class="elementor-repeater-item-{{ item._id }}">{{{ item.list_title }}}</dt>
				<dd>{{{ item.list_content }}}</dd>
			<# }); #>
			</dl>
		<# } #>
		<?php
	}
}
