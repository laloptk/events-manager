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
            'supports' => ['title', 'editor', 'thumbnail', 'custom-fields', "author"],
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
        ];
    }
}
