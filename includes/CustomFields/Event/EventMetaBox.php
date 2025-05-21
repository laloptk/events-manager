<?php
namespace EventOps\MetaBox\Event;

use EventOps\MetaBox\AbstractMetaBox;
use EventOps\MetaBox\Field\Text;
use EventOps\MetaBox\Field\Date;
use EventOps\MetaBox\Field\Textarea;

class EventMetaBox extends AbstractMetaBox {
    protected function get_id(): string {
        return 'event_meta_box';
    }

    protected function get_title(): string {
        return __('Event Details', 'event-ops');
    }

    protected function get_screen(): string {
        return 'event';
    }

    public function __construct() {
        $this->fields = [
            new Text('event_ops_location', __('Location', 'event-ops')),
            new Date('event_ops_start_date', __('Start Date', 'event-ops')),
            new Date('event_ops_end_date', __('End Date', 'event-ops')),
            new Text('event_ops_type', __('Type', 'event-ops')),
            new Textarea('event_ops_description', __('Description', 'event-ops')),
        ];
        parent::__construct();
    }
}
