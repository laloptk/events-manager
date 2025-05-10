import { registerBlockType } from '@wordpress/blocks';

registerBlockType('em/event-block', {
    edit: () => {
        return <p>Edit Event Block – customize this to pull event data.</p>;
    },
    save: () => {
        return <p>Event block front-end output.</p>;
    }
});
