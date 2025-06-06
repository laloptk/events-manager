import { __ } from '@wordpress/i18n';
import { PanelColorSettings, useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { useEntityRecords, getEntityRecords } from '@wordpress/core-data';
import { Spinner } from '@wordpress/components';
import {InspectorControls } from '@wordpress/block-editor';
import {
    SearchControl,
	CheckboxControl,
    FormTokenField,
	RadioControl,
	TextControl,
	ToggleControl,
	SelectControl,
	PanelBody,
} from '@wordpress/components';
import MultiPick from '../../components/organisms/MultiPick';

const Edit = ({ attributes, setAttributes }) => {
    const {
        eventsArgs,
        userArgs,
        selectedUsers
    } = attributes;
    
    const events = useEntityRecords( 'postType', 'event', eventsArgs );
    const users = useEntityRecords( 'root', 'user', userArgs);
    const updateAttribute = ( attribute, value ) => {
        setAttributes( { [attribute]: value } );
    }
   
    return (
        <> 
            <InspectorControls>
                <PanelBody title={__('Filter by', 'event-ops')}>
                    <SearchControl 
                        label="Search"
                        value={eventsArgs.search} 
                        onChange={ (value) => updateAttribute( "eventsArgs", {...eventsArgs, search: value } ) } 
                        __nextHasNoMarginBottom
                    />
                    <MultiPick
                        data={users?.records ? users.records : []}
                        selectedTokens={selectedUsers}
                        label="Filter by user"
                        attrName="selectedUsers"
                        onSelectionChange={updateAttribute}
                    />
                </PanelBody>
                <PanelBody title={__('Order by', 'event-ops')}>
                    <SelectControl
                        label={__('Order Events List', 'event-ops')}
                        value={eventsArgs.order}
                        options={[{ label: 'ASC', value: 'asc' }, {label: 'DESC', value: 'desc' }]}
                        onChange={(value) => updateAttribute('eventsArgs', {...eventsArgs, order: value})}
                        __nextHasNoMarginBottom={true}
                        __next40pxDefaultSize={true}
                    />
                    <SelectControl
                        label={__('Order by', 'event-ops')}
                        value={'date'}
                        options={[{ label: __('Start Date'), value: 'start date' }, {label: __('Title'), value: 'title' }]}
                        onChange={(value) => console.log(value)}
                        __nextHasNoMarginBottom={true}
                        __next40pxDefaultSize={true}
                    />
                </PanelBody>
                <PanelBody title={__('Filter EventList', 'event-ops')}>
                  
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