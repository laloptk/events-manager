<?php
namespace EventOS\MetaBox\Field;

use EventOS\AbstractMetaField;

class Textarea extends AbstractMetaField {
    protected function render_field($value): void {
        printf(
            '<p><label for="%1$s">%2$s</label><br><textarea class="widefat" name="%1$s" id="%1$s" rows="4">%3$s</textarea></p>',
            esc_attr($this->name),
            esc_html__($this->label, 'event-os'),
            esc_textarea($value)
        );
    }

    protected function sanitize($value) {
        return sanitize_textarea_field($value);
    }

    protected function validate($value): bool {
        return is_string($value);
    }
}
