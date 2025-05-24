import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

const Edit = () => {
    return (
        <p {...useBlockProps()}>
            {__('My First Block – hello from the editor!', 'my-first-block')}
        </p>
    );
}

export default Edit;