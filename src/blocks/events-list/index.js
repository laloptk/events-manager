import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.jsx';
import save from './save.jsx';

registerBlockType('event-ops/events-list', {
    edit: Edit,
    save: save,
});
