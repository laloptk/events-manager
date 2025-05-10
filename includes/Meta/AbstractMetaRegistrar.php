<?php
namespace EventManager\Meta;

abstract class AbstractMetaRegistrar {
    abstract protected function get_post_type(): string;
    abstract protected function get_fields(): array;

    public function register() {
        add_action('init', function () {
            foreach ($this->get_fields() as $field) {
                register_post_meta($this->get_post_type(), $field, [
                    'type' => 'string',
                    'single' => true,
                    'show_in_rest' => true,
                    'sanitize_callback' => 'sanitize_text_field',
                    'auth_callback' => function () {
                        return current_user_can('edit_posts');
                    }
                ]);
            }
        });
    }
}
