<?php
/*
Plugin Name: PK Elementor Lucide
Description: Add customizable Lucide icons in Elementor widgets with advanced styling options.
Version: 1.1.0
Author: Pieter Keuzenkamp
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define('PK_ELEMENTOR_LUCIDE_VERSION', '1.1.0');

// Enqueue Lucide Script and Styles
function lucide_enqueue_scripts() {
    wp_enqueue_script('lucide-icons', 'https://unpkg.com/lucide@latest', array(), null, true);
    wp_enqueue_style('lucide-icons-style', plugin_dir_url(__FILE__) . 'css/pk-elementor-lucide.css');
}
add_action('wp_enqueue_scripts', 'lucide_enqueue_scripts');

// Elementor Widget Registration
add_action('elementor/widgets/widgets_registered', function() {
    if ( defined('ELEMENTOR_PATH') && class_exists('Elementor\\Widget_Base') ) {
        require_once(__DIR__ . '/widgets/lucide-icon-widget.php');
    }
});
