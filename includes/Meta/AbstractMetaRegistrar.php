<?php
namespace EventManager\Meta;

abstract class AbstractMetaRegistrar {
    abstract protected function get_post_type(): string;
    abstract protected function get_fields(): array;

    protected function register_meta_to_rest_api($field) {        
        register_rest_field($this->get_post_type(), $field, [
            'get_callback' => function ($object) use ($field) {
                return get_post_meta($object['id'], $field, true);
            },
            'update_callback' => function ($value, $object) use ($field) {
                update_post_meta($object->ID, $field, sanitize_text_field($value));
            },
            'schema' => [
                'type' => 'string',
                'context' => ['view', 'edit'],
            ],
        ]);
    }

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
            $this->register_meta_to_rest_api($field);
        });
    }
}
