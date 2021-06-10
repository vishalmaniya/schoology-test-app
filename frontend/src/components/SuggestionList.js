import React from 'react'

const SuggestionList = (suggestion) => {
    const divStyle = {}
    return (
        <div style={divStyle}>{suggestion.name}</div>
    );
}

export default SuggestionList