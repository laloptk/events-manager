<?php
namespace EventOps\MetaBox;

abstract class AbstractMetaBox {
    protected string $id;
    protected string $title;
    protected string $screen;
    protected array $fields = [];

    public function __construct() {
        add_action('add_meta_boxes', [$this, 'register']);
        add_action("save_post_{$this->get_screen()}", [$this, 'save']);
    }

    public function register(): void {
        add_meta_box(
            $this->get_id(),
            $this->get_title(),
            [$this, 'render'],
            $this->get_screen(),
            'normal',
            'default'
        );
    }

    public function render($post): void {
        wp_nonce_field($this->get_id() . '_nonce_action', $this->get_id() . '_nonce');
        foreach ($this->fields as $field) {
            $field->render($post);
        }
    }

    public function save(int $post_id): void {
        if (!isset($_POST[$this->get_id() . '_nonce']) ||
            !wp_verify_nonce($_POST[$this->get_id() . '_nonce'], $this->get_id() . '_nonce_action') ||
            defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ||
            ! current_user_can('edit_post', $post_id)
        ) {
            return;
        }

        foreach ($this->fields as $field) {
            $field->save($post_id);
        }
    }

    abstract protected function get_id(): string;
    abstract protected function get_title(): string;
    abstract protected function get_screen(): string;
}
