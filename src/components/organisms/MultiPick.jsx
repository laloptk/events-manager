import { FormTokenField } from '@wordpress/components';

const MultiPick = ({ data, selectedTokens, label, onSelectionChange, attrName }) => {
    const tokens = data ? data.map(token => ({
        value: token.id,
        label: token.name
    })) : [];

    const getSelectedValues = (data, selected = [], getIds = true) => {
        let getKey = 'id';
        let valueKey = 'name';
        
        if(! getIds) {
            [getKey, valueKey] = [valueKey, getKey]
        }

        return selected.map((value) => {
            const selectedValue = data?.find( selectedVal => selectedVal[valueKey] === value);
            return selectedValue ? selectedValue[getKey] : '';
        }).filter(Boolean);
    }

    const selectedTokenLabels = getSelectedValues(data, selectedTokens, false);
    
    return (
        <FormTokenField
            label={label}
            value={selectedTokenLabels}
            suggestions={tokens.map(option => option.label)}
            onChange={(values) => {
                const tokenIds = getSelectedValues(data, values);
                onSelectionChange( attrName, tokenIds );
            }}
            placeholder="Type to search users..."
            maxSuggestions={8}
            __nextHasNoMarginBottom
            __next40pxDefaultSize
        />
    )
}

export default MultiPick;