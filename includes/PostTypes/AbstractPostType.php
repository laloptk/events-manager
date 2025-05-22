<?php
namespace EventOps\PostTypes;

abstract class AbstractPostType {
    abstract protected function get_post_type(): string;
    abstract protected function get_args(): array;

    public function register() {
        add_action('init', function () {
            register_post_type($this->get_post_type(), $this->get_args());
        });
    }
}
