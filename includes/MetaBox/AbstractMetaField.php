<?php
namespace EventOps\MetaBox;

abstract class AbstractMetaField {
    protected string $name;
    protected string $label;

    public function __construct(string $name, string $label) {
        $this->name = $name;
        $this->label = $label;
    }

    public function render($post): void {
        $value = get_post_meta($post->ID, $this->get_meta_key(), true);
        $this->render_field($value);
    }

    public function save(int $post_id): void {
        if (!isset($_POST[$this->name])) return;
        $value = $this->sanitize($_POST[$this->name]);
        if ($this->validate($value)) {
            update_post_meta($post_id, $this->get_meta_key(), $value);
        }
    }

    protected function get_meta_key(): string {
        return '_' . $this->name;
    }

    abstract protected function render_field($value): void;
    abstract protected function sanitize($value);
    abstract protected function validate($value): bool;
}