import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useEntityRecords } from '@wordpress/core-data';
import { Spinner } from '@wordpress/components';
import {InspectorControls } from '@wordpress/block-editor';
import {
	CheckboxControl,
	RadioControl,
	TextControl,
	ToggleControl,
	SelectControl,
	PanelBody,
} from '@wordpress/components';

const Edit = () => {
    const events = useEntityRecords( 'postType', 'event', { per_page: 10 } );
    const authors = useEntityRecords( 'root', 'user', { per_page: 10 } );
    console.log(authors);

    return (
        <> 
            <InspectorControls>
                <PanelBody title={__('Event List Settings', 'event-ops')}>
                    <SelectControl
                        label={__('Order', 'event-ops')}
                        value={'ASC'}
                        options={[{ label: ASC, value: 'ASC' }, {label: DESC, value: 'DESC' }]}
                        onChange={(value) => console.log(value)}
                    />
                    <SelectControl
                        label={__('Order by', 'event-ops')}
                        value={'date'}
                        options={[{ label: __('Start Date'), value: 'start date' }, {label: __('Title'), value: 'title' }]}
                        onChange={(value) => console.log(value)}
                    />
                </PanelBody>


            </ InspectorControls>
                        
            {
                events.records && events.records.length > 0 ?
                    <ul {...useBlockProps()}>
                        {events.records.map((event) => (
                            <li key={event.id}>
                                <strong>{event.title.rendered}</strong>
                            </li>
                        ))}
                    </ul>
                    : 
                        events.hasResolved ? 
                            <Spinner />
                        :  
                            <p {...useBlockProps()}>
                                {__('No events found.', 'event-ops')}
                            </p>            
                            
            }
        </>
    )
}

export default Edit;