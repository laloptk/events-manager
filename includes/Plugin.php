<?php
namespace EventManager;

use EventManager\PostTypes\EventPostType;
use EventManager\Meta\EventMeta;
use EventManager\Blocks\EventBlock;

class Plugin {
    public function run() {
        (new EventPostType())->register();
        (new EventMeta())->register();
        (new EventBlock())->register();
    }
}
