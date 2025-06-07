import { __ } from '@wordpress/i18n';
import { useEntityRecords } from '@wordpress/core-data';
import { InspectorControls } from '@wordpress/block-editor';
import MultiPick from '../../../components/organisms/MultiPick';
import {
    SearchControl,
    SelectControl,
    PanelBody,
} from '@wordpress/components';

const EventsListInspectorControls = ({attrs, setAttrs}) => {
    const {userArgs, eventsArgs} = attrs;
    const users = useEntityRecords('root', 'user', userArgs);
    
    const updateAttribute = (attribute, value) => {
        setAttrs({ [attribute]: value });
    }
    
    return(
        <InspectorControls>
            <PanelBody title={__('Filter by', 'event-ops')}>
                <SearchControl
                    label="Filter by Search Query"
                    value={eventsArgs?.search || ''}
                    onChange={(value) => updateAttribute("eventsArgs", { ...eventsArgs, search: value || '' })}
                    __nextHasNoMarginBottom
                />
                <SelectControl
                    label={__('Filter by Event Status', 'event-ops')}
                    value={eventsArgs.event_status || ''}
                    options={
                        [
                            { value: 'all', label: 'All Events'},
                            { value: 'upcoming', label: 'Upcoming Events' },
                            { value: 'past', label: 'Past Events' },
                            { value: 'today', label: "Today's Events" },
                            { value: 'next-weekend', label: 'Next Weekend' },
                            { value: 'this-week', label: 'This Week' },
                            { value: 'next-month', label: 'Next Month' },
                            { value: 'recent', label: 'Recent Events (30 days)' },
                            { value: 'soon', label: 'Soon (7 days)' },
                            { value: 'distant', label: 'Distant Future (3+ months)' }
                        ]
                    }
                    onChange={(value) => {
                        updateAttribute('eventsArgs', {...eventsArgs, event_status: value});
                    }}
                    __nextHasNoMarginBottom={true}
                    __next40pxDefaultSize={true}
                />
                <MultiPick
                    data={users?.records || []}
                    selectedTokens={eventsArgs.author || []}
                    label="Filter by user"
                    attrName="eventsArgs"
                    args={eventsArgs}
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
    )
}

export default EventsListInspectorControls