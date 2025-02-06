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
            'icon_docs',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => sprintf(
                    __('Browse all available icons at %s', 'lucide-icons'),
                    '<a href="https://lucide.dev/icons/" target="_blank">lucide.dev/icons</a>'
                ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
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
            'heading_tag',
            [
                'label' => __('Heading Tag', 'lucide-icons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'span' => 'Span',
                    'div' => 'Div',
                ],
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

        $this->start_controls_section(
            'heading_style_section',
            [
                'label' => __('Heading Style', 'lucide-icons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => ['show_heading' => 'yes']
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .lucide-heading',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Text Color', 'lucide-icons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lucide-heading' => 'color: {{VALUE}}',
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

            $heading_tag = $settings['heading_tag'];
            echo '<' . esc_html($heading_tag) . ' class="lucide-heading">'.esc_html($settings['heading_text']).'</' . esc_html($heading_tag) . '>';

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
        $icon_path = plugin_dir_path(__FILE__) . '../icons/' . $settings['icon_name'] . '.svg';
        if(file_exists($icon_path)) {
            $svg = file_get_contents($icon_path);
            echo '<script src="https://unpkg.com/lucide@latest"></script>';
            echo '<div class="lucide-icon-wrapper">' . $svg . '</div>';
            echo '<script>lucide.createIcons();</script>';
        }
    }
}

// Register the widget
add_action('elementor/widgets/register', function($widgets_manager) {
    $widgets_manager->register(new Lucide_Icon_Widget());
});
