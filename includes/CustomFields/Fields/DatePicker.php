<?php
namespace EventOps\MetaBox\Field;

use EventOps\MetaBox\AbstractMetaField;
/**
 * Class DatePicker
 * @package EventOps\MetaBox\Field
 *
 * A custom meta field for selecting a date.
 */
class DatePicker extends AbstractMetaField {
    protected function render_field($value): void {
        printf(
            '<p><label for="%1$s">%2$s</label><br><input type="date" class="widefat" name="%1$s" id="%1$s" value="%3$s" /></p>',
            esc_attr($this->name),
            esc_html__($this->label, 'evennt-os'),
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