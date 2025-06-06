import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useEntityRecords } from '@wordpress/core-data';
import { Spinner } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import {
    SearchControl,
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

    const events = useEntityRecords('postType', 'event', eventsArgs);
    const users = useEntityRecords('root', 'user', userArgs);

    const updateAttribute = (attribute, value) => {
        setAttributes({ [attribute]: value });
    }

    // Function to render the main content with proper error handling
    const renderEventsList = () => {
        // Still loading
        if (events.isResolving && !events.hasResolved) {
            return (
                <div {...useBlockProps()}>
                    <Spinner />
                    <p>{__('Loading events...', 'event-ops')}</p>
                </div>
            );
        }

        // Has resolved and has records
        if (events.hasResolved && events.records && events.records.length > 0) {
            return (
                <ul {...useBlockProps()}>
                    {events.records.map((event) => (
                        <li key={event.id}>
                            <strong>{event.title?.rendered || __('Untitled Event', 'event-ops')}</strong>
                        </li>
                    ))}
                </ul>
            );
        }

        // Has resolved but no records found
        if (events.hasResolved && (!events.records || events.records.length === 0)) {
            return (
                <div {...useBlockProps()}>
                    <p>{__('No events found matching your search criteria.', 'event-ops')}</p>
                </div>
            );
        }

        // Fallback for any other state
        return (
            <div {...useBlockProps()}>
                <p>{__('Loading...', 'event-ops')}</p>
            </div>
        );
    };

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Filter by', 'event-ops')}>
                    <SearchControl
                        label="Search"
                        value={eventsArgs?.search || ''}
                        onChange={(value) => updateAttribute("eventsArgs", { ...eventsArgs, search: value || '' })}
                        __nextHasNoMarginBottom
                    />
                    <MultiPick
                        data={users?.records || []}
                        selectedTokens={selectedUsers || []}
                        label="Filter by user"
                        attrName="selectedUsers"
                        onSelectionChange={updateAttribute}
                    />
                </PanelBody>
                <PanelBody title={__('Order by', 'event-ops')}>
                    <SelectControl
                        label={__('Order Events List', 'event-ops')}
                        value={eventsArgs?.order || 'desc'}
                        options={[{ label: 'ASC', value: 'asc' }, { label: 'DESC', value: 'desc' }]}
                        onChange={(value) => updateAttribute('eventsArgs', { ...eventsArgs, order: value })}
                        __nextHasNoMarginBottom={true}
                        __next40pxDefaultSize={true}
                    />
                    <SelectControl
                        label={__('Order by', 'event-ops')}
                        value={'date'}
                        options={[{ label: __('Start Date'), value: 'start date' }, { label: __('Title'), value: 'title' }]}
                        onChange={(value) => console.log(value)}
                        __nextHasNoMarginBottom={true}
                        __next40pxDefaultSize={true}
                    />
                </PanelBody>
            </InspectorControls>

            {renderEventsList()}
        </>
    )
}

export default Edit;