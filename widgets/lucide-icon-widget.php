<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Lucide_Icon_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'lucide_icon';
    }

    public function get_title() {
        return __('Lucide Icon', 'lucide-icons');
    }

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Icon Settings', 'pk-elementor-lucide'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_name',
            [
                'label' => __('Icon Name', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'circle',
                'label_block' => true,
                'description' => __('Enter Lucide icon name (e.g. circle, heart, star)', 'pk-elementor-lucide'),
            ]
        );

        $this->add_control(
            'icon_stroke_width',
            [
                'label' => __('Stroke Width', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 0.5,
                'max' => 4,
                'step' => 0.1,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->add_control(
            'show_heading',
            [
                'label' => __('Show Heading', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'pk-elementor-lucide'),
                'label_off' => __('No', 'pk-elementor-lucide'),
                'default' => 'no',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label' => __('Heading Text', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('New Heading', 'pk-elementor-lucide'),
                'label_block' => true,
                'condition' => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_tag',
            [
                'label' => __('Heading Tag', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'condition' => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => __('Icon Position', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __('Left', 'pk-elementor-lucide'),
                    'right' => __('Right', 'pk-elementor-lucide'),
                    'above' => __('Above', 'pk-elementor-lucide'),
                    'below' => __('Below', 'pk-elementor-lucide'),
                ],
                'condition' => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style sectie toevoegen
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style Settings', 'pk-elementor-lucide'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0.1,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 0.1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lucide-icon' => '--icon-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __('Icon Spacing', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pk-position-left .lucide-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pk-position-right .lucide-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pk-position-above .lucide-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pk-position-below .lucide-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section voor Heading Typography
        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => __('Heading Style', 'pk-elementor-lucide'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'label' => __('Typography', 'pk-elementor-lucide'),
                'selector' => '{{WRAPPER}} .lucide-icon-text, {{WRAPPER}} .lucide-icon-text *',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Heading Color', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lucide-icon-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __('Margin', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lucide-icon-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function get_style_depends() {
        return ['pk-elementor-lucide'];
    }

    public function get_script_depends() {
        return ['lucide-icons', 'pk-elementor-lucide-init'];
    }

    public function get_settings_for_display($setting_key = null) {
        try {
            $settings = parent::get_settings_for_display($setting_key);
            if ($setting_key === null) {
                return array_merge($this->get_default_settings(), (array)$settings);
            }
            return $settings[$setting_key] ?? $this->get_default_settings()[$setting_key] ?? null;
        } catch (\Throwable $e) {
            error_log('[Lucide Widget] Settings error: ' . $e->getMessage());
            return $setting_key === null ? $this->get_default_settings() : null;
        }
    }
    
    private function get_default_settings() {
        return [
            'icon_name' => 'circle',
            'icon_stroke_width' => 2,
            'icon_color' => '#000000',
            'show_heading' => 'no',
            'heading_text' => __('New Heading', 'pk-elementor-lucide'),
            'heading_tag' => 'h2',
            'icon_position' => 'left'
        ];
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $has_heading = $settings['show_heading'] ?? 'no';

        echo '<div class="lucide-icon-container pk-position-'.$settings['icon_position'].'">';

        if($has_heading === 'yes') {
            echo '<div class="pk-icon-heading">';
            if(in_array($settings['icon_position'] ?? 'left', ['left', 'above'])) {
                $this->render_icon($settings);
            }

            $heading_tag = $settings['heading_tag'] ?? 'h2';
            echo '<' . esc_html($heading_tag) . ' class="lucide-icon-text">'.esc_html($settings['heading_text'] ?? '').'</' . esc_html($heading_tag) . '>';

            if(in_array($settings['icon_position'] ?? 'left', ['right', 'below'])) {
                $this->render_icon($settings);
            }
            echo '</div>';
        } else {
            $this->render_icon($settings);
        }

        echo '</div>';
    }

    protected function render_icon($settings) {
        $icon_name = esc_attr($settings['icon_name'] ?? 'circle');
        $stroke_width = esc_attr($settings['icon_stroke_width'] ?? 2);
        $color = esc_attr($settings['icon_color'] ?? '#000000');
        
        printf(
            '<div class="lucide-icon" style="stroke-width: %s; color: %s;" data-lucide="%s"></div>',
            $stroke_width,
            $color,
            $icon_name
        );
    }

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        
        wp_register_style(
            'pk-elementor-lucide',
            plugins_url('css/pk-elementor-lucide.css', dirname(__FILE__)),
            [],
            '1.1.6'
        );
    }
}

// Register the widget
add_action('elementor/widgets/register', function($widgets_manager) {
    $widgets_manager->register(new Lucide_Icon_Widget());
});
