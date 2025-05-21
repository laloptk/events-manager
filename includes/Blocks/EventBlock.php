<?php
namespace EventOS\Blocks;

class EventBlock extends AbstractBlock {
    protected function get_block_type(): string {
        return 'em/event-block';
    }
}
