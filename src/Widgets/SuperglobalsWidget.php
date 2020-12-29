<?php

namespace JimmyHoweDotCom\Elementor\Support\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use JimmyHoweDotCom\Elementor\Support\Contracts\Widgetable;
use JimmyHoweDotCom\Elementor\Support\ElementorWidget;
use JimmyHoweDotCom\Elementor\Support\Helpers\WidgetCategories;

/**
 * Superglobals Widget
 *
 * @package JimmyHoweDotCom\Elementor\Support
 */
class SuperglobalsWidget extends ElementorWidget implements Widgetable
{
    /**
     * Get widget icon.
     *
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     */
    public function get_icon()
    {
        return parent::get_icon();
    }

    /**
     * Get widget categories.
     *
     * Retrieve the widget categories.
     *
     * @return array Widget categories.
     * @since 1.0.10
     * @access public
     */
    public function get_categories()
    {
        return [
            WidgetCategories::GENERAL
        ];
    }

    /**
     * Get element title.
     *
     * Retrieve the element title.
     *
     * @return string Element title.
     * @since 1.0.0
     * @access public
     */
    public function get_title()
    {
        return "Superglobals";
    }

    /**
     * Get element name.
     *
     * Retrieve the element name.
     *
     * @return string The name.
     * @since 1.4.0
     * @access public
     */
    public function get_name()
    {
        return 'jhdc-elementor-support-suberglobals';
    }

    /**
     * Register controls.
     *
     * Used to add new controls to any element type. For example, external
     * developers use this method to register controls in a widget.
     *
     * Should be inherited and register new controls using `add_control()`,
     * `add_responsive_control()` and `add_group_control()`, inside control
     * wrappers like `start_controls_section()`, `start_controls_tabs()` and
     * `start_controls_tab()`.
     *
     * @since 1.4.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'jimmyhowedotcom'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'select_superglobal',
            [
                'label'   => __('Superglobal', 'jimmyhowedotcom'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '$_SERVER'  => __('$_SERVER', 'jimmyhowedotcom'),
                    '$_REQUEST' => __('$_REQUEST', 'jimmyhowedotcom'),
                    '$_POST'    => __('$_POST', 'jimmyhowedotcom'),
                    '$_GET'     => __('$_GET', 'jimmyhowedotcom'),
                    '$_FILES'   => __('$_FILES', 'jimmyhowedotcom'),
                    '$_ENV'     => __('$_ENV', 'jimmyhowedotcom'),
                    '$_COOKIE'  => __('$_COOKIE', 'jimmyhowedotcom'),
                    '$_SESSION' => __('$_SESSION', 'jimmyhowedotcom'),
                ],
                'default' => 'globals',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render element.
     *
     * Generates the final HTML on the frontend.
     *
     * @since 2.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $results = [];

        switch ($settings['select_superglobal']) {
            case '$_SERVER':
                $results = $_SERVER;
                break;
            case '$_REQUEST':
                $results = $_REQUEST;
                break;
            case '$_POST':
                $results = $_POST;
                break;
            case '$_GET':
                $results = $_GET;
                break;
            case '$_FILES':
                $results = $_FILES;
                break;
            case '$_ENV':
                $results = $_ENV;
                break;
            case '$_COOKIE':
                $results = $_COOKIE;
                break;
            case '$_SESSION':
                $results = $_SESSION;
                break;

        }

        foreach ($results as $key => $value) {
            echo $key . " => " . $value . "<br>";
        }
    }


}
