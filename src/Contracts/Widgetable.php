<?php

namespace JimmyHoweDotCom\Elementor\Support\Contracts;

/**
 * Elementor Widget Contract
 *
 * @package JimmyHoweDotCom\Elementor\Support
 */
interface Widgetable
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
    public function get_icon();

    /**
     * Get widget categories.
     *
     * Retrieve the widget categories.
     *
     * @return array Widget categories.
     * @since 1.0.10
     * @access public
     */
    public function get_categories();

    /**
     * Get element title.
     *
     * Retrieve the element title.
     *
     * @return string Element title.
     * @since 1.0.0
     * @access public
     */
    public function get_title();

    /**
     * Get element name.
     *
     * Retrieve the element name.
     *
     * @return string The name.
     * @since 1.4.0
     * @access public
     */
    public function get_name();

}
