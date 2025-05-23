<?php
namespace EventOps\Blocks;

class EventBlock extends AbstractBlock {
    protected function get_block_type(): string {
        return 'event-ops/event-block';
    }
}
