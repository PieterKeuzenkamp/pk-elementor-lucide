<?php
/**
 * Plugin Name: PK Elementor Lucide Icons
 * Description: Voegt Lucide icons toe aan Elementor
 * Version: 1.1.6
 * Author: Pieter Keuzenkamp
 * Text Domain: pk-elementor-lucide
 */

defined('ABSPATH') || exit;

// Load translations
add_action('init', function() {
    load_plugin_textdomain('pk-elementor-lucide', false, dirname(plugin_basename(__FILE__)) . '/languages');
});

// Register scripts and styles
add_action('wp_enqueue_scripts', function() {
    wp_register_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest',
        [],
        null,
        true
    );

    wp_register_script(
        'pk-elementor-lucide-init',
        plugins_url('assets/js/lucide-init.js', __FILE__),
        ['lucide-icons'],
        '1.1.6',
        true
    );

    wp_enqueue_style(
        'pk-elementor-lucide',
        plugins_url('css/pk-elementor-lucide.css', __FILE__),
        [],
        '1.1.6'
    );

    wp_enqueue_script('lucide-icons');
    wp_enqueue_script('pk-elementor-lucide-init');
});

// Update ACF filter with proper error handling
add_filter('elementor_pro/dynamic_tags/acf/text', function($value) {
    if (!is_array($value)) {
        return ['', '', 'type' => 'text'];
    }
    
    // Ensure string values for processing
    $value[0] = is_string($value[0]) ? $value[0] : '';
    $value[1] = is_string($value[1]) ? $value[1] : '';
    
    return array_merge($value, ['type' => 'text']);
});

// Register Elementor widget
add_action('elementor/widgets/register', function($widgets_manager) {
    require_once(__DIR__ . '/widgets/lucide-icon-widget.php');
    $widgets_manager->register(new \Lucide_Icon_Widget());
});
