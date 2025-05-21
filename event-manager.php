<?php
/**
 * Plugin Name: EventOps
 * Description: OOP-based plugin with CPT, meta fields, and Gutenberg block.
 * Version: 1.0
 * Author: Eduardo Sanchez Hidalgo
 * Text Domain: event-ops
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/Loader.php';

use EventOps\Plugin;

function event_manager_bootstrap() {
    $plugin = new EventOps\Plugin();
    $plugin->run();
}
add_action('plugins_loaded', 'event_manager_bootstrap');