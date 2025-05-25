import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { getEntityRecords } from '@wordpress/core-data';

const Edit = () => {
    return (
        <p {...useBlockProps()}>
            {__('Event List – hello from the editor!', 'my-first-block')}
        </p>
    );
}

export default Edit;