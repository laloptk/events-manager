<?php
namespace EventOps\Blocks;

abstract class AbstractBlock {
    abstract protected function get_block_type(): string;

    public function register() {
        add_action('init', function () {
            register_block_type($this->get_block_type());
        });
    }
}
