<?php
/**
 * Plugin Name: EventOps
 * Description: OOP-based plugin with CPT, meta fields, and Gutenberg block.
 * Version: 1.0
 * Author: Eduardo Sanchez Hidalgo
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/Loader.php';

use EventOps\EventOpsPlugin;
function eventops_load_textdomain() {
    load_plugin_textdomain('event-ops', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('init', 'eventops_load_textdomain');

EventOpsPlugin::get_instance();

