<?php
namespace EventOS;

use EventOS\PostTypes\EventPostType;
use EventOS\Meta\EventMeta;
use EventOS\Blocks\EventBlock;
use EventOS\Settings\SettingsPage;

class Plugin {
    public function run() {
        (new EventPostType())->register();
        (new EventMeta())->register();
        (new EventBlock())->register();
        (new SettingsPage())->register();
    }
}
