<?php
namespace EventOps\PostTypes;

class EventPostType extends AbstractPostType {
    protected function get_post_type(): string {
        return 'event';
    }

    protected function get_args(): array {
        return [
            'label' => 'Events',
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-calendar-alt',
            'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        ];
    }
}
