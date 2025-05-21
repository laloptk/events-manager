<?php
namespace EventOps\Settings;
abstract class AbstractSettings {
    abstract protected function get_settings_page(): string;
    abstract protected function get_settings(): array;

    public function register() {
        add_action('admin_menu', function () {
            add_options_page(
                'Event Manager Settings',
                'Event Manager',
                'manage_options',
                $this->get_settings_page(),
                [$this, 'render_settings_page']
            );
        });

        add_action('admin_init', function () {
            foreach ($this->get_settings() as $setting) {
                register_setting('event_manager_settings_group', $setting);
            }
        });
    }
}