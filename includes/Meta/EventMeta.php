<?php
namespace EventOps\Meta;

class EventMeta extends AbstractMetaRegistrar {
    protected function get_post_type(): string {
        return 'event';
    }
    protected function get_fields(): array {
        return ['_event_ops_start_date', '_event_ops_end_date', '_event_ops_type', '_event_ops_location', '_event_ops_description'];
    }
}
