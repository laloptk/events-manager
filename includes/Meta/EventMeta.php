<?php
namespace EventManager\Meta;

class EventMeta extends AbstractMetaRegistrar {
    protected function get_post_type(): string {
        return 'event';
    }

    protected function get_fields(): array {
        return ['date', 'type', 'location', 'description'];
    }
}
