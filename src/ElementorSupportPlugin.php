<?php

namespace JimmyHoweDotCom\Elementor\Support;

use Elementor\Plugin;
use JimmyHoweDotCom\Elementor\Support\Widgets\SuperglobalsWidget;

/**
 * Plugin
 *
 * @package JimmyHoweDotCom\Elementor\Support
 */
final class ElementorSupportPlugin extends ElementorPlugin
{
    /**
     * Plugin Version
     *
     * @since 0.1.0
     * @var string The plugin version.
     */
    const VERSION = '0.1.0';

    /**
     * Include Files
     * Load required plugin core files.
     *
     * @since  0.1.0
     * @access public
     */
    public function includes()
    {
        require_once(__DIR__ . '/Widgets/SuperglobalsWidget.php');
    }

    /**
     * Register widgets
     *
     * @since  0.1.0
     * @access public
     */
    public function register_widgets()
    {
        parent::register_widgets();

        Plugin::instance()->widgets_manager->register_widget_type(new SuperglobalsWidget());
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return 'jhdc-elementor-support';
    }

    /**
     *
     */
    public function widget_styles()
    {
        wp_register_style('jhdc-iframe-elementor-widget',
            plugins_url('css/jhdc-iframe-elementor-widget.css', __FILE__));
    }

    /**
     * @return string
     */
    protected function getTitle(): string
    {
        return 'JHDC Elementor Support';
    }
}
