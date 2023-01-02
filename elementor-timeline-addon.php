<?php
/**
 * Plugin Name: Elementor Timeline Addon
 * Description: Add Timeline section to your pages
 * Version:     1.0.0
 * Author:      Admin
 * Text Domain: ea-timeline
 *
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Widget.
 *
 * Include widget file and register widget class.
 *
 * @author multanishebaz@gmail.com
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_oembed_widget( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/timeline.php' );

    $widgets_manager->register( new \Timeline_Widget() );

}
add_action( 'elementor/widgets/register', 'register_oembed_widget' );
