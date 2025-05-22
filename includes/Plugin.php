<?php
namespace EventOps;

use EventOps\PostTypes\EventPostType;
use EventOps\Meta\EventMeta;
use EventOps\Blocks\EventBlock;
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
        (new EventBlock())->register();
        (new SettingsPage())->register();
        new EventMetaBox();
    }
}
