<?php
namespace EventOps;

use EventOps\PostTypes\EventPostType;
use EventOps\Meta\EventMeta;
use EventOps\Blocks\Blocks;
use EventOps\Settings\SettingsPage;
use EventOps\MetaBox\Event\EventMetaBox;
/**
 * Class Plugin
 * @package EventOps
 *
 * Main plugin class that initializes all components.
 */
class EventOpsPlugin {
    private static ?EventOpsPlugin $instance = null;

    public static function get_instance(): EventOpsPlugin {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('plugins_loaded', [$this, 'run_on_plugins_loaded']);
        add_action('init', [$this, 'run_on_init']);
    }
    public function run_on_plugins_loaded() {
        (new EventPostType())->register();
        (new EventMeta())->register();
        (new SettingsPage())->register();
        new EventMetaBox();
    }

    public function run_on_init() {
        (new Blocks())->register();
    }
}
