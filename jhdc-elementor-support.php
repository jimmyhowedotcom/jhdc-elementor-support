<?php

/*
Plugin Name: JHDC Elementor Support
Plugin URI: https://jimmyhowe.com
Description: Supports Elementor plugins development.
Version: 0.1.0
Author: JimmyHowe.com LTD
Author URI: https://jimmyhowe.com
License: JimmyHowe.com LTD 2021
Text Domain: jimmyhowedotcom
*/

use Elementor\Elements_Manager;
use JimmyHoweDotCom\Elementor\Support\ElementorSupportPlugin;

if (!defined('ABSPATH')) {
    exit;
}

require __DIR__ . '/vendor/autoload.php';

/*
 * Boot the plugin...
 */
ElementorSupportPlugin::instance();

/**
 * Adds the JimmyHowe.com Widgets Category.
 *
 * @param $elements_manager
 */
function add_jhdc_elementor_support_categories(Elements_Manager $elements_manager)
{
    $elements_manager->add_category('jhdc-elementor-support-widgets', [
        'title' => __('JimmyHowe.com Support Widgets', 'jimmyhowedotcom'),
        'icon' => 'fa fa-home',
    ]);
}

add_action('elementor/elements/categories_registered', 'add_jhdc_elementor_support_categories');
