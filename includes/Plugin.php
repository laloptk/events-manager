<?php
namespace EventOps;

use EventOps\PostTypes\EventPostType;
use EventOps\Meta\EventMeta;
use EventOps\Blocks\EventBlock;
use EventOps\Settings\SettingsPage;

class Plugin {
    public function run() {
        (new EventPostType())->register();
        (new EventMeta())->register();
        (new EventBlock())->register();
        (new SettingsPage())->register();
    }
}
