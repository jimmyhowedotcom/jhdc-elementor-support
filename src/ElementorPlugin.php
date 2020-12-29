<?php

namespace JimmyHoweDotCom\Elementor\Support;

/**
 * Elementor Plugin
 *
 * @package JimmyHoweDotCom\Elementor\Support
 */
abstract class ElementorPlugin
{
    /**
     * Minimum Elementor Version
     *
     * @since 0.1.0
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 0.1.0
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Instance
     *
     * @since  0.1.0
     * @access private
     * @static
     * @var ElementorPlugin The single instance of the class.
     */
    protected static $_instance = null;

    /**
     * Constructor
     *
     * @since  0.1.0
     * @access public
     */
    public function __construct()
    {
        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Instance
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return ElementorPlugin An instance of the class.
     * @since  0.1.0
     * @access public
     * @static
     */
    public static function instance()
    {
        if (is_null(static::$_instance)) {
            static::$_instance = new static;
        }

        return static::$_instance;
    }

    /**
     * Load Textdomain
     * Load plugin localization files.
     * Fired by `init` action hook.
     *
     * @since  0.1.0
     * @access public
     */
    public function i18n()
    {
        load_plugin_textdomain($this->getDomain());
    }

    /**
     * @return string
     */
    public abstract function getDomain(): string;

    /**
     * Initialize the plugin
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     * Fired by `plugins_loaded` action hook.
     *
     * @since  0.1.0
     * @access public
     */
    public function init()
    {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);

            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, static::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);

            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, static::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);

            return;
        }

        // Register widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);

        // Register Widget Styles
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);
    }

    /**
     *
     */
    public function widget_styles()
    {

    }

    /**
     * Admin notice
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since  0.1.0
     * @access public
     */
    public function admin_notice_missing_main_plugin()
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $this->printWarningNotice($this->getMissingMainPluginNotificationMessage());
    }

    /**
     * @param string $message
     * @return int
     */
    protected function printWarningNotice(string $message): int
    {
        return printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * @return string
     */
    protected function getMissingMainPluginNotificationMessage(): string
    {
        $format = esc_html__('"%1$s" requires "%2$s" to be installed and activated.', $this->getDomain());

        $title = '<strong>' . esc_html__($this->getTitle(), $this->getDomain()) . '</strong>';

        $elementor = '<strong>' . esc_html__('Elementor', $this->getDomain()) . '</strong>';

        return sprintf($format, $title, $elementor);
    }

    /**
     * @return string
     */
    protected abstract function getTitle(): string;

    /**
     * Admin notice
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since  0.1.0
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $this->printWarningNotice($this->getMinimumElementorNotificationMessage());
    }

    /**
     * @return string
     */
    protected function getMinimumElementorNotificationMessage(): string
    {
        $format = esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', $this->getDomain());

        $title = '<strong>' . esc_html__($this->getTitle(), $this->getDomain()) . '</strong>';

        $elementor = '<strong>' . esc_html__('Elementor', $this->getDomain()) . '</strong>';

        return sprintf($format, $title, $elementor, static::MINIMUM_ELEMENTOR_VERSION);
    }

    /**
     * Admin notice
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since  0.1.0
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $this->printWarningNotice($this->getMinimumPhpNotificationMessage());
    }

    /**
     * @return string
     */
    protected function getMinimumPhpNotificationMessage(): string
    {
        $format = esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', $this->getDomain());

        $php = '<strong>' . esc_html__('PHP', $this->getDomain()) . '</strong>';

        $title = '<strong>' . esc_html__($this->getTitle(), $this->getDomain()) . '</strong>';

        return sprintf($format, $title, $php, static::MINIMUM_PHP_VERSION);
    }

    /**
     * Register widgets
     *
     * @since  0.1.0
     * @access public
     */
    public function register_widgets()
    {
        $this->includes();
    }

    /**
     * Include Files
     * Load required plugin core files.
     *
     * @since  0.1.0
     * @access public
     */
    public function includes()
    {

    }
}
