import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.jsx';
import save from './save.jsx';

registerBlockType('event-ops/events-list-w-filters', {
    edit: Edit,
    save: save,
});
