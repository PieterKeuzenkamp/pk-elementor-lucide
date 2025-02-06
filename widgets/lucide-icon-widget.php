<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

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
                'label' => __('Icon Settings', 'lucide-icons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_name',
            [
                'label' => __('Icon Name', 'lucide-icons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'camera',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'lucide-icons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .lucide-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size (px)', 'lucide-icons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 50,
                ],
            ]
        );

        $this->add_control(
            'icon_stroke_width',
            [
                'label' => __('Stroke Width', 'lucide-icons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 1,
                'max' => 5,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'lucide-icons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'box_shadow',
            [
                'label' => __('Box Shadow', 'lucide-icons'),
                'type' => \Elementor\Controls_Manager::BOX_SHADOW,
            ]
        );

        $this->add_control(
            'show_heading',
            [
                'label' => __('Show Heading', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'pk-elementor-lucide'),
                'label_off' => __('No', 'pk-elementor-lucide'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'heading_text',
            [
                'label' => __('Heading Text', 'pk-elementor-lucide'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heading Text',
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
                'options' => [
                    'left' => __('Left', 'pk-elementor-lucide'),
                    'right' => __('Right', 'pk-elementor-lucide'),
                    'above' => __('Above', 'pk-elementor-lucide'),
                    'below' => __('Below', 'pk-elementor-lucide'),
                ],
                'default' => 'left',
                'condition' => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $has_heading = $settings['show_heading'] === 'yes';

        echo '<div class="lucide-icon-container pk-position-'.$settings['icon_position'].'">';

        if($has_heading) {
            echo '<div class="pk-icon-heading">';
            if(in_array($settings['icon_position'], ['left', 'above'])) {
                $this->render_icon($settings);
            }

            echo '<h3 class="pk-heading-text">'.esc_html($settings['heading_text']).'</h3>';

            if(in_array($settings['icon_position'], ['right', 'below'])) {
                $this->render_icon($settings);
            }
            echo '</div>';
        } else {
            $this->render_icon($settings);
        }

        echo '</div>';
    }

    private function render_icon($settings) {
        echo '<i class="lucide-icon" data-lucide="'.esc_attr($settings['icon_name']).'" 
              style="color: '.esc_attr($settings['icon_color']).';
                     width: '.esc_attr($settings['icon_size']['size']).'px;
                     height: '.esc_attr($settings['icon_size']['size']).'px;"></i>';
    }
}

// Register the widget
add_action('elementor/widgets/register', function($widgets_manager) {
    $widgets_manager->register(new Lucide_Icon_Widget());
});
