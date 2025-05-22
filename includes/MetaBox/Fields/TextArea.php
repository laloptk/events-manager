<?php
namespace EventOps\MetaBox\Fields;

use EventOps\MetaBox\AbstractMetaField;
/**
 * Class Text
 * @package EventOps\MetaBox\Field
 *
 * A custom meta field for entering text.
 */
class TextArea extends AbstractMetaField {
    protected function render_field($value): void {
        printf(
            '<p><label for="%1$s">%2$s</label><br><textarea class="widefat" name="%1$s" id="%1$s" rows="4">%3$s</textarea></p>',
            esc_attr($this->name),
            esc_html__($this->label, 'event-ops'),
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
