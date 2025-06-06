import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useEntityRecords } from '@wordpress/core-data';
import { Spinner } from '@wordpress/components';
import EventsListInspectorControls from './components/EventsListInspectorControls';

const Edit = ({ attributes, setAttributes }) => {
    const { eventsArgs } = attributes;

    const events = useEntityRecords('postType', 'event', eventsArgs);

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
            <EventsListInspectorControls attrs={attributes} setAttrs={setAttributes} />
            {renderEventsList()}
        </>
    )
}

export default Edit;