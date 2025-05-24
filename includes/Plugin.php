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
class Plugin {
    public function run() {
        (new EventPostType())->register();
        (new EventMeta())->register();
        (new SettingsPage())->register();
        new EventMetaBox();
    }

    public function register_blocks() {
        (new Blocks())->register();
    }
}
