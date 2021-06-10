import React from 'react'
import axios from 'axios'
import Autosuggest from 'react-autosuggest';
import SuggestionList from './SuggestionList'
const API_URL = 'http://127.0.0.1:8081/api/v1/state/search'

function escapeRegexCharacters(str) {
    return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

function getSuggestionValue(suggestion) {
    return suggestion.name;
}

class AutocompleteSearch extends React.Component {
    constructor() {
        super();

        this.state = {
            value: '',
            suggestions: []
        };
    }

    onChange = (event, { newValue, method }) => {
        this.setState({
            value: newValue
        });
    };

    onSuggestionsFetchRequested = ({ value }) => {
        const escapedValue = escapeRegexCharacters(value.trim());

        if (escapedValue === '') {
            return [];
        }

        const regex = new RegExp('^' + escapedValue, 'i');

        axios.get(`${API_URL}?term=${value}`)
            .then(({ data }) => {
                this.setState({
                    suggestions: data.filter(state => regex.test(state.name))
                })
            })
    }

    onSuggestionsClearRequested = () => {
        this.setState({
            suggestions: []
        });
    };

    render() {
        const { value, suggestions } = this.state;
        const inputProps = {
            placeholder: "Search state..",
            value,
            onChange: this.onChange
        };

        return (
            <Autosuggest
                suggestions={suggestions}
                onSuggestionsFetchRequested={this.onSuggestionsFetchRequested}
                onSuggestionsClearRequested={this.onSuggestionsClearRequested}
                getSuggestionValue={getSuggestionValue}
                renderSuggestion={SuggestionList}
                inputProps={inputProps} />
        );
    }
}

export default AutocompleteSearch;