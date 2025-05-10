<?php
/**
 * Plugin Name: Event Manager
 * Description: OOP-based plugin with CPT, meta fields, and Gutenberg block.
 * Version: 1.0
 * Author: Your Name
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/Loader.php';

use EventManager\Plugin;

function event_manager_bootstrap() {
    $plugin = new EventManager\Plugin();
    $plugin->run();
}
add_action('plugins_loaded', 'event_manager_bootstrap');