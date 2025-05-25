<?php
namespace EventOps\MetaBox\Fields;

use EventOps\MetaBox\AbstractMetaField;
/**
 * Class Date
 * @package EventOps\MetaBox\Field
 *
 * A custom meta field for selecting a date.
 */
class Date extends AbstractMetaField {
    protected function render_field($value): void {
        printf(
            '<p><label for="%1$s">%2$s</label><br><input type="date" class="widefat" name="%1$s" id="%1$s" value="%3$s" /></p>',
            esc_attr($this->name),
            esc_html__($this->label, 'event-ops'),
            esc_attr($value)
        );
    }

    protected function sanitize($value) {
        return sanitize_text_field($value);
    }

    protected function validate($value): bool {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $value) === 1;
    }
}