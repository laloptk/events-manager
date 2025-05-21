<?php
/**
 * Plugin Name: EventOS
 * Description: OOP-based plugin with CPT, meta fields, and Gutenberg block.
 * Version: 1.0
 * Author: Eduardo Sanchez Hidalgo
 * Text Domain: event-os
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/Loader.php';

use EventOS\Plugin;

function event_manager_bootstrap() {
    $plugin = new EventOS\Plugin();
    $plugin->run();
}
add_action('plugins_loaded', 'event_manager_bootstrap');